<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Create_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database('default');
	}

	public function getproblems()
	{
		$select = 'id,'.lang('create_problems_column');
		$table = "car_problems";
		return $this->db->select($select)->get($table)->result_array();
	}

	public function getcarproblems($PostData)
	{
		$select = 'id,'.lang('create_problems_column');
		$conds = array(
			"part_id" => $PostData['part_id']
		);
		$table = "car_problems";
		return $this->db->select($select)->where($conds)->get($table)->result_array();
	}

	public function getsdinfo($sd_id)
	{
		$select = "name_th,name_eng,address,phone,fax, primary_phone";
		$conds = array(
			"sd_id" => $sd_id
		);
		$table = "service_dealer";
		return $this->db->select($select)->where($conds)->get($table)->row_array();
	}

	public function getdealers($maker_id,$sd_id)
	{
//		$select = "dealer_id,".lang("create_dealer_column");
//		$conds = array(
//			"maker_id" => $maker_id,
//			"sd_id" => $sd_id
//		);
//		$table = "dealer";
//		return $this->db->select($select)->where($conds)->get($table)->result_array();
                
                $this->db->select("dealer.dealer_id, dealer.".lang("create_dealer_column").", dealer.".lang("create_dealer_location"));
//                $this->db->select("dealer.dealer_id, dealer.name_th");        
                $this->db->join('dealer_relationship', 'dealer_relationship.dealer_id = dealer.dealer_id');
                $this->db->order_by('dealer.name_eng', 'asc');
                return $this->db->get_where('dealer', array(
                    'dealer_relationship.sd_id' => $sd_id,
                    'dealer.maker_id'           => $maker_id
                ))->result_array();
	}

	public function create($PostData,$table)
	{
		//BEGIN THE MANUAL ADDING OF THE DATA
        $this->db->trans_begin();

		$this->db->insert($table,$PostData);

		//ROLLBACK IF SOMETHING GOES WRONG
        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            return FALSE;
        }
        else
        {
            $this->db->trans_commit();
            return TRUE;
        }
	}

	public function getlast($table, $ros_prefix)
	{
		$result = $this->db->query("SELECT ros_no FROM $table WHERE ros_no LIKE '$ros_prefix%' ORDER BY id DESC LIMIT 1");

		if ($result->num_rows===1) {
			return $result->row()->ros_no;
		} else{
			return "DX-000-XX";
		}
	}

	public function getrosinfo($ros_no, $table)
	{
		$conds = array(
			"ros_no" => $ros_no,
			"created_by" => $this->session->userdata("sd_id")
		);
		return $this->db->where($conds)->get($table)->row_array();
	}

	public function update($PostData, $table)
	{
		//BEGIN THE MANUAL ADDING OF THE DATA
        $this->db->trans_begin();
        
        $conds = array(
                "ros_no" => $PostData['ros_no'],
                "created_by" => $this->session->userdata("sd_id")
        );

        $this->db->where($conds)->update($table,$PostData);

//		$conds = array(
//			"ros_no" => $PostData['ros_no']
//		);
//		
//		$this->db->update($table,$PostData);

		//ROLLBACK IF SOMETHING GOES WRONG
        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            return FALSE;
        }
        else
        {
            $this->db->trans_commit();
            return TRUE;
        }
	}

	public function deletedraft($ros_no)
	{
		$sd_id = $this->session->userdata("sd_id");
		$this->db->query("DELETE FROM ros_draft WHERE ros_no = '$ros_no' AND created_by = '$sd_id' LIMIT 1");
		return TRUE;
	}

	public function getcarmakers()
	{
		$select = "maker_id,".lang("create_car_maker_column");
		$table = "car_makers";
		return $this->db->select($select)->get($table)->result_array();
	}
        
        public function getLoginStatus($username){
                $this->db->select('user_role')->from('user_auth')->where('username',$username);

                $query = $this->db->get();

                if ($query->num_rows() > 0) {
                    return $query->row()->user_role;
                }
                return false;
        }
        
        public function getuserrole($admin)
	{       
                $this->db->select('role_id')->from('user_role')->where('name_eng',$admin);

                $query = $this->db->get();

                if ($query->num_rows() > 0) {
                    return $query->row()->role_id;
                }
                return false;
        }
        
        public function getAllAdress($sid){
                
                return $this->db->query("select address,phone,fax from service_dealer where sd_id='".$sid."'");
        
        }
        
        public function getservicedealers()
	{       
                $select= "sd_id,".lang("create_sd_name");
		$table = "service_dealer";
		return $this->db->select($select)->get($table)->result_array();
	}

	public function getcarmodels($PostData)
	{
		$table = $PostData['part_type']."_parts";
		$maker_id = $PostData['maker_id'];
		$query = "SELECT DISTINCT car_model FROM $table WHERE maker_id = '$maker_id'";

		return $this->db->query($query)->result_array();
	}

	public function getenginemodels($PostData)
	{
		$table = $PostData['part_type']."_parts";
		$maker_id = $PostData['maker_id'];
		$car_model = $PostData['car_model'];
		$query = "SELECT DISTINCT engine_model FROM $table WHERE maker_id = '$maker_id' AND car_model = '$car_model'";

		return $this->db->query($query)->result_array();
	}
        
    public function getfailuremodels($PostData)
	{
		$table = $PostData['part_type']."_parts";
		$maker_id = $PostData['maker_id'];
		$car_model = $PostData['car_model'];
                $engine_model = $PostData['engine_model'];
		$query = "SELECT DISTINCT car_maker_PN FROM $table WHERE maker_id = '$maker_id' AND car_model = '$car_model' AND engine_model = '$engine_model'";

		return $this->db->query($query)->result_array();
	}
        
    public function getexchangemodels($PostData)
	{
		$table = $PostData['part_type']."_parts";
		$maker_id = $PostData['maker_id'];
		$car_model = $PostData['car_model'];
        $engine_model = $PostData['engine_model'];
        $car_maker_PN = $PostData['car_maker_PN'];
		$query = "SELECT DISTINCT exchange_PN, part_code FROM $table WHERE maker_id = '$maker_id' AND car_model = '$car_model' AND engine_model = '$engine_model' AND car_maker_PN = '$car_maker_PN'";

		return $this->db->query($query)->result_array();
	}

	public function getwarranty($delivery_date,$maker_id)
	{
		$table = "warranty_condition";
		$select = "no_of_days, mileage";
		$delivery_date = date("Y-m-d",strtotime($delivery_date));
		$query = "SELECT $select FROM $table WHERE starting_date <= \"$delivery_date\" AND ending_date >= \"$delivery_date\" AND maker_id = \"$maker_id\" LIMIT 1";
		return $this->db->query($query)->row_array();
	}
        
	public function getdealerinfo($dealerid){
            $select = ("name_th, location_th, primary_phone, fax");
//	    $this->db->select(lang("create_dealer_column").',' . lang("create_dealer_location") .', primary_phone, fax');
            $this->db->select($select);
	    if($result = $this->db->get_where('dealer', array('dealer_id' => $dealerid)))
	        return $result->row_array();
	    else
	        return false;
	}

	public function getstatuslog($ros){
	    $this->db->select('status, created_time');
	    $this->db->where('ros_no', $ros);
	    return $this->db->get('status_log')->result_array();
	}

	public function getparttypes($sd_id)
	{
		$select = "part_id, ".lang("create_part_type_column").",table_prefix";
		$conds = array(
			"sd_id"
		);
		$query = "SELECT ".$select." FROM part_types
					  WHERE part_id IN(
						  SELECT part_id FROM sd_map_parts
						  WHERE sd_id = ?
					  )";
		return $this->db->query($query,array($sd_id))->result_array();
	}

	public function getpartnamebyid($part_id)
	{
		$result = $this->db->select(lang("create_part_type_column"))->where("part_id",$part_id)->get("part_types")->row_array();
		return $result[lang("create_part_type_column")];
	}
	public function allowedtoedit($sd_id,$ros_no,$table)
	{
		$conds = array(
			"created_by" => $sd_id,
			"ros_no" => $ros_no
		);
		$result = $this->db->select("ros_no")->where($conds)->get($table);

		return $result->num_rows() == 1?TRUE:FALSE;
	}

	public function getregions()
	{
		return $this->db->select("DISTINCT ".lang('create_region_column'), FALSE)->get("province")->result_array();
	}

	public function getprovinces()
	{
		return $this->db->select(lang('create_region_column').",".lang('create_province_column'))->get("province")->result_array();
	}

	public function getfilters($dealer_id)
	{
		$result = $this->db->select(lang('create_dealer_location'))->where("dealer_id",$dealer_id)->get("dealer")->row_array();
		return $result[lang('create_dealer_location')];
	}

}

/* End of file create_model.php */
/* Location: ./application/models/create_model.php */