<?php
class crr extends CI_Controller
{

	private $current_line;
	private $recent = true;

	public function __construct()
	{

		parent::__construct();

	}

	/*
     * Retrieve passcodes,resids,emails from db
     * Load data into crr_view
     *
     */
	public function index()
	{
		$this->load->model('crr_model');
		$data['title'] = "JAC Collaboration Rooms";
		$date = date("m/d/Y");
		//$data['rooms'] = $this -> crr_model -> getRooms($date);
		//$data['hours'] = $this -> crr_model -> getHours();
		$data['resId'] = $this->crr_model->getResIds();
        $data['categories'] = $this->crr_model->getCategories();
        $data['patrons'] = $this->crr_model->getPatrons();
		//$data['passcode'] = $this -> crr_model -> getPwd(1);
		//$data['Apasscode'] = $this -> crr_model -> getPwd(2);
		$data['emails'] = $this->crr_model->getEmails();
		$this->load->view('crr_view', $data);
	}

	/*
	 * Retrieve hours, rooms, instructions and blocked rooms information from db.
	 * Loads admin view with the retrieved data.
	 *
	 */
	/*	public function admin() {
            $this -> load -> model('crr_model');
            $data['hours'] = $this -> crr_model -> getHours();
            $data['rooms'] = $this -> crr_model -> getRooms();
            $data['instructions'] = $this -> crr_model -> getInstructions();
            $data['blockedrooms'] = $this -> crr_model -> getBlockedRooms();
            $this -> load -> view('admin2', $data);
        }*/
	/*
	 * updates the reservation status of a slot.
	 * new feature: automatic cancellation of slots >>
	 * checks the present timestamp value and slot time.
	 * if slot time > present timestamp, status = 5 (cancelled slot) or status = 6 (no show).
	 * if slot time < present timestamp, status = 4 Transaction Complete.
	 */
	public function updateStatus()
	{
		$rId = $_POST['rId'];
		$status = $_POST['status'];
		//$timestamp = $_POST['time'];
		//$currentTimeStamp = substr($timestamp, 0,10)." ". substr($timestamp, 11,19);
		date_default_timezone_set('US/Eastern');
		$currentTimeStamp = date("Y-m-d H:i:s");
		$this->load->model('crr_model');
		$result = $this->crr_model->getReservedSlots($rId);
		$slots = json_decode(json_encode($result), true);
		$dateString = strtotime($currentTimeStamp);
		$currentHours = date('H', $dateString);
		$currentMin = date('i', $dateString);
		$currentTime = $currentHours . $currentMin;

		foreach ($slots as $slot) {
			$resId = $slot['resId'];
			if (substr($resId, 11, 1) == "A" || substr($resId, 11, 1) == "B" || substr($resId, 11, 1) == "C" || substr($resId, 11, 1) == "D") {

				$SlotTime = substr($resId, 12);
				if (strlen($SlotTime) == 2) {
					$SlotTime = $SlotTime * 100;
				}
				if ($SlotTime > $currentTime) {
					if ($_POST['status'] == 6) {
						$status = 6;
					} else {

						$status = 5;
					}

					$result = $this->crr_model->updateSlotStatus($rId, $resId, $status, $currentTimeStamp);

				} else {

					$status = $_POST['status'];
					$result = $this->crr_model->updateStatus($rId, $status, $currentTimeStamp);
				}
			} else {

				$SlotTime = substr($resId, 11);
				if (strlen($SlotTime) == 2) {
					$SlotTime = $SlotTime * 100;
				}
				if ($SlotTime > $currentTime) {
					if ($_POST['status'] == 6) {
						$status = 6;
					} else {
						$status = 5;
					}
					$result = $this->crr_model->updateSlotStatus($rId, $resId, $status, $currentTimeStamp);

				} else {
					$status = $_POST['status'];
					$result = $this->crr_model->updateStatus($rId, $status, $currentTimeStamp);

				}
			}

		}

		echo $result;
	}

	/*
	 * Cancel the reservation by updating slot status to 3 or 6
	 *
	 */
	public function cancelReservation()
	{
		date_default_timezone_set('US/Eastern');
		$currentTimeStamp = date("Y-m-d H:i:s");
		$rId = $_POST['rId'];
		$status = $_POST['status'];
		$this->load->model('crr_model');
		$result = $this->crr_model->updateStatus($rId, $status, $currentTimeStamp);
		echo $result;

	}


	/*
	 * Updates the slot status from 2 to 1(unverified to reserved)
	 *
	 */
	public function verifyStatus()
	{
		date_default_timezone_set('US/Eastern');
		$currentTimeStamp = date("Y-m-d H:i:s");
		$rId = $_POST['rId'];
		$status = $_POST['status'];
		$this->load->model('crr_model');
		$result = $this->crr_model->updateStatus($rId, $status, $currentTimeStamp);
		echo $result;
	}

	/*
     * Updates the reservation details
     * Request: resEmail, secEmail, resPhone, num Patrons, comments.
     * Checks the resEmail is an existing one or not.
     * And inserts the new resEmail in reserver.
     */

	public function updateResDetails()
	{

		$rId = $_POST['rId'];
		$resEmail = $_POST['resEmail'];
		$secEmail = $_POST['secEmail'];
		$resPhone = $_POST['resPhone'];
		$numPatrons = $_POST['numPatrons'];
		$comments = $_POST['comments'];
		$this->load->library('form_validation');
		$this->form_validation->set_rules('resEmail', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('secEmail', 'Email', 'required|valid_email');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('reservation_view');
		}
		$this->load->model('crr_model');
		if ($this->crr_model->getreserver($resEmail)) {
			$reserverData = array(
				'email' => $resEmail
			);
			$this->crr_model->insert_user($reserverData);

			//echo "true";
		}
		$result = $this->crr_model->updateResDetails($rId, $resEmail, $secEmail, $resPhone, $numPatrons, $comments);

		echo $result;
	}

	/*
	 * Update the selected slot status
	 *
	 *
	 */
	public function updateSlotStatus()
	{
		$rId = $_POST['rId'];
		$resId = $_POST['resId'];
		$status = $_POST['status'];
		$this->load->model('crr_model');
		date_default_timezone_set('US/Eastern');
		$currentTimeStamp = date("Y-m-d H:i:s");
		$result = $this->crr_model->updateSlotStatus($rId, $resId, $status, $currentTimeStamp);
		echo $result;
	}

