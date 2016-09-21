<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Edit_profile_model extends CI_Model {
	
	public function __construct() {
		parent::__construct ();
		$this->load->database ( 'default' );
	}
	
	public function getProfileInfo($sd_id) {
		$select = "*";
		$conds = array (
				"sd_id" => $sd_id 
		);
		$table = "service_dealer";
		return $this->db->select ( $select )->where ( $conds )->get ( $table )->row_array ();
	}
	
	public function getRegion() {
		$select = "DISTINCT(region_name_th),region_name_eng,region_code";
		return $this->db->select ( $select )->get ( "province" )->result_array ();
	}
	
	public function updatedealer($UpdateData, $id, $table) {
		
		$this->db->where ( 'sd_id', $id );
		
		if ($this->db->update ( $table, $UpdateData )) {
			return true;
		} else {
			return false;
		}
	}
	
	public function getUser($username) {
		return $this->db->query ( "select * from user_auth where username='" . $username . "'" );
	}
	
	public function updateUserPwd($fixed_pw, $db_id) {
		return $this->db->query ( "Update user_auth SET password='" . $fixed_pw . "' WHERE id=$db_id" ) or die ( mysql_error () );
	}
}

/* End of file admin_model.php */
/* Location: ./application/models/admin_model.php */