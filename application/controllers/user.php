<?php
@session_start(); 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller {

    var $css = array(
        'webroot/css/my_style.css',
        'webroot/css/bootstrap-theme.min.css',
        'webroot/css/multiple-select.css',
        'webroot/css/jquery-ui.css',
        'webroot/css/bootstrap.min.css',
        'webroot/css/bootstrap-wysihtml5.css',
        'webroot/css/wysiwyg-color.css',
        'webroot/css/flags.css'
    );
    
    var $jscript = array(
        'webroot/js/wysihtml5-0.3.0.js',
        'webroot/js/jquery-1.7.2.min.js',
        'webroot/js/prettify.js',
        'webroot/js/bootstrap.min.js',
        'webroot/js/bootstrap-wysihtml5.js',
        'webroot/js/jquery.flagstrap.js',
        'webroot/js/jquery.validate.js'
    );

    var $admin_data = array();

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));
        $this->load->model('admin_model');
        // $is_loggin = $this->is_logged();
        $this->admin_data = $this->session->userdata('admin');
    }

    public function index($error = '') {
        print_r($_SESSION);
        echo "<br>";
        print_r($this->session->userdata('admin'));
    }

    function profile()
    {
        if(!$this->session->userdata('admin'))
		{
			 return redirect('main/login');
		}
		else
		{
			$header['css'] = $this->css;
			$header['jscript'] = $this->jscript;
			$header['header_user'] = $this->admin_data;

			$user_data = $this->admin_model->get_data_id('property_code',$this->admin_data[0]['property_code'],'user_profile');
			$country = $this->admin_model->get_where_data(array(),'country');

            $partner_province = $this->admin_model->get_where_data(array(),'province');
            

			$data['partner_province'] = $partner_province;
            $data['user_data'] = $user_data;
			$data['country'] = $country;
			$this->load->view('template/header', $header);
			$this->load->view('profile',$data);
			$this->load->view('template/footer');
		}	
    }

    function profile_api()
    {
        if(!$this->session->userdata('admin'))
        {
             return redirect('main/login');
        }
        else
        {
            $header['css'] = $this->css;
            $header['jscript'] = $this->jscript;
            $header['header_user'] = $this->admin_data;

            $user_data = $this->admin_model->get_data_id('property_code',$this->admin_data[0]['property_code'],'user_profile');
            $country = $this->admin_model->get_where_data(array(),'country');

            $partner_province = $this->admin_model->get_where_data(array(),'province');
            
            header('Content-Type: application/json');
            echo json_encode($user_data);

        
        }   
    }

    function submit_profile()
    {
        $first_name = $this->input->post('first_name');
        $last_name = $this->input->post('last_name');
        $email = $this->input->post('email');
        $nationality = $this->input->post('nationality');
        $country_id = $this->input->post('country_id');
        $backup_email = $this->input->post('backup_email');
        $mobile = $this->input->post('mobile');
        $address = $this->input->post('address');
        $city = $this->input->post('city');
        $province = $this->input->post('province');
        $postcode = $this->input->post('postcode');
        $external_number = $this->input->post('external_number');
        $a_set_data = array(
            'first_name' => $first_name ,
            'last_name' => $last_name ,
            'nationality' => $nationality ,
            'country_id' => $country_id ,
            'backup_email' => $backup_email ,
            'mobile' => $mobile ,
            'address' => $address ,
            'city' => $city ,
            'province' => $province ,
            'postcode' => $postcode ,
            'external_number' => $external_number ,
            'datetime_update' => date("Y-m-d H:i:s")
        );
        
        $update_data = $this->admin_model->Update_data($a_set_data, 'user_profile', 
            array(
                'property_code'=>$this->admin_data[0]['property_code']
            )
        );
        redirect('user/profile');
    }

}