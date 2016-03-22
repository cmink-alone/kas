<div class='well grs-hijau'>
	<legend>Laporan Pemasukan</legend>
	<nav class='navbar navbar-default' style=" margin-bottom:0px">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand judul" style="width:219px">Pemasukan</a>
			</div>
			<div class="navbar-collapse">
				<ul class="nav navbar-nav nav-tabs">
					<li class="li li_1 nav_tb pg" id='1'><a  >Anggota</a></li>
					<li class="li li_2 nav_tb pg" id='2'><a >Perbulan</a></li>
					<li class="li li_3 nav_tb pg" id='3'><a  >Donasi</a></li>
				</ul>
				<ul class="nav navbar-nav ">
					<li>
						<a>	<select class="form-control" id='m_menu'>
							</select></a>
					</li>
					
				</ul>
			</div>
		</div>
	</nav>
	<div class="alert fade alert-warning" id='konten_pemasukan'>
	</div>
</div>
<script type="text/javascript">
	var m_menu = '<?=$m_menu;?>';
	var js_m_menu= JSON.parse(m_menu);
	var now_tahun= '<?=$now_tahun;?>';
	var c='';
	$(".nav_tb").click(function(){
		var aktif=$(this).prop('id');
		if (c!=aktif){
			$('.li').removeClass('active key');
			$(this).addClass('active key');
			$('.li_seacrh').removeClass('fade').fadeIn(1);
			var isi=$(this).text();
			if(isi=='Anggota'){
				$('#konten_pemasukan').removeClass('fade').fadeIn('fast').load(base_url+'administrator/lap_anggota/'+$('#m_menu').val());		
			}else 
			if(isi=='Perbulan'){
				$('.li_seacrh').fadeOut(1);
				$('#konten_pemasukan').removeClass('fade').fadeIn('fast').load(base_url+'administrator/lap_bulanan/'+$("#m_menu").val());
			}else if(isi=='Donasi'){
				$('.li_seacrh').fadeOut(1);
				$('#konten_pemasukan').fadeOut('fast').removeClass('fade').load(base_url+'administrator/lap_donasi/'+$("#m_menu").val()).fadeIn('fast');
			}
			$('.judul').html('Pemasukan '+isi);
		}
		c=aktif;
	});
	var m_menu_op='';
	for (i=0;i<js_m_menu.length;i++){
		if (js_m_menu[i].tahun==now_tahun){
			m_menu_op +='<option selected value="'+js_m_menu[i].tahun+'" >'+js_m_menu[i].tahun+'</option>';
		
		}else{
			m_menu_op +='<option value="'+js_m_menu[i].tahun+'" >'+js_m_menu[i].tahun+'</option>';
		}
	}
	$("#m_menu").append(m_menu_op);
	
	$('#m_menu').change(function(){
		if ($('.key').text()=='Anggota'){
			$('#konten_pemasukan').fadeOut('fast').load(base_url+'administrator/lap_anggota/'+$('#m_menu').val()).fadeIn('fast');	
		}else if($('.key').text()=='Donasi'){
			$('#konten_pemasukan').fadeOut('fast').load(base_url+'administrator/lap_donasi/'+$('#m_menu').val()).fadeIn('fast');
		}else if($('.key').text()=='Perbulan'){
			$('#konten_pemasukan').removeClass('fade').fadeIn('fast').load(base_url+'administrator/lap_bulanan/'+$("#m_menu").val());
		}
	});

	$(".cr").keyup(function(){
		if ($(".cr").val()!=""){
			$('.crs').addClass('btn-success');
			$('.cri').addClass('text-warning');
		}else{
			$('.crs').removeClass('btn-success');
			$('.cri').removeClass('text-warning');
		}
	});


		
		
</script>