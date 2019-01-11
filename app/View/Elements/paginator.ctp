


<?php if(isset($pageCount) && $pageCount > 1) { ?>
	<hr>

	<div class="paging">
		<?php
		echo $this->Paginator->first('<i class="fa fa-angle-double-left"></i> Primeira', array('tag' => 'span', 'escape' => false), array('type' => "button", 'class' => "primeira"));
		echo $this->Paginator->prev('<i class="fa fa-angle-left"></i> Anterior', array('tag' => 'span', 'escape' => false), '', array('class' => 'prev disabled', 'tag' => 'span', 'escape' => false));
		echo $this->Paginator->numbers(array('separator' => '', 'tag' => 'span', 'currentspannk' => true, 'currentClass' => 'active', 'currentTag' => 'a'));
		echo $this->Paginator->next('Próxima <i class="fa fa-angle-right"></i>', array('tag' => 'span', 'escape' => false), '', array('class' => 'prev disabled', 'tag' => 'span', 'escape' => false));
		echo $this->Paginator->last('Última <i class="fa fa-angle-double-right"></i>', array('tag' => 'span', 'escape' => false), array('type' => "button", 'class' => "ultima"));
		?>
	</div>





	<style type="text/css">


	.paging {
		margin-top: 40px;
		text-align: center;
	}
	.paging .current,
	.paging .disabled,
	.paging a {
		color: #8b95a5;
		padding: 6px 10px;
		border: 1px solid #EBEBED;
		border-radius: 3px;
		font-weight: 400;
	}
	.paging > span {
		margin: 0 2px;
	}
	.paging a:hover {
		background: #efefef;
		-webkit-box-shadow: 2px 2px 20px -4px rgba(92,92,92,1);
		-moz-box-shadow: 2px 2px 20px -4px rgba(92,92,92,1);
		box-shadow: 2px 2px 20px -4px rgba(92,92,92,1);
		border-color: #fff;
	}

	.paging .disabled {
		color: #ccc;
		opacity: 0.5;
	}
	.paging .disabled:hover {
		background: transparent;
	}
	.paging .active > a{
		background: #33cabb !important;
		color: #fff;
		padding: 10px 14px;
		font-weight: 600;

	}
	.paging .active > a:hover{
		background: #33cabb !important;
		color: #fff;
		-webkit-box-shadow: none;
		-moz-box-shadow: none;
		box-shadow: none;

	}


</style>









<?php }


if(isset($emptySearch)) { ?>
	<div style="text-align: center; margin-top: 20px; margin-bottom: 10px;">
		<?php echo __('Não foi encontrado registros com: <u>%s</u>', $this->params['named']['busca']); ?>
	</div>
<?php } else { ?>

	<div style="text-align: center; margin-top: 20px; margin-bottom: 10px;">
		
		<?php


		if ($this->Paginator->counter(array('format' => '{:count}')) != 0) {

			if ($this->Paginator->counter(array('format' => '{:pages}')) > 1) {


			echo $this->Paginator->counter(
				array(
					'format' => __('<b>Página {:page}</b> de {:pages}, mostrando {:current} registros, no <b>total de {:count}</b>, iniciando em {:start}, terminando em {:end}')
				)
			);

			}



		}else{

			echo "Lista Vazia";
		}


		?>
	</div>

<?php } ?>





