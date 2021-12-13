<?php
$this->load->view('common/header');
//echo "<pre>";
//print_r($companydet);
//echo "</pre>";
$privilegegroupid=$_SESSION['privilege_group_id'];
?>
       <!--page_title-->
       <div class="page_title">
         <div class="headline">
          <h1><span><i class="fa fa-database"></i></span><?php echo $this->lang->line('Backup');?></h1>
         </div>
         <div class="right_panel">
           <!--<a href="#" class="btn pi-btn-base pi-btn-no-border"><span class="icon_all"><i class="fa fa-inbox"></i></span>Manage categories</a>-->
           
           <!--<a href="#" class="bttn pi-btn btn-no-border"><span class="edit_all"><i class="fa fa-pencil"></i></span>Edit message</a>-->
           
           <a id="backupNow" href="<?= TICKET_PLUGIN_URL;?>CI/index.php/backup/doBackup" class="bttn pi-btn btn-no-border"><span class="edit_all"><i class="fa fa-database"></i></span><?php echo $this->lang->line('Backup Now');?></a>

            <?php if(!B1st_is_dir_empty(TICKET_PLUGIN_PATH.'/backup/')){ ?>
              <a id="backupNow" href="javascript:void(0)" onclick="getConfirmation('Progress to download.','<?= TICKET_PLUGIN_URL;?>CI/index.php/backup/downloadbackup/name/2')" class="bttn pi-btn btn-no-border"><span class="edit_all"><i class="fa fa-cloud-download"></i></span><?php echo $this->lang->line('Download All');?></a>
            <?php } ?>

            <?php if(!B1st_is_dir_empty(TICKET_PLUGIN_PATH.'/CI/assets/attachments/')){ ?>
            <a id="backupNow" href="javascript:void(0)" onclick="getConfirmation('Progress to download.','<?= TICKET_PLUGIN_URL;?>CI/index.php/backup/downloadbackup/name/3')" class="bttn pi-btn btn-no-border"><span class="edit_all"><i class="fa fa-file-zip-o"></i></span><?php echo $this->lang->line('Download Attachments');?></a>
           <?php } ?>
	   <?php
	   if($privilegegroupid==1)
	   {
	    ?>
              <a id="backupRestore" href="<?= TICKET_PLUGIN_URL;?>CI/index.php/backup/doBackup" class="bttn pi-btn btn-no-border"><span class="edit_all"><i class="fa fa-file"></i></span><?php echo $this->lang->line('Restore From File');?></a>
	    <?php
	   }
	   ?>
           

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
           <p><span><i class="fa fa-th-list"></i></span><?php echo $this->lang->line('Manage Backup');?></p>
          <!--  <form id="pageNo" action="<?= TICKET_PLUGIN_URL;?>CI/index.php/backup/index/<?= $this->uri->segment(3) ?>" method="post">
             Show&nbsp;<select name="perpage" onchange="$('#pageNo').submit()">
              <?php $array = array(5,10,20,40,80,100); 
              foreach($array as $no){
               $sel = $no == $noPage ? 'selected':'';
              ?>
               <option value="<?= $no ?>" <?= $sel ?>><?= $no ?></option>
              <?php } ?>
             </select>&nbsp;Entries
           </form> -->
          </div>
          <div class="main_pro_pi">
           
           
         <div class="child_cake">
           
            
              <div class="main_panel">

		<table class="dibya tablesorter tableSort" cellpadding="0" cellspacing="0">
	   <thead>
     <tr>
			<th>
				<span class="spany"><?php echo $this->lang->line('Name');?></span>		
			</th>
			<th>
				<span class="spany"><?php echo $this->lang->line('Creation');?></span>	
			</th>
			<td>
				<span class="spany"><?php echo $this->lang->line('Action');?></span>	
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
				     <?php
				     if($privilegegroupid==1)
				     {
				    ?>
				     <button type="submit" class="edit_button bitn nuc_bl has-tip" title="<?php echo $this->lang->line('Restore');?>" onclick="getConfirmation('<?php echo $this->lang->line('Are you sure you want to Restore this backup .All current data will be erased');?>','<?= TICKET_PLUGIN_URL;?>CI/index.php/backup/restorebackup/<?php echo $backup['name'];?>')" ><i class="fa fa-bolt"></i></button>
				     <button type="submit" class="edit_button bitn nuc_bl has-tip" title="<?php echo $this->lang->line('Delete');?>" onclick="getConfirmation('<?php echo $this->lang->line('Are you sure you want to delete this backup Permenantly.');?>','<?= TICKET_PLUGIN_URL;?>CI/index.php/backup/deletebackup/<?php echo $backup['name'];?>')"><i class="fa fa-trash-o"></i></button>
				     <?php
				     }
				     ?>
             <button type="submit" class="edit_button bitn nuc_bl has-tip" title="<?php echo $this->lang->line('Download');?>" onclick="getConfirmation('<?php echo $this->lang->line('Progress to download');?>','<?= TICKET_PLUGIN_URL;?>CI/index.php/backup/downloadbackup/<?php echo $backup['name'];?>')"><i class="fa fa-download"></i></button>
             <!-- <button type="submit" class="edit_button bitn nuc_bl" id="backupDel"><i class="fa fa-trash-o"></i>Delete</button> -->
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
  <!-- backup popup HTML start -->

  <div id="backupoption" class="white-popup mfp-hide">
  <form id="backupoption_form" method="post" action="<?= TICKET_PLUGIN_URL;?>CI/index.php/backup/doBackup">
    
          <div class="main_pro_pi">
      <div class="status-message">
      </div>
              <div class="fileds">
        
              <div class="form_holder radio">
              <label><span><?php echo $this->lang->line('Backup Type');?></span></label>
               <div class="form_holder radio" style="width:150px;float: left;">
                 <input name="backup_type" type="radio" value="all" checked="checked"> <?php echo $this->lang->line('Data+Config');?>
               </div>
               <div class="form_holder radio" style="width:150px;float: left;">
                 <input name="backup_type" type="radio" value="data"> <?php echo $this->lang->line('Data Only');?>
               </div>
               <div class="form_holder radio" style="width:150px;float: left;">
                 <input name="backup_type" type="radio" value="config"> <?php echo $this->lang->line('Config Only');?>
               </div>
               </div>

    <div class="form_holder">
      <label><span><?php echo $this->lang->line('Backup Name');?></span></label>
      <input type="text" value="" placeholder="<?php echo $this->lang->line('Backup File Name');?>" name="backup_name">
    </div>
         
               
               <!--<div class="form_holder">-->
               <!--  <label><span>Backup Description</span></label>-->
               <!--  <textarea name="backup_description" cols="" rows=""></textarea>-->
               <!--</div>-->
               
               <!-- <div class="form_holder radio">
                 <label><span>Radio</span></label>
                 <input name="" type="checkbox" value=""> Checkbox
               </div> -->
               
               
               <div class="form_holder">
               <button type="submit" class="sbmt sbmt_base sbmt_base-no-border"><i class="fa fa-spinner upload_icon"></i><?php echo $this->lang->line('Backup Now');?></button>
               </div>
               
              </div>
    
        
         
              </div>
              <div style="clear: both;"></div>
