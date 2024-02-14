<?= $this->extend('layout/home'); ?>
<?= $this->section('content'); ?>
<div>
    <small id="totalProfissionais">* campos de preenchimento obrigatório.</small>
    <small id="contadorAtivo" style="display:block">* campos de preenchimento obrigatório.</small>
    <small id="contadorInativo">* campos de preenchimento obrigatório.</small>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card-body table-border-style">
            <div class="table-responsive">
                <table class="table table-striped table-head-fixed text-nowrap" id="tb_profissionais">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nome
                                profissional</th>
                            <th class="text-center">
                                CNS</th>
                            <th class="text-center">
                                CPF</th>
                            <th>
                                Modalidade</th>
                            <th>Tipo
                            </th>
                            <th>Status</th>
                            <th class="text-center">Ações
                            </th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editarProfissional" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

        <div class="modal-content">
            <div class="modal-header bg-blue">
                <h5 class="modal-title" id="exampleModalCenterTitle">Editar Profissional</h5>
          
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">

                <?php
                $atributos_formulario = array(
                    'role' => 'form',
                    'class' => '',
                    'id' => 'editProfissionalForm'
                );

                echo form_open('api/profissional/edita_profissional', $atributos_formulario);
                ?>

                <input type="hidden" id="idProfissional" name="nIdProfissional">
                <input type="hidden" id="id" name="nId">

                <div class="row clearfix">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                        <label for="">Nome completo: *</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="nomeProfissional" name="nNomeProfissional" class="form-control"
                                    onfocus="clearMessageError('iNomeProfissional');">
                            </div>
                            <span class="messageErro" style="color:red" id="iNomeProfissional"></span>
                        </div>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                        <label for="">Genero: * </label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line" id="genero">
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                        <label for="">CNS Profissional: *</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="cnsProfissional" name="nCnsProfissional" class="form-control"
                                    onfocus="clearMessageError('iCnsProfissional');">
                            </div>
                            <span class="messageErro" style="color:red" id="iCnsProfissional"></span>
                        </div>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                        <label for="">CPF Profissional: *</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="cpfProfissional" name="nCpfProfissional" class="form-control"
                                    onfocus="clearMessageError('iCpfProfissional');">
                            </div>
                            <span class="messageErro" style="color:red" id="iCpfProfissional"></span>
                        </div>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                        <label for="">Núm. Cons. de Classe: *</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="conselhoClasse" name="nConselhoClasse" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                        <label for="">Tipo profissional: *</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line" id="tipos"></div>
                            <span class="messageErro" style="color:red" id="iTipoProfissional"></span>
                        </div>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                        <label for="">Modalidade: *</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line" id="modalidades"></div>
                            <span class="messageErro" style="color:red" id="iModalidadeProfissional"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">  
                
            <div class="col-sm-9 d-flex justify-content-between">
                <?= session()->get('botaoSalvar'); ?>                
                <?= session()->get('botaoFecharModal'); ?>
            </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>

</div>


<div class="modal fade" id="ativarDesativarProfissional" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-teal">
                <h5 class="modal-title" id="titleFormAtivarDesativar"></h5>
                <small> </small>

            </div>
            <div class="modal-body">
            <div id="aviso" style="display:none" class="alert alert-warning alert-dismissible fade show" role="alert">
							<strong>Atenção!</strong> Após desativar o PROFISSIONAL todos os registros de: alocação, atendimento
                    e permissão serão desativados, não sendo possível recuperá-los.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
						</div>
               

                <?php
                $atributos_formulario = array(
                    'role' => 'form',
                    'class' => '',
                    'id' => 'ativarDesativarProfissionalForm'
                );
                echo form_open('api/profissional/ativa_desativa_profissional', $atributos_formulario);
                ?>

                <input type="hidden" id="idProfissionalAtivaDesativa" name="nIdProfissional">
                <input type="hidden" id="idAtivaDesativa" name="nId">
                <input type="hidden" id="statusAtivaDesativa" name="nAtivaDesativa">

                <div class="row clearfix">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                        <label for="">Nome completo: *</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <h4 id="nomeProfissionalAtivaDesativa">
                                </h4>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">  
                
            <div class="col-sm-9 d-flex justify-content-between">
                <?= session()->get('botaoSalvar'); ?>                
                <?= session()->get('botaoFecharModal'); ?>
            </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>


