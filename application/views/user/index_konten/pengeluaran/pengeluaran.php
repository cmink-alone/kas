 <div class="panel-group" id="accordion">

  <div class="panel panel-warning">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
        Pengeluaran Anggota</a>
      </h4>
    </div>
    <div id="collapse1" class="panel-collapse collapse in">
      <div class="panel-body">
        <div class="alert alert-warning form-inline">
          <label class="control-label">Tahun </label>
          <select class="form-control p_tahun"> 
          </select>
        </div>
         <table class="table table-bordered">
            <thead>
              <tr>
                <th>No</th>
                <th>Waktu</th>
                <th>Nama</th>
                <th>Keperluan</th>
                <th>Besaran</th>
                <th>Keterangan</th>
              </tr>
            </thead>
            <tbody class="p_i">
              
            </tbody>
        </table>
        <div><h4>Total Pengeluaran Tahun <span class="l_pi_t"></span> : <span class="l_pi_total"></span></h4>
      </div>
      </div>
    </div>
  </div>

  <div class="panel panel-warning">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
        Pengeluaran External</a>
      </h4>
    </div>
    <div id="collapse2" class="panel-collapse collapse">
      <div class="panel-body">
       <div class="alert alert-warning form-inline">
          <label class="control-label">Tahun </label>
          <select class="form-control p_tahun_x"> 
          </select>
        </div>
        <table class="table table-bordered">
            <thead>
              <tr>
                <th>No</th>
                <th>Waktu</th>
                <th>Keperluan</th>
                <th>Besaran</th>
                <th>Keterangan</th>
              </tr>
            </thead>
            <tbody class="p_x">
              
            </tbody>
        </table>
         <div><h4>Total Pengeluaran Tahan <span class="l_pi_t_x"></span> : <span class="l_pi_total_x"></span></h4>
    </div>
  </div>
</div> 

<script type="text/javascript">
  var db_tahun= JSON.parse('<?=$db_tahun?>');
  var t_s = '<?=$t_s;?>';
  var db_pengeluaran =JSON.parse('<?=$db_pengeluaran_i;?>');
  var db_pengeluaran_x=JSON.parse('<?=$db_pengeluaran_x;?>');
  for(i=0;i<db_tahun.length;i++){
    if(db_tahun[i].tahun==t_s){
      $('.p_tahun').append('<option selected value="'+db_tahun[i].tahun+'">'+db_tahun[i].tahun+'</option>');
    }else{
     $('.p_tahun').append('<option value="'+db_tahun[i].tahun+'">'+db_tahun[i].tahun+'</option>');
   }
 }

  //menu tahun ex
  for(i=0;i<db_tahun.length;i++){
    if(db_tahun[i].tahun==t_s){
      $('.p_tahun_x').append('<option selected value="'+db_tahun[i].tahun+'">'+db_tahun[i].tahun+'</option>');
    }else{
     $('.p_tahun_x').append('<option value="'+db_tahun[i].tahun+'">'+db_tahun[i].tahun+'</option>');
   }   
  }
  //isi tabel ex
  var jumlah=0;
  var tb='';
  var j=1;
  for (i=0; i< db_pengeluaran_x.length;i++){
    jumlah += parseInt(db_pengeluaran_x[i].besaran);
    tb='<tr>'+
          '<td>'+j+++'</td>'+
          '<td>'+db_pengeluaran_x[i].tanggal+'</td>'+
          '<td>'+db_pengeluaran_x[i].kategori+'</td>'+
          '<td>Rp. '+number(db_pengeluaran_x[i].besaran)+'</td>'+
          '<td>'+db_pengeluaran_x[i].keterangan+'</td>'+
        '</tr>';
    $('.p_x').append(tb);
    tb='';
  } 
  $('.l_pi_t_x').text($('.p_tahun').val());
  $('.l_pi_total_x').html('Rp. '+number(jumlah));



  var tb='';
  var j=1;
  jumlah=0;
  for (i=0; i< db_pengeluaran.length;i++){
    jumlah+=parseInt(db_pengeluaran[i].besaran);
    tb='<tr>'+
          '<td>'+j+++'</td>'+
          '<td>'+db_pengeluaran[i].tanggal+'</td>'+
          '<td>'+db_pengeluaran[i].nama+'</td>'+
          '<td>'+db_pengeluaran[i].kategori+'</td>'+
          '<td>Rp. '+number(db_pengeluaran[i].besaran)+'</td>'+
          '<td>'+db_pengeluaran[i].keterangan+'</td>'+
        '</tr>';
    $('.p_i').append(tb);
    tb='';
  }
  $('.l_pi_total').html('Rp. '+number(jumlah));

  $('.p_tahun').change(function(){
    $.ajax({
        url   : base_url + 'user/pengeluaran_update/'+$('.p_tahun').val(),
        beforeSend: function(){
          $('.p_i').text('Loading....');
        },
        type  : 'POST',
        tyepData: 'JSON',
        success: function(msg){
           $('.l_pi_t').html($('.p_tahun').val());
           $('.p_i').text('');
          var js = JSON.parse(msg);
          var tb='';
          var j=1;
          jumlah=0;
          for (i=0; i< js.length;i++){
            jumlah += parseInt(js[i].besaran);
            tb='<tr>'+
                  '<td>'+j+++'</td>'+
                  '<td>'+js[i].tanggal+'</td>'+
                  '<td>'+js[i].nama+'</td>'+
                  '<td>'+js[i].kategori+'</td>'+
                  '<td>Rp. '+number(js[i].besaran)+'</td>'+
                  '<td>'+js[i].keterangan+'</td>'+
                '</tr>';
            $('.p_i').append(tb);
            tb='';
          }
          $('.l_pi_total').html('Rp. '+number(jumlah));
         

        }
    })//ajax
  })

   $('.p_tahun_x').change(function(){
    $.ajax({
        url   : base_url + 'user/pengeluaran_update_x/'+$('.p_tahun_x').val(),
        beforeSend: function(){
          $('.p_x').text('Loading....');
        },
        type  : 'POST',
        tyepData: 'JSON',
        success: function(msg){
           $('.l_pi_t_x').html($('.p_tahun_x').val());
           $('.p_x').text('');
          var js_x = JSON.parse(msg);
          var tb='';
          var j=1;
          jumlah=0;
          for (i=0; i< js_x.length;i++){
            jumlah += parseInt(js_x[i].besaran);
            tb='<tr>'+
                  '<td>'+j+++'</td>'+
                  '<td>'+js_x[i].tanggal+'</td>'+
                  '<td>'+js_x[i].kategori+'</td>'+
                  '<td>Rp. '+number(js_x[i].besaran)+'</td>'+
                  '<td>'+js_x[i].keterangan+'</td>'+
                '</tr>';
            $('.p_x').append(tb);
            tb='';
          }
          $('.l_pi_total_x').html('Rp. '+number(jumlah));
         

        }
    })//ajax
  })


</script>