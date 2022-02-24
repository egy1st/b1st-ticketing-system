<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);
ini_set('error_reporting', E_ALL);

 session_start();

 ?>
<!DOCTYPE html>
<html>
<head>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Installation</title>
    <link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="./styles/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="./styles/bootstrap-responsive.css">
</head>
<body>
<?php


define('AUTH_KEY', "$fsgVoBpx5Zri.ri1&/|h>sbMx| ?%]$V&y4N;f}-K-mupG=/Lgxt+TU>4>C)s{?");

$url = $_SERVER['REQUEST_URI']; //returns the current URL
$parts = explode('/',$url);
$dir = $_SERVER['SERVER_NAME'];
for ($i = 0; $i < count($parts) - 2; $i++) {
      $dir .= $parts[$i] . "/";
     }
 $plugin_url = "http://". $dir;
 $admin_url = $plugin_url. "CI/";


$path =   dirname(__FILE__);
$parts2 = explode('/',$path);
for ($i = 0; $i < count($parts2) - 1; $i++) {
      $dir2 .= $parts2[$i] . "/";
     }
$plugin_path = substr_replace($dir2, "", -1);
$config_path= $plugin_path."/CI/application/config/config.php" ;


$error = 0;

if (!isset($_POST['db_username']) or (is_object($_POST['db_username']) and strlen($_POST['db_username']) == 0)) {
    $step = 0;
}
    if (isset($_GET['step']) && $_GET['step'] == 1) {
        $step = 1;
	}

        if (isset($_POST['db_username']) && isset($_POST['db_password']) && isset($_POST['db_server'])) {

            if (!empty($_POST['db_username']) && !empty($_POST['db_server']) && !empty($_POST['db_name'])) {

                $mysqlConnection = mysqli_connect($_POST['db_server'], $_POST['db_username'], $_POST['db_password']);
                $db_selected = mysqli_select_db($_POST['db_name'], $mysqlConnection);
                if (!$mysqlConnection) {
                    $error = 2;
				} elseif (!$db_selected) {
                   $error = 6;
                 } else {
                    if (isset($_POST['db_name']) and !empty($_POST['db_name'])) {
                        $dbname = mysql_real_escape_string($_POST['db_name']);
                    }

                    $sql = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$dbname'";
                    $sql_res = mysql_query($sql);
                    if (mysql_num_rows($sql_res) == 0) {
                        if (mysql_query("CREATE DATABASE $dbname", $mysqlConnection)) {
                            $db = mysql_select_db($dbname, $mysqlConnection);
                            require_once('../tableconfig.php');
							if(!empty($instab))
		                      {
                    			   foreach($instab as $sql)
	                        		{
				                      	 mysql_query ($sql) ;						 
									}
																			
		                      }
						  require_once('insert.php');
						  $res = mysql_query('SHOW TABLES');
                          while ($row = mysql_fetch_array($res, MYSQL_NUM))
                            {
                              $res2 = mysql_query("TRUNCATE TABLE `$row[0]`");
                            }
							if(!empty($ins2tab))
		                      {
                    			   foreach($ins2tab as $sql2)
	                        		{
				                      	mysql_query ($sql2) ;						 
									}
																			
		                      }	     
								
                           
                            $_SESSION['dbname'] = $dbname;
                            $step = 2;
                        } else {
                            $error = 3;
                        }
                    } else {
                        //$error = 5;
                        $db = mysql_select_db($dbname, $mysqlConnection);
                        require_once('../tableconfig.php');
						if(!empty($instab))
		                      {
                    			   foreach($instab as $sql)
	                        		{
				                      	 mysql_query ($sql) ;						 
									}
																			
		                      }
						require_once('insert.php');
						$res = mysql_query('SHOW TABLES');
                        while ($row = mysql_fetch_array($res, MYSQL_NUM))
                            {
                              $res2 = mysql_query("TRUNCATE TABLE `$row[0]`");
                            }
							if(!empty($ins2tab))
		                      {
                    			   foreach($ins2tab as $sql2)
	                        		{
				                      	 mysql_query ($sql2) ;						 
									}
																			
		                      }	     
							 
                        
                        $_SESSION['dbname'] = $dbname;
                        $step = 2;
						
					 

			  if ( file_exists( $config_path))
               {
               $config_file = file( $config_path );
              // Not a PHP5-style by-reference foreach, as this file must be parseable by PHP4.
              foreach ( $config_file as $line_num => $line ) {

                if ( ! preg_match( '/^define\(\'([A-Z_]+)\',([ ]+)/', $line, $match ) )
                  continue;

                $constant = $match[1];
                $padding  = $match[2];
				
				

                switch ( $constant ) {
                    case 'DBNAME'     :
                 
                      $config_file[ $line_num ] = "define('" . $constant . "'," . $padding . "'".$_POST['db_name']."');\r\n";
                    
                    break;
                       case 'DBUSER'     :
                 
                      $config_file[ $line_num ] = "define('" . $constant . "'," . $padding . "'".$_POST['db_username']."');\r\n";
					
                    
                    break;
                     case 'DBPASSWORD' :
					
                 
                      $config_file[ $line_num ] = "define('" . $constant . "'," . $padding . "'".$_POST['db_password']."');\r\n";
					  
                    
                    break;
                  case 'DBHOST'     :
                 
                      $config_file[ $line_num ] = "define('" . $constant . "'," . $padding . "'".$_POST['db_server']."');\r\n";
					 
                    
                    break;
                  case 'DBCHARSET'  :
                 
                      $config_file[ $line_num ] = "define('" . $constant . "'," . $padding . "'utf8');\r\n";
                    
                    break;

                   case 'TABLE_PREFIX'  :
                    
                      $config_file[ $line_num ] = "define('" . $constant . "'," . $padding . "'"."b1st_"."');\r\n";
                    
                    break;

                    case 'DBCOLLATE'  :
                    
                      $config_file[ $line_num ] = "define('" . $constant . "'," . $padding . "'utf8_general_ci');\r\n";
                    
                    break;

                    case 'WPADMINURL'  :
              
                      $config_file[ $line_num ] = "define('" . $constant . "'," . $padding . "'".addcslashes($admin_url, "\\'" )."');\r\n";
                    
                    break;

                   case 'AUTH_KEY'  :
              
                      $config_file[ $line_num ] = "define('" . $constant . "'," . $padding . "'".AUTH_KEY."');\r\n";
                    
                    break;

                   case 'TICKET_PLUGIN_PATH'  :
              
                      $config_file[ $line_num ] = "define('" . $constant . "'," . $padding . "'".$plugin_path."');\r\n";
                    
                    break;

                  case 'TICKET_PLUGIN_URL'  :
              
                      $config_file[ $line_num ] = "define('" . $constant . "'," . $padding . "'".$plugin_url."');\r\n";
                    
                    break;

                }
              }


                                
                  $handle = fopen( $config_path, 'w' );
                  foreach( $config_file as $line ) {
                    fwrite( $handle, $line );
                   }
                  fclose( $handle );
		}
					

                    }
                }
            } else {
                $error = 1;
            }
        } 
    