<div class="modal fade" id="alocarProfissionalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    ALOCAR HORÁRIOS DO PROFISSIONAL  <small class="d-block">* campos de preenchimento obrigatório.</small>

                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span>
                </button>
              
            </div>
            <div class="modal-body">
                <!-- <div class="body table-responsive" id="tbAlocacaoProfissionalManha" style="border:1px red solid;"></div> -->


                <?php
                $atributos_formulario = array(
                    'role' => 'form',
                    'class' => '',
                    'id' => 'alocarProfissionalForm'
                );

                echo form_open('api/profissional/aloca_profissional', $atributos_formulario);
                ?>

                <input type="text" id="idProfissionalAlocar" name="nIdProfissional">

                <div class="row clearfix">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                        <label for="">Nome completo: *</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <h4 id="nomeProfissionalAlocar"></h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                        <label for="">Horários cadastrados: </label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <h4 id="iTotalAlocacao"></h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
            <label for="" class="col-sm-3 col-form-label font-weight-bold">Dias de atendimento: *<a class="btn bg-green" onclick="marcardesmarcar();"> <i class="fa fa-check"></i>
                                    todos</a></label>
            <div class="col-sm-8">
            
                <div class="icheck-material-indigo icheck-inline">
                <div id="diaSemanaDiv"></div>
                </div>
                

                <p 
                    style="" 
                    class="text-danger mb-1"
                    id="iDiasAtendimento">

                </p>
            </div>
        </div>

             

                <div class="row clearfix">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                        <label>Horário::Manhã: *</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                        <div class="form-group">
                            
                                <div class="d-flex"> 
                                <div id="horaInicioNew"></div>
                                </div>
                      

                                <span class="messageErro" style="color:red" id="iHorarioManha"></span>

                        </div>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                        <label>Horário::Tarde: *</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="demo-checkbox-new">

                                <div id="horaFimNew"></div>

                                <span class="messageErro" style="color:red" id="iHorarioTarde"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">

                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="hidden" id="idProfissionalAlocar" name="nMensagem">
                            </div>
                            <span class="messageErro" style="color:red" id="iMensagem"></span>
                        </div>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
            <div class="col-sm-9 d-flex justify-content-between">
                   
                        <a href="#" class="btn main_back_bt disabled" id="btnListarAlocacao">
                            <i class="fa fa-table"></i> Listar Alocações
                        </a>
                 
                   
                    <?= session()->get('botaoSalvar'); ?>                
                    <?= session()->get('botaoFecharModal'); ?>
                    
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<div class="modal fade" id="listarAlocacaoProfissional" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-teal">
                <h5 class="modal-title">
                    ALOCAÇÕES DO PROFISSIONAL
                    <small class="d-block" id="nomeProfissionalSmall">* campos de preenchimento obrigatório.</small>
                </h5>
               
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span>
                </button>

            </div>
            <div class="modal-body">

                <div class="body table-responsive p-0" style="height: 500px;">
                    <table id="tb_alocacao_profissional" class="table table-striped table-head-fixed text-nowrap">
                        <thead>
                            <tr>
                                <th class="">Dia semana</th>
                                <th class="">Hora início</th>
                                <th class="">Hora fim</th>
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>

                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
            <div class="col-sm-9 d-flex justify-content-between">
                    <div id="btnSalvar">
                        <a href="#" class="main_back_bt" id="btVoltarAlocacaoProfissional"
                            data-toggle="modal" data-target="#alocarProfissionalModal">
                            <i class="fa fa-arrow-left"></i> Voltar
                        </a>
                    </div>
                    <?= session()->get('botaoFecharModal'); ?>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>


