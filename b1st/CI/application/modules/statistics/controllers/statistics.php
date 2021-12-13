<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class statistics extends MX_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		B1st_authenticate();
		B1st_selectbacklanguage();
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('statistics_model');

	}
	
	public function index()
	{
		@session_start();
		$data['deccolor']=B1st_random_color_decimal();
		
		$data['timeperiod']=$this->input->post('timeperiod');
		if(!empty($data['timeperiod']))
		{
			$data['customdatefrom']=$this->input->post('customdatefrom');
			$data['customdateto']=$this->input->post('customdateto');
		}
		else
		{
			$data['customdatefrom']="";
			$data['customdateto']="";
		}
		
		$det=$this->statistics_model->getPriorityChart($data['timeperiod'],$data['customdatefrom'],$data['customdateto']);
		
		$deptdet=$this->statistics_model->getDepartmentChart($data['timeperiod'],$data['customdatefrom'],$data['customdateto']);
		
		$compdet=$this->statistics_model->getCompanyChart($data['timeperiod'],$data['customdatefrom'],$data['customdateto']);
		
		$statedet=$this->statistics_model->getTicketStateChart($data['timeperiod'],$data['customdatefrom'],$data['customdateto']);
		
		$proddet=$this->statistics_model->getProductChart($data['timeperiod'],$data['customdatefrom'],$data['customdateto']);
		
		$ratedet=$this->statistics_model->getRateChart($data['timeperiod'],$data['customdatefrom'],$data['customdateto']);
		
		$responsedet=$this->statistics_model->getResponseChart($_SESSION['userid'],$data['timeperiod'],$data['customdatefrom'],$data['customdateto']);
		
		//echo "<pre>";
		//print_r($responsedet);
		//echo "</pre>";

		//echo "<pre>";
		//print_r($ratedet);
		//echo "</pre>";
		
		if(!empty($responsedet))
		{

			foreach($responsedet as $responseval)
			{
				$responsenamearr[]=date("jS M,Y h:i:sa",strtotime($responseval->currentdate));
				$responsevalarr[]=$responseval->responder_time_duration;
			}
			
		}
			$mainpriority=array();
			$priority_arr=array();		
		if(!empty($det))
		{

			foreach($det as $priority)
			{
				$priority_arr['value']=$priority->countnum;
				$priority_arr['color']=$priority->priority_color;
				$priority_arr['highlight']=$priority->priority_color;
				$priority_arr['label']=$priority->priority_name;
				
				$mainpriority[]=$priority_arr;
			}
		}
		
			$maindepartment=array();
			$department_arr=array();

		if(!empty($deptdet))
		{

			foreach($deptdet as $department)
			{
				$color="#".B1st_random_color_hexadecimal();
				$department_arr['value']=$department->countnum;
				$department_arr['color']=$color;
				$department_arr['highlight']=$color;
				$department_arr['label']=$department->department_name;
				
				$maindepartment[]=$department_arr;
			}
		}
			$mainstate=array();
			$state_arr=array();		
		if(!empty($statedet))
		{

			foreach($statedet as $state)
			{
				$color="#".B1st_random_color_hexadecimal();
				$state_arr['value']=$state->countnum;
				$state_arr['color']=$color;
				$state_arr['highlight']=$color;
				$state_arr['label']=ucwords($state->name);
				
				$mainstate[]=$state_arr;
			}
		}
			$maincompany=array();
			$company_arr=array();		
		if(!empty($compdet))
		{

			foreach($compdet as $company)
			{
				$color="#".B1st_random_color_hexadecimal();
				$company_arr['value']=$company->countnum;
				$company_arr['color']=$color;
				$company_arr['highlight']=$color;
				$company_arr['label']=$company->company_name;
				
				$maincompany[]=$company_arr;
			}
		}
			$ratename=array();
			$ratevalue=array();		
		if(!empty($ratedet))
		{

			foreach($ratedet as $rateval)
			{
				$ratename[]=$rateval->ticket_no;
				$ratevalue[]=$rateval->ratenum;
			}
		}
		
		//echo "<pre>";
		//print_r($proddet);
		//echo "</pre>";

		$productname_json=json_encode(array(0));
		
		$productnum_json=json_encode(array(0));
		
		$priority_json=json_encode(array(0));
		
		$department_json=json_encode(array(0));
		
		$company_json=json_encode(array(0));
		
		$state_json=json_encode(array(0));
		
		$ratename_json=json_encode(array(0));
		
		$rateval_json=json_encode(array(0));
		
		$responsename_json=json_encode(array(0));
		
		$responseval_json=json_encode(array(0));
		
		if(!empty($responsenamearr))
		{
			$responsename_json=json_encode($responsenamearr);
		}
		
		if(!empty($responsevalarr))
		{
			$responseval_json=json_encode($responsevalarr);
		}
		
		//echo "<pre>";
		//print_r($state_json);
		//echo "</pre>";
		
		$data['priority_json']=$priority_json;
		
		$data['department_json']=$department_json;
		
		$data['company_json']=$company_json;
		
		$data['state_json']=$state_json;
		
		$data['productname_json']=$productname_json;
		
		$data['productnum_json']=$productnum_json;
		
		$data['ratename_json']=$ratename_json;
		
		$data['rateval_json']=$rateval_json;
		
		$data['responsename_json']=$responsename_json;
		
		$data['responseval_json']=$responseval_json;

		if(!empty($proddet))
		{
			$productname=array();
			$productnum=array();
			foreach($proddet as $productlist)
			{
				$productname[]=$productlist->product_name;
				$productnum[]=$productlist->countnum;
			}

			$productname_json=json_encode($productname);
			$productnum_json=json_encode($productnum);
		}
		
		$priority_json=json_encode($mainpriority);
		
		$department_json=json_encode($maindepartment);
		
		$company_json=json_encode($maincompany);
		
		$state_json=json_encode($mainstate);

		$ratename = !empty($ratename) ? $ratename : "";

		$ratename_json=json_encode($ratename);
		
		$ratevalue = !empty($ratevalue) ? $ratevalue : "";

		$rateval_json=json_encode($ratevalue);
		
		//echo "<pre>";
		//print_r($state_json);
		//echo "</pre>";
		
		$data['priority_json']=$priority_json;
		
		$data['department_json']=$department_json;
		
		$data['company_json']=$company_json;
		
		$data['state_json']=$state_json;
		
		$data['productname_json']=$productname_json;
		
		$data['productnum_json']=$productnum_json;
		
		$data['ratename_json']=$ratename_json;
		
		$data['rateval_json']=$rateval_json;
		
		$data['responsename_json']=$responsename_json;
		
		$data['responseval_json']=$responseval_json;
		
		//echo "<pre>";
		//print_r($productname);
		//print_r($productnum);
		//echo "</pre>";
		

		
		$this->load->view('statisticslist.php',$data);
	}
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
