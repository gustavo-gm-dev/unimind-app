<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Prontuários') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- Seção: Selecionar Paciente -->
                    <h3 class="text-lg font-medium mb-4">{{ __('Pacientes com Sessões Ativas') }}</h3>
                    <ul class="mb-6">
                        @foreach ($patients as $patient)
                            <li>
                                <a href="{{ route('medical_records.show', $patient->id) }}"
                                   class="text-blue-600 dark:text-blue-400 hover:underline">
                                    {{ $patient->name }}
                                </a>
                                <span class="text-sm text-gray-500">
                                    ({{ $patient->sessions_active_count }} sessões ativas)
                                </span>
                            </li>
                        @endforeach
                    </ul>

                    <!-- Seção: Visualizar Prontuário -->
                    @isset($medicalRecord)
                        <h3 class="text-lg font-medium mb-4">{{ __('Prontuário de') }} {{ $medicalRecord->patient->name }}</h3>

                        <!-- Subir Arquivos para o Prontuário -->
                        <form action="{{ route('medical_records.upload', $medicalRecord->id) }}" method="POST" enctype="multipart/form-data" class="mb-6">
                            @csrf
                            <label class="block mb-2">{{ __('Subir Arquivo') }}</label>
                            <input type="file" name="record_file" required
                                   class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-2">
                                {{ __('Enviar') }}
                            </button>
                        </form>

                        <!-- Preencher Formulário de Prontuário -->
                        <form action="{{ route('medical_records.update', $medicalRecord->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <label for="notes" class="block mb-2">{{ __('Notas do Prontuário') }}</label>
                            <textarea name="notes" id="notes" rows="4" required
                                      class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 sm:text-sm mb-4">{{ $medicalRecord->notes }}</textarea>
                            <button type="submit"
                                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Salvar Notas') }}
                            </button>
                        </form>

                        <!-- Lista de Sessões Vinculadas -->
                        <h4 class="text-md font-semibold mt-6 mb-3">{{ __('Sessões Vinculadas') }}</h4>
                        <ul>
                            @foreach ($medicalRecord->sessions as $session)
                                <li class="mb-2">
                                    <a href="{{ route('sessions.show', $session->id) }}"
                                       class="text-blue-600 dark:text-blue-400 hover:underline">
                                        {{ __('Sessão de') }} {{ $session->date->format('d/m/Y') }}
                                    </a>
                                    <span class="text-sm text-gray-500">{{ __('Status:') }} {{ $session->status }}</span>
                                </li>
                            @endforeach
                        </ul>

                        <!-- Iniciar Nova Sessão -->
                        <form action="{{ route('sessions.store', $medicalRecord->id) }}" method="POST" class="mt-6">
                            @csrf
                            <label for="session_date" class="block mb-2">{{ __('Data da Nova Sessão') }}</label>
                            <input type="date" name="session_date" id="session_date" required
                                   class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 sm:text-sm mb-4">
                            <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Iniciar Nova Sessão') }}
                            </button>
                        </form>
                    @endisset

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
