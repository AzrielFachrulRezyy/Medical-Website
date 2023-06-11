<aside class="left-sidebar">
  <!-- Sidebar scroll-->
  <div>
    <div class="brand-logo d-flex align-items-center justify-content-between">
      <a href="index.php" class="text-nowrap logo-img">
        <img src="../assets/images/logo-green.png" width="100%" alt=""/>
      </a>
      <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
        <i class="ti ti-x fs-8"></i>
      </div>
    </div>
    <!-- Sidebar navigation-->
    <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
      <ul id="sidebarnav">
        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">Utama</span>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="<?= BASE_URL; ?>/admin/index.php" aria-expanded="false">
            <span>
              <i class="ti ti-layout-dashboard"></i>
            </span>
            <span class="hide-menu">Dashboard</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="<?= BASE_URL; ?>/admin/konsultasi/index.php" aria-expanded="false">
            <span>
              <i class="ti ti-message"></i>
            </span>
            <span class="hide-menu">Konsultasi</span>
          </a>
        </li>
        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">Data</span>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="<?= BASE_URL; ?>/admin/dokter/index.php" aria-expanded="false">
            <span>
              <i class="ti ti-stethoscope"></i>
            </span>
            <span class="hide-menu">Dokter</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="<?= BASE_URL; ?>/admin/spesialis/index.php" aria-expanded="false">
            <span>
              <i class="ti ti-tools"></i>
            </span>
            <span class="hide-menu">Spesialis</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="<?= BASE_URL; ?>/admin/penyakit/index.php" aria-expanded="false">
            <span>
              <i class="ti ti-virus"></i>
            </span>
            <span class="hide-menu">Penyakit</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="<?= BASE_URL; ?>/admin/obat/index.php" aria-expanded="false">
            <span>
              <i class="ti ti-vaccine-bottle"></i>
            </span>
            <span class="hide-menu">Obat</span>
          </a>
        </li>
        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">Riwayat Aktivitas</span>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="<?= BASE_URL; ?>/admin/riwayat/index.php" aria-expanded="false">
            <span>
              <i class="ti ti-article"></i>
            </span>
            <span class="hide-menu">Riwayat</span>
          </a>
        </li>
      </ul>
    </nav>
    <!-- End Sidebar navigation -->
  </div>
  <!-- End Sidebar scroll-->
</aside>