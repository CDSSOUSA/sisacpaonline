<?php 
echo $this->extend('layout/home');
echo $this->section('content');
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
        
                $idUsuario = $dadosUsuario->idUsuario;
                $nomeUsuario = $dadosUsuario->nomeUsuario;
                ?>
                <div class="card">
                    <div class="header bg-indigo">
                        <h2>
                            <?php echo $titulo; ?>
                            <small><h5>

                                <?php echo $dadosUsuario->idUsuario . ' - ' . $dadosUsuario->nomeUsuario; ?></small>
                            </h5> 
                        </h2>
                    </div>
                    <div class="body table-responsive">
                        <table class="table table-hover" id="iTabelaHorario">
                            <thead>
                                <tr>
                                    <th style="font-weight: bold; color: black; font-size: 18px;">Data </th>
                                    <th style="font-weight: bold; color: black; font-size: 18px;" class="text-center">Núm. registro </th>
                                    <th style="font-weight: bold; color: black; font-size: 18px;" class="text-center">Dia | Horário</th>
                                    <th style="font-weight: bold; color: black; font-size: 18px;" class="text-left">Id | Profissional</th>
                                    <th style="font-weight: bold; color: black; font-size: 18px;" class="text-left">Modalidade</th>
                                    <th style="font-weight: bold; color: black; font-size: 18px;" class="text-center">Ações</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $contador = 0;
                                foreach ($dadosAtendimento AS $atendimentos)
                                {
                                    $contador++;
                                   ?>
                                    <tr>
                                        <td><?php echo converteParaDataBrasileira($atendimentos->dataAtendimento); ?></td>
                                        <td class="text-center"><?php echo ($atendimentos->numeroRegistro); ?></td>
                                        <td class="text-center"><?php echo tratarDiaSemana($atendimentos->diaSemana).' | '. $atendimentos->horaInicio; ?></td>
                                        <td class="text-left"><?php echo $atendimentos->idProfissional.' - '.$atendimentos->nomeProfissional; ?></td>
                                        <td class="text-left"><?php echo $atendimentos->modalidade;?></td>
                                        <td class="text-center">
                                            <?php 
                                                if($atendimentos->justificouFaltaProfissional == 'S'){
                                                    
                                                    echo anchor('atendimento/form_justificar_falta_profissional/' . encrypt($atendimentos->idRegistroAtendimento), '<span class="badge">J</span> ustificar falta', array('class' => 'disabled btn bg-teal waves-effect')); 
                                                    echo '  ';
                                                    echo anchor('#', '<span class="badge">D </span> esfazer', array('class' => 'btn bg-red waves-effect disabled', 'title' => 'Impossivel desfazer registro ja evoluido'));

                                                }
                                                else
                                                {
                                                    echo anchor('atendimento/form_justificar_falta_profissional/' . encrypt($atendimentos->idRegistroAtendimento), '<span class="badge">J</span> ustificar falta', array('class' => 'btn bg-teal waves-effect')); 
                                                    echo '  ';
                                                    echo anchor('#/' , '<span class="badge">D </span> esfazer', array('class' => 'btn bg-red waves-effect', 'title' => 'Desfazer registro', 'data-toggle' => 'modal',
                                                    'data-target' => '#smallModal' . $atendimentos->idRegistroAtendimento));
                                                } 
                                                ?>
                                        </td>
                                    </tr>
                                    <div
                                    class="modal fade"
                                    id="smallModal<?php echo $atendimentos->idRegistroAtendimento; ?>"
                                    tabindex="-1" role="dialog">
                                    <div class="modal-dialog modal-sm" role="document">
                                        <div class="modal-content modal-col-red">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="smallModalLabel">Atenção</h4>
                                            </div>
                                            <div class="modal-body">

                                                <?php
                                                $atributos_formulario = array(
                                                    'role' => 'form',
                                                    'class' => ''
                                                );

                                                echo form_open('atendimento/desfaz_registro_atendimento', $atributos_formulario);
                                                echo form_hidden('nIdRegistroAtendimento',$atendimentos->idRegistroAtendimento);
                                                echo form_hidden('nIdUsuario',$idUsuario);
                                                echo form_hidden('nOpcao','P');
                                                ?>
                                                <h4>Confirmar
                                                    a desfazemento do registro?</h4>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit"
                                                        class="btn btn-link waves-effect">SIM</button>
                                                <button type="reset"
                                                        class="btn btn-link waves-effect"
                                                        data-dismiss="modal">CANCELAR</button>
                                            </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                                <?php } ?>       
                            </tbody>

                        </table>
                        <?php echo gerarBotaoImprimir('imprimir_faltas_profisssional').'  ';
                        
                         echo gerarbotaoVoltar('usuario/detalhar_usuario/' . encrypt($dadosUsuario->idUsuario));
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>