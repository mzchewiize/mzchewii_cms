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
        // $is_loggin = $this->is_logged();
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
			'webroot/js/easyslider/easySlider1.7.js');
        
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
        		if($auth[0]['user_group'] == 5)
        		{
        			$this->session->set_userdata('admin', $auth);
    				return redirect('wizcationadmin/amenities');
        		}
                else if( in_array($auth[0]['user_group'], array('2','3','4')))
                {
                    $this->session->set_userdata('partner', $auth);
                    return redirect('wizcationpartner/main_content');
                }

        		if($auth[0]['user_verify'] == 1)
        		{
        			$this->session->set_userdata('admin', $auth);

       				$a_set_data = array('last_login' => date('Y-m-d H:i:s'));
        			$update_data = $this->admin_model->Update_data($a_set_data, 'user_profile', array('property_code'=>$auth[0]['property_code']));

    				return redirect('main/overview');
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

        $data['info'] = "Wizcation Portal management : ADMIN";
		$this->load->view('template/header', $header);
		$this->load->view('login' , $data);
		$this->load->view('template/footer');
    }


    function logout() 
    {
        $this->session->unset_userdata('admin');
        return redirect('main/login');
    }

    function register()
    {
		$content_cat = array();
		array_push($this->css,'webroot/css/easyslider/screen.css');
		$header['css'] = $this->css;

		array_push($this->jscript,
			'webroot/js/jssor.js',
			'webroot/js/jssor.slider.js',
			'webroot/js/google_map_overview.js',
			'webroot/js/easyslider/easySlider1.7.js');
        
        $header['jscript'] = $this->jscript;
        $header['header_user'] = $this->admin_data;
        $user_group = $this->admin_model->get_where_data(array(),'user_group');
        $data['user_group'] = $user_group;
     	$data['info'] = "Wizcation Portal management : ADMIN";
		$this->load->view('template/header', $header);
		$this->load->view('register' , $data);
		$this->load->view('template/footer');
    }

    function submitRegister()
    {

    	$content_cat = array();
		array_push($this->css,'webroot/css/easyslider/screen.css');
		$header['css'] = $this->css;

		array_push($this->jscript,
			'webroot/js/jssor.js',
			'webroot/js/jssor.slider.js',
			'webroot/js/google_map_overview.js',
			'webroot/js/easyslider/easySlider1.7.js');
        
        $header['jscript'] = $this->jscript;
        $header['header_user'] = $this->admin_data;
        $useExits = $this->admin_model->get_data_id('email',$this->input->post('email'),'user_profile');
        if(empty($useExits))
        {
            $password_text = generateRandomString();
            $password = md5($password_text);
            $property_code = rand(5,22);
             $a_set_data = array(
                'property_code'=> $property_code,
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'user_group' => $this->input->post('user_group'),
                'login_name' => $this->input->post('email'),
                'email' => $this->input->post('email'),
                'mobile' => $this->input->post('mobile'),
                'datetime_update' => date("Y-m-d H:i:s")
            );
            
            $update_data = $this->admin_model->insert_data($a_set_data, 'user_profile');

            /*
            @send email welcome new partner register 
            */
                if($update_data)
                {   
                    $main_subject = 'Welcome to Wizcation.com';
                    $second_subject = 'Thank you for your registered';
                    $sendto = $this->input->post('email');
                    $body = "Hello , here is your register information <br/>";
                    $body.= "You can access to partner dashboard after verify this account<br/>";
                    $body.= "
                    <a href='http://wizcation.com/index.php/wizcationadmin/partner_verify?property_code=".$property_code."'>you can verify account by click this link </a><br/>";
                    $callback_url = 'wizcationadmin/partner';
                    
                    try
                    {
                        $sendmail = sendMail($main_subject, $second_subject, $sendto, $body, $callback_url);       
                        if($sendmail)
                        {
                               echo "<script>
                                alert('Register completed');
                                window.location.href='index.php/login';
                            </script>";       
                        } else {
                                 echo "<script>
                                alert('Register failed');
                                window.location.href='index.php/login';
                            </script>";  
                        }

                    } catch (Exception $e) {
                         echo 'Caught exceception'.$e->getMessage();
                    }
                }
            }

          	else
          	{
          		$data['status'] = 'Email is duplicatate';
          	}

  		$user_group = $this->admin_model->get_where_data(array(),'user_group');
        $data['user_group'] = $user_group;
     
		$this->load->view('template/header', $header);
		$this->load->view('register' , $data);
		$this->load->view('template/footer');
    }

	function overview()
	{
		if(!$this->session->userdata('admin'))
		{
			 return redirect('main/login');
		}
		else
		{
			$content_cat = array();
			array_push($this->css,'webroot/css/easyslider/screen.css');
			$header['css'] = $this->css;
			array_push($this->jscript,
				'webroot/js/jssor.js',
				'webroot/js/jssor.slider.js',
				'webroot/js/google_map_overview.js',
				'webroot/js/easyslider/easySlider1.7.js',
				'webroot/js/shCore.js',
				'webroot/js/shBrushXml.js',
				'webroot/js/shBrushJScript.js',
				'webroot/js/jquery.easing.js',
				'webroot/js/jquery.mousewheel.js',
				'webroot/js/demo.js',
				'webroot/js/jquery.flexslider.js'
			);
			$header['jscript'] = $this->jscript;
			$header['header_user'] = $this->admin_data;
			$data['facilities'] = $this->admin_model->get_where_data(array(),'category');
			$data['catergory_selected'] = @$this->admin_model->get_where_data(array('property_code'=>$this->admin_data[0]['property_code']),'item_category');
			
			$data['content'] = $this->admin_model->get_data_id('property_code',$this->admin_data[0]['property_code'],'accomodation_information');
		    $data['item_info'] = $this->admin_model->get_where_data(array('item_id' => 5),'item_info');
			$data['description'] = $this->admin_model->get_data_id('property_code',$this->admin_data[0]['property_code'],'description');;
			$data['image'] =  $this->admin_model->get_where_data(array('ref_code' => @$data['content'][0]['ref_code']), 'item_image');
           
			$data['service'] = $this->admin_model->get_where_data(array('property_code' =>$this->admin_data[0]['property_code']),'service');
			$data['term_policy'] = $this->admin_model->get_where_data(array('property_code' =>$this->admin_data[0]['property_code']),'term_policy');
			$data['policy'] = $this->admin_model->get_data_id('property_code',$this->admin_data[0]['property_code'],'policy');
	
		

			$this->load->view('template/header', $header);
			$this->load->view('overview',$data);
			$this->load->view('template/footer');
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
