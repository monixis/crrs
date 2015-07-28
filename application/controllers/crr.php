<?php
class crr extends CI_Controller {
	public function index() {
		$this -> load -> model('crr_model');
		$data['title'] = "JAC Collaboration Rooms";
		$data['rooms'] = $this -> crr_model -> getRooms();
		$data['hours'] = $this -> crr_model -> getHours();
		$this -> load -> view('crr_view', $data);
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
	
	public function reservationDetails(){
		$this -> load -> model('crr_model');
		$resId = $this -> input -> get('resId');
		$data['details'] = $this -> crr_model -> getResDetails($resId);
		$this -> load -> view('reservation_view', $data);
	}
	
	public function updateStatus(){
		$rId = $_POST['rId'];
		$status = $_POST['status'];
		$this -> load -> model('crr_model');
		$result = $this -> crr_model -> updateStatus($rId, $status);
		echo $result;
	}
	
	public function reserveForm(){
		$this -> load -> model('crr_model');
		$data['title'] = "JAC Collaboraseservation System";
		$data['rooms'] = $this -> crr_model -> getRooms();
		$data['hours'] = $this -> crr_model -> getHours();
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
			}
			else {
				$roomNum = substr($resId,8,3);
				$time = substr($resId,11);
			}
				if($this->input->post('bookType') == "person")
					$status = 1;
				else
					$status = 2;
				/*if($resDate > '12/14/2015' && $resDate < '12/18/2015' || $resDate > '05/09/2015' && $resDate < '05/13/2015')
					$isFinals = TRUE;
				else 
					$isFinals = FALSE;
			*/
			$totalHours = $this->input->post('numHours');
			$limit = $this->input->post('numHours') + $time;
			for($time; $time < $limit; $time++){
				if($time == 25)
					$resTime = 1;
				else if ($time == 26)
					$resTime = 2;
				else {
					$resTime = $time;
				}
				$resId = substr($resId, 0, 8) . $roomNum . $resTime;
				$inResTime = $resTime . ":00";
				$resData = array(
					'resId' => $resId,
					'roomNum' => $roomNum,
					'resDate' => $resDate,
					'startTime' => $inResTime,
					'resEmail' => $this->input->post('primEmail'),
					'resType' => $this->input->post('bookType'),
					'status' => $status,
					'totalHours' => $totalHours,
					'rId' => $rId
				);
			$this->crr_model->insert_reservation($resData);
			
			}
			
		$data['info'] = "The reservation is complete. Reservation id: ";		
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