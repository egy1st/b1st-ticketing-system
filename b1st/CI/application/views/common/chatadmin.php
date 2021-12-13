<?php
$adminlist=B1st_getAdminlistChat();
//echo "<pre>";
//print_r($adminlist);
//echo "</pre>";

$loginid=$_SESSION['c_userid'];

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
<!-- <link href="<?= TICKET_PLUGIN_URL;?>CI/assets/css/chat_style.css" rel="stylesheet" type="text/css" /> -->
<?php
    $theme=B1st_getFrontTheme();
   // echo "<pre>";
    //print_r($theme);
   // echo "</pre>";
  if(!empty($theme)){
    $themecolor=$theme->theme_name;
  }
else
{
$theme = '';
}
    ?>
    <?php
    if(!empty($themecolor))
    {
    ?>
    <link href="<?= TICKET_PLUGIN_URL;?>CI/assets/css/<?php echo $themecolor;?>front_chat_style.css" rel="stylesheet" type="text/css" />
    <?php
    }
    else
    {
    ?>
    <link href="<?= TICKET_PLUGIN_URL;?>CI/assets/css/front_chat_style.css" rel="stylesheet" type="text/css" />
    <?php
    }
    ?>

<link href="<?= TICKET_PLUGIN_URL;?>CI/assets/css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css" />

<div id="showchat" class="chatcover height" style="margin-right: -200px;">
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
               <div class="name_placeholder" onclick="showchatbox('<?php echo $adminlistsingle->id;?>')"><?php echo $adminlistsingle->username;?> <?php if($adminlistsingle->privilege_group_id==1) { echo "";  } ?></div>
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
              echo $this->lang->line("No users found");
       }
       ?>
       
       <!--<div class="search_chat">
           <input type="text" placeholder="Search" />
           <button type="button"><img src="<?php //echo TICKET_PLUGIN_URL;?>CI/assets/images/search_chaticon.png" /></button>
       </div>-->
        
</div>

<?php
if(!empty($adminlist))
{
       ?>
       <div id="divforchatbox">
	      <?php
	      foreach($adminlist as $adminlistsingle)
	      {
		     //echo "<pre>";
		     //print_r($adminlistsingle);
		     //echo "</pre>";
		     ?>
	      <!--chat box ends-->
	      <div class="chat_box" id="chatboxindividual<?php echo $adminlistsingle->id;?>" style="display: none;">
		    <div class="name" id="name<?php echo $adminlistsingle->id;?>"><div class="on_off <?php if($adminlistsingle->online_status==1) { ?> online <?php } if($adminlistsingle->online_status==0) { ?> offline <?php } ?>"></div><?php echo $adminlistsingle->username;?> <?php if($adminlistsingle->privilege_group_id==1) { ?>  <?php } ?>
		    <div class="close_this" onclick="closefunchat('<?php echo $adminlistsingle->id;?>')">X</div>
		    </div>
		    
		    <div id="totalchat<?php echo $adminlistsingle->id;?>" class="chat_chat">
		       <ul id="listchat<?php echo $adminlistsingle->id;?>">
			    <?php
			    $toid=$adminlistsingle->id;
			    $fromid=$loginid;
			    $chatdet=B1st_getChatsbtwnAdminUsers($toid,$fromid);
			    if(!empty($chatdet))
			    {
				   foreach($chatdet as $chatdetlist)
				   {
					  ?>
					  <li <?php if($fromid==$chatdetlist->from_userid) { ?> class="me" <?php } ?>>
						 <div class="image_placeholder"><img src="<?= B1st_getGravatar($adminlistsingle->email);?>" /></div>
						 <div class="chat_txt">
							<?php echo $chatdetlist->chat;?>
							<span class="time_chat"><?php echo B1st_smartdate($chatdetlist->create_date);?></span>
						 </div>
					  </li>
					  <?php
				   }
			    }
			    ?>
		       </ul>
		    </div>
		    
		    <div class="search_chat">
		     <input type="hidden" id="toid<?php echo $adminlistsingle->id;?>" name="toid" value="<?php echo $toid;?>" />
		     <input type="hidden" id="fromid<?php echo $adminlistsingle->id;?>" name="fromid" value="<?php echo $fromid;?>" />
		     <textarea name="chatrow" id="chatrow<?php echo $adminlistsingle->id;?>" onkeyup="addchat(event,'<?php echo $adminlistsingle->id;?>')"></textarea>
		    </div>
	      
	      </div>
	      <!--chat box ends-->
	      <?php
	      }
	      ?>
       </div>
<?php
}
?>
<script src="<?= TICKET_PLUGIN_URL;?>CI/assets/js/jquery.mCustomScrollbar.concat.min.js"></script>

