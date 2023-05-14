@extends('dashboard.layout.dmain')

@section('dcontent')
<div class="border-bottom mb-4 col-lg-10">
  <h2>Best Selling Product</h2>
</div>

<div class="mt-2 col-lg-10">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Price</th>
        <th scope="col">Sold</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($products as $product)
        <tr>
          <th>{{ $loop->iteration }}</th>
          <td>{{ $product->name }}</td>
          <td>{{ $product->price }}</td>
          <td>{{ $product->quantity }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

<hr>

{{-- <div class="border-bottom mb-4 col-lg-10">
  <h2>Top Customer</h2>
</div>

<div class="mt-2 col-lg-10">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Username</th>
        <th scope="col">Email</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($users as $user)
        <tr>
          <th>{{ $loop->iteration }}</th>
          <td>{{ $user->name }}</td>
          <td>{{ $user->username }}</td>
          <td>{{ $user->email }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div> --}}

@endsection