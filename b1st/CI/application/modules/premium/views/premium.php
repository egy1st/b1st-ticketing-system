<?php $this->load->view('common/header'); ?>
<style type="text/css">
.mt-table {
    background: none repeat scroll 0 0 #fff;
    border: 1px solid #e5e5e5;
    /*margin-top: 52px;*/
    width: 100%;
}
.mt-table tr th {
    color: #333;
    font-size: 15px;
    font-weight: normal;
    line-height: 22px;
    padding: 5px 20px;
    text-align: left;  
    border-bottom: 1px solid #e5e5e5;
}

.mt-table tr th:first-child
{
	width:25%;
}

.mt-table tr th:last-child
{
	width:75%;
}

.mt-table tr td:first-child
{
	width:25%;
}

.mt-table tr td:last-child
{
	width:75%;
}

.mt-table tr td {
    color: #333;
    font-size: 13px;
    font-weight: normal;
    line-height: 19px;
    padding: 10px 20px;
    text-align: left;
    border-bottom: 1px solid #e5e5e5;
    position: relative;
}
.mt-table tr td p{
    margin-bottom: 10px;
    font-size: 15px;
}
.onoffswitch {
    position: relative; width: 90px;
    -webkit-user-select:none; -moz-user-select:none; -ms-user-select: none;
}
.onoffswitch-checkbox {
    display: none;
}
.onoffswitch-label {
    display: block; overflow: hidden; cursor: pointer;
    border: 3px solid #ccc; border-radius: 12px;
}
.onoffswitch-inner {
    display: block; width: 200%; margin-left: -100%;
    -moz-transition: margin 0.3s ease-in 0s; -webkit-transition: margin 0.3s ease-in 0s;
    -o-transition: margin 0.3s ease-in 0s; transition: margin 0.3s ease-in 0s;
}
.onoffswitch-inner:before, .onoffswitch-inner:after {
    display: block; float: left; width: 50%; height: 20px; padding: 0; line-height: 20px;
    font-size: 14px; color: white; font-family: Trebuchet, Arial, sans-serif; font-weight: bold;
    -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box;
}
.onoffswitch-inner:before {
    content: "ON";
    padding-left: 10px;
    background-color: #0b9904; color: #FFFFFF;
}
.onoffswitch-inner:after {
    content: "OFF";
    padding-right: 10px;
    background-color: #d40505; color: #999999;
    text-align: right;
}
.onoffswitch-switch {
    display: block; width: 25px; margin: 6px;
    border-radius:8px;
    -moz-box-shadow: 1px 1px 4px #000;
    -o-box-shadow: 1px 1px 4px #000;
    -webkit-box-shadow: 1px 1px 4px #000;
    box-shadow: 1px 1px 4px #000;
    background: rgb(255,255,255); /* Old browsers */
background: -moz-linear-gradient(top, rgba(255,255,255,1) 0%, rgba(241,241,241,1) 33%, rgba(225,225,225,1) 66%, rgba(246,246,246,1) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(255,255,255,1)), color-stop(33%,rgba(241,241,241,1)), color-stop(66%,rgba(225,225,225,1)), color-stop(100%,rgba(246,246,246,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, rgba(255,255,255,1) 0%,rgba(241,241,241,1) 33%,rgba(225,225,225,1) 66%,rgba(246,246,246,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, rgba(255,255,255,1) 0%,rgba(241,241,241,1) 33%,rgba(225,225,225,1) 66%,rgba(246,246,246,1) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, rgba(255,255,255,1) 0%,rgba(241,241,241,1) 33%,rgba(225,225,225,1) 66%,rgba(246,246,246,1) 100%); /* IE10+ */
background: linear-gradient(to bottom, rgba(255,255,255,1) 0%,rgba(241,241,241,1) 33%,rgba(225,225,225,1) 66%,rgba(246,246,246,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#f6f6f6',GradientType=0 ); /* IE6-9 */
    position: absolute; top: 0; bottom: 0; right: 53px;
    -moz-transition: all 0.3s ease-in 0s; -webkit-transition: all 0.3s ease-in 0s;
    -o-transition: all 0.3s ease-in 0s; transition: all 0.3s ease-in 0s;
    
}
.onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-inner {
    margin-left: 0;
}
.onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-switch {
    right: 0px; 
}
.mask_div{opacity: .5;
         position: absolute;
	 top: 0;
	 bottom: 0;
	 left: 0;
	 right: 0;
	 margin: auto;
	 width: 100%;
	 height:100%;
	 background: rgba(0,0,0,1);
	 display: none;
	 }
.table_holder{position: relative;
               float:left;
	       width:100%;
	       }	 
</style>


<div class="main_section">
    <div class="headline">
        <h1><span><i class="fa fa-money"></i></span>Premium Modules</h1><br>
    </div>
    <div class="headding_bl">
        <p><span><i class="fa fa-th-list"></i></span> Manage Premium Modules</p>
    </div>
    <div class="table_holder">
    <table cellspacing="0" cellpadding="0" class="mt-table">
        <tr>
            <th>Name</th>
            <th>Description</th>
        </tr>
	<tr>
	    <td>
		<?php
		$companychk=B1st_fetchmod('company');
		$companyins=B1st_fetchIns('company');
		?>
                <p>Company Module</p>
		<?php
		if($companyins==0)
		{
		?>
		<p><span class="gt-it-btn"><a style="color: #0074A2;" href="javascript:void(0);" onclick="return moduleinstall('company','install')">Install</a></span></p>
		<?php
		}
		?>
		<?php
		if($companyins==1)
		{
		?>
		<p class="inst-btn"><span style="color: #0B9904;">Installed</span> | <a style="color: #0074A2;" href="javascript:void(0);" onclick="return moduleinstall('company','uninstall')">Uninstall</a></p>
		<?php
		}
		?>
		<?php
		if($companyins==1)
		{
		?>
                <div class="onoffswitch">
                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch13" <?php if($companychk==1) { ?> checked <?php } ?> onclick="togglemod('<?php echo $companychk;?>','company')">
                    <label class="onoffswitch-label" for="myonoffswitch13">
                        <span class="onoffswitch-inner"></span>
                        <span class="onoffswitch-switch"></span>
                    </label>
                </div>
		<?php
		}
		?>
            </td>
	    <td>
                <b><u>Company</u></b> is used to list companies that can be selected while posting Ticket. These companies are editable from the admin section, if enabled.
            </td>
	</tr>
        <tr>
	    <td>
		<?php
		$prodchk=B1st_fetchmod('product');
		$prodins=B1st_fetchIns('product');
		?>
                <p>Product Module</p>
		<?php
		if($prodins==0)
		{
		?>
		<p><span class="gt-it-btn"><a style="color: #0074A2;" href="javascript:void(0);" onclick="return moduleinstall('product','install')">Install</a></span></p>
		<?php
		}
		?>
		<?php
		if($prodins==1)
		{
		?>
		<p class="inst-btn"><span style="color: #0B9904;">Installed</span> | <a style="color: #0074A2;" href="javascript:void(0);" onclick="return moduleinstall('product','uninstall')">Uninstall</a></p>
		<?php
		}
		?>
		<?php
		if($prodins==1)
		{
		?>
                <div class="onoffswitch">
                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch12" <?php if($prodchk==1) { ?> checked <?php } ?> onclick="togglemod('<?php echo $prodchk;?>','product')">
                    <label class="onoffswitch-label" for="myonoffswitch12">
                        <span class="onoffswitch-inner"></span>
                        <span class="onoffswitch-switch"></span>
                    </label>
                </div>

		<?php
		}
		?>
            </td>
	    <td>
                <b><u>Product</u></b> is used to list products that can be selected while posting Ticket. These products are editable from the admin section, if enabled.
            </td>
	</tr>
	<?php if($prodchk==1) { ?>
	<tr>
            <td>
		<?php
		$faqchk=B1st_fetchmod('faq');
		$faqins=B1st_fetchIns('faq');
		?>
                <p>FAQ Module</p>
		<?php
		if($faqins==0)
		{
		?>
		<p><span class="gt-it-btn"><a style="color: #0074A2;" href="javascript:void(0);" onclick="return moduleinstall('faq','install')">Install</a></span></p>
		<?php
		}
		?>
		<?php
		if($faqins==1)
		{
		?>
		<p class="inst-btn"><span style="color: #0B9904;">Installed</span> | <a style="color: #0074A2;" href="javascript:void(0);" onclick="return moduleinstall('faq','uninstall')">Uninstall</a></p>
		<?php
		}
		?>
		<?php
		if($faqins==1)
		{
		?>
                <div class="onoffswitch">
                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch1" <?php if($faqchk==1) { ?> checked <?php } ?> onclick="togglemod('<?php echo $faqchk;?>','faq')">
                    <label class="onoffswitch-label" for="myonoffswitch1">
                        <span class="onoffswitch-inner"></span>
                        <span class="onoffswitch-switch"></span>
                    </label>
                </div>
		<?php
		}
		?>
            </td>
            <td>
                <b><u>FAQ</u></b> are listed questions and answers, all supposed to be commonly asked in some context, and pertaining to a particular topic. The format is commonly used on email mailing lists and other online forums, where certain common questions tend to recur, if enabled.
            </td>
        </tr>

        <tr>
            <td>
		<?php
		$kbcatchk=B1st_fetchmod('knowledge_base_cat');
		$kbcatins=B1st_fetchIns('knowledge_base_cat');
		?>
                <p>Knowledge Base Module</p>
		<?php
		if($kbcatins==0)
		{
		?>
		<p><span class="gt-it-btn"><a style="color: #0074A2;" href="javascript:void(0);" onclick="return moduleinstall('knowledge_base_cat','install')">Install</a></span></p>
		<?php
		}
		?>
		<?php
		if($kbcatins==1)
		{
		?>
		<p class="inst-btn"><span style="color: #0B9904;">Installed</span> | <a style="color: #0074A2;" href="javascript:void(0);" onclick="return moduleinstall('knowledge_base_cat','uninstall')">Uninstall</a></p>
		<?php
		}
		?>
		<?php
		if($kbcatins==1)
		{
		?>
                <div class="onoffswitch">
                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch2" <?php if($kbcatchk==1) { ?> checked <?php } ?> onclick="togglemod('<?php echo $kbcatchk;?>','knowledge_base_cat')">
                    <label class="onoffswitch-label" for="myonoffswitch2">
                        <span class="onoffswitch-inner"></span>
                        <span class="onoffswitch-switch"></span>
                    </label>
                </div>
		<?php
		}
		?>
            </td>
            <td>
		<b><u>Knowledge Base</u></b> is a detailed version of FAQ where topics and discussions based on products and knowledge base categories are listed. It will enable to add numerous topics and discussions based on categories and products, if enabled.
            </td>
        </tr>
        <?php } ?>
	<tr>
            <td>
		<?php
		$backupchk=B1st_fetchmod('backup');
		$backupins=B1st_fetchIns('backup');
		?>
                <p>Backup Module</p>
		<?php
		if($backupins==0)
		{
		?>
		<p><span class="gt-it-btn"><a style="color: #0074A2;" href="javascript:void(0);" onclick="return moduleinstall('backup','install')">Install</a></span></p>
		<?php
		}
		?>
		<?php
		if($backupins==1)
		{
		?>
		<p class="inst-btn"><span style="color: #0B9904;">Installed</span> | <a style="color: #0074A2;" href="javascript:void(0);" onclick="return moduleinstall('backup','uninstall')">Uninstall</a></p>
		<?php
		}
		?>
		<?php
		if($backupins==1)
		{
		?>
                <div class="onoffswitch">
                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch3" <?php if($backupchk==1) { ?> checked <?php } ?> onclick="togglemod('<?php echo $backupchk;?>','backup')">
                    <label class="onoffswitch-label" for="myonoffswitch3">
                        <span class="onoffswitch-inner"></span>
                        <span class="onoffswitch-switch"></span>
                    </label>
                </div>
		<?php
		}
		?>
            </td>
            <td>
		<b><u>Backup</u></b> is the module which is used for taking backups for the whole plugin. It is an extension of the plugin where admin can take backups from the plugin so that previous data cannot get lost, if enabled.
            </td>
        </tr>
	<tr>
            <td>
		<?php
		$chatchk=B1st_fetchmod('chat');
		$chatins=B1st_fetchIns('chat');
		?>
                <p>Chat Module</p>
		<?php
		if($chatins==0)
		{
		?>
		<p><span class="gt-it-btn"><a style="color: #0074A2;" href="javascript:void(0);" onclick="return moduleinstall('chat','install')">Install</a></span></p>
		<?php
		}
		?>
		<?php
		if($chatins==1)
		{
		?>
		<p class="inst-btn"><span style="color: #0B9904;">Installed</span> | <a style="color: #0074A2;" href="javascript:void(0);" onclick="return moduleinstall('chat','uninstall')">Uninstall</a></p>
		<?php
		}
		?>
		<?php
		if($chatins==1)
		{
		?>
                <div class="onoffswitch">
                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch4" <?php if($chatchk==1) { ?> checked <?php } ?> onclick="togglemod('<?php echo $chatchk;?>','chat')">
                    <label class="onoffswitch-label" for="myonoffswitch4">
                        <span class="onoffswitch-inner"></span>
                        <span class="onoffswitch-switch"></span>
                    </label>
                </div>
		<?php
		}
		?>
            </td>
            <td>
                <b><u>Chat</u></b> as the name indicates is a admin to user chat system where user can chat with admin and super admin can chat with users as well as subadmins. It is a two way chat system and admin can set ticket from the current chat session. Admin can check the number of currently online users where user can check number of currently online admins and can chat with, if enabled.
            </td>
        </tr>
	<tr>
            <td>
		<?php
		$reponsetimechk=B1st_fetchmod('response_time');
		$reponsetimeins=B1st_fetchIns('response_time');
		?>
                <p>Response Time Module</p>
		<?php
		if($reponsetimeins==0)
		{
		?>
		<p><span class="gt-it-btn"><a style="color: #0074A2;" href="javascript:void(0);" onclick="return moduleinstall('response_time','install')">Install</a></span></p>
		<?php
		}
		?>
		<?php
		if($reponsetimeins==1)
		{
		?>
		<p class="inst-btn"><span style="color: #0B9904;">Installed</span> | <a style="color: #0074A2;" href="javascript:void(0);" onclick="return moduleinstall('response_time','uninstall')">Uninstall</a></p>
		<?php
		}
		?>
		<?php
		if($reponsetimeins==1)
		{
		?>
                <div class="onoffswitch">
                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch5" <?php if($reponsetimechk==1) { ?> checked <?php } ?> onclick="togglemod('<?php echo $reponsetimechk;?>','response_time')">
                    <label class="onoffswitch-label" for="myonoffswitch5">
                        <span class="onoffswitch-inner"></span>
                        <span class="onoffswitch-switch"></span>
                    </label>
                </div>
		<?php
		}
		?>
            </td>
            <td>
		<b><u>Response Time</u></b> is an automated calculation of the response of the admin to a particular user. Based on the response time to user this module automatically calculates the average response time for each admin. This is used to check how efficient and how much fast an admin is, if enabled.
            </td>
        </tr>
	<tr>
            <td>
		<?php
		$opswatchk=B1st_fetchmod('opswat');
		$opswatins=B1st_fetchIns('opswat');
		?>
                <p>OPSWAT Module</p>
		<?php
		if($opswatins==0)
		{
		?>
		<p><span class="gt-it-btn"><a style="color: #0074A2;" href="javascript:void(0);" onclick="return moduleinstall('opswat','install')">Install</a></span></p>
		<?php
		}
		?>
		<?php
		if($opswatins==1)
		{
		?>
		<p class="inst-btn"><span style="color: #0B9904;">Installed</span> | <a style="color: #0074A2;" href="javascript:void(0);" onclick="return moduleinstall('opswat','uninstall')">Uninstall</a></p>
		<?php
		}
		?>
		<?php
		if($opswatins==1)
		{
		?>
                <div class="onoffswitch">
                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch6" <?php if($opswatchk==1) { ?> checked <?php } ?> onclick="togglemod('<?php echo $opswatchk;?>','opswat')">
                    <label class="onoffswitch-label" for="myonoffswitch6">
                        <span class="onoffswitch-inner"></span>
                        <span class="onoffswitch-switch"></span>
                    </label>
                </div>
		<?php
		}
		?>
            </td>
            <td>
                <b><u>OPSWAT</u></b> is used to check the mail attachments and file uploaded. It checks whether the file uploaded or attached is virus affected or not. Whether there is a threat on that file or not, if enabled.
            </td>
        </tr>
	<tr>
            <td>
		<?php
		$akismetchk=B1st_fetchmod('akismet');
		$akismetins=B1st_fetchIns('akismet');
		?>
                <p>AKISMET Module</p>
		<?php
		if($akismetins==0)
		{
		?>
		<p><span class="gt-it-btn"><a style="color: #0074A2;" href="javascript:void(0);" onclick="return moduleinstall('akismet','install')">Install</a></span></p>
		<?php
		}
		?>
		<?php
		if($akismetins==1)
		{
		?>
		<p class="inst-btn"><span style="color: #0B9904;">Installed</span> | <a style="color: #0074A2;" href="javascript:void(0);" onclick="return moduleinstall('akismet','uninstall')">Uninstall</a></p>
		<?php
		}
		?>
		<?php
		if($akismetins==1)
		{
		?>
                <div class="onoffswitch">
                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch7" <?php if($akismetchk==1) { ?> checked <?php } ?> onclick="togglemod('<?php echo $akismetchk;?>','akismet')">
                    <label class="onoffswitch-label" for="myonoffswitch7">
                        <span class="onoffswitch-inner"></span>
                        <span class="onoffswitch-switch"></span>
                    </label>
                </div>
		<?php
		}
		?>
            </td>
            <td>
                <b><u>AKISMET</u></b> is used to check the mail and ticket content. It checks whether the content is spam or not, if enabled.
            </td>
        </tr>
	<tr>
            <td>
		<?php
		$emailmodchk=B1st_fetchmod('email_mod');
		$emailmodins=B1st_fetchIns('email_mod');
		?>
                <p>Email Ticket Module</p>
		<?php
		if($emailmodins==0)
		{
		?>
		<p><span class="gt-it-btn"><a style="color: #0074A2;" href="javascript:void(0);" onclick="return moduleinstall('email_mod','install')">Install</a></span></p>
		<?php
		}
		?>
		<?php
		if($emailmodins==1)
		{
		?>
		<p class="inst-btn"><span style="color: #0B9904;">Installed</span> | <a style="color: #0074A2;" href="javascript:void(0);" onclick="return moduleinstall('email_mod','uninstall')">Uninstall</a></p>
		<?php
		}
		?>
		<?php
		if($emailmodins==1)
		{
		?>
                <div class="onoffswitch">
                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch8" <?php if($emailmodchk==1) { ?> checked <?php } ?> onclick="togglemod('<?php echo $emailmodchk;?>','email_mod')">
                    <label class="onoffswitch-label" for="myonoffswitch8">
                        <span class="onoffswitch-inner"></span>
                        <span class="onoffswitch-switch"></span>
                    </label>
                </div>
		<?php
		}
		?>
            </td>
            <td>
                <b><u>Email Ticket</u></b> is used to fetch emails from a particular email address based on a particular subject which can be set at the settings section. Here admin can set a particular email address and subject so that emails from that email address on that subject will be fetched and admin can set any email as ticket, if enabled
            </td>
        </tr>
	<tr>
            <td>
		<?php
		$twittermodchk=B1st_fetchmod('twitter');
		$twittermodins=B1st_fetchIns('twitter');
		?>
                <p>Twitter Module</p>
		<?php
		if($twittermodins==0)
		{
		?>
		<p><span class="gt-it-btn"><a style="color: #0074A2;" href="javascript:void(0);" onclick="return moduleinstall('twitter','install')">Install</a></span></p>
		<?php
		}
		?>
		<?php
		if($twittermodins==1)
		{
		?>
		<p class="inst-btn"><span style="color: #0B9904;">Installed</span> | <a style="color: #0074A2;" href="javascript:void(0);" onclick="return moduleinstall('twitter','uninstall')">Uninstall</a></p>
		<?php
		}
		?>
		<?php
		if($twittermodins==1)
		{
		?>
                <div class="onoffswitch">
                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch9" <?php if($twittermodchk==1) { ?> checked <?php } ?> onclick="togglemod('<?php echo $twittermodchk;?>','twitter')">
                    <label class="onoffswitch-label" for="myonoffswitch9">
                        <span class="onoffswitch-inner"></span>
                        <span class="onoffswitch-switch"></span>
                    </label>
                </div>
		<?php
		}
		?>
            </td>
            <td>
                <b><u>Twitter</u></b> is used to fetch tweets from a particular email address. Here admin can set a particular email address so that tweets from that email address will be fetched and admin can set any tweet as ticket, if enabled
            </td>
        </tr>
	<tr>
            <td>
		<?php
		$mobverchk=B1st_fetchmod('mob_ver');
		$mobverins=B1st_fetchIns('mob_ver');
		?>
                <p>Mobile Verification Module</p>
		<?php
		if($mobverins==0)
		{
		?>
		<p><span class="gt-it-btn"><a style="color: #0074A2;" href="javascript:void(0);" onclick="return moduleinstall('mob_ver','install')">Install</a></span></p>
		<?php
		}
		?>
		<?php
		if($mobverins==1)
		{
		?>
		<p class="inst-btn"><span style="color: #0B9904;">Installed</span> | <a style="color: #0074A2;" href="javascript:void(0);" onclick="return moduleinstall('mob_ver','uninstall')">Uninstall</a></p>
		<?php
		}
		?>
		<?php
		if($mobverins==1)
		{
		?>
                <div class="onoffswitch">
                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch200" <?php if($mobverchk==1) { ?> checked <?php } ?> onclick="togglemod('<?php echo $mobverchk;?>','mob_ver')">
                    <label class="onoffswitch-label" for="myonoffswitch200">
                        <span class="onoffswitch-inner"></span>
                        <span class="onoffswitch-switch"></span>
                    </label>
                </div>
		<?php
		}
		?>
            </td>
            <td>
		<span><b><u>Mobile Verification</u></b> is used to verify mobile number during front end registration by the front end users. This can be used to prevent junk registration by preventing user to register by providing mobile number of other users, if enabled.
            </td>
        </tr>
	<tr>
            <td>
		<?php
		$statisticschk=B1st_fetchmod('statistics');
		$statisticsins=B1st_fetchIns('statistics');
		?>
                <p>Statistics Module</p>
		<?php
		if($statisticsins==0)
		{
		?>
		<p><span class="gt-it-btn"><a style="color: #0074A2;" href="javascript:void(0);" onclick="return moduleinstall('statistics','install')">Install</a></span></p>
		<?php
		}
		?>
		<?php
		if($statisticsins==1)
		{
		?>
		<p class="inst-btn"><span style="color: #0B9904;">Installed</span> | <a style="color: #0074A2;" href="javascript:void(0);" onclick="return moduleinstall('statistics','uninstall')">Uninstall</a></p>
		<?php
		}
		?>
		<?php
		if($statisticsins==1)
		{
		?>
                <div class="onoffswitch">
                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch10" <?php if($statisticschk==1) { ?> checked <?php } ?> onclick="togglemod('<?php echo $statisticschk;?>','statistics')">
                    <label class="onoffswitch-label" for="myonoffswitch10">
                        <span class="onoffswitch-inner"></span>
                        <span class="onoffswitch-switch"></span>
                    </label>
                </div>
		<?php
		}
		?>
            </td>
            <td>
                <b><u>Statistics</u></b> is a graphical representation of the tickets posted. There are two types of grpahs: 1) Bar Graph for ticket and product. 2) Pie chart for: a) ticket and state, b) ticket and department, c) ticket and priority, if enabled.
            </td>
        </tr>
	<tr>
            <td>
                <p>Rating</p>
		<?php
		$ratingchk=B1st_fetchmod('rating');
		$ratingins=B1st_fetchIns('rating');
		?>
		<?php
		if($ratingins==0)
		{
		?>
		<p><span class="gt-it-btn"><a style="color: #0074A2;" href="javascript:void(0);" onclick="return moduleinstall('rating','install')">Install</a></span></p>
		<?php
		}
		?>
		<?php
		if($ratingins==1)
		{
		?>
		<p class="inst-btn"><span style="color: #0B9904;">Installed</span> | <a style="color: #0074A2;" href="javascript:void(0);" onclick="return moduleinstall('rating','uninstall')">Uninstall</a></p>
		<?php
		}
		?>
		<?php
		if($ratingins==1)
		{
		?>
                <div class="onoffswitch">
                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch11" <?php if($ratingchk==1) { ?> checked <?php } ?> onclick="togglemod('<?php echo $ratingchk;?>','rating')">
                    <label class="onoffswitch-label" for="myonoffswitch11">
                        <span class="onoffswitch-inner"></span>
                        <span class="onoffswitch-switch"></span>
                    </label>
                </div>
		<?php
		}
		?>
            </td>
            <td>
                <b><u>Rating</u></b> as the name indicates is a module which will be used to add rating to the tickets both from front end users and from back end admins, if enabled.
            </td>
        </tr>
        <tr>
            <th>Name</th>
            <th>Description</th>
        </tr>
    </table>

    <div class="mask_div"></div>
    </div>
