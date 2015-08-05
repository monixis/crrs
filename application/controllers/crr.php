<?php
class crr extends CI_Controller {
	public function index() {
		$this -> load -> model('crr_model');
		$data['title'] = "JAC Collaboration Rooms";
		$data['rooms'] = $this -> crr_model -> getRooms();
		$data['hours'] = $this -> crr_model -> getHours();
		$data['passcode'] = $this -> crr_model -> getPwd(1);
		$this -> load -> view('crr_view', $data);
	}
	public function admin() {
		$this -> load -> model('crr_model');
		$startTime = $this -> input -> post('startTime');
		$numHrs = $this -> input -> post('numHrs');
		$timeData = array(
					'starttime' => $startTime,
					'totalhrs' => $numHrs,
				);
		$unavailData = $this -> input -> post('unavailRoom');	
		$this->crr_model->updatetable($timeData, $unavailData);
		$this -> load -> view('admin');
	}
	public function updateStatus(){
		$rId = $_POST['rId'];
		$status = $_POST['status'];
		$notes = $_POST['notes'];
 		$this -> load -> model('crr_model');
		$result = $this -> crr_model -> updateStatus($rId, $status, $notes);
		echo $result;
	}
	
	public function todayReservation(){
		$this -> load -> model('crr_model');
		$date = date("m/d/Y");
		$data['rooms'] = $this -> crr_model -> getRooms();
		$data['hours'] = $this -> crr_model -> getHours();
		$data['slots'] = $this -> crr_model -> getReservations($date);
		$date = str_replace("/", "", $date);
		$data['date'] = $date;
		$this -> load -> view('main_view', $data);
	}
	public function getReservations(){
		$this -> load -> model('crr_model');
		$date = $this -> input -> get('date');
		$data['rooms'] = $this -> crr_model -> getRooms();
		$data['hours'] = $this -> crr_model -> getHours();
		$data['slots'] = $this -> crr_model -> getReservations($date);
		$date = str_replace("/", "", $date);
		$data['date'] = $date;
		$this -> load -> view('main_view', $data);
	}
	public function searchResults(){
		$this -> load -> model('crr_model');
		//$searchBy = $_POST["searchBy"];
		//$searchText = $_POST["q"];
		$searchBy = $this -> input -> get('searchBy');
		$searchText = $this -> input -> get('q');
		$data['searchText'] = $searchText;
		if($searchBy == 'resId'){
			$data['details'] = $this -> crr_model -> getResDetails($searchText);
			$this -> load -> view('reservation_view', $data);
		}
		else if($searchBy == 'email'){
			$data['details'] = $this -> crr_model -> getEmailDetails($searchText);
			$this -> load -> view('emailsearch_view', $data);
		}
		else if($searchBy == 'room'){
			$data['details'] = $this -> crr_model -> getRoomSearchDetails($searchText);
			$this -> load -> view('roomsearch_view', $data);
		} 
		//$this -> load -> view('searchresult_view', $data);		
	}
	public function reservationDetails(){
		$this -> load -> model('crr_model');
		$resId = $this -> input -> get('resId');
		$data['details'] = $this -> crr_model -> getResDetails($resId);
		$this -> load -> view('reservation_view', $data);
	}