</form>
</div>

  <!-- backup popup HTML end -->

   <!-- restore popup HTML start -->
  <div id="restoreoption" class="white-popup mfp-hide">
  <form id="restoreoption_form" method="post" enctype="multipart/form-data" action="<?= TICKET_PLUGIN_URL;?>CI/index.php/backup/restorebackupFromFile">
    
          <div class="main_pro_pi">
      <div class="status-message">
      </div>
              <div class="fileds">
        
             <div class="form_holder radio">
             <label><span><?php echo $this->lang->line('Restore Type');?></span></label>
              <div class="form_holder radio" style="width:150px;float: left;">
                <input name="restore_type" type="radio" value="backup" checked="checked"> <?php echo $this->lang->line('Backup');?>
              </div>
              <div class="form_holder radio" style="width:150px;float: left;">
                <input name="restore_type" type="radio" value="attachment"> <?php echo $this->lang->line('Attachments');?>
              </div>
              </div>

    <div class="form_holder">
      <label><span><?php echo $this->lang->line('Select File');?></span></label>
      <input type="file" name="restore_file">
    </div>
         
               
               <!-- <div class="form_holder">
                 <label><span>Backup Description</span></label>
                 <textarea name="backup_description" cols="" rows=""></textarea>
               </div> -->
               
               <!-- <div class="form_holder radio">
                 <label><span>Radio</span></label>
                 <input name="" type="checkbox" value=""> Checkbox
               </div> -->
               
               
               <div class="form_holder">
               <button type="submit" class="sbmt sbmt_base sbmt_base-no-border"><i class="fa fa-spinner upload_icon"></i><?php echo $this->lang->line('Restore Now');?></button>
               </div>
               
              </div>
    
        
         
              </div>
              <div style="clear: both;"></div>
