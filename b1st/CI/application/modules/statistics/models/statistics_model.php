<?php
class statistics_model extends CI_Model
{
	public function __construct()
	{
		
        	parent::__construct();
		//$this->load->helper('form');
          	$this->load->database();
                 
                
          	//$this->load->library('session');
	}
    
	public function getSettings($name)
	{
		$where['name'] = $name;
		$q =  $this->db->where($where)->get($this->db->dbprefix.'settings')->row();
		return $q;
	}

	public function update($data,$where)
	{
		$q = $this->db->where($where)->update($this->db->dbprefix.'settings',$data);
		if(!empty($q))
		{
			return 1;
		}
		else
		{
			return "";
		}
	}
	
	public function getPriorityChart($timeperiod,$customdatefrom,$customdateto)
	{
		if($timeperiod=="customdate")
		{
			$sql="select prior.priority_name,prior.priority_color,count(*) as countnum from ".$this->db->dbprefix."ticket_priority prior join ".$this->db->dbprefix."ticket tick on tick.priorty=prior.id where tick.status='1' and date(tick.create_date) between '".date('Y-m-d',strtotime($customdatefrom))."' and '".date('Y-m-d',strtotime($customdateto))."' and prior.status='1' group by tick.priorty";
		}
		if($timeperiod=="today" or $timeperiod=="")
		{
			$sql="select prior.priority_name,prior.priority_color,count(*) as countnum from ".$this->db->dbprefix."ticket_priority prior join ".$this->db->dbprefix."ticket tick on tick.priorty=prior.id where tick.status='1' and date(tick.create_date)='".date('Y-m-d')."' and prior.status='1' group by tick.priorty";
		}
		if($timeperiod=="yesterday")
		{
			$sql="select prior.priority_name,prior.priority_color,count(*) as countnum from ".$this->db->dbprefix."ticket_priority prior join ".$this->db->dbprefix."ticket tick on tick.priorty=prior.id where tick.status='1' and date(tick.create_date)='".date('Y-m-d',strtotime("-1 day"))."' and prior.status='1' group by tick.priorty";
		}
		if($timeperiod=="lastweek")
		{
			$sql="select prior.priority_name,prior.priority_color,count(*) as countnum from ".$this->db->dbprefix."ticket_priority prior join ".$this->db->dbprefix."ticket tick on tick.priorty=prior.id where tick.status='1' and date(tick.create_date)>='".date('Y-m-d',strtotime("-1 week"))."' and date(tick.create_date)<='".date('Y-m-d')."' and prior.status='1' group by tick.priorty";
		}
		if($timeperiod=="currentmonth")
		{
			$sql="select prior.priority_name,prior.priority_color,count(*) as countnum from ".$this->db->dbprefix."ticket_priority prior join ".$this->db->dbprefix."ticket tick on tick.priorty=prior.id where tick.status='1' and MONTH(tick.create_date)='".date('m')."' and prior.status='1' group by tick.priorty";
		}
		if($timeperiod=="lastmonth")
		{
			$sql="select prior.priority_name,prior.priority_color,count(*) as countnum from ".$this->db->dbprefix."ticket_priority prior join ".$this->db->dbprefix."ticket tick on tick.priorty=prior.id where tick.status='1' and MONTH(tick.create_date)='".date('m',strtotime("-1 month"))."' and prior.status='1' group by tick.priorty";
		}
		if($timeperiod=="currentyear")
		{
			$sql="select prior.priority_name,prior.priority_color,count(*) as countnum from ".$this->db->dbprefix."ticket_priority prior join ".$this->db->dbprefix."ticket tick on tick.priorty=prior.id where tick.status='1' and YEAR(tick.create_date)='".date('Y')."' and prior.status='1' group by tick.priorty";
		}
		if($timeperiod=="lastyear")
		{
			$sql="select prior.priority_name,prior.priority_color,count(*) as countnum from ".$this->db->dbprefix."ticket_priority prior join ".$this->db->dbprefix."ticket tick on tick.priorty=prior.id where tick.status='1' and YEAR(tick.create_date)='".date('Y',strtotime("-1 year"))."' and prior.status='1' group by tick.priorty";
		}

		$query=$this->db->query($sql);
		if(!empty($query))
		{
			return $query->result();
		}
		else
		{
			return "";
		}
	}
	
