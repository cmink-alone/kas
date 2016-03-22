<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_login extends CI_Model{
	public function admin($data){
		$q ="select * from login where id_anggota=-1 and user='".$data['data'][0]."' and password='".md5($data['data'][1])."'";
		return $db=$this->db->query($q)->result_array();

	}

	public function user($d){
		return $this->db->query("select * from login where user='".$d['data'][0]."' and password='".md5($d['data'][1])."'")->result_array();
	}
}
?>