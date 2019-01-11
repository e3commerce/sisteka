

<header class="header bg-ui-general">
	<div class="header-info">
		<h1 class="header-title">
			<strong>Empresas</strong> Cadastradas
			<small>Stylized tables to allow audience grabs the information in a glance.</small>
		</h1>
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


								<th style="text-align: right;">Detalhes</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($empresas as $kEmpresa => $vEmpresa) { ?>
								<tr>
									<td><?php echo $vEmpresa['Empresa']['id'] ?></td>	
									<td><?php echo $vEmpresa['Empresa']['nome'] ?></td>




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

	<?php echo $this->Form->create('Empresa', array('url' => array('controller' => 'empresas', 'action' => 'edit'))); ?>

	<?php echo $this->Form->input('id', array('type' => 'hidden', 'value' => $vEmpresa['Empresa']['id'])); ?>
		


	<div class="modal fade" id="empresa_<?php echo $vEmpresa['Empresa']['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel"><?php echo $vEmpresa['Empresa']['nome'] ?></h4>
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
							
		<?php echo $this->Form->submit('Finalizar', array('class' => 'btn-finalizar'));?>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php echo $this->Form->end(); ?>
<?php } ?>


