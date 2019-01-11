
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		Layout Publico
	</title>

	<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,300i" rel="stylesheet">


	<?php
		echo $this->Html->meta('icon');

		//echo $this->Html->css('cake.generic');

		// <link href="assets/css/core.min.css" rel="stylesheet">
    // <link href="assets/css/app.min.css" rel="stylesheet">
    // <link href="assets/css/style.min.css" rel="stylesheet">


		echo $this->Html->css(
				array(
					'../theAdmin/assets/css/core.min.css',
					'../theAdmin/assets/css/app.css',
					'../theAdmin/assets/css/style.css',
				)
			);

		



		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>


<body>


    <div class="row no-gutters min-h-fullscreen bg-white">
      <div class="col-md-6 col-lg-7 col-xl-8 d-none d-md-block bg-img" style="background-image: url(../img/bg-publico.jpg)" data-overlay="5">

        <div class="row h-100 pl-50">
          <div class="col-md-10 col-lg-8 align-self-end">
            <!-- <img src="../assets/img/logo-light-lg.png" alt="..."> -->
            <br><br><br>
            <h4 class="text-white"><b>e3Commerce</b></h4>
            <p class="text-white">Portal de controle do Fornecedor.</p>
            <br><br>
          </div>
        </div>

      </div>


        <?php echo $this->fetch('content'); ?>

      
    </div>




  <?php 

  echo $this->Html->script(
        array(
          '../theAdmin/assets/js/core.min.js',
          '../theAdmin/assets/js/app.min.js',
          '../theAdmin/assets/js/script.min.js',
        )
      );

       ?>

  </body>












<?php echo $this->element('sql_dump'); ?>
</html>
