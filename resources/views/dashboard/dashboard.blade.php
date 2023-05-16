@extends('dashboard.layout.dmain')

@section('dcontent')
<div class="border-bottom mb-4 col-lg-10">
  <h2>Latest Selling Product</h2>
</div>

<div class="mt-2 col-lg-10">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Price</th>
        <th scope="col">Sold</th>
        <th scope="col">Date</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($products as $product)
        <tr>
          <th>{{ $loop->iteration }}</th>
          <td>{{ $product->name }}</td>
          <td>{{ $product->price }}</td>
          <td>{{ $product->quantity }}</td>
          <td>{{ date('d-m-Y', strtotime($product->created_at)) }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

@endsection