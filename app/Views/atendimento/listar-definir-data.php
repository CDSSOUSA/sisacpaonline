
<?php
echo $this->extend('layout/home');
echo $this->section('content');
?>
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<?php 
				 echo view('layout/alert/alert-sucesso');
				 echo view('layout/alert/alert-erro');
				 echo view('layout/alert/alert-erro-preenchimento');
				 session()->remove('erro');
				 session()->remove('sucesso');
				 ?>
				<div class="card">
					<div class="header bg-indigo">
						<h2>
							<?php echo $titulo; ?>
							<small>Escolha uma das opções abaixo para pesquisar.</small>
						</h2>
					</div>
					<div class="body">
						<?php
						$atributos_formulario = array('role' => 'form', 'id'=>'formAtendimentoAnterior', 'class' => 'form-horizontal');
						echo form_open('api/atendimento/atendimentosAnterior', $atributos_formulario);
						?>
						<div class="row clearfix">
							<div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
								<label>Data para o atendimento: </label>
							</div>
							<div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
								<div class="form-group">
									<div class="form-line">
										<div class="form-line" id="bs_datepicker_container">
											<input id="iDataAtendimento" onfocus="eraseAlert(['erroData']);" type="text" class="form-control data" placeholder="Escolha uma data atendimento ..." name="nDataAtendimento">
										</div>
									</div>
									
									<span id="erroData" style="color:red"><?= session()->get('errors')['nDataAtendimento'] ?? ''; ?></span>
								</div>
							</div>
						</div>
						<div class="row clearfix">
							<div class="col-lg-offset-3 col-md-offset-3 col-sm-offset-4 col-xs-offset-5">
								<?php
								echo session()->get('botaoPesquisar');
								echo session()->get('botaoLimpar');
								?>
							</div>
						</div>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php $this->endSection();
