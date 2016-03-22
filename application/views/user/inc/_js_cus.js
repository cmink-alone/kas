<script language='javascript'>
var base_url="<?php echo base_url();?>";
$(document).ready(function(){
	$('.in_konten').load(base_url+'user/dashboard');
})
</script>


<script language='javascript'>

var user='<?php echo $user;?>';
var js_user=JSON.parse(user);
$(".nama_user").html(js_user[0].nama);
$(".nik_user").html(js_user[0].nik_anggota);
$('.user_foto').prop("src",base_url+'asset/foto/'+js_user[0].foto);
</script>


