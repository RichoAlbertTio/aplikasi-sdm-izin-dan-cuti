<!-- untuk menghubungkan dari personel -->
<?php
$cuti = $conn->query("SELECT cuti_ijin.*, personel.id as personel_id, personel.nama_personel as nama_personel FROM cuti_ijin INNER JOIN personel ON cuti_ijin.id_personel = personel.id WHERE cuti_ijin.status = 'cuti' ORDER BY cuti_ijin.id DESC");
$personel = $conn->query("SELECT * FROM personel ")
?>

<div class="content-wrapper">
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Data Cuti</h4>
          <p class="card-description"> <a href="?page=form-cuti" class="btn btn-primary">Tambah Cuti</a>
          </p>


          <table class="table table-bordered" id="data">
            <thead>
              <tr>
                <th> No </th>
                <th> Nama Personel </th>
                <th> Status</th>
                <th> Keterangan</th>
                <th> Berangkat </th>
                <th> Kembali </th>
                <th class="text-center"> Action </th>
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
                  <td><?= $ct['kembali'] ?></td>
                  <td class="text-center">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#edit-cuti<?= $ct['id'] ?>" class="btn btn-sm btn-success ">

                      <span class="mdi mdi-pencil"></span>
                    </button>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#delete-cuti<?= $ct['id'] ?>" class="btn btn-sm btn-danger">
                      <span class="mdi mdi-delete-outline"></span></button>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="edit-cuti<?= $ct['id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">

                          <div class="modal-header border-0">
                            <h5 class="modal-title">
                              <span class="fw-mediumbold"> Edit </span>
                              <span class="fw-light"> Cuti </span>
                            </h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>

                          <div class="modal-body">
                            <p class="small">
                              Edit Data Cuti
                            </p>

                            <form class="needs-validation" action="pages/cuti/proses/edit.php" method="POST" novalidate>
                              <div class="row">
                                <input type="hidden" name="id" value="<?= $ct['id'] ?>">

                                <div class="col-sm-12">
                                  <div class="form-group form-group-default">
                                    <label for="id_personel" class="form-label">Nama Personel</label>
                                    <select name="id_personel" id="id_personel" class="form-control text-dark" required>
                                      <?php
                                      $personel_all = $conn->query("SELECT * FROM personel");
                                      while ($ps = $personel_all->fetch_assoc()) {
                                        $selected = ($ps['id'] == $ct['personel_id']) ? 'selected' : '';
                                        echo "<option value='{$ps['id']}' {$selected}>{$ps['nama_personel']}</option>";
                                      }
                                      ?>
                                    </select>
                                  </div>
                                </div>


                                <div class="col-sm-12">
                                  <div class="form-group form-group-default">
                                    <label for="status" class="form-label">Status</label>
                                    <input name="status" id="status" type="text" class="form-control" value="<?= $ct['status'] ?>" required>
                                  </div>
                                </div>
                                <div class="col-sm-12">
                                  <div class="form-group form-group-default">
                                    <label for="berangkat" class="form-label">Berangkat</label>
                                    <input name="berangkat" id="berangkat" type="date" class="form-control" value="<?= $ct['berangkat'] ?>" required>
                                  </div>
                                </div>
                                <div class="col-sm-12">
                                  <div class="form-group form-group-default">
                                    <label for="kembali" class="form-label">Kembali</label>
                                    <input name="kembali" id="kembali" type="date" class="form-control" value="<?= $ct['kembali'] ?>" required>
                                  </div>
                                </div>
                                <div class="col-sm-12">
                                  <div class="form-group form-group-default">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <textarea name="keterangan" id="keterangan" type="text" class="form-control" required><?= $ct['keterangan'] ?></textarea>
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
                    <div class="modal fade" id="delete-cuti<?= $ct['id'] ?>" tabindex="-1" role="dialog">
                      <div class="modal-dialog" role="document">
                        <form action="pages/cuti/proses/delete.php" method="POST">
                          <div class="modal-content">
                            <div class="modal-header">

                              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <input type="hidden" name="id" value="<?= $ct['id'] ?>">
                              <div class="alert alert-danger">
                                Apakah Yakin Ingin Menghapus
                                <b><?= $ct['nama_personel'] ?></b> ini?
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