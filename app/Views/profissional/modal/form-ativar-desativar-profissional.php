<div class="modal fade" id="ativarDesativarProfissional" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleFormAtivarDesativar"></h5>
                <small></small>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span>
                </button>

            </div>
            <div class="modal-body">
                <div id="aviso" style="display:none" class="alert alert-warning alert-dismissible fade show"
                    role="alert">
                    <strong>Atenção!</strong> Após desativar o PROFISSIONAL todos os registros de: alocação, atendimento
                    e permissão serão desativados, não sendo possível recuperá-los.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
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
