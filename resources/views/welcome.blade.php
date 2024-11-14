<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Unimind - Bem Vindo</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite('resources/css/app.css')

    </head>
    <body class="font-sans bg-gray-100 antialiased">
        <div class="grid h-16 w-full border-b-2 border-b-gray-300 bg-gray-50">
            <div class="ml-4 md:ml-10 lg:ml-16 flex items-center">
                <x-application-logo/>
                <div class="ml-2 max-sm:hidden md:text-base lg:text-2xl font-semibold text-gray-700">
                    Unimind
                </div>
                <nav class="mr-4 md:mr-10 lg:mr-16 flex flex-1 justify-end">
                    <a
                        href="{{ route('login') }}"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                    >
                        Entrar
                    </a>
                    <a
                        href="{{ route('register') }}"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                    >
                        Resgistrar-se
                    </a>

                </nav>
            </div>
        </div>
        <div class="mx-auto text-center items-center">
            <img class="max-sm:hidden w-full" src="{{ asset('img/banner.png') }}" alt="Banner Desktop">
            <img class="sm:hidden w-full" src="{{ asset('img/banner-mobile.png') }}" alt="Banner Desktop">
        </div>
        <footer class="w-full bg-gray-400 text-white text-center p-4 max-sm:text-sm">
            © 2024 Unicuritiba, direitos reservados
        </footer>        
    </body>
</html>
