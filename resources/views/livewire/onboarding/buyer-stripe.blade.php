<div class="divide-y divide-gray-200 overflow-hidden rounded-lg bg-white shadow">
    <div class="px-4 py-5 sm:px-6">
        <span class="flex justify-between">
        Buyer Stripe Information (Optional)
        @if($buyer_verified)
            @include('livewire.onboarding.complete-marker')
        @endif
        </span>
    </div>
    <div class="px-4 py-5 sm:p-6">
        @livewire('profile.payment-details', ['redirect' => route('onboarding')])
    </div>
</div>

