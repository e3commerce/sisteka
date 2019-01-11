
<div class="pull-left breadcrumb_admin clear_both">
	<div class="row">
		<div class="col-md-6 col-xs-12">
			<div class="pull-left page_title theme_color">
				<h1><?php echo 'Pedidos'; ?></h1>
				<h2 class=""></h2>
			</div>
		</div>
		<div class="col-md-6 col-xs-12">
			<div class="pull-right">
				<ol class="breadcrumb">

				</ol>
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
						<th><?php echo $this->Paginator->sort('id', 'Número do Pedido'); ?></th>
						<th>Status</th>
<th><?php echo $this->Paginator->sort('data', 'Data Pedido'); ?></th>
<th><?php echo $this->Paginator->sort('data_entrega', 'Previsão de Entrega'); ?></th>
<th><?php echo $this->Paginator->sort('quantidade_item', 'Quantidade de Itens'); ?></th>
						<?php echo $this->element('admin/index-acoes-titulo'); ?>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($pedidos as $pedido): ?>
					<tr>
						<td><?php echo $pedido['Pedido']['id']; ?></td>
						<td><?php echo $this->Brainme->status_pedido($pedido['Pedido']['status']); ?></td>
<td><?php echo $this->Brainme->data($pedido['Pedido']['data']); ?>&nbsp;</td>
<td><?php echo $this->Brainme->data($pedido['Pedido']['data_entrega']); ?>


<?php 

$data1 = new DateTime($pedido['Pedido']['data_entrega']);
$data2 = new DateTime(date('Y-m-d'));

$diferenca = $data2->diff($data1);

//pr($diferenca); exit;

echo ' - Daqui '.$diferenca->d.' dias';

?>

</td>
<td><?php echo h($pedido['Pedido']['quantidade_item']); ?>&nbsp;</td>
<td>

<?php echo $this->Html->link('Imprimir', array('controller' => 'pedidos', 'action' => 'view', $pedido['Pedido']['id']), array('target' => '_blank')); ?>&nbsp; - &nbsp;

<?php echo $this->Html->link('Pedido Pronto', array('controller' => 'pedidos', 'action' => 'pedido_pronto', $pedido['Pedido']['id'])); ?>&nbsp;</td>
						
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






