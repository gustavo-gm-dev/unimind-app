<?php

namespace App\Http\Controllers;
use App\Models\Prontuario;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\SessionController;


class gerarPdfController extends Controller {
    public function gerarPdf($id)
{
    // Consulta para buscar a sessão diretamente no banco de dados
    $sessao = DB::table('sessoes')
        ->join('prontuarios', 'sessoes.sessao_prontuario_id', '=', 'prontuarios.prontuario_id')
        ->leftJoin('clientes', 'prontuarios.prontuario_cliente_id', '=', 'clientes.cliente_id')
        ->leftJoin('arquivos', 'prontuarios.prontuario_id', '=', 'arquivos.arquivo_prontuario_id')
        ->select(
            'sessoes.sessao_id',
            //"CONCAT(YEAR(NOW()), CASE WHEN MONTH(NOW()) BETWEEN 1 AND 6 THEN '/1' ELSE '/2' END) AS semestre",
            'sessoes.sessao_dt_inicio',
            'sessoes.sessao_st_confirmado',
            'prontuarios.prontuario_id',
            'clientes.cliente_nome',
            'arquivos.arquivo_id as ultimo_arquivo_id'
            ,'prontuarios.created_at'
            ,'clientes.cliente_dt_nascimento'
        )
        ->where('prontuarios.prontuario_id', $id)
        ->first();

    if (!$sessao) {
        abort(404, 'Sessão não encontrada');
    }

    // // Outras variáveis adicionais para a view
    // $extraData = [
    //     'informacao_adicional' => 'Este é um exemplo de informação extra',
    //     'data_geracao' => now()->format('d/m/Y H:i'),
    // ];


    //mont variavel
    $anoAtual = date("Y");
    $mesAtual = date("n"); // Retorna o número do mês (1 a 12)
    $semestreAtual = ($mesAtual <= 6) ? "/1" : "/2";
    $anolet = $anoAtual.$semestreAtual;

    // Dados enviados à view
    $data = [
        'id' => $id,
        'anolet'=> $anolet,
        'data_Cria' => $sessao -> created_at,
        'name' => $sessao -> cliente_nome,
        'data_Nasci' => $sessao -> cliente_dt_nascimento
    ];

    // Gera o PDF usando a view
    $pdf = Pdf::loadView('fichaCliente', $data);

    // Retorna o PDF no navegador
    return $pdf->stream('sessao-detalhes.pdf');
}

}
