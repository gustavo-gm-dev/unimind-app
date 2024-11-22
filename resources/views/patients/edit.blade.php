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
                        <x-input-label for="name" :value="__('Nome')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $patient->cliente_nome)" required />
                    </div>

                    <!-- Email -->
                    <div class="mt-4">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $patient->cliente_email)" required />
                    </div>

                    <!-- Telefone -->
                    <div class="mt-4">
                        <x-input-label for="phone" :value="__('Telefone')" />
                        <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone', $patient->cliente_telefone)" required />
                    </div>

                    <!-- Gênero -->
                    <div class="mt-4">
                        <x-input-label for="gender" :value="__('Gênero')" />
                        <select id="gender" name="gender" class="block mt-1 w-full">
                            <option value="M" @if($patient->cliente_genero == 'M') selected @endif>Masculino</option>
                            <option value="F" @if($patient->cliente_genero == 'F') selected @endif>Feminino</option>
                            <option value="Outro" @if($patient->cliente_genero == 'Outro') selected @endif>Outro</option>
                        </select>
                    </div>

                    <!-- CPF -->
                    <div class="mt-4">
                        <x-input-label for="cpf" :value="__('CPF')" />
                        <x-text-input id="cpf" class="block mt-1 w-full" type="text" name="cpf" :value="old('cpf', $patient->cliente_cpf)" required />
                    </div>

                    <!-- RG -->
                    <div class="mt-4">
                        <x-input-label for="rg" :value="__('RG')" />
                        <x-text-input id="rg" class="block mt-1 w-full" type="text" name="rg" :value="old('rg', $patient->cliente_rg)" required />
                    </div>

                    <!-- Data de Nascimento -->
                    <div class="mt-4">
                        <x-input-label for="date_birth" :value="__('Data de Nascimento')" />
                        <x-text-input id="date_birth" class="block mt-1 w-full" type="date" name="date_birth" :value="old('date_birth', $patient->cliente_dt_nascimento)" required />
                    </div>

                    <!-- Escolaridade -->
                    <div class="mt-4">
                        <x-input-label for="education" :value="__('Escolaridade')" />
                        <select id="education" name="education" class="block mt-1 w-full">
                            <option value="fundamental" @if($patient->education == 'fundamental') selected @endif>Fundamental</option>
                            <option value="superior" @if($patient->education == 'superior') selected @endif>Superior</option>
                            <option value="outro" @if($patient->education == 'outro') selected @endif>Outro</option>
                        </select>
                    </div>

                    <!-- Período de Atendimento -->
                    <div class="mt-4">
                        <x-input-label for="period" :value="__('Período')" />
                        <select id="period" name="period" class="block mt-1 w-full">
                            <option value="manha" @if($patient->period == 'manha') selected @endif>Manhã</option>
                            <option value="tarde" @if($patient->period == 'tarde') selected @endif>Tarde</option>
                            <option value="noite" @if($patient->period == 'noite') selected @endif>Noite</option>
                        </select>
                    </div>

                    <!-- Tipo de Atendimento -->
                    <div class="mt-4">
                        <x-input-label for="service" :value="__('Tipo de Atendimento')" />
                        <select id="service" name="service" class="block mt-1 w-full">
                            <option value="presencial" @if($patient->service == 'presencial') selected @endif>Presencial</option>
                            <option value="remoto" @if($patient->service == 'remoto') selected @endif>Remoto</option>
                        </select>
                    </div>

                    <!-- Termos -->
                    <div class="mt-4">
                        <label for="terms" class="flex items-center">
                            <input id="terms" name="terms" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" required>
                            <span class="ml-2 text-sm text-gray-600">
                                Paciente concorda com os termos descritos abaixo.<br>
                                O paciente tem conciencia que não há previsão para início dos atendimentos, 
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
