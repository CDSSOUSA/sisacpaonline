<?php
echo $this->extend('layout/home');
echo $this->section('content');
?>
<section class="content">
    <div class="container-fluid">
        <?php
        echo view('layout/alert/alert-erro');
        echo view('layout/alert/alert-erro-preenchimento');
        session()->remove('erro');
        session()->remove('sucesso');
        ?>
           <div class="col-12 p-2">
                <div class="card">
        <div class="card-header bg-indigo">
                        <h3 class="card-title font-weight-bold">
                            <?= $titulo; ?> ::
                        </h3>
                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <div class="input-group-append">
                                    <?= anchor('profissional/form_editar_profissional', '<i class="fas fa-plus"></i> Listar profissional', ["class" => "btn btn-secondary btn-sm"]); ?>
                                </div>
                            </div>
                        </div>
                    </div>



            <?php
                        $atributos_formulario = array('role' => 'form', 'class' => 'form-horizontal');
                        echo form_open('profissional/cadastrar_profissional', $atributos_formulario);
                        ?>
                <div class="card-body">

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Nome completo : *</label>
                        <div class="col-sm-10">
                            <input type="text" name="nNomeProfissional"
                                value="<?php echo set_value('nNomeProfissional') ?>" class="form-control" autofocus
                                placeholder="Nome completo">

                                <span style="color:red">
                                    <?= session()->get('errors')['nNomeProfissional'] ?? ''; ?>
                                </span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Gênero : *</label>
                        <div class="col-sm-10">
                           <div class="icheck-material-teal">
                                            <input name="nGenero" type="radio" class="with-gap" id="iGeneroMasc"
                                                value="M" <?php echo set_radio('nGenero', 'M', FALSE); ?> />
                                            <label for="iGeneroMasc">Masc</label>
                           </div>
                           <div class="icheck-material-teal">
                                            <input name="nGenero" type="radio" id="iGeneroFemi" class="with-gap"
                                                value="F" <?php echo set_radio('nGenero', 'F', FALSE); ?> />
                                            <label for="iGeneroFemi">Femi</label>
                                        </div>

                                        <span style="color:red">
                                            <?= session()->get('errors')['nGenero'] ?? ''; ?>
                                        </span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">CNS profissional: *</label>
                        <div class="col-sm-10">
                            <input type="text" name="nCnsProfissional"
                                            value="<?php echo set_value('nCnsProfissional') ?>" class="form-control cns"
                                            placeholder="CNS do profissional">
                                            <span style="color:red">
                                                <?= session()->get('errors')['nCnsProfissional'] ?? ''; ?>
                                            </span>
                                    </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Número CPF: *</label>
                        <div class="col-sm-10">
                        <input type="text" name="nCpfProfissional" class="form-control"
                                            value="<?php echo set_value('nCpfProfissional') ?>"
                                            placeholder="Número do CPF">

                                            <span style="color:red">
                                                <?= session()->get('errors')['nCpfProfissional'] ?? ''; ?>
                                            </span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Núm. Cons. Classe: </label>
                        <div class="col-sm-10">
                         <input type="text" name="nConselhoClasse" class="form-control"
                                            value="<?php echo set_value('nConselhoClasse') ?>"
                                            placeholder="Número do Conselho de classe">

                        </div>
                        <span style="color:red">
                            <?= session()->get('errors')['nConselhoClasse'] ?? ''; ?>
                        </span>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Tipo profissional: *</label>
                        <div class="col-sm-10">
                        <select class="form-control show-tick" name="nTipoProfissional">
                                            <option value="">selecione ...</option>
                                            <option value="F" <?php echo set_select('nTipoProfissional', 'F', FALSE); ?>>FUNCIONÁRIO</option>
                                            <option value="V" <?php echo set_select('nTipoProfissional', 'V', FALSE); ?>>VOLUNTÁRIO</option>
                                            <option value="O" <?php echo set_select('nTipoProfissional', 'O', FALSE); ?>>OUTROS</option>
                                        </select>

                                        <span style="color:red">
                                            <?= session()->get('errors')['nTipoProfissional'] ?? ''; ?>
                                        </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label align-right">Modalidade: *</label>
                        <div class="col-sm-10">
                        <select class="form-control show-tick" name="nModalidade">
                                            <option value="">selecione ...</option>
                                            <?php foreach ($modalidades as $modalidade) { ?>
                                                <option value="<?php echo $modalidade->nomeModalidade; ?>" <?php echo set_select('nModalidade', $modalidade->nomeModalidade, FALSE); ?>>
                                                    <?php echo $modalidade->nomeModalidade; ?>
                                                </option>
                                            <?php }
                                            ?>
                                        </select>

                                        <span style="color:red">
                                            <?= session()->get('errors')['nModalidade'] ?? ''; ?>
                                        </span>
                        </div>
                    </div>

                   

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-default "><i class="fas fa-times"></i> Cancelar</button>
                    <button type="submit" class="btn btn-success float-right"><i class="fas fa-save"></i> Salvar</button>
                </div>

            </form>
        </div>        
    </div>
</section>

<?= $this->endSection(); ?>