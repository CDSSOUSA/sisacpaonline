<?= $this->extend('layout/home'); ?>
<?= $this->section('content'); ?>
<div class="row">
    <div class="col-md-12">
        <?php
        $atributos_formulario = [
            'role' => 'form',
            'class' => 'form-horizontal',
            'id' => 'cadastrarOperadorForm'
        ];
        echo form_open('api/operador/cadastrar_operador', $atributos_formulario);
        ?>

        <div class="form-group row">
            <label 
                for="<?=$atributos['nomeOperador']['id']?>" 
                class="col-sm-3 col-form-label font-weight-bold">
                <?=$atributos['nomeOperador']['label']?>
            </label>
            <div class="col-sm-8">
                <input                     
                    id="<?=$atributos['nomeOperador']['id']?>"
                    type="text"
                    name="<?=$atributos['nomeOperador']['name']?>"
                    class="form-control" 
                    autofocus 
                    placeholder="<?=$atributos['nomeOperador']['label']?>"
                    onclick="clearMessageError('<?=$atributos['nomeOperador']['iError']?>')">
                <p 
                    style="" 
                    class="text-danger mb-1"
                    id="<?=$atributos['nomeOperador']['iError']?>">

                </p>
            </div>
        </div>        

        <div class="form-group row">
            <label 
                for="<?=$atributos['cpfOperador']['id']?>" 
                class="col-sm-3 col-form-label font-weight-bold">
                <?=$atributos['cpfOperador']['label']?>
            </label>
            <div class="col-sm-8">
                <input 
                    id="<?=$atributos['cpfOperador']['id']?>"
                    type="text" 
                    name="<?=$atributos['cpfOperador']['name']?>" 
                    class="form-control" 
                    placeholder="<?=$atributos['cpfOperador']['label']?>" 
                    onclick="clearMessageError('<?=$atributos['cpfOperador']['iError']?>')">

                    <p
                        style="" 
                        class="text-danger mb-1"
                        id="<?=$atributos['cpfOperador']['iError']?>">
                    </p>
            </div>
        </div>   

        <div class="form-group row">
            <label 
                for="<?=$atributos['tipoOperador']['id']?>" 
                class="col-sm-3 col-form-label font-weight-bold">
                <?=$atributos['tipoOperador']['label']?>
            </label>
            <div class="col-sm-8">
                <select 
                    id="<?=$atributos['tipoOperador']['id']?>"
                    class="custom-select" 
                    name="<?=$atributos['tipoOperador']['name']?>" 
                    onclick="clearMessageError('<?=$atributos['tipoOperador']['iError']?>')">
                    <option value="">selecione ...</option>
                    <option value="O">SECRETÁRIO (a)</option>
                    <option value="A">ADMINISTRADOR (a)</option>                    
                    <option value="S">SUPER ADMINISTRADOR (a)</option>                    
                </select>
                <p
                    style="" 
                    class="text-danger mb-1"
                    id="<?=$atributos['tipoOperador']['iError']?>">
                </p>   
            </div>
        </div>     
      
        <div class="form-group row">
            <label class="col-sm-3 hidden"></label>
            <div class="col-sm-8 d-flex justify-content-between">               
                <?= session()->get('botaoSalvar'); ?> 
                <?= session()->get('botaoLimpar'); ?>     
            </div>
        </div>
        </form>
    </div>

</div>
<script>
    const cadastrarOperadorForm = document.getElementById("cadastrarOperadorForm");

if (cadastrarOperadorForm) {
    cadastrarOperadorForm.addEventListener("submit", async (e) => {
        e.preventDefault();
        const dataForm = new FormData(cadastrarOperadorForm);

        await axios
            .post(`${URL_BASE}${URI_API_OPERADOR}/cadastrar_operador`, dataForm, {
                headers: {
                    "Content-Type": "application/json",
                },
            })
            .then((response) => {
                if (response.data.error) {
                    showAlertToast(false, "Erros no preechimento!");

                    validateErros(response.data.msgs.nNomeOperador, "iErrorNomeOperador");

                    validateErros(response.data.msgs.nCpfOperador, "iErrorCpfOperador");
                    validateErros(response.data.msgs.nTipoOperador, "iErrorTipoOperador");
                } else {
                    showAlertToast(true);
                    cadastrarOperadorForm.reset();

                    setTimeout(function () {
                        window.location.href = `${URL_BASE}operador/form_editar_operador`;
                    }, 2000);
                }
            })
            .catch((error) => {
                showAlertToast(false, error);
            });
    });
}
    </script>
<?= $this->endSection(); ?>
<?= $this->section('script-js'); ?>
<script src="<?= base_url() ?>js/operador.js"></script>
<?= $this->endSection(); ?>