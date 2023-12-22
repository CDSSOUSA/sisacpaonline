<!-- Small Size -->
<div class="modal modalAlert" id="smallModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="smallModalLabel">Atendimento confirmado!</h4>
            </div>
            <div class="modal-body">
                <?php
                use App\Models\RegistroAtendimentoModel;
                $modelAtendimento = new RegistroAtendimentoModel;
                $dadosAtendimento = $modelAtendimento->getRegistroAtendimentoIdAtenDtAtend((session()->getflashdata('confirmadoAtendimento')), session()->getflashdata('confirmadoAtendimentoData'));

                //$nomeUsuario = $this->Usuario_model->getById(encrypt($dadosAtendimento->idUsuario))->row()->nomeUsuario;

                echo'<strong>Número registro: ' . $dadosAtendimento->numeroRegistro . '</strong> <br>
                     <strong>Usuário: ' . $dadosAtendimento->nomeUsuario . '</strong> <br>
                <strong>Profissional: ' . abrevPalavras($dadosAtendimento->nomeProfissional,2) . '</strong> <br>
                <strong>Modalidade: ' . $dadosAtendimento->modalidade . '</strong><br>
                <strong>Dia | Horário: ' . tratarDiaSemana($dadosAtendimento->diaSemana). ' - '.$dadosAtendimento->horaInicio.'</strong><br>
                <strong>Data atendimento: ' . converteParaDataBrasileira($dadosAtendimento->dataAtendimento).'</strong><br>
                <strong>Hora confirmada: ' . $dadosAtendimento->horaAtendimento . '</strong><br>';
                
                ?>
            </div>
            <div class="modal-footer">               
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">FECHAR</button>
            </div>
        </div>
    </div>
</div>