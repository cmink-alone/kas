<div class="mgt ci">
	<div class="well">	
	<br>
		<div class="row">
			<div class="col-sm-12 text-center"><legend>Ganti Password</legend></div>
		</div>
		<form>
			<div class="row">
				
				<div class="col-sm-4"><label>Password Lama</label></div>
				<div class="col-sm-7"><input class="form-control pl" type='password'></input></div>
			</div>
			<div class="row mgt">
			
				<div class="col-sm-4"><label>Password Baru</label></div>
				<div class="col-sm-7"><input class="form-control pn" type='password'></input></div>
			</div>
			<div class="row mgt">
				
				<div class="col-sm-4"><label>Verifikasi Passowrd</label></div>
				<div class="col-sm-7"><input class="form-control pv" type='password'></input></div>
			</div>
			<div class="row">
				<div class="col-sm-12 mgt text-center"><hr><button type="button" class="btn btn-lg btn-primary">Simpan</button></div>
			</div>
		</form>
	</div>
</div>
<script type="text/javascript">

	$('.btn_sm').click(function(){
		
		var pass= Array();
		if($('.pl').val()=='' || $('.pn').val()=='' || $('.pv').val()==''){
			alert('Tidak Boleh kosong');
		}else if($('.pn').val()!= $('.pv').val()){
			alert('Password tidak sama');
		}else{
			$.ajax({
				url		: base_url + 'user/gp',
				data	: {pl:$('.pl').val(),pn:$('.pn').val()},
				type 	: "POST",
				success : function(msg){
					if (msg==0){alert('Password Salah');}else{
						alert('Sukses diperbarui');
					}
					$('.pl').val('');
					$('.pn').val('');
					$('.pv').val('');
				}
			});
		}
	});
</script>