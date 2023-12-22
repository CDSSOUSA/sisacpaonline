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

                        echo form_open('usuario/alterar_dados_responsaveis', $atributos_formulario);
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
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <?php
                                echo gerarbotaoVoltar('usuario/detalhar_usuario/' . encrypt($dadosUsuario->idUsuario));
                                ?>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">

                            </div>
                        </div>
                        <!-- dados da mae-->
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>Nome responsável: </label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="iNomeMae" name="nNomeMae" value="<?php echo set_value('nNomeMae', $dadosUsuario->nomeMae); ?>" class="form-control">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nNomeMae']??'';?> </span>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>Data nasc. responsável: </label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">

                                        <input type="text" id="iDataNascimentoMae" name="nDataNascimentoMae" value="<?php echo set_value('nDataNascimentoMae', converteParaDataBrasileira($dadosUsuario->dataNascimentoMae)); ?>" class="form-control data">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>Telefone responsável: </label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">

                                        <input type="text" id="iTelefoneMae" name="nTelefoneMae" value="<?php echo set_value('nTelefoneMae', $dadosUsuario->telefoneMae); ?>" class="form-control telefone">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nTelefoneMae']??'';?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>Profissão responsável: </label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="iProfissaoMae" name="nProfissaoMae" value="<?php echo set_value('nProfissaoMae', $dadosUsuario->profissaoMae); ?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>Rg responsável: </label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">

                                        <input type="text" id="iRgMae" name="nRgMae" value="<?php echo set_value('nRgMae', $dadosUsuario->rgMae); ?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>CPF responsável: </label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">

                                        <input type="text" id="iCpfMae" name="nCpfMae" value="<?php echo set_value('nCpfMae', mascaraCpf($dadosUsuario->cpfMae)); ?>" class="form-control cpf">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nCpfMae']??'';?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>Escolaridade responsável: </label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">

                                        <input type="text" id="iEscolaridadeMae" name="nEscolaridadeMae" value="<?php echo set_value('nEscolaridadeMae', $dadosUsuario->escolaridadeMae); ?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>Plano saúde responsável: </label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">

                                        <input type="text" id="iPlanoSaudeMae" name="nPlanoSaudeMae" value="<?php echo set_value('nPlanoSaudeMae', $dadosUsuario->planoSaudeMae); ?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- dados do pai -->
                        <hr>
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>Nome responsável: </label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">

                                        <input type="text" id="iNomePai" name="nNomePai" value="<?php echo set_value('nNomePai', $dadosUsuario->nomePai); ?>" class="form-control">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nNomePai']??'';?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>Data nasc. responsável: </label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">

                                        <input type="text" id="iDataNascimentoPai" name="nDataNascimentoPai" value="<?php echo set_value('nDataNascimentoPai', converteParaDataBrasileira($dadosUsuario->dataNascimentoPai)); ?>" class="form-control data">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>Telefone responsável: </label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">

                                        <input type="text" id="iTelefonePai" name="nTelefonePai" value="<?php echo set_value('nTelefonePai', $dadosUsuario->telefonePai); ?>" class="form-control telefone">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nTelefonePai']??'';?></span>

                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>Profissão responsável: </label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">

                                        <input type="text" id="iProfissaoPai" name="nProfissaoPai" value="<?php echo set_value('nProfissaoPai', $dadosUsuario->profissaoPai); ?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>Rg responsável: </label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">

                                        <input type="text" id="iRgPai" name="nRgPai" value="<?php echo set_value('nRgPai', $dadosUsuario->rgPai); ?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>CPF responsável: </label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">

                                        <input type="text" id="iCpfPai" name="nCpfPai" value="<?php echo set_value('nCpfPai', mascaraCpf($dadosUsuario->cpfPai)); ?>" class="form-control cpf">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nCpfPai']??'';?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>Escolaridade responsável: </label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">

                                        <input type="text" id="iEscolaridadePai" name="nEscolaridadePai" value="<?php echo set_value('nEscolaridadePai', $dadosUsuario->escolaridadePai); ?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>Plano saúde responsável: </label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">

                                        <input type="text" id="iPlanoSaudePai" name="nPlanoSaudePai" value="<?php echo set_value('nPlanoSaudePai', $dadosUsuario->planoSaudePai); ?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>Definir responsável: </label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="demo-checkbox">

                                            <input type="checkbox" id="iMaeResp" class="checkbox-inline" name="nMaeResp" value="S" <?php echo set_checkbox('nMaeResp', 'S'); ?> /> <label for="iMaeResp"> Responsável (01). </label><br>
                                            <input type="checkbox" id="iPaiResp" class="checkbox-inline" name="nPaiResp" value="S" <?php echo set_checkbox('nPaiResp', 'S'); ?> /> <label for="iPaiResp"> Responsável (02). </label><br>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <hr>
                        <!-- RESPONSAVEIS-->
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>Parentesco: </label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="iGrauParentesco" name="nGrauParentesco" value="<?php echo set_value('nGrauParentesco', $dadosUsuario->grauParentesco); ?>" class="form-control">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nGrauParentesco']??'';?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>Nome responsável: </label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="iNomeResp" name="nNomeResp" value="<?php echo set_value('nNomeResp', $dadosUsuario->nomeResponsavel); ?>" class="form-control">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nNomeResp']??'';?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>Data nasc. responsável: </label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">

                                        <input type="text" id="iDataNascimentoResp" name="nDataNascimentoResp" value="<?php echo set_value('nDataNascimentoResp', converteParaDataBrasileira($dadosUsuario->dataNascimentoResponsavel)); ?>" class="form-control data">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>Telefone responsável: </label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">

                                        <input type="text" id="iTelefoneResp" name="nTelefoneResp" value="<?php echo set_value('nTelefoneResp', $dadosUsuario->telefoneResponsavel); ?>" class="form-control telefone">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nTelefoneResp']??'';?></span>

                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>Profissão responsável: </label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">

                                        <input type="text" id="iProfissaoResp" name="nProfissaoResp" value="<?php echo set_value('nProfissaoResp', $dadosUsuario->profissaoResponsavel); ?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>Rg responsável: </label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">

                                        <input type="text" id="iRgResp" name="nRgResp" value="<?php echo set_value('nRgResp', $dadosUsuario->rgResponsavel); ?>" class="form-control">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nRgResp']??'';?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>CPF responsável: </label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">

                                        <input type="text" id="iCpfResp" name="nCpfResp" value="<?php echo set_value('nCpfResp', mascaraCpf($dadosUsuario->cpfResponsavel)); ?>" class="form-control cpf">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nCpfResp']??'';?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>Escolaridade responsável: </label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">

                                        <input type="text" id="iEscolaridadeResp" name="nEscolaridadeResp" value="<?php echo set_value('nEscolaridadeResp', $dadosUsuario->escolaridadeResponsavel); ?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>Plano saúde responsável: </label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="iPlanoSaudeResp" name="nPlanoSaudeResp" value="<?php echo set_value('nPlanoSaudeResp', $dadosUsuario->planoSaudeResponsavel); ?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 form-control-label">
                                <label>E-mail do responsável: </label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="iEmailResp" name="nEmailResp" value="<?php echo set_value('nEmailResp', $dadosUsuario->emailResponsavel); ?>" class="form-control">
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nEmailResp']??'';?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-offset-4 col-md-offset-4 col-sm-offset-5 col-xs-offset-6">
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