<div class="pt-6">
    <div class="w-full md:w-3/5 m-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">

                @error('cliente_duplicado')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror

                <form method="POST" action="{{ route('patients.store') }}">
                    @csrf
                    
                    <span class="text-lg font-medium text-gray-800 dark:text-gray-200">{{ __('Cadastro de Cliente') }}</span>

                    <!-- Nome -->
                    <div class="mt-4">
                        <x-input-label for="cliente_nome" :value="__('Nome')" />
                        <x-text-input id="cliente_nome" class="block mt-1 w-full" type="text" name="cliente_nome" :value="old('cliente_nome')" required />
                    </div>

                    <!-- CPF -->
                    <div class="mt-4">
                        <x-input-label for="cliente_cpf" :value="__('CPF')" />
                        <x-text-input id="cliente_cpf" class="block mt-1 w-full" type="text" name="cliente_cpf" :value="old('cliente_cpf')" />
                        @error('cpf_rg')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- RG -->
                    <div class="mt-4">
                        <x-input-label for="cliente_rg" :value="__('RG')" />
                        <x-text-input id="cliente_rg" class="block mt-1 w-full" type="text" name="cliente_rg" :value="old('cliente_rg')" />
                        @error('cpf_rg')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mt-4">
                        <x-input-label for="cliente_email" :value="__('Email')" />
                        <x-text-input id="cliente_email" class="block mt-1 w-full" type="email" name="cliente_email" :value="old('cliente_email')" required />
                    </div>

                    <!-- Telefone -->
                    <div class="mt-4">
                        <x-input-label for="cliente_telefone" :value="__('Telefone')" />
                        <x-text-input id="cliente_telefone" class="block mt-1 w-full" type="text" name="cliente_telefone" :value="old('cliente_telefone')" required/>
                    </div>

                    <!-- Data de Nascimento -->
                    <div class="mt-4">
                        <x-input-label for="cliente_dt_nascimento" :value="__('Data de Nascimento')" />
                        <x-text-input id="cliente_dt_nascimento" class="block mt-1 w-full" type="date" name="cliente_dt_nascimento" :value="old('cliente_dt_nascimento')" />
                    </div>

                    <!-- Gênero -->
                    <div class="mt-4">
                        <x-input-label for="cliente_genero" :value="__('Gênero')" />
                        <select id="cliente_genero" name="cliente_genero" class="block mt-1 w-full">
                            <option value="M">Masculino</option>
                            <option value="F">Feminino</option>
                            <option value="O">Outro</option>
                        </select>
                    </div>

                    <!-- Escolaridade -->
                    <div class="mt-4">
                        <x-input-label for="cliente_escolaridade" :value="__('Escolaridade')" />
                        <select id="cliente_escolaridade" name="cliente_escolaridade" class="block mt-1 w-full">
                            <option value="">Não Informado</option>
                            <option value="nenhuma">Sem Escolaridade</option>
                            <option value="fundamental">Ensino Fundamental</option>
                            <option value="medio">Ensino Médio</option>
                            <option value="tecnico">Técnico</option>
                            <option value="superior">Ensino Superior</option>
                            <option value="posgraduacao">Pós-Graduação</option>
                            <option value="mestrado">Mestrado</option>
                            <option value="doutorado">Doutorado</option>
                            <option value="outro">Outro</option>
                        </select>
                    </div>

                    <!-- Período de Atendimento -->
                    <div class="mt-4">
                        <x-input-label for="cliente_periodo_preferencia" :value="__('Período')" />
                        <select id="cliente_periodo_preferencia" name="cliente_periodo_preferencia" class="block mt-1 w-full">
                            <option value="manha">Manhã</option>
                            <option value="tarde">Tarde</option>
                            <option value="noite">Noite</option>
                        </select>
                    </div>

                    <!-- Tipo de Atendimento -->
                    <div class="mt-4">
                        <x-input-label for="cliente_tipo_atendimento" :value="__('Tipo de Atendimento')" />
                        <select id="cliente_tipo_atendimento" name="cliente_tipo_atendimento" class="block mt-1 w-full">
                            <option value="PRESENCIAL">Presencial</option>
                            <option value="REMOTO">Remoto</option>
                        </select>
                    </div>

                    <!-- Termos -->
                    <div class="mt-6">
                        <label for="cliente_st_confirma_dados" class="flex items-center">
                            <input 
                                id="cliente_st_confirma_dados" 
                                name="cliente_st_confirma_dados" 
                                type="checkbox" 
                                value="1" 
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" 
                                required>
                            <span class="ml-2 text-sm text-gray-600">
                                Paciente concorda com os termos descritos abaixo.<br>
                                O paciente tem consciência que não há previsão para início dos atendimentos, 
                                pois ser chamado para os atendimentos dependerá de uma série de variáveis, tais como:
                                número e estagiários/formandos que estarão atendendo; carga horária prevista para o estágio; 
                                vagas abertas no período; disponibilidade de horários dos pacientes x estagiários; número de salas disponíveis para este horário...
                            </span>
                        </label>
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
