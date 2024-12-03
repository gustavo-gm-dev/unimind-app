<div class="max-w-7xl mx-auto mt-4 sm:px-6 lg:px-8">
    <form method="GET" action="{{ route('patients.filter') }}">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($filters as $key => $label)
                <div>
                    <label for="{{ $key }}" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                        {{ $label }}
                    </label>
                    <input type="text" name="{{ $key }}" id="{{ $key }}"
                        value="{{ request($key) }}"
                        class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 rounded-md">
                </div>
            @endforeach
        </div>
        <div class="mt-4 flex justify-end">
            <x-primary-button>
                Filtrar
            </x-primary-button>
        </div>
    </form>
</div>
<div class="max-w-7xl mx-auto mt-4 sm:px-6 lg:px-8">
    <x-link-button href="{{ route('patients.create') }}">
        {{__('Novo Cliente')}}
    </x-link-button>
</div>
<div class="max-w-7xl mx-auto mt-4 sm:px-6 lg:px-8">
    <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-800">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                        {{ __('Nome') }}
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                        {{ __('Gênero') }}
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                        {{ __('Telefone') }}
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                        {{ __('Status Cadastro') }}
                    </th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                        {{ __('Ações') }}
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                @foreach ($patients as $patient)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                            {{ $patient->cliente_nome }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                            {{ $patient->cliente_genero == 'M' ? 'Masculino' : ($patient->cliente_genero == 'F' ? 'Feminino' : 'Outro') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                            {{ $patient->cliente_telefone }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            @if ($patient->cliente_st_cadastro)
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                    {{ __('Sim') }}
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800">
                                    {{ __('Não') }}
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium space-x-2">
                            <!-- Botão para Editar Cadastro -->
                            <x-link-button href="{{ route('patients.edit', $patient->cliente_id) }}">
                                {{ __('Editar Cadastro') }}
                            </x-link-button>
                            <!-- Botão para Acessar Prontuário -->
                            <x-link-button href="{{ route('medical-records.edit', $patient->cliente_id) }}">
                                {{ __('Prontuário') }}
                            </x-link-button>
                                <!-- Botão de Agendamento -->
                        @if ($patient->prontuario && $patient->prontuario->sessoes->last() && $patient->prontuario->sessoes->last()->sessao_dt_inicio >= now())
                            <x-link-button href="{{ route('scheduling.edit', $patient->cliente_id) }}">
                                {{ __('Alterar Agendamento') }}
                            </x-link-button>
                        @else
                            <x-link-button href="{{ route('scheduling.create', $patient->cliente_id) }}">
                                {{ __('Criar Agendamento') }}
                            </x-link-button>
                        @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>            
        </table>
    </div>
</div>
