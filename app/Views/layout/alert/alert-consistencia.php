<?php

if ($this->session->flashdata('consistencia')) {
    echo '<div class="alert alert-show bg-orange alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <b>ATENÇÃO, existe(m) inconsitências críticas no sistema que precisa(m) de solução para melhorar as funcionalidades do sistema!</b>
</div>';
}
      