<?php
include_once '../vendor/autoload.php';
include_once '../util/conexao.php';
include_once '../util/funcoes.php';

if (!isset($_SESSION['admin'])) :
    header('Location: ../index.php');
endif;

$sql = "select * from clinica";
$resultado = mysqli_query($conexao, $sql);
$dados = mysqli_fetch_array($resultado);
$nome = $dados['cli_nome'];
$logo = $dados['cli_logo'];
$data = date('d/m/Y \à\s H:i:s');

$status = clear($_POST['status']);
$ordem = clear($_POST['ordem']);

$mpdf = new \Mpdf\Mpdf();

$html = "<html>
            <head>
                <link rel='icon' href='../img/favicon.ico' type='image/ico' />
                <title> {$_SESSION['clinica']} | GHI Tecnologia</title>
                <!-- Bootstrap -->
                <link href='../vendors/bootstrap/dist/css/bootstrap.min.css' rel='stylesheet'>
                <!-- Font Awesome -->
                <link href='../vendors/font-awesome/css/font-awesome.min.css' rel='stylesheet'>
                <!-- NProgress -->
                <link href='../vendors/nprogress/nprogress.css' rel='stylesheet'>
            </head>
            <body>
            <img width='100px' src='./../img/clinica/$logo'/>
            <span style='font-size: 16px;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Relatório de Fornecedores</span>
            <span style='font-size: 10px;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$data</span>
            <hr>
                <table style='font-size: 12px;' class='table'>
                <thead>
                    <tr>
                        <th class='text-center' scope='col'>CNPJ</th>
                        <th scope='col'>Nome Fantasia</th>
                        <th scope='col'>Razão Social</th>
                        <th scope='col'>Status</th>
                    </tr>
                </thead>";

if ($status == 'A') :
    $where = "where for_status = 'A' ";
elseif ($status == 'I') :
    $where = "where for_status = 'I' ";
else :
    $where = '';
endif;

if ($ordem == 'codigo') :
    $order = "order by for_id";
elseif ($ordem == 'fantasia') :
    $order = "order by for_fantasia";
else:
    $order = "order by for_razaosocial";
endif;

$sql2 = "select * from fornecedor $where $order";

$resultado2 = mysqli_query($conexao, $sql2);
while ($dados2 = mysqli_fetch_array($resultado2)) :
    $status = $dados2['for_status'] == 'A' ? 'ATIVO' : 'INATIVO';
    $html .= "<tr>
                 <td class='text-center'> {$dados2['for_cnpj']} </td>
                 <td> {$dados2['for_fantasia']} </td>
                 <td> {$dados2['for_razaosocial']} </td>
                 <td> $status </td>
            </tr>";
endwhile;

$html .= "</table>
            <hr>
            <p style='font-size: 10px;' class='text-center'>GHI Tecnologia</p>
            </body>
        </html>";
$mpdf->WriteHTML($html);
$mpdf->Output();
exit;