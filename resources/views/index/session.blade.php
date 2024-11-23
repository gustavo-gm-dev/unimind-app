<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Sessões') }}
        </h2>
    </x-slot>

    @if (session('success'))
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    @if (request()->routeIs('session.edit') && isset($session))
        @include('sessions.index', ['patient' => $patient, 'medicalRecord' => $medicalRecord, 'sessions' => $session])
    @else
        @include('sessions.index', ['patient' => $patient, 'medicalRecord' => $medicalRecord])
    @endif
</x-app-layout>
