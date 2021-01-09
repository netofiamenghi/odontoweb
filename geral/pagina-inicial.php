<?php

include_once '../util/conexao.php';

$_SESSION['ger_msg'] = "";

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
    <!-- FullCalendar -->
    <link href="../css/fullcalendar/core/main.css" rel="stylesheet">
    <link href="../css/fullcalendar/daygrid/main.css" rel="stylesheet">
    <link href="../css/fullcalendar/list/main.css" rel="stylesheet">
    <link href="../css/fullcalendar/timegrid/main.css" rel="stylesheet">

    <link href="../css/estilo.css" rel="stylesheet">

</head>

<body class="nav-md">
    <?php
    include_once '../layout/cabecalho.php';
    ?>

    <!-- page content -->
    <div class="right_col" role="main">


        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Agendamento de Consultas <small>Clique para adicionar/editar</small></h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12">
                    <div class="x_panel">
                        <div class="x_content">

                            <div id='calendar'></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br />
    </div>
    <!-- /page content -->

    <!-- calendar modal -->

    <div id="visualizar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel2">Detalhes do Agendamento</h4>
                </div>
                <div class="modal-body">
                    <div class="visagendamento">
                        <dl class="row">
                            <dt class="col-sm-1">Código:</dt>
                            <dt class="col-sm-11" id="id"></dt>
                        </dl>
                        <dl class="row">
                            <dt class="col-sm-1">Descrição:</dt>
                            <dt class="col-sm-11" id="title"></dt>
                        </dl>
                        <dl class="row">
                            <dt class="col-sm-1">Início:</dt>
                            <dt class="col-sm-11" id="start"></dt>
                        </dl>
                        <dl class="row">
                            <dt class="col-sm-1">Término:</dt>
                            <dt class="col-sm-11x" id="end"></dt>
                        </dl>
                        <button class="btn btn-warning btn-editar">Editar</button>
                        <a href="" id="btnapagar" class="btn btn-danger">Apagar</a>
                    </div>
                    <div class="formedit">
                        <form id="editAgendamento" method="POST">
                            <input type="hidden" name="id" id="id" />
                            <dl class="row">
                                <dt class="col-sm-1">Código:</dt>
                                <dt class="col-sm-11" id="id"></dt>
                            </dl>
                            <dl class="row">
                                <dt class="col-sm-1">Descrição:</dt>
                                <dt class="col-sm-11" id="title"></dt>
                            </dl>
                            <dl class="col-md-6">
                                <label for="inicio">Início</label>
                                <input type="text" class="form-control" name="inicio" id="inicio" onkeypress="DataHora(event, this)" />
                            </dl>
                            <dl class="col-md-6">
                                <label for="termino">Término</label>
                                <input type="text" class="form-control" name="termino" id="termino" onkeypress="DataHora(event, this)" /><br>
                            </dl>
                            <button type="button" class="btn btn-warning btn-cancelar">Cancelar</button>
                            <button type="submit" class="btn btn-success" name="btnsalvar" id="btnsalvar"><i class="fa fa-save"></i> Salvar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="cadastrar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div id="cad-agendamento">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel2">Cadastrar Agendamento</h4>
                    </div>
                    <div class="modal-body">
                        <form id="addAgendamento" method="POST">
                            <input type="hidden" name="paciente" id="paciente" />
                            <div class="col-md-12">
                                <div class="col-md-10">
                                    <label for="paciente">Pesquisa</label>
                                    <input class="form-control" type="text" name="pesquisa-paciente" id="pesquisa-paciente" placeholder="Digite o nome do paciente" />
                                </div>
                                <div class="col-md-2">
                                    <br>
                                    <button type="button" class="btn btn-success btn-form-inserir"><i class="fa fa-plus"></i></button>
                                </div>
                                <div class="col-md-12">
                                    <small>Clique no resultado para selecionar</small>
                                    <ul class="paciente"></ul>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="inicio">Paciente Selecionado</label>
                                <input type="text" class="form-control" name="nomepaciente" id="nomepaciente" /><br>
                            </div>
                            <div class="col-md-12">
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
                            <div class="col-md-6">
                                <label for="inicio">Início</label>
                                <input type="text" class="form-control" name="inicio" id="inicio" onkeypress="DataHora(event, this)" />
                            </div>
                            <div class="col-md-6">
                                <label for="termino">Término</label>
                                <input type="text" class="form-control" name="termino" id="termino" onkeypress="DataHora(event, this)" /><br>
                            </div>
                            <div class="col-md-6">
                                <label for="tipo">Tipo de Agendamento</label>
                                <select class="form-control" name="tipo" id="tipo">
                                    <option value="CIRURGIA">CIRURGIA</option>
                                    <option value="CONSULTA">CONSULTA</option>
                                    <option value="CONSULTA GRATIS">CONSULTA GRATIS</option>
                                    <option value="ENCAMINHAMENTO">ENCAMINHAMENTO</option>
                                    <option value="TRATAMENTO">TRATAMENTO</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="obs">Observação</label>
                                <textarea class="form-control" name="obs" id="obs"></textarea><br>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success" name="btnsalvar" id="btnsalvar"><i class="fa fa-save"></i> Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div id="cad-paciente">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel2">Cadastrar Paciente</h4>
                    </div>
                    
                    <div class="modal-body">
                    <span id="msg-cad"></span><br>    
                        <form id="addPaciente" method="POST">
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
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success" name="btnsalvar" id="btnsalvar"><i class="fa fa-save"></i> Salvar</button>
                                <button type="button" class="btn btn-warning btn-form-voltar"><i class="fa fa-reply"></i> Voltar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- /calendar modal -->



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
    <!-- FullCalendar -->
    <script src="../js/fullcalendar/core/main.js"></script>
    <script src="../js/fullcalendar/daygrid/main.js"></script>
    <script src="../js/fullcalendar/interaction/main.js"></script>
    <script src="../js/fullcalendar/list/main.js"></script>
    <script src="../js/fullcalendar/timegrid/main.js"></script>
    <script src="../js/fullcalendar/core/locales/pt-br.js"></script>

    <script src="../js/pagina-inicial.js"></script>

    <!-- < !-- Pesquisas modal -->
    <script src="../js/pesquisas-modal.js"></script>

    <!-- jquery.inputmask -->
    <script src="../vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>

    <!-- CEP -->
    <script src="../js/funcoes.js"></script>
</body>

</html>