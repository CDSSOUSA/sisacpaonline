<?php

if (session()->has('sucesso')) {
    echo '<div class="alert alert-show bg-teal alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
 '.session()->get('sucesso').'
</div>';
}
      