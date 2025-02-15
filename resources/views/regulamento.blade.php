<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Faixa Azul - Regulamento') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased bg-[#0b2a54]">

    <!-- Barra superior com logo e botão -->
    <div class="absolute top-4 left-0 w-full px-8 flex justify-between items-center">
        <!-- Logo -->
        <img src="{{ asset('images/nav.png') }}" alt="Logo" class="w-[190px] h-auto ml-[7%]">

        <!-- Botão de voltar -->
        {{--  <button id="openModalButton"
            class="bg-white text-[#003F8E] px-4 py-2 rounded-md flex items-center gap-2 mr-[7%] hover:bg-gray-200 ">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M10 19a1 1 0 01-.7-.29l-7-7a1 1 0 010-1.42l7-7a1 1 0 111.4 1.42L4.42 10l6.3 6.3a1 1 0 01-.72 1.7z"
                    clip-rule="evenodd" />
            </svg>
            Voltar
        </button>  --}}
    </div>

    <!-- Container das imagens -->
    <div class="min-h-screen flex flex-col items-center w-full py-20 space-y-10 ">
        <img src="{{ asset('images/regulamento1.jpg') }}" alt="Regulamento 1"
            class="w-[90%] max-w-3xl shadow-lg rounded-lg mt-10">
        <img src="{{ asset('images/regulamento2.jpg') }}" alt="Regulamento 2"
            class="w-[90%] max-w-3xl shadow-lg rounded-lg">
        <img src="{{ asset('images/regulamento3.jpg') }}" alt="Regulamento 3"
            class="w-[90%] max-w-3xl shadow-lg rounded-lg">
    </div>

</body>

<script>
    document.getElementById('openModalButton').addEventListener('click', function() {
        window.location.href = "{{ route('dashboard') }}";
    });
</script>

</html>
