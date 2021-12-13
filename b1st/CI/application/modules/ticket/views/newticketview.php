<?php
$this->load->view('common/header');
//echo "<pre>";
//print_r($ticketdet);
//echo "</pre>";
?>
       <!--page_title-->
       <div class="page_title">
         <div class="headline">
          <h1><span><i class="fa fa-ticket"></i></span><?php echo $this->lang->line('Ticket');?></h1>
         </div>
         <div class="right_panel">
           <!--<a href="#" class="btn pi-btn-base pi-btn-no-border"><span class="icon_all"><i class="fa fa-inbox"></i></span>Manage categories</a>-->
           
           <!--<a href="#" class="bttn pi-btn btn-no-border"><span class="edit_all"><i class="fa fa-pencil"></i></span>Edit message</a>-->
            <a href="<?= TICKET_PLUGIN_URL;?>CI/index.php/ticket" class="bttn pi-btn btn-no-border"><span class="edit_all"><i class="fa fa-inbox"></i></span><?php echo $this->lang->line('Manage Tickets');?></a>
           <!--<a href="#"  class="bttn pi-btn btn-no-border"><span class="edit_all"><i class="fa fa-times"></i></span>Delete message</a>-->
         </div>
       </div>
       <!--/page_title-->
       <!--main_section-->
       <div class="main_section">
  <?php $this->load->view('common/ticketpanel');?>
         <!--vertical_menu-->
          <!--<div class="left_ver" id="change_bar">
          <span><i class="fa fa-angle-double-right"></i></span>
          </div>-->
         <!--/vertical_menu-->
   
         <!--product_box-->
         <div class="product_box" id="side_area">
          <div class="headding_bl">
           <p><span><i class="fa fa-th-list"></i></span><?php echo $this->lang->line('Manage Tickets');?>
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
          <span class="spany"><?php echo $this->lang->line('Ticket No');?></span>   
        </th>
        <th>
          <span class="spany"><?php echo $this->lang->line('Subject');?></span> 
        </th>
        <th>
          <span class="spany"><?php echo $this->lang->line('Customer');?></span>  
        </th>
        <th>
          <span class="spany"><?php echo $this->lang->line('State');?></span> 
        </th>
        <th>
          <span class="spany"><?php echo $this->lang->line('Priority');?></span>  
        </th>
        <?php
          $timesettings = (array)B1st_getSettingsValue('ticket_time');
          if($timesettings['type'] == 1)
          {
        ?>
        <th>
          <span class="spany"><?php echo $this->lang->line('Creation Time');?></span>    
        </th>
        <?php 
        }else if($timesettings['type'] == 2)
        { 
        ?>
        <th>
          <span class="spany"><?php echo $this->lang->line('Elapsed Time');?></span>    
        </th>
        <?php } ?>
        <td>
          <span class="spany"><?php echo $this->lang->line('Action');?></span>
        </td>
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
                  echo date('d-m-y h:i:s A',strtotime($ticketdetlist->modified_date)); // by Maa
                }
               ?></td>
           <td> 
             <?php if(B1st_check_privilege($_SESSION['userid'],'ET')){ ?>
             <button type="submit" class="edit_button nuc_bl" onclick="window.location.href='<?= TICKET_PLUGIN_URL;?>CI/index.php/ticket/edit/<?php echo $ticketdetlist->id;?>'"><i class="fa fa-pencil"></i></button>
            <?php } ?>

             <?php if(B1st_check_privilege($_SESSION['userid'],'DT')){ ?>
            
              <?php
               $settings = (array)B1st_getSettingsValue('delete_confirmation');
               $txt = '';
               if($settings['type'] == 1)
               {
                $txt = "getConfirmation('".$this->lang->line('Are you sure you want to delete this Ticket Permenantly.')."','".TICKET_PLUGIN_URL."CI/index.php/ticket/deleteticket/". $ticketdetlist->id."')";
               }
               else
               {
                $txt = "window.location.href='".TICKET_PLUGIN_URL."CI/index.php/ticket/deleteticket/".$ticketdetlist->id."'";
               }
            ?>

             <button type="submit" class="edit_button bitn nuc_b" onclick="<?= $txt ?>"><i class="fa fa-trash-o"></i></button>
             <?php } ?>
           </td>
      </tr>
      <?php
      $i++;
      
      }
      else
      {
       ?>
       <tr>
      <td class="gray" colspan="8">
        <?php echo $this->lang->line('No records found');?>
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
             
                      <i class="fa fa-reply"></i>
            

            </a></span>
            <span class="lock_pi"><a href="#"><!-- <strong class="red_imp">Important</strong> --></a></span>
            </p>
            <p class="det_all"><strong><?php echo $this->lang->line('Query');?> : </strong>
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
        <p class="date"><?= date('d',strtotime($query->date)) // by MAA - was create_date?> 
        <br>
        <span><?= date('M',strtotime($query->date)) // by MAA - was create_date ?></span>
        </p>
        <p class="time"><?= date('ga',strtotime($query->date)) // by MAA - was create_date ?></p>
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
                    <i class="fa fa-mail-forward"  style="color:#4c9628"></i>
                    <?php
                  }
                  else
                  {
                    ?>
                  <i class="fa fa-reply"></i>
                    <?php
                  }
                    ?>
            </a></span>
            <span class="lock_pi"><a href="#"><!-- <strong class="red_imp">Important</strong> --></a></span>
            </p>
            <p class="det_all"><strong><?php echo $this->lang->line('Reply');?> : </strong>
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
                                <label><span><?php echo $this->lang->line('Reply');?></span>&nbsp;[<a href="javascript:void(0)" id="ansfqa"><?php echo $this->lang->line('Answer from FAQ');?></a>]</label>
                                <?php
                                }
                                else
                                {
                                ?>
                                <label><span><?php echo $this->lang->line('Reply');?></span></label>
                                <?php
                                }
                                ?>
                                <textarea name="reply_text" id="reply" placeholder="<?php echo $this->lang->line('Enter Reply to query');?>"></textarea>
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
                               <input type="hidden" name="state" value="A">
                               <input type="hidden" name="ticket_id" value="<?= $ticketdetlist->id; ?>">
                               <input type="hidden" name="replier" value="admin">
                               <input type="hidden" name="replier_id" value="<?= $_SESSION['userid'] ?>">
                                
                                
                               <div class="form_holder">
                                <button id="buttonsubmit" class="sbmt sbmt_base sbmt_base-no-border" onclick="return checkfun();" type="submit"><i class="fa fa-spinner upload_icon"></i><?php echo $this->lang->line('Submit');?></button>
                                <button style="display:none;" id="buttondisabled" class="sbmt sbmt_base sbmt_base-no-border" type="button"><i class="fa fa-spinner upload_icon"></i><?php echo $this->lang->line('Submit');?></button>
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
       
       <!--recent_activity-->
       <!-- <div class="recent_act_box">
        <h1>Recent Activity</h1>
         <div class="sec_act">
          <div class="porfile_box">
            <div class="date_pi">
            <p>20</p><strong>March</strong>
            </div>
             <div class="time_pi">
          9pm
          </div>
          </div>
         
          <div class="right_rec">
           <p class="icon_top">
            <img src="<?= TICKET_PLUGIN_URL;?>CI/images/pic01.jpg">
           </p>
            <div class="corner">
          </div>
           <div class="left_details">
            <p class="name_pil">Suzane Marie <strong>#52</strong>
            <span class="aroe_pi"><a href="#"><i class="fa fa-reply"></i></a></span>
            <span class="lock_pi"><a href="#"><i class="fa fa-lock"></i><strong>Completed</strong></a></span>
            </p>
            <p class="det_all"><strong>Query</strong>
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since.</p>
             
           </div>
          </div>
         </div>
         
         <div class="sec_act">
          <div class="porfile_box">
            <div class="date_pi ui_pi">
            <p>20</p><strong>March</strong>
            </div>
             <div class="time_pi bhu_txt">
          9pm
          </div>
          </div>
         
          <div class="right_rec">
             <p class="icon_top">
            <img src="<?= TICKET_PLUGIN_URL;?>CI/images/pic02.jpg">
           </p>
            <div class="corner">
          </div>
           <div class="left_details">
            <p class="name_pil">Suzane Marie <strong>#52</strong>
            <span class="aroe_pi"><a href="#"><i class="fa fa-reply"></i></a></span>
            <span class="lock_pi"><a href="#"><strong class="red_imp">Important</strong></a></span>
            </p>
            <p class="det_all"><strong>Query</strong>
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since.</p>
           <div class="icon_ht"></div>
           </div>
          </div>
         </div>
         
         <div class="sec_act">
          <div class="porfile_box">
            <div class="date_pi">
            <p>20</p><strong>March</strong>
            </div>
             <div class="time_pi">
          9pm
          </div>
          </div>
         
          <div class="right_rec">
           <p class="icon_top">
            <img src="<?= TICKET_PLUGIN_URL;?>CI/images/pic03.jpg">
           </p>
            <div class="corner">
          </div>
           <div class="left_details">
            <p class="name_pil">Suzane Marie <strong>#52</strong>
            <span class="aroe_pi"><a href="#"><i class="fa fa-reply"></i></a></span>
            <span class="lock_pi"><a href="#"><i class="fa fa-lock"></i><strong>Completed</strong></a></span>
            </p>
            <p class="det_all"><strong>Query</strong>
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since.</p>
           </div>
          </div>
         </div>
         
         <div class="sec_act">
          <div class="porfile_box">
            <div class="date_pi">
            <p>20</p><strong>March</strong>
            </div>
             <div class="time_pi">
          9pm
          </div>
          </div>
         
          <div class="right_rec">
            <p class="icon_top">
            <img src="<?= TICKET_PLUGIN_URL;?>CI/images/pic04.jpg">
           </p>
            <div class="corner">
          </div>
           <div class="left_details">
            <p class="name_pil">Suzane Marie <strong>#52</strong>
            <span class="aroe_pi"><a href="#"><i class="fa fa-reply"></i></a></span>
           <span class="lock_pi"><a href="#"><strong class="red_imp">Important</strong></a></span>
            </p>
            <p class="det_all"><strong>Query</strong>
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since.</p>
           </div>
          </div>
         </div>
         
        </div>-->
       <!--/recent_activity-->
    </div>
    
  </div>