	public function getDepartmentChart($timeperiod,$customdatefrom,$customdateto)
	{
		if($timeperiod=="customdate")
		{
			$sql="select dep.department_name,count(*) as countnum from ".$this->db->dbprefix."department dep join ".$this->db->dbprefix."ticket tick on tick.department_id=dep.id where tick.status='1' and date(tick.create_date) between '".date('Y-m-d',strtotime($customdatefrom))."' and '".date('Y-m-d',strtotime($customdateto))."' and dep.status='1' group by tick.department_id";
		}
		if($timeperiod=="today" or $timeperiod=="")
		{
			$sql="select dep.department_name,count(*) as countnum from ".$this->db->dbprefix."department dep join ".$this->db->dbprefix."ticket tick on tick.department_id=dep.id where tick.status='1' and date(tick.create_date)='".date('Y-m-d')."' and dep.status='1' group by tick.department_id";
		}
		if($timeperiod=="yesterday")
		{
			$sql="select dep.department_name,count(*) as countnum from ".$this->db->dbprefix."department dep join ".$this->db->dbprefix."ticket tick on tick.department_id=dep.id where tick.status='1' and date(tick.create_date)='".date('Y-m-d',strtotime("-1 day"))."' and dep.status='1' group by tick.department_id";
		}
		if($timeperiod=="lastweek")
		{
			$sql="select dep.department_name,count(*) as countnum from ".$this->db->dbprefix."department dep join ".$this->db->dbprefix."ticket tick on tick.department_id=dep.id where tick.status='1' and date(tick.create_date)>='".date('Y-m-d',strtotime("-1 week"))."' and date(tick.create_date)<='".date('Y-m-d')."' and dep.status='1' group by tick.department_id";
		}
		if($timeperiod=="currentmonth")
		{
			$sql="select dep.department_name,count(*) as countnum from ".$this->db->dbprefix."department dep join ".$this->db->dbprefix."ticket tick on tick.department_id=dep.id where tick.status='1' and MONTH(tick.create_date)='".date('m')."' and dep.status='1' group by tick.department_id";
		}
		if($timeperiod=="lastmonth")
		{
			$sql="select dep.department_name,count(*) as countnum from ".$this->db->dbprefix."department dep join ".$this->db->dbprefix."ticket tick on tick.department_id=dep.id where tick.status='1' and MONTH(tick.create_date)='".date('m',strtotime("-1 month"))."' and dep.status='1' group by tick.department_id";
		}
		if($timeperiod=="currentyear")
		{
			$sql="select dep.department_name,count(*) as countnum from ".$this->db->dbprefix."department dep join ".$this->db->dbprefix."ticket tick on tick.department_id=dep.id where tick.status='1' and YEAR(tick.create_date)='".date('Y')."' and dep.status='1' group by tick.department_id";
		}
		if($timeperiod=="lastyear")
		{
			$sql="select dep.department_name,count(*) as countnum from ".$this->db->dbprefix."department dep join ".$this->db->dbprefix."ticket tick on tick.department_id=dep.id where tick.status='1' and YEAR(tick.create_date)='".date('Y',strtotime("-1 year"))."' and dep.status='1' group by tick.department_id";
		}
		$query=$this->db->query($sql);
		if(!empty($query))
		{
			return $query->result();
		}
		else
		{
			return "";
		}
	}
	
