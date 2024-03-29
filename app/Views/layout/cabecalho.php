<!DOCTYPE html>
<html lang="en">

<head>
    <title>Flat Able - Premium Admin Template by Phoenixcoded</title>
    <!-- HTML5 Shim and Respond.js IE11 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 11]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="Phoenixcoded" />
   
    <!-- Favicon icon -->
    <link rel="icon" href="<?= base_url() ?>assets/images/favicon.ico" type="image/x-icon">

    <!-- vendor css -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css">
    
    <link href="
    https://cdn.jsdelivr.net/npm/icheck-material@1.0.1/icheck-material.min.css
    " rel="stylesheet">
    <link rel="stylesheet" href="<?=base_url();?>assets/toastr/toastr.min.css">
    
    <link rel="stylesheet" href="<?php //base_url() ?>assets/datatables/datatables.min.css">
    <script src="<?php //base_url('assets/jquery/jquery.min.js'); ?>"></script>

    <style>
        .main_clear_bt {
            min-width: 125px;
            height: auto;
            float: left;
            background: #546252;
            text-align: center;
            color: #FFF;
            padding: 10px 25px;
            font-size: 16px;
            border-radius: 25px;
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

        .main_print_bt {
            min-width: 125px;
            height: auto;
            float: left;
            background: #0254A4;
            text-align: center;
            color: #FFF;
            padding: 10px 25px;
            font-size: 16px;
            border-radius: 25px;
            border: none;
            transition: ease all 0.5s;
            cursor: pointer;
            font-weight: 300;
        }

        button.main_print_bt {
            float: none;
            margin: 0;
        }

        .main_print_bt:hover,
        .main_print_bt:focus {
            background: #33A7D8;
            color: #fff;
        }

        .main_back_bt {
            min-width: 125px;
            height: auto;
            float: left;
            background: #F37027;
            text-align: center;
            color: #FFF;
            padding: 10px 25px;
            font-size: 16px;
            border-radius: 25px;
            border: none;
            transition: ease all 0.5s;
            cursor: pointer;
            font-weight: 300;
            margin-right: 10px;

        }

        button.main_back_bt {
            float: none;
            margin: 0;
        }

        .main_back_bt:hover,
        .main_back_bt:focus {
            background: #F9A54B;
            color: #fff;
        }

        .main_bt {
            min-width: 125px;
            height: auto;
            float: left;
            background: #1ed085;
            text-align: center;
            color: #fff;
            padding: 10px 25px;
            font-size: 16px;
            border-radius: 25px;
            border: none;
            transition: ease all 0.5s;
            cursor: pointer;
            font-weight: 300;
        }

        button.main_bt {
            float: none;
            margin: 0;
        }

        .main_bt:hover,
        .main_bt:focus {
            background: #009345;
            color: #fff;
        }
        .main_dropdown_bt {
            min-width: 125px;
            height: auto;
            float: left;
            background: #20c997;
            text-align: center;
            color: #fff;
            padding: 10px 25px;
            font-size: 16px;
            border-radius: 25px;
            border: none;
            transition: ease all 0.5s;
            cursor: pointer;
            font-weight: 300;
        }

        button.main_dropdown_bt {
            float: none;
            margin: 0;
        }

        .main_dropdown_bt:hover,
        .main_dropdown_bt:focus {
            background: #1abc9c;
            color: #fff;
        }

        .required {
            border: 2px solid red;
        }
    </style>


</head>