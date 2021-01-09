<?php
include_once '../util/conexao.php';

$sql = "select a.*, p.pac_nome paciente, d.den_nome dentista, d.den_cor cor
        from agendamento a, paciente p, dentista d 
        where a.age_pac_id = p.pac_id and a.age_den_id = d.den_id";
$resultado = mysqli_query($conexao, $sql);
mysqli_close($conexao);

$eventos = [];

while ($dados = mysqli_fetch_array($resultado)) :
    $id = $dados['age_id'];
    $paciente = $dados['paciente'];
    $dentista = $dados['dentista'];
    $cor = $dados['cor'];
    $inicio = $dados['age_inicio'];
    $fim = $dados['age_fim'];
    $tipo = $dados['age_tipo'];
    $obs = $dados['age_obs'];
    $status = $dados['age_status'];

    $eventos[] = [
        'id' => $id,
        'title' => "$paciente - Dr. $dentista - $tipo - $obs - $status",
        'color' => $cor,
        'start' => $inicio,
        'end' => $fim,
        'dentista' => $dentista
    ];

endwhile;

echo json_encode($eventos);
