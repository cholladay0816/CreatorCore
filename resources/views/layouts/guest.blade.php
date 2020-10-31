<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.0/dist/alpine.js" defer></script>
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
        <nav id="footer" class="bg-white font-sans text-black border-black border-t-4">

            <!-- start container -->
            <div class="container mx-auto pt-8 pb-4">

                <div class="flex flex-wrap overflow-hidden sm:-mx-1 md:-mx-px lg:-mx-2 xl:-mx-2">

                    <div class="w-full overflow-hidden sm:my-1 sm:px-1 sm:w-1/2 md:my-px md:px-px md:w-1/2 lg:my-2 lg:px-2 lg:w-1/4 xl:my-2 xl:px-2 xl:w-1/4 ">
                        <!-- Column 1 Content -->
                        <img style="max-width: 70%;height:auto;" class="" src="{{asset('/logo/default-monochrome-black.svg')}}" alt="{{env('APP_NAME')}} Logo">
                        <div class="text-black pt-3">{{env('APP_NAME')}} is an innovative platform that streamlines the commission process for content creators.</div>
                    </div>

                    <div class="w-full overflow-hidden sm:my-1 sm:px-1 sm:w-1/2 md:my-px md:px-px md:w-1/2 lg:my-2 lg:px-2 lg:w-1/4 xl:my-2 xl:px-2 xl:w-1/4 pb-6">
                        <!-- Column 2 Content -->

                        <h4 class="text-black">Important</h4>
                        <ul class="nav navbar-nav">
                            <li id="navi-2" class="leading-7 text-sm">
                                <a class="text-blue-500 underline text-small" href="/page-1">
                                    Page 1 </a>
                            </li>
                            <li id="navi-1" class="leading-7 text-sm"><a class="text-blue-500 underline text-small" href="/page-2">Page 2</a></li>
                        </ul>


                    </div>

                    <div class="w-full overflow-hidden sm:my-1 sm:px-1 sm:w-1/2 md:my-px md:px-px md:w-1/2 lg:my-2 lg:px-2 lg:w-1/4 xl:my-2 xl:px-2 xl:w-1/4 pb-6">
                        <!-- Column 3 Content -->
                        <h4 class="text-black">Info</h4>
                        <ul class="">
                            <li id="navi-2" class="leading-7 text-sm">
                                <a class="text-blue-500 underline text-small" href="/page-1">
                                    Page 1 </a>
                            </li>
                            <li id="navi-1" class="leading-7 text-sm"><a class="text-blue-500 underline text-small" href="/page-2">Page 2</a></li>
                        </ul>
                    </div>

                    <div class="w-full overflow-hidden sm:my-1 sm:px-1 sm:w-1/2 md:my-px md:px-px md:w-1/2 lg:my-2 lg:px-2 lg:w-1/4 xl:my-2 xl:px-2 xl:w-1/4 pb-6">
                        <!-- Column 4 Content -->

                        <h4 class="text-black">Products</h4>
                        <ul class="">
                            <li id="navi-2" class="leading-7 text-sm">
                                <a class="text-blue-500 underline text-small" href="/page-1">
                                    Page 1 </a>
                            </li>
                            <li id="navi-1" class="leading-7 text-sm"><a class="text-blue-500 underline text-small" href="/page-2">Page 2</a></li>
                        </ul>
                    </div>

                </div>



                <!-- Start footer bottom -->

                <div class="pt-4 md:flex md:items-center md:justify-center " style="border-top:1px solid white">
                    <ul class="">
                        <li class="md:mx-2 md:inline leading-7 text-sm" id="footer-navi-2"><a class="text-white underline text-small" href="/disclaimer">Disclaimer</a></li>
                        <li class="md:mx-2 md:inline leading-7 text-sm" id="footer-navi-2"><a class="text-white underline text-small" href="/cookie">Cookie policy</a></li>
                        <li class="md:mx-2 md:inline leading-7 text-sm" id="footer-navi-2"><a class="text-white underline text-small" href="/privacy">Privacy</a></li>
                    </ul>
                </div>


                <!-- end container -->
            </div>
        </nav>
        @livewireScripts
    </body>
</html>
