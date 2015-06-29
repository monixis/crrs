<?php
class crr extends CI_Controller {
	public function index() {
		$this -> load -> model('crr_model');
		$date = getdate();
		$dateStr = $date["mon"]. "-" . $date["mday"]. "-" . $date["year"];
		$data['title'] = "JAC Collaboration Rooms";
		$data['res'] = $this -> crr_model -> getres($dateStr);
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
				$status = "reserved";
			else
				$status = "unverified";
			if($this->input->post('resDate') > '12-14-2015' && $this->input->post('resDate') < '12-18-2015' )
				$isFinals = TRUE;
			else 
				$isFinals = FALSE;
			
			$reserver = $this->input->post('primEmail');
			if($this->crr_model->getreserver($reserver) == 0){
				//echo($this->crr_model->getreserver($reserver));
				$this->crr_model->insert_user($reserver);
			}
			$resData = array(
				'roomNum' => $this->input->post('roomNum'),
				'resDate' => $this->input->post('resDate'),
				'startTime' => $this->input->post('timeStart'),
				'endTime' => $this->input->post('timeEnd'),
				'resEmail' => $this->input->post('primEmail'),
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