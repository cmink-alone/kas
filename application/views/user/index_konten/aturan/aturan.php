  <br>
  <section class="sidebar">
  <div class="alert alert-info text-center"><p><h3>"Penggunakan Uang KAS ini digunakan sepenuhnya untuk kegiatan sosial karyawan KOPKARLA."</h3></p></div>
  </section>

<section class="sidebar container-fluid" style="padding-left: 10px">
	<div class="row">
		<div class="col-md-9">
		<legend>List Sumbangan</legend>
			<table class="table table-bordered">
				<thead class="btn-warning">
					<tr>
						<th>NO</th>
						<th>Sumbangan</th>
						<th>Besaran</th>
						<th>Keterangan</th>
					</tr>
				</thead>
				<tbody class="sumbangan">
					
				</tbody>
			</table>
		</div>

		
</section>
<script type="text/javascript">
	var sumb= JSON.parse('<?=$sumbangan;?>');
	j=1;
	for (i=0;i<sumb.length;i++){
		$('.sumbangan').append('<tr><td>'+j+++'</td><td>'+sumb[i].nama_kategori+'</td><td>Rp. '+number(sumb[i].pengeluaran)+'</td><td>'+sumb[i].keterangan+'</td></tr>')
	}
</script>