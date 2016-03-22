<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrator extends CI_Controller {
	
	public function __construct(){
    parent::__construct();
	    $this->load->helper(array('html','url')); 
		$session=$this->session->userdata();
		if($session['login']=='ya' and $session['type_login']=='user'){
			redirect(base_url().'user');
		}else if($session['type_login']=='admin'){
		}else{redirect(base_url());}

	}

	
	public function index()
	{
		
		$tanggal=date('D, d M Y');
		$data=array("head" => $this->load->view("administrator/p_index/_head",$data=array(),true),'tanggal'=>$tanggal,);
		$this->load->view('administrator/index',$data);
	}

	///////////////////////////////////////////////// menu index
	private function tahun_sekarang($thn=''){
		if(isset($thn['tahun'])){
			$tahun= $thn['tahun'];
		}else{
			$tahun= date('Y');
		}
		return $tahun;
	}
	
	public function menu_setting(){
		$waktu=getdate();
		$i=0;
		$tahun1=$waktu['year'];
		$cek = $this->Model_administrator->group_tahun();
		$cek =$cek->result_array();
		$tahun1=$cek[0]['tahun'];
		foreach($cek as $t){
			if($waktu['year'] == $t['tahun']){
				$tahun1=$waktu["year"];
			}
		}


		$db = $this->Model_administrator->group_tahun();
		$tahun = $db->result_array();
		$db =$this->Model_administrator->ambil_data_kas($tahun1);
		$db_bulanan= $db->result_array();
		$where = " ORDER BY tahun ASC";
		$tbl=" set_bulanan_kas ";
		$fild=" max(tahun) as max";
		$max = $this->Model_administrator->select_fild($fild, $tbl,$where);
		$max = $max->result_array();
		$max= $max[0]['max']+1;
		$data=array('now'=>$db,"tahun"=> $tahun, "aktif"=>$tahun1,"db_bulan"=>$db_bulanan,"max"=>$max);
		 $this->load->view("administrator/m_setting/iuran_bulanan",$data);
	}

	public function password(){
		$this->load->view('administrator/m_setting/password');
	}

	public function ganti_password(){
		$pass=$this->Model_administrator->password();
		$pass=$pass[0]['password'];
		if($pass==md5($_POST['plama'])){
			$this->Model_administrator->password_update($_POST['pb']);
			echo "sukses";
		}else{
			echo "gagal";
		}
	}

	public function update_kas_anggota(){
		//print_r($_POST);
		$db=$this->Model_administrator->update_besaran_kas($_POST);
		print_r($db);	
	}

	public function add_tahun(){
		$tahun=$_POST['tahun'];
		$db = $this->Model_administrator->add_tahun($tahun);
		print_r($db);
	}

	public function ambil_bulanan(){
		$tahun =$_POST['tahun'];
		$db=$this->Model_administrator->select_bulanan_kas($tahun);
		$js=$db->result();
		$db =json_encode($js);
		echo $db;
	}
	//donasi//
	public function add_donasi(){
		$db =$this->Model_administrator->add_donasi($_POST);
		print_r($db);
	}
	// Pembayaran//

	public function bayar($xdt){
		if($xdt!=3){
			echo "<h1 clss='text-danger'>UPS SORY... AKSES DITOLAK</h1>";
		}else{
			$nik=$_POST['nik_ang'];
			$bayar=$_POST['byk_bayar'];
			$arr_ket=$_POST['ket_byaran'];
			$dana=$_POST['nominal'];
			$terahir=$this->Model_administrator->terahir_bayar($nik);
			$terahir=$terahir->result_array();
			$terahir=$terahir[0] ['id_bayar'];
			if($terahir!=""){
				$db=$this->Model_administrator->pembayaran_terahir($terahir);
				$db = $db->result_array();
				$b_tahun=$db[0]['tahun'];
				$b_bulan=$db[0]['bayar_bulan']+1;				
				}else{
				$db=$this->Model_administrator->baru($nik);
				$db = $db->result_array();
				$b_tahun=$db[0]['ef_tahun'];
				$b_bulan=$db[0]['ef_bulan'];
			
				}

				for($i=0;$i<$bayar;$i++){
					if($b_bulan==13){
						$b_bulan=1;
						$b_tahun++;

						}
					$db=$this->Model_administrator->bayar_bulanan($nik,$b_tahun,$b_bulan,$arr_ket[$i],$dana[$i]);
					$b_bulan++;	
				}//for

			}//if_else
				
			echo $db;

	}

	public function donasi(){
		$data=array();
		$this->load->view("administrator/pembayaran/donasi",$data);
	}

	public function pembayaran_anggota(){
		$data=array(//'tab_data_pembayaran'=>$this->tab_data_pembayaran();
			);
		$this->load->view("administrator/pembayaran/pembayaran_anggota",$data);
	}
	public function show_pembayaran(){
		
		$terahir=$this->Model_administrator->terahir_bayar($_POST['nik']);
		$terahir=$terahir->result_array();
		$terahir=$terahir[0] ['id_bayar'];
		if($terahir!=""){
			$db=$this->Model_administrator->pembayaran_terahir($terahir);
			$db = $db->result_array();
			$b_tahun=$db[0]['tahun'];
			$b_bulan=$db[0]['bayar_bulan'];
			$b_tahun2=$b_tahun+2;
			
		}else{
			//belum bayar sama sekali akan di ambil dari aktifasinya
			$db=$this->Model_administrator->baru($_POST['nik']);
			$db = $db->result_array();
			$db['t']=1;
			$b_tahun=$db[0]['ef_tahun'];
			$b_tahun2=$b_tahun+2;
		}
		$max_tahun=$this->Model_administrator->max_tahun();
		$hrs=$this->Model_administrator->harus_bayar($b_tahun, $b_tahun2);
		$hrs=$hrs->result_array();
		$db['x']=$hrs;
		$db['max_th']=$max_tahun[0]['max_th'];
		echo json_encode($db);
	}
	public function tab_pembayaran(){ 
		$data=array();
		$this->load->view('administrator/pembayaran/tab_pembayaran',$data);
	}

	public function tab_data_pembayaran($id){
		$waktu=getdate();
		$i=0;
		$tahun=$waktu['year'];
		
		/////////// ambil anggota aktivasi
			$db=$this->Model_administrator->baru($id);
			$akt = $db->result_array();
			$akt['sk_bulan']=(int)date("m");
			$akt['sk_tahun']=date("Y");
		///////////
			$telat=$this->Model_administrator->show_telat($id);
			$telat=json_encode($telat);
		/////
		$cek = $this->Model_administrator->group_tahun();
		$cek =$cek->result_array();
		$tahun=$cek[0]['tahun'];
		foreach($cek as $t){
			if($waktu['year'] == $t['tahun']){
				$tahun=$waktu["year"];
			}
		}
		
		$db = $this->Model_administrator->group_tahun();
		$db= $db->result_array();
		$thn= json_encode($db);
		$db=$this->Model_administrator->set_bulanan($tahun);
		$tdb=$this->Model_administrator->telah_bayar($id,$tahun);
		$bayar=$tdb->result_array();
		$db=$db->result_array();
		$akt=json_encode($akt);
		$jsq=json_encode($db);
		$js2=json_encode($bayar);
		$data=array("bulanan"=>$jsq,"bayar"=>$js2,'tahun'=>$thn,'set_tahun'=>$tahun,"akt"=>$akt,"telat"=>$telat);
		$this->load->view('administrator/pembayaran/tab_data_pembayaran',$data);
	}

	public function tab_data_update(){
		$tdb=$this->Model_administrator->telah_bayar($_POST['nik_anggota'],$_POST['tahun']);
		$db=$tdb->result_array();
		echo json_encode($db);
	}

	public function tab_data_set_update(){
		$db=$this->Model_administrator->set_bulanan($_POST['tahun']);
		$db=$db->result_array();
		echo json_encode($db);
	}

	public function pembayaran_laporan(){
		$thn_pilih=$this->tahun_sekarang($_POST);
		$db= $this->Model_administrator->group_tahun();
		$tahun = $db->result_array();
		$js_tahun=json_encode($tahun);
		$data=array('m_menu'=>$js_tahun,'now_tahun'=>$thn_pilih);
		$this->load->view('administrator/pembayaran/laporan',$data);
	}

	public function lap_anggota($t,$dari=0){
		$tahun=$t;
		$typ=0;
		if(isset($_POST['typ'])){
			$typ=1;
		}
		$perp=15;
		$limit =$dari * $perp;
		$i=0;
		$db= $this->Model_administrator->lap_anggota_group($tahun,$limit,$perp);
		$n_row=$this->Model_administrator->lap_anggota_group_n($tahun);
		$page=(int)$n_row/$perp;
		$page=explode(".", $page);
		$ttl=$page[0];
		if(isset($page[1])){
			$ttl +=1;
		}
		$pages=array();
		$pages['total']=$ttl;
		$pages['limit']=$dari +1;

		foreach($db as $d){
			$isi[$i]= $this->Model_administrator->lap_anggota_isi($d['nik_anggota'],$tahun);
			$telat[$i]= $this->Model_administrator->lap_anggota_telat($d['nik_anggota'],$tahun);
			$i++;
		}
		
		if(isset($isi)){
			$js_pg=json_encode($pages);
			$jisi=json_encode($isi);
			$db=json_encode($db);
			$jtelat=json_encode($telat);
			$data=array('db'	=>$db,'isi'=>$jisi,'telat'=>$jtelat,'js_pg'=>$js_pg);
			$this->load->view('administrator/pembayaran/lap_anggota',$data);
		}else{
			ECHO "<H1 class='alert alert-info text-center'>BELUM ADA PEMBAYARAN</H1>";
		}

	
	}
	public function lap_bulanan($t){
		$tahun=$t;
		$total=0;
		for($i=1;$i<=12;$i++){
			$bulanan[$i]=$this->Model_administrator->lap_bulanan($i,$tahun);
			if($bulanan[$i]==''){
				$bulanan[$i]=0;
			}
			$total += $bulanan[$i];
		}
		$js_bulanan=json_encode($bulanan);
		$data=array('tahun'=>$tahun,'bulanan'=>$js_bulanan,'total'=>$total);
		$this->load->view('administrator/pembayaran/lap_bulanan',$data);
	}

	public function lap_donasi($a){
		if(!isset($a)){
			$a=date("Y");
			echo $a;
		}
		$db=$this->Model_administrator->lap_donasi($a);
		$db=json_encode($db);
		$data=array('donasi'=>$db);
		$this->load->view('administrator/pembayaran/lap_donasi',$data);
	}
	/////////////////////////////////////////////////////////////
	public function form_add_anggota(){
		$this->load->view('administrator/_form_add');
	}
	
	public function dashboard(){
		$db =$this->M_administrasi->total_kas();
		$db=json_encode($db);
		$data=array('data_kas'=>$db);
		$this->load->view('administrator/_dashboard',$data);
	}

	public function cari_nama_anggota(){
		$nama= $_POST['nama'];
		$db= $this->Model_administrator->cari_anggota($nama);
		$db=$db->result_array();
		$data=array('db'	=> $db,);
		$this->load->view('administrator/_reload_tabel',$data);
	}
	
	public function aktivasi(){
		$limit=10;
		$total=$this->Model_administrator->jumlah_anggota();
		$total=$total->num_rows();			
		$db= $this->Model_administrator->m_verifikasi($rec=0,$limit,$fild='nama',$urut='ASC');
		$db = $db->result_array();
		$pg=$total/ $limit;
		$pg2=0;
		$pg=explode(".",$pg);
		if(!isset($pg[1])){$pg[1]=0;}
		if ($pg[1]>0){$pg2=1;}
		$pg=$pg[0] + $pg2;
		$data=array(	'db'		=> $db,
						'inc_modal'		=> $this->aktivasi_modal(),
						'total_rec'	=>	$total,
						'total_pg'	=>	$pg,);
		$this->load->view('administrator/_aktivasi',$data);
	}
	
	public function reload_tabel(){
		$fild='nama';$urut='ASC';
		$rec=$_POST['record']*10;
		$limit=10;
		$total=$this->Model_administrator->jumlah_anggota();
		$total=$total->num_rows();			
		$db= $this->Model_administrator->m_verifikasi($rec,$limit,$fild,$urut);
		$db = $db->result_array();
		$pg=$total/ $limit;
		$pg2=0;
		$pg=explode(".",$pg);
		if(!isset($pg[1])){$pg[1]=0;}
		if ($pg[1]>0){$pg2=1;}
		$pg=$pg[0] + $pg2;
		$data=array(	'db'		=> $db,
						'total_rec'	=>	$total,
						'total_pg'	=>	$pg,);
		$this->load->view('administrator/_reload_tabel',$data);
		
	}
///////////////////////////////////////////////////////////////////////////////////////////////////////
	public function kategori_pengeluaran(){
		$data = array(	
					 	'input_kat_pengeluran'	=> $this->inc_kp_kat_pengeluran(),
					 	'tabel'					=> $this->inc_kp_tabel(),
					 	'modal'					=> $this->inc_kp_kat_modal(),
					 	'js'					=> $this->inc_kp_js(),
					 );
		return $this->load->view('administrator/_kategori_pengeluaran',$data);
	}

	public function inc_kp_kat_pengeluran(){
		$data=array();
	return 	$this->load->view('administrator/pengeluaran/_kat_pengeluaran',$data,true);
	}
	public function inc_kp_kat_modal(){
	$data=array();
	return 	$this->load->view('administrator/pengeluaran/_kategori_add_modal',$data,true);	
	}
	public function inc_kp_tabel($where=''){
	$data=array('isi'=> $this->isi_kategori_pengeluaran($where),);
	return 	$this->load->view('administrator/pengeluaran/_tabel_add_kategori',$data,true);	
	}
	public function inc_kp_js(){
	$data=array();
	return 	$this->load->view('administrator/pengeluaran/_kategori_pengeluaran.js',$data,true);	
	}

	public function delete_kategori(){
		$tbl ="kategori_pengeluaran";$fild="id_kat_pengeluaran";$key=$_POST['id'];
		$db= $this->Model_administrator->delete($tbl,$fild,$key);
		echo $db;
	}
////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function isi_kategori_pengeluaran($where=''){
		$tbl="kategori_pengeluaran";
		$db = $this->Model_administrator->select_semua($tbl,$where);
		$db =$db->result_array();
		return $db;

	}
	

	
	public function pengeluaran_ext(){
		$this->load->view('administrator/_pengeluaran_external');
	}

	public function laporan_pengeluaran(){
		$int=$this->Model_administrator->lap_pengeluaran_ang();
		$ext=$this->Model_administrator->lap_pengeluaran_ext();
		$in_t = json_encode($int);
		$ext = json_encode($ext);
	
		$data= array(	'int'=>$in_t,
						'ext'=>$ext
				);
		$this->load->view('administrator/pengeluaran/lap_pengeluaran',$data);
	}

	
	public function tambah_anggota(){
		
		//$this->load->view('administrator/_upload');
		$anggota_nik	= $_POST['nik'];
		$anggota_nama	= $_POST['nama'];
		$anggota_nama    =strtoupper($anggota_nama);
		$anggota_tempat= strtoupper($_POST['tempat']);
		$anggota_jk	= $_POST['jk'];
		$anggota_ttl	= $_POST['ttl'];
		$anggota_email	= $_POST['email'];
		$nama_f	= $_FILES['f-file']['name'];
		$type_f	= $_FILES['f-file']['type'];
		$error_f	= $_FILES['f-file']['error'];
		$size_f	= $_FILES['f-file']['size'];
		$file_max=1024*1024*5;
		$file_ext=explode('.',$nama_f);
		$file_ext=end($file_ext);
		$data=array(	'nik'	=>  $anggota_nik,
						'nama'	=>	$anggota_nama,
						'email'	=>  $anggota_email,
						'tempat'=>  $anggota_tempat,
						'tgl'	=>	$anggota_ttl,
						'jk'	=>	$anggota_jk,
						'foto'	=>	$anggota_nik.'.'.$file_ext,
					);	
		if($file_max>=$size_f){
				move_uploaded_file($_FILES['f-file']['tmp_name'],'asset/foto/'.$anggota_nik.'.'.$file_ext);
				$db = $this->Model_administrator->m_tambah_anggota($data);
				echo $db;
		}}
	
	public function cek($nik){
		$db=$this->Model_administrator->ambil($nik);
		$cek=$db->num_rows();
		if ($cek==1){echo "1";}
	}
	
	public function aktivasi_modal(){
		$data=array();
		return $this->load->view('administrator/_aktivasi_modal',$data,true);
	}

	public function efektif_keanggotaan(){
		if(!isset($_POST['typ'])){
		$now_tahun=date("Y");
		$now_bulan=(int)date("m");
		$ak_tahun=$_POST['thn'];
		$ak_bulan=$_POST['bln'];

		$telat= (($now_tahun-$ak_tahun)*12)+($now_bulan-$ak_bulan);
		if($telat>0){
			for($i=0;$i<$telat;$i++){
				if($ak_bulan==13){
					$ak_bulan=1;
					$ak_tahun++;
				} 	
				$db=$this->Model_administrator->telat_bayar($_POST['id'],$ak_tahun,$ak_bulan);
				$ak_bulan++;
			}
		}}
		$this->Model_administrator->update_efektif($_POST,$_POST['Keanggotaan']);
		$db=$this->Model_administrator->select_one('keanggotaan','nik_anggota',$_POST['id']);
		$db =$db->result_array();
		if($db[0]['keanggotaan']==2){
			$this->Model_administrator->hapus_telat($_POST['id']);
		}
		$js=json_encode($db[0]);
		print $js;
	}
	//////////////
	// PAGE  PENGELUARAN ///

	public function add_kategori(){
		$data		= $_POST;
		$nt 		= $data['nama'];
		$Ket 		= $data['keterangan'];
		$pengeluaran= $data['pengeluaran'];
		$db         = $this->Model_administrator->add_kategori($nt,$pengeluaran,$Ket);
		$tbl='kategori_pengeluaran '; $where=' where id_kat_pengeluaran IN (select max(id_kat_pengeluaran) from '.$tbl.')';
		$dbnew		= $this->Model_administrator->select_semua($tbl,$where);
		$dbnew=$dbnew->result_array();
		$js=json_encode($dbnew[0]);
		print_r($js);
		
	}

	public function edit_kategori(){
		$tbl="kategori_pengeluaran";
		$values="nama_kategori='".$_POST['e_kategori']."',pengeluaran='".$_POST['e_dana']."',keterangan='".$_POST['e_ket']."' ";
		$where=" id_kat_pengeluaran='".$_POST['e_id']."'";
		$db=$this->Model_administrator->update_where($tbl,$values,$where);
		$fild=" id_kat_pengeluaran";
		$key=$_POST['e_id'];
		$db=$this->Model_administrator->select_one($tbl,$fild,$key);
		$db=$db->result_array();
		echo  json_encode($db[0]);	 

	}

	public function cari_kategori($cd='1'){
		$cari= $_POST['cari'];
		$tbl='kategori_pengeluaran';
		if($cd='1'){
			$where=" where nama_kategori LIKE '%".$cari."%'";
		}else{
			$where="";
		}
		$db=$this->Model_administrator->select_semua($tbl,$where);
		$db=$db->result_array();
		$js=json_encode($db);
		print_r($js);
	}
	///////////////////////////////////////////////pengeluran anggota
	public function pengeluaran(){
		$data = array(
						'form'				=> $this->form_pengeluaran_anggota(),
						'pilih_pengeluaran'	=> $this->pilih_pengeluaran_anggota()
					);
		return $this->load->view('administrator/_pengeluaran',$data);
	}

	public function pengeluaran_anggota(){
		$db = $this->Model_administrator->add_pengeluaran_dana($_POST);
		echo $db;
	}

	public function pengeluaran_ext_simpan(){
		$db=$this->Model_administrator->add_pengeluaran_dana($_POST,$_POST['ext']);
		echo $db;
	}


	public function form_pengeluaran_anggota(){
		$fild="nama_kategori,pengeluaran "; $tbl=" kategori_pengeluaran ";$where ="";
		$db = $this->Model_administrator->select_fild($fild, $tbl,$where);
		$db = $db->result_array();
		$data=array("kategori"	=> json_encode($db));
		return $this->load->view('administrator/p_anggota/form',$data,true);
	}

	public function pilih_pengeluaran_anggota(){
		$data=array();
		return $this->load->view('administrator/p_anggota/pilih_pengeluaran',$data,true);
	}

	public function pilih_anggota(){
		$fild='*';
		$tbl='keanggotaan_aktif';
		$where=" where nik_anggota  LIKE '%".$_POST['key']."%'";
		$db=$this->Model_administrator->select_fild($fild,$tbl,$where);
		$db=$db->result_array();
		$js=json_encode($db);
		print_r ($js);
	}
	////////////////////////////////////////////////////////////////////

	public function update_data(){
			$tahun_sekarang=date("Y");
			$bulanan_sekarang= (int)date("m");
			//ambil nik
			$nik_anggota=$this->Model_administrator->ambil_nik_aktif();
			$n_array=count($nik_anggota);//banyak anggota
			
			$aktivasi=array();
			$bayar_terahir=array();
			$telat_terahir=array();
			$bayar_terahir=array();
			$mulai = array();
			for($i=0;$i<$n_array;$i++){	
				$mulai['bulan']=0;
				$mulai['tahun']=0;
				$m=1;
				//ambil_bayar terahir
				$id=$nik_anggota[$i]['nik_anggota'];
				$bayar_terahir=$this->Model_administrator->bayra_terahir($id);
				
				if(!isset($bayar_terahir[0])){
					$bayar_terahir[0]['tahun']=0;
					$bayar_terahir[0]['bulan']=0;
				}else{
					$bayar_terahir[0]['tahun']=$bayar_terahir[0]['tahun'];
					$bayar_terahir[0]['bulan']=$bayar_terahir[0]['bayar_bulan']+1;
					
					if( $bayar_terahir[0]['bulan']==13){
						$bayar_terahir[0]['tahun']++;
						$bayar_terahir[0]['bulan']=1;
					}
				}
				// telat terahir
				$telat_terahir=$this->Model_administrator->telat_terhir($id);
				if(!isset($telat_terahir[0])){
					$telat_terahir[0]['tahun']=0;
					$telat_terahir[0]['bulan']=0; 
				}
				
				//ambil aktivasi
			
				$db=$this->Model_administrator->baru($nik_anggota[$i]['nik_anggota']);
				$db=$db->result_array();
				

				if(!isset($db[0])){
					$aktivasi[0]['bulan']=0;
					$aktivasi[0]['tahun']=0;
				}else{
					$aktivasi[0]['bulan']=$db[0]['ef_bulan'];
					$aktivasi[0]['tahun']=$db[0]["ef_tahun"];
				}
				
		//MENENTUKAN PALING TERBARU
				if($aktivasi[0]['tahun']>$telat_terahir[0]['tahun']){
					$mulai['bulan']=$aktivasi[0]['bulan'];
					$mulai['tahun']=$aktivasi[0]['tahun'];
				}else if($aktivasi[0]['tahun']==$telat_terahir[0]['tahun'] and $aktivasi[0]['bulan']>$telat_terahir[0]['bulan']){
					$mulai['bulan']=$aktivasi[0]['bulan'];
					$mulai['tahun']=$aktivasi[0]['tahun'];
				}else{
					$mulai['bulan']=$telat_terahir[0]['bulan']+1;
					$mulai['tahun']=$telat_terahir[0]['tahun'];
				}

				if($mulai['tahun']<$bayar_terahir[0]['tahun']){
					$mulai['tahun']=$bayar_terahir[0]['tahun'];
					$mulai['bulan']=$bayar_terahir[0]['bulan'];
				}else if($mulai['tahun']==$bayar_terahir[0]['tahun'] and $mulai['bulan']<$bayar_terahir[0]['bulan']){
					$mulai['tahun']=$bayar_terahir[0]['tahun'];
					$mulai['bulan']=$bayar_terahir[0]['bulan'];
				}
				// EKSEKUSI PRINTAH
				
				if($tahun_sekarang < $mulai['tahun']){
				}elseif($tahun_sekarang==$mulai['tahun'] and $bulanan_sekarang<$mulai['bulan']){
				}else{
					//CARI BANYAK PERULANGAN BULAN
					while ($m<3) {
						if($mulai['tahun']<$tahun_sekarang){
							$this->Model_administrator->telat_bayar($nik_anggota[$i]['nik_anggota'],$mulai['tahun'],$mulai['bulan']);
							$mulai['bulan']++;
							if($mulai['bulan']==12){
								$mulai['tahun']++;
							}
						}elseif($mulai['bulan']<=$bulanan_sekarang){
							
							$this->Model_administrator->telat_bayar($nik_anggota[$i]['nik_anggota'],$mulai['tahun'],$mulai['bulan']);
							$mulai['bulan']++;
							if($mulai['bulan']>$bulanan_sekarang){
								$m=4;
								
							}
						}else{
							
							$m=4;
						}
					}//end while
				}//end eksekusi
			}
	}
	
}//end class

