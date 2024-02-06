  <?= view("layout/cabecalho"); ?>

  <body class="theme-indigo">
      <!-- Page Loader -->
     
      <!-- #END# Page Loader -->
      <!-- Overlay For Sidebars -->

      <!-- #END# Overlay For Sidebars -->
      <!-- Search Bar -->

      <!-- #END# Search Bar -->
      <!-- Top Bar -->

      <?= view("layout/menu"); ?>

      <!-- #Top Bar -->

      <?=$this->renderSection('content');?>
      
 


      <?= view("layout/rodape"); ?>