</form>
</div>

  <!-- restore popup HTML end -->
   <script>
     $('#backupNow').magnificPopup({
                items: {
                    src: '#backupoption',
                    type: 'inline'
                },
                closeBtnInside: true
     });

     $('#backupRestore').magnificPopup({
                items: {
                    src: '#restoreoption',
                    type: 'inline'
                },
                closeBtnInside: true
     });

     $("#backupoption_form").submit(function(e){
      $('.status-message').html('<img src="<?= TICKET_PLUGIN_URL;?>CI/assets/images/icon_loading.gif" />').css({"text-align":"center"});
       var form = $(this);
       var submitbtn = $(this).find('button[type="submit"]');
       submitbtn.attr('disabled',true);
       var url = $(this).attr('action'),
       data = $(this).serialize(); 
       $.ajax({
        url: url,
        data:data,
        type:"POST",
        success:function(data){
           submitbtn.attr('disabled',false);
           obj = $.parseJSON(data);
           if(obj.status == 0)
           {
           $('.status-message').html(obj.msg).fadeIn('slow').delay(2000).fadeOut('slow');
           }

           if(obj.status == 1)
           {
           $('.status-message').html(obj.msg).fadeIn('slow').delay(2000).fadeOut('slow',function(){

            form[0].reset();
            $.magnificPopup.close();
            window.location.href="<?= TICKET_PLUGIN_URL;?>CI/index.php/backup";
           });
           }

        }
       });
      e.preventDefault();
      return false;
     });

         $("#restoreoption_form").submit(function(e){
          $('.status-message').html('<img src="<?= TICKET_PLUGIN_URL;?>CI/assets/images/icon_loading.gif" />').css({"text-align":"center"});
       var form = $(this);
       var submitbtn = $(this).find('button[type="submit"]');
       submitbtn.attr('disabled',true);
       var url = $(this).attr('action'),
       data = new FormData($(this)[0]); 
      
       $.ajax({
          url: url,
          data: data,
          async: false,
          cache: false,
          contentType: false,
          processData: false,
          type:"POST",
        success:function(data){
           submitbtn.attr('disabled',false);
           obj = $.parseJSON(data);
           if(obj.status == 0)
           {
           $('.status-message').html(obj.msg).fadeIn('slow').delay(2000).fadeOut('slow');
           }

           if(obj.status == 1)
           {
           $('.status-message').html(obj.msg).fadeIn('slow').delay(2000).fadeOut('slow',function(){

            form[0].reset();
            $.magnificPopup.close();
            window.location.href="<?= TICKET_PLUGIN_URL;?>CI/index.php/backup";
           });
           }

        }
       });
      e.preventDefault();
      return false;
     });
  </script>
             <style type="text/css">
              .white-popup {
                position: relative;
                background: #FFF;
                padding: 20px;
                width:auto;
                max-width: 500px;
                margin: 20px auto;
              }
             </style>
</div>
<?php
$this->load->view('common/footer');
?>
