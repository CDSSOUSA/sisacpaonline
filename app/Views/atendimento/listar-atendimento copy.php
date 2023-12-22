<?php
echo $this->extend('layout/home');
echo $this->section('content');

?>
<script>
    /*var numero = 120;

    function contador(numero) {
        if (numero > 0)
            document.getElementById('timers').innerHTML = --numero;
    }
    setInterval("contador(numero--);", 1000);

    //setTimeout("document.location = 'http://192.168.88.89/sisapae/listarAtendimento';", 120000);
    setTimeout("document.location = '<?php // base_url('atendimento/listar_atendimento'); 
                                        ?>';", 120000);*/
</script>
<section class="content">
    <div class="container-fluid">

        <!--Input -->
        <div class="row clearfix">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?php
                echo view('layout/alert/alert-sucesso');
                echo view('layout/alert/alert-erro');
                echo view('layout/alert/alert-erro-preenchimento');
                session()->remove('erro');
                session()->remove('sucesso');

                if (session()->get('confirmadoAtendimento')) {

                    echo view('layout/alert/alert-atendimento-confirmado');
                }
                ?>
                <div class="card">
                    <div class="header bg-indigo">

                        <?php
                        setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'portuguese');
                        echo '<h2>';
                        echo 'HORÁRIOS DOS ATENDIMENTOS' . '<small>' . (strftime('%A, %d de %B de %Y', strtotime(date('Y-m-d')))) . '</small>';
                        echo '</h2>';
                        echo '<br>';
                        ?>



                        <small class="text-right"> A página será recarregada em <span class="badge" id="timers"></span> segundos ! </span></small>


                    </div>


                    <div class="body table-responsive">

                        <table id="_iTabelaAtendimento" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Id|Usuário</th>
                                    <th>Profissional</th>
                                    <th>Modalidade</th>
                                    <th>Hr. Início</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                foreach ($atendimentos as $atendimento) {

                                    $reg = $modelRegistroAtendimento->verifyRegisterAtendimento($atendimento->idAtendimento, $data);


                                    if (!$reg) {


                                        //$nomeUsuario = $modelUsuario->find($atendimento->idUsuario);



                                        $marcador = $atendimento->acompanhante == 'S' ? ' * ' : '';

                                        echo '<tr>'
                                            . '<td><span title="Acompanhante" class="font-bold">' . $marcador . '</span>' . $atendimento->idUsuario . ' - ' . $atendimento->nomeUsuario . '</td>
                                                            <td>' . $atendimento->nomeProfissional . '</td>
                                                            <td>' . $atendimento->modalidade . '</td>                                                         
                                                            <td>' . $atendimento->horaInicio . '</td>                                                        
                                                            <td class="text-center">'; ?>
                                        <button class="btn bg-green waves-effect" onclick="confirmarPresencaUsuarioHorario(
                                                                    <?= $atendimento->idAtendimento; ?>,
                                                                    '<?= date('Y-m-d'); ?>',
                                                                    '<?= $dia; ?>',
                                                                    'H',
                                                                    '<?= $atendimento->frequencia; ?>')" type="button" class="btn btn-primary" data-toggle="modal" data-target="#registrarPresencaUsuario">
                                            <span class="badge">R</span> egistrar </button>

                                            <?=anchor('#/' ,
                                             '<span class="badge bg-pink">E</span> xcluir',
                                              array('onclick'=> 'confirmarPresencaUsuarioHorario('.$atendimento->idAtendimento.')', 'class' => 'waves-effect waves-block', 'title' => 'Excluir Usuário', 'data-toggle' => 'modal', 'data-target' => '#registrarPresencaUsuario'));?>


                                        <?php echo anchor('atendimento/confirmar_presenca_usuario_horario/' . $atendimento->idAtendimento . '/' . date('Y-m-d') . '/' . $dia . '/H/' . $atendimento->frequencia, 'C', array(
                                            'class' => 'btn bg-teal waves-effect',
                                            'title' => 'Confirmar atendimento', 'data-toggle' => 'modal'
                                        ))
                                            . ' ' . anchor('atendimento/confirmar_falta_usuario/' . $atendimento->idAtendimento . '/' . date('Y-m-d') . '/' . $dia . '/H/' . $atendimento->frequencia, 'F', array(
                                                'class' => 'btn bg-red waves-effect',
                                                'title' => 'Falta usuario'
                                            )) . ' '
                                            . anchor('atendimento/confirmar_falta_profissional/' . $atendimento->idAtendimento . '/' . date('Y-m-d') . '/' . $dia . '/H/' . $atendimento->frequencia, 'P', array(
                                                'class' => 'btn bg-orange waves', 'title' => 'Falta profissional'
                                            )) . ' '
                                            . anchor('atendimento/form_escrever_observacao/' . $atendimento->idAtendimento . '/' . date('Y-m-d') . '/' . $dia . '/H/' . $atendimento->frequencia, 'O', array('class' => 'btn bg-indigo waves-effect', 'title' => 'Escrever Observação'));
                                        '</td>'; ?>

                                        <div class="modal fade" id="defaultModalLabel<?php echo $atendimento->idAtendimento; ?>" tabindex="-1" role="dialog">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-indigo">
                                                        <h4 class="modal-title">Escrevendo observação ...</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="body">
                                                            <?php
                                                            $atributos_formulario = array(
                                                                'role' => 'form',
                                                                'class' => 'form-horizontal'
                                                            );

                                                            echo form_open('escrever_outra_ocorrencia', $atributos_formulario);
                                                            echo form_hidden('nIdAtendimento', $atendimento->idAtendimento);
                                                            ?>
                                                            <div class="row clearfix">
                                                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                                                    <label>Id | nome: </label>
                                                                </div>
                                                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                                                    <div class="form-group">
                                                                        <div class="form-line">
                                                                            <h4><?php echo $atendimento->idUsuario . ' - ' . $atendimento->nomeUsuario; ?></h4>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row clearfix">
                                                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                                                    <label>Prof.| Modalidade | Hora: </label>
                                                                </div>
                                                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                                                    <div class="form-group">
                                                                        <div class="form-line">
                                                                            <h4><?php echo $atendimento->nomeProfissional . ' - ' . $atendimento->modalidade . ' - ' . $atendimento->horaInicio; ?></h4>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row clearfix">
                                                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                                                    <label>Observação: </label>
                                                                </div>
                                                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                                                    <div class="form-group">
                                                                        <div class="form-line">
                                                                            <textarea rows="4" name="nObservacao" class="form-control no-resize textareaLimite1" minlength="5" required="true" placeholder="Digite o texto ... Enter para mudar de linha."><?php echo set_value('nObservacao'); ?></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <span style="color:red"><?php echo ('nObservacao'); ?></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <?php
                                                            echo session()->get('botaoSalvar');
                                                            ?>

                                                            <button type="reset" class="btn btn-link waves-effect" data-dismiss="modal"><span class="badge">C</span> ANCELAR</button>

                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <?php echo ' </tr>';
                                        ?>


                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="registrarPresencaUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ATENÇÃO ::</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            <form role="form" method="post" action="<?=base_url();?>api/atendimento/confirmaPresencaUsuarioHorario" id="editSeriesForm">
                                <?= csrf_field();?>

                <?php
                $atributos_formulario = array(
                    'role' => 'form',
                    'class' => '',
                    'id'=>'editSeriesForm'
                );

                //echo form_open('api/atendimento/confirma_presenca_usuario_horario', $atributos_formulario);

               

                //echo form_input('nIdAtendimento', $atendimento->idAtendimento);
                /*echo form_input('nDiaSemana', $dia);
                echo form_input('nDataAtendimento', $dataAtendimento);
                echo form_input('nAcao', $acao);
                echo form_input('nFrequencia', $frequencia);*/


                ?>

                <input type="text" id="idAtendimento" name="nIdAtendimento">
                <input type="text" id="dataAtendimento" name="nDataAtendimento" value="<?= session()->get('dataConfirmacao');?>">
                <input type="text" id="dia" name="nDiaSemana">
                <input type="text" id="acao" name="nAcao">
                <input type="text" id="frequencia" name="nFrequencia">
                

                <div class="row clearfix">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                        <label for="">Id | Nome usuário:</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <h5 id="iIdUsuarioNome"></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label for="">Profissional | Modalidade:</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                    <h5 id="iNomeProfModalidade"></h5>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>    
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label for="">Dia | Horário:</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <h5 id="iDiaHoraInicio"></h5>
                                    </div>
                                </div>
                            </div>
                        </div>  
                        
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label for="">Data atendimento:</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <h5>

                                            <?php echo converteParaDataBrasileira(session()->get('dataConfirmacao')) ?>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                <label for="">Horário confirmado: * </label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="iHoraAtendimento" name="nHoraAtendimento" class="form-control hora" onfocus="eraseAlert(['iLabelHorarioConfirmado']);" placeholder="Digite o horário confirmado"/>
                                    </div>
                                    <span style="color:red" id="iLabelHorarioConfirmado"></span>
                                </div>
                            </div>
                        </div>

            </div>



            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cancelar</button>                
                <button type="submit" class="btn btn-link waves-effect">Salvar</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<?php $this->endSection();
