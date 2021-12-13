<?php $this->load->view('common/header'); ?>
<script type="text/javascript" src="<?= TICKET_PLUGIN_URL;?>CI/assets/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		skin : "o2k7",
		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups,autosave",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true
	});

</script>
<style>
.mceEditor
{
  margin:0 1px !important;
}
</style>
       <!--page_title-->
       <div class="page_title">
         <div class="headline">
          <h1><span><i class="fa fa-graduation-cap"></i></span><?php echo $this->lang->line('Knowledge Base');?></h1>
         </div>
         <div class="right_panel">
           <a href="<?= TICKET_PLUGIN_URL;?>CI/index.php/knowledgebase" class="bttn pi-btn btn-no-border"><span class="edit_all"><i class="fa fa-inbox"></i></span><?php echo $this->lang->line('Manage Knowledge Base');?></a>
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
	      <?php echo validation_errors(); ?>
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
           <p><span><i class="fa fa-th-list"></i></span><?php echo $this->lang->line('Edit Knowledge Base');?></p>
          </div>
	  
	  <form action="<?= TICKET_PLUGIN_URL;?>CI/index.php/knowledgebase/update" method="post">
	  
          <div class="main_pro_pi">
               
               <div class="fileds">
               
	        <div class="form_holder">
                 <label><span><?php echo $this->lang->line('Category');?></span></label>
                 <div class="select_cover">
                 <select name="category_id">
                   <option value=""><?php echo $this->lang->line('Select');?> <?php echo $this->lang->line('Category');?></option>
		   <?php
		   if(!empty($catdet))
		   {
		    foreach($catdet as $catdetlist)
		    {
		      ?>
		      <option <?php if($det->category_id==$catdetlist->id) { ?> selected="true" <?php } ?> value="<?php echo $catdetlist->id;?>"><?php echo $catdetlist->category_name;?></option>
		      <?php
		    }
		   }
		   ?>
                 </select> 
                 </select> 
                 </div>
               </div>
	       
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
		      <option <?php if($det->product_id==$productdetlist->id) { ?> selected="true" <?php } ?> value="<?php echo $productdetlist->id;?>"><?php echo $productdetlist->product_name;?></option>
		      <?php
		    }
		   }
		   ?>
                 </select> 
                 </select> 
                 </div>
               </div>
	       
		<div class="form_holder">
		  <label><span><?php echo $this->lang->line('Topic');?></span></label>
		  <input type="text" name="topic" placeholder="<?php echo $this->lang->line('Enter');?> <?php echo $this->lang->line('Topic');?>" value="<?=$det->topic;?>">
		  <input type="hidden" name="old_topic" placeholder="<?php echo $this->lang->line('Enter');?> <?php echo $this->lang->line('Topic');?>" value="<?=$det->topic;?>">
		</div>
	       
               
               <div class="form_holder">
                 <label><span><?php echo $this->lang->line('Content');?></span></label>
                 <textarea name="content" cols="" rows=""><?=$det->content;?></textarea>
               </div>
               
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
		<input type="hidden" name="id" value="<?php echo $det->id;?>" />
               <button class="sbmt sbmt_base sbmt_base-no-border" type="submit"><i class="fa fa-spinner upload_icon"></i><?php echo $this->lang->line('Update');?></button>
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