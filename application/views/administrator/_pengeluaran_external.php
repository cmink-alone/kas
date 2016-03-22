<div class='well grs-hijau'>
<legend>Pengeluaran External</legend>
	<form class='fo_ext form-horizontal'>
		<div class='form-group'>
			<label class='control-label col-sm-2'> Tanggal</label>
			<div class='col-sm-4'>
				<input name='tanggal' id='p_tgl' class='form-control'>
			</div>
		</div>
		<div class='form-group'>
			<label class='control-label col-sm-2'>Keperluan</label>
			<div class='col-sm-4'>
				<input name='kategori' class=' kep form-control'>
			</div>
		</div>
		
		<div class='form-group'>
			<label class='control-label col-sm-2'>Dana</label>
			<div class='col-sm-4'>
				<div class='input-group '>
					<span class='input-group-addon'>Rp.</span>
					<input name='pengeluaran' style="z-index:1" class='dana form-control'>
				</div>
			</div>
		</div>
		
		<div class='form-group'>
			<label class='control-label col-sm-2'>Keterangan</label>
			<div class='col-sm-4'>
				<textarea name='keterangan' class='form-control ket' rows='5' style="resize:none"></textarea>
			</div>
		</div>
		<button type='button' class='btn simpan btn-primary'>Simpan</button>
		
</div>

<script language='text/javascript'>
$('#p_tgl').datepicker({
	changeMonth:true,
	changeYear:true,
	dateFormat:'yy-mm-dd',
});

$('.dana').keyup(function(){
	var pola = /^[0-9]+$/;
	var isi = $('.dana').val();
	cek = pola.test(isi);
	if(cek){
			$('.simpan').prop('disabled',false);
			$('.dana').removeClass('btn-danger');
	}else{

		$('.simpan').prop('disabled',true);
		$('.dana').addClass('btn-danger');

	}
});

$(".simpan").click(function(){
	if($("#p_tgl").val()=='' || $('.dana').val()=='' || $('.ket').val()=='' || $('.kep').val()==''){
		alert('Tidak boleh kosong');
	}else{

		$.ajax({
			url : base_url + 'administrator/pengeluaran_ext_simpan',
			data : $('.fo_ext').serialize()+'&ext=0',
			type : 'post',
			typeData: 'json',
			cache : 'false',
			success:function(msg){
				if (msg==1){
					alert('Sukses');
					$("#p_tgl").val('');
					$('.dana').val('');
					$('.ket').val('');
					$('.kep').val('');
				}
			}

		});
	}


});
</script>
