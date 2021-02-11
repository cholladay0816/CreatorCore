@if(auth()->user()->stripe_account_id)
    @livewire('profile.view-stripe-account')
@else
    @livewire('profile.connect-with-stripe')
@endif
