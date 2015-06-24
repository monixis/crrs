<?php
class crr extends CI_Controller {
	public function index() {
		$this -> load -> model('crr_model');
		$data['title'] = "JAC Collaboration Rooms";
		//S$data['res'] = $this -> crr_model -> getres();
		$this -> load -> view('crr_view', $data);
	}
	public function reserveForm(){
		$data['title'] = "JAC Collaboration Rooms Reservation System";
		
		$this -> load -> view('reserveform_view', $data);
	}
	public function disclaimer(){
		$this -> load -> view('disclaimer');	
	}	
	public function verify(){
		$data['title'] = "JAC Collaboration Rooms Reservation System";
		$this -> load -> view('querySubmissionReserveForm', $data);
	}
	
	public function getres(){
		$this -> load -> model('crr_model');
		$result = $this -> crr_model -> getres(); 
		echo $result;
	}
	
}
?>