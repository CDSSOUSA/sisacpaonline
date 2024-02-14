
<?= view("layout/cabecalho"); ?>

<body class="hold-transition sidebar-mini layout-fixed">
<!-- Site wrapper -->
<div class="wrapper">

<?= view("layout/menu"); ?>
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
      <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">        
          <img src="<?php echo base_url('img/' . (session()->get('fotoPerfil') ?: 'foto-perfil.png')); ?>" class="img-circle elevation-2" width="48" height="48" alt="User" />
        </div>
        <div class="info">
          <a href="#" class="d-block"><?=word_limiter(session()->get('nome'),1,''); ?></a>
          
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-header">MENU PRINCIPAL</li>
               <li class="nav-item">          
                <?php echo anchor('form_alterar_senha_usuario/' . session()->get('idOperadorSistema'), '<i class="nav-icon fas fa-th"></i><p>ALTERAR SENHA<span class="right badge badge-danger">New</span></p>', array('class' => 'nav-link')); ?>
                </li>
                <li role="separator" class="divider"></li>

                <?php foreach(session()->get('menu')as $menus):?>
                <li class="nav-item <?php echo ($pasta == mb_strtolower(tratarPalavras($menus->descricao))) ? 'menu-open' : ''; ?>">
                            <a href="#" class="nav-link <?php echo ($pasta == mb_strtolower(tratarPalavras($menus->descricao))) ? 'active' : ''; ?>">
                                <i class="nav-icon <?php echo $menus->icone; ?>"></i>
                                <p>
                                    <?php echo $menus->descricao; ?>
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">

                            <?php
                                $itemMenu = session()->get('itemMenu');
                            

                                foreach ($itemMenu  as $item) {
                                    //echo $item->possuiSubMenu;
                                    if ($item->idMenu == $menus->idMenu) {
                                        if ($item->possuiSubMenu == 'S') {
                                            echo '<li class="nav-item">' . anchor($menus->link.'/'.$item->link, '<i class="far fa-circle nav-icon"></i><p>' . $item->nomeMenu . '</p>', array('target' => '_blank', 'class'=>'nav-link'. $item->link == 'form_cadastrar_profissional' ? 'active' : "")).'</li>';
                                        } else {
                                            echo '<li class="nav-item">' . anchor($menus->link.'/'.$item->link, '<i class="far fa-circle nav-icon"></i><p>' . $item->nomeMenu . '</p>',["class"=> $linkMenu == $item->link ? 'nav-link active' : "nav-link"]) . '</li>';
                                        }
                                    }
                                }
                                ?>
                                
                            </ul>
            <?php endforeach;?>

            <li class="nav-item">

            <?php echo anchor('dashboard/' . date('Y'), '<i class="nav-icon fas fa-tachometer-alt"></i><p>DASHBOARDS</p>', array('class' => 'nav-link')); ?>
            <?php echo anchor('logout/', '<i class="nav-icon fas fa-tachometer-alt"></i><p>SAIR</p>', array('class' => 'nav-link')); ?>
                

                         </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../../index.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v1</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../index2.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v2</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../index3.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v3</p>
                </a>
              </li>
            </ul>
          </li>      
        
          
         
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

  <?=$this->renderSection('content');?>
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


<?= view("layout/rodape"); ?>