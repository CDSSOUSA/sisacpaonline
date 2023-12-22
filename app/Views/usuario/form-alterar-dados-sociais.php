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
                            <small> <h4><?=$dadosUsuario->idUsuario . ' - ' . $dadosUsuario->nomeUsuario; ?></h4></small>

                        </h2>
                    </div>
                    <div class="body">
                        <?php
                        $atributos_formulario = array('role' => 'form', 'class' => 'form-horizontal');

                        echo form_open('usuario/alterar_dados_sociais', $atributos_formulario);
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
                                <label>Renda familiar: *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <select class="form-control" name="nRendaFamiliar">

                                            <option value="<?php echo $dadosUsuario->rendaFamiliar; ?>"
                                             <?php echo set_select('nRendaFamiliar', $dadosUsuario->rendaFamiliar !== null??'Escolha uma opção ...'); ?>
                                             ><?php echo $dadosUsuario->rendaFamiliar; ?></option>
                                            <option value="MENOS DE 01 SALARIO" <?php echo set_select('nRendaFamiliar', 'MENOS DE 01 SALARIO'); ?>>MENOS DE 01 SALÁRIO</option>
                                            <option value="01 SALARIO" <?php echo set_select('nRendaFamiliar', '01 SALARIO'); ?>>01 SALÁRIO</option>
                                            <option value="MAIS DE 01 SALARIO" <?php echo set_select('nRendaFamiliar', 'MAIS DE 01 SALARIO'); ?>>MAIS DE 01 SALÁRIO</option>
                                            <option value="ENTRE 02 E 05 SALARIOS" <?php echo set_select('nRendaFamiliar', 'ENTRE 02 E 05 SALARIOS'); ?>>ENTRE 02 E 05 SALÁRIOS</option>
                                            <option value="DE 06 SALARIOS EM DIANTE" <?php echo set_select('nRendaFamiliar', 'DE 06 SALARIOS EM DIANTE'); ?>>DE 06 SALÁRIOS EM DIANTE</option>

                                        </select>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nRendaFamiliar']??'';?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Número pessoas no endereço: *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="" name="nPessoasEndereco" value="<?php echo set_value('nPessoasEndereco', $dadosUsuario->numeroPessoasEndereco); ?>" class="form-control numeroMaxDois">

                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nPessoasEndereco']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Tipo de habitação: *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php

                                            if (empty($dadosUsuario->tipoHabitacao)) { ?>
                                                <input name="nTipoHabitacao" type="radio" class="with-gap" id="iCasa" value="C" <?php echo set_radio('nTipoHabitacao', 'C', false); ?> />
                                                <label for="iCasa">CASA</label>
                                                <input name="nTipoHabitacao" type="radio" id="iApartamento" class="with-gap" value="A" <?php echo set_radio('nTipoHabitacao', 'A', false); ?> />
                                                <label for="iApartamento">APARTAMENTO</label>

                                            <?php } else if ($dadosUsuario->tipoHabitacao == 'C') {
                                            ?>
                                                <input name="nTipoHabitacao" type="radio" checked="true" class="with-gap" id="iCasa" value="C" <?php echo set_radio('nTipoHabitacao', 'C', false); ?> />
                                                <label for="iCasa">CASA</label>
                                                <input name="nTipoHabitacao" type="radio" id="iApartamento" class="with-gap" value="A" <?php echo set_radio('nTipoHabitacao', 'A', false); ?> />
                                                <label for="iApartamento">APARTAMENTO</label>

                                            <?php
                                            } else {
                                            ?>
                                                <input name="nTipoHabitacao" type="radio" class="with-gap" id="iCasa" value="C" <?php echo set_radio('nTipoHabitacao', 'C', false); ?> />
                                                <label for="iCasa">CASA</label>
                                                <input name="nTipoHabitacao" type="radio" checked="true" id="iApartamento" class="with-gap" value="A" <?php echo set_radio('nTipoHabitacao', 'A', true); ?> />
                                                <label for="iApartamento">APARTAMENTO</label>

                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nTipoHabitacao']??'';?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Condição de habitação: *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php

                                            if (empty($dadosUsuario->condicaoHabitacao)) { ?>
                                                <input name="nCondicaoHabitacao" type="radio" class="with-gap" id="iPropria" value="P" <?php echo set_radio('nCondicaoHabitacao', 'P', false); ?> />
                                                <label for="iPropria">PRÓPRIA</label>
                                                <input name="nCondicaoHabitacao" type="radio" id="iAlugada" class="with-gap" value="A" <?php echo set_radio('nCondicaoHabitacao', 'A', false); ?> />
                                                <label for="iAlugada">ALUGADA</label>
                                                <input name="nCondicaoHabitacao" type="radio" id="iCedida" class="with-gap" value="C" <?php echo set_radio('nCondicaoHabitacao', 'C', false); ?> />
                                                <label for="iCedida">CEDIDA</label>

                                            <?php } else if ($dadosUsuario->condicaoHabitacao == 'P') {
                                            ?>
                                                <input name="nCondicaoHabitacao" type="radio" checked="true" class="with-gap" id="iPropria" value="P" <?php echo set_radio('nCondicaoHabitacao', 'P', false); ?> />
                                                <label for="iPropria">PRÓPRIA</label>
                                                <input name="nCondicaoHabitacao" type="radio" id="iAlugada" class="with-gap" value="A" <?php echo set_radio('nCondicaoHabitacao', 'A', false); ?> />
                                                <label for="iAlugada">ALUGADA</label>
                                                <input name="nCondicaoHabitacao" type="radio" id="iCedida" class="with-gap" value="C" <?php echo set_radio('nCondicaoHabitacao', 'C', false); ?> />
                                                <label for="iCedida">CEDIDA</label>

                                            <?php
                                            } else if ($dadosUsuario->condicaoHabitacao == 'A') {
                                            ?>
                                                <input name="nCondicaoHabitacao" type="radio" class="with-gap" id="iPropria" value="P" <?php echo set_radio('nCondicaoHabitacao', 'P', false); ?> />
                                                <label for="iPropria">PRÓPRIA</label>
                                                <input name="nCondicaoHabitacao" type="radio" checked="true" id="iAlugada" class="with-gap" value="A" <?php echo set_radio('nCondicaoHabitacao', 'A', false); ?> />
                                                <label for="iAlugada">ALUGADA</label>
                                                <input name="nCondicaoHabitacao" type="radio" id="iCedida" class="with-gap" value="C" <?php echo set_radio('nCondicaoHabitacao', 'C', false); ?> />
                                                <label for="iCedida">CEDIDA</label>

                                            <?php } else { ?>
                                                <input name="nCondicaoHabitacao" type="radio" class="with-gap" id="iPropria" value="P" <?php echo set_radio('nCondicaoHabitacao', 'P', false); ?> />
                                                <label for="iPropria">PRÓPRIA</label>
                                                <input name="nCondicaoHabitacao" type="radio" id="iAlugada" class="with-gap" value="A" <?php echo set_radio('nCondicaoHabitacao', 'A', false); ?> />
                                                <label for="iAlugada">ALUGADA</label>
                                                <input name="nCondicaoHabitacao" type="radio" checked="true" id="iCedida" class="with-gap" value="C" <?php echo set_radio('nCondicaoHabitacao', 'C', false); ?> />
                                                <label for="iCedida">CEDIDA</label>

                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nCondicaoHabitacao']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Possui outros irmãos com diagnóstico de autismo? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php if (empty($dadosUsuario->possuiOutrosIrmaos)) { ?>
                                                <input name="nDiagnosticoIrmaoAutismo" value="S" <?php echo set_radio('nDiagnosticoIrmaoAutismo', 'S', FALSE); ?> type="radio" class="with-gap" id="iDiagnosticoIrmaoAutismoSim" />
                                                <label for="iDiagnosticoIrmaoAutismoSim">SIM</label>
                                                <input name="nDiagnosticoIrmaoAutismo" value="N" <?php echo set_radio('nDiagnosticoIrmaoAutismo', 'N', FALSE); ?> type="radio" id="iDiagnosticoIrmaoAutismoNao" class="with-gap" />
                                                <label for="iDiagnosticoIrmaoAutismoNao">NÃO</label>
                                            <?php } else if ($dadosUsuario->possuiOutrosIrmaos == 'S') { ?>
                                                <input name="nDiagnosticoIrmaoAutismo" checked="true" value="S" <?php echo set_radio('nDiagnosticoIrmaoAutismo', 'S', FALSE); ?> type="radio" class="with-gap" id="iDiagnosticoIrmaoAutismoSim" />
                                                <label for="iDiagnosticoIrmaoAutismoSim">SIM</label>
                                                <input name="nDiagnosticoIrmaoAutismo" value="N" <?php echo set_radio('nDiagnosticoIrmaoAutismo', 'N', FALSE); ?> type="radio" id="iDiagnosticoIrmaoAutismoNao" class="with-gap" />
                                                <label for="iDiagnosticoIrmaoAutismoNao">NÃO</label>
                                            <?php } else { ?>
                                                <input name="nDiagnosticoIrmaoAutismo" value="S" <?php echo set_radio('nDiagnosticoIrmaoAutismo', 'S', FALSE); ?> type="radio" class="with-gap" id="iDiagnosticoIrmaoAutismoSim" />
                                                <label for="iDiagnosticoIrmaoAutismoSim">SIM</label>
                                                <input name="nDiagnosticoIrmaoAutismo" value="N" checked="true" <?php echo set_radio('nDiagnosticoIrmaoAutismo', 'N', FALSE); ?> type="radio" id="iDiagnosticoIrmaoAutismoNao" class="with-gap" />
                                                <label for="iDiagnosticoIrmaoAutismoNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nDiagnosticoIrmaoAutismo']??'';?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Como a família reagiu ao diagnósitco? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea rows="4" name="nReacaoFamilia" class="form-control no-resize" placeholder="Digite o texto ... Enter para mudar de linha."><?php echo set_value('nReacaoFamilia', $dadosUsuario->reacaoFamiliaDiagnostico); ?></textarea>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nReacaoFamilia']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Apresenta dificuldades motoras? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php if (empty($dadosUsuario->dificuldadesMotoras)) { ?>
                                                <input name="nDificuldadeMotora" value="S" <?php echo set_radio('nDificuldadeMotora', 'S', FALSE); ?> type="radio" class="with-gap" id="iDificuldadeSim" />
                                                <label for="iDificuldadeSim">SIM</label>
                                                <input name="nDificuldadeMotora" value="N" <?php echo set_radio('nDificuldadeMotora', 'N', FALSE); ?> type="radio" id="iDificuldadeNao" class="with-gap" />
                                                <label for="iDificuldadeNao">NÃO</label>
                                            <?php } else if ($dadosUsuario->dificuldadesMotoras == 'S') { ?>
                                                <input name="nDificuldadeMotora" checked="true" value="S" <?php echo set_radio('nDificuldadeMotora', 'S', FALSE); ?> type="radio" class="with-gap" id="iDificuldadeSim" />
                                                <label for="iDificuldadeSim">SIM</label>
                                                <input name="nDificuldadeMotora" value="N" <?php echo set_radio('nDificuldadeMotora', 'N', FALSE); ?> type="radio" id="iDificuldadeNao" class="with-gap" />
                                                <label for="iDificuldadeNao">NÃO</label>
                                            <?php } else { ?>
                                                <input name="nDificuldadeMotora" value="S" <?php echo set_radio('nDificuldadeMotora', 'S', FALSE); ?> type="radio" class="with-gap" id="iDificuldadeSim" />
                                                <label for="iDificuldadeSim">SIM</label>
                                                <input name="nDificuldadeMotora" value="N" checked="true" <?php echo set_radio('nDificuldadeMotora', 'N', FALSE); ?> type="radio" id="iDificuldadeNao" class="with-gap" />
                                                <label for="iDificuldadeNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nDificuldadeMotora']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Faz uso de medicação? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php if (empty($dadosUsuario->usoMedicacao)) { ?>
                                                <input name="nUsoMedicacao" value="S" <?php echo set_radio('nUsoMedicacao', 'S', FALSE); ?> type="radio" class="with-gap" id="iUsoMedicacaoSim" />
                                                <label for="iUsoMedicacaoSim">SIM</label>
                                                <input name="nUsoMedicacao" value="N" <?php echo set_radio('nUsoMedicacao', 'N', FALSE); ?> type="radio" id="iUsoMedicacaoNao" class="with-gap" />
                                                <label for="iUsoMedicacaoNao">NÃO</label>
                                            <?php } else if ($dadosUsuario->usoMedicacao == 'S') { ?>
                                                <input name="nUsoMedicacao" checked="true" value="S" <?php echo set_radio('nUsoMedicacao', 'S', FALSE); ?> type="radio" class="with-gap" id="iUsoMedicacaoSim" />
                                                <label for="iUsoMedicacaoSim">SIM</label>
                                                <input name="nUsoMedicacao" value="N" <?php echo set_radio('nUsoMedicacao', 'N', FALSE); ?> type="radio" id="iUsoMedicacaoNao" class="with-gap" />
                                                <label for="iUsoMedicacaoNao">NÃO</label>
                                            <?php } else { ?>
                                                <input name="nUsoMedicacao" value="S" <?php echo set_radio('nUsoMedicacao', 'S', FALSE); ?> type="radio" class="with-gap" id="iUsoMedicacaoSim" />
                                                <label for="iUsoMedicacaoSim">SIM</label>
                                                <input name="nUsoMedicacao" value="N" checked="true" <?php echo set_radio('nUsoMedicacao', 'N', FALSE); ?> type="radio" id="iUsoMedicacaoNao" class="with-gap" />
                                                <label for="iUsoMedicacaoNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nUsoMedicacao']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Em caso de sim, qual a medicacão?</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="iMedicacao" name="nMedicacao" value="<?php echo set_value('nMedicacao', $dadosUsuario->qualMedicacao); ?>" class="form-control">

                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nMedicacao']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Possui alergias? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php if (empty($dadosUsuario->possuiAlergia)) { ?>
                                                <input name="nPossuiAlergia" value="S" <?php echo set_radio('nPossuiAlergia', 'S', FALSE); ?> type="radio" class="with-gap" id="iPossuiAlergiaSim" />
                                                <label for="iPossuiAlergiaSim">SIM</label>
                                                <input name="nPossuiAlergia" value="N" <?php echo set_radio('nPossuiAlergia', 'N', FALSE); ?> type="radio" id="iPossuiAlergiaNao" class="with-gap" />
                                                <label for="iPossuiAlergiaNao">NÃO</label>
                                            <?php } else if ($dadosUsuario->possuiAlergia == 'S') { ?>
                                                <input name="nPossuiAlergia" checked="true" value="S" <?php echo set_radio('nPossuiAlergia', 'S', FALSE); ?> type="radio" class="with-gap" id="iPossuiAlergiaSim" />
                                                <label for="iPossuiAlergiaSim">SIM</label>
                                                <input name="nPossuiAlergia" value="N" <?php echo set_radio('nPossuiAlergia', 'N', FALSE); ?> type="radio" id="iPossuiAlergiaNao" class="with-gap" />
                                                <label for="iPossuiAlergiaNao">NÃO</label>
                                            <?php } else { ?>
                                                <input name="nPossuiAlergia" value="S" <?php echo set_radio('nPossuiAlergia', 'S', FALSE); ?> type="radio" class="with-gap" id="iPossuiAlergiaSim" />
                                                <label for="iPossuiAlergiaSim">SIM</label>
                                                <input name="nPossuiAlergia" value="N" checked="true" <?php echo set_radio('nPossuiAlergia', 'N', FALSE); ?> type="radio" id="iPossuiAlergiaNao" class="with-gap" />
                                                <label for="iPossuiAlergiaNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nPossuiAlergia']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Em caso de sim, quais as alergias?</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="iAlergia" name="nAlergia" value="<?php echo set_value('nAlergia', $dadosUsuario->qualAlergia); ?>" class="form-control">

                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nAlergia']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Mostra-se dependente de alguém da família? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php if (empty($dadosUsuario->dependenciaFamiliar)) { ?>
                                                <input name="nDependenciaFamiliar" value="S" <?php echo set_radio('nDependenciaFamiliar', 'S', FALSE); ?> type="radio" class="with-gap" id="iDependenciaFamiliarSim" />
                                                <label for="iDependenciaFamiliarSim">SIM</label>
                                                <input name="nDependenciaFamiliar" value="N" <?php echo set_radio('nDependenciaFamiliar', 'N', FALSE); ?> type="radio" id="iDependenciaFamiliarNao" class="with-gap" />
                                                <label for="iDependenciaFamiliarNao">NÃO</label>
                                            <?php } else if ($dadosUsuario->dependenciaFamiliar == 'S') { ?>
                                                <input name="nDependenciaFamiliar" checked="true" value="S" <?php echo set_radio('nDependenciaFamiliar', 'S', FALSE); ?> type="radio" class="with-gap" id="iDependenciaFamiliarSim" />
                                                <label for="iDependenciaFamiliarSim">SIM</label>
                                                <input name="nDependenciaFamiliar" value="N" <?php echo set_radio('nDependenciaFamiliar', 'N', FALSE); ?> type="radio" id="iDependenciaFamiliarNao" class="with-gap" />
                                                <label for="iDependenciaFamiliarNao">NÃO</label>
                                            <?php } else { ?>
                                                <input name="nDependenciaFamiliar" value="S" <?php echo set_radio('nDependenciaFamiliar', 'S', FALSE); ?> type="radio" class="with-gap" id="iDependenciaFamiliarSim" />
                                                <label for="iDependenciaFamiliarSim">SIM</label>
                                                <input name="nDependenciaFamiliar" value="N" checked="true" <?php echo set_radio('nDependenciaFamiliar', 'N', FALSE); ?> type="radio" id="iDependenciaFamiliarNao" class="with-gap" />
                                                <label for="iDependenciaFamiliarNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nDependenciaFamiliar']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Em caso de sim, quem é?</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="iDependente" name="nDependente" value="<?php echo set_value('nDependente', $dadosUsuario->dependenteFamiliar); ?>" class="form-control">

                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nDependente']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Os pais realiazam atividades (brincar, criar, trabalhar, assistir tv) com a criança? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php if (empty($dadosUsuario->atividadesFamilia)) { ?>
                                                <input name="nAtividadesFamilia" value="S" <?php echo set_radio('nAtividadesFamilia', 'S', FALSE); ?> type="radio" class="with-gap" id="iAtividadeFamiliaSim" />
                                                <label for="iAtividadeFamiliaSim">SIM</label>
                                                <input name="nAtividadesFamilia" value="N" <?php echo set_radio('nAtividadesFamilia', 'N', FALSE); ?> type="radio" id="iAtividadeFamiliaNao" class="with-gap" />
                                                <label for="iAtividadeFamiliaNao">NÃO</label>
                                            <?php } else if ($dadosUsuario->atividadesFamilia == 'S') { ?>
                                                <input name="nAtividadesFamilia" checked="true" value="S" <?php echo set_radio('nAtividadesFamilia', 'S', FALSE); ?> type="radio" class="with-gap" id="iAtividadeFamiliaSim" />
                                                <label for="iAtividadeFamiliaSim">SIM</label>
                                                <input name="nAtividadesFamilia" value="N" <?php echo set_radio('nAtividadesFamilia', 'N', FALSE); ?> type="radio" id="iAtividadeFamiliaNao" class="with-gap" />
                                                <label for="iAtividadeFamiliaNao">NÃO</label>
                                            <?php } else { ?>
                                                <input name="nAtividadesFamilia" value="S" <?php echo set_radio('nAtividadesFamilia', 'S', FALSE); ?> type="radio" class="with-gap" id="iAtividadeFamiliaSim" />
                                                <label for="iAtividadeFamiliaSim">SIM</label>
                                                <input name="nAtividadesFamilia" value="N" checked="true" <?php echo set_radio('nAtividadesFamilia', 'N', FALSE); ?> type="radio" id="iAtividadeFamiliaNao" class="with-gap" />
                                                <label for="iAtividadeFamiliaNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nAtividadesFamilia']??'';?></span></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Nome do médico que fez o diagnósitco?</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="" name="nMedicoDiagnostico" value="<?php echo set_value('nMedicoDiagnostico', $dadosUsuario->medicoDiagnostico); ?>" class="form-control">

                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nMedicoDiagnostico']??'';?></span></span>
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