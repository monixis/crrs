<?php
class crr_model extends CI_Model {

	function __construct() {
		// Call the Model constructor
		parent::__construct();
		// $this->load->database();
	}
	
	function getres($date) {
		$sql = "SELECT startTime, endTime, status, roomNum, isFinals FROM reservations WHERE resDate = $date;";
		$results = $this->db->query($sql, array($date));
		return $results -> result();
	}
	
	function getreserver($res){
		$query = $this->db->get_where('reserver', array('email' => $res));
		return $this->db->count_all_results();
	}
	function insert_user($res) {
       	$this->db->insert('reserver', $res);
	}
	function insert_reservation($data){
		$this->db->insert('reservations', $data);
	}
	
}
?>