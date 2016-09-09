<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

	}

	public function index()
        {
            echo "test";
            $this->load->model('test_model');
            $data['getdata'] = $this->test_model->loaddata("car_problems");
            $data['partname'] = $this->test_model->loadpartName("part_types");
            if ($data['getdata'] && $data['partname']) {
                $data['hi'] = "Yeah";
                $data['hay'] = "It has data back na";
            }
            else{
                $data['hi'] = "hi";
                $data['hay'] = "How are u DTB";
            }
            $this->load->view("test",$data);
            
        }
}