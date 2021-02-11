@if($onboarded)
    @livewire('profile.view-stripe-account')
@else
    @livewire('profile.connect-with-stripe')
@endif
