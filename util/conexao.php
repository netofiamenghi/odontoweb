<?php
session_start();

$producao = false;
$codclinica = $_SESSION['codclinica'];

if ($producao == false) :
    if ($codclinica == "000") :
        $_SESSION['clinica'] = 'Clínica Teste';
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $db_name = "odontoweb";
    endif;
else:
    // if ($codclinica == "000") :
    //     $_SESSION['empresa'] = 'Teste';
    //     $servername = "localhost";
    //     $username = "plugas91_teste";
    //     $password = "Swxaqz33";
    //     $db_name = "plugas91_construtora";
    // endif;
    // if ($codclinica == "001") :
    //     $_SESSION['empresa'] = 'Eccons Engenharia';
    //     $servername = "localhost";
    //     $username = "plugas91_eccons";
    //     $password = "Swxaqz33";
    //     $db_name = "plugas91_eccons";
    // endif;
endif;

$conexao = mysqli_connect($servername, $username, $password, $db_name);

if (mysqli_connect_error()) :
    $_SESSION['msg'] =  "Falha na conexão com o banco de dados: " . mysqli_connect_error();
endif;
