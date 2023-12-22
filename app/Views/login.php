<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>SISACPA | Sistema de Informação da ACPA</title>
    <!-- Favicon-->
    <link rel="icon" href="<?php echo base_url('img/logo-acpa.ico'); ?>" type="image/x-icon">


    <link href="<?php echo base_url('css/font-awesome.min.css'); ?>" rel="stylesheet">

    <link href="<?php echo base_url('css/icon.css'); ?>" rel="stylesheet">

    <!-- Bootstrap Core Css -->
    <link href="<?php echo base_url('plugins/bootstrap/css/bootstrap.css'); ?>" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?php echo base_url('plugins/node-waves/waves.css'); ?>" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?php echo base_url('plugins/animate-css/animate.css'); ?>" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="<?php echo base_url('css/style.css'); ?>" rel="stylesheet">

    <style>
    
    #password + .glyphicon {
   cursor: pointer;
   pointer-events: all;
 }
 #mostraSenha{
    cursor: pointer;
   pointer-events: all;
 }

/* Styles for CodePen Demo Only */

    </style>

</head>

<body class="signup-page bg-indigo">
    <div class="signup-box ">
        <div class="logo text-center">
            <?php
                $imgLogo = array(
                    'src' => 'img/logo-acpa.png',
                    'alt' => 'logo da ACPA',
                    'width' => '150px',
                    'text-align' => 'center'
                );
                echo img($imgLogo);
                
                ?>
            <a href="javascript:void(0);"></a>
            <small class="font-16"><b>Associação Campinense de Pais de Autistas</b></small>
        </div>
        <div class="card">
            <?php 
                
                // if ($this->session->flashdata('sucesso')) {
                //     echo '<div class="alert alert-show-60000 bg-teal alert-dismissible" role="alert">
                //     <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.
                //     $this->session->flashdata('sucesso').
                // '</div>';
                // }
                
                //echo view('layout/alert/alert-sucesso'); ?>


            <div class="body">
                <?php if(session()->has('message')): 
                    echo session()->get('message');
                endif; ?>
            <span style="color:red"><?php echo $msg ??'';//echo ('nLogin']??'';?></span>
                <?php
                    $atributos_formulario = array('id' => 'sign_up');
                    echo 'd6a2d408b7557df8a9d666b1e3c3babab855c821';
                    echo form_open("", $atributos_formulario);
                    
                    ?>
                <div class="msg">Faça login para acessar o Sistema</div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">person</i>
                    </span>
                    <div class="form-line">
                        <?php 
                        echo csrf_field();
                        echo form_input(array('name' => 'nLogin', 'class' => 'form-control cpf', 'autofocus' => 'true', 'placeholder' => 'Login (cpf)'), set_value('nLogin')); 
                        ?>
                    </div>
                    <span style="color:red"><?php //echo $msg ??'';//echo ('nLogin']??'';?></span>
                    <span style="color:red">
                        <?php
                            // echo session()-get('erroLogin');
                            // echo $this->session->unset_userdata('erroLogin');
                            ?></span>
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">lock</i>
                    </span>
                    <div class="form-line">
                        <input type="password" id="password" class="form-control" name="nSenha" minlength=""
                            placeholder="Senha" autocomplete="on">   
                    </div>                   
                    <span style="color:red;"><?php //echo ('nSenha']??'';?></span>                  
                                 
                </div>
                <div class="input-group">
                
                <span  class="input-group-daddon">
                        <i id="iv" class="glyphicon glyphicon-eye-close"></i>                       
                    </span>
                    <?php //nbs(3);?>
                    <span id="mostraSenha" onclick="myFunction()">Mostrar senha</span>               
                </div>                             

                <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">ACESSAR</button>

                <div class="m-t-25 m-b--5 align-center">
                    <?php echo anchor('form_redefinir_senha','Esqueceu a senha?');?>
                </div>

                </form>
            </div>
        </div>
        <div class="logo text-center">
            <a href="javascript:void(0);"></a>
            <small class="font-16"><b><span style="font-size: 10px" ;>cleberdossantossousa@gmail.com | (83)
                        98796-9712</span></b></small>
        </div>
    </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="<?php echo base_url('plugins/jquery/jquery.min.js'); ?>"></script>

    <!-- Bootstrap Core Js -->
    <script src="<?php echo base_url('plugins/bootstrap/js/bootstrap.js'); ?>"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?php echo base_url('plugins/node-waves/waves.js'); ?>"></script>

    <!-- Validation Plugin Js -->
    <script src="<?php echo base_url('plugins/jquery-validation/jquery.validate.js'); ?>"></script>

    <!-- Custom Js -->
    <script src="<?php echo base_url('js/admin.js'); ?>"></script>
    <script src="<?php echo base_url('js/pages/examples/sign-up.js'); ?>"></script>

    <!-- Masc-->
    <script src="<?php echo base_url('plugins/mask/jquery.mask.min.js'); ?>"></script>

    <!-- Scripts -->
    <script src="<?php echo base_url('js/script.js'); ?>"></script>

    <script>
    function myFunction() {
        var x = document.getElementById("password");
        
        
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
        x.focus();
        $('#iv').toggleClass('glyphicon-eye-close').toggleClass('glyphicon-eye-open');
    
    }
    </script>
    <script>
        //$('#password + .glyphicon').on('click', function() {
  //$(this).toggleClass('glyphicon-eye-close').toggleClass('glyphicon-eye-open'); // toggle our classes for the eye icon
  //$('#password').togglePassword(); // activate the hideShowPassword plugin
//});
    </script>
</body>

</html>