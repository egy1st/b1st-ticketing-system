<?php
class BaseModel extends CI_Model {

    var $module;
    var $table_name;
    var $order_by;
    var $order;
    var $start;
    var $limit;
    var $search;
    var $dataId;
    var $selected_dataId;
    var $from_module;

    var $sql_text;
    var $current_user_id;
	var $current_tenant_id;
	var $current_user_acl;
    var $current_user_team;
    var $current_user_preference;
    var $current_is_admin;
    var $searchalphabet;
    var $advSearch;
    var $searchtag;
	var $xtrawhere;

    var $db_export_fields = array();
    var $db_massupdate_fields = array();
    var $db_advance_search_fields = array();
    var $db_fields = array();

    var $bookmark;
	var $follow;
	var $comment;
    var $copy;
	var $password_expire;

    public function __construct() {
        parent::__construct();
	$this->load->database();	
	}


	
}
