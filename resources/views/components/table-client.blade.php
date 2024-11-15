<!-- Tabela para exibir pacientes, horários e alunos -->
<div class="overflow-x-auto">
<table class="min-w-full bg-white border border-gray-200 rounded-lg">
    <thead>
    <tr>
        <th class="py-3 px-6 bg-gray-200 text-gray-600 font-semibold uppercase text-sm border-b border-gray-200 text-left">Paciente</th>
        <th class="py-3 px-6 bg-gray-200 text-gray-600 font-semibold uppercase text-sm border-b border-gray-200 text-left">Data</th>
        <th class="py-3 px-6 bg-gray-200 text-gray-600 font-semibold uppercase text-sm border-b border-gray-200 text-left">Horário</th>
        <th class="py-3 px-6 bg-gray-200 text-gray-600 font-semibold uppercase text-sm border-b border-gray-200 text-left">Aluno</th>
        <th class="py-3 px-6 bg-gray-200 text-gray-600 font-semibold uppercase text-sm border-b border-gray-200">Ações</th>
    </tr>
    </thead>
    <tbody>
        <!-- Exemplo de dados para pacientes, horários e alunos -->
        <tr>
            <td class="py-4 px-6 border-b border-gray-200 text-gray-700">Paciente 1</td>
            <td class="py-4 px-6 border-b border-gray-200 text-gray-700">14/11/2024</td>
            <td class="py-4 px-6 border-b border-gray-200 text-gray-700">10:00 - 11:00</td>
            <td class="py-4 px-6 border-b border-gray-200 text-gray-700">Aluno A</td>
            <td class="py-4 px-6 border-b border-gray-200 text-gray-700 w-1/4">
                <div class="flex items-center justify-center space-x-4 w-auto">
                    <button class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Alterar</button>
                    <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Excluir</button>
                </div>
            </td>
        </tr>
        <tr class="bg-gray-50">
            <td class="py-4 px-6 border-b border-gray-200 text-gray-700">Paciente 2</td>
            <td class="py-4 px-6 border-b border-gray-200 text-gray-700">14/11/2024</td>
            <td class="py-4 px-6 border-b border-gray-200 text-gray-700">11:00 - 12:00</td>
            <td class="py-4 px-6 border-b border-gray-200 text-gray-700">Aluno B</td>
            <td class="py-4 px-6 border-b border-gray-200 text-gray-700 w-1/4">
                <div class="flex items-center justify-center space-x-4 w-auto">
                    <button class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Alterar</button>
                    <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Excluir</button>
                </div>
            </td>
        </tr>
        <tr>
            <td class="py-4 px-6 border-b border-gray-200 text-gray-700">Paciente 3</td>
            <td class="py-4 px-6 border-b border-gray-200 text-gray-700">14/11/2024</td>
            <td class="py-4 px-6 border-b border-gray-200 text-gray-700">14:00 - 15:00</td>
            <td class="py-4 px-6 border-b border-gray-200 text-gray-700">Aluno C</td>
            <td class="py-4 px-6 border-b border-gray-200 text-gray-700 w-1/4">
                <div class="flex items-center justify-center space-x-4 w-auto">
                    <button class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Alterar</button>
                    <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Excluir</button>
                </div>
            </td>
        </tr>
    </tbody>
</table>
</div>