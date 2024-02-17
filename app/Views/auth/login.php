<?php
    echo $this->extend('layout/home_auth');
    echo $this->section('content'); 
?>

<body>

<!-- [ auth-signin ] start -->
<div class="auth-wrapper">
	<div class="auth-content text-center">
		<img src="<?=base_url()?>img/logo-acpa.png" width="150" alt="" class="img-fluid mb-0">
		<div class="card borderless">
			<div class="row align-items-center ">
				<div class="col-md-12">
					<div class="card-body">
               <?php
                            $atributos_formulario = array('id' => 'sign_up');                            
                            echo form_open("/login", $atributos_formulario);
                    
                    ?>
						<h5 class="mb-3 f-w-400">ACESSAR O SISTEMA</h5>
						<hr>
						<div class="form-group mb-3">
                  <?php 
                                echo csrf_field();
                                echo form_input(array('name' => 'nLogin', 'class' => 'form-control cpf', 'autofocus' => 'true', 'placeholder' => 'Login (cpf)','value'=>'01939752469')); 
                             ?>
							
						</div>
						<div class="form-group mb-4">
                  <input type="password" id="password" class="form-control" name="nSenha" minlength=""
                            placeholder="Senha" autocomplete="on" value="1"> 
							
						</div>
						<div class="custom-control custom-checkbox text-left mb-4 mt-2">
							<input type="checkbox" class="custom-control-input" id="customCheck1">
							<label id="mostraSenha" onclick="myFunction()" class="custom-control-label" for="customCheck1">Exibir senha</label>
						</div>
						<button type="submit" class="btn btn-block btn-primary mb-4">Entrar</button>
                  
</form>
						<hr>
						<p class="mb-2 text-muted">Forgot password? <a href="auth-reset-password.html" class="f-w-400">Reset</a></p>
						<p class="mb-0 text-muted">Don’t have an account? <a href="auth-signup.html" class="f-w-400">Signup</a></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- [ auth-signin ] end -->


    
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