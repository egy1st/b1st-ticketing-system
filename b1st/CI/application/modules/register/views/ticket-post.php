<?php $this->load->view('front/header');?>
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
                    
.file_up .uploaded_img ul li{width:95%; 
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
/*.uploadfiles{position: fixed;
left: 0px;
        top: 0px;
	right: 0;
	bottom: 0;
	margin: auto;
	background:rgba(0,0,0,.5);
	width: 100%;
	height:100%;}*/
	
.gapping{margin-bottom: 56px;}


.file_popup{
  background: none repeat scroll 0 0 #fff;
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
<script>
function fileuploadfun()
{
  $('#subbut').click();
  //alert('checking');
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

  <!--  <div class="hdder_frm"></div>  --> 
    <div class="frm_area ribbon-container">
        <span class="ribbon">Ticket Post</span>
    
       <div class="left_frm_side file_up">
       <p><?php echo $this->lang->line('Fill out the form below and we will be in touch soon');?></p>
       <p>
         <?php
           if(isset($_SESSION['message']))
           {
            echo $_SESSION['message'];
            unset($_SESSION['message']);
           }
          ?>
       </p>
        <form action="<?= TICKET_PLUGIN_URL;?>CI/index.php/ticket/insert" method="post" enctype="multipart/form-data">
        
        <input type="hidden" name="ticket_no"  value="<?= B1st_create_guid(); ?>" >

        
         <label>
        <input name="customer" type="text" placeholder="<?php echo $this->lang->line('Email');?>" class="frm_nme">
        </label>
        <label>
        <input name="subject" type="text" placeholder="<?php echo $this->lang->line('Subject');?>" class="frm_nme">
        </label>
      <label>
	<?php
	$companychk=B1st_fetchmod('company');
	if($companychk==1)
	{
	?>
       <select name="company_id"  class="sel_con">
        <option value=""><?php echo $this->lang->line('Company');?></option>
	<?php
	if(!empty($companydet))
	{
	  foreach($companydet as $companydetlist)
	  {
	    ?>
	    <option value="<?php echo $companydetlist->id;?>"><?php echo stripslashes($companydetlist->company_name);?></option>
	    <?php
	  }
	}
	?>
       </select>
       <?php
	}
	?>
        </label>
        <label>
       <select name="department_id"  class="sel_con">
        <option value=""><?php echo $this->lang->line('Department');?></option>
	<?php
	if(!empty($departmentdet))
	{
	  foreach($departmentdet as $departmentdetlist)
	  {
	    ?>
	    <option value="<?php echo $departmentdetlist->id;?>"><?php echo stripslashes($departmentdetlist->department_name);?></option>
	    <?php
	  }
	}
	?>
       </select>
        </label>
         <label>
	<?php
	$prodchk=B1st_fetchmod('product');
	if($prodchk==1)
	{
	?>
       <select name="product_id"  class="sel_con">
        <option value=""><?php echo $this->lang->line('Product');?></option>
	<?php
	if(!empty($productdet))
	{
	  foreach($productdet as $productdetlist)
	  {
	    ?>
	    <option value="<?php echo $productdetlist->id;?>"><?php echo stripslashes($productdetlist->product_name);?></option>
	    <?php
	  }
	}
	?>
       </select>
       <?php
	}
	?>
        </label>
        <label>
       <select name="priorty"  class="sel_con">
        <option value=""><?php echo $this->lang->line('Priority');?></option>
	<?php
	if(!empty($prioritydet))
	{
	  foreach($prioritydet as $prioritydetlist)
	  {
	    ?>
	    <option value="<?php echo $prioritydetlist->id;?>"><?php echo stripslashes($prioritydetlist->priority_name);?></option>
	    <?php
	  }
	}
	?>
       </select>
        </label>
         <label>
        <textarea name="query" cols="" rows="" placeholder="<?php echo $this->lang->line('Write Your Query');?>..." class="area_txt"></textarea>
         </textarea>
         </label>
<!--          <span class="btn btn-default btn-file">
        <input type="file" name="fileupload[]" > Add file
</span> -->
      <div class="form_holder">
               <button class="sbmt sbmt_base sbmt_base-no-border open_upload" type="button" onclick="$('#getfile').click();"><i class="fa fa-spinner upload_icon"></i><?php echo $this->lang->line('Upload Files');?></button>
	       <?php
	       $arr=B1st_getSettingsValue('ticket_attachment');
	       $extensions_allowed=$arr->extensions_allowed;
	       $extensions_allowed=str_replace(",",", ",$extensions_allowed);
	       $max_upload=$arr->max_upload;
	       ?>
	       <br />
	       <span><?php echo $this->lang->line('Only');?> <?php echo $extensions_allowed;?> <?php echo $this->lang->line('file types are allowed and you can upload maximum');?> <?php echo $max_upload;?> <?php echo $this->lang->line('number of file(s) at a time');?></span>
               </div>
      
      <div class="form_holder" id="showprogressbar" style="display:none;">
		  <div class="wrapper_progress progress-bar">
		    <div class="progress-bar-wrapper">
		      <progress id="progressbar" value="0" max="100"></progress>
		      <span class="progress-value">0%</span>
		    </div>
		  </div>
	       </div>
        <div id="temperr" class="form_holder" style="color:#ff0000;font-weight:bold;"></div>
        <div id="tempfiles" class="form_holder uploaded_img" style="max-height:100px;overflow-y:auto;">
	 </div>

<input type="hidden" value="<?= TICKET_PLUGIN_URL;?>CI/index.php/register/ListTicket" name="front_post">
<button type="submit" class="con_button sbmt_base sbmt_base-no-border"><?php echo $this->lang->line('Send');?></button>
        </form>
        
        
        
       </div>
    
    <form class="uploadfiles" id="myForm" action="<?= TICKET_PLUGIN_URL;?>CI/index.php/ticket/insert" method="post" enctype="multipart/form-data" style="display: none;">
		
		 <div class="form_holder ">
		  <label><span><?php echo $this->lang->line('File Upload');?></span></label>
		  <input id="getfile" type="file" name="fileupload[]" multiple="true" onchange="fileuploadfun()"/>
		  <input type="submit" id="subbut" value="check" />
               </div>
	       <input type="text" value="<?= TICKET_PLUGIN_URL;?>CI/index.php/register/ListTicket" name="front_post"> 
	      </form>
              
         <!--<div class="form_holder" id="showprogressbar" style="display:none;">
		  <div class="wrapper_progress progress-bar">
		    <div class="progress-bar-wrapper">
		      <progress id="progressbar" value="0" max="100"></progress>
		      <span class="progress-value">0%</span>
		    </div>
		  </div>
	       </div>-->
         
         <!--<div id="tempfiles" class="form_holder uploaded_img">
	 </div>-->
       
       <div class="right_frm_side">
        <h1><?php echo $this->lang->line('Info');?></h1>
        <p><strong><?php echo $this->lang->line('Phone');?> : </strong> (012) 345-1236</p>
         <p><strong><?php echo $this->lang->line('Skype');?> : </strong> Username</p><br/>
          <p><strong><?php echo $this->lang->line('Address');?> : </strong> Lorem Ipsum is <br/>simply dummy text of the printing</p><br/>
          <p><strong><?php echo $this->lang->line('Support Hours');?> : </strong><br/> Sunday,closed<br/>simply dummy text of the printing</p>
          <h1><?php echo $this->lang->line('Socialize');?></h1>
           <ul class="list-services clearfix">
                                    <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a class="google-plus" href="#"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                                    <li><a class="skype" href="#"><i class="fa fa-skype"></i></a></li>
    </ul>

       </div>
        <div style="clear:both"></div>
    </div>

  </div>
<?php
$chk=B1st_fetchmod('chat');
if($chk==1)
{
    $this->load->view('common/chatadmin');
}
?>
<?php $this->load->view('front/footer');?>
