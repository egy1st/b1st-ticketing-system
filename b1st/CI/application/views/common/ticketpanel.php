        <!--another_extra_area-->
	 <div class="pil_extra" style="display:block;" id="target">
         <!--vertical_menu-->
          <div class="vertical_menu" id="extra_area">
            <div class="vertival_one" id="myClick">
             <p class="tickt_txt"><?php echo $this->lang->line('Status');?> <span class="arrow_ping" id="click_hre" ><i class="fa fa-angle-double-right"></i></span></p>
              <div class="body_ticket">
              <div id="w" class="clearfix">
<?php
$userdet=B1st_getUserInfoById($_SESSION['userid']);
//echo "<pre>";
//print_r($userdet);
//echo "</pre>";
$username=$userdet->username;
$responder_time_duration="";
$responder_time_duration=B1st_getresponsetimedur($_SESSION['userid']);
$repliedticketnumber=B1st_getticketreplied($_SESSION['userid']);
//echo "<pre>";
//print_r($responder_time_duration);
//echo "</pre>";
$chkrespond=B1st_fetchmod('response_time');

$settings = (array)B1st_getSettingsValue('response_time');
//print_r($settings);
//echo date('Y-m-d H:i:s');
$ajkertime=strtotime(date('Y-m-d H:i:s'));
if(!empty($settings))
{
  $t = $settings['number'];
  $l = $settings['unit'];
  $val = $t.' '.$l;
  $checktime = strtotime("+".$val,$ajkertime);
  
  $checktime = $checktime-$ajkertime;
}
$vv="";
//echo $checktime."<br />";
//echo $responder_time_duration;

$datediff=floor(($responder_time_duration-$checktime)/1000);

$averagerating=B1st_getticketrating();

$lowrate=B1st_getlowrate($_SESSION['userid']);

