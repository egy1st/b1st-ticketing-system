<?php $this->load->view('common/header'); ?>
<style>
	.wrapper_progress {
	width: 300px;
	float: left;
	margin: 10px auto 0;
	padding:5px;
	-webkit-box-shadow: 0px 0px 3px 0px rgba(0,0,0,0.4);
-moz-box-shadow: 0px 0px 3px 0px rgba(0,0,0,0.4);
box-shadow: 0px 0px 3px 0px rgba(0,0,0,0.4);
}
.progress-bar {	
	-moz-border-radius: 3px;
	-webkit-border-radius: 3px;
	border-radius: 3px;
	background-color: #fff;
	
	
	
}
.progress-bar progress {
	background-color: #f3f3f3;
	border: 0;
	width: 80%;
	height: 18px;
	border-radius: 9px;
		
}
.progress-bar progress::-webkit-progress-bar {
	background-color: #f3f3f3;
	-moz-border-radius: 9px;
	-webkit-border-radius: 9px;
	border-radius: 9px;
	
}
.progress-bar progress::-webkit-progress-value {
	background:rgb(83,172,24) url(../images/pattern.png) center repeat-x;
}
.progress-bar progress::-moz-progress-bar {
	background:rgb(83,172,24) url(../images/pattern.png) center repeat-x;
	-moz-border-radius: 9px;
	-webkit-border-radius: 9px;
	border-radius: 9px;
}
.progress-bar .progress-value {
	padding: 0px 5px;
	line-height: 20px;
	margin-left: 5px;
	font-size: 14px;
	color: #555;
	height: 18px;
	float: right;
}.uploaded_img{margin-top: 15px;}
.uploaded_img ul{list-style: none;}
.uploaded_img ul li{width:80%;                    
		    background: rgba(55,55,55,.1);
		    padding: 6px 6px;
		    float: left;
		    margin-right: 6px;
		    margin-bottom: 8px;
		    position: relative;
		    border-radius: 5px;
		    -moz-border-radius: 5px;
		    -webkit-border-radius: 5px;
		    
		    
		    }
.uploaded_img ul li img{width:100%;
                        height:auto;
			max-height:100%;
}

.uploaded_img ul li span{position: absolute;
                         right: 7px;
			 font-size: 20px;
			 color: #f00;
			  line-height: 0;
    margin-top: -3px;
    cursor: pointer;
			 }
			 
.abs{position: relative;}

.gapping{margin-bottom: 56px;}

.file_popup{background: none repeat scroll 0 0 #fff;
    display: none;
    border: 1px solid #db4d4d;
    border-radius: 4px;
    bottom: 0;
    height: 66px;
    left: 0;
    margin: auto;
    padding: 10px;
    position: absolute;
    right: 0;
    top: 0;
    width: 225px;
	    }
