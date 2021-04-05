<x-jet-action-section>
    <x-slot name="title">
        {{ __('Payment Details') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Use this panel to manage payment information and order history.') }}
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-600">
            {{ __('As a customer, you can always visit your Stripe customer profile to view, manage, and configure your information at any time.') }}
        </div>

        <div class="mt-5">
            <div>
                <button wire:click.prevent="portal" class="bg-indigo-500 text-white px-5 py-3 rounded-lg"><span>Billing Portal</span></button>
            </div>
        </div>
    </x-slot>
</x-jet-action-section>
