

<header class="header bg-ui-general">
<div class="header-info">
<h1 class="header-title">
<strong>Despesas</strong> Cadastradas
<small>Stylized tables to allow audience grabs the information in a glance.</small>
</h1>
<div><?php echo $this->Html->link('<i class="fa fa-plus-square"></i> Cadastrar nova despesa</span>', '#', array('data-target' => '#addDespesa', 'data-toggle' => 'modal', 'escape' => false, 'class'=>'btn btn-xs btn-success')); ?></div>
</div>

<div class="header-action">
          <nav class="nav">

          	<?php 

          	$links = array(
          		1 => 	array('Janeiro', 	'2019', 'nav-link'),
          		2 => 	array('Fevereiro', 	'2019', 'nav-link'),
          		3 => 	array('Março', 		'2019', 'nav-link'),
          		4 => 	array('Abril', 		'2019', 'nav-link'),
          		5 => 	array('Maio', 		'2019', 'nav-link'),
          		6 => 	array('Junho', 		'2019', 'nav-link'),
          		7 => 	array('Julho', 		'2019', 'nav-link'),
          		8 => 	array('Agosto', 	'2019', 'nav-link'),
          		9 => 	array('Setembro', 	'2019', 'nav-link'),
          		10 => 	array('Outubro', 	'2019', 'nav-link'),
          		11 => 	array('Novembro', 	'2019', 'nav-link'),
          		12 => 	array('Dezembro', 	'2019', 'nav-link'),
          	);

          	foreach ($links as $kLinks => $vLinks) {
          		if (($ano == $vLinks[1]) AND $mes == $kLinks) {
          			$links[$kLinks][2] = 'nav-link active';
          		}
          	}
          	 ?>

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

<div class="col-md-12">
<div class="card">
<!-- <h4 class="card-title"><strong>Hover</strong></h4> -->

<div class="card-body">
<!-- <p><code class="code-bold">.table-hover</code> applies to <em>.table</em></p> -->
<table class="table table-hover">
<thead>
<tr>
<th width="100"><?php echo $this->Paginator->sort('id','ID'); ?></th>
<th><?php echo $this->Paginator->sort('data','Nome'); ?></th>
<th><?php echo $this->Paginator->sort('created','Criado em'); ?></th>


<th style="text-align: right;">Detalhes</th>
</tr>
</thead>
<tbody>
<?php foreach ($despesas as $kDespesa => $vDespesa) { ?>
<tr>
<td><?php echo $vDespesa['Despesa']['id'] ?></td>	
<td><?php echo $vDespesa['Despesa']['nome'] ?></td>
<td><?php echo $this->Brainme->datatime($vDespesa['Despesa']['created']) ?></td>




<td style="text-align: right;">




<?php echo $this->Html->link('<i class="fa fa-eye"></i></span>', '#', array('data-target' => '#despesa_'.$vDespesa['Despesa']['id'], 'data-toggle' => 'modal', 'escape' => false, 'class'=>'btn btn-xs btn-secondary')); ?>

</td>







</tr>
<?php } ?>
</tbody>
</table>


<?php echo $this->element('paginator'); ?>


</div>
</div>
</div>

</div>
</div>



<?php foreach ($despesas as $kDespesa => $vDespesa) { ?>

<?php echo $this->Form->create('Despesa', array('url' => array('controller' => 'despesas', 'action' => 'edit'))); ?>

<?php echo $this->Form->input('id', array('type' => 'hidden', 'value' => $vDespesa['Despesa']['id'])); ?>



<div class="modal fade" id="despesa_<?php echo $vDespesa['Despesa']['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title" id="myModalLabel">Editar despesa: <?php echo $vDespesa['Despesa']['nome'] ?></h4>
</div>
<div class="modal-body">
<div class="row">
<div class="col-lg-12">

<?php echo $this->Form->input('nome', array('class' => 'form-control', 'label' => 'Nome', 'value' => $vDespesa['Despesa']['nome'])); ?>

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
</div>
</div>
</div>

<?php echo $this->Form->end(); ?>
<?php } ?>

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

<?php echo $this->Form->input('nome', array('class' => 'form-control', 'label' => 'Nome')); ?>

</div>
<div class="col-lg-3">

<?php echo $this->Form->input('valor', array('type'=>'text','class' => 'form-control', 'label' => 'Valor')); ?>

</div>
<div class="col-lg-5">

<?php echo $this->Form->input('empresa_id', array('class' => 'form-control', 'label' => 'Empresa', 'options' => $empresas, 'empty' => array('' => 'Selecione'))); ?>

</div>
<div class="col-lg-7">

<?php echo $this->Form->input('data', array('class' => 'form-control', 'label' => 'Data da despesa', 'minYear' => date('Y'), 'maxYear' => date('Y') + 1, 'empty' => array('' => 'Selecione'))); ?>

</div>

<div class="col-lg-6">

<?php echo $this->Form->input('formapagamento_id', array('class' => 'form-control', 'label' => 'Forma de pagamento', 'options' => $config->formas, 'empty' => array('' => 'Selecione'))); ?>

</div>
<div class="col-lg-6">

<?php echo $this->Form->input('despesatipo_id', array('class' => 'form-control', 'label' => 'Tipo da despesa', 'options' => $config->tipos, 'empty' => array('' => 'Selecione'))); ?>

</div>


<div class="col-lg-12">

<?php echo $this->Form->input('pago', array('class' => 'form-control', 'label' => 'Pago', 'options' => array(0 => 'Não', 1 => 'Sim'))); ?>

</div>


<div class="col-lg-12">
<?php echo $this->Form->input('datapagamento', array('class' => 'form-control', 'label' => 'Data do pagamento', 'minYear' => date('Y'), 'maxYear' => date('Y') + 1)); ?>

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

