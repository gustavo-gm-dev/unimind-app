<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

            <!-- Formulário de busca -->
            <form method="POST" action="{{ route('setting.find') }}">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Busca de cliente -->
                    <div>
                        <label for="cliente_busca" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Buscar Cliente</label>
                        <input type="text" name="cliente_busca" id="cliente_busca" class="mt-1 block w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Nome ou CPF do cliente">
                    </div>

                    <!-- Botão de busca -->
                    <div class="flex items-end">
                        <x-primary-button>
                            Buscar
                        </x-primary-button>
                    </div>
                </div>
            </form>

            <!-- Resultados da busca -->
            <div class="mt-6">
                <h3 class="text-lg font-medium text-gray-800 dark:text-gray-200">Resultados</h3>
                <form method="POST" action="{{ route('setting.store') }}">
                    @csrf
                    <div class="overflow-x-auto mt-4">
                        <table class="min-w-full border-collapse border border-gray-300 dark:border-gray-700">
                            <thead>
                                <tr>
                                    <th class="border border-gray-300 dark:border-gray-700 px-4 py-2">Cliente</th>
                                    <th class="border border-gray-300 dark:border-gray-700 px-4 py-2">Aluno</th>
                                    <th class="border border-gray-300 dark:border-gray-700 px-4 py-2">Status</th>
                                    <th class="border border-gray-300 dark:border-gray-700 px-4 py-2">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($patients as $patient)
                                    <tr>
                                        <td class="border border-gray-300 dark:border-gray-700 px-4 py-2">
                                            {{ $patient->cliente_nome }} ({{ $patient->cliente_cpf }})
                                        </td>
                            
                                        <td class="border border-gray-300 dark:border-gray-700 px-4 py-2">
                                            <label for="aluno_{{ $patient->cliente_id }}" class="sr-only">Aluno</label>
                                            <select name="aluno[{{ $patient->cliente_id }}]" id="aluno_{{ $patient->cliente_id }}" class="select-aluno w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md">
                                                <option value="" selected>Selecione um aluno</option>
                                                @foreach ($users->filter(fn($user) => $user->isAluno()) as $student)
                                                <option value="{{ $student->id }}" 
                                                    {{ optional($patient->vinculo)->vinculo_aluno_id == $student->id ? 'selected' : '' }}>
                                                    {{ $student->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </td>

                                        <td class="border border-gray-300 dark:border-gray-700 px-4 py-2">
                                            {{ $patient->active ? 'Ativo' : 'Inativo' }}
                                        </td>
                                        
                                        <td class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-center">
                                            <form method="POST" action="{{ route('patient.inactivate') }}">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" name="patient_id" value="{{ $patient->cliente_id }}" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                                    Inativar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>                            
                        </table>
                    </div>

                    <div class="mt-4">
                        <x-primary-button>
                            Salvar Vínculos
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

            <!-- Formulário de busca -->
            <form method="POST" action="{{ route('setting.find') }}">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Busca de Aluno -->
                    <div>
                        <label for="cliente_busca" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Buscar Usuário</label>
                        <input type="text" name="cliente_busca" id="cliente_busca" class="mt-1 block w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Nome ou CPF do usuário">
                    </div>

                    <!-- Botão de busca -->
                    <div class="flex items-end">
                        <x-primary-button>
                            Buscar
                        </x-primary-button>
                    </div>
                </div>
            </form>

            <!-- Formulário para Inativar Usuários -->
            <div class="mt-6">
                <h3 class="text-lg font-medium text-gray-800 dark:text-gray-200">Inativar Usuários</h3>
                <form method="POST" action="{{ route('user.inactivate') }}">
                    @csrf
                    @method('PATCH')
                    <div class="overflow-x-auto mt-4">
                        <table class="min-w-full border-collapse border border-gray-300 dark:border-gray-700">
                            <thead>
                                <tr>
                                    <th class="border border-gray-300 dark:border-gray-700 px-4 py-2">Usuário</th>
                                    <th class="border border-gray-300 dark:border-gray-700 px-4 py-2">E-mail</th>
                                    <th class="border border-gray-300 dark:border-gray-700 px-4 py-2">Status</th>
                                    <th class="border border-gray-300 dark:border-gray-700 px-4 py-2">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="border border-gray-300 dark:border-gray-700 px-4 py-2">{{ $user->name }}</td>
                                        <td class="border border-gray-300 dark:border-gray-700 px-4 py-2">{{ $user->email }}</td>
                                        <td class="border border-gray-300 dark:border-gray-700 px-4 py-2">
                                            {{ $user->active ? 'Ativo' : 'Inativo' }}
                                        </td>
                                        <td class="border border-gray-300 dark:border-gray-700 px-4 py-2">
                                            <button type="submit" name="user_id" value="{{ $user->id }}" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                                {{ $user->active ? 'Inativar' : 'Reativar' }}
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>