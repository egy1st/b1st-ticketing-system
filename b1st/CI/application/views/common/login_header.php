<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>B1st Ticketing System</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<link href="<?= TICKET_PLUGIN_URL;?>CI/assets/css/style.css" rel="stylesheet" type="text/css" />
<link href="<?= TICKET_PLUGIN_URL;?>CI/assets/css/responsive.css" rel="stylesheet" type="text/css" />
<link href="<?= TICKET_PLUGIN_URL;?>CI/assets/css/google-font.css" rel="stylesheet" type="text/css" />
<link href="<?= TICKET_PLUGIN_URL;?>CI/assets/font-awesome-4.3.0/css/font-awesome.css" rel="stylesheet" type="text/css" />
<link href="<?= TICKET_PLUGIN_URL;?>CI/assets/font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?= TICKET_PLUGIN_URL;?>CI/assets/js/jquery1.6.2.min.js"></script>
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
    <script type="text/javascript" src="<?= TICKET_PLUGIN_URL;?>CI/assets/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="<?= TICKET_PLUGIN_URL;?>CI/assets/js/modernizr.custom.29473.js"></script>
    <script type="text/javascript" src="<?= TICKET_PLUGIN_URL;?>CI/assets/js/jquery.tablesorter.min.js"></script>
    <script type="text/javascript" src="<?= TICKET_PLUGIN_URL;?>CI/assets/js/colorpicker.js"></script>
    <link href="<?= TICKET_PLUGIN_URL;?>CI/assets/css/colorpicker.css" rel="stylesheet" type="text/css" />
    <link href="<?= TICKET_PLUGIN_URL;?>CI/assets/js/themes/blue/style.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript">
    $(document).ready(function(){
       $(".tableSort").tablesorter({ theme: 'blue'}); 
    });
    </script>
    <style>
 @charset "utf-8";
/* CSS Document */

/* ---------- FONTAWESOME ---------- */


@import url(<?= TICKET_PLUGIN_URL;?>CI/assets/css/weloveFontAwesome.css);

/* ---------- ERIC MEYER'S RESET CSS ---------- */


@import url(<?= TICKET_PLUGIN_URL;?>CI/assets/css/reset.css);

/* ---------- FONTAWESOME ---------- */

[class*="fontawesome-"]:before {
  font-family: 'FontAwesome', sans-serif;
}

/* ---------- GENERAL ---------- */

body {

}

input {
  border: none;
  font-family: inherit;
  font-size: inherit;
  font-weight: inherit;
  line-height: inherit;
  -webkit-appearance: none;
}

/* ---------- LOGIN ---------- */

#login {
  margin: 50px auto;
  width: 400px;
}

#login h2 {
  background-color: #f95252;
  -webkit-border-radius: 10px 10px 0 0;
  -moz-border-radius: 10px 10px 0 0;
  border-radius: 10px 10px 0 0;
  color: #fff;
  font-size: 28px;
  padding: 20px 26px;
}

#login h2 span[class*="fontawesome-"] {
  margin-right: 14px;
}

#login fieldset {
  background-color: #fff;
  -webkit-border-radius: 0 0 10px 10px;
  -moz-border-radius: 0 0 10px 10px;
  border-radius: 0 0 10px 10px;
  padding: 20px 26px;
}

#login fieldset p {
  color: #777;
  margin-bottom: 14px;
}

#login fieldset p:last-child {
  margin-bottom: 0;
}

#login fieldset input,#login fieldset input select {
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
}

#login fieldset input[type="email"],input[type="text"], #login fieldset input[type="password"],#login fieldset select {
  background-color: #eee;
  color: #777;
  padding: 10px 10px;
  width: 328px;
}

#login fieldset input[type="submit"] {
  background-color: #33cc77;
  color: #fff;
  display: block;
  margin: 0 auto;
  padding: 10px 0;
  width: 100px;
}

#login .btn-verify{
    background-color: #33cc77;
  color: #fff;
  margin: 0 auto;
  padding: 10px 3px;
  display: inline-block;
    -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
}

#login fieldset input[type="submit"]:hover,#login .btn-verify:hover {
  background-color: #28ad63;
  cursor: pointer;
}

#login fieldset input[type="submit"].btn-disable{
  background-color: #d1d1d1;
}

#login .error{
     background-color: #f2dede;
    border-color: #eed3d7;
    color: #b94a48;
    border-radius: 4px;
    margin-bottom: 20px;
    padding: 8px 35px 8px 14px;
    text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
  }

  #login .error p{
    color: #b94a48;
    text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
       font-family: arial;
    font-size: 14px;
    margin-bottom: 5px;
    text-align: center;
  }

  .sub_container{
    width: 100%;
  }
 </style>
 <style>
.isa_info, .isa_success, .isa_warning, .isa_error {
  margin: 10px auto;
  padding:12px;
  width:60%;
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

@media screen and (max-width: 480px) {
 #login{width:90%;
	        margin:0 auto;
	 }
 #login fieldset{
	 padding: 20px 5%;
     width: 90%;
 }
 #login fieldset input[type="email"], input[type="text"], #login fieldset input[type="password"], #login fieldset select{width:93%;}
}
	 
 </style>
 <script>
    $(document).ready(function(){
      $('.isa_info, .isa_success, .isa_warning, .isa_error').delay(3000).fadeOut('slow');
    });
 </script>
 <link href="<?= TICKET_PLUGIN_URL;?>CI/assets/css/magnific-popup.css" rel="stylesheet" type="text/css" />
 <script type="text/javascript" src="<?= TICKET_PLUGIN_URL;?>CI/assets/js/jquery.magnific-popup.min.js"></script>
</head>


<body>
<div id="pi-all">
  <div class="container">
    <div class="sub_container">
      
	  