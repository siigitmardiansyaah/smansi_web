			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<div class="user">
						<div class="avatar-sm float-left mr-2">
							<img src="<?php echo base_url('assets/img/logo.png') ?>" alt="..." class="avatar-img rounded-circle">
						</div>
						<div class="info">
							<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span  style="padding-left: 10px;">
									<?php echo $this->session->nama_guru; ?>
									<span class="user-level text-success">Online</span>
									<span class="caret"></span>
								</span>
							</a>
							<div class="clearfix"></div>

							<div class="collapse in" id="collapseExample">
								<ul class="nav">
									<li>
										<a href="<?php echo base_url('auth/logout') ?>">
											<span class="link-collapse">Logout</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<?php if($this->session->userdata('username') == 'admin') {?>
						<ul class="nav nav-primary">
						<li class="nav-item <?php if($this->session->flashdata('activemenu') == 'admin'): echo "active"; endif; ?>">
							<a href="<?php echo base_url('admin'); ?>">
								<i class="fas fa-home"></i>
								<p>Dashboard</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-primary">
						<li class="nav-item <?php if($this->session->flashdata('activemenu') == 'guru'): echo "active"; endif; ?>">
							<a href="<?php echo base_url('guru'); ?>">
								<i class="fas fa-user"></i>
								<p>Master Guru</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-primary">
						<li class="nav-item <?php if($this->session->flashdata('activemenu') == 'kelas'): echo "active"; endif; ?>">
							<a href="<?php echo base_url('kelas'); ?>">
								<i class="fas fa-file"></i>
								<p>Master Kelas</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-primary">
						<li class="nav-item <?php if($this->session->flashdata('activemenu') == 'mapel'): echo "active"; endif; ?>">
							<a href="<?php echo base_url('mapel'); ?>">
								<i class="fas fa-school"></i>
								<p>Master Mata Pelajaran</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-primary">
						<li class="nav-item <?php if($this->session->flashdata('activemenu') == 'siswa'): echo "active"; endif; ?>">
							<a href="<?php echo base_url('siswa'); ?>">
								<i class="fas fa-users"></i>
								<p>Master Siswa</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-primary">
						<li class="nav-item <?php if($this->session->flashdata('activemenu') == 'jadwal'): echo "active"; endif; ?>">
							<a href="<?php echo base_url('jadwal'); ?>">
								<i class="fas fa-calendar"></i>
								<p>Master Jadwal Guru</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-primary">
						<li class="nav-item <?php if($this->session->flashdata('activemenu') == 'jadwal_siswa'): echo "active"; endif; ?>">
							<a href="<?php echo base_url('jadwal/index_jadwal'); ?>">
								<i class="fas fa-calendar"></i>
								<p>Master Jadwal Siswa</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-primary">
						<li class="nav-item <?php if($this->session->flashdata('activemenu') == 'generate_qr'): echo "active"; endif; ?>">
							<a href="<?php echo base_url('generateadmin'); ?>">
								<i class="fas fa-barcode"></i>
								<p>Generate QR Mate Pelajaran</p>
							</a>
						</li>
					</ul>
					<?php }else{?>
						<ul class="nav nav-primary">
						<li class="nav-item <?php if($this->session->flashdata('activemenu') == 'dashboard'): echo "active"; endif; ?>">
							<a href="<?php echo base_url(''); ?>">
								<i class="fas fa-home"></i>
								<p>Dashboard</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-primary">
						<li class="nav-item <?php if($this->session->flashdata('activemenu') == 'generate'): echo "active"; endif; ?>">
							<a href="<?php echo base_url('generate'); ?>">
								<i class="fas fa-qrcode"></i>
								<p>QR Generator</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-primary">
						<li class="nav-item <?php if($this->session->flashdata('activemenu') == 'rekapitulasi'): echo "active"; endif; ?>">
							<a href="<?php echo base_url('rekapitulasi'); ?>">
								<i class="fas fa-address-book"></i>
								<p>Rekapitulasi</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-primary">
						<li class="nav-item <?php if($this->session->flashdata('activemenu') == 'aktivitas'): echo "active"; endif; ?>">
							<a href="<?php echo base_url('aktivitas'); ?>">
								<i class="fas fa-clipboard-list"></i>
								<p>Aktivitas</p>
								<span class="badge badge-success">
									<?php
									$this->db->select('*');
								    $this->db->from('tbjadwal');
								    $this->db->join('tbkelas', 'tbkelas.id_kelas = tbjadwal.id_kelas');
								    $this->db->join('tbguru', 'tbguru.id_guru = tbjadwal.id_guru');
								    $this->db->join('tbmapel', 'tbmapel.id_mapel = tbjadwal.id_mapel');
								    $this->db->where('tbjadwal.id_guru', $this->session->id_guru);
								    $result = $this->db->get();
								    echo $result->num_rows();
									?>
								</span>
							</a>
						</li>
					</ul>
					<ul class="nav nav-primary">
						<li class="nav-item <?php if($this->session->flashdata('activemenu') == 'profil'): echo "active"; endif; ?>">
							<a href="<?php echo base_url('profil'); ?>">
								<i class="fas fa-user"></i>
								<p>Profile</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-primary">
						<li class="nav-item <?php if($this->session->flashdata('activemenu') == 'riwayat'): echo "active"; endif; ?>">
							<a href="<?php echo base_url('riwayat'); ?>">
								<i class="fas fa-history"></i>
								<p>Riwayat</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-primary">
						<li class="nav-item <?php if($this->session->flashdata('activemenu') == 'koreksi_absen'): echo "active"; endif; ?>">
							<a href="<?php echo base_url('koreksi_absen'); ?>">
								<i class="fas fa-edit"></i>
								<p>Koreksi Absen</p>
							</a>
						</li>
					</ul>
					<?php } ?>
					
				</div>
			</div>