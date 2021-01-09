<?php

include_once '../util/conexao.php';
include_once '../util/funcoes.php';

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$sql = "delete from agendamento where age_id = $id";
$resultado = mysqli_query($conexao, $sql);
mysqli_close($conexao);

header("Location: ../geral/pagina-inicial.php");