<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Agendamento') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('scheduling.update', $session->sessao_id) }}">
                        @csrf

                        <div class="mb-4">
                            <x-input-label for="sessao_dt_inicio" :value="__('Data do Agendamento')" />
                            <x-text-input id="sessao_dt_inicio" class="block mt-1 w-full" type="date" name="sessao_dt_inicio" :value="$session->sessao_dt_inicio->format('Y-m-d')" required />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="sessao_periodo" :value="__('Período do Atendimento')" />
                            <select id="sessao_periodo" name="sessao_periodo" class="block mt-1 w-full" required>
                                <option value="manha" @if($session->sessao_periodo === 'manha') selected @endif>{{ __('Manhã') }}</option>
                                <option value="tarde" @if($session->sessao_periodo === 'tarde') selected @endif>{{ __('Tarde') }}</option>
                                <option value="noite" @if($session->sessao_periodo === 'noite') selected @endif>{{ __('Noite') }}</option>
                            </select>
                        </div>
                        

                        <div class="mb-4">
                            <x-input-label for="sessao_tipo_atendimento" :value="__('Tipo de Atendimento')" />
                            <select id="sessao_tipo_atendimento" name="sessao_tipo_atendimento" class="block mt-1 w-full">
                                <option value="PRESENCIAL" @if($session->sessao_tipo_atendimento === 'PRESENCIAL') selected @endif>{{ __('Presencial') }}</option>
                                <option value="REMOTO" @if($session->sessao_tipo_atendimento === 'REMOTO') selected @endif>{{ __('Remoto') }}</option>
                            </select>
                        </div>

                        <x-primary-button>{{ __('Atualizar Agendamento') }}</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
