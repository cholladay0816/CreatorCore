<x-jet-form-section submit="updateUserBillingInformation">
    <x-slot name="title">
        {{ __('Billing Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s billing information.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <a href="{{url('')}}">Continue to Stripe</a>
            <x-jet-button>
                {{ __('Continue to Stripe') }}
            </x-jet-button>
        </div>

    </x-slot>

</x-jet-form-section>
