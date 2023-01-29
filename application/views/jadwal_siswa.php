<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view("partials/head.php"); ?>
</head>
<body>
	<div class="wrapper">
		<div class="main-header">
			<?php $this->load->view("partials/main-header.php") ?>
		</div>

		<!-- Sidebar -->
		<div class="sidebar sidebar-style-2">
			<?php $this->load->view("partials/sidebar.php") ?>
		</div>
		<!-- End Sidebar -->

		<div class="main-panel">
			<div class="content">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Data Jadwal Siswa</h4>
						<ul class="breadcrumbs">
							<li class="nav-home">
								<a href="<?php echo base_url('admin'); ?> ">
									<i class="flaticon-home"></i>
								</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								<a href="<?php echo base_url('jadwal/index_jadwal'); ?>">List Jadwal Siswa</a>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-body">
                                <a href="<?php echo base_url('jadwal') ?>/add_siswa" class="btn btn-primary">Tambah</a>
                                <br/>
                                <br/>
									<div class="table-responsive">
										<table id="add-row" class="display table table-striped table-hover" >
											<thead>
												<tr>
                                                    <th>No</th>
													<th>NIS</th>
													<th>Nama Siswa</th>
													<th>Nama Guru</th>
													<th>Kelas</th>
													<th>Mata Pelajaran</th>
                                                    <th>Waktu</th>
													<th>Action</th>
												</tr>
											</thead>
											<tfoot>
												<tr>
                                                <th>No</th>
													<th>NIS</th>
													<th>Nama Siswa</th>
													<th>Nama Guru</th>
													<th>Kelas</th>
													<th>Mata Pelajaran</th>
                                                    <th>Waktu</th>
													<th>Action</th>
												</tr>
											</tfoot>
											<tbody>
												<?php $no = 1; foreach ($guru as $gu) : ?>
												<tr>
                                                    <td><?php echo $no++ ?></td>
													<td><?php echo $gu->nis; ?></td>
													<td><?php echo $gu->nama; ?></td>
								                    <td><?php echo $gu->nama_guru ?></td>
								                    <td><?php echo $gu->nama_kelas ?></td>
								                    <td><?php echo $gu->nama_mapel ?></td>
								                    <td><?php echo date('d/m/Y H:i:s',strtotime($gu->waktu)) ?></td>
								                    <td><a href="<?php echo base_url('jadwal') ?>/edit_siswa/<?php echo $gu->id_jadwalsiswa ?>" class="btn btn-primary">Edit</a> <a href="<?php echo base_url('jadwal') ?>/hapus1/<?php echo $gu->id_jadwalsiswa ?>" class="btn btn-warning">Hapus</a></td>
												</tr>
												<?php endforeach; ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<footer class="footer">
				<?php $this->load->view("partials/footer.php") ?>
			</footer>
		</div>
		
	</div>
	<?php $this->load->view("partials/footer-js.php") ?>
	<script >
		$(document).ready(function() {

			// Add Row
			$('#add-row').DataTable({
				"pageLength": 5,
			});

			var action = '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';
		});
	</script>
</body>
</html>