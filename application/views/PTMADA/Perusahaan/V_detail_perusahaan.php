<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo $dt['nama_perusahaan']; ?>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php base_url('Ptmada/') ?>"> Master Data</a></li>
			<li><a href="<?php base_url() ?>/ptmada/Ptmada/lihat_perusahaan">Perusahaan</a></li>
			<li class="active">Profil Perusahaan</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">

		<div class="row">
			<!-- /.col -->
			<div class="col-md-12">
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#profilpejabat" data-toggle="tab">Profil Perusahaan</a></li>
						<li><a href="#persyaratan" data-toggle="tab">Persyaratan</a></li>
						<li><a href="#history" data-toggle="tab">Histori Proyek</a></li>
					</ul>
					<div class="tab-content">
						<div class="active tab-pane" id="profilpejabat">
							<div class="card-body">
								<div class="row">
									<div class="col-md-6">
										<table class="table table-striped table-hover table-bordered">
											<tbody>
												<tr>
													<td><strong><i class="fa fa-building margin-r-5"></i> Nama Perusahaan</strong></td>
												</tr>
												<tr>
													<td><?php echo $dt['nama_perusahaan']; ?></td>
												</tr>

												<tr>
													<td><strong><i class="fa fa-user margin-r-5"></i> Nama Pimpinan</strong></td>
												</tr>
												<tr>
													<td><?php echo $dt['nama_direktur']; ?></td>
												</tr>

												<tr>
													<td><strong><i class="fa fa-briefcase margin-r-5"></i> Jabatan Pimpinan</strong></td>
												</tr>
												<tr>
													<td><?php echo $dt['jab_pimpinan']; ?></td>
												</tr>

												<tr>
													<td><strong><i class="fa fa-user margin-r-5"></i> Nama Pejabat Penghubung</strong></td>
												</tr>
												<tr>
													<td><?php echo $dt['nama_pejabat']; ?></td>
												</tr>

												<tr>
													<td><strong><i class="fa fa-user margin-r-5"></i> Nama Agent</strong></td>
												</tr>
												<tr>
													<td><?php echo $dt['nama_agent']; ?></td>
												</tr>

											</tbody>
										</table>
									</div>
									<div class="col-md-6">
										<table class="table table-striped table-hover table-bordered">
											<tbody>
												<tr>
													<td><strong><i class="fa fa-building margin-r-5"></i> NPWP</strong></td>
												</tr>
												<tr>
													<td><?php echo $dt['npwp']; ?></td>
												</tr>

												<tr>
													<td><strong><i class="fa fa-map-marker margin-r-5"></i> Alamat</strong></td>
												</tr>
												<tr>
													<td><?php echo $dt['alamat']; ?></td>
												</tr>
												<tr>
													<td><strong><i class="fa fa-phone-square margin-r-5"></i> Nomor Telpon</strong></td>
												</tr>
												<tr>
													<td><?php echo $dt['no_telpon']; ?></td>
												</tr>

												<tr>
													<td><strong><i class="fa fa-fax margin-r-5"></i>Nomor Fax</strong></td>
												</tr>
												<tr>
													<td><?php echo $dt['no_fax']; ?></td>
												</tr>

												<tr>
													<td><strong><i class="fa fa-envelope-square margin-r-5"></i>Email</strong></td>
												</tr>
												<tr>
													<td><?php echo $dt['email']; ?></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<a href="<?php echo site_url('Ptmada/edit_perusahaan/' . $dt['kd_perusahaan']); ?>"><button class="btn btn-success"><i class="fa fa-edit"></i> Edit</button></a>
									</div>
								</div>
							</div>
						</div>

						<div class="tab-pane" id="persyaratan">
							<div class="card-body">
								<div class="row">
									<div class="col-md-12">
										<table class="table table-striped table-hover table-bordered" style="height: 10px; overflow-y: scroll; overflow-x: scroll;">
											<tr>
												<th style="width: 10px">#</th>
												<th>Persyaratan</th>
												<th>File</th>
												<th>Aksi</th>
											</tr>
											<tr>
												<td>1.</td>
												<td>Company Profile</td>
												<td>
													<div class="">
														<?php echo $dt['company_profile'] ?>
													</div>
												</td>
												<td>
													<?php if($dt['company_profile']!="Tidak Ada Data"){ ?>
													<a href="<?php echo base_url() ?>file/persyaratan/<?php echo $dt['company_profile']; ?>" title="Open File" target="_blank">
														<button class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="auto" title="Lihat File">
								                            <i class="fa fa-eye"></i>
								                        </button>
													</a>
													<?php }?>
												</td>
											</tr>

											<tr>
												<td>2.</td>
												<td>Akta Pendirian</td>
												<td>
													<div class="">
														<?php echo $dt['akta_pendirian'] ?>
														<!-- <div class="progress-bar progress-bar-danger" style="width: 55%"></div> -->
													</div>
												</td>
												<td>
													<?php if($dt['akta_pendirian']!="Tidak Ada Data"){ ?>
													<a href="<?php echo base_url() ?>file/persyaratan/<?php echo $dt['akta_pendirian']; ?>" title="Open File" target="_blank">
														<button class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="auto" title="Lihat File">
								                            <i class="fa fa-eye"></i>
								                        </button>
								                    </a>
								                    <?php }?>
												</td>
											</tr>

											<tr>
												<td>3.</td>
												<td>SPKMGR</td>
												<td>
													<div class="">
														<?php echo $dt['spkmgr'] ?>
														<!-- <div class="progress-bar progress-bar-danger" style="width: 55%"></div> -->
													</div>
												</td>
												<td>
													<?php if($dt['spkmgr']!="Tidak Ada Data"){ ?>
													<a href="<?php echo base_url() ?>file/persyaratan/<?php echo $dt['spkmgr']; ?>" title="Open File" target="_blank">
														<button class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="auto" title="Lihat File">
								                            <i class="fa fa-eye"></i>
								                        </button>
													</a>
													<?php }?>
												</td>
											</tr>

											<tr>
												<td>4.</td>
												<td>Surat Tanda Daftar Perusahaan (STDP)</td>
												<td>
													<div class="">
														<?php echo $dt['stdp'] ?>
													</div>
												</td>
												<td>
													<?php if($dt['stdp']!="Tidak Ada Data"){ ?>
													<a href="<?php echo base_url() ?>file/persyaratan/<?php echo $dt['stdp']; ?>" title="Open File" target="_blank">
														<button class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="auto" title="Lihat File">
								                            <i class="fa fa-eye"></i>
								                        </button>
													</a>
													<?php }?>
												</td>
											</tr>

											<tr>
												<td>5.</td>
												<td>Surat Ijin Usaha Pendirian (SIUP)</td>
												<td>
													<div class="">
														<?php echo $dt['siup'] ?>
													</div>
												</td>
												<td>
													<?php if($dt['siup']!="Tidak Ada Data"){ ?>
													<a href="<?php echo base_url() ?>file/persyaratan/<?php echo $dt['siup']; ?>" title="Open File" target="_blank">
														<button class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="auto" title="Lihat File">
								                            <i class="fa fa-eye"></i>
								                        </button>
													</a>
													<?php }?>
												</td>
											</tr>

											<tr>
												<td>6.</td>
												<td>Surat Keterangan Tempat Usaha (SKTU)</td>
												<td>
													<div class="">
														<?php echo $dt['sktu'] ?>
													</div>
												</td>
												<td>
													<?php if($dt['sktu']!="Tidak Ada Data"){ ?>
													<a href="<?php echo base_url() ?>file/persyaratan/<?php echo $dt['sktu']; ?>" title="Open File" target="_blank"><button class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="auto" title="Lihat File">
								                            <i class="fa fa-eye"></i>
								                        </button>
								                    </a>
								                    <?php }?>
												</td>
											</tr>

											<tr>
												<td>7.</td>
												<td>Surat Ijin Usaha Jasa Konstruksi (SIUJK)</td>
												<td>
													<div class="">
														<?php echo $dt['siujk'] ?>
													</div>
												</td>
												<td>
													<?php if($dt['siujk']!="Tidak Ada Data"){ ?>
													<a href="<?php echo base_url() ?>file/persyaratan/<?php echo $dt['siujk']; ?>" title="Open File" target="_blank">
														<button class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="auto" title="Lihat File">
								                            <i class="fa fa-eye"></i>
								                        </button>
													</a>
													<?php }?>
												</td>
											</tr>

											<tr>
												<td>8.</td>
												<td>Surat Pajak Tahunan (SPK)</td>
												<td>
													<div class="">
														<?php echo $dt['spt'] ?>
													</div>
												</td>
												<td>
													<?php if($dt['spt']!="Tidak Ada Data"){ ?>
													<a href="<?php echo base_url() ?>file/persyaratan/<?php echo $dt['spt']; ?>" title="Open File" target="_blank">
														<button class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="auto" title="Lihat File">
								                            <i class="fa fa-eye"></i>
								                        </button>
													</a>
													<?php }?>
												</td>
											</tr>

											<tr>
												<td>9.</td>
												<td>NPWP</td>
												<td>
													<div class="">
														<?php echo $dt['npwp_file'] ?>
													</div>
												</td>

												<td>
													<?php if($dt['npwp_file']!="Tidak Ada Data"){ ?>
													<a href="<?php echo base_url() ?>file/persyaratan/<?php echo $dt['npwp_file']; ?>" title="Open File" target="_blank">
														<button class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="auto" title="Lihat File">
								                            <i class="fa fa-eye"></i>
								                        </button>
													</a>
													<?php }?>
												</td>

											</tr>

											<tr>
												<td>10.</td>
												<td>Kartu Tanda Penduduk (KTP)</td>
												<td>
													<div class="">
														<?php echo $dt['ktp'] ?>
													</div>
												</td>
												<td>
													<?php if($dt['ktp']!="Tidak Ada Data"){ ?>
													<a href="<?php echo base_url() ?>file/persyaratan/<?php echo $dt['ktp']; ?>" title="Open File" target="_blank">
														<button class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="auto" title="Lihat File">
								                            <i class="fa fa-eye"></i>
								                        </button>
													</a>
													<?php }?>
												</td>
											</tr>

											<tr>
												<td>11.</td>
												<td>Laporan Keuangan</td>
												<td>
													<div class="">
														<?php echo $dt['laporan_keuangan'] ?>
													</div>
												</td>
												<td>
													<?php if($dt['laporan_keuangan']!="Tidak Ada Data"){ ?>
													<a href="<?php echo base_url() ?>file/persyaratan/<?php echo $dt['laporan_keuangan']; ?>" title="Open File" target="_blank">
														<button class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="auto" title="Lihat File">
								                            <i class="fa fa-eye"></i>
								                        </button>
													</a>
													<?php }?>
												</td>
											</tr>

											<tr>
												<td>12.</td>
												<td>Proyek Sebelumnya</td>
												<td>
													<div class="">
														<?php echo $dt['proyek_sebelumnya'] ?>
													</div>
												</td>

												<td>
													<?php if($dt['proyek_sebelumnya']!="Tidak Ada Data"){ ?>
													<a href="<?php echo base_url() ?>file/persyaratan/<?php echo $dt['proyek_sebelumnya']; ?>" title="Open File" target="_blank">
														<button class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="auto" title="Lihat File">
								                            <i class="fa fa-eye"></i>
								                        </button>
													</a>
													<?php }?>
												</td>
											</tr>

											<!-- Edit By Adiguna -->
											<tr>
												<td>13.</td>
												<td>Tanda Keanggotaan Asosiasi</td>
												<td>
													<div class="">
														<?php echo $dt['tanda_keanggotaan_asosiasi'] ?>
													</div>
												</td>

												<td>
													<?php if($dt['tanda_keanggotaan_asosiasi']!="Tidak Ada Data"){ ?>
													<a href="<?php echo base_url() ?>file/persyaratan/<?php echo $dt['tanda_keanggotaan_asosiasi']; ?>" title="Open File" target="_blank">
														<button class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="auto" title="Lihat File">
								                            <i class="fa fa-eye"></i>
								                        </button>
													</a>
													<?php }?>
												</td>
											</tr>

											<tr>
												<td>14.</td>
												<td>Akta Perubahan Perusahaan</td>
												<td>
													<div class="">
														<?php echo $dt['akta_perubahan_perusahaan'] ?>
													</div>
												</td>

												<td>
													<?php if($dt['akta_perubahan_perusahaan']!="Tidak Ada Data"){ ?>
													<a href="<?php echo base_url() ?>file/persyaratan/<?php echo $dt['akta_perubahan_perusahaan']; ?>" title="Open File" target="_blank">
														<button class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="auto" title="Lihat File">
								                            <i class="fa fa-eye"></i>
								                        </button>
													</a>
													<?php }?>
												</td>
											</tr>

											<tr>
												<td>15.</td>
												<td>Scan atau Foto TTD Pimpinan Perusahaan</td>
												<td>
													<div class="">
														<?php echo $dt['foto_ttd'] ?>
													</div>
												</td>

												<td>
													<?php if($dt['foto_ttd']!="Tidak Ada Data"){ ?>
													<a href="<?php echo base_url() ?>file/persyaratan/<?php echo $dt['foto_ttd']; ?>" title="Open File" target="_blank">
														<button class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="auto" title="Lihat File">
								                            <i class="fa fa-eye"></i>
								                        </button>
													</a>
													<?php }?>
												</td>
											</tr>


										</table>

										<a href="<?php echo site_url('Ptmada/edit_perusahaan/' . $dt['kd_perusahaan']); ?>"><button class="btn btn-success"><i class="fa fa-edit"></i> Edit</button></a>
									</div>
								</div>
							</div>
						</div>

						<div class="tab-pane" id="history">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>No</th>
										<th>Nomor Permohonan</th>
										<th>Tanggal Permohonan</th>
										<th>Nama Pejabat</th>
										<th>Nama Pekerjaan</th>
										<th>Nilai Proyek</th>
										<th>Detail</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$no = 1;
									foreach ($data2 as $dt) {
									?>
										<tr>
											<td><?php echo $no++; ?></td>
											<td><?php echo $dt['no_permohonan']; ?></td>
											<td><?php echo format_indo($dt['tgl_permohonan']); ?></td>
											<td><?php echo $dt['nama_pejabat']; ?></td>
											<td><?php echo $dt['nama_pekerjaan']; ?></td>
											<td><?php echo "Rp. " . number_format($dt['nilai_proyek'], 2, ',', '.'); ?></td>
											<td>
												<center>
													<a href="<?php echo site_url('Ptmada/detail_permohonan/' . $dt['id_permohonan']); ?>">
														<button class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="auto" title="Lihat Detail">
								                            <i class="fa fa-info-circle"></i>
								                        </button>
								                    </a>
												</center>
											</td>
										</tr>
									<?php
									}
									?>
								</tbody>
							</table>
						</div>


						<!-- /.tab-pane -->


						<!-- /.tab-pane -->
					</div>
					<!-- /.tab-content -->
				</div>
				<!-- /.nav-tabs-custom -->
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->

	</section>
	<!-- /.content -->
</div>
