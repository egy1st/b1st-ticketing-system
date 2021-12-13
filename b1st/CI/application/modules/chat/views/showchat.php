<?php
@session_start();
$loginid=$_SESSION['userid'];
$ccount=0;
if(!empty($userlist))
{
       foreach($userlist as $uu)
       {
              if($uu->online_status==1 and $uu->id!=$loginid)
              {
                     $ccount++;
              }
       }
}
?>
<div class="show_hide_butn" href="javascript:void(0)">
       <?php echo $this->lang->line('Chat');?> <?php if($ccount>0) { echo " (".$this->lang->line('Online').")"; } else { echo " (".$this->lang->line('Offline').")"; } ?>
</div>
       
   <?php
   if(!empty($userlist))
   {
   ?>
   <ul class="content">
       <?php
       foreach($userlist as $userlistsingle)
       {
         if($userlistsingle->admin==1)
         {
            if($userlistsingle->id!=$loginid)
            {
            ?>
            <li>
                <div class="image_placeholder"><img src="<?= B1st_getGravatar($userlistsingle->email);?>" /></div>
                <div class="name_placeholder" onclick="showchatbox('<?php echo $userlistsingle->id;?>')"><?php echo $userlistsingle->username;?> <?php if($userlistsingle->privilege_group_id==1) { echo ""; }  ?></div>
                <div class="on_off <?php if($userlistsingle->online_status==1) { ?> online <?php } if($userlistsingle->online_status==0) { ?> offline <?php } ?>"></div>
            </li>
            <?php
            }
         }
         else
         {
         ?>
         <li>
             <div class="image_placeholder"><img src="<?= B1st_getGravatar($userlistsingle->email);?>" /></div>
             <div class="name_placeholder" onclick="showchatbox('<?php echo $userlistsingle->id;?>')"><?php echo $userlistsingle->firstname;?> <?php echo $userlistsingle->lastname;?></div>
             <div class="on_off <?php if($userlistsingle->online_status==1) { ?> online <?php } if($userlistsingle->online_status==0) { ?> offline <?php } ?>"></div>
         </li>
         <?php
         }
       }
       ?>
   </ul>
   <?php
   }
   else
   {
      echo "No users found";
   }
   ?>
       
<!--<div class="search_chat">
   <input type="text" placeholder="Search" />
   <button type="button"><img src="<?php //echo TICKET_PLUGIN_URL;?>CI/assets/images/search_chaticon.png" /></button>
</div>-->

 <script type='text/javascript'>
  
  $(".show_hide_butn").toggle(function() {
      $('.chatcover').animate({ 'margin-right': '-200px'}, 200);      
  }, function() {       
      $('.chatcover').animate({ 'margin-right': '0px'}, 200);     
  });

 </script>