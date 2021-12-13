<?php
@session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>B1ST: Premium Ticketing System</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
       <link href="<?= TICKET_PLUGIN_URL;?>CI/assets/css/easy-responsive-tabs.css" rel="stylesheet" type="text/css" />
<?php
    $theme=B1st_getTheme();
   // echo "<pre>";
    //print_r($theme);
   // echo "</pre>";
	if(!empty($theme)){
    $themecolor=$theme->theme_name;
	}
else
{
$theme = '';
}
    ?>
    <?php
    if(!empty($themecolor))
    {
    ?>
    <link href="<?= TICKET_PLUGIN_URL;?>CI/assets/css/<?php echo $themecolor;?>style.css" rel="stylesheet" type="text/css" />
    <?php
    }
    else
    {
    ?>
    <link href="<?= TICKET_PLUGIN_URL;?>CI/assets/css/style.css" rel="stylesheet" type="text/css" />
    <?php
    }
    ?>
<link href="<?= TICKET_PLUGIN_URL;?>CI/assets/css/responsive.css" rel="stylesheet" type="text/css" />
<link href="<?= TICKET_PLUGIN_URL;?>CI/assets/css/developer.css" rel="stylesheet" type="text/css" />
<link href="<?= TICKET_PLUGIN_URL;?>CI/assets/css/google-font.css" rel="stylesheet" type="text/css" />
<link href="<?= TICKET_PLUGIN_URL;?>CI/assets/font-awesome-4.3.0/css/font-awesome.css" rel="stylesheet" type="text/css" />
<link href="<?= TICKET_PLUGIN_URL;?>CI/assets/font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

<!-- responsive css-->
  <link href="<?= TICKET_PLUGIN_URL;?>CI/assets/css/responsive_view.css" rel="stylesheet" type="text/css" />
<!-- responsive css-->  

 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
 <script src="<?= TICKET_PLUGIN_URL;?>CI/assets/js/confirmation.js"></script>
<script>
	 // DOM ready
	 $(function() {
	   
      // Create the dropdown base
      $("<select />").appendTo("nav");
      
      // Create default option "Go to..."
      $("<option />", {
         "selected": "selected",
         "value"   : "",
         "text"    : "Menu....."
      }).appendTo("nav select");
      
      // Populate dropdown with menu items
      $("nav a").each(function() {
       var el = $(this);
       $("<option />", {
           "value"   : el.attr("href"),
           "text"    : el.text()
       }).appendTo("nav select");
      });
      
	   // To make dropdown actually work
	   // To make more unobtrusive: http://css-tricks.com/4064-unobtrusive-page-changer/
      $("nav select").change(function() {
        window.location = $(this).find("option:selected").val();
      });
	 
	 });
	</script>
    <script type="text/javascript" src="<?= TICKET_PLUGIN_URL;?>CI/assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?= TICKET_PLUGIN_URL;?>CI/assets/js/modernizr.custom.29473.js"></script>
    <script type="text/javascript" src="<?= TICKET_PLUGIN_URL;?>CI/assets/js/jquery.tablesorter.min.js"></script>
    <script type="text/javascript" src="<?= TICKET_PLUGIN_URL;?>CI/assets/js/colorpicker.js"></script>
    <script type="text/javascript" src="<?= TICKET_PLUGIN_URL;?>CI/assets/js/datepick.js"></script>
    <link href="<?= TICKET_PLUGIN_URL;?>CI/assets/css/colorpicker.css" rel="stylesheet" type="text/css" />
    <link href="<?= TICKET_PLUGIN_URL;?>CI/assets/css/datepick.css" rel="stylesheet" type="text/css" />
    <link href="<?= TICKET_PLUGIN_URL;?>CI/assets/js/themes/blue/style.css" rel="stylesheet" type="text/css" />
    


	<script src="<?= TICKET_PLUGIN_URL;?>CI/assets/js/frosty.min.js" type="text/javascript"></script>
    <link href="<?= TICKET_PLUGIN_URL;?>CI/assets/css/frosty.min.css" rel="stylesheet" type="text/css" />

    <link href="<?= TICKET_PLUGIN_URL;?>CI/assets/css/jRating.jquery.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="<?= TICKET_PLUGIN_URL;?>CI/assets/js/jRating.jquery.js"></script>
    <link href="<?= TICKET_PLUGIN_URL;?>CI/assets/css/magnific-popup.css" rel="stylesheet" type="text/css" />
 
    <script type="text/javascript" src="<?= TICKET_PLUGIN_URL;?>CI/assets/js/jquery.magnific-popup.min.js"></script>
     <script type="text/javascript" src="<?= TICKET_PLUGIN_URL;?>CI/assets/js/easyResponsiveTabs.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
       $(".tableSort").tablesorter({ theme: 'blue'}); 

       $('.has-tip').frosty();
    });
    </script>
  
  <style>
