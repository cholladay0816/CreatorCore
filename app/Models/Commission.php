<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
    public static function statusesCommissions()
    {
        return [
            'Pending'=>'Pending',
            'Active'=>'Active',
            'Overdue'=>'Overdue',
            'Expired'=>'Expired',
            'Completed'=>'Completed',
            'Disputed'=>'Disputed',
            'Refunded'=>'Refunded',
            'Archived'=>'Archived',
        ];
    }
    public static function statusPriorityCommissions()
    {
        return [
            'Overdue' => 0,
            'Active' => 1,
            'Pending' => 2,
            'Disputed' => 3,
            'Completed' => 4,
            'Archived' => 5,
            'Refunded' => 6,
            'Expired' => 7,
            'Purchasing' => 11,
            'Declined' => 11,
            'Unpaid' => 11,
            'Failed' => 11,
        ];
    }
    public static function statusPriorityOrders()
    {
        return [
            'Unpaid' => 0,
            'Failed' => 1,
            'Pending' => 2,
            'Overdue' => 3,
            'Active' => 4,
            'Disputed' => 5,
            'Completed' => 6,
            'Purchasing' => 7,
            'Archived' => 8,
            'Refunded' => 9,
            'Expired' => 10,
            'Declined' => 11
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
    public function canEdit()
    {
        if (Gate::allows('manage-content')) {
            return true;
        }
        if ($this->isCreator() && in_array($this->status, ['Active', 'Overdue'])) {
            return true;
        }
        return false;
    }
    public function isBuyer()
    {
        if (auth()->guest()) {
            return false;
        }
        return auth()->id() == $this->buyer_id;
    }
    public function isCreator()
    {
        if (auth()->guest()) {
            return false;
        }
        return auth()->id() == $this->creator_id;
    }
    public function partner()
    {
        return $this->isCreator()?$this->buyer:$this->creator;
    }
    public function getPartnerAttribute()
    {
        return $this->partner();
    }

    public function events(): HasMany
    {
        return $this->hasMany(CommissionEvent::class);
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
            CommissionEvent::create(
                [
                    'commission_id' => $commission->id,
                    'title' => 'Created Commission', 'color' => 'gray-400', 'status' => 'Unpaid'
                ]
            );
        });
        self::factory(function ($commission) {
            $commission->slug = $commission->getSlug();
        });

        parent::boot();
    }
    public function decline()
    {
        $this->status = 'Declined';
        $this->save();
        CommissionEvent::create(
            [
                'commission_id' => $this->id,
                'title' => 'Declined by ' . $this->buyer->name, 'color' => 'red-500', 'status' => 'Declined'
            ]
        );
        // TODO: Send Email
    }
    public function accept()
    {
        $this->status = 'Active';
        $this->expires_at = now()->addDays($this->days_to_complete);
        $this->save();
        CommissionEvent::create(
            [
                'commission_id' => $this->id,
                'title' => 'Accepted by ' . $this->buyer->name, 'color' => 'green-500', 'status' => 'Purchasing'
            ]
        );
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
                $this->status = 'Purchasing';
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

        CommissionEvent::create(
            [
                'commission_id' => $this->id,
                'title' => 'Commission paid', 'color' => 'green-500', 'status' => 'Pending'
            ]
        );
    }
    public function chargeFail()
    {
        $this->status = 'Failed';
        $this->invoice_id = null;
        $this->save();
        // TODO: send emails and notifications

        CommissionEvent::create(
            [
                'commission_id' => $this->id,
                'title' => 'Payment failed', 'color' => 'red-500', 'status' => 'Failed'
            ]
        );
    }

    public function complete()
    {
        $this->status = 'Completed';
        $this->save();
        // TODO: Send email
        CommissionEvent::create(
            [
                'commission_id' => $this->id,
                'title' => 'Order completed', 'color' => 'blue-500', 'status' => 'Completed'
            ]
        );
    }
    public function dispute()
    {
        $this->status = 'Disputed';
        $this->save();
        // TODO: Send email
        CommissionEvent::create(
            [
                'commission_id' => $this->id,
                'title' => 'Disputed by ' . $this->buyer->name, 'color' => 'red-500', 'status' => 'Disputed'
            ]
        );
    }
    public function expire()
    {
        $this->status = 'Expired';
        $this->save();
        $stripe = new StripeClient(config('stripe.secret'));
        $invoice = $stripe->invoices->retrieve($this->invoice_id, ['expand' => ['charge']]);
        $stripe->refunds->create([
            'charge' => $invoice->charge->id,
            'reason' => 'requested_by_customer'
        ]);
        // TODO: Send email
        CommissionEvent::create(
            [
                'commission_id' => $this->id,
                'title' => 'Expired', 'color' => 'red-500', 'status' => 'Expired'
            ]
        );
    }
    public function refund()
    {
        $this->status = 'Refunded';
        $this->save();
        $stripe = new StripeClient(config('stripe.secret'));
        $invoice = $stripe->invoices->retrieve($this->invoice_id, ['expand' => ['charge']]);
        $stripe->refunds->create([
            'charge' => $invoice->charge->id
        ]);
        // TODO: Send email
        CommissionEvent::create(
            [
                'commission_id' => $this->id,
                'title' => 'Order refunded', 'color' => 'red-500', 'status' => 'Refunded'
            ]
        );
    }
    public function resolve()
    {
        // TODO: Send a resolution letter
        CommissionEvent::create(
            [
                'commission_id' => $this->id,
                'title' => 'Dispute resolved', 'color' => 'yellow-500', 'status' => 'Resolved'
            ]
        );
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

        CommissionEvent::create(
            [
                'commission_id' => $this->id,
                'title' => 'Order archived', 'color' => 'green-500', 'status' => 'Archived'
            ]
        );
    }
}
