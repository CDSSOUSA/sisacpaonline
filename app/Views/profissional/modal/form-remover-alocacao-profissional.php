
<div class="modal fade" id="removerAlocacaoProfissionalModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-red">
                <h5 class="modal-title">REMOVER ALOCAÇÃO <small class="d-block"
                        id="nomeProfissionalAlocacaoSmall"></small> </h5>
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
                    <a href="#" class="main_clear_bt" id="btnVoltarAlocacaoProfissional" data-toggle="modal"
                        data-target="#listarAlocacaoProfissional">
                        <i class="fa fa-times"></i> CANCELAR
                    </a>

                    <button type="submit" class="main_bt"><i class="fa fa-check"></i> SIM</button>

                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>