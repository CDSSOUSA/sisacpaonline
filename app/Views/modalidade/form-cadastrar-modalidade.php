<?= $this->extend('layout/home'); ?>
<?= $this->section('content'); ?>
<div class="row">
    <div class="col-md-12">
        <?php
        $atributos_formulario = [
            'role' => 'form',
            'class' => 'form-horizontal',
            'id' => 'cadastrarModalidadeForm'
        ];
        echo form_open('api/modalidade/cadastrar_modalidade', $atributos_formulario);
        ?>

        <div class="form-group row">
            <label 
                for="<?=$atributos['descricao']['id']?>" 
                class="col-sm-3 col-form-label font-weight-bold">
                <?=$atributos['descricao']['label']?>
            </label>
            <div class="col-sm-8">
                <input                     
                    id="<?=$atributos['descricao']['id']?>"
                    type="text"
                    name="<?=$atributos['descricao']['name']?>"
                    class="form-control" 
                    autofocus 
                    placeholder="<?=$atributos['descricao']['label']?>"
                    onclick="clearMessageError('<?=$atributos['descricao']['iError']?>')">
                <p 
                    style="" 
                    class="text-danger mb-1"
                    id="<?=$atributos['descricao']['iError']?>">

                </p>
            </div>
        </div>        

        <div class="form-group row">
            <label 
                for="<?=$atributos['cbo']['id']?>" 
                class="col-sm-3 col-form-label font-weight-bold">
                <?=$atributos['cbo']['label']?>
            </label>
            <div class="col-sm-8">
                <input 
                    id="<?=$atributos['cbo']['id']?>"
                    type="text" 
                    name="<?=$atributos['cbo']['name']?>" 
                    class="form-control" 
                    placeholder="<?=$atributos['cbo']['label']?>" 
                    onclick="clearMessageError('<?=$atributos['cbo']['iError']?>')">

                    <p
                        style="" 
                        class="text-danger mb-1"
                        id="<?=$atributos['cbo']['iError']?>">
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
<?= $this->endSection(); ?>
<?= $this->section('script-js'); ?>
<script src="<?= base_url() ?>js/modalidade.js"></script>
<?= $this->endSection(); ?>