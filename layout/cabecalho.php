<?php

if (!isset($_SESSION['admin'])) :
    header('Location: ../index.php');
endif;

if(time() - $_SESSION['MINHA_SESSAO'] > 7200):
    $_SESSION['msg'] = "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button>
                            Sessão expirou! Faça o login novamente!
                        </div>";
    header('Location: ../index.php');
endif;

?>
<!-- Custom fonts for this template-->
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="../geral/pagina-inicial.php" class="site_title"><i class="fa fa-tooth"></i> <span><?= $_SESSION['clinica'] ?></span></a>
                </div>

                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                <div class="profile clearfix">
                    <!-- <div class="profile_pic">
                        <img src="../img/img.jpg" alt="..." class="img-circle profile_img">
                    </div> -->
                    <div class="profile_info">
                        <span>Bem-vindo,</span>
                        <h2><?= $_SESSION['nomeUsuario'] ?></h2>
                    </div>
                </div>
                <!-- /menu profile quick info -->
                <br />
                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <h3>OdontoWeb - <?= $_SESSION['versao'] ?></h3>
                        <ul class="nav side-menu">
                            <li><a href="../geral/pagina-inicial.php"><i class="fa fa-home"></i> Início </a></li>
                            <li><a><i class="fa fa-pencil"></i> Cadastros <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <?= $_SESSION['ger_clinica'] == 'L' ? '<li><a href="../clinica/clinica.php">Clínica</a></li>' : '' ?>
                                    <?= $_SESSION['ger_dentista'] == 'L' ? '<li><a href="../dentista/listar-dentista.php">Dentista</a></li>' : '' ?>
                                    <?= $_SESSION['ger_fornecedor'] == 'L' ? '<li><a href="../fornecedor/listar-fornecedor.php">Fornecedor</a></li>' : '' ?>
                                    <?= $_SESSION['ger_funcionario'] == 'L' ? '<li><a href="../funcionario/listar-funcionario.php">Funcionários</a></li>' : '' ?>
                                    <?= $_SESSION['ger_grupo'] == 'L' ? '<li><a href="../grupo-usuario/listar-grupo-usuario.php">Grupos de Usuários</a></li>' : '' ?>
                                    <?= $_SESSION['ger_paciente'] == 'L' ? '<li><a href="../paciente/listar-paciente.php">Pacientes</a></li>' : '' ?>
                                    <?= $_SESSION['ger_produto'] == 'L' ? '<li><a href="../produto/listar-produto.php">Produtos</a></li>' : '' ?>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-line-chart"></i> Relatórios <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                <?= $_SESSION['ger_dentista'] == 'L' ? '<li><a href="../dentista/config-rel-dentista.php">Dentistas</a></li>' : '' ?>
                                <?= $_SESSION['ger_fornecedor'] == 'L' ? '<li><a href="../fornecedor/config-rel-fornecedor.php">Fornecedor</a></li>' : '' ?>
                                <?= $_SESSION['ger_funcionario'] == 'L' ? '<li><a href="../funcionario/config-rel-funcionario.php">Funcionários</a></li>' : '' ?>
                                <?= $_SESSION['ger_grupo'] == 'L' ? '<li><a href="../grupo-usuario/config-rel-grupo-usuario.php">Grupos de Usuários</a></li>' : '' ?>
                                <?= $_SESSION['ger_paciente'] == 'L' ? '<li><a href="../paciente/config-rel-paciente.php">Pacientes</a></li>' : '' ?>
                                <?= $_SESSION['ger_produto'] == 'L' ? '<li><a href="../produto/config-rel-produto.php">Produtos</a></li>' : '' ?>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /sidebar menu -->

                <!-- /menu footer buttons -->
                <div class="sidebar-footer hidden-small">
                    <a data-toggle="tooltip" data-placement="top" title="Início" href="../geral/pagina-inicial.php">
                        <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="Novidades" href="../geral/novidades-versao.php">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="Suporte Técnico" href="../geral/suporte.php">
                        <span class="glyphicon glyphicon-earphone" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="Sair" href="../logout.php">
                        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                    </a>
                </div>
                <!-- /menu footer buttons -->
            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="">
                            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <!-- <img src="../img/img.jpg" alt=""> -->
                                <?= $_SESSION['nomeUsuario'] ?>
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">
                                <li><a href="../geral/novidades-versao.php"><i class="fa fa-exclamation-circle pull-right"></i> Novidades da Versão</a></li>
                                <li><a href="../geral/suporte.php"><i class="fa fa-phone pull-right"></i> Suporte Técnico</a></li>
                                <li><a href="../logout.php"><i class="fa fa-power-off pull-right"></i> Sair</a></li>
                            </ul>
                        </li>
                        <li>
                            <a target="_blank" href="https://api.whatsapp.com/send?phone=5517997941983">
                                <img width="70px" style="border-radius: 10px;" src="../img/Whatsapp.jpg" alt="" class="img-responsive">
                            </a>
                        </li>
                        <li>
                            <br>+55 17 99794 1983 &nbsp;
                        </li>
                        <li>
                            <br>Suporte Técnico: &nbsp;&nbsp;
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- /top navigation -->

        <script src="https://kit.fontawesome.com/44f5bae32e.js" crossorigin="anonymous"></script>