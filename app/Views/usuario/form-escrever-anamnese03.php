
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

                        echo form_open('usuario/escrever_anamnese_ep03', $atributos_formulario);
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
                                  echo anchor('usuario/form_escrever_anamnese02/' . encrypt($dadosUsuario->idUsuario), '<i class="material-icons"> keyboard_backspace </i> 02. ETAPA', array('class' => 'btn bg-indigo waves-effect')) . '  ';
                                ?>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">

                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                            <label style = "text-decoration: underline";>EVOLUÇÃO PSICOMOTORA:</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">                              
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Ficou no cercadinho? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->ficouCercadinho))
                                            {
                                                ?>
                                                <input name="nCercadinho" value="S" <?php echo set_radio('nCercadinho', 'S', FALSE); ?> type="radio" class="with-gap" id="iCercadinhoSim" />
                                                <label for="iCercadinhoSim">SIM</label>
                                                <input name="nCercadinho" value="N" <?php echo set_radio('nCercadinho', 'N', FALSE); ?> type="radio" class="with-gap" id="iCercadinhoNao" />
                                                <label for="iCercadinhoNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->ficouCercadinho == 'S')
                                            {
                                                ?>
                                                <input name="nCercadinho" value="S" checked="true" <?php echo set_radio('nCercadinho', 'S', FALSE); ?> type="radio" class="with-gap" id="iCercadinhoSim" />
                                                <label for="iCercadinhoSim">SIM</label>
                                                <input name="nCercadinho" value="N" <?php echo set_radio('nCercadinho', 'N', FALSE); ?> type="radio" class="with-gap" id="iCercadinhoNao" />
                                                <label for="iCercadinhoNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nCercadinho" value="S"  <?php echo set_radio('nCercadinho', 'S', FALSE); ?> type="radio" class="with-gap" id="iCercadinhoSim" />
                                                <label for="iCercadinhoSim">SIM</label>
                                                <input name="nCercadinho" value="N" checked="true" <?php echo set_radio('nCercadinho', 'N', FALSE); ?> type="radio" class="with-gap" id="iCercadinhoNao" />
                                                <label for="iCercadinhoNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nCercadinho']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Engatinhou? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->engatinhou))
                                            {
                                                ?>
                                                <input name="nEngatinhou" value="S" <?php echo set_radio('nEngatinhou', 'S', FALSE); ?> type="radio" class="with-gap" id="iEngatinhouSim" />
                                                <label for="iEngatinhouSim">SIM</label>
                                                <input name="nEngatinhou" value="N" <?php echo set_radio('nEngatinhou', 'N', FALSE); ?> type="radio" class="with-gap" id="iEngatinhouNao" />
                                                <label for="iEngatinhouNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->engatinhou == 'S')
                                            {
                                                ?>
                                                <input name="nEngatinhou" value="S" checked="true" <?php echo set_radio('nEngatinhou', 'S', FALSE); ?> type="radio" class="with-gap" id="iEngatinhouSim" />
                                                <label for="iEngatinhouSim">SIM</label>
                                                <input name="nEngatinhou" value="N" <?php echo set_radio('nEngatinhou', 'N', FALSE); ?> type="radio" class="with-gap" id="iEngatinhouNao" />
                                                <label for="iEngatinhouNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nEngatinhou" value="S"  <?php echo set_radio('nEngatinhou', 'S', FALSE); ?> type="radio" class="with-gap" id="iEngatinhouSim" />
                                                <label for="iEngatinhouSim">SIM</label>
                                                <input name="nEngatinhou" value="N" checked="true" <?php echo set_radio('nEngatinhou', 'N', FALSE); ?> type="radio" class="with-gap" id="iEngatinhouNao" />
                                                <label for="iEngatinhouNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nEngatinhou']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Com que idade andou? * </label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nIdadeAndou" value="<?php echo set_value('nIdadeAndou', $dadosUsuario->idadeAndou); ?>" class="form-control numeroMaxDois">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nIdadeAndou']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Caía muito? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->caiaMuito))
                                            {
                                                ?>
                                                <input name="nCaiaMuito" value="S" <?php echo set_radio('nCaiaMuito', 'S', FALSE); ?> type="radio" class="with-gap" id="iCaiaMuitoSim" />
                                                <label for="iCaiaMuitoSim">SIM</label>
                                                <input name="nCaiaMuito" value="N" <?php echo set_radio('nCaiaMuito', 'N', FALSE); ?> type="radio" class="with-gap" id="iCaiaMuitoNao" />
                                                <label for="iCaiaMuitoNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->caiaMuito == 'S')
                                            {
                                                ?>
                                                <input name="nCaiaMuito" value="S" checked="true" <?php echo set_radio('nCaiaMuito', 'S', FALSE); ?> type="radio" class="with-gap" id="iCaiaMuitoSim" />
                                                <label for="iCaiaMuitoSim">SIM</label>
                                                <input name="nCaiaMuito" value="N" <?php echo set_radio('nCaiaMuito', 'N', FALSE); ?> type="radio" class="with-gap" id="iCaiaMuitoNao" />
                                                <label for="iCaiaMuitoNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nCaiaMuito" value="S"  <?php echo set_radio('nCaiaMuito', 'S', FALSE); ?> type="radio" class="with-gap" id="iCaiaMuitoSim" />
                                                <label for="iCaiaMuitoSim">SIM</label>
                                                <input name="nCaiaMuito" value="N" checked="true" <?php echo set_radio('nCaiaMuito', 'N', FALSE); ?> type="radio" class="with-gap" id="iCaiaMuitoNao" />
                                                <label for="iCaiaMuitoNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nCaiaMuito']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Quem ensinou a andar? * </label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nQuemEnsinouAndar" value="<?php echo set_value('nQuemEnsinouAndar', $dadosUsuario->quemEnsinouAndar); ?>" class="form-control">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nQuemEnsinouAndar']??'';?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Como aprendeu a andar? * </label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nComoAprendeu" value="<?php echo set_value('nComoAprendeu', $dadosUsuario->comoAprendouAndar); ?>" class="form-control">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nComoAprendeu']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Mostrava-se corajoso(a) ao subir uma escada? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->corajosoEscada))
                                            {
                                                ?>
                                                <input name="nCorajoso" value="S" <?php echo set_radio('nCorajoso', 'S', FALSE); ?> type="radio" class="with-gap" id="iCorajosoSim" />
                                                <label for="iCorajosoSim">SIM</label>
                                                <input name="nCorajoso" value="N" <?php echo set_radio('nCorajoso', 'N', FALSE); ?> type="radio" class="with-gap" id="iCorajosoNao" />
                                                <label for="iCorajosoNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->corajosoEscada == 'S')
                                            {
                                                ?>
                                                <input name="nCorajoso" value="S" checked="true" <?php echo set_radio('nCorajoso', 'S', FALSE); ?> type="radio" class="with-gap" id="iCorajosoSim" />
                                                <label for="iCorajosoSim">SIM</label>
                                                <input name="nCorajoso" value="N" <?php echo set_radio('nCorajoso', 'N', FALSE); ?> type="radio" class="with-gap" id="iCorajosoNao" />
                                                <label for="iCorajosoNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nCorajoso" value="S"  <?php echo set_radio('nCorajoso', 'S', FALSE); ?> type="radio" class="with-gap" id="iCorajosoSim" />
                                                <label for="iCorajosoSim">SIM</label>
                                                <input name="nCorajoso" value="N" checked="true" <?php echo set_radio('nCorajoso', 'N', FALSE); ?> type="radio" class="with-gap" id="iCorajosoNao" />
                                                <label for="iCorajosoNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nCorajoso']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Era corajoso ao explorar, engatinhando, um novo espaço? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->corajosoEspaco))
                                            {
                                                ?>
                                                <input name="nCorajosoEspaco" value="S" <?php echo set_radio('nCorajosoEspaco', 'S', FALSE); ?> type="radio" class="with-gap" id="iCorajosoEspacoSim" />
                                                <label for="iCorajosoEspacoSim">SIM</label>
                                                <input name="nCorajosoEspaco" value="N" <?php echo set_radio('nCorajosoEspaco', 'N', FALSE); ?> type="radio" class="with-gap" id="iCorajosoEspacoNao" />
                                                <label for="iCorajosoEspacoNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->corajosoEspaco == 'S')
                                            {
                                                ?>
                                                <input name="nCorajosoEspaco" value="S" checked="true" <?php echo set_radio('nCorajosoEspaco', 'S', FALSE); ?> type="radio" class="with-gap" id="iCorajosoEspacoSim" />
                                                <label for="iCorajosoEspacoSim">SIM</label>
                                                <input name="nCorajosoEspaco" value="N" <?php echo set_radio('nCoranCorajonCorajosoEspacosoEspacojoso', 'N', FALSE); ?> type="radio" class="with-gap" id="iCorajosoEspacoNao" />
                                                <label for="iCorajosoEspacoNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nCorajosoEspaco" value="S"  <?php echo set_radio('nCorajosoEspaco', 'S', FALSE); ?> type="radio" class="with-gap" id="iCorajosoEspacoSim" />
                                                <label for="iCorajosoEspacoSim">SIM</label>
                                                <input name="nCorajosoEspaco" value="N" checked="true" <?php echo set_radio('nCorajosoEspaco', 'N', FALSE); ?> type="radio" class="with-gap" id="iCorajosoEspacoNao" />
                                                <label for="iCorajosoEspacoNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nCorajosoEspaco']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Era inseguro? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->eraInseguro))
                                            {
                                                ?>
                                                <input name="nEraInseguro" value="S" <?php echo set_radio('nEraInseguro', 'S', FALSE); ?> type="radio" class="with-gap" id="iEraInseguroSim" />
                                                <label for="iEraInseguroSim">SIM</label>
                                                <input name="nEraInseguro" value="N" <?php echo set_radio('nEraInseguro', 'N', FALSE); ?> type="radio" class="with-gap" id="iEraInseguroNao" />
                                                <label for="iEraInseguroNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->eraInseguro == 'S')
                                            {
                                                ?>
                                                <input name="nEraInseguro" value="S" checked="true" <?php echo set_radio('nEraInseguro', 'S', FALSE); ?> type="radio" class="with-gap" id="iEraInseguroSim" />
                                                <label for="iEraInseguroSim">SIM</label>
                                                <input name="nEraInseguro" value="N" <?php echo set_radio('nEraInseguro', 'N', FALSE); ?> type="radio" class="with-gap" id="iEraInseguroNao" />
                                                <label for="iEraInseguroNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nEraInseguro" value="S"  <?php echo set_radio('nEraInseguro', 'S', FALSE); ?> type="radio" class="with-gap" id="iEraInseguroSim" />
                                                <label for="iEraInseguroSim">SIM</label>
                                                <input name="nEraInseguro" value="N" checked="true" <?php echo set_radio('nEraInseguro', 'N', FALSE); ?> type="radio" class="with-gap" id="iEraInseguroNao" />
                                                <label for="iEraInseguroNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nEraInseguro']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Com quem andava melhor? * </label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nQuemAndavaMelhor" value="<?php echo set_value('nQuemAndavaMelhor', $dadosUsuario->quemAndavaMelhor); ?>" class="form-control">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nQuemAndavaMelhor']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Como evoluiu a coordenação dos movimentos finos? * </label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nEvolucaoMovimento" value="<?php echo set_value('nEvolucaoMovimento', $dadosUsuario->evolucaoMovimentos); ?>" class="form-control">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nEvolucaoMovimento']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>E dos grandes músculos? (chutar uma bola, correr) * </label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nGrandeMusculos" value="<?php echo set_value('nGrandeMusculos', $dadosUsuario->grandesMusculos); ?>" class="form-control">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nGrandeMusculos']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label style = "text-decoration: underline";>Hoje</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">                                
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>É estabanado? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->estabanado))
                                            {
                                                ?>
                                                <input name="nEstabanado" value="S" <?php echo set_radio('nEstabanado', 'S', FALSE); ?> type="radio" class="with-gap" id="iEstabanadoSim" />
                                                <label for="iEstabanadoSim">SIM</label>
                                                <input name="nEstabanado" value="N" <?php echo set_radio('nEstabanado', 'N', FALSE); ?> type="radio" class="with-gap" id="iEstabanadoNao" />
                                                <label for="iEstabanadoNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->estabanado == 'S')
                                            {
                                                ?>
                                                <input name="nEstabanado" value="S" checked="true" <?php echo set_radio('nEstabanado', 'S', FALSE); ?> type="radio" class="with-gap" id="iEstabanadoSim" />
                                                <label for="iEstabanadoSim">SIM</label>
                                                <input name="nEstabanado" value="N" <?php echo set_radio('nEstabanado', 'N', FALSE); ?> type="radio" class="with-gap" id="iEstabanadoNao" />
                                                <label for="iEstabanadoNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nEstabanado" value="S"  <?php echo set_radio('nEstabanado', 'S', FALSE); ?> type="radio" class="with-gap" id="iEstabanadoSim" />
                                                <label for="iEstabanadoSim">SIM</label>
                                                <input name="nEstabanado" value="N" checked="true" <?php echo set_radio('nEstabanado', 'N', FALSE); ?> type="radio" class="with-gap" id="iEstabanadoNao" />
                                                <label for="iEstabanadoNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nEstabanado']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Nada? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->nada))
                                            {
                                                ?>
                                                <input name="nNada" value="S" <?php echo set_radio('nNada', 'S', FALSE); ?> type="radio" class="with-gap" id="iNadaSim" />
                                                <label for="iNadaSim">SIM</label>
                                                <input name="nNada" value="N" <?php echo set_radio('nNada', 'N', FALSE); ?> type="radio" class="with-gap" id="iNadaNao" />
                                                <label for="iNadaNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->nada == 'S')
                                            {
                                                ?>
                                                <input name="nNada" value="S" checked="true" <?php echo set_radio('nNada', 'S', FALSE); ?> type="radio" class="with-gap" id="iNadaSim" />
                                                <label for="iNadaSim">SIM</label>
                                                <input name="nNada" value="N" <?php echo set_radio('nNada', 'N', FALSE); ?> type="radio" class="with-gap" id="iNadaNao" />
                                                <label for="iNadaNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nNada" value="S"  <?php echo set_radio('nNada', 'S', FALSE); ?> type="radio" class="with-gap" id="iNadaSim" />
                                                <label for="iNadaSim">SIM</label>
                                                <input name="nNada" value="N" checked="true" <?php echo set_radio('nNada', 'N', FALSE); ?> type="radio" class="with-gap" id="iNadaNao" />
                                                <label for="iNadaNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nNada']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>É agitado? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->agitado))
                                            {
                                                ?>
                                                <input name="nAgitado" value="S" <?php echo set_radio('nAgitado', 'S', FALSE); ?> type="radio" class="with-gap" id="iAgitadoSim" />
                                                <label for="iAgitadoSim">SIM</label>
                                                <input name="nAgitado" value="N" <?php echo set_radio('nAgitado', 'N', FALSE); ?> type="radio" class="with-gap" id="iAgitadoNao" />
                                                <label for="iAgitadoNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->agitado == 'S')
                                            {
                                                ?>
                                                <input name="nAgitado" value="S" checked="true" <?php echo set_radio('nAgitado', 'S', FALSE); ?> type="radio" class="with-gap" id="iAgitadoSim" />
                                                <label for="iAgitadoSim">SIM</label>
                                                <input name="nAgitado" value="N" <?php echo set_radio('nAgitado', 'N', FALSE); ?> type="radio" class="with-gap" id="iAgitadoNao" />
                                                <label for="iAgitadoNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nAgitado" value="S"  <?php echo set_radio('nAgitado', 'S', FALSE); ?> type="radio" class="with-gap" id="iAgitadoSim" />
                                                <label for="iAgitadoSim">SIM</label>
                                                <input name="nAgitado" value="N" checked="true" <?php echo set_radio('nAgitado', 'N', FALSE); ?> type="radio" class="with-gap" id="iAgitadoNao" />
                                                <label for="iAgitadoNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nAgitado']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Anda de patins? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->andaPatins))
                                            {
                                                ?>
                                                <input name="nAndaPatins" value="S" <?php echo set_radio('nAndaPatins', 'S', FALSE); ?> type="radio" class="with-gap" id="iAndaPatinsSim" />
                                                <label for="iAndaPatinsSim">SIM</label>
                                                <input name="nAndaPatins" value="N" <?php echo set_radio('nAndaPatins', 'N', FALSE); ?> type="radio" class="with-gap" id="iAndaPatinsNao" />
                                                <label for="iAndaPatinsNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->andaPatins == 'S')
                                            {
                                                ?>
                                                <input name="nAndaPatins" value="S" checked="true" <?php echo set_radio('nAndaPatins', 'S', FALSE); ?> type="radio" class="with-gap" id="iAndaPatinsSim" />
                                                <label for="iAndaPatinsSim">SIM</label>
                                                <input name="nAndaPatins" value="N" <?php echo set_radio('nAndaPatins', 'N', FALSE); ?> type="radio" class="with-gap" id="iAndaPatinsNao" />
                                                <label for="iAndaPatinsNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nAndaPatins" value="S"  <?php echo set_radio('nAndaPatins', 'S', FALSE); ?> type="radio" class="with-gap" id="iAndaPatinsSim" />
                                                <label for="iAndaPatinsSim">SIM</label>
                                                <input name="nAndaPatins" value="N" checked="true" <?php echo set_radio('nAndaPatins', 'N', FALSE); ?> type="radio" class="with-gap" id="iAndaPatinsNao" />
                                                <label for="iAndaPatinsNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nAndaPatins']??'';?></span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Anda de bicicleta sem rodinha? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->andaBicicleta))
                                            {
                                                ?>
                                                <input name="nAndaBicicleta" value="S" <?php echo set_radio('nAndaBicicleta', 'S', FALSE); ?> type="radio" class="with-gap" id="iAndaBicicletaSim" />
                                                <label for="iAndaBicicletaSim">SIM</label>
                                                <input name="nAndaBicicleta" value="N" <?php echo set_radio('nAndaBicicleta', 'N', FALSE); ?> type="radio" class="with-gap" id="iAndaBicicletaNao" />
                                                <label for="iAndaBicicletaNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->andaBicicleta == 'S')
                                            {
                                                ?>
                                                <input name="nAndaBicicleta" value="S" checked="true" <?php echo set_radio('nAndaBicicleta', 'S', FALSE); ?> type="radio" class="with-gap" id="iAndaBicicletaSim" />
                                                <label for="iAndaBicicletaSim">SIM</label>
                                                <input name="nAndaBicicleta" value="N" <?php echo set_radio('nAndaBicicleta', 'N', FALSE); ?> type="radio" class="with-gap" id="iAndaBicicletaNao" />
                                                <label for="iAndaBicicletaNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nAndaBicicleta" value="S"  <?php echo set_radio('nAndaBicicleta', 'S', FALSE); ?> type="radio" class="with-gap" id="iAndaBicicletaSim" />
                                                <label for="iAndaBicicletaSim">SIM</label>
                                                <input name="nAndaBicicleta" value="N" checked="true" <?php echo set_radio('nAndaBicicleta', 'N', FALSE); ?> type="radio" class="with-gap" id="iAndaBicicletaNao" />
                                                <label for="iAndaBicicletaNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nAndaBicicleta']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Anda a cavalo? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->andaCavalo))
                                            {
                                                ?>
                                                <input name="nAndaCavalo" value="S" <?php echo set_radio('nAndaCavalo', 'S', FALSE); ?> type="radio" class="with-gap" id="iAndaCavaloSim" />
                                                <label for="iAndaCavaloSim">SIM</label>
                                                <input name="nAndaCavalo" value="N" <?php echo set_radio('nAndaCavalo', 'N', FALSE); ?> type="radio" class="with-gap" id="iAndaCavaloNao" />
                                                <label for="iAndaCavaloNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->andaCavalo == 'S')
                                            {
                                                ?>
                                                <input name="nAndaCavalo" value="S" checked="true" <?php echo set_radio('nAndaCavalo', 'S', FALSE); ?> type="radio" class="with-gap" id="iAndaCavaloSim" />
                                                <label for="iAndaCavaloSim">SIM</label>
                                                <input name="nAndaCavalo" value="N" <?php echo set_radio('nAndaCavalo', 'N', FALSE); ?> type="radio" class="with-gap" id="iAndaCavaloNao" />
                                                <label for="iAndaCavaloNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nAndaCavalo" value="S"  <?php echo set_radio('nAndaCavalo', 'S', FALSE); ?> type="radio" class="with-gap" id="iAndaCavaloSim" />
                                                <label for="iAndaCavaloSim">SIM</label>
                                                <input name="nAndaCavalo" value="N" checked="true" <?php echo set_radio('nAndaCavalo', 'N', FALSE); ?> type="radio" class="with-gap" id="iAndaCavaloNao" />
                                                <label for="iAndaCavaloNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nAndaCavalo']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Sobe em árvores? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->sobeArvore))
                                            {
                                                ?>
                                                <input name="nSobeArvores" value="S" <?php echo set_radio('nSobeArvores', 'S', FALSE); ?> type="radio" class="with-gap" id="iSobeArvoresSim" />
                                                <label for="iSobeArvoresSim">SIM</label>
                                                <input name="nSobeArvores" value="N" <?php echo set_radio('nSobeArvores', 'N', FALSE); ?> type="radio" class="with-gap" id="iSobeArvoresNao" />
                                                <label for="iSobeArvoresNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->sobeArvore == 'S')
                                            {
                                                ?>
                                                <input name="nSobeArvores" value="S" checked="true" <?php echo set_radio('nSobeArvores', 'S', FALSE); ?> type="radio" class="with-gap" id="iSobeArvoresSim" />
                                                <label for="iSobeArvoresSim">SIM</label>
                                                <input name="nSobeArvores" value="N" <?php echo set_radio('nSobeArvores', 'N', FALSE); ?> type="radio" class="with-gap" id="iSobeArvoresNao" />
                                                <label for="iSobeArvoresNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nSobeArvores" value="S"  <?php echo set_radio('nSobeArvores', 'S', FALSE); ?> type="radio" class="with-gap" id="iSobeArvoresSim" />
                                                <label for="iSobeArvoresSim">SIM</label>
                                                <input name="nSobeArvores" value="N" checked="true" <?php echo set_radio('nSobeArvores', 'N', FALSE); ?> type="radio" class="with-gap" id="iSobeArvoresNao" />
                                                <label for="iSobeArvoresNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nSobeArvores']??'';?></span>
                                </div>
                            </div>
                        </div>                     
                      
                        <div class="row clearfix">
                            <div class="col-lg-offset-5 col-md-offset-5 col-sm-offset-6 col-xs-offset-6">
                                <button class="btn bg-teal waves-effect" type="submit"><span class="badge">S</span> ALVAR
                                    <i class="material-icons"> keyboard_tab </i> 04. ETAPA
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