</div>
<script>
function togglemod(faqchk,modname)
{
	$('.mask_div').fadeIn();
	$.post('<?= TICKET_PLUGIN_URL;?>CI/index.php/premium/mod',{'modchk':faqchk,'modname':modname},function(data){
		if (data)
		{
			$('.mask_div').fadeOut();
			window.parent.location.href='<?= WPADMINURL;?>index.php/premium';
		}
	});
}

function moduleinstall(modname,functype)
{
	if (functype=="uninstall")
	{
		var conf=confirm("Are you sure to uninstall this plugin? ");
		if (conf===true)
		{
			$('.mask_div').fadeIn();
			$.post('<?= TICKET_PLUGIN_URL;?>CI/index.php/premium/modinstall',{'modname':modname,'functype':functype},function(data){
				if (data)
				{
					$('.mask_div').fadeOut();
					window.parent.location.href='<?= WPADMINURL;?>index.php/premium';
				}
			})
		}
		else
		{
			return false;
		}
	}
	$('.mask_div').fadeIn();
	$.post('<?= TICKET_PLUGIN_URL;?>CI/index.php/premium/modinstall',{'modname':modname,'functype':functype},function(data){
		if (data)
		{
			$('.mask_div').fadeOut();
			window.parent.location.href='<?= WPADMINURL;?>index.php/premium';
		}
	})
}
</script>

<?php
$this->load->view('common/footer');
?>
