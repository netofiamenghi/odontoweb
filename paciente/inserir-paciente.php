<?php

include_once '../util/conexao.php';
include_once '../util/funcoes.php';

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$cpf = clear($_POST['cpf']);
$rg = clear($_POST['rg']);
$nome = clear($_POST['nome']);
$sexo = clear($_POST['sexo']);
$sangue = clear($_POST['sangue']);
$dt_nasc = clear($_POST['dt_nasc']);
$cep = clear($_POST['cep']);
$logradouro = clear($_POST['logradouro']);
$complemento = clear($_POST['complemento']);
$numero = clear($_POST['numero']);
$bairro = clear($_POST['bairro']);
$cidade = clear($_POST['cidade']);
$estado = clear($_POST['estado']);
$telefone = clear($_POST['telefone']);
$celular = clear($_POST['celular']);
$email = clear($_POST['email']);
$musica = clear($_POST['musica']);
$dentista = clear($_POST['dentista']);

$sql = "insert into paciente (pac_cpf, pac_rg, pac_nome, pac_sexo, pac_sangue, pac_cep, pac_logradouro, 
            pac_numero, pac_complemento, pac_bairro, pac_cidade, pac_estado, pac_dt_nasc, pac_email, pac_telefone,
            pac_celular, pac_musica, pac_dent_id, pac_status) 
            values('$cpf', '$rg', '$nome', '$sexo', '$sangue', '$cep', '$logradouro', 
            '$numero', '$complemento', '$bairro', '$cidade', '$estado', '$dt_nasc', '$email', '$telefone',
            '$celular', '$musica', '$dentista', 'A')";

if (mysqli_query($conexao, $sql)) :
    $retorna = ['sit' => true, 'msg' => '<div class="alert alert-success" role="alert">Cadastro realizado!</div>'];
else :
    $retorna = ['sit' => false, 'msg' => '<div class="alert alert-danger" role="alert">Erro ao cadastrar!</div>'];
endif;


header('Content-Type: application/json');
echo json_encode($retorna);
