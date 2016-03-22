<div class='row'>
	<div class='col-md-6'>
		<table class="table table-bordered">
			<thead class="alert-success">
				<tr>
					<th>No</th>
					<th>Bulan</th>
					<th>Total</th>
				</tr>
			</thead>
			<tr>
				<td>1</td>
				<td>Januari</td>
				<td id='to_1'></td>
			</tr>
			<tr>
				<td>2</td>
				<td>Februari</td>
				<td id='to_2'>39999</td>
			</tr>
			<tr>
				<td>3</td>
				<td>Maret</td>
				<td id='to_3'>39999</td>
			</tr>
			<tr>
				<td>4</td>
				<td>April</td>
				<td  id='to_4'>39999</td>
			</tr>
			<tr>
				<td>5</td>
				<td>Mei</td>
				<td id='to_5'>39999</td>
			</tr>
			<tr>
				<td>6</td>
				<td>Juni</td>
				<td  id='to_6'>39999</td>
			</tr>

		</table>
	</div>
	<div class='col-md-6'>
		<table class="table table-bordered">
			<thead class="alert-success">
				<tr>
					<th>No</th>
					<th>Bulan</th>
					<th>Total</th>
				</tr>
			</thead>
			<tr>
				<td>7</td>
				<td>Juli</td>
				<td id='to_7'>39999</td>
			</tr>
			<tr>
				<td>8</td>
				<td>Agustus</td>
				<td  id='to_8'>39999</td>
			</tr>
			<tr>
				<td>9</td>
				<td>September</td>
				<td id='to_9'></td>
			</tr>
			<tr>
				<td>10</td>
				<td>Oktober</td>
				<td id='to_10'>39999</td>
			</tr>
			<tr>
				<td>11</td>
				<td>November</td>
				<td id='to_11'>39999</td>
			</tr>
			<tr>
				<td>12</td>
				<td>Desember</td>
				<td id='to_12'>39999</td>
			</tr>
		</table>
	</div>
	<div class="col-md-12" style="font-size: 19px">
		Total Pemasukan Tahun <span id='tahun'>2016</span> : <span class='text-primary total'></span>
	</div>
</div>
<script type="text/javascript">
	var perbulan= '<?=$bulanan;?>';
	var tahun 	= '<?=$tahun;?>';
	var js_bulanan= JSON.parse(perbulan);
	var total=0;
	for(i=1;i<=12;i++){
		if(js_bulanan[i]=='0'){
			$('#to_'+i).text(number(js_bulanan[i]));	
		}else{
			$('#to_'+i).text('Rp. '+number(js_bulanan[i]));
		}
	}
	$('#tahun').text(tahun);
	$('.total').text('Rp. '+number('<?=$total;?>'));
</script>