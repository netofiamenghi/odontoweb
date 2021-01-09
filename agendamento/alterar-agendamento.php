<?php

include_once '../util/conexao.php';
include_once '../util/funcoes.php';

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

//Converter a data e hora do formato brasileiro para o formato do Banco de Dados
$data_start = str_replace('/', '-', $dados['inicio']);
$data_start_conv = date("Y-m-d H:i:s", strtotime($data_start));

$data_end = str_replace('/', '-', $dados['termino']);
$data_end_conv = date("Y-m-d H:i:s", strtotime($data_end));

$id = clear($dados['id']);
$inicio = clear($data_start_conv);
$termino = clear($data_end_conv);

if ($inicio < $termino) :

    $sql = "update agendamento set age_inicio = '$inicio', age_fim = '$termino' where age_id = '$id'";

    if (mysqli_query($conexao, $sql)) :
        $retorna = ['sit' => true, 'msg' => '<div class="alert alert-success" role="alert">Agendamento editado!</div>'];
    else :
        $retorna = ['sit' => false, 'msg' => '<div class="alert alert-danger" role="alert">Erro: Agendamento não foi editado!</div>'];
    endif;

endif;


header('Content-Type: application/json');
echo json_encode($retorna);
