<div class="pt-6">
    <div class="w-full md:w-3/5 m-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <form method="POST" action="{{ route('patients.update', $patient->cliente_id) }}">
                    @csrf
                    @method('PUT')

                    <span class="text-lg font-medium text-gray-800 dark:text-gray-200">{{ __('Dados Cadastrais') }}</span>

                    <!-- Nome -->
                    <div class="mt-4">
                        <x-input-label for="cliente_nome" :value="__('Nome')" />
                        <x-text-input id="cliente_nome" class="block mt-1 w-full" type="text" name="cliente_nome" :value="old('cliente_nome', $patient->cliente_nome)" required />
                    </div>

                    <!-- CPF -->
                    <div class="mt-4">
                        <x-input-label for="cliente_cpf" :value="__('CPF')" />
                        <x-text-input id="cliente_cpf" class="block mt-1 w-full" type="text" name="cliente_cpf" :value="old('cliente_cpf', $patient->cliente_cpf)" />
                    </div>

                    <!-- RG -->
                    <div class="mt-4">
                        <x-input-label for="cliente_rg" :value="__('RG')" />
                        <x-text-input id="cliente_rg" class="block mt-1 w-full" type="text" name="cliente_rg" :value="old('cliente_rg', $patient->cliente_rg)" />
                    </div>

                    <!-- Email -->
                    <div class="mt-4">
                        <x-input-label for="cliente_email" :value="__('Email')" />
                        <x-text-input id="cliente_email" class="block mt-1 w-full" type="email" name="cliente_email" :value="old('cliente_email', $patient->cliente_email)" required />
                    </div>

                    <!-- Telefone -->
                    <div class="mt-4">
                        <x-input-label for="cliente_telefone" :value="__('Telefone')" />
                        <x-text-input id="cliente_telefone" class="block mt-1 w-full" type="text" name="cliente_telefone" :value="old('cliente_telefone', $patient->cliente_telefone)" required />
                    </div>

                    <!-- Data de Nascimento -->
                    <div class="mt-4">
                        <x-input-label for="cliente_dt_nascimento" :value="__('Data de Nascimento')" />
                        <x-text-input id="cliente_dt_nascimento" class="block mt-1 w-full" type="date" name="cliente_dt_nascimento" :value="old('cliente_dt_nascimento', $patient->cliente_dt_nascimento)" />
                    </div>

                    <!-- Gênero -->
                    <div class="mt-4">
                        <x-input-label for="cliente_genero" :value="__('Gênero')" />
                        <select id="cliente_genero" name="cliente_genero" class="block mt-1 w-full">
                            <option value="M" @if($patient->cliente_genero == 'M') selected @endif>Masculino</option>
                            <option value="F" @if($patient->cliente_genero == 'F') selected @endif>Feminino</option>
                            <option value="O" @if($patient->cliente_genero == 'O') selected @endif>Outro</option>
                        </select>
                    </div>

                    <!-- Escolaridade -->
                    <div class="mt-4">
                        <x-input-label for="cliente_escolaridade" :value="__('Escolaridade')" />
                        <select id="cliente_escolaridade" name="cliente_escolaridade" class="block mt-1 w-full">
                            <option value="">Não Informado</option>
                            <option value="nenhuma" @if($patient->cliente_escolaridade == 'nenhuma') selected @endif>Sem Escolaridade</option>
                            <option value="fundamental" @if($patient->cliente_escolaridade == 'fundamental') selected @endif>Ensino Fundamental</option>
                            <option value="medio" @if($patient->cliente_escolaridade == 'medio') selected @endif>Ensino Médio</option>
                            <option value="tecnico" @if($patient->cliente_escolaridade == 'tecnico') selected @endif>Técnico</option>
                            <option value="superior" @if($patient->cliente_escolaridade == 'superior') selected @endif>Ensino Superior</option>
                            <option value="posgraduacao" @if($patient->cliente_escolaridade == 'posgraduacao') selected @endif>Pós-Graduação</option>
                            <option value="mestrado" @if($patient->cliente_escolaridade == 'mestrado') selected @endif>Mestrado</option>
                            <option value="doutorado" @if($patient->cliente_escolaridade == 'doutorado') selected @endif>Doutorado</option>
                            <option value="outro" @if($patient->cliente_escolaridade == 'outro') selected @endif>Outro</option>
                        </select>
                    </div>

                    <!-- Período de Atendimento -->
                    <div class="mt-4">
                        <x-input-label for="cliente_periodo_preferencia" :value="__('Período')" />
                        <select id="cliente_periodo_preferencia" name="cliente_periodo_preferencia" class="block mt-1 w-full">
                            <option value="manha" @if($patient->cliente_periodo_preferencia == 'manha') selected @endif>Manhã</option>
                            <option value="tarde" @if($patient->cliente_periodo_preferencia == 'tarde') selected @endif>Tarde</option>
                            <option value="noite" @if($patient->cliente_periodo_preferencia == 'noite') selected @endif>Noite</option>
                        </select>
                    </div>

                    <!-- Tipo de Atendimento -->
                    <div class="mt-4">
                        <x-input-label for="cliente_tipo_atendimento" :value="__('Tipo de Atendimento')" />
                        <select id="cliente_tipo_atendimento" name="cliente_tipo_atendimento" class="block mt-1 w-full">
                            <option value="PRESENCIAL" @if($patient->cliente_tipo_atendimento == 'PRESENCIAL') selected @endif>Presencial</option>
                            <option value="REMOTO" @if($patient->cliente_tipo_atendimento == 'REMOTO') selected @endif>Remoto</option>
                        </select>
                    </div>


                    <!-- Cadastro de Endereços -->
                    <div class="mt-4">
                        <span class="text-lg font-medium text-gray-800 dark:text-gray-200">{{ __('Endereço') }}</span>
                    </div>

                    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Logradouro -->
                        <div>
                            <x-input-label for="endereco_logradouro" :value="__('Logradouro')" />
                            <x-text-input id="endereco_logradouro" class="block mt-1 w-full" type="text" name="endereco_logradouro" :value="old('endereco_logradouro', $patient->endereco->endereco_logradouro)" />
                        </div>
                    
                        <!-- Número -->
                        <div>
                            <x-input-label for="endereco_numero" :value="__('Número')" />
                            <x-text-input id="endereco_numero" class="block mt-1 w-24" type="text" name="endereco_numero" :value="old('endereco_numero', $patient->endereco->endereco_numero)" />
                        </div>

                        <!-- Estado -->
                        <div>
                            <x-input-label for="endereco_uf" :value="__('Estado')" />
                            <x-list-country :uf="$patient->endereco->endereco_uf" />
                        </div>
                    
                        <!-- Cidade -->
                        <div>
                            <x-input-label for="endereco_cidade" :value="__('Cidade')" />
                            <x-text-input id="endereco_cidade" class="block mt-1 w-full" type="text" name="endereco_cidade" :value="old('endereco_cidade', $patient->endereco->endereco_cidade)" />
                        </div>

                        <!-- Bairro -->
                        <div>
                            <x-input-label for="endereco_bairro" :value="__('Bairro')" />
                            <x-text-input id="endereco_bairro" class="block mt-1 w-full" type="text" name="endereco_bairro" :value="old('endereco_bairro', $patient->endereco->endereco_bairro)" />
                        </div>

                        <!-- CEP -->
                        <div>
                            <x-input-label for="endereco_cep" :value="__('CEP')" />
                            <x-text-input id="endereco_cep" class="block mt-1 w-full" type="text" name="endereco_cep" :value="old('endereco_cep', $patient->endereco->endereco_cep)" />
                        </div>

                        <!-- Complemento -->
                        <div>
                            <x-input-label for="endereco_complemento" :value="__('Complemento')" />
                            <x-text-input id="endereco_complemento" class="block mt-1 w-full" type="text" name="endereco_complemento" :value="old('endereco_complemento', $patient->endereco->endereco_complemento)" />
                        </div>
                    </div>   

                    <!-- Botão de Salvar -->
                    <div class="mt-8 flex justify-end">
                        <x-primary-button>
                            {{ __('Salvar') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
