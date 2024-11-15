<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="my-3 flex items-center justify-center">
            <span class="text-lg font-semibold text-gray-800">Cadastro de Paciente</span>
        </div>
        <!-- Etapa 1 -->
        <div class="step" id="step-1">
            <div class="mt-4">
                <span class="text-md font-medium text-gray-600">Dados do Cliente</span>
            </div>
            <!-- Name -->
            <div class="mt-4">
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>

            <!-- CPF -->
            <div class="mt-4">
                <x-input-label for="cpf" :value="__('CPF')" />
                <x-text-input id="cpf" class="block mt-1 w-full" type="text" name="cpf" :value="old('cpf')" required autocomplete="cpf" />
            </div>

            <!-- RG -->
            <div class="mt-4">
                <x-input-label for="rg" :value="__('RG')" />
                <x-text-input id="rg" class="block mt-1 w-full" type="text" name="rg" :value="old('rg')" required autocomplete="rg" />
            </div>

            <!-- Telefone -->
            <div class="mt-4">
                <x-input-label for="telefone" :value="__('Telefone')" />
                <x-text-input id="telefone" class="block mt-1 w-full" type="text" name="telefone" :value="old('telefone')" required autocomplete="telefone" />
            </div>

            <!-- Data de Nascimento -->
            <div class="mt-4">
                <x-input-label for="data_nascimento" :value="__('Data de Nascimento')" />
                <x-text-input id="data_nascimento" class="block mt-1 w-full" type="date" name="data_nascimento" :value="old('data_nascimento')" required />
            </div>

            <!-- Escolaridade -->
            <div class="mt-4">
                <x-input-label for="escolaridade" :value="__('Escolaridade')" />
                <select id="escolaridade" name="escolaridade" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50">
                    <option value="" disabled selected>Selecione escolaridade</option>
                    <option value="fundamental">Fundamental</option>
                    <option value="medio">Médio</option>
                    <option value="superior">Superior</option>
                    <option value="pos_graduacao">Pós-Graduação</option>
                </select>
            </div>

            <!-- Gênero -->
            <div class="mt-4">
                <x-input-label for="genero" :value="__('Gênero')" />
                <select id="genero" name="genero" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50">
                    <option value="" disabled selected>Selecione gênero</option>
                    <option value="masculino">Masculino</option>
                    <option value="feminino">Feminino</option>
                    <option value="outro">Outro</option>
                </select>
            </div>
        </div>

        <!-- Etapa 2 -->
        <div class="step" id="step-2">
            <div class="mt-4">
                <span class="text-md font-medium text-gray-600">Preferência de Atendimento</span>
            </div>
            <!-- Periodo -->
            <div class="mt-4">
                <x-input-label for="periodo" :value="__('Período')" />
                <select name="periodo" id="periodo" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50">
                    <option value="" disabled selected>Selecione Período de Preferência</option>
                    <option value="manha">Manhã</option>
                    <option value="tarde">Tarde</option>
                    <option value="noite">Noite</option>
                </select>
            </div>

            <!-- Horario -->
            <div class="mt-4">
                <x-input-label for="horario" :value="__('Horário')" />
                <x-text-input id="horario" class="block mt-1 w-full" type="time" name="horario" :value="old('horario')" required />
            </div>

            <!-- Tipo Atendimento -->
            <div class="mt-4">
                <x-input-label for="atendimento" :value="__('Tipo Atendimento')" />
                <select name="atendimento" id="atendimento" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50">
                    <option value="" disabled selected>Selecione Tipo Atendimento</option>
                    <option value="presencial">Presencial</option>
                    <option value="remoto">Remoto</option>
                </select>
            </div>
        </div>

        <!-- Etapa 3 -->    
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

        <!-- Botões -->
        <div class="flex items-center justify-end mt-4">
            <x-primary-button type="button" id="previous-button" class="ms-4 hidden">
                {{ __('Anterior') }}
            </x-primary-button>

            <x-primary-button type="button" id="next-button" class="ms-4">
                {{ __('Próximo') }}
            </x-primary-button>

            <x-primary-button type="submit" id="submit-button" class="ms-4 hidden">
                {{ __('Cadastrar') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
