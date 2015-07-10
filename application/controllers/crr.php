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

	public function reserveForm(){
		$this -> load -> model('crr_model');
		$data['title'] = "JAC Collaboration Rooms Reservation System";
		$data['rooms'] = $this -> crr_model -> getRooms();
		$data['hours'] = $this -> crr_model -> getHours();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('roomNum', 'Room Number', 'required|min_length[3]');
		$this->form_validation->set_rules('resDate', 'Reserve Date', 'required');
		$this->form_validation->set_rules('timeStart', 'Start Time', 'required');
		$this->form_validation->set_rules('timeEnd', 'End Time', 'required');
		$this->form_validation->set_rules('primEmail', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('secEmail', 'Email', 'required|valud_email');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('reserveForm_view', $data);
		}
		else
		{
			$reserver = $this->input->post('primEmail');
			if($this->crr_model->getreserver($reserver)){
				//echo ("in");
				$this->crr_model->insert_user($reserverData);
			}
			for($cnt = 0; cnt < $this->input->post('numHours'); $cnt++ ){
				if($this->input->post('bookType') == "person")
					$status = 1;
				else
					$status = 2;
				if($this->input->post('resDate') > '12/14/2015' && $this->input->post('resDate') < '12/18/2015' || $this->input->post('resDate') > '05/09/2015' && $this->input->post('resDate') < '05/13/2015')
					$isFinals = TRUE;
				else 
					$isFinals = FALSE;
				$reserverData = array(
					'email' => $this->input->post('primEmail')
				);
				
				$resdate = $this->input->post('resDate');
				
				
				$resStartTime =  $this->input->post('timeStart');
				if(substr($resStartTime,1,0) == ":")
					$resStartTime = substr($resStartTime,0,1);
				else {
					$resStartTime = substr($resStartTime,0,2);
				}
				$roomNum = $this->input->post('roomNum');
				$resId = substr($resdate, 0, 2) . substr($resdate,3,2) . substr($resdate,6,4) . $roomNum . $resStartTime;
				$resData = array(
					'resId' => $resId,
					'roomNum' => $this->input->post('roomNum'),
					'resDate' => $resdate,
					'startTime' => $this->input->post('timeStart'),
					'resEmail' => $this->input->post('primEmail'),
					'resType' => $this->input->post('bookType'),
					'status' => $status,
					'isFinals' => $isFinals
				);
				$this->crr_model->insert_reservation($resData);
			}
			$this->load->view('verify_view');
		}
		}
		//$this -> load -> view('reserveform_view', $data);
	public function disclaimer(){
		$this -> load -> view('disclaimer');	
	}	
}
?>