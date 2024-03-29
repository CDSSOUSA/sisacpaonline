﻿<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>SISACPA | Sistema de Informação da ACPA</title>
    <!-- Favicon-->
    <link rel="icon" href="<?php echo base_url('img/logo-acpa.ico'); ?>" type="image/x-icon">


<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">



    <link href="<?php echo base_url('plugins/fontawesome-free/css/all.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('dist/css/adminlte.min.css?v=3.2.0'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('css/icon.css'); ?>" rel="stylesheet">
    <link href="<?php //echo base_url('css/font-awesome.css');  
                ?>" rel="stylesheet">

    <!-- Bootstrap Core Css -->
    <link href="<?php echo base_url('plugins/bootstrap/css/bootstrap.css'); ?>" rel="stylesheet">
    
    <!-- Waves Effect Css -->
    <link href="<?php echo base_url('plugins/node-waves/waves.css'); ?>" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?php echo base_url('plugins/animate-css/animate.css'); ?>" rel="stylesheet" />

    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="<?php echo base_url('plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css'); ?>" rel="stylesheet" />

    <!-- Bootstrap DatePicker Css -->
    <link href="<?php echo base_url('plugins/bootstrap-datepicker/css/bootstrap-datepicker.css'); ?>" rel="stylesheet" />


    <!-- JQuery DataTable Css -->
    <link href="<?php echo base_url('plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css'); ?>" rel="stylesheet">

    <!-- Wait Me Css -->
    <link href="<?php echo base_url('plugins/waitme/waitMe.css'); ?>" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <link href="<?php echo base_url('plugins/bootstrap-select/css/bootstrap-select.css'); ?>" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="<?php echo base_url('css/style.css'); ?>" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="<?php echo base_url('css/themes/all-themes.css'); ?>" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <link href="<?php echo base_url('plugins/bootstrap-select/css/bootstrap-select.css'); ?>" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">




    <style>
        #iImagemPrincipal {
            margin: 0 auto;
        }

        .funil {

            position: absolute;
            left: 0;
            top: 0;
            z-index: 9999;
            padding: 20px;
        }

        .table {
            font-size: 12px;
        }

        .table th {
            font-size: 14px;
            font-weight: bold;
            color: black;
        }

        #mostraSenha {
            cursor: pointer;
            pointer-events: all;
        }

        .scrollable {
    max-height: 730px; /* Altura máxima */
    overflow: auto; /* Adiciona a barra de rolagem conforme necessário */
    border: 1px solid #ccc; /* Apenas para visualização */
    padding: 10px;
    box-sizing: border-box;
  }

  /* Estilos para telas menores (até 768px de largura) */
  .scrollable.full-height {
    max-height: none; /* Remova a altura máxima */
    overflow: auto; /* Exiba todo o conteúdo sem barra de rolagem */
  }
  .custom-modal {
      max-height: 400px; /* Altura máxima do modal */
      overflow-y: auto; /* Adiciona uma barra de rolagem vertical se necessário */
    }
    .w-75{
      width: 50px
    }
    .demo-checkbox-new label,
.demo-radio-button label {
  min-width: 90px; }
       
    </style>
    <script>
  // JavaScript para adicionar classe .full-height em telas menores
  window.addEventListener('resize', function() {
    const scrollable = document.querySelector('.scrollable');
    if (window.innerWidth <= 768) {
      scrollable.classList.add('full-height');
    } else {
      scrollable.classList.remove('full-height');
    }
  });
</script>


</head>