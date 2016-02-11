<?php
@session_start(); 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Property extends CI_Controller {

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
        $this->admin_data = $this->session->userdata('admin');

    }

    public function index($error = '') {
		print_r($_SESSION);
		echo "<br>";
		print_r($this->session->userdata('admin'));
    }

    function infomation()
	{
		if(!$this->session->userdata('admin'))
		{
			 return redirect('main/login');
		}
		else
		{
			$header['css'] = $this->css;
			array_push($this->jscript,'webroot/js/google_map.js');
			$header['jscript'] = $this->jscript;
			$header['header_user'] = $this->admin_data;
			
			$rest = $this->admin_model->get_where_data(array(),'rest');
			$service = $this->admin_model->get_where_data(array(),'service');
			$term_policy = $this->admin_model->get_where_data(array(),'term_policy');
			$geography = $this->admin_model->get_where_data(array(), 'geography');
		
			$data['item_info'] = $this->admin_model->get_where_data(array('item_id' => 5),'item_info');
			$data['content'] = $this->admin_model->get_where_data(array('property_code'=>$this->admin_data[0]['property_code']),'accomodation_information');
			$data['photos'] =  $this->admin_model->get_where_data(array('ref_code' => @$data['content'][0]['ref_code']), 'item_image');
          	
			// $content[0]['partner_region'] = $this->admin_model->get_where_data(
			// 	array(
			// 		'GEO_ID'=>@$content[0]['partner_region']
			// 	),
			// 	'geography'
			// );
			
			// $content[0]['partner_province'] = $this->admin_model->get_where_data(
			// 	array(
			// 		'PROVINCE_ID'=>@$content[0]['partner_province']
			// 	),
			// 	'province'
			// );
			
			// $content[0]['partner_district'] = $this->admin_model->get_where_data(
			// 	array(
			// 		'AMPHUR_ID'=>@$content[0]['partner_district']
			// 	),
			// 	'amphur'
			// );

			$content = $this->admin_model->get_where_data(array('property_code'=>$this->admin_data[0]['property_code']),'accomodation_information');
		#	$rest = $this->admin_model->get_where_data(array('property_code'=>$this->admin_data[0]['property_code']),'rest');
			$service = $this->admin_model->get_where_data(array('property_code'=>$this->admin_data[0]['property_code']),'service');
			$term_policy = $this->admin_model->get_where_data(array('property_code'=>$this->admin_data[0]['property_code']),'term_policy');
			
			
			$content[0]['category'] = $this->admin_model->get_where_data(
				array(
					'property_code' => $this->admin_data[0]['property_code']
				),
				'item_category'
			);
			
			$content[0]['partner_province'] = $this->admin_model->get_where_data(
				array(
					'PROVINCE_ID'=>@$content[0]['partner_province']
				),
				'province'
			);
			
			$content[0]['partner_district'] = $this->admin_model->get_where_data(
				array(
					'AMPHUR_ID'=>@$content[0]['partner_district']
				),
				'amphur'
			);
			#$data['rest'] = $rest;
			$data['service'] = $service;
			$data['term_policy'] = $term_policy;
			$data['geography'] = $geography;
			#$data['category'] = $category;
			#$data['images'] = $images;
			$data['content'] = $content;
			
			$this->load->view('template/header', $header);
			$this->load->view('infomation',$data);
			$this->load->view('template/footer');
		}
	}

	function submit_information()
	{

		$hotel_type = $this->input->POST('type');
		$option_search_1 = $this->input->POST('option_search_1');
		$partner_region = $this->input->POST('partner_region');
		$partner_province = $this->input->POST('partner_province');
		$partner_district = $this->input->POST('partner_district');
		$category = json_encode($this->input->POST('category'));
		$address = $this->input->POST('address');
		$hashtag = $this->input->POST('hashtag');
		$checkin = $this->input->POST('checkin');
		$checkout = $this->input->POST('checkout');
		$ref_code = $this->input->POST('ref_code');
		$latitude_text = $this->input->POST('latitude_text');
		$longitude_text = $this->input->POST('longitude_text');
		$upload_files = $this->input->POST('upload_files');

		$include_breakfast = $this->input->POST('include_breakfast');
		$breakfast_price = $this->input->POST('breakfast_price');
		$smoking = $this->input->POST('smoking');
		$pet_allowed = $this->input->POST('pet_allowed');
		$type_of_room = 1;


		//update_service
		$a_set_data_sevice = array(
			'include_breakfast' => $include_breakfast ,
			'property_code' => $this->admin_data[0]['property_code'],
			'breakfast_price' => $breakfast_price ,
			'smoking' => $smoking ,
			'pet_allowed' => $pet_allowed ,
			'type_of_room' => $type_of_room ,
			'datetime_update' => date("Y-m-d H:i:s")
		);
		
		$find_service = $this->admin_model->get_data_id('property_code',$this->admin_data[0]['property_code'],'service');

		if($find_service)
		{
			$update_service = $this->admin_model->Update_data($a_set_data_sevice, 'service', 
			array(
					'property_code'=>$this->admin_data[0]['property_code']
				)
			);
		}
		else
		{
			$this->admin_model->insert_data($a_set_data_sevice, 'service');
		}
		
		//delete cat
		$item_category = $this->admin_model->delete_data(
			array(
				'property_code' => $this->admin_data[0]['property_code']
			), 
			'item_category'
		);

		$a_set_data = array(
			'hotel_type' => $hotel_type ,
			'property_code' => $this->admin_data[0]['property_code'],
			'partner_region' => $partner_region ,
			'partner_province' => $partner_province ,
			'partner_district' => $partner_district ,
			'address' => $address ,
			'latitude' => $latitude_text ,
			'longitude' => $longitude_text ,
			'hashtag' => $hashtag ,
			'checkin' => $checkin ,
			'checkout' => $checkout,
			'catergory' => $category,
			'ref_code' => $ref_code,
			'datetime_update' => date("Y-m-d H:i:s")
		);
		
		$find_infomation = $this->admin_model->get_data_id('property_code',$this->admin_data[0]['property_code'],'accomodation_information');	
		
		if($find_infomation)
		{
			$update_data = $this->admin_model->Update_data($a_set_data, 'accomodation_information', array(
					'property_code'=>$this->admin_data[0]['property_code']
				)
			);
		}
		else
		{
			$this->admin_model->insert_data($a_set_data, 'accomodation_information');
		}

		if(!empty($_FILES['upload_files']['name']))
		{
	        $this->load->library('upload');
	        $this->load->library('image_lib');
			$origin_path = './upload/'.$this->admin_data[0]['property_code'];
	        $thumb_path = './upload/'.$this->admin_data[0]['property_code'].'/thumb';
			
			if (!is_dir($origin_path)) 
			{
				mkdir($origin_path, 0777, TRUE);
				chmod($origin_path, 0777);
			}
			if (!is_dir($thumb_path)) {
				mkdir($thumb_path, 0777, TRUE);
				chmod($thumb_path, 0777);
			}
			for ($i = 0; $i < count($_FILES['upload_files']['name']); $i++) 
			{
				$file_name = 'img_' . time() . $i;
	            $config['upload_path'] = $origin_path;
	            $config['allowed_types'] = 'gif|jpg|png';
	            $config['max_size'] = '10240'; //10mb
	            $config['max_width'] = '0';
	            $config['max_height'] = '0';
	            $config['file_name'] = $file_name;
	            $_FILES['temp_' . $i] = array(
	                'name' => $_FILES['upload_files']['name'][$i],
	                'size' => $_FILES['upload_files']['size'][$i],
	                'type' => $_FILES['upload_files']['type'][$i],
	                'tmp_name' => $_FILES['upload_files']['tmp_name'][$i],
	                'error' => $_FILES['upload_files']['error'][$i]
	            );

				 $this->upload->initialize($config);
				
				if (!$this->upload->do_upload('temp_' . $i)) 
				{
		            $error = array(
		            	'error' => $this->upload->display_errors()
		            );
			    } 
		        else 
		        {
					$pic = array(
						'upload_data' => $this->upload->data('temp_' . $i)
					);
					$types = explode(".", $pic['upload_data']['file_name']);
					$type = array_pop($types);
		            $file_path_origin = $origin_path . "/" . $config['file_name'] . "." . $type;
		            $file_path_thumb = $thumb_path . "/" . $config['file_name'] . "." . $type;
		            $config = array();
		            $config['image_library'] = 'gd2';
		            $config['allowed_types'] = 'gif|jpg|png|GIF|JPG|PNG';
					$config['width'] = 400;
					$config['height'] = 400;
					$config['source_image'] = $file_path_origin;
		            $config['new_image'] = $file_path_thumb;
		            $config['create_thumb'] = TRUE;
		            $config['maintain_ratio'] = TRUE;

		            $this->image_lib->initialize($config);
		            
		            if (!$this->image_lib->resize()) 
		            {
		                 $error = array(
		                 	'error' => $this->image_lib->display_errors()
		                 );
		            }

					$a_set_data = array(
						'property_code' => $this->admin_data[0]['property_code'],
						'image' => $file_name."." . $type,
						'datetime_update' => date("Y-m-d H:i:s")
					);
					
					$this->admin_model->insert_data($a_set_data, 'item_image');
		        }
			}
		}

		redirect('property/infomation');
	}

	function image_confirm_delete()
	{
		$item_id = $this->input->get('item_id');
		$item = $this->admin_model->chk_data_count(array(
				'property_code'=>$this->admin_data[0]['property_code'],
				'item_image_id'=>$item_id
			), 
			'item_image'
		);

		if($item>=1)
		{
			$content = $this->admin_model->get_data_id('item_image_id',$item_id,'item_image');
			$thumb = explode('.',$content[0]['image']);
			$thumb_name = $thumb[0].'_thumb.'.$thumb[1];
			
			unlink(realpath('upload/'.$content[0]['property_code'].'/'.$content[0]['image']));
			unlink(realpath('upload/'.$content[0]['property_code'].'/thumb/'.$thumb_name));
			
			$this->admin_model->delete_data(array(
					'property_code'=>$this->admin_data[0]['property_code'],
					'item_image_id'=>$item_id
				),
			'item_image'
			);
		}

	}
	
	function ajax_partner_region()
	{
		$region_id = $this->input->get('region_id');
		$province = $this->admin_model->get_data_id('GEO_ID',$region_id,'province');
		$data['province'] = $province;
		$this->load->view('ajax/ajax_select_province',$data);
	}
	
	function ajax_partner_province()
	{
		$province_id = $this->input->get('province_id');
		$district = $this->admin_model->get_data_id('PROVINCE_ID',$province_id,'amphur');
		$data['district'] = $district;
		$this->load->view('ajax/ajax_select_district',$data);
	}
}