<?php $this->load->view('common/header'); ?>
       <!--page_title-->
       <div class="page_title">
         <div class="headline">
          <h1><span><i class="fa fa-paint-brush"></i></span><?php echo $this->lang->line('Theme');?></h1>
         </div>
         <div class="right_panel">
           <a href="<?= TICKET_PLUGIN_URL;?>CI/index.php/theme" class="bttn pi-btn btn-no-border"><span class="edit_all"><i class="fa fa-inbox"></i></span><?php echo $this->lang->line('Manage Theme');?></a>
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
           <p><span><i class="fa fa-th-list"></i></span><?php echo $this->lang->line('Add Theme');?></p>
          </div>
	  
	  <form action="<?= TICKET_PLUGIN_URL;?>CI/index.php/theme/insert" method="post" id="themeadd">
	  
          <div class="main_pro_pi">
               
               <div class="fileds">
               
		<div class="form_holder">
		  <label><span><?php echo $this->lang->line('Theme Name');?></span></label>
		  <input type="text" name="theme_name" placeholder="<?php echo $this->lang->line('Enter');?> <?php echo $this->lang->line('Theme Name');?>" value="<?php echo set_value('theme_name');?>">
		</div>
    <div class="form_holder">
      <label><span><?php echo $this->lang->line('Theme Color');?></span></label>
      <input type="text" name="theme_color" id="theme_color" maxlength="7" style="width: 60px" value="<?php echo set_value('theme_color');?>">
    </div>
    <script type="text/javascript">
      var options = {
        onSubmit : function(hsb, hex, rgb, el){
          $(el).val('#'+hex);
          $(el).ColorPickerHide();
        },

        onBeforeShow: function () {
          $(this).ColorPickerSetColor(this.value);
        },
        onChange: function (hsb, hex, rgb) {
           $('#theme_color').val('#'+hex);
        }
      };
        $('#theme_color').ColorPicker(options).bind('keyup', function(){
             $(this).ColorPickerSetColor(this.value);
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
               <!--<div class="form_holder radio">-->
               <!--  <label><span>Radio</span></label>-->
               <!--  <input name="" type="checkbox" value=""> Checkbox-->
               <!--</div>-->
               
               
               <div class="form_holder">
		<input type="hidden" readonly="true" name="chkval" id="chkval" value="0" />
               <button class="sbmt sbmt_base sbmt_base-no-border" type="button" onclick="checksubmit()"><i class="fa fa-spinner upload_icon"></i><?php echo $this->lang->line('Add');?></button>
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
<script>
function checksubmit()
{
  var chkval=$('#chkval').val();
  if (chkval==0)
  {
    $('#chkval').val(1);
    $('#themeadd').submit();
    
  }
}
</script>
<?php
$this->load->view('common/footer');
?>