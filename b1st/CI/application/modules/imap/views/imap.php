<?php $this->load->view('common/header'); ?>

       <!--page_title-->
       <div class="page_title">
         <div class="headline">
          <h1><span><i class="fa fa-envelope"></i></span><?php echo $this->lang->line('Email');?></h1>
         </div>
        <!--  <div class="right_panel">
          <a href="<?= TICKET_PLUGIN_URL;?>CI/index.php/company" class="btn pi-btn-base pi-btn-no-border"><span class="icon_all"><i class="fa fa-inbox"></i></span>Manage Companies</a>
        </div> -->
       </div>
       <!--/page_title-->
       <!--main_section-->
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
           <p><span><i class="fa fa-th-list"></i></span><?php echo $this->lang->line('IMAP Email');?></p>
           <form>
           	<button class="has-tip" type="button" onclick="getTotalMail();" title="<?php echo $this->lang->line('Get New Emails');?>" ><i class="fa fa-refresh"></i></button>
           </form>
          </div>


	  
          <div class="main_pro_pi">
       	<div id="leftside" class="clearfix">
       		  <form action="<?= TICKET_PLUGIN_URL;?>CI/index.php/ticket/add" method="post">
         <div class="form_holder">
		  <label><span><?php echo $this->lang->line('Email From');?></span></label>
		  <input type="text" id="emailfrom" name="email" placeholder="Email From" value="" disabled="disabled">
		 </div>
	       
	       <input type="hidden" name="email_ticket" value="email_ticket" />
		   
		       <div class="form_holder">
                 <label><span><?php echo $this->lang->line('Email Subject');?> </span></label><br />
                <input type="text" id="emailsubject" name="emailsubject" placeholder="Email Subject" value="" disabled="disabled">
               </div>
               
               <div class="form_holder">
                 <label><span><?php echo $this->lang->line('Email Content');?> <span id="spam"></span></span></label><br />
                 <textarea id="body" name="content" cols="" rows="" style="height:160px" disabled="disabled"></textarea>
               </div>

               <div class="form_holder">
                 <label><span><?php echo $this->lang->line('Attachment');?>(<span id="ano"></span>):</span></label><br />
                 	<div id="attachment"></div>
               </div>
				
				<input type="hidden" name="email_no" id="email_no" value="" />
			  
			  <div class="form_holder">
               <button id="submit_post" class="sbmt sbmt_base sbmt_base-no-border" type="submit" disabled="disabled"><i class="fa fa-spinner upload_icon"></i><?php echo $this->lang->line('Post As Ticket');?></button>
              </div>
                   </form>    
           </div>
  			<div id="rightside">
	  				<div id="tcount"><?php echo $this->lang->line('Total Mail');?> : <?php echo count($emails); ?></div>
	              	<input type="hidden" name="emailcounttotal" id="emailcounttotal" value="<?php echo count($emails); ?>" />
	              <div id="subject">
	              	<ul>
	              		<?php 
	              			if(!empty($emails))
	              			{
	              				foreach($emails as $email){
	              								$string = (strlen($email->subject) > 15) ? substr($email->subject,0,15).'...' : $email->subject ;
	              					$txt = (B1st_check_already_posted($email->eid)) ? "<strong class='scanthreat has-tip' title=\"Already posted as ticket\">[P]</strong>" : "";

	              					echo '<li><a href="javascript:void(0)" onclick="getBody('.$email->eid.')" title="'.$email->subject.'" >'. $string.''.$txt.'</a><button class="has-tip" type="button" onclick="deleteEmail('.$email->eid.',this);" title="Delete Email" ><i class="fa fa-trash"></i></button></li>';
	              				}
	              			}
	              		?>
	              	</ul>
	              <div id="msg"></div>	
	              </div>
  			</div>

           </div>
       
	   <script>
	   	var ids,total=0,cur=0;

	   	$(document).ready(function(){
	   		$(".overlay").hide();
	   	});

	   	function getTotalMail()
	   	{
	   		$(".overlay").show();
	   		cur = parseInt($("#emailcounttotal").val(),10);

	   		$(".overlay").find("button").text("<?php echo $this->lang->line('Fetching');?>...").attr("disabled",true);
	   		//$('#tcount').text("Total Mail : ");
	   		var i
	   		$.ajax({
					url: "<?= TICKET_PLUGIN_URL;?>CI/index.php/imap/getTotal",
					method:"POST",
					success:function(data){
					$(".overlay").fadeOut("slow");
					var obj = $.parseJSON(data);
					var	newt = obj.count - cur;
					total = cur+newt;
					cur = 0;

						$('#tcount').text("<?php echo $this->lang->line('Total Mail');?> : "+total);
						$("#emailcounttotal").val(total);

						 ids = obj.ids;
						if(ids.length > 0)
						{
						 	i = ids.pop();
							get(i);
						}
					}
	   			});
	   	}

	   		function get(i){
	   			cur++;
	   			id = i;
	   			$('#msg').html("<?php echo $this->lang->line('Fetching');?> "+cur+" of "+total+"....<img src='<?= TICKET_PLUGIN_URL;?>CI/assets/images/ajax-loader.gif' />");	
	   			$.ajax({
					url: "<?= TICKET_PLUGIN_URL;?>CI/index.php/imap/get",
					method:"POST",
					data: {id:id},
					success:function(data){
						var obj = $.parseJSON(data);
						if(obj.status == true)
						{ 
							$('#msg').text('');
							$('#subject ul').append('<li>'+obj.subject+'</li>');
							if(ids.length > 0)
							{
								i = ids.pop();
								get(i);
							}
						}

						if(obj.status == 0)
						{ 
							$('#msg').text('');
							//$('#subject ul').append('<li>'+obj.subject+'</li>');
							if(ids.length > 0)
							{
								i = ids.pop();
								get(i);
							}
						}
					}
	   			});
	   		 }

	   		 function getBody(id)
	   		 {
	   		 	$(".overlay").fadeIn("slow");
	   			$(".overlay").find("button").text("<?php echo $this->lang->line('Fetching');?>...").attr("disabled",true);
	   			$.ajax({
					url: "<?= TICKET_PLUGIN_URL;?>CI/index.php/imap/getBody/"+id,
					method:"POST",
					success:function(data){
						$(".overlay").fadeOut("slow");
						var obj = $.parseJSON(data);
							$("#email_no").val(id);
							$('#body').val(obj.body).removeAttr("disabled");
							$("#spam").html(obj.spam);
							$('#emailfrom').val(obj.email).removeAttr("disabled");
							$('#emailsubject').val(obj.subject).removeAttr("disabled");
							$('#attachment').html(obj.file);
							$('#ano').text(obj.ano);
							$('#submit_post').removeAttr("disabled");
						}
					
	   			});
	   		 }

	   	function deleteEmail(id,_this)
	   	{
	   		$(_this).parent().fadeOut("fast",function(){
	   			var oldtot = parseInt($("#emailcounttotal").val(),10);
				total = oldtot - 1;
				$("#emailcounttotal").val(total);
				$('#tcount').text("<?php echo $this->lang->line('Total Mail');?> : "+total);
	   			
	   			$.ajax({
					url: "<?= TICKET_PLUGIN_URL;?>CI/index.php/imap/deleteEmail/"+id,
					method:"POST",
					success:function(data){
							console.log(data);
						}
					
	   			});
	   		});
	   	}	 
	   </script>
	   <style type="text/css">
		#leftside{
			width:74%;
			float:left;
			border-right:1px solid #d1d1d1;
			position:relative;
		}
		
		#leftside .form_holder input[type="text"], .form_holder input[type="password"], .form_holder textarea{
			width:95%;
		}

		#rightside{
			width:25%;
			float:left;
		}

		#tcount{
			font-size:18px;
			font-weight: bold;
			text-transform:capitalize;
			padding:4px;
		}
		#subject ul {
			margin-left:5px;
		}

		#subject ul li{
			list-style-position: inside;
		}
		
		#subject ul li a{
			display: inline-block;
    		width: 140px;
		}
		
		#msg{
			height:20px;
			line-height:20px;
			margin-left:10px;
		}

		#msg img{
			vertical-align:middle;
		}
		.product_box{position:relative;}

		.overlay{
			position:absolute;
			width:100%;
			height:100%;
			background:rgba(0,0,0,0.5);

		}

		.overlay .inside{
			 bottom: 0;
		     color: #fff;
		     height: 20%;
		     left: 0;
		     margin: auto;
		     position: absolute;
		     right: 0;
		     top: 0;
		     width: 20%;
		}
		.overlay .inside button{
			 border-radius: 16px;
    		 font-weight: bold;
		}

		.scanok{
			color: #4F8A10;
		}

		.scanthreat{
			color: #D8000C;
		}
	   </style>
              
              
				<div class="overlay">
					<div class="inside">
						 <div class="form_holder">
               <button onclick="getTotalMail();" class="sbmt sbmt_base sbmt_base-no-border" type="button" ><?php echo $this->lang->line('Click To Fetch Email');?></button>
              </div>
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