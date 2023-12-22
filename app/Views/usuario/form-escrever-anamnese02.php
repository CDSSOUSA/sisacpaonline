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

                        echo form_open('usuario/escrever_anamnese_ep02', $atributos_formulario);
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
                                  echo anchor('usuario/form_escrever_anamnese/' . encrypt($dadosUsuario->idUsuario), '<i class="material-icons"> keyboard_backspace </i> 01. ETAPA', array('class' => 'btn bg-indigo waves-effect')) . '  ';
                                ?>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">

                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                            <label style = "text-decoration: underline";>HISTÓRIA DE VIDA (CONCEPÇÃO:)</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">                              
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Filho(a) desejado(a) *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->filhoDesejado))
                                            {
                                                ?>
                                                <input name="nFilhoDesejado" value="S" <?php echo set_radio('nFilhoDesejado', 'S', FALSE); ?> type="radio" class="with-gap" id="iFilhoDesejadoSim" />
                                                <label for="iFilhoDesejadoSim">SIM</label>
                                                <input name="nFilhoDesejado" value="N" <?php echo set_radio('nFilhoDesejado', 'N', FALSE); ?> type="radio" class="with-gap" id="iFilhoDesejadoNao" />
                                                <label for="iFilhoDesejadoNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->filhoDesejado == 'S')
                                            {
                                                ?>
                                                <input name="nFilhoDesejado" value="S" checked="true" <?php echo set_radio('nFilhoDesejado', 'S', FALSE); ?> type="radio" class="with-gap" id="iFilhoDesejadoSim" />
                                                <label for="iFilhoDesejadoSim">SIM</label>
                                                <input name="nFilhoDesejado" value="N" <?php echo set_radio('nFilhoDesejado', 'N', FALSE); ?> type="radio" class="with-gap" id="iFilhoDesejadoNao" />
                                                <label for="iFilhoDesejadoNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nFilhoDesejado" value="S"  <?php echo set_radio('nFilhoDesejado', 'S', FALSE); ?> type="radio" class="with-gap" id="iFilhoDesejadoSim" />
                                                <label for="iFilhoDesejadoSim">SIM</label>
                                                <input name="nFilhoDesejado" value="N" checked="true" <?php echo set_radio('nFilhoDesejado', 'N', FALSE); ?> type="radio" class="with-gap" id="iFilhoDesejadoNao" />
                                                <label for="iFilhoDesejadoNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nFilhoDesejado']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Você queria engravidar? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->queriaEngravidar))
                                            {
                                                ?>
                                                <input name="nQueriaEngravidar" value="S" <?php echo set_radio('nQueriaEngravidar', 'S', FALSE); ?> type="radio" class="with-gap" id="iQueriaEngravidarSim" />
                                                <label for="iQueriaEngravidarSim">SIM</label>
                                                <input name="nQueriaEngravidar" value="N" <?php echo set_radio('nQueriaEngravidar', 'N', FALSE); ?> type="radio" class="with-gap" id="iQueriaEngravidarNao" />
                                                <label for="iQueriaEngravidarNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->queriaEngravidar == 'S')
                                            {
                                                ?>
                                                <input name="nQueriaEngravidar" value="S" checked="true" <?php echo set_radio('nQueriaEngravidar', 'S', FALSE); ?> type="radio" class="with-gap" id="iQueriaEngravidarSim" />
                                                <label for="iQueriaEngravidarSim">SIM</label>
                                                <input name="nQueriaEngravidar" value="N" <?php echo set_radio('nQueriaEngravidar', 'N', FALSE); ?> type="radio" class="with-gap" id="iQueriaEngravidarNao" />
                                                <label for="iQueriaEngravidarNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nQueriaEngravidar" value="S"  <?php echo set_radio('nQueriaEngravidar', 'S', FALSE); ?> type="radio" class="with-gap" id="iQueriaEngravidarSim" />
                                                <label for="iQueriaEngravidarSim">SIM</label>
                                                <input name="nQueriaEngravidar" value="N" checked="true" <?php echo set_radio('nQueriaEngravidar', 'N', FALSE); ?> type="radio" class="with-gap" id="iQueriaEngravidarNao" />
                                                <label for="iQueriaEngravidarNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nQueriaEngravidar']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Foi acidental? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->foiAcidental))
                                            {
                                                ?>
                                                <input name="nFoiAcidental" value="S" <?php echo set_radio('nFoiAcidental', 'S', FALSE); ?> type="radio" class="with-gap" id="iFoiAcidentalSim" />
                                                <label for="iFoiAcidentalSim">SIM</label>
                                                <input name="nFoiAcidental" value="N" <?php echo set_radio('nFoiAcidental', 'N', FALSE); ?> type="radio" class="with-gap" id="iFoiAcidentalNao" />
                                                <label for="iFoiAcidentalNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->foiAcidental == 'S')
                                            {
                                                ?>
                                                <input name="nFoiAcidental" value="S" checked="true" <?php echo set_radio('nFoiAcidental', 'S', FALSE); ?> type="radio" class="with-gap" id="iFoiAcidentalSim" />
                                                <label for="iFoiAcidentalSim">SIM</label>
                                                <input name="nFoiAcidental" value="N" <?php echo set_radio('nFoiAcidental', 'N', FALSE); ?> type="radio" class="with-gap" id="iFoiAcidentalNao" />
                                                <label for="iFoiAcidentalNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nFoiAcidental" value="S"  <?php echo set_radio('nFoiAcidental', 'S', FALSE); ?> type="radio" class="with-gap" id="iFoiAcidentalSim" />
                                                <label for="iFoiAcidentalSim">SIM</label>
                                                <input name="nFoiAcidental" value="N" checked="true" <?php echo set_radio('nFoiAcidental', 'N', FALSE); ?> type="radio" class="with-gap" id="iFoiAcidentalNao" />
                                                <label for="iFoiAcidentalNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nFoiAcidental']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Pertubou a vida do casal ou de um dos pais? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->pertubouCasal))
                                            {
                                                ?>
                                                <input name="nPertubouCasal" value="S" <?php echo set_radio('nPertubouCasal', 'S', FALSE); ?> type="radio" class="with-gap" id="iPertubouCasalSim" />
                                                <label for="iPertubouCasalSim">SIM</label>
                                                <input name="nPertubouCasal" value="N" <?php echo set_radio('nPertubouCasal', 'N', FALSE); ?> type="radio" class="with-gap" id="iPertubouCasalNao" />
                                                <label for="iPertubouCasalNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->pertubouCasal == 'S')
                                            {
                                                ?>
                                                <input name="nPertubouCasal" value="S" checked="true" <?php echo set_radio('nPertubouCasal', 'S', FALSE); ?> type="radio" class="with-gap" id="iPertubouCasalSim" />
                                                <label for="iPertubouCasalSim">SIM</label>
                                                <input name="nPertubouCasal" value="N" <?php echo set_radio('nPertubouCasal', 'N', FALSE); ?> type="radio" class="with-gap" id="iPertubouCasalNao" />
                                                <label for="iPertubouCasalNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nPertubouCasal" value="S"  <?php echo set_radio('nPertubouCasal', 'S', FALSE); ?> type="radio" class="with-gap" id="iPertubouCasalSim" />
                                                <label for="iPertubouCasalSim">SIM</label>
                                                <input name="nPertubouCasal" value="N" checked="true" <?php echo set_radio('nPertubouCasal', 'N', FALSE); ?> type="radio" class="with-gap" id="iPertubouCasalNao" />
                                                <label for="iPertubouCasalNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nPertubouCasal']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Como foi a gestação? (cuidados pré-natais, doenças, sintomas, alimentação) *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                    <textarea rows="4" name="nGestacao" class="form-control no-resize textareaLimite1" placeholder="Digite o texto ... Enter para mudar de linha."><?php echo set_value('nGestacao', $dadosUsuario->comoFoiGestacao); ?></textarea>
                                  </div>
                                    <span style="color:red"><?= session()->get('errors')['nGestacao']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Como foi o parto? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                    <textarea rows="4" name="nParto" class="form-control no-resize textareaLimite1" placeholder="Digite o texto ... Enter para mudar de linha."><?php echo set_value('nParto', $dadosUsuario->comoFoiParto); ?></textarea>
                                  </div>
                                    <span style="color:red"><?= session()->get('errors')['nParto']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                            <label style = "text-decoration: underline";>AMAMENTAÇÃO:</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                (defasagens, acidentes de percurso, assimilação/acomodação, carga efetiva)
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Mamou no peito? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->mamouPeito))
                                            {
                                                ?>
                                                <input name="nMamouPeito" value="S" <?php echo set_radio('nMamouPeito', 'S', FALSE); ?> type="radio" class="with-gap" id="iMamouPeitoSim" />
                                                <label for="iMamouPeitoSim">SIM</label>
                                                <input name="nMamouPeito" value="N" <?php echo set_radio('nMamouPeito', 'N', FALSE); ?> type="radio" class="with-gap" id="iMamouPeitoNao" />
                                                <label for="iMamouPeitoNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->mamouPeito == 'S')
                                            {
                                                ?>
                                                <input name="nMamouPeito" value="S" checked="true" <?php echo set_radio('nMamouPeito', 'S', FALSE); ?> type="radio" class="with-gap" id="iMamouPeitoSim" />
                                                <label for="iMamouPeitoSim">SIM</label>
                                                <input name="nMamouPeito" value="N" <?php echo set_radio('nMamouPeito', 'N', FALSE); ?> type="radio" class="with-gap" id="iMamouPeitoNao" />
                                                <label for="iMamouPeitoNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nMamouPeito" value="S"  <?php echo set_radio('nMamouPeito', 'S', FALSE); ?> type="radio" class="with-gap" id="iMamouPeitoSim" />
                                                <label for="iMamouPeitoSim">SIM</label>
                                                <input name="nMamouPeito" value="N" checked="true" <?php echo set_radio('nMamouPeito', 'N', FALSE); ?> type="radio" class="with-gap" id="iMamouPeitoNao" />
                                                <label for="iMamouPeitoNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nMamouPeito']??'';?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Mamou até que idade? * </label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nIdadeMamou" value="<?php echo set_value('nIdadeMamou', $dadosUsuario->mamouIdade); ?>" class="form-control numeroMaxDois">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nIdadeMamou']??'';?></span>
                                </div>
                            </div>
                        </div>
                        

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Como foi a passagem do peito para a mamadeira? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea rows="4" name="nPassagemMamadeira" class="form-control no-resize textareaLimite1" placeholder="Digite o texto ... Enter para mudar de linha."><?php echo set_value('nPassagemMamadeira', $dadosUsuario->passagemMamadeira); ?></textarea>
                                     </div>
                                    <span style="color:red"><?= session()->get('errors')['nPassagemMamadeira']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>E para a papinha? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea rows="4" name="nPassagemPapinha" class="form-control no-resize textareaLimite1" placeholder="Digite o texto ... Enter para mudar de linha."><?php echo set_value('nPassagemPapinha', $dadosUsuario->passagemPapinha); ?></textarea>
                                     </div>
                                    <span style="color:red"><?= session()->get('errors')['nPassagemPapinha']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Hoje tem hora para comer? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->horaComer))
                                            {
                                                ?>
                                                <input name="nHoraComer" value="S" <?php echo set_radio('nHoraComer', 'S', FALSE); ?> type="radio" class="with-gap" id="inHoraComerSim" />
                                                <label for="inHoraComerSim">SIM</label>
                                                <input name="nHoraComer" value="N" <?php echo set_radio('nHoraComer', 'N', FALSE); ?> type="radio" class="with-gap" id="inHoraComerNao" />
                                                <label for="inHoraComerNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->horaComer == 'S')
                                            {
                                                ?>
                                                <input name="nHoraComer" value="S" checked="true" <?php echo set_radio('nHoraComer', 'S', FALSE); ?> type="radio" class="with-gap" id="inHoraComerSim" />
                                                <label for="inHoraComerSim">SIM</label>
                                                <input name="nHoraComer" value="N" <?php echo set_radio('nHoraComer', 'N', FALSE); ?> type="radio" class="with-gap" id="inHoraComerNao" />
                                                <label for="inHoraComerNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nHoraComer" value="S"  <?php echo set_radio('nHoraComer', 'S', FALSE); ?> type="radio" class="with-gap" id="inHoraComerSim" />
                                                <label for="inHoraComerSim">SIM</label>
                                                <input name="nHoraComer" value="N" checked="true" <?php echo set_radio('nHoraComer', 'N', FALSE); ?> type="radio" class="with-gap" id="inHoraComerNao" />
                                                <label for="inHoraComerNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nHoraComer']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Come depressa? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->comeDepressa))
                                            {
                                                ?>
                                                <input name="nComeDepressa" value="S" <?php echo set_radio('nComeDepressa', 'S', FALSE); ?> type="radio" class="with-gap" id="iComeDepressaSim" />
                                                <label for="iComeDepressaSim">SIM</label>
                                                <input name="nComeDepressa" value="N" <?php echo set_radio('nComeDepressa', 'N', FALSE); ?> type="radio" class="with-gap" id="iComeDepressaNao" />
                                                <label for="iComeDepressaNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->comeDepressa == 'S')
                                            {
                                                ?>
                                                <input name="nComeDepressa" value="S" checked="true" <?php echo set_radio('nComeDepressa', 'S', FALSE); ?> type="radio" class="with-gap" id="iComeDepressaSim" />
                                                <label for="iComeDepressaSim">SIM</label>
                                                <input name="nComeDepressa" value="N" <?php echo set_radio('nComeDepressa', 'N', FALSE); ?> type="radio" class="with-gap" id="iComeDepressaNao" />
                                                <label for="iComeDepressaNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nComeDepressa" value="S"  <?php echo set_radio('nComeDepressa', 'S', FALSE); ?> type="radio" class="with-gap" id="iComeDepressaSim" />
                                                <label for="iComeDepressaSim">SIM</label>
                                                <input name="nComeDepressa" value="N" checked="true" <?php echo set_radio('nComeDepressa', 'N', FALSE); ?> type="radio" class="with-gap" id="iComeDepressaNao" />
                                                <label for="iComeDepressaNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nComeDepressa']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Mastiga bem? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->mastigaBem))
                                            {
                                                ?>
                                                <input name="nMastigaBem" value="S" <?php echo set_radio('nMastigaBem', 'S', FALSE); ?> type="radio" class="with-gap" id="iMastigaBemSim" />
                                                <label for="iMastigaBemSim">SIM</label>
                                                <input name="nMastigaBem" value="N" <?php echo set_radio('nMastigaBem', 'N', FALSE); ?> type="radio" class="with-gap" id="iMastigaBemNao" />
                                                <label for="iMastigaBemNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->mastigaBem == 'S')
                                            {
                                                ?>
                                                <input name="nMastigaBem" value="S" checked="true" <?php echo set_radio('nMastigaBem', 'S', FALSE); ?> type="radio" class="with-gap" id="iMastigaBemSim" />
                                                <label for="iMastigaBemSim">SIM</label>
                                                <input name="nMastigaBem" value="N" <?php echo set_radio('nMastigaBem', 'N', FALSE); ?> type="radio" class="with-gap" id="iMastigaBemNao" />
                                                <label for="iMastigaBemNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nMastigaBem" value="S"  <?php echo set_radio('nMastigaBem', 'S', FALSE); ?> type="radio" class="with-gap" id="iMastigaBemSim" />
                                                <label for="iMastigaBemSim">SIM</label>
                                                <input name="nMastigaBem" value="N" checked="true" <?php echo set_radio('nMastigaBem', 'N', FALSE); ?> type="radio" class="with-gap" id="iMastigaBemNao" />
                                                <label for="iMastigaBemNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nMastigaBem']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Comem juntos? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->comemJuntos))
                                            {
                                                ?>
                                                <input name="nComemJuntos" value="S" <?php echo set_radio('nComemJuntos', 'S', FALSE); ?> type="radio" class="with-gap" id="iComemJuntosSim" />
                                                <label for="iComemJuntosSim">SIM</label>
                                                <input name="nComemJuntos" value="N" <?php echo set_radio('nComemJuntos', 'N', FALSE); ?> type="radio" class="with-gap" id="iComemJuntosNao" />
                                                <label for="iComemJuntosNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->comemJuntos == 'S')
                                            {
                                                ?>
                                                <input name="nComemJuntos" value="S" checked="true" <?php echo set_radio('nComemJuntos', 'S', FALSE); ?> type="radio" class="with-gap" id="iComemJuntosSim" />
                                                <label for="iComemJuntosSim">SIM</label>
                                                <input name="nComemJuntos" value="N" <?php echo set_radio('nComemJuntos', 'N', FALSE); ?> type="radio" class="with-gap" id="iComemJuntosNao" />
                                                <label for="iComemJuntosNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nComemJuntos" value="S"  <?php echo set_radio('nComemJuntos', 'S', FALSE); ?> type="radio" class="with-gap" id="iComemJuntosSim" />
                                                <label for="iComemJuntosSim">SIM</label>
                                                <input name="nComemJuntos" value="N" checked="true" <?php echo set_radio('nComemJuntos', 'N', FALSE); ?> type="radio" class="with-gap" id="iComemJuntosNao" />
                                                <label for="iComemJuntosNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nComemJuntos']??'';?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Come vendo TV? *</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-radio-button radio-inline">
                                            <?php
                                            if (empty($dadosUsuario->comemVendoTv))
                                            {
                                                ?>
                                                <input name="nComeTv" value="S" <?php echo set_radio('nComeTv', 'S', FALSE); ?> type="radio" class="with-gap" id="iComeTvSim" />
                                                <label for="iComeTvSim">SIM</label>
                                                <input name="nComeTv" value="N" <?php echo set_radio('nComeTv', 'N', FALSE); ?> type="radio" class="with-gap" id="iComeTvNao" />
                                                <label for="iComeTvNao">NÃO</label>

                                                <?php
                                            } else if ($dadosUsuario->comemVendoTv == 'S')
                                            {
                                                ?>
                                                <input name="nComeTv" value="S" checked="true" <?php echo set_radio('nComeTv', 'S', FALSE); ?> type="radio" class="with-gap" id="iComeTvSim" />
                                                <label for="iComeTvSim">SIM</label>
                                                <input name="nComeTv" value="N" <?php echo set_radio('nComeTv', 'N', FALSE); ?> type="radio" class="with-gap" id="iComeTvNao" />
                                                <label for="iComeTvNao">NÃO</label>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input name="nComeTv" value="S"  <?php echo set_radio('nComeTv', 'S', FALSE); ?> type="radio" class="with-gap" id="iComeTvSim" />
                                                <label for="iComeTvSim">SIM</label>
                                                <input name="nComeTv" value="N" checked="true" <?php echo set_radio('nComeTv', 'N', FALSE); ?> type="radio" class="with-gap" id="iComeTvNao" />
                                                <label for="iComeTvNao">NÃO</label>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nComeTv']??'';?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label style = "text-decoration: underline";>ELIMINAÇÃO:</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">                              
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Com que idade parou de usar fraldas? * </label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nIdadeFraldas" value="<?php echo set_value('nIdadeFraldas', $dadosUsuario->idadeParouFraldas); ?>" class="form-control numeroMaxDois">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nIdadeFraldas']??'';?></span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Como foi a passagem para o troninho(segurava, molhava a roupa? brincava e saia correndo era repreendido? chorava?) * </label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea rows="4" name="nPassagemTroninho" class="form-control no-resize textareaLimite1" placeholder="Digite o texto ... Enter para mudar de linha."><?php echo set_value('nPassagemTroninho', $dadosUsuario->passagemTroninho); ?></textarea>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nPassagemTroninho']??'';?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 form-control-label">
                                <label>Como era as fezes? </label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                                <div class="form-group">
                                <div class="form-line">
                                    <div class="demo-checkbox">
                                                <!-- LIQUIDA-->
                                                <?php if(empty($dadosUsuario->fezesLiquida)){ ?>
                                                        <input type="checkbox" id="iLiquida" class="checkbox-inline" name="nLiquida" value="S"
                                                        <?php echo set_checkbox('nLiquida', 'S', FALSE); ?> /> <label
                                                        for="iLiquida"> LÍQUIDA </label><br>
                                            <?php } else if($dadosUsuario->fezesLiquida == 'S') { ?>
                                                        <input type="checkbox" id="iLiquida" class="checkbox-inline" checked="true" name="nLiquida" value="S"
                                                            <?php echo set_checkbox('nLiquida', 'S', FALSE); ?> /> <label
                                                            for="iLiquida"> LÍQUIDA </label><br>

                                            <?php } else { ?>
                                                <input type="checkbox" id="iLiquida" class="checkbox-inline" name="nLiquida" value="N"
                                                            <?php echo set_checkbox('nLiquida', 'N', FALSE); ?> /> <label
                                                            for="iLiquida"> LÍQUIDA </label><br>
                                                
                                                <?php
                                                }?>

                                                <!-- PASTOSA-->
                                                <?php if(empty($dadosUsuario->fezesPastosa)){ ?>
                                                        <input type="checkbox" id="iPastosa" class="checkbox-inline" name="nPastosa" value="S"
                                                        <?php echo set_checkbox('nPastosa', 'S', FALSE); ?> /> <label
                                                        for="iPastosa"> PASTOSA </label><br>
                                            <?php } else if($dadosUsuario->fezesPastosa == 'S') { ?>
                                                        <input type="checkbox" id="iPastosa" class="checkbox-inline" checked="true" name="nPastosa" value="S"
                                                            <?php echo set_checkbox('nPastosa', 'S', FALSE); ?> /> <label
                                                            for="iPastosa"> PASTOSA </label><br>

                                            <?php } else { ?>
                                                <input type="checkbox" id="iPastosa" class="checkbox-inline" name="nPastosa" value="N"
                                                            <?php echo set_checkbox('nPastosa', 'N', FALSE); ?> /> <label
                                                            for="iPastosa"> PASTOSA </label><br>
                                                
                                                <?php
                                                }?>

                                                <!-- RESSECADA-->
                                                <?php if(empty($dadosUsuario->fezesRessecada)){ ?>
                                                        <input type="checkbox" id="iRessecada" class="checkbox-inline" name="nRessecada" value="S"
                                                        <?php echo set_checkbox('nRessecada', 'S', FALSE); ?> /> <label
                                                        for="iRessecada"> RESSECADA </label><br>
                                            <?php } else if($dadosUsuario->fezesRessecada == 'S') { ?>
                                                        <input type="checkbox" id="iRessecada" class="checkbox-inline" checked="true" name="nRessecada" value="S"
                                                            <?php echo set_checkbox('nRessecada', 'S', FALSE); ?> /> <label
                                                            for="iRessecada"> RESSECADA </label><br>

                                            <?php } else { ?>
                                                <input type="checkbox" id="iRessecada" class="checkbox-inline" name="nRessecada" value="N"
                                                            <?php echo set_checkbox('nRessecada', 'N', FALSE); ?> /> <label
                                                            for="iRessecada"> RESSECADA </label><br>
                                                
                                                <?php
                                                }?>

                                                <!-- NORMAL-->
                                                <?php if(empty($dadosUsuario->fezesNormal)){ ?>
                                                        <input type="checkbox" id="iNormal" class="checkbox-inline" name="nNormal" value="S"
                                                        <?php echo set_checkbox('nNormal', 'S', FALSE); ?> /> <label
                                                        for="iNormal"> NORMAL </label><br>
                                            <?php } else if($dadosUsuario->fezesNormal == 'S') { ?>
                                                        <input type="checkbox" id="iNormal" class="checkbox-inline" checked="true" name="nNormal" value="S"
                                                            <?php echo set_checkbox('nNormal', 'S', FALSE); ?> /> <label
                                                            for="iNormal"> NORMAL </label><br>

                                            <?php } else { ?>
                                                <input type="checkbox" id="iNormal" class="checkbox-inline" name="nNormal" value="N"
                                                            <?php echo set_checkbox('nNormal', 'N', FALSE); ?> /> <label
                                                            for="iNormal"> NORMAL </label><br>
                                                
                                                <?php
                                                }?>

                                        </div>
                                    </div>                                   
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-offset-5 col-md-offset-5 col-sm-offset-6 col-xs-offset-6">
                                <button class="btn bg-teal waves-effect" type="submit"><span class="badge">S</span> ALVAR
                                    <i class="material-icons"> keyboard_tab </i> 03. ETAPA
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