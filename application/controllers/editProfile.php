<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class editProfile extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
	
		if(!$this->session->userdata("logged_in")){
			redirect('home?next='.urlencode(uri_string()));
		}
	
		$lang = $this->input->get('lang');
	
		if ($lang == "") {
			$lang = $this->session->userdata('lang');
		}
	
		//Default language for new users.
		if($lang==""){
			$lang = "th";
		}
	
		$this->session->set_userdata(
				array(
						"lang" => $lang
				)
		);
	
		switch ($lang) {
			case 'en':
				$lang = 'english';
				break;
	
			case 'th':
				$lang = 'thai';
				break;
	
				// Invalid language provided.
			default:
				redirect(current_url().'?lang=th');
				break;
		}
	
		if (!file_exists('application/language/'.$lang.'/side_lang.php')) {
			redirect('manage?lang=en');
		}
	
		$this->lang->load('side',$lang);
		$this->lang->load('menu',$lang);
		$this->lang->load('manage',$lang);
		$this->lang->load('create',$lang);
		$this->lang->load('home',$lang);
	
		$this->load->helper('language');
	}
	public function index() {
		
		redirect ( 'home' );
	}
	
	public function initHome() {
		$this->load->view('header_view');
		$this->load->view('side_bar_view');
	}
	
	public function editDealerPwdScreen() {
		$this->initHome();
		$this->load->view ( 'edit_password_view' );
	}
	
	public function editDealerInfoScreen() {
		$this->load->model('edit_profile_model');
		$data['sd_profile_info'] = $this->edit_profile_model->getProfileInfo($this->session->userdata('sd_id'));
		$data['regions'] = $this->edit_profile_model->getRegion();
		$this->initHome();
		$this->load->view ( 'edit_dealer_info_view', $data);
	}
	
	public function editDealerPwdAction() {
		$this->initHome();
		$this->load->view ( 'edit_password_view' );
	}
	
	public function editDealerInfoAction() {
		
		if($this->input->post()){
			$this->form_validation->set_error_delimiters('', '\n\\');
			$this->form_validation->set_rules('sd_id','Service Dealer','trim|max_length[6]');
			$this->form_validation->set_rules('NameEnglish','Name English','trim|required');
			$this->form_validation->set_rules('NameThai','Name Thai','trim');
			//$this->form_validation->set_rules('LocationEnglish','Location English','trim');
			//$this->form_validation->set_rules('LocationThai','Location Thai','trim');
			$this->form_validation->set_rules('Region','Region','trim|max_length[20]');
			$this->form_validation->set_rules('Address','Address','trim');
			$this->form_validation->set_rules('PrimaryPhone','Primary Phone','trim');
			$this->form_validation->set_rules('Phone','Phone','trim');
			$this->form_validation->set_rules('Fax','Fax','trim');
			
			if($this->form_validation->run() == FALSE){
				$this->initHome();
				$this->load->view ( 'edit_dealer_info_view' );
			}
			else{
				$UpdateServiceDealerData = array(
						'sd_id'      	=> $this->input->post('sd_id'),
						'name_eng'      => $this->input->post('NameEnglish'),
						'name_th'       => $this->input->post('NameThai'),
						//'location_en'   => $this->input->post('LocationEnglish'),
						//'location_th'   => $this->input->post('LocationThai'),
						'region'        => $this->input->post('Region'),
						'address'       => $this->input->post('Address'),
						'primary_phone' => $this->input->post('PrimaryPhone'),
						'phone'         => $this->input->post('Phone'),
						'fax'           => $this->input->post('Fax'),
						'email'			=> $this->input->post('email')
				);
				$id = $UpdateServiceDealerData['sd_id'];
				$this->load->model('edit_profile_model');
				if($this->edit_profile_model->updatedealer($UpdateServiceDealerData, $id, 'service_dealer')){
					$this->initHome();
					$this->load->view ( 'edit_password_view' );
				}
				else{
					$data['error'] =  'Update error...';
					$this->load->view('header_view');
					$this->load->view('side_bar_view');
					$this->load->view('error_view');
					$this->load->view('footer_view');
				}
			}
		}
		
		$this->initHome();
		$this->load->view ( 'edit_dealer_info_view' );
	}
}
