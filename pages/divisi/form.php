<div class="content-wrapper">
  <div class="row">

    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Form Divisi</h4>
          <p class="card-description"> <a href="?page=divisi" class="btn btn-primary">kembali</a>
          </p>
          <p class="card-description"> Form Tambah Divisi </p>
          <form class="forms-sample" action="pages/divisi/proses/insert.php" method="POST">

            <div class="form-group">
              <label for="nama_divisi">Nama Divisi</label>
              <input type="text" class="form-control" name="nama_divisi" id="nama_divisi" placeholder="Masukan Nama Divisi" required>
            </div>

            <div class="form-group">
              <label for="deskripsi">Deskripsi</label>
              <input type="text" class="form-control" name="deskripsi" id="deskripsi" placeholder="Masukan deskripsi" required>
            </div>

            <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
            <a href="?page=divisi" class="btn btn-light">Cancel</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>