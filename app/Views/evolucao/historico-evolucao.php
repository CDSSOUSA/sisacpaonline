<?php
echo $this->extend('layout/home');
echo $this->section('content');
$totalEvolucao = count($dadosEvolucao) < 25 ? count($dadosEvolucao): 25;
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
                            <small><?php echo $dadosUsuario->idUsuario.' - '.$dadosUsuario->nomeUsuario;?><br><br>Exibe as últimas <?= str_pad($totalEvolucao, 2, '0', STR_PAD_LEFT);?> evoluções preenchidas.<br> </small>
                            
                        </h2>                           
                    </div>
                    <div class="body table-responsive">                                                
                        <table class="table table-hover" id="">
                            <thead >
                                <tr>
                                    <th style="font-weight: bold; color: black; font-size: 18px;">EVOLUÇÃO</th>                                   
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                
                                
                                foreach ($dadosEvolucao AS $evolucao) {
                                    ?>
                                    <tr>
                                        <td>

                                            <div class="">
                                                <div class="header bg-grey">
                                                    <h2>
                                                        Data do atendimento: <?php echo converteParaDataBrasileira($evolucao->dataAtendimento) . ' - ' . tratarDiaSemana($evolucao->diaSemana) . ' - ' . $evolucao->horaInicio . ' - <span class="badge">'. $evolucao->numeroRegistro. '</span> <small>Profissional: ' . $evolucao->nomeProfissional . ' - '.$evolucao->modalidade.'</small><small>Registrado da evolução em : ' . converteParaDataHoraCompletaBrasileira($evolucao->dataRegistroEvolucao) . '</small>'; ?>
                                                    </h2>                            
                                                </div>
                                                <div class="body">
                                                    <?php echo tratarEvolucao(base64_decode($evolucao->textoEvolucao),true); ?>
                                                </div>
                                                <div>
                                                <?php echo anchor('evolucao/form_editar_evolucao/' . encrypt($evolucao->idRegistroAtendimento), '<span class="badge">E</span> ditar', array('class' => 'btn bg-teal waves-effect')); ?>
                                                </div>
                                            </div> 
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>  

                        </table>
                        <?php 
                        echo gerarbotaoVoltar('usuario/detalhar_usuario/' . encrypt($dadosUsuario->idUsuario));
                    ?>
                    </div>
                    
                </div>
            </div>
        </div>          
    </div>
</section>
<?php $this->endSection();
