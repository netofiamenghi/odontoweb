<?php
include_once '../util/conexao.php';
include_once '../util/funcoes.php';

if (!isset($_SESSION['admin'])) :
    header('Location: ../index.php');
endif;

// alterar
if ($_POST['id'] != null) :
    $_SESSION['msg'] = "";
    $id = clear($_POST['id']);
    $nome = clear($_POST['nome']);
    $razao = clear($_POST['razao']);
    $cnpj = clear($_POST['cnpj']);
    $ie = clear($_POST['ie']);
    $im = clear($_POST['im']);
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
    $site = clear($_POST['site']);
    $formatospermitidos = array("png", "jpeg", "jpg", "gif");
    $extensao = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);

    // alterar com imagem
    if ($extensao != null) :

        if (in_array($extensao, $formatospermitidos)) :
            $pasta = "../img/clinica/";
            $temporario = $_FILES['logo']['tmp_name'];
            $novoNome = uniqid() . ".$extensao";
            if (move_uploaded_file($temporario, $pasta . $novoNome)) :
                $sql = "update clinica set cli_nome = '$nome', cli_razao = '$razao', cli_cnpj = '$cnpj', 
                cli_ie = '$ie', cli_im = '$im', cli_cep = '$cep', cli_logradouro = '$logradouro', 
                cli_complemento = '$complemento', cli_numero = '$numero', cli_bairro = '$bairro', 
                cli_cidade = '$cidade', cli_estado = '$estado', cli_telefone = '$telefone', cli_celular = '$celular',
                cli_email = '$email', cli_site = '$site', cli_logo = '$novoNome' where cli_id = '$id'";
                if (mysqli_query($conexao, $sql)) :
                    $_SESSION['msg'] =
                        "<div class='alert alert-success alert-dismissible fade in' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button>
                                Clínica alterada com sucesso!
                        </div>";
                else :
                    $_SESSION['msg'] =
                        "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button>
                                Erro ao alterar Clínica: " . mysqli_error($conexao) . "</div>";
                endif;
            else :
                $_SESSION['msg'] =
                    "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button>
                            Não foi possível fazer o upload da imagem!!!
                    </div>";
            endif;
        else :
            $_SESSION['msg'] =
                "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button>
                        Formato de imagem incompatível!!!
                </div>";
        endif;
    // alterar sem imagem 
    mysqli_close($conexao);
    header("Location: clinica.php");   
    else :
        $sql = "update clinica set cli_nome = '$nome', cli_razao = '$razao', cli_cnpj = '$cnpj', cli_ie = '$ie', 
                cli_im = '$im', cli_cep = '$cep', cli_logradouro = '$logradouro', cli_complemento = '$complemento', 
                cli_numero = '$numero', cli_bairro = '$bairro', cli_cidade = '$cidade', cli_estado = '$estado', 
                cli_telefone = '$telefone', cli_celular = '$celular', cli_email = '$email', cli_site = '$site' 
                where cli_id = '$id'";
        if (mysqli_query($conexao, $sql)) :
            $_SESSION['msg'] =
                "<div class='alert alert-success alert-dismissible fade in' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button>
                                Clínica alterada com sucesso!
                        </div>";
        else :
            $_SESSION['msg'] =
                "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button>
                                Erro ao alterar Clínica: " . mysqli_error($conexao) . "</div>";
        endif;
    endif;

    mysqli_close($conexao);
    header("Location: clinica.php");

// inserir
elseif (isset($_POST['btnenviar'])) :
    $_SESSION['msg'] = "";
    $nome = clear($_POST['nome']);
    $razao = clear($_POST['razao']);
    $cnpj = clear($_POST['cnpj']);
    $ie = clear($_POST['ie']);
    $im = clear($_POST['im']);
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
    $site = clear($_POST['site']);
    $formatospermitidos = array("png", "jpeg", "jpg", "gif");
    $extensao = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
    if (in_array($extensao, $formatospermitidos)) :
        $pasta = "../img/clinica/";
        $temporario = $_FILES['logo']['tmp_name'];
        $novoNome = uniqid() . ".$extensao";
        if (move_uploaded_file($temporario, $pasta . $novoNome)) :
            $sql = "insert into clinica (cli_nome, cli_razao, cli_cnpj, cli_ie, cli_im, cli_cep, cli_logradouro,
            cli_complemento, cli_numero, cli_bairro, cli_cidade, cli_estado, cli_telefone, cli_celular, cli_email,
            cli_site, cli_logo) values('$nome','$razao','$cnpj', '$ie', '$im', '$cep', '$logradouro', '$complemento', 
            '$numero', '$bairro', '$cidade', '$estado', '$telefone', '$celular', '$email','$site', '$novoNome') ";
            if (mysqli_query($conexao, $sql)) :
                $_SESSION['msg'] =
                    "<div class='alert alert-success alert-dismissible fade in' role='alert'>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button>
                            Clínica cadastrada com sucesso!
                    </div>";
            else :
                $_SESSION['msg'] =
                    "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button>
                            Erro ao cadastrar Clínica: " . mysqli_error($conexao) . "</div>";
            endif;
        else :
            $_SESSION['msg'] =
                "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button>
                        Não foi possível fazer o upload da imagem!!!
                </div>";
        endif;
    else :
        $_SESSION['msg'] =
            "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button>
                    Formato de imagem incompatível!!!
            </div>";
    endif;
    mysqli_close($conexao);
    header("Location: clinica.php");
