<div class="mgt container">
	<div class="ci">
		<div class="well well-lg">
		<legend>Your Profile</legend>
			<div class="row">
				<div class="col-sm-4">
					<img class='pp img-responsive img-thumbnail' src="">
				</div>
				<div class="col-sm-2">
					<div>Nama</div>
					<div>NIK</div>
					<div>Ttl</div>
					<div>Email</div>
					<div>Jenik kelamin</div>
		
				</div>
				<div class="col-sm-1">
					<div>:</div>
					<div>:</div>
					<div>:</div>
					<div>:</div>
					<div>:</div>
	
				</div>
				<div class="col-sm-5">
					<div class="nama"></div>
					<div class="nik"></div>
					<div><span class='tempat'></span>, <span class='tgl'></span> <span class='bln'></span><span class="thn"></span></div>
					<div class="email"></div>
					<div class="jk"></div>
				
				</div>

				<div class="col-md-12"><hr><i><i class="fa fa-flag"></i> Bergabung sejak <span class="ak_bl"></span> <span class="ak_th"></span></i></div>

			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	var db=JSON.parse('<?=$d;?>');
	$('.nama').html(db[0].nama);
	$('.nik').html(db[0].nik_anggota);
	$('.tempat').html(db[0].tempat);
	$('.tgl').html(parseInt(db.ttl[2]));
	$('.bln').html(" "+bulan(parseInt(db.ttl[2]))+" ");
	$('.thn').html(db.ttl[0]);
	$('.email').html(db[0].email);
	$('.jk').html(db[0].jk);
	$('.pp').prop('src',base_url +'asset/foto/'+db[0].foto);
	$('.ak_bl').html(bulan(db.ak[0].ef_bulan));
	$('.ak_th').html(db.ak[0].ef_tahun);
</script>