<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class theme extends MX_Controller {

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
		$this->load->model('theme_model');
	
	}
	
	public function index()
	{

		$ppage=$this->input->post('perpage');
		$uriseg=$this->uri->segment(3);
		if(!empty($ppage))
		{
			$_SESSION['perpage'] = $this->input->post('perpage');
			$uriseg="";
			//$this->session->set_userdata('perpage',$this->input->post('perpage'));
		}
			//$this->session->set_userdata('perpage',$this->input->post('perpage'));
		//echo $this->session->userdata('perpage');
		$noPage = @$_SESSION['perpage'];
		
		$this->load->library('pagination');

		$options = array(
			'orderBy'=> 'DESC'
		);
		$settings = (array)B1st_getSettingsValue('pagination');

		#pagination start
		
		$perPage =(!empty($noPage)) ? $noPage : $settings['active'];
		$config['base_url'] = TICKET_PLUGIN_URL.'CI/index.php/theme/index';
		$config['total_rows'] = $this->theme_model->listthemeCount($options);
		$config['per_page'] = $perPage;
		$config["uri_segment"] = 3;
		$config['full_tag_open'] = '<div class="pagi_box"><ul class="pagi_main">';
		$config['full_tag_close'] = '</ul></div>';
		$config['next_link']        = '<i class="fa fa-angle-double-right"></i>';
		$config['next_tag_open']    = '<li class="no_b">';
		$config['next_tag_close']   = '</li>';
		$config['prev_link']        = '<i class="fa fa-angle-double-left"></i>';
		$config['prev_tag_open']    = '<li>';
		$config['prev_tag_close']   = '</li>';
		$config['cur_tag_open'] = '<li><a class="sect" href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        #pagination end
        $data['noPage'] = $perPage;
		$themedet=$this->theme_model->listtheme($options,$perPage,$uriseg);
		$data['themedet']=$themedet;
		$this->load->view('themelist',$data);
	}
	
	public function add()
	{
		$this->load->view('themeaddform');
	}
	
	public function insert()
	{
		$theme_name=$this->input->post('theme_name');
		$theme_color=$this->input->post('theme_color');
		
		$this->form_validation->set_rules('theme_name', 'Theme Name', 'required|is_unique['.B1st_getDbPrefix().'theme.theme_name]');
		
		$this->form_validation->set_rules('theme_color', 'Theme Color', 'required|is_unique['.B1st_getDbPrefix().'theme.theme_color]|color_check');
		
		$this->form_validation->set_message('required', 'Please enter %s !!');
		
		$this->form_validation->set_message('color_check', 'Invalid %s');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->add();
		}
		else
		{
			$data['theme_name'] = $theme_name;
			$data['theme_color'] = $theme_color;
			
			//code for dark color
			$themecolor_rgb=B1st_hex2rgb($theme_color);
			
			if($themecolor_rgb[0]>=45)
			{
				$newthemecolorrgb[0]=$themecolor_rgb[0]-45;
			}
			else
			{
				$newthemecolorrgb[0]=$themecolor_rgb[0];
			}
			if($themecolor_rgb[1]>=45)
			{
				$newthemecolorrgb[1]=$themecolor_rgb[1]-45;
			}
			else
			{
				$newthemecolorrgb[1]=$themecolor_rgb[1];
			}
			if($themecolor_rgb[2]>=45)
			{
				$newthemecolorrgb[2]=$themecolor_rgb[2]-45;
			}
			else
			{
				$newthemecolorrgb[2]=$themecolor_rgb[2];
			}
			
			$darktheme_color=B1st_rgb2hex($newthemecolorrgb);
			
			
			//code for light color
			
			if($themecolor_rgb[0]<=210)
			{
				$newthemecolorrgb[0]=$themecolor_rgb[0]+45;
			}
			else
			{
				$newthemecolorrgb[0]=$themecolor_rgb[0];
			}
			if($themecolor_rgb[1]<=210)
			{
				$newthemecolorrgb[1]=$themecolor_rgb[1]+45;
			}
			else
			{
				$newthemecolorrgb[1]=$themecolor_rgb[1];
			}
			if($themecolor_rgb[2]<=210)
			{
				$newthemecolorrgb[2]=$themecolor_rgb[2]+45;
			}
			else
			{
				$newthemecolorrgb[2]=$themecolor_rgb[2];
			}
			
			$lighttheme_color=B1st_rgb2hex($newthemecolorrgb);
			
			chmod(APPPATH.'../assets/css',0777);
			
			$csspath= APPPATH.'../assets/css/style.css';
			
			$newcsspath= APPPATH.'../assets/css/'.$theme_name.'style.css';
			
			$csspath1= APPPATH.'../assets/css/chat_style.css';
			
			$newcsspath1= APPPATH.'../assets/css/'.$theme_name.'chat_style.css';
			
			$fp=fopen($newcsspath,"w+");
			
			$datafile=file_get_contents($csspath);
			
			$datafilenew=str_ireplace("#da4c4c",$theme_color,$datafile);
			
			$datafilenew=str_ireplace("#db4d4d",$theme_color,$datafilenew);
			
			$datafilenew=str_ireplace("#e38787",$theme_color,$datafilenew);
			
			$datafilenew=str_ireplace("#ae3d3d",$darktheme_color,$datafilenew);
			
			$datafilenew=str_ireplace("#e17070",$darktheme_color,$datafilenew);
			
			$datafilenew=str_ireplace("#d96969",$darktheme_color,$datafilenew);
			
			$datafilenew=str_ireplace("#be3434",$darktheme_color,$datafilenew);
			
			$datafilenew=str_ireplace("#be3e3e",$darktheme_color,$datafilenew);
			
			$datafilenew=str_ireplace("#c63f3e",$darktheme_color,$datafilenew);
			
			$datafilenew=str_ireplace("#ed423b",$lighttheme_color,$datafilenew);
			
			$datafilenew=str_ireplace("#e94e47",$lighttheme_color,$datafilenew);
			
			$datafilenew=str_ireplace("#f25a5a",$lighttheme_color,$datafilenew);
			
			$datafilenew=str_ireplace("#f48d8d",$lighttheme_color,$datafilenew);
			
			file_put_contents($newcsspath,$datafilenew);
			
			fclose($fp);
			
			$fp1=fopen($newcsspath1,"w+");
			
			$datafile1=file_get_contents($csspath1);
			
			$datafilenew1=str_ireplace("#da4c4c",$theme_color,$datafile1);
			
			file_put_contents($newcsspath1,$datafilenew1);
			
			fclose($fp1);
			
			//echo "<pre>";
			//print_r($datafilenew);
			//echo "</pre>";
			//die;
			
			//front css generation
				
				$csspath= APPPATH.'../assets/css/front_style.css';
				
				$newcsspath= APPPATH.'../assets/css/'.$theme_name.'front_style.css';
				
				$csspath1= APPPATH.'../assets/css/front_chat_style.css';
				
				$newcsspath1= APPPATH.'../assets/css/'.$theme_name.'front_chat_style.css';
				
				$fp=fopen($newcsspath,"w+");
				
				$datafile=file_get_contents($csspath);
				
				$datafile=file_get_contents($csspath);
				
				$datafilenew=str_ireplace("#da4c4c",$theme_color,$datafile);
				
				$datafilenew=str_ireplace("#db4d4d",$theme_color,$datafilenew);
				
				$datafilenew=str_ireplace("#e38787",$theme_color,$datafilenew);
				
				$datafilenew=str_ireplace("#ae3d3d",$darktheme_color,$datafilenew);
				
				$datafilenew=str_ireplace("#e17070",$darktheme_color,$datafilenew);
				
				$datafilenew=str_ireplace("#d96969",$darktheme_color,$datafilenew);
				
				$datafilenew=str_ireplace("#be3434",$darktheme_color,$datafilenew);
				
				$datafilenew=str_ireplace("#be3e3e",$darktheme_color,$datafilenew);
				
				$datafilenew=str_ireplace("#c63f3e",$darktheme_color,$datafilenew);
				
				$datafilenew=str_ireplace("#ed423b",$lighttheme_color,$datafilenew);
				
				$datafilenew=str_ireplace("#e94e47",$lighttheme_color,$datafilenew);
				
				$datafilenew=str_ireplace("#f25a5a",$lighttheme_color,$datafilenew);
				
				$datafilenew=str_ireplace("#f48d8d",$lighttheme_color,$datafilenew);
				
				file_put_contents($newcsspath,$datafilenew);
				
				fclose($fp);
				
				$fp1=fopen($newcsspath1,"w+");
				
				$datafile1=file_get_contents($csspath1);
				
				$datafilenew1=str_ireplace("#da4c4c",$theme_color,$datafile1);
				
				file_put_contents($newcsspath1,$datafilenew1);
				
				fclose($fp1);
				//front css generation end

			$ins=$this->theme_model->addtheme($data);
			if(!empty($ins))
			{
				$_SESSION['SUCCESS_MSG']=$this->lang->line("Theme added successfully");
				redirect(TICKET_PLUGIN_URL."CI/index.php/theme");
			}
		}
	}
	
	public function statuschange($themeid)
	{
		$chk=$this->theme_model->statuschange($themeid);
		if(!empty($chk))
		{
			$_SESSION['SUCCESS_MSG']=$this->lang->line("Status changed successfully");
			redirect(TICKET_PLUGIN_URL."CI/index.php/theme");
		}
	}
	
	public function themechange($themeid)
	{
		$chk=$this->theme_model->themechange($themeid);
		if(!empty($chk))
		{
			$_SESSION['SUCCESS_MSG']=$this->lang->line("Theme set as default successfully");
			redirect(TICKET_PLUGIN_URL."CI/index.php/theme");
		}
	}

	public function themechangefront($themeid)
	{
		$chk=$this->theme_model->themechangefront($themeid);
		if(!empty($chk))
		{
			$_SESSION['SUCCESS_MSG']=$this->lang->line("Theme set as default successfully");
			redirect(TICKET_PLUGIN_URL."CI/index.php/theme");
		}
	}

	public function themechangedefaultfront()
	{
		$chk=$this->theme_model->themechangedefaultfront();
		if(!empty($chk))
		{
			$_SESSION['SUCCESS_MSG']=$this->lang->line("Theme set as default successfully");
			redirect(TICKET_PLUGIN_URL."CI/index.php/theme");
		}
	}

	public function themechangedefaultback()
	{
		$chk=$this->theme_model->themechangedefaultback();
		if(!empty($chk))
		{
			$_SESSION['SUCCESS_MSG']=$this->lang->line("Theme set as default successfully");
			redirect(TICKET_PLUGIN_URL."CI/index.php/theme");
		}
	}
	
	public function deletetheme($themeid)
	{
		$chk=$this->theme_model->delete($themeid);
		if(!empty($chk))
		{
			$_SESSION['SUCCESS_MSG']=$this->lang->line("Theme deleted successfully");
			redirect(TICKET_PLUGIN_URL."CI/index.php/theme");
		}
	}
	
	public function edit($companyid)
	{
		$det=$this->theme_model->B1st_getTheme($companyid);
		$data['det']=$det;
		$this->load->view('themeeditform',$data);
	}
	
	public function update()
	{
		$id=$this->input->post('id');
		$theme_name=$this->input->post('theme_name');
		$theme_color=$this->input->post('theme_color');
		
		if(strtolower($this->input->post('theme_name'))!=strtolower($this->input->post('old_theme_name')))
		{
			$this->form_validation->set_rules('theme_name', 'Theme Name', 'required|is_unique['.B1st_getDbPrefix().'theme.theme_name]');
		}
		else
		{
			$this->form_validation->set_rules('theme_name', 'Theme Name', 'required');
		}
		
		if($this->input->post('theme_color')!=$this->input->post('old_theme_color'))
		{
			$this->form_validation->set_rules('theme_color', 'Theme Color', 'required|is_unique['.B1st_getDbPrefix().'theme.theme_color]|color_check');
		}
		else
		{
			$this->form_validation->set_rules('theme_color', 'Theme Color', 'required|color_check');
		}
		
		$this->form_validation->set_message('required', 'Please enter %s !!');
		
		$this->form_validation->set_message('color_check', 'Invalid %s');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->edit($id);
		}
		else
		{
			$where['id'] = $id;
			
			if(!empty($theme_name))
			{
				$data['theme_name'] = $theme_name;
				$data['theme_color'] = $theme_color;
				
				//code for dark color
				$themecolor_rgb=B1st_hex2rgb($theme_color);
				
				if($themecolor_rgb[0]>=45)
				{
					$newthemecolorrgb[0]=$themecolor_rgb[0]-45;
				}
				else
				{
					$newthemecolorrgb[0]=$themecolor_rgb[0];
				}
				if($themecolor_rgb[1]>=45)
				{
					$newthemecolorrgb[1]=$themecolor_rgb[1]-45;
				}
				else
				{
					$newthemecolorrgb[1]=$themecolor_rgb[1];
				}
				if($themecolor_rgb[2]>=45)
				{
					$newthemecolorrgb[2]=$themecolor_rgb[2]-45;
				}
				else
				{
					$newthemecolorrgb[2]=$themecolor_rgb[2];
				}
				
				$darktheme_color=B1st_rgb2hex($newthemecolorrgb);
				
				
				//code for light color
				
				if($themecolor_rgb[0]<=210)
				{
					$newthemecolorrgb[0]=$themecolor_rgb[0]+45;
				}
				else
				{
					$newthemecolorrgb[0]=$themecolor_rgb[0];
				}
				if($themecolor_rgb[1]<=210)
				{
					$newthemecolorrgb[1]=$themecolor_rgb[1]+45;
				}
				else
				{
					$newthemecolorrgb[1]=$themecolor_rgb[1];
				}
				if($themecolor_rgb[2]<=210)
				{
					$newthemecolorrgb[2]=$themecolor_rgb[2]+45;
				}
				else
				{
					$newthemecolorrgb[2]=$themecolor_rgb[2];
				}
				
				$lighttheme_color=B1st_rgb2hex($newthemecolorrgb);
				
				chmod(APPPATH.'../assets/css',0777);
				
				$csspath= APPPATH.'../assets/css/style.css';
				
				$newcsspath= APPPATH.'../assets/css/'.$theme_name.'style.css';
				
				$csspath1= APPPATH.'../assets/css/chat_style.css';
				
				$newcsspath1= APPPATH.'../assets/css/'.$theme_name.'chat_style.css';
				
				$fp=fopen($newcsspath,"w+");
				
				$datafile=file_get_contents($csspath);
				
				$datafile=file_get_contents($csspath);
				
				$datafilenew=str_ireplace("#da4c4c",$theme_color,$datafile);
				
				$datafilenew=str_ireplace("#db4d4d",$theme_color,$datafilenew);
				
				$datafilenew=str_ireplace("#e38787",$theme_color,$datafilenew);
				
				$datafilenew=str_ireplace("#ae3d3d",$darktheme_color,$datafilenew);
				
				$datafilenew=str_ireplace("#e17070",$darktheme_color,$datafilenew);
				
				$datafilenew=str_ireplace("#d96969",$darktheme_color,$datafilenew);
				
				$datafilenew=str_ireplace("#be3434",$darktheme_color,$datafilenew);
				
				$datafilenew=str_ireplace("#be3e3e",$darktheme_color,$datafilenew);
				
				$datafilenew=str_ireplace("#c63f3e",$darktheme_color,$datafilenew);
				
				$datafilenew=str_ireplace("#ed423b",$lighttheme_color,$datafilenew);
				
				$datafilenew=str_ireplace("#e94e47",$lighttheme_color,$datafilenew);
				
				$datafilenew=str_ireplace("#f25a5a",$lighttheme_color,$datafilenew);
				
				$datafilenew=str_ireplace("#f48d8d",$lighttheme_color,$datafilenew);
				
				file_put_contents($newcsspath,$datafilenew);
				
				fclose($fp);
				
				$fp1=fopen($newcsspath1,"w+");
				
				$datafile1=file_get_contents($csspath1);
				
				$datafilenew1=str_ireplace("#da4c4c",$theme_color,$datafile1);
				
				file_put_contents($newcsspath1,$datafilenew1);
				
				fclose($fp1);

				//front css generation
				
				$csspath= APPPATH.'../assets/css/front_style.css';
				
				$newcsspath= APPPATH.'../assets/css/'.$theme_name.'front_style.css';
				
				$csspath1= APPPATH.'../assets/css/front_chat_style.css';
				
				$newcsspath1= APPPATH.'../assets/css/'.$theme_name.'front_chat_style.css';
				
				$fp=fopen($newcsspath,"w+");
				
				$datafile=file_get_contents($csspath);
				
				$datafile=file_get_contents($csspath);
				
				$datafilenew=str_ireplace("#da4c4c",$theme_color,$datafile);
				
				$datafilenew=str_ireplace("#db4d4d",$theme_color,$datafilenew);
				
				$datafilenew=str_ireplace("#e38787",$theme_color,$datafilenew);
				
				$datafilenew=str_ireplace("#ae3d3d",$darktheme_color,$datafilenew);
				
				$datafilenew=str_ireplace("#e17070",$darktheme_color,$datafilenew);
				
				$datafilenew=str_ireplace("#d96969",$darktheme_color,$datafilenew);
				
				$datafilenew=str_ireplace("#be3434",$darktheme_color,$datafilenew);
				
				$datafilenew=str_ireplace("#be3e3e",$darktheme_color,$datafilenew);
				
				$datafilenew=str_ireplace("#c63f3e",$darktheme_color,$datafilenew);
				
				$datafilenew=str_ireplace("#ed423b",$lighttheme_color,$datafilenew);
				
				$datafilenew=str_ireplace("#e94e47",$lighttheme_color,$datafilenew);
				
				$datafilenew=str_ireplace("#f25a5a",$lighttheme_color,$datafilenew);
				
				$datafilenew=str_ireplace("#f48d8d",$lighttheme_color,$datafilenew);
				
				file_put_contents($newcsspath,$datafilenew);
				
				fclose($fp);
				
				$fp1=fopen($newcsspath1,"w+");
				
				$datafile1=file_get_contents($csspath1);
				
				$datafilenew1=str_ireplace("#da4c4c",$theme_color,$datafile1);
				
				file_put_contents($newcsspath1,$datafilenew1);
				
				fclose($fp1);
				//front css generation end

			}
			$upd=$this->theme_model->edittheme($data,$where,$id);
			if(!empty($upd))
			{
				$_SESSION['SUCCESS_MSG']=$this->lang->line("Theme updated successfully");
			}
			else
			{
				$_SESSION['ERROR_MSG']=$this->lang->line("Something went wrong! Please try again");
			}
			redirect(TICKET_PLUGIN_URL."CI/index.php/theme");
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