/*	
	 else {
    $step = 2;
	
      if (!isset($_POST['db_username']) or (is_object($_POST['db_username']) and strlen($_POST['db_username']) == 0)) {
        header("Location: index.php");
        exit;
	  } 
}

*/


if (isset($_GET['step']) && $_GET['step'] == 4) {
    $step = 4;

}


?>

<div class="container">
    <div class="row">
        <div class="span12">


            <h3>Installation</h3>
            <?php
            if ($step == 0) {
                ?>
                <h4>Introduction</h4>
				<p>First, thank you for choosing this product. You won't regret it.<br>Installation just requires one simple step.</p>
                <div class="alert alert-error"><p>If you allready installed it but come to this page again, remember that you should delete or at least rename "install" folder; thus the script works corectly.</p></div>
                <a href="index.php?step=1">
                    <btn class="btn btn-success">Let's go</btn>
                </a>

                
                
            <?php
            }
            ?>

            <?php
            if ($step == 1) {
                ?>
                
				<h4 style="color:grey;">Introduction</h4>
                <p style="color:grey;">First, thank you for choosing this product. You won't regret it.<br>Installation
                    just requires one simple step.</p>

                <p><b>Make sure that these files have permission of 777</b></p>
                <ul>
                    <li>CI/application/config/config.php</li>
					<li>CI/assets/css/*.css</li> <span> <p>All css files under "CI/assets/css" should be set to 777 ONLY in case you need to change themes default colours </p> </span>
                   
                </ul>

                <p><b>Make sure that these folders have permission of 777</b></p>
                <ul>
                    <li>backup</li>
                    <li>tmp</li>
					<li>CI/assets/attachment</li>
					<li>CI/assets/css</li>

                </ul>
                <h4 style="margin-top: 20px;">MYSQL configuration</h4>
                <p>This contact form needs a database to be 100% efficient. Please enter your username/password/server
                    to install our tables :</p>
                <form class="form-inline" action="index.php?step=1" method="post">
                    <input type="text" placeholder="Database server" name="db_server">
                    <br>
                    <br>
                    <input type="text" placeholder="Database username" name="db_username">
                    <br>
                    <br>
                    <input type="password" placeholder="Database password" name="db_password">
                    <br>
                    <br>
                    <input type="text" placeholder="Database name" name="db_name">
                    <br>
                    <br>

                    <input type="submit" class="btn btn-success" style="height:30px;">
                </form>

                <?php if ($error == 1) { ?>
                    <div class="alert alert-error" style="position:absolute; top: 10px;">Please enter all required informations.</div>
                <?php } ?>

                <?php if ($error == 2) { ?>
                    <div class="alert alert-error"  style="position:absolute; top: 10px;">Invalid informations : please try again or contact a technician.
                    </div>
                <?php } ?>

                <?php if ($error == 3) { ?>
                    <div class="alert alert-error" style="position:absolute; top: 10px;">Database not created : technical error. You do not have enough
                        privilege to create new database. It is advised to create new database using your web hosting
                        control panel first. For more information contact your web hosting provider on how to use your
                        control panel e.g. cpanel and plesk to create new database.
                    </div>
                <?php } ?>

                <?php if ($error == 5) { ?>
                    <div
                        class="alert alert-error style="position:absolute; top: 10px;"" style="position:absolute; top: 10px;"><?php echo 'Database "' . $_POST['db_name']. '" already exists. Please try with new one.'; ?></div>
                <?php } ?>

              <?php if ($error == 6) { ?>
                    <div
                        class="alert alert-error style="position:absolute; top: 10px;""><?php echo 'Database "' . $_POST['db_name'] . '" not exist. Please create it first or make sure or use the correct database name'; ?></div>
                <?php } ?>

                
            <?php
            }
            ?>

            <?php
            if ($step == 2) {
                ?>
                <h4 style="color:grey;">Congratulations</h4>
                <p>Now everything is done: you just have to login as admin.<br> <b>username</b> : admin  <br>  <b>password</b> : admin <br> <br> Do not forget to <b>change</b> the default password once you login. as follows</p>
				<li> Select "users" Menu </li>
				<li> select "Admins/Clients" sub-menu" </li>
				<li> Edit your account, then save </li>
				<br>
				Finally, Do no forget to <b>remove</b> "install" folder
				<br><br>
				
              
				<form action="<?php echo $admin_url."index.php/ticket" ; ?>">
                      <input type="submit" class="btn btn-success" value="Login as Admin"/>
                </form>
                
                <?php if ($error == 4) { ?>
                    <div class="alert alert-error">Please give all required informations.</div>
                <?php } ?>

         
            <?php
            }
            ?>

            <?php
            
            ?>

            <?php
            
            ?>

        </div>
    </div>
</div>


</body>
</html>
