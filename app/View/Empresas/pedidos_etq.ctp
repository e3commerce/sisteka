<?php
echo $this->Html->script('admin/bytescoutbarcode128_1.00.07');
$this->layout = 'ajax'; 
?>

<style type="text/css">
	.container{width: 480px; height: 290px; border: 0px dashed #ccc; font-family: 'Verdana'; margin: 0 auto;  font-size: 15px; border: 0px solid #000; margin-bottom: 10px; page-break-after: always;}
	.logo{width: 100%; text-align: center; margin-top: 25px;}
	.separador{width: 100%; margin-top:2px; margin-bottom: 12px; text-align: center;}

	.nome{font-size: 20px; font-style: italic; font-weight: bold; width: 94%; margin-left: 3%; text-align: center; margin-bottom: 10px;}
	.sku{font-size: 45px; font-style: italic; font-weight: bold; width: 100%;  text-align: center;}
	.coluna{width: 50%; position: relative; float: left; text-align: center; font-size: 10px;}

	.itens{font-size: 19px; font-style: italic; font-weight: normal; width: 100%; text-align: center; padding-top: 10px;}
	.site{font-size: 25px; font-style: italic; font-weight: lighter; width: 100%; text-align: center; letter-spacing: 2px;}
	.acesse{font-size: 15px; font-style: italic; font-weight: bold; width: 100%;  text-align: center;}
	img{width: 100%;}
</style>

<body>


<?php if ($tipo == 'todas'): ?>
	


<div id="idTeste" class="container">
<div style="width: 480px; height: 50px; font-size: 18px; line-height: 17px; float: left; text-align: left; font-weight: normal; font-style: italic; letter-spacing: 0;">
Fornecedor:<br>
<b><?php echo $pedido['Fornecedor']['nome'] ?></b>
<br>
<br>
Pedido:<br>
<b><?php echo $pedido['Pedido']['id'] ?></b>
<br>
<br>
Data:<br>
<b><?php echo $this->Brainme->data($pedido['Pedido']['data']) ?></b>
<br>
<br>
Data Prometida de Entrega:<br>
<b><?php echo $this->Brainme->data($pedido['Pedido']['data_entrega']) ?></b>
<br>
<br>
Quantidade de Itens:<br>
<b><?php echo $pedido['Pedido']['quantidade_item'] ?></b>
<br>
<br>
</div>
</div>


<?php else: ?>



	<div id="idTeste" class="container">
<div style="width: 480px; height: 50px; font-size: 18px; line-height: 17px; float: left; text-align: left; font-weight: normal; font-style: italic; letter-spacing: 0;">

<br>
<br>
<font style="font-size: 40px; font-weight: bold;">ETIQUETA ÚNICA</font>
<br>
<br>


Venda Id:<br>
<b><?php echo $unica ?></b>
<br>
<br>
Fornecedor:<br>
<b><?php echo $pedido['Fornecedor']['nome'] ?></b>
<br>
<br>
Pedido:<br>
<b><?php echo $pedido['Pedido']['id'] ?></b>



</div>
</div>


<?php endif ?>


<?php foreach ($produtos_pedido as $key => $value) { ?>
<script type="text/javascript">
function <?php echo 'function'.$key; ?>(codigo) 
{
	var barcode = new bytescoutbarcode128();
	var value = codigo;


	barcode.valueSet(value);
	barcode.setMargins(0, 0, 0, 0);
	barcode.setBarWidth(5);


	var width = barcode.getMinWidth();

	barcode.setSize(width, 100);

	var <?php echo 'img'.$key; ?> = document.getElementById('<?php echo 'img'.$key; ?>');
	<?php echo 'img'.$key; ?>.src = barcode.exportToBase64(width,60, 0);
}

function <?php echo 'functionsku'.$key; ?>(codigosku) 
{
	var barcodesku = new bytescoutbarcode128();
	var valuesku = codigosku;

	// alert(parseInt(valuesku));

	barcodesku.valueSet(codigosku);
	barcodesku.setMargins(0, 0, 0, 0);
	barcodesku.setBarWidth(4);

	var width = barcodesku.getMinWidth();

	barcodesku.setSize(width, 90);

	var <?php echo 'imgsku'.$key; ?> = document.getElementById('<?php echo 'imgsku'.$key; ?>');
	<?php echo 'imgsku'.$key; ?>.src = barcodesku.exportToBase64(width,60, 0);


}


</script>


<style type="text/css">
	
.etq_linha_padrao{width: 440px;float: left; text-align: center; font-style: italic; letter-spacing: 0; border: 0px solid #000;}

</style>


<div id="idTeste" class="container">


<div style="width: 480px; height: 150px;  float: left;">
<?php if ($value['Produto']['cor'] == 'Tipo 2'): ?>
	

<div style="" class="etq_linha_padrao">
<?php echo $this->Html->image('preto.png', array('style' => 'width100%; height:15px;')) ?>
	
</div>
<?php endif ?>

<div style="font-size: 26px; line-height: 25px; font-weight: bold; " class="etq_linha_padrao">
<?php echo substr($value['Produto']['ref'], 0, 80); ?>
	
</div>

<div style="font-size: 18px;" class="etq_linha_padrao">
	Tipo: <b><?php echo $value['Produto']['cor']; ?></b>
</div>


<div style="font-size: 15px;" class="etq_linha_padrao">
	<b><?php echo substr($value['Produto']['nome'], 0, 80); ?></b>
</div>


<div style="font-size: 15px;" class="etq_linha_padrao">
	-<br>

	ID: <b><?php echo $value['Produto']['id'] ?></b> / Pedido: <b><?php echo $value['Produto']['pedido_id']; ?></b>


</div>

<div style="font-size: 22px;" class="etq_linha_padrao">
	<img id="<?php echo 'img'.$key; ?>"/>
</div>

<div style="font-size: 50px;" class="etq_linha_padrao">
	SKU: <b><?php echo $value['Produto']['sku']; ?></b>
</div>

<div style="font-size: 22px;" class="etq_linha_padrao">
	<img id="<?php echo 'imgsku'.$key; ?>"/>
</div>








</div>

</div>














<script>
	<?php echo 'function'.$key; ?>('ID<?php echo $value["Produto"]["id"]; ?>');
	<?php echo 'functionsku'.$key; ?>('SKU<?php echo $value["Produto"]["sku"]; ?>');
</script>

<?php } ?>
</body>
