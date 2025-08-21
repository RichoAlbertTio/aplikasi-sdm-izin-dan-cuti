<!-- untuk menghubungkan dari divisi -->
<?php
$personel = $conn->query("SELECT personel.*, divisi.id as divisi_id, divisi.nama_divisi as nama_divisi FROM personel INNER JOIN divisi ON personel.id_divisi = divisi.id ORDER BY personel.id DESC");
$divisi = $conn->query("SELECT * FROM divisi ")
?>

<div class="content-wrapper">
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Data Personel</h4>
          <p class="card-description"> <a href="?page=form-personel" class="btn btn-primary">Tambah Personel</a>
          </p>



          <table class="table table-bordered" id="data">
            <thead>
              <tr>
                <th> No </th>
                <th> Nama Personel </th>
                <th> NRP </th>
                <th> Pangkat </th>
                <th> Divisi </th>
                <th> No. Hp </th>
                <th class="text-center"> Action </th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1; ?>
              <?php foreach ($personel as $ps) : ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= $ps['nama_personel'] ?></td>
                  <td><?= $ps['nrp'] ?></td>
                  <td><?= $ps['pangkat'] ?></td>
                  <td><?= $ps['nama_divisi'] ?></td>
                  <td><?= $ps['no_hp'] ?></td>
                  <td class="text-center">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#edit-ps<?= $ps['id'] ?>" class="btn btn-sm btn-success ">

                      <span class="mdi mdi-pencil"></span>
                    </button>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#delete-ps<?= $ps['id'] ?>" class="btn btn-sm btn-danger">
                      <span class="mdi mdi-delete-outline"></span></button>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="edit-ps<?= $ps['id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">

                          <div class="modal-header border-0">
                            <h5 class="modal-title">
                              <span class="fw-mediumbold"> Edit </span>
                              <span class="fw-light"> Personel </span>
                            </h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>

                          <div class="modal-body">
                            <p class="small">
                              Edit Data Personel
                            </p>

                            <form class="needs-validation" action="pages/personel/proses/edit.php" method="POST" novalidate>
                              <div class="row">
                                <input type="hidden" name="id" value="<?= $ps['id'] ?>">

                                <div class="col-sm-12">
                                  <div class="form-group form-group-default">
                                    <label for="nama_personel" class="form-label">nama</label>

                                    <input name="nama_personel" id="nama_personel" type="text" class="form-control" value="<?= $ps['nama_personel'] ?>" required>
                                  </div>
                                  <div class="invalid-feedback">
                                    Please enter this name
                                  </div>
                                </div>

                                <div class="col-sm-12">
                                  <div class="form-group form-group-default">
                                    <label for="nrp" class="form-label">NRP</label>
                                    <input name="nrp" id="nrp" type="text" class="form-control" value="<?= $ps['nrp'] ?>" required>
                                  </div>
                                </div>

                                <div class="col-sm-12">
                                  <div class="form-group form-group-default">
                                    <label for="pangkat" class="form-label">Pangkat</label>
                                    <input name="pangkat" id="pangkat" type="text" class="form-control" value="<?= $ps['pangkat'] ?>" required>
                                  </div>
                                </div>
                                <div class="col-sm-12">
                                  <div class="form-group form-group-default">
                                    <label for="id_divisi" class="form-label">Nama Divisi</label>
                                    <select name="id_divisi" id="id_divisi" class="form-control text-dark" required>
                                      <?php
                                      // Ambil semua divisi
                                      $divisi_all = $conn->query("SELECT * FROM divisi");
                                      while ($dv = $divisi_all->fetch_assoc()) {
                                        $selected = ($dv['id'] == $ps['divisi_id']) ? 'selected' : '';
                                        echo "<option value='{$dv['id']}' {$selected}>{$dv['nama_divisi']}</option>";
                                      }
                                      ?>
                                    </select>
                                  </div>
                                </div>


                                <div class="col-sm-12">
                                  <div class="form-group form-group-default">
                                    <label for="no_hp" class="form-label"> No hp</label>
                                    <input name="no_hp" id="no_hp" type="text" class="form-control" value="<?= $ps['no_hp'] ?>" required>
                                  </div>
                                </div>




                              </div>
                          </div>
                          <div class="modal-footer border-0">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                              Close
                            </button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- END modal edit -->

                    <!-- modal Hapus -->
                    <div class="modal fade" id="delete-ps<?= $ps['id'] ?>" tabindex="-1" role="dialog">
                      <div class="modal-dialog" role="document">
                        <form action="pages/personel/proses/delete.php" method="POST">
                          <div class="modal-content">
                            <div class="modal-header">

                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <input type="hidden" name="id_personel" value="<?= $ps['id'] ?>">
                              <div class="alert alert-danger">
                                Apakah Yakin Ingin Menghapus
                                <b><?= $ps['nama_personel'] ?></b> ini?
                              </div>

                            </div>
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-primary">Yes</button>
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                      </div>
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