<?php
echo $this->extend('layout/home');
echo $this->section('content');
$dadosUsuario;
$idUsuario = $dadosUsuario->idUsuario;
$nomeUsuario = $dadosUsuario->nomeUsuario;

?>

<section class="content">
    <div class="container-fluid"> 
    <?php  
    echo view('layout/alert/alert-erro');
    echo view('layout/alert/alert-erro-preenchimento');
    session()->remove('erro');
    session()->remove('sucesso');
    ?>  
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header bg-indigo">
                        <h2>
							<?php 
								echo $titulo; ?>
                            <small>* campos de preenchimento obrigatórios.</small>
                        </h2>                           
                    </div>
                    <div class="body">
                        <?php
                        $atributos_formulario = array(
                            'role' => 'form',
                            'class' => 'form-horizontal'
                        );
                        echo form_open('atendimento/cadastrar_atendimento01/' . encrypt($idUsuario), $atributos_formulario);
                        echo form_hidden('nIdUsuario', $idUsuario);
                        ?>

						<div class="row clearfix">
							<div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
								<label>Id | Nome completo: </label>
							</div>
							<div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
								<div class="form-group">
									<div class="form-line">
										<h4><?php echo $idUsuario . ' - ' . $nomeUsuario; ?></h4>
									</div>
								</div>
							</div>
						</div>
                        <div class="row clearfix">
							<div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
								<label>Triagem ? </label>
							</div>
							<div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
								<div class="form-group">
									<div class="form-line">
										<div class="demo-radio-button radio-inline">

												<input name="nTriagem" value="TRIAGEM" <?php echo set_radio('nTriagem', 'TRIAGEM', FALSE); ?> type="radio" class="with-gap" id="iTriagemSim" />
												<label for="iTriagemSim">Sim</label>
												<input name="nTriagem" value="NAO" <?php echo set_radio('nTriagem', 'NAO', TRUE); ?> type="radio" id="iTriagemNao" class="with-gap" />
												<label for="iTriagemNao">Não</label>

										</div>

									</div>
								</div>
								<span style="color:red"><?= session()->get('errors')['nTriagem']??'';?></span>

							</div>
                        </div>
                        <div class="row clearfix">
							<div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
								<label>Tipo atendimento: </label>
							</div>
							<div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
								<div class="form-group">
									<div class="form-line">
										<div class="demo-radio-button radio-inline">

												<input name="nOpcaoAtendimento" value="I" <?php echo set_radio('nOpcaoAtendimento', 'I', FALSE); ?> type="radio" class="with-gap" id="iOpcaoAtendimentoI" />
												<label for="iOpcaoAtendimentoI">Individual</label>
												<input name="nOpcaoAtendimento" value="G" <?php echo set_radio('nOpcaoAtendimento', 'G', FALSE); ?> type="radio" id="iOpcaoAtendimentoG" class="with-gap" />
												<label for="iOpcaoAtendimentoG">Grupo</label>

										</div>

									</div>
								</div>
								<span style="color:red"><?= session()->get('errors')['nOpcaoAtendimento']??'';?></span>                               
							</div>
						</div>

						<div class="row clearfix">
							<div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
								<label>Nome do profissional: </label>
							</div>
							<div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
								<div class="form-group">
									<div class="form-line">
										<select class="form-control show-tick" name="nIdProfissional">
											<option value=""> selecione ...</option>
											<?php
												foreach ($profissionais AS $profissional) : ?>
                                                <option value="<?=$profissional->idProfissional;?>" <?=set_select('nIdProfissional', $profissional->idProfissional , FALSE);?>><?=$profissional->idProfissional . ' - ' . $profissional->nomeProfissional.' - '.$profissional->modalidade;?></option>
													
												<?php endforeach;?>											
										</select>
                                       
									</div>
									<span style="color:red"><?= session()->get('errors')['nIdProfissional']??'';?></span>
								</div>
							</div>
						</div>

						<div class="row clearfix">
							<div class="col-lg-offset-3 col-md-offset-3 col-sm-offset-4 col-xs-offset-5">
								<?php 
                                echo session()->get('botaoSalvar');
								echo session()->get('botaoLimpar');
								echo gerarbotaoVoltar('usuario/detalhar_usuario/' . encrypt($idUsuario));
								?>
							</div>
						</div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header bg-indigo">
                        
                        <h2>
                            <?php
                            echo ('HORÁRIOS DOS ATENDIMENTOS <small>' . $idUsuario . ' - ' . $nomeUsuario . '</small>');
                            ?>                           
                        </h2>
                    </div>
                    <div class="body table-responsive">
                        <table class="table table-hover" id="iTabelaHorario">
                            <thead >
                                <tr>
									<th style="font-weight: bold; color: black; font-size: 18px;">Dia Sem.</th>
                                    <th style="font-weight: bold; color: black; font-size: 18px;">Data</th>
									<th style="font-weight: bold; color: black; font-size: 18px;">Hr. Início</th>
									<th style="font-weight: bold; color: black; font-size: 18px;">Hr. Fim</th>
									<th style="font-weight: bold; color: black; font-size: 18px;">Profissional</th>
									<th style="font-weight: bold; color: black; font-size: 18px;">Modalidade</th>
									<th style="font-weight: bold; color: black; font-size: 18px;">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php									
									foreach ($atendimentosUsuario as $atendimento) {
                                    ?>
                                    <tr>
                                        <td> <?php echo $atendimento->diaSemana . ' - ' . tratarDiaSemana($atendimento->diaSemana); ?></td>
                                        <td> <?php echo converteParaDataBrasileira($atendimento->dataPrevisaoAtendimento); ?></td>
                                        <td> <?php echo $atendimento->horaInicio; ?></td>
                                        <td> <?php echo $atendimento->horaFim; ?></td>
                                        <td> <?php echo $atendimento->nomeProfissional; ?></td>
                                        <td> <?php echo $atendimento->modalidade; ?></td>
                                        <td class="text-center">  <button class="btn bg-red waves-effect" onclick=delTeacher(<?= $atendimento->idAtendimento; ?>) type="button" class="btn btn-primary" data-toggle="modal" data-target="#desativarAtendimento">
                                                <span class="badge">R</span> emover </button>
                                        </td>                                      
                                    </tr>                                

                                <?php
                            }
                            ?>
                            </tbody>  
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>          
    </div>
</section>
<div class="modal fade" id="desativarAtendimento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-col-red modal-sm">
            <div class="modal-header">
                <h5 class="modal-title">ATENÇÃO ::</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <?php
                $atributos_formulario = array(
                    'role' => 'form',
                    'class' => ''
                );

                echo form_open('atendimento/desativar_atendimento', $atributos_formulario);

                ?>
                <input type="hidden" id="idDeleteTeacher" name="nIdAtendimento">
                <input type="hidden" id="idDeleteTeacher" name="nEtapa" value="1">
                <h4>Confirmar
                    a exclusão?</h4>
            </div>



            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-link waves-effect">Salvar</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>