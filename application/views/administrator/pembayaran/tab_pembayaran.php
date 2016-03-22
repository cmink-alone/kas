	
	<div class="container-fluid ">
		<div class="row">
			<div class="col-6-sm">
				<div class="container-fluid">
					<div class="alert alert-success ">
						Bayar Untuk 
						<select id="n_bayar">
							<?php for ($i=1;$i<=12;$i++){
								echo "<option value='".$i."'>".$i."</option>";
							}?>
						</select> Bulan.  <button type="button" id="show" class="btn btn-default btn-xs">Show</button>
			
						<div id="show_simpan" class="hide">
							<hr>
							<input id="checkbox" type="checkbox"> <label>Sudah Sesuai.</label> 
							<button disabled="true" id="btn_bayar"class="btn btn-primary btn-xs">Bayar</button>
						</div>
					</div>
		
					<div id="pembayaran_ket" class="hide">
					<div class="alert alert-warning">
						Pembayaran terahir  :<strong id="label_terahir"></strong>.
					</div>
						<h4>Yang Akan dibayarkan :</h4> 
						 <table class="table table-responsive table-striped table-hover table-bordered">
						 	<thead>
						 		<tr>
						 			<th>NO</th>
						 			<th>Tahun</th>
						 			<th>Bulan</th>
						 			<th>Besaran</th>
						 			<th>Keterangan</th>
						 			</tr>
						 	</thead>
						 	<tbody id="detail">
						 	</tbody>
						 </table>
						 <legend> Total yang harus dibayarkan <strong id="total"></strong></legend>
					</div>
 				</div>
			</div>
		</div>
	</div>
	<input type="hidden" id="bayar_x">
<script type="text/javascript">
			
	$("#show").click(function(){
		$("#detail").html('');
		var n = $("#n_bayar").val();
		var bulan='';
		var td_bayar ='';
		$.ajax({
			url 	: base_url +"administrator/show_pembayaran",
			type	: "POST",
			typeData: "ajax",
			data 	: {nik : $("#nik").val()},
			success : function(msg){
				js=JSON.parse(msg);
				var tahun=js[0].tahun;
				var bln=js[0].bayar_bulan;
				var type_a=js.t;
				if(type_a==1){
					bln=js[0].ef_bulan;
					tahun=js[0].ef_tahun;
				}			
				switch(parseInt(bln)){
					case 1 : bulan="Januari";
					break;
					case 2 : bulan="Februari";
					break;
					case 3 : bulan="Maret";
					break;
					case 4 : bulan="April";
					break;
					case 5 : bulan="Mei";
					break;
					case 6 : bulan="Juni";
					break;
					case 7 : bulan="Juli";
					break;
					case 8 : bulan="Agustus";
					break;
					case 9 : bulan="September";
					break;
					case 10 : bulan="Oktober";
					break;
					case 11 : bulan="November";
					break;
					case 12 : bulan="Desember";
					break;
				}//switch

				$("#label_terahir").html("Tahun "+tahun+ " Bulan "+bulan);
				if(type_a==1){
					$("#label_terahir").html("Belum pernah membayar sebelumnya || Pembayaran dimulai dari<strong class='text-primary'> Bulan "+bulan+" Tahun "+tahun+"</strong>");
				}
				var byr_bln = parseInt(js[0].bayar_bulan);
				var byr_thn = parseInt(js[0].tahun);
				var max_th=parseInt(js.max_th);
				if(type_a==1){	
					byr_bln=parseInt(js[0].ef_bulan)-1;
					byr_thn=parseInt(js[0].ef_tahun);
				}
				var j=0;
				var total=0;
				
				for (i=1;i<=n;i++){
					byr_bln += 1;
				if(byr_bln>12){byr_bln=1; byr_thn+=1;}
					switch(parseInt(byr_bln)){
					case 1 : bulan="Januari";
					break;
					case 2 : bulan="Februari";
					break;
					case 3 : bulan="Maret";
					break;
					case 4 : bulan="April";
					break;
					case 5 : bulan="Mei";
					break;
					case 6 : bulan="Juni";
					break;
					case 7 : bulan="Juli";
					break;
					case 8 : bulan="Agustus";
					break;
					case 9 : bulan="September";
					break;
					case 10 : bulan="Oktober";
					break;
					case 11 : bulan="November";
					break;
					case 12 : bulan="Desember";
					break;
				}//switch
					for(j=0;j<24;j++){
					
					if(!js.x[j]){alert("Mohon Untuk Tambahkan Tahun Lagi. (Setting->KAS Anggota)");}
						if (js.x[j].tahun == byr_thn && js.x[j].bulan==byr_bln){
							nominal=js.x[j].bayar;
							total+=parseInt(nominal);
						}
					}
					if(max_th >= parseInt(byr_thn)){
						$("#bayar_x").val(i);
						td_bayar += "<tr><td>"+i+"</td><td id='thn_"+i+"'>"+byr_thn+"</td><td id='bln_"+i+"'>"+bulan+"</td><td id='nominal_"+i+"'>"+nominal+"</td><td class='hidden' id='byr_bln_"+i+"'>"+byr_bln+"</td><td><input id='ket_"+i+"' type='text' class=form-control></td></tr>";
					}
				}
				$("#total").html(total);
				$("#pembayaran_ket").removeClass("hide");
				$("#detail").append(td_bayar);
				$("#show_simpan").removeClass("hide");
				
			}//success
		});
		

	});//show
	$("#checkbox").click(function(){
		if($("#checkbox").prop("checked")){
			$("#btn_bayar").prop("disabled",false);
		}else{
			$("#btn_bayar").prop("disabled",true);
		}
	});


$("#btn_bayar").click(function(){
	var bln=$("#bayar_x").val();
	var nik=$("#nik").val();
	var keterangan= new Array();
	var dana= new Array();
	var bb_bulan= new Array();
	j=1;
	for(i=0;i<bln;i++){
		keterangan[i]=$("#ket_"+j).val();
		dana[i]=$("#nominal_"+j).html();
		bb_bulan[i]=$("#byr_bln_"+j).html();
		j++;
	}
	$.ajax({
		url 	: base_url + "administrator/bayar/3",
		typeData: "ajax",
		type 	: "POST",
		data 	: {byk_bayar:bln ,nik_ang:nik, ket_byaran:keterangan,nominal:dana,bayar_bulan:bb_bulan},
		success : function(msg){
			if(msg=='1'){
				$('#notif_judul_isi').html('<i class="fa fa-check fa-lg"></i> Transaksi Berhasil.');
				$('#notif_isi').html('<p>Pembayaran Anggota Telah Berhasil.Terma kasih.</p>');
				$('#notif').css('opacity','0.75');
				$('#notif').fadeIn(100).fadeOut(7000);
				$("#pembayaran_ket").addClass("hide");
				$("#show_simpan").addClass("hide");	
			}

		}
	});//ajax
});
</script>