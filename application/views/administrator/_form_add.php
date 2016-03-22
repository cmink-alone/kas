			<div class="well grs-hijau ">
				<fieldset>
					<legend ><i class="fa fa-user"> </i> Tambah Anggota Baru </legend>
					<form class="form-horizontal text-left" method="post" action='#' id="myForm"  enctype="multipart/form-data" onsubmit="return viaAjax()">
						<div class="form-group text-left">
							<label class="control-label  col-sm-3">NIK</label>
							<div class="col-sm-9">
									<input name="nik" id="nik" placeholder="No Induk Pegawai"  type="text" class="form-control col-sm-6">
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-3  "  >Nama Anggota</label>
							<div class="col-sm-9">
									<input type="text" name="nama" placeholder="Nama Pegawai" id="nama" class="form-control">
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-3">Tempat, Tanggal lahir</label>
							<div class="col-sm-5">
									<input type="text" name="tempat" id="tempat" placeholder="Tempat Lahir" class="form-control">
							</div>
							<div class="col-sm-4">
									<input id="ttl" name="ttl" type="text" placeholder="Tanggal Lahir" class="form-control" readonly style="background-color:white">
							</div>
						</div>
							
						<div class="form-group">
							<label class="control-label col-sm-3"> Jeni Kelamin</label>
							<div class="col-sm-4" placeholder="Pilih jenis Kelamin">
								<select name="jk" id="jk" class="form-control">
									<option value="laki-laki">Laki-laki</option>
									<option value="perempua">Perempuan</option>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-3">Email</label>
							<div class="col-sm-9">
								<input type="email" name="email" placeholder="Masukan Email" id="email"  class="form-control">
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-3">Upload Foto</label>
							<div class="col-md-3">
								<input type="file" name="img_up"   id="f-file">
							</div>
							<div class="col-md-3 pull-right"></div>
						</div>
						
						
							<button  id="tambah" type="reset" class="form-control">Tambah Anggota</button>
							
					
						
								
					</form>
				</fieldset>
			</div>
			
			
			
  

<script type="text/javascript">
function viaAjax(){ 
	
}

$(document).ready(function(){
	$(document).ready(function(){
			$('#loading').fadeOut("fast");
		});
	
});    

$('#tambah').click(function viaAjax(){ 
		var formdata = new FormData();      
		var file = $('#f-file')[0].files[0];
		var foto 	=$('#f-file').val();
		var nik 	= $("#nik").val();
		var nama 	=$("#nama").val().toUpperCase();
		var tempat	=$("#tempat").val();
		var ttl 	= $("#ttl").val();
		var jk		=$("#jk").val();
		var email	=$("#email").val();
		if(nik =="" || nama=="" || tempat=="" || ttl=="" || jk=="" || email=="" || foto=="" ){
			alert("tidak boleh ada yang kosong.");
			
		}else{
			
				
				formdata.append('f-file', file);
				$.each($('#myForm').serializeArray(), function(a, b){
					formdata.append(b.name, b.value);
				});
				$.ajax({
					url: base_url+'administrator/tambah_anggota',
					data: formdata,
					processData: false,
					contentType: false,
					type: 'POST',
					beforeSend: function(){
					// add event or loading animation
					},
					success: function(ret) {
						if (ret==1){
							$('#notif').css('opacity','0.70');
							$('#nik').css('border-color','red');
							$('#notif').fadeIn(10);
							$('#notif').fadeOut(4000);
							$('#notif_judul_isi').html('<i class="fa fa-check  fa-lg"></i> Tersimpan.');
							$('#notif_isi').html('<p>Data anggota baru telah tersimpan.</p>');
															
							$('#f-file').val('');
							$("#nik").val('');
							$("#nama").val('');
							$("#tempat").val('');
							$("#ttl").val('');
							$("#email").val('');
							document.getElementById('nik').onfocus;
							$('#nik').css('border-color','');
						} //terinput
		
		}
				});
			}
		
		return false;
	});
	
