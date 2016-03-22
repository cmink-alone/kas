<script language="javascript">
var base_url="<?php echo base_url();?>";
	$("#l_lupa").click(function(){
		$("#form_login").addClass("hidden");
		$("#form_lupa").removeClass("hidden");
		$("#l_lupa").addClass("hidden");
		$("#l_login").removeClass("hidden");
		$("#judul").html("LUPA PASSWORD");
	});

	$("#l_login").click(function(){
		$("#judul").html("L O G I N");
		$("#form_login").removeClass("hidden");
		$("#form_lupa").addClass("hidden");
		$("#l_lupa").removeClass("hidden");
		$("#l_login").addClass("hidden");
	});

	$("#nik").keyup(function(){
		var pola=/^[0-9]+$/;
		var isi=$("#nik").val();
		var tes=pola.test(isi);
		if(!tes){
			$("#nik").addClass("btn-danger");
		}else{
			$("#nik").removeClass("btn-danger");
		}
	});


	$("#btn_login").click(function(){
		var data= new Array();
		data[0]=$("#nik").val();
		data[1]=$("#pass").val();
		
		if( $("#nik").val()=='' || $("#pass").val()==''){
			alert("ada yang kosong");
		}else{
			if($("#nik").val()=="administrator"){
				
				$.ajax({
					url 	: base_url + "login/admin",
					cache	: false,
					data 	: {data},
					type	: "POST",
					success	 : function(msg){
					
						if(msg.length==4){
							$("#notoken").html(msg);
							$("#x").click();
						}
					}
				});//ajax_admin
			}else{
				alert("user");
				$.ajax({
					url 	: base_url+"login/user",
					data	: {data},
					cache 	: "false",
					typeData: "json",
					type	: "POST",
					success	: function(msg){
						if (msg==1){
							window.location=base_url+"user";
						}else{
							alert("Cek kebali NIK dan Password Anda.");
						}
					}
				});
			}
		}//endif
	});//btn_login;

	

	$("#btn-kirim").click(function(){
		$.ajax({
			url  : base_url+"login/v_token",
			cache: false,
			data :{ver:$("#your_token").val(),tk:$("#notoken").html()},
			type : "POST",
			success: function(msg){
				if(msg=='1'){
						window.location=base_url+ "administrator";
				}else{
					console.log("false");
				}
			}
		})

	});

</script>