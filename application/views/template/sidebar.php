<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?=base_url('dashboard')?>">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">DPM Vokasi <sup>UB</sup></div>
        </a>
        <?php
        $page = $this->uri->segment(1);
        $data_surat = ["surat_keluar", "surat_masuk", "template_surat", "berkas_proposal"];
        $data_kas = ["rekap_anggota", "rekap_organisasi"];
        $data_absensi = ["rapat_besar", "rapat_pleno", "rapat_koordinasi"];
        $data_konstitusi = ["konstitusi"];
        $data_penomoran = ["penomoran"];
        $data_akun = ["pengelolaan_akun"];

        ?>
        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item <?= $page === 'dashboard' ? "active" : "" ?>">
            <a class="nav-link" href="<?=base_url('dashboard')?>">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>
       <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Interface
        </div>

        <!-- Nav Item - latter Menu -->
        <li class="nav-item <?= in_array($page, $data_surat)  ? "active" : ""  ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-mail-bulk"></i>
                <span>Surat</span>
            </a>
            <div id="collapseTwo" class="collapse <?= in_array($page, $data_surat)  ? "show" : ""  ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Keluarga Surat</h6>
                    <a class="collapse-item <?= $page === 'surat_keluar' ? "active" : "" ?>" href="<?=base_url('surat_keluar')?>" ><i class="fas fa-envelope-open"></i> Surat Keluar</a>
                    <a class="collapse-item <?= $page === 'surat_masuk' ? "active" : "" ?>" href="<?=base_url('surat_masuk')?>"><i class="fas fa-envelope-open-text"></i> Surat Masuk</a>
                    <a class="collapse-item <?= $page === 'template_surat' ? "active" : "" ?>" href="<?=base_url('template_surat')?>"><i class="fas fa-envelope-square"></i> Template Surat</a>
                    <a class="collapse-item <?= $page === 'berkas_proposal' ? "active" : "" ?>" href="<?=base_url('berkas_proposal')?>"><i class="fas fa-file-word"></i> Berkas Proposal</a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Kas Collapse Menu -->
        <li class="nav-item <?= in_array($page, $data_kas)  ? "active" : ""  ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-wallet"></i>
                <span>Kas</span>
            </a>
            <div id="collapseUtilities" class="collapse <?= in_array($page, $data_kas)  ? "show" : ""  ?>" aria-labelledby="headingUtilities"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Rekap KAS DPM:</h6>
                    <a class="collapse-item <?= $page === 'rekap_anggota' ? "active" : "" ?>" href="<?=base_url('rekap_anggota')?>"><i class="fas fa-receipt"></i>   Rekap anggota</a>
                    <a class="collapse-item <?= $page === 'rekap_organisasi' ? "active" : "" ?>" href="<?=base_url('rekap_organisasi')?>"><i class="fas fa-money-check-alt"></i> Rekap Organisasi</a>
                   
                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Addons
        </div>

        <!-- Nav Item - Absensi Collapse Menu -->
        <li class="nav-item <?= in_array($page, $data_absensi)  ? "active" : ""  ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-fingerprint"></i>
                <span>Absensi</span>
            </a>
            <div id="collapsePages" class="collapse <?= in_array($page, $data_absensi)  ? "show" : ""  ?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Rekap Absensi </h6>
                    <a class="collapse-item <?= $page === 'rapat_besar' ? "active" : "" ?>" href="<?=base_url('rapat_besar')?>"><i class="fas fa-users"></i> Rapat Besar</a>
                    <a class="collapse-item <?= $page === 'rapat_pleno' ? "active" : "" ?>" href="<?=base_url('rapat_pleno')?>"><i class="fas fa-user-tie"></i> Rapat Pleno</a>
                    <a class="collapse-item <?= $page === 'rapat_koordinasi' ? "active" : "" ?>" href="<?=base_url('rapat_koordinasi')?>"><i class="fas fa-users-cog"></i>Rapat Koordinasi</a>

                </div>
            </div>
                   
        </li>

        <!-- Nav Item - Charts -->
        <li class="nav-item <?= in_array($page, $data_konstitusi)  ? "active" : ""  ?>">
            <a class="nav-link" href=" <?= base_url('konstitusi')?>">
            <i class="fas fa-gavel"></i>
                <span>Konstitusi</span></a>
        </li>

        <!-- Nav Item - Charts -->
        <li class="nav-item <?= in_array($page, $data_penomoran)  ? "active" : ""  ?>">
            <a class="nav-link" href="<?= base_url('penomoran')?>">
            <i class="fas fa-sort-numeric-down"></i>
                <span>Penomoran Berkas</span></a>
        </li>


        <!-- Nav Item - Tables -->
        <li class="nav-item <?= in_array($page, $data_akun)  ? "active" : ""  ?>">
            <a class="nav-link" href="<?= base_url('pengelolaan_akun')?>">
            <i class="fas fa-user-plus"></i>
                <span>Pengelolaan akun</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

        <!-- Sidebar Message -->
        <!-- <div class="sidebar-card d-none d-lg-flex">
            <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
            <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
            <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
        </div> -->

    </ul>
    <!-- End of Sidebar -->