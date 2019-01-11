

<div class="pull-left breadcrumb_admin clear_both">
	<div class="row">
		<div class="col-md-6 col-xs-12">
			<div class="pull-left page_title theme_color">
				<h1>Editar Pedido</h1>
				<h2 class=""></h2>
			</div>
		</div>
		<div class="col-md-6 col-xs-12">
			<div class="pull-right">
				<ol class="breadcrumb">
					
					<li><?php echo $this->Html->link('« Voltar para a lista', array('action' => 'index')); ?></li>
				</ol>
			</div>
		</div>
	</div>
</div>




<div class="container clear_both padding_fix">
	<div class="row">
		<div class="col-lg-12"> 
			<section class="panel default blue_title h2">
				<div class="panel-body">

<?php echo $this->Form->create('Pedido', array('novalidate', 'type' => 'file')); ?>	
	<div class="row">
			<div class="col-md-6">
		<?php echo $this->Form->input('id', array('class' => 'form-control campo', 'label' => false, 'placeholder' => 'Id')); ?>
		</div>
		<div class="col-md-6">
		<?php echo $this->Form->input('fornecedor_id', array('class' => 'form-control campo', 'label' => false, 'placeholder' => 'Fornecedor')); ?>
		</div>
		<div class="col-md-6">
		<?php echo $this->Form->input('data', array('class' => 'form-control campo', 'label' => false, 'placeholder' => 'Data')); ?>
		</div>
		<div class="col-md-6">
		<?php echo $this->Form->input('data_entrega', array('class' => 'form-control campo', 'label' => false, 'placeholder' => 'Data')); ?>
		</div>
		<div class="col-md-6">
		<?php echo $this->Form->input('dias_producao', array('class' => 'form-control campo', 'label' => false, 'placeholder' => 'Dias')); ?>
		</div>
		<div class="col-md-6">
		<?php echo $this->Form->input('quantidade_item', array('class' => 'form-control campo', 'label' => false, 'placeholder' => 'Quantidade')); ?>
		</div>
	</div>
	
<div class="row">
	<div class="col-md-12">
		<?php echo $this->Form->submit('Finalizar', array('class' => 'btn-finalizar'));?>	</div>
	
</div>
<?php echo $this->Form->end(); ?>
</div>
			</section>
		</div>
	</div>
</div>








