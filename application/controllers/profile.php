<?php
@session_start(); 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Profile extends CI_Controller {
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
        // $is_loggin = $this->is_logged();
        $this->admin_data = $this->session->userdata('admin');
    }

    public function index($error = '') {
		print_r($_SESSION);
		echo "<br>";
		print_r($this->session->userdata('admin'));
    }
	function delete_room()
	{

		$room_code = $this->uri->segment(3);

		$this->admin_model->delete_data(array('property_code'=>$this->admin_data[0]['property_code'],'room_code'=> $room_code ),'accomodation');
		$this->admin_model->delete_data(array('room_code'=> $room_code ),'accomodation_property');
		$this->admin_model->delete_data(array('room_code'=> $room_code ),'accomodation_price');
		$this->admin_model->delete_data(array('room_code'=> $room_code ),'accomodation_myguest');

		$content = $this->admin_model->get_data_id('room_code',$room_code,'item_image');

		for ($i=0;$i<count($content);$i++) {
			$thumb = explode('.',$content[$i]['image']);
			$thumb_name = $thumb[0].'_thumb.'.$thumb[1];
			unlink(realpath('upload/'.$this->admin_data[0]['property_code'].'/'.$room_code.'/'.$content[$i]['image']));
			unlink(realpath('upload/'.$this->admin_data[0]['property_code'].'/thumb/'.$room_code.'/'.$thumb_name));
			$this->admin_model->delete_data(array(
				'property_code'=>$this->admin_data[0]['property_code'],
				'room_code'=>$room_code),
				'item_image'

			);
		}
			redirect('profile/room');
	}

	function room()
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
	
			$data['content'] = $this->admin_model->room_and_image_join($this->admin_data[0]['property_code'],'accomodation');
	
			$this->load->view('template/header', $header);
			$this->load->view('room_list', $data);
			$this->load->view('template/footer');
		}
	}
	function view_comment_id()
	{
		 if(!$this->session->userdata('admin'))
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
            $this->load->view('comment',$data);
            $this->load->view('template/footer');
        }
	}
	function change_basic_night()
	{
		$header['css'] = $this->css;
        $header['jscript'] = $this->jscript;
        $header['header_user'] = $this->admin_data;
		$room_code = $this->input->GET('room_code');
		$new_price = $this->input->GET('new_price');

		$user_data = $this->admin_model->get_data_id('room_code',room_code,'accomodation');
		if($user_data[0]['basic_night'] != $new_price)
		{
			$error = 1;
		}
		$data['error'] = $error;

		$this->load->view('template/header', $header);
		$this->load->view('accomodation',$data);
		$this->load->view('template/footer');
	}
	function accomodation()
	{
		if(!$this->session->userdata('admin'))
		{
			 return redirect('main/login');
		}
		else
		{
			@$guest_booking;
			$header['css'] = $this->css;
			$header['jscript'] = $this->jscript;
			$header['header_user'] = $this->admin_data;
			$room_id = $this->uri->segment(3);
			$on_this_day = $this->admin_model->get_where_data(array('room_code' => @$room_id),'accomodation_price');
			$data['facilities'] = $this->admin_model->get_where_data(array('item_id' => 1),'item_info');
			$data['currency'] = $this->admin_model->get_where_data(array('property_code' =>$this->admin_data[0]['property_code'] ),'accomodation_information');
			$data['facilities_selcted'] = $this->admin_model->get_where_data(array('room_code' => @$room_id),'accomodation_property');
			$data['room_type'] = $this->admin_model->get_where_data(array(),'room_type');
			$data['guest_booking'] =  $this->admin_model->get_where_data(array('room_code' => @$room_id),'accomodation_myguest');
			

			if(!empty($room_id))
			{
				$content['flag'] = $this->admin_model->get_where_data(array('room_code' => $room_id),'accomodation_price');
				$on_this_day = $this->admin_model->get_where_data(array('room_code' => @$room_id),'accomodation_price');
			}

			$content['room'] = $this->admin_model->get_where_data(array('room_code' => $room_id),'accomodation');
			$data['photos'] =  $this->admin_model->get_where_data(array('ref_code' => @$content['room'][0]['ref_code']), 'item_image');
          
			$standard = $this->admin_model->get_where_data(array('room_code' => $room_id),'accomodation');
			$data['standard'] = $standard;

			// created booking array

			foreach ($on_this_day as $days)
			{
				$ondays[] =  $days['on_date'];
				if($days['room_off']==2)
				{
					$roomoffnotavailable[$days['on_date']] =  $days['room_off'];
				}
				if($days['room_off']==3)
				{
					$roomoffInactive[$days['on_date']] =  $days['room_off'];
				}
				if($days['special_type']==3)
				{
					$speciaratel[$days['on_date']] = $days['special_type'];
				}
				if($days['special_type']==2)
				{
					$lastminute[$days['on_date']] = $days['special_type'];
				}
				if($days['special_type']==1)
				{
					$topdeal[$days['on_date']] = $days['special_type'];
				}
				
				$roomPrice[$days['on_date']] = $days['price'];

		
				
			}
			foreach ($on_this_day as $days)
			{
				foreach($data['guest_booking'] as $booked)
				{

					if($days['on_date'] == $booked['start_book_date'])
					{
						$booked_date[$days['on_date']]  = array(
							$booked['start_book_date'],
							$booked['end_book_date'],
							$booked['num_of_room'],
							$booked['user_id']
						);
						//$guest_date[$days['on_date']]  = $booked['start_book_date'];
					}
				}
			}
		
			$data['ondays'] = (isset($ondays)) ? $ondays : array();
			$data['_roomoffnotavailable'] = (isset($roomoffnotavailable)) ? $roomoffnotavailable : array();
			$data['_roomoffInactive'] =  (isset($roomoffInactive)) ? $roomoffInactive : array();
			$data['_speciaratel'] = (isset($speciaratel)) ? $speciaratel : array();
			$data['_topdeal'] = (isset($topdeal)) ? $topdeal : array();
			$data['_lastminute'] = (isset($lastminute)) ? $lastminute : array();
			$data['_guest'] = (isset($booked_date)) ? $booked_date : array();
			$data['this_day'] = (isset($on_this_day)) ? $on_this_day : array();
			$data['roomPrice'] = (isset($roomPrice)) ? $roomPrice : array();
		
			$data['content'] = @$content;
			

			$this->load->view('template/header', $header);
			$this->load->view('accomodation',$data);
			$this->load->view('template/footer');
		}	
	}

	function set_cover()
	{
		$header['css'] = $this->css;
        $header['jscript'] = $this->jscript;
        $header['header_user'] = $this->admin_data;

		$room_code = $this->input->GET('redirect');

		$update_cover = array(
			'cover' => 0
		);

      	$this->admin_model->Update_data($update_cover, 'item_image', array('room_code'=> $room_code));
        $update_cover = array(
			'cover' => $this->input->GET('cover')
		);
        $this->admin_model->Update_data($update_cover, 'item_image', array('item_image_id'=> $this->input->GET('item_image_id')));

		redirect('profile/accomodation/'.$room_code);
	}

	function submit_room()
	{
	
		$title_place = $this->input->POST('title_place');
		$property_code = $this->input->POST('property_code');
		$room_code = $this->input->POST('room_code');
		$allotment = $this->input->POST('allotment');
		$room_type = $this->input->POST('room_type');
		$accommodates = $this->input->POST('accommodates');
		$basic_night = $this->input->POST('basic_night');
		$weekend_night = $this->input->POST('weekend_night');
		$cancelday = $this->input->POST('cancelday');
		$guest_night = $this->input->POST('guest_night');
		$breakfast_price = $this->input->POST('breakfast_price');
		$arraydays = json_decode($this->input->POST('arrays_day'));
		$cancle_option = $this->input->POST('cancle_option');
		
		foreach ($arraydays as $onday)
		{
		 	$set_upprice = array(
			 	'property_code' => $property_code,
			 	'room_code' => $room_code,
			 	'on_date' => $onday,
			 	'price' => $basic_night,
			 	'room_off' => 0,
			 	'special_type' => '',
			 	'flag' => 0
			 );
			$this->admin_model->insert_data($set_upprice, 'accomodation_price');
		 }
	
		$room = array(
			'title_name' => $title_place,
			'property_code' => $property_code,
			'room_code' => $room_code,
			'allotment' => $allotment,
			'room_type' => $room_type,
			'accommodates' => $accommodates,
			'basic_night' => $basic_night,
			'cancelday' => $cancelday,
			'breakfast_price' => $breakfast_price,
			'guest_night' => $guest_night,
			'ref_code' => $this->input->post('ref_code'),
			'cancle_option' => $cancle_option,
			'created' => date('Y-m-d H:i:s')
		);
		$update_basic = array(
			'price' => $basic_night
		);

		$this->admin_model->Update_data($update_basic, 'accomodation_price', array('room_code'=> $room_code));

		$this->admin_model->delete_data(array('property_code'=>$this->admin_data[0]['property_code'],'room_code'=> $room_code ),'accomodation');

		$this->admin_model->insert_data($room, 'accomodation');

		$facilities = $this->input->POST('facilities');

		$this->admin_model->delete_data(array('room_code'=> $room_code ),'accomodation_property');
	
		for($i=0;$i<count($facilities);$i++){
		 	$features_data = array(
		 		'property_code' => $this->admin_data[0]['property_code'] ,
		 		'room_code' => $room_code,
		 		'amenities_info_id' => $facilities[$i],
		 		'datetime_update' => date("Y-m-d H:i:s")
		 	);

		 	$this->admin_model->insert_data($features_data, 'accomodation_property');
		 }
	
		if(!empty($_FILES['upload_files']['name'])){
			$this->load->library('upload');
			$this->load->library('image_lib');
			$origin_path = 'upload/'.$this->admin_data[0]['property_code'].'/'.$room_code;
			$thumb_path = 'upload/'.$this->admin_data[0]['property_code'].'/'.$room_code.'/thumb';
			if (!is_dir($origin_path)) {
				mkdir($origin_path, 0777, TRUE);
				chmod($origin_path, 0777);
			}
			if (!is_dir($thumb_path)) {
				mkdir($thumb_path, 0777, TRUE);
				chmod($thumb_path, 0777);
			}
			for ($i = 0; $i < count($_FILES['upload_files']['name']); $i++) {
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
				if (!$this->upload->do_upload('temp_' . $i)) {
					$error = array('error' => $this->upload->display_errors());
					print_r($error);
				} else {
					$pic = array('upload_data' => $this->upload->data('temp_' . $i));
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
					if (!$this->image_lib->resize()) {
						 $error = array('error' => $this->image_lib->display_errors());
						print_r($error);
					}

					$a_set_data = array(
						'property_code' => $this->admin_data[0]['property_code'],
						'room_code' => $room_code,
						'image' => $file_name."." . $type,
						'datetime_update' => date("Y-m-d H:i:s")
					);
					$this->admin_model->insert_data($a_set_data, 'item_image');


				}
			}
		}
		redirect('profile/accomodation/'.$room_code);
	}

	function set_up_price()
	{
		$header['css'] = $this->css;
		$header['jscript'] = $this->jscript;
		$header['header_user'] = $this->admin_data;
	
		$start = date('Y-m-d', strtotime($this->input->GET('from')));
		$end = date('Y-m-d', strtotime($this->input->GET('to')));
		$price = $this->input->GET('price');
		$room_code = $this->input->GET('room_code');
	
		if(($start !="") || ($end != ""))
		{
			if($end == "" )
			{
				$end = $start;
			}
			$dates = $this->createDateRangeArray($start, $end);
		
	   		for($i=0;$i<count($dates);$i++)
	   		{
	   		
				 $set_up_prices = array(
						'price' => $price,
						'special_type' => $this->input->GET('special_type'),
						'room_off' => $this->input->GET('room_off'),
						'created' => date("Y-m-d H:i:s")
					);
					
				$this->admin_model->Update_data($set_up_prices, 'accomodation_price', array('on_date'=> $dates[$i],'room_code' => $room_code));			
	   		}
		}
	}

	function guest_booking()
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
			$previous_booking = $this->admin_model->get_where_data(array(
				'start_book_date' => $this->input->POST('start_book_date'),
				'room_code' => $this->input->POST('room_code'),
			),'accomodation_myguest');

			if(!empty($previous_booking))
			{
				$find_room = $this->admin_model->get_where_data(array('room_code' => $this->input->POST('room_code')),'accomodation_myguest');
				$available = ($find_room[0]['available'] - $this->input->POST('num_of_room'));
			}
			else
			{
				$find_room = $this->admin_model->get_where_data(array('room_code' => $this->input->POST('room_code')),'accomodation');
				$available = ($find_room[0]['allotment'] - $this->input->POST('num_of_room'));
			}

			$set_up_price = array(
				'property_code' => $this->admin_data[0]['property_code'],
				'transactionId' => rand(6,120),
				'user_id' => $this->input->POST('user_id'),
				'start_book_date' => $this->input->POST('start_book_date'),
				'end_book_date' => $this->input->POST('end_book_date'),
				'num_of_room' => $this->input->POST('num_of_room'),
				'allotment' => $find_room[0]['allotment'],
				'room_code' => $this->input->POST('room_code'),
				'available' => $available,
				'status' => 1,
				'created' => date("Y-m-d H:i:s")
			);
			$this->admin_model->insert_data($set_up_price, 'accomodation_myguest');
			redirect('profile/calendar');
		}
	}
	
	private function createDateRangeArray($strDateFrom,$strDateTo)
	{

		$aryRange=array();

		$iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),     substr($strDateFrom,8,2),substr($strDateFrom,0,4));
		$iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));

			if ($iDateTo>=$iDateFrom)
			{
				array_push($aryRange,date('j-n-Y',$iDateFrom)); // first entry
				while ($iDateFrom<$iDateTo)
				{
					$iDateFrom+=86400; // add 24 hours
					array_push($aryRange,date('j-n-Y',$iDateFrom));
				}
			}
			return $aryRange;
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
