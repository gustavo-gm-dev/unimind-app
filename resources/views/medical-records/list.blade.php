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
                            {{ __('Status do Prontuário') }}
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                            {{ __('Ações') }}
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($patients as $patient)
                        <tr>
                            <!-- Nome do Cliente -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                {{ $patient->name }}
                            </td>

                            <!-- Sessão Marcada -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                @if ($patient->session)
                                    <div>
                                        <p><strong>Data:</strong> {{ $patient->session->date }}</p>
                                        <p><strong>Local:</strong> {{ $patient->session->location }}</p>
                                        <p><strong>Hora:</strong> {{ $patient->session->time }}</p>
                                    </div>
                                @else
                                    <p>{{ __('Nenhuma sessão marcada') }}</p>
                                @endif
                            </td>

                            <!-- Status do Prontuário -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                @if ($patient->medical_record_status === 'concluido')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                        {{ __('Concluído') }}
                                    </span>
                                @elseif ($patient->medical_record_status === 'iniciado')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800">
                                        {{ __('Iniciado') }}
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800">
                                        {{ __('Não Existe') }}
                                    </span>
                                @endif
                            </td>

                            <!-- Botão de Ação -->
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                <x-link-button>
                                    <a href="{{ route('medical-records.edit', $patient->id) }}">
                                        {{ __('Ver Prontuário') }}
                                    </a>
                                </x-link-button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>