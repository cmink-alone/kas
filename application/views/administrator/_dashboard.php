			
			<div class="col-md-12 col-lg-4">
				<div class="well well well-ukuran  well-tambah	 " >
					<legend><i class="fa fa-plus-square " ></i> Pemasukan Dari Anggota</legend>
					<p class="isi pemasukan_anggota" ></p>
					
					
				</div>
			</div>
			<div class="col-md-12 col-md-4 ">
				<div class="well well well-ukuran  well-tambah ">
					<legend><i class="fa fa-plus-square-o  " ></i> Total Donasi</legend>
					<p class="isi total_donasi"></p>
				</div>
			</div>

			<div class="col-md-12 col-md-4  ">
				<div class="well ks well-ukuran well-tambah btn-success ">
					<legend><i class="fa fa-plus-square-o" ></i> Total Pemasukan</legend>
					<p class="isi  total_pemasukan text-success"></p>
				</div>
			</div>
			
			<div class="col-md-12 col-md-4 ">
				<div class="well well well-ukuran  well-pengeluran">
					<legend><i class="fa fa-minus-square-o " ></i>Pengeluaran Anggota</legend>
					<p class="isi tot_pengeluran_ang"></p>
				</div>
			</div>
			
			<div class="col-md-12 col-md-4 ">
				<div class="well well well-ukuran well-pengeluran">
					<legend><i class="fa fa-minus-square " ></i> Pengeluaran External</legend>
					<p class="isi pengeluran_ext"></p>
				</div>
			</div>
			
				<div class="col-md-12 col-md-4 ">
				<div class="well  well-ukuran well-pengeluran  btn-danger">
					<legend> <i class="fa fa-minus-square  " ></i> Total Pengeluaran</legend>
					<p class="isi total_pengeluaran_kas"></p>
				</div>
			</div>
			<div class="col-md-12 col-md-6 ">
				<div class="well well well-ukuran-total pg well-total">
					<legend>Belum Melakukan Pembayaran </legend>
					<p class="isi total_telat"></p>
				</div>
			</div>
			<div class="col-md-12 col-md-6 pg ">
				<div class="well well well-ukuran-total well-total">
					<legend>TOTAL SALDO KAS </legend>
					<p class="isi total_saldo_kas"></p>
				</div>
			</div>
			
<script type="text/javascript">
	var datakas=JSON.parse('<?=$data_kas;?>');	
	$('.pemasukan_anggota').html('Rp. '+number(datakas.total_pem_anggota));
	$('.total_donasi').html('Rp. '+number(datakas.total_donasi));
	$('.total_telat').html('Rp. '+number(datakas.total_telat));
	$('.ks').mouseover(function(){
		$('.total_pemasukan').removeClass('text-success');
	}).mouseleave(function(){$('.total_pemasukan').addClass('text-success')});
	$(".total_pemasukan").html('Rp. '+number(datakas.total_pem_kas));
	$(".pengeluran_ext").html('Rp. '+number(datakas.tot_pengeluaran_ext));
	$('.tot_pengeluran_ang').html('Rp. '+number(datakas.tot_pengeluran_ang));
	$('.total_pengeluaran_kas').html('Rp. '+number(datakas.total_pengeluaran_kas));
	$('.total_telat').html('Rp. '+number(datakas.total_telat));
	$('.total_saldo_kas').html('Rp. '+number(datakas.total_saldo_kas));

	

</script>