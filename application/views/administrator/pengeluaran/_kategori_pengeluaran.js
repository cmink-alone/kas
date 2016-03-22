<script type="text/javascript">
var pub_btn='0';
$("#dana").keyup(function(){
	var pola =/^[0-9]+$/;
	var d = $("#dana").val();
	var cek=pola.test(d);
	if(!cek){
			pub_btn='0';		
			$("#dana").addClass('btn-danger');
			$("#add_kategori").prop("disabled",true);
	}else{
			$("#dana").removeClass('btn-danger');
			pub_btn='1';
			if( $("#kategori").val() !=''){
				$("#add_kategori").prop("disabled",false);
			}
		}
	});

$("#add_kategori").click(function(){
	kategori=$('#kategori').val().toUpperCase();
	dana=$("#dana").val().toUpperCase();
	tr=$("#baris").val().toUpperCase();
	if(kategori!='' && dana!=''){
		$.ajax({
			url 		: base_url + 'administrator/add_kategori',
			typeData: 'json',
			type  	: 'POST',
			data 	: 'nama='+kategori+'&pengeluaran='+dana+"&keterangan="+$("#keterangan").val(),
			success: function(msg){
				if(msg){
					js=JSON.parse(msg);
				
					//tabel baru//
						var tr_baru="<tr id='tr"+tr+"'>"+
										"<td>"+tr+"</td>"+
										"<td id='k"+js.id_kat_pengeluaran+"''>"+js.nama_kategori.toUpperCase()+"</td>"+
										"<td id='d"+js.id_kat_pengeluaran+"'>"+js.pengeluaran.toUpperCase()+"</td>"+
										"<td id='ket"+js.id_kat_pengeluaran+"'>"+js.keterangan.toUpperCase()+"</td>"+
										"<td><i data-toggle='modal' data-target='#m_edit' onclick='f_id("+tr+","+js.id_kat_pengeluaran.toUpperCase()+")'  class='fa text-primary fa-pencil-square-o  pg'> Edit</i>  |  	<i data-toggle='modal' data-target='#m_delet' onclick='del_kat("+tr+","+js.id_kat_pengeluaran+")' class='fa fa-times text-danger pg'> Hapus</i></td>"+
									"</tr>";

					//tabel_baru//
					$("#isi").append(tr_baru);
					$("#baris").val(parseInt(tr)+1);
					$('#notif_judul_isi').html('<i class="fa fa-check fa-lg"></i> Sukses.');
					$('#notif_isi').html('<p>Data sudah ditambahkan.</p>');
					$('#notif').css('opacity','0.70');
					$('#notif').fadeIn(2000,function(){
						$('#notif').fadeOut('fast');
					});
						
				}
			}//sukses
			});//ajax
	}else{
		$('#notif_judul_isi').html('<i class="fa fa-exclamation-triangle fa-lg"></i> Gagal.');
		$('#notif_isi').html('<p>Data tidak boleh ada yang kosong.</p>');
		$('#notif').css('opacity','0.70');
		$('#notif').fadeIn(500,function(){
			$('#notif').fadeOut('slow');
		});
	}});

function f_id(a,b){
	kategori=$("#k"+b).html();
	dana=$("#d"+b).html();
	dana=dana.replace(/,/g,'');
	$("#in_kat").val(kategori);
	$("#in_dana").val(dana);
	$("#e_id").val(b);
	ket=$("#ket"+b).html();
	$("#in_ket").html(ket);	
	$("#in_dana").removeClass('btn-danger');
	$("#in_kat").removeClass('btn-danger');}

function del_kat(a,b){
	$("#nama_del_kat").html($("#k"+b).html());
	$("#in_del_id").val(b);
	$("#in_del_no").val(a);
}//functioan

$("#btn_hapus").click(function()
		$.ajax({
			url 	: base_url+"administrator/delete_kategori",
			data 	: "id="+$("#in_del_id").val(),
			type 	: "post",
			success : function(msg){
				$("#tr"+$("#in_del_no").val()).fadeOut(1000);
			}
		})
	);//click

