<?php
class crr extends CI_Controller {
	public function index() {
		$data['title'] = "JAC Collaboration Rooms";
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