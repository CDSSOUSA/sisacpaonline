<div class="modal fade" id="historicoEvolucaoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">HISTÓRICO EVOLUÇÃO
                    <small id="nomeUsuarioHistorico" class="d-block"></small>
                    <small id="totalHistorico" class="d-block"></small>
                    
                </h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" id="resultHistorico"></div>
            <div class="modal-footer">
                <?= session()->get('botaoFecharModal'); ?>
            </div>
        </div>
    </div>
</div>

