<?php
class crr extends CI_Controller {


	public function __construct()
	{
		parent::__construct();

	}

	public function index() {

		$this -> load -> model('crr_model');
		$data['title'] = "JAC Collaboration Rooms";
		$date = date("m/d/Y");
		$data['rooms'] = $this -> crr_model -> getRooms($date);
		$data['hours'] = $this -> crr_model -> getHours();
		$data['resId'] = $this -> crr_model -> getResIds();
		$data['passcode'] = $this -> crr_model -> getPwd(1);
		$data['Apasscode'] = $this -> crr_model -> getPwd(2);
		$data['emails'] = $this -> crr_model -> getEmails();
		$data['blockedHours'] = $this -> crr_model -> getBlockedHours($date) ;
		$this -> load -> view('crr_view', $data);
	}

	public function admin() {
		$this -> load -> model('crr_model');
		$data['hours'] = $this ->data['hours'];
		$data['hours'] = $this -> crr_model -> getHours();
		$data['instructions'] = $this -> crr_model -> getInstructions();
		$this -> load -> view('admin', $data);
	}

	public function updateStatus(){
		$rId = $_POST['rId'];
		$status = $_POST['status'];
		//$timestamp = $_POST['time'];
		//$currentTimeStamp = substr($timestamp, 0,10)." ". substr($timestamp, 11,19);
		date_default_timezone_set('US/Eastern');
		$currentTimeStamp = date("Y-m-d H:i:s");
		$this -> load -> model('crr_model');
		$result = $this ->crr_model -> getReservedSlots($rId) ;
		$slots = json_decode(json_encode($result), true);
		$dateString = strtotime($currentTimeStamp);
		$currentHours = date('H', $dateString);
		$currentMin = date('i',$dateString);
		$currentTime = $currentHours.$currentMin;


		foreach($slots as $slot){
			$resId = $slot['resId'];
			if (substr($resId, 11, 1) == "A" || substr($resId, 11, 1) == "B" || substr($resId, 11, 1) == "C" || substr($resId, 11, 1) == "D") {

				$SlotTime = substr($resId, 12);
				if (strlen($SlotTime) == 2) {
					$SlotTime = $SlotTime * 100;
				}
				if ($SlotTime > $currentTime) {
					$status = 5;
					$result = $this->crr_model->updateSlotStatus($rId, $resId, $status, $currentTimeStamp);

				} else {

					$status = $_POST['status'];
					$result = $this->crr_model->updateStatus($rId, $status, $currentTimeStamp);
				}
			}else{

				$SlotTime = substr($resId, 11);
				if(strlen($SlotTime) == 2 ){
					$SlotTime = $SlotTime*100;
				}
				if ($SlotTime > $currentTime) {
					$status = 5;
					$result = $this->crr_model->updateSlotStatus($rId, $resId, $status, $currentTimeStamp);

				} else {
					$status = $_POST['status'];
					$result = $this->crr_model->updateStatus($rId, $status, $currentTimeStamp);

				}

			}

		}

		echo $result;
	}
    public function update(){

       $rId = $this -> input -> get('rId');

	    $this -> load -> model('crr_model');
		$result = $this ->crr_model -> getReservedSlots($rId) ;
		$slots = json_decode(json_encode($result), true);
		date_default_timezone_set('US/Eastern');
		$date = new DateTime();
        $date =  $date->format('Y-m-d H:i:s');

		$dateString = strtotime($date);
		$currentHours = date('H', $dateString);
        $currentMin = date('i',$dateString);
		$currentTime = $currentHours.$currentMin;

		foreach($slots as $slot){
				$resId = $slot['resId'];

			if (substr($resId, 11, 1) == "A" || substr($resId, 11, 1) == "B" || substr($resId, 11, 1) == "C" || substr($resId, 11, 1) == "D") {
				$SlotTime = substr($resId, 12);
				if(strlen($SlotTime) == 2 ){
					$SlotTime = $SlotTime*100;
				}
				if ($SlotTime > $currentTime) {
					$status = 5;
					$result = $this->crr_model->updateSlotStatus($rId, $resId, $status, $date);

				} else {

					$status = 4;
					$result = $this->crr_model->updateStatus($rId, $status, $date);

				}
			} else
			{
				$SlotTime = substr($resId, 11);
				if(strlen($SlotTime) == 2 ){
					$SlotTime = $SlotTime*100;
				}
				if ($SlotTime > $currentTime) {
					$status = 5;
					$result = $this->crr_model->updateSlotStatus($rId, $resId, $status, $date);

				} else {

					$status = 4;
					$result = $this->crr_model->updateStatus($rId, $status, $date);

				}
			}

			}

       echo $result;

	}

