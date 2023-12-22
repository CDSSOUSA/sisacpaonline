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

                        echo form_open('usuario/alterar_dados_comunicacao', $atributos_formulario);
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
                                echo gerarbotaoVoltar('usuario/detalhar_usuario/' . encrypt($dadosUsuario->idUsuario));
                                ?>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">

                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Tipo de comunicação: *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php

                                            if (empty($dadosUsuario->tipoComunicacao)) { ?>
                                                <input name="nTipoComunicacao" type="radio" class="with-gap" id="iVerbal" value="V" <?php echo set_radio('nTipoComunicacao', 'V', false); ?> />
                                                <label for="iVerbal">VERBAL</label>
                                                <input name="nTipoComunicacao" type="radio" id="iNaoVerbal" class="with-gap" value="N" <?php echo set_radio('nTipoComunicacao', 'N', false); ?> />
                                                <label for="iNaoVerbal">NÃO VERBAL</label>

                                            <?php } else if ($dadosUsuario->tipoComunicacao == 'V') {
                                            ?>
                                                <input name="nTipoComunicacao" type="radio" checked="true" class="with-gap" id="iVerbal" value="V" <?php echo set_radio('nTipoComunicacao', 'V', false); ?> />
                                                <label for="iVerbal">VERBAL</label>
                                                <input name="nTipoComunicacao" type="radio" id="iNaoVerbal" class="with-gap" value="N" <?php echo set_radio('nTipoComunicacao', 'N', false); ?> />
                                                <label for="iNaoVerbal">NÃO VERBAL</label>

                                            <?php
                                            } else {
                                            ?>
                                                <input name="nTipoComunicacao" type="radio" class="with-gap" id="iVerbal" value="V" <?php echo set_radio('nTipoComunicacao', 'V', false); ?> />
                                                <label for="iVerbal">VERBAL</label>
                                                <input name="nTipoComunicacao" type="radio" checked="true" id="iNaoVerbal" class="with-gap" value="N" <?php echo set_radio('nTipoComunicacao', 'N', false); ?> />
                                                <label for="iNaoVerbal">NÃO VERBAL</label>

                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nTipoComunicacao']??'';?></span>                                   
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Tipo de expressão: </label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-checkbox">
                                            <!-- ORAL-->
                                            <?php if (empty($dadosUsuario->expressaoOral)) { ?>
                                                <input type="checkbox" id="iOral" class="checkbox-inline" name="nOral" value="S" <?php echo set_checkbox('nOral', 'S', FALSE); ?> /> <label for="iOral"> ORAL (fala) </label><br>
                                            <?php } else if ($dadosUsuario->expressaoOral == 'S') { ?>
                                                <input type="checkbox" id="iOral" class="checkbox-inline" checked="true" name="nOral" value="S" <?php echo set_checkbox('nOral', 'S', FALSE); ?> /> <label for="iOral"> ORAL (fala) </label><br>

                                            <?php } else { ?>
                                                <input type="checkbox" id="iOral" class="checkbox-inline" name="nOral" value="N" <?php echo set_checkbox('nOral', 'N', FALSE); ?> /> <label for="iOral"> ORAL (fala) </label><br>

                                            <?php
                                            } ?>

                                            <!-- GESTOS-->
                                            <?php if (empty($dadosUsuario->expressaoGestos)) { ?>
                                                <input type="checkbox" id="iGestos" class="checkbox-inline" name="nGestos" value="S" <?php echo set_checkbox('nGestos', 'S'); ?> /> <label for="iGestos"> GESTOS </label><br>
                                            <?php } else if ($dadosUsuario->expressaoGestos == 'S') { ?>
                                                <input type="checkbox" id="iGestos" class="checkbox-inline" checked="true" name="nGestos" value="S" <?php echo set_checkbox('nGestos', 'S'); ?> /> <label for="iGestos"> GESTOS </label><br>

                                            <?php } else { ?>
                                                <input type="checkbox" id="iGestos" class="checkbox-inline" name="nGestos" value="N" <?php echo set_checkbox('nGestos', 'N'); ?> /> <label for="iGestos"> GESTOS </label><br>

                                            <?php
                                            } ?>

                                            <!-- APONTA-->
                                            <?php if (empty($dadosUsuario->expressaoAponta)) { ?>
                                                <input type="checkbox" id="iAponta" class="checkbox-inline" name="nAponta" value="S" <?php echo set_checkbox('nAponta', 'S'); ?> /> <label for="iAponta"> APONTA </label><br>
                                            <?php } else if ($dadosUsuario->expressaoAponta == 'S') { ?>
                                                <input type="checkbox" id="iAponta" class="checkbox-inline" checked="true" name="nAponta" value="S" <?php echo set_checkbox('nAponta', 'S'); ?> /> <label for="iAponta"> APONTA </label><br>

                                            <?php } else { ?>
                                                <input type="checkbox" id="iAponta" class="checkbox-inline" name="nAponta" value="N" <?php echo set_checkbox('nAponta', 'N'); ?> /> <label for="iAponta"> APONTA </label><br>
                                            <?php
                                            } ?>

                                            <!-- GRITOS-->
                                            <?php if (empty($dadosUsuario->expressaoGritos)) { ?>
                                                <input type="checkbox" id="iGritos" class="checkbox-inline" name="nGritos" value="S" <?php echo set_checkbox('nGritos', 'S'); ?> /> <label for="iGritos"> GRITOS </label><br>
                                            <?php } else if ($dadosUsuario->expressaoGritos == 'S') { ?>
                                                <input type="checkbox" id="iGritos" class="checkbox-inline" checked="true" name="nGritos" value="S" <?php echo set_checkbox('nGritos', 'S'); ?> /> <label for="iGritos"> GRITOS </label><br>

                                            <?php } else { ?>
                                                <input type="checkbox" id="iGritos" class="checkbox-inline" name="nGritos" value="N" <?php echo set_checkbox('nGritos', 'N'); ?> /> <label for="iGritos"> GRITOS </label><br>
                                            <?php
                                            } ?>

                                            <!-- GRUNIDOS-->
                                            <?php if (empty($dadosUsuario->expressaoGrunidos)) { ?>
                                                <input type="checkbox" id="iGrunidos" class="checkbox-inline" name="nGrunidos" value="S" <?php echo set_checkbox('nGrunidos', 'S'); ?> /> <label for="iGrunidos"> GRUNIDOS </label><br>
                                            <?php } else if ($dadosUsuario->expressaoGrunidos == 'S') { ?>
                                                <input type="checkbox" id="iGrunidos" class="checkbox-inline" checked="true" name="nGrunidos" value="S" <?php echo set_checkbox('nGrunidos', 'S'); ?> /> <label for="iGrunidos"> GRUNIDOS </label><br>

                                            <?php } else { ?>
                                                <input type="checkbox" id="iGrunidos" class="checkbox-inline" name="nGrunidos" value="N" <?php echo set_checkbox('nGrunidos', 'N'); ?> /> <label for="iGrunidos"> GRUNIDOS </label><br>

                                            <?php
                                            } ?>

                                            <!-- FIGURAS-->
                                            <?php if (empty($dadosUsuario->expressaoFiguras)) { ?>
                                                <input type="checkbox" id="iFiguras" class="checkbox-inline" name="nFiguras" value="S" <?php echo set_checkbox('nFiguras', 'S'); ?> /> <label for="iFiguras"> USA FIGURAS OU OUTRO APOIO </label><br>
                                            <?php } else if ($dadosUsuario->expressaoFiguras == 'S') { ?>
                                                <input type="checkbox" id="iFiguras" class="checkbox-inline" checked="true" name="nFiguras" value="S" <?php echo set_checkbox('nFiguras', 'S'); ?> /> <label for="iFiguras"> USA FIGURAS OU OUTRO APOIO </label><br>

                                            <?php } else { ?>
                                                <input type="checkbox" id="iFiguras" class="checkbox-inline" name="nFiguras" value="N" <?php echo set_checkbox('nFiguras', 'N', FALSE); ?> /> <label for="iFiguras"> USA FIGURAS OU OUTRO APOIO </label><br>

                                            <?php
                                            } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Tem ecolalias? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php if (empty($dadosUsuario->possuiEcolalias)) { ?>
                                                <input name="nPossuiEcolalias" value="S" <?php echo set_radio('nPossuiEcolalias', 'S', FALSE); ?> type="radio" class="with-gap" id="iPossuiEscolaliasSim" />
                                                <label for="iPossuiEscolaliasSim">SIM</label>
                                                <input name="nPossuiEcolalias" value="N" <?php echo set_radio('nPossuiEcolalias', 'N', FALSE); ?> type="radio" id="iPossuiEscolaliasNao" class="with-gap" />
                                                <label for="iPossuiEscolaliasNao">NÃO</label>
                                            <?php } else if ($dadosUsuario->possuiEcolalias == 'S') { ?>
                                                <input name="nPossuiEcolalias" checked="true" value="S" <?php echo set_radio('nPossuiEcolalias', 'S', FALSE); ?> type="radio" class="with-gap" id="iPossuiEscolaliasSim" />
                                                <label for="iPossuiEscolaliasSim">SIM</label>
                                                <input name="nPossuiEcolalias" value="N" <?php echo set_radio('nPossuiEcolalias', 'N', FALSE); ?> type="radio" id="iPossuiEscolaliasNao" class="with-gap" />
                                                <label for="iPossuiEscolaliasNao">NÃO</label>
                                            <?php } else { ?>
                                                <input name="nPossuiEcolalias" value="S" <?php echo set_radio('nPossuiEcolalias', 'S', FALSE); ?> type="radio" class="with-gap" id="iPossuiEscolaliasSim" />
                                                <label for="iPossuiEscolaliasSim">SIM</label>
                                                <input name="nPossuiEcolalias" value="N" checked="true" <?php echo set_radio('nPossuiEcolalias', 'N', FALSE); ?> type="radio" id="iPossuiEscolaliasNao" class="with-gap" />
                                                <label for="iPossuiEscolaliasNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nPossuiEcolalias']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Pede ajuda? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php if (empty($dadosUsuario->pedeAjuda)) { ?>
                                                <input name="nPedeAjuda" value="S" <?php echo set_radio('nPedeAjuda', 'S', FALSE); ?> type="radio" class="with-gap" id="iPedeAjudaSim" />
                                                <label for="iPedeAjudaSim">SIM</label>
                                                <input name="nPedeAjuda" value="N" <?php echo set_radio('nPedeAjuda', 'N', FALSE); ?> type="radio" id="iPedeAjudaNao" class="with-gap" />
                                                <label for="iPedeAjudaNao">NÃO</label>
                                            <?php } else if ($dadosUsuario->pedeAjuda == 'S') { ?>
                                                <input name="nPedeAjuda" checked="true" value="S" <?php echo set_radio('nPedeAjuda', 'S', FALSE); ?> type="radio" class="with-gap" id="iPedeAjudaSim" />
                                                <label for="iPedeAjudaSim">SIM</label>
                                                <input name="nPedeAjuda" value="N" <?php echo set_radio('nPedeAjuda', 'N', FALSE); ?> type="radio" id="iPedeAjudaNao" class="with-gap" />
                                                <label for="iPedeAjudaNao">NÃO</label>
                                            <?php } else { ?>
                                                <input name="nPedeAjuda" value="S" <?php echo set_radio('nPedeAjuda', 'S', FALSE); ?> type="radio" class="with-gap" id="iPedeAjudaSim" />
                                                <label for="iPedeAjudaSim">SIM</label>
                                                <input name="nPedeAjuda" value="N" checked="true" <?php echo set_radio('nPedeAjuda', 'N', FALSE); ?> type="radio" id="iPedeAjudaNao" class="with-gap" />
                                                <label for="iPedeAjudaNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nPedeAjuda']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Em caso de sim, pede ajuda de que forma?</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="iformaAjuda" name="nFormaAjuda" value="<?php echo set_value('nFormaAjuda', $dadosUsuario->formaAjuda); ?>" class="form-control">

                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nFormaAjuda']??'';?></span>
                                </div>
                            </div>
                        </div>


                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Solicita o que quer? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php if (empty($dadosUsuario->solicita)) { ?>
                                                <input name="nSolicita" value="S" <?php echo set_radio('nSolicita', 'S', FALSE); ?> type="radio" class="with-gap" id="iSolicitaSim" />
                                                <label for="iSolicitaSim">SIM</label>
                                                <input name="nSolicita" value="N" <?php echo set_radio('nSolicita', 'N', FALSE); ?> type="radio" id="iSolicitaNao" class="with-gap" />
                                                <label for="iSolicitaNao">NÃO</label>
                                            <?php } else if ($dadosUsuario->solicita == 'S') { ?>
                                                <input name="nSolicita" checked="true" value="S" <?php echo set_radio('nSolicita', 'S', FALSE); ?> type="radio" class="with-gap" id="iSolicitaSim" />
                                                <label for="iSolicitaSim">SIM</label>
                                                <input name="nSolicita" value="N" <?php echo set_radio('nSolicita', 'N', FALSE); ?> type="radio" id="iSolicitaNao" class="with-gap" />
                                                <label for="iSolicitaNao">NÃO</label>
                                            <?php } else { ?>
                                                <input name="nSolicita" value="S" <?php echo set_radio('nSolicita', 'S', FALSE); ?> type="radio" class="with-gap" id="iSolicitaSim" />
                                                <label for="iSolicitaSim">SIM</label>
                                                <input name="nSolicita" value="N" checked="true" <?php echo set_radio('nSolicita', 'N', FALSE); ?> type="radio" id="iSolicitaNao" class="with-gap" />
                                                <label for="iSolicitaNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nSolicita']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Faz perguntas? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php if (empty($dadosUsuario->fazPergunta)) { ?>
                                                <input name="nFazPerguntas" value="S" <?php echo set_radio('nFazPerguntas', 'S', FALSE); ?> type="radio" class="with-gap" id="iFazPerguntasSim" />
                                                <label for="iFazPerguntasSim">SIM</label>
                                                <input name="nFazPerguntas" value="N" <?php echo set_radio('nFazPerguntas', 'N', FALSE); ?> type="radio" id="iFazPerguntasNao" class="with-gap" />
                                                <label for="iFazPerguntasNao">NÃO</label>
                                            <?php } else if ($dadosUsuario->fazPergunta == 'S') { ?>
                                                <input name="nFazPerguntas" checked="true" value="S" <?php echo set_radio('nFazPerguntas', 'S', FALSE); ?> type="radio" class="with-gap" id="iFazPerguntasSim" />
                                                <label for="iFazPerguntasSim">SIM</label>
                                                <input name="nFazPerguntas" value="N" <?php echo set_radio('nFazPerguntas', 'N', FALSE); ?> type="radio" id="iFazPerguntasNao" class="with-gap" />
                                                <label for="iFazPerguntasNao">NÃO</label>
                                            <?php } else { ?>
                                                <input name="nFazPerguntas" value="S" <?php echo set_radio('nFazPerguntas', 'S', FALSE); ?> type="radio" class="with-gap" id="iFazPerguntasSim" />
                                                <label for="iFazPerguntasSim">SIM</label>
                                                <input name="nFazPerguntas" value="N" checked="true" <?php echo set_radio('nFazPerguntas', 'N', FALSE); ?> type="radio" id="iFazPerguntasNao" class="with-gap" />
                                                <label for="iFazPerguntasNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nFazPerguntas']??'';?></span>
                                </div>
                            </div>
                        </div>



                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Responde quando é chamado pelo nome? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php if (empty($dadosUsuario->respondeChamado)) { ?>
                                                <input name="nRespondeChamando" value="S" <?php echo set_radio('nRespondeChamando', 'S', FALSE); ?> type="radio" class="with-gap" id="iRespondeChamadaSim" />
                                                <label for="iRespondeChamadaSim">SIM</label>
                                                <input name="nRespondeChamando" value="N" <?php echo set_radio('nRespondeChamando', 'N', FALSE); ?> type="radio" id="iRespondeChamadaNao" class="with-gap" />
                                                <label for="iRespondeChamadaNao">NÃO</label>
                                                <input name="nRespondeChamando" value="V" <?php echo set_radio('nRespondeChamando', 'V', FALSE); ?> type="radio" id="iRespondeChamadaVezes" class="with-gap" />
                                                <label for="iRespondeChamadaVezes">AS VEZES</label>
                                            <?php } else if ($dadosUsuario->respondeChamado == 'S') { ?>
                                                <input name="nRespondeChamando" checked="true" value="S" <?php echo set_radio('nRespondeChamando', 'S', FALSE); ?> type="radio" class="with-gap" id="iRespondeChamadaSim" />
                                                <label for="iRespondeChamadaSim">SIM</label>
                                                <input name="nRespondeChamando" value="N" <?php echo set_radio('nRespondeChamando', 'N', FALSE); ?> type="radio" id="iRespondeChamadaNao" class="with-gap" />
                                                <label for="iRespondeChamadaNao">NÃO</label>
                                                <input name="nRespondeChamando" value="V" <?php echo set_radio('nRespondeChamando', 'V', FALSE); ?> type="radio" id="iRespondeChamadaVezes" class="with-gap" />
                                                <label for="iRespondeChamadaVezes">ÀS VEZES</label>
                                            <?php } else if ($dadosUsuario->respondeChamado == 'N') { ?>
                                                <input name="nRespondeChamando" value="S" <?php echo set_radio('nRespondeChamando', 'S', FALSE); ?> type="radio" class="with-gap" id="iRespondeChamadaSim" />
                                                <label for="iRespondeChamadaSim">SIM</label>
                                                <input name="nRespondeChamando" value="N" checked="true" <?php echo set_radio('nRespondeChamando', 'N', FALSE); ?> type="radio" id="iRespondeChamadaNao" class="with-gap" />
                                                <label for="iRespondeChamadaNao">NÃO</label>
                                                <input name="nRespondeChamando" value="V" <?php echo set_radio('nRespondeChamando', 'V', FALSE); ?> type="radio" id="iRespondeChamadaVezes" class="with-gap" />
                                                <label for="iRespondeChamadaVezes">ÀS VEZES</label>
                                            <?php } else { ?>
                                                <input name="nRespondeChamando" value="S" <?php echo set_radio('nRespondeChamando', 'S', FALSE); ?> type="radio" class="with-gap" id="iRespondeChamadaSim" />
                                                <label for="iRespondeChamadaSim">SIM</label>
                                                <input name="nRespondeChamando" value="N" <?php echo set_radio('nRespondeChamando', 'N', FALSE); ?> type="radio" id="iRespondeChamadaNao" class="with-gap" />
                                                <label for="iRespondeChamadaNao">NÃO</label>
                                                <input name="nRespondeChamando" value="V" checked="true" <?php echo set_radio('nRespondeChamando', 'V', FALSE); ?> type="radio" id="iRespondeChamadaVezes" class="with-gap" />
                                                <label for="iRespondeChamadaVezes">ÀS VEZES</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nRespondeChamando']??'';?></span>
                                </div>
                            </div>
                        </div>


                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Tem boa compreensão do que falam? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php if (empty($dadosUsuario->compreensaoFala)) { ?>
                                                <input name="nCompreensaoFala" value="S" <?php echo set_radio('nCompreensaoFala', 'S', FALSE); ?> type="radio" class="with-gap" id="iCompreensaoFalaSim" />
                                                <label for="iCompreensaoFalaSim">SIM</label>
                                                <input name="nCompreensaoFala" value="N" <?php echo set_radio('nCompreensaoFala', 'N', FALSE); ?> type="radio" id="iCompreensaoFalaNao" class="with-gap" />
                                                <label for="iCompreensaoFalaNao">NÃO</label>
                                                <input name="nCompreensaoFala" value="V" <?php echo set_radio('nCompreensaoFala', 'V', FALSE); ?> type="radio" id="iCompreensaoFalaVezes" class="with-gap" />
                                                <label for="iCompreensaoFalaVezes">ÀS VEZES</label>
                                            <?php } else if ($dadosUsuario->compreensaoFala == 'S') { ?>
                                                <input name="nCompreensaoFala" checked="true" value="S" <?php echo set_radio('nCompreensaoFala', 'S', FALSE); ?> type="radio" class="with-gap" id="iCompreensaoFalaSim" />
                                                <label for="iCompreensaoFalaSim">SIM</label>
                                                <input name="nCompreensaoFala" value="N" <?php echo set_radio('nCompreensaoFala', 'N', FALSE); ?> type="radio" id="iCompreensaoFalaNao" class="with-gap" />
                                                <label for="iCompreensaoFalaNao">NÃO</label>
                                                <input name="nCompreensaoFala" value="V" <?php echo set_radio('nCompreensaoFala', 'V', FALSE); ?> type="radio" id="iCompreensaoFalaVezes" class="with-gap" />
                                                <label for="iCompreensaoFalaVezes">ÀS VEZES</label>
                                            <?php } else if ($dadosUsuario->compreensaoFala == 'N') { ?>
                                                <input name="nCompreensaoFala" value="S" <?php echo set_radio('nCompreensaoFala', 'S', FALSE); ?> type="radio" class="with-gap" id="iCompreensaoFalaSim" />
                                                <label for="iCompreensaoFalaSim">SIM</label>
                                                <input name="nCompreensaoFala" value="N" checked="true" <?php echo set_radio('nCompreensaoFala', 'N', FALSE); ?> type="radio" id="iCompreensaoFalaNao" class="with-gap" />
                                                <label for="iCompreensaoFalaNao">NÃO</label>
                                                <input name="nCompreensaoFala" value="V" <?php echo set_radio('nCompreensaoFala', 'V', FALSE); ?> type="radio" id="iCompreensaoFalaVezes" class="with-gap" />
                                                <label for="iCompreensaoFalaVezes">ÀS VEZES</label>
                                            <?php } else { ?>
                                                <input name="nCompreensaoFala" value="S" <?php echo set_radio('nCompreensaoFala', 'S', FALSE); ?> type="radio" class="with-gap" id="iCompreensaoFalaSim" />
                                                <label for="iCompreensaoFalaSim">SIM</label>
                                                <input name="nCompreensaoFala" value="N" <?php echo set_radio('nCompreensaoFala', 'N', FALSE); ?> type="radio" id="iCompreensaoFalaNao" class="with-gap" />
                                                <label for="iCompreensaoFalaNao">NÃO</label>
                                                <input name="nCompreensaoFala" value="V" checked="true" <?php echo set_radio('nCompreensaoFala', 'V', FALSE); ?> type="radio" id="iCompreensaoFalaVezes" class="with-gap" />
                                                <label for="iCompreensaoFalaVezes">ÀS VEZES</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nCompreensaoFala']??'';?></span>
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