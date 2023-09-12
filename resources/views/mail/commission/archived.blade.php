@component('mail::message')
# Order Complete

Congratulations, your order has been completed and processed!

${{ number_format($commission->price, 2) }} has been scheduled for payout to your account.

If you are an affiliate or have active incentives, you may have received more than the amount listed.

@component('mail::button', ['url' => route('commissions.show', $commission)])
    View Order
@endcomponent


Thanks,<br>
{{ config('app.name') }}
@endcomponent
