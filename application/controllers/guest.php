<?php
@session_start(); 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Guest extends CI_Controller {

    var $css = array(
        'webroot/css/my_style.css',
        'webroot/css/bootstrap-theme.min.css',
        'webroot/css/multiple-select.css',
        'webroot/css/jquery-ui.css',
        'webroot/css/bootstrap.min.css',
        'webroot/css/bootstrap-wysihtml5.css',
        'webroot/css/wysiwyg-color.css',
        'webroot/css/flags.css',
        'webroot/css/jquery.jqplot.min.css',
        'webroot/syntaxhighlighter/styles/shCoreDefault.min.css',
        'webroot/syntaxhighlighter/styles/shThemejqPlot.min.css'
  
    );
    
    var $jscript = array(
 
        'webroot/js/wysihtml5-0.3.0.js',
        'webroot/js/jquery-1.9.0.min.js',
        'webroot/js/prettify.js',
        'webroot/js/bootstrap.min.js',
        'webroot/js/bootstrap-wysihtml5.js',
        'webroot/js/jquery.flagstrap.js',
        'webroot/js/jquery.jqplot.min.js',
        'webroot/syntaxhighlighter/scripts/shCore.min.js',
        'webroot/syntaxhighlighter/scripts/shBrushJScript.min.js',
        'webroot/syntaxhighlighter/scripts/shBrushXml.min.js',
        'webroot/js/jqplot.barRenderer.min.js'
        

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


    function transaction()
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
          
            $book_date = $this->admin_model->getbookdate($this->admin_data[0]['property_code']);
            
  
			
            $data['booking'] = $this->admin_model->get_where_data(array('property_code' => $this->admin_data[0]['property_code']),'accomodation_myguest');
			$this->load->view('template/header', $header);
			$this->load->view('guest',$data);
			$this->load->view('template/footer');
		}
    }
  
}