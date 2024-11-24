<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficha de Atendimento</title>
    <style>
        .divpai-cab{
            width: 100%;
            display: flex;
        }
        .meu-retangulo {
            width: 80%; /* Ocupa toda a largura disponível */
            border: 2px solid ; /* Borda do retângulo */
            box-sizing: border-box; /* Inclui a borda dentro das dimensões */
        }
        .semestre {
            width: 20%; /* Ocupa toda a largura disponível */
            border: 2px solid ; /* Borda do retângulo */
            box-sizing: border-box; /* Inclui a borda dentro das dimensões */
        }
        .text-center{
            text-align: center;
        }
        .fontletivo{
           font-size: 14px;
        }
        .fonttitulo{
           font-size: 18px;
        }
        .caixa{
            width: 100%;
            border: 2px solid;
            box-sizing: border-box;
        }
        .meiadiv{
            width: 50%;
        }
        .pai {
            display: flex; /* Ativa o flexbox */
            justify-content: center; /* Centraliza horizontalmente */
            align-items: center; /* Centraliza verticalmente */
            width: 100%; /* Largura da div pai */
            }
        .filha {
            text-align: center; /* Centraliza o texto dentro da div filha */
            display: inline-block; /* Garante que a altura corresponda ao conteúdo */
        }
        .grid {
            display: grid; /* Ativa o CSS Grid */
            grid-template-columns: 20% 80%; /* Define a largura das colunas */
        }

        .grid div {
            padding: 5px; /* Espaçamento interno */
            text-align: center; /* Centraliza o texto */
            border: 1px solid /* Apenas para visualização */
        }
    </style>
</head>
<body>
    <div class="divpai-cab">
        <div class="meu-retangulo">
            <h1 class="text-center fonttitulo"><b>SERVIÇO ESCOLA DE PSICOLOGIA - UNICURITIBA</b></h1>
        </div>
        <div class="semestre">
            <div>
                <h1 class="text-center fontletivo">Semestre letivo</h1>
            </div>
            <div>
                <h1 class="text-center fonttitulo">2024/2</h1>
            </div>
        </div>
    </div>
    <div class="caixa">
        <div>
            <p>Número do prontuario:{{}} ("Campo será preechido pela Clinica-escola")</p>
        </div>
        <div>
            <p>Data abertura/inicio dos atendimentos:{{}}</p>
        </div>
        <div>
            <p>Nome Completo:{{}}</p>
        </div>
        <div class="divpai-cab">
            <div class="meiadiv">
                <p>Data Nascimento:{{}}</p>
            </div>
            <div class="meiadiv">
                <p>Gênero:[{{}}]M [{{}}]F []Outro:{{}}</p>
            </div>
        </div>
        <div>
            <p>Endereço:{{}}</p>
        </div>
        <div class="divpai-cab">
            <div class="meiadiv">
                <p>Telefone(s):{{}}</p>
            </div>
            <div class="meiadiv">
                <p>E-mail:{{}}</p>
            </div>
        </div>
        <div>
            <p>Nome e telefone de contatos em caso de emergência:{{}}</p>
        </div>
        <div class="divpai-cab">
            <div class="meiadiv">
                <p>Escolaridade:{{}}</p>
            </div>
            <div class="meiadiv">
                <p>Ocupação:{{}}</p>
            </div>
        </div>
        <div>
            <p>Necessidades Epecial: [{{}}]Cognitiva [{{}}]Locomoção [{{}}]Visão [{{}}]Audição [{{}}]Outros:{{}}</p>
        </div>
        <div>
            <p>Estágiario(a):{{}}</p>
        </div>
        <div>
            <p>Orientador(a):{{}}</p>
        </div>
    </div>
    <div class="caixa pai">
        <div class="text-center fonttitulo filha">
            <p class="fonttitulo"><b>Prontuário</b></p>
        </div>
    </div>
    <div class="grid">
        <div style="background-color: #a5a299;">Data e Hora</div>
        <div style="background-color: #a5a299;"> Avaliação de demanda e definição dos objetivos do trabalho • Registro da evolução dos atendimentos e principais observações clinicas • Registro dos procedimentos adotados • Registro de encaminhamento ou encerramento </div>
        <div>05/05/2024</div>
        <div>Aloooo.........</div>
    </div>
</body>
</html>
