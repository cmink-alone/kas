<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?=$head;?>
</head>
<body>

	<nav class="navbar grs-hijau navbar-default " style=" margin:0px;border-radius:0px; background-color:#c9fc16">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span> 
			</button>
			<a class="navbar-brand lebar text-center" style="padding-top:2px"  >Pembayaran Uang Kas<br>
				<span  style="color:#ffff00" class="text-shadaw text-danger">OTASK</span></a>
		</div>
      
		<div class="collapse navbar-collapse " id="myNavbar">
			<ul class="nav navbar-nav " style=" margin-left:10px;">
				<li id="upd">
					<a>
						<button id="btn_update" type="button" class="btn btn-warning btn-xs">
							<i id="fa_update" class="fa fa-chrome"> </i> <span id="label_up">Dhasboard</span>
						</button>
					</a>
				</li>
								
				<li id="pesan">
					<a href='#'>
						<i class='fa fa-comments'></i> Pesan 
					</a>
				</li>
				
				<li class="dropdown">
						<a  href="#" data-toggle="dropdown">
							<i id="dw_setting" class="fa fa-gears fa-fw "></i> Setting<span class="caret"></span>
						</a>
						<ul class="dropdown-menu" role="menu" aria-labelledby="dw_setting">
							<li role="presentation"class="pg"><a id="set_kas" href="#">KAS Anggota</a></li>
							<li role="presentation"class="pg"><a>Email</a></li>
							<li role="presentation" class="pg"><a id="password">Password</a></li>
						</ul>
					
				</li>
				<li>
					<a href="<?PHP echo base_url().'login/logout';?>">
						<i class="fa fa-power-off fa-fw"></i>Logout	
					</a>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li class="collapse navbar-collapse"><a id="by"><?=$tanggal;?></a></li>
			</ul>
		</div>
    </nav>
<!-- -->
<div class="container-fluid">
	<div class="row" >
	<!-- MENU KIRI -->
		<div class="col-sm-2 col-sm-3 menu">
			<ul class="form_menu" >	
				<li>
					<a href='#' class='collpased' data-toggle='collapse' data-target='#group_keanggotaan'><i class="fa fa-gg"></i> Keanggotaaan</a>
				</li>
				<ul id='group_keanggotaan' class='collapse'>
					<li id="tambah_anggota"><a href='#'>Tambah Anggota</a>
					</li>
					<li id="aktivasi"><a href='#'>Aktivasi Anggota</a>
					</li>
					</li>
					<li id="d_anggota"><a href='#'>Data Anggota</a>
					</li>
				</ul>
				<!-- -->
				
				<li><a href='#' id="pengeluran" class="collapsed" data-toggle="collapse" data-target="#group_pembayaran">
					<i class="fa fa-gg"></i> Pembayaran</a>
				</li>
					<ul class="collpase" id="group_pembayaran">
						<li><a href="#" id="pembayaran_anggota">Pembayaran Anggota</a></li>
						<li><a class="pg" id="donasi">Donasi </a></li>
						<li><a class="pg" id="pembayaran_laporan">Laporan </a></li>
					</ul>
				
				
				<li> <a id='h_pengeluran' class='collapsed' data-toggle='collapse' data-target='#group_pengeluaran'>
				
						<i class="fa fa-gg"></i> Pengeluaran
					</a>
				</li>
					<ul class='collapse' id='group_pengeluaran'>
						<li id='kategori_pengeluaran'>
							<a href="#">Kategori</a>
						</li>
						<li id='pengeluaran'>
							<a href='#'>Anggota</a>
						</li>
						<li id='pengeluaran_ext' >
							<a href='#'>External</a>
						</li>
						<li id='laporan_pengeluaran'><a>Laporan </a></li>
					</ul>
				
			</ul>
			<div class=' text-center'>Last Login : </div>
		</div>
	<!-- END MENU KIRI -->
	
	
	<!-- KONTEN -->
		<div id="konten" class="col-sm-10 col-sm-12" style="padding:10px 50px 0px 10px">
		</div>
	<!--end konten -->
	
	<!-- Add the extra clearfix for only the required viewport -->
		<div id="konten" class="col-md-9 col-sm-8"></div>
		<div class="clearfix visible-xs-block"></div>
	</div>
</div><!-- end cibtauber-->


<div id="notif" class="notif">
	<span id="x"><a id="close_x">x</a></span>
    <div id="notif_judul" class="text-center"><h4 id='notif_judul_isi'></h4></div>
    <div id="notif_isi" class="text-justify"> </div>
</div>	
<script type="text/javascript">


	var base_url="<?php echo base_url();?>";
	$(document).ready(function(){
		//$('#konten').load(base_url+'administrator/dashboard');
		$("#btn_update").click();

	})
	
	$('#dashboard').click(function(){
		$('#konten').load(base_url+'administrator/dashboard');
	})
		
	$("#tambah_anggota").click(function(){
			$('#konten').load(base_url+'administrator/form_add_anggota');
	})<!--end click dashboard -->
	
	$('#kategori_pengeluaran').click(function(){
		$('#konten').load(base_url+'administrator/kategori_pengeluaran')
	})
	
	$('#aktivasi').click(function(){
		$('#konten').load(base_url+'administrator/aktivasi');
	})

	$("#set_kas").click(function(){
		$("#konten").load(base_url + 'administrator/menu_setting');
	});
	
	$('#pengeluaran').click(function(){
		$('#konten').load(base_url+'administrator/pengeluaran')
	});
	
	$('#pengeluaran_ext').click(function(){
		$('#konten').load(base_url+'administrator/pengeluaran_ext')
	});
	$('#close_x').click(function(){
		$('#notif').fadeOut('fast');
	});
	//pemasukan
	$("#pembayaran_anggota").click(function(){
		$("#konten").load(base_url + "administrator/pembayaran_anggota");
	});
	$("#donasi").click(function(){
		$("#konten").load(base_url + "administrator/donasi");
	});
	$("#btn_update").mouseover(function(){
			$("#label_up").html("perbarui...");
	})
	$("#btn_update").mouseleave(function(){
			$("#label_up").html("Dhasboard");
	})

	$('#password').click(function(){
		$('#konten').fadeOut('fast').load(base_url + 'administrator/password').fadeIn('fast');
	});

	$("#pembayaran_laporan").click(function(){
		$("#konten").fadeOut('fast').load(base_url + 'administrator/pembayaran_laporan').fadeIn('fast');
	})
	$("#btn_update").click(function(){
		$.ajax({
			url		: base_url+"administrator/update_data",
			beforeSend		: function(){
				$("#notif").fadeIn("fast").css('opacity','0.75');;
				$("#notif_judul").html("<i class='fa fa-refresh fa-pulse'></i> Perbarui...");
				$("#notif_isi").html("</i> Mohon menunggu, sedang perbarui data.");
				$("#fa_update").addClass("fa-refresh fa-pulse");
				$("#label_up").html("Sedang Memperbarui");
				$("#konten").fadeOut().fadeOut("slow").html("<div class='text-center'>Loading..</div>");
			},
			type			:"POST",
			data 			:{},
			success			: function(msg){
				$("#konten").fadeOut("slow").load(base_url+"administrator/dashboard");
				$("#notif").fadeOut("slow");
				$("#konten").fadeOut().fadeIn("fast");
				$("#fa_update").removeClass("fa-refresh fa-pulse");
				$("#label_up").html("Memperbarui");
			}

		});
	});

	$("#laporan_pengeluaran").click(function(){
		$("#konten").fadeOut('fast').load(base_url + 'administrator/laporan_pengeluaran').fadeIn('fast');
	});


</script>


</body>
</html>