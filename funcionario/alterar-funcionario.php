<?php
include_once '../util/conexao.php';
include_once '../util/funcoes.php';

if (!isset($_SESSION['admin'])) :
    header('Location: ../index.php');
endif;

if (isset($_GET['id'])) :
    $id = $_GET['id'];
    $sql = "select * from funcionario where fun_id = '$id'";
    $resultado = mysqli_query($conexao, $sql);
    $dados = mysqli_fetch_array($resultado);

    $nome = $dados['fun_nome'];
    $sexo = $dados['fun_sexo'];
    $dt_nasc = $dados['fun_dt_nasc'];
    $cpf = $dados['fun_cpf'];
    $rg = $dados['fun_rg'];
    $cep = $dados['fun_cep'];
    $logradouro = $dados['fun_logradouro'];
    $complemento = $dados['fun_complemento'];
    $numero = $dados['fun_numero'];
    $bairro = $dados['fun_bairro'];
    $cidade = $dados['fun_cidade'];
    $estado = $dados['fun_estado'];
    $telefone = $dados['fun_telefone'];
    $celular = $dados['fun_celular'];
    $email = $dados['fun_email'];
    $grupo = $dados['fun_gru_id'];
    $status = $dados['fun_status'];

elseif (isset($_POST['btnenviar'])) :
    $_SESSION['msg'] = "";
    $id = clear($_POST['id']);
    $nome = clear($_POST['nome']);
    $sexo = clear($_POST['sexo']);
    $dt_nasc = clear($_POST['dt_nasc']);
    $cpf = clear($_POST['cpf']);
    $rg = clear($_POST['rg']);
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
    $senha = clear($_POST['senha']);
    $grupo = clear($_POST['grupo']);
    $status = clear($_POST['status']);

    if ($senha != "") :
        $senhaNova = password_hash($senha, PASSWORD_DEFAULT);
        $sql = "update funcionario set fun_nome = '$nome', fun_sexo = '$sexo', fun_dt_nasc = '$dt_nasc', 
            fun_cpf = '$cpf', fun_rg = '$rg', fun_cep = '$cep', fun_logradouro = '$logradouro',
            fun_complemento = '$complemento', fun_numero = '$numero', fun_bairro = '$bairro',
            fun_cidade = '$cidade', fun_estado = '$estado', fun_telefone = '$telefone', 
            fun_celular = '$celular', fun_email = '$email', fun_senha = '$senhaNova', 
            fun_status = '$status' where fun_id = '$id'";
    else :
        $sql = "update funcionario set fun_nome = '$nome', fun_sexo = '$sexo', fun_dt_nasc = '$dt_nasc', 
            fun_cpf = '$cpf', fun_rg = '$rg', fun_cep = '$cep', fun_logradouro = '$logradouro',
            fun_complemento = '$complemento', fun_numero = '$numero', fun_bairro = '$bairro',
            fun_cidade = '$cidade', fun_estado = '$estado', fun_telefone = '$telefone', 
            fun_celular = '$celular', fun_email = '$email', 
            fun_status = '$status' where fun_id = '$id'";
    endif;

    if (mysqli_query($conexao, $sql)) :
        $_SESSION['msg'] =
            "<div class='alert alert-success alert-dismissible fade in' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button>
                    Funcionário alterado com sucesso!
            </div>";
    else :
        $_SESSION['msg'] =
            "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button>
                    Erro ao alterar Funcionário: CPF e/ou E-mail já cadastrado!</div>";
    endif;
    mysqli_close($conexao);
    header("Location: alterar-funcionario.php?id=$id");
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

        <h3 class="h3">Alterar Funcionário</h3>
        <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
            <input type="hidden" name="id" id="id" value="<?= $id ?>" />
            <div class="col-md-6">
                <label for="nome">Nome *</label>
                <input class="form-control" type="text" name="nome" id="nome" maxlength="100" required value="<?= $nome ?>" /><br>
            </div>
            <div class="col-md-6">
                <label for="cpf">CPF *</label>
                <input class="form-control" type="text" name="cpf" id="cpf" required data-inputmask="'mask' : '999.999.999-99'" value="<?= $cpf ?>" /><br>
            </div>
            <div class="col-md-6">
                <label for="rg">RG *</label>
                <input class="form-control" type="text" name="rg" id="rg" required value="<?= $rg ?>" /><br>
            </div>
            <div class="col-md-6">
                <label for="sexo">Sexo *</label>
                <select class="form-control" name="sexo" id="sexo" required>
                    <option <?= $sexo == 'M' ? 'selected' : '' ?> value="M">MASCULINO</option>
                    <option <?= $sexo == 'F' ? 'selected' : '' ?> value="F">FEMININO</option>
                </select><br>
            </div>
            <div class="col-md-6">
                <label for="dt_nasc">Data Nascimento *</label>
                <input class="form-control" type="date" name="dt_nasc" id="dt_nasc" required value="<?= $dt_nasc ?>" /><br>
            </div>
            <div class="col-md-6">
                <label for="cep">CEP *</label>
                <input class="form-control" type="text" name="cep" id="cep" required data-inputmask="'mask' : '99.999-999'" value="<?= $cep ?>" /><br>
            </div>
            <div class="col-md-6">
                <label for=" logradouro">Logradouro * (Rua, Avenida, etc...)</label>
                <input class="form-control" type="text" name="logradouro" id="logradouro" maxlength="100" required value="<?= $logradouro ?>" /><br>
            </div>
            <div class="col-md-6">
                <label for="numero">Número *</label>
                <input class="form-control" type="text" name="numero" id="numero" required value="<?= $numero ?>" /><br>
            </div>
            <div class="col-md-6">
                <label for="complemento">Complemento</label>
                <input class="form-control" type="text" name="complemento" id="complemento" value="<?= $complemento ?>" /><br>
            </div>
            <div class="col-md-6">
                <label for="bairro">Bairro *</label>
                <input class="form-control" type="text" name="bairro" id="bairro" maxlength="100" required value="<?= $bairro ?>" /><br>
            </div>
            <div class="col-md-6">
                <label for="cidade">Cidade *</label>
                <input class="form-control" type="text" name="cidade" id="cidade" maxlength="100" required value="<?= $cidade ?>" /><br>
            </div>
            <div class="col-md-6">
                <label for="estado">Estado *</label>
                <select class="form-control" name="estado" id="estado" required>
                    <option <?= $estado == 'AC' ? 'selected' : '' ?> value="AC">ACRE</option>
                    <option <?= $estado == 'AL' ? 'selected' : '' ?> value="AL">ALAGOAS</option>
                    <option <?= $estado == 'AP' ? 'selected' : '' ?> value="AP">AMAPÁ</option>
                    <option <?= $estado == 'AM' ? 'selected' : '' ?> value="AM">AMAZONAS</option>
                    <option <?= $estado == 'BA' ? 'selected' : '' ?> value="BA">BAHIA</option>
                    <option <?= $estado == 'CE' ? 'selected' : '' ?> value="CE">CEARÁ</option>
                    <option <?= $estado == 'DF' ? 'selected' : '' ?> value="DF">DISTRITO FEDERAL</option>
                    <option <?= $estado == 'ES' ? 'selected' : '' ?> value="ES">ESPÍRITO SANTO</option>
                    <option <?= $estado == 'GO' ? 'selected' : '' ?> value="GO">GOIÁS</option>
                    <option <?= $estado == 'MA' ? 'selected' : '' ?> value="MA">MARANHÃO</option>
                    <option <?= $estado == 'MT' ? 'selected' : '' ?> value="MT">MATO GROSSO</option>
                    <option <?= $estado == 'MS' ? 'selected' : '' ?> value="MS">MATO GROSSO DO SUL</option>
                    <option <?= $estado == 'MG' ? 'selected' : '' ?> value="MG">MINAS GERAIS</option>
                    <option <?= $estado == 'PA' ? 'selected' : '' ?> value="PA">PARÁ</option>
                    <option <?= $estado == 'PB' ? 'selected' : '' ?> value="PB">PARAÍBA</option>
                    <option <?= $estado == 'PR' ? 'selected' : '' ?> value="PR">PARANÁ</option>
                    <option <?= $estado == 'PE' ? 'selected' : '' ?> value="PE">PERNAMBUCO</option>
                    <option <?= $estado == 'PI' ? 'selected' : '' ?> value="PI">PIAUÍ</option>
                    <option <?= $estado == 'RJ' ? 'selected' : '' ?> value="RJ">RIO DE JANEIRO</option>
                    <option <?= $estado == 'RN' ? 'selected' : '' ?> value="RN">RIO GRANDE DO NORTE</option>
                    <option <?= $estado == 'RS' ? 'selected' : '' ?> value="RS">RIO GRANDE DO SUL</option>
                    <option <?= $estado == 'RO' ? 'selected' : '' ?> value="RO">RONDÔNIA</option>
                    <option <?= $estado == 'RR' ? 'selected' : '' ?> value="RR">RORAIMA</option>
                    <option <?= $estado == 'SC' ? 'selected' : '' ?> value="SC">SANTA CATARINA</option>
                    <option <?= $estado == 'SP' ? 'selected' : '' ?> value="SP">SÃO PAULO</option>
                    <option <?= $estado == 'SE' ? 'selected' : '' ?> value="SE">SERGIPE</option>
                    <option <?= $estado == 'TO' ? 'selected' : '' ?> value="TO">TOCANTINS</option>
                </select><br>
            </div>
            <div class="col-md-6">
                <label for="telefone">Telefone</label>
                <input class="form-control" type="text" name="telefone" id="telefone" data-inputmask="'mask' : '(99) 9999-9999'" value="<?= $telefone ?>" /><br>
            </div>
            <div class="col-md-6">
                <label for="celular">Celular *</label>
                <input class="form-control" type="text" name="celular" id="celular" required data-inputmask="'mask' : '(99) 99999-9999'" value="<?= $celular ?>" /><br>
            </div>
            <div class="col-md-6">
                <label for="email">Email *</label>
                <input class="form-control" type="email" name="email" id="email" maxlength="100" required value="<?= $email ?>" /><br>
            </div>
            <div class="col-md-6">
                <label for="senha">Nova Senha</label>
                <input class="form-control" type="password" name="senha" id="senha" /><br>
            </div>
            <div class="col-md-6">
                <label for="grupo">Selecione o Grupo de Usuário</label>
                <select class="form-control" name="grupo" id="grupo">
                    <?php
                    $sql = "select * from grupo_usuario where gru_status = 'A'";
                    $resultado = mysqli_query($conexao, $sql);
                    while ($dados = mysqli_fetch_array($resultado)) :
                        $id = $dados['gru_id'];
                        $nome = $dados['gru_nome'];
                    ?>
                        <option <?= $grupo == $id ? 'selected' : '' ?> value="<?= $id ?>"><?= $nome ?></option>
                    <?php
                    endwhile;
                    ?>
                </select><br>
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
                <a class="btn btn-warning" href="listar-funcionario.php"><i class="fa fa-reply"></i> Voltar</a>
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
</body>

</html>