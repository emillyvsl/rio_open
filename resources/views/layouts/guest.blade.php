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
    <style>

    </style>
</head>

<body class="font-sans text-gray-900 antialiased ">
    <div class="w-screen h-screen z-[-1] absolute top-0 left-0">
        <img src="{{ asset('images/fundo.png') }}" class="w-full h-full " />
    </div>

    <div class="min-h-screen flex flex-col  justify-center sm:justify-center items-center   w-full">
        <div class="">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-[295px] h-[200px]">
        </div>

        <div
            class="max-w-[600px]  mt-6 px-8 py-8 bg-stone-800
                        shadow-lg rounded-3xl flex flex-col justify-center items-center mx-auto min-w-[320px] lg:min-w-[600px] ">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
