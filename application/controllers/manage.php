<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage extends CI_Controller {

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

		$this->load->helper('language');

		$this->load->model("manage_model");
                
        $this->load->library('pagination');
        if (!$this->session->userdata('logged_in')){
                    redirect('home');
                }
	}

	public function index()
	{
		if ($this->session->userdata('logged_in')) {
            $this->load->view('header_view');
            // $this->load->view('menu_view',$data);
            $this->load->view('side_bar_view');
            $per_page = 10;
            $status = $this->input->get("status");
            if ($status == "" OR !$status) {
                $status = "all";
            }

            $filter = array();
            if(is_array($this->input->get())){
                $getinput = $this->input->get();
                unset($getinput['RosCheck']);
                foreach ($getinput as $k => $v){
                    if($v){
                        switch ($k){
                            case 'CreateFrom':
                            case 'CreateTo':
                            case 'RepairFrom':
                            case 'RepairTo':
                                $filter[$k] = date("Y-m-d", strtotime($v));
                                break;
                            default:
                                $filter[$k] = $v;
                            break;
                        }
                    }
                }
            }
            $geturl = '';
            foreach($filter as $k => $v){
                if($k != 'status')
                    $geturl .= "&$k=$v";
            }
			// $data['filter'] = $filter;
			// echo "<pre>";
			// print_r ($filter);
			// echo "</pre>";
            $offset = $this->input->get("record");
            if ($offset == "" OR $offset%$per_page!=0) {
                $offset = 0;
            }
            $status = $this->input->get("status");
            if ($status == "" OR !$status OR $status == 'Draft'){
               $data['records'] = $this->manage_model->getros($this->session->userdata("sd_id"));
               $total_rows = 1;
            }
            else{
                $return = $this->manage_model->getrosfiltered($this->session->userdata("sd_id"),$status,$offset, $per_page, $filter);
                $data['records'] = $return['records'];
                $total_rows = $return['total_rows'];
            }

            //config the pagination library.
            $config['base_url'] = base_url().'index.php/manage?status='.$status.$geturl;
            $config['total_rows'] = $total_rows;
            // $config['use_page_numbers'] = TRUE;
            $config['per_page'] = $per_page;
            $config['page_query_string'] = TRUE;
            $config['first_link'] = 'First';
            $config['last_link'] = 'Last';
            $config['query_string_segment'] = 'record';

            //Initialize the pagination library with above configurations.
            $this->pagination->initialize($config);

            $data['table_makers'] = $this->manage_model->getallmakers();
            $data['table_statuses'] = $this->manage_model->getallstatuses();
            if($this->input->get('CarMaker'))
                $data['table_dealers'] = $this->manage_model->getsomedealers($this->input->get('CarMaker'));
            else
                $data['table_dealers'] = $this->manage_model->getalldealers();
            
            $this->load->view('manage_view',$data);
            $this->load->view('footer_view');
//			// $data['controller'] = "home";
//			$this->load->view('header_view');
//			// $this->load->view('menu_view',$data);
//			$this->load->view('side_bar_view');
//			$data['records'] = $this->manage_model->getros($this->session->userdata("sd_id"));
//			if ($data['records'] && !empty($data['records'])) {
//				# code...
//			}
//                        
//                        $data['table_makers'] = $this->manage_model->getallmakers();
//                        $data['table_statuses'] = $this->manage_model->getallstatuses();
//                        $data['table_dealers'] = $this->manage_model->getalldealers();
//                        
//			$this->load->view('manage_view',$data);
//			$this->load->view('footer_view');
		} else{
			redirect("home");
		}
	}
        
        public function ros($ros_no = "")
		{
		if ($this->session->userdata('logged_in')) {
			if ($this->input->post("ros_no")) {
				if (!($this->manage_model->allowedtoedit($this->session->userdata("sd_id"),$this->input->post("ros_no"),"ros_form"))) {
					redirect("home?message=".urlencode("Not allowed to edit the selected ROS."));
					die();
				}
				$PostData = $this->input->post();
				unset($PostData['part_code']);
				unset($PostData['draft']);
				unset($PostData['action']);
				unset($PostData['maker_name']);
               	unset($PostData['dummy']);
				$table = "ros_form";
				$log_ros_no = $PostData['ros_no'];
                                
                                
				if(isset($PostData['status'])){
					$log_status = $PostData['status'];
					$allowed = FALSE;
					$current_status = $this->manage_model->statusbyros($log_ros_no);
					$statuses = $this->manage_model->getstatuses($current_status);
					if (!empty($statuses)) {
						$new_statuses = explode(",", $statuses['status_string']);
						foreach ($new_statuses as $key => $status) {
							$status = trim($status);
							if ($status != "") {
								if ($log_status == $status) {
									$allowed = TRUE;
								}
							}
						}
					}
					if (!$allowed) {
						$return['code'] = 0;
						$return['message'] = "Changing status not allowed. Please refresh and try again.";
						echo json_encode($return);
						die();
					}
				}
                foreach ($PostData as $key => $value) {
                    if (!is_array($value)) {
                        $PostData[$key] = $PostData[$key]==""?null:$PostData[$key];
                    }
				}
                if(isset($PostData['delivery_date']))
                    $PostData['delivery_date'] = date("Y-m-d", strtotime($PostData['delivery_date']));
                if(isset($PostData['repair_date']))
                    $PostData['repair_date'] = date("Y-m-d", strtotime($PostData['repair_date']));
                $PostData['updated_time'] = date('Y-m-d H:i:s');
				$status = $this->manage_model->update($PostData,$table);
                                if(isset($log_status))
                                    trace_status($log_ros_no, $log_status);
				echo json_encode(array(
					"code" => 1,
					"message" => "Updated ".$PostData['ros_no']."successfully."
				));
			} else{
				if ($ros_no!=="") {
                                        
					if (!($this->manage_model->allowedtoedit($this->session->userdata("sd_id"),$ros_no,"ros_form"))) {
						redirect("home?message=".urlencode("Not allowed to edit the selected ROS."));
						die();
					}
                                        
					$table = "ros_form";
                                        $this->session->set_userdata("rosNo",$ros_no);
					$data['ros_info'] = $this->manage_model->getrosinfo($ros_no,$table);
					if (!empty($data['ros_info'])) {
						// echo "<pre>";print_r($data['ros_info']);echo "</pre>";
						$data['problems'] = $this->manage_model->getproblems();
						$data['sd_info'] = $this->manage_model->getsdinfo($data['ros_info']['created_by']);
                        $data['car_makers'] = $this->manage_model->getcarmakers();
                        $temp = $this->manage_model->getnextstatuses($data['ros_info']['status']);
                        $data['next_statuses'] = "";
                        $data['editable'] = $temp['editable_by_sd'];
                        if ($temp['next_status']!="") {
                            $next_statuses = explode(",",$temp['next_status']);
                            foreach ($next_statuses as $next_status) {
                                    $data['next_statuses'].="<option>$next_status</option>";
                            }
                        }
                        $this->session->set_userdata("created_by",$data['ros_info']['created_by']);
						unset($data['ros_info']['id']);
						unset($data['ros_info']['created_by']);
						unset($data['ros_info']['created_time']);
						unset($data['ros_info']['updated_time']);
                        foreach ($data['ros_info'] as $key => $value) {
                            if(!$value)
                                unset($data['ros_info'][$key]);
                        }
                        if(isset($data['ros_info']['delivery_date']))
                            $data['ros_info']['delivery_date'] = date("d-m-Y", strtotime($data['ros_info']['delivery_date']));
                        if(isset($data['ros_info']['repair_date']))
                            $data['ros_info']['repair_date'] = date("d-m-Y", strtotime($data['ros_info']['repair_date']));
                        $data['part_types'] = $this->manage_model->getparttypes($this->session->userdata('sd_id'));
						// $data['controller'] = "create";
						$this->load->view('header_view');
						// $this->load->view('menu_view',$data);
						$this->load->view('side_bar_view');
                                                $data['data'] = $data;
						$this->load->view('create_view_1',$data);
						$this->load->view('footer_view');
					} else{
						redirect("manage");
					}
				} else {
					redirect('manage');
				}
			}
		} else{
			redirect('home');
		}
	}
        
        public function getdealers()
	{
		if ($this->input->is_ajax_request()) {
			if ($this->session->userdata("logged_in")) {
				if ($this->input->post("maker_id")) {
					$maker_id = $this->input->post("maker_id");
                                        $sd_id = $this->input->post("sd_id");
                                        
					$dealers = $this->manage_model->getdealers($maker_id,$this->session->userdata("created_by"));
					if (isset($dealers) && !empty($dealers)) {
						$return['code'] = 1;
						$return['message'] = "<option selected disabled>".lang('create_general_select')."</option>";

						foreach ($dealers as $key => $value) {
							$return['message'].="<option value='".$value['dealer_id']."'>".$value[lang("create_dealer_column")]."</option>";
						}
					} else {
						$return['code'] = 0;
						$return['message'] = "No dealers found.";
					}
				} else {
					$return['code'] = 0;
					$return['message'] = "Invalid request type.";
				}
			} else {
				$return['code'] = 0;
				$return['message'] = "Session expired or not logged in.";
			}
		} else {
			$return['code'] = 0;
			$return['message'] = "NOT AJAX.";
		}

		echo json_encode($return);
	}

	public function getcarmodels()
	{
		if ($this->input->is_ajax_request()) {
			if ($this->session->userdata("logged_in")) {
				if ($this->input->post("maker_id")) {
					$PostData = $this->input->post();
                                        if($this->input->post("part_type") == "pumpinjector"){
                                            $models = $this->manage_model->getcarmodelsPumpInject($PostData);
                                        }else{
                                            $models = $this->manage_model->getcarmodels($PostData);
                                        }
					
					$return['code'] = 200;
					$return['message'] = "<option value=''>Select</option>";
					foreach ($models as $key => $row) {
						$return['message'].="<option value='".$row['car_model']."'>".$row['car_model']."</option>";
					}
					// $return['message'] = $models;
				} else {
					$return['code'] = 0;
					$return['message'] = "Invalid request type.";
				}
			} else {
				$return['code'] = 0;
				$return['message'] = "Session expired or not logged in.";
			}
		} else {
			$return['code'] = 0;
			$return['message'] = "NOT AJAX.";
		}

		echo json_encode($return);
	}

	public function getenginemodels()
	{
		if ($this->input->is_ajax_request()) {
			if ($this->session->userdata("logged_in")) {
				if ($this->input->post("maker_id")) {
					$PostData = $this->input->post();
					if($this->input->post("part_type") == "pumpinjector"){
                                            $models = $this->manage_model->getenginemodelsPumpInject($PostData);
                                        }else{
                                            $models = $this->manage_model->getenginemodels($PostData);
                                        }
                                        
                                        //$models = $this->manage_model->getenginemodels($PostData);
					$return['code'] = 200;
					$return['message'] = "<option value=''>Select</option>";
					foreach ($models as $key => $row) {
						$return['message'].="<option value='".$row['engine_model']."'>".$row['engine_model']."</option>";
					}
					// $return['message'] = $models;
				} else {
					$return['code'] = 0;
					$return['message'] = "Invalid request type.";
				}
			} else {
				$return['code'] = 0;
				$return['message'] = "Session expired or not logged in.";
			}
		} else {
			redirect("home");
		}

		echo json_encode($return);
	}

	public function getstatuses()
	{
		if ($this->input->is_ajax_request()) {
			if ($this->session->userdata("logged_in")) {
				if ($this->input->post("status")) {
					$current_status = $this->input->post("status");
					$statuses = $this->manage_model->getstatuses($current_status);
					if (!empty($statuses)) {
						$return['code'] = 200;
						$return['message'] = "";
						$new_statuses = explode(",", $statuses['status_string']);
						foreach ($new_statuses as $key => $status) {
							$status = trim($status);
							if ($status != "") {
								$return['message'].="<option value='$status'>$status</option>";
							}
						}
					} else{
						$return['code'] = 500;
						$return['message'] = "Error 505: Internal server error";
					}
				} else {
					$return['code'] = 0;
					$return['message'] = "No status provided.";
				}
			} else {
				$return['code'] = 0;
				$return['message'] = "Session expired or not logged in.";
			}
		} else {
			redirect("home");
		}

		echo json_encode($return);
	}
        
    public function getfailuremodels()
	{
		if ($this->input->is_ajax_request()) {
			if ($this->session->userdata("logged_in")) {
				if ($this->input->post("engine_model")) {
					$PostData = $this->input->post();
                                        
                                        if($this->input->post("part_type") == "pumpinjector"){
                                            $models = $this->manage_model->getfailuremodelsPumpInject($PostData);
                                        }else{
                                            $models = $this->manage_model->getfailuremodels($PostData);
                                        }
					//$models = $this->manage_model->getfailuremodels($PostData);
					$return['code'] = 200;
					$return['message'] = "<option value=''>Select</option>";
					foreach ($models as $key => $row) {
						$return['message'].="<option value='".$row['car_maker_PN']."'>".$row['car_maker_PN']."</option>";
					}
					// $return['message'] = $models;
				} else {
					$return['code'] = 0;
					$return['message'] = "Invalid request type.";
				}
			} else {
				$return['code'] = 0;
				$return['message'] = "Session expired or not logged in.";
			}
		} else {
			redirect("home");
		}

		echo json_encode($return);
	}
        
    public function getexchangemodels()
	{
		if ($this->input->is_ajax_request()) {
			if ($this->session->userdata("logged_in")) {
				if ($this->input->post("car_maker_PN")) {
					$PostData = $this->input->post();
                                        
                                        if($this->input->post("part_type") == "pumpinjector"){
                                            $models = $this->manage_model->getexchangemodelsPumpInject($PostData);
                                        }else{
                                            $models = $this->manage_model->getexchangemodels($PostData);
                                        }
					//$models = $this->manage_model->getexchangemodels($PostData);
					$return['code'] = 200;
					foreach ($models as $key => $row) {
						$return['message']=$row['exchange_PN'];
						$return['part_code'] = $row['part_code'];
					}
					// $return['message'] = $models;
				} else {
					$return['code'] = 0;
					$return['message'] = "Invalid request type.";
				}
			} else {
				$return['code'] = 0;
				$return['message'] = "Session expired or not logged in.";
			}
		} else {
			redirect("home");
		}

		echo json_encode($return);
	}

	public function getwarranty()
	{
		if ($this->input->is_ajax_request()) {
			if ($this->session->userdata("logged_in")) {
				if ($this->input->post()) {
					$PostData = $this->input->post();
					if (!isset($PostData['delivery_date']) OR !isset($PostData['repair_date'])) {
						$return['code'] = 0;
						$return['message'] = "Incomplete info provided.";
					} else {
						$warranty_conditions = $this->manage_model->getwarranty($PostData['delivery_date'],$PostData['maker_id']);
						if (!empty($warranty_conditions) AND count($warranty_conditions) != 0) {
							$delivery_date = date_create($PostData['delivery_date']);
							$repair_date = date_create($PostData['repair_date']);
							date_add($delivery_date, date_interval_create_from_date_string((int)$warranty_conditions['no_of_days']." days"));
							if ($repair_date > $delivery_date OR $PostData['mileage'] > $warranty_conditions['mileage']) {
								$return['code'] = 1;
								$return['warranty'] = "out";
							} else{
								$return['code'] = 1;
								$return['warranty'] = "in";
							}
						} else {
							$return['code'] = 1;
							$return['warranty'] = "out";
							$return['message'] = "Warranty policy not set or is outdated.";
						}
					}
				} else {
					$return['code'] = 0;
					$return['message'] = "Invalid request type.";
				}
			} else {
				$return['code'] = 0;
				$return['message'] = "Session expired or not logged in.";
			}
		} else {
			redirect("home");
		}

		echo json_encode($return);
	}
        
        public function delete()
	{
		if ($this->input->is_ajax_request()) {
			if ($this->session->userdata("logged_in")) {
				if ($this->input->post("ros_no") AND $this->input->post("ros_no")!="") {
					$PostData = $this->input->post();
					$this->manage_model->deletedraft($PostData['ros_no']);
					$return['code'] = 1;
					$return['message'] = "Deleted successfully";
				} else {
					$return['code'] = 0;
					$return['message'] = "Invalid request type.";
				}
			} else {
				$return['code'] = 0;
				$return['message'] = "Session expired or not logged in.";
			}
		} else {
			redirect("home");
		}

		echo json_encode($return);
	}
        
        public function getsomedealers()
	{
            if ($this->input->is_ajax_request()) {
                    if ($this->session->userdata("logged_in")) {
                            if ($this->input->post("CarMaker")) {
                                    $PostData = $this->input->post("CarMaker");
                                    $dealers = $this->manage_model->getsomedealers($PostData);
                                    $return['code'] = 200;
                                    $return['message'] = "<option value=''>All</option>";
                                    foreach ($dealers as $key => $row) {
                                            $return['message'].="<option value='".$row[lang('manage_dealer_name')]."'>".$row[lang('manage_dealer_name')]."</option>";
                                    }
                            } else {
                                    $dealers = $this->manage_model->getalldealers();
                                    $return['code'] = 200;
                                    $return['message'] = "<option value=''>All</option>";
                                    foreach ($dealers as $key => $row) {
                                            $return['message'].="<option value='".$row[lang('manage_dealer_name')]."'>".$row[lang('manage_dealer_name')]."</option>";
                                    }
                            }
                    } else {
                            $return['code'] = 0;
                            $return['message'] = "Session expired or not logged in.";
                    }
            } else {
                    redirect("home");
            }

            echo json_encode($return);
	}

	public function gettabs()
	{
		if ($this->input->is_ajax_request()) {
			if ($this->session->userdata("logged_in")) {
				if ($this->input->post("part_type")) {
					$PostData = $this->input->post();
					try {
						$return['tabs'] = $this->load->view("manage_".$PostData['part_type']."_tabheading_view","",true);
						$return['code'] = 200;
						$return['tab_content'] = $this->load->view("manage_".$PostData['part_type']."_content_view","",true);
					} catch (Exception $e) {
						$return['code'] = 500;
						$return['message'] = $e->getMessage();
					}
				} else {
					$return['code'] = 0;
					$return['message'] = "Invalid request type.";
				}
			} else {
				$return['code'] = 0;
				$return['message'] = "Session expired or not logged in.";
			}
		} else {
			redirect("home");
		}

		echo json_encode($return);
	}

}

/* End of file manage.php */
/* Location: ./application/controllers/manage.php */