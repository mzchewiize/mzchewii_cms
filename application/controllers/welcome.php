<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
 	 public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));
        $this->load->model('admin_model');
        // $is_loggin = $this->is_logged();
        $this->admin_data = $this->session->userdata('admin');
    }

	public function index()
	{
		redirect('mainpage');
	}



}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */