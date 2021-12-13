<?php
$this->load->view('common/header');
//echo "<pre>";
//print_r($companydet);
//echo "</pre>";
?>
       <!--page_title-->
       <div class="page_title">
         <div class="headline">
          <h1><span><i class="fa fa-users"></i></span><?php echo $this->lang->line('Users');?></h1>
         </div>
         <div class="right_panel">
           <!--<a href="#" class="btn pi-btn-base pi-btn-no-border"><span class="icon_all"><i class="fa fa-inbox"></i></span>Manage categories</a>-->
           
           <!--<a href="#" class="bttn pi-btn btn-no-border"><span class="edit_all"><i class="fa fa-pencil"></i></span>Edit message</a>-->

           <a href="<?= TICKET_PLUGIN_URL;?>CI/index.php/users/add" class="bttn pi-btn btn-no-border"><span class="edit_all"><i class="fa fa-plus"></i></span><?php echo $this->lang->line('Add Admin');?></a>
           
                      <a href="<?= TICKET_PLUGIN_URL;?>CI/index.php/users/clientList" class="bttn pi-btn btn-no-border"><span class="edit_all"><i class="fa fa-users"></i></span><?php echo $this->lang->line('View Clients');?></a>

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
           <p><span><i class="fa fa-th-list"></i></span><?php echo $this->lang->line('Manage Users');?></p>
           <form id="pageNo" action="<?= TICKET_PLUGIN_URL;?>CI/index.php/users/index/<?= $this->uri->segment(3) ?>" method="post">
              <?php echo $this->lang->line('Show');?>&nbsp;<select name="perpage" onchange="$('#pageNo').submit()">
               <?php $array = array(5,10,20,40,80,100); 
               foreach($array as $no){
                $sel = $no == $noPage ? 'selected':'';
               ?>
                <option value="<?= $no ?>" <?= $sel ?>><?= $no ?></option>
               <?php } ?>
              </select>&nbsp;<?php echo $this->lang->line('Entries');?>
            </form>
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
				<span class="spany"><?php echo $this->lang->line('Name');?></span>		
			</th>
      <th>
        <span class="spany"><?php echo $this->lang->line('Privilege Group');?></span>   
      </th>
      <th>
				<span class="spany"><?php echo $this->lang->line('Status');?></span>	
			</th>
			<td>
				<span class="spany"><?php echo $this->lang->line('Action');?></span>	
			</td>
		   </tr>
     <thead>
     <tbody>		   
		   <?php
		  if(!empty($userdet))
		  {
			$i=1;
			foreach($userdet as $userdetlist)
			{
			?>
			<tr <?php if($i%2==0) { ?> class="white" <?php } else  { ?> class="gray" <?php } ?>>
			     
			     <td><?php echo stripslashes($userdetlist->firstname).' '.stripslashes($userdetlist->lastname);?></td>
			     <td><?php echo stripslashes(B1st_getPrivilegeGroupById($userdetlist->privilege_group_id,'privilege_name'));?>
           </td>
			     <!--<td><?php //echo stripslashes($companydetlist->company);?></td>-->
			     <!--<td><?php //echo stripslashes($companydetlist->customer);?></td>-->
			     <td <?php if($userdetlist->status==1) { ?> class="act" <?php } if($userdetlist->status==0) { ?> class="inact" <?php } ?>>
				<?php if(B1st_admin_check($userdetlist->id,$_SESSION['userid'])) { ?>
        
        <?php if($userdetlist->id != $_SESSION['userid']){ ?>
        <?php
				if($userdetlist->status==1)
				{
				     ?>
				     <p><a style="color:#fff;" href="<?= TICKET_PLUGIN_URL;?>CI/index.php/users/statuschange/<?php echo $userdetlist->id;?>"><?php echo $this->lang->line('Active');?></a></p>
				     <?php
				}
				if($userdetlist->status==0)
				{
				     ?>
				     <p><a style="color:#fff;" href="<?= TICKET_PLUGIN_URL;?>CI/index.php/users/statuschange/<?php echo $userdetlist->id;?>"><?php echo $this->lang->line('Inactive');?></a></p>
				     <?php
				}
       }
      }
				?>
			     </td>
			     <!--<td <?php //if($companydetlist->priorty=="High") { ?> class="highp" <?php //} if($companydetlist->priorty=="Medium") { ?> class="medp" <?php //} if($companydetlist->priorty=="Low") { ?> class="lowp" <?php //} ?>>-->
				     <!--<p><?php //echo $companydetlist->priorty;?></p>	-->
			     <!--</td>-->

			     <td>	
            <?php if(B1st_admin_check($userdetlist->id,$_SESSION['userid'])) { ?>
				     <button type="submit" class="edit_button bitn nuc_bl has-tip" title="<?php echo $this->lang->line('Edit');?>" onclick="window.location.href='<?= TICKET_PLUGIN_URL;?>CI/index.php/users/edit/<?php echo $userdetlist->id;?>'"><i class="fa fa-pencil"></i></button>
				    <!--  <button type="submit" class="edit_button bitn nuc_bl"><i class="fa fa-eye"></i>View</button> -->
            <?php if($userdetlist->id != $_SESSION['userid']){ ?>

              <?php
               $settings = (array)B1st_getSettingsValue('delete_confirmation');
               $txt = '';
               if($settings['type'] == 1)
               {
                $txt = "getConfirmation('".$this->lang->line('Are you sure you want to delete this User Permenantly.')."','".TICKET_PLUGIN_URL."CI/index.php/users/deleteuser/". $userdetlist->id."')";
               }
               else
               {
                $txt = "window.location.href='".TICKET_PLUGIN_URL."CI/index.php/users/deleteuser/".$userdetlist->id."'";
               }
            ?>

				     <button type="submit" class="edit_button bitn nuc_bl has-tip" title="<?php echo $this->lang->line('Delete');?>" onclick="<?= $txt ?>"><i class="fa fa-trash-o"></i></button>
              <?php } ?>
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
       

    </div>
    
  </div>
</div>
<?php
$this->load->view('common/footer');
?>
