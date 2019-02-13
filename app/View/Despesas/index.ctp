

<header class="header bg-ui-general">
     <div class="header-info">
          <h1 class="header-title">
               <strong>Admnistração de Despesas</strong> - <?php echo $links[$mes][0].'/'.$ano; ?>
               <small>Controle de despesas Fixas, Pontuais e Fornecedores</small>
          </h1>
          <div><?php echo $this->Html->link('<i class="fa fa-plus-square"></i> Cadastrar nova despesa</span>', '#', array('data-target' => '#addDespesa', 'data-toggle' => 'modal', 'escape' => false, 'class'=>'btn btn-xs btn-success')); ?></div>
     </div>

     <div class="header-action">
          <nav class="nav">

          	

          	<?php
          	foreach ($links as $kLinks => $vLinks) {
          		echo $this->Html->link($vLinks[0], array('controller' => 'despesas', 'action' => 'index', $vLinks[1], $kLinks), array('class' => $vLinks[2]));
          	}
            ?>

       </nav>
  </div>







</header>
<div class="main-content">

     <div class="row">
          <div class="col-lg-5">


            <div class="card card-body">
              <h9>
                <span class="text-uppercase"><b>Resumo Geral</b></span>
                <!-- <span class="float-right"><a class="btn btn-xs btn-primary" href="#">View</a></span> -->
           </h9>
           <br>
           <p class="fs-20 fw-100">Total: <b><?php echo $this->Brainme->preco($resumo['tudo']) ?></b> / Aberto: <b><?php echo $this->Brainme->preco(($resumo['tudo'] - $resumo['tudo_pago'])) ?></b></p>


           <?php $porcentagem = @round(($resumo['tudo_pago'] * 100) / $resumo['tudo']); ?>
           <div class="progress">
                <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $porcentagem ?>%; height: 4px;" aria-valuenow="<?php echo $porcentagem ?>" aria-valuemin="0" aria-valuemax="100"></div>
           </div>
           <div class="text-gray fs-12"><i class="ti-stats-up text-success mr-1"></i> <?php echo $porcentagem ?>% das despesas pagas</div>
      </div>
 </div>
 <div class="col-lg-7">
     <div class="row">
          <?php foreach ($resumo['tipos'] as $key => $value): ?>


               <div class="col-lg-4">
                 <div class="card card-body">
                   <h9>
                     <span class="text-uppercase"><?php echo $config->tipos[$key] ?></span>
                     <!-- <span class="float-right"><a class="btn btn-xs btn-primary" href="#">View</a></span> -->
                </h9>
                <br>
                <p class="fs-20 fw-100"><?php echo $this->Brainme->preco($value) ?></p>

                <?php $porcentagem = @round(($value * 100) / $resumo['tudo']); ?>
                <div class="progress">
                     <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $porcentagem ?>%; height: 4px;" aria-valuenow="<?php echo $porcentagem ?>" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="text-gray fs-12"><i class="ti-stats-down text-danger mr-1"></i> <?php echo $porcentagem ?>% no total</div>
           </div>
      </div>


 <?php endforeach ?>
</div>
</div>

