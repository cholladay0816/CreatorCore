<div class="divide-y divide-gray-200 overflow-hidden rounded-lg bg-white shadow">
    <div class="px-4 py-5 sm:px-6">
        <span class="flex justify-between">
        Are you a Buyer or Creator?
        @if($form['account_type'])
                @include('livewire.onboarding.complete-marker')
            @endif
        </span>
    </div>
    <div class="px-4 py-5 sm:p-6">
        <div>
            <label>
                <input type="radio" wire:model="form.account_type" value="buyer"/>
                Buyer
            </label>
            <label>
                <input type="radio" wire:model="form.account_type" value="creator"/>
                Creator
            </label>
        </div>
    </div>
</div>
