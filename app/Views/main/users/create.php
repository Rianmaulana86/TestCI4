<?= $this->extend('layouts/main') ?>



<?= $this->section('content') ?>


<div class="container-fluid py-4">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header pb-0">
          <div class="d-flex align-items-center">

            <h3>Form Tambah Data User</h3>
          
          </div>
        </div>
        <div class="card-body">
            <form action="<?= base_url('processRegister') ?>" method="POST">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Username</label>
                    <input class="form-control" type="text" name="username">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Email</label>
                    <input class="form-control" type="email" name="email">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Password</label>
                    <input class="form-control" type="password" name="password">
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

