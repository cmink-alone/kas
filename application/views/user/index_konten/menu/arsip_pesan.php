<div class="row ">
	<section class="col-lg-2 ar" >
		<div class="panel">
			<div class="panel-heading ">Pilihan Tahun</div>
			<div class="panel-body ar_t scroll ">

			</div>
		</div>
	</section>
	<div class="col-sm-10 alert-denger">
		<div class="panel">
			<div class="panel-heading">Arsip Pembayaran</div>
			<div class="panel-body">
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
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	var isi=JSON.parse('<?=$arsip;?>');
	var thn=JSON.parse('<?=$thn;?>');
	for(i=0;i<thn.length;i++){
		a="<a href='#' class='thn tx' > <i class='fa fa-tag'></i> Tahun " + thn[i].tahun+"</a><br>";
		$('.ar_t').append(a);
		a='';
	}
	j=1;
	for(i=0;i<isi.length;i++){
		tb='<tr>'+
				'<td>'+ j++ +'</td>'+
				'<td>'+isi[i].dari+'</td>'+
				'<td>'+isi[i].judul+'</td>'+
				'<td>Anda telah Membayar iuaran bulan '+bulan(isi[i].pesan)+' '+isi[i].tahun +'.</td>'+
				'<td>Rp. '+number(isi[i].membayar)+'</td>'+
				'<td>'+isi[i].keterangan+'</td>'+
				'<td>'+isi[i].waktu+'</td>'+
			'</tr>';
		$('.isi_pesan').append(tb);
		tb='';
	
	}
	$('.thn').click(function(){
		var b=$(this).text();
		var tahun=b.replace('  Tahun ','');
		console.log(tahun);
		$.ajax({
			url		: base_url+'user/pesan_arsip_up/'+tahun,
			type 	: 'post',
			typeData: "JSON",
			beforeSend: function(){
				$('.isi_pesan').html('Loading...');
			},
			success : function(msg){
				$('.isi_pesan').html('');
				isi=JSON.parse(msg);
				j=1;
				for(i=0;i<isi.length;i++){
					tb='<tr>'+
							'<td>'+ j++ +'</td>'+
							'<td>'+isi[i].dari+'</td>'+
							'<td>'+isi[i].judul+'</td>'+
							'<td>Anda telah Membayar iuaran bulan '+bulan(isi[i].pesan)+' '+isi[i].tahun +'.</td>'+
							'<td>Rp. '+number(isi[i].membayar)+'</td>'+
							'<td>'+isi[i].keterangan+'</td>'+
							'<td>'+isi[i].waktu+'</td>'+
						'</tr>';
					$('.isi_pesan').append(tb);
					tb='';
				}
			}
		})
	});
</script>