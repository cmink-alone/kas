	function number(isi2){
		if(isi2==null){
			isi2=0;
		}
		var str=isi2.toString();
		var key=1;
		var hasil='';
		var n = str.length - 1;
		var a_num = Array();
		for (ul=n;ul >= 0; --ul){
			if(key==4){
				a_num[ul]= str.charAt(ul)+'.';
				key=1;
			}else{
				a_num[ul]=str.charAt(ul);
			}
			key++;
		}

		for (ul=0;ul<str.length;++ul){
			hasil+=a_num[ul];
		}

		return hasil;
	}
