<?php

require_once './recaptcha/Config.php';
require_once './recaptcha/Captcha.php';

session_start(); 

if (isset($_POST['logar'])) : 

  $ObjCaptcha = new Captcha();
  $Retorno = $ObjCaptcha->getCaptcha($_POST['g-recaptcha-response']);

  if ($Retorno->success == false && $Retorno->score < 0.9) {
    header("Location: index.php");  
  }

  session_unset();
  session_start();
  $_SESSION['MINHA_SESSAO'] = time();
  $_SESSION['ger_msg'] = "";
  $_SESSION['codclinica'] = $_POST['clinica'];
  $_SESSION['versao'] = "v 1.0.0";

  include_once 'util/funcoes.php';
  include_once 'util/conexao.php';

  $email = clear($_POST['email']);
  $senha = clear($_POST['senha']);

  if (($email == "ADM@GHITECNOLOGIA.COM.BR") and ($senha == "SWXAQZ33")) :
    $_SESSION['admin']       = true;
    $_SESSION['idUsuario']   = 999;
    $_SESSION['nomeUsuario'] = "Administrador";

    $_SESSION['ger_clinica']     = 'L';
    $_SESSION['ger_dentista']    = 'L';
    $_SESSION['ger_fornecedor']  = 'L';
    $_SESSION['ger_funcionario'] = 'L';
    $_SESSION['ger_grupo']       = 'L';
    $_SESSION['ger_paciente']    = 'L';
    $_SESSION['ger_produto']     = 'L';

    header('Location: geral/pagina-inicial.php');

  elseif (($_SESSION['codclinica'] == "000") and ($email == "VENDAS@GHITECNOLOGIA.COM.BR") and ($senha == "VENDAS")) :
    $_SESSION['admin']       = true;
    $_SESSION['idUsuario']   = 998;
    $_SESSION['nomeUsuario'] = "Vendas";

    $_SESSION['ger_clinica']     = 'L';
    $_SESSION['ger_dentista']    = 'L';
    $_SESSION['ger_fornecedor']  = 'L';
    $_SESSION['ger_funcionario'] = 'L';
    $_SESSION['ger_grupo']       = 'L';
    $_SESSION['ger_paciente']    = 'L';
    $_SESSION['ger_produto']     = 'L';

    header('Location: geral/pagina-inicial.php');

  else :
    $sql = "select d.den_id as id, 'D' as tipo, d.den_nome as nome, d.den_email as email, d.den_senha as senha, d.den_gru_id as grupo 
            from dentista d where d.den_status = 'A' and d.den_email = '$email'
            union
            select f.fun_id as id, 'F' as tipo, f.fun_nome as nome, f.fun_email as email, f.fun_senha as senha, f.fun_gru_id as grupo 
            from funcionario f where f.fun_status = 'A' and f.fun_email = '$email'";
    $resultado = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($resultado) > 0) :
      while ($dados = mysqli_fetch_array($resultado)) :

        if (password_verify($senha, $dados['senha'])) :

          $_SESSION['admin']       = true;
          $_SESSION['idUsuario']   = $dados['id'];
          $_SESSION['tipoUsuario'] = $dados['tipo'];
          $_SESSION['nomeUsuario'] = $dados['nome'];

          $sql = "select * from ger_acesso g where g.ger_gru_id = '{$dados['grupo']}' ";
          $resultado = mysqli_query($conexao, $sql);
          $dados = mysqli_fetch_array($resultado);

          $_SESSION['ger_clinica']     = $dados['ger_clinica'];
          $_SESSION['ger_dentista']    = $dados['ger_dentista'];
          $_SESSION['ger_fornecedor']  = $dados['ger_fornecedor'];
          $_SESSION['ger_funcionario'] = $dados['ger_funcionario'];
          $_SESSION['ger_grupo']       = $dados['ger_grupo'];
          $_SESSION['ger_paciente']    = $dados['ger_paciente'];
          $_SESSION['ger_produto']     = $dados['ger_produto'];

          header('Location: geral/pagina-inicial.php');

        else :
          $_SESSION['msg'] =
            "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
                </button>
                Senha não confere!
            </div>";
        endif;
      endwhile;
    else :
      $_SESSION['msg'] =
        "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
              </button>
              Usuário não encontrado!
        </div>";
    endif;
  endif;
  mysqli_close($conexao);
endif;
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="icon" type="imagem/png" href="./img/favicon.ico" />
  <title>OdontoWeb | GHI Tecnologia</title>

  <!-- Bootstrap -->
  <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
  <!-- Custom Theme Style -->
  <link href="css/custom.min.css" rel="stylesheet">

  <link href="css/estilo.css" rel="stylesheet">
</head>

<body class="login">
  <div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>

    <div class="login_wrapper">
      <div class="animate form login_form">
        <section class="login_content">
          <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
            <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response" />
            <h1><i class="fa fa-tooth"></i> OdontoWeb</h1>

            <div class="col-md-12 col-sm-6 col-xs-12 form-group has-feedback">
              <input maxlength="3" type="text" name="clinica" class="form-control has-feedback-left" placeholder="Clínica" required />
              <span class="fa fa-clinic-medical form-control-feedback left" aria-hidden="true"></span>
            </div>

            <div class="col-md-12 col-sm-6 col-xs-12 form-group has-feedback">
              <input maxlength="100" type="email" name="email" class="form-control has-feedback-left" id="email" placeholder="Email" required />
              <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
            </div>

            <div class="col-md-12 col-sm-6 col-xs-12 form-group has-feedback">
              <input maxlength="100" type="password" name="senha" class="form-control has-feedback-left" placeholder="Senha" required />
              <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
            </div>
            <div>
              <input type="submit" class="col-md-9 btn btn-success submit" name="logar" value="Entrar" />
            </div>
            <div class="clearfix"></div>
            <div class="card-footer">
              <div class="d-flex justify-content-center erro_entrar">
                <br>
                <?php
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
                ?>
              </div>
            </div>
            <div class="separator">
              <div class="clearfix"></div><br />
              <a href="http://www.ghitecnologia.com.br" target="_blank">
                <img width="100px" src="./img/ghi.png" />
              </a>
            </div>
          </form>
        </section>
      </div>
    </div>
  </div>

  <!-- jQuery -->
  <script src="vendors/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- FastClick -->
  <script src="vendors/fastclick/lib/fastclick.js"></script>
  <!-- NProgress -->
  <script src="vendors/nprogress/nprogress.js"></script>
  <!-- Custom Theme Scripts -->
  <script src="js/custom.min.js"></script>

  <script src="https://www.google.com/recaptcha/api.js?render=<?= FRONT_END_KEY ?>"></script>
  <script src="recaptcha/recaptcha.js"></script>
  <script src="https://kit.fontawesome.com/44f5bae32e.js" crossorigin="anonymous"></script>
</body>

</html>