<?php

include_once '../util/conexao.php';

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../img/favicon.ico" type="image/ico" />

    <title><?= $_SESSION['clinica'] ?> | GHI Tecnologia</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../css/custom.min.css" rel="stylesheet">
</head>

<body class="nav-md">
    <?php
    include_once '../layout/cabecalho.php';
    ?>

    <!-- page content -->
    <div class="right_col" role="main">
        <h2 class="h2 text-center">OdontoWeb</h2>
        <h4 class="h4 text-left"><?= $_SESSION['versao'] ?> - 01/04/2020</h4>
        <h4 class="h4">Novidades</h4>
        <ul class="ul">
            <li>Cadastro de Clínica.</li>
            <li>Cadastro de Dentistas.</li>
            <li>Relatório de Dentistas.</li>
            <li>Cadastro de Fornecedores.</li>
            <li>Relatório de Fornecedores.</li>
            <li>Cadastro de Funcionários.</li>
            <li>Relatório de Funcionários.</li>
            <li>Cadastro de Grupos de Usuários.</li>
            <li>Relatório de Grupos de Usuários.</li>
            <li>Cadastro de Pacientes.</li>
            <li>Relatório de Pacientes.</li>
            <li>Cadastro de Produtos.</li>
            <li>Relatório de Produtos.</li>
            <li>Gerenciamento de Acesso por Grupo de Usuários.</li>
        </ul>
        <hr>
    </div>
    </div>
    <br />
    </div>
    <!-- /page content -->
    <?php
    include_once '../layout/rodape.php';
    ?>
    </div>
    </div>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- gauge.js -->
    <script src="../vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="../vendors/skycons/skycons.js"></script>
    <!-- DateJS -->
    <script src="../vendors/DateJS/build/date.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../js/custom.min.js"></script>
</body>

</html>