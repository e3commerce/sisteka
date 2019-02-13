

<header class="header bg-ui-general">
	<div class="header-info">
		<h1 class="header-title">
			<strong>Empresas</strong> Cadastradas
			<small>Página de Administração das Empresas</small>
		</h1>
		<div><?php echo $this->Html->link('<i class="fa fa-plus-square"></i> Cadastrar nova empresa</span>', '#', array('data-target' => '#addEmpresa', 'data-toggle' => 'modal', 'escape' => false, 'class'=>'btn btn-xs btn-success')); ?></div>
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
							<?php foreach ($empresas as $kEmpresa => $vEmpresa) { ?>
								<tr>
									<td><?php echo $vEmpresa['Empresa']['id'] ?></td>	
									<td><?php echo $vEmpresa['Empresa']['nome'] ?></td>
									<td><?php echo $this->Brainme->datatime($vEmpresa['Empresa']['created']) ?></td>




									<td style="text-align: right;">




										<?php echo $this->Html->link('<i class="fa fa-eye"></i></span>', '#', array('data-target' => '#empresa_'.$vEmpresa['Empresa']['id'], 'data-toggle' => 'modal', 'escape' => false, 'class'=>'btn btn-xs btn-secondary')); ?>

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



<?php foreach ($empresas as $kEmpresa => $vEmpresa) { ?>

	



	<div class="modal fade" id="empresa_<?php echo $vEmpresa['Empresa']['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">

				<?php echo $this->Form->create('Empresa', array('url' => array('controller' => 'empresas', 'action' => 'edit'))); ?>

	<?php echo $this->Form->input('id', array('type' => 'hidden', 'value' => $vEmpresa['Empresa']['id'])); ?>


				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Editar empresa: <?php echo $vEmpresa['Empresa']['nome'] ?></h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-12">

							<?php echo $this->Form->input('nome', array('class' => 'form-control campo', 'label' => 'Nome', 'placeholder' => 'Nome da empresa', 'value' => $vEmpresa['Empresa']['nome'])); ?>

						</div>
					</div>
				</div>

				<div class="modal-footer">
					<div class="row">
						<div class="col-lg-12">
							
							<?php echo $this->Form->submit('Editar empresa', array('class' => 'btn btn-success'));?>
						</div>
					</div>
				</div>

				<?php echo $this->Form->end(); ?>
<div class="modal-body">
<div class="row">




<div class="col-lg-12"  id="respostaDeleta<?php echo $vEmpresa['Empresa']['id']; ?>">



<?php 
echo $this->Form->create('Empresa');
echo $this->Js->submit('Deletar', array(
'update' => '#respostaDeleta'.$vEmpresa['Empresa']['id'],
'url' => array('controller'=>'empresas', 'action' => 'delete', $vEmpresa['Empresa']['id']),
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

	
<?php } ?>

<?php echo $this->Form->create('Empresa', array('url' => array('controller' => 'empresas', 'action' => 'add'))); ?>
<div class="modal fade" id="addEmpresa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Cadastar nova empresa</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-12">

							<?php echo $this->Form->input('nome', array('class' => 'form-control campo', 'label' => 'Nome', 'placeholder' => 'Nome da empresa')); ?>
							
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<div class="row">
						<div class="col-lg-12">
							
							<?php echo $this->Form->submit('Cadastrar empresa', array('class' => 'btn btn-success'));?>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php echo $this->Form->end(); ?>

