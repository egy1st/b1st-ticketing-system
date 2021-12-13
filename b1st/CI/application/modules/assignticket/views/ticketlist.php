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

          <?php if(B1st_check_privilege($_SESSION['userid'],'AT')){ ?>
              <a href="<?= TICKET_PLUGIN_URL;?>CI/index.php/assignticket" class="bttn pi-btn btn-no-border"><span class="edit_all"><i class="fa fa-magic"></i></span><?php echo $this->lang->line('Assign Ticket');?></a>
          <?php } ?>
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
           <p><span><i class="fa fa-th-list"></i></span><?php echo $this->lang->line('Manage Tickets Assignment');?>
            <form id="pageNo" action="<?= TICKET_PLUGIN_URL;?>CI/index.php/assignticket/index/<?= $this->uri->segment(3) ?>" method="post">
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
             <div class="all_dro">
             <strong><?php echo $this->lang->line('Assign Multiple Tickets To admin');?> :</strong>
<form action="<?= TICKET_PLUGIN_URL;?>CI/index.php/assignticket/multiticketassign" method="post">
             <input type="hidden" id="mticket_id" name="mticket_id" value="">
                   
                <div>
                        <select class="input_list" name="admin_id" onchange="changeMultiAssignment(this)">
					<option value="0"><?php echo $this->lang->line('Select');?></option>
              <option value="1"><?php echo $this->lang->line('Super Admin');?></option>
                                                        <?php
                                                          if(!empty($users))
                                                          {
                                                            foreach($users as $user)
                                                            {
                                                              if($user->id != '1')
                                                              {
                                                              ?>
          <option value="<?= $user->id ?>" 
               
              ><?= $user->username ?></option>
                                                              <?php
                                                            }
                                                          }
                                                          }
                                                        ?>
                        </select> 
                </div>
                                     
             </form>
</div>
                <?= $pagination ?>
            </div>
            
              <div class="main_panel">

		<table class="dibya tablesorter tableSort" cellpadding="0" cellspacing="0">
	   <thead>
     <tr>
        <td>
          <span class="spany">#</span>
        </td>
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
  				<span class="spany"><?php echo $this->lang->line('Assigned To');?></span>	
  			</td>
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
			     <td><input type="checkbox" class="multiticketassign" name="assign[]" value="<?= $ticketdetlist->id ?>" /></td>
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
                  $d = B1st_smartdate($ticketdetlist->create_date); 
                  echo str_replace('ago',"",$d);
                }
                else if($timesettings['type'] == 1)
                {
                  echo date('d-m-y h:i:s A',strtotime($ticketdetlist->create_date));
                }
               ?></td>
			     <td>	
				     <form action="<?= TICKET_PLUGIN_URL;?>CI/index.php/assignticket/ticketassign" method="post">
             <input type="hidden" name="ticket_id" value="<?= $ticketdetlist->id ?>">
                   
                <div class="select_cover">
                        <select name="admin_id" onchange="changeAssignment(this)">
                                        <option value="1"><?php echo $this->lang->line('Super Admin');?></option>
                                                        <?php
                                                          if(!empty($users))
                                                          {
                                                            foreach($users as $user)
                                                            {
                                                              if($user->id != '1')
                                                              {
                                                              ?>
          <option value="<?= $user->id ?>" 
              <?php if(B1st_checkAdminTicketAssignment($ticketdetlist->id,$user->id)) 
                echo "selected"; 
              ?>  
              ><?= $user->username ?></option>
                                                              <?php
                                                            }
                                                          }
                                                          }
                                                        ?>
                        </select> 
                </div>
                                     
             </form>
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
       <script type="text/javascript">
       function changeAssignment(form)
       {
          $(form).parent().parent().submit();
       }

        function changeMultiAssignment(form)
       {
        if($('.multiticketassign:checked').length == 0 )
        {
          alert('No ticket selected !!');
          return;
        }
         var tids = [];
          $.each($('.multiticketassign:checked'),function(i,e){
             tids.push($(e).val());
          });

          $('#mticket_id').val(tids.join(','));

           $(form).parent().parent().submit();
          
       }
       </script>
    </div>
    
  </div>
</div>
<?php
$this->load->view('common/footer');
?>
