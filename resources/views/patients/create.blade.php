<div class="pt-6">
    <div class="w-full md:w-3/5 m-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <form method="POST" action="{{ route('patients.store') }}">
                    @csrf
                    
                    <span class="text-lg font-medium text-gray-800 dark:text-gray-200">{{ __('Dados Cadastrais Inicial') }}</span>

                    <!-- Nome -->
                    <div class="mt-4">
                        <x-input-label for="cliente_nome" :value="__('Nome')" />
                        <x-text-input id="cliente_nome" class="block mt-1 w-full" type="text" name="cliente_nome" :value="old('cliente_nome')" required />
                    </div>

                    <!-- CPF -->
                    <div class="mt-4">
                        <x-input-label for="cliente_cpf" :value="__('CPF')" />
                        <x-text-input id="cliente_cpf" class="block mt-1 w-full" type="text" name="cliente_cpf" :value="old('cliente_cpf')" required />
                    </div>

                    <!-- Email -->
                    <div class="mt-4">
                        <x-input-label for="cliente_email" :value="__('Email')" />
                        <x-text-input id="cliente_email" class="block mt-1 w-full" type="email" name="cliente_email" :value="old('cliente_email')" required />
                    </div>

                    <!-- Telefone -->
                    <div class="mt-4">
                        <x-input-label for="cliente_telefone" :value="__('Telefone')" />
                        <x-text-input id="cliente_telefone" class="block mt-1 w-full" type="text" name="cliente_telefone" :value="old('cliente_telefone')" required />
                    </div>

                    <h3 class="text-lg font-medium text-gray-800 dark:text-gray-200 mb-4">{{ __('Cadastro Completo') }}</h3>

                    <!-- Termos -->
                    <div class="mt-4">
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
