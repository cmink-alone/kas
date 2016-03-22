<div class="panel-group" id="accordion">

  <div class="panel panel-warning">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
          Pemasukan Anggota</a>
        </h4>
      </div>
      <div id="collapse1" class="panel-collapse collapse in">
        <div class="panel-body">
          <div class="alert alert-warning form-inline">
            <label class="control-label">Tahun </label>
            <select class="form-control p_t_a"> 
            </select>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Bulan</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody class="p_a_1">
                  
                </tbody>
              </table>
            </div>
            <div class="col-sm-6">
              <table class="table tbl2 table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Bulan</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody class="p_a_2">
                  
                </tbody>
              </table>
            </div>
        </div>
          <div>
              <h4>Total Pemasukan Anggota  Tahun <span class="l_pt_a"></span> : <span class="l_pa_total"></span></h4>
          </div>
        </div>
      </div>
  </div>
  <div class="panel panel-warning">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
        Pemasukan Donasi</a>
      </h4>
    </div>
    <div id="collapse2" class="panel-collapse collapse">
      <div class="panel-body">
        
        <table class="table  table-bordered">
            <thead>
              <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Besaran</th>
                <th>Keterangan</th>
              </tr>
            </thead>
            <tbody class="p_d">
              
            </tbody>
        </table>
          <div>
            <h4>Total Pemasukan Donasi  <span class="l_p_d"></span></h4>
          </div>
      </div>
    </div> 
  </div>
</div>
<script type="text/javascript">
 var ang=JSON.parse('<?=$pem;?>');
 var t_s='<?=$t_s;?>';
 var db_t=JSON.parse('<?=$db_tahun;?>');
 var dn=JSON.parse('<?=$donasi;?>');
var td='';
var jumlah=0;
  for(i=1;i<db_t.length;i++){
    if(db_t[i].tahun==t_s){
        $('.p_t_a').append('<option selected value="'+db_t[i].tahun+'">'+db_t[i].tahun+'</option>');
    }else{
      $('.p_t_a').append('<option value="'+db_t[i].tahun+'">'+db_t[i].tahun+'</option>');
    }
  }
var sisa=ang.length - 5;

    j=1;
    for (i=0;i<ang.length;i++){
      jumlah+=parseInt(ang[i].total);
      td='<tr><td>'+j+++ '</td><td>'+bulan(ang[i].bayar_bulan)+'</td><td>Rp. '+number(ang[i].total)+'</td></tr>';
      $('.p_a_1').append(td);
      td='';
    }

  
 j=6;
 bln=6;
  for (i=0;i<sisa;i++){
    jumlah+=parseInt(ang[i].total);
    td='<tr><td>'+ ++j +'</td><td>'+bulan(j)+'</td><td>Rp. '+number(ang[bln].total)+'</td></tr>';
    $('.p_a_2').append(td);
    td='';
    ++bln;
  }

  $('.l_pa_total').html('Rp. '+number(jumlah));
  $('.l_pt_a').html($('.p_t_a').val());

  $('.p_t_a').change(function(){
    $.ajax({
      url   : base_url +'user/pemasukan_ang_update/'+$('.p_t_a').val(),
      type  : 'post',
      beforeSend:function(){
        $('.l_pt_a').html($('.p_t_a').val());
        $('.l_pa_total').html('');
        $('.p_a_1').text(' ');
        $('.p_a_2').text(' ');
      },
        typeData:"JSON",
        success:function(msg){
            var jumlah=0;
            ang=JSON.parse(msg);
            j=1;
            for (i=0;i<6;i++){
              jumlah+=parseInt(ang[i].total);
              td='<tr><td>'+j+++ '</td><td>'+bulan(ang[i].bayar_bulan)+'</td><td>Rp. '+number(ang[i].total)+'</td></tr>';
              $('.p_a_1').append(td);
              td='';
            }
            var sisa=ang.length - 6;

            j=6;
            var bln=6;
            var k=6;
            for (i=0;i<sisa;i++){
              jumlah+=parseInt(ang[k].total);
              td='<tr><td>'+ ++j +'</td><td>'+bulan(parseInt(ang[k].bayar_bulan))+'</td><td>Rp. '+number(ang[k].total)+'</td></tr>';
              $('.p_a_2').append(td);
              td='';
              ++k;
              ++bln;
            }
            $('.l_pa_total').html('Rp. '+number(jumlah));
            $('.l_pt_a').html($('.p_t_a').val());
      }
    });//ajax
  });

  //////// donasi
    j=1;
   jumlah=0;
  for(i=0;i<dn.length;i++){
    jumlah+=parseInt(dn[i].donasi);
    $('.p_d').append('<tr><td>'+ ++j +'</td><td>'+dn[i].tanggal+'</td><td>'+dn[i].nama+'</td><td>'+dn[i].alamat+'</td><td>Rp '+number(dn[i].donasi)+'</td><td>'+dn[i].keterangan+'</td></tr>')
  }
  $('.l_p_d').html('Rp '+number(jumlah));
</script>