	public function getCompanyChart($timeperiod,$customdatefrom,$customdateto)
	{
		if($timeperiod=="customdate")
		{
			$sql="select com.company_name,count(*) as countnum from ".$this->db->dbprefix."company com join ".$this->db->dbprefix."ticket tick on tick.company_id=com.id where tick.status='1' and date(tick.create_date) between '".date('Y-m-d',strtotime($customdatefrom))."' and '".date('Y-m-d',strtotime($customdateto))."' and com.status='1' group by tick.company_id";
		}
		if($timeperiod=="today" or $timeperiod=="")
		{
			$sql="select com.company_name,count(*) as countnum from ".$this->db->dbprefix."company com join ".$this->db->dbprefix."ticket tick on tick.company_id=com.id where tick.status='1' and date(tick.create_date)='".date('Y-m-d')."' and com.status='1' group by tick.company_id";
		}
		if($timeperiod=="yesterday")
		{
			$sql="select com.company_name,count(*) as countnum from ".$this->db->dbprefix."company com join ".$this->db->dbprefix."ticket tick on tick.company_id=com.id where tick.status='1' and date(tick.create_date)='".date('Y-m-d',strtotime("-1 day"))."' and com.status='1' group by tick.company_id";
		}
		if($timeperiod=="lastweek")
		{
			$sql="select com.company_name,count(*) as countnum from ".$this->db->dbprefix."company com join ".$this->db->dbprefix."ticket tick on tick.company_id=com.id where tick.status='1' and date(tick.create_date)>='".date('Y-m-d',strtotime("-1 week"))."' and date(tick.create_date)<='".date('Y-m-d')."' and com.status='1' group by tick.company_id";
		}
		if($timeperiod=="currentmonth")
		{
			$sql="select com.company_name,count(*) as countnum from ".$this->db->dbprefix."company com join ".$this->db->dbprefix."ticket tick on tick.company_id=com.id where tick.status='1' and MONTH(tick.create_date)='".date('m')."' and com.status='1' group by tick.company_id";
		}
		if($timeperiod=="lastmonth")
		{
			$sql="select com.company_name,count(*) as countnum from ".$this->db->dbprefix."company com join ".$this->db->dbprefix."ticket tick on tick.company_id=com.id where tick.status='1' and MONTH(tick.create_date)='".date('m',strtotime("-1 month"))."' and com.status='1' group by tick.company_id";
		}
		if($timeperiod=="currentyear")
		{
			$sql="select com.company_name,count(*) as countnum from ".$this->db->dbprefix."company com join ".$this->db->dbprefix."ticket tick on tick.company_id=com.id where tick.status='1' and YEAR(tick.create_date)='".date('Y')."' and com.status='1' group by tick.company_id";
		}
		if($timeperiod=="lastyear")
		{
			$sql="select com.company_name,count(*) as countnum from ".$this->db->dbprefix."company com join ".$this->db->dbprefix."ticket tick on tick.company_id=com.id where tick.status='1' and YEAR(tick.create_date)='".date('Y',strtotime("-1 year"))."' and com.status='1' group by tick.company_id";
		}
		$query=$this->db->query($sql);
		if(!empty($query))
		{
			return $query->result();
		}
		else
		{
			return "";
		}
	}
	
