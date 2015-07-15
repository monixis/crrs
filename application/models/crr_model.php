<?php
class crr_model extends CI_Model {

	function __construct() {
		// Call the Model constructor
		parent::__construct();
		// $this->load->database();
	}
	
	function getreserver($res) {
		$sql = "SELECT email FROM reserver WHERE email = '$res';";
		$results = $this->db->query($sql, array($res));
		if($results == $res)
			return false;
		else {
			return true;
		}
	}
	
	public function getResDetails($resId){
		$sql = "SELECT resId, resDate, startTime, resEmail, resType, roomNum, status.status, reservations.status as 'statusId' FROM reservations inner join status on reservations.status = status.statusNum WHERE resId = '$resId';";
		$results = $this->db->query($sql, array($resId));
		return $results -> result();
		//return $sql;
	}
	
	public function getReservations($date){
		$sql = "SELECT resId, status FROM reservations WHERE resDate = '$date';";
		$results = $this->db->query($sql, array($date));
		return $results -> result();
		//return $sql;
 	}
	
	public function insert_user($email) {
		$this->db->insert('reserver', $email);
	}
	public function insert_reservation($data){
		$this->db->insert('reservations', $data);
	}
	
	public function getRooms(){
		$sql = "SELECT roomNum FROM rooms";
		$results = $this->db->query($sql);
		return $results -> result();
	} 
	
	public function getHours(){
		$sql = "SELECT starttime, totalhrs FROM hours";
		$results = $this->db->query($sql);
		return $results -> result();
	} 
}
?>