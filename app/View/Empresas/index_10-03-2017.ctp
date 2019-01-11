<div class="pull-left breadcrumb_admin clear_both">
<div class="row">
<div class="col-md-6 col-xs-12">
<div class="pull-left page_title theme_color">
<h1>Pedidos</h1>




</div>
</div>

</div>
</div>






<?php if($qtd_novos_produtos > 0){ ?>

<div class="container clear_both padding_fix">
	<div class="row">
		<div class="col-lg-12"> 
			<section class="panel default blue_title h2">
				<div class="panel-body">
				<h4>Há <?php echo $qtd_novos_produtos; ?> novos produtos para baixar:</h4>




				<?php echo $this->Form->create('Pedido', array('url' => array('controller' => 'pedidos', 'action' => 'gerar'))); ?>	
		<?php echo $this->Form->input('caio', array('class' => 'form-control campo', 'label' => false, 'type' => 'hidden')); ?>

	
		<?php echo $this->Form->submit('Gerar Novo Pedido', array('class' => 'btn-finalizar'));?>
	




				</div>
			</section>
		</div>
	</div>
</div>

<?php } ?>







<div class="container clear_both padding_fix">
<div class="row">

<div class="col-lg-12"> 
<section class="panel default blue_title h2">
<div class="panel-body">




<table class="table table-hover">
<thead>
<tr>
<th>Número</th>
<th>Interno</th>

<th>Data</th>
<th>Previsão de Entrega</th>
<th>Dias</th>
<th>Fatura</th>
<th>Qtd. de Itens</th>
<th>Total</th>



<th>Status</th>
<th>Ações</th>
</tr>
</thead>
<tbody>
<?php foreach ($pedidos as $pedido): ?>
<tr>
<td><?php echo $this->Html->link($pedido['Pedido']['id'], array('action' => 'view', $pedido['Pedido']['id']), array('target' => '_blank')) ?></td>
<td><?php echo $pedido['Pedido']['pedido_fornecedor'] ?></td>

<td align="left"><span class="<?php if ($pedido['Pedido']['data'] == date('Y-m-d')){ echo "blue_bg bg_space";} ?>"><?php echo $this->Brainme->data($pedido['Pedido']['data']) ?></span></td>
<td><?php echo $this->Brainme->data($pedido['Pedido']['data_entrega']) ?></td>
<td><?php 

$data1 = new DateTime($pedido['Pedido']['data_entrega']);
$data2 = new DateTime(date('Y-m-d'));

$diferenca = $data2->diff($data1);

?>

<?php if ($pedido['Pedido']['status'] != 3 ): ?>
	<?php if ($pedido['Pedido']['data_entrega'] > date('Y-m-d')): ?>
<span class="<?php if ($diferenca->d <= 2 AND $pedido['Pedido']['data_entrega'] > date('Y-m-d')){ echo "yellow_bg bg_space";}?>"><?php echo $diferenca->d.' dias' ?></span>
<?php elseif($pedido['Pedido']['data_entrega'] == date('Y-m-d')): ?>
<span class="blue_bg bg_space">Entregar Hoje</span>
<?php endif ?>

<?php if ($pedido['Pedido']['data_entrega'] < date('Y-m-d')): ?>
	<span class="red_bg bg_space"><?php echo $diferenca->d.' dias' ?> Atrasado</span>
<?php endif ?>


<?php else: ?>
<span class="green_bg bg_space">Coletado</span><span>dia <?php echo $this->Brainme->data($pedido['Pedido']['data_coleta']); ?></span>
<?php endif ?>



</td>
<td>
	
	<?php if ($pedido['Pedido']['faturado'] == 1): ?>
		<span class="green_bg bg_space">Faturado</span><span>dia <?php echo $this->Brainme->data($pedido['Pedido']['data_fatura']); ?></span>
	<?php else: ?>
		<span class="">Não Faturado</span>
	<?php endif ?>

</td>
<td><?php echo $pedido['Pedido']['quantidade_item'] ?></td>
<td><?php 

$total = 0;
//pr($pedido); exit;


foreach ($pedido['Produto'] as $produto) {
	$total = $total + $produto['custo'];
};

echo $this->Brainme->preco($total);

 ?></td>


<td>
	
<?php 

switch ($pedido['Pedido']['status']) {
	case '1':
		echo 'Em Produção';
	break;
	case '2':
		echo 'Pronto para Coleta - '.$pedido['Pedido']['data_pronto'];
	break;
	case '3':
		echo 'Finalizado';
	break;
}

 ?>

</td>
<td>

<a data-target="#ver_<?php echo $pedido['Pedido']['id'] ?>" data-toggle="modal"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;



</td>
</tr>
<?php endforeach ?>	

</tbody>
</table>

<?php echo $this->element('admin/paginator'); ?>


</div>
</section>
</div>
</div>
</div>




<?php foreach ($pedidos as $pedido) { ?>



<div class="modal fade" id="ver_<?php echo $pedido['Pedido']['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Pedido <?php echo $pedido['Pedido']['id'].' - '.$pedido['Fornecedor']['nome'] ?></h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-12">


					<table class="table table-hover">
<thead>
<tr>
<th>Produto</th>

</tr>
</thead>
<tbody>
<?php

$total_modal = 0;
 foreach ($pedido['Produto'] as $produto){	$total_modal = $total_modal + $produto['custo'];?>
<tr>
<td><?php echo $produto['nome'] ?></td>

</tr>
<?php } ?>	

</tbody>
</table>



					</div>
				</div>
			</div>

			<div class="modal-footer">
				<span style="float:left; margin-bottom:10px;">Total de Itens: <b><?php echo $pedido['Pedido']['quantidade_item'] ?></b> | Total do Pedido: <b><?php echo $this->Brainme->preco($total_modal) ?></b></span>
<hr>

				<span style="float:left;">
					
					<?php echo $this->Html->link('<i class="fa fa-print"></i> Imprimir', array('controller' => 'pedidos', 'action' => 'view', $pedido['Pedido']['id']), array('class' => 'btn btn-success', 'escape' => false, 'target' => '_blank')) ?>





					<?php 

					if ($pedido['Pedido']['status'] == 1) {
					echo $this->Html->link('<i class="fa fa-check-square-o"></i> Marcar como Pronto', array('controller' => 'pedidos', 'action' => 'pedido_pronto', $pedido['Pedido']['id']), array('class' => 'btn btn-success', 'escape' => false));
					}


					?>


					<?php 

					if ($pedido['Pedido']['fornecedor_id'] == 8) {
					echo $this->Html->link('<i class="fa fa-check-square-o"></i> Imprimir Etiquetas', array('controller' => 'pedidos', 'action' => 'pedidos_etq', $pedido['Pedido']['id']), array('class' => 'btn btn-success', 'escape' => false, 'target' => '_blank'));
					}


					?>



				</span>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

			</div>
			
		</div>
	</div>
</div>



<?php } ?>






