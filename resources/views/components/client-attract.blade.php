
      <h1 class="text-2xl font-bold text-gray-700 mb-8 text-center">Atribuir Paciente a Médico</h1>
      
      <form class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <!-- Selecionar Paciente -->
            <div>
              <label for="patient" class="block text-gray-600 font-semibold mb-2">Paciente</label>
              <select id="patient" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="" disabled selected>Selecione um paciente</option>
                <!-- Exemplos de opções de pacientes -->
                <option value="1">Paciente 1</option>
                <option value="2">Paciente 2</option>
                <option value="3">Paciente 3</option>
              </select>
              <div class="pt-1">
                  <span class="text-sm text-red-400">Último aluno atribuído: Gustavo</span>
              </div>
            </div>
    
            <!-- Selecionar Aluno -->
            <div>
              <label for="doctor" class="block text-gray-600 font-semibold mb-2">Alunos</label>
              <select id="doctor" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="" disabled selected>Selecione um Aluno</option>
                <!-- Exemplos de opções de aluno -->
                <option value="1">Valmir</option>
                <option value="2">Gustavo</option>
                <option value="3">Lucas</option>
              </select>
            </div>

            <!-- Selecionar Periodo -->
            <div>
                <label for="doctor" class="block text-gray-600 font-semibold mb-2">Período</label>
                <select id="doctor" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="" disabled selected>Selecione um Período</option>
                    <!-- Exemplos de opções de horario -->
                    <option value="1">Manha</option>
                    <option value="2">Tarde</option>
                    <option value="3">Noite</option>
                </select>
            </div>

            <!-- Selecionar Horario -->
            <div>
                <label for="doctor" class="block text-gray-600 font-semibold mb-2">Horários</label>
                <select id="doctor" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="" disabled selected>Selecione um Horários</option>
                    <!-- Exemplos de opções de horario -->
                    <option value="1">10:00 - 11:00</option>
                    <option value="2">11:00 - 12:00</option>
                    <option value="3">12:00 - 13:00</option>
                </select>
            </div>
        </div>
        <!-- Botão de Atribuir -->
        <div class="text-center">
          <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 rounded-lg transition duration-300">
            Atribuir Paciente ao Aluno
          </button>
        </div>
      </form>
