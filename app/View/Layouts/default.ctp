<?php
/**
* CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
* Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
*
* Licensed under The MIT License
* For full copyright and license information, please see the LICENSE.txt
* Redistributions of files must retain the above copyright notice.
*
* @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
* @link          https://cakephp.org CakePHP(tm) Project
* @package       app.View.Layouts
* @since         CakePHP(tm) v 0.10.0.1076
* @license       https://opensource.org/licenses/mit-license.php MIT License
*/

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
<?php echo $this->Html->charset(); ?>
<title>
<?php echo $cakeDescription ?>:
<?php echo $this->fetch('title'); ?>
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




echo $this->Html->script(
array(
'../theAdmin/assets/js/core.min.js',
'../theAdmin/assets/js/app.min.js',
'../theAdmin/assets/js/script.min.js',
'../theAdmin/assets/js/jquery.bootstrap-growl.min.js',
)
);



echo $this->fetch('meta');
echo $this->fetch('css');
echo $this->fetch('script');
?>
</head>


<body data-provide="pace">

<!-- Preloader -->
<div class="preloader">
<div class="spinner-dots">
<span class="dot1"></span>
<span class="dot2"></span>
<span class="dot3"></span>
</div>
</div>


<!-- Sidebar -->
<?php echo $this->element('sidebar'); ?>
<!-- END Sidebar -->


<!-- Topbar -->
<?php echo $this->element('topbar'); ?>
<!-- END Topbar -->


<!-- Main container -->
<main class="main-container">



<?php echo $this->Flash->render(); ?>

<?php echo $this->fetch('content'); ?>





<!-- Footer -->
<?php echo $this->element('footer'); ?>
<!-- END Footer -->

</main>
<!-- END Main container -->





<!-- Global quickview -->
<div id="qv-global" class="quickview" data-url="assets/data/quickview-global.html">
<div class="spinner-linear">
<div class="line"></div>
</div>
</div>
<!-- END Global quickview -->





</body>






<?php echo $this->element('sql_dump'); ?>
</html>
