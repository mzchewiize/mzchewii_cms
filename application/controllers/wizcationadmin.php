<?php
@session_start(); 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Wizcationadmin extends CI_Controller {
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
        'webroot/js/jquery.highlight.js'
       
    );

    var $admin_data = array();

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper(array('form', 'url','util'));
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


    function amenities()
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
            $amenities = $this->admin_model->get_where_data(array(),'item_type');
            $data['amenities'] = $amenities;
            $this->load->view('template/header', $header);
            $this->load->view('management/admin_website_aminities',$data);
            $this->load->view('template/footer');
        }
    }

    function amenities_customize()
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
            $item_type = $this->admin_model->get_where_data(array(),'item_type');
            $item_info = $this->admin_model->get_where_data(array(),'item_info');
            $data['item_info'] = $item_info;
            $data['item_type'] = $item_type;
            $this->load->view('template/header', $header);
            $this->load->view('management/admin_website_aminities_customize',$data);
            $this->load->view('template/footer');
        }
    }
 
    function test_sendmail()
    {
        sendMail();
    }
    
    function update_custom()
    {
        $update_statusaccomodation = array(
           $this->input->get('update_field') => $this->input->get('pcode_value')
        );
        $this->admin_model->Update_data($update_statusaccomodation, $this->input->get('table'), array($this->input->get('key') => $this->input->get('id')));
        redirect("wizcationadmin/".$this->input->get('reload_page'));
    }

    function add_item_new()
    {
        $add_new_item = array('item_name' => $this->input->get('pcode_value'));
        $this->admin_model->insert_data($add_new_item, $this->input->get('table'));
        redirect("wizcationadmin/".$this->input->get('reload_page'));
    }

    function update_deleteItem()
    {
        $this->admin_model->delete_data(array($this->input->get('key') => $this->input->get('id')), $this->input->get('table') );
        redirect("wizcationadmin/".$this->input->get('reload_page'));
    }

    function catergory()
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
            $data['catergory'] = $this->admin_model->get_where_data(array(),'category');
            $this->load->view('template/header', $header);
            $this->load->view('management/admin_website_catergory',$data);
            $this->load->view('template/footer');
        }

    }

    function approve_user_profile()
    {
        $updateuser_profile = array(
            'admin_approve' => 1
        );

        $approve = $this->admin_model->Update_data($updateuser_profile, 'user_profile', array('profile_id'=> $this->input->GET('profile_id')));
        
        // find user_profile infomation
        $user_profile = $this->admin_model->get_where_data(array('profile_id' => $this->input->GET('profile_id')),'user_profile');
        /*
        @send email after admin approve
        */
        if($approve)
        {   
            $password_text = generateRandomString();
            $password = md5($password_text);
            
            $a_set_data = array(
                'password' => $password,
                'datetime_update' => date("Y-m-d H:i:s")
            );
            
            $update_data = $this->admin_model->Update_data($a_set_data, 'user_profile', array('profile_id'=> $this->input->GET('profile_id')));

            $main_subject = 'Welcome to Wizcation.com';
            $second_subject = 'Your account has been approval';
            $sendto = $user_profile[0]['email'];
            $body = "Hello ,".$user_profile[0]['first_name']."<br/>";
            $body.= "Now You can access to partner dashboard<br/>";
            $body.= "<a href='http://wizcation.com/index.php/main/login'>Partner dashboard</a> <br/>";
            $body.= "username : ". $user_profile[0]['email'].'<br/>';
            $body.= "password : ".$password_text.'<br/>';
            $body.= "Thank you for you choosing WIZCATION.COM <br/>";
            $callback_url = 'wizcationadmin/partner';
            
            try
            {
                $sendmail = sendMail($main_subject, $second_subject, $sendto, $body, $callback_url);       
                if($sendmail)
                {
                       echo "<script>
                        alert('Register completed');
                        window.location.href='main/login';
                    </script>";       
                } else {
                         echo "<script>
                        alert('Register failed');
                        window.location.href='main/login';
                    </script>";  
                }

            } catch (Exception $e) {
                 echo 'Caught exceception'.$e->getMessage();
            }
        }

    }
     ## END  website_setting
    function partner()
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
            
            //get all partner register from user_profile 
            $data['user_group'] = $this->admin_model->get_where_data(array(),'user_group');
            $data['user_profile'] = $this->admin_model->get_where_data(array(),'user_profile');
            $this->load->view('template/header', $header);
            $this->load->view('management/admin_partner',$data);
            $this->load->view('template/footer');
        }
    }

    function delete_partner()
    {
        $this->admin_model->delete_data(array('profile_id' => $this->input->get('id')), 'user_profile');
    }

    function submit_partner()
    {
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
                $callback_url = 'partner';
                
                try
                {
                    $sendmail = sendMail($main_subject, $second_subject, $sendto, $body, $callback_url);       
                    if($sendmail)
                    {
                           echo "<script>
                            alert('Register completed');
                            window.location.href='partner';
                        </script>";       
                    } else {
                             echo "<script>
                            alert('Register failed');
                            window.location.href='partner';
                        </script>";  
                    }

                } catch (Exception $e) {
                     echo 'Caught exceception'.$e->getMessage();
                }
            }
        }
        else
        {
             echo "<script>
                alert('Email is duplicatated');
                window.location.href='partner';
            </script>";

        }     
    }

    function partner_verify()
    {
        $verify_partner = array(
               'user_verify' => '1'
            );

        $this->admin_model->Update_data($verify_partner, 'user_profile', array('property_code'=> $this->input->GET('property_code')));
        
        echo "<script>
                alert('Your account has been verify , Please wait for account information');
                window.location.href='http://wizcation.com/index.php/main/login';
            </script>";
    }

    function member()
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
            $data['members'] = $this->admin_model->get_where_data(array(),'member');
            $this->load->view('template/header', $header);
            $this->load->view('management/admin_member',$data);
            $this->load->view('template/footer');
        }

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

            $header['jscript'] = $this->jscript;
            $header['header_user'] = $this->admin_data;
            //get payment setting only from PAYSBUY
            $paysbuy = $this->admin_model->get_where_data(array(),'payment_paysbuy');

            $data['paysbuy'] = $paysbuy;
            $this->load->view('template/header', $header);
            $this->load->view('management/admin_setting',$data);
            $this->load->view('template/footer');
        }
    }

    function broadcast()
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
            //get payment setting only from PAYSBUY
            $data['message'] = $this->admin_model->get_where_data(array(),'inbox_broadcast');
            $data['message_from_partner'] = $this->admin_model->get_where_data(array('type' => 'send'),'inbox');
            
            $this->load->view('template/header', $header);
            $this->load->view('management/admin_broadcast',$data);
            $this->load->view('template/footer');
        }
    }

    function submit_new_broadcast()
    {
             $a_set_data = array(
                'msg_subject'=> $this->input->post('msg_subject'),
                'msg_detail' => $this->input->post('msg_detail'),
                'status' => 'new',
                'created' => date("Y-m-d H:i:s")
            );
            $update_data = $this->admin_model->insert_data($a_set_data, 'inbox_broadcast');
            echo "<script>
                alert('Message has been create');
                window.location.href='broadcast';
            </script>";
    }

    function submit_item_info()
    {
           $a_set_data = array(
                'item_id'=> $this->input->post('item_id'),
                'item_info_name' => $this->input->post('item_info_name')
            );
            $update_data = $this->admin_model->insert_data($a_set_data, 'item_info');
            echo "<script>
                alert('new item has been inserted');
                window.location.href='amenities_customize';
            </script>";
    }
    
    /*
    @update status message to sent
    @insert new reccord to all property_code set status = new
    @
    */
    function submit_send_msg()
    {
        $send_msg = array(
           'status' => 'sent'
        );

        #get message detail 
        $msg_detail = $this->admin_model->get_where_data(array('id' => $this->input->GET('msg_id')),'inbox_broadcast');
         
        $all_partner =  $this->admin_model->get_where_data(array(),'user_profile');
        
        foreach($all_partner as $partner)
        {
             $insert_new_broadcast_msg = array(
                'property_code' => $partner['property_code'],
                'inbox_title' => $msg_detail[0]['msg_subject'],
                'inbox_detail' => $msg_detail[0]['msg_detail'],
                'status' => 0,
                'type' => 'inbox'
            );

            $this->admin_model->insert_data($insert_new_broadcast_msg,'inbox');
        }

         $this->admin_model->Update_data($send_msg, 'inbox_broadcast', array('id'=> $this->input->GET('msg_id')));
         echo "<script>
                alert('Your message has been broadcast);
                window.location.href='broadcast';
            </script>";
    }
    
    /*
    @update status to sent
    @message has been sent
    @
    */
    
    function submit_delete_msg()
    {
           $send_msg = array(
               'status' => 'sent'
            );

        $this->admin_model->delete_data(array('id'=> $this->input->GET('msg_id')),'inbox_broadcast');
        echo "<script>
                alert('Your message has been removed');
                window.location.href='broadcast';
            </script>";
    }

    function submit_read_admin()
    {
         $send_msg = array(
               'status' => '2'
            );

        $this->admin_model->Update_data($send_msg, 'inbox', array('inbox_id'=> $this->input->GET('msg_id')));
        echo "<script>
                alert('Message mark as read');
                window.location.href='broadcast';
            </script>";
    }
   
    function update_paysbuy()
    {
        // fix to update only one reccord only for website payment
        if($this->input->post()!="")
        {
            $update_paysbuy = array(
                'paysbuy_psb' => $this->input->post('paysbuy_psb'),
                'paysbuy_username' => $this->input->post('paysbuy_username'),
                'paysbuy_secure_code' => $this->input->post('paysbuy_secure_code'),
          );

            $this->admin_model->Update_data($update_paysbuy, 'payment_paysbuy', array('id'=> 1));
            return redirect('wizcationadmin/setting');
        }            
    }

  
    function content_accomodation()
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
            
            //get all accomodation status = 0
            $data['content_accomodation'] = $this->admin_model->get_where_data(array(),'accomodation');
           
           
            $this->load->view('template/header', $header);
            $this->load->view('management/admin_content_accomodation',$data);
            $this->load->view('template/footer');
        }
    }

    function content_partner()
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
            
            // get all partner content status = 0
            $data['content_partner'] = $this->admin_model->get_where_data(array(),'partner_content');
           
           
            $this->load->view('template/header', $header);
            $this->load->view('management/admin_content_partner',$data);
            $this->load->view('template/footer');
        }
    }

    function admin_partner_approve_content()
    {
        $update_statusaccomodation = array(
            'content_status' => 1
        );

        $this->admin_model->Update_data($update_statusaccomodation, 'partner_content', array('id'=> $this->input->GET('id')));
    
    }

    function admin_accomodation_approve_content()
    {
        $update_statusaccomodation = array(
            'status' => 1
        );
        $this->admin_model->Update_data($update_statusaccomodation, 'accomodation', array('acc_id'=> $this->input->GET('acc_id')));
    }

    function static_page()
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
            $static_page = $this->admin_model->get_where_data(array(),'static_page');
            $data['static_page'] = $static_page;
            $this->load->view('template/header', $header);
            $this->load->view('management/admin_website_static',$data);
            $this->load->view('template/footer');
        }
    }

    function update_static_content()
    {
        $content = array(
            'description' => $this->input->POST('content'),
        );
        $this->admin_model->Update_data($content, 'static_page', array('id' => $this->input->POST('content_id')));
        redirect('wizcationadmin/static_page');
    }

    function submit_remove_item()
    {
        $this->admin_model->delete_data(array('item_info_id' => $this->input->get('id')), 'item_info');
    }
}