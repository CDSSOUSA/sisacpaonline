<div class="modal fade" id="historicoEvolucaoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">HISTÓRICO EVOLUÇÃO nome usuario e responsavel
                    <small id="nomeUsuarioHistorico" class="d-block">* campos de preenchimento obrigatório.</small>
                </h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
            <?php foreach ($dadosEvolucao as $evolucao) :?>
				
            <div class="col-xl-12">
				<div class="row">
                	<div class="col">
						<div class="card text-left">
							<div class="card-body">
								<h5 class="card-title">
                                    Data do atendimento: <?php echo converteParaDataBrasileira($evolucao->dataAtendimento) . ' - ' . tratarDiaSemana($evolucao->diaSemana) . ' - ' . $evolucao->horaInicio . ' 
                                    <span class="badge">' . $evolucao->numeroRegistro . '</span><br>
                                    <small>Profissional: ' . $evolucao->nomeProfissional . ' - ' . $evolucao->modalidade . '</small><br>
                                    <small>Registro da evolução em : ' . converteParaDataHoraCompletaBrasileira($evolucao->dataRegistroEvolucao) . '</small>'; ?>
                                </h5>
                                <blockquote class="blockquote">
							
                            <p class="mb-2"><?php echo tratarEvolucao(base64_decode($evolucao->textoEvolucao), true); ?></p>
							
						</blockquote>
								<a href="#!" onclick="editarEvolucao(encrypt($evolucao->idRegistroAtendimento)" class="main_bt"><i class="fa fa-edit"></i> Editar</a>
                                
							</div>
                            
						</div>
					</div>
					
				</div>
			</div>
            <?php endforeach;?>
            </div>
            <div class="modal-footer">
            <?= session()->get('botaoFecharModal'); ?>
            </div>
        </div>
        </div>

    </div>
</div>