	public function cancelSlot()
	{
		//	$rId =  $this -> input -> get('rId');
		//	$resId = $this ->input -> get('resId');
		//	$status = 5;
		$rId = $_POST['rId'];
		$resId = $_POST['resId'];
		$status = $_POST['status'];
		date_default_timezone_set('US/Eastern');
		$currentTimeStamp = date("Y-m-d H:i:s");
		$this->load->model('crr_model');

		$result = $this->crr_model->getReservation($rId);
		$result = json_decode(json_encode($result), true);

		foreach ($result as $row) {
			if ($row['resId'] == $resId) {

				$result = $this->crr_model->updateSlotStatus($rId, $resId, $status, $currentTimeStamp);

				echo $result;

			} else {

				echo 0;
			}

		}

	}
	/***********************************************************/
	/****Update on createdDttmColumn for data consistancy****/
/*
   public function getResDates(){
       $this->load->model('crr_model');
       $result = $this->crr_model->getResDates();
       $result  = json_decode(json_encode($result), true);
 $i = 0;
       foreach ($result as $row){
           $createdDttm = date($row['createdDttm']);

           if($createdDttm == 0) {
               $entDate = date($row['entDate']);
               if($entDate!=0){
                //   $date =  createFromFormat('Y-m-d', $entDate);
                   $newDate = date('Y-m-d H:i:s', strtotime($entDate));
                   $result = $this->crr_model-> updateCreatedDttm($newDate, $row['rId']);
                   if($result){
                       $i++;
                   }
                   //echo $row['rId']."--".$newDate;
                  // echo "</br>";
                   //$i++;
               }
           }
      }
     echo "total updated:".$i;
   }*/
    /***********************************************************/

   //verifies the data available in the given date range
   public function verifyReservationDateRange(){
       $fromDate = $this->input->get('fromDate');
       $toDate = $this->input->get('toDate');
       $fromDate = date('Y-m-d', strtotime($fromDate));
       $toDate = date('Y-m-d', strtotime($toDate));
       $this->load->model('crr_model');
       $data = $this->crr_model->getAllReservations($fromDate,$toDate);
       $data = json_decode(json_encode($data),true);

       if($data >0){
         echo 1;
       }else{
           echo 0;
       }

   }
   // Generates Reservation report for the given date range
   public function getReservationsReport(){

//Convert input dates into MySQL date format
       $fromDate = $this->input->get('fromDate');
       $toDate = $this->input->get('toDate');
       $fromDate = date('Y-m-d', strtotime($fromDate));
       $toDate = date('Y-m-d', strtotime($toDate));
// Headers to create a CSV file without caching
       header('Content-type: text/csv');
       header('Content-Disposition: attachment; filename="ReservationReport.csv"');
       header('Pragma: no-cache');
       header('Expires: 0');
       $file = fopen('php://output', 'w');

// column headers
       fputcsv($file, array('rid', 'resDate', 'resEmail', 'resType', 'roomNum','status', 'startTime', 'totalHours', 'numPatrons'));
// data
       $this->load->model('crr_model');
       $data = $this->crr_model->getAllReservations($fromDate,$toDate);
       $data = json_decode(json_encode($data),true);


// output each row of the data
       foreach ($data as $row)
       {
           fputcsv($file, $row);
       }

       exit();
   }


	/*
	 * Retrieve all the reservations of today.
	 * Reads ini file for tentative slots.
	 */
	/*public function todayReservation()
	{
		$this->load->model('crr_model');
		date_default_timezone_set('US/Eastern');
		$date = date("m/d/Y");
		$dateFormat = date("Y-m-d");//use this variable '$dateFormat' for mysql database. Needed for getBlockedHours($date)
		//	echo $dateFormat;
		//$data['rooms'] = $this->crr_model->getRooms();
	    $cat_type = $this -> input -> get("cat_type");
        $pat_type = $this -> input -> get("pat_type");
        $data['rooms'] = $this->crr_model->getRoomsOnCatg_Patr(1, 1);

        $data['hours'] = $this->crr_model->getHours();
		$data['slots'] = $this->crr_model->getReservations($date);
		$data['blockedHours'] = $this->crr_model->getBlockedHours($dateFormat);//use $dateFormat for mysql database
		$data['emails'] = $this->crr_model->getEmails();
		$date = str_replace("/", "", $date);
		$data['date'] = $date;
		$reservation = parse_ini_file('reservation.ini');
		$size = sizeof($reservation);

		if ($size > 0) {
			$data['tentativeSlots'] = $reservation;

		} else {
			$data['tentativeSlots'] = null;
		}

		$this->load->view('main_view', $data);
	}
     */

     /*
	 * Retrieve all the reservations of today based on the selected categories and patron
	 * Reads ini file for tentative slots.
	 */
     public function todayRes(){
         $this->load->model('crr_model');
         date_default_timezone_set('US/Eastern');
         $date = date("m/d/Y");
         $dateFormat = date("Y-m-d");//use this variable '$dateFormat' for mysql database. Needed for getBlockedHours($date)
         $cat_type = $this -> input -> get("cat_type");
         $pat_type = $this -> input -> get("pat_type");
        // if($cat_type!= 1 || $pat_type !=1) {
         $data['rooms'] = $this->crr_model->getRoomsOnCatg_Patr($cat_type, $pat_type);
         //}/*else if($cat_type==1 && $pat_type ==1){

           //  $data['rooms'] = $this->crr_model -> getRooms();
         //}*/
       //  $data['categories'] = $this->crr_model->getCategories();
        // $data['patrons'] = $this->crr_model->getPatrons();
         $data['hours'] = $this->crr_model->getHours();
         $data['slots'] = $this->crr_model->getReservations($date);
         $data['blockedHours'] = $this->crr_model->getBlockedHours($dateFormat);//use $dateFormat for mysql database
         $data['emails'] = $this->crr_model->getEmails();
         $date = str_replace("/", "", $date);
         $data['date'] = $date;
         $reservation = parse_ini_file('reservation.ini');
         $size = sizeof($reservation);
         if ($size > 0) {
             $data['tentativeSlots'] = $reservation;
         } else {
             $data['tentativeSlots'] = null;
         }
         $this->load->view('main_view', $data);
     }
	//testing with json
	/***********    public function reservations(){
	 * $this -> load -> model('crr_model');
	 * $date = date("m/d/Y");
	 * $data['slots'] = $this -> crr_model -> getReservations($date);
	 * $date = str_replace("/", "", $date);
	 * $data['date'] = $date;
	 * echo json_encode($data);
	 * }**************/

	/*
	 *
	 * Retrieve All the reservations of selected date.
	 * Checks the reservations.ini file
	 *
	 */
	public function getReservations()
	{
		$this->load->model('crr_model');
		$date = $this->input->get('date');
		$slotId = $this->input->get('slotId');
		$strings = explode("/", $date);
		$dateFormat = "$strings[2]-$strings[0]-$strings[1]";//use this variable '$dateFormat' for mysql database. Needed for getBlockedHours($date)
		$cat_type = $this -> input -> get("cat_type");
        $pat_type = $this -> input -> get("pat_type");
		//$data['rooms'] = $this->crr_model->getRooms();
		$data['rooms'] = $this->crr_model->getRoomsOnCatg_Patr($cat_type, $pat_type);
		$data['hours'] = $this->crr_model->getHours();
		$data['slots'] = $this->crr_model->getReservations($date);
		$data['blockedHours'] = $this->crr_model->getBlockedHours($dateFormat);//use $dateFormat for mysql database
		$date = str_replace("/", "", $date);
		$data['date'] = $date;
		$reservation = parse_ini_file('reservation.ini');
		$size = sizeof($reservation);
		$data['tentativeSlots'] = null;
		$data['NewSlots'] = null;
		/*		if($size>0 ) {
                    $data['tentativeSlots'] = $reservation;
                }*/


		$data['tentativeSlots'] = $reservation;

		$this->load->view('main_view', $data);
	}

