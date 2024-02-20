<div class="modal fade" id="permitirOperadorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">CADASTRAR PERMISSÃO OPERADOR 
                <small id="nomeOperadorPermissao"class="d-block">* campos de preenchimento obrigatório.</small>
                </h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
              
                <div class="row clearfix" id="resultado"></div>

            </div>
            <div class="modal-footer">
                <div class="col-sm-9 text-right">                   
                    <?= session()->get('botaoFecharModal'); ?>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>

</div>

<script>

    async function removerPermissao(idOperador, idPermissao){
        const dataForm = new FormData();

        dataForm.append('nIdOperador', idOperador);
        dataForm.append('nIdPermissao', idPermissao);   

        await axios.post(`${URL_BASE}${URI_API_OPERADOR}/remover_permissao`, dataForm, {
                headers: {
                    "Content-Type": "application/json",
                    'X-CSRF-TOKEN': "<?= csrf_hash() ?>"
                },
            }).then((response) => {
                console.log(response.data)
                if (response.data.error) {
                        showAlertToast(false, "Erros na tentativa!");
                        
                    } else {
                        showAlertToast(true);
                        permitir_operador(idOperador)

                        
                    }
            }).catch((error) => console.log(error));

    }
    
    async function adicionarPermissao(idOperador, idPermissao){
        const dataForm = new FormData();

        dataForm.append('nIdOperador', idOperador);
        dataForm.append('nIdPermissao', idPermissao);   

        await axios.post(`${URL_BASE}${URI_API_OPERADOR}/adicionar_permissao`, dataForm, {
                headers: {
                    "Content-Type": "application/json",
                    'X-CSRF-TOKEN': "<?= csrf_hash() ?>"
                },
            }).then((response) => {
                console.log(response.data)
                if (response.data.error) {
                        showAlertToast(false, "Erros na tentativa!");
                        
                    } else {
                        showAlertToast(true);
                        permitir_operador(idOperador)

                        
                    }
            }).catch((error) => console.log(error));

    }
</script>