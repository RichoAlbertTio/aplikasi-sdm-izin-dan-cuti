<style>
    /* Custom CSS untuk tabel laporan */
    #data {
        font-size: 14px;
    }

    #data td {
        vertical-align: middle;
        padding: 8px 12px;
    }

    #data .total-row {
        background-color: #f8f9fa !important;
        font-weight: bold;
        border-top: 2px solid #dee2e6;
    }

    #data .total-row td {
        text-align: right;
        font-size: 13px;
    }


    /* Styling untuk rowspan cells */
    #data td[rowspan] {
        border-right: 2px solid #dee2e6;
        background-color: #f9f9f9;
    }

    /* Print styling */
    @media print {

        .btn,
        .float-right,
        #searchInput, #searchContainer {
            display: none !important;
        }

        .card-title {
            text-align: center;
            margin-bottom: 20px;
        }

        #data {
            font-size: 12px;
        }

        #data td {
            padding: 6px 8px;
        }
    }
</style>
<?php
// Query untuk mendapatkan data lengkap per personel
$laporan = $conn->query("
    SELECT 
        p.id as personel_id,
        p.nama_personel,
        GROUP_CONCAT(
            DISTINCT CONCAT(ci.status, '|', ci.keterangan, '|', ci.berangkat, '|', ci.kembali)
            ORDER BY ci.status, ci.berangkat SEPARATOR ';'
        ) as detail_data,
        SUM(CASE WHEN ci.status = 'Cuti' THEN 1 ELSE 0 END) as total_cuti,
        SUM(CASE WHEN ci.status = 'Ijin' THEN 1 ELSE 0 END) as total_ijin
    FROM personel p
    LEFT JOIN cuti_ijin ci ON p.id = ci.id_personel
    WHERE ci.id IS NOT NULL
    GROUP BY p.id, p.nama_personel
    ORDER BY p.nama_personel
");
?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Data Laporan Cuti dan Ijin Per Personel</h4>

                    <!-- Tombol Export -->
                    <div class="mb-3 d-flex justify-content-between align-items-center">
                        <div class="d-block">
                            <button class="btn btn-success btn-sm" onclick="exportToExcelSimple()">
                                 Excel
                            </button>
                            <button class="btn btn-danger btn-sm" onclick="exportToPDF()">
                                PDF
                            </button>
                            <button class="btn btn-secondary btn-sm" onclick="printReport()">
                                 Print
                            </button>
                        </div>

                        <div id="searchContainer">
                            <label>Search:</label>
                            <input type="text" id="searchInput" class="form-control form-control-sm d-inline-block"
                                style="width: 200px;" placeholder="Cari nama personel...">
                        </div>
                    </div>

                    <!-- Tabel Laporan Gabungan -->
                    <table class="table table-bordered" id="data">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Personel</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                                <th>Berangkat</th>
                                <th>Kembali</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($laporan as $lap) : ?>
                            <?php
                            // Parse data detail
                            $detail_items = explode(';', $lap['detail_data']);
                            $row_count = count($detail_items);
                            $first_row = true;
                            ?>

                            <?php foreach ($detail_items as $index => $item) : ?>
                            <?php
                            $parts = explode('|', $item);
                            $status = $parts[0];
                            $keterangan = $parts[1];
                            $berangkat = $parts[2];
                            $kembali = $parts[3];
                            ?>
                            <tr>
                                <?php if ($first_row) : ?>
                                <td rowspan="<?= $row_count + 1 ?>"><?= $no ?></td>
                                <td rowspan="<?= $row_count + 1 ?>"><?= $lap['nama_personel'] ?></td>
                                <?php endif; ?>

                                <td>
                                    <?= $status ?>
                                </td>
                                <td><?= $keterangan ?></td>
                                <td><?= date('d/m/Y', strtotime($berangkat)) ?></td>
                                <td><?= date('d/m/Y', strtotime($kembali)) ?></td>
                            </tr>
                            <?php $first_row = false; ?>
                            <?php endforeach; ?>

                            <!-- Baris Total -->
                            <tr class="total-row">
                                <td colspan="2" class="text-right">
                                    Total Cuti: <?= $lap['total_cuti'] ?>
                                </td>
                                <td colspan="2" class="text-right">
                                    Total Ijin: <?= $lap['total_ijin'] ?>
                                </td>
                            </tr>

                            <?php $no++; ?>
                            <?php endforeach ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>



<script>
    // Fungsi untuk export ke Excel
    function exportToExcel() {
        // Query data dari PHP untuk export
        var exportData = [];
        
        // Header Excel
        exportData.push(['No', 'Nama Personel', 'Status', 'Keterangan', 'Berangkat', 'Kembali']);
        
        <?php 
        // Reset pointer untuk export
        mysqli_data_seek($laporan, 0);
        $no_excel = 1;
        ?>
        
        <?php foreach ($laporan as $lap) : ?>
            <?php 
            $detail_items = explode(';', $lap['detail_data']);
            $first_detail = true;
            ?>
            
            <?php foreach ($detail_items as $item) : ?>
                <?php 
                $parts = explode('|', $item);
                $status = $parts[0];
                $keterangan = $parts[1];
                $berangkat = $parts[2];
                $kembali = $parts[3];
                
                // Format tanggal untuk Excel
                $tanggal_berangkat = date('d/m/Y', strtotime($berangkat));
                $tanggal_kembali = date('d/m/Y', strtotime($kembali));
                ?>
                
                <?php if ($first_detail) : ?>
                    exportData.push([
                        '<?= $no_excel ?>',
                        '<?= addslashes($lap['nama_personel']) ?>',
                        '<?= $status ?>',
                        '<?= $keterangan ?>',
                        '<?= $tanggal_berangkat ?>',
                        '<?= $tanggal_kembali ?>'
                    ]);
                    <?php $first_detail = false; ?>
                <?php else : ?>
                    exportData.push([
                        '',
                        '',
                        '<?= $status ?>',
                        '<?= $keterangan ?>',
                        '<?= $tanggal_berangkat ?>',
                        '<?= $tanggal_kembali ?>'
                    ]);
                <?php endif; ?>
            <?php endforeach; ?>
            
            // Tambahkan baris total
            exportData.push([
                '',
                '',
                'Total Cuti: <?= $lap['total_cuti'] ?>',
                'Total Ijin: <?= $lap['total_ijin'] ?>',
                '',
                ''
            ]);
            
            // Tambahkan baris kosong sebagai pemisah
            exportData.push(['', '', '', '', '', '']);
            
            <?php $no_excel++; ?>
        <?php endforeach; ?>
        
        // Buat worksheet
        var ws = XLSX.utils.aoa_to_sheet(exportData);
        
        // Set column width
        ws['!cols'] = [
            {wch: 5},   // No
            {wch: 20},  // Nama Personel
            {wch: 10},  // Status
            {wch: 15},  // Keterangan
            {wch: 12},  // Berangkat
            {wch: 12}   // Kembali
        ];
        
        // Merge cells untuk nama personel (simulasi rowspan)
        if (!ws['!merges']) ws['!merges'] = [];
        
        var currentRow = 1; // Start from row 1 (after header)
        <?php 
        mysqli_data_seek($laporan, 0);
        $merge_row = 1;
        ?>
        
        <?php foreach ($laporan as $lap) : ?>
            <?php 
            $detail_items = explode(';', $lap['detail_data']);
            $row_count = count($detail_items);
            ?>
            
            // Merge cells untuk No dan Nama Personel
            if (<?= $row_count ?> > 1) {
                ws['!merges'].push({
                    s: {r: <?= $merge_row ?>, c: 0}, // Start: row, col
                    e: {r: <?= $merge_row + $row_count - 1 ?>, c: 0}  // End: row, col
                });
                ws['!merges'].push({
                    s: {r: <?= $merge_row ?>, c: 1}, // Start: row, col
                    e: {r: <?= $merge_row + $row_count - 1 ?>, c: 1}  // End: row, col
                });
            }
            
            <?php $merge_row += $row_count + 2; // +2 for total row and empty row ?>
        <?php endforeach; ?>
        
        // Buat workbook dan export
        var wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, "Laporan Cuti Ijin");
        
        // Set properties
        wb.Props = {
            Title: "Laporan Cuti dan Ijin Per Personel",
            Author: "Sistem SDM",
            CreatedDate: new Date()
        };
        
        // Download file
        XLSX.writeFile(wb, 'laporan_cuti_ijin_' + new Date().toISOString().slice(0, 10) + '.xlsx');
    }


    // Fungsi untuk export ke PDF
    function exportToPDF() {
        // Siapkan data untuk PDF
        var pdfData = [];
        
        // Header
        pdfData.push(['No', 'Nama Personel', 'Status', 'Keterangan', 'Berangkat', 'Kembali']);
        
        <?php 
        mysqli_data_seek($laporan, 0);
        $no_pdf = 1;
        foreach ($laporan as $lap) {
            $detail_items = explode(';', $lap['detail_data']);
            foreach ($detail_items as $index => $item) {
                $parts = explode('|', $item);
                $status = $parts[0];
                $keterangan = $parts[1];
                $berangkat = date('d/m/Y', strtotime($parts[2]));
                $kembali = date('d/m/Y', strtotime($parts[3]));
                
                if ($index == 0) {
                    echo "pdfData.push(['{$no_pdf}', '" . addslashes($lap['nama_personel']) . "', '{$status}', '{$keterangan}', '{$berangkat}', '{$kembali}']);\n";
                } else {
                    echo "pdfData.push(['', '', '{$status}', '{$keterangan}', '{$berangkat}', '{$kembali}']);\n";
                }
            }
            // Baris total
            echo "pdfData.push(['', '', 'Total Cuti: {$lap['total_cuti']}', 'Total Ijin: {$lap['total_ijin']}', '', '']);\n";
            echo "pdfData.push(['', '', '', '', '', '']);\n"; // Baris kosong
            $no_pdf++;
        }
        ?>
        
        // Buat PDF menggunakan jsPDF
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF({
            orientation: 'landscape',
            unit: 'mm',
            format: 'a4'
        });
        
        // Set font
        doc.setFont('helvetica');
        
        // Judul
        doc.setFontSize(16);
        doc.setFont('helvetica', 'bold');
        doc.text('LAPORAN CUTI DAN IJIN PER PERSONEL', 148, 20, { align: 'center' });
        
        // Tanggal generate
        doc.setFontSize(10);
        doc.setFont('helvetica', 'normal');
        doc.text('Digenerate pada: ' + new Date().toLocaleDateString('id-ID'), 148, 28, { align: 'center' });
        
        // Tabel menggunakan autoTable
        doc.autoTable({
            head: [pdfData[0]],
            body: pdfData.slice(1),
            startY: 35,
            styles: {
                fontSize: 8,
                cellPadding: 2,
                valign: 'middle'
            },
            headStyles: {
                fillColor: [54, 96, 146], // Biru
                textColor: [255, 255, 255], // Putih
                fontStyle: 'bold',
                halign: 'center'
            },
            bodyStyles: {
                textColor: [0, 0, 0]
            },
            columnStyles: {
                0: { cellWidth: 15, halign: 'center' }, // No
                1: { cellWidth: 50 }, // Nama Personel
                2: { cellWidth: 25, halign: 'center' }, // Status
                3: { cellWidth: 35 }, // Keterangan
                4: { cellWidth: 30, halign: 'center' }, // Berangkat
                5: { cellWidth: 30, halign: 'center' }  // Kembali
            },
            didParseCell: function(data) {
                // Highlight baris total
                if (data.cell.text[0] && data.cell.text[0].includes('Total')) {
                    data.cell.styles.fillColor = [248, 249, 250]; // Abu-abu terang
                    data.cell.styles.fontStyle = 'bold';
                }
            },
            margin: { top: 35, right: 10, bottom: 20, left: 10 }
        });
        
        // Footer
        const pageCount = doc.internal.getNumberOfPages();
        for (let i = 1; i <= pageCount; i++) {
            doc.setPage(i);
            doc.setFontSize(8);
            doc.text(`Halaman ${i} dari ${pageCount}`, 148, doc.internal.pageSize.height - 10, { align: 'center' });
        }
        
        // Download PDF
        const fileName = 'Laporan_Cuti_Ijin_' + new Date().toISOString().slice(0, 10).replace(/-/g, '') + '.pdf';
        doc.save(fileName);
        
        // Notifikasi sukses
        alert('File PDF berhasil di-download dengan nama: ' + fileName);
    }

    // Fungsi untuk export Excel alternatif (lebih sederhana dan rapi)
    function exportToExcelSimple() {
        var exportData = [];
        
        // Header dengan styling
        exportData.push(['No', 'Nama Personel', 'Status', 'Keterangan', 'Berangkat', 'Kembali']);
        
        // Data langsung dari PHP
        <?php 
        mysqli_data_seek($laporan, 0);
        $no = 1;
        foreach ($laporan as $lap) {
            $detail_items = explode(';', $lap['detail_data']);
            foreach ($detail_items as $index => $item) {
                $parts = explode('|', $item);
                $status = $parts[0];
                $keterangan = $parts[1];
                $berangkat = date('d/m/Y', strtotime($parts[2]));
                $kembali = date('d/m/Y', strtotime($parts[3]));
                
                if ($index == 0) {
                    echo "exportData.push(['{$no}', '" . addslashes($lap['nama_personel']) . "', '{$status}', '{$keterangan}', '{$berangkat}', '{$kembali}']);\n";
                } else {
                    echo "exportData.push(['', '', '{$status}', '{$keterangan}', '{$berangkat}', '{$kembali}']);\n";
                }
            }
            // Baris total dengan format yang lebih jelas
            echo "exportData.push(['', '', 'Total Cuti: {$lap['total_cuti']}', 'Total Ijin: {$lap['total_ijin']}', '', '']);\n";
            echo "exportData.push(['', '', '', '', '', '']);\n"; // Baris kosong sebagai pemisah
            $no++;
        }
        ?>
        
        // Buat worksheet
        var ws = XLSX.utils.aoa_to_sheet(exportData);
        
        // Set column width yang lebih baik
        ws['!cols'] = [
            {wch: 6},   // No - sedikit lebih lebar
            {wch: 25},  // Nama Personel - lebih lebar
            {wch: 12},  // Status - lebih lebar
            {wch: 18},  // Keterangan - lebih lebar
            {wch: 15},  // Berangkat - lebih lebar
            {wch: 15}   // Kembali - lebih lebar
        ];
        
        // Style header row
        var range = XLSX.utils.decode_range(ws['!ref']);
        for (var C = range.s.c; C <= range.e.c; ++C) {
            var address = XLSX.utils.encode_cell({r: 0, c: C});
            if (!ws[address]) continue;
            if (!ws[address].s) ws[address].s = {};
            ws[address].s.font = {bold: true, color: {rgb: "FFFFFF"}};
            ws[address].s.fill = {fgColor: {rgb: "FF366092"}};
            ws[address].s.alignment = {horizontal: "center", vertical: "center"};
        }
        
        // Style untuk baris total
        for (var R = 1; R <= range.e.r; ++R) {
            var cell_c = ws[XLSX.utils.encode_cell({r: R, c: 2})];
            if (cell_c && cell_c.v && cell_c.v.toString().includes('Total')) {
                for (var C = 0; C <= 5; ++C) {
                    var address = XLSX.utils.encode_cell({r: R, c: C});
                    if (!ws[address]) ws[address] = {t: "s", v: ""};
                    if (!ws[address].s) ws[address].s = {};
                    ws[address].s.font = {bold: true};
                    ws[address].s.fill = {fgColor: {rgb: "FFF2F2F2"}};
                }
            }
        }
        
        // Buat workbook
        var wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, "Laporan Cuti Ijin");
        
        // Set properties workbook
        wb.Props = {
            Title: "Laporan Cuti dan Ijin Per Personel",
            Subject: "Data Cuti dan Ijin Karyawan",
            Author: "Sistem SDM",
            Manager: "Admin SDM",
            Company: "Perusahaan",
            Category: "Laporan",
            Keywords: "Cuti, Ijin, Laporan, SDM",
            CreatedDate: new Date()
        };
        
        // Download file dengan nama yang lebih deskriptif
        var fileName = 'Laporan_Cuti_Ijin_' + new Date().toISOString().slice(0, 10).replace(/-/g, '') + '.xlsx';
        XLSX.writeFile(wb, fileName);
        
        // Notifikasi sukses
        alert('File Excel berhasil di-export dengan nama: ' + fileName);
    }

    // Fungsi untuk print
    function printReport() {
        var printContents = document.querySelector('.card-body').innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = `
        <html>
        <head>
            <title>Laporan Cuti dan Ijin</title>
            <style>
                body { font-family: Arial, sans-serif; }
                table { border-collapse: collapse; width: 100%; }
                th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                th { background-color: #f2f2f2; }
                .total-row { background-color: #f8f9fa; font-weight: bold; }
                .btn { display: none; }
                .float-right { display: none; }
                #searchInput, #searchContainer { display: none; }
            </style>
        </head>
        <body>
            ${printContents}
        </body>
        </html>
    `;

        window.print();
        document.body.innerHTML = originalContents;
        location.reload();
    }

    // Fungsi search sederhana
    document.getElementById('searchInput').addEventListener('keyup', function() {
        var input = this.value.toLowerCase();
        var table = document.getElementById('data');
        var rows = table.getElementsByTagName('tr');

        for (var i = 1; i < rows.length; i++) {
            var nameCell = rows[i].getElementsByTagName('td')[1];
            if (nameCell) {
                var name = nameCell.textContent || nameCell.innerText;
                var rowspan = nameCell.getAttribute('rowspan');

                if (name.toLowerCase().indexOf(input) > -1) {
                    rows[i].style.display = '';
                    if (rowspan) {
                        var spanCount = parseInt(rowspan);
                        for (var j = 1; j < spanCount; j++) {
                            if (rows[i + j]) {
                                rows[i + j].style.display = '';
                            }
                        }
                        i += spanCount - 1;
                    }
                } else {
                    rows[i].style.display = 'none';
                    if (rowspan) {
                        var spanCount = parseInt(rowspan);
                        for (var j = 1; j < spanCount; j++) {
                            if (rows[i + j]) {
                                rows[i + j].style.display = 'none';
                            }
                        }
                        i += spanCount - 1;
                    }
                }
            }
        }
    });
</script>

<!-- Include XLSX library untuk export Excel -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

<!-- Include jsPDF library untuk export PDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.31/jspdf.plugin.autotable.min.js"></script>
