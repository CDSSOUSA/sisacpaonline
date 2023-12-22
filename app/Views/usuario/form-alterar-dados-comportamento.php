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
                                <h5> <?php echo $dadosUsuario->idUsuario . ' - ' . $dadosUsuario->nomeUsuario; ?></h5>
                            </small>

                        </h2>
                    </div>
                    <div class="body">
                        <?php
                        $atributos_formulario = array('role' => 'form', 'class' => 'form-horizontal');

                        echo form_open('usuario/alterar_dados_comportamento', $atributos_formulario);
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
                                        echo '  ' . anchor('form_alterar_dados_foto/' . encrypt($dadosUsuario->idUsuario), 'Alterar', array('class' => 'text-center', 'title' => 'Alterar foto usuário'));

                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <?php
                                echo gerarbotaoVoltar('detalhar_usuario/' . encrypt($dadosUsuario->idUsuario));
                                ?>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">

                            </div>
                        </div>


                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Tipo de comportamento: </label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-checkbox">
                                            <!-- ECOLALIAS-->
                                            <?php if (empty($dadosUsuario->possuiEcolalias)) { ?>
                                                <input type="checkbox" id="iEcolalias" class="checkbox-inline" name="nEcolalias" value="S" <?php echo set_checkbox('nEcolalias', 'S', FALSE); ?> /> <label for="iEcolalias"> ECOLALIAS </label><br>
                                            <?php } else if ($dadosUsuario->possuiEcolalias == 'S') { ?>
                                                <input type="checkbox" id="iEcolalias" class="checkbox-inline" checked="true" name="nEcolalias" value="S" <?php echo set_checkbox('nEcolalias', 'S', TRUE); ?> /> <label for="iEcolalias"> ECOLALIAS </label><br>

                                            <?php } else { ?>
                                                <input type="checkbox" id="iOral" class="checkbox-inline" name="nEcolalias" value="N" <?php echo set_checkbox('nEcolalias', 'N', FALSE); ?> /> <label for="iEcolalias"> ECOLALIAS </label><br>

                                            <?php
                                            } ?>

                                            <!-- DESTRUTIVIDADE-->
                                            <?php if (empty($dadosUsuario->possuiDestrutividade)) { ?>
                                                <input type="checkbox" id="iDestrutividade" class="checkbox-inline" name="nDestrutividade" value="S" <?php echo set_checkbox('nDestrutividade', 'S'); ?> /> <label for="iDestrutividade"> DESTRUTIVIDADE </label><br>
                                            <?php } else if ($dadosUsuario->possuiDestrutividade == 'S') { ?>
                                                <input type="checkbox" id="iDestrutividade" class="checkbox-inline" checked="true" name="nDestrutividade" value="S" <?php echo set_checkbox('nDestrutividade', 'S'); ?> /> <label for="iDestrutividade"> DESTRUTIVIDADE </label><br>

                                            <?php } else { ?>
                                                <input type="checkbox" id="iDestrutividade" class="checkbox-inline" name="nDestrutividade" value="N" <?php echo set_checkbox('nDestrutividade', 'N'); ?> /> <label for="iDestrutividade"> DESTRUTIVIDADE </label><br>

                                            <?php
                                            } ?>

                                            <!-- FUGA-->
                                            <?php if (empty($dadosUsuario->possuiFuga)) { ?>
                                                <input type="checkbox" id="iFuga" class="checkbox-inline" name="nFuga" value="S" <?php echo set_checkbox('nFuga', 'S'); ?> /> <label for="iFuga"> FUGA </label><br>
                                            <?php } else if ($dadosUsuario->possuiFuga == 'S') { ?>
                                                <input type="checkbox" id="iFuga" class="checkbox-inline" checked="true" name="nFuga" value="S" <?php echo set_checkbox('nFuga', 'S'); ?> /> <label for="iFuga"> FUGA </label><br>

                                            <?php } else { ?>
                                                <input type="checkbox" id="iFuga" class="checkbox-inline" name="nFuga" value="N" <?php echo set_checkbox('nFuga', 'N'); ?> /> <label for="iFuga"> FUGA </label><br>
                                            <?php
                                            } ?>

                                            <!-- CHORO-->
                                            <?php if (empty($dadosUsuario->possuiChoro)) { ?>
                                                <input type="checkbox" id="iChoro" class="checkbox-inline" name="nChoro" value="S" <?php echo set_checkbox('nChoro', 'S'); ?> /> <label for="iChoro"> CHORO </label><br>
                                            <?php } else if ($dadosUsuario->possuiChoro == 'S') { ?>
                                                <input type="checkbox" id="iChoro" class="checkbox-inline" checked="true" name="nChoro" value="S" <?php echo set_checkbox('nChoro', 'S'); ?> /> <label for="iChoro"> CHORO </label><br>

                                            <?php } else { ?>
                                                <input type="checkbox" id="iChoro" class="checkbox-inline" name="nChoro" value="N" <?php echo set_checkbox('nChoro', 'N'); ?> /> <label for="iChoro"> CHORO </label><br>
                                            <?php
                                            } ?>

                                            <!-- RISOS-->
                                            <?php if (empty($dadosUsuario->possuiRisos)) { ?>
                                                <input type="checkbox" id="iRisos" class="checkbox-inline" name="nRisos" value="S" <?php echo set_checkbox('nRisos', 'S'); ?> /> <label for="iRisos"> RISOS </label><br>
                                            <?php } else if ($dadosUsuario->possuiRisos == 'S') { ?>
                                                <input type="checkbox" id="iRisos" class="checkbox-inline" checked="true" name="nRisos" value="S" <?php echo set_checkbox('nRisos', 'S'); ?> /> <label for="iRisos"> RISOS </label><br>

                                            <?php } else { ?>
                                                <input type="checkbox" id="iRisos" class="checkbox-inline" name="nRisos" value="N" <?php echo set_checkbox('nRisos', 'N'); ?> /> <label for="iRisos"> RISOS </label><br>

                                            <?php
                                            } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Autoagressão? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php if (empty($dadosUsuario->autoAgressao)) { ?>
                                                <input name="nAutoAgressao" value="S" <?php echo set_radio('nAutoAgressao', 'S', FALSE); ?> type="radio" class="with-gap" id="iAutoAgressaoSim" />
                                                <label for="iAutoAgressaoSim">SIM</label>
                                                <input name="nAutoAgressao" value="N" <?php echo set_radio('nAutoAgressao', 'N', FALSE); ?> type="radio" id="iAutoAgressaoNao" class="with-gap" />
                                                <label for="iAutoAgressaoNao">NÃO</label>
                                            <?php } else if ($dadosUsuario->autoAgressao == 'S') { ?>
                                                <input name="nAutoAgressao" checked="true" value="S" <?php echo set_radio('nAutoAgressao', 'S', FALSE); ?> type="radio" class="with-gap" id="iAutoAgressaoSim" />
                                                <label for="iAutoAgressaoSim">SIM</label>
                                                <input name="nAutoAgressao" value="N" <?php echo set_radio('nAutoAgressao', 'N', FALSE); ?> type="radio" id="iAutoAgressaoNao" class="with-gap" />
                                                <label for="iAutoAgressaoNao">NÃO</label>
                                            <?php } else { ?>
                                                <input name="nAutoAgressao" value="S" <?php echo set_radio('nAutoAgressao', 'S', FALSE); ?> type="radio" class="with-gap" id="iAutoAgressaoSim" />
                                                <label for="iAutoAgressaoSim">SIM</label>
                                                <input name="nAutoAgressao" value="N" checked="true" <?php echo set_radio('nAutoAgressao', 'N', FALSE); ?> type="radio" id="iAutoAgressaoNao" class="with-gap" />
                                                <label for="iAutoAgressaoNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nAutoAgressao']??'';?></span>
                                </div>
                            </div>
                        </div>


                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Em caso de sim, qual(is) tipo(s) de autoagressão?</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="iTipoAutoAgressao" name="nTipoAutoAgressao" value="<?php echo set_value('nTipoAutoAgressao', $dadosUsuario->tipoAgressao); ?>" class="form-control">

                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nTipoAutoAgressao']??'';?></span>
                                </div>
                            </div>
                        </div>


                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Heteroagressão *?</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php if (empty($dadosUsuario->heteroAgressao)) { ?>
                                                <input name="nHeteroagressao" value="S" <?php echo set_radio('nHeteroagressao', 'S', FALSE); ?> type="radio" class="with-gap" id="iHeteroagressaoSim" />
                                                <label for="iHeteroagressaoSim">SIM</label>
                                                <input name="nHeteroagressao" value="N" <?php echo set_radio('nHeteroagressao', 'N', FALSE); ?> type="radio" id="iHeteroagressaoNao" class="with-gap" />
                                                <label for="iHeteroagressaoNao">NÃO</label>
                                            <?php } else if ($dadosUsuario->heteroAgressao == 'S') { ?>
                                                <input name="nHeteroagressao" checked="true" value="S" <?php echo set_radio('nHeteroagressao', 'S', FALSE); ?> type="radio" class="with-gap" id="iHeteroagressaoSim" />
                                                <label for="iHeteroagressaoSim">SIM</label>
                                                <input name="nHeteroagressao" value="N" <?php echo set_radio('nHeteroagressao', 'N', FALSE); ?> type="radio" id="iHeteroagressaoNao" class="with-gap" />
                                                <label for="iHeteroagressaoNao">NÃO</label>
                                            <?php } else { ?>
                                                <input name="nHeteroagressao" value="S" <?php echo set_radio('nHeteroagressao', 'S', FALSE); ?> type="radio" class="with-gap" id="iHeteroagressaoSim" />
                                                <label for="iHeteroagressaoSim">SIM</label>
                                                <input name="nHeteroagressao" value="N" checked="true" <?php echo set_radio('nHeteroagressao', 'N', FALSE); ?> type="radio" id="iHeteroagressaoNao" class="with-gap" />
                                                <label for="iHeteroagressaoNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nHeteroagressao']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Em caso de sim, qual(is) tipo(s) de heteroagressão?</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="iTipoHeteroagressao" name="nTipoHeteroagressao" value="<?php echo set_value('nTipoHeteroagressao', $dadosUsuario->tipoHetero); ?>" class="form-control">

                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nTipoHeteroagressao']??'';?></span>
                                </div>
                            </div>
                        </div>


                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Movimentos esteriotipados? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php if (empty($dadosUsuario->movimentoEsteriotipado)) { ?>
                                                <input name="nMovimentoEsteriotipado" value="S" <?php echo set_radio('nMovimentoEsteriotipado', 'S', FALSE); ?> type="radio" class="with-gap" id="iMovimentoEsteriotipadoSim" />
                                                <label for="iMovimentoEsteriotipadoSim">SIM</label>
                                                <input name="nMovimentoEsteriotipado" value="N" <?php echo set_radio('nMovimentoEsteriotipado', 'N', FALSE); ?> type="radio" id="iMovimentoEsteriotipadoNao" class="with-gap" />
                                                <label for="iMovimentoEsteriotipadoNao">NÃO</label>
                                            <?php } else if ($dadosUsuario->movimentoEsteriotipado == 'S') { ?>
                                                <input name="nMovimentoEsteriotipado" checked="true" value="S" <?php echo set_radio('nMovimentoEsteriotipado', 'S', FALSE); ?> type="radio" class="with-gap" id="iMovimentoEsteriotipadoSim" />
                                                <label for="iMovimentoEsteriotipadoSim">SIM</label>
                                                <input name="nMovimentoEsteriotipado" value="N" <?php echo set_radio('nMovimentoEsteriotipado', 'N', FALSE); ?> type="radio" id="iMovimentoEsteriotipadoNao" class="with-gap" />
                                                <label for="iMovimentoEsteriotipadoNao">NÃO</label>
                                            <?php } else { ?>
                                                <input name="nMovimentoEsteriotipado" value="S" <?php echo set_radio('nMovimentoEsteriotipado', 'S', FALSE); ?> type="radio" class="with-gap" id="iMovimentoEsteriotipadoSim" />
                                                <label for="iMovimentoEsteriotipadoSim">SIM</label>
                                                <input name="nMovimentoEsteriotipado" value="N" checked="true" <?php echo set_radio('nMovimentoEsteriotipado', 'N', FALSE); ?> type="radio" id="iMovimentoEsteriotipadoNao" class="with-gap" />
                                                <label for="iMovimentoEsteriotipadoNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nMovimentoEsteriotipado']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Em caso de sim, qual(is) tipo(s) de movimentos?</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="iTipoMovimento" name="nTipoMovimento" value="<?php echo set_value('nTipoMovimento', $dadosUsuario->tipoMovimento); ?>" class="form-control">

                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nTipoMovimento']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Obedece ordens simples? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php if (empty($dadosUsuario->obedeceOrdem)) { ?>
                                                <input name="nObedeceOrdem" value="S" <?php echo set_radio('nObedeceOrdem', 'S', FALSE); ?> type="radio" class="with-gap" id="iObedeceOrdemSim" />
                                                <label for="iObedeceOrdemSim">SIM</label>
                                                <input name="nObedeceOrdem" value="N" <?php echo set_radio('nObedeceOrdem', 'N', FALSE); ?> type="radio" id="iObedeceOrdemNao" class="with-gap" />
                                                <label for="iObedeceOrdemNao">NÃO</label>
                                            <?php } else if ($dadosUsuario->obedeceOrdem == 'S') { ?>
                                                <input name="nObedeceOrdem" checked="true" value="S" <?php echo set_radio('nObedeceOrdem', 'S', FALSE); ?> type="radio" class="with-gap" id="iObedeceOrdemSim" />
                                                <label for="iObedeceOrdemSim">SIM</label>
                                                <input name="nObedeceOrdem" value="N" <?php echo set_radio('nObedeceOrdem', 'N', FALSE); ?> type="radio" id="iObedeceOrdemNao" class="with-gap" />
                                                <label for="iObedeceOrdemNao">NÃO</label>
                                            <?php } else { ?>
                                                <input name="nObedeceOrdem" value="S" <?php echo set_radio('nObedeceOrdem', 'S', FALSE); ?> type="radio" class="with-gap" id="iObedeceOrdemSim" />
                                                <label for="iObedeceOrdemSim">SIM</label>
                                                <input name="nObedeceOrdem" value="N" checked="true" <?php echo set_radio('nObedeceOrdem', 'N', FALSE); ?> type="radio" id="iObedeceOrdemNao" class="with-gap" />
                                                <label for="iObedeceOrdemNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nObedeceOrdem']??'';?></span>
                                </div>
                            </div>
                        </div>



                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Espera sua vez? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php if (empty($dadosUsuario->esperaVez)) { ?>
                                                <input name="nEsperaVez" value="S" <?php echo set_radio('nEsperaVez', 'S', FALSE); ?> type="radio" class="with-gap" id="iEsperaVezSim" />
                                                <label for="iEsperaVezSim">SIM</label>
                                                <input name="nEsperaVez" value="N" <?php echo set_radio('nEsperaVez', 'N', FALSE); ?> type="radio" id="iEsperaVezNao" class="with-gap" />
                                                <label for="iEsperaVezNao">NÃO</label>
                                            <?php } else if ($dadosUsuario->esperaVez == 'S') { ?>
                                                <input name="nEsperaVez" checked="true" value="S" <?php echo set_radio('nEsperaVez', 'S', FALSE); ?> type="radio" class="with-gap" id="iEsperaVezSim" />
                                                <label for="iEsperaVezSim">SIM</label>
                                                <input name="nEsperaVez" value="N" <?php echo set_radio('nEsperaVez', 'N', FALSE); ?> type="radio" id="iEsperaVezNao" class="with-gap" />
                                                <label for="iEsperaVezNao">NÃO</label>
                                            <?php } else { ?>
                                                <input name="nEsperaVez" value="S" <?php echo set_radio('nEsperaVez', 'S', FALSE); ?> type="radio" class="with-gap" id="iEsperaVezSim" />
                                                <label for="iEsperaVezSim">SIM</label>
                                                <input name="nEsperaVez" value="N" checked="true" <?php echo set_radio('nEsperaVez', 'N', FALSE); ?> type="radio" id="iEsperaVezNao" class="with-gap" />
                                                <label for="iEsperaVezNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nEsperaVez']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Em caso de não, o que faz?</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="iOrdemFaz" name="nOrdemFaz" value="<?php echo set_value('nOrdemFaz', $dadosUsuario->ordemFaz); ?>" class="form-control">

                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nOrdemFaz']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Tempo de tolerância em permanecer sentado ? Em minutos. </label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="iTempoSentado" name="nTempoSentado" value="<?php echo set_value('nTempoSentado', $dadosUsuario->tempoToleranciaSentado); ?>" class="form-control">

                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nTempoSentado']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Indica necessidade básica? </label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-checkbox">
                                            <!-- BANHEIRO-->
                                            <?php if (empty($dadosUsuario->necessidadeBanheiro)) { ?>
                                                <input type="checkbox" id="iNecessidadeBanheiro" class="checkbox-inline" name="nNecessidadeBanheiro" value="S" <?php echo set_checkbox('nNecessidadeBanheiro', 'S', FALSE); ?> /> <label for="iNecessidadeBanheiro"> BANHEIRO </label><br>
                                            <?php } else if ($dadosUsuario->necessidadeBanheiro == 'S') { ?>
                                                <input type="checkbox" id="iNecessidadeBanheiro" class="checkbox-inline" checked="true" name="nNecessidadeBanheiro" value="S" <?php echo set_checkbox('nNecessidadeBanheiro', 'S', TRUE); ?> /> <label for="iNecessidadeBanheiro"> BANHEIRO </label><br>

                                            <?php } else { ?>
                                                <input type="checkbox" id="iOral" class="checkbox-inline" name="nNecessidadeBanheiro" value="N" <?php echo set_checkbox('nNecessidadeBanheiro', 'N', FALSE); ?> /> <label for="iNecessidadeBanheiro"> BANHEIRO </label><br>

                                            <?php
                                            } ?>

                                            <!-- AGUA-->
                                            <?php if (empty($dadosUsuario->necessidadeAgua)) { ?>
                                                <input type="checkbox" id="iNecessidadeAgua" class="checkbox-inline" name="nNecessidadeAgua" value="S" <?php echo set_checkbox('nNecessidadeAgua', 'S'); ?> /> <label for="iNecessidadeAgua"> ÁGUA </label><br>
                                            <?php } else if ($dadosUsuario->necessidadeAgua == 'S') { ?>
                                                <input type="checkbox" id="iNecessidadeAgua" class="checkbox-inline" checked="true" name="nNecessidadeAgua" value="S" <?php echo set_checkbox('nNecessidadeAgua', 'S'); ?> /> <label for="iNecessidadeAgua"> ÁGUA </label><br>

                                            <?php } else { ?>
                                                <input type="checkbox" id="iNecessidadeAgua" class="checkbox-inline" name="nNecessidadeAgua" value="N" <?php echo set_checkbox('nNecessidadeAgua', 'N'); ?> /> <label for="iNecessidadeAgua"> ÁGUA </label><br>

                                            <?php
                                            } ?>

                                            <!-- DOR-->
                                            <?php if (empty($dadosUsuario->necessidadeDor)) { ?>
                                                <input type="checkbox" id="iNecessidadeDor" class="checkbox-inline" name="nNecessidadeDor" value="S" <?php echo set_checkbox('nNecessidadeDor', 'S'); ?> /> <label for="iNecessidadeDor"> DOR </label><br>
                                            <?php } else if ($dadosUsuario->necessidadeDor == 'S') { ?>
                                                <input type="checkbox" id="iNecessidadeDor" class="checkbox-inline" checked="true" name="nNecessidadeDor" value="S" <?php echo set_checkbox('nNecessidadeDor', 'S'); ?> /> <label for="iNecessidadeDor"> DOR </label><br>

                                            <?php } else { ?>
                                                <input type="checkbox" id="iNecessidadeDor" class="checkbox-inline" name="nNecessidadeDor" value="N" <?php echo set_checkbox('nNecessidadeDor', 'N'); ?> /> <label for="iNecessidadeDor"> DOR </label><br>
                                            <?php
                                            } ?>

                                            <!-- CANSAÇO-->
                                            <?php if (empty($dadosUsuario->necessidadeCansaco)) { ?>
                                                <input type="checkbox" id="iNecessidadeCansaco" class="checkbox-inline" name="nNecessidadeCansaco" value="S" <?php echo set_checkbox('nNecessidadeCansaco', 'S'); ?> /> <label for="iNecessidadeCansaco"> CANSAÇO </label><br>
                                            <?php } else if ($dadosUsuario->necessidadeCansaco == 'S') { ?>
                                                <input type="checkbox" id="iNecessidadeCansaco" class="checkbox-inline" checked="true" name="nNecessidadeCansaco" value="S" <?php echo set_checkbox('nNecessidadeCansaco', 'S'); ?> /> <label for="iNecessidadeCansaco"> CANSAÇO </label><br>

                                            <?php } else { ?>
                                                <input type="checkbox" id="iNecessidadeCansaco" class="checkbox-inline" name="nNecessidadeCansaco" value="N" <?php echo set_checkbox('nNecessidadeCansaco', 'N'); ?> /> <label for="iNecessidadeCansaco"> CANSAÇO </label><br>
                                            <?php
                                            } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Se indica de que forma? </label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="iFormaNecessidade" name="nFormaNecessidade" value="<?php echo set_value('nFormaNecessidade', $dadosUsuario->formaNecessidade); ?>" class="form-control">

                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nFormaNecessidade']??'';?></span>
                                </div>
                            </div>
                        </div>


                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Tem objeto de apego? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php if (empty($dadosUsuario->possuiObjetoApego)) { ?>
                                                <input name="nPossuiObjeto" value="S" <?php echo set_radio('nPossuiObjeto', 'S', FALSE); ?> type="radio" class="with-gap" id="iPossuiObjetoSim" />
                                                <label for="iPossuiObjetoSim">SIM</label>
                                                <input name="nPossuiObjeto" value="N" <?php echo set_radio('nPossuiObjeto', 'N', FALSE); ?> type="radio" id="iPossuiObjetoNao" class="with-gap" />
                                                <label for="iPossuiObjetoNao">NÃO</label>
                                            <?php } else if ($dadosUsuario->possuiObjetoApego == 'S') { ?>
                                                <input name="nPossuiObjeto" checked="true" value="S" <?php echo set_radio('nPossuiObjeto', 'S', FALSE); ?> type="radio" class="with-gap" id="iPossuiObjetoSim" />
                                                <label for="iPossuiObjetoSim">SIM</label>
                                                <input name="nPossuiObjeto" value="N" <?php echo set_radio('nPossuiObjeto', 'N', FALSE); ?> type="radio" id="iPossuiObjetoNao" class="with-gap" />
                                                <label for="iPossuiObjetoNao">NÃO</label>
                                            <?php } else { ?>
                                                <input name="nPossuiObjeto" value="S" <?php echo set_radio('nPossuiObjeto', 'S', FALSE); ?> type="radio" class="with-gap" id="iPossuiObjetoSim" />
                                                <label for="iPossuiObjetoSim">SIM</label>
                                                <input name="nPossuiObjeto" value="N" checked="true" <?php echo set_radio('nPossuiObjeto', 'N', FALSE); ?> type="radio" id="iPossuiObjetoNao" class="with-gap" />
                                                <label for="iPossuiObjetoNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nPossuiObjeto']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Se sim, qual objeto? </label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="iObjetoApego" name="nObjetoApego" value="<?php echo set_value('nObjetoApego', $dadosUsuario->objetoApego); ?>" class="form-control">

                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nObjetoApego']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Imita? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php if (empty($dadosUsuario->imita)) { ?>
                                                <input name="nImita" value="S" <?php echo set_radio('nImita', 'S', FALSE); ?> type="radio" class="with-gap" id="iImitaSim" />
                                                <label for="iImitaSim">SIM</label>
                                                <input name="nImita" value="N" <?php echo set_radio('nImita', 'N', FALSE); ?> type="radio" id="iImitaNao" class="with-gap" />
                                                <label for="iImitaNao">NÃO</label>
                                            <?php } else if ($dadosUsuario->imita == 'S') { ?>
                                                <input name="nImita" checked="true" value="S" <?php echo set_radio('nImita', 'S', FALSE); ?> type="radio" class="with-gap" id="iImitaSim" />
                                                <label for="iImitaSim">SIM</label>
                                                <input name="nImita" value="N" <?php echo set_radio('nImita', 'N', FALSE); ?> type="radio" id="iImitaNao" class="with-gap" />
                                                <label for="iImitaNao">NÃO</label>
                                            <?php } else { ?>
                                                <input name="nImita" value="S" <?php echo set_radio('nImita', 'S', FALSE); ?> type="radio" class="with-gap" id="iImitaSim" />
                                                <label for="iImitaSim">SIM</label>
                                                <input name="nImita" value="N" checked="true" <?php echo set_radio('nImita', 'N', FALSE); ?> type="radio" id="iImitaNao" class="with-gap" />
                                                <label for="iImitaNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nImita']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Aponta? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php if (empty($dadosUsuario->aponta)) { ?>
                                                <input name="nAponta" value="S" <?php echo set_radio('nAponta', 'S', FALSE); ?> type="radio" class="with-gap" id="iApontaSim" />
                                                <label for="iApontaSim">SIM</label>
                                                <input name="nAponta" value="N" <?php echo set_radio('nAponta', 'N', FALSE); ?> type="radio" id="iApontaNao" class="with-gap" />
                                                <label for="iApontaNao">NÃO</label>
                                            <?php } else if ($dadosUsuario->aponta == 'S') { ?>
                                                <input name="nAponta" checked="true" value="S" <?php echo set_radio('nAponta', 'S', FALSE); ?> type="radio" class="with-gap" id="iApontaSim" />
                                                <label for="iApontaSim">SIM</label>
                                                <input name="nAponta" value="N" <?php echo set_radio('nAponta', 'N', FALSE); ?> type="radio" id="iApontaNao" class="with-gap" />
                                                <label for="iApontaNao">NÃO</label>
                                            <?php } else { ?>
                                                <input name="nAponta" value="S" <?php echo set_radio('nAponta', 'S', FALSE); ?> type="radio" class="with-gap" id="iApontaSim" />
                                                <label for="iApontaSim">SIM</label>
                                                <input name="nAponta" value="N" checked="true" <?php echo set_radio('nAponta', 'N', FALSE); ?> type="radio" id="iApontaNao" class="with-gap" />
                                                <label for="iApontaNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nAponta']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Controla esfíncter vesical (xixi)? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php if (empty($dadosUsuario->controleXixi)) { ?>
                                                <input name="nControleXixi" value="S" <?php echo set_radio('nControleXixi', 'S', FALSE); ?> type="radio" class="with-gap" id="iControleXixiSim" />
                                                <label for="iControleXixiSim">SIM</label>
                                                <input name="nControleXixi" value="N" <?php echo set_radio('nControleXixi', 'N', FALSE); ?> type="radio" id="iControleXixiNao" class="with-gap" />
                                                <label for="iControleXixiNao">NÃO</label>
                                            <?php } else if ($dadosUsuario->controleXixi == 'S') { ?>
                                                <input name="nControleXixi" checked="true" value="S" <?php echo set_radio('nControleXixi', 'S', FALSE); ?> type="radio" class="with-gap" id="iControleXixiSim" />
                                                <label for="iControleXixiSim">SIM</label>
                                                <input name="nControleXixi" value="N" <?php echo set_radio('nControleXixi', 'N', FALSE); ?> type="radio" id="iControleXixiNao" class="with-gap" />
                                                <label for="iControleXixiNao">NÃO</label>
                                            <?php } else { ?>
                                                <input name="nControleXixi" value="S" <?php echo set_radio('nControleXixi', 'S', FALSE); ?> type="radio" class="with-gap" id="iControleXixiSim" />
                                                <label for="iControleXixiSim">SIM</label>
                                                <input name="nControleXixi" value="N" checked="true" <?php echo set_radio('nControleXixi', 'N', FALSE); ?> type="radio" id="iControleXixiNao" class="with-gap" />
                                                <label for="iControleXixiNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nControleXixi']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Controla esfíncter vesical (cocô)? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php if (empty($dadosUsuario->controleCoco)) { ?>
                                                <input name="nControleCoco" value="S" <?php echo set_radio('nControleCoco', 'S', FALSE); ?> type="radio" class="with-gap" id="iControleCocoSim" />
                                                <label for="iControleCocoSim">SIM</label>
                                                <input name="nControleCoco" value="N" <?php echo set_radio('nControleCoco', 'N', FALSE); ?> type="radio" id="iControleCocoNao" class="with-gap" />
                                                <label for="iControleCocoNao">NÃO</label>
                                            <?php } else if ($dadosUsuario->controleCoco == 'S') { ?>
                                                <input name="nControleCoco" checked="true" value="S" <?php echo set_radio('nControleCoco', 'S', FALSE); ?> type="radio" class="with-gap" id="iControleCocoSim" />
                                                <label for="iControleCocoSim">SIM</label>
                                                <input name="nControleCoco" value="N" <?php echo set_radio('nControleCoco', 'N', FALSE); ?> type="radio" id="iControleCocoNao" class="with-gap" />
                                                <label for="iControleCocoNao">NÃO</label>
                                            <?php } else { ?>
                                                <input name="nControleCoco" value="S" <?php echo set_radio('nControleCoco', 'S', FALSE); ?> type="radio" class="with-gap" id="iControleCocoSim" />
                                                <label for="iControleCocoSim">SIM</label>
                                                <input name="nControleCoco" value="N" checked="true" <?php echo set_radio('nControleCoco', 'N', FALSE); ?> type="radio" id="iControleCocoNao" class="with-gap" />
                                                <label for="iControleCocoNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nControleCoco']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Interage com outras crianças em sala? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php if (empty($dadosUsuario->interageCrianca)) { ?>
                                                <input name="nInterageCrianca" value="S" <?php echo set_radio('nInterageCrianca', 'S', FALSE); ?> type="radio" class="with-gap" id="iInterageCriancaSim" />
                                                <label for="iInterageCriancaSim">SIM</label>
                                                <input name="nInterageCrianca" value="N" <?php echo set_radio('nInterageCrianca', 'N', FALSE); ?> type="radio" id="iInterageCriancaNao" class="with-gap" />
                                                <label for="iInterageCriancaNao">NÃO</label>
                                            <?php } else if ($dadosUsuario->interageCrianca == 'S') { ?>
                                                <input name="nInterageCrianca" checked="true" value="S" <?php echo set_radio('nInterageCrianca', 'S', FALSE); ?> type="radio" class="with-gap" id="iInterageCriancaSim" />
                                                <label for="iInterageCriancaSim">SIM</label>
                                                <input name="nInterageCrianca" value="N" <?php echo set_radio('nInterageCrianca', 'N', FALSE); ?> type="radio" id="iInterageCriancaNao" class="with-gap" />
                                                <label for="iInterageCriancaNao">NÃO</label>
                                            <?php } else { ?>
                                                <input name="nInterageCrianca" value="S" <?php echo set_radio('nInterageCrianca', 'S', FALSE); ?> type="radio" class="with-gap" id="iInterageCriancaSim" />
                                                <label for="iInterageCriancaSim">SIM</label>
                                                <input name="nInterageCrianca" value="N" checked="true" <?php echo set_radio('nInterageCrianca', 'N', FALSE); ?> type="radio" id="iInterageCriancaNao" class="with-gap" />
                                                <label for="iInterageCriancaNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nInterageCrianca']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Possui seletividade alimentar? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php if (empty($dadosUsuario->seletividadeAlimentar)) { ?>
                                                <input name="nSeletividadeAlimentar" value="S" <?php echo set_radio('nSeletividadeAlimentar', 'S', FALSE); ?> type="radio" class="with-gap" id="iSeletividadeAlimentarSim" />
                                                <label for="iSeletividadeAlimentarSim">SIM</label>
                                                <input name="nSeletividadeAlimentar" value="N" <?php echo set_radio('nSeletividadeAlimentar', 'N', FALSE); ?> type="radio" id="iSeletividadeAlimentarNao" class="with-gap" />
                                                <label for="iSeletividadeAlimentarNao">NÃO</label>
                                            <?php } else if ($dadosUsuario->seletividadeAlimentar == 'S') { ?>
                                                <input name="nSeletividadeAlimentar" checked="true" value="S" <?php echo set_radio('nSeletividadeAlimentar', 'S', FALSE); ?> type="radio" class="with-gap" id="iSeletividadeAlimentarSim" />
                                                <label for="iSeletividadeAlimentarSim">SIM</label>
                                                <input name="nSeletividadeAlimentar" value="N" <?php echo set_radio('nSeletividadeAlimentar', 'N', FALSE); ?> type="radio" id="iSeletividadeAlimentarNao" class="with-gap" />
                                                <label for="iSeletividadeAlimentarNao">NÃO</label>
                                            <?php } else { ?>
                                                <input name="nSeletividadeAlimentar" value="S" <?php echo set_radio('nSeletividadeAlimentar', 'S', FALSE); ?> type="radio" class="with-gap" id="iSeletividadeAlimentarSim" />
                                                <label for="iSeletividadeAlimentarSim">SIM</label>
                                                <input name="nSeletividadeAlimentar" value="N" checked="true" <?php echo set_radio('nSeletividadeAlimentar', 'N', FALSE); ?> type="radio" id="iSeletividadeAlimentarNao" class="with-gap" />
                                                <label for="iSeletividadeAlimentarNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nSeletividadeAlimentar']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Se sim, Qual(is) alimentos? </label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="iQualAlimento" name="nQualAlimento" value="<?php echo set_value('nQualAlimento', $dadosUsuario->qualAlimentacao); ?>" class="form-control">

                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nQualAlimento']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-offset-5 col-md-offset-5 col-sm-offset-6 col-xs-offset-6">
                                <?php
                                echo session()->get('botaoSalvar');
                                echo session()->get('botaoLimpar');
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