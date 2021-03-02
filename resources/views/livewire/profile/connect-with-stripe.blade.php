<x-jet-action-section>
    <x-slot name="title">
        {{ __('Connect with Stripe') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Connect your stripe account in order to receive payouts as a creator.') }}
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-600">
            {{ __('This option will create a Stripe account which we can send payouts to.
                    Once verified, you will be able to use this panel to manage your Stripe customer profile.') }}
        </div>

        <div class="mt-5">
            <div>
                <a href=" {{ $accountLink }} " class="bg-indigo-500 text-white px-5 py-3 rounded-lg"><span>Connect with <span class="font-bold">Stripe</span></span></a>
            </div>
        </div>
    </x-slot>
</x-jet-action-section>
