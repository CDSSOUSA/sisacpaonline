<?php
use App\Models\RegistroAtendimentoModel;

echo $this->extend('layout/home');
echo $this->section('content'); ?>

<div class="row">
    <div class="col-xl-12">
        <div class="body table-responsive">
            <table class="table table-hover" id="iTabelaHorario">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Profissisonal</th>
                        <th>Status</th>

                        <th class="text-center">Qtde pendentes</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $contadorSim = 0;
                    $contadorNao = 0;
                    $contador = 1;
                    foreach ($profissionais as $profissional) {
                        $modelRegistroAtendimento = new RegistroAtendimentoModel;
                        $evolucao = $modelRegistroAtendimento->getAtendiemntoStatusEvolucao($profissional->idProfissional, 'S');

                        $contadorNao = 0; // Inicialize o contador dentro do loop para cada profissional
                    
                        foreach ($evolucao as $status) {
                            if ($status->jaEvoluiu == 'N') { // Corrigido: use == para comparação, não =
                                $contadorNao++;
                            }
                        }

                        // Exibir a linha somente se o contadorNao não for maior ou igual a 1
                        if ($contadorNao >= 1) {
                            ?>
                            <tr
                                style="<?= $profissional->ativo == 'N' ? "text-decoration: line-through; color:gray;" : "text-decoration: none" ?>">
                                <td><?=$contador++;?></td>
                                <td>
                                    <?php echo $profissional->nomeProfissional; ?>
                                </td>
                                <td>
                                    <?php echo tratarAtivo($profissional->ativo); ?>
                                </td>
                                <td class="text-center <?= $profissional->ativo == 'S' ? "text-danger" : "" ?> mb-1">
                                    <?php echo $contadorNao; ?>
                                </td>
                                <td class="text-center">
                                    <?php echo anchor('evolucao/detalhar_estatistica_evolucao/' . encrypt($profissional->idProfissional), '<i class="icon feather icon-eye"></i>', array('class' => 'btn btn-icon btn-primary', 'title' => "Visualizar")); ?>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>


                </tbody>

            </table>


        </div>
        <hr>
        <div class="d-flex justify-content-end">
            <?php echo gerarBotaoImprimir('rel_dados_estatistica_evolucao'); ?>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>