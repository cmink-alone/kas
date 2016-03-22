<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller{
	 private $waktu;
	 private $bulan_sekarang;
	 private $tahun_sekarang ;
	 private $db_tahun;
	 private $nik;

	function __construct(){
		parent::__construct();
		
		$data=$this->session->userdata();
		if(!isset($data['idx'])){
			redirect(base_url());
		}
		$this->nik=$data['idx'];

		$this->waktu=getdate();
		$this->tahun_sekarang = $this->waktu['year'];
		$this->db_tahun = $this->M_user->db_tahun();
		$this->bulan_sekarang =$this->waktu['mon'];
		$id=$this->nik;
		$dari=array();

		$aktivasi=$this->M_user->aktivasi ($id);
		$dari['bulan']=$aktivasi[0]['ef_bulan'];
		$dari['tahun']=$aktivasi[0]['ef_tahun'];

		$bayar=$this->M_user->data_bayaran($id);
		if(!isset($bayar[0])){
			$bayar[0]['bulan']=0;
			$bayar[0]['tahun']=0;
		}
		 $bulan_sekarang= $this->bulan_sekarang;
		 $tahun_sekarang= $this->tahun_sekarang;
	
		if( $dari['tahun']<$bayar[0]['tahun']){
			$dari['tahun']=$bayar[0]['tahun'];
			$dari['bulan']=$bayar[0]['bulan']+1;
		}elseif($dari['tahun']==$bayar[0]['tahun'] and $dari['bulan']<$bayar[0]['bulan'] ){
			$dari['tahun']=$bayar[0]['tahun'];
			$dari['bulan']=$bayar[0]['bulan']+1;
		}

		$telat=$this->M_user->telat_bayar1($id);

		if(!isset($telat[0])){
			$telat[0]['bulan']=0;
			$telat[0]['tahun']=0;
		}else{
			++$telat[0]['bulan'];
		}
		
	
		if( $dari['tahun']<$telat[0]['tahun']){
			$dari['tahun']=$telat[0]['tahun'];
			$dari['bulan']=$telat[0]['bulan'];
		}elseif($dari['tahun']==$telat[0]['tahun'] and $dari['bulan']<$telat[0]['bulan'] ){
			$dari['tahun']=$telat[0]['tahun'];
			$dari['bulan']=$telat[0]['bulan'];
		}

		$key=0;
		if($dari['tahun']<$this->tahun_sekarang){

		}elseif($dari['tahun'] == $tahun_sekarang and $dari['bulan'] < $bulan_sekarang){
			
			while ( $key == 0) {
				$this->M_user->telat_bayar2($id,$dari['tahun'],$dari['bulan']);
			
				if($dari['bulan']==$this->bulan_sekarang){
					$key=1;
				}
				++$dari['bulan'];
				
			}
		}elseif($dari['tahun']<$this->tahun_sekarang){
			while ($key==0) {
				//$this->M_user->telat_bayar2($id,$dari['tahun'],$dari['bulan']);
			
				++$dari['bulan'];
				if($dari['bulan']==13){
					$dari['bulan']==1;
					++$dari['tahun'];
				}

				if($dari['tahun']==$this->$tahun_sekarang and $dari['bulan']==$this->bulan_sekarang){
					$key=1;
				}
				
			}
		}
	}

 	
	public function index(){

		$data=array('js'=>$this->in_js());
		$data['bootstrap']=$this->bootstrap();
		$data['css']=$this->css();
		$data['in_header']=$this->in_header();
		$data['in_menu_kiri']=$this->in_menu_kiri();
		$data['js_manual']=$this->js_cus();
		$this->load->view("user/index",$data);
	}

	public function in_js(){
		//untuk semua js di index
		return $this->load->view("user/inc/_in_js.js",array(),true);
	}

	private function js_cus(){
		return $this->load->view('user/inc/_js_cus.js',array(),true);
	}

	private function bootstrap(){
		return $this->load->view("user/inc/in_bootstrap",array(),true);	
	}
	private function css(){
		return $this->load->view("user/inc/in_css.css",array(),true);	
	}

	public function in_header(){
		
		$nik=$this->session->userdata('idx');
		$db= $this->M_user->anggota($nik);
		$ps=$this->M_user->pesan($nik);
		if(count($ps)==0){
			$ps_y=$this->M_user->pesan_y($nik);
		}else{
			$ps_y='';
		};
		$ps_y=json_encode($ps_y);
		$ps=json_encode($ps);
		$telat=json_encode($this->M_user->telat($nik));
		$js=json_encode($db);
		$data=array('user'=>$js,'pesan'=>$ps,'ps_y'=>$ps_y);
		return $this->load->view('user/index_konten/_in_header',$data,true);
	}

	public function in_menu_kiri(){
		$data=array();
		return $this->load->view('user/index_konten/_in_menu_kiri',$data,true);
	}

	public function in_belum_bayar(){
		$nik=$this->session->userdata('idx');
		$telat=json_encode($this->M_user->telat($nik));
		$data=array('telat'=>$telat);
		return $this->load->view("user/index_konten/_in_belum_bayar",$data,true);
	}

	public function in_pembayaran_terahir(){
		$nik=$this->session->userdata('idx');
		$bayar=json_encode($this->M_user->bayaran($nik));
		$data=array('bayar'=>$bayar);
		return $this->load->view("user/index_konten/_in_pembayaran_terahir",$data,true);
	}

	public function dashboard(){
		$db=$this->M_user->total_pemasukan();
		$do=$this->M_user->total_donasi();
		if(isset($do[0])){$do[0]['total_donasi'];}else{$do[0]['total_donasi']=0;}
		if(isset($db[0])){$db[0]['total_pembayaran'];}else{$db[0]['total_pembayaran']=0;}
		$total_pemasukan1=$do[0]['total_donasi']+$db[0]['total_pembayaran'];
		$total_pemasukan='Rp. ' .number_format($total_pemasukan1 ,0 ,',','.');

		$pa=$this->M_user->t_pa();
		$px=$this->M_user->t_px();
		if(!isset($pa[0])){$pa[0]['total_pengeluaran_ang']=0;}
		if(!isset($px[0])){$px[0]['tot_pengeluaran_ext']=0;}
		$t=$pa[0]['total_pengeluaran_ang']+$px[0]['tot_pengeluaran_ext'];
		$total_pengeluaran = 'Rp. '.number_format($t ,0,',','.');

		$sisa='Rp. '.number_format(($total_pemasukan1-$t),0,',','.');
		$data=array('total_pemasukan'=>$total_pemasukan,'total_pengeluaran'=>$total_pengeluaran,'sisa'=>$sisa	);
		$data['in_belum_bayar']=$this->in_belum_bayar();
		$data['in_pembayaran_terahir']=$this->in_pembayaran_terahir();

		$this->load->view('user/index_konten/_in_dashboard',$data);
	}

	public function aturan(){
		$db=json_encode($this->M_user->sumbangan());
		$data=array('sumbangan'=>$db);
		$this->load->view('user/index_konten/aturan/aturan',$data);
	}
	public function pemasukan(){
		$db=json_encode($this->M_user->pemasukan_anggota_bulan($this->tahun_sekarang));
		$data=array('pem'=>$db);
		$data['donasi']=json_encode($this->M_user->donasi());
		$data['t_s']=$this->tahun_sekarang;
		$data['db_tahun']=json_encode($this->db_tahun);
		$this->load->view('user/index_konten/pemasukan/pemasukan',$data);
	}

	public function pemasukan_ang_update($thn){
		echo json_encode($this->M_user->pemasukan_anggota_bulan($thn));
	}

	public function pengeluaran(){
		$data=array();
		$data['db_pengeluaran_i']=json_encode($this->M_user->pengeluaran_int($this->tahun_sekarang));
		$data['db_pengeluaran_x']=json_encode($this->M_user->pengeluaran_ext($this->tahun_sekarang));
		$data['db_tahun']=json_encode($this->db_tahun);
		$data['t_s']=$this->tahun_sekarang;
		$data['b_s']=$this->bulan_sekarang;
		$this->load->view('user/index_konten/pengeluaran/pengeluaran',$data);
	}

	public function pengeluaran_update($tahun){
		echo json_encode($this->M_user->pengeluaran_int($tahun));
	}

	public function pengeluaran_update_x($tahun){
		echo json_encode($this->M_user->pengeluaran_ext($tahun));
	}

	//setting
	public function g_pass(){
	
		$this->load->view('user/index_konten/menu/g_pass');
	}

	public function profile(){
		$ak=$this->M_user->aktivasi($this->nik);
		$db=$this->M_user->anggota($this->nik);
		$ttl=explode('-', $db[0]['tgl_lahir']);
		$db['ttl']=$ttl;
		$db['ak']=$ak;
		$db=json_encode($db);
		$data=array('d'=>$db);
		$this->load->view('user/index_konten/menu/profile',$data);
	}

	public function gp(){//ganti passowrd
		$data=$this->M_user->am_password($this->nik);
		$p=$data[0]['password'];
		$data=$_POST;
		$data['nik']=$this->nik;
		if ($p==md5($data['pl'])){
			$this->M_user->up_password($data);
			echo '1';
		}else{echo '0';}
		
	}

	public function pesan_detail(){
		$db=$this->M_user->detail_pesan_t($this->nik);
		$this->M_user->update_pesan($this->nik);
		$data=array('dt'=>json_encode($db));
		$this->load->view('user/index_konten/menu/messege',$data);
	}

	public function pesan_arsip(){
		$db=$this->M_user->pesan_arsip($this->tahun_sekarang,$this->nik);
		$thn=$this->M_user->pesan_arsip_tahun($this->nik);
		$data=array('arsip'=>json_encode($db),'thn'=>json_encode($thn));
		$this->load->view('user/index_konten/menu/arsip_pesan',$data);	
	}

	public function pesan_arsip_up($thn){
		$db=$this->M_user->pesan_arsip($thn,$this->nik);
		echo json_encode($db);
	}
}	
?>