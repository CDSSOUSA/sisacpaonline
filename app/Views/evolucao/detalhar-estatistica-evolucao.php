<?php

echo $this->extend('layout/home');
echo $this->section('content'); ?>

<div class="row">
    <div class="col-xl-12">
        <div class="body table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Data atendimento</th>
                        <th>Número registro</th>
                        <th>Id | Nome usuário</th>
                        <th>Dia Sem. | Horário</th>
                      
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $nomeProfissional = '';
                    $idProfissional = '';
                    $modalidade = '';
                    $contador = 1;

                    foreach ($atendimentosPendentes as $atendimentoPendente) { 

                        $nomeProfissional = $atendimentoPendente->nomeProfissional;
                        $idProfissional = $atendimentoPendente->idProfissional;
                        $modalidade = $atendimentoPendente->modalidade;
                        
                        ?>

                        <tr>
                            <td><?=$contador++;?></td>
                            <td>
                                <?php echo converteParaDataBrasileira($atendimentoPendente->dataAtendimento); ?>
                            </td>
                            <td>
                                <?php echo $atendimentoPendente->numeroRegistro; ?>
                            </td>
                            <td>
                                <?php echo $atendimentoPendente->idUsuario . ' - ' . $atendimentoPendente->nomeUsuario; ?>
                            </td>
                            <td>
                                <?php echo tratarDiaSemana($atendimentoPendente->diaSemana) . ' - ' . $atendimentoPendente->horaInicio; ?>
                            </td>
                            
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <hr>
        <div class="d-flex justify-content-end">
        <?php
            echo gerarbotaoVoltar('evolucao/listar_dados_estatistica_evolucao');
            echo gerarBotaoImprimir('imprimir_detalhes_estatistica_evolucao/'.$idProfissional);
        ?>

        </div>
    </div>
   
</div>

<script>
    const subTitulo = document.querySelector('#subTitulo')
    subTitulo.textContent = 
                '<?= $nomeProfissional. ' - ' .$modalidade;?>'
</script>

<?php $this->endSection(); ?>