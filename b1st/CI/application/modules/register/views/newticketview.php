<?php $this->load->view('front/header'); ?>
<style>
.attachclass
{
  color:#00009a;
}

.attachclass:hover
{
  text-decoration: underline;
}
.uploaded_img{margin-top: 15px;margin-left: 15px;}
.uploaded_img ul{list-style: none;}
.uploaded_img ul li{width:80%;                    
        background: rgba(55,55,55,.1);
        padding: 6px 6px;
        float: left;
        margin-right: 6px;
        margin-bottom: 8px;
        position: relative;
        border-radius: 5px;
        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
        
        
        }
.uploaded_img ul li img{width:100%;
                        height:auto;
      max-height:100%;
}

.uploaded_img ul li span{position: absolute;
                         right: 7px;
       font-size: 20px;
       color: #f00;
        line-height: 0;
    margin-top: -3px;
    cursor: pointer;
       }
.main_section{
  width: 100%;
}
.headding_bl{
  width: 98%;
}
.t_view_both{
  width:98%;
}
.main_pro_pi{width:100%;}
.main_panel{width:97%;}
#reply{width:90%;}
</style>
       <!--main_section-->
       <div class="main_section">
   
         <!--product_box-->
         <div id="side_area">
          <div class="headding_bl">
           <p><?php echo $this->lang->line('Ticket No');?>:<?=$ticketdetlist->ticket_no;?>
            <!--<form id="pageNo" action="<?php //echo TICKET_PLUGIN_URL;?>CI/index.php/ticket/index/<?php //echo $this->uri->segment(3) ?>" method="post">-->
            <!--  <?php //echo $this->lang->line('Show');?>&nbsp;<select name="perpage" onchange="$('#pageNo').submit()">-->
            <!--   <?php //$array = array(5,10,20,40,80,100);
                  //foreach($array as $no){
                   //$sel = $no == $noPage ? 'selected':'';
               ?>-->
            <!--    <option value="<?php //echo $no ?>" <?php //echo $sel ?>><?php //echo $no ?></option>-->
            <!--   <?php //} ?>-->
            <!--  </select>&nbsp;<?php //echo $this->lang->line('Entries');?>-->
            <!--</form>-->
           </p>
          </div>
          <div class="main_pro_pi">
           
           
         <div class="child_cake">
            <div class="drop_down_pi">


 <?php
              $ratingmod=B1st_fetchmod('rating');
              if($ratingmod==1)
              {
                if(!empty($ticketdetlist))
                {
                  ?>
                  <div class="ticketinfo" style="width:25%">
                  <strong style="float:left;font-size: 15px;padding-right: 6px;"><?php echo $this->lang->line('Rating');?> : </strong><div class="basic jDisabled" data-average="<?php echo $ticketdetlist->rating;?>" data-id="<?= $ticketdetlist->id ?>"></div>
                  </div>
                  <?php
                }
              }
              ?>
              <?php
              $promod=B1st_fetchmod('product');
              if($promod==1)
              {
                if(!empty($ticketdetlist))
                {
                  $name = B1st_getProductById($ticketdetlist->product_id,'product_name');
                  ?>
                  <div class="ticketinfo">
                  <strong style="float:left;font-size: 15px;padding-right: 6px;"><?php echo $this->lang->line('Product');?> : </strong>
                    <?= $name; ?>
                 </div>
                  <?php
                }
              }
              ?>
              
              <?php
            
                if(!empty($ticketdetlist))
                {
                   $name = B1st_getDepartmentById($ticketdetlist->department_id,'department_name');
                  ?>
                  <div class="ticketinfo">
                  <strong style="float:left;font-size: 15px;padding-right: 6px;"><?php echo $this->lang->line('Department');?> : </strong>
                  <?= $name; ?>
                  </div>
                  <?php
                }
              
              ?>

            </div>
            
              <div class="main_panel">

    <table class="dibya tablesorter tableSort" cellpadding="0" cellspacing="0">
     <thead>
     <tr>
        <th>
          <span class="spany">Ticket No</span>    
        </th>
        <th>
          <span class="spany">Subject</span>  
        </th>
        <th>
          <span class="spany">Customer</span> 
        </th>
        <th>
          <span class="spany">State</span>  
        </th>
        <th>
          <span class="spany">Priority</span>   
        </th>
        <?php
          $timesettings = (array)B1st_getSettingsValue('ticket_time');
          if($timesettings['type'] == 1)
          {
        ?>
        <th>
          <span class="spany">Creation Time</span>   
        </th>
        <?php 
        }else if($timesettings['type'] == 2)
        { 
        ?>
        <th>
          <span class="spany">Elapsed time</span>   
        </th>
        <?php } ?>
