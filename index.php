<?php
session_start();
if (!isset($_SESSION['username'])) {
  header('location: login.php');
}
require_once 'config/connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- notifikasi -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Data Cuti dan Ijin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="assets/css/style.css">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="assets/images/favicon.ico" />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" />
  <!-- DataTables CSS dari CDN sebagai alternatif -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" />
    <!-- plugins:js -->
  <script src="assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="assets2/js/jquery-3.7.1.min.js"></script>
  <script src="assets/vendors/chart.js/Chart.min.js"></script>
  <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="assets/js/off-canvas.js"></script>
  <script src="assets/js/hoverable-collapse.js"></script>
  <!-- <script src="assets/js/misc.js"></script> -->
  <!-- endinject -->
  <!-- Custom js for this page -->
  <script src="assets/js/dashboard.js"></script>
  <script src="assets/js/todolist.js"></script>
  <!-- End custom js for this page -->
  <!-- <script src="assets/js/plugin/datatables/datatables.min.js"></script> -->

  <!-- DataTables JS dari CDN sebagai alternatif -->
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <?php include 'layouts/navbar.php'; ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <?php include 'layouts/sidebar.php'; ?>
      <!-- partial -->
      <div class="main-panel">
        <?php include 'layouts/content.php'; ?>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <?php include 'layouts/footer.php'; ?>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <script>
    $(document).ready(function() {
      // Hanya inisialisasi DataTables untuk tabel yang tidak menggunakan rowspan
      var currentPage = window.location.pathname;
      
      if ($('#data').length && !$('#data tbody tr td[rowspan]').length) {
        $('#data').DataTable({
          lengthChange: false,
          pageLength: 5,
          dom: '<"row mb-3"<"col-md-6 d-flex align-items-center"B><"col-md-6 d-flex justify-content-end"f>>' +
            'rt' +
            '<"row mt-3"<"col-md-6 d-flex align-items-center"i><"col-md-6 d-flex justify-content-end"p>>',
          buttons: [{
              className: 'btn-success btn-sm me-2 rounded-2',
              extend: 'excel',
              text: 'Excel'
            },
            {
              className: 'btn-danger btn-sm me-2 rounded-2',
              extend: 'pdf',
              text: 'PDF'
            },
            {
              className: 'btn-secondary btn-sm me-2 rounded-2',
              extend: 'print',
              text: 'Print'
            }
          ]
        });
      }
    });
  </script>


  <?php if (isset($_SESSION['success'])) : ?>
    <script>
      Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: '<?= $_SESSION['success']; ?>',
        showConfirmButton: false,
        timer: 2000
      });
    </script>
  <?php unset($_SESSION['success']);
  endif; ?>

  <?php if (isset($_SESSION['error'])) : ?>
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: '<?= $_SESSION['error']; ?>',
        showConfirmButton: false,
        timer: 2000
      });
    </script>
  <?php unset($_SESSION['error']);
  endif; ?>

</body>

</html>