	public function updateTenativeSlots()
	{
		$slotId = $this->input->get('slotId');
		$reservation = parse_ini_file('reservation.ini');
		$size = sizeof($reservation);
		$data['tentativeSlots'] = array();

		$tentativeIni = array();
		for ($i = 0; $i < $size; $i++) {
			if ($slotId == $reservation[$i]) {
				$i = $i + 5;

			} else if ($i < $size) {
				array_push($tentativeIni, $reservation[$i]);
			}
		}
		$newSize = sizeof($tentativeIni);
		if ($newSize == 0) {
			fopen("reservation.ini", 'w');
		}
		if ($newSize > 0) {
			$fp = fopen("reservation.ini", 'w');

			for ($i = 0; $i < $newSize; $i++) {
				if ($tentativeIni[$i] != null) {
					$string = "$i = $tentativeIni[$i] \n";
					fwrite($fp, $string);
				}
			}
		}
	}
	/*	public function reservations(){
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
        }*/
	/*
	 * Receives search text as an email.
	 * Retrieve details and notes of the received email
	 *
	 */
	public function search()
	{
		$this->load->model('crr_model');
		$searchText = $this->input->get('q');
		if (is_numeric($searchText)) {
			$result = $this->crr_model->getresIdDetails($searchText);
			$data['details'] = $result;
			$result = json_decode(json_encode($result), true);
			if ($result != null) {
				foreach ($result as $res) {

					$email = $res['resEmail'];
				}
				$data['notes'] = $this->crr_model->getNotes($email);
			} else {
				$data['notes'] = $this->crr_model->getNotes($searchText);

			}
		} else {
			$data['details'] = $this->crr_model->getEmailDetails($searchText);
			$data['notes'] = $this->crr_model->getNotes($searchText);

		}
		$data['email'] = $searchText;

		$this->load->view('search_view', $data);
	}

	/*
	 *
	 * Receive resId of selected reservation
	 * Retrieve reservation details, emails, Admin Passcode from db.
	 * Return reservation_view with data
	 */
	public function reservationDetails()
	{
		$this->load->model('crr_model');
		$resId = $this->input->get('resId');
		$data['details'] = $this->crr_model->getResDetails($resId);
		$data['emails'] = $this->crr_model->getEmails();
		$data['Apasscode'] = $this->crr_model->getPwd(2);
		$data['resId'] = $resId;
		$this->load->view('reservation_view', $data);
	}

	/*
 *
 * Receive resId of selected reservation
 * Retrieve reservation details from db.
 * Return readonlyreservation_view with data
 */

	public function readonlyReservationDetails()
	{
		$this->load->model('crr_model');
		$resId = $this->input->get('resId');
		$data['details'] = $this->crr_model->getResDetails($resId);
		$data['resId'] = $resId;
		$this->load->view('readonlyreservation_view', $data);
	}

	/*
    * Receive resId of selected reservation
    * Retrieve reservation details from db.
    * Return reservation_view with data
    */

	public function reservationDetails1()
	{
		$this->load->model('crr_model');
		$rId = $this->input->get('rId');
		$data['details'] = $this->crr_model->getResDetails1($rId);
		$data['emails'] = $this->crr_model->getEmails();
		$data['Apasscode'] = $this->crr_model->getPwd(2);
		$data['resId'] = 0;
		$this->load->view('reservation_view', $data);
	}

	/*
     *Receive resId from request.
     *Fetch non-operating hours from db.
     *Reads reservation.ini file.
     * Check if it is tentative or already reserved and save in reservation.ini file.
     *    ⇒ If resId found in INI file → Return reservation_conflict view.
     *    ⇒ Else if resId found in db → Return reservation_conflict view.
     *    ⇒ Else → create 6 consecutive slotIds(or resIds) as tentative
     *          slotIds.
     *           → for each tentative slotId →Check if hour of
     *                                         tentative slotId is not
     *                                         available in  non-operating
     *                                         hours
     *           →  Save the slotId in reservation.ini file and also in
     *           array[tentativeSlots]
     *           → return reservationForm_view with array[tentativeSlots].
     */


	public function verifyReservations()
	{

		date_default_timezone_set('US/Eastern');
		$date = new DateTime();
		//$endDate = $date->format('m/d/Y H:i:s');
		$this->load->model('crr_model');
		//$data['title'] = "JAC Collaboraseservation System";
		$date = $this->input->get('date');
		//$date = date_format($date, "Y-m-d");
		$data['emails'] = $this->crr_model->getEmails();
		$resId = $this->input->get('resId');
		$data['resId'] = $this->input->get('resId');

		$pat = $this->input->get('pat');
		$cat = $this->input->get('cat');
		$data['req'] = $this->crr_model->getReq($pat, $cat);

		$reservation = parse_ini_file('reservation.ini');
		$NonOperatinghours = $this->crr_model->getUnavailableHours($date);
		$NonOperatinghours = json_decode(json_encode($NonOperatinghours), true);
		$unavailableHours = array();

		foreach ($NonOperatinghours as $hour) {
			$hour = str_replace(":", "", $hour['hours']);
			array_push($unavailableHours, $hour);

		}
		if (in_array($resId, $reservation)) {

			$this->load->view('reserve_conflict');

		} else if ($this->crr_model->checkResId($resId)) {

			//checking if it is selected reservation
			$this->load->view('reserve_conflict');

		} else {
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
			$timeAvailable = 0;
			$isReserved =  false;
			$isBlocked = false;
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

				} else if ($timeLim == 24.5) {
					$resTime = "00.5";
				} else if ($timeLim == 25) {
					$resTime = 1;
				} else if ($timeLim == 25.5) {
					$resTime = 1.5;
				} else if ($timeLim == 26) {
					$resTime = 2;
				} else if ($timeLim == 26.5) {
					$resTime = 2.5;
				} else {
					$resTime = $timeLim;
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
					$inResTime = $resTime;
					$resId = $month . $day . $year . $roomNum . $resTime;
				}
				$resDate = $year . "-" . $month . "-" . $day;
				 array_push($tentativeSlots, $resId);

				/*	if ($this -> crr_model -> checkBlockedHour($resDate,$inResTime)) {

                    }*/
				if($isBlocked==false) {
					if (!$this->crr_model->checkBlockedHour($resDate, $inResTime)) {

						if ($this->crr_model->checkResId($resId)) {

							$isReserved = true;

						} else {
							if ($isBlocked == false && $isReserved == false) {
								$reservation = parse_ini_file('reservation.ini');
								$size = sizeof($reservation);
								if ($size > 0) {
									if (!in_array($resId, $reservation)) {
										$timeAvailable = $timeAvailable + 0.5;

									}

								} else {

									$timeAvailable = $timeAvailable + 0.5;

								}

							}
						}


						//	$timeAvailable = $timeAvailable +0.5;


					} else {
						$isBlocked = true;
					}
				}

			}
			$availableSlot = 0;
			if (sizeof($tentativeSlots) > 1) {

				for ($j = 0; $j < 2; $j++) {
					if ($this->crr_model->checkResId($tentativeSlots[$j])) {

						$availableSlot = 1;

					}

				}
				if ($availableSlot == 1) {
					$data['header'] = "Message";
					$info = "Please select the slot with atleast 1 hr availablity";
					$data['info'] = $info;
					$data['result'] = "000000";
					$data['slotid'] = 0;
					$this->load->view('verify_view', $data);
				}else if($timeAvailable<1){
					$data['header'] = "Message";
					$info = "Please select the slot with atleast 1 hr availablity";
					$data['info'] = $info;
					$data['result'] = "000000";
					$data['slotid'] = 0;
					$this->load->view('verify_view', $data);
				}
				else {
					$data['tentative_slots'] = $tentativeSlots;
				//	$timeAvailable = 0;
/*					foreach ($tentativeSlots as $resId) {

						if ($this->crr_model->checkResId($resId)) {
							break;
						} else {

								$timeAvailable = $timeAvailable + 0.5;
						}

					}*/
					$reservation = parse_ini_file('reservation.ini');
					$size = sizeof($reservation);
					if ($size > 0) {
						for ($i = 0; $i < $size; $i++) {
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
					$data['timeAvailalbe'] = $timeAvailable;

          // Trying to pass current patron status into PHP
          $data['patron'] = $pat;
					$this->load->view('reserveform_view', $data);

				}
			}else{
				$data['header'] = "Message";
				$info = "Please select the slot with atleast 1 hr availability";
				$data['info'] = $info;
				$data['result'] = "000000";
				$data['slotid'] = 0;
				$this->load->view('verify_view', $data);

			}

		}


	}


