<x-guest-layout>
    @section('title', 'Thank You! - ')
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="bg-white">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:py-24 lg:px-8">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-3xl font-extrabold text-gray-900">Thank you all!</h2>
                <p class="mt-4 text-lg text-gray-500">This site would not be possible without help from the following artists.  Please consider them for your next art commissions!</p>
            </div>
            <dl class="w-full pt-12">
                @component('components.thanks.card', [
                'name' => 'Tomato',
                'description' => 'In our early development, we commissioned Tomato to make a few drafts for our website.
                He did such a fantastic job and ended up producing one of our final designs.  We very much appreciate
                the work that Tomato has done for us towards our final design.',
                'img' => url('img/tomato.png'),
                'url' => 'https://tomatoboy.crevado.com/'])
                @endcomponent

                @component('components.thanks.card', [
                'name' => 'Shyro',
                'description' => 'Shyro is an incredibly talented artist who used our original sketch as inspiration
                for an amazing design which carried over into the next round of commissions.  Shyro has always been
                willing to help, and provided tons of early testing for our team.',
                'img' => url('img/shyro.png'),
                'url' => 'https://marobotic.github.io/co/'])
                @endcomponent
                @component('components.thanks.card', [
                'name' => 'Nimnum',
                'description' => 'Nimnum was one of our first round artists, and like many of the others on this list, provided
                                  an excellent draft.  Thank you again for your help!',
                'img' => url('img/nimnum.png'),
                'url' => ''])
                @endcomponent
            </dl>
        </div>
    </div>

</x-guest-layout>
