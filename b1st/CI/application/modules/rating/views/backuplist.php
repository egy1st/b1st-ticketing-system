<?php
$this->load->view('common/header');
//echo "<pre>";
//print_r($companydet);
//echo "</pre>";
?>
       <!--page_title-->
       <div class="page_title">
         <div class="headline">
          <h1><span><i class="fa fa-envelope"></i></span>Message</h1>
         </div>
         <div class="right_panel">
           <!--<a href="#" class="btn pi-btn-base pi-btn-no-border"><span class="icon_all"><i class="fa fa-inbox"></i></span>Manage categories</a>-->
           
           <!--<a href="#" class="bttn pi-btn btn-no-border"><span class="edit_all"><i class="fa fa-pencil"></i></span>Edit message</a>-->
           
           <a href="<?= TICKET_PLUGIN_URL;?>CI/index.php/backup/doBackup" class="bttn pi-btn btn-no-border"><span class="edit_all"><i class="fa fa-plus"></i></span>Backup Now</a>
           
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
           <p><span><i class="fa fa-th-list"></i></span>Manage Companies</p>
           <form id="pageNo" action="<?= TICKET_PLUGIN_URL;?>CI/index.php/backup/index/<?= $this->uri->segment(3) ?>" method="post">
              Show&nbsp;<select name="perpage" onchange="$('#pageNo').submit()">
               <?php $array = array(5,10,20,40,80,100); 
               foreach($array as $no){
                $sel = $no == $noPage ? 'selected':'';
               ?>
                <option value="<?= $no ?>" <?= $sel ?>><?= $no ?></option>
               <?php } ?>
              </select>&nbsp;Entries
            </form>
          </div>
          <div class="main_pro_pi">
           
           
         <div class="child_cake">
            <div class="drop_down_pi">
             <div class="all_dro">
             <form action="" method="get">
             <select name="cars" class="input_list">
<option value="volvo">Builk Actions</option>
<option value="saab">1</option>
<option value="fiat">2</option>
<option value="audi">3</option>
</select>

<select name="cars" class="input_list">
<option value="volvo">Show All Dates</option>
<option value="saab">1</option>
<option value="fiat">2</option>
<option value="audi">3</option>
</select>

<select name="cars" class="input_list">
<option value="volvo">View All Categories</option>
<option value="saab">1</option>
<option value="fiat">2</option>
<option value="audi">3</option>
</select>

 <button type="submit" class="pi pi_base pi-no-border">Filter</button>
             </form>
             </div>
         <?= $pagination ?>
            </div>
            
              <div class="main_panel">

		<table class="dibya tablesorter tableSort" cellpadding="0" cellspacing="0">
	   <thead>
     <tr>
			<th>
				<span class="spany">Name</span>		
			</th>
			<th>
				<span class="spany">Creation</span>	
			</th>
			<td>
				<span class="spany">Action</span>	
			</td>
		   </tr>
     <thead>
     <tbody>		   
		   <?php
		  if(!empty($backups))
		  {
			$i=1;
			foreach($backups as $backup)
			{
			?>
			<tr <?php if($i%2==0) { ?> class="white" <?php } else  { ?> class="gray" <?php } ?>>
			     
			     <td><?php echo stripslashes($backup['name']);?></td>
			     <!--<td><?php //echo stripslashes($companydetlist->subject);?></td>-->
			     <!--<td><?php //echo stripslashes($companydetlist->company);?></td>-->
			     <!--<td><?php //echo stripslashes($companydetlist->customer);?></td>-->
			     <td >
				  <?php echo stripslashes(date('d/m/Y H:i:s A',$backup['created']));?>
			     </td>
			     <!--<td <?php //if($companydetlist->priorty=="High") { ?> class="highp" <?php //} if($companydetlist->priorty=="Medium") { ?> class="medp" <?php //} if($companydetlist->priorty=="Low") { ?> class="lowp" <?php //} ?>>-->
				     <!--<p><?php //echo $companydetlist->priorty;?></p>	-->
			     <!--</td>-->

			     <td>	
				     <!-- <button type="submit" class="edit_button nuc_bl" onclick="window.location.href='<?= TICKET_PLUGIN_URL;?>CI/index.php/company/edit/<?php echo $companydetlist->id;?>'"><i class="fa fa-pencil"></i>Edit</button> -->
				     <button type="submit" class="edit_button bitn nuc_bl" onclick="getConfirmation('Are you sure you want to Restore this backup.All current data will be erased','<?= TICKET_PLUGIN_URL;?>CI/index.php/backup/restorebackup/<?php echo $backup['name'];?>')" ><i class="fa fa-eye"></i>Restore</button>
				     <button type="submit" class="edit_button bitn nuc_bl" onclick="getConfirmation('Are you sure you want to delete this backup Permenantly.','<?= TICKET_PLUGIN_URL;?>CI/index.php/backup/deletebackup/<?php echo $backup['name'];?>')"><i class="fa fa-trash-o"></i>Delete</button>
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
				No records found
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
<script type="text/javascript">
  function getConfirmation(txt,url)
  {
    $c = confirm(txt)
    if($c)
    {
      window.location.href= url;
    }
  }
</script>
<?php
$this->load->view('common/footer');
?>