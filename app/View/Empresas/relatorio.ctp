<?php echo $this->Form->input('link_base_pagina_fornecedor',array('type'=>'hidden','id'=>'link_base_pagina_fornecedor','value'=>$_SERVER['SERVER_NAME'])); ?>
<?php echo $this->Form->input('id_pagina_fornecedor',array('type'=>'hidden','id'=>'id_pagina_fornecedor','value'=>$userData['fornecedor_id'])); ?>
<?php
foreach ($pedido as $kPedido => $vPedido) 
{
	$pedido[$kPedido]['Pedido']['quantidade_coletada'] = 0;
	$pedido[$kPedido]['Pedido']['total'] = 0.00;
	foreach ($vPedido['Produto'] as $kProd => $vProd) 
	{
		if($vProd['status'] == 3) $pedido[$kPedido]['Pedido']['quantidade_coletada']++;

		$pedido[$kPedido]['Pedido']['total'] += $vProd['custo'];
	}
}

$statuPedido['1'] = 'Em Produção';
$statuPedido['2'] = 'Pronto para Coleta';
$statuPedido['3'] = 'Finalizado';
?>
<div class="pull-left breadcrumb_admin clear_both">
	<div class="row">
		<div class="col-md-6 col-xs-12">
			<div class="pull-left page_title theme_color">
				<h1>Relatório de Pedidos</h1>
				<h2 class=""></h2>
			</div>
		</div>
	</div>
</div>