	public function reserveForm(){
		$this -> load -> model('crr_model');
 		$data['title'] = "JAC Collaboraseservation System";
 		//$data['rooms'] = $this -> crr_model -> getRooms();
 		//$data['hours'] = $this -> crr_model -> getHours();
		$data['emails'] = $this -> crr_model -> getEmails();
 		$resId = $this -> input -> get('resId');
 		$data['resId'] = $this -> input -> get('resId');
 		$rId = $this -> crr_model -> getmaxid('rId', 'reservations');
 		$this->load->library('form_validation');
 		$this->form_validation->set_rules('primEmail', 'Email', 'required|valid_email');
 		$this->form_validation->set_rules('secEmail', 'Email', 'required|valud_email');
 		if ($this->form_validation->run() == FALSE)
 		{
 			$this->load->view('reserveform_view', $data);
 		}
 		else
 		{
 			$reserverData = array(
 					'email' => $this->input->post('primEmail')
 			);
 			$reserver = $this->input->post('primEmail');
 			if($this->crr_model->getreserver($reserver)){
 				//echo ("in");
 				$this->crr_model->insert_user($reserverData);
 			}
 			$resDate = substr($resId, 0, 2) . "/" . substr($resId, 2, 2) . "/" . substr($resId, 4, 4);
 			if(substr($resId,11,1) == "A" || substr($resId,11,1) == "B"|| substr($resId,11,1) == "C" || substr($resId,11,1) == "D"){
 				$roomNum = substr($resId,8,4);
 				$time = substr($resId,12);
				if(strlen($time) == 4){
					$timeLim = substr($time, 0, 2) + .5;
					$limit = $this->input->post('numHours') + $timeLim;
					
				}
				else if(strlen($time) == 3) {
					$timeLim = substr($time, 0, 1) + .5;
					$limit = $this->input->post('numHours') + $timeLim;
				}
				else {
					$timeLim = $time;
					$limit = $this->input->post('numHours') + $timeLim;
				}
 			}
 			else {
 				$roomNum = substr($resId,8,3);
 				$time = substr($resId,11);
				if(strlen($time) == 4){
					$timeLim = substr($time, 0, 2) + .5;
					$limit = $this->input->post('numHours') + $timeLim;
					
				}
				else if(strlen($time) == 3) {
					$timeLim = substr($time, 0, 1) + .5;
					$limit = $this->input->post('numHours') + $timeLim;
				}
				else {
					$timeLim = $time;
					$limit = $this->input->post('numHours') + $timeLim;
				}
 			}
 				if($this->input->post('bookType') == "person")
 					$status = 1;
 				else
 					$status = 2;

			$secEmail = $this->input->post('secEmail');
			$comments = $this->input->post('Comments');
 			$totalHours = $this->input->post('numHours');
			for($timeLim; $timeLim < $limit; $timeLim = $timeLim + .5){
				$day = substr($resId, 2, 2); 
				$month = substr($resId, 0, 2);
				$year = substr($resId, 4, 4);
				if($timeLim == 24){
					$resTime = "00";
					$day = substr($resId, 2, 2); 
					$month = substr($resId, 0, 2);
					$year = substr($resId, 4, 4);
					if($month == "12"){
						if($day == 31){
							$day = "01";
							$month = "01";
						}
						else {
							$day = $day + 1;
							if($day < 10)
								$day = "0" . $day;
						}
					}
					if($month == "02"){
						$leapYear = FALSE;
						if($year %4 == 0){
							$leapYear = TRUE;
						}
						if(substr($year, 2, 2) == "00" && $year %400 == 0){
								$leapYear = TRUE;
						}
						if($leapYear){
							if($day == "29"){
								$day = "00";
								$month = "03";
							}
							else {
								$day = $day + 1;
								if($day < 10)
									$day = "0" . $day;
							}
						}
						else{
							if($day == 28){
								$day = "00";
								$month = "03";
							}
							else {
								$day = $day + 1;
								if($day < 10)
									$day = "0" . $day;
							}
						}
					}
					if($month == "04" || $month == "06" || $month == "09" || $month == "11"){
						if($day == 30){
							$day = "01";
							$month = $month + 1;
							if($month < 10)
								$month = "0" . $month;
						}
						else {
							$day = $day + 1;
							if($day < 10)
								$day = "0" . $day;
						}
					}
					if($month == "01" || $month == "03" || $month == "05" || $month == "07" || $month == "08" || $month == "10"){
						if($day == 31){
							$day = "01";
							$month = $month + 1;
							if($month < 10)
								$month = "0" . $month;
						}
						else {
							$day = $day + 1;
							if($day < 10)
								$day = "0" . $day;
						}
					}
					$resDate = $month . "/" . $day . "/" . $year;
					//$resId = $month . $day . $year . $roomNum . $resTime;
				}
				else if ($timeLim == 24.5){
					$resTime = "00.5";
					//$resId = substr($resId, 0, 8) . $roomNum . $resTime;
				}
				else if ($timeLim == 25){
 					$resTime = 1;
				}
				else if ($timeLim == 25.5){
					$resTime = 1.5;
					//$resId = substr($resId, 0, 8) . $roomNum . $resTime;
				}
				else if ($timeLim == 26){
 					$resTime = 2;
					//$resId = substr($resId, 0, 8) . $roomNum . $resTime;
				}
				else if ($timeLim == 26.5){
					$resTime = 2.5;
					//$resId = substr($resId, 0, 8) . $roomNum . $resTime;
				}
 				else {
					$resTime = $timeLim;
					//$resId = substr($resId, 0, 8) . $roomNum . $resTime;
 				}
				if(strpos($resTime, ".") > 0){
					if(substr($resTime, 1, 1) == "."){
						if(substr($resTime, 0, 1) == "0"){
							$inResTime = substr($resTime, 0, 1) . ":30";
							$resId = $month . $day . $year . $roomNum . "0" . substr($resTime, 0, 1) . "30";
						}
						else{
							$inResTime = substr($resTime, 0, 1) . ":30";
							$resId = $month . $day . $year . $roomNum . substr($resTime, 0, 1) . "30";
						}
					}
					else {
						$inResTime = substr($resTime, 0, 2) . ":30";
						$resId = $month . $day . $year . $roomNum . substr($resTime, 0, 2) . "30";
					}
				}
				else {
					$inResTime = $resTime . ":00";
					$resId = $month . $day . $year . $roomNum . $resTime;
				} 
 				$resData = array(
 					'resId' => $resId,
 					'roomNum' => $roomNum,
 					'resDate' => $resDate,
 					'startTime' => $inResTime,
 					'resEmail' => $this->input->post('primEmail'),
 					'resType' => $this->input->post('bookType'),
 					'status' => $status,
					'secEmail' => $secEmail,
					'comments' => $comments,
 					'totalHours' => $totalHours,
 					'rId' => $rId
 				);
			$result = $this->crr_model->insert_reservation($resData);
			$data['result']= $result;
			}
		if ($result == 1){
			$data['info'] = "The reservation is complete. Reservation id: " . $resId;	
		}elseif ($result == 0){
			$data['info'] = "Reservation Conflict. Reservation could not be completed";
		}	
		$this->load->view('verify_view', $data);
	}
}
		//$this -> load -> view('reserveform_view', $data);
	public function disclaimer(){
		$this -> load -> view('disclaimer');	
	}	
	
	public function roomDetails(){
		$this -> load -> model('crr_model');
		$roomNo = $this -> input -> get('roomNo');
		$data['details'] = $this -> crr_model -> getRoomDetails($roomNo);
		$this -> load -> view('roomdetails_view', $data);
	}
	
}
?>