<div class="col-md-8">
                            <section class="panel">
								<header class="panel-heading">
                                  Pembayaran 10 Terahir Anda
                            </header>
								<div class="panel-body table-responsive">
                                <table class="table table-hover">
                                  <thead>
                                    <tr>
                                      <th>NO</th>
                                      <th>Waktu Pembayaran</th>
                                      <th>Pembayaran</th>
                                      <th>Dana</th>
                                      <th>Keterangan</th>
                                     
                                  </tr>
								</thead>
								<tbody class="pembayaran_10">								
								</tbody>
							</table>
						</div>
							</section>
						</div>

<script language='javascript'>
	var bayar= JSON.parse('<?=$bayar;?>');
	
	var j=1;

	for (i=0;i<bayar.length;i++){
		$('.pembayaran_10').append('<tr><td>'+j+++'</td><td>'+bayar[i].tanggal_bayar+'</td><td>'+bulan(bayar[i].bayar_bulan)+' '+bayar[i].tahun+'</td><td>Rp. '+number(bayar[i].membayar)+'</td><td>'+bayar[i].keterangan+'<td></tr>');
	}


</script>