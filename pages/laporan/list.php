<!-- untuk menghubungkan dari personel -->
<?php $cuti = $conn->query("SELECT cuti_ijin.*, personel.id as personel_id, personel.nama_personel as nama_personel FROM cuti_ijin INNER JOIN personel ON cuti_ijin.id_personel = personel.id  ORDER BY cuti_ijin.id DESC");
$personel = $conn->query("SELECT * FROM personel ")
?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Data Laporan</h4>



                    <table class="table table-bordered" id="data">
                        <thead>
                            <tr>
                                <th> No </th>
                                <th> Nama Personel </th>
                                <th> Status</th>
                                <th> Keterangan</th>
                                <th> Jumlah</th>
                                <th> Berangkat </th>
                                <th> Kembali </th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($cuti as $ct) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $ct['nama_personel'] ?></td>
                                    <td><?= $ct['status'] ?></td>
                                    <td><?= $ct['keterangan'] ?></td>
                                    <td><?= $ct['berangkat'] ?></td>
                                    <td><?= $ct['berangkat'] ?></td>
                                    <td><?= $ct['kembali'] ?></td>

                </div>




                </td>
                </tr>
            <?php endforeach ?>
            </tbody>
            </table>

            </div>
        </div>
    </div>

</div>
</div>