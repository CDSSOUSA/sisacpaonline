<!-- INSERIR NO BANCO DE DADOS 
CREATE TABLE tb_documento_justificativa(
	idDocumento INT NOT NULL AUTO_INCREMENT,
    dataRegistro DATETIME DEFAULT CURRENT_DATE,
    documento VARCHAR(255),
    idOperador SMALLINT UNSIGNED,
    idUsuario SMALLINT UNSIGNED,
    idRegistroAtendimento INT UNSIGNED,
    CONSTRAINT idDocumento_pk PRIMARY KEY (idDocumento),
    CONSTRAINT idUsuarioDocumento_fk FOREIGN KEY (idUsuario) REFERENCES tb_usuario (idUsuario),
    CONSTRAINT idRegistroAtendimentoDocumento_fk FOREIGN KEY (idRegistroAtendimento) REFERENCES tb_registro_atendimento (idRegistroAtendimento),
    CONSTRAINT idOperadorDocumento_pk FOREIGN KEY (idOperador) REFERENCES tb_operador (idOperador),
    CONSTRAINT idRegistroAndimento_uk UNIQUE (idRegistroAtendimento)
)ENGINE = INNODB;
-->
<?php
echo $this->extend('layout/home');
echo $this->section('content');
?>

<section class="content">
    <div class="container-fluid">
        <?php
        echo view('layout/alert/alert-sucesso');
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
                                <h5>

                                    <?php echo $dadosUsuario->idUsuario . ' - ' . $dadosUsuario->nomeUsuario; ?>
                            </small>
                            </h5>



                        </h2>
                    </div>
                    <div class="body">



                        <?php
                        

                        $atributos_formulario = array('role' => 'form', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data');
                        echo form_open('atendimento/alterar_documento', $atributos_formulario);
                        echo form_hidden('nIdUsuario', $dadosUsuario->idUsuario);
                        echo form_hidden('nIdRegistroAtendimento', $dadosAtendimento->idRegistroAtendimento);
                        ?>
                        <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                            <label>Data atendimento: </label>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <h4>

                                        <?php echo converteParaDataBrasileira($dadosAtendimento->dataAtendimento); ?>
                                    </h4>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                            <label>Profissional | Modalidade: </label>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <?php echo '<h4>' . ($dadosAtendimento->idProfissional . ' - ' . abrevPalavras($dadosAtendimento->nomeProfissional, 2) . ' - ' . $dadosAtendimento->modalidade) . '</h4>'; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                            <label>Justificativa: </label>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <?php echo '<h4>' . ($dadosAtendimento->textoJustificativaFalta) . '</h4>'; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>Imagem: *</label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
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
                                <label><span style="color:red">ATENÇÃO PARA IMAGEM</span></label><br>
                                <label>Tamanho máximo permitido: 1Mb</label><br>
                                <label>Largura x altura máximo permitidos: 200 x 200(px)</label><br>
                                <label>Tipos de arquivo permitidos: .jpg|.gif|.png</label>
                            </div>

                        </div>


                        <div class="row clearfix">
                            <div class="col-lg-offset-5 col-md-offset-5 col-sm-offset-6 col-xs-offset-6">
                                <?php
                                echo session()->get('botaoSalvar');
                                echo session()->get('botaoLimpar');
                                echo gerarbotaoVoltar('atendimento/listar_faltas_usuario/' . encrypt($dadosUsuario->idUsuario));
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
<?php $this->endSection();