<!--         <td>
  <span class="spany">Action</span> 
</td> -->
       </tr>
       </thead>
       <tbody>
       <?php
      if(!empty($ticketdetlist))
      {
      $i=1;
     
      ?>
      <tr <?php if($i%2==0) { ?> class="white" <?php } else  { ?> class="gray" <?php } ?>>
           
           <td><?php echo stripslashes($ticketdetlist->ticket_no);?></td>
           <td><?php echo stripslashes($ticketdetlist->subject);?></td>
           <td><?php echo stripslashes($ticketdetlist->customer);?></td>
           <td class="act">
              <?php
              $states = B1st_getTicketStates();

              foreach($states as $state)
              {
                if($state->code == $ticketdetlist->state)
                {
                   ?>
                   <p><a style="color:#fff;" href="javascript:void()"><?= $state->name ?></a></p>
                   <?php
                 }
              }
              ?>
           </td>
           <td class="act">
             <p style="background-color:<?= $ticketdetlist->priority_color ?>"><a style="color:#fff;" href="javascript:void(0);"><?= $ticketdetlist->priority_name ?></a></p>  
           </td>
              <td><?php
               if($timesettings['type'] == 2)
                {
                  $d = B1st_smartdate($ticketdetlist->modified_date); // by MAA
                  echo str_replace('ago',"",$d);
                }
                else if($timesettings['type'] == 1)
                {
                  echo date('d-m-y h:i:s A',strtotime($ticketdetlist->modified_date)); //by MAA
                }
               ?></td>
           <!-- <td> 
             <?php if(B1st_check_privilege($_SESSION['userid'],'ET')){ ?>
             <button type="submit" class="edit_button nuc_bl" onclick="window.location.href='<?= TICKET_PLUGIN_URL;?>CI/index.php/ticket/edit/<?php echo $ticketdetlist->id;?>'"><i class="fa fa-pencil"></i></button>
            <?php } ?>
           
             <?php if(B1st_check_privilege($_SESSION['userid'],'DT')){ ?>
            
              <?php
               $settings = (array)B1st_getSettingsValue('delete_confirmation');
               $txt = '';
               if($settings['type'] == 1)
               {
                $txt = "getConfirmation('Are you sure you want to delete this Ticket Permenantly.','".TICKET_PLUGIN_URL."CI/index.php/ticket/deleteticket/". $ticketdetlist->id."')";
               }
               else
               {
                $txt = "window.location.href='".TICKET_PLUGIN_URL."CI/index.php/ticket/deleteticket/".$ticketdetlist->id."'";
               }
            ?>
           
             <button type="submit" class="edit_button bitn nuc_b" onclick="<?= $txt ?>"><i class="fa fa-trash-o"></i></button>
             <?php } ?>
           </td> -->
      </tr>
      <?php
      $i++;
      
      }
      else
      {
       ?>
       <tr>
      <td class="gray" colspan="8">
        No records found
      </td>
       </tr>
       <?php
      }
      ?>
      </tbody>
    </table>