	public function getTicketStateChart($timeperiod,$customdatefrom,$customdateto)
	{
		if($timeperiod=="customdate")
		{
			$sql="select stat.name,stat.code,count(*) as countnum from ".$this->db->dbprefix."ticket_states stat join ".$this->db->dbprefix."ticket tick on tick.state=stat.code where tick.status='1' and date(tick.create_date) between '".date('Y-m-d',strtotime($customdatefrom))."' and '".date('Y-m-d',strtotime($customdateto))."' and stat.status='1' group by tick.state";
		}
		if($timeperiod=="today" or $timeperiod=="")
		{
			$sql="select stat.name,stat.code,count(*) as countnum from ".$this->db->dbprefix."ticket_states stat join ".$this->db->dbprefix."ticket tick on tick.state=stat.code where tick.status='1' and date(tick.create_date)='".date('Y-m-d')."' and stat.status='1' group by tick.state";
		}
		if($timeperiod=="yesterday")
		{
			$sql="select stat.name,stat.code,count(*) as countnum from ".$this->db->dbprefix."ticket_states stat join ".$this->db->dbprefix."ticket tick on tick.state=stat.code where tick.status='1' and date(tick.create_date)='".date('Y-m-d',strtotime("-1 day"))."' and stat.status='1' group by tick.state";
		}
		if($timeperiod=="lastweek")
		{
			$sql="select stat.name,stat.code,count(*) as countnum from ".$this->db->dbprefix."ticket_states stat join ".$this->db->dbprefix."ticket tick on tick.state=stat.code where tick.status='1' and date(tick.create_date)>='".date('Y-m-d',strtotime("-1 week"))."' and date(tick.create_date)<='".date('Y-m-d')."' and stat.status='1' group by tick.state";
		}
		if($timeperiod=="currentmonth")
		{
			$sql="select stat.name,stat.code,count(*) as countnum from ".$this->db->dbprefix."ticket_states stat join ".$this->db->dbprefix."ticket tick on tick.state=stat.code where tick.status='1' and MONTH(tick.create_date)='".date('m')."' and stat.status='1' group by tick.state";
		}
		if($timeperiod=="lastmonth")
		{
			$sql="select stat.name,stat.code,count(*) as countnum from ".$this->db->dbprefix."ticket_states stat join ".$this->db->dbprefix."ticket tick on tick.state=stat.code where tick.status='1' and MONTH(tick.create_date)='".date('m',strtotime("-1 month"))."' and stat.status='1' group by tick.state";
		}
		if($timeperiod=="currentyear")
		{
			$sql="select stat.name,stat.code,count(*) as countnum from ".$this->db->dbprefix."ticket_states stat join ".$this->db->dbprefix."ticket tick on tick.state=stat.code where tick.status='1' and YEAR(tick.create_date)='".date('Y')."' and stat.status='1' group by tick.state";
		}
		if($timeperiod=="lastyear")
		{
			$sql="select stat.name,stat.code,count(*) as countnum from ".$this->db->dbprefix."ticket_states stat join ".$this->db->dbprefix."ticket tick on tick.state=stat.code where tick.status='1' and YEAR(tick.create_date)='".date('Y',strtotime("-1 year"))."' and stat.status='1' group by tick.state";
		}
		$query=$this->db->query($sql);
		if(!empty($query))
		{
			return $query->result();
		}
		else
		{
			return "";
		}
	}
	