	public function updateResDetails(){

       $rId = $_POST['rId'];
		$resEmail = $_POST['resEmail'];
		$secEmail = $_POST['secEmail'];
		$resPhone = $_POST['resPhone'];
		$numPatrons = $_POST['numPatrons'];
		$comments = $_POST['comments'];

		$this ->load -> model('crr_model');
		if($this->crr_model->getreserver($resEmail)){
			$reserverData = array(
				'email' => $resEmail
			);
			$this->crr_model->insert_user($reserverData);

			//echo "true";
		}
		$result = $this ->crr_model -> updateResDetails($rId,$resEmail,$secEmail,$resPhone,$numPatrons,$comments);

		echo $result;

	}
	public function updateSlotStatus(){
		$rId = $_POST['rId'];
		$resId = $_POST['resId'];
		$status = $_POST['status'];
		$this -> load -> model('crr_model');
		$currentTimeStamp = date("Y-m-d H:i:s");

		$result = $this -> crr_model -> updateSlotStatus($rId, $resId, $status,$currentTimeStamp);
		echo $result;
	}

	public function todayReservation(){
		$this -> load -> model('crr_model');
		$date = date("m/d/Y");
		//$dateFormat = date("Y-m-d");
		//	echo $dateFormat;
		$data['rooms'] = $this -> crr_model -> getRooms($date);
		$data['hours'] = $this -> crr_model -> getHours();
		$data['slots'] = $this -> crr_model -> getReservations($date);
		$data['blockedHours'] = $this -> crr_model -> getBlockedHours($date);
		$data['emails'] = $this -> crr_model -> getEmails();
		$date = str_replace("/", "", $date);
		$data['date'] = $date;
		$reservation = parse_ini_file('reservation.ini');
		$size = sizeof($reservation);

		if($size>0 ) {
			$data['tentativeSlots'] = $reservation;

		}else{
			$data['tentativeSlots']    = null;
		}

		$this -> load -> view('main_view', $data);
	}



	public function getReservations(){
		$this -> load -> model('crr_model');
		$date = $this -> input -> get('date');
		$strings = explode("/",$date);
		/*$dateFormat="$strings[2]-$strings[0]-$strings[1]";*/
		$data['rooms'] = $this -> crr_model -> getRooms($date);
		$data['hours'] = $this -> crr_model -> getHours();
		$data['slots'] = $this -> crr_model -> getReservations($date);
		$data['blockedHours'] = $this -> crr_model -> getBlockedHours($date);//use $dateFormat for mysql database
		$date = str_replace("/", "", $date);
		$data['date'] = $date;
		$reservation = parse_ini_file('reservation.ini');
		$size = sizeof($reservation);
		$data['tentativeSlots']    = null;
		$data['NewSlots'] = null;
		if($size>0 ) {
			$data['tentativeSlots'] = $reservation;
		}
		//}
		$this -> load -> view('main_view', $data);
	}

	public function reservations(){
		$this -> load -> model('crr_model');
		$date = $this -> input -> get('date');
		$strings = explode("/",$date);
		$data['slots'] = $this -> crr_model -> getReservations($date);
		$date = str_replace("/", "", $date);
		$data['date'] = $date;
		$reservation = parse_ini_file('reservation.ini');
		$size = sizeof($reservation);
		$data['tentativeSlots']    = null;
		if($size>0 ){
			$data['tentativeSlots'] = $reservation;
			//fopen("reservation.ini", 'w');
		}
		$this -> load -> view('main_view', $data);
	}
	public function search(){
		$this -> load -> model('crr_model');
		$email = $this -> input -> get('q');
		$data['email'] = $email;
		$data['details'] = $this -> crr_model -> getEmailDetails($email);
		$data['notes'] = $this -> crr_model -> getNotes($email);
		$this -> load -> view('search_view', $data);
	}

