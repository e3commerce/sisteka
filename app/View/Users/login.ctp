


<div class="col-md-6 col-lg-5 col-xl-4 align-self-center">
        <div class="px-80 py-30">
          <h4>Login</h4>
          <p><small>Entre no sisema.</small></p>
          <br>
          <?php echo $this->Form->create('User', array('class' => 'form-type-line'));?>
            <div class="form-group">
            <?php echo $this->Form->input('username', array('class' => 'form-control', 'label' => 'Nome de Usuário')); ?>
            </div>

            <div class="form-group">
            <?php echo $this->Form->input('password', array('class' => 'form-control', 'label' => 'Sua Senha')); ?>
            </div>

            <div class="form-group flexbox">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" checked>
                <label class="custom-control-label">Lembrar-me</label>
              </div>

              <a class="text-muted hover-primary fs-13" href="#">Perdi minha senha</a>
            </div>

            <div class="form-group">


              <?php echo $this->Form->submit('Entrar no Sistema', array('class' => 'btn btn-bold btn-block btn-primary'));?>	

            </div>
          <?php echo $this->Form->end(); ?>

          <!-- <div class="divider">Or Sign In With</div> -->
          <!-- <div class="text-center">
            <a class="btn btn-square btn-facebook" href="#"><i class="fa fa-facebook"></i></a>
            <a class="btn btn-square btn-google" href="#"><i class="fa fa-google"></i></a>
            <a class="btn btn-square btn-twitter" href="#"><i class="fa fa-twitter"></i></a>
          </div> -->

          <hr class="w-30px">

          <p class="text-center text-muted fs-13 mt-20">Está com dúvidas? <a class="text-primary fw-500" href="#">Clique aqui</a></p>
        </div>
      </div>


