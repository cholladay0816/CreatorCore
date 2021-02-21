<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Stripe\StripeClient;

class Commission extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $dates = [
        'created_at',
        'updated_at',
        'expires_at',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public static function statuses()
    {
        return [
            'Unpaid'=>'Unpaid',
            'Pending'=>'Pending',
            'Declined'=>'Declined',
            'Purchasing'=>'Purchasing',
            'Failed'=>'Failed',
            'Active'=>'Active',
            'Overdue'=>'Overdue',
            'Expired'=>'Expired',
            'Completed'=>'Completed',
            'Disputed'=>'Disputed',
            'Refunded'=>'Refunded',
            'Archived'=>'Archived',
        ];
    }

    public function displayTitle()
    {
        return '[$' . $this->price . '] ' . $this->title;
    }
    public function getDisplayTitleAttribute()
    {
        return $this->displayTitle();
    }

    public function canView()
    {
        if (Gate::allows('manage-content')) {
            return true;
        }
        if (auth()->guest()) {
            return false;
        }
        if (!$this->isBuyer() && !$this->isCreator()) {
            return false;
        }

        return true;
    }
    public function isBuyer()
    {
        if (auth()->guest()) {
            return false;
        }
        return auth()->user()->id == $this->buyer_id;
    }
    public function isCreator()
    {
        if (auth()->guest()) {
            return false;
        }
        return auth()->user()->id == $this->creator_id;
    }


    public function buyer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id');
    }
    public function preset(): BelongsTo
    {
        return $this->belongsTo(CommissionPreset::class, 'commission_preset_id');
    }
    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'commission_id');
    }

    public function getSlug()
    {
        return Str::slug(($this->id??(Commission::count() + 1)) . '-' . $this->title);
    }

    protected static function boot()
    {
        self::creating(function ($commission) {
            if ($commission->commission_preset_id != null) {
                $preset = $commission->preset;
                $commission->title = $preset->title;
                $commission->description = $preset->description;
                $commission->price = $preset->price;
                $commission->days_to_complete = $preset->days_to_complete;
            }
            $commission->slug = $commission->getSlug();
        });
        self::created(function ($commission) {
            $commission->slug = $commission->getSlug();
        });
        self::factory(function ($commission) {
            $commission->slug = $commission->getSlug();
        });

        parent::boot();
    }
//
//    public function generateProduct()
//    {
//        $stripe = new StripeClient(config('stripe.secret'));
//        $product = $stripe->products->create(
//            [
//                'name' => $this->title,
//                'description' => $this->description,
//                'metadata' => ['user_id' => $this->user_id],
//            ]
//        );
//        $this->product_id = $product->id;
//
//        $this->generatePrice();
//    }
//
//    public function generatePrice()
//    {
//        $stripe = new StripeClient(config('stripe.secret'));
//        $stripe->prices->create(
//            [
//                'unit_amount'=>$this->price * 100,
//                'currency' => 'usd',
//                'product' => $this->product_id,
//                'type' => 'one_time',
//            ]
//        );
//    }

    public function decline()
    {
        $this->status = 'Declined';
        $this->save();
        // TODO: Send Email
    }
    public function accept()
    {
        $this->status = 'Purchasing';
        $this->save();
        $this->attemptCharge();
    }
    public function attemptCharge()
    {
        if ($this->invoice_id) {
            return null;
        }

        $this->buyer->createOrGetStripeCustomer();
        if ($this->buyer->hasPaymentMethod()) {
            try {
                $amount = $this->price * 100;
                $total = $amount + 30;
                $total += ceil(($this->price * 0.06) * 100);

                $invoice = $this->buyer->invoiceFor($this->displayTitle(), $total);
                $this->invoice_id = $invoice->id;
                $this->save();
                return $invoice;
            } catch (\Exception $e) {
                return $e;
            }
        }
        return null;
    }

    public function checkInvoiceStatus()
    {
        $stripe = new \Stripe\StripeClient(
            config('stripe.secret'),
        );
        $invoice = $stripe->invoices->retrieve(
            $this->invoice_id,
        );
        if ($invoice->status == 'paid') {
            $this->chargeSuccess();
        }
    }

    public function chargeSuccess()
    {
        // TODO: send emails and notifications
        $this->status = 'Pending';
        $this->save();
    }
    public function chargeFail()
    {
    }

    public function complete()
    {
        $this->status = 'Completed';
        $this->save();
        // TODO: Send email
    }
    public function dispute()
    {
        $this->status = 'Disputed';
        $this->save();
        // TODO: Send email
    }
    public function expire()
    {
        $this->status = 'Expired';
        $this->save();
        // TODO: Refund buyer
        // TODO: Send email
    }
    public function refund()
    {
        $this->status = 'Refunded';
        $this->save();
        // TODO: Refund buyer
        // TODO: Send email
    }
    public function resolve()
    {
        // TODO: Send a resolution letter
        $this->archive();
    }
    public function archive()
    {
        $this->status = 'Archived';
        $this->save();
        // TODO: payout the creator
        $stripe = new StripeClient(config('stripe.secret'));
        $invoice = $stripe->invoices->retrieve($this->invoice_id, ['expand' => ['charge']]);

        $transfer = $stripe->transfers->create(
            [
                'amount' => $this->price * 100,
                'currency' => 'usd',
                'source_transaction' => $invoice->charge->id,
                'destination' => $this->creator->stripe_account_id,
                'transfer_group' => $this->slug,
            ]
        );

        // $this->creator->payout($this->price);
    }
}