</div>
<?php foreach ($dados['lista'] as $kDados => $vDados): ?>

     <?php //pr($kDados); pr($vDados); exit; ?>
     

     <div class="row">
          <div class="col-md-12">
               <div class="card">
                    <h4 class="card-title"><strong><?php echo $config->tipos[$kDados] ?></strong></h4>
                    <div class="card-body">
                         <table class="table table-hover">
                              <thead>
                                   <tr>
                                        <th width="40">ID</th>
                                        <th width="110">Data</th>
                                        <th>Nome</th>
                                        <th>Empresa</th>
                                        <th width="160">Forma de Pagamento</th>
                                        <th width="95">Valor</th>
                                        <th style="text-align: center;" width="45">Pago</th>
                                        <th>Data Pagamento</th>
                                        <th style="text-align: center;" width="60">OBS</th>
                                        <th style="text-align: center;" width="50">Ver</th>
                                   </tr>
                              </thead>
                              <tbody>
                                   <?php foreach ($vDados as $kDespesa => $vDespesa) { ?>
                                        <tr>
                                             <th><?php echo $vDespesa['Despesa']['id'] ?></th>
                                             <th><?php echo $this->Brainme->data($vDespesa['Despesa']['data']) ?></th>
                                             <th><?php echo $vDespesa['Despesa']['nome'] ?></th>
                                             <th><?php echo $empresas[$vDespesa['Despesa']['empresa_id']] ?></th>
                                             <th><?php echo $config->formas[$vDespesa['Despesa']['formapagamento_id']] ?></th>
                                             <th><?php echo $this->Brainme->preco($vDespesa['Despesa']['valor']) ?></th>
                                             <th style="text-align: center;"><?php echo $this->Brainme->ativo($vDespesa['Despesa']['pago']) ?></th>
                                             <th><?php if ($vDespesa['Despesa']['datapagamento']) { echo $this->Brainme->data($vDespesa['Despesa']['datapagamento']); } ?></th>
                                             <th style="text-align: center;"><?php if ($vDespesa['Despesa']['obs']): ?>

                                             <button type="button" class="btn btn-xs btn-outline btn-info" data-provide="tooltip" data-placement="left" title="" data-original-title="<?php echo $vDespesa['Despesa']['obs'] ?>">OBS</button> <?php endif ?></th>
                                             <td style="text-align: center;">
                                                  <?php echo $this->Html->link('<i class="fa fa-eye"></i></span>', '#', array('data-target' => '#despesa_'.$vDespesa['Despesa']['id'], 'data-toggle' => 'modal', 'escape' => false, 'class'=>'btn btn-xs btn-secondary')); ?>




                                                  <div class="modal fade" id="despesa_<?php echo $vDespesa['Despesa']['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="text-align: left;">


                                                       <div class="modal-dialog">
                                                            <div class="modal-content">


                                                  <?php echo $this->Form->create('Despesa', array('url' => array('controller' => 'despesas', 'action' => 'edit'))); ?>
                                                  <?php echo $this->Form->input('id', array('type' => 'hidden', 'value' => $vDespesa['Despesa']['id'])); ?>
                                                                 <div class="modal-header">
                                                                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                      <h4 class="modal-title" id="myModalLabel">Editar despesa: <?php echo $vDespesa['Despesa']['nome'] ?></h4>
                                                                 </div>
                                                                 

                                                                 <div class="modal-body">
                                                                      <div class="row form-group">
                                                                           <div class="col-lg-9">

                                                                                <?php echo $this->Form->input('nome', array('class' => 'form-control', 'label' => 'Nome', 'placeholder' => 'Nome da Despesa', 'value' => $vDespesa['Despesa']['nome'])); ?>

                                                                           </div>
                                                                           <div class="col-lg-3">

                                                                                <?php echo $this->Form->input('valor', array('type'=>'text','class' => 'form-control', 'label' => 'Valor', 'placeholder' => 'R$ 000.00', 'value' => $vDespesa['Despesa']['valor'])); ?>

                                                                           </div>
                                                                           <div class="col-lg-5">

                                                                                <?php echo $this->Form->input('empresa_id', array('class' => 'form-control', 'label' => 'Empresa', 'options' => $empresas, 'empty' => array('' => 'Selecione'), 'value' => $vDespesa['Despesa']['empresa_id'])); ?>

                                                                           </div>
                                                                           <div class="col-lg-7">

                                                                                <?php echo $this->Form->input('data', array('class' => 'form-control', 'label' => 'Data da despesa', 'minYear' => date('Y'), 'maxYear' => date('Y'), 'selected' => $vDespesa['Despesa']['data'])); ?>

                                                                           </div>

                                                                           <div class="col-lg-6">

                                                                                <?php echo $this->Form->input('formapagamento_id', array('class' => 'form-control', 'label' => 'Forma de pagamento', 'options' => $config->formas, 'empty' => array('' => 'Selecione'), 'value' => $vDespesa['Despesa']['formapagamento_id'])); ?>

                                                                           </div>
                                                                           <div class="col-lg-6">

                                                                                <?php echo $this->Form->input('despesatipo_id', array('class' => 'form-control', 'label' => 'Tipo da despesa', 'options' => $config->tipos, 'empty' => array('' => 'Selecione'), 'value' => $vDespesa['Despesa']['despesatipo_id'])); ?>

                                                                           </div>


                                                                           <div class="col-lg-12">

                                                                                <?php echo $this->Form->input('pago', array('value' => $vDespesa['Despesa']['pago'], 'class' => 'form-control', 'label' => 'Pago', 'options' => array(0 => 'Não', 1 => 'Sim'), 'id' => 'data_pagamento_edit'.$vDespesa['Despesa']['id'], 'onchange' => "habilitaDataPago('#data_pagamento_edit".$vDespesa['Despesa']['id']."','#data_pagamento_edit_div".$vDespesa['Despesa']['id']."')")); ?>

                                                                           </div>


                                                                           <div class="col-lg-12" id="data_pagamento_edit_div<?php echo $vDespesa['Despesa']['id']; ?>" <?php if ($vDespesa['Despesa']['pago'] == 0): ?>
                                                                                style="display: none;"
                                                                           <?php endif ?>>
                                                                                <?php echo $this->Form->input('datapagamento', array('class' => 'form-control', 'label' => 'Data do pagamento', 'minYear' => date('Y'), 'maxYear' => date('Y'), 'empty' => array('' => 'Selecione'), 'selected' => $vDespesa['Despesa']['datapagamento'])); ?>

                                                                           </div>

                                                                           <div class="col-lg-12">

                                                                                <?php echo $this->Form->input('obs', array('class' => 'form-control', 'label' => 'Observações', 'placeholder' => 'Escreva aqui o que quiser..','value' => $vDespesa['Despesa']['obs'])); ?>

                                                                           </div>


                                                                      </div>
                                                                 </div>


                                                                 <div class="modal-footer">
                                                                      <div class="row">
                                                                           <div class="col-lg-12">
                                                                                <?php echo $this->Form->submit('Editar despesa', array('class' => 'btn btn-success'));?>
                                                                           </div>
                                                                      </div>
                                                                 </div>
<?php echo $this->Form->end(); ?>

                                                                 <div class="modal-body">
<div class="row">
<div class="col-lg-12"  id="respostaDeleta<?php echo $vDespesa['Despesa']['id']; ?>">
<?php 
echo $this->Form->create('Despesa');
echo $this->Js->submit('Deletar', array(
'update' => '#respostaDeleta'.$vDespesa['Despesa']['id'],
'url' => array('controller'=>'despesas', 'action' => 'delete', $vDespesa['Despesa']['id']),
'class' => 'btn btn-block btn-xs btn-danger ',
)
);
echo $this->Js->writeBuffer(array('inline' => 'true'));
echo $this->Form->end();
?>
</div>
</div>
</div>



                                                            </div>
                                                       </div>
                                                  </div>
                                                  


                                             </td>
                                        </tr>
                                   <?php } ?>
                              </tbody>
                         </table>
                    </div>
               </div>
          </div>
     </div>


