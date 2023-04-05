@component('mail::message')
# Support Request Submitted

Your support request has been received, and we will review it shortly.

@component('mail::button', ['url' =>  route('tickets.show', $ticket)])
View Ticket
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
