
<div class="modal fade" id="alocarProfissionalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    ALOCAR HORÁRIOS DO PROFISSIONAL <small class="d-block">* campos de preenchimento
                        obrigatório.</small>

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
                    <label for="" class="col-sm-3 col-form-label font-weight-bold">Dias de atendimento: *<a
                            class="btn bg-green" onclick="marcardesmarcar();"> <i class="fa fa-check"></i>
                            todos</a></label>
                    <div class="col-sm-8">

                        <div class="icheck-material-indigo icheck-inline">
                            <div id="diaSemanaDiv"></div>
                        </div>


                        <p style="" class="text-danger mb-1" id="iDiasAtendimento">

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
                <div class="col-sm-12 d-flex justify-content-between">

                    <a href="#" class="btn main_back_bt disabled" id="btnListarAlocacao">
                        <i class="fa fa-table"></i> Listar Alocações
                    </a>


                    <?= session()->get('botaoSalvar'); ?>
                    <button type="submit" class="main_bt" id="salvarContinuar" data-continue="true"><i class="fa fa-save"></i> Salvar e Continuar</button>
                    <?= session()->get('botaoFecharModal'); ?>

                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
