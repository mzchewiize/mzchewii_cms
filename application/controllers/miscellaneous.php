<?php
@session_start(); 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Miscellaneous extends CI_Controller {

    var $css = array(
        'webroot/css/my_style.css',
        'webroot/css/bootstrap-theme.min.css',
        'webroot/css/multiple-select.css',
        'webroot/css/jquery-ui.css',
        'webroot/css/bootstrap.min.css',
        'webroot/css/bootstrap-wysihtml5.css',
        'webroot/css/wysiwyg-color.css',
        'webroot/css/flags.css',
          'webroot/css/bootstrap-markdown.min.css'
    );
    
    var $jscript = array(
        'webroot/js/wysihtml5-0.3.0.js',
        'webroot/js/jquery-1.7.2.min.js',
        'webroot/js/prettify.js',
        'webroot/js/bootstrap.min.js',
        'webroot/js/bootstrap-wysihtml5.js',
        'webroot/js/jquery.flagstrap.js',
       'webroot/js/jquery.validate.js',
       'webroot/js/bootstrap-markdown.js'
    );

    var $admin_data = array();

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper(array('form', 'url','util'));
        $this->load->model('admin_model');
        // $is_loggin = $this->is_logged();
        $this->admin_data = $this->session->userdata('admin');
    }

    public function index($error = '') {
        print_r($_SESSION);
        echo "<br>";
        print_r($this->session->userdata('admin'));
    }

    
    function inbox()
    {
        $header['css'] = $this->css;
        $header['jscript'] = $this->jscript;
        $header['header_user'] = $this->admin_data;
        
        $data['message'] = $this->admin_model->get_where_data(array('property_code' => $this->admin_data[0]['property_code']),'inbox');
        
        $this->load->view('template/header', $header);
        $this->load->view('inbox', $data);
        $this->load->view('template/footer');
    }
    
    function set_read_msg()
    {
        $a_set_data = array(
            'status' => '1' ,
            'datetime_update' => date("Y-m-d H:i:s")
        );
        $update_data = $this->admin_model->Update_data($a_set_data, 'inbox', array('property_code'=>$this->admin_data[0]['property_code'],'inbox_id'=>$this->input->get('inbox_id')));
    }

    function set_delete_msg()
    {
        $a_set_data = array(
            'status' => '2' ,
        );
        $update_data = $this->admin_model->Update_data($a_set_data, 'inbox', array('property_code'=>$this->admin_data[0]['property_code'],'inbox_id'=>$this->input->get('inbox_id')));
    }

    function submit_new_msg()
    {
        $detail = $this->input->get('msg_detail');
     
        $a_set_data = array(
            'property_code' => $this->admin_data[0]['property_code'],
            'inbox_title' => $this->input->post('msg_subject'),
            'inbox_detail' => $this->input->post('msg_detail'),
            'status' => '1',
            'type' => 'send' ,
            'datetime_update' => date("Y-m-d H:i:s")
        );

        $this->admin_model->insert_data($a_set_data, 'inbox');

        echo "<script>
            alert('Your message has been create');
            window.location.href='inbox';
        </script>";
    }


    // function ajax_inbox($type)
    // {
    //     $content = $this->admin_model->where_cause(array(
    //             'property_code'=>$this->admin_data[0]['property_code'],
    //             'type'=>$type
    //         ),
    //     'datetime_update','inbox',FALSE, FALSE);
        
    //     $data['content'] = $content;
    //     $this->load->view('ajax/ajax_inbox',$data);
    // }

    // function read_inbox()
    // {
    //     $inbox_id = $this->input->get('inbox_id');
    //     $a_set_data = array(
    //         'status' => '1' ,
    //     );
    //     $update_data = $this->admin_model->Update_data($a_set_data, 'inbox', array(
    //                 'property_code'=>$this->admin_data[0]['property_code'],
    //                 'inbox_id'=>$inbox_id
    //             )
    //         );
    // }
    
    // function submit_write_mail()
    // {
    //     $title = $this->input->get('title');
    //     $detail = $this->input->get('detail');
    //     $a_set_data = array(
    //         'property_code' => $this->admin_data[0]['property_code'] ,
    //         'inbox_title' => $title ,
    //         'inbox_detail' => $detail ,
    //         'status' => '1' ,
    //         'type' => 'send' ,
    //         'datetime_update' => date("Y-m-d H:i:s")
    //     );

    //     $update_data = $this->admin_model->insert_data($a_set_data, 'inbox');
    // }

    function policy()
    {
        if(!$this->session->userdata('admin'))
		{
			 return redirect('main/login');
		}
		else
		{
			$header['css'] = $this->css;
			array_push($this->jscript,'webroot/js/ckeditor/ckeditor.js');
			$header['jscript'] = $this->jscript;
			$header['header_user'] = $this->admin_data;

			$content_policy = $this->admin_model->get_data_id('property_code',$this->admin_data[0]['property_code'],'policy');
			$content_rule = $this->admin_model->get_data_id('property_code',$this->admin_data[0]['property_code'],'rules');
			$data['policy'] = $content_policy;
			$data['rule'] = $content_rule;
			$this->load->view('template/header', $header);
			$this->load->view('policy',$data);
			$this->load->view('template/footer');
		}
    }

    function submit_policy()
    {
        $content_policy = $this->input->post('content_policy');
        $a_set_data = array(
            'policy_detail' => $content_policy ,
            'datetime_update' => date("Y-m-d H:i:s")
        );
        $update_data = $this->admin_model->Update_data($a_set_data, 'policy', array(
                'property_code'=>$this->admin_data[0]['property_code']
                )
        );
        redirect('miscellaneous/policy');
    }

    function submit_rule()
    {
        $rules_detail = $this->input->post('rules_detail');
        $a_set_data = array(
            'rules_detail' => $rules_detail ,
            'datetime_update' => date("Y-m-d H:i:s")
        );
        $update_data = $this->admin_model->Update_data($a_set_data, 'rules', array(
            'property_code'=>$this->admin_data[0]['property_code']
            )
        );
        redirect('miscellaneous/policy');
    }

    function setting()
    {
       if(!$this->session->userdata('admin'))
		{
			 return redirect('main/login');
		}
		else
		{
			$header['css'] = $this->css;
			array_push($this->jscript,'webroot/js/ckeditor/ckeditor.js');
			$header['jscript'] = $this->jscript;
			$header['header_user'] = $this->admin_data;
            $data['currency'] = $this->admin_model->get_where_data(array(),'currency');
			$content_policy = $this->admin_model->get_data_id('property_code',$this->admin_data[0]['property_code'],'policy');
			$content_rule = $this->admin_model->get_data_id('property_code',$this->admin_data[0]['property_code'],'rules');
			$data['policy'] = $content_policy;
			$data['rule'] = $content_rule;
            $data['currency_selected'] = $this->admin_model->get_data_id('property_code',$this->admin_data[0]['property_code'],'accomodation_information');
			$this->load->view('template/header', $header);
			$this->load->view('setting',$data);
			$this->load->view('template/footer');
		}		
    }

    function validateUser()
    {
        $current_password = $this->input->GET('current_password');
        $header['header_user'] = $this->admin_data;
        $isUserExist = $this->admin_model->get_where_data(array('password' => md5($current_password)),'user_profile');
        if(!(empty($isUserExist)))
        {
            $match = 1;
        }
        else
        {
            $match = 0;
        }
        echo json_encode(array('password_match' => $match));
    }

    function update_password()
    {
        $new_password = $this->input->GET('new_password');

         $a_set_data = array(
                    'password' => md5($new_password)               
                );

        $update_data = $this->admin_model->Update_data($a_set_data, 'user_profile', 
                        array(
                            'property_code'=>$this->admin_data[0]['property_code'],  
                        )
                    );
		redirect('miscellaneous/setting');
    }

    function update_currency()
    {
         $currency = $this->input->GET('currency');

         $a_set_data = array(
            'currency_code' => $currency            
        );

        $update_data = $this->admin_model->Update_data($a_set_data, 'accomodation_information', 
            array(
                'property_code'=>$this->admin_data[0]['property_code'],  
            )
        );

        redirect('miscellaneous/setting');
    }
}