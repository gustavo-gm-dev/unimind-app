<div class="py-4">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form method="GET" action="{{ route('index.medical-record') }}">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($filters as $key => $label)
                    <div>
                        <label for="{{ $key }}" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                            {{ $label }}
                        </label>
                        @if ($key === 'status_validacao')
                            <select name="{{ $key }}" id="{{ $key }}"
                                class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 rounded-md">
                                <option value="">{{ __('Selecione') }}</option>
                                <option value="1" {{ request($key) == '1' ? 'selected' : '' }}>{{ __('Validado') }}</option>
                                <option value="0" {{ request($key) == '0' ? 'selected' : '' }}>{{ __('Não Validado') }}</option>
                            </select>
                        @else
                            <input type="text" name="{{ $key }}" id="{{ $key }}"
                                value="{{ request($key) }}"
                                class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 rounded-md">
                        @endif
                    </div>
                @endforeach
            </div>
            <div class="mt-4 flex justify-end">
                <x-primary-button>
                    {{ __('Filtrar') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</div>

<div class="py-4">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-800">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                            {{ __('Nome') }}
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                            {{ __('Sessão Marcada') }}
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                            {{ __('Status Validação') }}
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
                                @if ($patient->prontuario && $patient->prontuario->sessoes->isNotEmpty())
                                    <div>
                                        <p><strong>Data:</strong> {{ $patient->prontuario->sessoes->last()->sessao_dt_inicio }}</p>
                                        <p><strong>Local:</strong> {{ $patient->prontuario->sessoes->last()->sessao_tipo_atendimento }}</p>
                                    </div>
                                @else
                                    <p>{{ __('Nenhuma sessão marcada') }}</p>
                                @endif
                            </td>
                
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                @if ($patient->prontuario)
                                    @if ($patient->prontuario->prontuario_st_validacao_prof)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                            {{ __('Validado') }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800">
                                            {{ __('Não Validado') }}
                                        </span>
                                    @endif
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800">
                                        {{ __('Não Existe') }}
                                    </span>
                                @endif
                            </td>
                
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                <x-link-button href="{{ route('medical-records.edit', $patient->cliente_id) }}">
                                    {{ __('Ver Prontuário') }}
                                </x-link-button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                
            </table>
        </div>
    </div>
</div>