<div class="container clear_both padding_fix view">
	<div class="row">
		<div class="col-lg-12"> 
			<section class="panel default blue_title h2">
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12"> 
							<b>Filtros:</b>
							<?php $btnTodos = ($filtro == 'todos') ? 'success' : 'primary'; ?>
							<?php $btnFaturado = ($filtro == 'faturado') ? 'success' : 'primary'; ?>
							<?php $btnNaoFaturado = ($filtro == 'nfaturado') ? 'success' : 'primary'; ?>
							<?php $btnNaoColetados = ($filtro == 'ncoletado') ? 'success' : 'primary'; ?>
							<span class="btnStatus btn btn-sm btn-<?php echo $btnTodos; ?>" onclick="status('todos')">Todos</span>
							<span class="btnStatus btn btn-sm btn-<?php echo $btnFaturado; ?>" onclick="status('faturado')">Faturados</span>
							<span class="btnStatus btn btn-sm btn-<?php echo $btnNaoFaturado; ?>" onclick="status('nfaturado')">Não Faturados</span>
							<span class="btnStatus btn btn-sm btn-<?php echo $btnNaoColetados; ?>" onclick="status('ncoletado')">Não Coletados</span>
						</div>
					</div>
					<script>
					function status(statu)
					{
						window.location = 'http://'+$('#link_base_pagina_fornecedor').val()+'/fornecedor/admin/pedidos/relatorio/'+(statu);
					}
					</script>
					<div class="row">
						<table class="table table-hover">
							<thead>
								<tr>
									<th style="text-align:center;"><?php echo $this->Paginator->sort('id','Pedido'); ?></th>
									<th style="text-align:center;"><?php echo $this->Paginator->sort('pedido_fornecedor','Pedido Fornecedor'); ?></th>
									<th style="text-align:center;"><?php echo $this->Paginator->sort('data','Data do Pedido'); ?></th>
									<th style="text-align:center;"><?php echo $this->Paginator->sort('data_entrega','Data Prevista'); ?></th>
									<th style="text-align:center;"><?php echo $this->Paginator->sort('data_coleta','Data de Coleta'); ?></th>
									<th style="text-align:center;"><?php echo $this->Paginator->sort('data_fatura','Data de Fatura'); ?></th>
									<th style="text-align:center;"><?php echo $this->Paginator->sort('data_pronto','Data Pronto'); ?></th>
									<th style="text-align:center;"><?php echo $this->Paginator->sort('quantidade_item','Quantidade De Itens'); ?></th>
									<th style="text-align:center;">Itens Coletados</th>
									<th style="text-align:center;">Total</th>
									<th style="text-align:center;">Status</th>
									<th style="text-align:center;">Faturado</th>
									<th style="text-align:center;">Observações</th>
									<th style="text-align:center;">Produtos</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($pedido as $kPedido => $vPedido) { ?>
									<tr>
										<td style="text-align:center;"><?php echo $this->Html->link($vPedido['Pedido']['id'], array('controller'=>'pedidos','action' => 'view',$vPedido['Pedido']['id']),array('target'=>'_blank')); ?></td>
										<td style="text-align:center;"><?php echo (!empty($vPedido['Pedido']['pedido_fornecedor'])) ? $vPedido['Pedido']['pedido_fornecedor'] : 'Não Informado'; ?></td>
										<td style="text-align:center;"><?php echo $this->Brainme->data($vPedido['Pedido']['data']); ?></td>
										<td style="text-align:center;"><?php echo ($vPedido['Pedido']['data_entrega'] != '0000-00-00') ? $this->Brainme->data($vPedido['Pedido']['data_entrega']) : 'Não Entregue'; ?></td>

										<td style="text-align:center;"><?php echo ($vPedido['Pedido']['data_coleta'] != '0000-00-00') ? $this->Brainme->data($vPedido['Pedido']['data_coleta']) : 'Não Coletado'; ?></td>

										<td style="text-align:center;"><?php echo ($vPedido['Pedido']['data_fatura'] != '0000-00-00') ? $this->Brainme->data($vPedido['Pedido']['data_fatura']) : 'Não Faturado'; ?></td>
										<td style="text-align:center;"><?php echo ($vPedido['Pedido']['data_pronto'] != '0000-00-00') ? $this->Brainme->data($vPedido['Pedido']['data_pronto']) : 'Não está Pronto'; ?></td>

										<td style="text-align:center;"><?php echo $vPedido['Pedido']['quantidade_item']; ?></td>
										<td style="text-align:center;"><?php echo $vPedido['Pedido']['quantidade_coletada']; ?></td>
										<td style="text-align:center;"><?php echo 'R$ '.number_format($vPedido['Pedido']['total'],2,',',''); ?></td>
										<td style="text-align:center;">
											<?php if($vPedido['Pedido']['status'] != 3) { 
												echo '<span class="btn btn-sm btn-info">'.$statuPedido[$vPedido['Pedido']['status']].'</span>';
											 }else{
											 	echo '<span class="btn btn-sm btn-success">'.$statuPedido[$vPedido['Pedido']['status']].'</span>';
											 }
											?>
										</td>
										<td style="text-align:center;"><?php echo $this->Brainme->ativo($vPedido['Pedido']['faturado']); ?></td>
										<td style="text-align:center;">
											<?php 
												if(empty($vPedido['Pedido']['observacao'])) 
													echo '-'; 
												else 
													 echo $this->Html->link('<i class="fa fa-eye"></i>', '#', array('data-target' => '#observacoes_'.$vPedido['Pedido']['id'], 'data-toggle' => 'modal', 'escape'=>false));
											?>
										</td>
										<td style="text-align:center;"><?php echo $this->Html->link('<i class="fa fa-eye"></i>', '#', array('data-target' => '#produtos_'.$vPedido['Pedido']['id'], 'data-toggle' => 'modal', 'escape'=>false)); ?></td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
						<?php echo $this->element('admin/paginator'); ?>
					</div>
				</div>
			</section>
		</div>
	</div>
</div>

<?php
$statusProduto[1] = 'Solicitado';
$statusProduto[2] = 'Pronto Para a Coleta';
$statusProduto[3] = 'Coletado';

$produtoAtivo[1] = 0;
$produtoAtivo[2] = 0;
$produtoAtivo[3] = 1;
?>
<?php foreach ($pedido as $kPedido => $vPedido) { ?>
<div class="modal fade" id="observacoes_<?php echo $vPedido['Pedido']['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Pedido <?php echo $vPedido['Pedido']['id'] ?></h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-12">
						<table class="table table-hover">
							<thead>
								<tr>
									<th style="text-align: center;">Observações:</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td style="text-align: left;"><?php echo h($vPedido['Pedido']['observacao']); ?></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="produtos_<?php echo $vPedido['Pedido']['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" style="width:1000px;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Pedido <?php echo $vPedido['Pedido']['id'] ?></h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-12">
						<table class="table table-hover">
							<thead>
								<tr>
									<th style="text-align:center;">Coletado</th>
									<th style="text-align:center;">Status</th>
									<th style="text-align:center;">Produto</th>
									<th style="text-align:center;">SKU</th>
									<th style="text-align:center;">Data do Pedido</th>
									<th style="text-align:center;">Data Prevista</th>
									<th style="text-align:center;">Data Coletado</th>
									<th style="text-align:center;">Custo</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($vPedido['Produto'] as $key => $value) { ?>
									<tr>
										<td style="text-align:center;"><?php echo $this->Brainme->ativo($produtoAtivo[$value['status']]); ?></td>
										<td style="text-align:center;"><?php echo $statusProduto[$value['status']]; ?></td>
										<td style="text-align:center;"><?php echo $value['nome']; ?></td>
										<td style="text-align:center;"><?php echo $value['sku']; ?></td>
										<td style="text-align:center;"><?php echo $this->Brainme->datatime($value['created']); ?></td>
										<td style="text-align:center;"><?php echo $this->Brainme->data($value['previsao_entrega']); ?></td>
										<td style="text-align:center;"><?php echo ($value['data_coletado'] != '0000-00-00 00:00:00')?$this->Brainme->datatime($value['data_coletado']):'Não Coletado'; ?></td>
										<td style="text-align:center;"><?php echo 'R$ '.number_format($value['custo'],2,',',''); ?></td>
									</tr>
								<?php } ?>
							</tbody>
							<tfoot>
								<tr>
									<td colspan="8" style="text-align: right;">Total: <b><?php echo 'R$ '.number_format($vPedido['Pedido']['total'],2,',',''); ?></b></td>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php } ?>