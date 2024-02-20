
<div class="modal fade" id="desativarOperadorModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-red">
                <h5 class="modal-title">DESATIVAR OPERADOR <small class="d-block"
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
                    'id' => 'desativarOperadorForm'
                );

                echo form_open('', $atributos_formulario);
                ?>

                <input type="text" id="idOperadorDesativar" name="nIdOperador">
                <input type="text" id="idDesativar" name="nId">
                <h5>Confirmar a desativação?</h5>    
                <h4 id="iNomeOperadorDesativar"></h4>           
               
            </div>

            <div class="modal-footer">
                <div class="col-sm-12 d-flex justify-content-between">
                    <?= session()->get('botaoFecharModal'); ?>
                    <button type="submit" class="main_bt"><i class="fa fa-check"></i> SIM</button>

                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<script>

const desativarOperadorForm = document.getElementById("desativarOperadorForm");

if (desativarOperadorForm) {
    desativarOperadorForm.addEventListener("submit", async (e) => {
        e.preventDefault();
        const dataForm = new FormData(desativarOperadorForm);

        await axios
            .post(`${URL_BASE}${URI_API_OPERADOR}/desativar_operador`, dataForm, {
                headers: {
                    "Content-Type": "application/json",
                },
            })
            .then((response) => {
                if (response.data.error) {
                    showAlertToast(false, "Erros no preechimento!");
                } else {
                    showAlertToast(true);
                   $('#desativarOperadorModal').modal("hide");
                   listarOperador()
                 
                }
            })
            .catch((error) => {
                showAlertToast(false, error);
            });
    });
}


    
   
</script>