	public function reservationDetails(){
		$this -> load -> model('crr_model');
		$resId = $this -> input -> get('resId');
		$data['details'] = $this -> crr_model -> getResDetails($resId);
		$data['emails'] = $this -> crr_model ->getEmails();
		$data['resId'] = $resId;
		$this -> load -> view('reservation_view', $data);
	}

	public function readonlyReservationDetails(){
		$this -> load -> model('crr_model');
		$resId = $this -> input -> get('resId');
		$data['details'] = $this -> crr_model -> getResDetails($resId);
		$data['resId'] = $resId;
		$this -> load -> view('readonlyreservation_view', $data);
	}

	public function reservationDetails1(){
		$this -> load -> model('crr_model');
		$rId = $this -> input -> get('rId');
		$data['details'] = $this -> crr_model -> getResDetails1($rId);
		$data['resId'] = 0;
		$this -> load -> view('reservation_view', $data);
	}

	public function verifyReservations(){

		date_default_timezone_set('US/Eastern');
		$date = new DateTime();

		//$endDate = $date->format('m/d/Y H:i:s');
		$this->load->model('crr_model');
		//$data['title'] = "JAC Collaboraseservation System";

		$data['emails'] = $this->crr_model->getEmails();
		$resId = $this->input->get('resId');
		$data['resId'] = $this->input->get('resId');
		$reservation = parse_ini_file('reservation.ini');

		if (in_array($resId, $reservation)) {

			$this->load->view('reserve_conflict');

		} else if ($this->crr_model->checkResId($resId)) {

			//checking if it is selected for reservation
			$this->load->view('reserve_conflict');

		}else {
			$tentative = true;
			$data['tentative'] = $tentative;
			$resDate = substr($resId, 0, 2) . "/" . substr($resId, 2, 2) . "/" . substr($resId, 4, 4);
			if (substr($resId, 11, 1) == "A" || substr($resId, 11, 1) == "B" || substr($resId, 11, 1) == "C" || substr($resId, 11, 1) == "D") {
				$roomNum = substr($resId, 8, 4);
				$time = substr($resId, 12);
				$startTime = substr($resId, 12);

				if (strlen($time) == 4) {
					$timeLim = substr($time, 0, 2) + .5;
					$limit = 3 + $timeLim;

				} else if (strlen($time) == 3) {
					$timeLim = substr($time, 0, 1) + .5;
					$limit = 3 + $timeLim;
				} else {
					$timeLim = $time;

					$limit = 3 + $timeLim;
				}
			} else {
				$roomNum = substr($resId, 8, 3);
				$time = substr($resId, 11);
				$startTime = substr($resId, 11);
				if (strlen($time) == 4) {
					$timeLim = substr($time, 0, 2) + .5;
					$limit = 3 + $timeLim;

				} else if (strlen($time) == 3) {
					$timeLim = substr($time, 0, 1) + .5;
					$limit = 3 + $timeLim;
				} else {
					$timeLim = $time;
					$limit = 3 + $timeLim;
				}
			}
			if (strlen($startTime) == 4) {
				$startTime = substr($startTime, 0, 2) . ":" . substr($startTime, 2);
			} else if (strlen($startTime) == 3) {
				$startTime = substr($startTime, 0, 1) . ":" . substr($startTime, 1);
			} else {
				$startTime = $startTime . ":00";
			}
			$tentativeSlots = array();

			for ($timeLim; $timeLim < $limit; $timeLim = $timeLim + .5) {
				$day = substr($resId, 2, 2);
				$month = substr($resId, 0, 2);
				$year = substr($resId, 4, 4);
				if ($timeLim == 24) {
					$resTime = "00";
					$day = substr($resId, 2, 2);
					$month = substr($resId, 0, 2);
					$year = substr($resId, 4, 4);
					if ($month == "12") {
						if ($day == 31) {
							$day = "01";
							$month = "01";
						} else {
							$day = $day + 1;
							if ($day < 10)
								$day = "0" . $day;
						}
					}
					if ($month == "02") {
						$leapYear = FALSE;
						if ($year % 4 == 0) {
							$leapYear = TRUE;
						}
						if (substr($year, 2, 2) == "00" && $year % 400 == 0) {
							$leapYear = TRUE;
						}
						if ($leapYear) {
							if ($day == "29") {
								$day = "00";
								$month = "03";
							} else {
								$day = $day + 1;
								if ($day < 10)
									$day = "0" . $day;
							}
						} else {
							if ($day == 28) {
								$day = "00";
								$month = "03";
							} else {
								$day = $day + 1;
								if ($day < 10)
									$day = "0" . $day;
							}
						}
					}
					if ($month == "04" || $month == "06" || $month == "09" || $month == "11") {
						if ($day == 30) {
							$day = "01";
							$month = $month + 1;
							if ($month < 10)
								$month = "0" . $month;
						} else {
							$day = $day + 1;
							if ($day < 10)
								$day = "0" . $day;
						}
					}
					if ($month == "01" || $month == "03" || $month == "05" || $month == "07" || $month == "08" || $month == "10") {
						if ($day == 31) {
							$day = "01";
							$month = $month + 1;
							if ($month < 10)
								$month = "0" . $month;
						} else {
							$day = $day + 1;
							if ($day < 10)
								$day = "0" . $day;
						}
					}
					$resDate = $month . "/" . $day . "/" . $year;
				} else if ($timeLim == 24.5) {
					$resTime = "00.5";
					//$resId = substr($resId, 0, 8) . $roomNum . $resTime;
				} else if ($timeLim == 25) {
					$resTime = 1;
					//$resId = substr($resId, 0, 8) . $roomNum . $resTime;
				} else if ($timeLim == 25.5) {
					$resTime = 1.5;
					//$resId = substr($resId, 0, 8) . $roomNum . $resTime;
				} else if ($timeLim == 26) {
					$resTime = 2;
					//$resId = substr($resId, 0, 8) . $roomNum . $resTime;
				} else if ($timeLim == 26.5) {
					$resTime = 2.5;
					//$resId = substr($resId, 0, 8) . $roomNum . $resTime;
				} else {
					$resTime = $timeLim;
					//$resId = substr($resId, 0, 8) . $roomNum . $resTime;
				}
				if (strpos($resTime, ".") > 0) {
					if (substr($resTime, 1, 1) == ".") {
						if (substr($resTime, 0, 1) == "0") {
							$inResTime = substr($resTime, 0, 1) . ":30";
							$resId = $month . $day . $year . $roomNum . "0" . substr($resTime, 0, 1) . "30";
						} else {
							$inResTime = substr($resTime, 0, 1) . ":30";
							$resId = $month . $day . $year . $roomNum . substr($resTime, 0, 1) . "30";
						}
					} else {
						$inResTime = substr($resTime, 0, 2) . ":30";
						$resId = $month . $day . $year . $roomNum . substr($resTime, 0, 2) . "30";
					}
				} else {
					$inResTime = $resTime . ":00";
					$resId = $month . $day . $year . $roomNum . $resTime;
				}
				array_push($tentativeSlots, $resId);

			}


			$reservation = parse_ini_file('reservation.ini');
			$size = sizeof($reservation);
			if($size>0){
				for($i=0; $i<$size ; $i++){
					array_push($tentativeSlots, $reservation[$i]);
				}
			}
			$i = 0;
			$fp = fopen("reservation.ini", 'w');
			foreach ($tentativeSlots as $resId) {
				$string = "$i = $resId \n";
				fwrite($fp, $string);
				$i++;
			}
			$this->load->view('reserveform_view', $data);
		}


	}
 public function getBlockedHours(){

	 $resId= $this ->input -> get('resId');
	 $this -> load -> model('crr_model');
	 $time = substr($resId,11);
     $totalHours = 3;
	 $NonOperatinghours= $this -> crr_model -> getUnavailableHours();
	 $NonOperatinghours = json_decode(json_encode($NonOperatinghours), true);
	 $unavailableHours = array();
	 foreach($NonOperatinghours as $hour){
		 $hour = str_replace(":","",$hour['hours']);
		 array_push($unavailableHours,$hour);
	 }
	 $availableTime = $totalHours;
	 echo $time;
     for($i=0;$i<$totalHours;$i+= 0.5){
        echo "___";
		 if(in_array($time,$unavailableHours)){
			 $availableTime = $availableTime - 0.5;
		 }
		 if(strlen($time) == 1 || strlen($time) == 2) {
			 if($time == 0){
				 $time = $time+30;

			 }elseif($time ==30){
				 $time = $time + 70;
				 $time = $time / 100;
			 }else {
				 $time = $time * 100;
				 $time = $time + 30;
			 }
            echo $time;

		 }elseif(strlen($time)==4 || strlen($time)==3 ){

			 $time = $time + 70;
			 $time = $time / 100;
			 echo $time;
		 }

	 }
	 echo "___";

	 echo $availableTime;

 }
	public function reserveForm() {
		date_default_timezone_set('US/Eastern');
		$date = new DateTime();
		//$fp = fopen("reservation.ini", 'w');
		/*
         * Below changes are to match with the date format in mysql
         */
		//$endDate = $date->format('Y-m-d H:i:s');
		$endDate = $date->format('m/d/Y H:i:s');
		$this -> load -> model('crr_model');
		$data['title'] = "JAC Collaboraseservation System";
		$data['emails'] = $this -> crr_model -> getEmails();
		$NonOperatinghours= $this -> crr_model -> getUnavailableHours();
		$NonOperatinghours = json_decode(json_encode($NonOperatinghours), true);
		$unavailableHours = array();
		foreach($NonOperatinghours as $hour){
			$hour = str_replace(":","",$hour['hours']);
			array_push($unavailableHours,$hour);
		}

		$resId = $this -> input -> get('resId');
		$data['resId'] = $this -> input -> get('resId');
		$rId = $this -> crr_model -> getmaxid('rId', 'reservations');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('primEmail', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('secEmail', 'Email', 'required|valid_email');
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
				$this->crr_model->insert_user($reserverData);
			}

			/*
             * Below changes are to match with the date format in mysql
             */
			$resDate = substr($resId, 0, 2) . "/" . substr($resId, 2, 2) . "/" . substr($resId, 4, 4);
			//$resDate =  substr($resId, 4, 4) . "-" . substr($resId, 0, 2). "-" . substr($resId, 2, 2);
			if(substr($resId,11,1) == "A" || substr($resId,11,1) == "B"|| substr($resId,11,1) == "C" || substr($resId,11,1) == "D"){
				$roomNum = substr($resId,8,4);
				$time = substr($resId,12);
				$startTime = substr($resId,12);
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
				$startTime = substr($resId,11);
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
			/* if($resDate > '12/14/2015' && $resDate < '12/18/2015' || $resDate > '05/09/2015' && $resDate < '05/13/2015')
                $isFinals = TRUE;
            else
                $isFinals = FALSE;
            */

			$secEmail = $this->input->post('secEmail');
			$comments = $this->input->post('Comments');
			$totalHours = $this->input->post('numHours');

			if(strlen($startTime) == 4){
				$startTime = substr($startTime, 0, 2) . ":" . substr($startTime, 2);
			}
			else if(strlen($startTime) == 3){
				$startTime = substr($startTime, 0, 1) . ":" . substr($startTime, 1);
			}
			else {
				$startTime = $startTime . ":00";
			}
			$availableTime = $totalHours;
			for($i=0;$i<$totalHours;$i+= 0.5){

				if(in_array($time,$unavailableHours)){
					$availableTime = $availableTime - 0.5;
				}
				if(strlen($time) == 1 || strlen($time) == 2) {
					if($time == 0){
						$time = $time+30;

					}elseif($time ==30){
						$time = $time + 70;
						$time = $time / 100;
					}else {
						$time = $time * 100;
						$time = $time + 30;
					}

				}elseif(strlen($time)==4 || strlen($time)==3 ){
					$time = $time + 70;
					$time = $time / 100;
				}


			}
			for($timeLim; $timeLim < $limit; $timeLim = $timeLim + .5) {
				$day = substr($resId, 2, 2);
				$month = substr($resId, 0, 2);
				$year = substr($resId, 4, 4);
				if ($timeLim == 24) {
					$resTime = "00";
					$day = substr($resId, 2, 2);
					$month = substr($resId, 0, 2);
					$year = substr($resId, 4, 4);
					if ($month == "12") {
						if ($day == 31) {
							$day = "01";
							$month = "01";
						} else {
							$day = $day + 1;
							if ($day < 10)
								$day = "0" . $day;
						}
					}
					if ($month == "02") {
						$leapYear = FALSE;
						if ($year % 4 == 0) {
							$leapYear = TRUE;
						}
						if (substr($year, 2, 2) == "00" && $year % 400 == 0) {
							$leapYear = TRUE;
						}
						if ($leapYear) {
							if ($day == "29") {
								$day = "00";
								$month = "03";
							} else {
								$day = $day + 1;
								if ($day < 10)
									$day = "0" . $day;
							}
						} else {
							if ($day == 28) {
								$day = "00";
								$month = "03";
							} else {
								$day = $day + 1;
								if ($day < 10)
									$day = "0" . $day;
							}
						}
					}
					if ($month == "04" || $month == "06" || $month == "09" || $month == "11") {
						if ($day == 30) {
							$day = "01";
							$month = $month + 1;
							if ($month < 10)
								$month = "0" . $month;
						} else {
							$day = $day + 1;
							if ($day < 10)
								$day = "0" . $day;
						}
					}
					if ($month == "01" || $month == "03" || $month == "05" || $month == "07" || $month == "08" || $month == "10") {
						if ($day == 31) {
							$day = "01";
							$month = $month + 1;
							if ($month < 10)
								$month = "0" . $month;
						} else {
							$day = $day + 1;
							if ($day < 10)
								$day = "0" . $day;
						}
					}
					/*
					 * Sql Database
					 * $resDate = $year . "-" . $month . "-" . $day;
					 */
					$resDate = $month . "/" . $day . "/" . $year;
					//$resId = $month . $day . $year . $roomNum . $resTime;
				} else if ($timeLim == 24.5) {
					$resTime = "00.5";
					//$resId = substr($resId, 0, 8) . $roomNum . $resTime;
				} else if ($timeLim == 25) {
					$resTime = 1;
					//$resId = substr($resId, 0, 8) . $roomNum . $resTime;
				} else if ($timeLim == 25.5) {
					$resTime = 1.5;
					//$resId = substr($resId, 0, 8) . $roomNum . $resTime;
				} else if ($timeLim == 26) {
					$resTime = 2;
					//$resId = substr($resId, 0, 8) . $roomNum . $resTime;
				} else if ($timeLim == 26.5) {
					$resTime = 2.5;
					//$resId = substr($resId, 0, 8) . $roomNum . $resTime;
				} else {
					$resTime = $timeLim;
					//$resId = substr($resId, 0, 8) . $roomNum . $resTime;
				}
				if (strpos($resTime, ".") > 0) {
					if (substr($resTime, 1, 1) == ".") {
						if (substr($resTime, 0, 1) == "0") {
							$inResTime = substr($resTime, 0, 1) . ":30";
							$resId = $month . $day . $year . $roomNum . "0" . substr($resTime, 0, 1) . "30";
						} else {
							$inResTime = substr($resTime, 0, 1) . ":30";
							$resId = $month . $day . $year . $roomNum . substr($resTime, 0, 1) . "30";
						}
					} else {
						$inResTime = substr($resTime, 0, 2) . ":30";
						$resId = $month . $day . $year . $roomNum . substr($resTime, 0, 2) . "30";
					}
				} else {
					$inResTime = $resTime . ":00";
					$resId = $month . $day . $year . $roomNum . $resTime;
				}
				$availableSlot = true;

				if (substr($resId, 11, 1) == "A" || substr($resId, 11, 1) == "B" || substr($resId, 11, 1) == "C" || substr($resId, 11, 1) == "D") {
					$time = substr($resId, 12);
					if (in_array($time, $unavailableHours)) {
						$totalHours = $totalHours - 0.5;
						$availableSlot = false;
					}
				} else {
					$time = substr($resId, 11);

					if (in_array($time, $unavailableHours)) {
						$totalHours = $totalHours - 0.5;
						$availableSlot = false;
					}
				}
				$bookedHours = 0;
				if($totalHours < ($this -> input -> post('numHours'))){

					$bookedHours = ($this -> input -> post('numHours')) - $totalHours;

				}
				if ($availableSlot) {
					$currentTimeStamp = $date->format('Y-m-d H:i:s');
					$resData = array(
						'resId' => $resId,
						'roomNum' => $roomNum,
						'resDate' => $resDate,
						'startTime' => $startTime,
						'time' => $inResTime,
						'resEmail' => $this->input->post('primEmail'),
						'resPhone' => $this->input->post('primPhone'),
						'resType' => $this->input->post('bookType'),
						'status' => $status,
						'secEmail' => $secEmail,
						'comments' => $comments,
						'totalHours' => $availableTime,
						'numPatrons' => $this->input->post('numPatrons'),
						'rId' => $rId,
						'entDate' => $endDate,
						'createdDttm' => $currentTimeStamp
					);
					$result1 = $this->crr_model->checkResId($resData['resId']);
					if (sizeof($result1) == 0) {
						$result = $this->crr_model->insert_reservation($resData, 'reservations');
						if ($result == 0) {
							$data['header'] = "Confirmation Page";
							$data['info'] = "Reservation Conflict. The slot $resId is already reserved.";
							$this->crr_model->deleteRes($rId);
							break;
						} else {
                            if( $availableTime < $totalHours) {
								$data['header'] = "Confirmation Page";
								$data['info'] = "The reservation is complete. Reservation id: " . $rId." As We cannot make reservation in closing hours, Room is reserved for ".$availableTime." hours.";
								$data['result'] = $result;

							}else{
								$data['header'] = "Confirmation Page";
								$data['info'] = "The reservation is complete. Reservation id: " . $rId;
								$data['result'] = $result;
							}
						}
					} else {
						$data['header'] = "Confirmation Page";
						$data['info'] = "Reservation Conflict. The slot $resId is already reserved.";
						$this->crr_model->deleteRes($rId);
						break;
					}
				}
			}
			$this->load->view('verify_view', $data);
		}
	}

