<?php
include_once '../util/conexao.php';
include_once '../util/funcoes.php';

if (!isset($_SESSION['admin'])) :
    header('Location: ../index.php');
endif;

// carregar
if (isset($_GET['id'])) :
    // carregamento do grupo
    $id = $_GET['id'];
    $sql = "select * from grupo_usuario where gru_id = $id";
    $resultado = mysqli_query($conexao, $sql);
    $dados = mysqli_fetch_array($resultado);

    $nome = $dados['gru_nome'];
    $status = $dados['gru_status'];

    // carregamento do gerenciamento de acesso
    $sql = "select * from ger_acesso where ger_gru_id = $id";
    $resultado = mysqli_query($conexao, $sql);
    $dados = mysqli_fetch_array($resultado);

    $ger_id = $dados['ger_id'];
    $ger_clinica = $dados['ger_clinica'];
    $ger_dentista = $dados['ger_dentista'];
    $ger_fornecedor = $dados['ger_fornecedor'];
    $ger_funcionario = $dados['ger_funcionario'];
    $ger_grupo = $dados['ger_grupo'];
    $ger_paciente = $dados['ger_paciente'];
    $ger_produto = $dados['ger_produto'];

// alterar grupo
elseif (isset($_POST['btnenviar'])) :
    $_SESSION['msg'] = "";
    $id = clear($_POST['id']);
    $nome = clear($_POST['nome']);
    $status = clear($_POST['status']);

    $sql = "update grupo_usuario set gru_nome = '$nome', gru_status = '$status' where gru_id = '$id'";

    if (mysqli_query($conexao, $sql)) :
        $_SESSION['msg'] =
            "<div class='alert alert-success alert-dismissible fade in' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button>
                Grupo de Usuário alterado com sucesso!
            </div>";
    else :
        $_SESSION['msg'] =
            "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button>
                Erro ao alterar Usuário: " . mysqli_error($conexao) . "</div>";
    endif;
    $_SESSION['ger_msg'] = "";
    mysqli_close($conexao);
    header("Location: alterar-grupo-usuario.php?id=$id");

