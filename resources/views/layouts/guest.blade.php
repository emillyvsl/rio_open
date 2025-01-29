<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased ">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-black">
            <div class="">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-[254px] h-[194px]">

                {{--  <a href="/">
                    <x-application-logo class="w-[250px] h-[250px] fill-current text-white" />
                </a>  --}}
            </div>


            <div class="max-w-[520px] sm:max-w-[560px] lg:max-w-md mt-6 px-6 py-6 bg-stone-800 shadow-lg rounded-3xl sm:rounded-3xl flex flex-col justify-center items-center mx-auto min-w-[280px]">
                {{ $slot }}
            </div>




        </div>
    </body>
</html>
