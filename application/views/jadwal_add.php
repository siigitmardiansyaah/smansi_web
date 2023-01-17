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
								<h2 class="text-white pb-2 fw-bold">Tambah Jadwal Guru</h2>
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
										<h4 class="card-title">Informasi Jadwal</h4>
									</div>
								</div>
								<div class="card-body">
									<form method="POST" action="<?php echo base_url('jadwal/store') ?>">
									<div class="row">
										<div class="col">
											<div class="form-group">
												<label>NIP Guru</label>
                                                <select name="nip" id="nip" class="form-control">
                                                    <option value="">Pilih Guru</option>
                                                    <?php foreach ($guru as $ke) : ?>
                                                        <option value="<?php echo $ke->nip ?>"><?php echo $ke->nama_guru ?></option>
                                                    <?php endforeach; ?>
                                                </select>											
                                            </div>
                                            <div class="form-group">
												<label>Kelas</label>
                                                <select name="id_kelas" id="id_kelas" class="form-control">
                                                    <option value="">Pilih Kelas</option>
                                                    <?php foreach ($kelas as $ke) : ?>
                                                        <option value="<?php echo $ke->id_kelas ?>"><?php echo $ke->nama_kelas ?></option>
                                                    <?php endforeach; ?>
                                                </select>
											</div>
                                            <div class="form-group">
												<label>Mata Pelajaran</label>
                                                <select name="id_mapel" id="id_mapel" class="form-control">
                                                    <option value="">Pilih Mata Pelajaran</option>
                                                    <?php foreach ($mapel as $ke) : ?>
                                                        <option value="<?php echo $ke->id_mapel ?>"><?php echo $ke->nama_mapel ?></option>
                                                    <?php endforeach; ?>
                                                </select>
											</div>

                                            <div class="form-group">
												<label>Waktu Pelajaran</label>
                                                <input type="datetime-local" name="waktu" class="form-control">
											</div>
											</div>
										<div class="col">
											<div class="form-group float-right">
												<button type="submit" value="Kirim" name="btnUbah" class="btn btn-primary">Ubah</button>
												<span style="padding: 5px"></span>
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