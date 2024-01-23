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
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header bg-indigo">
                        <h2>
                            <?= $titulo; ?>
                            <small>* Escolha uma opção para iniciar o cadastro de usuário.</small>
                        </h2>
                    </div>
                    <div class="body">
                        <?php
                        $atributos_formulario = array('role' => 'form', 'class' => 'form-horizontal');
                        echo form_open('profissional/cadastrar_profissional', $atributos_formulario);
                        ?>
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label>Nome completo: *</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nNomeProfissional" value="<?php echo set_value('nNomeProfissional') ?>" class="form-control" autofocus placeholder="Nome completo">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nNomeProfissional']??'';?></span>                                     
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label>Genero: *</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <input name="nGenero" type="radio" class="with-gap" id="iGeneroMasc" value="M" <?php echo set_radio('nGenero', 'M', FALSE); ?> />
                                            <label for="iGeneroMasc">Masc</label>
                                            <input name="nGenero" type="radio" id="iGeneroFemi" class="with-gap" value="F" <?php echo set_radio('nGenero', 'F', FALSE); ?> />
                                            <label for="iGeneroFemi">Femi</label>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nGenero']??'';?></span> 
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label>CNS do Profissional: *</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nCnsProfissional" value="<?php echo set_value('nCnsProfissional') ?>" class="form-control cns" placeholder="CNS do profissional">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nCnsProfissional']??'';?></span> 
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label>Numero do CPF: *</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nCpfProfissional" class="form-control" value="<?php echo set_value('nCpfProfissional') ?>" placeholder="Número do CPF">

                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nCpfProfissional']??'';?></span> 
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label>Num. do cons. de classe: </label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nConselhoClasse" class="form-control" value="<?php echo set_value('nConselhoClasse') ?>" placeholder="Número do Conselho de classe">

                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nConselhoClasse']??'';?></span> 
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label>Tipo profissional: * </label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <select class="form-control show-tick" name="nTipoProfissional">
                                            <option value="">selecione ...</option>
                                            <option value="F" <?php echo set_select('nTipoProfissional', 'F', FALSE); ?>>FUNCIONÁRIO</option>
                                            <option value="V" <?php echo set_select('nTipoProfissional', 'V', FALSE); ?>>VOLUNTÁRIO</option>
                                            <option value="O" <?php echo set_select('nTipoProfissional', 'O', FALSE); ?>>OUTROS</option>
                                        </select>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nTipoProfissional']??'';?></span> 
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label>Modalidade * </label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <select class="form-control show-tick" name="nModalidade">
                                            <option value="">selecione ...</option>
                                            <?php foreach ($modalidades AS $modalidade) { ?>
                                                <option value="<?php echo $modalidade->nomeModalidade; ?>" <?php echo set_select('nModalidade', $modalidade->nomeModalidade, FALSE); ?>><?php echo $modalidade->nomeModalidade; ?></option>
                                            <?php }
                                            ?>
                                        </select>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nModalidade']??'';?></span> 
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-offset-3 col-md-offset-3 col-sm-offset-4 col-xs-offset-5">
                                <?php
                                    echo session()->get('botaoSalvar');
                                    echo session()->get('botaoLimpar');                                
                                ?>
                            </div>
                        </div>

                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>