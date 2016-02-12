<?php
@session_start(); 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Malongyeradmin extends CI_Controller {
    var $css = array(
        'webroot/css/my_style.css',
        'webroot/css/bootstrap-theme.min.css',
        'webroot/css/multiple-select.css',
        'webroot/css/jquery-ui.css',
        'webroot/css/bootstrap.min.css',
        'webroot/css/bootstrap-wysihtml5.css',
        'webroot/css/wysiwyg-color.css',
        'webroot/css/flags.css',
        'webroot/css/flexslider.css',
        'webroot/css/timeline.css',
        'webroot/css/sb-admin-2.css',
        'webroot/css/metisMenu.css',
        'webroot/css/pnotify.custom.css',
        'webroot/css/fine-uploader.css',
        'webroot/css/fine-uploader.min.css',
        'webroot/css/fine-uploader-new.css',
        'webroot/css/fine-uploader-gallery.css',
        'webroot/fonts/font-awesome.css',
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
        'webroot/js/sb-admin-2.js',
        'webroot/js/metisMenu.js',
        'webroot/js/pnotify.custom.js',
        'webroot/js/bootstrap-wysiwyg.js',
        'webroot/js/bootstrap-markdown.js',
        'webroot/js/jquery.highlight.js',
        'webroot/js/iframe.xss.response.js',
      //  'webroot/js/fine-uploader.js',
        'webroot/js/fine-uploader.min.js'
        
    );

    var $admin_data = array();

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper(array('form', 'url','util'));
        $this->load->model('admin_model');
        $this->admin_data = $this->session->userdata('partner');
    }

    public function index($error = '') 
    {
        print_r($_SESSION);
        if(!$this->session->userdata('partner'))
        {
             return redirect('main/login');
        }
    }

    function main_content()
    {
        if(!$this->session->userdata('partner'))
        {
             return redirect('main/login');
        }
        else
        {
            $header['css'] = $this->css;
            $header['jscript'] = $this->jscript;
            $header['header_user'] = $this->admin_data;
            $data['partner_content'] =  $this->admin_model->get_where_data(array(),'item_type');
            
            $this->load->view('template/header', $header);
            $this->load->view('partner/partner_content',$data);
            $this->load->view('template/footer');
        }
    }

    function add_item_new()
    {
        $add_new_item = array('item_name' => $this->input->get('pcode_value'));
        $this->admin_model->insert_data($add_new_item, $this->input->get('table'));
        redirect("malongyeradmin/".$this->input->get('reload_page'));
    }

    function add_photo_album()
    {
        $album_id = $this->uri->segment(3);

        $header['css'] = $this->css;
        $header['jscript'] = $this->jscript;
        $header['header_user'] = $this->admin_data;

        $data['photos'] = $this->admin_model->get_where_data(array('ref_code' => $album_id),'item_image');

        $this->load->view('template/header', $header);
        $this->load->view('partner/partner_content_add', @$data);
        $this->load->view('template/footer');
    }

    function set_catergories()
    {
       $this->admin_model->Update_data(array(
            'catergories'=> $this->input->GET('catergories')
            ),
       'item_image', 
       array(
        'ref_code' => $this->input->GET('item_id')
        ));
    }

    function submit_removed_content()
    {
         $this->admin_model->delete_data(array('id' => $this->input->get('id')), 'item_image');
    }
}