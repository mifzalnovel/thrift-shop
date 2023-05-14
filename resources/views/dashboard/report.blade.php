@extends('dashboard.layout.dmain')

@section('dcontent')
<div class="border-bottom mb-4 col-lg-10">
  <h2>Product</h2>
</div>

<div class="mt-2 col-lg-10">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Price</th>
        <th scope="col">Stock</th>
        <th scope="col">Category</th>
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
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

<hr>

<div class="border-bottom mb-4 col-lg-10">
  <h2>Orders</h2>
</div>

<div class="mt-2 col-lg-10">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Order Id</th>
        <th scope="col">Total Amount</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($orders as $order)
        <tr>
          <th>{{ $loop->iteration }}</th>
          <td>{{ $order->user->name }}</td>
          <td>{{ $order->id }}</td>
          <td>{{ $order->total_amount }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

<hr>

<div class="border-bottom mb-4 col-lg-10">
  <h2>Customer</h2>
</div>

<div class="mt-2 col-lg-10">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Username</th>
        <th scope="col">Email</th>
        <th scope="col">Level</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($users as $user)
        <tr>
          <th>{{ $loop->iteration }}</th>
          <td>{{ $user->name }}</td>
          <td>{{ $user->username }}</td>
          <td>{{ $user->email }}</td>
          <td>{{ $user->name }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

@endsection