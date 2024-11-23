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
                            <li><strong>{{ __('Nome:') }}</strong> {{ $patient->cliente_nome }}</li>
                            <li><strong>{{ __('E-mail:') }}</strong> {{ $patient->cliente_email }}</li>
                            <li><strong>{{ __('CPF:') }}</strong> {{ $patient->cliente_cpf }}</li>
                            <li><strong>{{ __('RG:') }}</strong> {{ $patient->cliente_rg }}</li>
                            <li><strong>{{ __('Telefone:') }}</strong> {{ $patient->cliente_telefone }}</li>
                            <li><strong>{{ __('Data de Nascimento:') }}</strong> {{ $patient->cliente_dt_nascimento }}</li>
                            <li><strong>{{ __('Escolaridade:') }}</strong> {{ ucfirst($patient->cliente_escolaridade) }}</li>
                            <li><strong>{{ __('Gênero:') }}</strong> {{ ucfirst($patient->cliente_genero) }}</li>                            
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

                
                @isset($medicalRecord->prontuario_id)
                    
                <div class="flex items-center justify-between">
                    <!-- Informações do Prontuário -->
                    <div class="flex-1">
                        <div class="mb-2">
                            <p class="text-sm text-gray-600">
                                <strong>{{ __('Data de Cadastro:') }}</strong> {{ $medicalRecord->created_at->format('d/m/Y H:i:s') }}
                            </p>
                        </div>
                        <div class="mb-4">
                            <p class="text-sm text-gray-600">
                                <strong>{{ __('Última Atualização:') }}</strong> {{ $medicalRecord->updated_at->format('d/m/Y H:i:s') }}
                            </p>
                        </div>
                    </div>
                
                @if ($medicalRecord->ultimoArquivo)
                <!-- Ícone de Visualizar -->
                    <div class="flex-none w-auto">
                        <div class="flex justify-end">
                            <a href="{{ route('records.view', ['idPatient' => $patient->cliente_id, 'idRecord' => $medicalRecord->prontuario_id, 'fileId' => $medicalRecord->ultimoArquivo->arquivo_id]) }}" 
                            class="cursor-pointer bg-blue-100 hover:bg-blue-200 rounded-full p-2 inline-flex items-center transition duration-150 ease-in-out">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 -960 960 960" fill="#5985E1">
                                    <path d="M240-80q-33 0-56.5-23.5T160-160v-640q0-33 23.5-56.5T240-880h320l240 240v240h-80v-200H520v-200H240v640h360v80H240Zm638 15L760-183v89h-80v-226h226v80h-90l118 118-56 57Zm-638-95v-640 640Z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                @endif
                </div>
                
                @endisset

                <!-- Formulário de Preenchimento -->
                <div class="mb-4">
                    <x-input-label for="prontuario_tx_historico_familiar" :value="__('Histórico Familiar')" />
                    <textarea id="prontuario_tx_historico_familiar" name="prontuario_tx_historico_familiar" rows="8" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50"
                        >{{ old('prontuario_tx_historico_familiar', $medicalRecord->prontuario_tx_historico_familiar ?? '') }}</textarea>
                </div>

                <div class="mb-4">
                    <x-input-label for="prontuario_tx_historico_social" :value="__('Histórico Social')" />
                    <textarea id="prontuario_tx_historico_social" name="prontuario_tx_historico_social" rows="8" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50"
                        >{{ old('prontuario_tx_historico_social', $medicalRecord->prontuario_tx_historico_social ?? '') }}</textarea>
                </div>

                <div class="mb-4">
                    <x-input-label for="prontuario_tx_consideracoes" :value="__('Considerações')" />
                    <textarea id="prontuario_tx_consideracoes" name="prontuario_tx_consideracoes" rows="8" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50"
                        >{{ old('prontuario_tx_consideracoes', $medicalRecord->prontuario_tx_consideracoes ?? '') }}</textarea>
                </div>

                <div class="mb-4">
                    <x-input-label for="prontuario_tx_observacao" :value="__('Observações')" />
                    <textarea id="prontuario_tx_observacao" name="prontuario_tx_observacao" rows="8" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50"
                        >{{ old('prontuario_tx_observacao', $medicalRecord->prontuario_tx_observacao ?? '') }}</textarea>
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
        <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
            <h3 class="text-lg font-medium text-gray-800 dark:text-gray-200 mb-4">{{ __('Sessões') }}</h3>
            <x-view-sessions :sessions="$sessions" :medicalRecord="$medicalRecord"/>
            <div class="mt-8 flex justify-end">
                <x-link-button href="{{ route('session.create', $medicalRecord->prontuario_id) }}">
                    {{ __('Nova Sessão') }}
                </x-link-button>
            </div>
        </div>
    </div>
</div>
