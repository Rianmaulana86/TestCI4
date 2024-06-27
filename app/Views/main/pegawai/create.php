<?= $this->extend('layouts/main') ?>



<?= $this->section('content') ?>


<div class="container-fluid py-4">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header pb-0">
          <div class="d-flex align-items-center">

            <h3>Form Tambah Data Pegawai</h3>
          
          </div>
        </div>
        <div class="card-body">
            <form action="<?= base_url('pegawai') ?>" method="POST" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Name</label>
                    <input class="form-control" type="text" name="name">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Addres</label>
                    <input class="form-control" type="text" name="addres">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Age</label>
                    <input class="form-control" type="text" name="age">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Gender</label>
                    <select name="gender" class="form-control">
                        <option value="">Klik Untuk Pilih Gender</option>
                        <option value="1">Laki Laki</option>
                        <option value="2">Perempuan</option>
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
                  <label for="image-preview" class="form-control-label">Image Preview</label>
                  <img id="image-preview" src="#" alt="your image" style="display: none; max-width: 200px; max-height: 200px;" />
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
document.getElementById('image').addEventListener('change', function(event) {
    var input = event.target;
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var preview = document.getElementById('image-preview');
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
});
</script>

<?= $this->endSection() ?>

