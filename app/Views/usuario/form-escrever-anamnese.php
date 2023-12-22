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
                            <small>  <h5><?php echo $dadosUsuario->idUsuario . ' - ' . $dadosUsuario->nomeUsuario; ?></h5></small>

                        </h2>
                    </div>
                    <div class="body">
                        <?php
                        $atributos_formulario = array('role' => 'form', 'class' => 'form-horizontal');

                        echo form_open('usuario/escrever_anamnese_ep01', $atributos_formulario);
                        echo form_hidden('nIdUsuario', $dadosUsuario->idUsuario);
                        ?>
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="">
                                    <div class="form-line text-center">

                                        <?php
                                        echo img(array('src' => 'img/fotos/' . $dadosUsuario->fotoUsuario, 'height' => '80', 'widht' => '80', 'class' => 'image-area'));
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
                            <label style = "text-decoration: underline";>DADOS PESSOAIS:</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">                              
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Tem apelido? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->temApelido))
                                            {
                                                ?>
                                                <input name="nTemApelido" value="S" <?php echo set_radio('nTemApelido', 'S', FALSE); ?> type="radio" class="with-gap" id="iTemApelidoSim" />
                                                <label for="iTemApelidoSim">SIM</label>
                                                <input name="nTemApelido" value="N" <?php echo set_radio('nTemApelido', 'N', FALSE); ?> type="radio" class="with-gap" id="iTemApelidoNao" />
                                                <label for="iTemApelidoNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->temApelido == 'S')
                                            {
                                                ?>
                                                <input name="nTemApelido" value="S" checked="true" <?php echo set_radio('nTemApelido', 'S', FALSE); ?> type="radio" class="with-gap" id="iTemApelidoSim" />
                                                <label for="iTemApelidoSim">SIM</label>
                                                <input name="nTemApelido" value="N" <?php echo set_radio('nTemApelido', 'N', FALSE); ?> type="radio" class="with-gap" id="iTemApelidoNao" />
                                                <label for="iTemApelidoNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nTemApelido" value="S"  <?php echo set_radio('nTemApelido', 'S', FALSE); ?> type="radio" class="with-gap" id="iTemApelidoSim" />
                                                <label for="iTemApelidoSim">SIM</label>
                                                <input name="nTemApelido" value="N" checked="true" <?php echo set_radio('nTemApelido', 'N', FALSE); ?> type="radio" class="with-gap" id="iTemApelidoNao" />
                                                <label for="iTemApelidoNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nTemApelido']??'';?></span>                                   
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Qual apelido? </label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nApelido" value="<?php echo set_value('nApelido', $dadosUsuario->qualApelido); ?>" class="form-control">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nApelido']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Ele gosta? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->gosta))
                                            {
                                                ?>
                                                <input name="nGosta" value="S" <?php echo set_radio('nGosta', 'S', FALSE); ?> type="radio" class="with-gap" id="iGostaSim" />
                                                <label for="iGostaSim">SIM</label>
                                                <input name="nGosta" value="N" <?php echo set_radio('nGosta', 'N', FALSE); ?> type="radio" class="with-gap" id="iGostaNao" />
                                                <label for="iGostaNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->gosta == 'S')
                                            {
                                                ?>
                                                <input name="nGosta" value="S" checked="true" <?php echo set_radio('nGosta', 'S', FALSE); ?> type="radio" class="with-gap" id="iGostaSim" />
                                                <label for="iGostaSim">SIM</label>
                                                <input name="nGosta" value="N" <?php echo set_radio('nGosta', 'N', FALSE); ?> type="radio" class="with-gap" id="iGostaNao" />
                                                <label for="iGostaNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nGosta" value="S"  <?php echo set_radio('nGosta', 'S', FALSE); ?> type="radio" class="with-gap" id="iGostaSim" />
                                                <label for="iGostaSim">SIM</label>
                                                <input name="nGosta" value="N" checked="true" <?php echo set_radio('nGosta', 'N', FALSE); ?> type="radio" class="with-gap" id="iGostaNao" />
                                                <label for="iGostaNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nGosta']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Por que esse apelido? </label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nPorqueApelido" value="<?php echo set_value('nPorqueApelido', $dadosUsuario->porqueApelido); ?>" class="form-control">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nPorqueApelido']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Pai, estudou até: </label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nPaiEstudou" value="<?php echo set_value('nPaiEstudou', $dadosUsuario->paiEstudouAte); ?>" class="form-control numeroMaxDois">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nPaiEstudou']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Pai, teve dificuldades? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->paiDificuldade))
                                            {
                                                ?>
                                                <input name="nPaiDificuldade" value="S" <?php echo set_radio('nPaiDificuldade', 'S', FALSE); ?> type="radio" class="with-gap" id="iPaiDificuldadeSim" />
                                                <label for="iPaiDificuldadeSim">SIM</label>
                                                <input name="nPaiDificuldade" value="N" <?php echo set_radio('nPaiDificuldade', 'N', FALSE); ?> type="radio" class="with-gap" id="iPaiDificuldadeNao" />
                                                <label for="iPaiDificuldadeNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->paiDificuldade == 'S')
                                            {
                                                ?>
                                                <input name="nPaiDificuldade" value="S" checked="true" <?php echo set_radio('nPaiDificuldade', 'S', FALSE); ?> type="radio" class="with-gap" id="iPaiDificuldadeSim" />
                                                <label for="iPaiDificuldadeSim">SIM</label>
                                                <input name="nPaiDificuldade" value="N" <?php echo set_radio('nPaiDificuldade', 'N', FALSE); ?> type="radio" class="with-gap" id="iPaiDificuldadeNao" />
                                                <label for="iPaiDificuldadeNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nPaiDificuldade" value="S"  <?php echo set_radio('nPaiDificuldade', 'S', FALSE); ?> type="radio" class="with-gap" id="iPaiDificuldadeSim" />
                                                <label for="iPaiDificuldadeSim">SIM</label>
                                                <input name="nPaiDificuldade" value="N" checked="true" <?php echo set_radio('nPaiDificuldade', 'N', FALSE); ?> type="radio" class="with-gap" id="iPaiDificuldadeNao" />
                                                <label for="iPaiDificuldadeNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nPaiDificuldade']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Pai, se formou? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->paiFormou))
                                            {
                                                ?>
                                                <input name="nPaiFormou" value="S" <?php echo set_radio('nPaiFormou', 'S', FALSE); ?> type="radio" class="with-gap" id="iPaiFormouSim" />
                                                <label for="iPaiFormouSim">SIM</label>
                                                <input name="nPaiFormou" value="N" <?php echo set_radio('nPaiFormou', 'N', FALSE); ?> type="radio" class="with-gap" id="iPaiFormouNao" />
                                                <label for="iPaiFormouNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->paiFormou == 'S')
                                            {
                                                ?>
                                                <input name="nPaiFormou" value="S" checked="true" <?php echo set_radio('nPaiFormou', 'S', FALSE); ?> type="radio" class="with-gap" id="iPaiFormouSim" />
                                                <label for="iPaiFormouSim">SIM</label>
                                                <input name="nPaiFormou" value="N" <?php echo set_radio('nPaiFormou', 'N', FALSE); ?> type="radio" class="with-gap" id="iPaiFormouNao" />
                                                <label for="iPaiFormouNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nPaiFormou" value="S"  <?php echo set_radio('nPaiFormou', 'S', FALSE); ?> type="radio" class="with-gap" id="iPaiFormouSim" />
                                                <label for="iPaiFormouSim">SIM</label>
                                                <input name="nPaiFormou" value="N" checked="true" <?php echo set_radio('nPaiFormou', 'N', FALSE); ?> type="radio" class="with-gap" id="iPaiFormouNao" />
                                                <label for="iPaiFormouNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nPaiFormou']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Mãe, estudou até: </label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nMaeEstudou" value="<?php echo set_value('nMaeEstudou', $dadosUsuario->maeEstudouAte); ?>" class="form-control numeroMaxDois">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nMaeEstudou']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Mãe, teve dificuldades? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->maeDificuldade))
                                            {
                                                ?>
                                                <input name="nMaeDificuldade" value="S" <?php echo set_radio('nMaeDificuldade', 'S', FALSE); ?> type="radio" class="with-gap" id="iMaeDificuldadeSim" />
                                                <label for="iMaeDificuldadeSim">SIM</label>
                                                <input name="nMaeDificuldade" value="N" <?php echo set_radio('nMaeDificuldade', 'N', FALSE); ?> type="radio" class="with-gap" id="iMaeDificuldadeNao" />
                                                <label for="iMaeDificuldadeNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->maeDificuldade == 'S')
                                            {
                                                ?>
                                                <input name="nMaeDificuldade" value="S" checked="true" <?php echo set_radio('nMaeDificuldade', 'S', FALSE); ?> type="radio" class="with-gap" id="iMaeDificuldadeSim" />
                                                <label for="iMaeDificuldadeSim">SIM</label>
                                                <input name="nMaeDificuldade" value="N" <?php echo set_radio('nMaeDificuldade', 'N', FALSE); ?> type="radio" class="with-gap" id="iMaeDificuldadeNao" />
                                                <label for="iMaeDificuldadeNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nMaeDificuldade" value="S"  <?php echo set_radio('nMaeDificuldade', 'S', FALSE); ?> type="radio" class="with-gap" id="iMaeDificuldadeSim" />
                                                <label for="iMaeDificuldadeSim">SIM</label>
                                                <input name="nMaeDificuldade" value="N" checked="true" <?php echo set_radio('nMaeDificuldade', 'N', FALSE); ?> type="radio" class="with-gap" id="iMaeDificuldadeNao" />
                                                <label for="iMaeDificuldadeNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nMaeDificuldade']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Mãe, se formou? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->maeFormou))
                                            {
                                                ?>
                                                <input name="nMaeFormou" value="S" <?php echo set_radio('nMaeFormou', 'S', FALSE); ?> type="radio" class="with-gap" id="iMaeFormouSim" />
                                                <label for="iMaeFormouSim">SIM</label>
                                                <input name="nMaeFormou" value="N" <?php echo set_radio('nMaeFormou', 'N', FALSE); ?> type="radio" class="with-gap" id="iMaeFormouNao" />
                                                <label for="iMaeFormouNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->maeFormou == 'S')
                                            {
                                                ?>
                                                <input name="nMaeFormou" value="S" checked="true" <?php echo set_radio('nMaeFormou', 'S', FALSE); ?> type="radio" class="with-gap" id="iMaeFormouSim" />
                                                <label for="iMaeFormouSim">SIM</label>
                                                <input name="nMaeFormou" value="N" <?php echo set_radio('nMaeFormou', 'N', FALSE); ?> type="radio" class="with-gap" id="iMaeFormouNao" />
                                                <label for="iMaeFormouNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nMaeFormou" value="S"  <?php echo set_radio('nMaeFormou', 'S', FALSE); ?> type="radio" class="with-gap" id="iMaeFormouSim" />
                                                <label for="iMaeFormouSim">SIM</label>
                                                <input name="nMaeFormou" value="N" checked="true" <?php echo set_radio('nMaeFormou', 'N', FALSE); ?> type="radio" class="with-gap" id="iMaeFormouNao" />
                                                <label for="iMaeFormouNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nMaeFormou']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Irmãos (nome e idade): </label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nIrmaos" value="<?php echo set_value('nIrmaos', $dadosUsuario->nomeIrmaos); ?>" class="form-control">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nIrmaos']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Esquema familiar: *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea rows="4" name="nEsquemaFamiliar" class="form-control no-resize textareaLimite1" placeholder="Digite o texto ... Enter para mudar de linha."><?php echo set_value('nEsquemaFamiliar', $dadosUsuario->esquemaFamiliar); ?></textarea>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nEsquemaFamiliar']??'';?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                            <label style = "text-decoration: underline";>QUEIXAS:</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">                               
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Na escola: *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea rows="4" name="nQueixaEscola" class="form-control no-resize textareaLimite1" placeholder="Digite o texto ... Enter para mudar de linha."><?php echo set_value('nQueixaEscola', $dadosUsuario->queixaEscola); ?></textarea>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nQueixaEscola']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Indicado por: </label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nIndicadoPor" value="<?php echo set_value('nIndicadoPor', $dadosUsuario->indicadoPor); ?>" class="form-control">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nIndicadoPor']??'';?></span>
                                </div>
                            </div>
                        </div>                     
                        <div class="row clearfix">
                            <div class="col-lg-offset-5 col-md-offset-5 col-sm-offset-6 col-xs-offset-6">
                                <button class="btn bg-teal waves-effect" type="submit"><span class="badge">S</span> ALVAR
                                    <i class="material-icons"> keyboard_tab </i> 02. ETAPA
                                </button>
                                <?php
                                //echo session()-> get('botaoSalvar');
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