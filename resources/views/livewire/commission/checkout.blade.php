<div class="max-w-7xl mx-auto sm:px-6 lg:px-8" x-data x-on:generate-stripe-token.window="generateStripeToken()">
    <div class="bg-gray-50 overflow-hidden rounded-lg my-8">
        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Checkout: {{$commission->displayTitle()}}
                </h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                    Please review your order and enter payment details below.
                </p>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                <dl class="sm:divide-y sm:divide-gray-200">
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Commission to
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $commission->creator->name }}
                        </dd>
                    </div>
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Title
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $commission->title }}
                        </dd>
                    </div>
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Description
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $commission->description }}
                        </dd>
                    </div>
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Memo
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $commission->memo }}
                        </dd>
                    </div>
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Price
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            ${{ number_format($commission->price, 2) }}
                        </dd>
                    </div>
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Fees
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            ${{ number_format($commission->fees, 2) }}
                        </dd>
                    </div>
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Total
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            ${{ number_format($commission->total, 2) }}
                        </dd>
                    </div>
                </dl>
            </div>
            <div class="rounded-lg my-4 p-4 border border-gray-200">
                <h3 class="text-lg leading-6 font-medium text-gray-900 pb-4">Pay with Stripe</h3>
                <div class="flex flex-row gap-x-5">
                    <div class="flex flex-1 bg-lightBlue-50 rounded-md border border-gray-200 px-2 py-3">
                        <div class="w-full" id="card-element"></div>
                    </div>
                    <button wire:click.prevent="submit" class="flex flex-shrink px-3 py-2 bg-indigo-500 text-white rounded-lg">
                        Submit
                    </button>
                </div>
                <span class="text-red-500" id="card-errors">

                </span>
            </div>
        </div>

    </div>
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        var stripe = Stripe('{{ config('stripe.public') }}');
        var elements = stripe.elements();
        var cardElement = elements.create('card', {
            hidePostalCode: true
        });
        cardElement.mount('#card-element');

        window.generateStripeToken = async function () {
            stripe.createToken(cardElement).then(function (result) {
                if (result.error) {
                    // Inform the user if there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server.
                    @this.set('stripe_token', result.token.id);
                    setTimeout(function () {
                    @this.call('store');
                    }, 250);
                }
            });
        }
    </script>
</div>

