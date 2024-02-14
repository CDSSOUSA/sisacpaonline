<?php
    echo $this->extend('layout/home_auth');
    echo $this->section('content'); 
?>
    <body class="inner_page login">
      <div class="full_container">
         <div class="container">
            <div class="center verticle_center full_height">
               <div class="login_section">
                  <div class="logo_login">
                     <div class="center">
                        <img width="210" src="<?= base_url();?>assets/images/logo/logo.png" alt="#" />
                     </div>
                  </div>
                  <div class="login_form">
                     <?php
                            $atributos_formulario = array('id' => 'sign_up');
                            echo 'd6a2d408b7557df8a9d666b1e3c3babab855c821';
                            echo form_open("", $atributos_formulario);
                    
                    ?>
                        <fieldset>
                           <div class="field">
                              <label class="label_field">Email Address</label>
                              <?php 
                                echo csrf_field();
                                echo form_input(array('name' => 'nLogin', 'class' => 'form-control cpf', 'autofocus' => 'true', 'placeholder' => 'Login (cpf)'), set_value('nLogin')); 
                             ?>
                           </div>
                           <div class="field">
                              <label class="label_field">Password</label>
                              <input type="password" id="password" class="form-control" name="nSenha" minlength=""
                            placeholder="Senha" autocomplete="on"> 
                        </div>
                        <div class="input-group">
                
                <span  class="input-group-daddon">
                        <i id="iv" class="fa fa-eye-slash"></i>                       
                    </span>
                    <?php //nbs(3);?>
                    <span id="mostraSenha" onclick="myFunction()">Mostrar senha</span>               
                </div>    
                           <div class="field">
                              <label class="label_field hidden">hidden label</label>
                              <label class="form-check-label"><input type="checkbox" class="form-check-input"> Remember Me</label>
                              <a class="forgot" href="">Forgotten Password?</a>
                           </div>
                           <div class="field margin_0">
                              <label class="label_field hidden">hidden label</label>
                              <button class="main_bt">Sing In</button>
                           </div>
                        </fieldset>
                        <div class="m-t-25 m-b--5 align-center">
                            <?php echo anchor('form_redefinir_senha','Esqueceu a senha?');?>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <script>
    function myFunction() {
        var x = document.getElementById("password");
        
        
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
        x.focus();
        $('#iv').toggleClass('fa-eye-slash').toggleClass('fa-eye');
    
    }
    </script>

    <?php echo $this->endSection(); 