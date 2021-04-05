<x-jet-action-section>
    <x-slot name="title">
        {{ __('View Stripe Account') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Access your Stripe Creator Account.') }}
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-600">
            {{ __('If you wish to edit your stripe credentials, verify your information, or initiate a payout,
                    you may do so from the Stripe Account panel.') }}
        </div>

        <div class="mt-5">
            <div>
                <button wire:click.prevent="view" class="bg-indigo-500 text-white px-5 py-3 rounded-lg"><span>Manage <span class="font-bold">Stripe</span></span></button>
            </div>
        </div>

    </x-slot>
</x-jet-action-section>
