

<div class="modal fade" id="visualizarAgendaProfissionalModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    AGENDA DO PROFISSIONAL
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                $segunda = new DateTime('monday this week');
                $sexta = new DateTime('friday this week');
                ?>

                <h5 id="idNomeAgenda"> - </h5>
                <h5 id="modalidadeAgenda"> - </h5>
                <h5>Período:
                    <?= $segunda->format('d/m/Y') . " a " . $sexta->format('d/m/Y'); ?>
                </h5>

                <div class="btn-group mb-2 mr-2" id="divAgendaLocal">

                </div>
                <div class="btn-group mb-2 mr-2" id="divAgendaSUS">

                </div>

            </div>

            <div class="card-body" style="max-height: 500px; overflow-y: auto;">
                
                
                <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">

                </ul>
                <div class="tab-content" id="myTagbContent" >

                </div>
            </div>
            <div class="modal-footer">
                <?= session()->get('botaoFecharModal'); ?>
            </div>
        </div>
    </div>
</div>