</div>
<!-- faq popup start -->

  <div id="restoreoption" class="white-popup mfp-hide">
  <form id="restoreoption_form" method="post" enctype="multipart/form-data" action="<?= TICKET_PLUGIN_URL;?>CI/index.php/backup/restorebackupFromFile">
    
          <div class="main_pro_pi">
      <div class="status-message">
      </div>
              <div class="fileds">

         <?php
         if(!empty($faqs))
         {
          $x = 1;
          foreach($faqs as $faq){ ?>
             <div class="form_holder radio">
             <label style="font-weight:bold;"><span><?php echo $x++; ?>.</span>
              <?php echo $faq->question; ?>
             </label>
              <div class="form_holder radio">
                <input name="faq_ans" type="radio" value="backup" >
                <span><?php echo nl2br($faq->answer); ?></span>
              </div>
            </div>
        <?php
          }
          ?>
          <div class="form_holder radio">
                <input name="but" class="sbmt sbmt_base sbmt_base-no-border" type="button" value="<?php echo $this->lang->line('Insert');?>" id="insbut" />
          </div>
          <?php
         }
         else
         {
          ?>
          <div><?php echo $this->lang->line('No Faqs avilable');?> !!</div>
          <?php
         }
       ?>
         
               
              </div>
    
        
         
              </div>
              <div style="clear: both;"></div>
</form>
</div>

<!-- faq popup end -->
<script type="text/javascript">
   $('#ansfqa').magnificPopup({

                items: {
                    src: '#restoreoption',
                    type: 'inline'
                },
                closeBtnInside: true
     });

   $('#insbut').click(function(){
      var answer = $('input[name="faq_ans"]:checked').next().html();
      $('#reply').val(answer);
      $('.mfp-close').click();
   });
   
   function checkfun(that)
   {
    $('#buttonsubmit').hide();
    $('#buttondisabled').show();
   }
</script>
             <style type="text/css">
              .white-popup {
                position: relative;
                background: #FFF;
				padding: 20px;
                width:auto;
                max-width: 500px;
                margin: 20px auto;
                max-height: 500px;
                overflow-y:auto;
              }
             </style>
<?php
$this->load->view('common/footer');
?>
