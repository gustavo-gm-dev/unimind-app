<!-- Seção para Professores -->
{{-- @can('isProfessor') <!-- Verifica se o usuário é professor --> --}}
<div class="py-4">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h3 class="text-lg font-medium text-gray-800 dark:text-gray-200 mb-4">
                    {{ __('Funcionalidades para Professores') }}
                </h3>
                
                <!-- Formulário para Cadastrar Paciente -->
                <form action="{{ route('patients.store') }}" method="POST" class="mb-6">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            {{ __('Nome') }}
                        </label>
                        <input type="text" name="name" id="name" required
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-300 dark:focus:border-blue-500 focus:ring focus:ring-blue-200 dark:focus:ring-blue-500 sm:text-sm">
                    </div>

                    <div class="mb-4">
                        <label for="age" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            {{ __('Idade') }}
                        </label>
                        <input type="number" name="age" id="age" required
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-300 dark:focus:border-blue-500 focus:ring focus:ring-blue-200 dark:focus:ring-blue-500 sm:text-sm">
                    </div>

                    <div class="mb-4">
                        <label for="diagnosis" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            {{ __('Diagnóstico Inicial') }}
                        </label>
                        <textarea name="diagnosis" id="diagnosis" rows="3"
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-300 dark:focus:border-blue-500 focus:ring focus:ring-blue-200 dark:focus:ring-blue-500 sm:text-sm"></textarea>
                    </div>

                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        {{ __('Cadastrar Paciente') }}
                    </button>
                </form>

                <!-- Lista de Pacientes com Opções de Edição -->
                <h4 class="text-md font-semibold mb-3">{{ __('Pacientes Cadastrados') }}</h4>
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-800">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                {{ __('Nome') }}
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                {{ __('Idade') }}
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                {{ __('Diagnóstico') }}
                            </th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                {{ __('Ações') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($patients as $patient)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                    {{ $patient->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                    {{ $patient->age }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                    {{ $patient->diagnosis ?? __('Não informado') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('patients.edit', $patient->id) }}" class="text-yellow-600 dark:text-yellow-400 hover:underline">
                                        {{ __('Editar') }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
{{-- @endcan --}}

<!-- Seção para Alunos -->
{{-- @can('isStudent') <!-- Verifica se o usuário é aluno --> --}}
<div class="py-4">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h3 class="text-lg font-medium text-gray-800 dark:text-gray-200 mb-4">
                    {{ __('Funcionalidades para Alunos') }}
                </h3>

                <!-- Lista de Pacientes Vinculados -->
                <h4 class="text-md font-semibold mb-3">{{ __('Pacientes Vinculados') }}</h4>
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-800">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                {{ __('Nome') }}
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                {{ __('Histórico Clínico') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($studentsPatients as $patient)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                    {{ $patient->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                    {{ $patient->clinical_history ?? __('Não informado') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
{{-- @endcan --}}
