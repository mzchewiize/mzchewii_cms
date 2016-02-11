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

    function content_add()
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
            if($this->admin_data[0]['user_group']==2)
            {
                $data['item_info'] = $this->admin_model->get_where_data(array('item_id' => 4),'item_info');
            }
            elseif($this->admin_data[0]['user_group']==3)
            {
                $data['item_info'] = $this->admin_model->get_where_data(array('item_id' => 6),'item_info');
            }
            elseif($this->admin_data[0]['user_group']==4)
            {
                $data['item_info'] = $this->admin_model->get_where_data(array('item_id' => 7),'item_info');     
           }
            
            $this->load->view('template/header', $header);
            $this->load->view('partner/partner_content_add',$data);
            $this->load->view('template/footer');
        }
    }

    function content_edit()
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
            $content_id = $this->uri->segment(3);

            $data['content'] = $this->admin_model->get_where_data(array('id' => $content_id),'partner_content');
            $data['item_info'] = $this->admin_model->get_where_data(array('item_id' => 4),'item_info');   
            
            // find related images
            $data['photos'] =  $this->admin_model->get_where_data(array('ref_code' => $data['content'][0]['ref_code']), 'item_image');
            

            $this->load->view('template/header', $header);
            $this->load->view('partner/partner_content_edit',$data);
            $this->load->view('template/footer');
        }

    }

    function submit_removed_content()
    {
         $this->admin_model->delete_data(array('id' => $this->input->get('id')), 'partner_content');
    }
    
    function submit_information()
    {
        $a_set_data = array(
            'content_subject' => $this->input->post('content_subject'),
            'content_hilight' => $this->input->post('content_hilight'),
            'content_detail' => $this->input->post('content_detail'),
            'content_address' => $this->input->post('content_address'),
            'content_price' => $this->input->post('content_price'),
            'content_discount' => $this->input->post('content_discount'),
            'property_code' => $this->admin_data[0]['property_code'],
            'content_price_discount' => $this->input->post('content_price_discount'),
            'content_website' => $this->input->post('content_website'),
            'content_status' => 0,
            'ref_code' => $this->input->post('ref_code'),
            'content_type' => $this->admin_data[0]['user_group'],
            'latitude_text' => '',
            'longitude_text' => '',
            'category' => json_encode($this->input->post('category')),
            'hashtag' => $this->input->post('hashtag'),
            'created' => date("Y-m-d H:i:s")
        );
        
        $update_data = $this->admin_model->insert_data($a_set_data, 'partner_content');
        if($update_data)
        {
             echo "<script>
                alert('You have been submit new content');
                window.location.href='main_content';
            </script>";
        }
    }

    function submit_update_content()
    {
         $a_set_data = array(
            'content_subject' => $this->input->post('content_subject'),
            'content_hilight' => $this->input->post('content_hilight'),
            'content_detail' => $this->input->post('content_detail'),
            'content_address' => $this->input->post('content_address'),
            'content_price' => $this->input->post('content_price'),
            'content_discount' => $this->input->post('content_discount'),
            'property_code' => $this->admin_data[0]['property_code'],
            'content_price_discount' => $this->input->post('content_price_discount'),
            'content_website' => $this->input->post('content_website'),
            'content_status' => 0,
            'ref_code' => $this->input->post('ref_code'),
            'content_type' => $this->admin_data[0]['user_group'],
            'latitude_text' => '',
            'longitude_text' => '',
            'category' => json_encode($this->input->post('category')),
            'hashtag' => $this->input->post('hashtag'),
            'created' => date("Y-m-d H:i:s")
        );

        $update_data = $this->admin_model->update_data($a_set_data, 'partner_content', array('ref_code' => $this->input->post('ref_code')));
        if($update_data)
        {
             echo "<script>
                alert('Content has been updated');
                window.location.href='main_content';
            </script>";
        }
    }

    function main_comment()
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
            $data['user_profile'] = $this->admin_model->get_where_data(array(),'user_profile');
            $this->load->view('template/header', $header);
            $this->load->view('partner/partner_comment',$data);
            $this->load->view('template/footer');
        }
    }

    function main_inbox()
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
            $data['message'] = $this->admin_model->get_where_data(array('property_code' => $this->admin_data[0]['property_code']),'inbox');
      
            $this->load->view('template/header', $header);
            $this->load->view('partner/partner_inbox',$data);
            $this->load->view('template/footer');
        }
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
            window.location.href='main_inbox';
        </script>";
    }

    function main_setting()
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
            $data['user_data'] = $this->admin_model->get_where_data(array('property_code' => $this->admin_data[0]['property_code']), 'user_profile');
            $data['country'] = $this->admin_model->get_where_data(array(),'country');
            $data['partner_province'] = $this->admin_model->get_where_data(array(),'province');
            
            $this->load->view('template/header', $header);
            $this->load->view('partner/partner_setting',$data);
            $this->load->view('template/footer');
        }
    }

    function submit_partner_profile()
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
            'first_name' => $first_name,
            'last_name' => $last_name,
            'nationality' => $nationality,
            'country_id' => $country_id,
            'backup_email' => $backup_email,
            'mobile' => $mobile,
            'address' => $address,
            'city' => $city,
            'province' => $province,
            'postcode' => $postcode,
            'external_number' => $external_number,
            'password' => md5($this->input->post('password')),
            'datetime_update' => date("Y-m-d H:i:s")
        );
        
        $update_data = $this->admin_model->Update_data($a_set_data, 'user_profile', array('property_code'=>$this->admin_data[0]['property_code']));
        if($update_data)
        {
             echo "<script>
                alert('Your profile informatino has been update');
                window.location.href='main_setting';
            </script>";
        }
    }

    function set_cover()
    {
        #clear all cover by ref_code 
        $this->admin_model->Update_data(array('cover'=> 0), 'item_image', array('ref_code' => $this->input->GET('ref_code')));
        #then set cover status by image_item_id
        $this->admin_model->Update_data(array('cover'=> 1), 'item_image', array('item_image_id' => $this->input->GET('id')));
        
    }

    function view_comment()
    {
        if(!$this->session->userdata('partner'))
        {
             return redirect('main/login');
        }
        else
        {
            $ref_code = $this->uri->segment(3);

            $header['css'] = $this->css;
            $header['jscript'] = $this->jscript;
            $header['header_user'] = $this->admin_data;
            $data['comments'] = $this->admin_model->get_where_data(array('ref_code' => $ref_code), 'comment');
     
            $this->load->view('template/header', $header);
            $this->load->view('partner/partner_comment',$data);
            $this->load->view('template/footer');
        }
    }

    function manual_delete_photo()
    { 
        unlink(realpath('webroot/files/'.$this->input->get('uuid').'/'.$this->input->get('image')));
        $this->admin_model->delete_data(array('item_image_id' => $this->input->get('id')), 'item_image');        
    }

}