<select id="endereco_uf" name="endereco_uf" class="block mt-1 w-full" required>
    <option value="">Selecione um estado</option>
    <option value="AC" {{ old('endereco_uf') == 'AC' ? 'selected' : '' }}>Acre</option>
    <option value="AL" {{ old('endereco_uf') == 'AL' ? 'selected' : '' }}>Alagoas</option>
    <option value="AP" {{ old('endereco_uf') == 'AP' ? 'selected' : '' }}>Amapá</option>
    <option value="AM" {{ old('endereco_uf') == 'AM' ? 'selected' : '' }}>Amazonas</option>
    <option value="BA" {{ old('endereco_uf') == 'BA' ? 'selected' : '' }}>Bahia</option>
    <option value="CE" {{ old('endereco_uf') == 'CE' ? 'selected' : '' }}>Ceará</option>
    <option value="DF" {{ old('endereco_uf') == 'DF' ? 'selected' : '' }}>Distrito Federal</option>
    <option value="ES" {{ old('endereco_uf') == 'ES' ? 'selected' : '' }}>Espírito Santo</option>
    <option value="GO" {{ old('endereco_uf') == 'GO' ? 'selected' : '' }}>Goiás</option>
    <option value="MA" {{ old('endereco_uf') == 'MA' ? 'selected' : '' }}>Maranhão</option>
    <option value="MT" {{ old('endereco_uf') == 'MT' ? 'selected' : '' }}>Mato Grosso</option>
    <option value="MS" {{ old('endereco_uf') == 'MS' ? 'selected' : '' }}>Mato Grosso do Sul</option>
    <option value="MG" {{ old('endereco_uf') == 'MG' ? 'selected' : '' }}>Minas Gerais</option>
    <option value="PA" {{ old('endereco_uf') == 'PA' ? 'selected' : '' }}>Pará</option>
    <option value="PB" {{ old('endereco_uf') == 'PB' ? 'selected' : '' }}>Paraíba</option>
    <option value="PR" {{ old('endereco_uf') == 'PR' ? 'selected' : '' }}>Paraná</option>
    <option value="PE" {{ old('endereco_uf') == 'PE' ? 'selected' : '' }}>Pernambuco</option>
    <option value="PI" {{ old('endereco_uf') == 'PI' ? 'selected' : '' }}>Piauí</option>
    <option value="RJ" {{ old('endereco_uf') == 'RJ' ? 'selected' : '' }}>Rio de Janeiro</option>
    <option value="RN" {{ old('endereco_uf') == 'RN' ? 'selected' : '' }}>Rio Grande do Norte</option>
    <option value="RS" {{ old('endereco_uf') == 'RS' ? 'selected' : '' }}>Rio Grande do Sul</option>
    <option value="RO" {{ old('endereco_uf') == 'RO' ? 'selected' : '' }}>Rondônia</option>
    <option value="RR" {{ old('endereco_uf') == 'RR' ? 'selected' : '' }}>Roraima</option>
    <option value="SC" {{ old('endereco_uf') == 'SC' ? 'selected' : '' }}>Santa Catarina</option>
    <option value="SP" {{ old('endereco_uf') == 'SP' ? 'selected' : '' }}>São Paulo</option>
    <option value="SE" {{ old('endereco_uf') == 'SE' ? 'selected' : '' }}>Sergipe</option>
    <option value="TO" {{ old('endereco_uf') == 'TO' ? 'selected' : '' }}>Tocantins</option>
</select>
