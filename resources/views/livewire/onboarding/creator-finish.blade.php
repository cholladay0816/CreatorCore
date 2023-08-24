
<div class="grid">
    <div>
        <ul class="grid grid-cols-1 gap-6  lg:grid-cols-4">
            <div class="hidden lg:flex">

            </div>
        @include('livewire.explore.card')
            <li class="col-span-2">
                <div class="divide-y divide-gray-200 overflow-hidden rounded-lg bg-white shadow">
                    <div class="px-4 py-5 sm:px-6">
                        Confirmation
                    </div>
                    <div class="px-4 py-5 sm:p-6">
                        <span>Please verify that this profile looks correct.  You can change this information any time
                        by visiting your account profile.</span>
                        <hr class="mt-2 pb-2">
                        <button class="bg-indigo-500 text-white px-5 py-3 rounded-lg font-bold" wire:click="onboard">Looks Good!</button>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>
