<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Create extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
                $this->load->model('create_model');
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
			redirect('create?lang=en');
		}

		$this->lang->load('side',$lang);
		$this->lang->load('menu',$lang);
		$this->lang->load('create',$lang);

		$this->load->helper('language');
		$this->load->helper("email");

		$this->load->model('create_model');
	}

	public function index($type="",$ros_no="")
	{
        $Admin = 'ServiceAdmin';
        if ($this->input->is_ajax_request()) {
            if ($this->input->post()) {
                $PostData = $this->input->post();
                unset($PostData['dummy']);
                foreach ($PostData as $key => $value) {
                    if (!is_array($value)) {
                        $PostData[$key] = $PostData[$key]==""?null:$PostData[$key];
                    }
                }
                if(isset($PostData['delivery_date']))
                    $PostData['delivery_date'] = date("Y-m-d", strtotime($PostData['delivery_date']));
                if(isset($PostData['repair_date']))
                    $PostData['repair_date'] = date("Y-m-d", strtotime($PostData['repair_date']));
                $draft = $PostData['draft'];
                $action = $PostData['action'];
                unset($PostData['draft']);
                unset($PostData['action']);
                unset($PostData['maker_name']);
                // if (isset($PostData['maker_name'])) {
                // 	$maker_name = $PostData['maker_name'];
                // 	echo "UNSETTING IT";
                // }

                //Check car, fuel, parts other
                if(isset($PostData['car_condition']) AND $PostData['car_condition'] == 'original'){
                    $PostData['car_condition_other'] = '';
                }
                if(isset($PostData['fuel_condition']) AND $PostData['fuel_condition'] == 'normal'){
                    $PostData['fuel_condition_other'] = '';
                }
                if(isset($PostData['parts_condition']) AND $PostData['parts_condition'] == 'normal'){
                    $PostData['parts_condition_other'] = '';
                }
                if(isset($PostData['car_problem']) AND $PostData['car_problem'] != 10 AND $PostData['car_problem'] != 20 AND $PostData['car_problem'] != 31 AND $PostData['car_problem'] != 37){
                    $PostData['car_problem_other'] = '';
                }
                
                $PostData['created_time'] = date("Y-m-d H:i:s");

                switch ($draft) {
                    case 'true':
	                    if (isset($PostData['part_code'])) {
		                    unset($PostData['part_code']);
		                }
                        $table = "ros_draft";
                        $PostData['status'] = "Draft";
                        $ros_prefix = "DX";						//D for Draft and X for Don't care
                        $log_status = "Draft";
                    break;

                    case 'false':
                        $table = "ros_form";
                        $PostData['status'] = "Request";
                        if (isset($PostData['part_code'])) {
		                    $part_code = $PostData['part_code'];
		                    unset($PostData['part_code']);
		                } else{
		                	if($action == "add"){
			                	$return['code'] = 0;
			                	$return['message'] = "Part Code not found for the part specified.";
			                	goto end;
			                }
			                    $part_code = "NXX";
		                }
                        $log_status = "Request";
                        $ros_prefix = $part_code;
                        // $ros_prefix = substr($maker_name, 0,1).substr("INJECTOR", 0,1);
                        // TODO: PUT VALIDATION HERE....
                    break;
                    default:
                        goto error;
                    break;
                }

                switch ($action) {
                    case 'add':
                        if (isset($PostData['ros_no'])) {
                            $ros_no = $PostData['ros_no'];
                            $this->create_model->deletedraft($ros_no);
                        }
                        $last_ros_no = $this->create_model->getlast($table, $ros_prefix);
                        $runnin_number = explode("-", $last_ros_no);
                        $runnin_number = $runnin_number[1];
                        $runnin_number = sprintf("%03d",$runnin_number+1);
                        $PostData['ros_no'] = $ros_prefix."-".($runnin_number)."-".(date('y'));
                        $PostData['created_by'] = $this->session->userdata("sd_id");
                        $return['code'] = $this->create_model->create($PostData,$table)?1:0;
                        if ($return['code'] === 1 AND $draft === "false") {
                        	$sd_name = $this->session->userdata("full_name");
                        	$part_type = $this->create_model->getpartnamebyid($PostData['part_id']);
                            $to = "densoth.ros@gmail.com";
                            // $to = "yanksin@gmail.com";
                            $subject = "**[New IMV] New Request ROS No.".$PostData['ros_no']." has been added.";
					        $message = "A new request has been made in the ROS system.
					    				<br/>
					    				<b>Ros. No. ".$PostData['ros_no']."
					    				<br/>
					    				From SD Name: ".$sd_name."
					    				<br/>
					    				Part Type: ".$part_type."</b>
					    				<br/><br/>
					    				To view it, log in to the system".
					                    " at ".anchor(str_replace("densoIMV", "densoIMV_backend", base_url())."index.php/manage/ros/".$PostData['ros_no'],"this link")."";
					        $message = wordwrap($message, 70, "\r\n");
					        send_email($to,$subject,$message);
                        }
                        $log_ros_no = $PostData['ros_no'];
                        $return['ross'] = $PostData['ros_no'];
                    break;

                    case 'update':
                        $PostData['updated_time'] = date('Y-m-d H:i:s');
                        $ros_no = $PostData['ros_no'];
                        $return['code'] = $this->create_model->update($PostData,$table)?1:0;
                        $return['ross'] = $ros_no;
                        $log_ros_no = $ros_no;
                    break;

                    case 'cancel':
                        $PostData['updated_time'] = date('Y-m-d H:i:s');
                        $PostData['status'] = "Cancel";
                        $log_status = "Cancel";
                        $ros_no = $PostData['ros_no'];
                        $log_ros_no = $PostData['ros_no'];
                        $return['code'] = $this->create_model->update($PostData,$table)?1:0;
                        $return['ross'] = $ros_no;
                    break;
                    default:
                        goto error;
                    break;
                }
                trace_status($log_ros_no,$log_status);
                $return['message'] = "Data recieved";
            } else {
                error:
                $return['code'] = 0;
                $return['message'] = "No data sent";
            }
            end:
            echo json_encode($return);
        } else if($ros_no===""){
            // $data['problems'] = $this->create_model->getproblems();
            $data['sd_info'] = $this->create_model->getsdinfo($this->session->userdata('sd_id'));
            // check login status to have permission to change data
            $data['dealer_status'] = $this->create_model->getLoginStatus($this->session->userdata('username'));
            $data['user_role_admin'] = $this->create_model->getuserrole($Admin);
            // getservicedealers list
            $data['service_dealers'] = $this->create_model->getservicedealers();
            //
            $data['car_makers'] = $this->create_model->getcarmakers();
            $data['part_types'] = $this->create_model->getparttypes($this->session->userdata('sd_id'));
            $data['regions'] = $this->create_model->getregions();
            $data['provinces'] = $this->create_model->getprovinces();
            // $data['controller'] = "create";
            $this->load->view('header_view');
            // $this->load->view('menu_view',$data);
            $this->load->view('side_bar_view');
            $this->load->view('create_view',$data);
            $this->load->view('footer_view');
        } else {
        	if (!($this->create_model->allowedtoedit($this->session->userdata("sd_id"),$ros_no,"ros_draft"))) {
					redirect("home?message=".urlencode("Not allowed to edit the selected draft."));
					die();
				}
            // $data['problems'] = $this->create_model->getproblems();
            $data['sd_info'] = $this->create_model->getsdinfo($this->session->userdata('sd_id'));
            $data['car_makers'] = $this->create_model->getcarmakers();
            // check login status to have permission to change data
            $data['dealer_status'] = $this->create_model->getLoginStatus($this->session->userdata('username'));
            $data['user_role_admin'] = $this->create_model->getuserrole($Admin);
            // getservicedealers list
            $data['service_dealers'] = $this->create_model->getservicedealers();
            //
            // Get the part types for the SD.
            $data['part_types'] = $this->create_model->getparttypes($this->session->userdata('sd_id'));
            $data['regions'] = $this->create_model->getregions();
            $data['provinces'] = $this->create_model->getprovinces();
            $table=$type=="form"?"ros_form":"ros_draft";
            $data['ros_info'] = $this->create_model->getrosinfo($ros_no,$table);
            foreach ($data['ros_info'] as $key => $value) {
                if(!$value)
                    unset($data['ros_info'][$key]);
            }
            if(isset($data['ros_info']['delivery_date']))
                $data['ros_info']['delivery_date'] = date("d-m-Y", strtotime($data['ros_info']['delivery_date']));
            if(isset($data['ros_info']['repair_date']))
                $data['ros_info']['repair_date'] = date("d-m-Y", strtotime($data['ros_info']['repair_date']));
            unset($data['ros_info']['id']);
            unset($data['ros_info']['created_by']);
            unset($data['ros_info']['created_time']);
            unset($data['ros_info']['updated_time']);
            // $data['controller'] = "create";
            $this->load->view('header_view');
            // $this->load->view('menu_view',$data);
            $this->load->view('side_bar_view');
            $this->load->view('create_view',$data);
            $this->load->view('footer_view');
        }
	}

	public function page2()
	{
		// $data['controller'] = "create";
		$this->load->view('header_view');
		// $this->load->view('menu_view',$data);
		$this->load->view('side_bar_view');
		$this->load->view('create_two_view');
		$this->load->view('footer_view');
	}

	public function getdealers()
	{
		if ($this->input->is_ajax_request()) {
                        if ($this->session->userdata("logged_in")) {
				if ($this->input->post("maker_id")) {
	                $maker_id = $this->input->post("maker_id");
	                $dealers = $this->create_model->getdealers($maker_id,$this->session->userdata("sd_id"));
	                if (isset($dealers) && !empty($dealers)) {
	                    $return['code'] = 1;
	                    $return['message'] = "<option value='' selected>".lang('create_general_select')."</option>";
	                    $return['arrayObject'] = "[";
	                    foreach ($dealers as $key => $value) {
	                        $return['message'].="<option value='".$value['dealer_id']."'>".$value[lang("create_dealer_column")]."</option>";
	                        $return['arrayObject'].= "{\"value\":\"".$value['dealer_id']."\",\"label\":\"".$value[lang("create_dealer_column")]."\",\"class1\":\"".$value[lang("create_dealer_location")]."\",\"class2\":\"All\"},";
	                    }
	                    $return['arrayObject'] = trim($return['arrayObject'],",");
	                    $return['arrayObject'].= "]";
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
            redirect("home");
		}

		echo json_encode($return);
	}

	public function getcarmodels()
	{
		if ($this->input->is_ajax_request()) {
			if ($this->session->userdata("logged_in")) {
				if ($this->input->post("maker_id")) {
					$PostData = $this->input->post();
					$models = $this->create_model->getcarmodels($PostData);
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
			redirect("home");
		}

		echo json_encode($return);
	}

	public function getenginemodels()
	{
		if ($this->input->is_ajax_request()) {
			if ($this->session->userdata("logged_in")) {
				if ($this->input->post("maker_id")) {
					$PostData = $this->input->post();
					$models = $this->create_model->getenginemodels($PostData);
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
        
    public function getfailuremodels()
	{
		if ($this->input->is_ajax_request()) {
			if ($this->session->userdata("logged_in")) {
				if ($this->input->post("engine_model")) {
					$PostData = $this->input->post();
					$models = $this->create_model->getfailuremodels($PostData);
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
					$models = $this->create_model->getexchangemodels($PostData);
					if (!empty($models)) {
						$return['code'] = 200;
						foreach ($models as $key => $row) {
							$return['message']=$row['exchange_PN'];
							$return['part_code'] = $row['part_code'];
						}
					} else {
						$return['code'] = 0;
						$return['message'] = "No part code found!";	
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
						$warranty_conditions = $this->create_model->getwarranty($PostData['delivery_date'],$PostData['maker_id']);
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
					$this->create_model->deletedraft($PostData['ros_no']);
					$return['code'] = 1;
					$return['message'] = "Deleted successfully";
					$log_status = "Deleted";
					$log_ros_no = $PostData['ros_no'];
					trace_status($log_ros_no, $log_status);
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
        
    public function printform(){
        $this->load->model('create_model');
        
        $data['sd_info'] = $this->create_model->getsdinfo($this->session->userdata('sd_id'));
        if($this->input->get('dealer_id')){
            $data['dealer_info'] = $this->create_model->getdealerinfo($this->input->get('dealer_id'));
        }
        if($this->input->get('ros_no')){
            $statuslog = $this->create_model->getstatuslog($this->input->get('ros_no'));
            foreach ($statuslog as $key => $value) {
                $data[str_replace(' ', '', $value['status'])] = $value['created_time'];
            }
        }
        // for loading form of each part 
        // 1 & 2 pump and injector use same form (printform_view.php) ,
        // 3 for compressor(printform_compressor_view.php) and 
        // 4 for alternator(printform_alternator_view.php)
        $part_id = $this->input->get('part_id');
        if (intval($part_id) === 1 || intval($part_id) === 2) {
//            echo "Pump & Injector";
            $this->load->view('printform_view', $data);
        }
        else if (intval($part_id) === 3) {
//            echo "Compressor";
            $this->load->view('printform_compressor_view', $data);
        }
        else if (intval($part_id) === 4) {
//            echo "Alternator";
            $this->load->view('printform_alternator_view', $data);
        }
    }

    public function getcarproblems()
	{
		if ($this->input->is_ajax_request()) {
			if ($this->session->userdata("logged_in")) {
				if ($this->input->post("part_id")) {
					$PostData = $this->input->post();
					$problems = $this->create_model->getcarproblems($PostData);
					$return['code'] = 200;
					$return['message'] = "<option value=''>Select</option>";
					foreach ($problems as $key => $row) {
						$return['message'].="<option value='".$row['id']."'>".$row[lang('create_problems_column')]."</option>";
					}
					// $return['message'] = $problems;
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

	public function getfilters()
	{
		if ($this->input->is_ajax_request()) {
			if ($this->session->userdata("logged_in")) {
				if ($this->input->post("dealer_id")) {
					$PostData = $this->input->post();
					$province = $this->create_model->getfilters($PostData['dealer_id']);
					if ($province!="" && !empty($province)){
						$return['code'] = "1";
						$return['message'] = $province;
					} else{
						$return['code'] = 0;
						$return['message'] = "Possible front shop.";
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

	public function gettabs()
	{
		if ($this->input->is_ajax_request()) {
			if ($this->session->userdata("logged_in")) {
				if ($this->input->post("part_type")) {
					$PostData = $this->input->post();
					try {
						$return['tabs'] = $this->load->view($PostData['part_type']."_tabheading_view","",true);
						$return['code'] = 200;
						$return['tab_content'] = $this->load->view($PostData['part_type']."_content_view","",true);
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
        
        public function getAddress(){
            $sid= $this->input->post('sid');
            if($sid != ''){
                $this->session->set_userdata('sd_id',$sid);
            }
            $query = $this->create_model->getAllAdress($sid);
            foreach ($query->result_array() as $row)
            {
                $arr =  array(
                    'address'=> $row['address'],
                    'phone' => $row['phone'],
                    'fax' => $row['fax']
                );
                   
            }
            echo json_encode($arr);
        }
        
        public function getPartTypes(){
            $sid= $this->input->post('sid');
            $data = $this->create_model->getparttypes($sid);
            
            echo json_encode($data);
            
        }
}

/* End of file create.php */
/* Location: ./application/controllers/create.php */