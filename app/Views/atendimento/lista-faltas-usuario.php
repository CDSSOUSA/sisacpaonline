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
                            <small> <h5><?php echo ($idUsuario . ' - ' . $nomeUsuario); ?></h5></small>
                        </h2>
                    </div>
                    <div class="body table-responsive">
                        <table class="table table-hover" id="iTabelaHodrario">
                            <thead>
                                <tr>
                                    <th style="font-weight: bold; color: black; font-size: 18px;">Data </th>
                                    <th style="font-weight: bold; color: black; font-size: 18px;" class="text-center">
                                        Dia | Horário</th>
                                    <th style="font-weight: bold; color: black; font-size: 18px;" class="text-left">Id |
                                        Profissional</th>
                                    <th style="font-weight: bold; color: black; font-size: 18px;" class="text-left">
                                        Modalidade</th>
                                    <th style="font-weight: bold; color: black; font-size: 18px;" class="text-left">
                                        Justificativa</th>
                                    <th style="font-weight: bold; color: black; font-size: 18px;" class="text-left">
                                        Status Atend.</th>
                                    <th style="font-weight: bold; color: black; font-size: 18px;" class="text-center">
                                        Ações</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $contador = 0;
                                //dd($dadosAtendimento);
                                foreach ($dadosAtendimento AS $atendimentos)
                                {
                                    $contador++;
                                   ?>
                                <tr>
                                    <td><?php echo converteParaDataBrasileira($atendimentos->dataAtendimento); ?></td>
                                    <td class="text-center">
                                        <?php echo tratarDiaSemana($atendimentos->diaSemana).' | '. $atendimentos->horaInicio; ?>
                                    </td>
                                    <td class="text-left">
                                        <?php echo $atendimentos->idProfissional.' - '.abrevPalavras($atendimentos->nomeProfissional,2); ?>
                                    </td>
                                    <td class="text-left"><?php echo $atendimentos->modalidade;?></td>
                                    <td class="text-left">
                                        <?php echo tratarCamposVazio($atendimentos->textoJustificativaFalta) != '--' ? 
                                        anchor('#/', character_limiter($atendimentos->textoJustificativaFalta,40, '...'),
                                         array('title'=>'Vizualizar justificativa',                                             
                                            'data-toggle' => 'modal', 
                                            'data-target' => '#smallModalJustificativa'.$atendimentos->idRegistroAtendimento)): 
                                            '--'; 
                                           
                                            ?>
                                    </td>
                                    <td class="text-left">
                                        <?php echo ($atendimentos->ativo);?>
                                    </td>
                                    <td class="text-center">
                                        <?php if($atendimentos->justificouFaltaUsuario == 'S'){
                                                 echo anchor('form_justificar_falta_usuario/' . encrypt($atendimentos->idRegistroAtendimento), '<span class="badge">J</span> ust. falta', array('class' => 'disabled btn bg-teal waves-effect')); 
                                                 echo '  ';
                                                 echo anchor('#', '<span class="badge">D </span> esfazer', array('class' => 'btn bg-red waves-effect disabled', 'title' => 'Impossível desfazer registro já evoluido'));
                                                 echo '  ';
                                                 
                                                 $documentoJustificativa = $modelRegistroAtendimento->getDocumentoJustificativa($atendimentos->idRegistroAtendimento);
                                                 //dd($documentoJustificativa);
                                                 //exit;
                                                 if($documentoJustificativa):
                                                    echo anchor('atendimento/visualiza_documento_justificativa/'.encrypt($documentoJustificativa->idDocumento).'/'.encrypt($documentoJustificativa->idRegistroAtendimento),'<span class="badge">V</span> er Doc. falta', array('class' => 'btn bg-blue waves-effect', 'title'=> 'Visualizar Documento Justificativa', 'target'=>'_blank'));

                                                 else:
                                                    echo anchor('atendimento/form_enviar_documento_justificativa/'.encrypt($atendimentos->idRegistroAtendimento).'/'.encrypt($dadosUsuario->idUsuario),'<span class="badge">D</span> oc.', array('class' => 'btn bg-orange waves-effect', 'title'=> 'Enviar documento da justificativa'));

                                                 endif;      
                                                 
                                        } else {
                                            echo anchor('atendimento/form_justificar_falta_usuario/' . encrypt($atendimentos->idRegistroAtendimento), '<span class="badge">J</span> ust. falta', array('class' => 'btn bg-teal waves-effect', 'title'=> 'Justificar falta')); 
                                            echo '  ';
                                            echo anchor('#/' . encrypt($atendimentos->idRegistroAtendimento), '<span class="badge">D </span> esfazer', array('class' => 'btn bg-red waves-effect', 'title' => 'Desfazer registro', 'data-toggle' => 'modal',
                                                    'data-target' => '#smallModal' . $atendimentos->idRegistroAtendimento));
                                        } ?>
                                    </td>
                                </tr>
                                <div class="modal fade"
                                    id="smallModal<?php echo $atendimentos->idRegistroAtendimento; ?>" tabindex="-1"
                                    role="dialog">
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
                                                echo form_hidden('nOpcao','U');
                                                ?>
                                                <h4>Confirmar
                                                    a desfazemento do registro?</h4>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-link waves-effect">SIM</button>
                                                <button type="reset" class="btn btn-link waves-effect"
                                                    data-dismiss="modal">CANCELAR</button>
                                            </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade"
                                    id="smallModalJustificativa<?php echo $atendimentos->idRegistroAtendimento; ?>"
                                    tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-indigo">
                                                <h4 class="modal-title">Visualizando justificativa <span
                                                        class="badge"><?=$atendimentos->numeroRegistro;?></span></h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="body">
                                                    <div class="row clearfix">
                                                        <div
                                                            class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                                            <label>Id | nome: </label>
                                                        </div>
                                                        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <h4><?php echo $idUsuario . ' - ' . $nomeUsuario;?>
                                                                    </h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row clearfix">
                                                        <div
                                                            class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                                            <label>Prof.| Modalidade | Hora | Data: </label>
                                                        </div>
                                                        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <h4><?php echo $atendimentos->nomeProfissional . ' - ' . $atendimentos->modalidade .' - '.$atendimentos->horaInicio.' - '. converteParaDataBrasileira($atendimentos->dataAtendimento);?>
                                                                    </h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row clearfix">
                                                        <div
                                                            class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                                            <label>Justificativa: </label>
                                                        </div>
                                                        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <h4><?php echo $atendimentos->textoJustificativaFalta;?>
                                                                    </h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">

                                                    <button type="reset" class="btn btn-link waves-effect"
                                                        data-dismiss="modal">Fechar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php } ?>
                            </tbody>

                        </table>
                        <?php echo gerarBotaoImprimir('imprimir_faltas_usuario').'  ';
                        
                         echo gerarbotaoVoltar('usuario/detalhar_usuario/' . encrypt($dadosUsuario->idUsuario));
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>