	/*
	 * Receive resId from request.
     *  Fetch non-operating hours from db.
     *  Load Form-Validation Library.
     *      If Form -Validation run false → return reserveForm_view with data.
     * Else → verify existence of primary email in reserver table and save if it is not available.
     *   Define limit and timelimit on the basis of number of hours requested for reservation.
     *     Limit =  number of hours from selected time.
     *     TimeLimit = hour of selected slot time.
     * For each TimeLimit< Limit → check if the slot time is available in non-operating hours.
     *  If it not found in non-operating hours insert new reservation.
	 */
	public function checkBlockedHr(){
     $date= $this -> input ->get('date');
	  $hour = $this -> input -> get('hour');
		$this->load->model('crr_model');
		if($this -> crr_model -> checkBlockedHour($date,$hour)){

			echo true;
		}else{
			echo false;
		}


	}
	public function reserveForm()
	{
		date_default_timezone_set('US/Eastern');
		$date = new DateTime();
		//$fp = fopen("reservation.ini", 'w');
		/*
         * Below changes are to match with the date format in mysql
         */

		$endDate = $date->format('Y-m-d H:i:s');//uncomment this line to work with mysql
		//$endDate = $date->format('m/d/Y H:i:s');//uncomment this line to work with sqlite
		$this->load->model('crr_model');
		$data['title'] = "JAC Collaboration reservation System";
		$data['emails'] = $this->crr_model->getEmails();
		$resId = $this->input->get('resId');
		$selectedSlot =$this->input->get('resId');
		$resDate = substr($resId, 4, 4) . "-" . substr($resId, 0, 2) . "-" . substr($resId, 2, 2);
		$NonOperatinghours = $this->crr_model->getUnavailableHours($resDate);
		$NonOperatinghours = json_decode(json_encode($NonOperatinghours), true);
		$unavailableHours = array();
		foreach ($NonOperatinghours as $hour) {
			$hour = str_replace(":", "", $hour['hours']);
			array_push($unavailableHours, $hour);
		}

		$data['resId'] = $this->input->get('resId');
		$rId = $this->crr_model->getmaxid('rId', 'reservations');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('primEmail', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('numPatrons', 'Patrons Number', 'required');

        $numPatrons = $this->input->post('numPatrons');
        if($numPatrons !=1) {
            $this->form_validation->set_rules('secEmail', 'Email', 'required|valid_email');
        }else{

            $secEmail = "";
        }
		if ($this->form_validation->run() == FALSE) {
			$data['timeAvailalbe'] = $this->input->post('timeAvailalbe');
      // Trying to pass current patron status into PHP
      $data['patron'] = $this->input->post('patron');
			$this->load->view('reserveform_view', $data);
		} else {
			$reserverData = array(
				'email' => $this->input->post('primEmail')
			);
			$reserver = $this->input->post('primEmail');
			if ($this->crr_model->getreserver($reserver)) {
				//echo ("in");
				$this->crr_model->insert_user($reserverData);
			}

			/*
             * Below changes are to match with the date format in mysql
             */
			$resDate = substr($resId, 0, 2) . "/" . substr($resId, 2, 2) . "/" . substr($resId, 4, 4);//uncomment this line for sqlite
			//$resDate =  substr($resId, 4, 4) . "-" . substr($resId, 0, 2). "-" . substr($resId, 2, 2);//uncomment this line for mysql
			if (substr($resId, 11, 1) == "A" || substr($resId, 11, 1) == "B" || substr($resId, 11, 1) == "C" || substr($resId, 11, 1) == "D") {
				$roomNum = substr($resId, 8, 4);
				$time = substr($resId, 12);
				$startTime = substr($resId, 12);
				if (strlen($time) == 4) {
					$timeLim = substr($time, 0, 2) + .5;
					$limit = $this->input->post('numHours') + $timeLim;

				} else if (strlen($time) == 3) {
					$timeLim = substr($time, 0, 1) + .5;
					$limit = $this->input->post('numHours') + $timeLim;
				} else {
					$timeLim = $time;
					$limit = $this->input->post('numHours') + $timeLim;
				}
			} else {
				$roomNum = substr($resId, 8, 3);
				$time = substr($resId, 11);
				$startTime = substr($resId, 11);
				if (strlen($time) == 4) {
					$timeLim = substr($time, 0, 2) + .5;
					$limit = $this->input->post('numHours') + $timeLim;

				} else if (strlen($time) == 3) {
					$timeLim = substr($time, 0, 1) + .5;
					$limit = $this->input->post('numHours') + $timeLim;
				} else {
					$timeLim = $time;
					$limit = $this->input->post('numHours') + $timeLim;
				}
			}
			if ($this->input->post('bookType') == "person")
				$status = 1;
			else
				$status = 2;
			/* if($resDate > '12/14/2015' && $resDate < '12/18/2015' || $resDate > '05/09/2015' && $resDate < '05/13/2015')
                $isFinals = TRUE;
            else
                $isFinals = FALSE;
            */
			if($this->input->post('secEmail')) {
                $secEmail = $this->input->post('secEmail');
            }else{
                $secEmail = "";
            }
			$comments = $this->input->post('Comments');
			$totalHours = $this->input->post('numHours');
			if (strlen($startTime) == 4) {
				$startTime = substr($startTime, 0, 2) . ":" . substr($startTime, 2);
			} else if (strlen($startTime) == 3) {
				$startTime = substr($startTime, 0, 1) . ":" . substr($startTime, 1);
			} else {
				$startTime = $startTime . ":00";
			}

			$availableTime = $this->input->post('timeAvailalbe');
			$conflict = false;

			//$blockedTime = 0;
			for ($i = 0; $i < $totalHours; $i += 0.5) {

				//if (in_array($time, $unavailableHours)) {
				//	$blockedTime = $blockedTime + 0.5;
				//}
				if (strlen($time) == 1 || strlen($time) == 2) {
					if ($time == 0) {
						$time = $time + 30;

					} elseif ($time == 30) {
						$time = $time + 70;
						$time = $time / 100;
					} else {
						$time = $time * 100;
						$time = $time + 30;
					}

				} else if (strlen($time) == 4 || strlen($time) == 3) {
					$time = $time + 70;
					$time = $time / 100;
				}
			}if ($totalHours < $availableTime) {
			$availableTime = $totalHours;
		 	}
			/*if ($blockedTime < $availableTime) {
				$availableTime = $availableTime - $blockedTime;
			}*/
			$result1 = array();
			$r=0;
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

				// $availableSlot = true;

				if (substr($resId, 11, 1) == "A" || substr($resId, 11, 1) == "B" || substr($resId, 11, 1) == "C" || substr($resId, 11, 1) == "D") {
					$time = substr($resId, 12);
					if (in_array($time, $unavailableHours)) {
						$totalHours = $totalHours - 0.5;
						$availableSlot = false;
					} else {
						$availableSlot = true;

						$isReserved = $this->crr_model->checkResId($resId);
						if (sizeof($isReserved) == 0) {
							$availableSlot = true;
							//$totalHours = $totalHours - 0.5;
							//$availableTime = $availableTime - 0.5;
						} else {

							$availableSlot = false;
							//$availableTime = $availableTime - 0.5;
						}
					}
				} else {
					$time = substr($resId, 11);

					if (in_array($time, $unavailableHours)) {
						//$totalHours = $totalHours - 0.5;
						$availableSlot = false;
					} else {
						$isReserved = $this->crr_model->checkResId($resId);
						if (sizeof($isReserved) == 0) {
							$availableSlot = true;

							//$totalHours = $totalHours - 0.5;
						} else {
							//$availableTime = $availableTime - 0.5;
							$availableSlot = false;
							//$availableTime = $availableTime - 0.5;
						}
					}
				}
				if ($availableSlot) {
					$r= $r+1;
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
				//	$result1 = $this->crr_model->checkResId($resData['resId']);
				//	if (sizeof($result1) == 0) {

						$result = $this->crr_model->insert_reservation($resData, 'reservations');
						if ($result == 0) {
							$data['header'] = "Confirmation Page";
							$data['info'] = "Reservation Conflict. The slot $resId is already reserved.";
							$this->crr_model->deleteRes($rId);
							break;
						} else {

							//  $selectedHours= $totalHours;//$this ->input-> get('totalHours');
							if ($availableTime < $totalHours) {
								$data['header'] = "Confirmation Page";
								$info = "The reservation is complete. As some of the slots are already reserved/blocked, Room is reserved for " . $availableTime . " hour(s) only.";
								$data['info'] = "The reservation is complete. Reservation id: " . $rId . ".As some of the slots are already reserved/blocked, Room is reserved for " . $availableTime . " hour(s) only.";
								$data['result'] = $result;
								$data['slotid'] = $selectedSlot;
							} else {
								$data['header'] = "Confirmation Page";
								$info = "The reservation is complete.";
								$data['info'] = "The reservation is complete. Reservation id: " . $rId;
								$data['result'] = $result;
								$data['slotid'] = $selectedSlot;

							}

						}
				/*	} else {
						$data['header'] = "Confirmation Page";
						$data['info'] = "Reservation Conflict. The slot $resId is already reserved.";
						$this->crr_model->deleteRes($rId);
						break;
					}*/

				} else {
					if($r==0){
                        $conflict = true;
						$data['header'] = "Confirmation Page";
						$data['info'] = "Reservation Conflict. The slot $resId is already reserved.";
						break;

					}else{
						break;
					}

				}
			}
			$numPatrons = $this->input->post('numPatrons');

			if ( $conflict == false && sizeof($result1) == 0) {

				$this->load->library('email');

					$config['protocol'] = "smtp";
                    $config['smtp_host'] = "tls://smtp.googlemail.com";
                    $config['smtp_port'] = "465";
                    $config['smtp_user'] = "cannavinolibrary@gmail.com";
                    $config['smtp_pass'] = "845@jac3419";
                    $config['charset'] = "utf-8";
                    $config['mailtype'] = "html";
                    $config['newline'] = "\r\n";
                    $this->email->initialize($config);
				$this->email->from('cannavinolibrary@gmail.com', 'James A. Cannavino Library (Collaboration Room Reservation System)');
				//$this->email->to($this->input->post('primEmail'));
				$primPatron = $this->input->post('primEmail');
				$secEmail = $this->input->post('secEmail');
				$list = array($primPatron,$secEmail);
				$this->email->to($list);
				$this->email->cc("cannavinolibrary@gmail.com");
			//	$this->email->bcc('dheerajkarnati1@marist.edu');
				$this->email->subject('Reservation Confirmation. ReservationID:' . $rId);
				$message = "<h4> $info </h4></br></br>";
				$message .= "<table cellspacing=\"0\" cellpadding=\"0\" style=\"width:100%; border-bottom:1px solid #eee; font-size:12px; line-height:135%\">
                                             <tr style=\"background-color:#f5f5f5\">
                                             <th style=\"vertical-align:top ;color:#222; text-align:left; padding:7px 9px 7px 9px; border-top:1px solid #eee\">Reservation Id</th>
                                             <td style=\"vertical-align:top; color:#333; width:60%; padding:7px 9px 7px 0; border-top:1px solid #eee\">$rId</td>
                                             </tr>
       										 <tr style=\"\">
               								 <th style=\"vertical-align: top;color:#222; text-align:left; padding:7px 9px 7px 9px; border-top:1px solid #eee\">Room Number</th>
                      					     <td style=\"vertical-align:top;color:#333;width:60%;padding:7px 9px 7px 0;border-top:1px solid #eee\">$roomNum</td>
                                             </tr>
                                             <tr style=\"background-color:#f5f5f5\">
                                             <th style=\"vertical-align:top; color:#222; text-align:left; padding:7px 9px 7px 9px; border-top:1px solid #eee\">Reservation Date</th>
                                             <td style=\"vertical-align:top;color:#333;width:60%;padding:7px 9px 7px 0;border-top:1px solid #eee\">$resDate</td>
                                             </tr>
                                              <tr style=\"\">
                                             <th style=\"vertical-align:top; color:#222; text-align:left; padding:7px 9px 7px 9px; border-top:1px solid #eee\">Primary Patron</th>
                                             <td style =\"vertical-align:top;color:#333;width:60%;padding:7px 9px 7px 0;border-top:1px solid #eee\">$primPatron</td>
                                             </tr >
                                             <tr style=\"background-color:#f5f5f5\">
                                             <th style=\"vertical-align:top; color:#222; text-align:left; padding:7px 9px 7px 9px; border-top:1px solid #eee\">Secondary Patron</th>
                                             <td style =\"vertical-align:top;color:#333;width:60%;padding:7px 9px 7px 0;border-top:1px solid #eee\">$secEmail</td>
                                             </tr >
                                             <tr style=\"\">
                                             <th style=\"vertical-align:top; color:#222; text-align:left; padding:7px 9px 7px 9px; border-top:1px solid #eee\">Start Time</th>
                                             <td style=\"vertical-align:top;color:#333;width:60%;padding:7px 9px 7px 0;border-top:1px solid #eee\">$startTime</td>
                                             </tr>
                                            <tr style=\"background-color:#f5f5f5\">
                                            <th style=\"vertical-align:top; color:#222; text-align:left; padding:7px 9px 7px 9px; border-top:1px solid #eee\">Duration </th>
                                            <td style=\"vertical-align:top;c olor:#333; width:60%; padding:7px 9px 7px 0; border-top:1px solid #eee\">$availableTime hr(s)</td>
                              				</tr>
        									<tr style=\"\">
         							        <th style=\"vertical-align:top; color:#222; text-align:left; padding:7px 9px 7px 9px; border-top:1px solid #eee\">Date & Time Reserved</th>
                      						<td style=\"vertical-align:top; color:#333; width:60%; padding:7px 9px 7px 0; border-top:1px solid #eee\">$currentTimeStamp</td>
        									</tr>
                                            <tr style=\"background-color:#f5f5f5\">
                                            <th style = \"vertical-align:top; color:#222; text-align:left; padding:7px 9px 7px 9px; border-top:1px solid #eee\" > Number of patrons</th >
                                         	<td style = \"vertical-align:top;c olor:#333; width:60%; padding:7px 9px 7px 0; border-top:1px solid #eee\" > $numPatrons </td >
       										</tr >
										   </table>";

				$this->email->message($message);
				$this->email->send();

			}

			$this->load->view('verify_view', $data);
		}
	}