	public function refreshReservations(){
		$this -> load -> model('crr_model');
		$date = $this -> input -> get('date');
		$slotId = $this ->input ->get('slotId');
		$strings = explode("/",$date);
		$timestamp = $this -> input -> get('time');
		$currentTimestamp = substr($timestamp, 0,10)." ". substr($timestamp, 11,19);
		$data['slots'] = $this -> crr_model -> getNewReservations($currentTimestamp);
		//$date = str_replace("/", "", $date);
		//$data['dat'] = $date;
		$reservation = parse_ini_file('reservation.ini');
		$size = sizeof($reservation);
		if($size == 0) {
			$data['tentativeSlots'] = null;
		}
		$tentativeIni = array();
		for($i=0; $i<$size;$i++){
			if($slotId == $reservation[$i]){

				$i= $i+5;

			}else if($i < $size){
				array_push($tentativeIni,$reservation[$i]);
			}
		}
		$newSize = sizeof($tentativeIni);
		if($newSize == 0){
			fopen("reservation.ini", 'w');
		}
		if($newSize>0) {
			$fp = fopen("reservation.ini", 'w');

			for($i=0;$i<$newSize;$i++){
				if($tentativeIni[$i] != null) {
					$string = "$i = $tentativeIni[$i] \n";
					fwrite($fp, $string);
				}
			}
			$data['tentativeSlots'] = $tentativeIni;
		}

		echo json_encode($data);

	}

