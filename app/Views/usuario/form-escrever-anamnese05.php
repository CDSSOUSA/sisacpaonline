
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
                            <small>  <h5><?php echo $dadosUsuario->idUsuario . ' - ' . $dadosUsuario->nomeUsuario; ?></h5></small>

                        </h2>
                    </div>
                    <div class="body">
                        <?php
                        $atributos_formulario = array('role' => 'form', 'class' => 'form-horizontal');

                        echo form_open('usuario/escrever_anamnese_ep05', $atributos_formulario);
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
                                  echo anchor('usuario/form_escrever_anamnese04/' . encrypt($dadosUsuario->idUsuario), '<i class="material-icons"> keyboard_backspace </i> 04. ETAPA', array('class' => 'btn bg-indigo waves-effect')) . '  ';
                                ?>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">

                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label style = "text-decoration: underline";>HISTÓRIA CLÍNICA: <br> Ocorreram:</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">                               
                            </div>
                        </div>        
                        
                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Bronquite? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->bronquite))
                                            {
                                                ?>
                                                <input name="nBronquite" value="S" <?php echo set_radio('nBronquite', 'S', FALSE); ?> type="radio" class="with-gap" id="iBronquiteSim" />
                                                <label for="iBronquiteSim">SIM</label>
                                                <input name="nBronquite" value="N" <?php echo set_radio('nBronquite', 'N', FALSE); ?> type="radio" class="with-gap" id="iBronquiteNao" />
                                                <label for="iBronquiteNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->bronquite == 'S')
                                            {
                                                ?>
                                                <input name="nBronquite" value="S" checked="true" <?php echo set_radio('nBronquite', 'S', FALSE); ?> type="radio" class="with-gap" id="iBronquiteSim" />
                                                <label for="iBronquiteSim">SIM</label>
                                                <input name="nBronquite" value="N" <?php echo set_radio('nBronquite', 'N', FALSE); ?> type="radio" class="with-gap" id="iBronquiteNao" />
                                                <label for="iBronquiteNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nBronquite" value="S"  <?php echo set_radio('nBronquite', 'S', FALSE); ?> type="radio" class="with-gap" id="iBronquiteSim" />
                                                <label for="iBronquiteSim">SIM</label>
                                                <input name="nBronquite" value="N" checked="true" <?php echo set_radio('nBronquite', 'N', FALSE); ?> type="radio" class="with-gap" id="iBronquiteNao" />
                                                <label for="iBronquiteNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nBronquite']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Alergia? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->alergia))
                                            {
                                                ?>
                                                <input name="nAlergia" value="S" <?php echo set_radio('nAlergia', 'S', FALSE); ?> type="radio" class="with-gap" id="iAlergiaSim" />
                                                <label for="iAlergiaSim">SIM</label>
                                                <input name="nAlergia" value="N" <?php echo set_radio('nAlergia', 'N', FALSE); ?> type="radio" class="with-gap" id="iAlergiaNao" />
                                                <label for="iAlergiaNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->alergia == 'S')
                                            {
                                                ?>
                                                <input name="nAlergia" value="S" checked="true" <?php echo set_radio('nAlergia', 'S', FALSE); ?> type="radio" class="with-gap" id="iAlergiaSim" />
                                                <label for="iAlergiaSim">SIM</label>
                                                <input name="nAlergia" value="N" <?php echo set_radio('nAlergia', 'N', FALSE); ?> type="radio" class="with-gap" id="iAlergiaNao" />
                                                <label for="iAlergiaNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nAlergia" value="S"  <?php echo set_radio('nAlergia', 'S', FALSE); ?> type="radio" class="with-gap" id="iAlergiaSim" />
                                                <label for="iAlergiaSim">SIM</label>
                                                <input name="nAlergia" value="N" checked="true" <?php echo set_radio('nAlergia', 'N', FALSE); ?> type="radio" class="with-gap" id="iAlergiaNao" />
                                                <label for="iAlergiaNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nAlergia']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Asma? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->asma))
                                            {
                                                ?>
                                                <input name="nAsma" value="S" <?php echo set_radio('nAsma', 'S', FALSE); ?> type="radio" class="with-gap" id="iAsmaSim" />
                                                <label for="iAsmaSim">SIM</label>
                                                <input name="nAsma" value="N" <?php echo set_radio('nAsma', 'N', FALSE); ?> type="radio" class="with-gap" id="iAsmaNao" />
                                                <label for="iAsmaNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->asma == 'S')
                                            {
                                                ?>
                                                <input name="nAsma" value="S" checked="true" <?php echo set_radio('nAsma', 'S', FALSE); ?> type="radio" class="with-gap" id="iAsmaSim" />
                                                <label for="iAsmaSim">SIM</label>
                                                <input name="nAsma" value="N" <?php echo set_radio('nAsma', 'N', FALSE); ?> type="radio" class="with-gap" id="iAsmaNao" />
                                                <label for="iAsmaNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nAsma" value="S"  <?php echo set_radio('nAsma', 'S', FALSE); ?> type="radio" class="with-gap" id="iAsmaSim" />
                                                <label for="iAsmaSim">SIM</label>
                                                <input name="nAsma" value="N" checked="true" <?php echo set_radio('nAsma', 'N', FALSE); ?> type="radio" class="with-gap" id="iAsmaNao" />
                                                <label for="iAsmaNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nAsma']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Viroses infantis? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->viroses))
                                            {
                                                ?>
                                                <input name="nVirose" value="S" <?php echo set_radio('nVirose', 'S', FALSE); ?> type="radio" class="with-gap" id="iViroseSim" />
                                                <label for="iViroseSim">SIM</label>
                                                <input name="nVirose" value="N" <?php echo set_radio('nVirose', 'N', FALSE); ?> type="radio" class="with-gap" id="iViroseNao" />
                                                <label for="iViroseNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->viroses == 'S')
                                            {
                                                ?>
                                                <input name="nVirose" value="S" checked="true" <?php echo set_radio('nVirose', 'S', FALSE); ?> type="radio" class="with-gap" id="iViroseSim" />
                                                <label for="iViroseSim">SIM</label>
                                                <input name="nVirose" value="N" <?php echo set_radio('nVirose', 'N', FALSE); ?> type="radio" class="with-gap" id="iViroseNao" />
                                                <label for="iViroseNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nVirose" value="S"  <?php echo set_radio('nVirose', 'S', FALSE); ?> type="radio" class="with-gap" id="iViroseSim" />
                                                <label for="iViroseSim">SIM</label>
                                                <input name="nVirose" value="N" checked="true" <?php echo set_radio('nVirose', 'N', FALSE); ?> type="radio" class="with-gap" id="iViroseNao" />
                                                <label for="iViroseNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nVirose']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Internações? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->intenacao))
                                            {
                                                ?>
                                                <input name="nInternacoes" value="S" <?php echo set_radio('nInternacoes', 'S', FALSE); ?> type="radio" class="with-gap" id="iInternacoesSim" />
                                                <label for="iInternacoesSim">SIM</label>
                                                <input name="nInternacoes" value="N" <?php echo set_radio('nInternacoes', 'N', FALSE); ?> type="radio" class="with-gap" id="iInternacoesNao" />
                                                <label for="iInternacoesNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->intenacao == 'S')
                                            {
                                                ?>
                                                <input name="nInternacoes" value="S" checked="true" <?php echo set_radio('nInternacoes', 'S', FALSE); ?> type="radio" class="with-gap" id="iInternacoesSim" />
                                                <label for="iInternacoesSim">SIM</label>
                                                <input name="nInternacoes" value="N" <?php echo set_radio('nInternacoes', 'N', FALSE); ?> type="radio" class="with-gap" id="iInternacoesNao" />
                                                <label for="iInternacoesNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nInternacoes" value="S"  <?php echo set_radio('nInternacoes', 'S', FALSE); ?> type="radio" class="with-gap" id="iInternacoesSim" />
                                                <label for="iInternacoesSim">SIM</label>
                                                <input name="nInternacoes" value="N" checked="true" <?php echo set_radio('nInternacoes', 'N', FALSE); ?> type="radio" class="with-gap" id="iInternacoesNao" />
                                                <label for="iInternacoesNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nInternacoes']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Cirurgias? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->cirurgia))
                                            {
                                                ?>
                                                <input name="nCirurgia" value="S" <?php echo set_radio('nCirurgia', 'S', FALSE); ?> type="radio" class="with-gap" id="iCirurgiaSim" />
                                                <label for="iCirurgiaSim">SIM</label>
                                                <input name="nCirurgia" value="N" <?php echo set_radio('nCirurgia', 'N', FALSE); ?> type="radio" class="with-gap" id="iCirurgiaNao" />
                                                <label for="iCirurgiaNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->cirurgia == 'S')
                                            {
                                                ?>
                                                <input name="nCirurgia" value="S" checked="true" <?php echo set_radio('nCirurgia', 'S', FALSE); ?> type="radio" class="with-gap" id="iCirurgiaSim" />
                                                <label for="iCirurgiaSim">SIM</label>
                                                <input name="nCirurgia" value="N" <?php echo set_radio('nCirurgia', 'N', FALSE); ?> type="radio" class="with-gap" id="iCirurgiaNao" />
                                                <label for="iCirurgiaNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nCirurgia" value="S"  <?php echo set_radio('nCirurgia', 'S', FALSE); ?> type="radio" class="with-gap" id="iCirurgiaSim" />
                                                <label for="iCirurgiaSim">SIM</label>
                                                <input name="nCirurgia" value="N" checked="true" <?php echo set_radio('nCirurgia', 'N', FALSE); ?> type="radio" class="with-gap" id="iCirurgiaNao" />
                                                <label for="iCirurgiaNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nCirurgia']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                            <label style = "text-decoration: underline";>Outras doenças:</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">                                
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Tratamentos realizados (fonoaudiológico, psicológico ...)? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->outroTratamento))
                                            {
                                                ?>
                                                <input name="nOutroTratamento" value="S" <?php echo set_radio('nOutroTratamento', 'S', FALSE); ?> type="radio" class="with-gap" id="iOutroTratamentoSim" />
                                                <label for="iOutroTratamentoSim">SIM</label>
                                                <input name="nOutroTratamento" value="N" <?php echo set_radio('nOutroTratamento', 'N', FALSE); ?> type="radio" class="with-gap" id="iOutroTratamentoNao" />
                                                <label for="iOutroTratamentoNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->outroTratamento == 'S')
                                            {
                                                ?>
                                                <input name="nOutroTratamento" value="S" checked="true" <?php echo set_radio('nOutroTratamento', 'S', FALSE); ?> type="radio" class="with-gap" id="iOutroTratamentoSim" />
                                                <label for="iOutroTratamentoSim">SIM</label>
                                                <input name="nOutroTratamento" value="N" <?php echo set_radio('nOutroTratamento', 'N', FALSE); ?> type="radio" class="with-gap" id="iOutroTratamentoNao" />
                                                <label for="iOutroTratamentoNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nOutroTratamento" value="S"  <?php echo set_radio('nOutroTratamento', 'S', FALSE); ?> type="radio" class="with-gap" id="iOutroTratamentoSim" />
                                                <label for="iOutroTratamentoSim">SIM</label>
                                                <input name="nOutroTratamento" value="N" checked="true" <?php echo set_radio('nOutroTratamento', 'N', FALSE); ?> type="radio" class="with-gap" id="iOutroTratamentoNao" />
                                                <label for="iOutroTratamentoNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nOutroTratamento']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Qual(is)? * </label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nQual" value="<?php echo set_value('nQual', $dadosUsuario->qualTratamento); ?>" class="form-control">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nQual']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Problemas de visão? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->problemaVisa))
                                            {
                                                ?>
                                                <input name="nProblemaVisao" value="S" <?php echo set_radio('nProblemaVisao', 'S', FALSE); ?> type="radio" class="with-gap" id="iProblemaVisaoSim" />
                                                <label for="iProblemaVisaoSim">SIM</label>
                                                <input name="nProblemaVisao" value="N" <?php echo set_radio('nProblemaVisao', 'N', FALSE); ?> type="radio" class="with-gap" id="iProblemaVisaoNao" />
                                                <label for="iProblemaVisaoNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->problemaVisa == 'S')
                                            {
                                                ?>
                                                <input name="nProblemaVisao" value="S" checked="true" <?php echo set_radio('nProblemaVisao', 'S', FALSE); ?> type="radio" class="with-gap" id="iProblemaVisaoSim" />
                                                <label for="iProblemaVisaoSim">SIM</label>
                                                <input name="nProblemaVisao" value="N" <?php echo set_radio('nProblemaVisao', 'N', FALSE); ?> type="radio" class="with-gap" id="iProblemaVisaoNao" />
                                                <label for="iProblemaVisaoNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nProblemaVisao" value="S"  <?php echo set_radio('nProblemaVisao', 'S', FALSE); ?> type="radio" class="with-gap" id="iProblemaVisaoSim" />
                                                <label for="iProblemaVisaoSim">SIM</label>
                                                <input name="nProblemaVisao" value="N" checked="true" <?php echo set_radio('nProblemaVisao', 'N', FALSE); ?> type="radio" class="with-gap" id="iProblemaVisaoNao" />
                                                <label for="iProblemaVisaoNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nProblemaVisao']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Problema de audição? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->problemaAudicao))
                                            {
                                                ?>
                                                <input name="nProblemaAudicao" value="S" <?php echo set_radio('nProblemaAudicao', 'S', FALSE); ?> type="radio" class="with-gap" id="iProblemaAudicaoSim" />
                                                <label for="iProblemaAudicaoSim">SIM</label>
                                                <input name="nProblemaAudicao" value="N" <?php echo set_radio('nProblemaAudicao', 'N', FALSE); ?> type="radio" class="with-gap" id="iProblemaAudicaoNao" />
                                                <label for="iProblemaAudicaoNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->problemaAudicao == 'S')
                                            {
                                                ?>
                                                <input name="nProblemaAudicao" value="S" checked="true" <?php echo set_radio('nProblemaAudicao', 'S', FALSE); ?> type="radio" class="with-gap" id="iProblemaAudicaoSim" />
                                                <label for="iProblemaAudicaoSim">SIM</label>
                                                <input name="nProblemaAudicao" value="N" <?php echo set_radio('nProblemaAudicao', 'N', FALSE); ?> type="radio" class="with-gap" id="iProblemaAudicaoNao" />
                                                <label for="iProblemaAudicaoNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nProblemaAudicao" value="S"  <?php echo set_radio('nProblemaAudicao', 'S', FALSE); ?> type="radio" class="with-gap" id="iProblemaAudicaoSim" />
                                                <label for="iProblemaAudicaoSim">SIM</label>
                                                <input name="nProblemaAudicao" value="N" checked="true" <?php echo set_radio('nProblemaAudicao', 'N', FALSE); ?> type="radio" class="with-gap" id="iProblemaAudicaoNao" />
                                                <label for="iProblemaAudicaoNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nProblemaAudicao']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Problemas psicossomáticos (verificar os posssíveis deslocamentos e a eventual relação com a não aprendizagem):</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                    <textarea rows="4" name="nProblemaPsico" class="form-control no-resize textareaLimite1" placeholder="Digite o texto ... Enter para mudar de linha."><?php echo set_value('nProblemaPsico', $dadosUsuario->problemaPsico); ?></textarea>
                                  </div>
                                    <span style="color:red"><?= session()->get('errors')['nProblemaPsico']??'';?></span>
                                </div>
                            </div>
                        </div>    
                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                 <label style = "text-decoration: underline";>HISTÓRIA DA FAMÍLIA NUCLEAR:</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">                                
                            </div>
                        </div>    

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Fatos marcantes dos pais e irmãos (antes, durante e depois da entrada do paciente na família):</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                    <textarea rows="4" name="nFatosMarcantes" class="form-control no-resize textareaLimite1" placeholder="Digite o texto ... Enter para mudar de linha."><?php echo set_value('nFatosMarcantes', $dadosUsuario->fatosMarcantes); ?></textarea>
                                  </div>
                                    <span style="color:red"><?= session()->get('errors')['nFatosMarcantes']??'';?></span>
                                </div>
                            </div>
                        </div>   
                        
                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label style = "text-decoration: underline";>SITUAÇÕES NEGATIVAS VIVENCIADAS PELA CRIANÇA <br>(através de alterações familiares):</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">                              
                            </div>
                        </div>  
                        
                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Nascimento de irmãos? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->nascimentoIrmao))
                                            {
                                                ?>
                                                <input name="nNascimentoIrmao" value="S" <?php echo set_radio('nNascimentoIrmao', 'S', FALSE); ?> type="radio" class="with-gap" id="iNascimentoIrmaoSim" />
                                                <label for="iNascimentoIrmaoSim">SIM</label>
                                                <input name="nNascimentoIrmao" value="N" <?php echo set_radio('nNascimentoIrmao', 'N', FALSE); ?> type="radio" class="with-gap" id="iNascimentoIrmaoNao" />
                                                <label for="iNascimentoIrmaoNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->nascimentoIrmao == 'S')
                                            {
                                                ?>
                                                <input name="nNascimentoIrmao" value="S" checked="true" <?php echo set_radio('nNascimentoIrmao', 'S', FALSE); ?> type="radio" class="with-gap" id="iNascimentoIrmaoSim" />
                                                <label for="iNascimentoIrmaoSim">SIM</label>
                                                <input name="nNascimentoIrmao" value="N" <?php echo set_radio('nNascimentoIrmao', 'N', FALSE); ?> type="radio" class="with-gap" id="iNascimentoIrmaoNao" />
                                                <label for="iNascimentoIrmaoNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nNascimentoIrmao" value="S"  <?php echo set_radio('nNascimentoIrmao', 'S', FALSE); ?> type="radio" class="with-gap" id="iNascimentoIrmaoSim" />
                                                <label for="iNascimentoIrmaoSim">SIM</label>
                                                <input name="nNascimentoIrmao" value="N" checked="true" <?php echo set_radio('nNascimentoIrmao', 'N', FALSE); ?> type="radio" class="with-gap" id="iNascimentoIrmaoNao" />
                                                <label for="iNascimentoIrmaoNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nNascimentoIrmao']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Mudanças? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->mudancas))
                                            {
                                                ?>
                                                <input name="nMudancas" value="S" <?php echo set_radio('nMudancas', 'S', FALSE); ?> type="radio" class="with-gap" id="iMudancasSim" />
                                                <label for="iMudancasSim">SIM</label>
                                                <input name="nMudancas" value="N" <?php echo set_radio('nMudancas', 'N', FALSE); ?> type="radio" class="with-gap" id="iMudancasNao" />
                                                <label for="iMudancasNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->mudancas == 'S')
                                            {
                                                ?>
                                                <input name="nMudancas" value="S" checked="true" <?php echo set_radio('nMudancas', 'S', FALSE); ?> type="radio" class="with-gap" id="iMudancasSim" />
                                                <label for="iMudancasSim">SIM</label>
                                                <input name="nMudancas" value="N" <?php echo set_radio('nMudancas', 'N', FALSE); ?> type="radio" class="with-gap" id="iMudancasNao" />
                                                <label for="iMudancasNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nMudancas" value="S"  <?php echo set_radio('nMudancas', 'S', FALSE); ?> type="radio" class="with-gap" id="iMudancasSim" />
                                                <label for="iMudancasSim">SIM</label>
                                                <input name="nMudancas" value="N" checked="true" <?php echo set_radio('nMudancas', 'N', FALSE); ?> type="radio" class="with-gap" id="iMudancasNao" />
                                                <label for="iMudancasNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nMudancas']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Mortes? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->mortes))
                                            {
                                                ?>
                                                <input name="nMorte" value="S" <?php echo set_radio('nMorte', 'S', FALSE); ?> type="radio" class="with-gap" id="iMorteSim" />
                                                <label for="iMorteSim">SIM</label>
                                                <input name="nMorte" value="N" <?php echo set_radio('nMorte', 'N', FALSE); ?> type="radio" class="with-gap" id="iMorteNao" />
                                                <label for="iMorteNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->mortes == 'S')
                                            {
                                                ?>
                                                <input name="nMorte" value="S" checked="true" <?php echo set_radio('nMorte', 'S', FALSE); ?> type="radio" class="with-gap" id="iMorteSim" />
                                                <label for="iMorteSim">SIM</label>
                                                <input name="nMorte" value="N" <?php echo set_radio('nMorte', 'N', FALSE); ?> type="radio" class="with-gap" id="iMorteNao" />
                                                <label for="iMorteNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nMorte" value="S"  <?php echo set_radio('nMorte', 'S', FALSE); ?> type="radio" class="with-gap" id="iMorteSim" />
                                                <label for="iMorteSim">SIM</label>
                                                <input name="nMorte" value="N" checked="true" <?php echo set_radio('nMorte', 'N', FALSE); ?> type="radio" class="with-gap" id="iMorteNao" />
                                                <label for="iMorteNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nMorte']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Morte de Quem?</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nMorteQuem" value="<?php echo set_value('nMorteQuem', $dadosUsuario->quemMorte); ?>" class="form-control">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nMorteQuem']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Desempregos? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->desemprego))
                                            {
                                                ?>
                                                <input name="nDesemprego" value="S" <?php echo set_radio('nDesemprego', 'S', FALSE); ?> type="radio" class="with-gap" id="iDesempregoSim" />
                                                <label for="iDesempregoSim">SIM</label>
                                                <input name="nDesemprego" value="N" <?php echo set_radio('nDesemprego', 'N', FALSE); ?> type="radio" class="with-gap" id="iDesempregoNao" />
                                                <label for="iDesempregoNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->desemprego == 'S')
                                            {
                                                ?>
                                                <input name="nDesemprego" value="S" checked="true" <?php echo set_radio('nDesemprego', 'S', FALSE); ?> type="radio" class="with-gap" id="iDesempregoSim" />
                                                <label for="iDesempregoSim">SIM</label>
                                                <input name="nDesemprego" value="N" <?php echo set_radio('nDesemprego', 'N', FALSE); ?> type="radio" class="with-gap" id="iDesempregoNao" />
                                                <label for="iDesempregoNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nDesemprego" value="S"  <?php echo set_radio('nDesemprego', 'S', FALSE); ?> type="radio" class="with-gap" id="iDesempregoSim" />
                                                <label for="iDesempregoSim">SIM</label>
                                                <input name="nDesemprego" value="N" checked="true" <?php echo set_radio('nDesemprego', 'N', FALSE); ?> type="radio" class="with-gap" id="iDesempregoNao" />
                                                <label for="iDesempregoNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nDesemprego']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Separações? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->separacao))
                                            {
                                                ?>
                                                <input name="nSeparacao" value="S" <?php echo set_radio('nSeparacao', 'S', FALSE); ?> type="radio" class="with-gap" id="iSeparacaoSim" />
                                                <label for="iSeparacaoSim">SIM</label>
                                                <input name="nSeparacao" value="N" <?php echo set_radio('nSeparacao', 'N', FALSE); ?> type="radio" class="with-gap" id="iSeparacaoNao" />
                                                <label for="iSeparacaoNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->separacao == 'S')
                                            {
                                                ?>
                                                <input name="nSeparacao" value="S" checked="true" <?php echo set_radio('nSeparacao', 'S', FALSE); ?> type="radio" class="with-gap" id="iSeparacaoSim" />
                                                <label for="iSeparacaoSim">SIM</label>
                                                <input name="nSeparacao" value="N" <?php echo set_radio('nSeparacao', 'N', FALSE); ?> type="radio" class="with-gap" id="iSeparacaoNao" />
                                                <label for="iSeparacaoNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nSeparacao" value="S"  <?php echo set_radio('nSeparacao', 'S', FALSE); ?> type="radio" class="with-gap" id="iSeparacaoSim" />
                                                <label for="iSeparacaoSim">SIM</label>
                                                <input name="nSeparacao" value="N" checked="true" <?php echo set_radio('nSeparacao', 'N', FALSE); ?> type="radio" class="with-gap" id="iSeparacaoNao" />
                                                <label for="iSeparacaoNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nSeparacao']??'';?></span>
                                </div>
                            </div>
                        </div>




                      
                        <div class="row clearfix">
                            <div class="col-lg-offset-5 col-md-offset-5 col-sm-offset-6 col-xs-offset-6">
                                <button class="btn bg-teal waves-effect" type="submit"><span class="badge">S</span> ALVAR
                                    <i class="material-icons"> keyboard_tab </i> 06. ETAPA
                                </button>
                                <?php
                                //echo session()-> get('botaoSalvar');
                                echo session()-> get('botaoLimpar');
                                echo gerarbotaoVoltar('detalhar_usuario/' . encrypt($dadosUsuario->idUsuario));
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