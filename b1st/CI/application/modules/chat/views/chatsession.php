<?php
if(!empty($chatdet))
{
       foreach($chatdet as $chatdetlist)
       {
              ?>
              <li <?php if($fromid==$chatdetlist->from_userid) { ?> class="me" <?php } ?>>
                     <div class="image_placeholder"><img <?php if($fromid==$chatdetlist->from_userid) { ?> src="<?= B1st_getGravatar($fromemail);?>" <?php } if($toid==$chatdetlist->from_userid) { ?> src="<?= B1st_getGravatar($toemail);?>" <?php } ?> /></div>
                     <div class="chat_txt">
                            <?php echo $chatdetlist->chat;?>
                            <span class="time_chat"><?php echo B1st_smartdate($chatdetlist->create_date);?></span>
                     </div>
              </li>
              <?php
       }
}
?>