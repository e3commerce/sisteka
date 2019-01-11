<div class="card">

<div class="card-body">

<div class="row">



<div class="col-md-6">

<div class="callout callout-info" role="alert">
<h5>Data: <?php echo $this->Brainme->data($fechamento['Fechamento']['fim']); ?></h5>
<?php if (!empty($fechamento['Fechamento']['arquivo_fornecedor'])): ?>
<p><a href="http://s3-sa-east-1.amazonaws.com/brainme-images/fechamentos/<?php echo $fechamento['Fechamento']['arquivo_fornecedor']; ?>" target="_blank">Clique aqui</a> para baixar o aqruivo.</p>
<?php else: ?>
<p>-</p>
<?php endif ?>

</div>

</div>

<div class="col-md-6">


<div class="callout callout-success" role="alert">
<h5>Total: <?php echo $this->Brainme->preco($fechamento['Fechamento']['total_fornecedor']); ?></h5>
<p>Ciclo: <b><?php echo $this->Brainme->data($fechamento['Fechamento']['inicio']).' - '.$this->Brainme->data($fechamento['Fechamento']['fim']); ?></b></p>
</div>



</div>

<?php if (!empty($fechamento['Fechamento']['observacoes'])): ?>


<div class="col-md-12">

<div class="callout callout-warning" role="alert">
<h5>Observação:</h5>
<p><?php echo $fechamento['Fechamento']['observacoes']; ?></p>
</div>



</div>

<?php endif ?>


<?php if (count($fechamento['Pagamento']) > 0): ?>



<div class="col-md-12">

<strong>Pagamentos</strong>


<table class="table table-separated" style="border-top: #eee 1px solid;">
<thead>
<tr>
<th>Data</th>
<th>Valor</th>
<th>Forma</th>
<th>Destino</th>
<th style="text-align: center;">Realizado</th>
<th style="text-align: right;">Comprovante</th>
</tr>
</thead>
<tbody>

<?php foreach ($fechamento['Pagamento'] as $key => $pagamento): ?>


<tr class="bl-3 border-primary bg-pale-info">
<th><?php echo $this->Brainme->data($pagamento['data']); ?></th>
<th><?php echo $this->Brainme->preco($pagamento['total']); ?></th>
<th><?php echo $pagamento['forma']; ?></th>
<th><?php echo $pagamento['destino']; ?></th>
<th style="text-align: center;"><?php echo $this->Brainme->ativo($pagamento['pago']); ?></th>
<th style="text-align: right;">
<?php if (!empty($pagamento['comprovante'])): ?>

<a href="http://s3-sa-east-1.amazonaws.com/brainme-images/fechamentos/<?php echo $pagamento['comprovante']; ?>" class="btn btn-w-xs btn-xs btn btn-secondary bg-lightest" target="_blank">Baixar</a>


<!-- <button class="btn btn-w-xs btn-xs btn-outline btn-secondary">Baixar</button> -->
<?php else: ?>
Não disponível.
<?php endif ?>


</th>
</tr>

<?php endforeach ?>
</tbody>
</table>


</div>

<?php endif ?>


</div>


</div>


</div>