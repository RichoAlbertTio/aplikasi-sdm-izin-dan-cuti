<?php
$pageActive = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
?>

<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item nav-profile">
      <a href="#" class="nav-link">
        <div class="nav-profile-image">
          <img src="assets/images/faces/sdm.jpeg" alt="profile">
          <span class="login-status online"></span>
          <!--change to offline or busy as needed-->
        </div>
        <div class="nav-profile-text d-flex flex-column">
          <span class="font-weight-bold mb-2">RENMIN SDM</span>
          <span class="text-secondary text-small">Project By</span>
        </div>

      </a>
    </li>
    <li class="nav-item <?= $pageActive == 'dashboard' ? 'active' : '' ?>">
      <a class="nav-link" href="?page=dashboard">
        <span class="menu-title">Dashboard</span>
        <i class="mdi mdi-home menu-icon"></i>
      </a>
    </li>

    <li class="nav-item <?= $pageActive == 'divisi' ? 'active' : '' ?>">
      <a class="nav-link" href="?page=divisi">
        <span class="menu-title">Divisi</span>
        <i class="mdi mdi-bulletin-board menu-icon"></i>
      </a>
    </li>
    <li class="nav-item <?= $pageActive == 'personel' ? 'active' : '' ?>">
      <a class="nav-link" href="?page=personel">
        <span class="menu-title">Personel</span>
        <i class="mdi mdi-account menu-icon"></i>
      </a>
    </li>

    <li class="nav-item <?= $pageActive == 'cuti' ? 'active' : '' ?>">
      <a class="nav-link" href="?page=cuti">
        <span class="menu-title">Data Cuti</span>
        <i class="mdi mdi-clipboard-text menu-icon"></i>
      </a>
    </li>


    <li class="nav-item <?= $pageActive == 'ijin' ? 'active' : '' ?>">
      <a class="nav-link" href="?page=ijin">
        <span class="menu-title">Data Ijin</span>
        <i class="mdi mdi-clipboard-text menu-icon"></i>
      </a>
    </li>
    <li class="nav-item <?= $pageActive == 'laporan' ? 'active' : '' ?>">
      <a class="nav-link" href="?page=laporan">
        <span class="menu-title">Laporan</span>
        <i class="mdi mdi-table-large menu-icon"></i>
      </a>
    </li>
  </ul>
</nav>