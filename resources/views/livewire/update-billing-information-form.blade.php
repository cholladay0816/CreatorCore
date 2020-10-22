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
            <a class="button bg-indigo-500 hover:bg-indigo-400 text-white font-semibold hover:text-white
                      py-2 px-4 border border-indigo-500 hover:border-transparent rounded"
               href="{{auth()->user()->billingPortalUrl(url('user/profile'))}}">Continue to Stripe</a>
        </div>

    </x-slot>

</x-jet-form-section>