.isa_info, .isa_success, .isa_warning, .isa_error {
  margin: 10px auto;
  padding:12px;
  width:100%;
  float: left;
  }
.isa_info {
    color: #00529B;
    background-color: #BDE5F8;
}
.isa_success {
    color: #4F8A10;
    background-color: #DFF2BF;
}
.isa_warning {
    color: #9F6000;
    background-color: #FEEFB3;
}
.isa_error {
    color: #D8000C;
    background-color: #FFBABA;
}
.isa_info i, .isa_success i, .isa_warning i, .isa_error i {
    margin:10px 22px;
    font-size:2em;
    vertical-align:middle;
}

.welcometext .fa{
    font-size:20px;
}
 </style>
 <script>
    $(document).ready(function(){
      $('.isa_info, .isa_success, .isa_warning, .isa_error').delay(3000).fadeOut('slow');
    });
 </script>
  
</head>
<?php
if(!empty($_SESSION['privilege_group_id']))
{
    $privilegegroupid=$_SESSION['privilege_group_id'];
}
else
{
    $privilegegroupid="";
}
?>
<body>
<div id="pi-all">
  <div class="container">
    <div class="sub_container">
       <!--headder--> 
         <div class="header_all">
           <!--navigation-->
             <div class="nav_all">
                     <div class="navigation"><i class="fa fa-bars"></i> <span class="navi"><?php echo $this->lang->line('Navigation');?></span></div>             
               <nav>  
                  <!--<ul>-->
		    <?php
		    /*$chk=B1st_geturl();
		    ?>
                    <li class="bar_Side bar_side"><a onclick="checkurl('<?php echo WPADMINURL;?>index.php/ticket')" href="javascript:void(0);" <?php if($chk=="ticket" or $chk=="assignticket") { ?> class="active" <?php } ?>><span><i class="fa fa-ticket"></i></span><?php echo $this->lang->line('Ticket');?></a></li>
		    <li><a onclick="checkurl('<?php echo WPADMINURL;?>index.php?page=company')" href="javascript:void(0);" <?php if($chk=="company") { ?> class="active" <?php } ?>><span><i class="fa fa-institution"></i></span><?php echo $this->lang->line('Company');?></a></li>
		    <li><a onclick="checkurl('<?php echo WPADMINURL;?>index.php?page=product')" href="javascript:void(0);" <?php if($chk=="product") { ?> class="active" <?php } ?>><span><i class="fa fa-gift"></i></span><?php echo $this->lang->line('Product');?></a></li>
		    <li><a onclick="checkurl('<?php echo WPADMINURL;?>index.php?page=department')" href="javascript:void(0);" <?php if($chk=="department") { ?> class="active" <?php } ?>><span><i class="fa fa-sitemap"></i></span><?php echo $this->lang->line('Department');?></a></li> 
                    <!--<li><a href="services.html"><span><i class="fa fa-minus-square"></i></span>Divisions</a> -->
                    </li>
                    <!--<li><a href="quote.html"><span><i class="fa fa-envelope-o"></i></span>Emails  -->
                    </a> 
                    </li>
		    <?php
		    $faq=B1st_fetchmod('faq');
		    if($faq==1)
		    {
		    ?>
                    <li><a onclick="checkurl('<?php echo WPADMINURL;?>index.php/faq')" href="javascript:void(0);" <?php if($chk=="faq") { ?> class="active" <?php } ?>><span><i class="fa fa-question-circle"></i></span><?php echo $this->lang->line('Faqs');?></a></li>
		    <?php
		    }
		    ?>
		    <li><a onclick="checkurl('<?php echo WPADMINURL;?>index.php?page=users')" href="javascript:void(0);" <?php if($chk=="users") { ?> class="active" <?php } ?>><span><i class="fa fa-users"></i></span><?php echo $this->lang->line('Users');?> </a>
                    </li>
		    <?php
		    if($privilegegroupid==1)
		    {
		    ?>
                    <li><a onclick="checkurl('<?php echo WPADMINURL;?>index.php?page=settings')" href="javascript:void(0);" <?php if($chk=="settings") { ?> class="active" <?php } ?>><span><i class="fa fa-cog"></i></span><?php echo $this->lang->line('Settings');?></a></li>
		    <?php
		    }
		    $backup=B1st_fetchmod('backup');
		    if($backup==1)
		    {
		    ?>
                     <li><a onclick="checkurl('<?php echo WPADMINURL;?>index.php?page=backup')" href="javascript:void(0);" <?php if($chk=="backup") { ?> class="active" <?php } ?>><span><i class="fa fa-database"></i></span><?php echo $this->lang->line('Backup');?></a></li>
		    <?php
		    }
		    ?>
		     <li><a onclick="checkurl('<?php echo WPADMINURL;?>index.php?page=theme')" href="javascript:void(0);" <?php if($chk=="theme") { ?> class="active" <?php } ?>><span><i class="fa fa-paint-brush"></i></span><?php echo $this->lang->line('Theme');?></a></li>
		    <?php
		    $statistics=B1st_fetchmod('statistics');
		    if($statistics==1)
		    {
		    ?>
		     <li><a onclick="checkurl('<?php echo WPADMINURL;?>index.php?page=statistics')" href="javascript:void(0);" <?php if($chk=="statistics") { ?> class="active" <?php } ?>><span><i class="fa fa-fax"></i></span><?php echo $this->lang->line('Statistics');?></a></li>
		    <?php
		    }
		    ?>
                     <li><a onclick="window.location.href='<?= TICKET_PLUGIN_URL ?>CI/index.php/logins/logout'" href="javascript:void(0);"><span><i class="fa fa-sign-out"></i></span><?php echo $this->lang->line('Logout');?></a></li>
                  </ul>
                  */
		    ?>
		    <?php
			$chk=B1st_geturl();
		    ?>
		  <ul>
		    <li class="bar_Side bar_side"><a <?php if(($chk=="company") or ($chk=="product") or ($chk=="department")) { ?> class="active" <?php } ?> href="javascript:void(0);"><span><i class="fa fa-bullseye"></i></span><?php echo $this->lang->line('Main');?></a>
			<ul>
			    <?php
			    $companymod=B1st_fetchmod('company');
			    if($companymod==1)
			    {
			    ?>
			    <li><a  <?php if($chk=="company") { ?> class="active" <?php } ?> onclick="checkurl('<?php echo WPADMINURL;?>index.php/company')" href="javascript:void(0);"><span><i class="fa fa-institution"></i></span><?php echo $this->lang->line('Companies');?></a></li>
			    <?php
			    }
			    $productmod=B1st_fetchmod('product');
			    if($productmod==1)
			    {
			    ?>
			    <li><a  <?php if($chk=="product") { ?> class="active" <?php } ?> onclick="checkurl('<?php echo WPADMINURL;?>index.php/product')" href="javascript:void(0);"><span><i class="fa fa-gift"></i></span><?php echo $this->lang->line('Products');?></a></li>
			    <?php
			    }
			    ?>
			    <li><a  <?php if($chk=="department") { ?> class="active" <?php } ?> onclick="checkurl('<?php echo WPADMINURL;?>index.php/department')" href="javascript:void(0);"><span><i class="fa fa-sitemap"></i></span><?php echo $this->lang->line('Departments');?></a></li>
			</ul>
		    </li>
		    <li><a <?php if(($chk=="ticket") or ($chk=="assignticket") or ($chk=="ticketpriority") or ($chk=="imap") or ($chk=="twitter")) { ?> class="active" <?php } ?> href="javascript:void(0);"><span><i class="fa fa-ticket"></i></span><?php echo $this->lang->line('Ticketing');?></a>
			<ul>
			    <li><a <?php if(($chk=="ticket") or ($chk=="assignticket")) { ?> class="active" <?php } ?> onclick="checkurl('<?php echo WPADMINURL;?>index.php/ticket')" href="javascript:void(0);"><span><i class="fa fa-ticket"></i></span><?php echo $this->lang->line('Tickets');?></a></li>
			    <li><a  <?php if($chk=="ticketpriority") { ?> class="active" <?php } ?> onclick="checkurl('<?php echo WPADMINURL;?>index.php/ticketpriority')" href="javascript:void(0);"><span><i class="fa fa-star"></i></span><?php echo $this->lang->line('Ticket Priority');?></a></li>
			    <?php
    if($privilegegroupid==1)
	{
			    $emailmod=B1st_fetchmod('email_mod');
			    if($emailmod==1)
			    {
			    ?>
			    <li><a  <?php if($chk=="imap") { ?> class="active" <?php } ?> onclick="checkurl('<?php echo WPADMINURL;?>index.php/imap')" href="javascript:void(0);"><span><i class="fa fa-envelope"></i></span><?php echo $this->lang->line('Email');?></a></li>
			    <?php
			    }
			    $twitter=B1st_fetchmod('twitter');
			    if($twitter==1)
			    {
			    ?>
			    <li><a  <?php if($chk=="twitter") { ?> class="active" <?php } ?> onclick="checkurl('<?php echo WPADMINURL;?>index.php/twitter')" href="javascript:void(0);"><span><i class="fa fa-twitter"></i></span><?php echo $this->lang->line('Twitter');?></a></li>
			    <?php
			    }
    }
			    ?>
			</ul>
		    </li>
		    <li><a <?php if(($chk=="privilagegroup") or ($chk=="users")) { ?> class="active" <?php } ?> href="javascript:void(0);"><span><i class="fa fa-users"></i></span><?php echo $this->lang->line('Users');?></a>
			<ul>
			    <?php
			    if($privilegegroupid==1)
			    {
			    ?>
				<li><a  <?php if($chk=="privilagegroup") { ?> class="active" <?php } ?> onclick="checkurl('<?php echo WPADMINURL;?>index.php/privilagegroup')" href="javascript:void(0);"><span><i class="fa fa-key"></i></span><?php echo $this->lang->line('Privilege');?></a></li>
			    <?php
			    }
			    ?>
			    <li><a  <?php if($chk=="users") { ?> class="active" <?php } ?> onclick="checkurl('<?php echo WPADMINURL;?>index.php/users')" href="javascript:void(0);"><span><i class="fa fa-users"></i></span><?php echo $this->lang->line('Admin/Clients');?></a></li>
			</ul>
		    </li>
		    <?php
		    $backup=B1st_fetchmod('backup');
		    if($backup==1)
		    {
		    ?>
		    <li><a <?php if($chk=="backup") { ?> class="active" <?php } ?> href="javascript:void(0);"><span><i class="fa fa-lock"></i></span><?php echo $this->lang->line('Safety & Security');?></a>
			<ul>
			    <li><a <?php if($chk=="backup") { ?> class="active" <?php } ?> onclick="checkurl('<?php echo WPADMINURL;?>index.php/backup')" href="javascript:void(0);"><span><i class="fa fa-database"></i></span><?php echo $this->lang->line('Backup');?></a></li>
			</ul>
		    </li>
		    <?php
		    }
		    ?>
		    <li><a <?php if(($chk=="theme") or ($chk=="language")) { ?> class="active" <?php } ?> href="javascript:void(0);"><span><i class="fa fa-paint-brush"></i></span><?php echo $this->lang->line('Appearance & Locale');?></a>
			<ul>
			    <li><a <?php if($chk=="theme") { ?> class="active" <?php } ?> onclick="checkurl('<?php echo WPADMINURL;?>index.php/theme')" href="javascript:void(0);"><span><i class="fa fa-paint-brush"></i></span><?php echo $this->lang->line('Theme');?></a></li>
			    <li><a <?php if($chk=="language") { ?> class="active" <?php } ?> onclick="checkurl('<?php echo WPADMINURL;?>index.php/language')" href="javascript:void(0);"><span><i class="fa fa-language"></i></span><?php echo $this->lang->line('Language');?></a></li>
			</ul>
		    </li>
		    <?php
    if($privilegegroupid==1)
	{
		    $knowledgebase_cat=B1st_fetchmod('knowledge_base_cat');
		    $faq=B1st_fetchmod('faq');
		   if($productmod==1)
			{ 
			    if($knowledgebase_cat == 1 or $faq == 1)
			    {
		    ?>
		    <li><a <?php if(($chk=="knowledgebase") or ($chk=="kbcat") or ($chk=="faq")) { ?> class="active" <?php } ?> href="javascript:void(0);"><span><i class="fa fa-graduation-cap"></i></span><?php echo $this->lang->line('Technical Contents');?></a>
			<ul>
			    <?php
			    
			    if($knowledgebase_cat==1)
			    {
			    ?>
			    <li><a <?php if($chk=="kbcat") { ?> class="active" <?php } ?> onclick="checkurl('<?php echo WPADMINURL;?>index.php/kbcat')" href="javascript:void(0);"><span><i class="fa fa-graduation-cap"></i></span><?php echo $this->lang->line('KB Categories');?></a></li>
			    <li><a <?php if($chk=="knowledgebase") { ?> class="active" <?php } ?> onclick="checkurl('<?php echo WPADMINURL;?>index.php/knowledgebase')" href="javascript:void(0);"><span><i class="fa fa-graduation-cap"></i></span><?php echo $this->lang->line('Knowledge Base');?></a></li>
			    <?php
			    }
			    
			    if($faq==1)
			    {
			    ?>
			    <li><a <?php if($chk=="faq") { ?> class="active" <?php } ?> onclick="checkurl('<?php echo WPADMINURL;?>index.php/faq')" href="javascript:void(0);"><span><i class="fa fa-question-circle"></i></span><?php echo $this->lang->line('FAQ');?></a></li>
			    <?php
			    }
			    ?>
			</ul>
		    </li>
		    <?php
			}
		   } 
	}
		  ?>
		    <li><a <?php if(($chk=="statistics") or ($chk=="settings") or ($chk=="premium")) { ?> class="active" <?php } ?> href="javascript:void(0);"><span><i class="fa fa-wrench"></i></span><?php echo $this->lang->line('Tools');?></a>
			<ul>
			    <?php
			    if($privilegegroupid==1)
			    {
			    ?>
			    <li><a  <?php if($chk=="settings") { ?> class="active" <?php } ?> onclick="checkurl('<?php echo WPADMINURL;?>index.php/settings')" href="javascript:void(0);"><span><i class="fa fa-cog"></i></span><?php echo $this->lang->line('Settings');?></a></li>
			    <?php
			    }
			    $statistics=B1st_fetchmod('statistics');
			    if($statistics==1)
			    {
			    ?>
			    <li><a  <?php if($chk=="statistics") { ?> class="active" <?php } ?> onclick="checkurl('<?php echo WPADMINURL;?>index.php/statistics')" href="javascript:void(0);"><span><i class="fa fa-area-chart"></i></span><?php echo $this->lang->line('Statistics');?></a></li>
			    <?php
			    }
			    if($privilegegroupid==1)
			    {
			    ?>
			    <li><a  <?php if($chk=="premium") { ?> class="active" <?php } ?> onclick="checkurl('<?php echo WPADMINURL;?>index.php/premium')" href="javascript:void(0);"><span><i class="fa fa-money"></i></span><?php echo $this->lang->line('Configuration');?></a></li>
			    <?php
			    }
			    ?>
			</ul>
		    </li>
		    <li><a onclick="window.location.href='<?= TICKET_PLUGIN_URL ?>CI/index.php/logins/logout'" href="javascript:void(0);"><span><i class="fa fa-sign-out"></i></span><?php echo $this->lang->line('Logout');?></a></li>
		  </ul>
                </nav>
             </div>
           <!--navigation-->
           <!--notification-->
			<div class="notification_box">
			<?php 
			$e = B1st_getEmailCountInfo();
			?>
			<ul class="notific_list">
			<li><a href="#" ><?php echo $this->lang->line('All Email');?></a><div class="color_mm"><?php echo $e['all'] ?></div></li>
			<li><a href="#"><span><i class="fa fa-check"></i></span><?php echo $this->lang->line('Posted');?></a><div class="color_mm pub_mm"><?php echo $e['posted'] ?></div></li>
