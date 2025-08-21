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
      console.log('DataTable initialization started...');
      
      // Cek apakah halaman menggunakan tabel dengan rowspan (laporan)
      var currentPage = window.location.href;
      var hasRowspan = $('#data tbody tr td[rowspan]').length > 0;
      
      console.log('Current page:', currentPage);
      console.log('Has rowspan:', hasRowspan);
      console.log('Table found:', $('#data').length > 0);
      
      // Jika bukan halaman laporan dan tidak ada rowspan, inisialisasi DataTable
      if (!currentPage.includes('laporan') && !hasRowspan && $('#data').length) {
        console.log('Initializing DataTable...');
        
        try {
          var table = $('#data').DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "pageLength": 10,
            "searching": true,
            "ordering": true,
            "info": true,
            "paging": true,
            "processing": false,
            "serverSide": false,
            "language": {
              "search": "Cari:",
              "lengthMenu": "Tampilkan _MENU_ data per halaman",
              "zeroRecords": "Tidak ada data yang ditemukan",
              "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
              "infoEmpty": "Tidak ada data yang tersedia",
              "infoFiltered": "(difilter dari _MAX_ total data)",
              "paginate": {
                "first": "Pertama",
                "last": "Terakhir",
                "next": "Selanjutnya",
                "previous": "Sebelumnya"
              },
              "emptyTable": "Tidak ada data yang tersedia di tabel",
              "loadingRecords": "Memuat...",
              "processing": "Memproses..."
            },
            "dom": '<"row mb-3"<"col-md-6 d-flex align-items-center"B><"col-md-6 d-flex justify-content-end"f>>' +
              'rt' +
              '<"row mt-3"<"col-md-6 d-flex align-items-center"i><"col-md-6 d-flex justify-content-end"p>>',
            "buttons": [
              {
                className: 'btn-success btn-sm me-2 rounded-2',
                extend: 'excel',
                text: 'Excel',
                exportOptions: {
                  columns: ':visible:not(:last-child)' // Exclude action column
                }
              },
              {
                className: 'btn-danger btn-sm me-2 rounded-2',
                extend: 'pdf',
                text: 'PDF',
                exportOptions: {
                  columns: ':visible:not(:last-child)' // Exclude action column
                },
                orientation: 'landscape',
                pageSize: 'A4'
              },
              {
                className: 'btn-secondary btn-sm me-2 rounded-2',
                extend: 'print',
                text: 'Print',
                exportOptions: {
                  columns: ':visible:not(:last-child)' // Exclude action column
                }
              }
            ],
            "columnDefs": [
              {
                "targets": -1, // Last column (Action)
                "orderable": false,
                "searchable": false,
                "className": "no-export"
              },
              {
                "targets": 0, // First column (No)
                "orderable": true,
                "searchable": false,
                "width": "50px"
              },
              {
                "targets": 1, // Nama Personel column - PASTIKAN BISA DICARI
                "orderable": true,
                "searchable": true,
                "type": "string"
              },
              {
                "targets": [2, 3, 4, 5], // Status, Keterangan, Berangkat, Kembali
                "orderable": true,
                "searchable": true
              }
            ],
            "order": [[0, 'asc']], // Sort by No column by default
            "searchCols": [
              null, // No column - tidak dicari
              null, // Nama Personel - bisa dicari (default)
              null, // Status - bisa dicari (default)
              null, // Keterangan - bisa dicari (default)  
              null, // Berangkat - bisa dicari (default)
              null, // Kembali - bisa dicari (default)
              null  // Action - tidak dicari
            ]
          });
          
          console.log('DataTable initialized successfully');
          console.log('Total rows:', table.rows().count());
          
          // Debug search functionality
          $('.dataTables_filter input').on('keyup change', function() {
            var searchValue = this.value;
            console.log('Search input:', searchValue);
            
            // Trigger search dengan delay
            setTimeout(function() {
              var filteredRows = table.rows({search: 'applied'}).count();
              console.log('Filtered rows:', filteredRows);
            }, 100);
          });
          
        } catch (error) {
          console.error('Error initializing DataTable:', error);
        }
        
      } else if (currentPage.includes('laporan') || hasRowspan) {
        // Untuk halaman laporan dengan rowspan, disable DataTable
        console.log('DataTable disabled for this page due to rowspan structure');
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