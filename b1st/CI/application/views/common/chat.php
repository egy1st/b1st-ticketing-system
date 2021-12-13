<?php
$userlist=B1st_getUserlistChat();
//echo "<pre>";
//print_r($userlist);
//echo "</pre>";

if(isset($_SESSION['userid']))
{
       $loginid=$_SESSION['userid'];
}
else
{
       $loginid="";
}
if(!empty($loginid))
{
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
       
       $theme=B1st_getTheme();
       // echo "<pre>";
       //print_r($theme);
       // echo "</pre>";
       if(!empty($theme))
       {
           $themecolor=$theme->theme_name;
       }
       else
       {
              $theme = '';
       }
       if(!empty($themecolor))
       {
       ?>
       <link href="<?= TICKET_PLUGIN_URL;?>CI/assets/css/<?php echo $themecolor;?>chat_style.css" rel="stylesheet" type="text/css" />
       <?php
       }
       else
       {
       ?>
       <link href="<?= TICKET_PLUGIN_URL;?>CI/assets/css/chat_style.css" rel="stylesheet" type="text/css" />
       <?php
       }
       ?>
       
       <link href="<?= TICKET_PLUGIN_URL;?>CI/assets/css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css" />
       
       <div id="showchat" class="chatcover height" style="margin-right: -200px;">
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
                                <div class="name_placeholder" onclick="showchatbox('<?php echo $userlistsingle->id;?>')"><?php echo $userlistsingle->username;?> <?php if($userlistsingle->privilege_group_id==1) { echo "";  } ?></div>
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
               
       </div>
       
       <?php
       if(!empty($userlist))
       {
              ?>
              <div id="divforchatbox">
              <?php
              foreach($userlist as $userlistsingle)
              {
                     //echo "<pre>";
                     //print_r($userlistsingle);
                     //echo "</pre>";
                     ?>
                     <!--chat box ends-->
                     <div class="chat_box" id="chatboxindividual<?php echo $userlistsingle->id;?>" style="display:none;">
                            <div id="name<?php echo $userlistsingle->id;?>" class="name">
                            <?php
                            if($userlistsingle->admin==1)
                            {
                            ?>
                            <div class="on_off <?php if($userlistsingle->online_status==1) { ?> online <?php } if($userlistsingle->online_status==0) { ?> offline <?php } ?>"></div><?php echo $userlistsingle->username;?> <?php if($userlistsingle->privilege_group_id==1) { echo ""; } ?>
                            <?php
                            }
                            else
                            {
                            ?>
                            <div class="on_off <?php if($userlistsingle->online_status==1) { ?> online <?php } if($userlistsingle->online_status==0) { ?> offline <?php } ?>"></div><?php echo $userlistsingle->firstname;?> <?php echo $userlistsingle->lastname;?>
                            <?php
                            }
                            ?>
                           <div class="close_this" onclick="closefunchat('<?php echo $userlistsingle->id;?>')">X</div>
                           </div>
                           
                           <div id="totalchat<?php echo $userlistsingle->id;?>" class="chat_chat">
                              <div id="chatseeoverlay<?php echo $userlistsingle->id;?>" class="chatseeoverlay">
                                   <span><i class="fa fa-spinner fa-pulse fa-5x"></i></span>
                              </div>
                              <ul id="listchat<?php echo $userlistsingle->id;?>">
                                   <?php
                                   $toid=$userlistsingle->id;
                                   $fromid=$loginid;
                                   $chatdet=B1st_getChatsbtwnAdminUsers($toid,$fromid);
                                   if(!empty($chatdet))
                                   {
                                          foreach($chatdet as $chatdetlist)
                                          {
                                                 ?>
                                                 <li <?php if($fromid==$chatdetlist->from_userid) { ?> class="me" <?php } ?>>
                                                        <div class="image_placeholder"><img src="<?php echo B1st_getGravatar($userlistsingle->email);?>" /></div>
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
                           <span id="savechatsession<?php echo $userlistsingle->id;?>" class="chatsessspan"><a onclick="savechatsessionticket('<?php echo $userlistsingle->id;?>','<?php echo $toid;?>','<?php echo $fromid;?>','<?php echo date('Y-m-d');?>')" href="javascript:void(0);">Save this chat session as ticket</a></span>
                           <div class="search_chat">
                            <input type="hidden" id="toid<?php echo $userlistsingle->id;?>" name="toid" value="<?php echo $toid;?>" />
                            <input type="hidden" id="fromid<?php echo $userlistsingle->id;?>" name="fromid" value="<?php echo $fromid;?>" />
                            <textarea name="chatrow" id="chatrow<?php echo $userlistsingle->id;?>" onkeyup="addchat(event,'<?php echo $userlistsingle->id;?>')"></textarea>
                           </div>
                     
                     </div>
                     <!--chat box ends-->
                     <?php
              }
              ?>
              </div>
              <?php
       }
}
?>
<form action="<?= TICKET_PLUGIN_URL;?>CI/index.php/ticket/add" id="addformforchat" method="post">
       <textarea readonly="true" name="content" id="query" style="display: none;"></textarea>
       <input type="hidden" readonly="true" name="email" id="emailval" />
	   <input type="hidden" readonly="true" name="subject" id="subject" value="Chat session with <?php echo $userlistsingle->firstname . ' ' . $userlistsingle->lastname;?>"/>
       <input type="hidden" name="chatsession" id="chatsession" />
</form>
<script>
function savechatsessionticket(fetchid,toid,fromid,todaysdate)
{
       $('#chatseeoverlay'+fetchid).fadeIn();
       $.post('<?= TICKET_PLUGIN_URL;?>CI/index.php/chat/chatticket',{'fetchid':fetchid,'toid':toid,'fromid':fromid,'todaysdate':todaysdate},function(data){
              //alert(data);
              var newdata=$.parseJSON(data);
              $('#query').val(newdata[0]);
              $('#emailval').val(newdata[1]);
              $('#chatsession').val(1);
              $('#addformforchat').submit();
       });
       //alert(toid+"=========="+fromid+"=========="+todaysdate);
}
</script>
<script src="<?= TICKET_PLUGIN_URL;?>CI/assets/js/jquery.mCustomScrollbar.concat.min.js"></script>

<script>

var distance=0;       

$(document).ready(function(){
       
   var nchatobj=document.getElementsByClassName('.chat_chat');
   for(var jj=0;jj<nchatobj.length;jj++)
   {
       nchatobj[jj].scrollTop = nchatobj[jj].scrollHeight;
   }
       
   setInterval(function(){
      $.post('<?php echo TICKET_PLUGIN_URL;?>CI/index.php/chat',function(data){
	 //alert(data);
	 $('#showchat').html(data);
      });
   },5000);
   
   
   //js for marin the chat box
   
   
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
              var maindist=parseInt(distance)*200;
              if (maindist==0)
              {
                     var totaldistance=maindist;
              }
              else
              {
                     var totaldistance=maindist+++(5*parseInt(distance));
              }
              var marginright=totaldistance;
              if(!$('#chatboxindividual'+fromid).is(':visible'))
              {
                     $('#chatboxindividual'+fromid).css('margin-right',marginright+'px');
                     $('#chatboxindividual'+fromid).show();
                     distance+=1;
              }
              $('#chatboxindividual'+fromid).show();
              $('#chatrow'+fromid).focus();
              //autoloadchat(fromid,'<?php echo $loginid;?>');
             });
       }
      });
      //alert(distance);
   },5000);
});