<script>
$(document).ready(function(){
       
   var chatobj=document.getElementsByClassName('.chat_chat');
   for(var jj=0;jj<chatobj.length;jj++)
   {
       chatobj[jj].scrollTop = chatobj[jj].scrollHeight;
   }
       
   setInterval(function(){
      $.post('<?php echo TICKET_PLUGIN_URL;?>CI/index.php/chat/adminchat',function(data){
	 //alert(data);
	 $('#showchat').html(data);
      })
   },5000);
   
   //code for chat popup self
   setInterval(function(){
      $.post('<?php echo TICKET_PLUGIN_URL;?>CI/index.php/chat/chatpopup',{'toid':'<?php echo $loginid;?>'},function(data){
       //alert(data);
       if (data)
       {
             var iddet=JSON.parse(data);
             //alert(iddet);
             $.each(iddet, function( index, value ) {
              var fromid=value;
              $('#chatboxindividual'+fromid).show();
	      $('#chatrow'+fromid).focus();
	      autoloadchat(fromid,'<?php echo $loginid;?>');
             });
       }
       
      })
   },5000);
});

function autoloadchat(touserid,fromuserid)
{
       setInterval(function(){
       var chatobj=document.getElementById('totalchat'+touserid);
       var oldheight=chatobj.scrollHeight;
       $.post('<?php echo TICKET_PLUGIN_URL;?>CI/index.php/chat/getchatall',{'toid':touserid,'fromid':fromuserid},function(data){
          //alert(data);
          $('#listchat'+touserid).html(data);
          
          var newheight=chatobj.scrollHeight;
          if (newheight>oldheight)
          {
               chatobj.scrollTop = chatobj.scrollHeight;
          }
	  $('#name'+touserid).load('<?php echo TICKET_PLUGIN_URL;?>CI/index.php/chat/chatonoffadmin/'+touserid);
       })
    },3000);
}

var checkenter=true;

function addchat(e,userid)
{
    if (!e) e = window.event;
    var keyCode = e.keyCode || e.which;
    if (keyCode == '13')
    {
       if (checkenter)
       {
	      var toid=$('#toid'+userid).val();
	      var fromid=$('#fromid'+userid).val();
	      var chatrow=$('#chatrow'+userid).val();
              //alert(chatrow.trim());
              chatrow=chatrow.trim();
	      if (chatrow!="")
              {
		     var chatobj=document.getElementById('totalchat'+userid);
		     var oldheight=chatobj.scrollHeight;
		     $.post('<?php echo TICKET_PLUGIN_URL;?>CI/index.php/chat/addchat',{'toid':toid,'fromid':fromid,'chatrow':chatrow},function(data){
			    //alert(data);
			    $('#listchat'+userid).append(data);
			    $('#chatrow'+userid).val('');
			    var newheight=chatobj.scrollHeight;
			    if (newheight>oldheight)
			    {
				 chatobj.scrollTop = chatobj.scrollHeight;
			    }
			    checkenter=true;
		     });
	      }
	      $('#chatrow'+userid).val('');
       }
    }  
}

function showchatbox(userid)
{
       $('#chatboxindividual'+userid).show();
       autoloadchat(userid,'<?php echo $loginid;?>');
       $('#chatrow'+userid).focus();
       $('.chatcover').animate({ 'margin-right': '-200px'}, 200);
}


</script>

<script>
		(function($){
			$(window).load(function(){
				
				$(".content").mCustomScrollbar({
					theme:"light-2",
					scrollButtons:{
						enable:true
					},
					callbacks:{
						onTotalScroll:function(){ addContent(this) },
						onTotalScrollOffset:100,
						alwaysTriggerOffsets:false
					}
				});
				
				function addContent(el){
					el.mcs.content.append(c);
					$(".offset").appendTo(el.mcs.content);
				}
				
			});
		})(jQuery);
	</script>
<script>

$(window).resize(function(){

		height=$(window).height() - 20;
		$('.height').css('height',height +'px');
		
		
		heightarea=$('.height').height()-36;
		$('.content').css('height',heightarea + "px");		
		});	
			
$(window).resize();

function closefunchat(userid)
{
     $('#chatboxindividual'+userid).hide();
}
</script>



 <script type='text/javascript'>
  
  $(".show_hide_butn").toggle(function() {
       
      $('.chatcover').animate({ 'margin-right': '-200px'}, 200);      
  }, function() {       
      $('.chatcover').animate({ 'margin-right': '0px'}, 200);     
  });

 </script>