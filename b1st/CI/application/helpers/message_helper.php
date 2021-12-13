<?php
function B1st_showmessage()
{
    if(isset($_SESSION['SUCCESS_MSG']))
    {
    ?>
    <div class="isa_success">
         <i class="fa fa-check"></i>
         <?= $_SESSION['SUCCESS_MSG']; ?>
    </div>
    <?php
    unset($_SESSION['SUCCESS_MSG']);
    }
    
    if(isset($_SESSION['ERROR_MSG']))
    {
    ?>
    <div class="isa_error">
         <i class="fa fa-minus"></i>
         <?= $_SESSION['ERROR_MSG']; ?>
    </div>
    <?php
    unset($_SESSION['ERROR_MSG']);
    }
    
    if(isset($_SESSION['INFO_MSG']))
    {
    ?>
    <div class="isa_info">
         <i class="fa fa-info"></i>
         <?= $_SESSION['INFO_MSG']; ?>
    </div>
    <?php
    unset($_SESSION['INFO_MSG']);
    }
    
    if(isset($_SESSION['WARNING_MSG']))
    {
    ?>
    <div class="isa_warning">
         <i class="fa fa-warning"></i>
         <?= $_SESSION['WARNING_MSG']; ?>
    </div>
    <?php
    unset($_SESSION['WARNING_MSG']);
    }
}
?>