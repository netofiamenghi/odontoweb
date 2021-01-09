<?php
include_once '../util/conexao.php';
include_once '../util/funcoes.php';

if (!isset($_SESSION['admin'])) :
    header('Location: ../index.php');
endif;

if (isset($_POST['btnenviar'])) :
    $_SESSION['msg'] = "";
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
        $_SESSION['msg'] =
            "<div class='alert alert-success alert-dismissible fade in' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button>
                Paciente cadastrado com sucesso!
            </div>";
    else :
        $_SESSION['msg'] =
            "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button>
                Erro ao cadastrar Paciente: " . mysqli_error($conexao) . "</div>";
    endif;
    mysqli_close($conexao);
    header("Location: cadastrar-paciente.php");
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
        <h3 class="h3">Cadastro de Paciente</h3>
        <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
            <div class="col-md-6">
                <label for="cpf">CPF *</label>
                <input class="form-control" type="text" name="cpf" id="cpf" required data-inputmask="'mask' : '999.999.999-99'" /><br>
            </div>
            <div class="col-md-6">
                <label for="rg">RG *</label>
                <input class="form-control" type="text" name="rg" id="rg" required /><br>
            </div>
            <div class="col-md-6">
                <label for="nome">Nome *</label>
                <input class="form-control" type="text" name="nome" id="nome" maxlength="100" required /><br>
            </div>
            <div class="col-md-6">
                <label for="sexo">Sexo *</label>
                <select class="form-control" name="sexo" id="sexo" required>
                    <option value="M">MASCULINO</option>
                    <option value="F">FEMININO</option>
                </select><br>
            </div>
            <div class="col-md-6">
                <label for="sangue">Tipo Sanguíneo *</label>
                <select class="form-control" name="sangue" id="sangue" required>
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                    <option value="NAO">NÃO INFORMADO</option>
                </select><br>
            </div>
            <div class="col-md-6">
                <label for="dt_nasc">Data Nascimento *</label>
                <input class="form-control" type="date" name="dt_nasc" id="dt_nasc" required /><br>
            </div>
            <div class="col-md-6">
                <label for="cep">CEP *</label>
                <input class="form-control" type="text" name="cep" id="cep" required data-inputmask="'mask' : '99.999-999'" /><br>
            </div>
            <div class="col-md-6">
                <label for=" logradouro">Logradouro * (Rua, Avenida, etc...)</label>
                <input class="form-control" type="text" name="logradouro" id="logradouro" maxlength="100" required /><br>
            </div>
            <div class="col-md-6">
                <label for="complemento">Complemento</label>
                <input class="form-control" type="text" name="complemento" id="complemento" /><br>
            </div>
            <div class="col-md-6">
                <label for="numero">Número *</label>
                <input class="form-control" type="text" name="numero" id="numero" required /><br>
            </div>
            <div class="col-md-6">
                <label for="bairro">Bairro *</label>
                <input class="form-control" type="text" name="bairro" id="bairro" maxlength="100" required /><br>
            </div>
            <div class="col-md-6">
                <label for="cidade">Cidade *</label>
                <input class="form-control" type="text" name="cidade" id="cidade" maxlength="100" required /><br>
            </div>
            <div class="col-md-6">
                <label for="estado">Estado *</label>
                <select class="form-control" name="estado" id="estado" required>
                    <option value="AC">ACRE</option>
                    <option value="AL">AlAGOAS</option>
                    <option value="AP">AMAPÁ</option>
                    <option value="AM">AMAZONAS</option>
                    <option value="BA">BAHIA</option>
                    <option value="CE">CEARÁ</option>
                    <option value="DF">DISTRITO FEDERAL</option>
                    <option value="ES">ESPÍRITO SANTO</option>
                    <option value="GO">GOIÁS</option>
                    <option value="MA">MARANHÃO</option>
                    <option value="MT">MATO GROSSO</option>
                    <option value="MS">MATO GROSSO DO SUL</option>
                    <option value="MG">MINAS GERAIS</option>
                    <option value="PA">PARÁ</option>
                    <option value="PB">PARAÍBA</option>
                    <option value="PR">PARANÁ</option>
                    <option value="PE">PERNAMBUCO</option>
                    <option value="PI">PIAUÍ</option>
                    <option value="RJ">RIO DE JANEIRO</option>
                    <option value="RN">RIO GRANDE DO NORTE</option>
                    <option value="RS">RIO GRANDE DO SUL</option>
                    <option value="RO">RONDÔNIA</option>
                    <option value="RR">RORAIMA</option>
                    <option value="SC">SANTA CATARINA</option>
                    <option value="SP">SÃO PAULO</option>
                    <option value="SE">SERGIPE</option>
                    <option value="TO">TOCANTINS</option>
                </select><br>
            </div>
            <div class="col-md-6">
                <label for="telefone">Telefone</label>
                <input class="form-control" type="text" name="telefone" id="telefone" data-inputmask="'mask' : '(99) 9999-9999'" /><br>
            </div>
            <div class="col-md-6">
                <label for="celular">Celular *</label>
                <input class="form-control" type="text" name="celular" id="celular" required data-inputmask="'mask' : '(99) 99999-9999'" /><br>
            </div>
            <div class="col-md-6">
                <label for="email">E-mail *</label>
                <input class="form-control" type="email" name="email" id="email" required /><br>
            </div>
            <div class="col-md-6">
                <label for="musica">Preferência Musical</label>
                <input class="form-control" type="text" name="musica" id="musica" maxlength="150" /><br>
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
                        <option value="<?= $id ?>"><?= $nome ?></option>
                    <?php
                    endwhile;
                    ?>
                </select><br>
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