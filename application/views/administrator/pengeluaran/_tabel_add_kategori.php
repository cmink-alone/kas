<div class='well grs-hijau'>
	<div class='input-group'>
		<span class='input-group-addon'><i id="icon_cari" class='fa fa-search'></i></span>
		<input type='text' id="kat_cari" class='form-control' placeholder='Cari kategori' style='width:400px'>
		<div class="text-right"><i id="refresh" class="fa fa-refresh pg text-primary"></i></div>
	</div>
	<br>
	<table class='table table-bordered' id='isi_kat'>
		<thead>
			<tr>
				<th>No</th>
				<th>Kategori</th>
				<th>Dana</th>
				<th>Keterangan</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody id="isi">

		<?php $i=1;foreach ($isi as $d) {;?>
			<tr id='tr<?php echo $i;?>'>
				<td><?php echo $i;?></td>
				<td id='k<?php echo $d["id_kat_pengeluaran"];?>'><?php echo $d["nama_kategori"];?></td>
				<td id='d<?php echo $d["id_kat_pengeluaran"];?>'><?php echo number_format($d["pengeluaran"]);?></td>
				<td id='ket<?php echo strtoupper($d["id_kat_pengeluaran"]);?>'><?php echo ($d["keterangan"]);?></td>
				<td><i data-toggle='modal' data-target='#m_edit' onclick="f_id(<?php echo $i;?>,<?php echo $d["id_kat_pengeluaran"];?>)"  class="fa text-primary fa-pencil-square-o  pg"> Edit</i>  |  	<i data-toggle="modal" data-target="#m_delet" onclick="del_kat(<?php echo $i;?>,<?php echo $d["id_kat_pengeluaran"];?>)" class="fa fa-times text-danger pg"> Hapus</i> </td>
			</tr>
	<?php $i++;}?>
		</tbody>
	</table>
</div>
<input  id='baris' type="hidden" value="<?php echo $i;?>">