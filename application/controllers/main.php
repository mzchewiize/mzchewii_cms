<?php
@session_start(); 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Main extends CI_Controller {
    var $css = array(
    	'webroot/css/my_style.css',
    	'webroot/css/bootstrap-theme.min.css',
    	'webroot/css/multiple-select.css',
    	'webroot/css/jquery-ui.css',
    	'webroot/css/bootstrap.min.css',
    	'webroot/css/bootstrap-wysihtml5.css',
    	'webroot/css/wysiwyg-color.css',
    	'webroot/css/flags.css',
    	'webroot/css/flexslider.css'

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
        $this->load->helper(array('form', 'url', 'util'));
        $this->load->model('admin_model');
        $this->admin_data = $this->session->userdata('admin');
    }

    public function index($error = '') 
	{
		if(!$this->session->userdata('admin'))
		{
			 return redirect('main/login');
		}
    }
   
    function login()
    {
		$content_cat = array();
		array_push($this->css,'webroot/css/easyslider/screen.css');
		$header['css'] = $this->css;

		array_push($this->jscript,
    			'webroot/js/jssor.js',
    			'webroot/js/jssor.slider.js',
    			'webroot/js/google_map_overview.js',
    			'webroot/js/easyslider/easySlider1.7.js'
            );
        
        $header['jscript'] = $this->jscript;
        $header['header_user'] = $this->admin_data;
        $post = $this->input->post();

        if($post)
        {
        	$auth = $this->admin_model->get_where_data(
        		array(
	        			'login_name' => $post['user_login'],
	        			'password' => md5($post['password']),
        			),
        		'user_profile'
        	);
        	
        	if($auth == true)
        	{
        		if($auth[0]['user_verify'] == 1 && in_array($auth[0]['user_group'], array('4')))
        		{
                    $this->session->set_userdata('partner', $auth);
                    $a_set_data = array('last_login' => date('Y-m-d H:i:s'));
                    $update_data = $this->admin_model->Update_data($a_set_data, 'user_profile', array('property_code'=>$auth[0]['property_code']));
                    return redirect('malongyeradmin/main_content');
        		}
        		else
        		{	
        			$data['danger'] = "User not verify or admin not approve";
        		}
        	}
        	else
        	{
        		$data['danger'] = "user not found / please contact administrator";
        	}
        }

        $data['info'] = "MALONGYER production";
		$this->load->view('template/header', $header);
		$this->load->view('login' , $data);
		$this->load->view('template/footer');
    }


    function logout() 
    {
        $this->session->unset_userdata('admin');
        return redirect('main/login');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
