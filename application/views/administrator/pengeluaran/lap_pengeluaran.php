<div class='well grs-hijau'>
	<legend>Laporan Pengeluaran</legend>
	<div class="row">
		<div class="col-sm-10">
		<h4>Pengeluaran Anggota</h4>
			<table class="table table-bordered table-responsive ">
				<thead>
				<tr class="btn-warning">
					<th>No</th>
					<th>tanggal</th>
					<th>Nik</th>
					<th>Nama</th>
					<th>Kategori</th>
					<th>Besaran</th>
					<th>Keterangan</th>
				</tr>
				</thead>
				<tbody class="t_in">
					
				</tbody>
			</table>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-10">
		<h4>Pengeluaran External</h4>
			<table class="table table-bordered table-responsive ">
				<thead>
				<tr class="btn-warning">
					<th>No</th>
					<th>tanggal</th>
					<th>Keperluan</th>
					<th>Dana</th>
					<th>Keterangan</th>
				</tr>
				</thead>
				<tbody class="t_ex">
				
				</tbody>
			</table>
		</div>
	</div>
	<div class="text-info"> Total Pengeluaran : <span class="ttt"></span></div>
</div>

<script type="text/javascript">
	var p_in = JSON.parse('<?=$int;?>');
	var p_ex = JSON.parse('<?=$ext;?>');
	var t_tin='';
	var p_total=0;
	var x_total=0;
	j=1;
	for(i=0;i<p_in.length;i++){
		p_total +=parseInt(p_in[i].besaran)
		t_tin='<tr><td>'+j+++'</td>'+
					'<td>'+p_in[i].tanggal+'</td>'+
					'<td>'+p_in[i].nik_anggota+'</td>'+
					'<td>'+p_in[i].nama+'</td>'+
					'<td>'+p_in[i].kategori+'</td>'+
					'<td>Rp. '+number(p_in[i].besaran)+'</td>'+
					'<td>'+p_in[i].keterangan+'</td></tr>';
		$('.t_in').append(t_tin);
		t_tin='';
	}
	$('.t_in').append('<tr><td colspan=2> <b>Total</b></td><td colspan=5>Rp. '+number(p_total)+'</td></tr>');
x_total=0
j=1;
	for(i=0;i<p_ex.length;i++){
		x_total +=parseInt(p_ex[i].besaran)
		t_tin='<tr><td>'+j+++'</td>'+
					'<td>'+p_ex[i].tanggal+'</td>'+
					'<td>'+p_in[i].kategori+'</td>'+
					'<td>Rp. '+number(p_in[i].besaran)+'</td>'+
					'<td>'+p_in[i].keterangan+'</td></tr>';
		$('.t_ex').append(t_tin);
		t_tin='';
	}
		$('.t_ex').append('<tr><td colspan=2> <b>Total</b></td><td colspan=3>Rp. '+number(x_total)+'</td></tr>');
		$('.ttt').html('Rp. '+number(p_total+x_total));
</script>