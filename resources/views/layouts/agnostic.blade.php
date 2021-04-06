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

    <title>{{ (isset($title) ? $title . ' - ' : '') . config('app.name', 'CreatorCore') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>
<body class="font-sans antialiased">
<div>
    @livewire('navigation-menu')
    <main>
        <div class="">
            {{$slot}}
        </div>
    </main>
</div>

    @stack('modals')

    @livewireScripts
</body>
</html>
