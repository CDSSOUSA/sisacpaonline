<?php
echo $this->extend('layout/home');
echo $this->section('content');
$totalEvolucao = count($atendimentos) < 30 ? count($atendimentos): 30;
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
                            <?php echo $titulo; ?>
                            <small>Os <?= str_pad($totalEvolucao, 2, '0', STR_PAD_LEFT);?> últimos atendimentos confirmados!</small>
                        </h2>
                    </div>
                    <div class="body table-responsive">
                        <table class="table table-hover" id="iTabdelaAtendimento">
                            <thead>
                                <tr>
                                    <th style="font-weight: bold; color: black; font-size: 18px;">Data atendimento</th>
                                    <th style="font-weight: bold; color: black; font-size: 18px;" class="text-center">Número registro</th>
                                    <th style="font-weight: bold; color: black; font-size: 18px;">Id | Nome Usuário</th>
                                    <th style="font-weight: bold; color: black; font-size: 18px;">Nome profissional</th>
                                    <th style="font-weight: bold; color: black; font-size: 18px;">Dia semana</th>
                                    <th style="font-weight: bold; color: black; font-size: 18px;">Hora Início</th>
                                    <th style="font-weight: bold; color: black; font-size: 18px;" class="text-center">Atendido</th>
                                    <th style="font-weight: bold; color: black; font-size: 18px;">Ações</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php 
                                   /*
                                    @CONTROLLER Evolucao
                                    @METODO formEscreverEvolucaoDataAtendimento
                                   */
                                foreach ($atendimentos AS $atendimento) { ?>
                                    <tr>
                                        <td><?php echo converteParaDataBrasileira($atendimento->dataAtendimento); ?></td>
                                        <td class="text-center"><?php echo $atendimento->numeroRegistro; ?></td>
                                        <td><?php echo $atendimento->idUsuario . ' - ' . $atendimento->nomeUsuario; ?></td>
                                        <td><?php echo $atendimento->nomeProfissional; ?></td>
                                        <td class="text-center"><?php echo tratarDiaSemana($atendimento->diaSemana); ?></td>
                                        <td class="text-center"><?php echo $atendimento->horaInicio; ?></td>
                                        <td class="text-center"><?php echo tratarOpcaoSimNao($atendimento->atendido); ?></td>
                                        <td><?php echo anchor('evolucao/form_evoluir_atendimento/' . encrypt($atendimento->numeroRegistro), '<span class="badge">E</span> voluir', array(' class' => 'btn bg-teal waves-effect', 'title' => 'Evoluir atendimento')) ?></td>

                                    </tr>
                                <?php }
                                ?>
                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $this->endSection();