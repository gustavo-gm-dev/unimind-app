<div class="py-4">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg px-4 py-2">
            <!-- Dropdown para Exibir os Dados do Paciente -->
            <x-dropdown-list>
                <x-slot name="trigger">
                    <button class="inline-flex items-center px-3 py-2 border border-transparent leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                        <div class="w-full text-left text-gray-800 font-medium">
                            {{ __('Dados do Paciente') }}
                        </div>
                        <div class="ms-1">
                            <svg :class="{ 'rotate-180': open }" class="fill-current h-4 w-4 transition-transform duration-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <div class="mx-4 bg-gray-100 sm:rounded-lg">
                        <ul class="p-4 text-sm text-gray-600 dark:text-gray-300 space-y-2">
                            <li><strong>{{ __('Nome:') }}</strong> {{ $patient->name }}</li>
                            <li><strong>{{ __('E-mail:') }}</strong> {{ $patient->email }}</li>
                            <li><strong>{{ __('CPF:') }}</strong> {{ $patient->cpf }}</li>
                            <li><strong>{{ __('RG:') }}</strong> {{ $patient->rg }}</li>
                            <li><strong>{{ __('Telefone:') }}</strong> {{ $patient->phone }}</li>
                            <li><strong>{{ __('Data de Nascimento:') }}</strong> {{ $patient->date_birth }}</li>
                            <li><strong>{{ __('Escolaridade:') }}</strong> {{ ucfirst($patient->education) }}</li>
                            <li><strong>{{ __('Gênero:') }}</strong> {{ ucfirst($patient->gender) }}</li>
                        </ul>
                    </div>
                </x-slot>
            </x-dropdown-list>
        </div>
    </div>
</div>

<div class="py-4">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <form method="POST" action="{{ route('medical-records.save', $medicalRecord->prontuario_id ?? null) }}">
                @csrf
                @if(isset($medicalRecord->prontuario_id))
                    @method('PUT')
                @endif

                <!-- Exibição de Informações do Prontuário -->
                @isset($medicalRecord->prontuario_id)
                    <div class="mb-4">
                        <p class="text-sm text-gray-600"><strong>{{ __('Data de Cadastro:') }}</strong> {{ $medicalRecord->prontuario_dt_register }}</p>
                    </div>
                    <div class="mb-4">
                        <p class="text-sm text-gray-600"><strong>{{ __('Última Atualização:') }}</strong> {{ $medicalRecord->prontuario_dt_update }}</p>
                    </div>
                @endisset

                <!-- Formulário de Preenchimento -->
                <div class="mb-4">
                    <x-input-label for="prontuario_tx_historico_familiar" :value="__('Histórico Familiar')" />
                    <textarea id="prontuario_tx_historico_familiar" name="prontuario_tx_historico_familiar" rows="8" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50"
                        >{{ old('prontuario_tx_historico_familiar', $medicalRecord->prontuario_tx_family_history ?? '') }}
                    </textarea>
                </div>

                <div class="mb-4">
                    <x-input-label for="prontuario_tx_historico_social" :value="__('Histórico Social')" />
                    <textarea id="prontuario_tx_historico_social" name="prontuario_tx_historico_social" rows="8" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50"
                        >{{ old('prontuario_tx_historico_social', $medicalRecord->prontuario_tx_historico_social ?? '') }}</textarea>
                </div>

                <div class="mb-4">
                    <x-input-label for="prontuario_tx_consideracoes" :value="__('Considerações')" />
                    <textarea id="prontuario_tx_consideracoes" name="prontuario_tx_consideracoes" rows="8" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50"
                        >{{ old('prontuario_tx_consideracoes', $medicalRecord->prontuario_tx_considerations ?? '') }}</textarea>
                </div>

                <div class="mb-4">
                    <x-input-label for="prontuario_tx_observacao" :value="__('Observações')" />
                    <textarea id="prontuario_tx_observacao" name="prontuario_tx_observacao" rows="8" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50"
                        >{{ old('prontuario_tx_observacao', $medicalRecord->prontuario_tx_observation ?? '') }}</textarea>
                </div>

                <!-- Botão de Salvar -->
                <div class="mt-8 flex justify-end">
                    <x-primary-button>
                        {{ __('Salvar Prontuário') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="py-4">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <!-- Sessões -->
            @if($sessions->isEmpty())
                <!-- Botão para Iniciar Sessão -->
                <button 
                    class="w-full text-center bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition ease-in-out duration-150"
                    onclick="window.location.href='{{ route('sessions.create', $patient->id) }}'">
                    {{ __('Iniciar Sessão') }}
                </button>
            @else
                <!-- Lista de Sessões -->
                <div x-data="{ selectedSession: null }">
                    <h3 class="text-lg font-medium text-gray-800 dark:text-gray-200">{{ __('Sessões') }}</h3>
                    <ul class="mt-4 space-y-2">
                        @foreach($sessions as $session)
                            <li>
                                <button 
                                    class="w-full text-left text-gray-800 dark:text-gray-200 py-2 px-4 border border-gray-300 rounded hover:bg-gray-100 dark:hover:bg-gray-700"
                                    @click="selectedSession = {{ $session->id }}">
                                    {{ __('Sessão de:') }} {{ $session->date }}
                                </button>
                            </li>
                        @endforeach
                    </ul>

                    <!-- Detalhes da Sessão Selecionada -->
                    <div x-show="selectedSession" class="mt-6 p-4 bg-gray-100 dark:bg-gray-700 rounded shadow">
                        <h4 class="text-md font-semibold text-gray-800 dark:text-gray-200">{{ __('Detalhes da Sessão') }}</h4>
                        <template x-for="session in {{ $sessions }}">
                            <div x-show="session.id == selectedSession">
                                <p class="mt-2"><strong>{{ __('Data:') }}</strong> <span x-text="session.date"></span></p>
                                <p class="mt-2"><strong>{{ __('Principal:') }}</strong> <span x-text="session.sessao_tx_principal"></span></p>
                                <p class="mt-2"><strong>{{ __('Procedimento:') }}</strong> <span x-text="session.sessao_tx_procedimento"></span></p>
                                <p class="mt-2"><strong>{{ __('Encaminhamento:') }}</strong> <span x-text="session.sessao_tx_encaminhamento"></span></p>
                                <p class="mt-2"><strong>{{ __('Observação:') }}</strong> <span x-text="session.sessao_tx_observacao"></span></p>
                            </div>
                        </template>
                    </div>
                </div>

                <div class="mt-8">
                    <button 
                        class="w-full text-center bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition ease-in-out duration-150"
                        onclick="window.location.href='{{ route('sessions.start', $patient->id) }}'">
                        {{ __('Iniciar Sessão') }}
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>
