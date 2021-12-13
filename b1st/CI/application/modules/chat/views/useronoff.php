<?php
if($userdet->admin==1)
{
?>
       <div class="on_off <?php if($userdet->online_status==1) { ?> online <?php } if($userdet->online_status==0) { ?> offline <?php } ?>"></div><?php echo $userdet->username;?> <?php if($userdet->privilege_group_id==1) { echo "";  } ?>
       <div class="close_this" onclick="closefunchat('<?php echo $userdet->id;?>')">X</div>
<?php
}
else
{
?>
       <div class="on_off <?php if($userdet->online_status==1) { ?> online <?php } if($userdet->online_status==0) { ?> offline <?php } ?>"></div><?php echo $userdet->firstname;?> <?php echo $userdet->lastname;?>
       <div class="close_this" onclick="closefunchat('<?php echo $userdet->id;?>')">X</div>
<?php
}
?>