<!-- reply section -->
 <section class="ac-container">
        <div>
          <input type="checkbox" name="accordion-1" id="ac-1" checked="checked">
                    
          <article class="ac-small">
            <p>
                        </p>

 <div class="sec_act">
          <div class="porfile_box">
        <p class="date"><?= date('d',strtotime($ticketdetlist->create_date)) ?>
        <br>
        <span><?= date('M',strtotime($ticketdetlist->create_date)) ?></span>
        </p>
        <p class="time"><?= date('ga',strtotime($ticketdetlist->create_date)) ?></p>
       </div>
         
          <div class="right_rec">
             <?php 
               $userinfo = B1st_getUserInfoById($ticketdetlist->userid);
               $name = $userinfo->firstname.' '.$userinfo->lastname;
            ?>
            <p class="icon_top">
                        <img width="45" height="45"  src="<?= B1st_getGravatar($userinfo->email) ?>">
                       </p>
                        <div class="corner">
                      </div>
           <div class="left_details">
            
            <p class="name_pil"><?php echo $name ; ?><strong>#<?= $ticketdetlist->ticket_no ?></strong>
            <span class="aroe_pi"><a href="#">
             
                      <i class="fa fa-mail-forward"></i>
            

            </a></span>
            <span class="lock_pi"><a href="#"><!-- <strong class="red_imp">Important</strong> --></a></span>
            </p>
            <p class="det_all"><strong>Query : </strong>
           <?= nl2br($ticketdetlist->query) ?></p>
            <ul class="icon_ht">
              <?php
              if(!empty($ticketattachment))
              {
               foreach($ticketattachment as $ticklist)
               {
                $ticklist->filename;
                $farr=explode(".",$ticklist->filename);
                $ext=$farr[1];
                if(file_exists(TICKET_PLUGIN_PATH."/CI/assets/attachments/".$ticklist->filename))
                {
                  if(file_exists(TICKET_PLUGIN_PATH."/CI/assets/images/d".$ext.".png"))
                  {
                  ?>
                  <a href="<?php echo TICKET_PLUGIN_URL; ?>CI/index.php/ticket/showfile/<?php echo $ticklist->filename; ?>">
                    <img src="<?= TICKET_PLUGIN_URL ?>/CI/assets/images/d<?php echo $ext;?>.png">
                  </a>
                  <?php
                  }
                  else
                  {
                   ?>
                  <a href="<?php echo TICKET_PLUGIN_URL; ?>CI/index.php/ticket/showfile/<?php echo $ticklist->filename; ?>">
                    <img src="<?= TICKET_PLUGIN_URL ?>/CI/assets/images/blank.png">
                  </a>
                   <?php 
                  }
                }
               }
              }
              ?>
          <!-- <li><img src="images/d1.png"></li>
          <li><img src="images/d2.png"></li>
          <li><img src="images/d3.png"></li>
          <li><img src="images/d4.png"></li>
          <li><img src="images/d5.png"></li>
          <li><img src="images/d6.png"></li>
          <li><img src="images/d7.png"></li> -->
        </ul>
           </div>
          </div>
         </div>

         <?php if(!empty($querychain)){ ?>
               <?php foreach($querychain as $query){ ?>
         <div class="sec_act">
          <div class="porfile_box">
        <p class="date"><?= date('d',strtotime($query->date)) // by MAA was create_date ?>
        <br>
        <span><?= date('M',strtotime($query->date)) // by MAA was create_date  ?></span>
        </p>
        <p class="time"><?= date('ga',strtotime($query->date)) // by MAA was create_date ?></p>
       </div>
         
          <div class="right_rec">
                       <?php 
               $userinfo = B1st_getUserInfoById($query->replier_id);
               $name = $userinfo->firstname.' '.$userinfo->lastname;
                        ?>
            <p class="icon_top">
                        <img width="45" height="45"  src="<?= B1st_getGravatar($userinfo->email) ?>">
                       </p>
                        <div class="corner">
                      </div>
           <div class="left_details">
            <p class="name_pil"><?php echo $name ; ?><strong>#<?= $query->ticket_no ?></strong>
            <span class="aroe_pi"><a href="#">

                            <?php
                  if($query->replier == "admin"){
                    ?>
                    <i class="fa fa-reply"  style="color:#4c9628"></i>
                    <?php
                  }
                  else
                  {
                    ?>
                  <i class="fa fa-mail-forward"></i>
                    <?php
                  }
                    ?>
            </a></span>
            <span class="lock_pi"><a href="#"><!-- <strong class="red_imp">Important</strong> --></a></span>
            </p>
            <p class="det_all"><strong>Reply : </strong>
            <?= nl2br($query->body) ?>
            </p>
        <!--    <ul class="icon_ht">
          <li><img src="images/d1.png"></li>
          <li><img src="images/d2.png"></li>
          <li><img src="images/d3.png"></li>
          <li><img src="images/d4.png"></li>
          <li><img src="images/d5.png"></li>
          <li><img src="images/d6.png"></li>
          <li><img src="images/d7.png"></li>
        </ul> -->
           </div>
          </div>
         </div>
         <?php }
        }
          ?>
         
         
         
         
         <p></p>
          </article>
        </div>
         
         </section> 