// alterar gerenciamento de acesso
elseif (isset($_POST['btngerenciar'])) :
    $_SESSION['ger_msg'] = "";
    $id = clear($_POST['id']);
    $ger_id = clear($_POST['ger_id']);
    $ger_clinica = clear($_POST['ger_clinica']);
    $ger_dentista = clear($_POST['ger_dentista']);
    $ger_fornecedor = clear($_POST['ger_fornecedor']);
    $ger_funcionario = clear($_POST['ger_funcionario']);
    $ger_grupo = clear($_POST['ger_grupo']);
    $ger_paciente = clear($_POST['ger_paciente']);
    $ger_produto = clear($_POST['ger_produto']);

    $sql = "update ger_acesso set ger_clinica = '$ger_clinica', ger_dentista = '$ger_dentista', 
            ger_fornecedor = '$ger_fornecedor', ger_funcionario = '$ger_funcionario', ger_grupo = '$ger_grupo',
            ger_paciente = '$ger_paciente', ger_produto = '$ger_produto' where ger_id = '$ger_id'";

    if (mysqli_query($conexao, $sql)) :
        $_SESSION['ger_msg'] =
            "<div class='alert alert-success alert-dismissible fade in' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button>
                Gerenciamento de Acesso alterado com sucesso!
            </div>";
    else :
        $_SESSION['ger_msg'] =
            "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button>
                Erro ao alterar Gerenciamento de Acesso: " . mysqli_error($conexao) . "</div>";
    endif;
    $_SESSION['msg'] = "";
    mysqli_close($conexao);
    header("Location: alterar-grupo-usuario.php?id=$id");
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



        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h3 class="h3">Alterar Grupo de Usuário</h3>
                    <ul class="nav navbar-right panel_toolbox">
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">


                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                            <li role="presentation" <?= $_SESSION['ger_msg'] == "" ? 'class="active"' : 'class=""' ?> ><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Informações Cadastrais</a></li>
                            <li role="presentation" <?= $_SESSION['ger_msg'] != "" ? 'class="active"' : 'class=""' ?> ><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Gerenciar Acessos</a></li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <div role="tabpanel" class="tab-pane fade <?= $_SESSION['ger_msg'] == "" ? 'active in' : '' ?> " id="tab_content1" aria-labelledby="home-tab">

                                <!--  Informações Cadastrais -->
                                <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">

                                    <input class="form-control" type="hidden" name="id" id="id" readonly="readonly" value="<?= $id ?>" />
                                    <div class="col-md-6">
                                        <label for="nome">Nome *</label>
                                        <input class="form-control" type="text" name="nome" id="nome" value="<?= $nome ?>" maxlength="100" required />
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
                                        <a class="btn btn-warning" href="listar-grupo-usuario.php"><i class="fa fa-reply"></i> Voltar</a>
                                    </div>
                                </form>
                                <br>
                                <br><br>
                                <?= $_SESSION['msg'] ?>

                            </div>
                            <div role="tabpanel" class="tab-pane fade <?= $_SESSION['ger_msg'] != "" ? 'active in' : '' ?>" id="tab_content2" aria-labelledby="profile-tab">

                                <!-- Gerenciar Acessos -->
                                <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">

                                    <input type="hidden" name="ger_id" id="ger_id" value="<?= $ger_id ?>" />
                                    <input type="hidden" name="id" id="id" value="<?= $id ?>" />

                                    <div class="col-md-3">
                                        <h4 class="h4">Clínica</h4>
                                        Liberado <input <?= $ger_clinica == 'L' ? 'checked' : '' ?> type="radio" value="L" name="ger_clinica" />
                                        Negado <input <?= $ger_clinica == 'N' ? 'checked' : '' ?> type="radio" value="N" name="ger_clinica" /><br><br>
                                    </div>

                                    <div class="col-md-3">
                                        <h4 class="h4">Dentista</h4>
                                        Liberado <input <?= $ger_dentista == 'L' ? 'checked' : '' ?> type="radio" value="L" name="ger_dentista" />
                                        Negado <input <?= $ger_dentista == 'N' ? 'checked' : '' ?> type="radio" value="N" name="ger_dentista" /><br><br>
                                    </div>

                                    <div class="col-md-3">
                                        <h4 class="h4">Fornecedor</h4>
                                        Liberado <input <?= $ger_fornecedor == 'L' ? 'checked' : '' ?> type="radio" value="L" name="ger_fornecedor" />
                                        Negado <input <?= $ger_fornecedor == 'N' ? 'checked' : '' ?> type="radio" value="N" name="ger_fornecedor" /><br><br>
                                    </div>

                                    <div class="col-md-3">
                                        <h4 class="h4">Funcionário</h4>
                                        Liberado <input <?= $ger_funcionario == 'L' ? 'checked' : '' ?> type="radio" value="L" name="ger_funcionario" />
                                        Negado <input <?= $ger_funcionario == 'N' ? 'checked' : '' ?> type="radio" value="N" name="ger_funcionario" /><br><br>
                                    </div>

                                    <div class="col-md-3">
                                        <h4 class="h4">Grupo de Usuários</h4>
                                        Liberado <input <?= $ger_grupo == 'L' ? 'checked' : '' ?> type="radio" value="L" name="ger_grupo" />
                                        Negado <input <?= $ger_grupo == 'N' ? 'checked' : '' ?> type="radio" value="N" name="ger_grupo" /><br><br>
                                    </div>

                                    <div class="col-md-3">
                                        <h4 class="h4">Paciente</h4>
                                        Liberado <input <?= $ger_paciente == 'L' ? 'checked' : '' ?> type="radio" value="L" name="ger_paciente" />
                                        Negado <input <?= $ger_paciente == 'N' ? 'checked' : '' ?> type="radio" value="N" name="ger_paciente" /><br><br>
                                    </div>

                                    <div class="col-md-3">
                                        <h4 class="h4">Produto</h4>
                                        Liberado <input <?= $ger_produto == 'L' ? 'checked' : '' ?> type="radio" value="L" name="ger_produto" />
                                        Negado <input <?= $ger_produto == 'N' ? 'checked' : '' ?> type="radio" value="N" name="ger_produto" /><br><br>
                                    </div>

                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-success" name="btngerenciar"><i class="fa fa-save"></i> Salvar</button>
                                        <a class="btn btn-warning" href="listar-grupo-usuario.php"><i class="fa fa-reply"></i> Voltar</a>
                                    </div>
                                </form>
                                <br>
                                <br><br>
                                <?= $_SESSION['ger_msg'] ?>
                            </div>
                        </div>
                    </div>

                </div>
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
    <!-- Custom Theme Scripts -->
    <script src="../js/custom.min.js"></script>
</body>

</html>