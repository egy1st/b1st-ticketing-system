<?php $this->load->view('common/header'); ?>
       <!--page_title-->
       <div class="page_title">
         <div class="headline">
          <h1><span><i class="fa fa-question-circle"></i></span><?php echo $this->lang->line('FAQ');?></h1>
         </div>
         <div class="right_panel">
           <a href="<?= TICKET_PLUGIN_URL;?>CI/index.php/faq" class="bttn pi-btn btn-no-border"><span class="edit_all"><i class="fa fa-inbox"></i></span><?php echo $this->lang->line('Manage FAQs');?></a>
         </div>
       </div>
       <!--/page_title-->
       <!--main_section-->
       <?php
	$valerror=validation_errors();
	 if(!empty($valerror))
	 {
	  ?>
	  <div class="errorMsg">
	      <?php echo $valerror; ?>
	  </div>
	 <?php
	 }
       ?>
       <div class="main_section">
       <!--another_extra_area-->
         <?php $this->load->view('common/ticketpanel');?>
         <!--/another_extra_area-->
         <!--vertical_menu-->
          <!--<div class="left_ver" id="change_bar">
          <span><i class="fa fa-angle-double-right"></i></span>
          </div>-->
         <!--/vertical_menu-->
	 
	 
         <!--product_box-->
         <div class="product_box" id="side_area">
          <div class="headding_bl">
           <p><span><i class="fa fa-th-list"></i></span><?php echo $this->lang->line('Add FAQ');?></p>
          </div>
	  
	  <form action="<?= TICKET_PLUGIN_URL;?>CI/index.php/faq/insert" method="post">
	  
          <div class="main_pro_pi">
               
               <div class="fileds">
               
	        <div class="form_holder">
                 <label><span><?php echo $this->lang->line('Product');?></span></label>
                 <div class="select_cover">
                 <select name="product_id">
			<option value=""><?php echo $this->lang->line('Select');?> <?php echo $this->lang->line('Product');?></option>
			<?php
			if(!empty($productdet))
			{
			  foreach($productdet as $productdetlist)
			  {
			    ?>
			    <option value="<?php echo $productdetlist->id;?>" <?php if(set_value("product_id")==$productdetlist->id) { ?> selected="true" <?php } ?>><?php echo stripslashes($productdetlist->product_name);?></option>
			    <?php
			  }
			}
			?>
                 </select> 
                </div>
	        
		<div class="form_holder">
		  <label><span><?php echo $this->lang->line('Question');?></span></label>
		  <input type="text" name="question" placeholder="<?php echo $this->lang->line('Enter');?> <?php echo $this->lang->line('Question');?>" value="<?php echo set_value("question");?>">
		</div>
		
		<div class="form_holder">
		  <label><span><?php echo $this->lang->line('Answer');?></span></label>
		  <textarea name="answer" placeholder="<?php echo $this->lang->line('Enter');?> <?php echo $this->lang->line('Answer');?>"><?php echo set_value("answer");?></textarea>
		</div>
               
               <!--<div class="form_holder">-->
                 <!--<label><span>Text area</span></label>-->
                 <!--<textarea name="" cols="" rows=""></textarea>-->
               <!--</div>-->
               
               <!--<div class="form_holder radio">-->
               <!--  <label><span>Radio</span></label>-->
               <!--  <input name="" type="radio" value=""> Radio-->
               <!--</div>-->
               <!---->
               <!--<div class="form_holder radio">-->
               <!--  <label><span>Radio</span></label>-->
               <!--  <input name="" type="checkbox" value=""> Checkbox-->
               <!--</div>-->
               
               
               <div class="form_holder">
               <button class="sbmt sbmt_base sbmt_base-no-border" type="submit"><i class="fa fa-spinner upload_icon"></i><?php echo $this->lang->line('Add');?></button>
               </div>
               
              </div>
	  
	      </form>
         
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