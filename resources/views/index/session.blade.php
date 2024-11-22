<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Sessão') }}
        </h2>
    </x-slot>
   

    @include('medical-records.start', ['patient' => $patient, 'medicalRecord' => $medicalRecord])

</x-app-layout>
