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


    @if(Auth::user()->true || Auth::user()->true)
    <div class="pt-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="w-full flex items-center justify-center sm:justify-start">
                <x-link-button href="{{ route('patients.create') }}">
                    {{ __('Novo Cliente') }}
                </x-link-button>
            </div>
        </div>
    </div>
    @endif


    <head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100">
    <div class="pt-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
        <!-- Gráfico 1 -->
        <div class="p-6 bg-white dark:bg-gray-800 text-gray-600 rounded-lg shadow">
            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-4">Pacientes por Gênero</h3>
            <canvas id="donutChart1"></canvas>
        </div>

        <!-- Gráfico 2 -->
        <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow">
            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-4">Sessões Realizadas</h3>
            <canvas id="donutChart2"></canvas>
        </div>
    </div>
</div>

<script>
    // Gráfico 1: Pacientes por Gênero
    const ctx1 = document.getElementById('donutChart1').getContext('2d');
    new Chart(ctx1, {
        type: 'doughnut',
        data: {
            labels: ['Masculino', 'Feminino', 'Outro'],
            datasets: [{
                data: [1, 2, 5], // Dados do gráfico
                backgroundColor: ['#4F46E5', '#EC4899', '#F59E0B'], // Cores
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top'
                }
            }
        }
    });
    // Gráfico 2: Sessões Realizadas
    const ctx2 = document.getElementById('donutChart2').getContext('2d');
    new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: ['Concluídas', 'Canceladas', 'Reagendadas'],
            datasets: [{
                data: [2, 5, 10], // Dados do gráfico
                backgroundColor: ['#22C55E', '#EF4444', '#3B82F6'], // Cores
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top'
                }
            }
        }
    });
</script>
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
