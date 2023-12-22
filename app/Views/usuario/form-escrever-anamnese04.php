
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

                        echo form_open('usuario/escrever_anamnese_ep04', $atributos_formulario);
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
                                  echo anchor('usuario/form_escrever_anamnese03/' . encrypt($dadosUsuario->idUsuario), '<i class="material-icons"> keyboard_backspace </i> 03. ETAPA', array('class' => 'btn bg-indigo waves-effect')) . '  ';
                                ?>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">

                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                            <label style = "text-decoration: underline";>FALA:</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">                               
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Com que idade começou a falar? * </label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nIdadeFala" value="<?php echo set_value('nIdadeFala', $dadosUsuario->idadeFalou); ?>" class="form-control numeroMaxDois">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nIdadeFala']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Com quem falava mais? * </label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nFalavaMais" value="<?php echo set_value('nFalavaMais', $dadosUsuario->comQuemFalava); ?>" class="form-control">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nFalavaMais']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Falava(m) para ele(a) repetir? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->falavaRepetir))
                                            {
                                                ?>
                                                <input name="nFalavaRepetir" value="S" <?php echo set_radio('nFalavaRepetir', 'S', FALSE); ?> type="radio" class="with-gap" id="iFalavaRepetirSim" />
                                                <label for="iFalavaRepetirSim">SIM</label>
                                                <input name="nFalavaRepetir" value="N" <?php echo set_radio('nFalavaRepetir', 'N', FALSE); ?> type="radio" class="with-gap" id="iFalavaRepetirNao" />
                                                <label for="iFalavaRepetirNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->falavaRepetir == 'S')
                                            {
                                                ?>
                                                <input name="nFalavaRepetir" value="S" checked="true" <?php echo set_radio('nFalavaRepetir', 'S', FALSE); ?> type="radio" class="with-gap" id="iFalavaRepetirSim" />
                                                <label for="iFalavaRepetirSim">SIM</label>
                                                <input name="nFalavaRepetir" value="N" <?php echo set_radio('nFalavaRepetir', 'N', FALSE); ?> type="radio" class="with-gap" id="iFalavaRepetirNao" />
                                                <label for="iFalavaRepetirNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nFalavaRepetir" value="S"  <?php echo set_radio('nFalavaRepetir', 'S', FALSE); ?> type="radio" class="with-gap" id="iFalavaRepetirSim" />
                                                <label for="iFalavaRepetirSim">SIM</label>
                                                <input name="nFalavaRepetir" value="N" checked="true" <?php echo set_radio('nFalavaRepetir', 'N', FALSE); ?> type="radio" class="with-gap" id="iFalavaRepetirNao" />
                                                <label for="iFalavaRepetirNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nFalavaRepetir']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Quais foram as primeiras palavras? * </label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nPalavras" value="<?php echo set_value('nPalavras', $dadosUsuario->primeirasPalavras); ?>" class="form-control">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nPalavras']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Trocava letras? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->trocavaLetras))
                                            {
                                                ?>
                                                <input name="nTrocavaLetras" value="S" <?php echo set_radio('nTrocavaLetras', 'S', FALSE); ?> type="radio" class="with-gap" id="iTrocaLetrasSim" />
                                                <label for="iTrocaLetrasSim">SIM</label>
                                                <input name="nTrocavaLetras" value="N" <?php echo set_radio('nTrocavaLetras', 'N', FALSE); ?> type="radio" class="with-gap" id="iTrocaLetrasNao" />
                                                <label for="iTrocaLetrasNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->trocavaLetras == 'S')
                                            {
                                                ?>
                                                <input name="nTrocavaLetras" value="S" checked="true" <?php echo set_radio('nTrocavaLetras', 'S', FALSE); ?> type="radio" class="with-gap" id="iTrocaLetrasSim" />
                                                <label for="iTrocaLetrasSim">SIM</label>
                                                <input name="nTrocavaLetras" value="N" <?php echo set_radio('nTrocavaLetras', 'N', FALSE); ?> type="radio" class="with-gap" id="iTrocaLetrasNao" />
                                                <label for="iTrocaLetrasNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nTrocavaLetras" value="S"  <?php echo set_radio('nTrocavaLetras', 'S', FALSE); ?> type="radio" class="with-gap" id="iTrocaLetrasSim" />
                                                <label for="iTrocaLetrasSim">SIM</label>
                                                <input name="nTrocavaLetras" value="N" checked="true" <?php echo set_radio('nTrocavaLetras', 'N', FALSE); ?> type="radio" class="with-gap" id="iTrocaLetrasNao" />
                                                <label for="iTrocaLetrasNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nTrocavaLetras']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Quais? * </label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nQuaisLetras" value="<?php echo set_value('nQuaisLetras', $dadosUsuario->quaisLetras); ?>" class="form-control">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nQuaisLetras']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Falava muito errado? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->falavaErrado))
                                            {
                                                ?>
                                                <input name="nFalavaErrado" value="S" <?php echo set_radio('nFalavaErrado', 'S', FALSE); ?> type="radio" class="with-gap" id="iFalavaErradoSim" />
                                                <label for="iFalavaErradoSim">SIM</label>
                                                <input name="nFalavaErrado" value="N" <?php echo set_radio('nFalavaErrado', 'N', FALSE); ?> type="radio" class="with-gap" id="iFalavaErradoNao" />
                                                <label for="iFalavaErradoNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->falavaErrado == 'S')
                                            {
                                                ?>
                                                <input name="nFalavaErrado" value="S" checked="true" <?php echo set_radio('nFalavaErrado', 'S', FALSE); ?> type="radio" class="with-gap" id="iFalavaErradoSim" />
                                                <label for="iFalavaErradoSim">SIM</label>
                                                <input name="nFalavaErrado" value="N" <?php echo set_radio('nFalavaErrado', 'N', FALSE); ?> type="radio" class="with-gap" id="iFalavaErradoNao" />
                                                <label for="iFalavaErradoNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nFalavaErrado" value="S"  <?php echo set_radio('nFalavaErrado', 'S', FALSE); ?> type="radio" class="with-gap" id="iFalavaErradoSim" />
                                                <label for="iFalavaErradoSim">SIM</label>
                                                <input name="nFalavaErrado" value="N" checked="true" <?php echo set_radio('nFalavaErrado', 'N', FALSE); ?> type="radio" class="with-gap" id="iFalavaErradoNao" />
                                                <label for="iFalavaErradoNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nFalavaErrado']??'';?></span>
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
                                <label>Troca letras? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->trocaLetras))
                                            {
                                                ?>
                                                <input name="nTrocaLetras" value="S" <?php echo set_radio('nTrocaLetras', 'S', FALSE); ?> type="radio" class="with-gap" id="iTrocaLetrasHojeSim" />
                                                <label for="iTrocaLetrasHojeSim">SIM</label>
                                                <input name="nTrocaLetras" value="N" <?php echo set_radio('nTrocaLetras', 'N', FALSE); ?> type="radio" class="with-gap" id="iTrocaLetrasHojeNao" />
                                                <label for="iTrocaLetrasHojeNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->trocaLetras == 'S')
                                            {
                                                ?>
                                                <input name="nTrocaLetras" value="S" checked="true" <?php echo set_radio('nTrocaLetras', 'S', FALSE); ?> type="radio" class="with-gap" id="iTrocaLetrasHojeSim" />
                                                <label for="iTrocaLetrasHojeSim">SIM</label>
                                                <input name="nTrocaLetras" value="N" <?php echo set_radio('nTrocaLetras', 'N', FALSE); ?> type="radio" class="with-gap" id="iTrocaLetrasHojeNao" />
                                                <label for="iTrocaLetrasHojeNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nTrocaLetras" value="S"  <?php echo set_radio('nTrocaLetras', 'S', FALSE); ?> type="radio" class="with-gap" id="iTrocaLetrasHojeSim" />
                                                <label for="iTrocaLetrasHojeSim">SIM</label>
                                                <input name="nTrocaLetras" value="N" checked="true" <?php echo set_radio('nTrocaLetras', 'N', FALSE); ?> type="radio" class="with-gap" id="iTrocaLetrasHojeNao" />
                                                <label for="iTrocaLetrasHojeNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nTrocaLetras']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Fala muito | pouco (ancioso)? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->falaMuito))
                                            {
                                                ?>
                                                <input name="nFalaMuito" value="S" <?php echo set_radio('nFalaMuito', 'S', FALSE); ?> type="radio" class="with-gap" id="iFalaMuitoSim" />
                                                <label for="iFalaMuitoSim">SIM</label>
                                                <input name="nFalaMuito" value="N" <?php echo set_radio('nFalaMuito', 'N', FALSE); ?> type="radio" class="with-gap" id="iFalaMuitoNao" />
                                                <label for="iFalaMuitoNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->falaMuito == 'S')
                                            {
                                                ?>
                                                <input name="nFalaMuito" value="S" checked="true" <?php echo set_radio('nFalaMuito', 'S', FALSE); ?> type="radio" class="with-gap" id="iFalaMuitoSim" />
                                                <label for="iFalaMuitoSim">SIM</label>
                                                <input name="nFalaMuito" value="N" <?php echo set_radio('nFalaMuito', 'N', FALSE); ?> type="radio" class="with-gap" id="iFalaMuitoNao" />
                                                <label for="iFalaMuitoNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nFalaMuito" value="S"  <?php echo set_radio('nFalaMuito', 'S', FALSE); ?> type="radio" class="with-gap" id="iFalaMuitoSim" />
                                                <label for="iFalaMuitoSim">SIM</label>
                                                <input name="nFalaMuito" value="N" checked="true" <?php echo set_radio('nFalaMuito', 'N', FALSE); ?> type="radio" class="with-gap" id="iFalaMuitoNao" />
                                                <label for="iFalaMuitoNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nFalaMuito']??'';?></span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Fala de uma forma que todos entendem? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->falaEntende))
                                            {
                                                ?>
                                                <input name="nFalaEntende" value="S" <?php echo set_radio('nFalaEntende', 'S', FALSE); ?> type="radio" class="with-gap" id="iFalaEntendeSim" />
                                                <label for="iFalaEntendeSim">SIM</label>
                                                <input name="nFalaEntende" value="N" <?php echo set_radio('nFalaEntende', 'N', FALSE); ?> type="radio" class="with-gap" id="iFalaEntendeNao" />
                                                <label for="iFalaEntendeNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->falaEntende == 'S')
                                            {
                                                ?>
                                                <input name="nFalaEntende" value="S" checked="true" <?php echo set_radio('nFalaEntende', 'S', FALSE); ?> type="radio" class="with-gap" id="iFalaEntendeSim" />
                                                <label for="iFalaEntendeSim">SIM</label>
                                                <input name="nFalaEntende" value="N" <?php echo set_radio('nFalaEntende', 'N', FALSE); ?> type="radio" class="with-gap" id="iFalaEntendeNao" />
                                                <label for="iFalaEntendeNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nFalaEntende" value="S"  <?php echo set_radio('nFalaEntende', 'S', FALSE); ?> type="radio" class="with-gap" id="iFalaEntendeSim" />
                                                <label for="iFalaEntendeSim">SIM</label>
                                                <input name="nFalaEntende" value="N" checked="true" <?php echo set_radio('nFalaEntende', 'N', FALSE); ?> type="radio" class="with-gap" id="iFalaEntendeNao" />
                                                <label for="iFalaEntendeNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nFalaEntende']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Dê um exemplo de como ele(a) fala: * </label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nExemploFala" value="<?php echo set_value('nExemploFala', $dadosUsuario->exemploFala); ?>" class="form-control">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nExemploFala']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Consegue dar recado? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->darRecado))
                                            {
                                                ?>
                                                <input name="nDarRecado" value="S" <?php echo set_radio('nDarRecado', 'S', FALSE); ?> type="radio" class="with-gap" id="iDarRecadoSim" />
                                                <label for="iDarRecadoSim">SIM</label>
                                                <input name="nDarRecado" value="N" <?php echo set_radio('nDarRecado', 'N', FALSE); ?> type="radio" class="with-gap" id="iDarRecadoNao" />
                                                <label for="iDarRecadoNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->darRecado == 'S')
                                            {
                                                ?>
                                                <input name="nDarRecado" value="S" checked="true" <?php echo set_radio('nDarRecado', 'S', FALSE); ?> type="radio" class="with-gap" id="iDarRecadoSim" />
                                                <label for="iDarRecadoSim">SIM</label>
                                                <input name="nDarRecado" value="N" <?php echo set_radio('nDarRecado', 'N', FALSE); ?> type="radio" class="with-gap" id="iDarRecadoNao" />
                                                <label for="iDarRecadoNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nDarRecado" value="S"  <?php echo set_radio('nDarRecado', 'S', FALSE); ?> type="radio" class="with-gap" id="iDarRecadoSim" />
                                                <label for="iDarRecadoSim">SIM</label>
                                                <input name="nDarRecado" value="N" checked="true" <?php echo set_radio('nDarRecado', 'N', FALSE); ?> type="radio" class="with-gap" id="iDarRecadoNao" />
                                                <label for="iDarRecadoNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nDarRecado']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Faz compra sozinho(a)? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->compraSozinho))
                                            {
                                                ?>
                                                <input name="nCompraSozinho" value="S" <?php echo set_radio('nCompraSozinho', 'S', FALSE); ?> type="radio" class="with-gap" id="iCompraSozinhoSim" />
                                                <label for="iCompraSozinhoSim">SIM</label>
                                                <input name="nCompraSozinho" value="N" <?php echo set_radio('nCompraSozinho', 'N', FALSE); ?> type="radio" class="with-gap" id="iCompraSozinhoNao" />
                                                <label for="iCompraSozinhoNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->compraSozinho == 'S')
                                            {
                                                ?>
                                                <input name="nCompraSozinho" value="S" checked="true" <?php echo set_radio('nCompraSozinho', 'S', FALSE); ?> type="radio" class="with-gap" id="iCompraSozinhoSim" />
                                                <label for="iCompraSozinhoSim">SIM</label>
                                                <input name="nCompraSozinho" value="N" <?php echo set_radio('nCompraSozinho', 'N', FALSE); ?> type="radio" class="with-gap" id="iCompraSozinhoNao" />
                                                <label for="iCompraSozinhoNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nCompraSozinho" value="S"  <?php echo set_radio('nCompraSozinho', 'S', FALSE); ?> type="radio" class="with-gap" id="iCompraSozinhoSim" />
                                                <label for="iCompraSozinhoSim">SIM</label>
                                                <input name="nCompraSozinho" value="N" checked="true" <?php echo set_radio('nCompraSozinho', 'N', FALSE); ?> type="radio" class="with-gap" id="iCompraSozinhoNao" />
                                                <label for="iCompraSozinhoNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nCompraSozinho']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Conta história | um caso | uma novela? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->contaHistoria))
                                            {
                                                ?>
                                                <input name="nContaHistoria" value="S" <?php echo set_radio('nContaHistoria', 'S', FALSE); ?> type="radio" class="with-gap" id="iContaHistoriaSim" />
                                                <label for="iContaHistoriaSim">SIM</label>
                                                <input name="nContaHistoria" value="N" <?php echo set_radio('nContaHistoria', 'N', FALSE); ?> type="radio" class="with-gap" id="iContaHistoriaNao" />
                                                <label for="iContaHistoriaNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->contaHistoria == 'S')
                                            {
                                                ?>
                                                <input name="nContaHistoria" value="S" checked="true" <?php echo set_radio('nContaHistoria', 'S', FALSE); ?> type="radio" class="with-gap" id="iContaHistoriaSim" />
                                                <label for="iContaHistoriaSim">SIM</label>
                                                <input name="nContaHistoria" value="N" <?php echo set_radio('nContaHistoria', 'N', FALSE); ?> type="radio" class="with-gap" id="iContaHistoriaNao" />
                                                <label for="iContaHistoriaNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nContaHistoria" value="S"  <?php echo set_radio('nContaHistoria', 'S', FALSE); ?> type="radio" class="with-gap" id="iContaHistoriaSim" />
                                                <label for="iContaHistoriaSim">SIM</label>
                                                <input name="nContaHistoria" value="N" checked="true" <?php echo set_radio('nContaHistoria', 'N', FALSE); ?> type="radio" class="with-gap" id="iContaHistoriaNao" />
                                                <label for="iContaHistoriaNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nContaHistoria']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Dê um exemplo: * </label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nExemploHistoria" value="<?php echo set_value('nExemploHistoria', $dadosUsuario->exemploHistoria); ?>" class="form-control">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nExemploHistoria']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Você entende o que ele(a) conta? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->entendeEleConta))
                                            {
                                                ?>
                                                <input name="nEntendeConta" value="S" <?php echo set_radio('nEntendeConta', 'S', FALSE); ?> type="radio" class="with-gap" id="iEntendeContaSim" />
                                                <label for="iEntendeContaSim">SIM</label>
                                                <input name="nEntendeConta" value="N" <?php echo set_radio('nEntendeConta', 'N', FALSE); ?> type="radio" class="with-gap" id="iEntendeContaNao" />
                                                <label for="iEntendeContaNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->entendeEleConta == 'S')
                                            {
                                                ?>
                                                <input name="nEntendeConta" value="S" checked="true" <?php echo set_radio('nEntendeConta', 'S', FALSE); ?> type="radio" class="with-gap" id="iEntendeContaSim" />
                                                <label for="iEntendeContaSim">SIM</label>
                                                <input name="nEntendeConta" value="N" <?php echo set_radio('nEntendeConta', 'N', FALSE); ?> type="radio" class="with-gap" id="iEntendeContaNao" />
                                                <label for="iEntendeContaNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nEntendeConta" value="S"  <?php echo set_radio('nEntendeConta', 'S', FALSE); ?> type="radio" class="with-gap" id="iEntendeContaSim" />
                                                <label for="iEntendeContaSim">SIM</label>
                                                <input name="nEntendeConta" value="N" checked="true" <?php echo set_radio('nEntendeConta', 'N', FALSE); ?> type="radio" class="with-gap" id="iEntendeContaNao" />
                                                <label for="iEntendeContaNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nEntendeConta']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Tem começo, meio e fim? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->comecoMeioFim))
                                            {
                                                ?>
                                                <input name="nComecoMeioFim" value="S" <?php echo set_radio('nComecoMeioFim', 'S', FALSE); ?> type="radio" class="with-gap" id="iComecoMeioFimSim" />
                                                <label for="iComecoMeioFimSim">SIM</label>
                                                <input name="nComecoMeioFim" value="N" <?php echo set_radio('nComecoMeioFim', 'N', FALSE); ?> type="radio" class="with-gap" id="iComecoMeioFimNao" />
                                                <label for="iComecoMeioFimNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->comecoMeioFim == 'S')
                                            {
                                                ?>
                                                <input name="nComecoMeioFim" value="S" checked="true" <?php echo set_radio('nComecoMeioFim', 'S', FALSE); ?> type="radio" class="with-gap" id="iComecoMeioFimSim" />
                                                <label for="iComecoMeioFimSim">SIM</label>
                                                <input name="nComecoMeioFim" value="N" <?php echo set_radio('nComecoMeioFim', 'N', FALSE); ?> type="radio" class="with-gap" id="iComecoMeioFimNao" />
                                                <label for="iComecoMeioFimNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nComecoMeioFim" value="S"  <?php echo set_radio('nComecoMeioFim', 'S', FALSE); ?> type="radio" class="with-gap" id="iComecoMeioFimSim" />
                                                <label for="iComecoMeioFimSim">SIM</label>
                                                <input name="nComecoMeioFim" value="N" checked="true" <?php echo set_radio('nComecoMeioFim', 'N', FALSE); ?> type="radio" class="with-gap" id="iComecoMeioFimNao" />
                                                <label for="iComecoMeioFimNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nComecoMeioFim']??'';?></span>
                                </div>
                            </div>
                        </div>


                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                            <label style = "text-decoration: underline";>SONO:</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">                               
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
                                            if (empty($dadosUsuario->eAgitado))
                                            {
                                                ?>
                                                <input name="nSonoAgitado" value="S" <?php echo set_radio('nSonoAgitado', 'S', FALSE); ?> type="radio" class="with-gap" id="iSonoAgitadoSim" />
                                                <label for="iSonoAgitadoSim">SIM</label>
                                                <input name="nSonoAgitado" value="N" <?php echo set_radio('nSonoAgitado', 'N', FALSE); ?> type="radio" class="with-gap" id="iSonoAgitadoNao" />
                                                <label for="iSonoAgitadoNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->eAgitado == 'S')
                                            {
                                                ?>
                                                <input name="nSonoAgitado" value="S" checked="true" <?php echo set_radio('nSonoAgitado', 'S', FALSE); ?> type="radio" class="with-gap" id="iSonoAgitadoSim" />
                                                <label for="iSonoAgitadoSim">SIM</label>
                                                <input name="nSonoAgitado" value="N" <?php echo set_radio('nSonoAgitado', 'N', FALSE); ?> type="radio" class="with-gap" id="iSonoAgitadoNao" />
                                                <label for="iSonoAgitadoNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nSonoAgitado" value="S"  <?php echo set_radio('nSonoAgitado', 'S', FALSE); ?> type="radio" class="with-gap" id="iSonoAgitadoSim" />
                                                <label for="iSonoAgitadoSim">SIM</label>
                                                <input name="nSonoAgitado" value="N" checked="true" <?php echo set_radio('nSonoAgitado', 'N', FALSE); ?> type="radio" class="with-gap" id="iSonoAgitadoNao" />
                                                <label for="iSonoAgitadoNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nSonoAgitado']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>É sonâmbulo? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->eSonambulo))
                                            {
                                                ?>
                                                <input name="nSonambulo" value="S" <?php echo set_radio('nSonambulo', 'S', FALSE); ?> type="radio" class="with-gap" id="iSonambuloSim" />
                                                <label for="iSonambuloSim">SIM</label>
                                                <input name="nSonambulo" value="N" <?php echo set_radio('nSonambulo', 'N', FALSE); ?> type="radio" class="with-gap" id="iSonambuloNao" />
                                                <label for="iSonambuloNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->eSonambulo == 'S')
                                            {
                                                ?>
                                                <input name="nSonambulo" value="S" checked="true" <?php echo set_radio('nSonambulo', 'S', FALSE); ?> type="radio" class="with-gap" id="iSonambuloSim" />
                                                <label for="iSonambuloSim">SIM</label>
                                                <input name="nSonambulo" value="N" <?php echo set_radio('nSonambulo', 'N', FALSE); ?> type="radio" class="with-gap" id="iSonambuloNao" />
                                                <label for="iSonambuloNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nSonambulo" value="S"  <?php echo set_radio('nSonambulo', 'S', FALSE); ?> type="radio" class="with-gap" id="iSonambuloSim" />
                                                <label for="iSonambuloSim">SIM</label>
                                                <input name="nSonambulo" value="N" checked="true" <?php echo set_radio('nSonambulo', 'N', FALSE); ?> type="radio" class="with-gap" id="iSonambuloNao" />
                                                <label for="iSonambuloNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nSonambulo']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Tem pesadelos? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->temPesadelos))
                                            {
                                                ?>
                                                <input name="nTemPesadelos" value="S" <?php echo set_radio('nTemPesadelos', 'S', FALSE); ?> type="radio" class="with-gap" id="iTemPesadelosSim" />
                                                <label for="iTemPesadelosSim">SIM</label>
                                                <input name="nTemPesadelos" value="N" <?php echo set_radio('nTemPesadelos', 'N', FALSE); ?> type="radio" class="with-gap" id="iTemPesadelosNao" />
                                                <label for="iTemPesadelosNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->temPesadelos == 'S')
                                            {
                                                ?>
                                                <input name="nTemPesadelos" value="S" checked="true" <?php echo set_radio('nTemPesadelos', 'S', FALSE); ?> type="radio" class="with-gap" id="iTemPesadelosSim" />
                                                <label for="iTemPesadelosSim">SIM</label>
                                                <input name="nTemPesadelos" value="N" <?php echo set_radio('nTemPesadelos', 'N', FALSE); ?> type="radio" class="with-gap" id="iTemPesadelosNao" />
                                                <label for="iTemPesadelosNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nTemPesadelos" value="S"  <?php echo set_radio('nTemPesadelos', 'S', FALSE); ?> type="radio" class="with-gap" id="iTemPesadelosSim" />
                                                <label for="iTemPesadelosSim">SIM</label>
                                                <input name="nTemPesadelos" value="N" checked="true" <?php echo set_radio('nTemPesadelos', 'N', FALSE); ?> type="radio" class="with-gap" id="iTemPesadelosNao" />
                                                <label for="iTemPesadelosNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nTemPesadelos']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Dorme só ou acompanhada? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->dorme))
                                            {
                                                ?>
                                                <input name="nDorme" value="SÓ" <?php echo set_radio('nDorme', 'SÓ', FALSE); ?> type="radio" class="with-gap" id="iDormeSo" />
                                                <label for="iDormeSo">SÓ</label>
                                                <input name="nDorme" value="ACOMPANHADO" <?php echo set_radio('nDorme', 'ACOMPANHADO', FALSE); ?> type="radio" class="with-gap" id="iDormeAcomp" />
                                                <label for="iDormeAcomp">ACOMPANHADO</label>

                                                <?php
                                            } else if ($dadosUsuario->dorme == 'SÓ')
                                            {
                                                ?>
                                                <input name="nDorme" value="SÓ" checked="true" <?php echo set_radio('nDorme', 'SÓ', FALSE); ?> type="radio" class="with-gap" id="iDormeSo" />
                                                <label for="iDormeSo">SÓ</label>
                                                <input name="nDorme" value="ACOMPANHADO" <?php echo set_radio('nDorme', 'ACOMPANHADO', FALSE); ?> type="radio" class="with-gap" id="iDormeAcomp" />
                                                <label for="iDormeAcomp">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nDorme" value="SÓ"  <?php echo set_radio('nDorme', 'SÓ', FALSE); ?> type="radio" class="with-gap" id="iDormeSo" />
                                                <label for="iDormeSo">SÓ</label>
                                                <input name="nDorme" value="ACOMPANHADO" checked="true" <?php echo set_radio('nDorme', 'ACOMPANHADO', FALSE); ?> type="radio" class="with-gap" id="iDormeAcomp" />
                                                <label for="iDormeAcomp">ACOMPANHADO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nDorme']??'';?></span>
                                </div>
                            </div>
                        </div>

                        

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Com quantas pessoas? * </label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nQuantasPessoas" value="<?php echo set_value('nQuantasPessoas', $dadosUsuario->pessoasDorme); ?>" class="form-control numeroMaxDois">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nQuantasPessoas']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Quando acorda vai para cama dos pais? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->vaiParaCamaPais))
                                            {
                                                ?>
                                                <input name="nCamaPais" value="S" <?php echo set_radio('nCamaPais', 'S', FALSE); ?> type="radio" class="with-gap" id="iCamaPaisSim" />
                                                <label for="iCamaPaisSim">SIM</label>
                                                <input name="nCamaPais" value="N" <?php echo set_radio('nCamaPais', 'N', FALSE); ?> type="radio" class="with-gap" id="iCamaPaisNao" />
                                                <label for="iCamaPaisNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->vaiParaCamaPais == 'S')
                                            {
                                                ?>
                                                <input name="nCamaPais" value="S" checked="true" <?php echo set_radio('nCamaPais', 'S', FALSE); ?> type="radio" class="with-gap" id="iCamaPaisSim" />
                                                <label for="iCamaPaisSim">SIM</label>
                                                <input name="nCamaPais" value="N" <?php echo set_radio('nCamaPais', 'N', FALSE); ?> type="radio" class="with-gap" id="iCamaPaisNao" />
                                                <label for="iCamaPaisNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nCamaPais" value="S"  <?php echo set_radio('nCamaPais', 'S', FALSE); ?> type="radio" class="with-gap" id="iCamaPaisSim" />
                                                <label for="iCamaPaisSim">SIM</label>
                                                <input name="nCamaPais" value="N" checked="true" <?php echo set_radio('nCamaPais', 'N', FALSE); ?> type="radio" class="with-gap" id="iCamaPaisNao" />
                                                <label for="iCamaPaisNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nCamaPais']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Tem medo de dormir sozinho? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->medoDormir))
                                            {
                                                ?>
                                                <input name="nMedoDormir" value="S" <?php echo set_radio('nMedoDormir', 'S', FALSE); ?> type="radio" class="with-gap" id="iMedoDormirSim" />
                                                <label for="iMedoDormirSim">SIM</label>
                                                <input name="nMedoDormir" value="N" <?php echo set_radio('nMedoDormir', 'N', FALSE); ?> type="radio" class="with-gap" id="iMedoDormirNao" />
                                                <label for="iMedoDormirNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->medoDormir == 'S')
                                            {
                                                ?>
                                                <input name="nMedoDormir" value="S" checked="true" <?php echo set_radio('nMedoDormir', 'S', FALSE); ?> type="radio" class="with-gap" id="iMedoDormirSim" />
                                                <label for="iMedoDormirSim">SIM</label>
                                                <input name="nMedoDormir" value="N" <?php echo set_radio('nMedoDormir', 'N', FALSE); ?> type="radio" class="with-gap" id="iMedoDormirNao" />
                                                <label for="iMedoDormirNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nMedoDormir" value="S"  <?php echo set_radio('nMedoDormir', 'S', FALSE); ?> type="radio" class="with-gap" id="iMedoDormirSim" />
                                                <label for="iMedoDormirSim">SIM</label>
                                                <input name="nMedoDormir" value="N" checked="true" <?php echo set_radio('nMedoDormir', 'N', FALSE); ?> type="radio" class="with-gap" id="iMedoDormirNao" />
                                                <label for="iMedoDormirNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nMedoDormir']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Enurese noturna? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->enureseNoturna))
                                            {
                                                ?>
                                                <input name="nEnureseNoturna" value="S" <?php echo set_radio('nEnureseNoturna', 'S', FALSE); ?> type="radio" class="with-gap" id="iEnureseNoturnaSim" />
                                                <label for="iEnureseNoturnaSim">SIM</label>
                                                <input name="nEnureseNoturna" value="N" <?php echo set_radio('nEnureseNoturna', 'N', FALSE); ?> type="radio" class="with-gap" id="iEnureseNoturnaNao" />
                                                <label for="iEnureseNoturnaNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->enureseNoturna == 'S')
                                            {
                                                ?>
                                                <input name="nEnureseNoturna" value="S" checked="true" <?php echo set_radio('nEnureseNoturna', 'S', FALSE); ?> type="radio" class="with-gap" id="iEnureseNoturnaSim" />
                                                <label for="iEnureseNoturnaSim">SIM</label>
                                                <input name="nEnureseNoturna" value="N" <?php echo set_radio('nEnureseNoturna', 'N', FALSE); ?> type="radio" class="with-gap" id="iEnureseNoturnaNao" />
                                                <label for="iEnureseNoturnaNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nEnureseNoturna" value="S"  <?php echo set_radio('nEnureseNoturna', 'S', FALSE); ?> type="radio" class="with-gap" id="iEnureseNoturnaSim" />
                                                <label for="iEnureseNoturnaSim">SIM</label>
                                                <input name="nEnureseNoturna" value="N" checked="true" <?php echo set_radio('nEnureseNoturna', 'N', FALSE); ?> type="radio" class="with-gap" id="iEnureseNoturnaNao" />
                                                <label for="iEnureseNoturnaNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nEnureseNoturna']??'';?></span>
                                </div>
                            </div>
                        </div>
                      
                        <div class="row clearfix">
                            <div class="col-lg-offset-5 col-md-offset-5 col-sm-offset-6 col-xs-offset-6">
                                <button class="btn bg-teal waves-effect" type="submit"><span class="badge">S</span> ALVAR
                                    <i class="material-icons"> keyboard_tab </i> 05. ETAPA
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