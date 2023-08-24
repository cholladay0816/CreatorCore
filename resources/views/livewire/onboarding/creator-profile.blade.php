<div class="divide-y divide-gray-200 overflow-hidden rounded-lg bg-white shadow">
    <div class="px-4 py-5 sm:px-6">
        <span class="flex justify-between">
        Creator Page Information
        @if($creator->title)
            @include('livewire.onboarding.complete-marker')
        @endif
        </span>
    </div>
    <div class="px-4 py-5 sm:p-6">
        @livewire('profile.creator')
    </div>
</div>

