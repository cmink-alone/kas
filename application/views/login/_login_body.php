<div class="container-fluid ">
	<div class="bg row padding ">
		<div class="text-center col-sm-12"><h2 class="sha">PEMBUKUAN UANG KAS OUTASK</h2></div>
	</div>


	<div class="row ">
		<div class="col-sm-4"></div>
		<div class=" col-sm-4 text-center pannel-group">
			<div class="panel p-c">
				<div class="panel-heading"><span id="judul" style="font-size:22px">L O G I N </span></div>
				<div class="panel-body">
					<form id="form_login">
						<table  width="100%">
						<tr>
							<td style="width:120px">
								<label class="label-control col-sm"> NIK </label>
							</td>
							<td>
								<input type="text" id="nik" class="form-control">
							</td>
						</tr>

						<tr>
							<td>
								<br>
								<label class="label-control col-sm"> Password </label>
								
							</td>
							<td>
								<input type="password" id="pass"   class="form-control">
							</td>
						</tr>
						<tr>
							<td colspan="2" class="text-center">
								<br>
								<button style="width:120px" id="btn_login" type="button" class="btn btn-primary ">Login</button>
							</td>
						</tr>
						
							<td colspan="2" class="text-right"></td>
						</table>

					</form>
					<form id="form_lupa" class="hidden">
						<table  width="100%">
						<tr>
							<td style="width:120px">
								<label class="label-control col-sm"> NIK </label>
							</td>
							<td>
								<input type="text" class="form-control">
							</td>
						</tr>

						<tr>
							<td>
								<br>
								<label class="label-control col-sm"> Email </label>
								
							</td>
							<td>
								<input type="email"   class="form-control">
							</td>
						</tr>
						<tr>
							<td colspan="2" class="text-center">
								<br>
								<button style="width:120px" type="button" class="btn btn-primary ">Kirim</button>
							</td>
						</tr>
						
							<td colspan="2" class="text-right"></td>
						</table>

					</form>
					<hr class="l-s">
					<a id="l_lupa" class="hov">Lupa Password</a>
					<a id="l_login"  class="hov hidden">Login</a>
				</div>
			</div>
		</div>
		<div class="col-sm-4"></div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="token" role="dialog">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header btn-warning text-center"><h4>T.O.K.E.N</h4></div>
				<div class="modal-body text-center">
					<div id="notoken" class="form-control"></div>
					<input id="your_token" type="password" placeholder="Masukan verifikasi token"  class="m-5-t text-center text-danger form-control">

					<button  id="btn-kirim" class="btn btn-warning m-10-t btn-sm"><i class="fa fa-paper-plane-o"></i> Kirim
</button>
				</div>
				<div class="modal-fotter"></div>
			</div>
		</div>
	</div>
	<button id='x' hidden data-toggle="modal" data-target="#token"></button>
	<!-- end modal-->
</div><!--container-->
