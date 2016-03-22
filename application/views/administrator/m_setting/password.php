<div class="well grs-hijau ">
	<div class="panel">
		<div class="panel-heading panel-default"><h3>Ganti Password</div>
		<div class="panel-body">
			<form id="tbl_1">
				<label class="control-label">Password Lama</label>
				<input name='plama' type="password" class="plama form-control margin-bottom">
				<label class="control-label">Password Baru</label>
				<input name='pb' type="password" class="pbaru form-control margin-bottom">
				<label class="control-label">Verifikasi Password</label>
				<input name='vp' type="password" class="verp form-control margin-bottom">
				<div class="text-center">
					<button type="button" return='false' class="btn simpan btn-primary">Simpan</button>
					<button type="reset" class="btn btn-warning">Reset</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">

$('.simpan').click(function(){

	if($('.plama').val()=='' || $('.pbaru').val()=='' || $('.verp').val()==''){
		alert('Data tidak boleh kosong');
	}else if($('.pbaru').val()!=$('.verp').val()){
		alert('Password tidak sama.');
	}else if($('.pbaru').val().length<6){
		alert('Password minimal 6 karakter.');
	}else{
		
		$.ajax({
			url 	: base_url +'administrator/ganti_password',
			type	: 'POST',
			cache	: 'false',
			data 	: $('#tbl_1').serialize(),
			success : function(msg){
				if(msg=='gagal'){
					alert('Password lama salah.');
					$('.pbaru').val('');$('.verp').val('');
				}else if(msg=='sukses'){
					alert('Password sukses diperbarui.');
					$('.plama').val('');$('.pbaru').val('');$('.verp').val('');
				}
			}

		});
	}
});
</script>