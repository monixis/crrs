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
	function isreserved($res) {
		$sql = "SELECT resId FROM reservations WHERE resId = '$res';";
		$results = $this->db->query($sql, array($res));
		if($results == $res)
			return TRUE;
		else {
			return FALSE;
		}
	}
	public function updateStatus($rId, $status, $notes){
		$sql = "UPDATE reservations SET status = '$status' WHERE rId = '$rId' AND status IN (1,2);";
		if ($this->db->simple_query($sql, array($rId, $status))){
			if (strlen($notes) > 0){
				$sql1 = "INSERT into notes(resId, note) VALUES ('$rId', '$notes');";	
				if ($this->db->simple_query($sql1, array($rId, $notes))){
					return 1;		
				}else{
					return 0;
				}
			}
			else{
				return 1;
			}
		}else{
			return 0;			
		}
	}
	
	public function updateSlotStatus($rId, $resId, $status, $notes){
		$sql = "UPDATE reservations SET status = '$status' WHERE resId = '$resId' AND rid = '$rId';";
		if ($this->db->simple_query($sql, array($resId, $status))){
			if (strlen($notes) > 0){
				$sql1 = "INSERT into notes(resId, note) VALUES ('$rId', '$notes');";	
				if ($this->db->simple_query($sql1, array($rId, $notes))){
					return 1;		
				}else{
					return 0;
				}
			}
			else{
				return 1;
			}
		}else{
			return 0;			
		}
	}
	
	public function addNotes($rId, $notes){
		$sql1 = "INSERT into notes(resId, note) VALUES ('$rId', '$notes');";	
				if ($this->db->simple_query($sql1, array($rId, $notes))){
					return 1;		
				}else{
					return 0;
				}
	}
	

	function getmaxid($col, $table){
		$this -> db -> select_max($col);
		$query = $this -> db -> get($table);
		foreach ($query -> result() as $row){
			$maxval = $row -> $col;
		}
		$maxval = $maxval + 1;
		return $maxval;
	}
	public function getRoomDetails($roomno){
		$sql = "SELECT roomNum, seats, computers, printers, scanners, whiteboards FROM rooms WHERE roomNum = '$roomno';";
		$results = $this->db->query($sql, array($roomno));
		return $results -> result();
	}
	public function getResDetails($resId){
		$sql = "SELECT resId, resDate, startTime, resEmail, resPhone, resType, roomNum, status.status, reservations.status as 'statusId', totalHours, rId, comments, numPatrons FROM reservations inner join status on reservations.status = status.statusNum WHERE resId = '$resId';";
		$results = $this->db->query($sql, array($resId));
		return $results -> result();
	}
	public function getResDetails1($rId){
		$sql = "SELECT DISTINCT rId, resDate, startTime, resEmail, resPhone, resType, roomNum, status.status, reservations.status as 'statusId', totalHours, comments, numPatrons FROM reservations inner join status on reservations.status = status.statusNum WHERE rId = '$rId';";
		$results = $this->db->query($sql, array($rId));
		return $results -> result();
	}
	public function getRoomSearchDetails($roomNum){
		$sql = "SELECT resId, resDate, startTime, resEmail, resType, roomNum, status.status, reservations.status as 'statusId' FROM reservations inner join status on reservations.status = status.statusNum WHERE roomNum = '$roomNum';";
		$results = $this->db->query($sql, array($roomNum));
		return $results -> result();
	}
	public function getEmailDetails($email){
		$sql = "SELECT DISTINCT resDate, rId, status.status as 'status', reservations.status as 'statusId' FROM reservations INNER JOIN status ON reservations.status = status.statusNum WHERE resEmail = '$email' AND reservations.status != '3' ORDER BY rId DESC;";
		$results = $this->db->query($sql, array($email));
		return $results -> result();
	}
	public function getNotes($email){
		$sql = "SELECT note, resid FROM notes WHERE resid IN ( SELECT DISTINCT rId FROM reservations WHERE resEmail = '$email') ORDER BY resid DESC";
		$results = $this->db->query($sql, array($email));
		return $results -> result();
	}
	
	public function getReservations($date){
		$sql = "SELECT resId, status FROM reservations WHERE resDate = '$date' and status != 3;";
		$results = $this->db->query($sql, array($date));
		return $results -> result();
 	}
	
	public function insert_user($email) {
		$this->db->insert('reserver', $email);
	}
	public function insert_reservation($data, $table){
		$this->db->insert($table, $data);	
		if($this->db->affected_rows()>0)
		{
			return 1;			
		}else{
			return 0;
			//return $this->db->_error_number();
		}
	}
	
	public function getRooms($date){
		$sql = "SELECT roomNum FROM rooms WHERE roomNum NOT IN(SELECT roomNum FROM roomInstructions WHERE '$date' BETWEEN startDate AND endDate)";
		$results = $this->db->query($sql, array($date));
		return $results -> result();
	} 
	public function getResIds(){
		$sql = "SELECT resId FROM reservations;";
		$results = $this->db->query($sql);
		return $results -> result();
	}
	public function getHours(){
		$sql = "SELECT id, hours, isAvailable, displayhrs FROM operationHours ORDER BY id ASC";
		$results = $this->db->query($sql);
		return $results -> result();
	} 
	public function getBlockedHours($date){
		$sql = "SELECT hourid FROM hoursInstructions WHERE '$date' BETWEEN startDate AND endDate";
		$results = $this->db->query($sql, array($date));
		return $results -> result();
	} 
	public function getDisplayHours($hour){
		$sql = "SELECT displayhrs FROM operationHours WHERE hours = '$hour';";
		$results = $this->db->query($sql, array($hour));
		return $results -> result();
	}
	public function getEmails(){
		$sql = "SELECT email, userID FROM reserver";
		$results = $this->db->query($sql);
		return $results -> result();
	} 

	public function getPwd($id){
		$this -> db -> select('pwd');
		$query = $this -> db -> get_where('passcode', array('id' => $id));
		foreach ($query -> result() as $row){
			$passcode = $row -> pwd;
		}
		return $passcode;		
 	}
	
	public function getAssociatedResId($rId){
		$sql = "SELECT max(resId) FROM reservations WHERE rId='$rId'";
		$results = $this->db->query($sql, array($rId));
		return $results -> result();
	}
		
	function updatetable($timeData, $unavailData){
		$this->db->empty_table('hours'); 
		$this->db->insert('hours', $timeData);
		$unavail = array(
			'isAvailable' => 0
		);
		$avail = array(
			'isAvailable' => 1
		);
		$rooms = array(
			110,
			111,
			112,
			"300A",
			"300B",
			"300C",
			"300D",
			306,
			312,
			313,
			314,
			315,
			316,
			317,
			318
		);
		for($j = 0; $j < count($rooms); $j++){
			$this -> db -> where('roomNum', $rooms[$j]);
			$this -> db -> update('rooms', $avail);
		}
		for($i = 0; $i < count($unavailData); $i++){
			$this -> db -> where('roomNum', $unavailData[$i]);
			$this -> db -> update('rooms', $unavail);
		}
	}
	
	public function deleteRes($rId){
		$this->db->delete('reservations', array('rId' => $rId)); 
	}
	
	public function checkResId($resId){
		$sql = "SELECT resId FROM reservedSlots where resId = '$resId'";
		$results = $this->db->query($sql, array($resId));
		return $results->result();
	}
	
	public function getInstructions(){
		$sql = "SELECT startDate, endDate, hourId, displayhrs, instDate, iid FROM hoursInstructions INNER JOIN operationHours on hoursInstructions.hourId = operationHours.id ORDER BY instDate DESC"; 
		$results = $this->db->query($sql);
		return $results -> result();
 	}
	
	public function insert_instructions($data){
		$this->db->insert_batch('hoursInstructions', $data);	
		if($this->db->affected_rows()>0)
		{
			return 1;			
		}else{
			return 0;
		}
	}
	
	public function remove_instructions($iid){
		$this->db->delete('hoursInstructions', array('iid' => $iid)); 
		return 1;
	}
	
			
}
?>