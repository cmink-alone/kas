<?php

		$i=1;
	
		foreach($db as $d){
			
	?>
		<tr>
				<td><?php echo $i;?></td>
				<td id="nik_anggota"><?php echo $d['nik_anggota'];?></td>
				<td id='n<?php echo $d['nik_anggota'];?>'><?php echo $d['nama'];?></td>
				<td id="k<?php echo $d['nik_anggota'];?>"><?php 
						if ($d['keanggotaan']==0){
							echo "<span class='label label-warning'>Pending";
						}elseif($d['keanggotaan']==1){
							echo "<span class='label label-success'>Aktif";
						}elseif($d['keanggotaan']==2){
							echo "<span class='label label-danger'>Non Aktif";
						}?></span>
				</td>
				<td id="t<?php echo $d['nik_anggota'];?>" ><?php echo $d['tanggal'];?></td>
				<td id="e<?php echo $d['nik_anggota'];?>"><?php echo $d['ef_bulan']."-".$d['ef_tahun'];?></td>
				<td id="b<?php echo $d['nik_anggota'];?>">
					<?php
					$nama=str_replace(' ','__',$d['nama']);
						if ($d['keanggotaan']==0 || $d['keanggotaan']==2 ){
							echo 	("<button data-toggle='modal' data-target='#mdl_aktifkan' onclick=data_anggota('".$d['nik_anggota']."','".$nama."') class='btn btn-primary btn-sm'>
									<i class='fa fa-power-off'></i> Aktifkan</button>");}
						elseif($d['keanggotaan']==1){
							echo "<a data-toggle='modal'  class='btn btn-danger btn-sm' onclick=data_anggota('".$d['nik_anggota']."','".$nama."')  data-target='#mdl_nokaktif'><i class='fa fa-power-off'></i> Non Akftikan</a>";
						}
						
					?>
				</td>
			</tr>
	<?php $i++;};?>
			
