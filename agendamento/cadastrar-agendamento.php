<?php

include_once '../util/conexao.php';
include_once '../util/funcoes.php';

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

//Converter a data e hora do formato brasileiro para o formato do Banco de Dados
$data_start = str_replace('/', '-', $dados['inicio']);
$data_start_conv = date("Y-m-d H:i:s", strtotime($data_start));

$data_end = str_replace('/', '-', $dados['termino']);
$data_end_conv = date("Y-m-d H:i:s", strtotime($data_end));

$paciente = clear($dados['paciente']);
$dentista = clear($dados['dentista']);
$inicio = clear($data_start_conv);
$termino = clear($data_end_conv);
$tipo = clear($dados['tipo']);
$obs = clear($dados['obs']);

$sql = "insert into agendamento (age_pac_id, age_den_id, age_inicio, age_fim, age_tipo, age_obs, age_status) 
        values('$paciente', '$dentista', '$inicio', '$termino', '$tipo',  '$obs','AGENDADA')";

if (mysqli_query($conexao, $sql)) :
    $retorna = ['sit' => true, 'msg' => '<div class="alert alert-success" role="alert">Agendamento realizado!</div>'];
else :
    $retorna = ['sit' => false, 'msg' => '<div class="alert alert-danger" role="alert">Erro: Agendamento não foi cadastrado!</div>'];
endif;


header('Content-Type: application/json');
echo json_encode($retorna);
