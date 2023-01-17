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
				<div class="panel-header bg-primary-gradient">
					<div class="page-inner py-5">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
								<h2 class="text-white pb-2 fw-bold">Dashboard</h2>
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner mt--5">
					<div class="row mt--2">
						<div class="col-md-12">
							<div class="card full-height">
								<div class="card-body">
									<div class="row py-3">
										<div class="col-sm-6 col-md-3">
											<div class="card card-stats card-primary card-round">
												<div class="card-body">
													<div class="row">
														<div class="col-5">
															<div class="icon-big text-center">
																<i class="flaticon-users"></i>
															</div>
														</div>
														<div class="col-7 col-stats">
															<div class="numbers">
																<p class="card-category">Siswa</p>
																<h4 class="card-title"><?php  echo $siswa ?></h4>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-sm-6 col-md-3">
											<div class="card card-stats card-info card-round">
												<div class="card-body">
													<div class="row">
														<div class="col-5">
															<div class="icon-big text-center">
																<i class="flaticon-network"></i>
															</div>
														</div>
														<div class="col-7 col-stats">
															<div class="numbers">
																<p class="card-category">Kelas</p>
																<h4 class="card-title"><?php  echo $kelas ?></h4>														
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-sm-6 col-md-3">
											<div class="card card-stats card-success card-round">
												<div class="card-body ">
													<div class="row">
														<div class="col-5">
															<div class="icon-big text-center">
																<i class="flaticon-agenda-1"></i>
															</div>
														</div>
														<div class="col-7 col-stats">
															<div class="numbers">
																<p class="card-category">Mata Pelajaran</p>
																<h4 class="card-title"><?php  echo $mapel ?></h4>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
                                        <div class="col-sm-6 col-md-3">
											<div class="card card-stats card-primary card-round">
												<div class="card-body ">
													<div class="row">
														<div class="col-5">
															<div class="icon-big text-center">
																<i class="flaticon-agenda-1"></i>
															</div>
														</div>
														<div class="col-7 col-stats">
															<div class="numbers">
																<p class="card-category">Guru</p>
																<h4 class="card-title"><?php  echo $guru ?></h4>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
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
	<script type="text/javascript">
		//Notify
		$.notify({
			icon: 'flaticon-alarm-1',
			title: 'Halo, <?php echo $this->session->nama_dosen ?>!',
<<<<<<< HEAD
			message: 'Selamat datang di SMANSI WEB',
=======
			message: 'Selamat datang di SENSASIQ',
>>>>>>> d1b8c56b57908e07ede54c3c7ccada25c9bcf72c
		},{
			type: 'info',
			placement: {
				from: "bottom",
				align: "right"
			},
			time: 1000,
		});
	var ctx = document.getElementById('statisticsChart').getContext('2d');

var statisticsChart = new Chart(ctx, {
	type: 'line',
	data: {
		labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
		datasets: [ {
			label: "Mahasiswa Terabsen",
			borderColor: '#177dff',
			pointBackgroundColor: 'rgba(23, 125, 255, 0.6)',
			pointRadius: 0,
			backgroundColor: 'rgba(23, 125, 255, 0.4)',
			legendColor: '#177dff',
			fill: true,
			borderWidth: 2,
			data: [
			<?php 
			foreach ($riwayat as $r):
			$nip = $r['nip'];
			endforeach;
			for ($i=1; $i<13; $i++){
				if ($i < 10) {
					$res[$i] = $this->db->query("SELECT a.* from tbabsen a,tbjadwal j,tbdosen d where a.id_jadwal=j.id_jadwal and j.nip=d.nip and d.nip=$nip and a.waktu like concat(year(curdate()),'-0$i%')");
					$bulan[$i] = $res[$i]->num_rows();
				}
				elseif($i>9 && $i<13){
					$res[$i] = $this->db->query("SELECT a.* from tbabsen a,tbjadwal j,tbdosen d where a.id_jadwal=j.id_jadwal and j.nip=d.nip and d.nip=$nip and a.waktu like concat(year(curdate()),'-$i%')");
					$bulan[$i] = $res[$i]->num_rows();
				}
			}
			echo $bulan[1];
			for($i = 2;$i<13;$i++){
				echo ",".$bulan[$i];
			}
			
			?> 
			]
		}]
	},
	options : {
		responsive: true, 
		maintainAspectRatio: false,
		legend: {
			display: false
		},
		tooltips: {
			bodySpacing: 4,
			mode:"nearest",
			intersect: 0,
			position:"nearest",
			xPadding:10,
			yPadding:10,
			caretPadding:10
		},
		layout:{
			padding:{left:5,right:5,top:15,bottom:15}
		},
		scales: {
			yAxes: [{
				ticks: {
					fontStyle: "500",
					beginAtZero: false,
					maxTicksLimit: 5,
					padding: 10
				},
				gridLines: {
					drawTicks: false,
					display: false
				}
			}],
			xAxes: [{
				gridLines: {
					zeroLineColor: "transparent"
				},
				ticks: {
					padding: 10,
					fontStyle: "500"
				}
			}]
		}, 
		legendCallback: function(chart) { 
			var text = []; 
			text.push('<ul class="' + chart.id + '-legend html-legend">'); 
			for (var i = 0; i < chart.data.datasets.length; i++) { 
				text.push('<li><span style="background-color:' + chart.data.datasets[i].legendColor + '"></span>'); 
				if (chart.data.datasets[i].label) { 
					text.push(chart.data.datasets[i].label); 
				} 
				text.push('</li>'); 
			} 
			text.push('</ul>'); 
			return text.join(''); 
		}  
	}
});

var myLegendContainer = document.getElementById("myChartLegend");
	</script>
</body>
</html>