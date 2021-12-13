<?php
@session_start();
 $this->load->view('front/header');?> 
    <div class="frm_area">
       <p><?php echo $this->lang->line('Fill out the form below and we will be in touch soon');?></p>
	<ul class="collapse">
	 <?php
	 $errflag=0;
	 ?>
	<?php if(!empty($faqdet)){
	 //echo "<pre>";
	 //print_r($faqdet);
	 //echo "</pre>";
		foreach($faqdet as $key => $val)
		{
		  if(!empty($val)){
	 ?>
		<li class="heading">
		
			<a href="javascript:void(0)" >
				<span class="sign">+</span>
				<span><?php echo $this->lang->line('Product');?> : <?php echo $key; ?></span>
			</a>
			
		 <ul class="hidden">
		 <?php
        $no = 1;
		 	 foreach($val as $kb)
		 	  {
		  ?>
			<li>
				<div>
				 	<h4><?php echo $no++; ?>) <?php echo $kb->question; ?></h4>
				 	<p><?php echo nl2br($kb->answer); ?></p>
				</div>
			 </li>
		  <?php
		  	}
			$errflag=1;
		   }
		   ?>
		   </ul>
		</li>

	 <?php
	 	}
	  }
	  else
	  {
	    echo $this->lang->line("No FAQ found");
	  }
	  
	  if(!empty($faqdet) and $errflag==0)
	  {
	    echo $this->lang->line("No FAQ found");
	  }
	  ?>
     </ul>
     <style type="text/css">
		ol.collapse li ul {
		    list-style-type: none;
		    margin-left: 20px;
		    overflow: hidden;
		} 		                            
     </style>
     <script type="text/javascript">
     	$("ul.collapse li").first().find('ul').removeClass("hidden");
     	$("ul.collapse li").first().find("a span.sign").text("-");
     	$('.heading a').click(function(){
     		var ul = $(this).parent().find('ul'),
     			cls = ul.hasClass("hidden");
     		    if(!cls)
     		    {
     		    	ul.stop().animate({height:"0"},500);
     		    	ul.addClass("hidden");
     		    	if(!cls)
     		    		$(this).find(".sign").text("+");
     		    	else
     		    		$(this).find(".sign").text("-");
     		    }
     		    else
     		    {
     		    	var li = ul.find("li"),
     		    		height = li.height()*li.length;
     		    	ul.stop().animate({height:height+"px"},500);
     		    	ul.removeClass("hidden");
     		    	if(!cls)
     		    		$(this).find(".sign").text("+");
     		    	else
     		    		$(this).find(".sign").text("-");
     		    }
     	});
     </script>
  </div>
<?php
$chk=B1st_fetchmod('chat');
if($chk==1)
{
  if(!empty($_SESSION['c_userid']))
    $this->load->view('common/chatadmin');
}
?>
<?php $this->load->view('front/footer');?>