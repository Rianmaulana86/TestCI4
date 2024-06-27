<?= $this->extend('layouts/main') ?>



<?= $this->section('content') ?>


<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h6>Data Pegawai</h6>
            <br>
            <a class="btn btn-primary btn-sm" href="<?= base_url('pegawai/new') ?>">Tambah Data pegawai</a>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0" >
              <table class="table align-items-center mb-0" id="datatable">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Name</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Age</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Addres</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Gender</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Created At</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Updated At</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Action</th>
                  </tr>
                </thead>
                <tbody> 
                    <?php if (!empty($pegawai)): ?>
                        <?php foreach ($pegawai as $peg): ?>
                        <tr>
                            <td><?= $peg['no'] ?></td>
                            <td><?= $peg['name'] ?></td>
                            <td><?= $peg['age'] ?></td>
                            <td><?= $peg['addres'] ?></td>
                            <td>

                            <?php if ($peg['gender'] == 1): ?>
                              <i>Laki Laki</i>
                            <?php else: ?>
                              <i>Perempuan</i>
                            <?php endif; ?>
                            <td><?= $peg['created_at'] ?></td>
                            <td><?= $peg['updated_at'] ?></td>
                            <td>
                                <a href="<?= base_url('pegawai/'.$peg['id'].'/edit') ?>" class="btn btn-primary">Edit</a>
                                <form action="<?= site_url('pegawai/'.$peg['id']) ?>" method="post" style="display:inline;">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this pegawai?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">No data available</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



<?= $this->endSection() ?>

