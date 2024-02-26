<div class="modal fade" id="editarEvolucaoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">EDITAR EVOLUÇÃO
                    <small id="nomeUsuarioHistorico" class="d-block"></small>
                </h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                $atributos_formulario = array(
                    'role' => 'form',
                    'class' => 'form-horizontal',
                    'id' => 'editarEvolucaoForm'
                );
                echo form_open('evolucao/editar_evolucao', $atributos_formulario);
                //echo form_hidden('nIdRegistroAtendimento', encrypt($idRegistroAtendimento));
                ?>
                <input type="text" id="iIdRegistroAtendimento" name="nIdRegistroAtendimento">         
               
                <div class="form-group row">
            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                <label for="">Registro:</label>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                <div class="form-group">
                    <div class="form-line">
                        <h5 id="iRegistroEdicao">                           
                        </h5>
                    </div>
                </div>
            </div>
        </div>
                <div class="form-group row">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                        <label for="iTextoEvolucao">Texto da evoluçao: *</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                        <div class="form-group">

                            <div class="form-line">
                                <textarea id="iTextoEvolucaoEdicao" rows="4" name="nTextoEvolucao"
                                    class="form-control no-resize textareaLimite2"
                                    placeholder="Digite o texto ... Enter para mudar de linha."
                                    onclick="clearMessageError('iErrorTextoEvolucaoEdicao')">
                        </textarea>
                            </div>

                            <p style="" class="text-danger mb-1" id="iErrorTextoEvolucaoEdicao">
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            <div class="col d-flex justify-content-between">
                <button type="button" class="main_clear_bt"  id="btFecharEditarEvolucao"><i class="fa fa-times"></i> Fechar</button>               
                <?= session()->get('botaoSalvar'); ?>
            </div>
            </div>
            </form>
        </div>
    </div>
</div>
