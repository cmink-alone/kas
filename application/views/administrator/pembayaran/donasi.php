<div class='well grs-hijau'>
<legend>PEMASUKAN DONASI / SUMBANGAN</legend>
<div id="info" class="alert hidden alert-success">
<i class="fa fa-check fa-lg"></i> Data Berhasil ditambahkan.
</div>
	<form class='form-horizontal'>
		<div class='form-group'>
			<label class='control-label col-sm-2'> Tanggal</label>
			<div class='col-sm-4'>
				<input id='p_tgl' class='form-control'>
			</div>
		</div>
		<div class='form-group'>
			<label class='control-label col-sm-2'>Nama</label>
			<div class='col-sm-4'>
				<input id="p_nama" class='form-control'>
			</div>
		</div>
		<div class='form-group'>
			<label class='control-label col-sm-2'>Alamat</label>
			<div class='col-sm-4'>
				<textarea id="p_alamat" class='form-control' rows='5' style="resize:none"></textarea>
			</div>
		</div>
		<div class='form-group'>
			<label class='control-label col-sm-2'>Beasaran Donasi</label>
			<div class='col-sm-4'>
				<div class='input-group'>
					<span  class='input-group-addon'>Rp.</span>
					<input style="z-index:1"; id="dana" class='form-control'>
				</div>
			</div>
		</div>
		
		<div class='form-group'>
			<label class='control-label col-sm-2'>Keterangan</label>
			<div class='col-sm-4'>
				<textarea class='form-control' id="keterangan" rows='5' style="resize:none"></textarea>
			</div>
		</div>
		
		<button type='button' id="btn_simpan" class='btn btn-primary'>Simpan</button>
		
</div>

<script language='text/javascript'>
$('#p_tgl').datepicker({
	changeMonth:true,
	changeYear:true,
	dateFormat:"yy-mm-dd"
});

$("#dana").keyup(function(){
	var pola =/^[0-9]+$/;
	var dana = $("#dana").val();
	var cek = pola.test(dana);
	if(cek){
		$("#dana").removeClass("btn-danger");
		$("#btn_simpan").addClass("btn-primary");
		$("#btn_simpan").prop("disabled",false);
	}else{
		$("#btn_simpan").removeClass("btn-primary")
		 $("#dana").addClass("btn-danger");
		 $("#btn_simpan").prop("disabled",true);
	}
	
});

$("#btn_simpan").click(function(){
	var p_tgl 	=$("#p_tgl").val();
	var p_alamat=$("#p_alamat").val();
	var p_nama	=$("#p_nama").val();
	var dana 	=$("#dana").val();
	var ket 	=$("#keterangan").val();
	if(p_tgl=="" || p_alamat=="" || p_nama=="" || dana==""  || ket==''){
		alert("Data tidak boleh kosong");
	}else{
		$.ajax({
			url 	: base_url +"administrator/add_donasi",
			type	: "post",
			cache	: "false",
			data  	: {tgl:p_tgl,alamat:p_alamat,nama:p_nama,rp_dana:dana,keterangan:ket},
			beforeSend:function(){
					$('#notif_judul_isi').html('Prosessing...');
					$('#notif_isi').html('<div class="text-center"><i  class="fa fa-spinner fa-pulse"></i></div>');
					$('#notif').css('opacity','0.70');
					$('#notif').fadeIn(1000);

			},
			success:function(msg){
				$("#notif").fadeOut("fast");
				$("#info").removeClass("hidden");
				$("#info").fadeIn(3000).fadeOut(3000);
				$("#p_tgl").val('');
				$("#p_alamat").val('');
				$("#p_nama").val('');
				$("#dana").val('');
				$("#keterangan").val('');
				$("#p_tgl").focus();
			}
			
			
		});//ajax
		
	}
});
</script>