$('#nik').keyup(function(){
	var nik=$("#nik").val();
	var cek_angka=/^\d*[0-9](|.\d*[0-9]|,\d*[0-9])?$/;	
	var nik_num = cek_angka.test($('#nik').val());
	if(!nik_num){
		$('#notif').css('opacity','0.70');
		$('#tambah').prop('disabled',true);
		$('#nik').css('border-color','red');
		$('#notif').fadeIn(500);
		$('#notif_judul_isi').html('<i class="fa fa-exclamation-triangle fa-lg"></i> Perhatian.');
		$('#notif_isi').html('<p>Yang diinputkan harus berformat Angka.</p>');
		document.getElementById('nik').onfocus;
	}else{
		$('#tambah').prop('disabled',false);
		$('#nik').css('border-color','');
		$('#notif').fadeOut(500);
		$('#notif').css('opacity','0.70');
		
	}
	$.ajax({
		url		: base_url+'administrator/cek/'+nik,
		success:function(msg){
			if(nik_num){
				if(msg==1){
					$('#notif').css('opacity','0.70');
					$('#tambah').prop('disabled',true);
					$('#nik').css('border-color','red');
					$('#notif').fadeIn(500);
					$('#notif_judul_isi').html('<i class="fa fa-exclamation-triangle fa-lg"></i> Perhatian.');
					$('#notif_isi').html('<p>NIK yang dimasukan sudah terpakai.</p>');
					}
				else{
					$('#tambah').prop('disabled',false);
					$('#nik').css('border-color','');
					$('#notif').fadeOut(500);
					$('#notif').css('opacity','0.70');
				}
			}
		}
	})
})


$('#email').focusout(function(){
	var cek_email=/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	var email_true=cek_email.test($('#email').val());
	if(!email_true){
		$('#notif').css('opacity','0.70');
		$('#tambah').prop('disabled',true);
		$('#email').css('border-color','red');
		$('#notif').fadeIn(500);
		$('#notif_judul_isi').html('<i class="fa fa-exclamation-triangle fa-lg"></i> Perhatian.');
		$('#notif_isi').html('<p>Masukan Email dengan benar.</p>');
		
	}else{
		$('#tambah').prop('disabled',false);
		$('#email').css('border-color','');
		$('#notif').fadeOut(500);
		$('#notif').css('opacity','0.70');
		
	}
})

$('#f-file').change(function(){
	var imgRe = /^.+\.(jpg|jpeg|gif|png|bmp)$/i;
	var gambar_true = imgRe.test($('#f-file').val());
	var file = this.files[0];
	var reader = new FileReader();

	if(!gambar_true){
		$('#notif').css('opacity','0.70');
		$('#tambah').prop('disabled',true);
		$('#f-file').addClass('text-danger');
		$('#notif').fadeIn(500);
		$('#notif_judul').html('<i class="fa fa-exclamation-triangle fa-lg"></i> Perhatian.');
		$('#notif_isi').html('<p>Foto yang boleh diupload hanya berextensi : jpg, jpeg, gif, png dan bmp.</p>');
		$('#previewing').attr('src',base_url+'asset/foto/default.jpg');
	}else{
		  
          reader.onload = imageIsLoaded;
          reader.readAsDataURL(this.files[0]);
		$('#tambah').prop('disabled',false);
		$('#f-file').removeClass('text-danger');
		$('#notif').fadeIn(500);
		$('#notif_judul').html('<i class="fa fa-user fa-lg"></i> Foto.');
		$('#notif_isi').html("<img src='"+base_url+"asset/foto/default.jpg'  class='form-control img-ukuran' id='previewing' >");
		$('#notif').css('opacity','0.70');
	}
})	
    function imageIsLoaded(e) {
				$('#previewing').attr('src', e.target.result);
	}
</script>
<script type="text/javascript">


				$("#ttl").datepicker({
					'dateFormat':'dd-mm-yy',
					changeMonth:true,
					changeYear:true,
					showButtonPanel:true,
				});
</script>