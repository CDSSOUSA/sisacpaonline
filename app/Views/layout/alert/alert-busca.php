<?php

if ($this->session->flashdata('busca')) {
    echo '<div class="alert alert-show bg-teal alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' .
    $this->session->flashdata('busca') .
    '</div>';
}
