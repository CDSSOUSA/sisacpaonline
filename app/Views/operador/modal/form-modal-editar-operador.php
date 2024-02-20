<div class="modal fade" id="editarOperadorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">EDITAR OPERADOR
                    <small id="nomeOperadorPermissao" class="d-block">* campos de preenchimento obrigatório.</small>
                </h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">

                <?php
                $atributos_formulario = [
                    'role' => 'form',
                    'class' => 'form-horizontal',
                    'id' => 'editarOperadorForm'
                ];
                echo form_open('api/operador/editar_operador', $atributos_formulario);
                ?>

                <input id="idOperadorEdit" name="nIdOperador" type="text">
                <input id="idEdit" name="nId" type="text">
                <input id="iIdentificador" name="nIdentificador" type="text">

                <div class="form-group row">
                    <label for="<?= $atributos['nomeOperador']['id'] ?>" class="col-sm-3 col-form-label font-weight-bold">
                        <?= $atributos['nomeOperador']['label'] ?>
                    </label>
                    <div class="col-sm-8">
                        <input id="<?= $atributos['nomeOperador']['id'] ?>" type="text"
                            name="<?= $atributos['nomeOperador']['name'] ?>" class="form-control" autofocus
                            placeholder="<?= $atributos['nomeOperador']['label'] ?>"
                            onclick="clearMessageError('<?= $atributos['nomeOperador']['iError'] ?>')">
                        <p style="" class="text-danger mb-1" id="<?= $atributos['nomeOperador']['iError'] ?>">

                        </p>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="<?= $atributos['tipoOperador']['id'] ?>" class="col-sm-3 col-form-label font-weight-bold">
                        <?= $atributos['tipoOperador']['label'] ?>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-line" id="operadores"></div>

                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <div class="col-sm-8 d-flex justify-content-between">
                    <?= session()->get('botaoSalvar'); ?>
                    <?= session()->get('botaoFecharModal'); ?>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>

</div>

<script>

    const editarOperadorForm = document.getElementById("editarOperadorForm");
    if (editarOperadorForm) {
        editarOperadorForm.addEventListener("submit", async (e) => {
            e.preventDefault();
            const dataForm = new FormData(editarOperadorForm);

            //dataForm.append('nIdOperador', idOperador);
            //dataForm.append('nIdPermissao', idPermissao);   

            await axios.post(`${URL_BASE}${URI_API_OPERADOR}/editarOperador`, dataForm, {
                headers: {
                    "Content-Type": "application/json",
                },
            }).then((response) => {
                console.log(response.data)
                if (response.data.error) {
                    showAlertToast(false, "Erros na tentativa!");

                    validateErros(response.data.msgs.nNomeOperador, "iErrorNomeOperador");

                } else {
                    showAlertToast(true);
                    $("#editarOperadorModal").modal("hide");
                    listarOperador()
                }
            }).catch((error) => console.log(error));
        })
    }
</script>