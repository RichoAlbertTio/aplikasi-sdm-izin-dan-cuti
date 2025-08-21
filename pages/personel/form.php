<?php $personel = $conn->query("SELECT * FROM personel INNER JOIN divisi ON personel.id_divisi = divisi.id ORDER BY personel.id DESC");
$divisi = $conn->query("SELECT * FROM divisi ")
?>

<div class="content-wrapper">
  <div class="row">

    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Form personel</h4>
          <p class="card-description"> <a href="?page=personel" class="btn btn-primary">kembali</a>
          </p>
          <p class="card-description"> Form Tambah Personel </p>
          <form class="forms-sample" action="pages/personel/proses/insert.php" method="POST">

            <div class="form-group">
              <label for="nama_personel">Nama</label>
              <input type="text" class="form-control" name="nama_personel" id="nama_personel" placeholder="Masukan Nama personel" required>
            </div>

            <div class="form-group">
              <label for="nrp">NRP</label>
              <input type="text" class="form-control" name="nrp" id="nrp" placeholder="Masukan nrp" required>
            </div>

            <div class="form-group">
              <label for="pangkat">Pangkat</label>
              <input type="text" class="form-control" name="pangkat" id="pangkat" placeholder="Masukan pangkat" required>
            </div>

            <div class="form-group">
              <label for="id_divisi">Divisi</label>
              <select class="form-select" name="id_divisi" id="id_divisi" required>
                <option value="" disabled selected>Pilih Nama Divisi</option>
                <?php foreach ($divisi as $dip) : ?>
                  <option class="text-dark" value="<?= $dip['id'] ?>">
                    <?= $dip['nama_divisi'] ?>
                  </option>

                <?php endforeach; ?>
              </select>
            </div>

            <div class="form-group">
              <label for="no_hp">No Hp</label>
              <input type="text" class="form-control" name="no_hp" id="no_hp" placeholder="Masukan No Hp" required>
            </div>

            <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
            <a href="?page=personel" class="btn btn-light">Cancel</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>