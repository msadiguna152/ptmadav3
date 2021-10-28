<header class="main-header">
  <!-- Logo -->
  <a href="<?php echo site_url('Finansial')?>" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><img src="<?php echo base_url()?>/assets/img/bms_logo.jpg" alt=""><b>PT MADA</b></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><img src="<?php echo base_url()?>/assets/img/bms_logo.jpg" alt=""><b>PT MADA</b></span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </a>
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <li class="dropdown tasks-menu">
          <a href="<?php echo base_url() ?>login/logout" title="Logout">
            <i class="fa fa-power-off"></i> &nbsp <b>Logout</b>
          </a>
        </li>
        <!-- Messages: style can be found in dropdown.less-->

        <!-- Notifications: style can be found in dropdown.less -->

        <!-- Tasks: style can be found in dropdown.less -->

        <!-- User Account: style can be found in dropdown.less -->

        <!-- Control Sidebar Toggle Button -->

      </ul>
    </div>
  </nav>
</header>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->

    <!-- search form -->
    <!-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> -->
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->

    <!-- SIDEBAR 1 -->
    <ul class="sidebar-menu tree" data-widget="tree">
      <li class="header">MENU UTAMA</li>

      <li>
        <a href="<?php echo base_url('Finansial/index') ?>">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>
      <li>
        <a href="<?php echo base_url('Finansial/lihat_perhitungan') ?>">
          <i class="fa fa-calculator"></i> <span>Master Perhitungan Tarif</span>
        </a>
      </li>
      <li>
        <a href="<?php echo base_url('Finansial/lihat_permohonan') ?>">
          <i class="fa fa-clipboard"></i> <span>Permohonan Baru</span>
        </a>
      </li>
      <li>
        <a href="<?php echo base_url('Finansial/lihat_tarif') ?>">
          <i class="fa fa-calculator"></i> <span>Perhitungan Tarif </span>
        </a>
      </li>
      <li class="treeview" style="height: auto;">
        <a href="#">
          <i class="fa fa-history"></i> <span>Transaksi</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu" style="display: none;">
          <li><a href="<?php echo base_url('Finansial/lihat_transaksi') ?>"><i class="fa fa-circle-o"></i>Transaksi Permohonan</a></li>
          <li><a href="<?php echo base_url('Finansial/lihat_umum') ?>"><i class="fa fa-circle-o"></i>Transaksi Umum</a></li>
        </ul>
      </li>

      <!-- <li>
        <a href="<?php echo base_url('Finansial/lihat_transaksi') ?>">
          <i class="fa fa-book"></i> <span>Transaksi Permohonan</span>
        </a>
      </li>
      <li>
        <a href="<?php echo base_url('Finansial/lihat_umum') ?>">
          <i class="fa fa-book"></i> <span>Transaksi Umum</span>
        </a>
      </li> -->
      <li class="treeview" style="height: auto;">
        <a href="#">
          <i class="fa fa-print"></i> <span>Laporan</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu" style="display: none;">
          <li>
            <a href="<?php echo base_url('Finansial/lihat_laporan') ?>">
              <i class="fa fa-book"></i> <span>Lap. Pendapatan Perusahaan</span>
            </a>
          </li>
          <li>
            <a href="<?php echo base_url('Finansial/laporan_pemasukan') ?>">
              <i class="fa fa-book"></i> <span>Lap. Pemasukan Permohonan</span>
            </a>
          </li>
          <li>
            <a href="<?php echo base_url('Finansial/laporan_pengeluaran') ?>">
              <i class="fa fa-book"></i> <span>Lap. Pengeluaran Permohonan</span>
            </a>
          </li>
        </ul>
      </li>
      <!-- =============== -->
      <!-- <li class="treeview" style="height: auto;">
        <a href="#">
          <i class="fa fa-book"></i> <span>Pembayaran</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu" style="display: none;">
          <li><a href="<?php echo base_url('Finansial/lihat_pembayaran/Client') ?>"><i class="fa fa-circle-o"></i> Data Pembayaran Client</a></li>
          <li><a href="<?php echo base_url('Finansial/lihat_pembayaran/Jamkrida') ?>"><i class="fa fa-circle-o"></i> Data Pembayaran Jamkrida</a></li>
        </ul>
      </li>
      <li class="treeview" style="height: auto;">
        <a href="#">
          <i class="fa fa-book"></i> <span>Pengeluaran</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu" style="display: none;">
          <li><a href="<?php echo base_url('Finansial/lihat_pengeluaran/Operasional') ?>"><i class="fa fa-circle-o"></i> Data Operasional</a></li>
          <li><a href="<?php echo base_url('Finansial/lihat_pengeluaran/Proyek') ?>"><i class="fa fa-circle-o"></i> Data Proyek</a></li>
        </ul>
      </li> -->
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>