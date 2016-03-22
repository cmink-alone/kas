<div class="alert">
<legend class="title"></legend>
	<table class="table tb_dt">
		<thead>
			<tr class="alert-warning">
				<th>No</th>
				<th>Dari</th>
				<th>Judul</th>
				<th>Isi Pesan</th>
				<th>Sebesar</th>
				<th>Keterangan</th>
				<th>Waktu</th>
			</tr>
		</thead>
		<tbody class="isi_pesan">
			
		</tbody>
	</table>
	<div class="alert alert-info">Jika tida sesuai silahkan menghubungi kami. -Admin Kas-</div>
</div>
<script type="text/javascript">
   $('.ps_label').html('');
   $('.ps_judul').html('sudah tidak ada pesan baru');
	var isi=JSON.parse('<?=$dt;?>');
	var tb='';
	if(isi.length>0){
		$('.title').html('Anda Mempunya '+isi.length+' pesan baru.');
	}else{
		$('.tb_dt').remove();
		$('.title').html('Anda tidak mempunyai  pesan baru. | <a text-primary class="arsip" href="#">Arip Pembayaran</a>');
	}
	j=1;
	for(i=0;i<isi.length;i++){
		tb='<tr>'+
				'<td>'+ j++ +'</td>'+
				'<td>'+isi[i].dari+'</td>'+
				'<td>'+isi[i].judul+'</td>'+
				'<td>Anda telah Membayar iuaran bulan '+bulan(isi[i].pesan)+' '+isi[i].tahun +'.</td>'+
				'<td>'+isi[i].membayar+'</td>'+
				'<td>'+isi[i].keterangan+'</td>'+
				'<td>'+isi[i].waktu+'</td>'+
			'</tr>';
		$('.isi_pesan').append(tb);
		tb='';
	
	}

	$('.arsip').click(function(){
		$('.in_konten').load(base_url+'user/pesan_arsip');
	});

</script>