<div id="mdl_aktifkan" class="modal fade" relo='dialog'>
		<div class="modal-dialog">
			<div class='modal-content'>
				<div class='modal-header'>
					<button type='button' class='close' data-dismiss='modal'>&times;</button>
					<h4 class='modat-title'>Aktifkan Anggota</h4>
				</div>
		
			<div class='modal-body'>
				<p><span>Nama </span><span class='text-primary nama_anggota'>Nama Anggota</span> akan diaktfikan.</p>
				<span class='nik_anggota hide'></span> 
				<form class='form-horizontal'>
					<div class='form-group'>
						<label class='control-label col-sm-5'>Efektif pada bulan :</label> 
						<div class='col-sm-3'>
								<select id='efektif' class='form-control'>
									<option value='1'>Januari</option>
									<option value='2'>Februari</option>
									<option value='3'>Maret</option>
									<option value='4'>April</option>
									<option value='5'>Mei</option>
									<option value='6'>Juni</option>
									<option value='7'>Juli</option>
									<option value='8'>Agustus</option>
									<option value='9'>September</option>
									<option value='10'>Oktober</option>
									<option value='11'>November</option>
									<option value='12'>Desember</option>
								</select>
						</div>
						<div class='col-sm-3'>
							<input class='form-control' id='efektif_tahun' value='<?php echo date('Y');?>'>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-3">
						<button id='send_aktif' data-dismiss='modal' class="btn btn-primary">Aktifkan Keanggotaan</button>
						</div>
					</div>
				</form>
			</div>
		
			<div class='modal-footer'></div>


		</div>
	</div>
</div>


<div class="modal fade" id='mdl_nokaktif' rele="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4> Non Aktifkan Anggota </h4>
			</div>
			<div class="modal-body text-center">
				<p> Apakah Anda yakin untuk non aktifkan <span class='text-primary nama_anggota'>n</span> ?</p>
				<span class='nik_anggota hide'>0</span> 
				<button data-dismiss='modal' id='btn_non_aktif' class="btn btn-danger">Non Aktifkan</button>
			</div>
			<div class="modal-footer">
			</div>
		</div>
	</div>
</div>

<script language='javascript'>
$("#send_aktif").click(function(){
	$.ajax({
		url		: base_url+'administrator/efektif_keanggotaan',
		cache	: 'false',
		type	: "POST",
		typeData: "json",
		data 	:'Keanggotaan=1&id='+$(".nik_anggota").html()+'&bln='+$("#efektif").val()+"&thn="+$('#efektif_tahun').val(),
		success	: function(msg){
				data=JSON.parse(msg);
				$("#k"+data.nik_anggota).html("<span class='label label-success'>Aktif</span>");
				$("#t"+data.nik_anggota).html(data.tanggal);
				$("#e"+data.nik_anggota).html(data.ef_bulan+" - "+data.ef_tahun);
				nik=data.nik_anggota;
				nama=$("#n"+nik).html();
				nama=nama.replace(' ','_');	
				$("#b"+data.nik_anggota).html("<a data-toggle='modal' onclick=data_anggota("+nik+",'"+nama+"')  class='btn btn-danger btn-sm' data-target='#mdl_nokaktif'> <i class='fa fa-power-off'></i> Non Akftikan</a>");
				$('#notif').css('opacity','0.80');
				$('#notif').fadeIn(200);
				$('#notif_judul_isi').html('<i class="fa fa-check fa-lg"></i> Sukses.');
				$('#notif_isi').html('<p>Anggota berhasil diaktifasi.</p>');
				$('#notif').fadeOut(2000);
		} 
	})});

$("#btn_non_aktif").click(function(){$.ajax({
		url		: base_url+'administrator/efektif_keanggotaan',
		cache	: 'false',
		type	: "POST",
		typeData: "json",
		data 	:'id='+$(".nik_anggota").html()+'&bln=""&Keanggotaan=2&thn=""&typ=non',
		success	: function(msg){
				data=JSON.parse(msg);
				nik=data.nik_anggota;
				nama=$("#n"+nik).html();
				nama=nama.replace(' ','_');
				$("#k"+data.nik_anggota).html("<span class='label label-danger'>Non Aktif</span>");
				$("#t"+data.nik_anggota).html(data.tanggal);
				$("#e"+data.nik_anggota).html(data.ef_bulan + " - "+data.ef_tahun);
				$("#b"+data.nik_anggota).html("<button data-toggle='modal' data-target='#mdl_aktifkan'onclick=data_anggota("+nik+",'"+nama+"')  class='btn btn-primary btn-sm'><i class='fa fa-power-off'></i> Aktifkan</button>");
				$('#notif').css('opacity','0.80');
				$('#notif').fadeIn(200,function(){$("#notif").fadeOut(2000);});
				$('#notif_judul_isi').html('<i class="fa fa-check fa-lg"></i> Sukses.');
				$('#notif_isi').html('<p>Anggota berhasil dinonaktifkan.</p>');



		}})});

</script>	