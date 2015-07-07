<?php
class crr extends CI_Controller {
	public function index() {
		$this -> load -> model('crr_model');
		$data['title'] = "JAC Collaboration Rooms";
		$data['rooms'] = $this -> crr_model -> getRooms();
		$data['hours'] = $this -> crr_model -> getHours();
		$this -> load -> view('crr_view', $data);
	}
	public function reserveForm(){
		$this -> load -> model('crr_model');
		$data['title'] = "JAC Collaboration Rooms Reservation System";
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
			$reserver = $this->input->post('primEmail');
			if($this->crr_model->getreserver($reserver)){
				//echo ("in");
				$this->crr_model->insert_user($reserverData);
			}
			$resdate = $this->input->post('resDate');
			
			
			$resStartTime =  $this->input->post('timeStart');
			$resEndTime =  $this->input->post('timeEnd');
			if(substr($resStartTime, -2, 1) == "a"){
				if(substr($resStartTime, 2, 1) == ":"){
					$resStartTime = substr($resStartTime, 0, 2) * 100;
				}
				else {
					$resStartTime = '0' . substr($resStartTime, 0, 1)  * 100;
				}
			}
			else{
				if(substr($resStartTime, 2, 1) == ":"){
	         		if(substr($resStartTime, 0, 2) == '12')
						$resStartTime = 1200; 
					else
						$resStartTime = (substr($resStartTime, 0, 2) + 12) * 100;
				}
				else {
					
					$resStartTime = (substr($resStartTime, 0, 1) + 12)  * 100;
				}
			}
			if(substr($resEndTime, -2, 1) == "a"){
				if(substr($resEndTime, 2, 1) == ":"){
					$resEndTime = substr($resEndTime, 0, 2) * 100;
				}
				else {
					$resEndTime = '0' . substr($resEndTime, 0, 1)  * 100;
				}
			}
			else {
				if(substr($resEndTime, 2, 1) == ":"){
					if(substr($resEndTime, 0, 2) == '12')
						$resEndTime = 1200; 
					else
						$resEndTime = (substr($resEndTime, 0, 2) + 12) * 100;
				}
				else {
					
					$resEndTime = (substr($resEndTime, 0, 1) + 12) * 100;
				}
			}
			if($this->input->post('roomNum') == "300A")
				$roomNum = "300";
			else if($this->input->post('roomNum') == "300B")
				$roomNum = "301";
			else if($this->input->post('roomNum') == "300C")
				$roomNum = "302";
			else if($this->input->post('roomNum') == "300D")
				$roomNum = "303";
			else 
				$roomNum = $this->input->post('roomNum');
			$resId = substr($resdate, 0, 2) . substr($resdate,3,2) . substr($resdate,6,4) . $resStartTime . $resEndTime . $roomNum;
			$resData = array(
				'resId' => $resId,
				'roomNum' => $this->input->post('roomNum'),
				'resDate' => $resdate,
				'startTime' => $this->input->post('timeStart'),
				'endTime' => $this->input->post('timeEnd'),
				'resEmail' => $reserver,
				'resType' => $this->input->post('bookType'),
				'status' => $status,
				'isFinals' => $isFinals
			);
			$this->crr_model->insert_reservation($resData);
			$this->load->view('verify_view');
		}
		//$this -> load -> view('reserveform_view', $data);
	}
	public function disclaimer(){
		$this -> load -> view('disclaimer');	
	}	
}
?>