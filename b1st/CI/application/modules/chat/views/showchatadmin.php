<?php
$ccount=0;
if(!empty($adminlist))
{
       foreach($adminlist as $aa)
       {
              if($aa->online_status==1)
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
   if(!empty($adminlist))
   {
   ?>
   <ul class="content">
       <?php
       foreach($adminlist as $adminlistsingle)
       {
       ?>
       <li>
           <div class="image_placeholder"><img src="<?= B1st_getGravatar($adminlistsingle->email);?>" /></div>
           <div class="name_placeholder" onclick="showchatbox('<?php echo $adminlistsingle->id;?>')"><?php echo $adminlistsingle->username;?> <?php if($adminlistsingle->privilege_group_id==1) { echo ""; } ?></div>
           <div class="on_off <?php if($adminlistsingle->online_status==1) { ?> online <?php } if($adminlistsingle->online_status==0) { ?> offline <?php } ?>"></div>
       </li>
       <?php
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