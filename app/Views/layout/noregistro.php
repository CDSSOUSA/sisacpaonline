<?php
echo $this->extend('layout/home');
echo $this->section('content');
//dd(session()->get('erro'));

?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header bg-indigo">
                        <h2>
                            <?php echo $titulo; ?>
                        </h2>
                    </div>
                    <div class="body">
                        <section class="text-center">
                           <div class="container">
                            <div class="error-page">
                                <h2 class="headline text-warning"> 404</h2>
                                <div class="error-content">
                                    <h3><i class="fa fa-exclamation-triangle text-warning"></i> Oops! Nenhum registro encontrado para evolução.</h3>
                                    <p>Todos os registros para evolução já formam preenchidos!!!</p>                                   
                                    
                                </div>

                            </div>
                            </div>

                        </section>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $this->endSection();
