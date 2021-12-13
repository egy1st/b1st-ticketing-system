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
           <?php if(B1st_check_privilege($_SESSION['userid'],'AT')){ ?>
               <a href="<?= TICKET_PLUGIN_URL;?>CI/index.php/ticket/add" class="bttn pi-btn btn-no-border"><span class="edit_all"><i class="fa fa-plus"></i></span><?php echo $this->lang->line('Add Ticket');?></a>
           <?php } ?>

          <?php if(B1st_check_privilege($_SESSION['userid'],'TTAA')){ ?>
              <a href="<?= TICKET_PLUGIN_URL;?>CI/index.php/assignticket/transferTicket" class="bttn pi-btn btn-no-border"><span class="edit_all"><i class="fa fa-exchange"></i></span><?php echo $this->lang->line('Transfer Ticket');?></a>
          <?php } ?>

          <?php if(B1st_check_privilege($_SESSION['userid'],'ATTA')){ ?>
              <a href="<?= TICKET_PLUGIN_URL;?>CI/index.php/assignticket" class="bttn pi-btn btn-no-border"><span class="edit_all"><i class="fa fa-magic"></i></span><?php echo $this->lang->line('Assign Ticket');?></a>
          <?php } ?>
           <!--<a href="#"  class="bttn pi-btn btn-no-border"><span class="edit_all"><i class="fa fa-times"></i></span>Delete message</a>-->
         </div>
       </div>
       <!--/page_title-->
       <!--main_section-->
       <div class="main_section">
       
       <div class="show_ticketpanel">
            <span class="tic">Tickets</span><span class="edit_all"><i class="fa fa-angle-double-right"></i></span> 
       </div>
       
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
            <form id="pageNo" action="<?= TICKET_PLUGIN_URL;?>CI/index.php/ticket/index/<?= $this->uri->segment(3) ?>" method="post">
              <?php echo $this->lang->line('Show');?>&nbsp;<select name="perpage" onchange="$('#pageNo').submit()">
               <?php $array = array(5,10,20,40,80,100); 
               foreach($array as $no){
                $sel = $no == $noPage ? 'selected':'';
               ?>
                <option value="<?= $no ?>" <?= $sel ?>><?= $no ?></option>
               <?php } ?>
              </select>&nbsp;<?php echo $this->lang->line('Entries');?>
            </form>
           </p>
          </div>
          <div class="main_pro_pi">
           
           
         <div class="child_cake">
            <div class="drop_down_pi">
             
                <?= $pagination ?>
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
  			<th>
  				<span class="spany"><?php echo $this->lang->line('Action');?></span>	
  			</th>
		   </tr>
       </thead>
		   <tbody>
		   <?php
		  if(!empty($ticketdet))
		  {
			$i=1;
			foreach($ticketdet as $ticketdetlist)
			{
			?>
			<tr <?php if($i%2==0) { ?> class="white" <?php } else  { ?> class="gray" <?php } ?>>
			     
			     <td><?php echo stripslashes($ticketdetlist->ticket_no);?></td>
			     <td>
			     <?php
			     echo stripslashes($ticketdetlist->subject);
			     if($ticketdetlist->spam == 1)
			      {
				echo "<br/><strong class='scanthreat'>[Spam]</strong>";
			      }
			     ?>
			     </td>
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
                  $d = B1st_smartdate($ticketdetlist->modified_date);  // by MAA
                  echo str_replace('ago',"",$d);
                }
                else if($timesettings['type'] == 1)
                {
                  echo date('d-m-y h:i:s A',strtotime($ticketdetlist->modified_date)); // by Maa
                }
               ?></td>
			     <td>	
				     <?php if(B1st_check_privilege($_SESSION['userid'],'ET')){ ?>
             <button type="submit" class="edit_button bitn nuc_bl has-tip" title="<?php echo $this->lang->line('Edit');?>" onclick="window.location.href='<?= TICKET_PLUGIN_URL;?>CI/index.php/ticket/edit/<?php echo $ticketdetlist->id;?>'"><i class="fa fa-pencil"></i></button>
            <?php } ?>
				     <button type="submit" class="edit_button bitn nuc_bl has-tip" title="<?php echo $this->lang->line('View');?>" onclick="window.location.href='<?= TICKET_PLUGIN_URL;?>CI/index.php/ticket/newviewTicket/<?php echo $ticketdetlist->id;?>'"><i class="fa fa-eye"></i></button>
             <?php if(B1st_check_privilege($_SESSION['userid'],'DT')){ ?>
				    
              <?php
               $settings = (array)B1st_getSettingsValue('delete_confirmation');
               $txt = '';
               if($settings['type'] == 1)
               {
		$conftxt=$this->lang->line('Are you sure you want to delete this Ticket Permanently');
                $txt = "getConfirmation('".$conftxt.".','".TICKET_PLUGIN_URL."CI/index.php/ticket/deleteticket/". $ticketdetlist->id."')";
               }
               else
               {
                $txt = "window.location.href='".TICKET_PLUGIN_URL."CI/index.php/ticket/deleteticket/".$ticketdetlist->id."'";
               }
            ?>

             <button type="submit" class="edit_button bitn nuc_bl has-tip" title="<?php echo $this->lang->line('Delete');?>" onclick="<?= $txt ?>"><i class="fa fa-trash-o"></i></button>
             <?php } ?>
			     </td>
			</tr>
			<?php
			$i++;
			}
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
            <p class="det_all"><strong>Milestone Title</strong>
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
            <p class="det_all"><strong>Milestone Title</strong>
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
            <p class="det_all"><strong>Milestone Title</strong>
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
            <p class="det_all"><strong>Milestone Title</strong>
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since.</p>
           </div>
          </div>
         </div>
         
        </div>-->
       <!--/recent_activity-->
    </div>
    
  </div>
</div>
<?php
$this->load->view('common/footer');
?>
