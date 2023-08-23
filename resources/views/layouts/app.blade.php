<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="theme-color" content="#0ea5e9">
        <meta property='og:title' content='{{ (isset($title)?$title . ' - ' : '') . config('app.name', 'CreatorCore') }}'/>
        <meta property='og:site_name' content='{{ config('app.name', 'CreatorCore') }}'/>
        <meta property='og:type' content='website'/>
        <meta property='og:description' content='CreatorCore is a commission-based service for digital artists to make money doing what they love.'/>
        <meta property='og:image' content='{{ asset('img/logos/primary-logo.png') }}'/>
        <meta name="keywords" content="CreatorCore, creator-core, Commission, Artist, Art, Creator, Digital Art, Holladay Digital, Digital, Holladay">

        <title>{{ (isset($title)?$title . ' - ' : '') . config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">


        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">

    <div class="min-h-screen bg-gray-100">

        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="h-screen flex overflow-hidden bg-gray-100" x-data="{showingNavigationDropdown: false}">
            <!-- Off-canvas menu for mobile, show/hide based on off-canvas menu state. -->
            <div class="md:hidden" x-show="showingNavigationDropdown">
                <div class="fixed inset-0 flex z-40 transition-opacity ease-linear duration-300">
                    <!--
                      Off-canvas menu overlay, show/hide based on off-canvas menu state.
                      Entering: "transition-opacity ease-linear duration-300"
                        From: "opacity-0"
                        To: "opacity-100"
                      Leaving: "transition-opacity ease-linear duration-300"
                        From: "opacity-100"
                        To: "opacity-0"
                    -->
                    <div class="fixed inset-0">
                        <div class="absolute inset-0 bg-gray-600 opacity-75"></div>
                    </div>
                    <!--
                      Off-canvas menu, show/hide based on off-canvas menu state.
                      Entering: "transition ease-in-out duration-300 transform"
                        From: "-translate-x-full"
                        To: "translate-x-0"
                      Leaving: "transition ease-in-out duration-300 transform"
                        From: "translate-x-0"
                        To: "-translate-x-full"
                    -->
                    <div class="relative flex-1 flex flex-col max-w-xs w-full bg-gray-800">
                        <div class="absolute top-0 right-0 -mr-12 pt-2">
                            <button @click="showingNavigationDropdown = false" class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                                <span class="sr-only">Close sidebar</span>
                                <!-- Heroicon name: x -->
                                <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto">
                            <div class="flex-shrink-0 flex items-center px-4">
                                <img class="h-8 w-auto" src="{{ asset('img/logos/primary-logo-white-medium-shadowed-text.svg') }}" alt="Workflow">
                            </div>
                            <nav class="mt-5 px-2 space-y-1">
                                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                                <x-jet-nav-link href="{{ route('dashboard') }}"  :active="request()->routeIs('dashboard')">
                                    <div class="flex flex-row">
                                    <!-- Current: "text-gray-300", Default: "text-gray-400 group-hover:text-gray-300" -->
                                    <!-- Heroicon name: home -->
                                    <svg class="text-gray-300 mr-4 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                    Dashboard
                                    </div>
                                </x-jet-nav-link>

                                <x-jet-nav-link href="{{route('notifications.index')}}"  :active="request()->routeIs('notifications*')">
                                    <div class="flex flex-row">
                                        <!-- Heroicon name: bell -->
                                        <svg class="text-gray-400 group-hover:text-gray-300 mr-4 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                        </svg>
                                        Notifications
                                    </div>
                                </x-jet-nav-link>

                                <x-jet-nav-link href="{{route('commissions.index') }}"  :active="request()->routeIs('commissions.index')">
                                    <div class="flex flex-row">
                                        <!-- Heroicon name: folder -->
                                        <svg class="text-gray-400 group-hover:text-gray-300 mr-4 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                                        </svg>
                                        Commissions
                                    </div>
                                </x-jet-nav-link>

                                <x-jet-nav-link href="{{route('commissions.orders') }}"  :active="request()->routeIs('commissions.orders')">
                                    <div class="flex flex-row">
                                        <!-- Heroicon name: folder -->
                                        <svg class="text-gray-400 group-hover:text-gray-300 mr-4 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                        </svg>
                                        Orders
                                    </div>
                                </x-jet-nav-link>

                                <x-jet-nav-link href="{{route('tickets.index') }}"  :active="request()->routeIs('tickets.index')">
                                    <div class="flex flex-row">
                                        <!-- Heroicon name: lifebuoy -->
                                        <svg class="text-gray-400 group-hover:text-gray-300 mr-4 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.712 4.33a9.027 9.027 0 011.652 1.306c.51.51.944 1.064 1.306 1.652M16.712 4.33l-3.448 4.138m3.448-4.138a9.014 9.014 0 00-9.424 0M19.67 7.288l-4.138 3.448m4.138-3.448a9.014 9.014 0 010 9.424m-4.138-5.976a3.736 3.736 0 00-.88-1.388 3.737 3.737 0 00-1.388-.88m2.268 2.268a3.765 3.765 0 010 2.528m-2.268-4.796a3.765 3.765 0 00-2.528 0m4.796 4.796c-.181.506-.475.982-.88 1.388a3.736 3.736 0 01-1.388.88m2.268-2.268l4.138 3.448m0 0a9.027 9.027 0 01-1.306 1.652c-.51.51-1.064.944-1.652 1.306m0 0l-3.448-4.138m3.448 4.138a9.014 9.014 0 01-9.424 0m5.976-4.138a3.765 3.765 0 01-2.528 0m0 0a3.736 3.736 0 01-1.388-.88 3.737 3.737 0 01-.88-1.388m2.268 2.268L7.288 19.67m0 0a9.024 9.024 0 01-1.652-1.306 9.027 9.027 0 01-1.306-1.652m0 0l4.138-3.448M4.33 16.712a9.014 9.014 0 010-9.424m4.138 5.976a3.765 3.765 0 010-2.528m0 0c.181-.506.475-.982.88-1.388a3.736 3.736 0 011.388-.88m-2.268 2.268L4.33 7.288m6.406 1.18L7.288 4.33m0 0a9.024 9.024 0 00-1.652 1.306A9.025 9.025 0 004.33 7.288" />
                                        </svg>
                                        Support Requests
                                    </div>
                                </x-jet-nav-link>
                            </nav>
                        </div>
                        <div class="flex-shrink-0 flex hover:bg-gray-700 transform transform-color duration-150 p-4">
                            <a href="{{route('profile.show')}}" class="flex-shrink-0 group block">
                                <div class="flex flex-row">
                                    <div>
                                        <img class="inline-block h-10 w-10 rounded-full" src="{{auth()->user()->profile_photo_url}}" alt="">
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-base font-medium text-white">
                                            {{ auth()->user()->name }}
                                        </p>
                                        <p class="text-sm font-medium text-gray-400 group-hover:text-gray-300">
                                            View profile
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="flex-shrink-0 w-14">
                        <!-- Force sidebar to shrink to fit close icon -->
                    </div>
                </div>
            </div>

            <!-- Static sidebar for desktop -->
            <div class="hidden md:flex md:flex-shrink-0">
                <div class="flex flex-col w-64">
                    <!-- Sidebar component, swap this element with another sidebar if you like -->
                    <div class="flex flex-col h-0 flex-1 bg-gray-800">
                        <div class="flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
                            <div class="flex items-center flex-shrink-0 px-4">
                                <img class="h-8 w-auto" src="{{ asset('img/logos/primary-logo-white-medium-shadowed-text.svg') }}" alt="Workflow">
                            </div>
                            <nav class="mt-5 flex-1 px-2 bg-gray-800 space-y-1">
                                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                                <x-jet-nav-link href="{{route('dashboard')}}" :active="request()->routeIs('dashboard')">
                                <!-- Current: "text-gray-300", Default: "text-gray-400 group-hover:text-gray-300" -->
                                    <!-- Heroicon name: home -->
                                    <div class="flex flex-row">
                                        <svg class="text-gray-300 mr-3 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                        </svg>
                                        Dashboard
                                        </div>
                                </x-jet-nav-link>

                                <x-jet-nav-link href="{{route('notifications.index')}}" :active="request()->routeIs('notifications*')">
                                    <div class="flex flex-row">
                                        <!-- Heroicon name: bell -->
                                        <svg class="text-gray-400 group-hover:text-gray-300 mr-3 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                        </svg>
                                        Notifications
                                    </div>
                                </x-jet-nav-link>

                                <x-jet-nav-link :active="request()->routeIs('commissions.index')"
                                    href="{{route('commissions.index')}}">
                                    <div class="flex flex-row">
                                    <!-- Heroicon name: folder -->
                                    <svg class="text-gray-400 group-hover:text-gray-300 mr-3 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                                    </svg>
                                    Commissions
                                    </div>
                                </x-jet-nav-link>

                                <x-jet-nav-link :active="request()->routeIs('commissions.orders')"
                                    href="{{route('commissions.orders')}}">
                                    <div class="flex flex-row">
                                        <!-- Heroicon name: folder -->
                                        <svg class="text-gray-400 group-hover:text-gray-300 mr-3 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                        </svg>
                                        Orders
                                    </div>
                                </x-jet-nav-link>
                                <x-jet-nav-link :active="request()->routeIs('tickets.index')"
                                                href="{{route('tickets.index')}}">
                                    <div class="flex flex-row">
                                        <!-- Heroicon name: lifebuoy -->
                                        <svg class="text-gray-400 group-hover:text-gray-300 mr-3 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.712 4.33a9.027 9.027 0 011.652 1.306c.51.51.944 1.064 1.306 1.652M16.712 4.33l-3.448 4.138m3.448-4.138a9.014 9.014 0 00-9.424 0M19.67 7.288l-4.138 3.448m4.138-3.448a9.014 9.014 0 010 9.424m-4.138-5.976a3.736 3.736 0 00-.88-1.388 3.737 3.737 0 00-1.388-.88m2.268 2.268a3.765 3.765 0 010 2.528m-2.268-4.796a3.765 3.765 0 00-2.528 0m4.796 4.796c-.181.506-.475.982-.88 1.388a3.736 3.736 0 01-1.388.88m2.268-2.268l4.138 3.448m0 0a9.027 9.027 0 01-1.306 1.652c-.51.51-1.064.944-1.652 1.306m0 0l-3.448-4.138m3.448 4.138a9.014 9.014 0 01-9.424 0m5.976-4.138a3.765 3.765 0 01-2.528 0m0 0a3.736 3.736 0 01-1.388-.88 3.737 3.737 0 01-.88-1.388m2.268 2.268L7.288 19.67m0 0a9.024 9.024 0 01-1.652-1.306 9.027 9.027 0 01-1.306-1.652m0 0l4.138-3.448M4.33 16.712a9.014 9.014 0 010-9.424m4.138 5.976a3.765 3.765 0 010-2.528m0 0c.181-.506.475-.982.88-1.388a3.736 3.736 0 011.388-.88m-2.268 2.268L4.33 7.288m6.406 1.18L7.288 4.33m0 0a9.024 9.024 0 00-1.652 1.306A9.025 9.025 0 004.33 7.288" />
                                        </svg>
                                        Support Requests
                                    </div>
                                </x-jet-nav-link>
                            </nav>
                        </div>
                        <div class="flex-shrink-0 flex hover:bg-gray-700 transform transform-color duration-150 p-4">
                            <a href="{{route('profile.show')}}" class="flex-shrink-0 w-full group block">
                                <div class="flex flex-row">
                                    <div>
                                        <img src="{{auth()->user()->profile_photo_url}}" class="inline-block h-9 w-9 rounded-full" alt="">
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-white">
                                            {{auth()->user()->name}}
                                        </p>
                                        <p class="text-xs font-medium text-gray-300 group-hover:text-gray-200">
                                            View profile
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-col w-0 flex-1 overflow-hidden">
                <div class="md:hidden pl-1 pt-1 sm:pl-3 sm:pt-3">
                    <button @click="showingNavigationDropdown = true" class="-ml-0.5 -mt-0.5 h-12 w-12 inline-flex items-center justify-center rounded-md text-gray-500 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                        <span class="sr-only">Open sidebar</span>
                        <!-- Heroicon name: menu -->
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
                <main class="flex-1 relative z-0 overflow-y-auto focus:outline-none" tabindex="0">
                    <div class="">
                        <div class="mx-auto">
                            <h1 class="text-2xl font-semibold text-gray-900"></h1>
                        </div>
                        <div class="mx-auto ">
                            <x-agnostic-layout>
                            {{ $slot }}
                            </x-agnostic-layout>
                        </div>
                    </div>
                </main>
            </div>
        </div>

    </div>

    </body>
</html>
