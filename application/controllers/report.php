<?php
@session_start(); 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Report extends CI_Controller {

    var $css = array(
    	'webroot/css/my_style.css',
    	'webroot/css/bootstrap-theme.min.css',
    	'webroot/css/multiple-select.css',
    	'webroot/css/jquery-ui.css',
    	'webroot/css/bootstrap.min.css',
    	'webroot/css/bootstrap-wysihtml5.css',
    	'webroot/css/wysiwyg-color.css',
    	'webroot/css/flags.css',
    	'webroot/css/bootstrap-tagsinput.css',
        'webroot/css/datepicker.css'
    );
    
    var $jscript = array(
    	'webroot/js/wysihtml5-0.3.0.js',
    	'webroot/js/jquery-1.7.2.min.js',
    	'webroot/js/prettify.js',
    	'webroot/js/bootstrap.min.js',
    	'webroot/js/bootstrap-wysihtml5.js',
    	'webroot/js/jquery.flagstrap.js',
    	'webroot/js/bootstrap-tagsinput.min.js',
        'webroot/js/bootstrap-datepicker.js'
    );

	var $admin_data = array();

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper(array('form', 'url','util'));
        $this->load->model('admin_model');
        $this->admin_data = $this->session->userdata('admin');

    }

    public function index($error = '') {
		print_r($_SESSION);
		echo "<br>";
		print_r($this->session->userdata('admin'));
    }

   	function self_report()
   	{

        $header['css'] = $this->css;
        $header['jscript'] = $this->jscript;
        $header['header_user'] = $this->admin_data;
    

        if($this->input->post()!="")
        {
            $room_infomation =  $this->admin_model->get_where_data(array('room_code' => $this->input->post('room_code')),'accomodation');
            $room_allotement = $room_infomation[0]['allotment'];
            $output = $this->admin_model->sum_booking($this->input->post('from_date'),$this->input->post('room_code'));
            
            $booked = count($output);
            $available = $room_allotement - $booked;

            $data = array(
                'room_type' => $room_infomation[0]['title_name'],
                'allotment' => $room_allotement,
                'booked' => $booked,
                'available' => $available,
                'on_date' => $this->input->post('from_date')
            );

          
        }

        $data['type'] = $this->admin_model->distinct_room_type($this->admin_data[0]['property_code']);
        $data['room'] =  $this->admin_model->get_where_data(array('property_code' => $this->admin_data[0]['property_code']),'accomodation');
        $data['book_reccord'] = $this->admin_model->get_where_data(array('property_code' => $this->admin_data[0]['property_code']),'accomodation_myguest');
      
        $this->load->view('template/header', $header);
        $this->load->view('self_report',$data);
        $this->load->view('template/footer');
   	}



}