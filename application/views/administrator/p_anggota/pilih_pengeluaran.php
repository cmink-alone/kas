<div class='well grs-hijau'>
<form class='form-horizontal'>
<div class='form-group'>
	
		<div class='col-sm-4'>
			<select class='form-control' id="kategori">
				<option id="terpilih" selected>Pilih Kategori Pengeluaran</option>	
			</select>
		</div>

		<div class='col-sm-4'>
			<div class='input-group'>
					<span class='input-group-addon'>Tanggal</span>
					<input id="tanggal" class='form-control' >
			</div>

		</div>
	
		<div class='col-sm-4'>
			<div class='input-group'>
					<span class='input-group-addon'>Rp.</span>
					<input id="besaran" class='form-control' disabled>
			</div>

		</div>

</div>
<div class='form-group'>
	<div class='col-sm-4'>
			<textarea  rows='5' class='form-control' style="resize:vertical" id="keterangan" placeholder='Keterangan' title='Keterangan' ></textarea>
	</div>
	<div class='col-sm-4'>
		<button type='button' id="btn_simpan" disabled class='btn btn-primary btn-sm'>Simpan</button>
	</div>
</div>
</form>
</div>

<script language='javascript' type="text/javascript">

		
		var data = JSON.parse('<?=$kategori?>');
		var op='';
		for (i=0 ;i < data.length;i++ ){
			op += "<option value='"+i+"' id='op"+i+"'> "+data[i].nama_kategori+"</option>";
		}
		$("#kategori").append(op);
		
		$("#kategori").change(function(){
			a=$("#kategori").val();
			$("#besaran").val(data[a].pengeluaran);
			if($("#nik").val()!='' && $("#tanggal").val()!=''){
				$('#btn_simpan').prop('disabled',false);

			}else{
				$('#btn_simpan').prop('disabled',true);
			}	
		});


		$("#tanggal").change(function(){
			if($("#nik").val()!='' && $("#tanggal").val()!=''){
				$('#btn_simpan').prop('disabled',false);

			}else{
				$('#btn_simpan').prop('disabled',true);
			}	
		});

		$("#kategori").click(function(){
			$("#terpilih").fadeOut("slow");
		});

		$("#btn_simpan").click(function(){
			$.ajax({
				url		: base_url + "administrator/pengeluaran_anggota",
				type	: "post",
				dataType: "json",
				data    : {tanggal:$('#tanggal').val(),nik_anggota:$("#nik").val(),kategori:data[a].nama_kategori,keterangan:$("#keterangan").val(),pengeluaran:$("#besaran").val()},
				success:function(msg){
					if(msg==1){
						$("#cari_nik").val('');
						$("#nama").val('');
						$("#foto").prop({
							"src" : base_url +"asset/foto/default.jpg"
						});
						$("#email").val('');
						$("#ttl").val('');
						$("#jk").val('');
						$("#nik").val('');
						$("#kategori").val("Pilih Kategori Pengeluaran");
						$("#besaran").val('');
						$("#keterangan").val('');
						$('#tanggal').val('');
						$("#btn_simpan").prop("disabled",true);
					$('#notif_judul_isi').html('<i class="fa fa-check fa-lg"></i> Sukses.');
					$('#notif_isi').html('<p>Data sudah ditambahkan.</p>');
					$('#notif').css('opacity','0.70');
					$('#notif').fadeIn(2000,function(){
						$('#notif').fadeOut(2000);
					});
					}
				}
			});//ajax
		});

		$("#tanggal").datepicker({
			changeMonth:true,
			changeYear:true,
			dateFormat:'yy-mm-dd'
		});
</script>