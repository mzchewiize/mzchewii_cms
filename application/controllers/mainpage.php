
<?php
@session_start(); 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mainpage extends CI_Controller {

	
  public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));
        $this->load->database();
        $this->load->model('front_model');
        // $is_loggin = $this->is_logged();
        $this->admin_data = $this->session->userdata('admin');
    }

    public function view(){
    	$data['id']=$this->uri->segment('3');
    	$property=$data['id'];
    	$this->load->model('front_model');
    	$data['accom_detail'] = $this->front_model->get_acomodation_detail($property);
    	$data['roomdetail'] = $this->front_model->get_acomodation_by_roomcode($property);
    	$data['roomlist'] = $this->front_model->get_acomodation_RoomAllProperty($property);
    	 
    	$data['content']="mainpage/accomodation_viewdetail";
    	$this->load->view('layouts/column1',$data);
    	 
    }
    function profile_api()
    {
    	$this->db->select('*')->from('amenities');
    	$item = $this->db->get()->result();
    	$arr_data=array();
    	$i=0;
    	foreach ($item as $r){
    		
    		$arr_data[$i]['amenities_id']=$r->amenities_id;
    		$arr_data[$i]['amenities_name']=$r->amenities_name;
    		$i++;
    	}
    	echo json_encode($arr_data);
    	
    }
    
	public function index()
	{
		
		$this->db->select('*')
		->from('accomodation a');
		$this->db->join('accomodation_property b', 'b.property_code=a.property_code', 'left'); 
		$this->db->join('description c', 'c.property_code=a.property_code', 'left');
		$this->db->join('accomodation_information d', 'd.property_code=a.property_code', 'left');
		$this->db->join('province e', 'e.PROVINCE_ID=d.partner_province', 'left');
		$this->db->join('geography g', 'g.GEO_ID=d.partner_region', 'left');
		$this->db->join('item_image f', 'f.property_code=a.property_code', 'left');
		$this->db->group_by('a.property_code');		
		
		$item = $this->db->get();
		$data['item']=$item->result();
		$data['content']="mainpage/index";
		$this->load->view('layouts/main',$data);
	
	}

	function accomodation()
	{   
   		$this->load->model('front_model');
		$data['rest_list'] = $this->front_model->get_rest();
		$data['west']=$this->front_model->get_acomodation_by_geo(4);
		$data['south']=$this->front_model->get_acomodation_by_geo(6);
		$data['center']=$this->front_model->get_acomodation_by_geo(2);
		$data['content']="mainpage/front_accomodation";
		$this->load->view('layouts/column2',$data);
		
	}

	function diningout()
	{ $this->load->model('front_model');
		$data['rest_list'] = $this->front_model->get_rest();
		$this->load->database();
		$query = $this->db->get("accomodation");
		if ( $query->num_rows() > 0 ) {
			$data['dbrow'] = $query->result();
		} else {
			$data['dbrow'] = null;
		}
		$data['content']="mainpage/front_activity";
		$this->load->view('layouts/column2',$data);
	}

	function thingtodo()
	{
		$this->load->model('front_model');
		$data['rest_list'] = $this->front_model->get_rest();
		
		$this->load->database();
		$query = $this->db->get("accomodation");
		if ( $query->num_rows() > 0 ) {
			$data['dbrow'] = $query->result();
		} else {
			$data['dbrow'] = null;
		}
		$data['content']="mainpage/front_thingtodo";
		$this->load->view('layouts/column2',$data);
	}

	function localpackage()
	{
		$this->load->model('front_model');
		$data['rest_list'] = $this->front_model->get_rest();
		
		$this->load->database();
		$query = $this->db->get("accomodation");
		if ( $query->num_rows() > 0 ) {
			$data['dbrow'] = $query->result();
		} else {
			$data['dbrow'] = null;
		}
		$data['content']="mainpage/front_localpackage";
		$this->load->view('layouts/column2',$data);
	}

	function promotion()
	{
		$this->load->model('front_model');
		$data['rest_list'] = $this->front_model->get_rest();
		$this->load->database();
		$query = $this->db->get("accomodation");
		if ( $query->num_rows() > 0 ) {
			$data['dbrow'] = $query->result();
		} else {
			$data['dbrow'] = null;
		}
		$data['content']="mainpage/front_promotion";
		$this->load->view('layouts/column2',$data);
	}

	function privilege()
	{ $this->load->model('front_model');
		$data['rest_list'] = $this->front_model->get_rest();
			$this->load->database();
		$query = $this->db->get("accomodation");
		if ( $query->num_rows() > 0 ) {
			$data['dbrow'] = $query->result();
		} else {
			$data['dbrow'] = null;
		}
		$data['content']="mainpage/front_privilege";
		$this->load->view('layouts/column2',$data);
	}

	function  detailaccomodation(){
		
		$data['content']="mainpage/detailaccomodation";
		$this->load->view('mainpage/template_main',$data);
		
	}

}