	/*
     *
     * Receive date and slotId and timestamp from request.
     * Fetch slots(timestamp greater than received timestamp) from db.
     * If received slotId found in reservation.ini file → delete 6 consecutive slots from ini file and
     * -update ini file with existing remaining tentative slots.
     * Return data of slots and tentative slots
     *
     */
	public function refreshReservations()
	{
		$this->load->model('crr_model');
		$date = $this->input->get('date');
		$slotId = $this->input->get('slotId');
		$strings = explode("/", $date);
		$timestamp = $this->input->get('time');
		$currentTimestamp = substr($timestamp, 0, 10) . " " . substr($timestamp, 11, 19);
		$data['slots'] = $this->crr_model->getNewReservations($currentTimestamp);
		//$date = str_replace("/", "", $date);
		//$data['dat'] = $date;
		$reservation = parse_ini_file('reservation.ini');
		$size = sizeof($reservation);
		if ($size == 0) {
			$data['tentativeSlots'] = null;
		}
		$tentativeIni = array();
		for ($i = 0; $i < $size; $i++) {
			if ($slotId == $reservation[$i]) {
				$i = $i + 5;

			} else if ($i < $size) {
				array_push($tentativeIni, $reservation[$i]);
			}
		}
		$newSize = sizeof($tentativeIni);
		if ($newSize == 0) {
			fopen("reservation.ini", 'w');
		}
		if ($newSize > 0) {
			$fp = fopen("reservation.ini", 'w');

			for ($i = 0; $i < $newSize; $i++) {
				if ($tentativeIni[$i] != null) {
					$string = "$i = $tentativeIni[$i] \n";
					fwrite($fp, $string);
				}
			}
			$data['tentativeSlots'] = $tentativeIni;
		}

		echo json_encode($data);

	}