	public function getNewReservations(){
		$date = $this -> input -> get('date');
		$timestamp = $this -> input -> get('time');
		$currentTimeStamp = substr($timestamp, 0,10)." ". substr($timestamp, 11,19);
		$this -> load -> model('crr_model');
		$data['slots'] = $this -> crr_model -> getNewReservations($currentTimeStamp);
		//	print_r($data['slots']);
		//$date = str_replace("/", "", $date);
		//$data['date'] = $date;
		$reservation = parse_ini_file('reservation.ini');
		$size = sizeof($reservation);
		$data['tentativeSlots'] = null;
		if($size>0 ) {

			$data['tentativeSlots'] = $reservation;
		}
		echo json_encode($data);
	}

	public function displayInfo(){
		$data['header'] = "Reservation Failed";
		$data['info'] = "Unfortunately we cannot go back on time to make a reservation :)";
		$this->load->view('verify_view', $data);
	}

	public function disclaimer(){
		$this -> load -> view('disclaimer');
	}

	public function roomDetails(){
		$this -> load -> model('crr_model');
		$roomNo = $this -> input -> get('roomNo');
		$data['details'] = $this -> crr_model -> getRoomDetails($roomNo);
		$this -> load -> view('roomdetails_view', $data);
	}

	public function tooltipRoomDetails(){
		$this -> load -> model('crr_model');
		$roomNo = $this -> input -> get('roomNo');
		$data['details'] = $this -> crr_model -> getRoomDetails($roomNo);
		$this -> load -> view('t_roomdetails_view', $data);
	}

