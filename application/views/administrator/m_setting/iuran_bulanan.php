<div class="well grs-hijau ">
	<fieldset>
		<legend>Besaran KAS Anggota Perbulan2</legend>
		<div class="form-group form-inline">
		<label> Pilih Tahun</label>
			<select id="menu_tahun" class="form-control">
			<?php foreach ($tahun as $d) {
				echo "<option>".$d['tahun']."</option>";
			}?>
				
			</select>
			<span class="alert alert-success">

   Add Tahun <strong id="isi_tahun"><?=$max?></strong> <button id="add_tahun" class="btn btn-primary btn-xs">Add</button>

</span>
		</div>
		<table class="table table-bordered">
			<thead>
		
				<tr >
					<th id="th_1" class="text-center">Januari</th>
					<th  id="th_2" class="text-center">Februari</th>
					<th  id="th_3" class="text-center">Maret</th>
					<th  id="th_4" class="text-center">April</th>
					<th  id="th_5" class="text-center">Mei</th>
					<th  id="th_6" class="text-center">Juni</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td id="ui_td1"  onmouseout="hide_fa(1)" onmousemove="show_fa(1)" >
							<span class="input-group-addon no_bak">
								<input id="in_bln1" type="text" readonly value="<?=$db_bulan[0]['bayar'];?>" class="in_bul"><i  typ="0"  onclick="fa_click(1)" id="ui_fa_1" class="fa fa-pencil-square-o  fac fa_hide"></i>
							</span>
					</td>
					<td id="ui_td2"  onmouseout="hide_fa(2)" onmousemove="show_fa(2)" >
							<span class="input-group-addon no_bak">
								<input id="in_bln2" type="text" readonly value="<?=$db_bulan[1]['bayar']?>" class="in_bul"><i  typ="0"  onclick="fa_click(2)" id="ui_fa_2" class="fa fa-pencil-square-o  fac fa_hide"></i>
							</span>
					</td>
					<td id="ui_td3"  onmouseout="hide_fa(3)" onmousemove="show_fa(3)" >
							<span class="input-group-addon no_bak">
								<input id="in_bln3" type="text" readonly value="<?=$db_bulan[2]['bayar']?>" class="in_bul"><i  typ="0"  onclick="fa_click(3)" id="ui_fa_3" class="fa fa-pencil-square-o  fac fa_hide"></i>
							</span>
					</td>
					<td id="ui_td4"  onmouseout="hide_fa(4)" onmousemove="show_fa(4)" >
							<span class="input-group-addon no_bak">
								<input id="in_bln4" type="text" readonly  value="<?=$db_bulan[3]['bayar']?>" class="in_bul"><i  typ="0"  onclick="fa_click(4)" id="ui_fa_4" class="fa fa-pencil-square-o  fac fa_hide"></i>
							</span>
					</td>
					<td id="ui_td5"  onmouseout="hide_fa(5)" onmousemove="show_fa(5)" >
							<span class="input-group-addon no_bak">
								<input id="in_bln5" type="text" readonly  value="<?=$db_bulan[4]['bayar']?>" class="in_bul"><i  typ="0"  onclick="fa_click(5)" id="ui_fa_5" class="fa fa-pencil-square-o  fac fa_hide"></i>
							</span>
					</td>
					<td id="ui_td6"  onmouseout="hide_fa(6)" onmousemove="show_fa(6)" >
							<span class="input-group-addon no_bak">
								<input id="in_bln6" type="text" readonly value="<?=$db_bulan[5]['bayar']?>" class="in_bul"><i  typ="0"  onclick="fa_click(6)" id="ui_fa_6" class="fa fa-pencil-square-o  fac fa_hide"></i>
							</span>
					</td>

				</tr>
			</tbody>
		</table>
		
		<table class="table table-bordered">
			<thead>
		
				<tr >
					<th  id="th_7" class="text-center">Juli</th>
					<th  id="th_8" class="text-center">Agustus</th>
					<th  id="th_9" class="text-center">September</th>
					<th  id="th_10" class="text-center">Oktober</th>
					<th  id="th_11" class="text-center">November</th>
					<th  id="th_12" class="text-center">Desember</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td id="ui_td7"  onmouseout="hide_fa(7)" onmousemove="show_fa(7)" >
							<span class="input-group-addon no_bak">
								<input id="in_bln7" type="text" readonly  value="<?=$db_bulan[6]['bayar']?>" class="in_bul"><i  typ="0"  onclick="fa_click(7)" id="ui_fa_7" class="fa fa-pencil-square-o  fac fa_hide"></i>
							</span>
					</td>
					<td id="ui_td8"  onmouseout="hide_fa(8)" onmousemove="show_fa(8)" >
							<span class="input-group-addon no_bak">
								<input id="in_bln8" type="text" readonly  value="<?=$db_bulan[8]['bayar']?>"class="in_bul"><i  typ="0"  onclick="fa_click(8)" id="ui_fa_8" class="fa fa-pencil-square-o  fac fa_hide"></i>
							</span>
					</td>
					<td id="ui_td9"  onmouseout="hide_fa(9)" onmousemove="show_fa(9)" >
							<span class="input-group-addon no_bak">
								<input id="in_bln9" type="text" readonly  value="<?=$db_bulan[8]['bayar']?>"class="in_bul"><i  typ="0"  onclick="fa_click(9)" id="ui_fa_9" class="fa fa-pencil-square-o  fac fa_hide"></i>
							</span>
					</td>
					<td id="ui_td10"  onmouseout="hide_fa(10)" onmousemove="show_fa(10)" >
							<span class="input-group-addon no_bak">
								<input id="in_bln10" type="text" readonly  value="<?=$db_bulan[9]['bayar']?>" class="in_bul"><i  typ="0"  onclick="fa_click(10)" id="ui_fa_10" class="fa fa-pencil-square-o  fac fa_hide"></i>
							</span>
					</td>
					<td id="ui_td11"  onmouseout="hide_fa(11)" onmousemove="show_fa(11)" >
							<span class="input-group-addon no_bak">
								<input id="in_bln11" type="text" readonly  value="<?=$db_bulan[10]['bayar']?>" class="in_bul"><i  typ="0"  onclick="fa_click(11)" id="ui_fa_11" class="fa fa-pencil-square-o  fac fa_hide"></i>
							</span>
					</td>
					<td id="iu_td1"  onmouseout="hide_fa(12)"   onmousemove="show_fa(12)"  >
							<span class="input-group-addon no_bak">
								<input id="in_bln12" type="text" readonly  value="<?=$db_bulan[11]['bayar']?>" class="in_bul"><i  typ="0"  typ="0" onclick="fa_click(12)" disabled="true" id="ui_fa_12" class="fa fa-pencil-square-o  fac fa_hide"></i>
							</span>
					</td>

				</tr>
			</tbody>
		</table>	
	</fieldset>
