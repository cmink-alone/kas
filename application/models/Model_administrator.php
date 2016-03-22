<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_administrator extends CI_Model{
	
	public function m_tambah_anggota ($data){
		$query="insert into anggota 
				values(
						null,
						'".$data['nama']."',
						'".$data['nik']."',
						'".$data['tempat']."',
						STR_TO_DATE('".$data['tgl']."','%d-%m-%Y'),
						'".$data['jk']."',
						'".$data['email']."',
						'".$data['foto']."'
						
					)";
	
	return $this->db->query($query);	
		
	}
	
	public function ambil($nik){
		$q="select nik_anggota from anggota where nik_anggota='".$nik."'";
		return $this->db->query($q);
	}
	
	public function m_verifikasi($rec,$lim,$fild,$urut,$where='') {
		$q="select keanggotaan.nik_anggota, anggota.nama, keanggotaan.keanggotaan, keanggotaan.tanggal , keanggotaan.ef_bulan, keanggotaan.ef_tahun from anggota left JOIN keanggotaan ON anggota.nik_anggota=keanggotaan.nik_anggota ".$where." ORDER BY ".$fild." ".$urut." limit ". $rec.",".$lim;
		return $this->db->query($q);
	}

	public function cari_anggota($nama) {
		$q="select keanggotaan.nik_anggota, anggota.nama, keanggotaan.keanggotaan, keanggotaan.tanggal , keanggotaan.ef_bulan,keanggotaan.ef_tahun from anggota left JOIN keanggotaan ON anggota.nik_anggota=keanggotaan.nik_anggota where anggota.nama Like '%".$nama."%' ORDER BY anggota.nama  limit 0,50";
		return $this->db->query($q);
	}
	
	public function jumlah_anggota(){
		$q="select * from anggota";
		return $this->db->query($q);
	}

	

	public function update_efektif($d,$ke=1){
			$q="update keanggotaan SET keanggotaan=".$ke.", tanggal= date(now()), ef_bulan=".$d['bln'].",ef_tahun=".$d['thn']." where nik_anggota=".$d['id'];
	return  $this->db->query($q);

	}

	public function add_kategori($nt,$pengeluaran,$ket){
		$q= "insert into kategori_pengeluaran (nama_kategori,pengeluaran,keterangan) values('".$nt."',".$pengeluaran.",'".$ket."')";
		return $this->db->query($q);
	}

	public function add_pengeluaran_dana($data,$iex=1){
		if (!isset($data['nik_anggota'])){
			$data['nik_anggota']=-100;
		}

		$q="insert into dana_pengeluaran VALUES (null,'".$data['tanggal']."',".$data['nik_anggota'].",'".$data['kategori']."','".$data['pengeluaran']."','".$data['keterangan']."',".$iex.")";
		return $this->db->query($q);

	}


	public function lap_pengeluaran_ang(){
		return $this->db->query("select * from data_pengeluaran where internal_external=1")->result_array();
	}

	public function lap_pengeluaran_ext(){
		return $this->db->query("select * from data_pengeluaran where internal_external=0")->result_array();
	}
	
	// cepat//

	public function delete($tbl,$fild,$key){
		$q="delete from ".$tbl." where ".$fild." = '".$key."'";
	return $this->db->query($q);
	}	

	public function select_semua($tbl,$where=''){
		$q='select * from '.$tbl.$where;
		return $this->db->query($q);
	}

	public function select_fild($fild, $tbl,$where){
		$q='select '.$fild.' from '.$tbl.$where;
		return $this->db->query($q);
	}

	public function select_one($tbl,$fild,$key){
		$q="select * from ".$tbl ." where ".$fild."='".$key."'";
	return	$this->db->query($q);
	}


	public function update_where ($tbl, $values, $where ){
		$q="update ".$tbl." SET ".$values." where ".$where;
	return $this->db->query($q);	
	}

	/////////////////////////////////// menu index
	public function update_besaran_kas($data){
		$q="update set_bulanan_kas SET bayar =".$data['bayaran']." where tahun=".$data['tahun']." and bulan=".$data['bulan'];
		return $this->db->query($q);
	}

	public function group_tahun(){
		$q="select tahun from set_bulanan_kas group by tahun";
		return $this->db->query($q);
	}

	public function ambil_data_kas($tahun){
		$q="select * from set_bulanan_kas where tahun =".$tahun;
		return $this->db->query($q);
	}
	public function add_tahun($tahun){
		$q1 =   "insert into set_bulanan_kas (tahun,bulan) values(".$tahun.",1);";
		$q2 =   "insert into set_bulanan_kas (tahun,bulan) values(".$tahun.",2);";
		$q3 =   "insert into set_bulanan_kas (tahun,bulan) values(".$tahun.",3);";
		$q4 =   "insert into set_bulanan_kas (tahun,bulan) values(".$tahun.",4);";
		$q5 =   "insert into set_bulanan_kas (tahun,bulan) values(".$tahun.",5);";
		$q6 =   "insert into set_bulanan_kas (tahun,bulan) values(".$tahun.",6);";
		$q7 =   "insert into set_bulanan_kas (tahun,bulan) values(".$tahun.",7);";
		$q8 =   "insert into set_bulanan_kas (tahun,bulan) values(".$tahun.",8);";
		$q9 =   "insert into set_bulanan_kas (tahun,bulan) values(".$tahun.",9);";
		$q10 =   "insert into set_bulanan_kas (tahun,bulan) values(".$tahun.",10);";
		$q11 =   "insert into set_bulanan_kas (tahun,bulan) values(".$tahun.",11);";
		$q12 =   "insert into set_bulanan_kas (tahun,bulan) values(".$tahun.",12);";
		$this->db->query($q1);$this->db->query($q2);$this->db->query($q3);$this->db->query($q4);
		$this->db->query($q5);$this->db->query($q6);$this->db->query($q7);$this->db->query($q8);
		$this->db->query($q9);$this->db->query($q10);$this->db->query($q11);
		return $this->db->query($q12);
	}

	public function select_bulanan_kas($tahun){
		$q= "select * from set_bulanan_kas where tahun = ".$tahun;
		return $this->db->query($q);
	}
	// telat

	public function  telat_bayar($nik,$tahun,$bulan){
		$q="insert into telat_bayar (nik,tahun,bulan) values(".$nik.",".$tahun.",".$bulan.")";
		$this->db->query($q);
	}

	public function telat_terhir($id){
		return $this->db->query("select tahun,bulan  from telat_bayar  where nik=".$id." order by id DESC limit 0,1")->result_array();
	}

	public function show_telat($id){
		$q="select * from telat_bayar where nik=".$id;
		return $this->db->query($q)->result_array();
	}

	public function hapus_telat($nik){
		$q="delete from telat_bayar where nik='".$nik."'";
		$this->db->query($q);
	}
	//////////////////////// PEMBAYARAN UANG KAS //
	public function max_tahun(){
		$q="select max(tahun) as max_th from set_bulanan_kas";
		$db=$this->db->query($q);
		return $db->result_array();
	}
	public function data_pembayaran($tahun){
		$q= "select bayar_kas.id_bayar_kas, bayar_kas.nik_anggota, bayar_kas.tahun, bayar_kas.bayar_bulan,set_bulanan_kas.bayar,bayar_kas.tanggal_bayar,bayar_kas.bayar, bayar_kas.`status`, bayar_kas.keterangan from  set_bulanan_kas 
			inner join bayar_kas ON set_bulanan_kas.bulan = bayar_kas.bayar_bulan where set_bulanan_kas.tahun = ".$tahun." and bayar_kas.tahun = ".$tahun;
		return $this->db->query($q);
	}

	public function bayar_bulanan($nik,$tahun,$bln,$ket,$dana){
		$q="insert into bayar_kas (nik_anggota,tahun,bayar_bulan,membayar,keterangan,status) values(".$nik.",".$tahun.",".$bln.",".$dana.",'".$ket."','Sudah dibayar')";
		return $this->db->query($q);
	}

	public function harus_bayar($tahun1, $tahun2){
		$q="select * from set_bulanan_kas where ".$tahun1." <= tahun and  tahun < ".$tahun2;
		return $this->db->query($q);
	}

	public function telah_bayar($id,$tahun){
		$q= "select * from bayar_kas where tahun =".$tahun." and nik_anggota=".$id;
		return $this->db->query($q);
	}

	public function terahir_bayar($id){
		$q= "select max(id_bayar_kas) as id_bayar from bayar_kas  where nik_anggota=".$id;
		return $this->db->query($q);
	}
	public function baru($id){
		$q="select ef_tahun,ef_bulan from keanggotaan where nik_anggota=".$id;
		return $this->db->query($q);
	}

	public function pembayaran_terahir($id){
		$q="select * from bayar_kas where id_bayar_kas=".$id;
		return $this->db->query($q);
	}

	function set_bulanan($tahun=''){

		$q="select * from set_bulanan_kas where tahun = ".$tahun ." order by bulan ASC";
		return $this->db->query($q);
	}

	// DONASI //

	public function add_donasi($d){
		$q="insert into donasi (tanggal,nama,alamat,donasi,keterangan) values('".$d['tgl']."','".$d['nama']."','".$d['alamat'].",',".$d['rp_dana'].",'".$d['keterangan']."')";
		$d= $this->db->query($q);
		return $d;
	}

	public function ambil_nik_aktif(){
		return $this->db->query("select nik_anggota from keanggotaan where keanggotaan=1")->result_array();
	}

	public function bayra_terahir($id){
		return $this->db->query("select tahun,bayar_bulan from bayar_kas where nik_anggota=".$id." order by id_bayar_kas DESC LIMIT 0,1")->result_array();
	}
	////////// laporan
	public function lap_anggota_group($tahun,$limit,$pg){
		return $this->db->query('Select nik_anggota,nama from data_bayaran where tahun='.$tahun. ' group by nik_anggota order by nama limit '.$limit.','.$pg)->result_array();
	}


	public function lap_anggota_group_n($tahun){
		return $this->db->query('Select nik_anggota,nama from data_bayaran where tahun='.$tahun. ' group by nama order by nama')->num_rows();
	}

	public function lap_anggota_isi($nik,$tahun){
		return $this->db->query('select nik_anggota,tahun,bayar_bulan,membayar from data_bayaran where nik_anggota='.$nik.' and tahun='.$tahun.' order by bayar_bulan ASC')->result_array();
	}

	public function lap_anggota_telat($nik,$tahun){
		return $this->db->query('select * from pembayar_telat where nik='.$nik.' and tahun='.$tahun.' order by bulan ASC')->result_array();
	}

	public function lap_bulanan($bulan,$tahun){
		$db= $this->db->query('select sum(membayar) as perbulan from data_bayaran  where bayar_bulan='.$bulan.' and tahun='.$tahun)->result_array();	
		return	$db=$db[0]['perbulan'];
	}

	public function lap_donasi($tahun){
		$k=$tahun-1;
		$l=$tahun+1;
		$k=$k.'-12-31';
		$l=$l.'-1-1';
		return $this->db->query("select  * from donasi WHERE '".$k."' < tanggal and tanggal < '".$l."'")->result_array();
	}

	public function password(){
		return $this->db->query('select password from login where user="administrator"')->result_array();
	}

	public function password_update($data){
		 $this->db->query('update login set password="'.md5($data).'" where user="administrator"');//200ceb26807d6bf99fd6f4f0d1ca54d4
	}
}//end_class
?>