	public function tfq(){
		$this -> load -> model('crr_model');
		$data['emails'] = $this -> crr_model -> getEmails();
		//$data['val'] = $this -> input -> get('val');
		$this -> load -> view('tfq', $data);
	}

	public function setInstructions(){
		date_default_timezone_set('US/Eastern');
		$date = new DateTime();
		$iDate = $date->format('m/d/Y H:i:s');
		$this -> load -> model('crr_model');
		$startDate = $_POST['startDate'];
		$endDate = $_POST['endDate'];
		$hoursId = $_POST['hoursId'];
		for ($i = 0; $i < sizeof($hoursId); $i++){
			$data['startdate'] = $startDate;
			$data['enddate'] = $endDate;
			$data['hourId'] = $hoursId[$i];
			$data['instDate'] = $iDate;
			$result = $this->crr_model->insert_reservation($data,'hoursInstructions');
		}
		echo $result;
	}

	public function removeInstructions(){
		$this -> load -> model('crr_model');
		$iidArray = $_POST['iidArray'];
		for ($i = 0; $i < sizeof($iidArray); $i++){
			$iid = $iidArray[$i];
			$result = $this->crr_model->remove_instructions($iid);
		}
		echo $result;
	}

	public function printTable(){
		$this -> load -> model('crr_model');
		$date = $this -> input -> get('date');
		$data['rooms'] = $this -> crr_model -> getRooms($date);
		$data['hours'] = $this -> crr_model -> getHours();
		$data['slots'] = $this -> crr_model -> getReservations($date);
		$data['blockedHours'] = $this -> crr_model -> getBlockedHours($date);
		$date = str_replace("/", "", $date);
		$data['date'] = $date;
		$this -> load -> view('printPage', $data);
	}

