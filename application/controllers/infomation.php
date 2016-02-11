<?php
@session_start(); 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Infomation extends CI_Controller {

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
        'webroot/js/jquery.flagstrap.js'
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
    function description()
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

			$language = $this->admin_model->where_cause(array(
				'language_display'=>0),FALSE,'language',FALSE, FALSE);
			$content = $this->admin_model->where_cause(array(
				'property_code'=>$this->admin_data[0]['property_code']),
			'datetime_update','description',FALSE, FALSE);
			
			for($i=0;$i<count($content);$i++)
			{
				$language_data = $this->admin_model->get_data_id('language_id',$content[$i]['lang'],'language');
				$content[$i]['lang_data'] = $language_data[0];
			}
			
			$data['content'] = $content;
			$data['language'] = $language;

			$this->load->view('template/header', $header);
			$this->load->view('description',$data);
			$this->load->view('template/footer');
		}
    }

    function submit_description()
    {
        $all_group = $this->input->post('all_group');// print_r($_POST);
        for($i=0;$i<=$all_group;$i++)
        {
             $title = $this->input->post('title_'.$i);
             
             if(!empty($title))
             {
                $lang_code = $this->input->post('lang_code_'.$i);
                $long_description = $this->input->post('long_description_'.$i);
                $rule_description = $this->input->post('rule_description_'.$i);
                
                $item = $this->admin_model->chk_data_count(
                    array(
                        'property_code'=>$this->admin_data[0]['property_code'],
                        'lang'=>$lang_code), 
                        'description'
                    );
                
                $a_set_data = array(
                    'property_code' => $this->admin_data[0]['property_code'] ,
                    'description_title' => $title ,
                    'description_detail' => $long_description ,
                    'description_rule' => $rule_description ,
                    'lang' => $lang_code ,
                    'datetime_update' => date("Y-m-d H:i:s")
                );
                
                if($item>=1)
                {
                    $update_data = $this->admin_model->Update_data($a_set_data, 'description', 
                        array(
                            'property_code'=>$this->admin_data[0]['property_code'],
                            'lang'=>$lang_code
                        )
                    );
                }
                else
                {
                    $add_data = $this->admin_model->insert_data($a_set_data, 'description');
                }
             }
        }
        redirect('infomation/description');
    }

    function ajax_description()
    {
        $next_number = $this->input->get('next_number');
        $language_id = $this->input->get('language_id');
        $language_data = $this->admin_model->get_data_id('language_id',$language_id,'language');
        $data['language'] = $language_data[0];
        $data['number'] = $next_number;
        $this->load->view('ajax/add_more_description',$data);
    }
    
    function description_confirm_delete()
    {
        $language_id = $this->input->get('language_id');
        $item = $this->admin_model->chk_data_count(
            array(
                'property_code'=>$this->admin_data[0]['property_code'],
                'lang'=>$language_id
            ), 
            'description'
        );
        
        if($item>=1)
        {
            $this->admin_model->delete_data(
                array(
                    'property_code'=>$this->admin_data[0]['property_code'],
                    'lang'=>$language_id
                ),
                'description'
            );
        }
    }
}