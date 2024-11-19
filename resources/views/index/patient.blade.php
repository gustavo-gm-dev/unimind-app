<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pacientes') }}
        </h2>
    </x-slot>

    @if (session('success'))
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">
            {{ session('success') }}
        </div>
    @endif
    
    @if (request()->routeIs('patients.edit') && isset($patient))
        <!-- Lista de Pacientes -->
        @include('patients.edit', ['patient' => $patient])
    @else
        <!-- Formulário de Edição -->
        @include('patients.list', ['patients' => $patients])
    @endif
</x-app-layout>