<!-- reply section -->
<?php if($ticketdetlist->state !== 'C'){  ?>
                <div class="t_view_both clearfix">
                  <?php
                  $valerror="";
                  if(!empty($_SESSION['reply_validation']))
                  {
                   $valerror=$_SESSION['reply_validation'];
                  }
                   if(!empty($valerror))
                   {
                    ?>
                    <div class="errorMsg">
                        <?php echo $valerror; ?>
                    </div>
                   <?php
                   }
                   unset($_SESSION['reply_validation']);
                  ?>
                    <form action="<?= TICKET_PLUGIN_URL;?>CI/index.php/ticket/reply" method="post">
                      <div class="main_pro_pi">
                           <div class="fileds">
                              <div class="form_holder">
                                <?php
                                $faqchk=B1st_fetchmod('faq');
                                if($faqchk==1)
                                {
                                ?>
                                <label><span>Reply</span></label>
                                <?php
                                }
                                else
                                {
                                ?>
                                <label><span>Reply</span></label>
                                <?php
                                }
                                ?>
                                <textarea name="reply_text" id="reply" placeholder="Enter Reply to query"></textarea>
                              </div>

                                       <!--<div class="form_holder">
                                                       <label><span>State</span></label>
                                                       <div class="select_cover">
                                                       <select name="state">
                                            <option value="">Select State</option>
                                            <?php
                                            /*$states = B1st_getTicketStates();
                                            if(!empty($states))
                                            {
                                              foreach($states as $state)
                                              {
                                                $sel = $state->code == 'A' ? "selected" : "";
                                                ?>
                                                <option value="<?php echo $state->code;?>" <?= $sel ?>><?php echo stripslashes($state->name);?></option>
                                                <?php
                                              }
                                            }*/
                                            ?>
                                                       </select> 
                                                       </div>
                                        </div>-->
                                <input type="hidden" name="state" value="P" />
                                <input type="hidden" name="ticket_id" value="<?= $ticketdetlist->id; ?>">
                                <input type="hidden" name="replier" value="client">
                                <input type="hidden" name="replier_id" value="<?php echo $_SESSION['c_userid']; ?>">
                                
                                
                               <div class="form_holder">
                                <button id="butn" class="sbmt sbmt_base sbmt_base-no-border" type="submit" onclick="return butnprob()"><i class="fa fa-spinner upload_icon"></i>Submit</button>
			        <button id="duplibutn" style="display:none;" class="sbmt sbmt_base sbmt_base-no-border" disabled="true" type="button"><i class="fa fa-spinner upload_icon"></i>Submit</button>
                               </div>
                          </div>
                          <?php } ?>
         </section>
                </div>
      
                
              
               
              </div>
              </div>
          </div>
          
         </div>
           
         <!--/product_box-->

         
       </div>
       <!--/main_section-->
<?php
$chk=B1st_fetchmod('chat');
if($chk==1)
{
    $this->load->view('common/chatadmin');
}
?>
<?php
$this->load->view('front/footer');
?>
<script>
function butnprob()
{
	$('#butn').hide();
	$('#duplibutn').show();
	return true;
}
</script>

