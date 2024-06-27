<?= $this->extend('layouts/main') ?>



<?= $this->section('content') ?>


<div class="container-fluid py-4">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header pb-0">
          <div class="d-flex align-items-center">

            <h3>Form Edit Data User</h3>
          
          </div>
        </div>
        <div class="card-body">
            <form action="<?= site_url('user/'.$data['id']) ?>" method="post">
              <?= csrf_field() ?>
              <input type="hidden" name="_method" value="PUT">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Username</label>
                    <input class="form-control" type="text" name="username" value="<?= $data['username'] ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Email</label>
                    <input class="form-control" type="email" name="email" value="<?= $data['email']?>">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Password</label>
                    <input class="form-control" type="password" name="password" placeholder="Isikan Password Baru, Kosongkan Jika Tidak Ingin Mengganti Password">
                  </div>
                </div>
              </div>
              <button class="btn btn-primary btn-sm ms-auto" type="submit">Submit</button>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>



<?= $this->endSection() ?>

