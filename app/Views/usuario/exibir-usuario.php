<?php
echo $this->extend('layout/home');
echo $this->section('content'); ?>

<?php
$usuarios = session()->get('dados');


//dd($usu);

//dd($result);

$botao = '';
$botaoDesligamento = '';
$botaoAtendimentos = '';
$botaoExcluir = '';
$botaoListaEspera = '';
$message = '';
$matricula = '';
?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <div class="card">
                    <div class="header bg-indigo">

                        <h2><?= $titulo; ?><small>Fornece a lista dos usuários cadastrados.</small></h2>


                    </div>
                    <div class="body table-responsive">
                        <table class="table table-hover" id="">
                            <thead>
                                <tr>
                                    <th>Id | Usuário</th>
                                    <th>N. responsável</th>
                                    <th class="text-center">Data nasc</th>
                                    <th class="text-center">Idade</th>
                                    <th class="text-center">CNS</th>
                                    <th class="text-center">CPF</th>
                                    <th>Ativo</th>
                                    <th>Telefone(s)</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php

                                $contador = 0;

                                foreach ($usuarios as $dados) {
                                    $contador++;

                                    if ($dados->ativo == 'S') {
                                        $botao = anchor('usuario/detalhar_usuario/' . encrypt($dados->idUsuario), '<span class="badge bg-teal">D</span> etalhar', array(
                                            'class' => 'waves-effect waves-block',
                                            'title' => 'Detalhar Usuário'
                                        ));
                                    } else {
                                        $botao = anchor('#', '<span class="badge bg-green">A</span> tivar', array(
                                            'class' => 'waves-effecdt waves-block',
                                            'title' => 'Ativar Usuário', 'data-toggle' => 'modal',
                                            'data-target' => '#smallModal' . $dados->idUsuario,
                                        ));
                                    }
                                    if ($dados->listaEspera == 'N') {
                                        $matricula = $modelMatricula->getMatriculasUsuario($dados->idUsuario);
                                        if ($matricula <= 0) {

                                            $botaoListaEspera = anchor('inserir_lista_espera/' . encrypt($dados->idUsuario), '<span class="badge bg-purple">L</span> ista Espera', array('class' => 'waves-effect waves-block', 'title' => 'Inserir na lista de espera'));

                                            $message = '';
                                        }
                                    } else {
                                        $message = '
                                        <br><span style="color:orange">* USUÁRIO EM LISTA DE ESPERA!</span>
                                    ';
                                    }

                                    if ($dados->acompanhante != 'S') {

                                        $botaoDesligamento = anchor('imprimir_termo_desligamento/' . encrypt($dados->idUsuario), '<span class="badge">D</span> esligamento', array('target' => '_blank', 'class' => 'waves-effect waves-block'));
                                    }

                                    $botaoExcluir = anchor('#/' . encrypt($dados->idUsuario), '<span class="badge bg-pink">E</span> xcluir', array('class' => 'waves-effect waves-block', 'title' => 'Excluir Usuário', 'data-toggle' => 'modal', 'data-target' => '#smallModalExcluir' . $dados->idUsuario));

                                    $atendimentosRealizados = $modelAtendimento->getAtendimentosRealizadosPorUsuario($dados->idUsuario);

                                    if ($atendimentosRealizados >= 1) {
                                        $botaoAtendimentos = anchor('exibirAtendimentoUsuario/' . encrypt($dados->idUsuario), '<span class="badge bg-cyan">A</span> tendimentos', array('class' => 'waves-effect waves-block', 'title' => 'Exibir atendimentos'));
                                    }
                                ?>

                                    <tr class="align-middle <?php echo $dados->ativo == 'N'? 'font-line-through col-grey': '';?>">
                                        <td class="align-middle"> <?php echo $dados->idUsuario . ' - ' . $dados->nomeUsuario; ?>
                                        <?= $message; ?></td>
                                        <td class="align-middle"><?php echo $dados->acompanhante == 'S' ? '<span style="color:orange;font-weight:bold">ACOMPANHANTE</span>' : $dados->nomeResponsavel; ?></td>
                                        <td class="text-center align-middle">
                                            <?php echo converteParaDataBrasileira($dados->dataNascimento); ?></td>
                                        <td class="text-center align-middle"><?php echo calcAge($dados->dataNascimento); ?></td>
                                        <td class="text-center align-middle"><?php echo mascaraCns($dados->cnsUsuario); ?></td>
                                        <td class="text-center align-middle"><?php echo mascaraCpf($dados->cpfUsuario); ?></td>
                                        <td><?php echo tratarOpcaoSimNao($dados->ativo); ?></td>
                                        <?php
                                            $telefones = '';
                                            if($dados->telefone) {
                                                $telefones .= $dados->telefone.'<br>';
                                            }
                                            if($dados->telefoneMae || $dados->telefonePai ) {
                                                $telefones .= $dados->telefoneMae.'<br>';
                                            }
                                            if($dados->telefonePai) {
                                                $telefones .= $dados->telefonePai;
                                            }
                                        ?>
                                        <td class="text-center align-middle"><?php echo $telefones; ?>
                                        </td>

                                        <td>
                                            <ul class="header-dropdown m-r--5">
                                                <li class="dropdown">
                                                    <button type="button" class="btn bg-purple dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                        AÇÕES <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu pull-right">
                                                        <li><?php echo $botao; ?></li>
                                                        <li> <?php echo $botaoListaEspera; ?></li>
                                                        <li><?php echo $botaoDesligamento; ?></li>
                                                        <li><?php echo $botaoAtendimentos; ?></li>
                                                        <li> <?php echo $botaoExcluir; ?></li>
                                                    </ul>
                                                </li>
                                            </ul>                                            
                                        </td>
                                    </tr>



                                    <div class="modal fade" id="smallModal<?php echo $dados->idUsuario; ?>" tabindex="-1" role="dialog">
                                        <div class="modal-dialog modal-sm" role="document">
                                            <div class="modal-content modal-col-green">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="smallModalLabel">Atenção!</h4>
                                                </div>
                                                <div class="modal-body">

                                                    <?php
                                                    $atributos_formulario = array(
                                                        'role' => 'form',
                                                        'class' => ''
                                                    );

                                                    echo form_open('ativar_usuario/' . $dados->idUsuario, $atributos_formulario);
                                                    echo '<h4>Confirmar a ativação ?</h4>';
                                                    ?>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-link waves-effect">SIM</button>
                                                    <button type="reset" class="btn btn-link waves-effect" data-dismiss="modal">CANCELAR</button>
                                                </div>
                                                <?php echo form_close(); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="smallModalExcluir<?php echo $dados->idUsuario; ?>" tabindex="-1" role="dialog">
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

                                                    echo form_open('excluir_usuario/' . $dados->idUsuario, $atributos_formulario);
                                                    ?>
                                                    <h4>Todos os dados do usuário serão perdidos. Confirmar a exclusão?</h4>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-link waves-effect">SIM</button>
                                                    <button type="reset" class="btn btn-link waves-effect" data-dismiss="modal">CANCELAR</button>
                                                </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </tbody>

                        </table>
                    
                        <?php echo gerarbotaoVoltar('usuario/form_pesquisar_usuario'); ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<?= $this->endSection(); ?>