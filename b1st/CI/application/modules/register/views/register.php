<?php $this->load->view('common/login_header'); 
//define ('TICKET_PLUGIN_URL', 'http://egyfirst.com/b1st/');
//echo TICKET_PLUGIN_URL ;
?>
 
 <?php if(isset($_SESSION['register_success'])) { ?>
 <div class="isa_success">
     <i class="fa fa-check"></i>
     <?= $_SESSION['register_success']; ?>
</div>
<?php
unset($_SESSION['register_success']);
 } ?>
 <!-- start login -->
 <div id="login">

    <h2><span class="fontawesome-lock"></span>Register</h2>

    <form id="regForm" action="<?= TICKET_PLUGIN_URL ?>CI/index.php/register/doRegister" method="POST">

      <fieldset>
      <?php
      $valerror=validation_errors();
      if(!empty($valerror) || !empty($_SESSION['register_error'])) { ?>
      <div class="error">
          <?php echo validation_errors(); 
            if(!empty($_SESSION['register_error']))
            {
              echo $_SESSION['register_error'];
              unset($_SESSION['register_error']);
            }
          ?>
      </div>
      <?php } ?>
        <p><label for="username">Username</label></p>
        <p><input type="text" id="username" name="username" value="<?= set_value('username'); ?>" ></p>

        <p><label for="username">First Name</label></p>
        <p><input type="text" id="firstname" name="firstname" value="<?= set_value('firstname'); ?>" ></p> 

        <p><label for="username">Last Name</label></p>
        <p><input type="text" id="lastname" name="lastname" value="<?= set_value('lastname'); ?>" ></p>  
        
        <p><label for="email">Email</label></p>
        <p><input type="text" id="email" name="email" value="<?= set_value('email'); ?>" ></p> 
        
        <p><label for="password">Password</label></p>
        <p><input type="password" id="password" name="password" ></p> 
        
        <p><label for="password">Confirm Password</label></p>
        <p><input type="password" id="cpassword" name="cpassword" ></p>
        
        <?php
        $chkmob=B1st_fetchmod('mob_ver');
        if($chkmob==1)
	{
         $settings_mob = B1st_getSettingsValue('mobile_verification'); 
        ?>
        <p><label for="password">Mobile No. <?php if($settings_mob->type != 1) echo "(optional)"; ?></label></p>
        <p>
        <!-- <input type="text" id="mcode"  value="+91" size="3" style="width:30px" >8583022646 -->
  <select id="mcode" style="width:160px;border:0;">
     <option value="1">USA (+1) 
     <option value="213">Algeria (+213) 
     <option value="376">Andorra (+376) 
     <option value="244">Angola (+244) 
     <option value="1264">Anguilla (+1264) 
     <option value="1268">Antigua &amp; Barbuda (+1268) 
     <option value="599">Antilles (Dutch) (+599) 
     <option value="54">Argentina (+54) 
     <option value="374">Armenia (+374) 
     <option value="297">Aruba (+297) 
     <option value="247">Ascension Island (+247) 
     <option value="61">Australia (+61) 
     <option value="43">Austria (+43) 
     <option value="994">Azerbaijan (+994) 
     <option value="1242">Bahamas (+1242) 
     <option value="973">Bahrain (+973) 
     <option value="880">Bangladesh (+880) 
     <option value="1246">Barbados (+1246) 
     <option value="375">Belarus (+375) 
     <option value="32">Belgium (+32) 
     <option value="501">Belize (+501) 
     <option value="229">Benin (+229) 
     <option value="1441">Bermuda (+1441) 
     <option value="975">Bhutan (+975) 
     <option value="591">Bolivia (+591) 
     <option value="387">Bosnia Herzegovina (+387) 
     <option value="267">Botswana (+267) 
     <option value="55">Brazil (+55) 
     <option value="673">Brunei (+673) 
     <option value="359">Bulgaria (+359) 
     <option value="226">Burkina Faso (+226) 
     <option value="257">Burundi (+257) 
     <option value="855">Cambodia (+855) 
     <option value="237">Cameroon (+237) 
     <option value="1">Canada (+1) 
     <option value="238">Cape Verde Islands (+238) 
     <option value="1345">Cayman Islands (+1345) 
     <option value="236">Central African Republic (+236) 
     <option value="56">Chile (+56) 
     <option value="86">China (+86) 
     <option value="57">Colombia (+57) 
     <option value="269">Comoros (+269) 
     <option value="242">Congo (+242) 
     <option value="682">Cook Islands (+682) 
     <option value="506">Costa Rica (+506) 
     <option value="385">Croatia (+385) 
     <option value="53">Cuba (+53) 
     <option value="90392">Cyprus North (+90392) 
     <option value="357">Cyprus South (+357) 
     <option value="42">Czech Republic (+42) 
     <option value="45">Denmark (+45) 
     <option value="2463">Diego Garcia (+2463) 
     <option value="253">Djibouti (+253) 
     <option value="1809">Dominica (+1809) 
     <option value="1809">Dominican Republic (+1809) 
     <option value="593">Ecuador (+593) 
     <option value="20">Egypt (+20) 
     <option value="353">Eire (+353) 
     <option value="503">El Salvador (+503) 
     <option value="240">Equatorial Guinea (+240) 
     <option value="291">Eritrea (+291) 
     <option value="372">Estonia (+372) 
     <option value="251">Ethiopia (+251) 
     <option value="500">Falkland Islands (+500) 
     <option value="298">Faroe Islands (+298) 
     <option value="679">Fiji (+679) 
     <option value="358">Finland (+358) 
     <option value="33">France (+33) 
     <option value="594">French Guiana (+594) 
     <option value="689">French Polynesia (+689) 
     <option value="241">Gabon (+241) 
     <option value="220">Gambia (+220) 
     <option value="7880">Georgia (+7880) 
     <option value="49">Germany (+49) 
     <option value="233">Ghana (+233) 
     <option value="350">Gibraltar (+350) 
     <option value="30">Greece (+30) 
     <option value="299">Greenland (+299) 
     <option value="1473">Grenada (+1473) 
     <option value="590">Guadeloupe (+590) 
     <option value="671">Guam (+671) 
     <option value="502">Guatemala (+502) 
     <option value="224">Guinea (+224) 
     <option value="245">Guinea - Bissau (+245) 
     <option value="592">Guyana (+592) 
     <option value="509">Haiti (+509) 
     <option value="504">Honduras (+504) 
     <option value="852">Hong Kong (+852) 
     <option value="36">Hungary (+36) 
     <option value="354">Iceland (+354) 
     <option value="91">India (+91) 
     <option value="62">Indonesia (+62) 
     <option value="98">Iran (+98) 
     <option value="964">Iraq (+964) 
     <option value="972">Israel (+972) 
     <option value="39">Italy (+39) 
     <option value="225">Ivory Coast (+225) 
     <option value="1876">Jamaica (+1876) 
     <option value="81">Japan (+81) 
     <option value="962">Jordan (+962) 
     <option value="7">Kazakhstan (+7) 
     <option value="254">Kenya (+254) 
     <option value="686">Kiribati (+686) 
     <option value="850">Korea North (+850) 
     <option value="82">Korea South (+82) 
     <option value="965">Kuwait (+965) 
     <option value="996">Kyrgyzstan (+996) 
     <option value="856">Laos (+856) 
     <option value="371">Latvia (+371) 
     <option value="961">Lebanon (+961) 
     <option value="266">Lesotho (+266) 
     <option value="231">Liberia (+231) 
     <option value="218">Libya (+218) 
     <option value="417">Liechtenstein (+417) 
     <option value="370">Lithuania (+370) 
     <option value="352">Luxembourg (+352) 
     <option value="853">Macao (+853) 
     <option value="389">Macedonia (+389) 
     <option value="261">Madagascar (+261) 
     <option value="265">Malawi (+265) 
     <option value="60">Malaysia (+60) 
     <option value="960">Maldives (+960) 
     <option value="223">Mali (+223) 
     <option value="356">Malta (+356) 
     <option value="692">Marshall Islands (+692) 
     <option value="596">Martinique (+596) 
     <option value="222">Mauritania (+222) 
     <option value="269">Mayotte (+269) 
     <option value="52">Mexico (+52) 
     <option value="691">Micronesia (+691) 
     <option value="373">Moldova (+373) 
     <option value="377">Monaco (+377) 
     <option value="976">Mongolia (+976) 
     <option value="1664">Montserrat (+1664) 
     <option value="212">Morocco (+212) 
     <option value="258">Mozambique (+258) 
     <option value="95">Myanmar (+95) 
     <option value="264">Namibia (+264) 
     <option value="674">Nauru (+674) 
     <option value="977">Nepal (+977) 
     <option value="31">Netherlands (+31) 
     <option value="687">New Caledonia (+687) 
     <option value="64">New Zealand (+64) 
     <option value="505">Nicaragua (+505) 
     <option value="227">Niger (+227) 
     <option value="234">Nigeria (+234) 
     <option value="683">Niue (+683) 
     <option value="672">Norfolk Islands (+672) 
     <option value="670">Northern Marianas (+670) 
     <option value="47">Norway (+47) 
     <option value="968">Oman (+968) 
     <option value="680">Palau (+680) 
     <option value="507">Panama (+507) 
     <option value="675">Papua New Guinea (+675) 
     <option value="595">Paraguay (+595) 
     <option value="51">Peru (+51) 
     <option value="63">Philippines (+63) 
     <option value="48">Poland (+48) 
     <option value="351">Portugal (+351) 
     <option value="1787">Puerto Rico (+1787) 
     <option value="974">Qatar (+974) 
     <option value="262">Reunion (+262) 
     <option value="40">Romania (+40) 
     <option value="7">Russia (+7) 
     <option value="250">Rwanda (+250) 
     <option value="378">San Marino (+378) 
     <option value="239">Sao Tome &amp; Principe (+239) 
     <option value="966">Saudi Arabia (+966) 
     <option value="221">Senegal (+221) 
     <option value="381">Serbia (+381) 
     <option value="248">Seychelles (+248) 
     <option value="232">Sierra Leone (+232) 
     <option value="65">Singapore (+65) 
     <option value="421">Slovak Republic (+421) 
     <option value="386">Slovenia (+386) 
     <option value="677">Solomon Islands (+677) 
     <option value="252">Somalia (+252) 
     <option value="27">South Africa (+27) 
     <option value="34">Spain (+34) 
     <option value="94">Sri Lanka (+94) 
     <option value="290">St. Helena (+290) 
     <option value="1869">St. Kitts (+1869) 
     <option value="1758">St. Lucia (+1758) 
     <option value="249">Sudan (+249) 
     <option value="597">Suriname (+597) 
     <option value="268">Swaziland (+268) 
     <option value="46">Sweden (+46) 
     <option value="41">Switzerland (+41) 
     <option value="963">Syria (+963) 
     <option value="886">Taiwan (+886) 
     <option value="7">Tajikstan (+7) 
     <option value="66">Thailand (+66) 
     <option value="228">Togo (+228) 
     <option value="676">Tonga (+676) 
     <option value="1868">Trinidad &amp; Tobago (+1868) 
     <option value="216">Tunisia (+216) 
     <option value="90">Turkey (+90) 
     <option value="7">Turkmenistan (+7) 
     <option value="993">Turkmenistan (+993) 
     <option value="1649">Turks &amp; Caicos Islands (+1649) 
     <option value="688">Tuvalu (+688) 
     <option value="256">Uganda (+256) 
     <option value="44">UK (+44) 
     <option value="380">Ukraine (+380) 
     <option value="971">United Arab Emirates (+971) 
     <option value="598">Uruguay (+598) 
     <option value="1">USA (+1) 
     <option value="7">Uzbekistan (+7) 
     <option value="678">Vanuatu (+678) 
     <option value="379">Vatican City (+379) 
     <option value="58">Venezuela (+58) 
     <option value="84">Vietnam (+84) 
     <option value="84">Virgin Islands - British (+1284) 
     <option value="84">Virgin Islands - US (+1340) 
     <option value="681">Wallis &amp; Futuna (+681) 
     <option value="969">Yemen (North) (+969) 
     <option value="967">Yemen (South) (+967) 
     <option value="381">Yugoslavia (+381) 
     <option value="243">Zaire (+243) 
     <option value="260">Zambia (+260) 
     <option value="263">Zimbabwe (+263)
</select>

        <input type="text" id="mobilenumber"  value="" size="10" style="width:100px;" > 
  <?php
     if($settings_mob->type == 1)
     {
    ?>
        <a class="btn-verify" href="javascript:void(0);" id="mobileverify">Verify</a>
    <?php 
    } ?>
    </p>
        <input type="hidden" name="user_mobile" id="user_mobile" value="" >
        <?php
        }
        ?>
        <?php
         $settings = B1st_getSettingsValue('register');
         $captcha = B1st_getSettingsValue('reCAPTCHA');
         if($captcha->type == 1)
         {
         ?> 
        <p>
        <div class="g-recaptcha" data-theme="<?= $captcha->theme ?>" data-sitekey="<?= $captcha->sitekey; ?>"></div>
        </p>
        <?php } ?>
      <input type="hidden" id="c_type" name="c_type" value="<?= $settings->active ?>" >
      <p><input type="submit" name="register" value="Register"></p>
      <p>Already a member ? <a href="<?= TICKET_PLUGIN_URL ?>CI/index.php/register/login">Login</a></p>
      </fieldset>
    </form>
    
  </div> 
  <!-- end login -->
  <?php if($captcha->type == 1){ ?>
 <!-- reCAPTCHA API call -->
<script src='https://www.google.com/recaptcha/api.js?hl=<?= $captcha->language; ?>
'></script>
<?php } ?>
<div id="mobileVerifyBox" class="white-popup mfp-hide">
  <form id="mobileVerify_form" method="post" action="<?= TICKET_PLUGIN_URL;?>CI/index.php/register/VerifyMobileNumber">
    
          <div class="main_pro_pi" style="width: 100%;">
      <div class="status-message">
      </div>

              <div id="formBox" style="display: none" class="fileds">
        
                    <div class="form_holder">
                    <label><span></span></label>
                                  You may got a missed call to<br>
                    <strong id="mnumber" style="font-weight:bold;line-height:24px;">+918100651750</strong>
                    <br>
                    . in 60 secs
                  </div>   

    <div class="form_holder">
      <label><span>Enter Last 5 Digit of Missed Call:</span></label>
      <input type="text" value="" id="otp" name="otp">
    </div>
         <input type="hidden" name="keymatch" value="" id="keymatch" />
         <input type="hidden" name="mobile_number" value="" id="mobile_number" />
               
               <!-- <div class="form_holder radio">
                 <label><span>Radio</span></label>
                 <input name="" type="checkbox" value=""> Checkbox
               </div> -->
               
               
               <div class="form_holder">
               <button type="submit" class="sbmt sbmt_base sbmt_base-no-border"><i class="fa fa-spinner upload_icon"></i>OK</button>
               </div>
               
              </div>
    
        
         
              </div>
              <div style="clear: both;"></div>
