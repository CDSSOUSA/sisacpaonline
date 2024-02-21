<?php
echo $this->extend('layout/home');
echo $this->section('content');
$totalEvolucao = count($atendimentos) < 30 ? count($atendimentos) : 30;
?>
<div class="row">
    <div class="col-xl-12">
        <div class="body table-responsive">
            <table class="table table-hover" id="iTabdelaAtendimento">
                <thead>
                    <tr>
                        <th>Dt. Atend.</th>
                        <th class="text-center">N. Registro</th>
                        <th>Id | Nome Usuário</th>
                        <th>Nome profissional</th>
                        <th>Dia</th>
                        <th>H. Início</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    /*
                     @CONTROLLER Evolucao
                     @METODO formEscreverEvolucaoDataAtendimento
                    */
                    foreach ($atendimentos as $atendimento) { ?>
                        <tr>
                            <td>
                                <?php echo converteParaDataBrasileira($atendimento->dataAtendimento); ?>
                            </td>
                            <td class="text-center">
                                <?php echo $atendimento->numeroRegistro; ?>
                            </td>
                            <td>
                                <?php echo $atendimento->idUsuario . ' - ' . word_limiter($atendimento->nomeUsuario,3,''); ?>
                            </td>
                            <td>
                                <?php echo word_limiter($atendimento->nomeProfissional,2,''); ?>
                            </td>
                            <td class="text-center">
                                <?php echo tratarDiaSemana($atendimento->diaSemana); ?>
                            </td>
                            <td class="text-center">
                                <?php echo $atendimento->horaInicio; ?>
                            </td>
                            <td class="text-center">
                                <?php echo anchor('evolucao/form_evoluir_atendimento/' . encrypt($atendimento->numeroRegistro), '<i class="fa fa-file"></i>', array(' class' => 'btn btn-icon btn-primary', 'title' => 'Evoluir atendimento')) ?>
                            </td>

                        </tr>
                    <?php }
                    ?>
                </tbody>

            </table>

        </div>
    </div>
</div>
<script>
    const subTitulo = document.querySelector('#subTitulo')
    subTitulo.textContent = 
                '<?= 'Os '. str_pad($totalEvolucao, 2, '0', STR_PAD_LEFT). ' últimos atendimentos confirmados!';?>'
</script>

<?php $this->endSection();