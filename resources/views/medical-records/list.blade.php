<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">
            <!-- Formulário de busca -->
            <form method="GET" action="{{ route('prontuarios.buscar-clientes') }}">
                @csrf
                <div class="flex flex-wrap gap-4">
                    <div class="w-full sm:w-1/2 lg:w-1/4">
                        <label for="cliente_nome" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nome</label>
                        <input type="text" name="cliente_nome" id="cliente_nome" value="{{ request('cliente_nome') }}"
                               class="mt-1 block w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                               placeholder="Nome do cliente">
                    </div>
                    <div class="w-full sm:w-1/2 lg:w-1/4">
                        <label for="cliente_cpf" class="block text-sm font-medium text-gray-700 dark:text-gray-300">CPF</label>
                        <input type="text" name="cliente_cpf" id="cliente_cpf" value="{{ request('cliente_cpf') }}"
                               class="mt-1 block w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                               placeholder="CPF do cliente">
                    </div>
                    <div class="w-full sm:w-1/2 lg:w-1/4">
                        <label for="cliente_email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">E-mail</label>
                        <input type="email" name="cliente_email" id="cliente_email" value="{{ request('cliente_email') }}"
                               class="mt-1 block w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                               placeholder="E-mail do cliente">
                    </div>
                    <div class="w-full sm:w-1/2 lg:w-1/4">
                        <label for="cliente_telefone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Telefone</label>
                        <input type="text" name="cliente_telefone" id="cliente_telefone" value="{{ request('cliente_telefone') }}"
                               class="mt-1 block w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                               placeholder="Telefone do cliente">
                    </div>
                    <div class="w-full sm:w-1/2 lg:w-1/4">
                        <label for="cliente_st_confirma_dados" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                        <select name="cliente_st_confirma_dados" id="cliente_st_confirma_dados"
                                class="mt-1 block w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">{{ __('Selecione') }}</option>
                            <option value="confirmado" {{ request('cliente_st_confirma_dados') == 'confirmado' ? 'selected' : '' }}>{{ __('Confirmado') }}</option>
                            <option value="pendente" {{ request('cliente_st_confirma_dados') == 'pendente' ? 'selected' : '' }}>{{ __('Pendente') }}</option>
                            <option value="não confirmado" {{ request('cliente_st_confirma_dados') == 'não confirmado' ? 'selected' : '' }}>{{ __('Não Confirmado') }}</option>
                        </select>
                    </div>
                    <div class="w-full sm:w-1/2 lg:w-1/4 flex items-end">
                        <x-primary-button>{{ __('Buscar') }}</x-primary-button>
                    </div>
                </div>
            </form>

            <!-- Tabela de Resultados -->
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-800">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">{{ __('Nome') }}</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">{{ __('Sessão Marcada') }}</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">{{ __('Status do Prontuário') }}</th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">{{ __('Ações') }}</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($patients as $patient)
                        <tr>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-gray-100">{{ $patient->cliente_nome }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-300">
                                @if ($patient->prontuario && $patient->prontuario->sessoes->isNotEmpty())
                                    <div>
                                        <p><strong>Data:</strong> {{ $patient->prontuario->sessoes->last()->sessao_dt_inicio }}</p>
                                        <p><strong>Local:</strong> {{ $patient->prontuario->sessoes->last()->sessao_tipo_atendimento }}</p>
                                    </div>
                                @else
                                    <p>{{ __('Nenhuma sessão marcada') }}</p>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm">
                                @if ($patient->prontuario)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">{{ __('Concluído') }}</span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800">{{ __('Não Existe') }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center text-sm font-medium">
                                <x-link-button href="{{ route('prontuarios.buscar-clientes', $patient->id) }}" class="text-indigo-600 hover:text-indigo-900">{{ __('Editar') }}</x-link-button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">{{ __('Nenhum cliente encontrado') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
