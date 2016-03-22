<div class='col-md-4'>
    <section class="panel">
        <header class="panel-heading">Belum Bayar </header>
  		      	<div class="telat_bayar panel-body scroll" id="noti-box">
  		      	</div>
	</section>
</div>


<script language='javascript'>
    var telat= JSON.parse('<?=$telat;?>');
    for (i=0;i<telat.length;i++){
        $('.telat_bayar').append('<div class="alert alert-block alert-danger"><strong>'+bulan(telat[i].bulan)+' ' +telat[i].tahun+'</strong> Anda Belum bayar</div>');
    }

</script>