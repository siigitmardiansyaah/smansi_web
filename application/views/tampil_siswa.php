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
						<h4 class="page-title">List Siswa</h4>
						<ul class="breadcrumbs">
							<li class="nav-home">
								<a href="<?php echo base_url(''); ?> ">
									<i class="flaticon-home"></i>
								</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								<a href="<?php echo base_url('koreksi_absen'); ?>">Koreksi Absen Siswa</a>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-body">
									<div class="table-responsive">
										<table id="add-row" class="display table table-striped table-hover" >
											<thead>
												<tr>
                                                    <th>No</th>
													<th>Nama Siswa</th>
                                                    <th>Mata Pelajaran</th>
													<th>Kelas</th>
                                                    <th>Aksi</th>
												</tr>
											</thead>
											<tfoot>
												<tr>
                                                    <th>No</th>
													<th>Nama Siswa</th>
													<th>Mata Pelajaran</th>
													<th>Kelas</th>
                                                    <th>Aksi</th>
												</tr>
											</tfoot>
											<tbody>
												<?php 
                                                $no = 1;
                                                foreach ($siswa as $datajadwal) : ?>
												<tr>
                                                    <td><?php echo $no ++ ?></td>
													<td><?php echo $datajadwal['nama']; ?></td>
								                    <td><?php echo $datajadwal['nama_mapel']; ?></td>
								                    <td><?php echo $datajadwal['nama_kelas']; ?></td>
                                                    <td><a href='<?php echo base_url()?>koreksi_absen/update_kehadiran/<?php echo $datajadwal['id_siswa'] ?> ' data-toggle='tooltip' title='Koreksi Kehadiran'><i class='fas fa-edit'></i></a></td>
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
			$('#basic-datatables').DataTable({
			});

			$('#multi-filter-select').DataTable( {
				"pageLength": 5,
				initComplete: function () {
					this.api().columns().every( function () {
						var column = this;
						var select = $('<select class="form-control"><option value=""></option></select>')
						.appendTo( $(column.footer()).empty() )
						.on( 'change', function () {
							var val = $.fn.dataTable.util.escapeRegex(
								$(this).val()
								);

							column
							.search( val ? '^'+val+'$' : '', true, false )
							.draw();
						} );

						column.data().unique().sort().each( function ( d, j ) {
							select.append( '<option value="'+d+'">'+d+'</option>' )
						} );
					} );
				}
			});

			// Add Row
			$('#add-row').DataTable({
				"pageLength": 5,
			});

			var action = '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';
		});
	</script>
</body>
</html>