function autoloadchat(touserid,fromuserid)
{
       setInterval(function(){
       var chatobj=document.getElementById('totalchat'+touserid);
       var oldheight=chatobj.scrollHeight;
       //alert(oldheight);
       $.post('<?php echo TICKET_PLUGIN_URL;?>CI/index.php/chat/getchatall',{'toid':touserid,'fromid':fromuserid},function(data){
          //alert(data);
          $('#listchat'+touserid).html(data);
          
          var newheight=chatobj.scrollHeight;
          if (newheight>oldheight)
          {
              chatobj.scrollTop = chatobj.scrollHeight;
          }
          $('#name'+touserid).load('<?php echo TICKET_PLUGIN_URL;?>CI/index.php/chat/chatonoff/'+touserid);
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
                     //alert(oldheight);
                     checkenter=false;
                     $.post('<?php echo TICKET_PLUGIN_URL;?>CI/index.php/chat/addchat',{'toid':toid,'fromid':fromid,'chatrow':chatrow},function(data){
                            //alert(data);
                            $('#listchat'+userid).append(data);
                            $('#chatrow'+userid).val('');
                            var newheight=chatobj.scrollHeight;
                            //alert(newheight);
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
       var maindist=parseInt(distance)*200;
       if (maindist==0)
       {
              var totaldistance=maindist;
       }
       else
       {
              var totaldistance=maindist+++(5*parseInt(distance));
       }
       var marginright=totaldistance;
       if(!$('#chatboxindividual'+userid).is(':visible'))
       {
              $('#chatboxindividual'+userid).css('margin-right',marginright+'px');
              $('#chatboxindividual'+userid).show();
              distance+=1;
       }
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
     distance-=1;
}
</script>



 <script type='text/javascript'>
  
  $(".show_hide_butn").toggle(function() {
       
      $('.chatcover').animate({ 'margin-right': '-200px'}, 200);      
  }, function() {       
      $('.chatcover').animate({ 'margin-right': '0px'}, 200);     
  });

 </script>