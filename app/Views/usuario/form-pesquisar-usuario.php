<?php 
echo $this->extend('layout/home');
echo $this->section('content'); ?>

<section class="content">
    <div class="container-fluid">
        <!-- Basic Example -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?php 
                    echo view('layout/alert/alert-sucesso');
                    echo view('layout/alert/alert-erro');
                    echo view('layout/alert/alert-erro-preenchimento');
                    session()->remove('erro');
                 ?>
                <div class="card">

                    <div class="header bg-indigo">
                        <h2><?=$titulo;?><small>Utilize uma das opões abaixo.</small></h2>                                           
                  
                    </div>
                    <div class="body">
                        <?php
                        $atributos_formulario = array(
                            'role' => 'form',
                            'class' => 'form-horizontal'
                        );
                        echo form_open('usuario/pesquisar_usuario', $atributos_formulario);
                        echo csrf_field();
                        ?>
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label>Código do usuário: </label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" 
                                                id="iCodigo" 
                                                name="nCodigo" 
                                                class="form-control apenasNumero" 
                                                autofocus 
                                                pattern ="[0-9]+$" 
                                                title ="Digite apenas números!" 
                                                placeholder="Digite o Código do usuario"
                                                value="<?= old('nCodigo') ?>" >
                                    </div>
                                    <span style="color: red"><?= session()->get('errors')['nCodigo']??'';?></span>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">

                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label> Nome do usuário: </label>
                            </div>

                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">

                                <div class="form-group">

                                    <div class="form-line">
                                        <input type="text" 
                                                id="iNome" 
                                                name ="nNome" 
                                                class="form-control" 
                                                placeholder="Digite o nome do usuario"
                                                value="<?= old('nNome') ?>">
                                    </div>
                                    <span style="color: red"><?= session()->get('errors')['nNome']??'';?></span>

                                </div>

                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-offset-3 col-md-offset-3 col-sm-offset-4 col-xs-offset-5">
                                <?php echo session()->get('botaoPesquisar'); ?>
                            </div>
                        </div>

                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?= $this->endSection();?>

