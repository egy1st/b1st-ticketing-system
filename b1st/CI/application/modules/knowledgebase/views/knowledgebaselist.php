<?php
$this->load->view('common/header');
//echo "<pre>";
//print_r($knowledgebasedet);
//echo "</pre>";
?>
<style>
.searchbox
{
  background-color: #ffffff;
  border: 1px solid #e1e0e0;
  color: #444;
  float: left !important;
  font-size: 11px;
  height: 26px;
  margin-right: 5px !important;
  padding-left: 3px !important;
  width: 160px !important;
}
</style>
       <!--page_title-->
       <div class="page_title">
         <div class="headline">
          <h1><span><i class="fa fa-graduation-cap"></i></span><?php echo $this->lang->line('Knowledge Base');?></h1>
         </div>
         <div class="right_panel">
           <!--<a href="#" class="btn pi-btn-base pi-btn-no-border"><span class="icon_all"><i class="fa fa-inbox"></i></span>Manage categories</a>-->
           
           <!--<a href="#" class="bttn pi-btn btn-no-border"><span class="edit_all"><i class="fa fa-pencil"></i></span>Edit message</a>-->
           
           <a href="<?= TICKET_PLUGIN_URL;?>CI/index.php/knowledgebase/add" class="bttn pi-btn btn-no-border"><span class="edit_all"><i class="fa fa-plus"></i></span><?php echo $this->lang->line('Add Knowledge Base');?></a>
           
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
           <p><span><i class="fa fa-th-list"></i></span><?php echo $this->lang->line('Manage Knowledge Base');?></p>
           <form id="pageNo" action="<?= TICKET_PLUGIN_URL;?>CI/index.php/knowledgebase/index/<?= $this->uri->segment(3) ?>" method="post">
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
            
	    
	<div class="all_dro">
	  <form action="" method="get">
	    <input type="text" name="topic" class="searchbox" class="input_list" placeholder="<?php echo $this->lang->line('Search by Topic');?>" <?php if(!empty($topic)) { ?> value="<?php echo $topic;?>" <?php } ?> />
	  
	    <select name="product_id" class="input_list">
	      <option value=""><?php echo $this->lang->line('Filter by Products');?></option>
	      <?php
	      if(!empty($productdet))
	      {
		foreach($productdet as $productdetlist)
		{
		?>
		<option <?php if($product_id==$productdetlist->id) { ?> selected="true" <?php } ?> value="<?php echo $productdetlist->id;?>"><?php echo $productdetlist->product_name;?></option>
		<?php
		}
	      }
	      ?>
	    </select>
	  
	    <select name="category_id" class="input_list">
	      <option value=""><?php echo $this->lang->line('Filter by Categories');?></option>
	      <?php
	      if(!empty($catdet))
	      {
		foreach($catdet as $catdetlist)
		{
		?>
		<option <?php if($category_id==$catdetlist->id) { ?> selected="true" <?php } ?> value="<?php echo $catdetlist->id;?>"><?php echo $catdetlist->category_name;?></option>
		<?php
		}
	      }
	      ?>
	    </select>
	    
	    <button type="submit" class="pi pi_base pi-no-border"><?php echo $this->lang->line('Filter');?></button>
	  </form>
	</div>
	    
	    
	    
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
				<span class="spany"><?php echo $this->lang->line('Product Name');?></span>		
			</th>
			<th>
				<span class="spany"><?php echo $this->lang->line('Category Name');?></span>		
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
		  if(!empty($knowledgebasedet))
		  {
			$i=1;
			foreach($knowledgebasedet as $knowledgebasedetlist)
			{
			  //echo "<pre>";
			  //print_r($knowledgebasedetlist);
			  //echo "</pre>";
			?>
			<tr <?php if($i%2==0) { ?> class="white" <?php } else  { ?> class="gray" <?php } ?>>
			     
			     <td><?php echo stripslashes($knowledgebasedetlist->topic);?></td>
			     <td><?php echo stripslashes($knowledgebasedetlist->product_name);?></td>
			     <td><?php echo stripslashes($knowledgebasedetlist->category_name);?></td>
			     <!--<td><?php //echo stripslashes($knowledgebasedetlist->subject);?></td>-->
			     <!--<td><?php //echo stripslashes($knowledgebasedetlist->company);?></td>-->
			     <!--<td><?php //echo stripslashes($knowledgebasedetlist->customer);?></td>-->
			     <td <?php if($knowledgebasedetlist->status==1) { ?> class="act" <?php } if($knowledgebasedetlist->status==0) { ?> class="inact" <?php } ?>>
				<?php
				if($knowledgebasedetlist->status==1)
				{
				     ?>
				     <p><a style="color:#fff;" href="<?= TICKET_PLUGIN_URL;?>CI/index.php/knowledgebase/statuschange/<?php echo $knowledgebasedetlist->id;?>"><?php echo $this->lang->line('Active');?></a></p>
				     <?php
				}
				if($knowledgebasedetlist->status==0)
				{
				     ?>
				     <p><a style="color:#fff;" href="<?= TICKET_PLUGIN_URL;?>CI/index.php/knowledgebase/statuschange/<?php echo $knowledgebasedetlist->id;?>"><?php echo $this->lang->line('Inactive');?></a></p>
				     <?php
				}
				?>
			     </td>
			     <!--<td <?php //if($knowledgebasedetlist->priorty=="High") { ?> class="highp" <?php //} if($knowledgebasedetlist->priorty=="Medium") { ?> class="medp" <?php //} if($knowledgebasedetlist->priorty=="Low") { ?> class="lowp" <?php //} ?>>-->
				     <!--<p><?php //echo $knowledgebasedetlist->priorty;?></p>	-->
			     <!--</td>-->

			     <td>	
				     <button type="submit" class="edit_button bitn nuc_bl has-tip" title="<?php echo $this->lang->line('Edit');?>" onclick="window.location.href='<?= TICKET_PLUGIN_URL;?>CI/index.php/knowledgebase/edit/<?php echo $knowledgebasedetlist->id;?>'"><i class="fa fa-pencil"></i></button>
				     <!-- <button type="submit" class="edit_button bitn nuc_bl"><i class="fa fa-eye"></i>View</button> -->
            <?php
               $settings = (array)B1st_getSettingsValue('delete_confirmation');
               $txt = '';
               if($settings['type'] == 1)
               {
		$conftxt=$this->lang->line('Are you sure you want to delete this knowledge base Permanently');
                $txt = "getConfirmation('".$conftxt.".','".TICKET_PLUGIN_URL."CI/index.php/knowledgebase/deleteknowledgebase/". $knowledgebasedetlist->id."')";
               }
               else
               {
                $txt = "window.location.href='".TICKET_PLUGIN_URL."CI/index.php/knowledgebase/deletecompany/".$knowledgebasedetlist->id."'";
               }
            ?>

				     <button type="submit" class="edit_button bitn nuc_bl has-tip" title="<?php echo $this->lang->line('Delete');?>" onclick="<?= $txt ?>"><i class="fa fa-trash-o"></i></button>
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
