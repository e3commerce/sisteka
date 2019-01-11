 <header class="topbar topbar-expand-lg" id="app-topbar">
      <div class="topbar-left">
        <!-- <span class="topbar-btn sidebar-toggler"><i>&#9776;</i>CAIO</span> -->
      </div>

      <div class="topbar-right">

        <nav class="topbar-navigation">
          <ul class="menu">

            


            <li class="menu-item active open">
              <a class="menu-link" href="#">
                <span class="fa fa-user"></span>
                <span class="title"><?php echo $userData['first_name'].' ('.$userData['last_name'].')' ?></span>
                <span class="arrow"></span>
              </a>

              <ul class="menu-submenu">
                

                <li class="menu-item">
                  <?php echo $this->Html->link('<span class="fa fa-key"></span><span class="title">Trocar senha</span>', array('controller' => 'users', 'action' => 'trocar_senha'), array('escape' => false, 'class' => 'menu-link')) ?>
                </li>

                <li class="menu-item">
                  <?php echo $this->Html->link('<span class="fa fa-remove"></span><span class="title">Sair do sistema</span>', array('controller' => 'users', 'action' => 'logout'), array('escape' => false, 'class' => 'menu-link')) ?>
                </li>



                

                
              </ul>
            </li>


            

          </ul>
        </nav>
        

      </div>
    </header>