$("#btn_edit").click(function(){
	$.ajax({
		url 	: base_url+'administrator/edit_kategori',
		data 	: $("#form_edit").serialize(),
		type 	: "POST",
		cache	: "false",
		success : function(msg){
			var data= JSON.parse(msg)
			id=data.id_kat_pengeluaran;
			$("#ket"+id).html(data.keterangan.toUpperCase());
			$("#k"+id).html(data.nama_kategori.toUpperCase());
			$("#d"+id).html(data.pengeluaran.toUpperCase());
			$('#notif').css('opacity','0.80');
			$('#notif').fadeIn(202,function(){
					$("#notif").fadeOut(7000);
			});
			$('#notif_judul_isi').html('<i class="fa fa-check fa-lg"></i> Sukses.');
			$('#notif_isi').html('<p>Data sudah berhasil diperbarui.</p>');
		}
	});
});

$("#in_kat").keyup(function(){
	cek_edit(1);
});

$("#in_dana").keyup(function(){
	cek_edit(1);
});


function cek_edit(a){
	var kategori=$("#in_kat");
	var dana=$("#in_dana");
	var pola=/^[0-9]+$/;	
	var angka=pola.test(dana.val());
	if(a==1){
		if(kategori.val()=='' || angka==false ){
			$("#btn_edit").prop("disabled",true);
			
			if(angka==false){
				dana.addClass('btn-danger');
			}else{
				dana.removeClass('btn-danger');
			}

			if(kategori.val()==''){
				kategori.addClass('btn-danger');
			}else{
				kategori.removeClass('btn-danger');
			}
		}else{
			$("#btn_edit").prop("disabled",false);
			if(angka==true){
				dana.removeClass('btn-danger');
			}
			if(kategori.val()!=''){
				kategori.removeClass('btn-danger');
			}}
	}
}
$("#kat_cari").keyup(function(tr=''){
	cari=$("#kat_cari").val().toUpperCase();
	if(cari!=''){url_p=base_url+'administrator/cari_kategori';$("#icon_cari").addClass("text-primary");}else{url_p=base_url+'administrator/cari_kategori/1';$("#icon_cari").removeClass("text-primary");}
	
		$.ajax({
			url 	: url_p,
			data    :"cari="+cari,
			type 	: "post",
			success : function(msg){
			js=JSON.parse(msg);
				j=1;
				for(i=0;i<js.length;i++){
					 tr +="<tr id='tr"+j+"'><td>"+j+"</td><td id='k"+js[i].id_kat_pengeluaran+"'>"+js[i].nama_kategori+
					 "</td><td  id='d"+js[i].id_kat_pengeluaran+"'>"+js[i].pengeluaran+
					 "</td><td id='ket"+js[i].id_kat_pengeluaran+"'>"+js[i].keterangan+"</td><td><i data-toggle='modal' data-target='#m_edit' onclick='f_id("+j+","+js[i].id_kat_pengeluaran.toUpperCase()+")'  class='fa text-primary fa-pencil-square-o  pg'> Edit</i>  |  	<i data-toggle='modal' data-target='#m_delet' onclick='del_kat("+j+","+js[i].id_kat_pengeluaran+")' class='fa fa-times text-danger pg'> Hapus</i></td><tr>";
				 		j++;
				}
				$("#isi").html(tr);
			}
		})//ajax
	
});
$("#refresh").click(function(){
	url_p=base_url+'administrator/cari_kategori/0';
		$.ajax({
			url 	: url_p,
			type 	: "post",
			data 	: "cari=",	
			success : function(msg){
			js=JSON.parse(msg);
		
				j=1;
				var tr='';
				for(i=0;i<js.length;i++){
					 tr +="<tr id='tr"+j+"'><td>"+j+"</td><td id='k"+js[i].id_kat_pengeluaran+"'>"+js[i].nama_kategori+
					 "</td><td  id='d"+js[i].id_kat_pengeluaran+"'>"+js[i].pengeluaran+
					 "</td><td id='ket"+js[i].id_kat_pengeluaran+"'>"+js[i].keterangan+"</td><td><i data-toggle='modal' data-target='#m_edit' onclick='f_id("+j+","+js[i].id_kat_pengeluaran.toUpperCase()+")'  class='fa text-primary fa-pencil-square-o  pg'> Edit</i>  |  	<i data-toggle='modal' data-target='#m_delet' onclick='del_kat("+j+","+js[i].id_kat_pengeluaran+")' class='fa fa-times text-danger pg'> Hapus</i></td><tr>";
				 		j++;
				}
				$("#isi").html(tr);
		
			}
		})//ajax
});


$("#kategori").keyup(function(){
	if( $("#kategori").val()!='' && pub_btn=='1'){
		$("#add_kategori").prop("disabled", false);

	}else{
		$("#add_kategori").prop("disabled", true);
	}
	
});
</script>