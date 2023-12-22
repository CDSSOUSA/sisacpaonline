
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

                        echo form_open('usuario/escrever_anamnese_ep07', $atributos_formulario);
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
                                  echo anchor('usuario/form_escrever_anamnese06/' . encrypt($dadosUsuario->idUsuario), '<i class="material-icons"> keyboard_backspace </i> 06. ETAPA', array('class' => 'btn bg-indigo waves-effect')) . '  ';
                                ?>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">

                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label style = "text-decoration: underline";>HISTÓRIA ESCOLAR:<br> (considerar: entrada precoce ou tardia na escola, trocas...)</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">                               
                            </div>
                        </div>  

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Frequentou creches? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->creches))
                                            {
                                                ?>
                                                <input name="nCreche" value="S" <?php echo set_radio('nCreche', 'S', FALSE); ?> type="radio" class="with-gap" id="iCrecheSim" />
                                                <label for="iCrecheSim">SIM</label>
                                                <input name="nCreche" value="N" <?php echo set_radio('nCreche', 'N', FALSE); ?> type="radio" class="with-gap" id="iCrecheNao" />
                                                <label for="iCrecheNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->creches == 'S')
                                            {
                                                ?>
                                                <input name="nCreche" value="S" checked="true" <?php echo set_radio('nCreche', 'S', FALSE); ?> type="radio" class="with-gap" id="iCrecheSim" />
                                                <label for="iCrecheSim">SIM</label>
                                                <input name="nCreche" value="N" <?php echo set_radio('nCreche', 'N', FALSE); ?> type="radio" class="with-gap" id="iCrecheNao" />
                                                <label for="iCrecheNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nCreche" value="S"  <?php echo set_radio('nCreche', 'S', FALSE); ?> type="radio" class="with-gap" id="iCrecheSim" />
                                                <label for="iCrecheSim">SIM</label>
                                                <input name="nCreche" value="N" checked="true" <?php echo set_radio('nCreche', 'N', FALSE); ?> type="radio" class="with-gap" id="iCrecheNao" />
                                                <label for="iCrecheNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nCreche']??'';?></span>
                                </div>
                            </div>
                        </div>    

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Quando entrou para a escola(idade)? * </label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nIdadeEscola" value="<?php echo set_value('nIdadeEscola', $dadosUsuario->idadeEscola); ?>" class="form-control numeroMaxDois">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nIdadeEscola']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Por que? * </label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nPorqueEscola" value="<?php echo set_value('nPorqueEscola', $dadosUsuario->porqueEscola); ?>" class="form-control">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nPorqueEscola']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Quem escolheu a escola? * </label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nEscolheuEscola" value="<?php echo set_value('nEscolheuEscola', $dadosUsuario->quemEscolheuEscola); ?>" class="form-control">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nEscolheuEscola']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Como foi essa escolha? * </label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nComoFoiEscolha" value="<?php echo set_value('nComoFoiEscolha', $dadosUsuario->comoFoiEscolha); ?>" class="form-control">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nComoFoiEscolha']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Caso tenha havido mudança, por que mudou? * </label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nMudancaEscola" value="<?php echo set_value('nMudancaEscola', $dadosUsuario->mudancaEscola); ?>" class="form-control">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nMudancaEscola']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Repetiu de ano? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->repetiuAno))
                                            {
                                                ?>
                                                <input name="nRepetiuAno" value="S" <?php echo set_radio('nRepetiuAno', 'S', FALSE); ?> type="radio" class="with-gap" id="iRepetiuAnoSim" />
                                                <label for="iRepetiuAnoSim">SIM</label>
                                                <input name="nRepetiuAno" value="N" <?php echo set_radio('nRepetiuAno', 'N', FALSE); ?> type="radio" class="with-gap" id="iRepetiuAnoNao" />
                                                <label for="iRepetiuAnoNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->repetiuAno == 'S')
                                            {
                                                ?>
                                                <input name="nRepetiuAno" value="S" checked="true" <?php echo set_radio('nRepetiuAno', 'S', FALSE); ?> type="radio" class="with-gap" id="iRepetiuAnoSim" />
                                                <label for="iRepetiuAnoSim">SIM</label>
                                                <input name="nRepetiuAno" value="N" <?php echo set_radio('nRepetiuAno', 'N', FALSE); ?> type="radio" class="with-gap" id="iRepetiuAnoNao" />
                                                <label for="iRepetiuAnoNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nRepetiuAno" value="S"  <?php echo set_radio('nRepetiuAno', 'S', FALSE); ?> type="radio" class="with-gap" id="iRepetiuAnoSim" />
                                                <label for="iRepetiuAnoSim">SIM</label>
                                                <input name="nRepetiuAno" value="N" checked="true" <?php echo set_radio('nRepetiuAno', 'N', FALSE); ?> type="radio" class="with-gap" id="iRepetiuAnoNao" />
                                                <label for="iRepetiuAnoNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nRepetiuAno']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Por que? * </label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nPorqueRepetiu" value="<?php echo set_value('nPorqueRepetiu', $dadosUsuario->porqueRepetiu); ?>" class="form-control">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nPorqueRepetiu']??'';?></span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Houve problema com professor(es)? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->problemaProfessor))
                                            {
                                                ?>
                                                <input name="nProblemaProf" value="S" <?php echo set_radio('nProblemaProf', 'S', FALSE); ?> type="radio" class="with-gap" id="iProblemaProfSim" />
                                                <label for="iProblemaProfSim">SIM</label>
                                                <input name="nProblemaProf" value="N" <?php echo set_radio('nProblemaProf', 'N', FALSE); ?> type="radio" class="with-gap" id="iProblemaProfNao" />
                                                <label for="iProblemaProfNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->problemaProfessor == 'S')
                                            {
                                                ?>
                                                <input name="nProblemaProf" value="S" checked="true" <?php echo set_radio('nProblemaProf', 'S', FALSE); ?> type="radio" class="with-gap" id="iProblemaProfSim" />
                                                <label for="iProblemaProfSim">SIM</label>
                                                <input name="nProblemaProf" value="N" <?php echo set_radio('nProblemaProf', 'N', FALSE); ?> type="radio" class="with-gap" id="iProblemaProfNao" />
                                                <label for="iProblemaProfNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nProblemaProf" value="S"  <?php echo set_radio('nProblemaProf', 'S', FALSE); ?> type="radio" class="with-gap" id="iProblemaProfSim" />
                                                <label for="iProblemaProfSim">SIM</label>
                                                <input name="nProblemaProf" value="N" checked="true" <?php echo set_radio('nProblemaProf', 'N', FALSE); ?> type="radio" class="with-gap" id="iProblemaProfNao" />
                                                <label for="iProblemaProfNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nProblemaProf']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Qual(is) problema(s)? * </label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nQualProblema" value="<?php echo set_value('nQualProblema', $dadosUsuario->qualProblemaProf); ?>" class="form-control">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nQualProblema']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Como é a atitude em sala de aula? * </label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nAtitudeSala" value="<?php echo set_value('nAtitudeSala', $dadosUsuario->atitudeSala); ?>" class="form-control">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nAtitudeSala']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Falta muito à escola? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->faltaEscola))
                                            {
                                                ?>
                                                <input name="nFaltaEscola" value="S" <?php echo set_radio('nFaltaEscola', 'S', FALSE); ?> type="radio" class="with-gap" id="iFaltaEscolaSim" />
                                                <label for="iFaltaEscolaSim">SIM</label>
                                                <input name="nFaltaEscola" value="N" <?php echo set_radio('nFaltaEscola', 'N', FALSE); ?> type="radio" class="with-gap" id="iFaltaEscolaNao" />
                                                <label for="iFaltaEscolaNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->faltaEscola == 'S')
                                            {
                                                ?>
                                                <input name="nFaltaEscola" value="S" checked="true" <?php echo set_radio('nFaltaEscola', 'S', FALSE); ?> type="radio" class="with-gap" id="iFaltaEscolaSim" />
                                                <label for="iFaltaEscolaSim">SIM</label>
                                                <input name="nFaltaEscola" value="N" <?php echo set_radio('nFaltaEscola', 'N', FALSE); ?> type="radio" class="with-gap" id="iFaltaEscolaNao" />
                                                <label for="iFaltaEscolaNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nFaltaEscola" value="S"  <?php echo set_radio('nFaltaEscola', 'S', FALSE); ?> type="radio" class="with-gap" id="iFaltaEscolaSim" />
                                                <label for="iFaltaEscolaSim">SIM</label>
                                                <input name="nFaltaEscola" value="N" checked="true" <?php echo set_radio('nFaltaEscola', 'N', FALSE); ?> type="radio" class="with-gap" id="iFaltaEscolaNao" />
                                                <label for="iFaltaEscolaNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nFaltaEscola']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Por que? * </label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nProqueFaltaEscola" value="<?php echo set_value('nProqueFaltaEscola', $dadosUsuario->porqueFalta); ?>" class="form-control">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nProqueFaltaEscola']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Faz reforço? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->refoco))
                                            {
                                                ?>
                                                <input name="nReforco" value="S" <?php echo set_radio('nReforco', 'S', FALSE); ?> type="radio" class="with-gap" id="iReforcoSim" />
                                                <label for="iReforcoSim">SIM</label>
                                                <input name="nReforco" value="N" <?php echo set_radio('nReforco', 'N', FALSE); ?> type="radio" class="with-gap" id="iReforcoNao" />
                                                <label for="iReforcoNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->refoco == 'S')
                                            {
                                                ?>
                                                <input name="nReforco" value="S" checked="true" <?php echo set_radio('nReforco', 'S', FALSE); ?> type="radio" class="with-gap" id="iReforcoSim" />
                                                <label for="iReforcoSim">SIM</label>
                                                <input name="nReforco" value="N" <?php echo set_radio('nReforco', 'N', FALSE); ?> type="radio" class="with-gap" id="iReforcoNao" />
                                                <label for="iReforcoNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nReforco" value="S"  <?php echo set_radio('nReforco', 'S', FALSE); ?> type="radio" class="with-gap" id="iReforcoSim" />
                                                <label for="iReforcoSim">SIM</label>
                                                <input name="nReforco" value="N" checked="true" <?php echo set_radio('nReforco', 'N', FALSE); ?> type="radio" class="with-gap" id="iReforcoNao" />
                                                <label for="iReforcoNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nReforco']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Ele gosta do reforço? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->gostaRefoco))
                                            {
                                                ?>
                                                <input name="nGostaReforco" value="S" <?php echo set_radio('nGostaReforco', 'S', FALSE); ?> type="radio" class="with-gap" id="iGostaReforcoSim" />
                                                <label for="iGostaReforcoSim">SIM</label>
                                                <input name="nGostaReforco" value="N" <?php echo set_radio('nGostaReforco', 'N', FALSE); ?> type="radio" class="with-gap" id="iGostaReforcoNao" />
                                                <label for="iGostaReforcoNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->gostaRefoco == 'S')
                                            {
                                                ?>
                                                <input name="nGostaReforco" value="S" checked="true" <?php echo set_radio('nGostaReforco', 'S', FALSE); ?> type="radio" class="with-gap" id="iGostaReforcoSim" />
                                                <label for="iGostaReforcoSim">SIM</label>
                                                <input name="nGostaReforco" value="N" <?php echo set_radio('nGostaReforco', 'N', FALSE); ?> type="radio" class="with-gap" id="iGostaReforcoNao" />
                                                <label for="iGostaReforcoNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nGostaReforco" value="S"  <?php echo set_radio('nGostaReforco', 'S', FALSE); ?> type="radio" class="with-gap" id="iGostaReforcoSim" />
                                                <label for="iGostaReforcoSim">SIM</label>
                                                <input name="nGostaReforco" value="N" checked="true" <?php echo set_radio('nGostaReforco', 'N', FALSE); ?> type="radio" class="with-gap" id="iGostaReforcoNao" />
                                                <label for="iGostaReforcoNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nGostaReforco']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>O que você acha da escola? (há uma abertura, um diálogo? ou é tradicional?) * </label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nOpiniaoEscola" value="<?php echo set_value('nOpiniaoEscola', $dadosUsuario->opiniaoEscola); ?>" class="form-control">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nOpiniaoEscola']??'';?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label style = "text-decoration: underline";>FINALIZANDO</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">                               
                            </div>
                        </div>  
                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>O que você mais gosta no seu filho? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                    <textarea rows="4" name="nMaisGosta" class="form-control no-resize textareaLimite2" placeholder="Digite o texto ... Enter para mudar de linha."><?php echo set_value('nMaisGosta', $dadosUsuario->maisGosta); ?></textarea>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nMaisGosta']??'';?></span>
                                </div>
                            </div>
                        </div>            

                       <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Quais as maiores dificuldades com seu filho? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                    <textarea rows="4" name="nDificuldades" class="form-control no-resize textareaLimite2" placeholder="Digite o texto ... Enter para mudar de linha."><?php echo set_value('nDificuldades', $dadosUsuario->maioresDificuldades); ?></textarea>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nDificuldades']??'';?></span>
                                </div>
                            </div>
                        </div>

                       <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Orientações aos pais: </label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                    <textarea rows="4" name="nOrientacaoPais" class="form-control no-resize textareaLimite2" placeholder="Digite o texto ... Enter para mudar de linha."><?php echo set_value('nOrientacaoPais', $dadosUsuario->orientacaoPais); ?></textarea>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nOrientacaoPais']??'';?></span>
                                </div>
                            </div>
                        </div>

                       <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Observações do avaliador: </label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                    <textarea rows="4" name="nOrientacaoAvaliador" class="form-control no-resize textareaLimite2" placeholder="Digite o texto ... Enter para mudar de linha."><?php echo set_value('nOrientacaoAvaliador', $dadosUsuario->observacaoAvaliador); ?></textarea>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nOrientacaoAvaliador']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Conduta terapêutica : </label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                <div class="form-line">
                                    <textarea rows="4" name="nConduta" class="form-control no-resize textareaLimite2" placeholder="Digite o texto ... Enter para mudar de linha."><?php echo set_value('nConduta', $dadosUsuario->condutaTerapeutica); ?></textarea>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nConduta']??'';?></span>
                                   
                                </div>                                   
                            </div>
                        </div>                      
                      
                        <div class="row clearfix">
                            <div class="col-lg-offset-5 col-md-offset-5 col-sm-offset-6 col-xs-offset-6">
                                <button class="btn bg-teal waves-effect" type="submit"><span class="badge">F</span> INALIZAR </button>
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