<?php $this->layout = 'ajax'; ?>

<style>

body{font-family:Verdana; }

table, th, td {
font-size:12px !important;
    border: 1px solid silver;
    border-collapse: collapse;

}
th, td {
    padding: 5px;
}
.semborda{border: 0px; !important; text-align:center}
.logo{margin:10px;}

</style>

<table align="center" width="1000" border="0" cellpadding="5" class="semborda">
	<tr class="semborda"><td class="semborda">
			<span style="font-size: 20px; font-weight: bold;">
				<?php if($pedido['Fornecedor']['id'] != 48) { ?>
					<?php echo $pedido['Fornecedor']['nome']; ?>
				<?php }else{ ?> 
					<?php echo $pedido['Fornecedor']['nome'].' - Capital do Enxoval'; ?>
				<?php } ?>
			</span>
		</td>
	</tr>
</table>

<table align="center" width="1000" border="0" cellpadding="5">
	<tr>
		<td><b>Pedido N.:</b></td>
		<td><b>Fornecedor</b></td>
		<td><b>% Desconto</b></td>
		<td><b>Data</b></td>
		<td><b>Prev. de Entrega</b></td>
	</tr>
	<tr>
		<td><?php echo $pedido['Pedido']['id']; ?></td>
		<td><?php echo $pedido['Fornecedor']['nome']; ?></td>
		<td><?php echo $pedido['Fornecedor']['porcentagem_desconto']; ?></td>
		<td><?php echo $this->Brainme->data($pedido['Pedido']['data']); ?></td>
		<td><?php echo $this->Brainme->data($pedido['Pedido']['data_entrega']); ?></td>
	</tr>
</table>

<?php
//VERIFICAÇÃO SE EXISTE ALGUM ITEM PERSONALIZADO
$existeItemPersonalizado = false;
foreach($produtos_agrupados as $produto)
{
	if((!empty($produto['Produto']['texto_personalizado'])))
	{
		$existeItemPersonalizado = true;
	}
}
?>
<br>
<table align="center" width="1000" border="0" cellpadding="5">
	<tr>
		<td><b>Foto</b></td>
		<td><b>Código Interno</b></td>
		<td><b>QTD</b></td>
		<td><b>Já Recebidos</b></td>
		<td><b>Referência</b></td>
		<td><b>Nome</b></td>
		<?php if($existeItemPersonalizado) { ?>
			<td><b>Personalização</b></td>
		<?php } ?>
		<td><b>Cor</b></td>
		<td><b>Preço</b></td>
		<td><b>Total</b></td>
	</tr>

	<?php
	foreach($produtos_agrupados as $produto){
	//pr($produto); exit;	
	?>
		<tr>

		<?php if (empty($produto['Produto']['imagem'])): ?>
			<td></td>
		<?php else: ?>
			<?php $link_foto = explode('.', $produto['Produto']['imagem']) ?>
			<td><?php echo $this->Html->link('Foto', 'http://d40mfigxwzq6t.cloudfront.net/produtos/'.explode('.', $produto['Produto']['imagem'])[0].'-480.'.explode('.', $produto['Produto']['imagem'])[1], array('target' => '_blank')) ?></td>
			<?php endif ?>
				<td><?php echo $produto['Produto']['sku'] ?></td>
			<td><?php echo $produto['Produto']['quantidade_agrupada'] ?></td>
			<td><?php echo $produto['Produto']['quantidade_agrupada_recebidos'] ?>
				<?php if ($pedido['Pedido']['total_ja_recebido'] > 0): ?>
					
				
			<?php if ($produto['Produto']['quantidade_agrupada'] == $produto['Produto']['quantidade_agrupada_recebidos']): ?>
				&nbsp;<?php echo $this->Brainme->ativo(1); ?>
			<?php else: ?>
				&nbsp;<?php echo $this->Brainme->ativo(0); ?>
			<?php endif ?>

			<?php endif ?>

			</td>
			<?php if ($pedido['Fornecedor']['id'] == 8): ?>
			<td><?php echo $produto['Produto']['ref'] ?></td>
			<?php else: ?>
				<td><?php echo $produto['Produto']['ref'] ?></td>
			<?php endif; ?>
			<td><?php echo $produto['Produto']['nome'] ?></td>

			<?php if($existeItemPersonalizado) { ?>
				<td><?php echo (!empty($produto['Produto']['texto_personalizado'])) ? $produto['Produto']['texto_personalizado'] : '-' ?></td>
			<?php } ?>
			
			<td><?php echo $produto['Produto']['cor'] ?></td>
			<td><?php echo $this->Brainme->preco($produto['Produto']['custo']) ?> / <?php echo $this->Brainme->preco($produto['Produto']['custo_desconto']) ?></td>
			<td><?php echo $this->Brainme->preco($produto['Produto']['total']) ?></td>
		</tr>
	<?php
	}
	?>
