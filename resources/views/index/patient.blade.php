<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pacientes') }}
        </h2>
    </x-slot>

    <!-- Lista de Pacientes -->
    

    <!-- Formulário de Edição -->
    @if (request()->routeIs('patients.edit') && isset($patient))
        @include('patients.edit', ['patient' => $patient])
    @else
        @include('patients.list', ['patients' => $patients])
    @endif
</x-app-layout>
