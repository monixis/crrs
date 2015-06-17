<?php
class crr_model extends CI_Model {

	function __construct() {
		// Call the Model constructor
		parent::__construct();
		// $this->load->database();
	}
	function getrestime() {
		$sql = "SELECT res.startTime, res.endTime FROM reservations AS res;";
		$results = $this -> db -> query($sql);
		return $results -> result();
	}
	
}
?>