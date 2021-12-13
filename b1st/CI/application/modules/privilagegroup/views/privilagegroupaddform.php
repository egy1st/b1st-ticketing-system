<?php $this->load->view('common/header'); ?>
       <!--page_title-->
       <div class="page_title">
         <div class="headline">
          <h1><span><i class="fa fa-key"></i></span><?php echo $this->lang->line('Privilege');?></h1>
         </div>
         <div class="right_panel">
           <a href="<?= TICKET_PLUGIN_URL;?>CI/index.php/privilagegroup" class="bttn pi-btn btn-no-border"><span class="edit_all"><i class="fa fa-inbox"></i></span><?php echo $this->lang->line('Manage Privilege');?></a>
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
           <p><span><i class="fa fa-th-list"></i></span><?php echo $this->lang->line('Add Privilege');?></p>
          </div>
	  
	  <form action="<?= TICKET_PLUGIN_URL;?>CI/index.php/privilagegroup/insert" method="post">
	  
          <div class="main_pro_pi">
               
               <div class="fileds">
               
		<div class="form_holder">
		  <label><span><?php echo $this->lang->line('Privilage Group Name');?></span></label>
		  <input type="text" name="privilagegroup_name" placeholder="<?php echo $this->lang->line('Enter Privilage Group Name');?>" value="<?php echo set_value('privilagegroup_name');?>">
		</div>
    <div class="form_holder">
       <label><span><?php echo $this->lang->line('Description');?></span></label>
       <textarea name="description" cols="" rows=""><?php echo set_value("description");?></textarea>
    </div>
    <div class="form_holder radio">
        <label><span><?php echo $this->lang->line('Assign Privilages');?> : </span></label>
        <input name="" type="checkbox" id="check_all" value=""> All
    </div>
    <?php
      $privilages = B1st_getPrivileges();
     if(!empty($privilages)){
      foreach ($privilages as $privilage) {
      ?>
    <div class="form_holder radio">
        <label><span></span></label>
        <input name="privilages[]" type="checkbox" value="<?= $privilage->code ?>"> <?= $privilage->name ?>
    </div>
<?php
    }
      } ?>

    <!-- <div class="form_holder radio">
              <label><span></span></label>
              <input name="privilages[]" type="checkbox" value=""> Add Ticket
          </div>
          <div class="form_holder radio">
              <label><span></span></label>
              <input name="privilages[]" type="checkbox" value=""> Delete Ticket
          </div>
          <div class="form_holder radio">
              <label><span></span></label>
              <input name="privilages[]" type="checkbox" value=""> Close Ticket
          </div>
          <div class="form_holder radio">
              <label><span></span></label>
              <input name="privilages[]" type="checkbox" value=""> Assign ticket to Admin
          </div>     
           <div class="form_holder radio">
              <label><span></span></label>
              <input name="privilages[]" type="checkbox" value=""> Transfer ticket from one Admin to another Admin
          </div>  
          <div class="form_holder radio">
              <label><span></span></label>
              <input name="privilages[]" type="checkbox" value=""> Reopen Tickets
          </div>
          <div class="form_holder radio">
              <label><span></span></label>
              <input name="privilages[]" type="checkbox" value=""> Read all Tickets
          </div>        
          <div class="form_holder radio">
              <label><span></span></label>
              <input name="privilages[]" type="checkbox" value=""> Answer any tickets
          </div>   -->      
           <script type="text/javascript">
           $(document).ready(function(){
              $('#check_all').change(function(){
               var c =  $(this);
                if(c.is(':checked'))
                {
                  $('input[name="privilages[]"]').prop( "checked", true );
                }
                else
                {
                  $('input[name="privilages[]"]').prop( "checked", false );
                }

              });
           });
           </script>    
               <!--<div class="form_holder">-->
                 <!--<label><span>Text area</span></label>-->
                 <!--<textarea name="" cols="" rows=""></textarea>-->
               <!--</div>-->
               
               <!--<div class="form_holder radio">-->
               <!--  <label><span>Radio</span></label>-->
               <!--  <input name="" type="radio" value=""> Radio-->
               <!--</div>-->
               <!---->
<!--                <div class="form_holder radio">
<label><span>Radio</span></label>
<input name="" type="checkbox" value=""> Checkbox
</div> -->
               
               
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