if(($responder_time_duration<=$checktime) or ($datediff==0))
{
  $vv="good";
}
else
{
  $vv="bad";
}
?>
    <ul id="sidemenu">
      <?php
      if($chkrespond==1)
      {
	  ?>
	    <li>
	      <a href="#home-content" class="open"><span>
	      <?php
	      if(!empty($responder_time_duration))
	      {
		if($vv=="good")
		{
		  ?>
		  <i class="fa fa-thumbs-o-up"></i>
		  <?php
		}
		if($vv=="bad")
		{
		  ?>
		  <i class="fa fa-thumbs-o-down"></i>
		  <?php
		}
	      }
	      else
	      {
		?>
		<i class="fa fa-exclamation-circle"></i>
		<?php
	      }
	      ?>
	      </span></a>
	    </li>
	  <?php
      }
      ?>

      <li>
        <a href="#about-content" <?php if($chkrespond==0) { ?> class="open" <?php } ?>><span><i class="fa fa-ticket"></i></span></a>
      </li>
      
      <li>
        <a href="#ideas-content"><span><i class="fa fa-spinner"></i></span></a>
      </li>
      
     <li>
        <a href="#contact-content"><span><i class="fa fa-times-circle"></i></span></a>
      </li>
    </ul>
    
    <div id="content">
	<?php
	if($chkrespond==1)
	{
	    ?>
	       <div id="home-content" class="contentblock">
		<h1><?php echo $this->lang->line('Response time');?></h1>
		<p><?php echo $this->lang->line('Hello');?> <?php echo $username;?>!
		<?php
		if(!empty($responder_time_duration))
		{
		  //if($vv=="good")
		  //{
		  ?>
		  <!--Congratulations-->
		  <?php
		  //}
		  //if($vv=="bad")
		  //{
		  ?>
		  <!--Sorry-->
		  <?php
		  //}
		  echo $this->lang->line("Your current Response Time is")." ".B1st_smarttimestamp($responder_time_duration);
		}
		else
		{
		  echo $this->lang->line("Respond quickly to improve your response time");
		}
		?>
	       </p>
	       </div>
	    <?php
	}
	?>
	<!-- @end #home-content -->
        
        <div id="about-content" class="contentblock <?php if($chkrespond!=0) { ?> hidden <?php } ?>">
          <h1><?php echo $this->lang->line('Average Rating');?></h1>
	  <?php
	  if(!empty($averagerating))
	  {
	  ?>
          <p><?php echo $this->lang->line('Average Rating for the Tickets is');?> <?php 
           for($i=0;$i<$averagerating;$i++)
           {
           		echo '<i class="fa fa-star"></i>&nbsp;';
           }
           ?></p>
	  <?php
	  }
	  else
	  {
	  ?>
	  <p><?php echo $this->lang->line('No tickets have been rated yet');?></p>
	  <?php
	  }
	  ?>
        </div><!-- @end #about-content -->
        
        <div id="ideas-content" class="contentblock hidden">
         <h1><?php echo $this->lang->line('Total Number of Ticket Replied');?></h1>
	  <?php
	  if(!empty($repliedticketnumber))
	  {
	  ?>
          <p><?php echo $this->lang->line('Number of tickets replied is');?> <?php echo $repliedticketnumber;?></p>
	  <?php
	  }
	  else
	  {
	  ?>
	  <p><?php echo $this->lang->line('You have not replied to any tickets');?></p>
	  <?php
	  }
	  ?>
        </div><!-- @end #ideas-content -->
        
        <div id="contact-content" class="contentblock hidden">
          <h1><?php echo $this->lang->line('Lowest Rated Tickets');?></h1>
	  <?php
	  if(!empty($lowrate))
	  {
	  ?>
          <p><?php echo $this->lang->line('Number of tickets with lowest rating is');?> <?php echo $lowrate;?></p>
	  <?php
	  }
	  else
	  {
	  ?>
	  <p><?php echo $this->lang->line('No tickets have been rated yet');?></p>
	  <?php
	  }
	  ?>
        </div><!-- @end #contact-content -->
    </div><!-- @end #content -->
  </div>
              </div>
            </div>
            
            <div class="from_sec">
             <div class="enquiry_box">
              <form action="<?php echo TICKET_PLUGIN_URL;?>CI/index.php/ticket/index" method="post">
		
               <label>
               <div class="bar_pi"></div>
                <input name="ticket_id" type="text" class="input_txt" placeholder="<?php echo $this->lang->line('Search by ticket number');?>" <?php if(!empty($searchticketid)) { ?> value="<?php echo $searchticketid;?>" <?php } ?>>
                <span><i class="fa fa-ticket"></i></span>
               </label>
	       
	       
               <label>
               <div class="bar_pi"></div>
                <input name="email" type="text" class="input_txt" placeholder="<?php echo $this->lang->line('Search by user email');?>" <?php if(!empty($searchemail)) { ?> value="<?php echo $searchemail;?>" <?php } ?>>
                <span><i class="fa fa-user"></i></span>
               </label>
		
		
	       <label>
               <div class="bar_pi"></div>
                <input name="text_part" type="text" class="input_txt" placeholder="<?php echo $this->lang->line('Search by part of text');?>" <?php if(!empty($search_text_part)) { ?> value="<?php echo $search_text_part;?>" <?php } ?>>
                <span><i class="fa fa-file"></i></span>
               </label>
	       
	       <?php
	       $priority=B1st_getPriorties();
	       if(!empty($priority))
	       {
	       //echo "<pre>";
	       //print_r($priority);
	       //echo "</pre>";
	       ?>
	       <label>
               <div class="bar_pi"></div>
		<select class="drpdwn" name="priority">
		  <option value=""><?php echo $this->lang->line('Search by priority');?></option>
		  <?php
		  foreach($priority as $prioritylist)
		  {
		    ?>
		    <option value="<?php echo $prioritylist->id;?>" <?php if(!empty($search_priority) and $search_priority==$prioritylist->id) { ?> selected="true" <?php } ?>><?php echo $prioritylist->priority_name;?></option>
		    <?php
		  }
		  ?>
		</select>
                <span><i class="fa fa-tasks"></i></span>
               </label>
	       <?php
	       }
	       $department=B1st_getDepartments();
	       //echo "<pre>";
	       //print_r($department);
	       //echo "</pre>";
	       if(!empty($department))
	       {
	       ?>
	       <label>
               <div class="bar_pi"></div>
		<select class="drpdwn" name="department">
		  <option value=""><?php echo $this->lang->line('Search by department');?></option>
		  <?php
		  foreach($department as $departmentlist)
		  {
		    ?>
		    <option value="<?php echo $departmentlist->id;?>" <?php if(!empty($search_department) and $search_department==$departmentlist->id) { ?> selected="true" <?php } ?>><?php echo $departmentlist->department_name;?></option>
		    <?php
		  }
		  ?>
		</select>
                <span><i class="fa fa-delicious"></i></span>
               </label>
	       <?php
	       }
	       $prodchk = B1st_fetchmod('product');
	       if($prodchk == 1)
	       {
		       $product=B1st_getProducts();
		       //echo "<pre>";
		       //print_r($product);
		       //echo "</pre>";
		       if(!empty($product))
		       {
		       ?>
		       <label>
	               <div class="bar_pi"></div>
			<select class="drpdwn" name="product">
			  <option value=""><?php echo $this->lang->line('Search by product');?></option>
			  <?php
			  foreach($product as $productlist)
			  {
			    ?>
			    <option value="<?php echo $productlist->id;?>" <?php if(!empty($search_product) and $search_product==$productlist->id) { ?> selected="true" <?php } ?>><?php echo $productlist->product_name;?></option>
			    <?php
			  }
			  ?>
			</select>
	                <span><i class="fa fa-renren"></i></span>
	               </label>
		       <?php
		       }
	    	}
	       $ticketstate=B1st_getTicketStates();
	       //echo "<pre>";
	       //print_r($ticketstate);
	       //echo "</pre>";
	       if(!empty($ticketstate))
	       {
	       ?>
	       <label>
               <div class="bar_pi"></div>
		<select class="drpdwn" name="state">
		  <option value=""><?php echo $this->lang->line('Search by state');?></option>
		  <?php
		  foreach($ticketstate as $ticketstatelist)
		  {
		    ?>
		    <option value="<?php echo $ticketstatelist->code;?>" <?php if(!empty($search_state) and $search_state==$ticketstatelist->code) { ?> selected="true" <?php } ?>><?php echo $ticketstatelist->name;?></option>
		    <?php
		  }
		  ?>
		</select>
                <span><i class="fa fa-codepen"></i></span>
               </label>
	       <?php
	       }
	       ?>
	       <!--<label>-->
               <!--<div class="bar_pi"></div>-->
		<!--<select class="drpdwn" name="admin">-->
		  <!--<option value="">Search by admin</option>-->
		<!--</select>-->
                <!--<span><i class="fa fa-user-md"></i></span>-->
               <!--</label>-->
		
                <!--<div class="side_pol">-->
                <!--<div class="checkbox">-->
                <!--<input class="check_po" type="checkbox" name="check" value="check1"><small>New</small>-->
                <!--</div>-->
                <!--</div>-->
                
                <!--<div class="side_pol">-->
                <!--<div class="checkbox">-->
                <!--<input class="check_po" type="checkbox" name="check" value="check1"><small>Answered</small>-->
                <!--</div>-->
                <!--</div>-->
              
              
               <button type="submit" class="sbmt sbmt_base sbmt_base-no-border"><i class="fa fa-spinner upload_icon"></i><?php echo $this->lang->line('Search');?></button>
              
              </form>
             </div>
            </div>
            
          </div>
         <!--/vertical_menu-->
         </div>
	<!--/another_extra_area-->