	/*
     * Receive date and timestamp from request.
     * Fetch slots(timestamp greater than received timestamp) from db.
     * Fetch tentative slots from reservation.ini file.
     * Return data of slots and tentative slots.
     *
     */
	public function getNewReservations()
	{
		$date = $this->input->get('date');
		$timestamp = $this->input->get('time');
		$currentTimeStamp = substr($timestamp, 0, 10) . " " . substr($timestamp, 11, 19);
		$this->load->model('crr_model');
		$data['slots'] = $this->crr_model->getNewReservations($currentTimeStamp);
		//	print_r($data['slots']);
		//$date = str_replace("/", "", $date);
		//$data['date'] = $date;
		$reservation = parse_ini_file('reservation.ini');
		$size = sizeof($reservation);
		$data['tentativeSlots'] = null;
		if ($size > 0) {

			$data['tentativeSlots'] = $reservation;
		}
		echo json_encode($data);
	}

	/*
     *
     * Returns verify_view with header and info
     *
     */

	public function displayInfo()
	{
		$data['header'] = "Reservation Failed";
		$data['info'] = "Unfortunately we cannot go back in time to make a reservation :)";
		$data['slotid']="0";
		$this->load->view('verify_view', $data);
	}

	/*
     *
     * Returns disclaimer
     *
     */

	public function disclaimer()
	{
		$this->load->view('disclaimer');
	}

	/*
	 * Receives selected room number
	 * Returns roomdetails_view with room details from db.
	 *
	 */
	public function roomDetails()
	{
		$this->load->model('crr_model');
		$roomNo = $this->input->get('roomNo');
		$data['details'] = $this->crr_model->getRoomDetails($roomNo);
		$this->load->view('roomdetails_view', $data);
	}

	/*
     * Receives selected room number
     * Returns roomdetails_view with room details from db.
     *
     */
	public function tooltipRoomDetails()
	{
		$this->load->model('crr_model');
		$roomNo = $this->input->get('roomNo');
		$data['details'] = $this->crr_model->getRoomDetails($roomNo);
		$this->load->view('t_roomdetails_view', $data);
	}

	/*
	 * Returns all the emails from reserver to tfq
	 */
	public function tfq()
	{
		$this->load->model('crr_model');
		$data['emails'] = $this->crr_model->getEmails();
		//$data['val'] = $this -> input -> get('val');
		$this->load->view('tfq', $data);
	}

