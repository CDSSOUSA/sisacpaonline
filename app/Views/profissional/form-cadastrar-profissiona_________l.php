<?php
echo $this->extend('layout/home');
echo $this->section('content');
?>
<div class="row column1" style="padding-top:36px">
   
   <div class="col-md-12">
      <div class="white_shd full margin_bottom_30 ">
         <div class="full graph_head" style="background:#214162; border-start-start-radius: 5px; border-start-end-radius:5px;">
            <div class="heading1 margin_0">
               <h2 style="color:#fff">
                  <?= $titulo; ?>
               </h2>
            </div>
         </div>
         <div class="login_form">
            <?php
            $atributos_formulario = [
               'role' => 'form', 
               'class' => 'form-horizontal',
               'id'=>'cadastrarProfissionalForm'];
            echo form_open('', $atributos_formulario);
            ?>
            <fieldset>
               <div class="form-group row">
                  <label for="nome" class="col-sm-4 col-form-label font-weight-bold">Nome completo: *</label>
                  <div class="col-sm-8">
                     <input 
                        type="text" 
                        name="nNomeProfissional" 
                        value="<?php echo set_value('nNomeProfissional') ?>"
                        class="form-control" 
                        autofocus 
                        placeholder="Nome completo"
                        onclick="clearMessageError('iNomeProfissional')">
                     <span style="color:red" id="iNomeProfissional">
                        
                     </span>
                  </div>
               </div>

               <div class="form-group row">
                  <label for="nome" class="col-sm-4 col-form-label font-weight-bold">Gênero: *</label>
                  <div class="col-sm-8">
                     <div class="icheck-material-indigo icheck-inline">
                        <input 
                           name="nGenero" 
                           type="radio" 
                           class="with-gap" 
                           id="iGeneroMasc"
                           value="M" <?php echo set_radio('nGenero', 'M', FALSE); ?> />
                        <label for="iGeneroMasc">Masc</label>
                     </div>
                     
                     <div class="icheck-material-orange icheck-inline">
                        <input 
                           name="nGenero" 
                           type="radio" 
                           id="iGeneroFemi" 
                           class="with-gap"
                           value="F" <?php echo set_radio('nGenero', 'F', FALSE); ?> />
                        <label for="iGeneroFemi">Femi</label>
                     </div>
                     <br>

                     <span style="color:red" id="iGenero">
                        <?= session()->get('errors')['nGenero'] ?? ''; ?>
                     </span>
                  </div>
               </div>

               <div class="form-group row">
                  <label for="nome" class="col-sm-4 col-form-label font-weight-bold">CNS profissional: *</label>
                  <div class="col-sm-8">
                  <input type="text" name="nCnsProfissional"
                                            value="<?php echo set_value('nCnsProfissional') ?>" class="form-control cns"
                                            placeholder="CNS do profissional">
                                            <span style="color:red" id="iCnsProfissional">
                                                <?= session()->get('errors')['nCnsProfissional'] ?? ''; ?>
                                            </span>
                  </div>
               </div>

               <div class="form-group row">
                  <label for="nome" class="col-sm-4 col-form-label font-weight-bold">CPF profissional: *</label>
                  <div class="col-sm-8">
                  <input type="text" name="nCpfProfissional" class="form-control"
                                            value="<?php echo set_value('nCpfProfissional') ?>"
                                            placeholder="Número do CPF">

                                            <span style="color:red" id="iCpfProfissional">
                                                
                                            </span>
                  </div>
               </div>

               <div class="form-group row">
                  <label for="nome" class="col-sm-4 col-form-label font-weight-bold">Núm. Cons. Classe: </label>
                  <div class="col-sm-8">
                  <input type="text" name="nConselhoClasse" class="form-control"
                                            value="<?php echo set_value('nConselhoClasse') ?>"
                                            placeholder="Número do Conselho de classe">

                        </div>                       
                  </div>
               

               <div class="form-group row">
                  <label for="nome" class="col-sm-4 col-form-label font-weight-bold">Tipo profissional: *</label>
                  <div class="col-sm-8">                  
                  <select class="custom-select" name="nTipoProfissional">
                                            <option value="">selecione ...</option>
                                            <option value="F" <?php echo set_select('nTipoProfissional', 'F', FALSE); ?>>FUNCIONÁRIO</option>
                                            <option value="V" <?php echo set_select('nTipoProfissional', 'V', FALSE); ?>>VOLUNTÁRIO</option>
                                            <option value="O" <?php echo set_select('nTipoProfissional', 'O', FALSE); ?>>OUTROS</option>
                                        </select>

                                        <span style="color:red" id="iTipoProfissional">
                                           
                                        </span>
                  </div>
               </div>

               <div class="form-group row">
                  <label for="nome" class="col-sm-4 col-form-label font-weight-bold">Tipo profissional: *</label>
                  <div class="col-sm-8">                  
                  <select class="custom-select" name="nModalidade">
                                            <option value="">selecione ...</option>
                                            <?php foreach ($modalidades as $modalidade) { ?>
                                                <option value="<?php echo $modalidade->nomeModalidade; ?>" <?php echo set_select('nModalidade', $modalidade->nomeModalidade, FALSE); ?>>
                                                    <?php echo $modalidade->nomeModalidade; ?>
                                                </option>
                                            <?php }
                                            ?>
                                        </select>

                                        <span style="color:red" id="iModalidadeProfissional">
                                            <?= session()->get('errors')['nModalidade'] ?? ''; ?>
                                        </span>
                  </div>
               </div>


               <div class="form-group row">
                  <label class="col-sm-4 hidden">hidden label</label>
                  <div class="col-sm-8 d-flex justify-content-between">
                     <button type="" class="main_bt" id="btnSalvarProfissional"><i class="fa fa-save"></i> Salvar</button>
                     <button type="reset" class="main_clear_bt"><i class="fa fa-times"></i> Limpar</button>
                  </div>
               </div>
            </fieldset>
            </form>
         </div>
      </div>
   </div>
   
   <!-- end row -->
</div>

<?= $this->endSection(); ?>
<?= $this->section('script-js'); ?>
<script src="<?= base_url() ?>js/profissional.js"></script>
<?= $this->endSection(); ?>