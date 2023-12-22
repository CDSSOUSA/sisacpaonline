<!-- Overlay For Sidebars -->

<!-- #END# Overlay For Sidebars -->
<!-- Search Bar -->

<!-- #END# Search Bar -->
<!-- Top Bar -->
<nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
            <a href="javascript:void(0);" class="bars"></a>
            <?php echo anchor('dashboard/' . date('Y'), 'SISACPA - Sistema de Informaçao da ACPA', array('class' => 'navbar-brand')); ?>
            <?php
            /* $imagemPrincipal = array('src' => 'img/logo-acpa.png', 'class' => 'img-responsive','width'=>'48', 'id' => 'iImagemPrincipal');
              echo img($imagemPrincipal); */
            ?>

        </div>


    </div>
</nav>
<!-- #Top Bar -->
<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <div class="user-info">
            <div class="image">
                <img src="<?php echo base_url('img/' . (session()->get('fotoPerfil') ?: 'foto-perfil.png')); ?>" width="48" height="48" alt="User" />
            </div>

            <div class="info-container">
                <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?=word_limiter(session()->get('nome'),1,''); ?></div>
                <div class="email"><?php echo mascaraCpf(session()->get('login')); ?></div>
                <div class="btn-group user-helper-dropdown">
                    <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                    <ul class="dropdown-menu pull-right">
                        <li><?php echo anchor('form_alterar_senha_usuario/' . session()->get('idOperadorSistema'), '<i class="material-icons">person</i>Alterar senha'); ?>
                        <li role="separator" class="divider"></li>
                        <li><?php echo anchor('logout', '<i class="material-icons">input</i> Sair'); ?></li>
                    </ul>

                </div>

            </div>
        </div>
        <!-- #User Info -->
        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                <li class="header">Menu principal</li>
                <?php echo anchor('form_alterar_senha_usuario/' . session()->get('idOperadorSistema'), '<i class="material-icons">vpn_key</i><span>ALTERAR SENHA</span>', array('class' => 'waves-effect waves-block')); ?>

                <li role="separator" class="divider"></li>

                <?php     
                  
                
                foreach (session()->get('menu')as $menus) {
                ?>
                    <li class="<?php echo ($pasta == mb_strtolower(tratarPalavras($menus->descricao))) ? 'active' : ''; ?>">
                        <a href="javascript:void(0);" class="menu-toggle " data-toggle="dropdown">
                            <i class="material-icons"><?php echo $menus->icone; ?></i>
                            <span><?php echo $menus->descricao; ?></span></a>
                        <ul class="ml-menu">
                            <?php
                            $itemMenu = session()->get('itemMenu');
                           

                            foreach ($itemMenu  as $item) {
                                //echo $item->possuiSubMenu;
                                if ($item->idMenu == $menus->idMenu) {
                                    if ($item->possuiSubMenu == 'S') {
                                        echo '<li>' . anchor($menus->link.'/'.$item->link, '<i class="material-icons col-grey">layers</i><span>' . $item->nomeMenu . '</span>', array('target' => '_blank')) . '</li>';
                                    } else {
                                        echo '<li>' . anchor($menus->link.'/'.$item->link, '<i class="material-icons col-grey">layers</i><span>' . $item->nomeMenu . '</span>') . '</li>';
                                    }
                                }
                            }
                            ?>

                        </ul>
                    </li>
                <?php }
                ?>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons col-teal">equalizer</i>
                        <span class="col-teal">RELATÓRIOS</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="javascript:void(0);" class="menu-toggle">
                                <i class="material-icons">equalizer</i><span>USUÁRIO</span>
                            </a>
                            <ul class="ml-menu">

                                <?php echo '<li>' . anchor('rel_usuario_faixa_etaria', '<i class="material-icons col-grey">layers</i><span>' . 'Faixa-etária' . '</span>') . '</li>'; ?>
                                <?php echo '<li>' . anchor('rel_dados_usuario_filiacao', '<i class="material-icons col-grey">layers</i><span>' . 'Filiação' . '</span>') . '</li>'; ?>
                                <?php echo '<li>' . anchor('imprimir_usuario_genero', '<i class="material-icons col-grey">layers</i><span>' . 'Gênero' . '</span>', array('target' => '_blank')) . '</li>'; ?>
                                <?php echo '<li>' . anchor('imprimir_usuario_telefone', '<i class="material-icons col-grey">layers</i><span>' . 'Telefone' . '</span>', array('target' => '_blank')) . '</li>'; ?>
                                <?php echo '<li>' . anchor('rel_usuario_matriculado', '<i class="material-icons col-grey">layers</i><span>' . 'Matriculados <span style=color:red> [Ativos]</span>' . '</span>') . '</li>'; ?>
                                <?php echo '<li>' . anchor('rel_usuario_desligado', '<i class="material-icons col-grey">layers</i><span>' . 'Desligados <span style=color:red> [Inativos]</span>' . '</span>') . '</li>'; ?>
                                <?php echo '<li>' . anchor('rel_usuario_cidade', '<i class="material-icons col-grey">layers</i><span>' . 'Cidade' . '</span>') . '</li>'; ?>
                                <?php echo '<li>' . anchor('imprimir_usuario_completo/ativos', '<i class="material-icons col-grey">layers</i><span>' . 'Completo' . '</span>', array('target' => '_blank')) . '</li>'; ?>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript:void(0);" class="menu-toggle">
                                <i class="material-icons">equalizer</i><span>ATENDIMENTOS</span>
                            </a>
                            <ul class="ml-menu">
                                <?php echo '<li>' . anchor('imprimir_atendimento_modalidade', '<i class="material-icons col-grey">layers</i><span>' . 'Modalidade' . '</span>', array('target' => '_blank')) . '</li>'; ?>
                                <?php echo '<li>' . anchor('imprimir_atendimento_dia_semana', '<i class="material-icons col-grey">layers</i><span>' . 'Dia semana' . '</span>', array('target' => '_blank')) . '</li>'; ?>
                                <?php echo '<li>' . anchor('imprimir_atendimento_profissional', '<i class="material-icons col-grey">layers</i><span>' . 'Profissional' . '</span>', array('target' => '_blank')) . '</li>'; ?>
                                <?php echo '<li>' . anchor('rel_atendimento_periodo', '<i class="material-icons col-grey">layers</i><span>' . 'Período' . '</span>') . '</li>'; ?>
                                <li>
                                    <a href="javascript:void(0);" class="menu-toggle">
                                        <i class="material-icons col-grey">equalizer</i><span><span>Agendados</span>
                                    </a>
                                    <ul class="ml-menu">

                                        <?php
                                        for ($i = 2; $i <= 6; $i++) {
                                            echo '<li>' . anchor('imprimir_atendimento_dia_previsao/' . $i, '<i class="material-icons col-grey">layers</i><span>' . tratarDiaSemana($i) . '</span>', array('target' => '_blank')) . '</li>';
                                        }
                                        ?>
                                    </ul>
                                </li>
                            </ul>

                        </li>
                        <li>
                            <a href="javascript:void(0);" class="menu-toggle">
                                <i class="material-icons">equalizer</i><span>EVOLUÇÃO</span>
                            </a>
                            <ul class="ml-menu">
                                <?php echo '<li>' . anchor('rel_dados_estatistica_evolucao', '<i class="material-icons col-grey">layers</i><span>' . 'Estatística' . '</span>', array('target' => '_blank')) . '</li>'; ?>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="menu-toggle">
                                <i class="material-icons">equalizer</i>
                                <span>MODALIDADE</span>
                            </a>
                            <ul class="ml-menu">
                                <?php echo '<li>' . anchor('rel_modalidade_periodo', '<i class="material-icons col-grey">layers</i><span> Período </span>') . '</li>'; ?>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript:void(0);" class="menu-toggle">
                                <i class="material-icons">equalizer</i>
                                <span>PROFISSIONAL</span>
                            </a>
                            <ul class="ml-menu">

                                <li>
                                    <a href="javascript:void(0);" class="menu-toggle">
                                        <i class="material-icons col-grey">equalizer</i><span>Desempenho</span>
                                    </a>
                                    <ul class="ml-menu">

                                        <?php
                                        for ($i = 1; $i <= date('m'); $i++) {
                                            echo '<li>' . anchor('imprimir_desempenho_profissional_mes/' . $i . '/' . date('Y'), '<i class="material-icons col-grey">layers</i><span>' . tratarMes($i) . '/' . date('Y') . '</span>', array('target' => '_blank')) . '</li>';
                                        }
                                        ?>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <?php echo '<li>' . anchor('imprimir_cidades_atendidas/ativos', '<i class="material-icons">equalizer</i><span>CIDADES ATENDIDAS</span>', array('target' => '_blank')) . '</li>' ?>
                        <?php echo '<li>' . anchor('imprimir_tipo_escola/ativos', '<i class="material-icons">equalizer</i><span>TIPO ESCOLA</span>', array('target' => '_blank')) . '</li>' ?>


                    </ul>
                </li>

                <li>

                    <?php echo anchor('dashboard/' . date('Y'), '<i class="material-icons">dashboard</i><span>DASHBOARDS</span>', array('class' => 'waves-effect waves-block')); ?>
                    <?php echo anchor('logout', '<i class="material-icons">exit_to_app</i><span>SAIR</span>', array('class' => 'waves-effect waves-block')); ?>

                </li>
            </ul>
        </div>
        <!-- #Menu -->
        <!-- Footer -->
        <div class="legal">
            <div class="copyright">
                &copy; 2019 - <?php echo date('Y') . ' ' . anchor('dashboard/' . date('Y'), '[ACPA]'); ?>
            </div>

            <div class="version">
                <b>Version: </b> 01.01.20 <br> <span style="font-size: 10px" ;>por cleberdossantossousa@gmail.com <br> (83) 98796-9712</span>
            </div>
        </div>
        <!-- #Footer -->
    </aside>
    <!-- #END# Left Sidebar -->
    <!-- Right Sidebar -->

    <!-- #END# Right Sidebar -->
</section>