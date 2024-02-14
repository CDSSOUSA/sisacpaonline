<!DOCTYPE html>
<html lang="en">

<head>
   <!-- basic -->
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <!-- mobile metas -->
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="viewport" content="initial-scale=1, maximum-scale=1">
   <!-- site metas -->
   <title>Pluto - Responsive Bootstrap Admin Panel Templates</title>
   <meta name="keywords" content="">
   <meta name="description" content="">
   <meta name="author" content="">
   <!-- site icon -->
   <link rel="icon" href="<?= base_url(); ?>assets/images/fevicon.png" type="image/png" />
   <!-- bootstrap css -->
   <link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap.min.css" />
   <!-- site css -->
   <link rel="stylesheet" href="<?= base_url(); ?>assets/style.css" />
   <!-- responsive css -->
   <link rel="stylesheet" href="<?= base_url(); ?>assets/css/responsive.css" />
   <!-- color css -->
   <link rel="stylesheet" href="<?= base_url(); ?>assets/css/colors.css" />
   <!-- select bootstrap -->
   <link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap-select.css" />
   <!-- scrollbar css -->
   <link rel="stylesheet" href="<?= base_url(); ?>assets/css/perfect-scrollbar.css" />
   <!-- custom css -->
   <link rel="stylesheet" href="<?= base_url(); ?>assets/css/custom.css" />
   <!-- calendar file css -->
   <link rel="stylesheet" href="<?= base_url(); ?>assets/js/semantic.min.css" />
   <link href="
https://cdn.jsdelivr.net/npm/icheck-material@1.0.1/icheck-material.min.css
" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
   <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
   <style>
      input,
      select {
         border-top: none !important;
         border-left: none !important;
         border-right: none !important;
         border-bottom: solid #ddd 2px !important;
         line-height: normal !important;
         font-weight: 300 !important;
         transition: ease all 0.5s !important;
      }

      input:hover,
      input:focus,
      select:focus {
         box-shadow: none !important;
         transition: ease all 0.5s !important;
         border-bottom: solid blue 2px !important;
      }

      .login_form .field label.form-check-label .form-check-input {
         width: auto;
      }

      .main_clear_bt {
         min-width: 125px;
         height: auto;
         float: left;
         background: #546252;
         text-align: center;
         color: #FFF;
         padding: 10px 25px;
         font-size: 16px;
         border-radius: 5px;
         border: none;
         transition: ease all 0.5s;
         cursor: pointer;
         font-weight: 300;
      }

      button.main_clear_bt {
         float: none;
         margin: 0;
      }

      .main_clear_bt:hover,
      .main_clear_bt:focus {
         background: #222;
         color: #fff;
      }
   </style>
</head>