<?php
   print_r($_POST);
   print_r($_FILES);
   $anggota_nik	= $_POST['nik'];
   $anggota_nama	= $_POST['nama'];
   $anggota_tempat= $_POST['tempat'];
   $anggota_ttl	= $_POST['jk'];
   $anggota_email	= $_POST['email'];
	$nama_f	= $_FILES['f-file']['name'];
	$type_f	= $_FILES['f-file']['type'];
	$error_f	= $_FILES['f-file']['error'];
	$size_f	= $_FILES['f-file']['size'];
	
	$ext= array('jpg','jpeg','png','gif','png','bmp');
	$file_ext=explode('.',$nama_f);
	$file_ext=end($file_ext);
	$file_max=1024*1024*5;
	
	if (in_array($file_ext,$ext) && $file_max>=$size_f){
			move_uploaded_file($_FILES['f-file']['tmp_name'],'asset/foto/'.$anggota_nik.'.'.$file_ext);
			echo "file uploaded ";
	}else{
		
	}
	
?>