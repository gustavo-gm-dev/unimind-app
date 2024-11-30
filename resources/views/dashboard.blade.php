<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <!-- Resumo Geral (Cards de Informações) -->
    <div class="pt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <x-info-card title="Total de Pacientes" :value="$totalPatients" icon="users"/>
            <x-info-card title="Total de Prontuários" :value="$totalMedicalRecords" icon="clipboard"/>
            <x-info-card title="Sessões Agendadas" :value="$totalScheduledSessions" icon="calendar"/>
            <x-info-card title="Sessões Realizadas" :value="$totalSessionsHeld" icon="calendarCheck"/>
        </div>
    </div>

    <!-- Cadastrar novo cliente -->
    <div class="pt-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="w-full flex items-center justify-center sm:justify-start">
                <x-link-button href="{{ route('patients.create') }}">
                    {{ __('Novo Cliente') }}
                </x-link-button>
            </div>
        </div>
    </div>

    <!-- Lista de Sessões Agendadas -->
    <div class="pt-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium text-gray-800 dark:text-gray-200 mb-4">
                        {{ __('Sessões Agendadas') }}
                    </h3>
                    <x-dash-sessions :sessions="$futureSessions"/>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