	/*
	 * Recieve instructions(i.e start date,end date, hourId etc).
	 * Inserts the above information into hourInstructions table in db.
	 */
	public function setInstructions()
	{
		date_default_timezone_set('US/Eastern');
		$dateFormat = date('Y-m-d H:i:s');
		$date = new DateTime();
		$iDate = $date->format('m/d/Y H:i:s');
		$this->load->model('crr_model');
		$startDate = $_POST['startDate'];
		$strings = explode("/", $startDate);
		$formattedStartDate = "$strings[2]-$strings[0]-$strings[1]";
		$endDate = $_POST['endDate'];
		$strings = explode("/", $endDate);
		$formattedEndDate = "$strings[2]-$strings[0]-$strings[1]";
		$hoursId = $_POST['hoursId'];
		for ($i = 0; $i < sizeof($hoursId); $i++) {
			$data['startdate'] = $formattedStartDate;
			$data['enddate'] = $formattedEndDate;
			$data['hourId'] = $hoursId[$i];
			$data['instDate'] = $dateFormat;
			$result = $this->crr_model->insert_reservation($data, 'hoursInstructions');
		}
		echo $result;
	}

	/*
     * Retrieve the reservation details of the recieved date.
     * Load the retrieved details into printPage view
     */
	public function printTable()
	{
		$this->load->model('crr_model');
		$date = $this->input->get('date');
		$data['rooms'] = $this->crr_model->getRooms($date);
		$data['hours'] = $this->crr_model->getHours();
		$data['slots'] = $this->crr_model->getReservations($date);
		$data['blockedHours'] = $this->crr_model->getBlockedHours($date);
		$date = str_replace("/", "", $date);
		$data['date'] = $date;
		$this->load->view('printPage', $data);
	}

	/*
	 * Recieves the resId and deletes the reservation slot of 'resId' in db.
	 */
	public function deleteSlot()
	{
		$resId = $_POST['resId'];
		$this->load->model('crr_model');
		$result = $this->crr_model->deleteSlot($resId);
		echo $result;
	}

	/*
	 * Loads ack_view
	 */
	public function ack()
	{
		$this->load->view('ack_view');
	}

	/*
	 * Loads addNotes_view
	 */
	public function addNotes()
	{
		$this->load->view('addNotes_view');
	}

	/*
 * Loads addNotes2_view
 */
	public function addNotes1()
	{
		$data['email'] = $this->input->get('email');
		$this->load->view('addNotes2_view', $data);

	}

	/*
	 * Recieve email and notes
     * Save in database.
     */
	public function addANote()
	{
		$email = $_POST['email'];
		$notes = $_POST['notes'];
		$this->load->model('crr_model');
		$result = $this->crr_model->addANote($email, $notes);
		echo $result;
	}

	/*
	 * Recieve email
	 * Retrieve notes of 'email' form db
	 * Loads viewNotes.
	 */
	public function tooltipNotes()
	{
		$this->load->model('crr_model');
		$email = $this->input->get('email');
		if (empty($email)) {
			$data['error'] = "Please select an email to view the associated notes";
			$data['notes'] = array();
		} else {
			$data['error'] = null;

			$data['notes'] = $this->crr_model->getNotes($email);
		}
		$this->load->view('viewNotes', $data);

	}

	/*
	 * Loads report_view
	 *
	 */
	public function report()
	{
		$this->load->model('crr_model');
		$this->load->view('report_view');
	}

	/*
	 * Recieves date.
	 * Retrieve patron count for recieved date
	 * Loads patronCountReport view.
	 */
	public function getPatronCount()
	{
		$this->load->model('crr_model');
		$date = $this->input->get('date');
		$data['hours'] = $this->crr_model->getPatronCount($date);
		$data['date'] = $date;
		$this->load->view('patronCountReport', $data);
	}

	/*
	 * Recieves array of iids
	 * Remove each iid from hourInstructions table
	 *
	 */
	public function removeInstructions()
	{
		$this->load->model('crr_model');
		$iidArray = $_POST['iidArray'];
		for ($i = 0; $i < sizeof($iidArray); $i++) {
			$iid = $iidArray[$i];
			$result = $this->crr_model->remove_instructions($iid);
		}
		echo $result;
	}

	/*
	 * Recieves 's'(value of isAvailable) and array of room numbers
	 * Updates each room status as recieved the value 's'
	 *
	 */

	public function blockRooms()
	{
		$this->load->model('crr_model');
		$s = $this->input->get('s');
		$roomNo = $_POST['roomNo'];
		for ($i = 0; $i < sizeof($roomNo); $i++) {
			$room = $roomNo[$i];
			$result = $this->crr_model->updateRoomStatus($room, $s);
		}
		echo $result;
	}


	public function clearini()
	{
		$reservation = parse_ini_file('reservation.ini');
		$size = sizeof($reservation);
		$slots = array();
		if ($size > 0) {
			array_push($slots, $reservation);
			fopen("reservation.ini", 'w');
		}else{
			echo 1;
		}
		$reservation = parse_ini_file('reservation.ini');
		$newsize = sizeof($reservation);
		$slotsSize = sizeof($slots);

		if ($newsize == 0) {
			if ($slotsSize > 0) {
				$message = "<h4> Error Logs </h4></br></br>";
				$slots = json_encode($slots);
				date_default_timezone_set('US/Eastern');
				$date = date('Y-m-d');
				$log_file_name = "log-" . $date . ".php";
				$log_file_path = "/data/library/htdocs/crrs/application/logs/" . $log_file_name;
				if(file_exists($log_file_path)) {
					$contents = file($log_file_path);
				}else{
					$contents = false;
				}
				if($contents) {
					$contents = array_reverse($contents);
					$log_size = sizeof($contents);

				if ($log_size > 0) {
					$contents = json_encode($contents);
					$message .= "<table cellspacing=\"0\" cellpadding=\"0\" style=\"width:100%; border-bottom:1px solid #eee; font-size:12px; line-height:135%\">
                                             <tr style=\"background-color:#f5f5f5\">
                                             <th style=\"vertical-align:top ;color:#222; text-align:left; padding:7px 9px 7px 9px; border-top:1px solid #eee\">Slots Cleared</th>
                                             <td style=\"vertical-align:top; color:#333; width:60%; padding:7px 9px 7px 0; border-top:1px solid #eee\">$slots</td>
                                             </tr>
                                             <tr style=\"\">
               								 <th style=\"vertical-align: top;color:#222; text-align:left; padding:7px 9px 7px 9px; border-top:1px solid #eee\">Error Log</th>
                      					     <td style = \"vertical-align:top;color:#333;width:60%;padding:7px 9px 7px 0;border-top:1px solid #eee\" > $contents</td >
                                             </tr >
                                             </table>";

					if ($this->send_logmail($message)) {

						echo 1;

					}
				}else{

					$message .= "<table cellspacing=\"0\" cellpadding=\"0\" style=\"width:100%; border-bottom:1px solid #eee; font-size:12px; line-height:135%\">
                                             <tr style=\"background-color:#f5f5f5\">
                                             <th style=\"vertical-align:top ;color:#222; text-align:left; padding:7px 9px 7px 9px; border-top:1px solid #eee\">Slots Cleared</th>
                                             <td style=\"vertical-align:top; color:#333; width:60%; padding:7px 9px 7px 0; border-top:1px solid #eee\">$slots</td>
                                             </tr>
                                             <tr style=\"\">
               								 <th style=\"vertical-align: top;color:#222; text-align:left; padding:7px 9px 7px 9px; border-top:1px solid #eee\">Error Log</th>
                      					     <td style = \"vertical-align:top;color:#333;width:60%;padding:7px 9px 7px 0;border-top:1px solid #eee\" > Empty </td >
                                             </tr >
                                             </table>";
					if ($this->send_logmail($message)) {

						echo 1;

					}
				}
				}else{
					$message .= "<table cellspacing=\"0\" cellpadding=\"0\" style=\"width:100%; border-bottom:1px solid #eee; font-size:12px; line-height:135%\">
                                             <tr style=\"background-color:#f5f5f5\">
                                             <th style=\"vertical-align:top ;color:#222; text-align:left; padding:7px 9px 7px 9px; border-top:1px solid #eee\">Slots Cleared</th>
                                             <td style=\"vertical-align:top; color:#333; width:60%; padding:7px 9px 7px 0; border-top:1px solid #eee\">$slots</td>
                                             </tr>
                                             <tr style=\"\">
               								 <th style=\"vertical-align: top;color:#222; text-align:left; padding:7px 9px 7px 9px; border-top:1px solid #eee\">Error Log</th>
                      					     <td style = \"vertical-align:top;color:#333;width:60%;padding:7px 9px 7px 0;border-top:1px solid #eee\" > Empty </td >
                                             </tr >
                                             </table>";
					if ($this->send_logmail($message)) {

						echo 1;

					}

				}
			}

		} else {

			echo 0;
		}

	}

