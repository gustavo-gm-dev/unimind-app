<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <!-- Resumo Geral (Cards de Informações) -->
    <div class="pt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <x-info-card title="Total de Pacientes" :value="10" icon="users"/>
            <x-info-card title="Total de Prontuários" :value="10" icon="clipboard"/>
            <x-info-card title="Sessões Agendadas" :value="10" icon="calendar"/>
        </div>
    </div>

    <!-- Lista de Pacientes Vinculados -->
    @php
    $pacients = collect([
        (object)[
            'id' => 1,
            'name' => 'João da Silva',
            'age' => 45,
            'diagnosis' => 'Hipertensão'
        ],
        (object)[
            'id' => 2,
            'name' => 'Maria Oliveira',
            'age' => 30,
            'diagnosis' => 'Diabetes'
        ],
        (object)[
            'id' => 3,
            'name' => 'Carlos Andrade',
            'age' => 62,
            'diagnosis' => null // Diagnóstico não informado
        ],
        (object)[
            'id' => 4,
            'name' => 'Ana Beatriz',
            'age' => 28,
            'diagnosis' => 'Ansiedade'
        ]
    ]);
    @endphp
    <div class="pt-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium text-gray-800 dark:text-gray-200 mb-4">
                        {{ __('Pacientes Vinculados') }}
                    </h3>
                    <x-dash-client :pacients="$pacients"/>
                </div>
            </div>
        </div>
    </div>

    @php
    $sessions = collect([
        (object)[
            'id' => 1,
            'date' => now()->subDays(1),
            'status' => 'Concluída',
            'patient' => (object)['name' => 'João da Silva']
        ],
        (object)[
            'id' => 2,
            'date' => now(),
            'status' => 'Agendada',
            'patient' => (object)['name' => 'Maria Oliveira']
        ],
        (object)[
            'id' => 3,
            'date' => now()->addDays(2),
            'status' => 'Agendada',
            'patient' => (object)['name' => 'Carlos Andrade']
        ],
    ]);
    @endphp
    <!-- Lista de Sessões Agendadas -->
    <div class="pt-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium text-gray-800 dark:text-gray-200 mb-4">
                        {{ __('Sessões Agendadas') }}
                    </h3>
                    <x-dash-sessions :sessions="$sessions"/>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
