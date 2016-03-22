
		<div class="form-inline">
			<label class="label-control">Pilih tahun</label> 
			<select id="m_tahun" style="width:30%" class="form-control ">
			</select>
		</div>
		<br>

		<table class="table table-bordered">
			<thead>
				<th>No</th>
				<th>Bulan</th>
				<th>Ketentuan bayar</th>
				<th>Waktu Pembayaran</th>
				<th class="hidden">Bayar</th>
				<th>Status</th>
				<th>Keterangan</th>
			</thead>
			<tbody>
			<?php for($i=1;$i<13;$i++){?>
				
				<tr id="tr_<?php echo $i;?>">
					<td id="no_<?php echo $i;?>"><?php echo $i;?></td>
					<td id="bln_<?php echo $i;?>"></td>
					<td  id="td_<?php echo $i;?>"></td>
					<td  id="tgl_<?php echo $i;?>"></td>
					<td class="hidden" id="bayar_<?php echo $i;?>"></td>
					<td id="sts_<?php echo $i;?>"></td>
					<td id="ket_<?php echo $i;?>"></td>
				</tr>
				<?php }?>
			</tbody>
		</table>
	</div>

<script type="text/javascript">
var akt='<?=$akt;?>';
akt=JSON.parse(akt);
var telat='<?=$telat;?>';
telat=JSON.parse(telat);
var data='<?=$bulanan;?>';
var bayar='<?=$bayar;?>';
var tahun='<?=$tahun;?>';
var set_tahun="<?=$set_tahun;?>";
$("#bln_1").html("Januari");
$("#bln_2").html("Februari");
$("#bln_3").html("Maret");
$("#bln_4").html("April");
$("#bln_5").html("Mei");
$("#bln_6").html("Juni");
$("#bln_7").html("Juli");
$("#bln_8").html("Agustus");
$("#bln_9").html("September");
$("#bln_10").html("Oktober");
$("#bln_11").html("November");
$("#bln_12").html("Desember");
//telat//
for(i=0;i<telat.length;i++){
	if(akt.sk_tahun==telat[i].tahun){
		$("#sts_"+telat[i].bulan).html("<span class='label label-danger'>Belum Bayar</span>");
	}
}
//
js_tahun= JSON.parse(tahun);
js_set=JSON.parse(data);
if(js_set[0].tahun==akt.sk_tahun){
	$("#tr_"+akt.sk_bulan).addClass("alert-info");
}
if(js_set[0].tahun==akt[0].ef_tahun){
	$("#tr_"+akt[0].ef_bulan).addClass("alert-warning");
	$("#no_"+akt[0].ef_bulan).html(akt[0].ef_bulan+' <i id="gabung" title="Bergabung" class="pg fa fa-flag"></i>');

}

js_bayar=JSON.parse(bayar);
var j=1;
for (i=0;i<js_set.length;i++){
	$("#td_"+j).html(js_set[i].bayar);	
	j++;
}
j=1;
for (i=0;i<js_bayar.length;i++){
	bb=js_bayar[i].membayar;
	tb=js_bayar[i].bayar_bulan;
	tg=js_bayar[i].tanggal_bayar;
	ket=js_bayar[i].keterangan;
	sts=js_bayar[i].status;
	$("#tgl_"+tb).html(tg);
	$("#bayar_"+tb).html(bb);
	$("#ket_"+tb).html(ket);
	$("#sts_"+tb).html(sts); 		

	j++;
}
var t_op="";
for (i=0;i<js_tahun.length;i++){
	if (js_tahun[i].tahun==set_tahun){
		t_op +="<option selected value="+js_tahun[i].tahun+">"+js_tahun[i].tahun+"</option>";
	}else{
		t_op +="<option value="+js_tahun[i].tahun+">"+js_tahun[i].tahun+"</option>";
	}
}
$("#m_tahun").append(t_op);

$("#m_tahun").change(function(){
	$.ajax({
		url		: base_url +"administrator/tab_data_update",
		type	: "POST",
		beforeSend	: function(){
			for(i=1;i<13;i++){
				$("#bayar_"+i).html("-");
				$("#tgl_"+i).html("-");
				$("#ket_"+i).html("-");
				$("#sts_"+i).html("-");			
			}

		},
		data 	: {nik_anggota : $("#nik").val(),tahun: $("#m_tahun").val()},
		typeData: "json",
		success:function(msg){
			j=1;
			var js_up=JSON.parse(msg);
			for(i=0;i<js_up.length;i++){
				bb=js_up[i].membayar;
				tb=js_up[i].bayar_bulan;
				tg=js_up[i].tanggal_bayar;
				ket=js_up[i].keterangan;
				$("#tgl_"+tb).html(tg);
				$("#bayar_"+tb).html(bb);
				$("#ket_"+tb).html(ket);	
				j++;

			}
		}	
	})//ajax 1

	$.ajax({
		url		: base_url +"administrator/tab_data_set_update",
		type	: "POST",
		beforeSend	: function(){
			for(i=1;i<13;i++){
				$("#td_"+i).html("-");
			}

		},
		data 	: {tahun: $("#m_tahun").val()},
		typeData: "json",
		success:function(msg){
			var js_set=JSON.parse(msg);
			j=1;
			for(i=0;i<js_set.length;i++){
				//now
				if(akt.sk_tahun==$("#m_tahun").val() && akt.sk_bulan==j){
					$("#tr_"+j).addClass("alert-info");
				}else{
					$("#tr_"+j).removeClass("alert-info");
				}
				//registrasi
				if(akt[0].ef_tahun==$("#m_tahun").val() && akt[0].ef_bulan==j){
					$("#tr_"+j).addClass("alert-warning");
					$("#no_"+j).html(j+'  <i id="gabung" title="Bergabung" class="pg fa fa-flag"></i>');
				}else{
					$("#tr_"+j).removeClass("alert-warning");
					$("#no_"+j).html(j);
				}

				//telat//

				if(telat.length>i){
					if($("#m_tahun").val()==telat[i].tahun){
						$("#sts_"+telat[i].bulan).html("<span class='label label-danger'>Belum Bayar</span>");
					}
				}
					//

				$("#td_"+j).html(js_set[i].bayar);
				j++;	
			}
		}	
	})//ajax 2

	//telat//
	for(i=0;i<telat.length;i++){
		if($("m_tahun").val()==telat[i].tahun){
			$("#sts_"+telat[i].bulan).html("<span class='label label-danger'>Belum Bayar</span>");
		}
	}
	//

});
</script>
