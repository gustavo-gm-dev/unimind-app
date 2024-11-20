<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Prontuários') }}
        </h2>
    </x-slot>

    @if (request()->routeIs('medical-records.edit') && isset($patient))
        @include('medical-records.edit', ['patient' => $patient, 'medicalRecord' => $medicalRecord, 'sessions' => $sessions])
    @elseif (request()->routeIs('sessions.start') && isset($medicalRecord))
        @include('medical-records.start', ['patient' => $patient, 'medicalRecord' => $medicalRecord])
    @else
        @include('medical-records.list', ['patients' => $patients])
    @endif
    </x-app-layout>
