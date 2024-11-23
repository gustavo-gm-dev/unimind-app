<!-- Container Pai -->
<div x-data="{ selectedSession: null }" class="grid grid-cols-1 lg:grid-cols-3 gap-4">

    <!-- Lista de Sessões (Esquerda) -->
    <div class="bg-gray-100 dark:bg-gray-800 rounded shadow p-4 max-h-96 overflow-y-auto">
        <ul>
            @foreach($sessions as $session)
                <li>
                    <button
                        @click="selectedSession = {{ $session->sessao_id }}"
                        x-bind:class="{
                            'bg-gray-100 text-gray-800 hover:bg-gray-200': '{{ $session->sessao_st_confirmado }}' === 'PENDENTE' && new Date('{{ $session->sessao_dt_inicio }}') < new Date(),
                            'bg-red-100 text-red-800 hover:bg-red-200': '{{ $session->sessao_st_confirmado }}' === 'PENDENTE' && new Date('{{ $session->sessao_dt_inicio }}') >= new Date(),
                            'bg-yellow-100 text-yellow-800 hover:bg-yellow-200': '{{ $session->sessao_st_confirmado }}' === 'INICIADA',
                            'bg-green-100 text-green-800 hover:bg-green-200': '{{ $session->sessao_st_confirmado }}' === 'CONCLUIDA'
                        }"
                        class="w-full text-left py-2 px-4 border border-gray-300 rounded"
                    >
                        {{ __('Sessão de:') }} {{ \Carbon\Carbon::parse($session->sessao_dt_inicio)->format('d/m/Y') }}
                    </button>
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Detalhes da Sessão (Direita) -->
    <div 
        class="bg-gray-50 dark:bg-gray-900 rounded shadow p-4 lg:col-span-2"
        :class="selectedSession ? 'block' : 'hidden lg:block'"
    >
        <template x-if="selectedSession">
            <div>
                @foreach($sessions as $session)
                    <div x-show="selectedSession === {{ $session->sessao_id }}">
                        <h3 class="text-lg font-medium text-gray-800 dark:text-gray-200">{{ __('Detalhes da Sessão') }}</h3>
                        <p><strong>{{ __('Data:') }}</strong> {{ \Carbon\Carbon::parse($session->sessao_dt_inicio)->format('d/m/Y') }}</p>
                        <p><strong>{{ __('Principal:') }}</strong> {{ $session->sessao_tx_principal }}</p>
                        <p><strong>{{ __('Procedimento:') }}</strong> {{ $session->sessao_tx_procedimento }}</p>
                        <p><strong>{{ __('Encaminhamento:') }}</strong> {{ $session->sessao_tx_encaminhamento }}</p>
                        <p><strong>{{ __('Observação:') }}</strong> {{ $session->sessao_tx_observacao }}</p>

                        <!-- Botões para Ação -->
                        <div class="mt-6 space-x-4">
                            @if ($session->sessao_st_confirmado === 'PENDENTE')
                                <x-link-button href="{{ route('session.edit', $session->sessao_id) }}">
                                    {{ __('Iniciar Sessão') }}
                                </x-link-button>
                            @elseif ($session->sessao_st_confirmado === 'INICIADA')
                                <x-link-button href="{{ route('session.edit', $session->sessao_id) }}">
                                    {{ __('Editar Sessão') }}
                                </x-link-button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </template>
        <template x-if="!selectedSession">
            <p class="text-gray-600 dark:text-gray-300">{{ __('Selecione uma sessão para visualizar os detalhes.') }}</p>
        </template>
    </div>
</div>