</div>

<script type="text/javascript" language="javascript">
var index="";
var pola=/^[0-9]+$/;
$(document).ready($("#menu_tahun").val(<?=$aktif?>));


function show_fa(a){
	$("#ui_fa_"+a).removeClass("fa_hide");	
}
//

function hide_fa(b){
	
	var typ3 = $("#ui_fa_"+b).attr("typ");
	if(typ3=='0'){
		$("#ui_fa_"+b).addClass("fa_hide");
	}
}

function fa_click(index){
	var typ = $("#ui_fa_"+index).attr("typ");
	
	if(typ=='0'){
		$("#in_bln"+index).addClass("text-primary");
		$("#in_bln"+index).prop("readonly",false);
		$("#iu_td"+index).prop("onmouseout","0");
		$("#ui_fa_"+index).addClass("text-primary");
		$("#ui_fa_"+index).addClass("fa-floppy-o");
		$("#ui_fa_"+index).removeClass("fa_hide");
		$("#ui_fa_"+index).attr("typ","3");
	}else if(typ=='1'){
		$("#in_bln"+index).val('');
		$("#in_bln"+index).focus();
		$("#ui_fa_"+index).removeClass("fa_hide");

	}else if(typ=='3'){ 
		var tahun = $("#menu_tahun").val();
		var bulan= $("#th_"+index).html();
		var bayaran = $("#in_bln"+index).val();
		$.ajax({
				url		: base_url +"administrator/update_kas_anggota",
				type	: "POST",
				data	: {bulan : index, bayaran :bayaran,tahun:tahun },
				success : function(msg){
						if (msg==1){
							$('#notif_judul_isi').html('<i class="fa fa-check fa-lg"></i> Sukses.');
							$('#notif_isi').html('<p>Data sudah diperbarui.</p>');
							$('#notif').css('opacity','0.70');
							$('#notif').fadeIn(2000,function(){
								$('#notif').fadeOut('slow');
							});
						}
				}
			});

		$("#in_bln"+index).removeClass("text-primary");
		$("#in_bln"+index).prop("readonly",true);
		$("#ui_fa_"+index).attr("typ","0");
		$("#ui_fa_"+index).removeClass("text-primary");
		$("#ui_fa_"+index).addClass("fa_hide");
		$("#ui_fa_"+index).removeClass("fa-floppy-o");
		$("#iu_td"+index).prop("onmouseout","hide_fa("+index+")");
	}

	$("#in_bln"+index).keyup(function(){
		var e_dana=$("#in_bln"+index).val();
		var typ2 = $("#ui_fa_"+index).attr("typ");
		var cek= pola.test(e_dana);

		if(!cek && (typ2=='3' || typ2=='1')){
			$("#in_bln"+index).addClass("text-danger");
			$("#ui_fa_"+index).addClass("fa-times-circle-o");
			$("#ui_fa_"+index).removeClass("fa-floppy-o");
			$("#ui_fa_"+index).addClass("text-danger");
			$("#ui_fa_"+index).attr("typ","1");
			
		}else if(cek &&(typ2=='3' || typ2=='1')) {
		
			$("#in_bln"+index).removeClass("text-danger");
			$("#ui_fa_"+index).removeClass("fa-times-circle-o");
			$("#ui_fa_"+index).addClass("fa-floppy-o");
			$("#ui_fa_"+index).removeClass("text-danger");
			$("#ui_fa_"+index).addClass("text-primary");
			$("#ui_fa_"+index).attr("typ","3");
	
		}
	});

}