</form>
</div>
<script type="text/javascript">
       $('#mobileverify').magnificPopup({
                items: {
                    src: '#mobileVerifyBox',
                    type: 'inline'
                },
                closeBtnInside: true,

                callbacks: {
                open: function() {
                  
                 var mobileNo = $("#mcode").val()+$("#mobilenumber").val();

                 var url = "<?= TICKET_PLUGIN_URL ?>CI/index.php/register/getOTP",
                     data = {mobile:mobileNo};

                   $.ajax({
                          url: url,
                          data:data,
                          type:"POST",
                          beforeSend:function(){
                             $('.status-message').html('<img src="<?= TICKET_PLUGIN_URL;?>CI/assets/images/icon_loading.gif" />').css({"text-align":"center"});
                           },
                          success:function(data){
                             obj = $.parseJSON(data);
                             if(obj.status == "failed")
                             {
                             $('.status-message').html('<div class="isa_error" style="width: 80%;">'+obj.error_msg+'</div>').fadeIn('slow').delay(2000).fadeOut('slow',function(){
                                 $.magnificPopup.close();
                             });
                             }

                             if(obj.status == "500")
                             {
                              $('.status-message').html('<div class="isa_error" style="width: 80%;">'+obj.message+'</div>').fadeIn('slow').delay(2000).fadeOut('slow',function(){
                                 $.magnificPopup.close();
                             });
                             }

                             if(obj.status == "success")
                             {
                             $('.status-message').html("").fadeIn('slow').delay(2000).fadeOut('slow');
                                $("#formBox").show();
                                $("#mnumber").html(obj.mobile);
                                $("#otp").val(obj.otp_start);
                                $("#keymatch").val(obj.keymatch);
                                $("#mobile_number").val(obj.mobile);
                             }

                          }
                         });
                },
                close: function() {
                  $("#otp").val("");
                  $("#mnumber").html("");
                  $("#formBox").hide();
                   $('.status-message').html("").show();
                   $("#keymatch").val("");
                   $("#mobile_number").val("");
                }
                // e.t.c.
              }
     });

