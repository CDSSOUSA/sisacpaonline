<?php

if (validation_errors()) {
    echo '<div class="alert alert-show bg-red alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    ERRO, foi(ram) encontrado(s) erro(s) no preenchimento.
    </div>';
}
