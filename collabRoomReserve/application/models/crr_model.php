<?php
class crr_model extends CI_Model {

	function __construct() {
		// Call the Model constructor
		parent::__construct();
		// $this->load->database();
	}
	
	function getres($date) {
		$sql = "SELECT startTime, endTime FROM reservations WHERE resDate = $date;";
		$results = $this->db->query($sql);
		return $results -> result();
	}
	
	public function insert_user($userId, $email) {
        $qry = "INSERT INTO reserver VALUES ('$userId', '$email')";
		$qry->execute();
	}
	public function insert_reservation($resID, $resDate, $startTime, $endTime, $resEmail, $resType, $roomNum, $status, $isFinals){
		$qry = "INSERT INTO reservations VALUES ('$resID', $resDate, $startTime, $endTime, '$resEmail', '$resType', '$roomNum', '$status', '$isFinals')";
		$qry->execute();
	}
	
}
?>