<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_user extends CI_Model{
	public function anggota($nik){
		return $this->db->query("select nik_anggota,nama,tempat,tgl_lahir,jk,email,foto from anggota where nik_anggota=".$nik)->result_array();
	}

	public function bayaran($nik){
		return $this->db->query("select 	tanggal_bayar,tahun,bayar_bulan,membayar ,keterangan from bayar_kas where nik_anggota=".$nik.' order by id_bayar_kas DESC limit 0,10')->result_array();
	}

	public function telat($nik){
		return $this->db->query("select bulan, tahun from telat_bayar where nik=".$nik." order by id DESC")->result_array();
	}

	public function total_pemasukan(){
		return $p1= $this->db->query('select * from pemasukan_anggota')->result_array();
	}

	public function total_donasi(){
		return $this->db->query('select * from total_donasi')->result_array();
	} 

	public function t_pa(){
		return $this->db->query('select * from total_pengeluaran_anggota')->result_array();
	}

	public function t_px(){
		return $this->db->query('select * from total_pengeluaran_ext')->result_array();
	}
	public function sumbangan(){
		return $this->db->query('select * from kategori_pengeluaran')->result_array();
	}

	public function db_tahun(){
		return $this->db->query("select tahun from set_bulanan_kas group by (tahun)")->result_array();
	}

	public function pengeluaran_int($thn){
		$ak_max=($thn+1).'-01-01';
		$ak_min=($thn-1).'-12-31';
		return $this->db->query('select * from data_pengeluaran where internal_external=1 and tanggal< "'.$ak_max.'" and tanggal>"'.$ak_min.'"')->result_array();
	}

	public function pengeluaran_ext($thn){
		$ak_max=($thn+1).'-01-01';
		$ak_min=($thn-1).'-12-31';
		return $this->db->query('select * from data_pengeluaran where internal_external=0 and tanggal< "'.$ak_max.'" and tanggal>"'.$ak_min.'"')->result_array();
	}
	public function pemasukan_anggota_bulan($tahun){
		return $this->db->query('select bayar_bulan, sum(membayar) as total from data_bayaran  where tahun= '.$tahun.' group by (bayar_bulan) order by bayar_bulan asc;')->result_array();
	}

	public function donasi(){
		return $this->db->query('select tanggal,nama,alamat,donasi,keterangan from donasi')->result_array();
	}

	public function am_password($id){
		return $this->db->query('select password from login where user='.$id)->result_array();
	}

	public function up_password($data){
		return $this->db->query('update login SET password="'.md5($data['pn']).'" where user='.$data['nik']);
	}

	public function aktivasi ($id){
		return $this->db->query('select ef_bulan,ef_tahun from keanggotaan where nik_anggota = '.$id)->result_array();
	}

	public function pesan ($id){
		return $this->db->query('select dari,foto,judul,pesan,waktu,id1,terbaca from pesan where  buat="'.$id.'" and terbaca="t"' )->result_array();
	}

	public function pesan_y ($id){
		return $this->db->query('select dari,foto,judul,pesan,waktu,id1,terbaca from pesan where  buat="'.$id.'" and terbaca="y"  order by id desc limit 0,10' )->result_array();
	}
	
	public function detail_pesan_t($id){
		return $this->db->query('select dari,judul,pesan,waktu,bayar_bulan,tahun,membayar,keterangan,id_bayar_kas from detail_pesan where terbaca="t" and buat='.$id)->result_array();
	}

	public function update_pesan($id){
		$this->db->query('update pesan SET terbaca="y" where buat='.$id.' and terbaca="t"');
	}

	public function pesan_arsip($thn,$id){
		return $this->db->query('select dari,judul,pesan,waktu,bayar_bulan,tahun,membayar,keterangan,id_bayar_kas from detail_pesan where tahun='.$thn.' and buat='.$id)->result_array();
	}

	public function pesan_arsip_tahun($id){
		return $this->db->query("select tahun from detail_pesan where buat=".$id." group by (tahun)")->result_array();
	}

	public function data_bayaran($id){
		return $this->db->query('select bayar_bulan as bulan,tahun from bayar_kas where nik_anggota='.$id.'  order by id_bayar_kas DESC limit 0,1')->result_array();
	}

	public function telat_bayar($id){
		return $this->db->query('select bulan,tahun from telat_bayar where nik='.$id)->result_array();
	}
	
	public function telat_bayar1($id){
		return $this->db->query('select bulan,tahun from telat_bayar where nik='.$id ." order by id Desc limit 0,1")->result_array();
	}
	public function  telat_bayar2($nik,$tahun,$bulan){
		 $q="insert into telat_bayar (nik,tahun,bulan) values(".$nik.",".$tahun.",".$bulan.")";
		$this->db->query($q);
	}
}
?>