	public function send_logmail($message)
	{

		$this->load->library('email');
		$config['protocol'] = "smtp";
		$config['smtp_host'] = "ssl://smtp.googlemail.com";
		$config['smtp_port'] = "465";
		$config['smtp_user'] = "cannavinolibrary@gmail.com";
		$config['smtp_pass'] = "845@jac3419";
		$config['charset'] = "utf-8";
		$config['mailtype'] = "html";
		$config['newline'] = "\r\n";
		$this->email->initialize($config);
		$this->email->from('cannavinolibrary@gmail.com', 'James A. Cannavino Library (Collaboration Room Reservation System)');
		$this->email->to('cannavinolibrary@gmail.com');
		$this->email->cc('monish.singh1@marist.edu');
		$this->email->bcc('dheeraj.karnati1@marist.edu');
		$this->email->subject("crrs_logs");
		$this->email->message($message);



		if ($this->email->send()) {
			echo true;
		} else {
			echo false;
		}
	}

	public function user_verify()
	{

		$passcode = $this->input->get('pass');
		$this->load->model('crr_model');
		$apasscode = $this->crr_model->getPwd(1);
		if ($passcode == $apasscode) {
			$authorized = 1;
		} else {
			$authorized = 0;

		}
		echo $authorized;
	}

	public function admin()
	{

		$this->load->view('admin_view');

	}

	public function admin_verify()
	{

		$passcode = $this->input->get('pass');

		$this->load->model('crr_model');
		$apasscode = $this->crr_model->getPwd(2);
		if ($passcode == $apasscode) {
			$authorized = 1;
		} else {
			$authorized = 0;

		}

		echo $authorized;

	}

	public function admin_verify1()
	{

		$passcode = $this->input->get('pass');
		$this->load->model('crr_model');
		$apasscode = $this->crr_model->getPwd(2);
		if ($passcode == $apasscode) {
			$data['pass'] = $apasscode;
			$data['hours'] = $this->crr_model->getHours();
			$data['rooms'] = $this->crr_model->getRooms();
            $data['categories'] = $this->crr_model->getCategories();
            $data['patrons'] = $this->crr_model->getPatrons();
			$data['instructions'] = $this->crr_model->getInstructions();
            $data['bookingRequirements'] = $this->crr_model->getAllBookingRequirements();
            $data['blockedrooms'] = $this->crr_model->getBlockedRooms();
			$this->load->view('admin', $data);
		} else {

			echo "<h1 align='center' style=\"color:#B31B1B;\" > 401 - Unauthorized access</h1>";
		}

	}

    /* Creates a new booking requirment */
    public function addBookingRequirements() {
      $this->load->model('crr_model');
      $roomArray = $_POST['roomNo'];
      $catg_id= $_POST['category_type'];
      $patr_id = $_POST['patron_type'];

      if($_POST['patr_req']) {
        $patr_req = $_POST['patr_req'];
      }
      else{
        $patr_req = 1;
      }
      if($_POST['maxHour']) {
          $maxHour = $_POST['maxHour'];
      }
      else{
          $maxHour = 1;
      }

      for ($i= 0 ; $i<sizeof($roomArray); $i++) {
        $result = $this->crr_model->addBookingRequirements($roomArray[$i], $catg_id, $patr_id, $patr_req, $maxHour);
      }
      echo $result;
    }

    /* Updates an existiing booking requirement for a room */
    public function updateBookingRequirements() {
      $this->load->model('crr_model');
      $roomArray = $_POST['roomNo'];
      $catg_id= $_POST['category_type'];
      $patr_id = $_POST['patron_type'];

      if($_POST['patr_req']) {
        $patr_req = $_POST['patr_req'];
      }
      else{
        $patr_req = 1;
      }
      if($_POST['maxHour']) {
          $maxHour = $_POST['maxHour'];
      }
      else{
          $maxHour = 1;
      }

      for ($i= 0 ; $i<sizeof($roomArray); $i++) {
        $result = $this->crr_model->updateBookingRequirements($roomArray[$i], $catg_id, $patr_id, $patr_req, $maxHour);
      }

      echo $result;
    }

    /* Checks if there is an existing booking requirement for a given room with the specified caegory and patron */
    public function checkExistingBookingRequirements() {
      $this->load->model('crr_model');
      $roomArray = $_POST['roomNo'];
      $catg_id= $_POST['category_type'];
      $patr_id = $_POST['patron_type'];

      for ($i= 0 ; $i<sizeof($roomArray); $i++) {
        $result = $this->crr_model->checkExistingBookingRequirements($roomArray[$i], $catg_id, $patr_id);
        if ($result == 1){
          echo $result;
          return 1;
        }
      }

      echo $result;
    }

public function removeBookingRequirements(){

    $this->load->model('crr_model');
    $idArray = $_POST['idArray'];
    for ($i = 0; $i < sizeof($idArray); $i++) {

        $result = $this->crr_model->removeBookingRequirements($idArray[$i]);
    }
    echo $result;
}

public function timestamp(){
	$this->load->model('crr_model');

	$result = $this->crr_model->getReservation('47553');

	//$current_timestamp = mt_rand(10000,99999);

	print_r($result);

}


}
?>
