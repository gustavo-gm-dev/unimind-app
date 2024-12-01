@props(['uf'])

<select id="endereco_uf" name="endereco_uf" class="block mt-1 w-full">
    <option value="">Selecione um estado</option>
    <option value="AC" {{ old('endereco_uf', $uf ?? '') == 'AC' ? 'selected' : '' }}>Acre</option>
    <option value="AL" {{ old('endereco_uf', $uf ?? '') == 'AL' ? 'selected' : '' }}>Alagoas</option>
    <option value="AP" {{ old('endereco_uf', $uf ?? '') == 'AP' ? 'selected' : '' }}>Amapá</option>
    <option value="AM" {{ old('endereco_uf', $uf ?? '') == 'AM' ? 'selected' : '' }}>Amazonas</option>
    <option value="BA" {{ old('endereco_uf', $uf ?? '') == 'BA' ? 'selected' : '' }}>Bahia</option>
    <option value="CE" {{ old('endereco_uf', $uf ?? '') == 'CE' ? 'selected' : '' }}>Ceará</option>
    <option value="DF" {{ old('endereco_uf', $uf ?? '') == 'DF' ? 'selected' : '' }}>Distrito Federal</option>
    <option value="ES" {{ old('endereco_uf', $uf ?? '') == 'ES' ? 'selected' : '' }}>Espírito Santo</option>
    <option value="GO" {{ old('endereco_uf', $uf ?? '') == 'GO' ? 'selected' : '' }}>Goiás</option>
    <option value="MA" {{ old('endereco_uf', $uf ?? '') == 'MA' ? 'selected' : '' }}>Maranhão</option>
    <option value="MT" {{ old('endereco_uf', $uf ?? '') == 'MT' ? 'selected' : '' }}>Mato Grosso</option>
    <option value="MS" {{ old('endereco_uf', $uf ?? '') == 'MS' ? 'selected' : '' }}>Mato Grosso do Sul</option>
    <option value="MG" {{ old('endereco_uf', $uf ?? '') == 'MG' ? 'selected' : '' }}>Minas Gerais</option>
    <option value="PA" {{ old('endereco_uf', $uf ?? '') == 'PA' ? 'selected' : '' }}>Pará</option>
    <option value="PB" {{ old('endereco_uf', $uf ?? '') == 'PB' ? 'selected' : '' }}>Paraíba</option>
    <option value="PR" {{ old('endereco_uf', $uf ?? '') == 'PR' ? 'selected' : '' }}>Paraná</option>
    <option value="PE" {{ old('endereco_uf', $uf ?? '') == 'PE' ? 'selected' : '' }}>Pernambuco</option>
    <option value="PI" {{ old('endereco_uf', $uf ?? '') == 'PI' ? 'selected' : '' }}>Piauí</option>
    <option value="RJ" {{ old('endereco_uf', $uf ?? '') == 'RJ' ? 'selected' : '' }}>Rio de Janeiro</option>
    <option value="RN" {{ old('endereco_uf', $uf ?? '') == 'RN' ? 'selected' : '' }}>Rio Grande do Norte</option>
    <option value="RS" {{ old('endereco_uf', $uf ?? '') == 'RS' ? 'selected' : '' }}>Rio Grande do Sul</option>
    <option value="RO" {{ old('endereco_uf', $uf ?? '') == 'RO' ? 'selected' : '' }}>Rondônia</option>
    <option value="RR" {{ old('endereco_uf', $uf ?? '') == 'RR' ? 'selected' : '' }}>Roraima</option>
    <option value="SC" {{ old('endereco_uf', $uf ?? '') == 'SC' ? 'selected' : '' }}>Santa Catarina</option>
    <option value="SP" {{ old('endereco_uf', $uf ?? '') == 'SP' ? 'selected' : '' }}>São Paulo</option>
    <option value="SE" {{ old('endereco_uf', $uf ?? '') == 'SE' ? 'selected' : '' }}>Sergipe</option>
    <option value="TO" {{ old('endereco_uf', $uf ?? '') == 'TO' ? 'selected' : '' }}>Tocantins</option>
</select>

