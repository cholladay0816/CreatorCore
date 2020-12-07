<x-app-layout>
<div class="bg-white min-h-screen max-w-screen">
    <div class="text-white max-w-screen bg-blue-600 min-h-screen flex flex-col mx-auto">
        <div class="mx-auto my-auto text-center object-center">
            <h1 class="mx-auto font-bold text-6xl">Welcome to {{env('APP_NAME')}}</h1>
            <h2 class="font-semibold text-xl text-gray-200">The Free Platform To Help Artists <span class="font-semibold text-white underline">Succeed</span>.</h2>
        </div>
        <img class="" src="{{asset('img/wave3.png')}}">
    </div>

    <div class="bg-white min-h-screen">
        <div class="max-w-6xl p-8 mt-24 mx-auto shadow-lg rounded-lg text-black">
            <h1 class="text-center font-bold text-4xl">What is {{env('APP_NAME')}}?</h1>
            <p class="pt-4 px-4 text-2xl">
                {{env('APP_NAME')}} is a web service designed to streamline, simplify, and improve the commission process.
                We provide a service where content creators can receive commissions from clients and get paid after delivering
                a finished commission. The service is <a class="text-blue-600 font-semibold">100% free to use</a>, takes <a class="font-semibold text-green-500">$0</a> from creators, and helps you <a class="font-semibold text-orange-500">establish your brand</a>.
            </p>
        </div>

        <div class="max-w-6xl p-8 mt-24 mx-auto shadow-lg rounded-lg text-black">
            <h1 class="text-center font-bold text-4xl">Why choose us?</h1>
            <p class="pt-4 px-4 text-2xl">
                {{env('APP_NAME')}} is built and managed by a dedicated team that found
                several problems with the state of internet freelance work.
                We found room for improvement to provide a better, cheaper, more user-friendly solution to commissions.
                Our mission is to simplify and streamline commissions for artists everywhere,
                so we can stop worrying about logistics and get back to making great things!
            </p>
        </div>
    </div>
    <div class="bg-blue-500 max-w-screen">
        <div class="py-2 max-w-7xl mx-auto grid lg:grid-cols-3 grid-cols-1">
            @component('components.index.featurebadge', ['heading'=>'Customizable'])
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
            @endcomponent
            @component('components.index.featurebadge', ['heading'=>'Community-Driven'])
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
            @endcomponent

            @component('components.index.featurebadge', ['heading'=>'Open Source'])
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
            @endcomponent

        </div>
    </div>
    <div class="bg-white min-h-screen">

    </div>
    </div>
</div>
</x-app-layout>
