<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Ticket extends Model
{
    use HasFactory;

//    public $user_id;
//    public $user;
//    public $slug;
//    public $title;
//    public $description;
//    public $status;
//    public $ticketResponses;

    protected $guarded = [];

    // Generates a unique slug to limit number of tickets to one per hour
    protected static function generateSlug($id)
    {
        return $id . '-' . now()->format('m-d-y-H');
    }

    protected static function boot()
    {
        // Generate slug when creating or being faked
        self::creating(function (Ticket $ticket) {
            $ticket->slug = static::generateSlug($ticket->user_id);
        });
        self::factory(function (Ticket $ticket) {
            $ticket->slug = static::generateSlug($ticket->user_id);
        });
        parent::boot();
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo|User
    {
        return $this->belongsTo(User::class);
    }

    public function ticketResponses(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(TicketResponse::class);
    }
}
