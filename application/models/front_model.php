<?php

class front_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->load->database();
    }
    //
    function get_rest(){
    	$return[''] = 'please select type ';
    	$query  = $this->db->get('rest');
    	foreach($query->result_array() as $row){
    		$return[$row['rest_id']] = $row['rest_name'];
    	}
    	return $return;
    }

    // get accomodation by geo 
    function get_acomodation_by_geo($id) {
    	$this->db->select('*')
    	->from('accomodation a');
		$this->db->join('accomodation_property b', 'b.property_code=a.property_code', 'left'); 
		$this->db->join('description c', 'c.property_code=a.property_code', 'left');
		$this->db->join('accomodation_information d', 'd.property_code=a.property_code', 'left');
		$this->db->join('province e', 'e.PROVINCE_ID=d.partner_province', 'left');
		$this->db->join('geography g', 'g.GEO_ID=d.partner_region', 'left');
		$this->db->join('item_image f', 'f.room_code=a.room_code', 'left');
		$this->db->group_by('a.room_code');
		$this->db->where('d.partner_region',$id);
    	  $result = $this->db->get()->result();
        return $result;
    }
    
    // get accomodation by propertycode
    function get_acomodation_by_roomcode($propertycode) {
    	$this->db->select('*')
    	->from('accomodation a');
    	$this->db->join('accomodation_property b', 'b.property_code=a.property_code', 'left');
    	$this->db->join('description c', 'c.property_code=a.property_code', 'left');
    	$this->db->join('accomodation_information d', 'd.property_code=a.property_code', 'left');
    	$this->db->join('province e','e.PROVINCE_ID=d.partner_province', 'left');
    	$this->db->join('geography g','g.GEO_ID=d.partner_region', 'left');
    	$this->db->join('item_image f','f.property_code=a.property_code', 'left');
    	$this->db->group_by('f.image');
    	$this->db->where('a.property_code',$propertycode);
    	$result = $this->db->get()->result();
    	return $result;
    }
    
    // get accomodation detail  by propertycode
    function get_acomodation_detail($propertycode) {
    	$this->db->select('*')
    	->from('accomodation a');
    	$this->db->join('description c', 'c.property_code=a.property_code', 'left');
    	$this->db->join('accomodation_information d', 'd.property_code=a.property_code', 'left');
    	$this->db->join('province e', 'e.PROVINCE_ID=d.partner_province', 'left');
    	$this->db->join('geography g', 'g.GEO_ID=d.partner_region', 'left');
    	$this->db->where('a.property_code',$propertycode);
    	$this->db->group_by('c.property_code');
    	 
    	$result = $this->db->get()->result();
    	return $result;
    }
    
    // get accomodation room all  by propertycode
    function get_acomodation_RoomAllProperty($propertycode) {
    	$this->db->distinct();
    	$this->db->select('*')
    	->from('accomodation a');
    	$this->db->join('room_type b', 'b.room_id=a.room_type', 'left');
    	$this->db->join('description c', 'c.property_code=a.property_code', 'left');
    	$this->db->join('accomodation_information d', 'd.property_code=a.property_code', 'left');
    	$this->db->join('province e', 'e.PROVINCE_ID=d.partner_province', 'left');
    	$this->db->join('geography g', 'g.GEO_ID=d.partner_region', 'left');
    	$this->db->join('item_image f', 'f.room_code=a.room_code', 'left');
    	$this->db->join('canceltype h', ' h.canceltype_id=a.canceltype', 'left');
    	 
    	$this->db->where('a.property_code',$propertycode); 
    	$this->db->where('f.cover', 1);
    	$result = $this->db->get()->result();
    	return $result;
    }
    
	}