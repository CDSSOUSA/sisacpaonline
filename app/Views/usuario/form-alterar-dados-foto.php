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
                            <?php echo $titulo; ?>
                            <small>
                                <h5><?php echo $dadosUsuario->idUsuario . ' - ' . $dadosUsuario->nomeUsuario; ?></h5>
                            </small>

                        </h2>
                    </div>
                    <div class="body">
                        <?php
                        $atributos_formulario = array('role' => 'form', 'class' => 'form-horizontal');

                        echo form_open_multipart('usuario/alterar_dados_foto', $atributos_formulario);
                        echo form_hidden('nIdUsuario', $dadosUsuario->idUsuario);
                        echo form_hidden('nFotoUsuario', $dadosUsuario->fotoUsuario);
                        ?>
                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="">
                                    <div class="form-line text-center">

                                    <?php  
                                            
                                                                                       
                                            echo img(array('src'=>'img/fotos/'.$dadosUsuario->fotoUsuario, 'height'=>'80', 'widht'=>'80', 'class'=>'image-area')); 
                                            //echo br(). anchor('form-alterar-foto/'.encrypt($dadosUsuario->idUsuario), 'Alterar', array('class'=>'text-center','title'=>'Alterar foto usuário'));

                                            ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <?php
                                echo gerarbotaoVoltar('usuario/detalhar_usuario/' . encrypt($dadosUsuario->idUsuario));
                                ?>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">

                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Nova foto: *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                    <input type="file" id="iNovaFoto" name="nNovaFoto" value="<?php echo set_value('nNovaFoto'); ?>" class="form-control">
</div>
<span style="color:red"><?= session()->get('errors')['nNovaFoto']??'';?></span>
                                </div>
                            </div>
                        </div>  
                        
                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label><span style="color:red">ATENÇÃO PARA FOTO</span></label><br>
                                <label>Tamanho máximo permitido: 1Mb</label><br>
                                <label>Largura x altura máximo permitidos: 200 x 200(px)</label><br>
                                <label>Tipos de arquivo permitidos: .jpg|.gif|.png</label>
                            </div>
                            
                        </div>    

                        
                        <div class="row clearfix">
                            <div class="col-lg-offset-5 col-md-offset-5 col-sm-offset-6 col-xs-offset-6">
                                <?php
                                echo session()-> get('botaoSalvar');
                                echo session()-> get('botaoLimpar');
                                echo gerarbotaoVoltar('usuario/detalhar_usuario/' . encrypt($dadosUsuario->idUsuario));
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