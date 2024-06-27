<?= $this->extend('layouts/main') ?>



<?= $this->section('content') ?>


<div class="container-fluid py-4">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header pb-0">
          <div class="d-flex align-items-center">

            <h3>Form Edit Data Pegawai</h3>
          
          </div>
        </div>
        <div class="card-body">
          <form action="<?= site_url('pegawai/'.$data['id']) ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="PUT">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Name</label>
                    <input class="form-control" type="text" name="name" value="<?= $data['name'] ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Addres</label>
                    <input class="form-control" type="text" name="addres" value="<?= $data['addres'] ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Age</label>
                    <input class="form-control" type="text" name="age" value="<?= $data['age'] ?>">
                  </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                        <label for="example-text-input" class="form-control-label">Gender</label>
                        <select name="gender" class="form-control">
                            <option value="1" <?= $data['gender'] == 1 ? 'selected' : '' ?>>Laki Laki</option>
                            <option value="2" <?= $data['gender'] == 2 ? 'selected' : '' ?>>Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="example-text-input" class="form-control-label">Picture Profile</label>
                        <input class="form-control" type="file" name="image" id="image">
                        <i class="text-danger">Maksimal Size Image 300 kb</i>
                    </div>
                    </div>
                    <div class="form-group">
                        <img id="image-preview" src="<?= !empty($data['image']) ? base_url('uploads/'.$data['image']) : '#' ?>" alt="your image" style="<?= !empty($data['image']) ? '' : 'display: none;' ?> max-width: 200px; max-height: 200px;" />
                    </div>
              </div>
              <button class="btn btn-primary btn-sm ms-auto" type="submit">Submit</button>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
    document.getElementById('image').onchange = function(evt) {
        const [file] = this.files;
        if (file) {
            const imgPreview = document.getElementById('image-preview');
            imgPreview.src = URL.createObjectURL(file);
            preview.src = e.target.result;
            preview.style.display = 'block';
            imgPreview.style.display = 'block';
        }
    };
</script>

<?= $this->endSection() ?>

