<div class="pt-6">
    <div class="w-full md:w-3/5 m-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <form method="POST" action="{{ route('patients.update', $patient->id) }}">
                    @csrf
                    @method('PUT')

                    <span class="text-lg font-medium text-gray-800 dark:text-gray-200">{{ __('Dados Cadastrais') }}</span>

                    <div class="mt-4">
                        <x-input-label for="name" :value="__('Nome')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$patient->name" required />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="$patient->email" required />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="phone" :value="__('Telefone')" />
                        <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="$patient->phone" required />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="gender" :value="__('Gênero')" />
                        <select id="gender" name="gender" class="block mt-1 w-full">
                            <option value="masculino" @if($patient->gender == 'masculino') selected @endif>Masculino</option>
                            <option value="feminino" @if($patient->gender == 'feminino') selected @endif>Feminino</option>
                            <option value="outro" @if($patient->gender == 'outro') selected @endif>Outro</option>
                        </select>
                    </div>

                    <!--CPF-->
                    <div class="mt-4">
                        <x-input-label for="cpf" :value="__('CPF')" />
                        <x-text-input id="cpf" class="block mt-1 w-full" type="text" name="cpf" :value="old('cpf', $patient->cpf)" required />
                    </div>

                    <!--RG-->
                    <div class="mt-4">
                        <x-input-label for="rg" :value="__('RG')" />
                        <x-text-input id="rg" class="block mt-1 w-full" type="text" name="rg" :value="old('rg', $patient->rg)" required />
                    </div>

                    <!-- Data de Nascimento -->
                    <div class="mt-4">
                        <x-input-label for="date_birth" :value="__('Data de Nascimento')" />
                        <x-text-input 
                            id="date_birth" 
                            class="block mt-1 w-full" 
                            type="date" 
                            name="date_birth" 
                            :value="old('date_birth', $patient->date_birth)" 
                            required 
                        />
                    </div>

                    <!--Escolaridare-->
                    <div class="mt-4">
                        <x-input-label for="education" :value="__('Escolaridare')" />
                        <select id="education" name="education" class="block mt-1 w-full">
                            <option value="fundamental" @if($patient->education == 'fundamental') selected @endif>Superior</option>
                            <option value="superior" @if($patient->education == 'superior') selected @endif>Fundamental</option>
                            <option value="outro" @if($patient->education == 'outro') selected @endif>Outro</option>
                        </select>
                    </div>
                    
                    <div class="mt-4">
                        <span class="text-lg font-medium text-gray-800 dark:text-gray-200">{{ __('Preferencia de Atendimento') }}</span>
                    </div>

                    <div class="mt-4">
                        <x-input-label for="period" :value="__('Período')" />
                        <select id="period" name="period" class="block mt-1 w-full">
                            <option value="manha" @if($patient->period == 'manha') selected @endif>Manha</option>
                            <option value="tarde" @if($patient->period == 'tarde') selected @endif>Tarde</option>
                            <option value="noite" @if($patient->period == 'noite') selected @endif>Noite</option>
                        </select>
                    </div>

                    <div class="mt-4">
                        <x-input-label for="service" :value="__('Tipo de Atendimento')" />
                        <select id="service" name="service" class="block mt-1 w-full">
                            <option value="presencial" @if($patient->service == 'presencial') selected @endif>Presencial</option>
                            <option value="remoto" @if($patient->service == 'remoto') selected @endif>Remoto</option>
                        </select>
                    </div>

                    <div class="mt-4">
                        <span class="text-lg font-medium text-gray-800 dark:text-gray-200">{{ __('Termos') }}</span>
                    </div>

                    <div class="step" id="step-3">
                        <div class="mt-4">
                            <label for="terms" class="flex items-center">
                                <input id="terms" name="terms" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" required>
                                <span class="ml-2 text-sm text-gray-600">
                                    O paciente tem conciencia que não há previsão para início dos atendimentos, 
                                    pois ser chamado para os atendimentos dependerá de uma série de variáveis, tais como:
                                    número e estagiários/formandos que estarão atendendo; carga horária prevista para o estágio; 
                                    vagas abertas no período; disponibilidade de horários dos pacientes x estagiários; número de salas disponíveis para este horário...
                                </span>
                            </label>
                            @if ($errors->has('terms'))
                                <span class="text-red-500 text-sm mt-2">{{ $errors->first('terms') }}</span>
                            @endif
                        </div>
                    </div>

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