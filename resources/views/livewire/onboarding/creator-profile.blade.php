<div class="divide-y divide-gray-200 overflow-hidden rounded-lg bg-white shadow">
    <div class="px-4 py-5 sm:px-6">
        <span class="flex justify-between">
        Creator Page Information
        @if($creator->title)
            @include('livewire.onboarding.complete-marker')
        @endif
        </span>
    </div>
    <div class="grid grid-cols-1 px-4 py-5 sm:p-6 gap-y-2">
        @livewire('profile.update-profile-information-form')
        @livewire('profile.creator')
    </div>
</div>

