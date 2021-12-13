<script>
  var audio = document.createElement('audio');
 document.body.appendChild(audio);
  audio.src = '<?php echo TICKET_PLUGIN_URL . "CI/assets/sounds/alarm.mp3" ; ?>'; audio.play();
  
  var element = document.getElementById("chat_box");
element.scrollTop = element.scrollHeight;
 </script>
 
 
 
<li class="me">
       <div class="image_placeholder"><img src="<?= B1st_getGravatar($fromemail);?>" /></div>
       <div id="chat_box" class="chat_txt">
              <?php echo $chatrow;?>
              <span class="time_chat">Just Now</span>
       </div>
</li>