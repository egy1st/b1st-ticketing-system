<?php $this->load->view('common/login_header'); ?>
 <!-- start login -->
 <div id="login">

    <h2><span class="fontawesome-lock"></span>Login</h2>

    <form action="<?= TICKET_PLUGIN_URL ?>CI/index.php/logins/dologin" method="POST">

      <fieldset>

        <p><label for="email">Username</label></p>
        <p><input type="text" id="username" name="username" ></p> <!-- JS because of IE support; better: placeholder="mail@address.com" -->

        <p><label for="password">Password</label></p>
        <p><input type="password" id="password" name="password" ></p> <!-- JS because of IE support; better: placeholder="password" -->

        <p><input type="submit" name="login" value="Login"></p>
      
      <?php if((validation_errors()!="") || !empty($_SESSION['login_error'])) { ?>
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
      </fieldset>

    </form>
    
  </div> 
  <!-- end login -->

<?php
$this->load->view('common/footer');
?>