	public function deleteSlot(){
		$resId = $_POST['resId'];
		$this -> load -> model('crr_model');
		$result = $this -> crr_model -> deleteSlot($resId);
		echo $result;
	}

	public function ack(){
		$this -> load -> view('ack_view');
	}

	public function addNotes(){
		$this -> load -> view('addNotes_view');
	}

	public function addNotes1(){
		$data['email']= $this -> input -> get('email');
		$this -> load -> view('addNotes2_view', $data);


	}

	public function addANote(){
		$email = $_POST['email'];
		$notes = $_POST['notes'];
		$this -> load -> model('crr_model');
		$result = $this -> crr_model -> addANote($email, $notes);
		echo $result;
	}

	public function tooltipNotes(){
		$this -> load -> model('crr_model');
		$email = $this -> input -> get('email');
		$data['notes'] = $this -> crr_model -> getNotes($email);
		$this -> load -> view('viewNotes', $data);
	}

	public function report(){
		$this -> load -> model('crr_model');
		//	$date = $this -> input -> get('date');
		//$data['patronCount'] = $this -> crr_model -> getPatronCount($date);
		$this -> load -> view('report_view');
	}

	public function getPatronCount(){
		$this -> load -> model('crr_model');
		$date = $this -> input -> get('date');
		$data['hours'] = $this -> crr_model -> getPatronCount($date);
		$data['date'] = $date;
		$this -> load -> view('patronCountReport', $data);
	}


}
?>