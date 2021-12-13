<?php $this->load->view('common/login_header'); 
//http://egyfirst.com/b1st/CI/index.php/register/login  URL for front login by MAA
?>
 <?php if(isset($_SESSION['register_success'])) { ?>
 <div class="isa_success">
     <i class="fa fa-check"></i>
     <?= $_SESSION['register_success']; ?>
</div>
<?php
unset($_SESSION['register_success']);
 } ?>
 <!-- start login -->
 <div id="login">

    <h2><span class="fontawesome-lock"></span>Login</h2>

    <form action="<?= TICKET_PLUGIN_URL ?>CI/index.php/register/dologin" method="POST">

      <fieldset>
      <?php
      $valerror=validation_errors();
      if(!empty($valerror) || !empty($_SESSION['login_error'])) { ?>
      <div class="error">
          <?php echo validation_errors(); 
            if(!empty($_SESSION['login_error']))
            {
              echo $_SESSION['login_error'];
              unset($_SESSION['login_error']);
            }
          ?>
      </div>
      <?php } ?>
        <p><label for="email">Username</label></p>
        <p><input type="text" id="username" name="username" value="test"></p> <!-- JS because of IE support; better: placeholder="mail@address.com" -->

        <p><label for="password">Password</label></p>
        <p><input type="password" id="password" name="password" value="test"></p> <!-- JS because of IE support; better: placeholder="password" -->

        <p><input type="submit" name="login" value="Login"></p>
        
        <p>Not a member ? <a href="<?= TICKET_PLUGIN_URL ?>CI/index.php/register/index">Register</a></p>
  
      </fieldset>

    </form>
    
  </div> 
  <!-- end login -->

<?php
$this->load->view('common/footer');
?>