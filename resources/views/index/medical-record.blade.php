<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Prontuários') }}
        </h2>
    </x-slot>

    @if (session('success'))
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    @if (request()->routeIs('medical-records.edit') && isset($patient))
        @include('medical-records.edit', ['patient' => $patient, 'medicalRecord' => $medicalRecord, 'sessions' => $sessions])
    @else
        @include('medical-records.list', ['patients' => $patients])
    @endif
</x-app-layout>
