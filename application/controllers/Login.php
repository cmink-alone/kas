<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller{
	public function __construct(){
		parent:: __construct();
		
	}
	public function index(){

		////////// cek Login ///
		$session = $this->session->userdata();
		if(isset($session['login'])){
		if($session['login']=="ya"){
			if($session['type_login']=="admin"){
				redirect(base_url().'administrator');
			}else if($session['type_login']=='user'){
				redirect(base_url().'user');
			}
		}}
		/////////////////////////////////////////
		$data=array(
					"title"	=>"Login",
					"body"	=>$this->login_body(),
					"css" 	=>$this->login_css(),
					"js"	=>$this->login_js(),
					);
		$this->load->view("login_",$data);
	}

	private function login_body(){
		return $this->load->view("login/_login_body",array(),true);
	}

	private function login_css(){
	return	$this->load->view("login/_login_css.css",array(),true);
	}

	private function login_js(){
		return $this->load->view("login/_login_js.js",array(),true);
	}

	public function admin(){ 
		if(!isset($_POST['data'])){
			redirect(base_url());
		}else{
			$db=$this->M_login->admin($_POST);
			if(isset($db[0]['password']) and isset($db[0]['user'])){ 
				$tok='';
				if(md5($_POST['data'][1])==$db[0]['password']){ 
					for ($i=1;$i<5;$i++){
						$tok=$tok.rand(0,9); 
					} 
				echo $tok;
				} 
			}
		}
	}	

	public function v_token(){
		if(!isset($_POST['tk'])){
			redirect(base_url());
		}else{
			$sama=$_POST['tk'];
			$v=($sama*$sama)+(($sama*3)+($sama*4));
			for($i=0;$i<6;$i++){
				$tkn[$i]=substr($v, $i,1);
			}
			$ver='';
			for($i=0;$i<6;$i++){
				$ver.=$tkn[$i];
				
			}
			
			if($ver==$_POST['ver']){
				$data_session=array('login'=>'ya','type_login'=>'admin',"idx"=>'-1');
				$this->session->set_userdata($data_session);
				echo "1";
			}else{
				echo "0";
			}
		}
	}

	public function user(){
		$db=$this->M_login->user($_POST);
		if($db[0]['id_anggota']!=''){
			$session['login']='ya';
			$session['type_login']='user';
			$session['idx']=$db[0]['user'];
		$this->session->set_userdata($session);
		echo '1';
		}else{echo '0';}
	}
	public function logout(){
		$session=array('login','type_login','idx');
		$this->session->unset_userdata($session);
		redirect(base_url());
	}

}//end class
?>