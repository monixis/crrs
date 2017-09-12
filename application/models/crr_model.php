<?php
class crr_model extends CI_Model
{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		// $this->load->database();
	}

	function getreserver($res)
	{
		$sql = "SELECT email FROM reserver WHERE email = '$res';";
		$results = $this->db->query($sql, array($res));
		$row = $results->row_array();
		if (sizeof($row) > 0 && $row['email'] == $res) {
			return false;

		} else {
			return true;
		}
	}

	function isreserved($res)
	{
		$sql = "SELECT resId FROM reservations WHERE resId = '$res';";
		$results = $this->db->query($sql, array($res));
		$result = json_decode(json_encode($results), true);
		//	print_r($result);
		if ($result == $res)
			return TRUE;
		else {
			return FALSE;
		}
	}
/*    public function getResDates(){
        $sql = "SELECT rId, entDate, createdDttm FROM reservations";
        $results = $this->db->query($sql);
        return $results->result();

    }
    public function updateCreatedDttm($newDate, $rId){
        $sql = "UPDATE reservations SET createdDttm = '$newDate' WHERE rId = '$rId';";
        if ($this->db->simple_query($sql, array($rId))) {
            return 1;
        } else {
            return 0;
        }
    }*/
    public function getAllReservations($fromDate, $toDate){
        $sql = " SELECT DISTINCT
		reservations.rId AS rid,
		reservations.resDate AS resDate,
		reservations.resEmail AS resEmail,
        reservations.resType AS resType,
        reservations.roomNum AS roomNum,
        reservations.status AS status,
        reservations.startTime AS startTime,
        reservations.totalHours AS totalHours,
        reservations.numPatrons AS numPatrons
    FROM
        reservations
    WHERE

            reservations.createdDttm BETWEEN '$fromDate' AND '$toDate'";
        $results = $this->db->query($sql);
        return $results->result();


    }
	public function updateStatus($rId, $status, $currentTimeStamp)
	{
		$sql = "UPDATE reservations SET status = '$status' , createdDttm = '$currentTimeStamp' WHERE rId = '$rId' AND status IN (1,2);";
		if ($this->db->simple_query($sql, array($rId, $status))) {
			return 1;
		} else {
			return 0;
		}
	}


	public function getCategories(){

        $sql = "Select * from category";
        $results = $this->db->query($sql);
        return $results->result();

    }
    public function getPatrons(){

        $sql = "Select * from patron";
        $results = $this->db->query($sql);
        return $results->result();
    }

    public function getRoomsOnCatg_Patr($cat_id, $pat_id){
        $sql = "Select roomNum from catg_patr_room where catg_id='$cat_id' and patr_id='$pat_id'";
        $results = $this->db->query($sql);
        return $results->result();

    }
	public function updateSlotStatus($rId, $resId, $status, $currentTimeStamp)
	{
		$sql = "UPDATE reservations SET status = '$status' , createdDttm = '$currentTimeStamp' WHERE resId = '$resId' AND rid = '$rId';";
		if ($this->db->simple_query($sql, array($resId, $status))) {
			/*if (strlen($notes) > 0){
				$sql1 = "INSERT into notes(resId, note) VALUES ('$rId', '$notes');";
				if ($this->db->simple_query($sql1, array($rId, $notes))){
					return 1;
				}else{
					return 0;
				}
			}
			else{
				return 1;
			}*/
			return 1;
		} else {
			return 0;
		}
	}

	function getmaxid($col, $table)
	{
		$this->db->select_max($col);
		$query = $this->db->get($table);
		foreach ($query->result() as $row) {
			$maxval = $row->$col;
		}
		$maxval = $maxval + 1;
		return $maxval;
	}

	public function getRoomDetails($roomno)
	{
		$sql = "SELECT roomNum, seats, computers, windows, whiteboards FROM rooms WHERE roomNum = '$roomno';";
		$results = $this->db->query($sql, array($roomno));
		return $results->result();
	}

	public function getResDetails($resId)
	{
		$sql = "SELECT resId, resDate, startTime, resEmail, secEmail, resPhone, resType, roomNum, status.status, reservations.status as 'statusId', totalHours, rId, comments, numPatrons,createdDttm FROM reservations inner join status on reservations.status = status.statusNum WHERE resId = '$resId' ORDER BY rId ASC;";
		$results = $this->db->query($sql, array($resId));
		return $results->result();
	}

	public function getResDetails1($rId)
	{
		$sql = "SELECT DISTINCT rId, resDate, startTime, resEmail, secEmail, resPhone, resType, roomNum, status.status, reservations.status as 'statusId', totalHours, comments, numPatrons,createdDttm FROM reservations inner join status on reservations.status = status.statusNum WHERE rId = '$rId';";
		$results = $this->db->query($sql, array($rId));
		return $results->result();
	}

	public function getRoomSearchDetails($roomNum)
	{
		$sql = "SELECT resId, resDate, startTime, resEmail, resType, roomNum, status.status, reservations.status as 'statusId' FROM reservations inner join status on reservations.status = status.statusNum WHERE roomNum = '$roomNum';";
		$results = $this->db->query($sql, array($roomNum));
		return $results->result();
	}

	public function getEmailDetails($email)
	{
		$sql = "SELECT DISTINCT resDate, rId, status.status as 'status', reservations.status as 'statusId' FROM reservations INNER JOIN status ON reservations.status = status.statusNum WHERE resEmail = '$email' AND reservations.status NOT IN (3,5) ORDER BY rId DESC;";
		$results = $this->db->query($sql, array($email));
		return $results->result();
	}

	public function getresIdDetails($resId)
	{
		$sql = "SELECT DISTINCT resDate, rId,resEmail, status.status as 'status', reservations.status as 'statusId' FROM reservations INNER JOIN status ON reservations.status = status.statusNum WHERE rId = '$resId' AND reservations.status NOT IN (3,5) ORDER BY rId DESC;";
		$results = $this->db->query($sql, array($resId));
		return $results->result();
	}

	public function getNotes($email)
	{
		$sql = "SELECT email, notes, date FROM notes WHERE email = '$email' ORDER BY date DESC";
		$results = $this->db->query($sql, array($email));
		return $results->result();
	}

	public function getReservations($date)
	{
		//$sql = "SELECT resId, status, rId FROM reservations WHERE resDate = '$date' and status NOT IN (3,5);";
		$sql = "SELECT resId, status, resEmail, rId FROM reservations WHERE resDate = '$date' and status NOT IN (3,5,6);";
		$results = $this->db->query($sql, array($date));
		return $results->result();
	}

	public function insert_user($email)
	{
		$this->db->insert('reserver', $email);
	}

	public function insert_reservation($data, $table)
	{
		$this->db->insert($table, $data);
		if ($this->db->affected_rows() > 0) {
			return 1;
		} else {
			return 0;
			//return $this->db->_error_number();
		}
	}

	public function getNewReservations($timestamp)
	{

		$sql = "SELECT resId, status, rId FROM reservations WHERE  createdDttm >='$timestamp' ;";
		$results = $this->db->query($sql);
		return $results->result();

	}

  public function getReservation($rId){

	 $sql = "SELECT resId FROM reservations where id=(SELECT max(id) FROM reservations where rid='$rId' and status not in (3,5))";
	  //$sql ="SELECT max(id),resId FROM reservations where rId='$rId'";
	  $results = $this->db->query($sql);

	  return $results->result();

  }
	public function getRooms()
	{
		//$sql = "SELECT roomNum FROM rooms WHERE roomNum NOT IN(SELECT roomNum FROM roomInstructions WHERE '$date' BETWEEN startDate AND endDate)";
		$sql = "SELECT roomNum FROM rooms WHERE isAvailable = 1";
		$results = $this->db->query($sql, array());
		return $results->result();
	}

	public function getResIds()
	{
		$sql = "SELECT resId FROM reservations;";
		$results = $this->db->query($sql);
		return $results->result();
	}

	public function getHours()
	{
		$sql = "SELECT id, hours, isAvailable, displayhrs FROM operationHours ORDER BY id ASC";
		$results = $this->db->query($sql);
		return $results->result();
	}

	public function getUnavailableHours($date)
	{

		$sql = "SELECT  hours FROM operationHours WHERE  id in (SELECT hourId from hoursInstructions WHERE '$date' BETWEEN startDate AND endDate);";
		$results = $this->db->query($sql);
		return $results->result();

	}
	public function checkBlockedHour($date,$hour){

		$sql = "SELECT  hours FROM operationHours WHERE hours='$hour' and id in (SELECT hourId from hoursInstructions WHERE '$date' BETWEEN startDate AND endDate);";
		$results = $this->db->query($sql,array($hour));
		return $results->result();

	}

	public function getBlockedHours($date)
	{
		$sql = "SELECT hourId FROM hoursInstructions WHERE '$date' BETWEEN startDate AND endDate";
		//$sql = "SELECT hourid FROM hoursInstructions WHERE 12/29/2015 >= startDate AND 12/29/2015 <= endDate";
		$results = $this->db->query($sql, array($date));
		return $results->result();
	}

	public function getDisplayHours($hour)
	{
		$sql = "SELECT displayhrs FROM operationHours WHERE hours = '$hour';";
		$results = $this->db->query($sql, array($hour));
		return $results->result();
	}

	public function getEmails()
	{
		$sql = "SELECT email, userID FROM reserver";
		$results = $this->db->query($sql);
		return $results->result();
	}

	public function getPwd($id)
	{
		$this->db->select('pwd');
		$query = $this->db->get_where('passcode', array('id' => $id));
		foreach ($query->result() as $row) {
			$passcode = $row->pwd;
		}
		return $passcode;
	}

	public function getAssociatedResId($rId)
	{
		$sql = "SELECT max(resId) FROM reservations WHERE rId='$rId'";
		$results = $this->db->query($sql, array($rId));
		return $results->result();
	}

	function updatetable($timeData, $unavailData)
	{
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
		for ($j = 0; $j < count($rooms); $j++) {
			$this->db->where('roomNum', $rooms[$j]);
			$this->db->update('rooms', $avail);
		}
		for ($i = 0; $i < count($unavailData); $i++) {
			$this->db->where('roomNum', $unavailData[$i]);
			$this->db->update('rooms', $unavail);
		}
	}

	public function updateResDetails($rId, $resEmail, $secEmail, $resPhone, $numPatrons, $comments)
	{

		$sql = "UPDATE reservations SET resEmail = '$resEmail', secEmail= '$secEmail',resPhone ='$resPhone', numPatrons = '$numPatrons' , comments = '$comments' WHERE  rId = '$rId'";

		if ($this->db->simple_query($sql, array($rId))) {

			return 1;
		} else {

			return 0;
		}

	}

	public function deleteRes($rId)
	{
		$this->db->delete('reservations', array('rId' => $rId));
	}

	public function getReservedSlots($rId)
	{

		$sql = "SELECT rId,resId,resDate FROM reservations WHERE rId = '$rId'";
		$results = $this->db->query($sql, array($rId));
		return $results->result();

	}

	public function checkResId($resId)
	{
			$sql = "SELECT resId FROM reservedSlots where resId = '$resId'";
		$results = $this->db->query($sql, array($resId));
		return $results->result();
	}

	public function getInstructions()
	{
		$sql = "SELECT startDate, endDate, hourId, displayhrs, instDate, iid FROM hoursInstructions INNER JOIN operationHours on hoursInstructions.hourId = operationHours.id ORDER BY instDate DESC";
		$results = $this->db->query($sql);
		return $results->result();
	}

	public function insert_instructions($data)
	{
		$this->db->insert_batch('hoursInstructions', $data);
		if ($this->db->affected_rows() > 0) {
			return 1;
		} else {
			return 0;
		}
	}

	public function remove_instructions($iid)
	{
		$this->db->delete('hoursInstructions', array('iid' => $iid));
		return 1;
	}

	public function addANote($email, $notes)
	{
		$date = date("Y/m/d");
		$sql1 = "INSERT into notes(email, notes, date) VALUES ('$email', '$notes', '$date');";
		if ($this->db->simple_query($sql1, array($email, $notes, $date))) {
			return 1;
		} else {
			return 0;
		}
	}

	public function getPatronCount($date)
	{
		$sql = "SELECT time, sum(numPatrons) as 'patroncount' FROM reservations WHERE resDate= '$date' AND status NOT IN (2,3,5,6) GROUP BY time ORDER BY time ASC";
		$results = $this->db->query($sql, array($date));
		return $results->result();
	}

	public function getBlockedRooms()
	{
		$sql = "SELECT roomNum FROM rooms WHERE isAvailable = 0";
		$results = $this->db->query($sql, array());
		return $results->result();
	}

	public function updateRoomStatus($room, $s)
	{
		$sql = "UPDATE rooms SET isAvailable = '$s' WHERE roomNum = '$room'";
		if ($this->db->simple_query($sql, array($s, $room))) {
			return 1;
		} else {
			return 0;
		}
	}
	public function data()
	{
		$sql = "SELECT resId FROM reservations";
		$results = $this->db->query($sql);
		return  json_decode(json_encode($results), true);

	}

	public function newReservations($id){

		$sql = "SELECT * from reservations where id > '$id' ";
		$results = $this->db->query($sql, array($id));
		return  json_decode(json_encode($results), true);

	}

	public function getAllBookingRequirements(){

        $sql = "SELECT roomNum, id,catg_name,patr_name, patr_req, maxHour from catg_patr_room join category on category.catg_id=catg_patr_room.catg_id join patron on patron.patr_id= catg_patr_room.patr_id ;";
        $results = $this->db->query($sql);
        return $results->result();

    }
    public function addBookingRequirements($roomNum, $catg_id, $patr_id, $patr_req, $maxHour){
        $sql= "INSERT into catg_patr_room(catg_id, patr_id, roomNum, patr_req, maxHour) VALUES ('$catg_id', '$patr_id', '$roomNum', '$patr_req', '$maxHour');";

        if ($this->db->simple_query($sql, array($catg_id, $patr_id, $roomNum, $patr_req, $maxHour))) {
            return 1;
        } else {
            return 0;
        }
    }

    public function updateBookingRequirements($roomNum, $catg_id, $patr_id, $patr_req, $maxHour){
      $sql = "UPDATE catg_patr_room SET maxHour = '$maxHour', patr_req = '$patr_req' WHERE roomNum = '$roomNum' AND catg_id = '$catg_id' AND patr_id = '$patr_id';";

      if ($this->db->query($sql, array($catg_id, $patr_id, $patr_req, $maxHour, $roomNum))) {
          return 1;
      } else {
          return 0;
      }
    }

    public function checkExistingBookingRequirements($roomNum, $catg_id, $patr_id){
      // SQL Statment to see if there is already a  booking requirement for this room with the same patron and category
      $sql = "SELECT id FROM catg_patr_room WHERE catg_id = '$catg_id' AND patr_id = '$patr_id' AND roomNum = '$roomNum';";

      // Returns true if there is an existing record, false if not
      $query = $this->db->query($sql, array($catg_id, $patr_id, $roomNum));

      // Returns 1 if there is an existing requiremnt for the room for the specified patron and category
      if ($query->num_rows() > 0) {
        return 1;
      }
      else {
        return 0;
      }
    }

    public function removeBookingRequirements($id){

     if($this->db->delete('catg_patr_room', array('id' => $id))) {
         return 1;
     }else{
         return 0;
     }
     }

	public function getReq($pat, $cat, $roomNum)
	{
		$sql = "SELECT patr_req, maxHour FROM catg_patr_room WHERE patr_id = '$pat' AND catg_id = '$cat' AND roomNum = '$roomNum'";
		$results = $this->db->query($sql, array());
		return $results->result();
	}
}
?>