</table>

<br>
<?php //pr($pedido); ?>
<table align="center" width="1000" border="0" cellpadding="5">
	<tr>
		<td><b>Quantidade Total:</b> <?php echo $pedido['Pedido']['quantidade_item']; ?> - <b>Já Recebidos</b> <?php echo $pedido['Pedido']['total_ja_recebido']; ?></td>
		<td><b>Total do Pedido:</b> <?php echo $this->Brainme->preco($total_pedido) ?><br>

		<b>Total do Pedido c/ desconto:</b> <?php 
												$valor = $total_pedido; // valor original
												$percentual = $pedido['Fornecedor']['porcentagem_desconto'] / 100.0; // 15%
												$valor_final = $valor - ($percentual * $valor);
												echo $this->Brainme->preco($valor_final);
											?>
		</td>
	</tr>
	<tr>
		<td>
			<div style="background: #ddd; border-color: #000; width: 100%; height: 20px;">
				<?php 
					$caio = $pedido['Pedido']['total_ja_recebido']*100/$pedido['Pedido']['quantidade_item'];
				?>

				<div style="background: green; width: <?php echo $caio ?>%; height: 20px; text-align: center; color: #fff;">
					&nbsp;<?php echo round($caio) ?>% do pedido completo
				</div>
			</div>
		</td>
	</tr>
</table>

<!--
<div class="pull-left breadcrumb_admin clear_both">
	<div class="row">
		<div class="col-md-6 col-xs-12">
			<div class="pull-left page_title theme_color">
				<h1>Detalhe Pedido</h1>
				<h2 class=""></h2>
			</div>
		</div>
		<div class="col-md-6 col-xs-12">
			<div class="pull-right">
				<ol class="breadcrumb">
							<li><?php echo $this->Html->link('Editar Pedido', array('action' => 'edit', $pedido['Pedido']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink('Deletar Pedido', array('action' => 'delete', $pedido['Pedido']['id']), null, ('Você tem certeza?')); ?> </li>
					<li>	<?php echo $this->Html->link('« Voltar para a lista', array('action' => 'index')); ?>
</li>
				</ol>
			</div>
		</div>
	</div>
</div>



<div class="container clear_both padding_fix view">
	<div class="row">
		<div class="col-lg-12"> 
			<section class="panel default blue_title h2">
				<div class="panel-body">



				<div class="col-md-12">
					<dl>
								<dt>Fornecedor:</dt>
		<dd>
			<?php echo $this->Html->link($pedido['Fornecedor']['nome'], array('controller' => 'fornecedores', 'action' => 'view', $pedido['Fornecedor']['id'])); ?>
			&nbsp;
		</dd>
		<dt>Data:</dt>
		<dd>
			<?php echo $this->Brainme->data($pedido['Pedido']['data']); ?>
			&nbsp;
		</dd>
		<dt>Data Entrega:</dt>
		<dd>
			<?php echo h($pedido['Pedido']['data_entrega']); ?>
			&nbsp;
		</dd>
		<dt>Dias Producao:</dt>
		<dd>
			<?php echo h($pedido['Pedido']['dias_producao']); ?>
			&nbsp;
		</dd>
		<dt>Quantidade Item:</dt>
		<dd>
			<?php echo h($pedido['Pedido']['quantidade_item']); ?>
			&nbsp;
		</dd>
		<dt>Criado em:</dt>
		<dd>
			<?php echo $this->Brainme->datatime($pedido['Pedido']['created']); ?>
			&nbsp;
		</dd>
		<dt>Modificado em:</dt>
		<dd>
			<?php echo $this->Brainme->datatime($pedido['Pedido']['modified']); ?>
			&nbsp;
		</dd>
					</dl>
				</div>


					
				</div>
			</section>
		</div>
	</div>
</div>
-->







