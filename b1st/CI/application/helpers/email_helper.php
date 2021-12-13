<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php
function B1st_sendmail($to,$firstname='',$lastname='',$subject,$message,$from)
{
    $CI =& get_instance();
    
    $CI->load->library('parser');
    
    if(!empty($firstname) and !empty($lastname))
    {
        $tdata['firstname'] = $firstname;
        $tdata['lastname'] = $lastname;
    }
    else
    {
        $tdata['firstname']="Admin";
        $tdata['lastname']="";
    }
    $msg = $message.".<br>";
    $tdata['email_body'] = $msg;
    
    $mail = $CI->parser->parse('mail_templet/register.php', $tdata,TRUE);
    
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    // More headers
    $headers .= 'From: <'.$from.'>' . "\r\n";

    $zz=mail($to,$subject,$mail,$headers);
    
    if(!empty($zz))
    {
        return 1;
    }
    else
    {
        return "";
    }
}

?>
