<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_administrasi extends CI_Model{
	public function __construct(){
		parent:: __construct();
		
	}

	public function total_kas(){
		$data['tot_pengeluaran_ext']='';
		$data['tot_pengeluran_ang']=0;
		$db1= $this->db->query("Select sum(membayar) as total_bayaran from bayar_kas;")->result_array();
		$data['total_pem_anggota']=$db1[0]['total_bayaran'];
		$db2= $this->db->query("select sum(bayar) as total_telat from pembayar_telat;")->result_array();
		$data['total_telat']=$db2[0]['total_telat'];
		$db3	=$this->db->query("select * from total_donasi;")->result_array();
		if(isset($db3[0]['total_donasi'])){$data['total_donasi']=$db3[0]['total_donasi'];}else{$data['total_donasi']='';}
		$data['total_pem_kas']=$data['total_pem_anggota']+$data['total_donasi'];
		$db=$this->db->query("select * from total_pengeluaran_anggota")->result_array();
		if(isset($db[0]['total_pengeluaran_ang'])){
		$data['tot_pengeluran_ang']=$db[0]['total_pengeluaran_ang'];}
		$db= $this->db->query("select * from total_pengeluaran_ext")->result_array();
		if(isset($db[0]['tot_pengeluaran_ext'])){
		$data['tot_pengeluaran_ext']=$db[0]['tot_pengeluaran_ext'];}
		$data['total_pengeluaran_kas']=$data['tot_pengeluran_ang']+$data['tot_pengeluaran_ext'];
		$data['total_saldo_kas']=$data['total_pem_kas']-$data['total_pengeluaran_kas'];
		return $data;
	}
}
?>