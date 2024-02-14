<?= $this->extend('layout/home'); ?>
<?= $this->section('content'); ?>
<div class="row">
    <div class="col-md-12">
        <?php
        $atributos_formulario = [
            'role' => 'form',
            'class' => 'form-horizontal',
            'id' => 'cadastrarProfissionalForm'
        ];
        echo form_open('api/profissional/cadastrar_profissional', $atributos_formulario);
        ?>

        <div class="form-group row">
            <label 
                for="<?=$atributos['nome']['id']?>" 
                class="col-sm-3 col-form-label font-weight-bold">
                <?=$atributos['nome']['label']?>
            </label>
            <div class="col-sm-8">
                <input                     
                    id="<?=$atributos['nome']['id']?>"
                    type="text"
                    name="<?=$atributos['nome']['name']?>"
                    class="form-control" 
                    autofocus 
                    placeholder="<?=$atributos['nome']['label']?>"
                    onclick="clearMessageError('<?=$atributos['nome']['iError']?>')">
                <p 
                    style="" 
                    class="text-danger mb-1"
                    id="<?=$atributos['nome']['iError']?>">

                </p>
            </div>
        </div>
        <div class="form-group row">
            <label for="<?=$atributos['genero']['id']?>" class="col-sm-3 col-form-label font-weight-bold">Gênero: *</label>
            <div class="col-sm-8">
                <div class="icheck-material-indigo icheck-inline">
                    <input name="<?=$atributos['genero']['name']?>" type="radio" class="with-gap" id="iGeneroMasc" value="M" onclick="clearMessageError('<?=$atributos['genero']['iError']?>')"/>
                    <label for="iGeneroMasc">Masc</label>
                </div>

                <div class="icheck-material-orange icheck-inline">
                    <input name="<?=$atributos['genero']['name']?>" type="radio" id="iGeneroFemi" class="with-gap" value="F" onclick="clearMessageError('<?=$atributos['genero']['iError']?>')" />
                    <label for="iGeneroFemi">Femi</label>
                </div>
                <br>

                <p 
                    style="" 
                    class="text-danger mb-1"
                    id="<?=$atributos['genero']['iError']?>">

                </p>
            </div>
        </div>

        <div class="form-group row">
            <label 
                for="<?=$atributos['cnsProfissional']['id']?>" 
                class="col-sm-3 col-form-label font-weight-bold">
                <?=$atributos['cnsProfissional']['label']?>
            </label>
            <div class="col-sm-8">
                <input 
                    id="<?=$atributos['cnsProfissional']['id']?>"
                    type="text" 
                    name="<?=$atributos['cnsProfissional']['name']?>" 
                    class="form-control" 
                    placeholder="<?=$atributos['cnsProfissional']['label']?>" 
                    onclick="clearMessageError('<?=$atributos['cnsProfissional']['iError']?>')">

                    <p
                        style="" 
                        class="text-danger mb-1"
                        id="<?=$atributos['cnsProfissional']['iError']?>">
                    </p>
            </div>
        </div>

        <div class="form-group row">
            <label 
                for="<?=$atributos['cpfProfissional']['id']?>" 
                class="col-sm-3 col-form-label font-weight-bold">
                <?=$atributos['cpfProfissional']['label']?>
            </label>
            <div class="col-sm-8">
                <input 
                    id="<?=$atributos['cpfProfissional']['id']?>"
                    type="text" 
                    name="<?=$atributos['cpfProfissional']['name']?>" 
                    class="form-control" 
                    placeholder="<?=$atributos['cpfProfissional']['label']?>" 
                    onclick="clearMessageError('<?=$atributos['cpfProfissional']['iError']?>')">

                    <p
                        style="" 
                        class="text-danger mb-1"
                        id="<?=$atributos['cpfProfissional']['iError']?>">
                    </p>        
            </div>
        </div>

        <div class="form-group row">
            <label 
                for="<?=$atributos['numClasse']['id']?>" 
                class="col-sm-3 col-form-label font-weight-bold">
                <?=$atributos['numClasse']['label']?>
                    
            </label>
            <div class="col-sm-8">
                <input 
                    id="<?=$atributos['numClasse']['id']?>"
                    type="text" 
                    name="<?=$atributos['numClasse']['name']?>" 
                    class="form-control"
                    placeholder="<?=$atributos['numClasse']['label']?>">

            </div>
        </div>


        <div class="form-group row">
            <label 
                for="<?=$atributos['tipoProfissional']['id']?>" 
                class="col-sm-3 col-form-label font-weight-bold">
                <?=$atributos['tipoProfissional']['label']?>
            </label>
            <div class="col-sm-8">
                <select 
                    id="<?=$atributos['tipoProfissional']['id']?>"
                    class="custom-select" 
                    name="<?=$atributos['tipoProfissional']['name']?>" 
                    onclick="clearMessageError('<?=$atributos['tipoProfissional']['iError']?>')">
                    <option value="">selecione ...</option>
                    <option value="F">FUNCIONÁRIO</option>
                    <option value="V">VOLUNTÁRIO</option>
                    <option value="O">OUTROS</option>
                </select>
                <p
                    style="" 
                    class="text-danger mb-1"
                    id="<?=$atributos['tipoProfissional']['iError']?>">
                </p>   
            </div>
        </div>

        <div class="form-group row">
            <label 
                for="nome" 
                class="col-sm-3 col-form-label font-weight-bold">
                <?=$atributos['modalidade']['label']?>
            </label>
            <div class="col-sm-8">
                <select 
                    id=" <?=$atributos['modalidade']['id']?>"
                    class="custom-select" 
                    name=" <?=$atributos['modalidade']['name']?>" 
                    onclick="clearMessageError('<?=$atributos['modalidade']['iError']?>')">
                    <option value="">selecione ...</option>
                    <?php foreach ($modalidades as $modalidade) { ?>
                        <option value="<?php echo $modalidade->nomeModalidade; ?>">
                            <?php echo $modalidade->nomeModalidade; ?>
                        </option>
                    <?php }
                    ?>
                </select>
                <p
                    style="" 
                    class="text-danger mb-1"
                    id="<?=$atributos['modalidade']['iError']?>">
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
<script src="<?= base_url() ?>js/profissional.js"></script>
<?= $this->endSection(); ?>