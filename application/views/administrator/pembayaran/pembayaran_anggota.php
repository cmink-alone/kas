<div class="well grs-hijau">
<fieldset>
	<legend>Pembayaran Uang Kas</legend>
		<form class='form-horizontal'>
		<div class='row'>
			<div  class=' col-sm-3'>
				<img class='form-control' id="foto" style='min-height:200px' src='<?php echo base_url();?>asset/foto/default.jpg'>
			</div>
			
			<div class='form-group col-sm-8 ui-widget'>
				<label class='control-label col-sm-3'style='text-align:left' for="cari_nik">NIK </label>
				<div class='col-sm-8'>
					<input id='cari_nik' class='form-control' placeholder="Masukan No Induk Pegawai" type='text' >
					<input id='nik' class='form-control' placeholder="Masukan No Induk Pegawai" type='hidden' >
				</div>
			</div>


			<div class='form-group  col-sm-8'>
				<label class='control-label col-sm-3' style='text-align:left'>Nama Anggota </label>
				<div class='col-sm-8'>
					<input type='text' id="nama" class='form-control' disabled>
				</div>				
			</div>
			
			
			<div class='form-group col-sm-8'>
				<label class='control-label col-sm-3'style='text-align:left' >Jenis kelamin </label>
				<div class='col-sm-8'>
					<input class='form-control' id="jk" type='text' disabled>
				</div>
			</div>
			
			<div class='form-group col-sm-8'>
				<label class='control-label col-sm-3'style='text-align:left' >Tempat, tgl lahir </label>
				<div class='col-sm-8'>
					<input class='form-control' id="ttl" type='text' disabled>
				</div>
			</div>
			
			<div class='form-group col-sm-8'>
				<label class='control-label col-sm-3'style='text-align:left' >Email </label>
				<div class='col-sm-8'>
					<input class='form-control' id="email" type='text' disabled>
				</div>
			</div>
		</div>
		</form>
	</fieldset>
</div>
<div id="tab_konten" class="well grs-hijau hidden">
	<ul class="nav nav-tabs ">
	    <li id="li_tb_pembayaran"class="tb active"><a class="pg" id="tb_pembayaran">Pembayaran</a></li>
	    <li id="li_tb_data" class="tb"><a class="pg" id="tb_data">Laporan</a></li>
  	</ul>	
  	<br>

<div id="isi_konten">

</div>
<script  language="javascript">
var index_k=1;
$(document).ready(function(){
	$("#cari_nik").autocomplete({

		source		: function(request,respon){
			$.ajax({
				url 	: base_url + "administrator/pilih_anggota",
				type	: "POST",
				typeData: "jsonp",
				data 	: {key:request.term},
				success	: function(data){
					js1 = JSON.parse(data);
					respon($.map(js1,
					 function (item2) {
                		return {
                    		label: item2.nik_anggota,
                    		value: item2.nik_anggota,
                    		nama : item2.nama,
                    		foto : item2.foto,
                    		jk	 : item2.jk,
                    		tempat: item2.tempat,
                    		tgl_lahir : item2.tgl_lahir,
                    		email : item2.email,
                    		nik : item2.nik_anggota
                		};
                		}))}
					
				 

			})//ajax
		},
		minLength:1,
		select : function(event,ui){
			$("#nik").val(ui.item.nik);
			$("#nama").val(ui.item.nama);
			$("#foto").prop({
				"src" : base_url +"asset/foto/"+ui.item.foto
			});
			$("#email").val(ui.item.email);
			$("#ttl").val(ui.item.tempat + ", "+ ui.item.tgl_lahir);
			$("#jk").val(ui.item.jk);
			$("#tab_konten").fadeIn(2000);
			$("#isi_konten").load(base_url+"administrator/tab_pembayaran");
			$(".tb").removeClass("active");
			$("#li_tb_pembayaran").addClass("active");
			$("#tab_konten").removeClass("hidden");
			
						
		}

	});
})

$("#cari_nik").keyup(function(){
	if ($("#cari_nik").val()==''){
		$("#nama").val('');
			$("#foto").prop({
				"src" : base_url +"asset/foto/default.jpg"
			});
			$("#email").val('');
			$("#tab_konten").fadeOut(1000);
			$("#ttl").val('');
			$("#jk").val('');
			$("#nik").val('');
			

	}
});

$("#tb_pembayaran").click(function(){

	$(".tb").removeClass("active");
	$("#li_tb_pembayaran").addClass("active");
	$("#isi_konten").load(base_url+"administrator/tab_pembayaran");

});

$("#tb_data").click(function(){
	var nik= $("#nik").val();
	$("#isi_konten").load(base_url+"administrator/tab_data_pembayaran/"+nik);
	$(".tb").removeClass("active");
	$("#li_tb_data").addClass("active");
});

$("#email").change(function(){
	alert("nik berubah");
})
</script>