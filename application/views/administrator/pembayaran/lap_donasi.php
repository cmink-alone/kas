<table class="table table-striped">
	<thead>
		<tr>
			<th>No</th>
			<th>Tanggal</th>
			<th>Nama</th>
			<th>Besaran</th>
			<th>Alamat</th>
			<th>Keterangan</th>
		</tr>
	</thead>
	<tbody id='isi_tabel'>
		
	</tbody>
	</table>
	<hr>
	<span>Total Pemasukan Donasi Tahun <strong><span class="text-primary tahun_donasi"></span>  :  <span class="text-primary total_donasi"></span></span></strong>
<script type="text/javascript">
	var donasi = '<?=$donasi?>';
	donasi=JSON.parse(donasi);
	total=0;
	var j=1;
	for (i=0;i<donasi.length;i++){
		total +=parseInt(donasi[i].donasi);
		$("#isi_tabel").append('<tr><td>'+j+++'</td><td>'+donasi[i].tanggal+'</td><td>'+donasi[i].nama+'</td><td>Rp. '+number(donasi[i].donasi)+'</td><td>'+donasi[i].alamat+'</td><td>'+donasi[i].keterangan+'</td></tr>')
	}
	$(".total_donasi").html('Rp. ' +number(total));
	$(".tahun_donasi").html($("#m_menu").val());
</script>