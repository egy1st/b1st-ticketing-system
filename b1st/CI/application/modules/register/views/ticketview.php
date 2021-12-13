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
</style>
       <!--main_section-->
       <div class="main_section">
	 
         <!--product_box-->
         <div  id="side_area">
          <div class="headding_bl">
           <p></span><?php echo $this->lang->line('Ticket No');?>:<?=$det->ticket_no;?></p>
          </div>
              <div class="t_view_left clearfix"> 
               <table class="t_view" cellpadding="0" cellspacing="0">
               <tr>
                 <th colspan="3"><h3>Ticket Info</h3></th>
               </tr>
                 <tr>
                   <td><?php echo $this->lang->line('Department');?></td><td>:</td><td><?= B1st_getDepartmentById($det->department_id,'department_name');?></td>
                 </tr> 
                 <tr>
                   <td><?php echo $this->lang->line('Product');?></td><td>:</td><td><?= B1st_getProductById($det->product_id,'product_name');?></td>
                 </tr>
                 <tr>
                   <td><?php echo $this->lang->line('Client');?></td><td>:</td><td><?= $det->customer;?></td>
                 </tr>
                 <tr>
                   <td><?php echo $this->lang->line('Posted On');?></td><td>:</td><td><?= $det->create_date ?></td>
                 </tr>
                  <tr>
                   <td><?php echo $this->lang->line('State');?></td><td>:</td><td><?= B1st_getTicketStateByCode($det->state,'name') ?></td>
                 </tr>  
               </table>
              </div>
              <div class="t_view_right clearfix"> 
               <!-- <table class="t_view" cellpadding="0" cellspacing="0">
               <tr>
                 <th colspan="3"><h3>Ticket Info</h3></th>
               </tr>
                 <tr>
                   <td>Department</td><td>:</td><td><?= B1st_getDepartmentById($det->department_id,'department_name');?></td>
                 </tr> 
                 <tr>
                   <td>Product</td><td>:</td><td><?= B1st_getProductById($det->product_id,'product_name');?></td>
                 </tr>
                 <tr>
                   <td>Posted On</td><td>:</td><td><?= $det->create_date ?></td>
                 </tr>
                  <tr>
                   <td>State</td><td>:</td><td><?= B1st_getTicketStateByCode($det->state,'name') ?></td>
                 </tr>  
               </table> -->
              </div>
   
              <div class="t_view_both clearfix">
               <ul class="pd_left">
                    <li><strong><?php echo $this->lang->line('Query');?> :</strong>
                                
                      <p class="t_view_query"><?= $det->query ?></p>
                  </li>
                    <li><strong><?php echo $this->lang->line('Client');?> : </strong> <?=$det->customer;?></li>
                    <li><strong><?php echo $this->lang->line('Posted');?> : </strong><?= B1st_smartdate($det->create_date) ?></li>
               </ul>
               <?php if(!empty($querychain)){ ?>
               <?php foreach($querychain as $query){ ?>
                  
                  <ul 
                <?php
                  if($query->replier == "admin"){
                    echo 'class="pd_left2"';
                  }
                  else
                  {
                    echo 'class="pd_left"';
                  }
                 ?>
                  >
                    <li><strong><?php echo $this->lang->line('Query');?> :</strong>
                                
                      <p class="t_view_query">
                        <?= $query->body ?>
                      </p>
                  </li>
                    <?php if($query->replier == "admin"){ ?>
                      <li><strong><?php echo $this->lang->line('Admin');?> : </strong> admin@admin.com</li>
                    <?php }else{ ?>
                      <li><strong><?php echo $this->lang->line('Client');?> : </strong> <?=$query->customer;?></li>
                    <?php } ?>
                    <li><strong><?php echo $this->lang->line('Posted');?> : </strong><?= B1st_smartdate($query->date) ?></li>
               </ul>
               <?php
                  }
                } ?>
<!-- 
                             <ul class="pd_left2">
                                  <li><strong>Query :</strong>
                                              
                                    <p class="t_view_query">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                                </li>
                                  <li><strong>Client : </strong> <?=$det->customer;?></li>
                                  <li><strong>Date and Time : </strong><?= $det->create_date ?></li>
                             </ul>
              
               -->
         <?php
         if(!empty($ticketattachment))
         {
         ?>
         <br />
         <b style="margin-left: 15px;"><?php echo $this->lang->line('Attachment');?></b>
         <div class="form_holder uploaded_img">
    <ul>
      <?php
      foreach($ticketattachment as $ticklist)
      {
      ?>
      <li><a href="<?php echo TICKET_PLUGIN_URL; ?>CI/index.php/ticket/showfile/<?php echo $ticklist->filename; ?>"><?php echo $ticklist->filename; ?></a></li>
      <?php
      }
      ?>
    </ul>
         </div>
         <?php
         }
         ?>
        </div>
               <?php if($det->state !== 'C'){  ?>
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
                                <label><span><?php echo $this->lang->line('Reply');?></span></label>
                                <textarea name="reply_text" placeholder="<?php echo $this->lang->line('Enter Reply to query');?>"></textarea>
                              </div>

                                      <!--  <div class="form_holder">
                                                      <label><span>State</span></label>
                                                      <div class="select_cover">
                                                      <select name="state">
                                           <option value="">Select State</option>
                                           <?php
                                           $states = B1st_getTicketStates();
                                           if(!empty($states))
                                           {
                                             foreach($states as $state)
                                             {
                                               $sel = $state->code == 'A' ? "selected" : "";
                                               ?>
                                               <option value="<?php echo $state->code;?>" <?= $sel ?>><?php echo stripslashes($state->name);?></option>
                                               <?php
                                             }
                                           }
                                           ?>
                                                      </select> 
                                                      </div>
                                       </div> -->
                                <input type="hidden" name="state" value="P" />
                                <input type="hidden" name="ticket_id" value="<?= $det->id; ?>">
                                <input type="hidden" name="replier" value="client">
                                <input type="hidden" name="replier_id" value="<?php echo $_SESSION['c_userid']; ?>">
                               <div class="form_holder">
                               <button class="sbmt sbmt_base sbmt_base-no-border" type="submit"><i class="fa fa-spinner upload_icon"></i><?php echo $this->lang->line('Submit');?></button>
                               </div>
                          </div>
                          <?php } ?>
                      </div>
                    </form>
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
    $this->load->view('common/chat');
}
?>
<?php
$this->load->view('front/footer');
?>
