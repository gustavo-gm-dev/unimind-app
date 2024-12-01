<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Configuração') }}
        </h2>
    </x-slot>
    @if(Auth::user()->isAdmin() || Auth::user()->isProfessor())
        @if (session('success'))
            <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @include('settings.index')
    @endif
</x-app-layout>