<div class="modal fade" id="removerAlocacaoProfissionalModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-red">
                <h5 class="modal-title">REMOVER ALOCAÇÃO <small class="d-block" id="nomeProfissionalAlocacaoSmall"></small> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span>
                </button>
                

            </div>
            <div class="modal-body">
                <?php
                $atributos_formulario = array(
                    'role' => 'form',
                    'class' => '',
                    'id' => 'removerAlocacaoProfissionalForm'
                );

                echo form_open('', $atributos_formulario);
                ?>

                <input type="text" id="idAlocacao" name="nIdAlocacao">
                <input type="text" id="idAlocacaoProfissional" name="nIdProfissional">

                <h4>Confirmar a exclusão?</h4>
                <h5 id="dataALocacao"></h5>
            </div>

            <div class="modal-footer">
                <div class="col-sm-12 d-flex justify-content-between">  
                    <a href="#" class="main_clear_bt" id="btnVoltarAlocacaoProfissional"
                        data-toggle="modal" data-target="#listarAlocacaoProfissional">
                        <i class="fa fa-times"></i> CANCELAR
                    </a>                  
                
                    <button type="submit" class="main_bt"><i class="fa fa-check"></i> SIM</button>
                        
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<div class="modal fade" id="visualizarAgendaProfissionalModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-red">
                <h5 class="modal-title">
                    AGENDA DO PROFISSIONAL ::
                </h5>
                <small id="">Fornece a lista de todos os atendimentos.</small>

            </div>
            <div class="modal-body">
                <?php 
                    $segunda = new DateTime('monday this week');
                    $sexta = new DateTime('friday this week');
                ?>

                <h5 id="idNomeAgenda"> - </h5>
                <h5 id="modalidadeAgenda"> - </h5>                
                <h5>Período: <?=$segunda->format('d/m/Y')." a ".$sexta->format('d/m/Y');?></h5>
                   <a href="http://localhost/sistemaAcpaNovo/form_visualizar_agenda"
                    class="btn bg-orange waves-effect"><span class="badge">V</span> OLTAR</a>&nbsp;&nbsp; <div
                    class="btn-group">
                    <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-print"></i> AGENDA LOCAL <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="http://localhost/sistemaAcpaNovo/imprimirAgenda/461/semana" target="_blank"
                                class="waves-effect waves-block">SEMANA ATUAL</a> </li>
                        <li><a href="http://localhost/sistemaAcpaNovo/imprimirAgenda/461/next" target="_blank"
                                class="waves-effect waves-block"> PRÓXIMA SEMANA</a> </li>
                    </ul>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn bg-teal dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="material-icons">print</i> AGENDA SUS <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="http://localhost/sistemaAcpaNovo/imprimirAgendaSus/461/atual" target="_blank"
                                class="waves-effect waves-block">MÊS ATUAL</a> </li>
                        <li><a href="http://localhost/sistemaAcpaNovo/imprimirAgendaSus/461/next" target="_blank"
                                class="waves-effect waves-block">PRÓXIMO MÊS</a> </li>
                    </ul>
                </div>
                <hr>

                <div class="card-body">
						<ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
							
						</ul>
						<div class="tab-content" id="myTagbContent">
							
						</div>
					</div>



               





            </div>

            <div class="modal-footer">
                <div style="display: flex;">
                    <div id="btnSalvar" style="flex: 2; padding: 10px; text-align: left;">
                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal"><span
                                class="badge">C</span> ANCELAR</button>
                    </div>
                    <div style="flex: 2; padding: 10px;">
                        <button type="submit" class="btn btn-danger waves-effect">SIM</button>
                    </div>
                </div>
            </div>




            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
<?= $this->section('script-js'); ?>
<script src="<?= base_url() ?>js/profissional.js"></script>
<?= $this->endSection(); ?>