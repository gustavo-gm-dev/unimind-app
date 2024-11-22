<div class="pt-4">
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
                            <li cl><strong>{{ __('Nome:') }}</strong> {{ $patient->cliente_nome }}</li>
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

<div class="pt-4">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg px-4 py-2">
            <!-- Dropdown para Exibir os Dados de Prontuário -->
            <x-dropdown-list>
                <x-slot name="trigger">
                    <button class="inline-flex items-center px-3 py-2 border border-transparent leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                        <div class="w-full text-left text-gray-800 font-medium">
                            {{ __('Dados de Prontuário') }}
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
                            <li><strong>{{ __('Histórico Familiar:') }}</strong> {{ $medicalRecord->prontuario_tx_historico_familiar }}</li>
                            <li><strong>{{ __('Histórico Social:') }}</strong> {{ $medicalRecord->prontuario_tx_historico_social }}</li>
                            <li><strong>{{ __('Considerações:') }}</strong> {{ $medicalRecord->prontuario_tx_consideracoes }}</li>
                            <li><strong>{{ __('Observações:') }}</strong> {{ $medicalRecord->prontuario_tx_observacao }}</li>                            
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
            <form method="POST" action="{{ route('sessao.save', $medicalRecord->prontuario_id ?? null) }}">
                @csrf
            
                <!-- Campo Principal -->
                <div class="mb-4">
                    <x-input-label for="sessao_tx_principal" :value="__('Principal')" />
                    <textarea id="sessao_tx_principal" name="sessao_tx_principal" rows="8" 
                              class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50">{{ old('sessao_tx_principal') }}</textarea>
                </div>
            
                <!-- Campo Procedimento -->
                <div class="mb-4">
                    <x-input-label for="sessao_tx_procedure" :value="__('Procedimento')" />
                    <textarea id="sessao_tx_procedure" name="sessao_tx_procedure" rows="8" 
                              class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50">{{ old('sessao_tx_procedure') }}</textarea>
                </div>
            
                <!-- Campo Encaminhamento -->
                <div class="mb-4">
                    <x-input-label for="sessao_tx_forwarding" :value="__('Encaminhamento')" />
                    <textarea id="sessao_tx_forwarding" name="sessao_tx_forwarding" rows="8" 
                              class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50">{{ old('sessao_tx_forwarding') }}</textarea>
                </div>
            
                <!-- Campo Observações -->
                <div class="mb-4">
                    <x-input-label for="sessao_tx_observation" :value="__('Observações')" />
                    <textarea id="sessao_tx_observation" name="sessao_tx_observation" rows="8" 
                              class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50">{{ old('sessao_tx_observation') }}</textarea>
                </div>
            
                <!-- Botão de Salvar -->
                <div class="mt-8 flex justify-end">
                    <x-primary-button>
                        {{ __('Salvar Sessão') }}
                    </x-primary-button>
                </div>
            </form>            
        </div>
    </div>
</div>

<div class="py-4">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg px-4 py-2">
            <!-- Dropdown para Exibir dados para subir arquivo -->
            <x-dropdown-list>
                <x-slot name="trigger">
                    <button class="inline-flex items-center px-3 py-2 border border-transparent leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                        <div class="w-full text-left text-gray-800 font-medium">
                            {{ __('Deseja subir um arquivo?') }}
                        </div>
                        <div class="ms-1">
                            <svg :class="{ 'rotate-180': open }" class="fill-current h-4 w-4 transition-transform duration-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <div class="px-6">
                        <form action="{{ route('records.upload', ['idPatient' => $patient->cliente_id, 'idRecord' => $medicalRecord->prontuario_id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <!-- Input para Data -->
                            <div class="mb-4">
                                <label for="session_date" class="block text-sm font-medium text-gray-700">{{ __('Data') }}</label>
                                <input 
                                    type="date" 
                                    name="session_date" 
                                    id="session_date" 
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" 
                                    required
                                />
                            </div>
                        
                            <!-- Input para Arquivo -->
                            <div class="mb-4">
                                <label for="file" class="block text-sm font-medium text-gray-700">{{ __('Selecione um Arquivo') }}</label>
                                <input 
                                    type="file" 
                                    name="file" 
                                    id="file"
                                    accept="application/pdf"
                                    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" 
                                    required 
                                />
                            </div>
                        
                            <!-- Botão de Submeter -->
                            <div class="mt-8 flex justify-end">
                                <x-primary-button>
                                    {{ __('Subir Arquivo') }}
                                </x-primary-button>
                            </div>
                        </form>
                        
                    </div>
                </x-slot>
            </x-dropdown-list>
        </div>
    </div>
</div>

<script>
    function displaySelectedFiles(input) {
        const fileList = input.files;
        const fileDisplay = document.getElementById('selectedFilesList');
        fileDisplay.innerHTML = '';

        if (fileList.length > 0) {
            Array.from(fileList).forEach(file => {
                const listItem = document.createElement('p');
                listItem.textContent = file.name;
                fileDisplay.appendChild(listItem);
            });
        }
    }
</script>
