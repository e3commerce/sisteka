<div class="main-content">


	<div class="row">

		<div class="col-md-12">
			<div class="row">

				<div class="col-md-12"><h2 style="border-bottom: 1px dashed #ccc;">Despesas</h2></div>

				<div class="col-lg-6">
					<div class="card card-body">
						<h9>
							<span class="text-uppercase"><b>Pagamento em atraso</b></span>
						</h9>
						<br>
						<p class="fs-20 fw-100">
							<?php $totalDespesa = 0; foreach ($despesas['emAtraso'] as $kDesepsa => $vDespesa){$totalDespesa += $vDespesa['Despesa']['valor'];}?>
							<b><?php echo $this->Brainme->preco($totalDespesa); ?></b>
						</p>
						<div class="progress">
							<div class="progress-bar bg-danger" role="progressbar" style="width: 100%; height: 4px;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
						</div>

						<?php if (count($despesas['emAtraso']) == 0): ?>
							<table class="table table-hover">
								<thead>
									<tr>
										<th>#</th>
									</thead>
									<tbody>
										<tr>
											<td>
												<b>Nenhuma despesa atrasada</b>
											</td>
										</tr>
									</tbody>
								</table>
								<?php else: ?>



									<table class="table table-hover">
										<thead>
											<tr>
												<th width="10">#</th>
												<th width="100">Data</th>
												<th>Nome</th>
												<th>Valor</th>
												<th>Forma</th>
												<th style="text-align: right;">Empresa</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($despesas['emAtraso']as $kDesepsa => $vDespesa): ?>
												<tr>
													<th><?php echo $vDespesa['Despesa']['id'] ?></th>
													<td><?php echo $this->Brainme->data($vDespesa['Despesa']['data']) ?></td>
													<td><?php echo $vDespesa['Despesa']['nome'] ?></td>
													<td><?php echo $this->Brainme->preco($vDespesa['Despesa']['valor']) ?></td>
													<td><?php echo $config['Despesa']->formas[$vDespesa['Despesa']['formapagamento_id']] ?></td>
													<td style="text-align: right;"><?php echo $empresas[$vDespesa['Despesa']['empresa_id']] ?></td>
												</tr>
											<?php endforeach ?>
										</tbody>
									</table>

								<?php endif ?>
							</div>


						</div>
						<div class="col-lg-6">
							<div class="card card-body">
								<h9>
									<span class="text-uppercase"><b>Pagamentos para hoje</b></span>
								</h9>
								<br>
								<p class="fs-20 fw-100">
									<?php $totalDespesa = 0; foreach ($despesas['paraHoje'] as $kDesepsa => $vDespesa){$totalDespesa += $vDespesa['Despesa']['valor'];}?>
									<b><?php echo $this->Brainme->preco($totalDespesa); ?></b>
								</p>
								<div class="progress">
									<div class="progress-bar bg-info" role="progressbar" style="width: 100%; height: 4px;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
								<?php if (count($despesas['paraHoje']) == 0): ?>
									<table class="table table-hover">
										<thead>
											<tr>
												<th>#</th>
											</thead>
											<tbody>
												<tr>
													<td>
														<b>Nenhuma despesa para hoje</b>
													</td>
												</tr>
											</tbody>
										</table>
									<?php else: ?>
									<table class="table table-hover">
										<thead>
											<tr>
												<th>#</th>
												<th>Data</th>
												<th>Nome</th>
												<th>Valor</th>
												<th>Forma</th>
												<th style="text-align: right;">Empresa</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($despesas['paraHoje'] as $kDesepsa => $vDespesa): ?>
												<tr>
													<th><?php echo $vDespesa['Despesa']['id'] ?></th>
													<td><?php echo $this->Brainme->data($vDespesa['Despesa']['data']) ?></td>
													<td><?php echo $vDespesa['Despesa']['nome'] ?></td>
													<td><?php echo $this->Brainme->preco($vDespesa['Despesa']['valor']) ?></td>
													<td><?php echo $config['Despesa']->formas[$vDespesa['Despesa']['formapagamento_id']] ?></td>
													<td style="text-align: right;"><?php echo $empresas[$vDespesa['Despesa']['empresa_id']] ?></td>
												</tr>
											<?php endforeach ?>
										</tbody>
									</table>
									<?php endif ?>
								</div>

							</div>
							<div class="col-lg-12">
								<div class="card card-body">
									<h9>
										<span class="text-uppercase"><b>Próximas despesas (10 dias)</b></span>
									</h9>
									<br>
									<p class="fs-20 fw-100">
										<?php $totalDespesa = 0; foreach ($despesas['Futuras'] as $kDesepsa => $vDespesa){$totalDespesa += $vDespesa['Despesa']['valor'];}?>
										<b><?php echo $this->Brainme->preco($totalDespesa); ?></b>
									</p>
									<div class="progress">
										<div class="progress-bar bg-success" role="progressbar" style="width: 100%; height: 4px;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
									</div>

									<?php if (count($despesas['Futuras']) == 0): ?>
										<table class="table table-hover">
											<thead>
												<tr>
													<th>#</th>
												</thead>
												<tbody>
													<tr>
														<td>
															<b>Nenhuma despesa futura</b>
														</td>
													</tr>
												</tbody>
											</table>
										<?php else: ?>



										<table class="table table-hover">
											<thead>
												<tr>
													<th>#</th>
													<th>Data</th>
													<th>Nome</th>
													<th>Valor</th>
													<th>Forma</th>
													<th style="text-align: right;">Empresa</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach ($despesas['Futuras']as $kDesepsa => $vDespesa): ?>
													<tr>
														<th><?php echo $vDespesa['Despesa']['id'] ?></th>
														<td><?php echo $this->Brainme->data($vDespesa['Despesa']['data']) ?></td>
														<td><?php echo $vDespesa['Despesa']['nome'] ?></td>
														<td><?php echo $this->Brainme->preco($vDespesa['Despesa']['valor']) ?></td>
														<td><?php echo $config['Despesa']->formas[$vDespesa['Despesa']['formapagamento_id']] ?></td>
														<td style="text-align: right;"><?php echo $empresas[$vDespesa['Despesa']['empresa_id']] ?></td>
													</tr>
												<?php endforeach ?>
											</tbody>
										</table>
										<?php endif ?>
									</div>

								</div>
							</div>
						</div>
					</div>
				</div>