////
$("#add_tahun").click(function(){
	var tmb_thn=parseInt($("#isi_tahun").html());
	var op='<option>'+tmb_thn+'</option>';
	$("#menu_tahun").append(op);
	$("#isi_tahun").html(tmb_thn+1);
	$.ajax({
		url 	: base_url +"administrator/add_tahun",
		data 	: {tahun:tmb_thn},
		type 	: "post",
		success : function(msg){
			if (msg==1){
				$('#notif_judul_isi').html('<i class="fa fa-check fa-lg"></i> Sukses.');
				$('#notif_isi').html('<p>Data sudah ditambahkan.</p>');
				$('#notif').css('opacity','0.70');
				$('#notif').fadeIn(2000,function(){
					$('#notif').fadeOut('slow');
				});
			}
		}
	});
});	

//
$("#menu_tahun").change(function(){
	$.ajax({
		url 	: base_url + "administrator/ambil_bulanan",
		type	: "post",
		datatype: "json",
		data	:{tahun:$("#menu_tahun").val()},
		success : function(msg){
			 js = JSON.parse(msg);
			$("#in_bln1").val(js[0].bayar);
			$("#in_bln2").val(js[1].bayar);
			$("#in_bln3").val(js[2].bayar);
			$("#in_bln4").val(js[3].bayar);
			$("#in_bln5").val(js[4].bayar);
			$("#in_bln6").val(js[5].bayar);
			$("#in_bln7").val(js[6].bayar);
			$("#in_bln8").val(js[7].bayar);
			$("#in_bln9").val(js[8].bayar);
			$("#in_bln10").val(js[9].bayar);
			$("#in_bln11").val(js[10].bayar);
			$("#in_bln12").val(js[11].bayar);

		}
	});

});
</script>