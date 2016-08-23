<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database('default');
	}
        public function loaddata($querystr)
	{
//		return $this->db->select('*')->where($querystr)->get('car_problems')->row_array();
                return $this->db->select('*')->get($querystr)->result_array();
	}
        
        public function loadpartName($querystr)
	{
//		return $this->db->select('*')->where($querystr)->get('car_problems')->row_array();
                return $this->db->select('*')->get($querystr)->result_array();
	}

}