<?php
include_once '../util/conexao.php';
include_once '../util/funcoes.php';

if (!isset($_SESSION['admin'])) :
    header('Location: ../index.php');
endif;

if (isset($_GET['id'])) :
    $id = $_GET['id'];
    $sql = "select * from paciente where pac_id = '$id'";
    $resultado = mysqli_query($conexao, $sql);
    $dados = mysqli_fetch_array($resultado);

    $cpf = $dados['pac_cpf'];
    $rg = $dados['pac_rg'];
    $nome = $dados['pac_nome'];
    $sexo = $dados['pac_sexo'];
    $sangue = $dados['pac_sangue'];
    $dt_nasc = $dados['pac_dt_nasc'];
    $cep = $dados['pac_cep'];
    $logradouro = $dados['pac_logradouro'];
    $complemento = $dados['pac_complemento'];
    $numero = $dados['pac_numero'];
    $bairro = $dados['pac_bairro'];
    $cidade = $dados['pac_cidade'];
    $estado = $dados['pac_estado'];
    $telefone = $dados['pac_telefone'];
    $celular = $dados['pac_celular'];
    $email = $dados['pac_email'];
    $musica = $dados['pac_musica'];
    $dentista = $dados['pac_dent_id'];
    $status = $dados['den_status'];

elseif (isset($_POST['btnenviar'])) :
    $_SESSION['msg'] = "";
    $id = clear($_POST['id']);
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
    $status = clear($_POST['status']);

     
    $sql = "update paciente set pac_cpf = '$cpf', pac_rg = '$rg', pac_nome = '$nome', pac_sexo = '$sexo', 
            pac_sangue = '$sangue', pac_cep = '$cep', pac_logradouro = '$logradouro', pac_numero = '$numero', 
            pac_complemento = '$complemento', pac_bairro = '$bairro', pac_cidade = '$cidade', pac_estado = '$estado',
            pac_dt_nasc = '$dt_nasc', pac_email = '$email', pac_telefone = '$telefone', pac_celular = '$celular', 
            pac_musica = '$musica', pac_dent_id = '$dentista', pac_status = '$status' where pac_id = '$id'";

    if (mysqli_query($conexao, $sql)) :
        $_SESSION['msg'] =
            "<div class='alert alert-success alert-dismissible fade in' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button>
                    Paciente alterado com sucesso!
            </div>";
    else :
        $_SESSION['msg'] =
            "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button>
                    Erro ao alterar Paciente: " . mysqli_error($conexao) . "</div>";
    endif;
    mysqli_close($conexao);
    header("Location: alterar-paciente.php?id=$id");
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

        <h3 class="h3">Alterar Paciente</h3>
        <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
            <input type="hidden" name="id" id="id" value="<?= $id ?>" />
            <div class="col-md-6">
                <label for="cpf">CPF *</label>
                <input class="form-control" type="text" name="cpf" id="cpf" required data-inputmask="'mask' : '999.999.999-99'" value="<?= $cpf ?>" /><br>
            </div>
            <div class="col-md-6">
                <label for="rg">RG *</label>
                <input class="form-control" type="text" name="rg" id="rg" required value="<?= $rg ?>" /><br>
            </div>
            <div class="col-md-6">
                <label for="nome">Nome *</label>
                <input class="form-control" type="text" name="nome" id="nome" maxlength="100" required value="<?= $nome ?>" /><br>
            </div>
            <div class="col-md-6">
                <label for="sexo">Sexo *</label>
                <select class="form-control" name="sexo" id="sexo" required>
                    <option <?= $sexo == 'M' ? 'selected' : '' ?> value="M">MASCULINO</option>
                    <option <?= $sexo == 'F' ? 'selected' : '' ?> value="F">FEMININO</option>
                </select><br>
            </div>
            <div class="col-md-6">
                <label for="sangue">Tipo Sanguíneo *</label>
                <select class="form-control" name="sangue" id="sangue" required>
                    <option <?= $sangue == 'A+' ? 'selected' : '' ?> value="A+">A+</option>
                    <option <?= $sangue == 'A-' ? 'selected' : '' ?> value="A-">A-</option>
                    <option <?= $sangue == 'AB+' ? 'selected' : '' ?> value="AB+">AB+</option>
                    <option <?= $sangue == 'AB-' ? 'selected' : '' ?> value="AB-">AB-</option>
                    <option <?= $sangue == 'B+' ? 'selected' : '' ?> value="B+">B+</option>
                    <option <?= $sangue == 'B-' ? 'selected' : '' ?> value="B-">B-</option>
                    <option <?= $sangue == 'O+' ? 'selected' : '' ?> value="O+">O+</option>
                    <option <?= $sangue == 'O-' ? 'selected' : '' ?> value="O-">O-</option>
                    <option <?= $sangue == 'NAO' ? 'selected' : '' ?> value="NAO">NÃO INFORMADO</option>
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
                <label for="complemento">Complemento</label>
                <input class="form-control" type="text" name="complemento" id="complemento" value="<?= $complemento ?>" /><br>
            </div>
            <div class="col-md-6">
                <label for="numero">Número *</label>
                <input class="form-control" type="text" name="numero" id="numero" required value="<?= $numero ?>" /><br>
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
                <label for="email">E-mail *</label>
                <input class="form-control" type="email" name="email" id="email" required value="<?= $email ?>" /><br>
            </div>
            <div class="col-md-6">
                <label for="musica">Preferência Musical</label>
                <input class="form-control" type="text" name="musica" id="musica" maxlength="150" value="<?= $musica ?>" /><br>
            </div>
            <div class="col-md-6">
                <label for="dentista">Selecione o Dentista</label>
                <select class="form-control" name="dentista" id="dentista">
                    <?php
                    $sql = "select * from dentista where den_status = 'A'";
                    $resultado = mysqli_query($conexao, $sql);
                    while ($dados = mysqli_fetch_array($resultado)) :
                        $id = $dados['den_id'];
                        $nome = $dados['den_nome'];
                    ?>
                        <option <?= $dentista == $id ? 'selected' : '' ?> value="<?= $id ?>"><?= $nome ?></option>
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
                <a class="btn btn-warning" href="listar-paciente.php"><i class="fa fa-reply"></i> Voltar</a>
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