<li><a href="#"><span><i class="fa fa-trash-o"></i></span><?php echo $this->lang->line('Deleted');?></a><div class="color_mm drf_mm"><?php echo $e['deleted'] ?></div></li>
<!-- 			<li class="trash_pi"><a href="#"><span><i class="fa fa-trash-o"></i></span><?php echo $this->lang->line('Deleted');?></a><div class="color_mm trs_mm">0</div></li> -->
			</ul>
			</div>
            <!--/notification-->
         </div>
       <!--/headder-->
<script>
function checkurl(urllocation)
{
    window.parent.location.href=urllocation;
}
</script>
<?php B1st_showmessage();?>
<?php
$chk=B1st_fetchmod('chat');
if($chk==1)
{
    $this->load->view('common/chat');
}
?>




<script type="text/javascript">

	
$(window).resize(function()
{
	if($(window).width()<980){
		$('.navigation').css({'display':'block'});
		$('nav').hide();
		}
   else{$('.navigation').css({'display':'none'});
         $('nav').show();
   }});
   
   
$(document).ready(function() {
	$(".navigation").click(function() {
		$("nav").slideToggle();
	});
}); 



<!-- width calculation -->

$(window).resize(function() {
  if ($(window).width() < 1001) {
     widthx=$(window).width()-$(".pil_extra").width()-40;
		$('.product_box').css('width',widthx);
  }
 else {
    $('.product_box').css('width',750);
 }
});


<!-- div animation -->
$(document).ready(function(){
$(".show_ticketpanel").click(function(){
    $(".pil_extra").toggleClass("show_ticket");
	$(this).toggleClass("move");
});
});

</script> 