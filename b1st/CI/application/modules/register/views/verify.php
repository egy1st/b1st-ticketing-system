<?php $this->load->view('common/login_header'); 
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

    <h2><span class="fontawesome-lock"></span>Verify</h2>

    <form action="<?= TICKET_PLUGIN_URL ?>CI/index.php/register/doverify" method="POST">

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
        <p><label for="email">Enter the Verification code</label></p>
        <p><input type="text" id="vcode" name="vcode" ></p> 
        <input type="hidden" name="uid" value="<?php echo $_SESSION['c_userid']; ?>">
        <p><input type="submit" name="submit" value="Submit"></p>
        
        <p>Already verified ? <a href="<?= TICKET_PLUGIN_URL ?>CI/index.php/register/login">Login</a></p>
  
      </fieldset>

    </form>
    
  </div> 
  <!-- end login -->

<?php
$this->load->view('common/footer');
?>