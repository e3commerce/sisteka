<aside class="sidebar sidebar-icons-right sidebar-icons-boxed sidebar-expand-lg">
  <header class="sidebar-header">
  <?php echo $this->Html->link('<i class="fa fa-area-chart"></i>', array('controller' => 'pages', 'action' => 'index'), array('escape' => false, 'class' => 'logo-icon')) ?>
    <!-- <a class="logo-icon" href="../index.html"></a> -->
    <span class="logo">
     <?php echo $this->Html->link('<b>Sistema</b>', array('controller' => 'pages', 'action' => 'index'), array('escape' => false)) ?>
      <!-- <a href="../index.html">e3</a> -->
    </span>
    <span class="sidebar-toggle-fold"></span>
  </header>

  <nav class="sidebar-navigation">
    <ul class="menu">

    <!-- 

      <li class="menu-category">Category 1</li>

      <li class="menu-item active">
        <a class="menu-link" href="../dashboard/general.html">
          <span class="icon fa fa-home"></span>
          <span class="title">Dashboard</span>
        </a>
      </li>

      <li class="menu-item">
        <a class="menu-link" href="#">
          <span class="icon fa fa-user"></span>
          <span class="title">Users</span>
          <span class="arrow"></span>
        </a>

        <ul class="menu-submenu">
          <li class="menu-item">
            <a class="menu-link" href="#">
              <span class="dot"></span>
              <span class="title">Moderators</span>
            </a>
          </li>

          <li class="menu-item">
            <a class="menu-link" href="#">
              <span class="dot"></span>
              <span class="title">Customers</span>
            </a>
          </li>
        </ul>
      </li>

 -->

     

      

      <li class="menu-category">Financeiro</li>

      


            <?php echo $this->Html->link('<span class="icon fa fa-list"></span><span class="title">Movimentações</span><span class="arrow"></span>', array('controller' => 'catalogoprodutos', 'action' => 'index'), array('escape' => false, 'class' => 'menu-link') );?>
            <?php echo $this->Html->link('<span class="icon fa fa-list"></span><span class="title">Despesas</span><span class="arrow"></span>', array('controller' => 'catalogoprodutos', 'action' => 'index'), array('escape' => false, 'class' => 'menu-link') );?>
          

      

      

        <li class="menu-category">Estoque</li>


          <?php echo $this->Html->link('<span class="icon fa fa-money"></span><span class="title">Controle</span><span class="arrow"></span>', array('controller' => 'fechamentos', 'action' => 'index'), array('escape' => false, 'class' => 'menu-link') );?>

          <li class="menu-category">Vendas</li>


          <?php echo $this->Html->link('<span class="icon fa fa-money"></span><span class="title">Pedidos</span><span class="arrow"></span>', array('controller' => 'fechamentos', 'action' => 'index'), array('escape' => false, 'class' => 'menu-link') );?>

        
 <li class="menu-category">Administração Geral</li>


      <li class="menu-item">
        <a class="menu-link" href="#">
          <span class="icon fa fa-dashboard"></span>
          <span class="title">Geral</span>
          <span class="arrow"></span>
        </a>

        <ul class="menu-submenu">


          <li class="menu-item">
            <?php echo $this->Html->link('<span class="dot"></span><span class="title">Empresas</span><span>&nbsp;</span>', array('controller' => 'empresas', 'action' => 'index', 'todos'), array('escape' => false, 'class' => 'menu-link') );?>
          </li>
          
          
          
          
                

          
        </ul>
      </li>




      

    </ul>
  </nav>

</aside>