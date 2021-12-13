<?php $this->load->view('common/header'); ?>

       <!--page_title-->
       <div class="page_title">
         <div class="headline">
          <h1><span><i class="fa fa-envelope"></i></span><?php echo $this->lang->line('Twitter Ticket');?></h1>
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
           <p><span><i class="fa fa-th-list"></i></span><?php echo $this->lang->line('Twitter Module');?></p>
            <form>
           		<button class="has-tip" type="button" onclick="getTweets();" title="<?php echo $this->lang->line('Get New Tweets');?>" ><i class="fa fa-refresh"></i></button>
           </form>
          </div>


	  
          <div class="main_pro_pi">
       	<div id="leftside" class="clearfix">
       		  <form>
<!--          <div class="form_holder">
		  <label><span>Email From</span></label>
		  <input type="text" id="emailfrom" name="email" placeholder="Email From" value="" disabled="disabled">
		 </div> -->
	       
	       <input type="hidden" name="tweet_ticket" value="tweet_ticket" />
		    <input type="hidden" name="sender_id" id="sender_id" value="" />
               
               <div class="form_holder">
                 <label><span><?php echo $this->lang->line('Tweet Content');?> <span id="spam"></span></span></label><br />
                 <textarea id="body" name="content" cols="" rows="" style="height:120px" disabled="disabled"></textarea>
               </div>
			   <div class="form_holder">
                 <label><span><?php echo $this->lang->line('Reply');?> <span id="spam"></span></span></label><br />
                 <textarea id="replymsg" name="content" cols="" rows="" maxlength="140" style="height:120px" ></textarea>
               </div>
				
				<input type="hidden" name="tweet_id" id="tweet_id" value="" />
			  
			  <div class="form_holder">
               <button id="submit_post" class="sbmt sbmt_base sbmt_base-no-border" type="button" onclick="replyDM('4759880961','hello Mohamed');" disabled="disabled"><i class="fa fa-spinner upload_icon"></i><?php echo $this->lang->line('Reply');?></button>
              </div>
                   </form>    
           </div>
  			<div id="rightside">
	  				<div id="tcount"><?php echo $this->lang->line('Total Tweets');?> : <?php echo count($tweets); ?></div>
	              	<input type="hidden" name="totaltweetcount" id="totaltweetcount" value="<?php echo count($tweets); ?>">
	              <div id="subject">
	              	<ul>
	              	<?php 
	              			if(!empty($tweets))
	              			{
	              				foreach($tweets as $tweet){
	              								$string = (strlen($tweet->body) > 15) ? substr($tweet->body,0,15).'...' : $tweet->body ;
	              								$txt = (B1st_check_already_posted($tweet->tid,'tweet')) ? "<strong class='scanthreat has-tip' title=\"".$this->lang->line('Already posted as ticket')."\">[P]</strong>" : "";
	              					echo '<li><a  href="javascript:void(0)" onclick="getTweet(\''.$tweet->tid.'\')" title="'.$tweet->body.'" >'. $string.''.$txt.'</a><button class="has-tip" title="'.$this->lang->line('Delete Tweet').'" type="button" onclick="deleteTweet(\''.$tweet->tid.'\',this);" ><i class="fa fa-trash"></i></button></li>';
	              				}
	              			}
	              		?>
	              	</ul>
	              <div id="msg"></div>	
	              </div>
  			</div>

           </div>
       
	   
	   
	   <script>
	   function replyDM(id,txt)
	   	{
			
			$(".overlay").show();
	   		$(".overlay").find("button").text("<?php echo $this->lang->line('Sending');?>...").attr("disabled",true);
	   		$.ajax({
					url: "<?= TICKET_PLUGIN_URL;?>CI/index.php/twitter/reply_DM/"+id+"/"+replymsg.value,
					method:"POST",
					success:function(data){

					$(".overlay").fadeOut("slow");
					msg='Reply success'
					$("#replymsg").val(msg).prop('disabled', true);
					}
	   			});
	   	}
		
		</script>
	   
	   <script>
	   	var ids,total=0,cur=0;
	   	
	   	$(document).ready(function(){
	   		$(".overlay").hide();
	   	});

	   	function getTweets()
	   	{
	   		$(".overlay").show();
	   		$(".overlay").find("button").text("<?php echo $this->lang->line('Fetching');?>...").attr("disabled",true);
	   		$('#tcount').text("Total Tweets : ");
	   		var i
	   		$.ajax({
					url: "<?= TICKET_PLUGIN_URL;?>CI/index.php/twitter/getTweets",
					method:"POST",
					success:function(data){

					$(".overlay").fadeOut("slow");
					var obj = $.parseJSON(data);
					var oldtot = parseInt($("#totaltweetcount").val(),10);
						total = obj.total + oldtot;
						$("#totaltweetcount").val(total);
						$('#tcount').text("Total Tweets : "+total);
						$('#replymsg').prop('disabled', false).val('');
						$('#subject ul').append(obj.content);
					}
	   			});
	   	}

	   		function get(i){
	   			cur++;
	   			id = i;
	   			/*if(i == 10)
	   			{
	   				return;
	   			}*/
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
					}
	   			});
	   		 }

	   		 function getTweet(id)
	   		 {
	   		 	$(".overlay").fadeIn("slow");
	   		 		   		$(".overlay").find("button").text("<?php echo $this->lang->line('Fetching');?>...").attr("disabled",true);
	   		 	//$('#body').val("fetching Body....");	
	   			$.ajax({
					url: "<?= TICKET_PLUGIN_URL;?>CI/index.php/twitter/getTweet/"+id,
					method:"POST",
					//data: {id:id},
					success:function(data){
						$(".overlay").fadeOut("slow");
						var obj = $.parseJSON(data);
							//$('#body').val(obj.body);
							$("#tweet_id").val(obj.id);
							$('#body').val(obj.body).removeAttr("disabled"); 
							$('#replymsg').prop('disabled', false).val('');
							$('#sender_id').val(obj.sender_id);
							//$("#spam").html(obj.spam);
							//$('#emailfrom').val(obj.email).removeAttr("disabled");
							
							//$('#ano').text(obj.ano);
							$('#submit_post').removeAttr("disabled");
						}
					
	   			});
	   		 }

	   	function deleteTweet(id,_this)
	   	{

	   		$(_this).parent().fadeOut("fast",function(){

	   			var oldtot = parseInt($("#totaltweetcount").val(),10);
				total = oldtot - 1;
				$("#totaltweetcount").val(total);
				$('#tcount').text("Total Tweets : "+total);

	   			$.ajax({
					url: "<?= TICKET_PLUGIN_URL;?>CI/index.php/twitter/deleteTweet/"+id,
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
		     width: 22%;
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
               <button onclick="getTweets();" class="sbmt sbmt_base sbmt_base-no-border" type="button" ><?php echo $this->lang->line('Click To Fetch Tweets');?></button>
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