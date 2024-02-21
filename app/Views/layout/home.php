<?= view("layout/cabecalho"); ?>
<body class="">
	<!-- [ Pre-loader ] start -->
	<div class="loader-bg">
		<div class="loader-track">
			<div class="loader-fill"></div>
		</div>
	</div>
	<!-- [ Pre-loader ] End -->
	<!-- [ navigation menu ] start -->
	<nav class="pcoded-navbar  ">
		<div class="navbar-wrapper  ">
			<div class="navbar-content scroll-div " >
				
				<div class="">
					<div class="main-menu-header">
						<img class="img-radius" src="<?=base_url()?><?=base_url()?>assets/images/user/avatar-2.jpg" alt="User-Profile-Image">
						<div class="user-details">
							<span>John Doe</span>
							<div id="more-details">UX Designer<i class="fa fa-chevron-down m-l-5"></i></div>
						</div>
					</div>
					<div class="collapse" id="nav-user-link">
						<ul class="list-unstyled">
							<li class="list-group-item"><a href="user-profile.html"><i class="feather icon-user m-r-5"></i>View Profile</a></li>
							<li class="list-group-item"><a href="#!"><i class="feather icon-settings m-r-5"></i>Settings</a></li>
							<li class="list-group-item"><a href="auth-normal-sign-in.html"><i class="feather icon-log-out m-r-5"></i>Logout</a></li>
						</ul>
					</div>
				</div>
				
				<ul class="nav pcoded-inner-navbar ">
					<li class="nav-item pcoded-menu-caption">
						<label>Menu principal</label>
					</li>
                  
                   
					<li class="nav-item">
                        <?php echo anchor('form_alterar_senha_usuario/' . session()->get('idOperadorSistema'), 
                            '<span class="pcoded-micon">
                                <i class="feather icon-home"></i>
                            </span>
                            <span class="pcoded-mtext">
                                    Alterar Senha
                            </span>', 
                        ['class' => 'nav-link']); ?>                   
					</li>
                    <?php foreach (session()->get('menu')as $menus):?>
                    
                        <li class="<?php echo ($pasta == mb_strtolower(tratarPalavras($menus->descricao))) ? 'active' : ''; ?> nav-item pcoded-hasmenu">
                            <a href="javascript:void(0);" class="nav-link" data-toggle="dropdown">
                                <span class="pcoded-micon"><i class="feather icon-layout"></i></span>
                                <span class="pcoded-mtext"><?php echo $menus->descricao; ?></span></span>
                            </a>
                            <ul class="pcoded-submenu">
                                <?php
                                $itemMenu = session()->get('itemMenu');                           

                                foreach ($itemMenu  as $item) {
                                    //echo $item->possuiSubMenu;
                                    if ($item->idMenu == $menus->idMenu) {
                                        if ($item->possuiSubMenu == 'S') {
                                            echo '<li>' . anchor($menus->link.'/'.$item->link, $item->nomeMenu, array('target' => '_blank')) . '</li>';
                                        } else {
                                            echo '<li>' . anchor($menus->link.'/'.$item->link,$item->nomeMenu) . '</li>';
                                        }
                                    }
                                }
                                ?>

                            </ul>
                        </li>
                    <?php endforeach?>

                    <li class="nav-item pcoded-hasmenu">
                        <a href="javascript:void(0);" class="nav-link">
                            <span class="pcoded-micon"><i class="feather icon-layout"></i></span>
                            <span class="pcoded-mtext">RELATÓRIOS</span></span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li class="nav-item pcoded-hasmenu">
                                <a href="javascript:void(0);" class="nav-link">                                    
                                    <span>USUÁRIO</span>
                                </a>
                                <ul class="pcoded-submenu">
                                    <?php echo '<li>' . anchor('rel_usuario_faixa_etaria', '<span> Faixa-etária </span>') . '</li>'; ?>
                                    <?php echo '<li>' . anchor('rel_dados_usuario_filiacao', '<span> Filiação </span>') . '</li>'; ?>
                                    <?php echo '<li>' . anchor('imprimir_usuario_genero', '<span> Gênero </span>', array('target' => '_blank')) . '</li>'; ?>
                                    <?php echo '<li>' . anchor('imprimir_usuario_telefone', '<span> Telefone </span>', array('target' => '_blank')) . '</li>'; ?>
                                    <?php echo '<li>' . anchor('rel_usuario_matriculado', '<span> Matriculados <span style=color:red> [Ativos]</span>' . '</span>') . '</li>'; ?>
                                    <?php echo '<li>' . anchor('rel_usuario_desligado', '<span> Desligados <span style=color:red> [Inativos]</span>' . '</span>') . '</li>'; ?>
                                    <?php echo '<li>' . anchor('rel_usuario_cidade', '<span> Cidade </span>').'</li>'; ?>
                                    <?php echo '<li>' . anchor('imprimir_usuario_completo/ativos', '<span> Completo </span>', array('target' => '_blank')) . '</li>'; ?>
                                </ul>
                            </li>
                            
                            <li class="nav-item pcoded-hasmenu">
                                <a href="javascript:void(0);" class="nav-link">                                    
                                    <span>ATENDIMENTOS</span>
                                </a>
                                <ul class="pcoded-submenu">
                                    <?php echo '<li>' . anchor('imprimir_atendimento_modalidade', '<span>' . 'Modalidade' . '</span>', array('target' => '_blank')) . '</li>'; ?>
                                    <?php echo '<li>' . anchor('imprimir_atendimento_dia_semana', '<span>' . 'Dia semana' . '</span>', array('target' => '_blank')) . '</li>'; ?>
                                    <?php echo '<li>' . anchor('imprimir_atendimento_profissional', '<span>' . 'Profissional' . '</span>', array('target' => '_blank')) . '</li>'; ?>
                                    <?php echo '<li>' . anchor('rel_atendimento_periodo', '<span>' . 'Período' . '</span>') . '</li>'; ?>
                                   
                                    <li class="nav-item pcoded-hasmen">
                                        <a href="#!" class="nav-link">                                           
                                            <span>Agendados</span>
                                        </a>
                                        <ul class="pcoded-submenu">
                                            <?php
                                            for ($i = 2; $i <= 6; $i++) {
                                                echo '<li>' . anchor('imprimir_atendimento_dia_previsao/' . $i, '<span>' . tratarDiaSemana($i) . '</span>', array('target' => '_blank')) . '</li>';
                                            }
                                            ?>
                                        </ul>
                                    </li>
                                </ul>

                            </li>
                            <li class="nav-item pcoded-hasmenu">
                                <a href="javascript:void(0);" class="nav-link">                                   
                                    <span>EVOLUÇÃO</span>
                                </a>
                                <ul class="pcoded-submenu">
                                    <?php echo '<li>' . anchor('rel_dados_estatistica_evolucao', '<span>' . 'Estatística' . '</span>', array('target' => '_blank')) . '</li>'; ?>
                                 </ul>
                            </li>
                            <li class="nav-item pcoded-hasmenu">
                            <a href="javascript:void(0);" class="nav-link">                               
                                    <span>MODALIDADE</span>
                                </a>
                                <ul class="pcoded-submenu">
                                    <?php echo '<li>' . anchor('rel_modalidade_periodo', ' <span> Período </span>') . '</li>'; ?>
                                </ul>
                            </li>

                            <li class="nav-item pcoded-hasmenu">
                                <a href="javascript:void(0);" class="nav-link">                                   
                                        <span>PROFISSIONAL</span>
                                    </a>
                                <ul class="pcoded-submenu">

                                        <li class="nav-item pcoded-hasmenu">
                                            <a href="javascript:void(0);" class="nav-link">                                               
                                                <span>Desempenho</span>
                                            </a>
                                            <ul class="pcoded-submenu">
                                                <?php
                                                for ($i = 1; $i <= date('m'); $i++) {
                                                    echo '<li>' . anchor('imprimir_desempenho_profissional_mes/' . $i . '/' . date('Y'), '<span>' . tratarMes($i) . '/' . date('Y') . '</span>', array('target' => '_blank')) . '</li>';
                                                }
                                                ?>
                                            </ul>
                                        </li>
                                </ul>
                            </li>

                            <?php echo '
                            <li>' . anchor('imprimir_cidades_atendidas/ativos', '<span>CIDADES ATENDIDAS</span>', array('target' => '_blank')) . '</li>' ?>
                            <?php echo '
                            <li>' . anchor('imprimir_tipo_escola/ativos', '<span>TIPO ESCOLA</span>', array('target' => '_blank')) . '</li>' ?>


                        </ul>
                    </li>                   

                    <li>

                        <?php echo anchor('dashboard/' . date('Y'), '
                            <span class="pcoded-micon">
                                <i class="feather icon-home"></i>
                            </span>
                            <span class="pcoded-mtext">
                                  Dashboard
                            </span>', array('class' => 'nav-item')); ?>
                    </li>
                    <li>
                        <?php echo anchor('logout', '
                                <span class="pcoded-micon">
                                    <i class="feather icon-home"></i>
                                </span>
                                <span class="pcoded-mtext">
                                    Sair
                                </span>', array('class' => 'nav-item')); ?>                      

                    </li>
				</ul>			
				
			</div>
		</div>
	</nav>
	<!-- [ navigation menu ] end -->
	<!-- [ Header ] start -->
	<header class="navbar pcoded-header navbar-expand-lg navbar-light header-dark">
		
			
				<div class="m-header">
					<a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
					<a href="#!" class="b-brand">
						<!-- ========   change your logo hear   ============ -->
						<img src="<?=base_url()?>assets/images/logo.png" alt="" class="logo">
						<img src="<?=base_url()?>assets/images/logo-icon.png" alt="" class="logo-thumb">
					</a>
					<a href="#!" class="mob-toggler">
						<i class="feather icon-more-vertical"></i>
					</a>
				</div>
				<div class="collapse navbar-collapse">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item">
							<a href="#!" class="pop-search"><i class="feather icon-search"></i></a>
							<div class="search-bar">
								<input type="text" class="form-control border-0 shadow-none" placeholder="Search hear">
								<button type="button" class="close" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
						</li>
						<li class="nav-item">
							<div class="dropdown">
								<a class="dropdown-toggle h-drop" href="#" data-toggle="dropdown">
									Dropdown
								</a>
								<div class="dropdown-menu profile-notification ">
									<ul class="pro-body">
										<li><a href="user-profile.html" class="dropdown-item"><i class="fas fa-circle"></i> Profile</a></li>
										<li><a href="email_inbox.html" class="dropdown-item"><i class="fas fa-circle"></i> My Messages</a></li>
										<li><a href="auth-signin.html" class="dropdown-item"><i class="fas fa-circle"></i> Lock Screen</a></li>
									</ul>
								</div>
							</div>
						</li>
						<li class="nav-item">
							<div class="dropdown mega-menu">
								<a class="dropdown-toggle h-drop" href="#" data-toggle="dropdown">
									Mega
								</a>
								<div class="dropdown-menu profile-notification ">
									<div class="row no-gutters">
										<div class="col">
											<h6 class="mega-title">UI Element</h6>
											<ul class="pro-body">
												<li><a href="#!" class="dropdown-item"><i class="fas fa-circle"></i> Alert</a></li>
												<li><a href="#!" class="dropdown-item"><i class="fas fa-circle"></i> Button</a></li>
												<li><a href="#!" class="dropdown-item"><i class="fas fa-circle"></i> Badges</a></li>
												<li><a href="#!" class="dropdown-item"><i class="fas fa-circle"></i> Cards</a></li>
												<li><a href="#!" class="dropdown-item"><i class="fas fa-circle"></i> Modal</a></li>
												<li><a href="#!" class="dropdown-item"><i class="fas fa-circle"></i> Tabs & pills</a></li>
											</ul>
										</div>
										<div class="col">
											<h6 class="mega-title">Forms</h6>
											<ul class="pro-body">
												<li><a href="#!" class="dropdown-item"><i class="feather icon-minus"></i> Elements</a></li>
												<li><a href="#!" class="dropdown-item"><i class="feather icon-minus"></i> Validation</a></li>
												<li><a href="#!" class="dropdown-item"><i class="feather icon-minus"></i> Masking</a></li>
												<li><a href="#!" class="dropdown-item"><i class="feather icon-minus"></i> Wizard</a></li>
												<li><a href="#!" class="dropdown-item"><i class="feather icon-minus"></i> Picker</a></li>
												<li><a href="#!" class="dropdown-item"><i class="feather icon-minus"></i> Select</a></li>
											</ul>
										</div>
										<div class="col">
											<h6 class="mega-title">Application</h6>
											<ul class="pro-body">
												<li><a href="#!" class="dropdown-item"><i class="feather icon-mail"></i> Email</a></li>
												<li><a href="#!" class="dropdown-item"><i class="feather icon-clipboard"></i> Task</a></li>
												<li><a href="#!" class="dropdown-item"><i class="feather icon-check-square"></i> To-Do</a></li>
												<li><a href="#!" class="dropdown-item"><i class="feather icon-image"></i> Gallery</a></li>
												<li><a href="#!" class="dropdown-item"><i class="feather icon-help-circle"></i> Helpdesk</a></li>
											</ul>
										</div>
										<div class="col">
											<h6 class="mega-title">Extension</h6>
											<ul class="pro-body">
												<li><a href="#!" class="dropdown-item"><i class="feather icon-file-plus"></i> Editor</a></li>
												<li><a href="#!" class="dropdown-item"><i class="feather icon-file-minus"></i> Invoice</a></li>
												<li><a href="#!" class="dropdown-item"><i class="feather icon-calendar"></i> Full calendar</a></li>
												<li><a href="#!" class="dropdown-item"><i class="feather icon-upload-cloud"></i> File upload</a></li>
												<li><a href="#!" class="dropdown-item"><i class="feather icon-scissors"></i> Image cropper</a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</li>
					</ul>
					<ul class="navbar-nav ml-auto">
						<li>
							<div class="dropdown">
								<a class="dropdown-toggle" href="#" data-toggle="dropdown">
									<i class="icon feather icon-bell"></i>
									<span class="badge badge-pill badge-danger">5</span>
								</a>
								<div class="dropdown-menu dropdown-menu-right notification">
									<div class="noti-head">
										<h6 class="d-inline-block m-b-0">Notifications</h6>
										<div class="float-right">
											<a href="#!" class="m-r-10">mark as read</a>
											<a href="#!">clear all</a>
										</div>
									</div>
									<ul class="noti-body">
										<li class="n-title">
											<p class="m-b-0">NEW</p>
										</li>
										<li class="notification">
											<div class="media">
												<img class="img-radius" src="<?=base_url()?>assets/images/user/avatar-1.jpg" alt="Generic placeholder image">
												<div class="media-body">
													<p><strong>John Doe</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>5 min</span></p>
													<p>New ticket Added</p>
												</div>
											</div>
										</li>
										<li class="n-title">
											<p class="m-b-0">EARLIER</p>
										</li>
										<li class="notification">
											<div class="media">
												<img class="img-radius" src="<?=base_url()?>assets/images/user/avatar-2.jpg" alt="Generic placeholder image">
												<div class="media-body">
													<p><strong>Joseph William</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>10 min</span></p>
													<p>Prchace New Theme and make payment</p>
												</div>
											</div>
										</li>
										<li class="notification">
											<div class="media">
												<img class="img-radius" src="<?=base_url()?>assets/images/user/avatar-1.jpg" alt="Generic placeholder image">
												<div class="media-body">
													<p><strong>Sara Soudein</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>12 min</span></p>
													<p>currently login</p>
												</div>
											</div>
										</li>
										<li class="notification">
											<div class="media">
												<img class="img-radius" src="<?=base_url()?>assets/images/user/avatar-2.jpg" alt="Generic placeholder image">
												<div class="media-body">
													<p><strong>Joseph William</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>30 min</span></p>
													<p>Prchace New Theme and make payment</p>
												</div>
											</div>
										</li>
									</ul>
									<div class="noti-footer">
										<a href="#!">show all</a>
									</div>
								</div>
							</div>
						</li>
						<li>
							<div class="dropdown drp-user">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="feather icon-user"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-right profile-notification">
									<div class="pro-head">
										<img src="<?=base_url()?>assets/images/user/avatar-1.jpg" class="img-radius" alt="User-Profile-Image">
										<span>John Doe</span>
										<a href="auth-signin.html" class="dud-logout" title="Logout">
											<i class="feather icon-log-out"></i>
										</a>
									</div>
									<ul class="pro-body">
										<li><a href="user-profile.html" class="dropdown-item"><i class="feather icon-user"></i> Profile</a></li>
										<li><a href="email_inbox.html" class="dropdown-item"><i class="feather icon-mail"></i> My Messages</a></li>
										<li><a href="auth-signin.html" class="dropdown-item"><i class="feather icon-lock"></i> Lock Screen</a></li>
									</ul>
								</div>
							</div>
						</li>
					</ul>
				</div>
				
			
	</header>
	<!-- [ Header ] end -->
	
	

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
       
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- [ sample-page ] start -->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5><?=$titulo?></h5>
                        <p class="text-muted mb-1" id="subTitulo">* campos de preeechimento obrigátorio!</p>
                        <div class="card-header-right">
                            <div class="btn-group card-option">
                                <button type="button" class="btn dropdown-toggle btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="feather icon-more-horizontal"></i>
                                </button>
                                <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                    <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
                                    <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
                                    <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a></li>
                                    <li class="dropdown-item close-card"><a href="#!"><i class="feather icon-trash"></i> remove</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                    <?= $this->renderSection('content');?>  
                    </div>
                </div>
            </div>
            <!-- [ sample-page ] end -->
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>


<?= view("layout/rodape"); ?>