</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script> 
<script src="http://malsup.github.com/jquery.form.js"></script> 
       <!--page_title-->
       <div class="page_title">
         <div class="headline">
          <h1><span><i class="fa fa-ticket"></i></span><?php echo $this->lang->line('Ticket');?></h1>
         </div>
         <div class="right_panel">
           <a href="<?= TICKET_PLUGIN_URL;?>CI/index.php/ticket" class="bttn pi-btn btn-no-border"><span class="edit_all"><i class="fa fa-inbox"></i></span><?php echo $this->lang->line('Manage Tickets');?></a>
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
           <p><span><i class="fa fa-th-list"></i></span><?php echo $this->lang->line('Edit Ticket');?></p>
          </div>
	  
	  <form action="<?= TICKET_PLUGIN_URL;?>CI/index.php/ticket/update" method="post">
	  
          <div class="main_pro_pi">
               
               <div class="fileds">
               
		<div class="form_holder">
		  <label><span><?php echo $this->lang->line('Ticket Name');?></span></label>
		  <input type="text" name="ticket_name" placeholder="<?php echo $this->lang->line('Enter');?> <?php echo $this->lang->line('Ticket Name');?>" value="<?=$det->ticket_no;?>" readonly="">
		</div>
		
		<div class="form_holder">
		  <label><span><?php echo $this->lang->line('Subject');?></span></label>
		  <input type="text" name="subject" placeholder="<?php echo $this->lang->line('Enter');?> <?php echo $this->lang->line('Subject');?>" value="<?=$det->subject;?>">
		</div>
		
		<div class="form_holder">
		  <label><span><?php echo $this->lang->line('Customer Email');?></span></label>
		  <input type="text" name="customer" placeholder="<?php echo $this->lang->line('Enter');?> <?php echo $this->lang->line('Customer Email');?>" value="<?=$det->customer;?>">
		</div>
               </div>
	       
               
               <!--<div class="form_holder">-->
                 <!--<label><span>Text area</span></label>-->
                 <!--<textarea name="" cols="" rows=""></textarea>-->
               <!--</div>-->
               
	       <?php
	       $companychk=B1st_fetchmod('company');
	       if($companychk==1)
	       {
	       ?>
               <div class="form_holder">
                 <label><span><?php echo $this->lang->line('Company');?></span></label>
                 <div class="select_cover">
                 <select name="company_id">
			<option value=""><?php echo $this->lang->line('Select');?> <?php echo $this->lang->line('Company');?></option>
			<?php
			if(!empty($companydet))
			{
			  foreach($companydet as $companydetlist)
			  {
			    ?>
			    <option value="<?php echo $companydetlist->id;?>" <?php if($det->company_id==$companydetlist->id) { ?> selected="true" <?php } ?>><?php echo stripslashes($companydetlist->company_name);?></option>
			    <?php
			  }
			}
			?>
                 </select> 
                 </div>
               </div>
	       <?php
	       }
	       ?>
	       
               <div class="form_holder">
                 <label><span><?php echo $this->lang->line('Department');?></span></label>
                 <div class="select_cover">
                 <select name="department_id">
			<option value=""><?php echo $this->lang->line('Select');?> <?php echo $this->lang->line('Department');?></option>
			<?php
			if(!empty($departmentdet))
			{
			  foreach($departmentdet as $departmentdetlist)
			  {
			    ?>
			    <option value="<?php echo $departmentdetlist->id;?>" <?php if($det->department_id==$departmentdetlist->id) { ?> selected="true" <?php } ?>><?php echo stripslashes($departmentdetlist->department_name);?></option>
			    <?php
			  }
			}
			?>
                 </select> 
                 </div>
               </div>
	       
	       <?php
	       $prodchk=B1st_fetchmod('product');
	       if($prodchk==1)
	       {
	       ?>
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
			    <option value="<?php echo $productdetlist->id;?>" <?php if($det->product_id==$productdetlist->id) { ?> selected="true" <?php } ?>><?php echo stripslashes($productdetlist->product_name);?></option>
			    <?php
			  }
			}
			?>
                 </select> 
                 </div>
               </div>
	       <?php
	       }
	       ?>
	       
	       <div class="form_holder">
                 <label><span><?php echo $this->lang->line('Priority');?></span></label>
                 <div class="select_cover">
                 <select name="priorty">
                   <option value=""><?php echo $this->lang->line('Select');?> <?php echo $this->lang->line('Priority');?></option>
      <?php
      if(!empty($prioritydet))
      {
        foreach($prioritydet as $prioritydetlist)
        {
          $sel = $det->priorty == $prioritydetlist->id ? "selected" : ""; 
          ?>
          <option value="<?php echo $prioritydetlist->id;?>" <?= $sel ?> ><?php echo stripslashes($prioritydetlist->priority_name);?></option>
          <?php
        }
      }
      ?>
                 </select> 
                 </div>
               </div>
               <div class="form_holder">
                 <label><span><?php echo $this->lang->line('Query');?></span></label>
                 <textarea name="query" cols="" rows="" placeholder="<?php echo $this->lang->line('Enter');?> <?php echo $this->lang->line('Query');?>"><?= $det->query ?></textarea>
               </div>
                <div class="form_holder">
                                                       <label><span><?php echo $this->lang->line('State');?></span></label>
                                                       <div class="select_cover">
                                                       <select name="state">
                                            <option value=""><?php echo $this->lang->line('Select');?> <?php echo $this->lang->line('State');?></option>
                                            <?php
                                            $states = B1st_getTicketStates();
                                            if(!empty($states))
                                            {
                                              foreach($states as $state)
                                              {
                                                $sel = $state->code == $det->state ? "selected" : "";
                                                ?>
                                                <option value="<?php echo $state->code;?>" <?= $sel ?>><?php echo stripslashes($state->name);?></option>
                                                <?php
                                              }
                                            }
                                            ?>
                                                       </select> 
                                                       </div>
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
               
	       <div class="form_holder" id="showprogressbar" style="display:none;">
		  <div class="wrapper_progress progress-bar">
		    <div class="progress-bar-wrapper">
		      <progress id="progressbar" value="0" max="100"></progress>
		      <span class="progress-value">0%</span>
		    </div>
		  </div>
	       </div>
	       
	       <div id="temperr" class="form_holder" style="color:#ff0000;font-weight:bold;"></div>
	       <div id="tempfiles" class="form_holder uploaded_img">
	       </div>
	       
	       <div class="form_holder">
               <button class="sbmt sbmt_base sbmt_base-no-border open_upload" type="button" onclick="$('#getfile').click();"><i class="fa fa-spinner upload_icon"></i><?php echo $this->lang->line('Upload Files');?></button>
	       <?php
	       $arr=B1st_getSettingsValue('ticket_attachment');
	       $extensions_allowed=$arr->extensions_allowed;
	       $extensions_allowed=str_replace(",",", ",$extensions_allowed);
	       $max_upload=$arr->max_upload;
	       ?>
	       <br />
	       <span>Only <?php echo $extensions_allowed;?> file types are allowed and you can upload maximum <?php echo $max_upload;?> number of file(s) at a time</span>
               </div>
               
               <div class="form_holder">
		<input type="hidden" name="id" value="<?php echo $det->id;?>" />
               <button class="sbmt sbmt_base sbmt_base-no-border" type="submit"><i class="fa fa-spinner upload_icon"></i><?php echo $this->lang->line('Update');?></button>
               </div>
               
              </div>
	  
	      </form>
	      
	      
	      <form class="uploadfiles" id="myForm" action="<?= TICKET_PLUGIN_URL;?>CI/index.php/ticket/update" method="post" enctype="multipart/form-data">
		<div class="form_holder file_popup">
		 <label><span><?php echo $this->lang->line('File Upload');?></span></label>
		 <input id="getfile" type="file" name="fileupload[]" multiple="true" onchange="fileuploadfun()"/>
		 <input type="submit" id="subbut" value="check" style="display:none;" />
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
function fileuploadfun()
{
  $('#subbut').click();
  $('.file_popup').fadeOut();
}
$(document).ready(function(){
    var options = {
    beforeSend: function()
    {
      $('#showprogressbar').fadeIn();
    },
    uploadProgress: function(event, position, total, percentComplete)
    {
	var percom=parseInt(percentComplete);
	//if (percom < 90)
	//{
	  $('#progressbar').delay(3000).removeAttr('value');
	  $('#progressbar').delay(3000).attr('value',percom);
	  $('.progress-value').delay(3000).html(percom+"%");
	  //ekhane progressing er code likte hobe 90% er age obdi
	//}
 
    },
    success: function()
    {
      $('#progressbar').delay(3000).removeAttr('value');
      $('#progressbar').delay(3000).attr('value',"100");
      $('.progress-value').delay(3000).html("100%");
 
    },
    complete: function(response)
    {
      $('#showprogressbar').delay(3000).fadeOut(function(){
	$('#getfile').val('');
	//alert(response.responseText);
	var response_json=$.parseJSON(response.responseText);
	if (response_json.status==0)
	{
		$('#temperr').html(response_json.err);
	}
	if (response_json.status==1)
	{
		$('#temperr').html('');
		$('#tempfiles').append(response_json.content);
	}
      });
    }
  };
     $("#myForm").ajaxForm(options);
 
});


function delfile(fileid,filename)
{
  $.post('<?= TICKET_PLUGIN_URL;?>CI/index.php/ticket/deletetempfile',{'fileid':fileid,'filename':filename},function(data){
    if (data)
    {
      $('#delfil'+fileid).fadeOut();
    }
  });
}
</script>
<?php
$this->load->view('common/footer');
?>