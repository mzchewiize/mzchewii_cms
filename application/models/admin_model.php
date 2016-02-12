<?php

class admin_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->load->database();
    }
    function chk_data_count($array, $table) {
        $this->db->where($array);
        $this->db->from($table);
        return $this->db->count_all_results();
    }
	function get_where_data($array,$table) {
		$this->db->where($array);
        $this->db->from($table);
        $result = $this->db->get()->result_array();
        return $result;
    }
	function get_data_id($filed,$id,$table) {
        $this->db->where($filed, $id);
        $this->db->from($table);
        $result = $this->db->get()->result_array();
        return $result;
    }
	function get_data_by_select($select,$filed,$id,$table) {
		$this->db->select($select);
        $this->db->where($filed, $id);
        $this->db->from($table);
        $result = $this->db->get()->result_array();
        return $result;
    }
	function insert_data($array, $table) {
        $this->db->set($array);
        $data = $this->db->insert($table);
        return $this->db->insert_id();
    }
	function Update_data($array, $table, $array_where) {
        $this->db->where($array_where);
        $this->db->update($table, $array);
        return $this->db->affected_rows();
    }
	function where_cause($where,$order,$table,$page, $pp){
		$this->db->where($where);
		$this->db->from($table);
		if(!empty($order)){
			$this->db->order_by($order,"DESC");
		}
		if(!empty($page) ){
			$this->db->limit( $page, $pp );
		}
		return $this->db->get()->result_array();
	}
	function delete_data($where,$table){
		$this->db->where($where);
		$this->db->delete($table);
	}
	function get_data_id_limit($filed,$id,$table) {
        $this->db->where($filed, $id);
        $this->db->from($table);
        $this->db->limit(1);
        $result = $this->db->get()->result_array();
        return $result;
    }
	function room_and_image_join($admin_code)
	{
		$this->db->distinct('room_code');
	    $this->db->from('accomodation a');
        $this->db->where('a.property_code',$admin_code); 
        $this->db->where('i.cover',1); 
        $this->db->join('item_image i', 'a.ref_code = i.ref_code');
		$this->db->group_by('a.room_code');
		$result = $this->db->get()->result_array();
        return $result;
	}

    function getbookdate($admin_code)
    {
        $this->db->distinct();
        $this->db->from('accomodation_myguest');
        $this->db->where('property_code',$admin_code); 
        $this->db->group_by('start_book_date');
        $result = $this->db->get()->result_array();
        return $result;
    }

    function sum_booking($start_book_date,  $room_code)
    {
        $this->db->select('
        *
        FROM accomodation_myguest
        WHERE room_code =  "'.$room_code.'"
        and  start_book_date = "'.$start_book_date.'"', FALSE); 
        $result = $this->db->get()->result_array();
        return $result;
    }

    function distinct_room_type($property_code)
    {
        $this->db->distinct();

        $this->db->select('title_name');
        $this->db->from('accomodation');
        $this->db->where('property_code',$property_code); 
        $result = $this->db->get()->result_array();
        return $result;
       
    }
}
