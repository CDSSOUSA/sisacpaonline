<?php
echo $this->extend('layout/home');
echo $this->section('content');

$idUsuario = $dadosUsuario->idUsuario;
$nomeUsuario = $dadosUsuario->nomeUsuario;
?>

<section class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?php
                echo view('layout/alert/alert-sucesso');
                echo view('layout/alert/alert-erro');
                echo view('layout/alert/alert-erro-preenchimento');
                session()->remove('erro');
                session()->remove('sucesso');
                ?>
                <div class="card">
                    <div class="header bg-indigo">
                        <h2>
                            <?php
                            echo $titulo;
                            ?><small>* campos de preenchimento obrigatorio.</small>
                        </h2>

                    </div>
                    <div class="body">
                        <?php
                        $atributos_formulario = array(
                            'role' => 'form',
                            'class' => 'form-horizontal'
                        );
                        echo form_open('matricula/matricular_usuario', $atributos_formulario);
                        echo form_hidden('nIdUsuario', $idUsuario);
                        ?>

                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label>Id | Nome Usuario: </label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <h5>

                                            <?php echo $idUsuario . ' - ' . $nomeUsuario; ?>
                                    </div>
                                    </h5>

                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label>Ano matricula: </label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <select class="form-control show-tick" name="nAnoMatricula">
                                            <option value="">selecione um ...</option>
                                            <?php
                                            for ($i = date('Y'); $i <= date('Y') + 1; $i++) {

                                                echo ' <option value="' . $i . '">' . $i . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <span style="color:red"><?= session()->get('errors')['nAnoMatricula'] ?? ''; ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-offset-3 col-md-offset-3 col-sm-offset-4 col-xs-offset-5">
                                <?php
                                echo session()->get('botaoSalvar');
                                echo session()->get('botaoLimpar');
                                echo gerarbotaoVoltar('usuario/detalhar_usuario/' . encrypt($idUsuario));
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
<?php $this->endSection();
