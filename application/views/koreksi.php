<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view('partials/head.php') ?>
</head>
<body>
	<div class="wrapper">
		<div class="main-header">
			<?php $this->load->view('partials/main-header.php') ?>
		</div>

		<!-- Sidebar -->
		<div class="sidebar sidebar-style-2">
			<?php $this->load->view('partials/sidebar.php') ?>
		</div>
		<!-- End Sidebar -->

		<div class="main-panel">
			<div class="content">
				<div class="panel-header bg-primary-gradient">
					<div class="page-inner py-5">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
								<h2 class="text-white pb-2 fw-bold">Koreksi Kehadiran Siswa</h2>
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner mt--5">
					<div class="row row-card-no-pd">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-head-row card-tools-still-right">
										<h4 class="card-title">Koreksi Kehadiran Siswa</h4>
									</div>
									<p class="card-category">
									Memperbarui Absensi Siswa.</p>
								</div>
								<div class="card-body">
									<form method="POST" action="<?php echo base_url('koreksi_absen/update') ?>">
									<div class="row">
										<div class="col">
											<div class="form-group">
												<label>Nama Siswa</label>
													<input type="text" class="form-control" name="nama" value="<?php echo $siswa->nama; ?>" readonly="readonly" />
                                                    <input type="hidden" class="form-control" name="id_siswa" value="<?php echo $siswa->id_siswa; ?>" readonly="readonly" />
											</div>
											<div class="form-group">
												<label for="exampleFormControlSelect1">Kelas</label>
												<select class="form-control" name="id_jadwal" id="exampleFormControlSelect1">
												<option value="">Pilih Kelas</option>
													<?php foreach ($jadwal as $datajadwal) : ?>
													<option value="<?php echo $datajadwal['id_jadwal']; ?>" ><?php echo $datajadwal['nama_mapel'].' - '.$datajadwal['nama_kelas']; ?></option>
													<?php endforeach; ?>
												</select>
											</div>
											</div>
										<div class="col">
											<div class="form-group">
												<label for="password">Pilih Tanggal dan Jam</label>
                                                <input type="text" id="datetimepicker" class="form-control" name="waktu">											
                                            </div>
											<div class="form-group">
												<label for="exampleFormControlSelect1">Keterangan</label>
												<select class="form-control" name="keterangan" id="exampleFormControlSelect1">
													<option value="">Pilih Keterangan</option>
													<option value="Hadir">Hadir</option>
													<option value="Sakit">Sakit</option>
													<option value="Alpha">Alpha</option>
													<option value="Izin">Izin</option>
												</select>
											</div>
											<div class="form-group float-right">
												<button type="submit" value="Kirim" name="btnUbah" class="btn btn-primary">Koreksi</button>
												<span style="padding: 5px"></span>
												<input type="button" class="btn btn-primary btn-border" onclick="location.href='<?php echo base_url(`koreksi_absen`) ?>';" value="Batal">
											</div>
										</div>
									</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<footer class="footer">
				<?php $this->load->view('partials/footer.php'); ?>
			</footer>
		</div>
		
	</div>
	<?php $this->load->view('partials/footer-js.php'); ?>

</body>
</html>