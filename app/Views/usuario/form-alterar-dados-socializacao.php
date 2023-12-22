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

                        echo form_open('usuario/alterar_dados_socializacao', $atributos_formulario);
                        echo form_hidden('nIdUsuario', $dadosUsuario->idUsuario);
                        ?>
                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
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
                                <label>Tem amigos? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php if (empty($dadosUsuario->possuiAmigos)) { ?>
                                                <input name="nPossuiAmigos" value="S" <?php echo set_radio('nPossuiAmigos', 'S', FALSE); ?> type="radio" class="with-gap" id="iPossuiAmigosSim" />
                                                <label for="iPossuiAmigosSim">SIM</label>
                                                <input name="nPossuiAmigos" value="N" <?php echo set_radio('nPossuiAmigos', 'N', FALSE); ?> type="radio" id="iPossuiAmigosNao" class="with-gap" />
                                                <label for="iPossuiAmigosNao">NÃO</label>
                                            <?php } else if ($dadosUsuario->possuiAmigos == 'S') { ?>
                                                <input name="nPossuiAmigos" checked="true" value="S" <?php echo set_radio('nPossuiAmigos', 'S', FALSE); ?> type="radio" class="with-gap" id="iPossuiAmigosSim" />
                                                <label for="iPossuiAmigosSim">SIM</label>
                                                <input name="nPossuiAmigos" value="N" <?php echo set_radio('nPossuiAmigos', 'N', FALSE); ?> type="radio" id="iPossuiAmigosNao" class="with-gap" />
                                                <label for="iPossuiAmigosNao">NÃO</label>
                                            <?php } else { ?>
                                                <input name="nPossuiAmigos" value="S" <?php echo set_radio('nPossuiAmigos', 'S', FALSE); ?> type="radio" class="with-gap" id="iPossuiAmigosSim" />
                                                <label for="iPossuiAmigosSim">SIM</label>
                                                <input name="nPossuiAmigos" value="N" checked="true" <?php echo set_radio('nPossuiAmigos', 'N', FALSE); ?> type="radio" id="iPossuiAmigosNao" class="with-gap" />
                                                <label for="iPossuiAmigosNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nPossuiAmigos']??'';?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Prefere brincar: *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php if (empty($dadosUsuario->brinca)) { ?>
                                                <input name="nBrinca" value="S" <?php echo set_radio('nBrinca', 'S', FALSE); ?> type="radio" class="with-gap" id="iBrincaSozinho" />
                                                <label for="iBrincaSozinho">SOZINHO</label>
                                                <input name="nBrinca" value="A" <?php echo set_radio('nBrinca', 'A', FALSE); ?> type="radio" id="iBrincaAcompanhado" class="with-gap" />
                                                <label for="iBrincaAcompanhado">ACOMPANHADO</label>
                                            <?php } else if ($dadosUsuario->brinca == 'S') { ?>
                                                <input name="nBrinca" checked="true" value="S" <?php echo set_radio('nBrinca', 'S', FALSE); ?> type="radio" class="with-gap" id="iBrincaSozinho" />
                                                <label for="iBrincaSozinho">SOZINHO</label>
                                                <input name="nBrinca" value="A" <?php echo set_radio('nBrinca', 'A', FALSE); ?> type="radio" id="iBrincaAcompanhado" class="with-gap" />
                                                <label for="iBrincaAcompanhado">ACOMPANHADO</label>
                                            <?php } else { ?>
                                                <input name="nBrinca" value="S" <?php echo set_radio('nBrinca', 'S', FALSE); ?> type="radio" class="with-gap" id="iBrincaSozinho" />
                                                <label for="iBrincaSozinho">SOZINHO</label>
                                                <input name="nBrinca" value="A" checked="true" <?php echo set_radio('nBrinca', 'A', FALSE); ?> type="radio" id="iBrincaAcompanhado" class="with-gap" />
                                                <label for="iBrincaAcompanhado">ACOMPANHADO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nBrinca']??'';?></span>
                                </div>
                            </div>
                        </div>


                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Que tipos de brincadeiras prefere?</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="iTipoBrincadeira" name="nTipoBrincadeira" value="<?php echo set_value('nTipoBrincadeira', $dadosUsuario->tipoBrincadeira); ?>" class="form-control">

                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nTipoBrincadeira']??'';?></span>
                                </div>
                            </div>
                        </div>


                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Brinca de faz de conta? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php if (empty($dadosUsuario->brincaFazConta)) { ?>
                                                <input name="nBrincaFazConta" value="S" <?php echo set_radio('nBrincaFazConta', 'S', FALSE); ?> type="radio" class="with-gap" id="iBrincaFazContaSim" />
                                                <label for="iBrincaFazContaSim">SIM</label>
                                                <input name="nBrincaFazConta" value="N" <?php echo set_radio('nBrincaFazConta', 'N', FALSE); ?> type="radio" id="iBrincaFazContaNao" class="with-gap" />
                                                <label for="iBrincaFazContaNao">NÃO</label>
                                            <?php } else if ($dadosUsuario->brincaFazConta == 'S') { ?>
                                                <input name="nBrincaFazConta" checked="true" value="S" <?php echo set_radio('nBrincaFazConta', 'S', FALSE); ?> type="radio" class="with-gap" id="iBrincaFazContaSim" />
                                                <label for="iBrincaFazContaSim">SIM</label>
                                                <input name="nBrincaFazConta" value="N" <?php echo set_radio('nBrincaFazConta', 'N', FALSE); ?> type="radio" id="iBrincaFazContaNao" class="with-gap" />
                                                <label for="iBrincaFazContaNao">NÃO</label>
                                            <?php } else { ?>
                                                <input name="nBrincaFazConta" value="S" <?php echo set_radio('nBrincaFazConta', 'S', FALSE); ?> type="radio" class="with-gap" id="iBrincaFazContaSim" />
                                                <label for="iBrincaFazContaSim">SIM</label>
                                                <input name="nBrincaFazConta" value="N" checked="true" <?php echo set_radio('nBrincaFazConta', 'N', FALSE); ?> type="radio" id="iBrincaFazContaNao" class="with-gap" />
                                                <label for="iBrincaFazContaNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nBrincaFazConta']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Imita animais? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php if (empty($dadosUsuario->imitaAnimal)) { ?>
                                                <input name="nImitaAnimal" value="S" <?php echo set_radio('nImitaAnimal', 'S', FALSE); ?> type="radio" class="with-gap" id="iImitaAnimalSim" />
                                                <label for="iImitaAnimalSim">SIM</label>
                                                <input name="nImitaAnimal" value="N" <?php echo set_radio('nImitaAnimal', 'N', FALSE); ?> type="radio" id="iImitaAnimalNao" class="with-gap" />
                                                <label for="iImitaAnimalNao">NÃO</label>
                                            <?php } else if ($dadosUsuario->imitaAnimal == 'S') { ?>
                                                <input name="nImitaAnimal" checked="true" value="S" <?php echo set_radio('nImitaAnimal', 'S', FALSE); ?> type="radio" class="with-gap" id="iImitaAnimalSim" />
                                                <label for="iImitaAnimalSim">SIM</label>
                                                <input name="nImitaAnimal" value="N" <?php echo set_radio('nImitaAnimal', 'N', FALSE); ?> type="radio" id="iImitaAnimalNao" class="with-gap" />
                                                <label for="iImitaAnimalNao">NÃO</label>
                                            <?php } else { ?>
                                                <input name="nImitaAnimal" value="S" <?php echo set_radio('nImitaAnimal', 'S', FALSE); ?> type="radio" class="with-gap" id="iImitaAnimalSim" />
                                                <label for="iImitaAnimalSim">SIM</label>
                                                <input name="nImitaAnimal" value="N" checked="true" <?php echo set_radio('nImitaAnimal', 'N', FALSE); ?> type="radio" id="iImitaAnimalNao" class="with-gap" />
                                                <label for="iImitaAnimalNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nImitaAnimal']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Imita pessoas? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php if (empty($dadosUsuario->imitaPessoa)) { ?>
                                                <input name="nImitaPessoa" value="S" <?php echo set_radio('nImitaPessoa', 'S', FALSE); ?> type="radio" class="with-gap" id="iImitaPessoaSim" />
                                                <label for="iImitaPessoaSim">SIM</label>
                                                <input name="nImitaPessoa" value="N" <?php echo set_radio('nImitaPessoa', 'N', FALSE); ?> type="radio" id="iImitaPessoaNao" class="with-gap" />
                                                <label for="iImitaPessoaNao">NÃO</label>
                                            <?php } else if ($dadosUsuario->imitaPessoa == 'S') { ?>
                                                <input name="nImitaPessoa" checked="true" value="S" <?php echo set_radio('nImitaPessoa', 'S', FALSE); ?> type="radio" class="with-gap" id="iImitaPessoaSim" />
                                                <label for="iImitaPessoaSim">SIM</label>
                                                <input name="nImitaPessoa" value="N" <?php echo set_radio('nImitaPessoa', 'N', FALSE); ?> type="radio" id="iImitaPessoaNao" class="with-gap" />
                                                <label for="iImitaPessoaNao">NÃO</label>
                                            <?php } else { ?>
                                                <input name="nImitaPessoa" value="S" <?php echo set_radio('nImitaPessoa', 'S', FALSE); ?> type="radio" class="with-gap" id="iImitaPessoaSim" />
                                                <label for="iImitaPessoaSim">SIM</label>
                                                <input name="nImitaPessoa" value="N" checked="true" <?php echo set_radio('nImitaPessoa', 'N', FALSE); ?> type="radio" id="iImitaPessoaNao" class="with-gap" />
                                                <label for="iImitaPessoaNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nImitaPessoa']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>A criança é responsável por atividade em casa? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php if (empty($dadosUsuario->responsavelAtividade)) { ?>
                                                <input name="nResponsavelAtividade" value="S" <?php echo set_radio('nResponsavelAtividade', 'S', FALSE); ?> type="radio" class="with-gap" id="iResponsavelAtividadeSim" />
                                                <label for="iResponsavelAtividadeSim">SIM</label>
                                                <input name="nResponsavelAtividade" value="N" <?php echo set_radio('nResponsavelAtividade', 'N', FALSE); ?> type="radio" id="iResponsavelAtividadeNao" class="with-gap" />
                                                <label for="iResponsavelAtividadeNao">NÃO</label>
                                            <?php } else if ($dadosUsuario->responsavelAtividade == 'S') { ?>
                                                <input name="nResponsavelAtividade" checked="true" value="S" <?php echo set_radio('nResponsavelAtividade', 'S', FALSE); ?> type="radio" class="with-gap" id="iResponsavelAtividadeSim" />
                                                <label for="iResponsavelAtividadeSim">SIM</label>
                                                <input name="nResponsavelAtividade" value="N" <?php echo set_radio('nResponsavelAtividade', 'N', FALSE); ?> type="radio" id="iResponsavelAtividadeNao" class="with-gap" />
                                                <label for="iResponsavelAtividadeNao">NÃO</label>
                                            <?php } else { ?>
                                                <input name="nResponsavelAtividade" value="S" <?php echo set_radio('nResponsavelAtividade', 'S', FALSE); ?> type="radio" class="with-gap" id="iResponsavelAtividadeSim" />
                                                <label for="iResponsavelAtividadeSim">SIM</label>
                                                <input name="nResponsavelAtividade" value="N" checked="true" <?php echo set_radio('nResponsavelAtividade', 'N', FALSE); ?> type="radio" id="iResponsavelAtividadeNao" class="with-gap" />
                                                <label for="iResponsavelAtividadeNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nResponsavelAtividade']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Em caso de sim, o que faz?</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="iTipoAtividade" name="nTipoAtividade" value="<?php echo set_value('nTipoAtividade', $dadosUsuario->qualAtividade); ?>" class="form-control">

                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nTipoAtividade']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Demonstra algum tipo de fuga? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php if (empty($dadosUsuario->comportamentoFuga)) { ?>
                                                <input name="nComportamentoFuga" value="S" <?php echo set_radio('nComportamentoFuga', 'S', FALSE); ?> type="radio" class="with-gap" id="iComportamentoFugaSim" />
                                                <label for="iComportamentoFugaSim">SIM</label>
                                                <input name="nComportamentoFuga" value="N" <?php echo set_radio('nComportamentoFuga', 'N', FALSE); ?> type="radio" id="iComportamentoFugaNao" class="with-gap" />
                                                <label for="iComportamentoFugaNao">NÃO</label>
                                            <?php } else if ($dadosUsuario->comportamentoFuga == 'S') { ?>
                                                <input name="nComportamentoFuga" checked="true" value="S" <?php echo set_radio('nComportamentoFuga', 'S', FALSE); ?> type="radio" class="with-gap" id="iComportamentoFugaSim" />
                                                <label for="iComportamentoFugaSim">SIM</label>
                                                <input name="nComportamentoFuga" value="N" <?php echo set_radio('nComportamentoFuga', 'N', FALSE); ?> type="radio" id="iComportamentoFugaNao" class="with-gap" />
                                                <label for="iComportamentoFugaNao">NÃO</label>
                                            <?php } else { ?>
                                                <input name="nComportamentoFuga" value="S" <?php echo set_radio('nComportamentoFuga', 'S', FALSE); ?> type="radio" class="with-gap" id="iComportamentoFugaSim" />
                                                <label for="iComportamentoFugaSim">SIM</label>
                                                <input name="nComportamentoFuga" value="N" checked="true" <?php echo set_radio('nComportamentoFuga', 'N', FALSE); ?> type="radio" id="iComportamentoFugaNao" class="with-gap" />
                                                <label for="iComportamentoFugaNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nComportamentoFuga']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Recebe algum tipo de atendimento fora da instituição? </label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-checkbox">
                                            <!-- FONOAUDIOLOGIA-->
                                            <?php if (empty($dadosUsuario->tipoAtendimentoForaFono)) { ?>
                                                <input type="checkbox" id="iTipoFono" class="checkbox-inline" name="nTipoFono" value="S" <?php echo set_checkbox('nTipoFono', 'S', FALSE); ?> /> <label for="iTipoFono"> FONOAUDIOLOGIA </label><br>
                                            <?php } else if ($dadosUsuario->tipoAtendimentoForaFono == 'S') { ?>
                                                <input type="checkbox" id="iTipoFono" class="checkbox-inline" checked="true" name="nTipoFono" value="S" <?php echo set_checkbox('nTipoFono', 'S', TRUE); ?> /> <label for="iTipoFono"> FONOAUDIOLOGIA </label><br>

                                            <?php } else { ?>
                                                <input type="checkbox" id="iTipoFono" class="checkbox-inline" name="nTipoFono" value="N" <?php echo set_checkbox('nTipoFono', 'N', FALSE); ?> /> <label for="iTipoFono"> FONOAUDIOLOGIA </label><br>

                                            <?php
                                            } ?>

                                            <!-- TERAPIA OCUPACIONAL-->
                                            <?php if (empty($dadosUsuario->tipoAtendimentoForaTO)) { ?>
                                                <input type="checkbox" id="iTipoTO" class="checkbox-inline" name="nTipoTO" value="S" <?php echo set_checkbox('nTipoTO', 'S'); ?> /> <label for="iTipoTO"> TERAPIA OCUPACIONAL </label><br>
                                            <?php } else if ($dadosUsuario->tipoAtendimentoForaTO == 'S') { ?>
                                                <input type="checkbox" id="iTipoTO" class="checkbox-inline" checked="true" name="nTipoTO" value="S" <?php echo set_checkbox('nTipoTO', 'S'); ?> /> <label for="iTipoTO"> TERAPIA OCUPACIONAL </label><br>

                                            <?php } else { ?>
                                                <input type="checkbox" id="iTipoTO" class="checkbox-inline" name="nTipoTO" value="N" <?php echo set_checkbox('nTipoTO', 'N'); ?> /> <label for="iTipoTO"> TERAPIA OCUPACIONAL </label><br>

                                            <?php
                                            } ?>

                                            <!-- FISIOTERAPIA-->
                                            <?php if (empty($dadosUsuario->tipoAtendimentoFisio)) { ?>
                                                <input type="checkbox" id="iTipoFisio" class="checkbox-inline" name="nTipoFisio" value="S" <?php echo set_checkbox('nTipoFisio', 'S'); ?> /> <label for="iTipoFisio"> FISIOTERAPIA </label><br>
                                            <?php } else if ($dadosUsuario->tipoAtendimentoFisio == 'S') { ?>
                                                <input type="checkbox" id="iTipoFisio" class="checkbox-inline" checked="true" name="nTipoFisio" value="S" <?php echo set_checkbox('nTipoFisio', 'S'); ?> /> <label for="iTipoFisio"> FISIOTERAPIA </label><br>

                                            <?php } else { ?>
                                                <input type="checkbox" id="iTipoFisio" class="checkbox-inline" name="nTipoFisio" value="N" <?php echo set_checkbox('nTipoFisio', 'N'); ?> /> <label for="iTipoFisio"> FISIOTERAPIA </label><br>
                                            <?php
                                            } ?>

                                            <!-- PSICOLOGIA-->
                                            <?php if (empty($dadosUsuario->tipoAtendimentoPsico)) { ?>
                                                <input type="checkbox" id="iTipoPsico" class="checkbox-inline" name="nTipoPsico" value="S" <?php echo set_checkbox('nTipoPsico', 'S'); ?> /> <label for="iTipoPsico"> PSICOLOGIA </label><br>
                                            <?php } else if ($dadosUsuario->tipoAtendimentoPsico == 'S') { ?>
                                                <input type="checkbox" id="iTipoPsico" class="checkbox-inline" checked="true" name="nTipoPsico" value="S" <?php echo set_checkbox('nTipoPsico', 'S'); ?> /> <label for="iTipoPsico"> PSICOLOGIA </label><br>

                                            <?php } else { ?>
                                                <input type="checkbox" id="iTipoPsico" class="checkbox-inline" name="nTipoPsico" value="N" <?php echo set_checkbox('nTipoPsico', 'N'); ?> /> <label for="iTipoPsico"> PSICOLOGIA </label><br>
                                            <?php
                                            } ?>

                                            <!-- EQUOTERAPIA-->
                                            <?php if (empty($dadosUsuario->tipoAtendimentoEquo)) { ?>
                                                <input type="checkbox" id="iTipoEquo" class="checkbox-inline" name="nTipoEquo" value="S" <?php echo set_checkbox('nTipoEquo', 'S'); ?> /> <label for="iTipoEquo"> EQUOTERAPIA </label><br>
                                            <?php } else if ($dadosUsuario->tipoAtendimentoEquo == 'S') { ?>
                                                <input type="checkbox" id="iTipoEquo" class="checkbox-inline" checked="true" name="nTipoEquo" value="S" <?php echo set_checkbox('nTipoEquo', 'S'); ?> /> <label for="iTipoEquo"> EQUOTERAPIA </label><br>

                                            <?php } else { ?>
                                                <input type="checkbox" id="iTipoEquo" class="checkbox-inline" name="nTipoEquo" value="N" <?php echo set_checkbox('nTipoEquo', 'N'); ?> /> <label for="iTipoEquo"> EQUOTERAPIA </label><br>
                                            <?php
                                            } ?>

                                            <!-- PSICOTERAPIA-->
                                            <?php if (empty($dadosUsuario->tipoAtendimentoPsTerapia)) { ?>
                                                <input type="checkbox" id="iTipoPsTerapia" class="checkbox-inline" name="nTipoPsTerapia" value="S" <?php echo set_checkbox('nTipoPsTerapia', 'S'); ?> /> <label for="iTipoPsTerapia"> PSICOTERAPIA </label><br>
                                            <?php } else if ($dadosUsuario->tipoAtendimentoPsTerapia == 'S') { ?>
                                                <input type="checkbox" id="iTipoPsTerapia" class="checkbox-inline" checked="true" name="nTipoPsTerapia" value="S" <?php echo set_checkbox('nTipoPsTerapia', 'S'); ?> /> <label for="iTipoPsTerapia"> PSICOTERAPIA </label><br>

                                            <?php } else { ?>
                                                <input type="checkbox" id="iTipoPsTerapia" class="checkbox-inline" name="nTipoPsTerapia" value="N" <?php echo set_checkbox('nTipoPsTerapia', 'N'); ?> /> <label for="iTipoPsTerapia"> PSICOTERAPIA </label><br>
                                            <?php
                                            } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Outro atendimento:</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="iOutroAtendimento" name="nOutroAtendimento" value="<?php echo set_value('nOutroAtendimento', $dadosUsuario->tipoAtendimentoOutro); ?>" class="form-control">

                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nOutroAtendimento']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Onde?</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="iOnde" name="nOnde" value="<?php echo set_value('nOnde', $dadosUsuario->localAtendimentoFora); ?>" class="form-control">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nOnde']??'';?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Se sim, quantas vezes? Por semana.</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="iNumeroAtendimento" name="nNumeroAtendimento" value="<?php echo set_value('nNumeroAtendimento', $dadosUsuario->numeroAtendimento); ?>" class="form-control numeroMaxDois">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nNumeroAtendimento']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Estimulação? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php if (empty($dadosUsuario->estimulacao)) { ?>
                                                <input name="nEstimulacao" value="S" <?php echo set_radio('nEstimulacao', 'S', FALSE); ?> type="radio" class="with-gap" id="iEstimulacaoSim" />
                                                <label for="iEstimulacaoSim">SIM</label>
                                                <input name="nEstimulacao" value="N" <?php echo set_radio('nEstimulacao', 'N', FALSE); ?> type="radio" id="iEstimulacaoNao" class="with-gap" />
                                                <label for="iEstimulacaoNao">NÃO</label>
                                            <?php } else if ($dadosUsuario->estimulacao == 'S') { ?>
                                                <input name="nEstimulacao" checked="true" value="S" <?php echo set_radio('nEstimulacao', 'S', FALSE); ?> type="radio" class="with-gap" id="iEstimulacaoSim" />
                                                <label for="iEstimulacaoSim">SIM</label>
                                                <input name="nEstimulacao" value="N" <?php echo set_radio('nEstimulacao', 'N', FALSE); ?> type="radio" id="iEstimulacaoNao" class="with-gap" />
                                                <label for="iEstimulacaoNao">NÃO</label>
                                            <?php } else { ?>
                                                <input name="nEstimulacao" value="S" <?php echo set_radio('nEstimulacao', 'S', FALSE); ?> type="radio" class="with-gap" id="iEstimulacaoSim" />
                                                <label for="iEstimulacaoSim">SIM</label>
                                                <input name="nEstimulacao" value="N" checked="true" <?php echo set_radio('nEstimulacao', 'N', FALSE); ?> type="radio" id="iEstimulacaoNao" class="with-gap" />
                                                <label for="iEstimulacaoNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nEstimulacao']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>A criança tem acesso a: </label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-checkbox">
                                            <!-- BRINQUEDOS-->
                                            <?php if (empty($dadosUsuario->brinquedoPedagogico)) { ?>
                                                <input type="checkbox" id="iBrinquedo" class="checkbox-inline" name="nBrinquedo" value="S" <?php echo set_checkbox('nBrinquedo', 'S', FALSE); ?> /> <label for="iBrinquedo"> BRINQUEDOS PEDAGÓGICOS </label><br>
                                            <?php } else if ($dadosUsuario->brinquedoPedagogico == 'S') { ?>
                                                <input type="checkbox" id="iBrinquedo" class="checkbox-inline" checked="true" name="nBrinquedo" value="S" <?php echo set_checkbox('nBrinquedo', 'S', TRUE); ?> /> <label for="iBrinquedo"> BRINQUEDOS PEDAGÓGICOS </label><br>

                                            <?php } else { ?>
                                                <input type="checkbox" id="iBrinquedo" class="checkbox-inline" name="nBrinquedo" value="N" <?php echo set_checkbox('nBrinquedo', 'N', FALSE); ?> /> <label for="iBrinquedo"> BRINQUEDOS PEDAGÓGICOS </label><br>

                                            <?php
                                            } ?>

                                            <!-- JOGOS-->
                                            <?php if (empty($dadosUsuario->jogos)) { ?>
                                                <input type="checkbox" id="iJogos" class="checkbox-inline" name="nJogos" value="S" <?php echo set_checkbox('nJogos', 'S'); ?> /> <label for="iJogos"> JOGOS </label><br>
                                            <?php } else if ($dadosUsuario->jogos == 'S') { ?>
                                                <input type="checkbox" id="iJogos" class="checkbox-inline" checked="true" name="nJogos" value="S" <?php echo set_checkbox('nJogos', 'S'); ?> /> <label for="iJogos"> JOGOS </label><br>

                                            <?php } else { ?>
                                                <input type="checkbox" id="iJogos" class="checkbox-inline" name="nJogos" value="N" <?php echo set_checkbox('nJogos', 'N'); ?> /> <label for="iJogos"> JOGOS </label><br>

                                            <?php
                                            } ?>

                                            <!-- REVISTA LIVRO-->
                                            <?php if (empty($dadosUsuario->revistaLivro)) { ?>
                                                <input type="checkbox" id="iRevistaLivro" class="checkbox-inline" name="nRevistaLivro" value="S" <?php echo set_checkbox('nRevistaLivro', 'S'); ?> /> <label for="iRevistaLivro"> REVISTAS, LIVROS </label><br>
                                            <?php } else if ($dadosUsuario->revistaLivro == 'S') { ?>
                                                <input type="checkbox" id="iRevistaLivro" class="checkbox-inline" checked="true" name="nRevistaLivro" value="S" <?php echo set_checkbox('nRevistaLivro', 'S'); ?> /> <label for="iRevistaLivro"> REVISTAS, LIVROS </label><br>

                                            <?php } else { ?>
                                                <input type="checkbox" id="iRevistaLivro" class="checkbox-inline" name="nRevistaLivro" value="N" <?php echo set_checkbox('nRevistaLivro', 'N'); ?> /> <label for="iRevistaLivro"> REVISTAS, LIVROS </label><br>
                                            <?php
                                            } ?>

                                            <!-- BRINQUEDOS ELETRONICOS-->
                                            <?php if (empty($dadosUsuario->brinquedoEletronico)) { ?>
                                                <input type="checkbox" id="iBriquedoEletronico" class="checkbox-inline" name="nBriquedoEletronico" value="S" <?php echo set_checkbox('nBriquedoEletronico', 'S'); ?> /> <label for="iBriquedoEletronico"> BRINQUEDOS ELETRÔNICOS </label><br>
                                            <?php } else if ($dadosUsuario->brinquedoEletronico == 'S') { ?>
                                                <input type="checkbox" id="iBriquedoEletronico" class="checkbox-inline" checked="true" name="nBriquedoEletronico" value="S" <?php echo set_checkbox('nBriquedoEletronico', 'S'); ?> /> <label for="iBriquedoEletronico"> BRINQUEDOS ELETRÔNICOS </label><br>

                                            <?php } else { ?>
                                                <input type="checkbox" id="iBriquedoEletronico" class="checkbox-inline" name="nBriquedoEletronico" value="N" <?php echo set_checkbox('nBriquedoEletronico', 'N'); ?> /> <label for="iBriquedoEletronico"> BRINQUEDOS ELETRÔNICOS </label><br>
                                            <?php
                                            } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>De que atividades a criança participa: </label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-checkbox">
                                            <!-- MÚSICA-->
                                            <?php if (empty($dadosUsuario->participaMusica)) { ?>
                                                <input type="checkbox" id="iMusica" class="checkbox-inline" name="nMusica" value="S" <?php echo set_checkbox('nMusica', 'S', FALSE); ?> /> <label for="iMusica"> MÚSICA </label><br>
                                            <?php } else if ($dadosUsuario->participaMusica == 'S') { ?>
                                                <input type="checkbox" id="iMusica" class="checkbox-inline" checked="true" name="nMusica" value="S" <?php echo set_checkbox('nMusica', 'S', TRUE); ?> /> <label for="iMusica"> MÚSICA </label><br>

                                            <?php } else { ?>
                                                <input type="checkbox" id="iMusica" class="checkbox-inline" name="nMusica" value="N" <?php echo set_checkbox('nMusica', 'N', FALSE); ?> /> <label for="iMusica"> MÚSICA </label><br>

                                            <?php
                                            } ?>

                                            <!-- ESPORTES-->
                                            <?php if (empty($dadosUsuario->participaEsporte)) { ?>
                                                <input type="checkbox" id="iEsportes" class="checkbox-inline" name="nEsportes" value="S" <?php echo set_checkbox('nEsportes', 'S'); ?> /> <label for="iEsportes"> ESPORTES </label><br>
                                            <?php } else if ($dadosUsuario->participaEsporte == 'S') { ?>
                                                <input type="checkbox" id="iEsportes" class="checkbox-inline" checked="true" name="nEsportes" value="S" <?php echo set_checkbox('nEsportes', 'S'); ?> /> <label for="iEsportes"> ESPORTES </label><br>

                                            <?php } else { ?>
                                                <input type="checkbox" id="iEsportes" class="checkbox-inline" name="nEsportes" value="N" <?php echo set_checkbox('nEsportes', 'N'); ?> /> <label for="iEsportes"> ESPORTES </label><br>

                                            <?php
                                            } ?>

                                            <!-- DANÇA-->
                                            <?php if (empty($dadosUsuario->participaDanca)) { ?>
                                                <input type="checkbox" id="iDanca" class="checkbox-inline" name="nDanca" value="S" <?php echo set_checkbox('nDanca', 'S'); ?> /> <label for="iDanca"> DANÇA </label><br>
                                            <?php } else if ($dadosUsuario->participaDanca == 'S') { ?>
                                                <input type="checkbox" id="iDanca" class="checkbox-inline" checked="true" name="nDanca" value="S" <?php echo set_checkbox('nDanca', 'S'); ?> /> <label for="iDanca"> DANÇA </label><br>

                                            <?php } else { ?>
                                                <input type="checkbox" id="iDanca" class="checkbox-inline" name="nDanca" value="N" <?php echo set_checkbox('nDanca', 'N'); ?> /> <label for="iDanca"> DANÇA </label><br>
                                            <?php
                                            } ?>
                                        </div>
                                    </div>
                                </div>
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