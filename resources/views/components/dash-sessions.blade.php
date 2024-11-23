
<div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">
    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
        <thead class="bg-gray-50 dark:bg-gray-800">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                    {{ __('Data') }}
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                    {{ __('Paciente') }}
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                    {{ __('Status') }}
                </th>
                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                    {{ __('Ações') }}
                </th>
            </tr>
        </thead>
        <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
            @forelse ($sessions as $session)
                <tr>
                    <!-- Data da Sessão -->
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                        {{ \Carbon\Carbon::parse($session->date)->format('d/m/Y') }}
                    </td>
        
                    <!-- Nome do Paciente -->
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                        {{ $session->patient->name ?? __('Não informado') }}
                    </td>
        
                    <!-- Status da Sessão -->
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium 
                            @if ($session->situacao === 'PENDENTE') bg-yellow-100 text-yellow-800 
                            @elseif ($session->situacao === 'INICIADA') bg-blue-100 text-blue-800 
                            @else bg-green-100 text-green-800 
                            @endif">
                            {{ $session->situacao }}
                        </span>
                    </td>
        
                    <!-- Ações -->
                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium space-x-2">
                        @if ($session->situacao === 'PENDENTE')
                            <!-- Botão para Criar Sessão -->
                            <x-link-button>
                                <a href="{{ route('sessions.create', $session->prontuario_id) }}">
                                    {{ __('Iniciar Sessão') }}
                                </a>
                            </x-link-button>
                        @elseif ($session->situacao === 'INICIADA')
                            <!-- Botão para Editar Sessão -->
                            <x-link-button>
                                <a href="{{ route('sessions.edit', $session->id) }}">
                                    {{ __('Editar Sessão') }}
                                </a>
                            </x-link-button>
                        @elseif ($session->situacao === 'CONCLUIDA' && $session->ultimoArquivo)
                            <!-- Botão para Baixar Arquivo -->
                            <x-link-button>
                                <a href="{{ route('records.view', ['idPatient' => $session->cliente_id,'idRecord' => $session->prontuario_id, 'fileId' => $session->ultimoArquivo->id]) }}">
                                    {{ __('Baixar Arquivo') }}
                                </a>
                            </x-link-button>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300 text-center">
                        {{ __('Nenhuma sessão encontrada.') }}
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
