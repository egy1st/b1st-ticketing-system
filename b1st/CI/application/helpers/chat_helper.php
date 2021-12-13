<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function B1st_getAdminlistChat()
{
    $CI =& get_instance();
    $CI->load->model('users/users_model');
    return $CI->users_model->getAllAdmin();
}


function B1st_getUserlistChat()
{
    $CI =& get_instance();
    $CI->load->model('users/users_model');
    return $CI->users_model->getAllUser();
}

function B1st_getChatsbtwnAdminUsers($toid,$fromid)
{
    $CI =& get_instance();
    $CI->load->model('chat/chat_model');
    return $CI->chat_model->getchatall($toid,$fromid);
}
?>
