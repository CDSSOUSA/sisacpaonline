
<div class="modal fade" id="listarAlocacaoProfissional" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    ALOCAÇÕES DO PROFISSIONAL
                    <small class="d-block" id="nomeProfissionalSmall">* campos de preenchimento obrigatório.</small>
                </h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span>
                </button>

            </div>
            <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                <div class="body table-responsive p-0">
                    <table id="tb_alocacao_profissional" class="table table-striped table-head-fixed text-nowrap">
                        <thead>
                            <tr>
                                <th class="">Dia semana</th>
                                <th class="">Hora início</th>
                                <th class="">Hora fim</th>
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>

                        <tbody>

                        </tbody>
                    </table>
                </div>                
            </div>
            <div class="modal-footer">
                <div class="col-sm-9 d-flex justify-content-between">
                    <div id="btnSalvar">
                        <a href="#" class="main_back_bt" id="btVoltarAlocacaoProfissional" data-toggle="modal"
                            data-target="#alocarProfissionalModal">
                            <i class="fa fa-arrow-left"></i> Voltar
                        </a>
                    </div>
                    <?= session()->get('botaoFecharModal'); ?>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

