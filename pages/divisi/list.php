<?php $divisi = $conn->query("SELECT * FROM divisi ORDER BY id DESC");
?>
<div class="content-wrapper">
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Data Divisi</h4>
          <p class="card-description"> <a href="?page=form-divisi" class="btn btn-primary">Tambah Divisi</a>
          </p>


          <table class="table table-bordered">
            <thead>
              <tr>
                <th> No </th>
                <th> Divisi </th>
                <th> Deskripsi </th>
                <th class="text-center"> Action </th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1; ?>
              <?php foreach ($divisi as $dip) : ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= $dip['nama_divisi'] ?></td>
                  <td><?= $dip['deskripsi'] ?></td>
                  <td class="text-center">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#edit-dip<?= $dip['id'] ?>" class="btn btn-sm btn-success ">

                      <span class="mdi mdi-pencil"></span>
                    </button>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#delete-dip<?= $dip['id'] ?>" class="btn btn-sm btn-danger">
                      <span class="mdi mdi-delete-outline"></span></button>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="edit-dip<?= $dip['id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">

                          <div class="modal-header border-0">
                            <h5 class="modal-title">
                              <span class="fw-mediumbold"> Edit </span>
                              <span class="fw-light"> Divisi </span>
                            </h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>

                          <div class="modal-body">
                            <p class="small">
                              Edit Data Divisi
                            </p>

                            <form class="needs-validation" action="pages/divisi/proses/edit.php" method="POST" novalidate>
                              <div class="row">
                                <input type="hidden" name="id_divisi" value="<?= $dip['id'] ?>">

                                <div class="col-sm-12">
                                  <div class="form-group form-group-default">
                                    <label for="nama_divisi" class="form-label">Nama Divisi</label>

                                    <input name="nama_divisi" id="nama_divisi" type="text" class="form-control" value="<?= $dip['nama_divisi'] ?>" required>
                                  </div>
                                  <div class="invalid-feedback">
                                    Please enter this name
                                  </div>
                                </div>

                                <div class="col-sm-12">
                                  <div class="form-group form-group-default">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <input name="deskripsi" id="deskripsi" type="text" class="form-control" value="<?= $dip['deskripsi'] ?>" required>
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
                    <div class="modal fade" id="delete-dip<?= $dip['id'] ?>" tabindex="-1" role="dialog">
                      <div class="modal-dialog" role="document">
                        <form action="pages/divisi/proses/delete.php" method="POST">
                          <div class="modal-content">
                            <div class="modal-header">

                              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <input type="hidden" name="id_divisi" value="<?= $dip['id'] ?>">
                              <div class="alert alert-danger">
                                Apakah Yakin Ingin Menghapus
                                <b><?= $dip['nama_divisi'] ?></b> ini?
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