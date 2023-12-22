
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

                        echo form_open('usuario/escrever_anamnese_ep06', $atributos_formulario);
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
                                  echo anchor('usuario/form_escrever_anamnese05/' . encrypt($dadosUsuario->idUsuario), '<i class="material-icons"> keyboard_backspace </i> 05. ETAPA', array('class' => 'btn bg-indigo waves-effect')) . '  ';
                                ?>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">

                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label style = "text-decoration: underline";>HISTÓRIA DA FAMÍLIA AMPLIADA:</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">                               
                            </div>
                        </div>      
                        
                        
                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Família: passado, presente, interferências, ligações, quadros patológicos: *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                    <textarea rows="4" name="nFamilia" class="form-control no-resize textareaLimite1" placeholder="Digite o texto ... Enter para mudar de linha."><?php echo set_value('nFamilia', $dadosUsuario->familia); ?></textarea>
                                  </div>
                                    <span style="color:red"><?= session()->get('errors')['nFamilia']??'';?></span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Forma de disciplina: *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                    <textarea rows="4" name="nDisciplina" class="form-control no-resize textareaLimite1" placeholder="Digite o texto ... Enter para mudar de linha."><?php echo set_value('nDisciplina', $dadosUsuario->disciplina); ?></textarea>
                                  </div>
                                    <span style="color:red"><?= session()->get('errors')['nDisciplina']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Atitude dos pais diante da falta de limite do filho(a): *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                    <textarea rows="4" name="nAtitudePais" class="form-control no-resize textareaLimite1" placeholder="Digite o texto ... Enter para mudar de linha."><?php echo set_value('nAtitudePais', $dadosUsuario->atitudePais); ?></textarea>
                                  </div>
                                    <span style="color:red"><?= session()->get('errors')['nAtitudePais']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Como a criança reage? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                    <textarea rows="4" name="nReacaoCrianca" class="form-control no-resize textareaLimite1" placeholder="Digite o texto ... Enter para mudar de linha."><?php echo set_value('nReacaoCrianca', $dadosUsuario->reacaoCrianca); ?></textarea>
                                  </div>
                                    <span style="color:red"><?= session()->get('errors')['nReacaoCrianca']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Tem alguém que a protege? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->alguemProtege))
                                            {
                                                ?>
                                                <input name="nAlguemProtege" value="S" <?php echo set_radio('nAlguemProtege', 'S', FALSE); ?> type="radio" class="with-gap" id="iAlguemProtegeSim" />
                                                <label for="iAlguemProtegeSim">SIM</label>
                                                <input name="nAlguemProtege" value="N" <?php echo set_radio('nAlguemProtege', 'N', FALSE); ?> type="radio" class="with-gap" id="iAlguemProtegeNao" />
                                                <label for="iAlguemProtegeNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->alguemProtege == 'S')
                                            {
                                                ?>
                                                <input name="nAlguemProtege" value="S" checked="true" <?php echo set_radio('nAlguemProtege', 'S', FALSE); ?> type="radio" class="with-gap" id="iAlguemProtegeSim" />
                                                <label for="iAlguemProtegeSim">SIM</label>
                                                <input name="nAlguemProtege" value="N" <?php echo set_radio('nAlguemProtege', 'N', FALSE); ?> type="radio" class="with-gap" id="iAlguemProtegeNao" />
                                                <label for="iAlguemProtegeNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nAlguemProtege" value="S"  <?php echo set_radio('nAlguemProtege', 'S', FALSE); ?> type="radio" class="with-gap" id="iAlguemProtegeSim" />
                                                <label for="iAlguemProtegeSim">SIM</label>
                                                <input name="nAlguemProtege" value="N" checked="true" <?php echo set_radio('nAlguemProtege', 'N', FALSE); ?> type="radio" class="with-gap" id="iAlguemProtegeNao" />
                                                <label for="iAlguemProtegeNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nAlguemProtege']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Quem a protege? </label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nQuemProtege" value="<?php echo set_value('nQuemProtege', $dadosUsuario->quemProtege); ?>" class="form-control">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nQuemProtege']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>É muito censurado? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->censurado))
                                            {
                                                ?>
                                                <input name="nCensurado" value="S" <?php echo set_radio('nCensurado', 'S', FALSE); ?> type="radio" class="with-gap" id="iCensuradoSim" />
                                                <label for="iCensuradoSim">SIM</label>
                                                <input name="nCensurado" value="N" <?php echo set_radio('nCensurado', 'N', FALSE); ?> type="radio" class="with-gap" id="iCensuradoNao" />
                                                <label for="iCensuradoNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->censurado == 'S')
                                            {
                                                ?>
                                                <input name="nCensurado" value="S" checked="true" <?php echo set_radio('nCensurado', 'S', FALSE); ?> type="radio" class="with-gap" id="iCensuradoSim" />
                                                <label for="iCensuradoSim">SIM</label>
                                                <input name="nCensurado" value="N" <?php echo set_radio('nCensurado', 'N', FALSE); ?> type="radio" class="with-gap" id="iCensuradoNao" />
                                                <label for="iCensuradoNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nCensurado" value="S"  <?php echo set_radio('nCensurado', 'S', FALSE); ?> type="radio" class="with-gap" id="iCensuradoSim" />
                                                <label for="iCensuradoSim">SIM</label>
                                                <input name="nCensurado" value="N" checked="true" <?php echo set_radio('nCensurado', 'N', FALSE); ?> type="radio" class="with-gap" id="iCensuradoNao" />
                                                <label for="iCensuradoNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nCensurado']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                            <label style = "text-decoration: underline";>Relaciona-se bem com:</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">                                
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Com o pai? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->relacaoPai))
                                            {
                                                ?>
                                                <input name="nRelacaoPai" value="S" <?php echo set_radio('nRelacaoPai', 'S', FALSE); ?> type="radio" class="with-gap" id="iRelacaoPaiSim" />
                                                <label for="iRelacaoPaiSim">SIM</label>
                                                <input name="nRelacaoPai" value="N" <?php echo set_radio('nRelacaoPai', 'N', FALSE); ?> type="radio" class="with-gap" id="nRelacaoPaiNao" />
                                                <label for="nRelacaoPaiNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->relacaoPai == 'S')
                                            {
                                                ?>
                                                <input name="nRelacaoPai" value="S" checked="true" <?php echo set_radio('nRelacaoPai', 'S', FALSE); ?> type="radio" class="with-gap" id="iRelacaoPaiSim" />
                                                <label for="iRelacaoPaiSim">SIM</label>
                                                <input name="nRelacaoPai" value="N" <?php echo set_radio('nRelacaoPai', 'N', FALSE); ?> type="radio" class="with-gap" id="nRelacaoPaiNao" />
                                                <label for="nRelacaoPaiNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nRelacaoPai" value="S"  <?php echo set_radio('nRelacaoPai', 'S', FALSE); ?> type="radio" class="with-gap" id="iRelacaoPaiSim" />
                                                <label for="iRelacaoPaiSim">SIM</label>
                                                <input name="nRelacaoPai" value="N" checked="true" <?php echo set_radio('nRelacaoPai', 'N', FALSE); ?> type="radio" class="with-gap" id="nRelacaoPaiNao" />
                                                <label for="nRelacaoPaiNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nRelacaoPai']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Com a mãe? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->relacaoMae))
                                            {
                                                ?>
                                                <input name="nRelacaoMae" value="S" <?php echo set_radio('nRelacaoMae', 'S', FALSE); ?> type="radio" class="with-gap" id="iRelacaoMaeSim" />
                                                <label for="iRelacaoMaeSim">SIM</label>
                                                <input name="nRelacaoMae" value="N" <?php echo set_radio('nRelacaoMae', 'N', FALSE); ?> type="radio" class="with-gap" id="nRelacaoMaeNao" />
                                                <label for="nRelacaoMaeNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->relacaoMae == 'S')
                                            {
                                                ?>
                                                <input name="nRelacaoMae" value="S" checked="true" <?php echo set_radio('nRelacaoMae', 'S', FALSE); ?> type="radio" class="with-gap" id="iRelacaoMaeSim" />
                                                <label for="iRelacaoMaeSim">SIM</label>
                                                <input name="nRelacaoMae" value="N" <?php echo set_radio('nRelacaoMae', 'N', FALSE); ?> type="radio" class="with-gap" id="nRelacaoMaeNao" />
                                                <label for="nRelacaoMaeNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nRelacaoMae" value="S"  <?php echo set_radio('nRelacaoMae', 'S', FALSE); ?> type="radio" class="with-gap" id="iRelacaoMaeSim" />
                                                <label for="iRelacaoMaeSim">SIM</label>
                                                <input name="nRelacaoMae" value="N" checked="true" <?php echo set_radio('nRelacaoMae', 'N', FALSE); ?> type="radio" class="with-gap" id="nRelacaoMaeNao" />
                                                <label for="nRelacaoMaeNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nRelacaoMae']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Com os irmãos? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->relacaoIrmao))
                                            {
                                                ?>
                                                <input name="nRelacaoIrmao" value="S" <?php echo set_radio('nRelacaoIrmao', 'S', FALSE); ?> type="radio" class="with-gap" id="iRelacaoIrmaoSim" />
                                                <label for="iRelacaoIrmaoSim">SIM</label>
                                                <input name="nRelacaoIrmao" value="N" <?php echo set_radio('nRelacaoIrmao', 'N', FALSE); ?> type="radio" class="with-gap" id="iRelacaoIrmaoNao" />
                                                <label for="iRelacaoIrmaoNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->relacaoIrmao == 'S')
                                            {
                                                ?>
                                                <input name="nRelacaoIrmao" value="S" checked="true" <?php echo set_radio('nRelacaoIrmao', 'S', FALSE); ?> type="radio" class="with-gap" id="iRelacaoIrmaoSim" />
                                                <label for="iRelacaoIrmaoSim">SIM</label>
                                                <input name="nRelacaoIrmao" value="N" <?php echo set_radio('nRelacaoIrmao', 'N', FALSE); ?> type="radio" class="with-gap" id="iRelacaoIrmaoNao" />
                                                <label for="iRelacaoIrmaoNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nRelacaoIrmao" value="S"  <?php echo set_radio('nRelacaoIrmao', 'S', FALSE); ?> type="radio" class="with-gap" id="iRelacaoIrmaoSim" />
                                                <label for="iRelacaoIrmaoSim">SIM</label>
                                                <input name="nRelacaoIrmao" value="N" checked="true" <?php echo set_radio('nRelacaoIrmao', 'N', FALSE); ?> type="radio" class="with-gap" id="iRelacaoIrmaoNao" />
                                                <label for="iRelacaoIrmaoNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nRelacaoIrmao']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Os pais sabem ler e escrever? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->paisLeem))
                                            {
                                                ?>
                                                <input name="nPaisLer" value="S" <?php echo set_radio('nPaisLer', 'S', FALSE); ?> type="radio" class="with-gap" id="iPaisLerSim" />
                                                <label for="iPaisLerSim">SIM</label>
                                                <input name="nPaisLer" value="N" <?php echo set_radio('nPaisLer', 'N', FALSE); ?> type="radio" class="with-gap" id="iPaisLerNao" />
                                                <label for="iPaisLerNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->paisLeem == 'S')
                                            {
                                                ?>
                                                <input name="nPaisLer" value="S" checked="true" <?php echo set_radio('nPaisLer', 'S', FALSE); ?> type="radio" class="with-gap" id="iPaisLerSim" />
                                                <label for="iPaisLerSim">SIM</label>
                                                <input name="nPaisLer" value="N" <?php echo set_radio('nPaisLer', 'N', FALSE); ?> type="radio" class="with-gap" id="iPaisLerNao" />
                                                <label for="iPaisLerNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nPaisLer" value="S"  <?php echo set_radio('nPaisLer', 'S', FALSE); ?> type="radio" class="with-gap" id="iPaisLerSim" />
                                                <label for="iPaisLerSim">SIM</label>
                                                <input name="nPaisLer" value="N" checked="true" <?php echo set_radio('nPaisLer', 'N', FALSE); ?> type="radio" class="with-gap" id="iPaisLerNao" />
                                                <label for="iPaisLerNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nPaisLer']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Quem auxiliar na lição de casa? * </label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nAuxiliaLicao" value="<?php echo set_value('nAuxiliaLicao', $dadosUsuario->auxiliaLicao); ?>" class="form-control">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nAuxiliaLicao']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Problema que a família está passando no momento? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                    <textarea rows="4" name="nProblemaFamilia" class="form-control no-resize textareaLimite1" placeholder="Digite o texto ... Enter para mudar de linha."><?php echo set_value('nProblemaFamilia', $dadosUsuario->problemaFamilia); ?></textarea>
                                  </div>
                                    <span style="color:red"><?= session()->get('errors')['nProblemaFamilia']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Como é o ambiente de brincadeira no dia a dia? Quais brincadeiras? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                    <textarea rows="4" name="nBrincadeiras" class="form-control no-resize textareaLimite1" placeholder="Digite o texto ... Enter para mudar de linha."><?php echo set_value('nBrincadeiras', $dadosUsuario->brincadeiras); ?></textarea>
                                  </div>
                                    <span style="color:red"><?= session()->get('errors')['nBrincadeiras']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Qual prefere? * </label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nPrefereBrincadeira" value="<?php echo set_value('nPrefereBrincadeira', $dadosUsuario->prefereBrincadeira); ?>" class="form-control">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nPrefereBrincadeira']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Como se relaciona com os colegas? * </label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nRelacaoColega" value="<?php echo set_value('nRelacaoColega', $dadosUsuario->relacaoColega); ?>" class="form-control">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nRelacaoColega']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>É lider? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->lider))
                                            {
                                                ?>
                                                <input name="nLider" value="S" <?php echo set_radio('nLider', 'S', FALSE); ?> type="radio" class="with-gap" id="iLiderSim" />
                                                <label for="iLiderSim">SIM</label>
                                                <input name="nLider" value="N" <?php echo set_radio('nLider', 'N', FALSE); ?> type="radio" class="with-gap" id="iLiderNao" />
                                                <label for="iLiderNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->lider == 'S')
                                            {
                                                ?>
                                                <input name="nLider" value="S" checked="true" <?php echo set_radio('nLider', 'S', FALSE); ?> type="radio" class="with-gap" id="iLiderSim" />
                                                <label for="iLiderSim">SIM</label>
                                                <input name="nLider" value="N" <?php echo set_radio('nLider', 'N', FALSE); ?> type="radio" class="with-gap" id="iLiderNao" />
                                                <label for="iLiderNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nLider" value="S"  <?php echo set_radio('nLider', 'S', FALSE); ?> type="radio" class="with-gap" id="iLiderSim" />
                                                <label for="iLiderSim">SIM</label>
                                                <input name="nLider" value="N" checked="true" <?php echo set_radio('nLider', 'N', FALSE); ?> type="radio" class="with-gap" id="iLiderNao" />
                                                <label for="iLiderNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nLider']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Chora nas brincadeiras? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->choraBrincadeiras))
                                            {
                                                ?>
                                                <input name="nChoraBrincadeiras" value="S" <?php echo set_radio('nChoraBrincadeiras', 'S', FALSE); ?> type="radio" class="with-gap" id="iChoraBrincadeirasSim" />
                                                <label for="iChoraBrincadeirasSim">SIM</label>
                                                <input name="nChoraBrincadeiras" value="N" <?php echo set_radio('nChoraBrincadeiras', 'N', FALSE); ?> type="radio" class="with-gap" id="iChoraBrincadeirasNao" />
                                                <label for="iChoraBrincadeirasNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->choraBrincadeiras == 'S')
                                            {
                                                ?>
                                                <input name="nChoraBrincadeiras" value="S" checked="true" <?php echo set_radio('nChoraBrincadeiras', 'S', FALSE); ?> type="radio" class="with-gap" id="iChoraBrincadeirasSim" />
                                                <label for="iChoraBrincadeirasSim">SIM</label>
                                                <input name="nChoraBrincadeiras" value="N" <?php echo set_radio('nChoraBrincadeiras', 'N', FALSE); ?> type="radio" class="with-gap" id="iChoraBrincadeirasNao" />
                                                <label for="iChoraBrincadeirasNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nChoraBrincadeiras" value="S"  <?php echo set_radio('nChoraBrincadeiras', 'S', FALSE); ?> type="radio" class="with-gap" id="iChoraBrincadeirasSim" />
                                                <label for="iChoraBrincadeirasSim">SIM</label>
                                                <input name="nChoraBrincadeiras" value="N" checked="true" <?php echo set_radio('nChoraBrincadeiras', 'N', FALSE); ?> type="radio" class="with-gap" id="iChoraBrincadeirasNao" />
                                                <label for="iChoraBrincadeirasNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nChoraBrincadeiras']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Qual o programa preferido de TV? </label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nProgramaTv" value="<?php echo set_value('nProgramaTv', $dadosUsuario->programaTv); ?>" class="form-control">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nProgramaTv']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Assunto ou lazer que interessa a criança: </label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                    <textarea rows="4" name="nAssunto" class="form-control no-resize textareaLimite1" placeholder="Digite o texto ... Enter para mudar de linha."><?php echo set_value('nAssunto', $dadosUsuario->assuntoLazer); ?></textarea>
                                  </div>
                                    <span style="color:red"><?= session()->get('errors')['nAssunto']??'';?></span>
                                </div>
                            </div>
                        </div>
                      
                        <div class="row clearfix">
                            <div class="col-lg-offset-5 col-md-offset-5 col-sm-offset-6 col-xs-offset-6">
                                <button class="btn bg-teal waves-effect" type="submit"><span class="badge">S</span> ALVAR
                                    <i class="material-icons"> keyboard_tab </i> 07. ETAPA
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