	public function getProductChart($timeperiod,$customdatefrom,$customdateto)
	{
		if($timeperiod=="customdate")
		{
			$sql="select prod.product_name,count(*) as countnum from ".$this->db->dbprefix."product prod join ".$this->db->dbprefix."ticket tick on tick.product_id=prod.id where tick.status='1' and date(tick.create_date) between '".date('Y-m-d',strtotime($customdatefrom))."' and '".date('Y-m-d',strtotime($customdateto))."' and prod.status='1' group by prod.product_name";
		}
		if($timeperiod=="today" or $timeperiod=="")
		{
			$sql="select prod.product_name,count(*) as countnum from ".$this->db->dbprefix."product prod join ".$this->db->dbprefix."ticket tick on tick.product_id=prod.id where tick.status='1' and date(tick.create_date)='".date('Y-m-d')."' and prod.status='1' group by prod.product_name";
		}
		if($timeperiod=="yesterday")
		{
			$sql="select prod.product_name,count(*) as countnum from ".$this->db->dbprefix."product prod join ".$this->db->dbprefix."ticket tick on tick.product_id=prod.id where tick.status='1' and date(tick.create_date)='".date('Y-m-d',strtotime("-1 day"))."' and prod.status='1' group by prod.product_name";
		}
		if($timeperiod=="lastweek")
		{
			$sql="select prod.product_name,count(*) as countnum from ".$this->db->dbprefix."product prod join ".$this->db->dbprefix."ticket tick on tick.product_id=prod.id where tick.status='1' and date(tick.create_date)>='".date('Y-m-d',strtotime("-1 week"))."' and date(tick.create_date)<='".date('Y-m-d')."' and prod.status='1' group by prod.product_name";
		}
		if($timeperiod=="currentmonth")
		{
			$sql="select prod.product_name,count(*) as countnum from ".$this->db->dbprefix."product prod join ".$this->db->dbprefix."ticket tick on tick.product_id=prod.id where tick.status='1' and MONTH(tick.create_date)='".date('m')."' and prod.status='1' group by prod.product_name";
		}
		if($timeperiod=="lastmonth")
		{
			$sql="select prod.product_name,count(*) as countnum from ".$this->db->dbprefix."product prod join ".$this->db->dbprefix."ticket tick on tick.product_id=prod.id where tick.status='1' and MONTH(tick.create_date)='".date('m',strtotime("-1 month"))."' and prod.status='1' group by prod.product_name";
		}
		if($timeperiod=="currentyear")
		{
			$sql="select prod.product_name,count(*) as countnum from ".$this->db->dbprefix."product prod join ".$this->db->dbprefix."ticket tick on tick.product_id=prod.id where tick.status='1' and YEAR(tick.create_date)='".date('Y')."' and prod.status='1' group by prod.product_name";
		}
		if($timeperiod=="lastyear")
		{
			$sql="select prod.product_name,count(*) as countnum from ".$this->db->dbprefix."product prod join ".$this->db->dbprefix."ticket tick on tick.product_id=prod.id where tick.status='1' and YEAR(tick.create_date)='".date('Y',strtotime("-1 year"))."' and prod.status='1' group by prod.product_name";
		}
		$query=$this->db->query($sql);
		if(!empty($query))
		{
			return $query->result();
		}
		else
		{
			return "";
		}
	}
	
	public function getRateChart($timeperiod,$customdatefrom,$customdateto)
	{
		if($timeperiod=="customdate")
		{
			$sql="select tick.ticket_no,AVG(rat.rating) as ratenum from ".$this->db->dbprefix."ticket tick,".$this->db->dbprefix."ticket_rating rat where tick.id=rat.ticket_id and date(rat.dateAdded) between '".date('Y-m-d',strtotime($customdatefrom))."' and '".date('Y-m-d',strtotime($customdateto))."' group by tick.ticket_no";
		}
		if($timeperiod=="today" or $timeperiod=="")
		{
			$sql="select tick.ticket_no,AVG(rat.rating) as ratenum from ".$this->db->dbprefix."ticket tick,".$this->db->dbprefix."ticket_rating rat where tick.id=rat.ticket_id and date(rat.dateAdded)='".date('Y-m-d')."' group by tick.ticket_no";
		}
		if($timeperiod=="yesterday")
		{
			$sql="select tick.ticket_no,AVG(rat.rating) as ratenum from ".$this->db->dbprefix."ticket tick,".$this->db->dbprefix."ticket_rating rat where tick.id=rat.ticket_id and date(rat.dateAdded)='".date('Y-m-d',strtotime("-1 day"))."' group by tick.ticket_no";
		}
		if($timeperiod=="lastweek")
		{
			$sql="select tick.ticket_no,AVG(rat.rating) as ratenum from ".$this->db->dbprefix."ticket tick,".$this->db->dbprefix."ticket_rating rat where tick.id=rat.ticket_id and date(rat.dateAdded)>='".date('Y-m-d',strtotime("-1 week"))."' and date(rat.dateAdded)<='".date('Y-m-d')."' group by tick.ticket_no";
		}
		if($timeperiod=="currentmonth")
		{
			$sql="select tick.ticket_no,AVG(rat.rating) as ratenum from ".$this->db->dbprefix."ticket tick,".$this->db->dbprefix."ticket_rating rat where tick.id=rat.ticket_id and MONTH(rat.dateAdded)='".date('m')."' group by tick.ticket_no";
		}
		if($timeperiod=="lastmonth")
		{
			$sql="select tick.ticket_no,AVG(rat.rating) as ratenum from ".$this->db->dbprefix."ticket tick,".$this->db->dbprefix."ticket_rating rat where tick.id=rat.ticket_id and MONTH(rat.dateAdded)='".date('m',strtotime("-1 month"))."' group by tick.ticket_no";
		}
		if($timeperiod=="currentyear")
		{
			$sql="select tick.ticket_no,AVG(rat.rating) as ratenum from ".$this->db->dbprefix."ticket tick,".$this->db->dbprefix."ticket_rating rat where tick.id=rat.ticket_id and YEAR(rat.dateAdded)='".date('Y')."' group by tick.ticket_no";
		}
		if($timeperiod=="lastyear")
		{
			$sql="select tick.ticket_no,AVG(rat.rating) as ratenum from ".$this->db->dbprefix."ticket tick,".$this->db->dbprefix."ticket_rating rat where tick.id=rat.ticket_id and YEAR(rat.dateAdded)='".date('Y',strtotime("-1 year"))."' group by tick.ticket_no";
		}
		//echo $sql;
		$query=$this->db->query($sql);
		if(!empty($query))
		{
			return $query->result();
		}
		else
		{
			return "";
		}
	}
	
