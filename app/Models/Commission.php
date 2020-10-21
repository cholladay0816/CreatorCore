<?php

namespace App\Models;

use DateTimeZone;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Commission extends Model
{
    use HasFactory;

    protected $dates = ['created_at', 'updated_at', 'expiration_date'];

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }
    public function preset()
    {
        return $this->belongsTo(CommissionPreset::class, 'preset_id');
    }
    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'commission_id');
    }
    public function isBuyer()
    {
        return auth()->user()->id == $this->buyer_id;
    }
    public function isCreator()
    {
        return auth()->user()->id == $this->creator_id;
    }
    public function isExpired()
    {
        return $this->expiration_date < now();
    }
    public function getTip()
    {
        if($this->preset == null)
            return 0;
        if($this->price > $this->preset->value)
            return $this->price - $this->preset->value;
        return 0;
    }
    public function hoursleft()
    {
        if($this->isExpired())
            return 0;
        $d1 = new \DateTime(now());
        $d2 = new \DateTime($this->expiration_date);
        $diff = $d1->diff($d2);
        return ($diff->days*24 + $diff->h);
    }
    public function delivery_date()
    {
        if($this->status == 'Pending')
        {
            $date = new \DateTime($this->expiration_date);
            $date->add(new \DateInterval('P' . $this->days_to_complete . 'D'));
        }
        else if($this->status == 'Active')
        {
            $date = new \DateTime($this->expiration_date);
        }
        return $date;
    }
    public function delivery_days()
    {
        $d1 = new \DateTime(now());
        $d2 = $this->delivery_date();
        $diff = $d1->diff($d2);
        return $diff->days;
    }
    public function processing_date()
    {
        $date = $this->delivery_date();
        $date->add(new \DateInterval('P7D'));
        return $date;
    }
    public function processing_days()
    {
        return 7;
    }
    public function getLocalExpiration()
    {
        return $this->expiration_date->diffForHumans();
    }
    public function pay()
    {
        if($this->status != 'Unpaid')
        {
           return null;
        }
        $this->status = 'Pending';
        //Send Notification to Creator
        $this->expiration_date = new \DateTime('now + 7 day',new DateTimeZone('America/Chicago'));
        return $this->save();
    }
    public function accept()
    {
        //Send notification to Buyer
        $this->status = 'Active';
        $this->expiration_date = new \DateTime('now + '.$this->days_to_complete.' day',new DateTimeZone('America/Chicago'));
        return $this->save();
    }
    public function decline()
    {
        //Send notification to Buyer
        //Refund payment
        $this->status = 'Declined';
        $this->expiration_date = now()->toString();
        return $this->save();
    }
    public function remove()
    {
        //Refund payment
        if($this->status == 'Pending')
        {
            //Send message to buyer, do refund
        }
        $this->delete();
    }
    public function removeAttachments()
    {
        $this->attachments->each(function($attachment){
            $attachment->remove();
        });
    }
    public function lockAttachments()
    {
        $this->attachments->each(function($attachment){
            $attachment->lock();
        });
    }
    public function unlistAttachments()
    {
        $this->attachments->each(function($att){
            $att->unlist();
        });
    }
    public function cancel()
    {
        $this->removeAttachments();
        //Send notification to Buyer
        //Give strike to Creator
        //Refund payment
        $this->status = 'Canceled';
        $this->expiration_date = now();
        return $this->save();
    }
    public function expire()
    {
        $this->removeAttachments();
        //Send notification to Creator
        $this->status = 'Canceled';
        $this->expiration_date = now();
        return $this->save();
    }
    public function complete()
    {
        if($this->attachments->count() <= 0)
            return false;
        //Send a notification to the Buyer
        $this->lockAttachments();
        $this->status = 'Completed';
        return $this->save();
    }
    public function archive()
    {
        //Send a notification to the Creator, payment ready
        $this->status = 'Archived';
        return $this->save();
    }
    public function dispute()
    {
        //Send a notification to the Creator, dispute underway
        //Create a case?
        $this->status = 'Disputed';
        return $this->save();
    }
}
