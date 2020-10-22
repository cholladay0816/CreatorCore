<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Make a Payment') }}
        </h2>
    </x-slot>

        <input id="card-holder-name" type="text">

        <!-- Stripe Elements Placeholder -->
        <div id="card-element"></div>
        <button id="card-button">
            Process Payment
        </button>

</x-app-layout>
<script src="https://js.stripe.com/v3/"></script>

<script>
    const stripe = Stripe('{{ env('STRIPE_KEY') }}');

    const elements = stripe.elements();
    const cardElement = elements.create('card');

    cardElement.mount('#card-element');

    const cardHolderName = document.getElementById('card-holder-name');
    const cardButton = document.getElementById('card-button');

    cardButton.addEventListener('click', async (e) => {
        const { paymentMethod, error } = await stripe.createPaymentMethod(
            'card', cardElement, {
                billing_details: { name: cardHolderName.value }
            }
        );

        if (error) {
            console.warn(error);
            // Display "error.message" to the user...
        } else {
            const charge = await stripe.paymentRequest({
                country: 'US',
                currency: 'usd',
                total: {
                    label: 'Demo total',
                    amount: 999,
                },
                requestPayerName: true,
                requestPayerEmail: true,
            });
            if(await charge.canMakePayment())
            {
                await charge.show();
            }
            //console.log(charge);
            // The card has been verified successfully...
        }
    });
</script>