	public function getResponseChart($userid,$timeperiod,$customdatefrom,$customdateto)
	{
		if($timeperiod=="customdate")
		{
			$sql="select responder_time_duration, currentdate from ".$this->db->dbprefix."responder_time_duration where userid='".$userid."' and date(currentdate) between '".date('Y-m-d',strtotime($customdatefrom))."' and '".date('Y-m-d',strtotime($customdateto))."' order by currentdate ASC";
		}
		if($timeperiod=="today" or $timeperiod=="")
		{
			$sql="select responder_time_duration, currentdate from ".$this->db->dbprefix."responder_time_duration where userid='".$userid."' and date(currentdate)='".date('Y-m-d')."' order by currentdate ASC";
		}
		if($timeperiod=="yesterday")
		{
			$sql="select responder_time_duration, currentdate from ".$this->db->dbprefix."responder_time_duration where userid='".$userid."' and date(currentdate)='".date('Y-m-d',strtotime("-1 day"))."' order by currentdate ASC";
		}
		if($timeperiod=="lastweek")
		{
			$sql="select responder_time_duration, currentdate from ".$this->db->dbprefix."responder_time_duration where userid='".$userid."' and date(currentdate)>='".date('Y-m-d',strtotime("-1 week"))."' and date(currentdate)<='".date('Y-m-d')."' order by currentdate ASC";
		}
		if($timeperiod=="currentmonth")
		{
			$sql="select responder_time_duration, currentdate from ".$this->db->dbprefix."responder_time_duration where userid='".$userid."' and MONTH(currentdate)='".date('m')."' order by currentdate ASC";
		}
		if($timeperiod=="lastmonth")
		{
			$sql="select responder_time_duration, currentdate from ".$this->db->dbprefix."responder_time_duration where userid='".$userid."' and MONTH(currentdate)='".date('m',strtotime("-1 month"))."' order by currentdate ASC";
		}
		if($timeperiod=="currentyear")
		{
			$sql="select responder_time_duration, currentdate from ".$this->db->dbprefix."responder_time_duration where userid='".$userid."' and YEAR(currentdate)='".date('Y')."' order by currentdate ASC";
		}
		if($timeperiod=="lastyear")
		{
			$sql="select responder_time_duration, currentdate from ".$this->db->dbprefix."responder_time_duration where userid='".$userid."' and YEAR(currentdate)='".date('Y',strtotime("-1 year"))."' order by currentdate ASC";
		}
		$query=$this->db->query($sql);
		if(!empty($query))
		{
			return $query->result();
		}
		else
		{
			return "";
		}
	}
}
