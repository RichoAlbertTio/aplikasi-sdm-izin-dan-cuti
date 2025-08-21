<?php
$ps = mysqli_query($conn, "SELECT * FROM personel");
$count1 = mysqli_num_rows($ps);

$ct = mysqli_query($conn, "SELECT * FROM cuti_ijin WHERE status='Cuti'");
$count2 = mysqli_num_rows($ct);

$ij = mysqli_query($conn, "SELECT * FROM cuti_ijin WHERE status='Ijin'");
$count3 = mysqli_num_rows($ij);

// Data personel yang sedang cuti/ijin (hanya yang masih berlaku)
$cuti_list = $conn->query("
    SELECT personel.nama_personel, cuti_ijin.status, cuti_ijin.kembali
    FROM cuti_ijin
    INNER JOIN personel ON cuti_ijin.id_personel = personel.id
    WHERE CURDATE() <= cuti_ijin.kembali
    ORDER BY cuti_ijin.kembali ASC
");
?>
<div class="content-wrapper">
  <div class="page-header">
    <h3 class="page-title">
      <span class="page-title-icon bg-gradient-primary text-white me-2">
        <i class="mdi mdi-home"></i>
      </span> Dashboard
    </h3>
    <nav aria-label="breadcrumb">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">
          <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
        </li>
      </ul>
    </nav>
  </div>
  <div class="row">
    <div class="col-md-4 stretch-card grid-margin">
      <div class="card bg-gradient-danger card-img-holder text-white">
        <div class="card-body">
          <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
          <h4 class="font-weight-normal mb-3">Data Personel <i class="mdi mdi-account mdi-24px float-right"></i></h4>
          <h2 class="mb-5"><?= $count1 ?></h2>
        </div>
      </div>
    </div>
    <div class="col-md-4 stretch-card grid-margin">
      <div class="card bg-gradient-info card-img-holder text-white">
        <div class="card-body">
          <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
          <h4 class="font-weight-normal mb-3">Data Cuti <i class="mdi mdi-clipboard-text mdi-24px float-right"></i></h4>
          <h2 class="mb-5"><?= $count2 ?></h2>
        </div>
      </div>
    </div>
    <div class="col-md-4 stretch-card grid-margin">
      <div class="card bg-gradient-warning card-img-holder text-white">
        <div class="card-body">
          <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
          <h4 class="font-weight-normal mb-3">Data Ijin <i class="mdi mdi-clipboard-text mdi-24px float-right"></i></h4>
          <h2 class="mb-5"><?= $count3 ?></h2>
        </div>
      </div>
    </div>
  </div>

  <!-- Tambahan daftar personel yang sedang cuti / ijin -->
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Personel yang Sedang Cuti/Ijin</h4>
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Nama Personel</th>
                  <th>Status</th>
                  <th>Tanggal Kembali</th>
                </tr>
              </thead>
              <tbody>
                <?php if ($cuti_list->num_rows > 0) : ?>
                  <?php while ($row = $cuti_list->fetch_assoc()) : ?>
                    <tr>
                      <td><?= htmlspecialchars($row['nama_personel']) ?></td>
                      <td>
                        <?php if (strtolower($row['status']) == 'cuti') : ?>
                          <span class="badge bg-danger">Cuti</span>
                        <?php elseif (strtolower($row['status']) == 'ijin') : ?>
                          <span class="badge bg-info text-dark">Ijin</span>
                        <?php else : ?>
                          <?= htmlspecialchars($row['status']) ?>
                        <?php endif; ?>
                      </td>
                      <td><?= htmlspecialchars($row['kembali']) ?></td>
                    </tr>
                  <?php endwhile; ?>
                <?php else : ?>
                  <tr>
                    <td colspan="3" class="text-center">Tidak ada personel yang sedang cuti atau ijin</td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>