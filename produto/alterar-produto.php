<?php
include_once '../util/conexao.php';
include_once '../util/funcoes.php';

if (!isset($_SESSION['admin'])) :
    header('Location: ../index.php');
endif;

if (isset($_GET['id'])) :
    $id = $_GET['id'];
    $sql = "select * from produto where pro_id = '$id'";
    $resultado = mysqli_query($conexao, $sql);
    $dados = mysqli_fetch_array($resultado);

    $barras = $dados['pro_barras'];
    $descricao = $dados['pro_descricao'];
    $unidade = $dados['pro_unidade'];
    $ult_vl = $dados['pro_ult_vl'];
    $vl_vend = $dados['pro_vl_vend'];
    $status = $dados['pro_status'];

elseif (isset($_POST['btnenviar'])) :
    $_SESSION['msg'] = "";
    $id = clear($_POST['id']);
    $barras = clear($_POST['barras']);
    $descricao = clear($_POST['descricao']);
    $unidade = clear($_POST['unidade']);
    $ult_vl = clear($_POST['ult_vl']);
    $vl_vend = clear($_POST['vl_vend']);
    $status = clear($_POST['status']);

    $sql = "update produto set pro_barras = '$barras', pro_descricao = '$descricao', pro_unidade = '$unidade', 
            pro_ult_vl = '$ult_vl', pro_vl_vend = '$vl_vend', pro_status = '$status' where pro_id = '$id'";

    if (mysqli_query($conexao, $sql)) :
        $_SESSION['msg'] =
            "<div class='alert alert-success alert-dismissible fade in' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button>
                    Produto alterado com sucesso!
            </div>";
    else :
        $_SESSION['msg'] =
            "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button>
                    Erro ao alterar Produto: " . mysqli_error($conexao) . "</div>";
    endif;
    mysqli_close($conexao);
    header("Location: alterar-produto.php?id=$id");
endif;
?>
<!doctype html>
<html class="corpo_login" lang="pt-br">

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
    <!-- Custom Theme Style -->
    <link href="../css/custom.min.css" rel="stylesheet">

    <link href="../css/estilo.css" rel="stylesheet">
</head>

<body class="nav-md">
    <?php
    include_once '../layout/cabecalho.php';
    ?>

    <!-- page content -->
    <div class="right_col" role="main">

        <h3 class="h3">Alterar Produto</h3>
        <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
            <input type="hidden" name="id" id="id" value="<?= $id ?>" />
            <div class="col-md-6">
                <label for="barras">Código de Barras</label>
                <input class="form-control" type="text" name="barras" id="barras" maxlength="100" value="<?= $barras ?>" /><br>
            </div>
            <div class="col-md-6">
                <label for="descricao">Descrição *</label>
                <input class="form-control" type="text" name="descricao" id="descricao" maxlength="100" required value="<?= $descricao ?>" /><br>
            </div>
            <div class="col-md-6">
                <label for="unidade">Unidade *</label>
                <input class="form-control" type="text" name="unidade" id="unidade" required value="<?= $unidade ?>" /><br>
            </div>
            <div class="col-md-6">
                <label for="ult_vl">Último Valor Pago *</label>
                <input class="form-control" type="text" name="ult_vl" id="ult_vl" required onKeyPress="return(moeda(this,'','.',event))" value="<?= $ult_vl ?>" /><br>
            </div>
            <div class="col-md-6">
                <label for="vl_vend">Valor Venda *</label>
                <input class="form-control" type="text" name="vl_vend" id="vl_vend" required onKeyPress="return(moeda(this,'','.',event))" value="<?= $vl_vend ?>" /><br>
            </div>
            <div class="col-md-6">
                <label for="status">Status</label>
                <select class="form-control" name="status">
                    <option value="A" <?= $status == 'A' ? 'selected' : '' ?>>ATIVO</option>
                    <option value="I" <?= $status == 'I' ? 'selected' : '' ?>>INATIVO</option>
                </select>
                <br>
            </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-success" name="btnenviar"><i class="fa fa-save"></i> Salvar</button>
                <a class="btn btn-warning" href="listar-produto.php"><i class="fa fa-reply"></i> Voltar</a>
            </div>
        </form>

        <br>
        <br><br>
        <?= $_SESSION['msg'] ?>

    </div>
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
    <!-- DateJS -->
    <script src="../vendors/DateJS/build/date.js"></script>
    <!-- jquery.inputmask -->
    <script src="../vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../js/custom.min.js"></script>
    <!-- CEP -->
    <script src="../js/funcoes.js"></script>
    <!-- Moeda -->
    <script src="../js/moeda.js"></script>
</body>

</html>