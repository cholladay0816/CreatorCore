<div class="grid grid-cols-1 gap-y-4 py-4" wire:poll.4s="refresh">
    @include('livewire.onboarding.buyer-or-creator')
    @if($form['account_type'] == 'buyer')
        @include('livewire.onboarding.buyer-stripe')
        @include('livewire.onboarding.buyer-finish')
    @elseif($form['account_type'] == 'creator')
        @include('livewire.onboarding.creator-profile')
        @if($creator->title)
            @include('livewire.onboarding.creator-stripe')
        @endif
        @include('livewire.onboarding.creator-finish')
        @include('livewire.onboarding.creator-skip')
    @endif
</div>
