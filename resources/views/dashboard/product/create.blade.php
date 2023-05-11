@extends('dashboard.layout.dmain')

@section('dcontent')

<div class="border-bottom mb-4">
  <h2>Tambah Product</h2>
</div>

<div class="col-lg-8">
  <form method="post" action="/dashboard/product" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
      <label for="name" class="form-label">Nama</label>
      <input type="text" class="form-control" id="name" name="name" placeholder="Nama Product" required>
    </div>
    <div class="mb-3">
      <label for="price" class="form-label">Harga</label>
      <input type="text" class="form-control" id="price" name="price" placeholder="Harga Product" required>
    </div>
    <div class="mb-3">
      <label for="stock" class="form-label">Stock</label>
      <input type="text" class="form-control" id="stock" name="stock" placeholder="Stock Product" required>
    </div>
    <div class="mb-3">
      <label for="category" class="form-label">Kategori</label>
      <select class="form-select" name="category">
        <option value="Men">Men's</option>
        <option value="Women">Women's</option>
      </select>
    </div>
    <div class="mb-3">
      <label for="image" class="form-label">Gambar</label>
      <img src="" class="img-preview mb-3 col-sm-5" alt="">
      <input class="form-control" type="file" id="image" name="image" onchange="previewImage()" required>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
<script>

  function previewImage() {
    const image = document.querySelector('#image');
    const imgPreview = document.querySelector('.img-preview');

    imgPreview.style.display = 'block';

    const oFReader = new FileReader();
    oFReader.readAsDataURL(image.files[0]);

    oFReader.onload = function(oFReader) {
      imgPreview.src = oFReader.target.result;
    }
  }

</script>

@endsection