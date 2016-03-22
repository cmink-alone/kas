<div class='konten_tabel'></div>

<script type='text/javascript' language='javascript'>
				var ang ='<?=$db;?>';
				var t_isi= '<?=$isi;?>';
				var telat= '<?=$telat;?>';
				var page = '<?=$js_pg;?>';
				js_page = JSON.parse(page);
				page_now=parseInt(js_page.limit);
				////.......//
				js_isi=JSON.parse(t_isi);
				js_ang=JSON.parse(ang);
				js_telat=JSON.parse(telat);
				var tbl='<h4> Tahun : '+$("#m_menu").val()+'</h4>';
				var sisa =12;
				j=1;
				for(i=0;i<js_ang.length;i++){
					var belum=0;
					var total=0;
					 sisa=12;

					tbl +='<table  class="tbl_'+j+' m_b_0 table  table-bordered ">'+
							'<thead>'+
								'<tr id="'+j+'" class="pg th-nama  btn-success">'+
									'<th colspan="12"><strong id="nama_judul_"'+j+'>'+js_ang[i].nama+' ['+js_ang[i].nik_anggota+']</strong></th>'+
								'</tr>'+
							'</thead>'+
							'<tbody class="th-isi-'+j+' alert-success hide">'+
								'<tr>'+
									'<td>Januari</td>'+
									'<td>Februari</td>'+
									'<td>Maret</td>'+
									'<td>April</td>'+
									'<td>Mei</td>'+
									'<td>Juni</td>'+
									'<td>Juli</td>'+
									'<td>Agustus</td>'+
									'<td>September</td>'+
									'<td>Oktober</td>'+
									'<td>November</td>'+
									'<td>Desember</td>'+
								'</tr>'+
							'<tr>';
						for(n=1;n<=12;n++){
							tbl+= '<td id="bayar_'+i+'_'+n+'"></td>';
						}

					tbl+='</tr>'+
						'<tr>'+
				'<td colspan="3"><strong>TOTAL</strong> </td>'+
				'<td colspan="3" id="total_'+i+'"></td>'+
				'<td colspan="3"><strong id="belum_'+i+'"></strong></td>'+ 
				'<td colspan="3" id="telat_'+i+'"></td>'+
				'</tr>'+
				'</tbody>'+
				'</table>';
					j++;
					
					$('.konten_tabel').append(tbl);
					tbl='';
					//isi
					for(n=0;n<js_isi[i].length;n++){
							index=js_isi[i][n].bayar_bulan;
							$('#bayar_'+i+'_'+index).text(js_isi[i][n].membayar);
							total += parseInt(js_isi[i][n].membayar);

						}
						$('#total_'+i).html(number(total));

					//telat 
					total=0;
					for(n=0;n<js_telat[i].length;n++){
						index=js_telat[i][n].bulan;
						$('#bayar_'+i+'_'+index).html('<span class="label label-danger"><i class="fa fa-calendar-times-o"></i> Belum</span>');
						total += parseInt(js_telat[i][n].bayar);
					}
					$("#telat_"+i).html('Rp. '+number(total));
					$("#belum_"+i).html('Belum membayar [ '+js_telat[i].length+' ] Bulan')
				};//for

				nav='<hr><div class="nav  text-center"><i class="pg kembali fa fa-arrow-left"></i> <span class="p1">'+page_now+'</span> of <span class="p2">'+js_page.total+' </span>Page <i class="selanjutnya pg fa fa-arrow-right"></i></div>';
				$('.konten_tabel').append(nav);
				$('.nav').fadeIn(1);

				if(page_now==1){
					$('.kembali').addClass('fade');
				}else{
					$('.kembali').removeClass('fade');
				}

				if(page_now==js_page.total){
					$('.selanjutnya').addClass('fade');
				}else{
					$('.selanjutnya').removeClass('fade');
				}

	$('.th-nama').click(function(){
		var id=$(this).attr('id');
		$('.th-isi-'+id).fadeToggle(function(){
			$('.th-isi-'+id).removeClass('hide');
		});
	});

	$('.selanjutnya').click(function(){
		page_now=parseInt($('.p1').text());
		console.log(page_now);
		$('#konten_pemasukan').load(base_url + 'administrator/lap_anggota/'+$("#m_menu").val()+'/'+page_now);
	});

	$('.kembali').click(function(){
			page_now=parseInt($('.p1').text())-2;
			$('#konten_pemasukan').load(base_url + 'administrator/lap_anggota/'+$("#m_menu").val()+'/'+page_now);
	});

</script>