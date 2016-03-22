<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Administrasi extends CI_Controller{
	public function __construct(){
		parent:: __construct();

		$session=$this->session->userdata();
		if($session['login']!='ya'){
			redirect(base_url());
		}
	}

	function index(){
		echo "Administrasi";
	}

	public function total_kas(){
		$db =$this->M_administrasi->total_kas();
		echo "<pre>";
		print_r($db);
		echo "</pre>";
	}
}
?>