$("#mobileVerify_form").submit(function(e){ 
$('.status-message').html('').show(); 
       var form = $(this);
       var submitbtn = $(this).find('button[type="submit"]');
       //submitbtn.attr('disabled',true);
       var url = $(this).attr('action'),
       data = $(this).serialize(); 
       $.ajax({
        url: url,
        data:data,
        type:"POST",
        beforeSend:function(){
                             $('.status-message').html('<img src="<?= TICKET_PLUGIN_URL;?>CI/assets/images/icon_loading.gif" />').css({"text-align":"center"});
                           },
        success:function(data){
           submitbtn.attr('disabled',false);
           obj = $.parseJSON(data);
           if(obj.status == "success")
           {
           $('.status-message').html('<div class="isa_success" style="width: 80%;">'+obj.message+"</div>").fadeIn('slow').delay(2000).fadeOut('slow',function(){
                $('#user_mobile').val(obj.mobile);
                $("#register").removeClass("btn-disable").removeAttr("disabled");
                form[0].reset();
                $.magnificPopup.close();
              });
            return;
           }

           if(obj.status == "failed")
           {
             var er = obj.error_msg;

           $('.status-message').html('<div class="isa_error" style="width: 80%;">'+er+'</div>').fadeIn('slow').delay(2000).fadeOut('slow');
             return;
           }
        }
       });
      e.preventDefault();
      return false;
     });
</script>
             <style type="text/css">
              .white-popup {
                position: relative;
                background: #FFF;
                padding: 20px;
                width:auto;
                max-width: 500px;
                margin: 20px auto;
              }
             </style>
<?php
$this->load->view('common/footer');
?>