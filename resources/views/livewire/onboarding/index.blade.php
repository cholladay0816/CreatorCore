<div class="grid grid-cols-1 gap-y-4 py-4" wire:poll.5s="refresh">
    @include('livewire.onboarding.buyer-or-creator')
    @if($form['account_type'] == 'buyer')
        @include('livewire.onboarding.buyer-stripe')
        @if($buyer_verified)
            @include('livewire.onboarding.buyer-finish')
        @endif
    @elseif($form['account_type'] == 'creator')
        @include('livewire.onboarding.creator-stripe')
        @if($creator_verified)
            @include('livewire.onboarding.creator-profile')
            @if($creator->title)
                @include('livewire.onboarding.creator-finish')
            @endif
        @endif
    @endif
</div>
