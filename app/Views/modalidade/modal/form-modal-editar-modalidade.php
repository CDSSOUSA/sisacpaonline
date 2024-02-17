<div class="modal fade" id="editarModalidadeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Editar Modalidade
                <small class="d-block">* campos de preenchimento obrigatório.</small>
                </h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">

                <?php
                $atributos_formulario = array(
                    'role' => 'form',
                    'class' => '',
                    'id' => 'editModalidadeForm'
                );

                echo form_open('#/', $atributos_formulario);
                ?>

                <input type="hidden" id="idModalidade" name="nIdModalidade">

                <div class="form-group row">
                    <label for="<?= $atributos['descricao']['id'] ?>" class="col-sm-3 col-form-label font-weight-bold">
                        <?= $atributos['descricao']['label'] ?>
                    </label>
                    <div class="col-sm-8">
                        <input id="<?= $atributos['descricao']['id'] ?>" type="text"
                            name="<?= $atributos['descricao']['name'] ?>" class="form-control" autofocus
                            placeholder="<?= $atributos['descricao']['label'] ?>"
                            onclick="clearMessageError('<?= $atributos['descricao']['iError'] ?>')">
                        <p style="" class="text-danger mb-1" id="<?= $atributos['descricao']['iError'] ?>">

                        </p>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="<?= $atributos['cbo']['id'] ?>" class="col-sm-3 col-form-label font-weight-bold">
                        <?= $atributos['cbo']['label'] ?>
                    </label>
                    <div class="col-sm-8">
                        <input id="<?= $atributos['cbo']['id'] ?>" type="text" name="<?= $atributos['cbo']['name'] ?>"
                            class="form-control" placeholder="<?= $atributos['cbo']['label'] ?>"
                            onclick="clearMessageError('<?= $atributos['cbo']['iError'] ?>')">

                        <p style="" class="text-danger mb-1" id="<?= $atributos['cbo']['iError'] ?>">
                        </p>
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