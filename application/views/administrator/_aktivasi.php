<div class="well grs-hijau ">
<legend>Aktivasi Keanggotaan</legend>
<div class="input-group">
  <span class="input-group-addon"><i id='icon_cari' class="fa fa-search"></i></span>
<input type='text' class='form-control' id='cari' style='width:400px' placeholder='Cari Nama Anggota'>
</div>
<br>

	<table class='table table-bordered'>
		<thead>
			<tr>
				<th class='text-center'>No</th>
				<th class='text-center'>NIK</th>
				<th class='text-center'>Nama</th>
				<th class='text-center'>Status</th>
				<th class='text-center'>Tanggal</th>
				<th class='text-center'>Efektif </th>
				<th class='text-center'>Action</td>
			</tr>
		</thead>
		<tbody id='isi' >
	<!-- reload -->	
	<?php

		$i=1;
	
		foreach($db as $d){
			
	?>
		<tr>
				<td><?php echo $i;?></td>
				<td id="nik_anggota"><?php echo $d['nik_anggota'];?></td>
				<td id='n<?php echo $d['nik_anggota'];?>'><?php echo $d['nama'];?></td>
				<td id="k<?php echo $d['nik_anggota'];?>"><?php 
						if ($d['keanggotaan']==0){
							echo "<span class='label label-warning'>Pending";
						}elseif($d['keanggotaan']==1){
							echo "<span class='label label-success'>Aktif";
						}elseif($d['keanggotaan']==2){
							echo "<span class='label label-danger'>Non Aktif";
						}?></span>
				</td>
				<td id="t<?php echo $d['nik_anggota'];?>" ><?php echo $d['tanggal'];?></td>
				<td id="e<?php echo $d['nik_anggota'];?>"><?php echo $d['ef_bulan']."-".$d['ef_tahun'];?></td>
				<td id="b<?php echo $d['nik_anggota'];?>">
					<?php
					$nama=str_replace(' ','__',$d['nama']);
						if ($d['keanggotaan']==0 || $d['keanggotaan']==2 ){
							echo 	("<button data-toggle='modal' data-target='#mdl_aktifkan' onclick=data_anggota('".$d['nik_anggota']."','".$nama."') class='btn btn-primary btn-sm'>
									<i class='fa fa-power-off'></i> Aktifkan</button>");}
						elseif($d['keanggotaan']==1){
							echo "<a data-toggle='modal'  class='btn btn-danger btn-sm' onclick=data_anggota('".$d['nik_anggota']."','".$nama."')  data-target='#mdl_nokaktif'><i class='fa fa-power-off'></i> Non Akftikan</a>";
						}
						
					?>
				</td>
			</tr>
	<?php $i++;};?>
			
	<!-- reload -->		
		</tbody>
	</table>
	<div id='ket_leg' class='row'>
		<div class='col-xs-3'>
			<div class="input-group margin-bottom-sm">
				<span  class="input-group-addon"><i id="page_kiri" class="fa pg fa-arrow-circle-left fa-lg"></i></span>
				<input class="form-control text-center" id="page"  type="text" value=1 placeholder="page">
				<span class="input-group-addon"><i title="Total Page" id='total_page'><?=$total_pg?></i></span>
				<span class="input-group-addon"><i id='page_kanan' class="fa pg fa-arrow-circle-right fa-lg"></i></span>
				<span class="input-group-addon"><i title="Pindah halaman" id='pindah_halamam' class="fa fa-send-o pg "></i></span>
			</div>
				
		</div>
		<div class='col-xs-5 '></div>
		<div class='text-right col-xs-4 '>  <span id='total'> Total Anggota  <?=$total_rec?></span>
		<i class="fa fa-database pg fa-lg"></i>
		</div>
	</div>
	
</div>
<input type='hidden' value=1 id='cpg'>
<?php echo $inc_modal;?>

<script text='text/javascript'>

		var total_record;
		var total_page;
		var page;
		var a;

function data_anggota(id,nama){
	nama =nama.replace('__',' ');
	$(".nama_anggota").html(nama);
	$(".nik_anggota").html(id);
}


	$('#page_kiri').click(function(){
		page = parseInt($('#page').val());
		total_page=parseInt($('#total_page').html());
		total_record= parseInt($('#total').html());
		
		if(page==1){
			$('#page').val(total_page);
			$('#cpg').val(total_page);
			 a=total_page-1;
			$.ajax({
				url:base_url+'administrator/reload_tabel',
				data:'record='+a,
				beforeSend:function(){},
				type:'POST',
				success:function(msg){
					$('#isi').html(msg);
					
				}
			})
			
		}else if(page<=total_page && page>1){
			page = page-1;
			$('#page').val(page);
			$('#cpg').val(page);
			 a=page-1;
			$.ajax({
				url:base_url+'administrator/reload_tabel',
				data:'record='+a,
				beforeSend:function(){},
				type:'POST',
				success:function(msg){
					$('#isi').html(msg);
					
				}
			})
		}else{
			alert('Page Halaman tidak vaid');
			$('#page').val
			($('#cpg').val());
		}
	});
	
	$('#page_kanan').click(function(){
		page = parseInt($('#page').val());
		total_page=parseInt($('#total_page').html());
		total_record= parseInt($('#total').html());
		
		if(page==total_page){
			$('#page').val(1);
			$('#cpg').val(1);
			
			a=0;
			$.ajax({
				url:base_url+'administrator/reload_tabel',
				data:'record='+a,
				beforeSend:function(){},
				type:'POST',
				success:function(msg){
					$('#isi').html(msg);
					
				}
			})
			
		}else if(page<total_page && page>=1){
			page = page+1;
			$('#page').val(page);
			$('#cpg').val(page);
			
			a=page-1;
			$.ajax({
				url:base_url+'administrator/reload_tabel',
				data:'record='+a,
				beforeSend:function(){},
				type:'POST',
				success:function(msg){
					$('#isi').html(msg);
					
				}
			})
			
		}else{
			alert('Page halaman tidak valid');
			$('#page').val($('#cpg').val());
		}
	});
	
	$("#pindah_halamam").click(function(){
		page = parseInt($('#page').val());
		total_page=parseInt($('#total_page').html());
		total_record= parseInt($('#total').html());
		if(page>total_page || page<1 ){
			alert('Page Halaman tidak vaid');
			$('#page').val(parseInt($('#cpg').val()));
		}else{
			a=page-1;
			$.ajax({
				url:base_url+'administrator/reload_tabel',
				typeData:'json',
				data:'record='+a,
				type:'POST',
				success:function(msg){
					$('#isi').html(msg);
				}
			})//ajax
		}
	})
	
$("#cari").keyup(function(){
	huruf=$("#cari").val();
	panjang=huruf.length;
	if(panjang>0){
		$("#icon_cari").addClass('text-primary');
		$("#ket_leg").hide();
		$.ajax({
			url 		: base_url+'administrator/cari_nama_anggota',
			type 		: 'post',
			cache		: 'false',
			beforeSend: function(){
				$('#notif').css('opacity','0.80');
				$('#notif').fadeIn(200);
				$('#notif_judul_isi').html('<i class="fa fa-spinner fa-pulse"></i> Pencarian Data.');
				$('#notif_isi').html('<p>Mohon menunggu....</p>');


			},
			data 		: 'nama='+$("#cari").val(),
			success 	: function(msg){
							$("#isi").html(msg);
							$('#notif').hide(100);
						}
		});
	}else{
		$.ajax({
			url 	: base_url+'administrator/reload_tabel',
			data 	: 'record='+$("#page").html(),
			type 	: 'POST',
			success:function(msg){
				$("#isi").html(msg);	

			}
		})
		$("#ket_leg").show();
		$("#icon_cari").removeClass('text-primary');
	}
});
</script>