<?php endforeach ?>





</div>







<?php echo $this->Form->create('Despesa', array('url' => array('controller' => 'despesas', 'action' => 'add'))); ?>
<div class="modal fade" id="addDespesa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Cadastar nova despesa</h4>
               </div>
               <div class="modal-body">
                    <div class="row form-group">
                         <div class="col-lg-9">

                              <?php echo $this->Form->input('nome', array('class' => 'form-control', 'label' => 'Nome', 'placeholder' => 'Nome da Despesa')); ?>

                         </div>
                         <div class="col-lg-3">

                              <?php echo $this->Form->input('valor', array('type'=>'text','class' => 'form-control', 'label' => 'Valor', 'placeholder' => 'R$ 000.00')); ?>

                         </div>
                         <div class="col-lg-5">

                              <?php echo $this->Form->input('empresa_id', array('class' => 'form-control', 'label' => 'Empresa', 'options' => $empresas, 'empty' => array('' => 'Selecione'))); ?>

                         </div>
                         <div class="col-lg-7">

                              <?php echo $this->Form->input('data', array('class' => 'form-control', 'label' => 'Data da despesa', 'minYear' => date('Y'), 'maxYear' => date('Y'), 'empty' => array('' => 'Selecione'))); ?>

                         </div>

                         <div class="col-lg-6">

                              <?php echo $this->Form->input('formapagamento_id', array('class' => 'form-control', 'label' => 'Forma de pagamento', 'options' => $config->formas, 'empty' => array('' => 'Selecione'))); ?>

                         </div>
                         <div class="col-lg-6">

                              <?php echo $this->Form->input('despesatipo_id', array('class' => 'form-control', 'label' => 'Tipo da despesa', 'options' => $config->tipos, 'empty' => array('' => 'Selecione'))); ?>

                         </div>


                         <div class="col-lg-12">

                              <?php echo $this->Form->input('pago', array('class' => 'form-control', 'label' => 'Pago', 'options' => array(0 => 'Não', 1 => 'Sim'), 'id' => 'SelectPago_add', 'onchange' => "habilitaDataPago('#SelectPago_add', '#data_pagamento_add')")); ?>

                         </div>


                         <div class="col-lg-12" id="data_pagamento_add" style="display: none;">
                              <?php echo $this->Form->input('datapagamento', array('class' => 'form-control', 'label' => 'Data do pagamento', 'minYear' => date('Y'), 'maxYear' => date('Y'), 'empty' => array('' => 'Selecione'))); ?>

                         </div>

                         <div class="col-lg-12">

                              <?php echo $this->Form->input('obs', array('class' => 'form-control', 'label' => 'Observações', 'placeholder' => 'Escreva aqui o que quiser..')); ?>

                         </div>


                    </div>
               </div>

               <div class="modal-footer">
                    <div class="row">
                         <div class="col-lg-12">

                              <?php echo $this->Form->submit('Cadastrar despesa', array('class' => 'btn btn-success'));?>	
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>
<?php echo $this->Form->end(); ?>

<script type="text/javascript">
     function  habilitaDataPago(select, div){

          if ($(select).val() == 1) {
               $(div).css("display", "block");
          }else{
               $(div).css("display", "none");
          }
          
     }
</script>

