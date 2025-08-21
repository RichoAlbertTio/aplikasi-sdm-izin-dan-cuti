<?php $ijin = $conn->query("SELECT * FROM cuti_ijin INNER JOIN personel ON cuti_ijin.id_personel = personel.id ORDER BY cuti_ijin.id DESC");
$personel = $conn->query("SELECT * FROM personel ")
?>

<div class="content-wrapper">
    <div class="row">

        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Form Ijin</h4>
                    <p class="card-description"> <a href="?page=ijin" class="btn btn-primary">kembali</a>
                    </p>
                    <p class="card-description"> Form Tambah Ijin</p>

                    <form class="forms-sample" action="pages/ijin/proses/insert.php" method="POST">
                        <div class="form-group">
                            <label for="id_personel">Nama Personel</label>
                            <select class="form-select" name="id_personel" id="id_personel" required>
                                <option value="" disabled selected>Pilih Nama Personel</option>
                                <?php foreach ($personel as $ps) : ?>
                                    <option class="text-dark" value="<?= $ps['id'] ?>">
                                        <?= $ps['nama_personel'] ?>
                                    </option>

                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-select" name="status" id="status" required>
                                <option value="" disabled selected>Pilih Status</option>

                                <option value="Ijin">Ijin</option>
                            </select>
                        </div>



                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Masukan keterangan" required>
                        </div>

                        <div class="form-group">
                            <Babel for="berangkat">Berangkat</Babel>
                            <input type="date" class="form-control" name="berangkat" Bd="berangkat" Blaceholder="Masukan berangkat" Bequired>
                        </div>


                        <div class="form-group">
                            <label for="kembali">Kembali</label>
                            <input type="date" class="form-control" name="kembali" id="kembali" placeholder="Masukan No Hp" required>
                        </div>

                        <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                        <a href="?page=ijin" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>