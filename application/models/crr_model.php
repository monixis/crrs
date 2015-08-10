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
	
	public function updateStatus($rId, $status, $notes){
		$sql = "UPDATE reservations SET status = '$status' WHERE rId = '$rId' ;";
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
		$sql = "SELECT resId, resDate, startTime, resEmail, resType, roomNum, status.status, reservations.status as 'statusId', totalHours, rId FROM reservations inner join status on reservations.status = status.statusNum WHERE resId = '$resId';";
		$results = $this->db->query($sql, array($resId));
		return $results -> result();
		//return $sql;
	}
	public function getRoomSearchDetails($roomNum){
		$sql = "SELECT resId, resDate, startTime, resEmail, resType, roomNum, status.status, reservations.status as 'statusId' FROM reservations inner join status on reservations.status = status.statusNum WHERE roomNum = '$roomNum';";
		$results = $this->db->query($sql, array($roomNum));
		return $results -> result();
		//return $sql;
	}
	public function getEmailDetails($email){
		$sql = "SELECT resId, resDate, startTime, resEmail, resType, roomNum, status.status, reservations.status as 'statusId' FROM reservations inner join status on reservations.status = status.statusNum WHERE resEmail = '$email';";
		$results = $this->db->query($sql, array($email));
		return $results -> result();
		//return $sql;
	}
	
	public function getReservations($date){
		$sql = "SELECT resId, status FROM reservations WHERE resDate = '$date' and status != 3;";
		$results = $this->db->query($sql, array($date));
		return $results -> result();
		//return $sql;
 	}
	
	public function insert_user($email) {
		$this->db->insert('reserver', $email);
	}
	
	public function insert_reservation($data){
		$this->db->insert('reservations', $data);	
		if($this->db->affected_rows()>0)
		{
			return 1;			
		}else{
			return 0;
		}
	}
	
	public function getRooms($date){
		$sql = "SELECT roomNum FROM rooms WHERE roomNum NOT IN(SELECT roomNum FROM roomInstructions WHERE '$date' BETWEEN startDate AND endDate)";
		$results = $this->db->query($sql, array($date));
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
}
?>