// carregar    
else :

    $sql = "select * from clinica";
    $resultado = mysqli_query($conexao, $sql);

    if ($resultado != null) :

        $dados = mysqli_fetch_array($resultado);
        $id = $dados['cli_id'];
        $nome = $dados['cli_nome'];
        $razao = $dados['cli_razao'];
        $cnpj = $dados['cli_cnpj'];
        $ie = $dados['cli_ie'];
        $im = $dados['cli_im'];
        $cep = $dados['cli_cep'];
        $logradouro = $dados['cli_logradouro'];
        $complemento = $dados['cli_complemento'];
        $numero = $dados['cli_numero'];
        $bairro = $dados['cli_bairro'];
        $cidade = $dados['cli_cidade'];
        $estado = $dados['cli_estado'];
        $telefone = $dados['cli_telefone'];
        $celular = $dados['cli_celular'];
        $email = $dados['cli_email'];
        $site = $dados['cli_site'];
        $logo = $dados['cli_logo'];

    endif;

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
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $id ?>" />
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h3 class="h3">Cadastro de Clínica</h3>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="" role="tabpanel" data-example-id="togglable-tabs">
                            <div id="myTabContent" class="tab-content">
                                <div class="col-md-6">
                                    <label for="nome">Nome da Clínica *</label>
                                    <input class="form-control" type="text" name="nome" id="nome" maxlength="100" required value="<?= $nome ?>" /><br>
                                </div>
                                <div class="col-md-6">
                                    <label for="razao">Razão Social *</label>
                                    <input class="form-control" type="text" name="razao" id="razao" maxlength="100" required value="<?= $razao ?>" /><br>
                                </div>
                                <div class="col-md-6">
                                    <label for="cnpj">CNPJ *</label>
                                    <input class="form-control" type="text" name="cnpj" id="cnpj" required data-inputmask="'mask' : '99.999.999/9999-99'" value="<?= $cnpj ?>" /><br>
                                </div>
                                <div class="col-md-6">
                                    <label for="ie">Inscrição Estadual *</label>
                                    <input class="form-control" type="text" name="ie" id="ie" required value="<?= $ie ?>" /><br>
                                </div>
                                <div class="col-md-6">
                                    <label for="im">Inscrição Municipal</label>
                                    <input class="form-control" type="text" name="im" id="im" value="<?= $im ?>" /><br>
                                </div>
                                <div class="col-md-6">
                                    <label for="cep">CEP *</label>
                                    <input class="form-control" type="text" name="cep" id="cep" required data-inputmask="'mask' : '99.999-999'" value="<?= $cep ?>" /><br>
                                </div>
                                <div class="col-md-6">
                                    <label for="logradouro">Logradouro * (Rua, Avenida, etc...)</label>
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
                                    <select class="form-control" name="estado" id="estado">
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
                                    <label for="telefone">Telefone *</label>
                                    <input class="form-control" type="text" name="telefone" id="telefone" required data-inputmask="'mask' : '(99) 9999-9999'" value="<?= $telefone ?>" /><br>
                                </div>
                                <div class="col-md-6">
                                    <label for="celular">Celular</label>
                                    <input class="form-control" type="text" name="celular" id="celular" data-inputmask="'mask' : '(99) 99999-9999'" value="<?= $celular ?>" /><br>
                                </div>
                                <div class="col-md-6">
                                    <label for="email">Email</label>
                                    <input class="form-control" type="email" name="email" id="email" maxlength="100" value="<?= $email ?>" /><br>
                                </div>
                                <div class="col-md-6">
                                    <label for="site">Site</label>
                                    <input class="form-control" type="text" name="site" id="site" maxlength="100" value="<?= $site ?>" /><br>
                                </div>
                                <label for="logo">Selecione a Imagem</label>
                                <input class="form-control" type="file" name="logo" id="logo" /><br>
                                <img src="./../img/clinica/<?= $logo ?>" alt="Sem Logo" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success" name="btnenviar"><i class="fa fa-save"></i> Salvar</button>
            <a class="btn btn-warning" href="./../geral/pagina-inicial.php"><i class="fa fa-reply"></i> Voltar</a>
        </form>
        <br>
        <br><br>
        <?= $_SESSION['msg'] ?>
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
    <!-- CEP e Validações -->
    <script src="../js/funcoes.js"></script>

</body>

</html>