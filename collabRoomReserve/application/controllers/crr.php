<?php
class crr extends CI_Controller {
	public function index() {
		$this -> load -> model('crr_model');
		$data['title'] = "JAC Collaboration Rooms";
		$data['resTime'] = $this -> crr_model -> getrestime();
		$this -> load -> view('crr_view', $data);
	}
	public function reserveForm(){
		$data['title'] = "JAC Collaboration Rooms Reservation System";
		$this -> load -> view('reserveform_view', $data);
	}
	public function disclaimer(){
		$this -> load -> view('disclaimer');	
	}	
}
?>