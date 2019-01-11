<?php
echo $this->Html->script('admin/bytescoutbarcode128_1.00.07');
$this->layout = 'ajax'; 
?>

<style type="text/css">
	.container{width: 440px; border: 0px dashed #ccc; font-family: 'Verdana'; margin: 0 auto; height: 100px;  font-size: 15px; border: 1px solid #ccc;}
	.logo{width: 100%; text-align: center; margin-top: 25px;}
	.separador{width: 100%; margin-top:2px; margin-bottom: 12px; text-align: center;}

	.nome{font-size: 25px; font-style: italic; font-weight: bold; width: 95%; text-align: right; }
	.sku{font-size: 45px; font-style: italic; font-weight: bold; width: 100%;  text-align: center;}
	.coluna{width: 50%; position: relative; float: left; text-align: center; font-size: 10px;}

	.itens{font-size: 19px; font-style: italic; font-weight: normal; width: 100%; text-align: center; padding-top: 10px;}
	.site{font-size: 25px; font-style: italic; font-weight: lighter; width: 100%; text-align: center; letter-spacing: 2px;}
	.acesse{font-size: 15px; font-style: italic; font-weight: bold; width: 100%;  text-align: center;}
	img{width: 100%;}
</style>

<body>
<?php foreach ($produtos_pedido as $key => $value) { ?>
<script type="text/javascript">
function <?php echo 'function'.$key; ?>(codigo) 
{
	var barcode = new bytescoutbarcode128();
	var value = codigo;

	barcode.valueSet(value);
	barcode.setMargins(5, 5, 5, 5);
	barcode.setBarWidth(4);

	var width = barcode.getMinWidth();

	barcode.setSize(width, 150);

	var <?php echo 'img'.$key; ?> = document.getElementById('<?php echo 'img'.$key; ?>');
	<?php echo 'img'.$key; ?>.src = barcode.exportToBase64(width,70, 0);
}
</script>

<div id="idTeste" class="container">
<div class="nome"><?php echo $value['Produto']['sku']; ?></div>
<div class="coluna"><font style="font-style: italic; font-size: 18px; font-weight: bold;"><?php echo $value['Produto']['ref']; ?>
	
<BR>
<?php echo $value['Produto']['cor']; ?>

</font></div>
<div class="coluna" style="text-align: right; height: 20px; font-size: 1px;"><img id="<?php echo 'img'.$key; ?>"/></div>

<?php echo $value['Produto']['sku']; ?>


	<!--<div class="logo"><?php echo $this->Html->image('etq/logo.jpg'); ?></div>
	<div class="separador">__________________________________________</div>-->
	<!--<div class="sku"><?php echo $value['Produto']['sku']; ?></div>-->

	
	<div class="itens">
		<!--<img id="<?php echo 'img'.$key; ?>"/>-->
	</div>

</div>

<script>
	<?php echo 'function'.$key; ?>('<?php echo $value["Produto"]["sku"]; ?>');
</script>

<?php } ?>
</body>
