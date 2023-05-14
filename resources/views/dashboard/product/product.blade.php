@extends('dashboard.layout.dmain')

@section('dcontent')

<div class="border-bottom mb-4">
  <h2>Tambah Product</h2>
</div>

<a class="btn btn-primary mb-2" href="/dashboard/product/create" role="button">Tambah Product</a>
<div class="mt-2 col-lg-10">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Price</th>
        <th scope="col">Stock</th>
        <th scope="col">Category</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($products as $product)
        <tr>
          <th>{{ $loop->iteration }}</th>
          <td>{{ $product->name }}</td>
          <td>{{ $product->price }}</td>
          <td>{{ $product->stock }}</td>
          <td>{{ $product->category }}</td>
          <td>
            <a href="/dashboard/product/{{ $product->id }}/edit" role="button" class="bnt text-decoration-none">
              <span class="badge text-bg-warning">Edit</span>
            </a>
            <form action="/dashboard/product/{{ $product->id }}" method="post" class="d-inline" data-token="{{csrf_token()}}">
              @method('delete')
              @csrf
              <button type="submit" class="badge text-bg-danger border-0">
                <span>Hapus</span>
              </button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

@endsection