<div class="modal fade"  id="m_edit" role="dialog">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header text-center"><h4> Edit Kategori Pengeluaran</div>
			<div class="modal-body">
				<form id="form_edit">
					<div class="form-group">
						<label>Kategori</label>
						<input id="in_kat"name='e_kategori' class="form-control">
						<input type="hidden" id="e_id" name='e_id'>
					</div>
					<div class="form-group">
						<label>Dana</label>
						<input id="in_dana" name='e_dana' class="form-control">
					</div>
					<div class="form-group">
						<label>Keterangan</label>
						<textarea id="in_ket" name='e_ket' class="form-control"></textarea> 
					</div>

					<div class="form-group text-center">
						<button type="button" data-dismiss="modal" id="btn_edit" class="btn btn-primary">Simpan</button>
						<button type="button" data-dismiss="modal" class="btn btn-default">Batal</button>
					</div>
				</form>
			</div>
			<div class="modal-footer"></div>
		</div>
	</div>
</div>

<div class="modal fade" id="m_delet" role="dialog">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header text-center"><h4>Hapus Kategori Pengeluaran</h4></div>
			<div class="modal-body">
					<input id="in_del_id" type="hidden">
					<input id="in_del_no" type="hidden">
					<p> Apakah yakin untuk menghapus kategor <span id="nama_del_kat" class='text-danger'> - </span> ?</p>	
				<div class="text-center"><button data-dismiss="modal" id="btn_hapus" class="margin-right btn btn-sm btn-danger ">Hapus</button>  <button data-dismiss="modal" class="margin-left btn btn-default btn-sm">Batal</button></div>
			</div>
			<div class="modal-footer text-center"></div>
		</div>
	</div>
</div>