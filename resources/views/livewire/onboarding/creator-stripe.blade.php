<div class="divide-y divide-gray-200 overflow-hidden rounded-lg bg-white shadow">
    <div class="px-4 py-5 sm:px-6">
        <span class="flex justify-between">
        Creator Stripe Information
        @if($creator_verified)
                @include('livewire.onboarding.complete-marker')
            @endif
        </span>
    </div>
    <div class="px-4 py-5 sm:p-6">
        @livewire('profile.stripe', ['redirect' => route('onboarding')])
    </div>
</div>

