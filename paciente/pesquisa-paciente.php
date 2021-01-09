<?php

include_once '../util/conexao.php';

$pesquisa = filter_input(INPUT_POST, 'palavra', FILTER_SANITIZE_STRING);

$sql = "select * from paciente where pac_nome like '%$pesquisa%' limit 3 ";
$resultado = mysqli_query($conexao, $sql);

if (($resultado) and ($resultado->num_rows != 0)) :
    while ($dados = mysqli_fetch_array($resultado)) :

        echo "<li class='item-paciente'>
                {$dados['pac_nome']} - {$dados['pac_cpf']} - {$dados['pac_id']}
            </li>
            ";
    endwhile;
else :
    echo "Nenhum paciente encontrado!";
endif;
