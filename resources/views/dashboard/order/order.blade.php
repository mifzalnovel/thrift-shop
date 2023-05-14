@extends('dashboard.layout.dmain')

@section('dcontent')

<div class="border-bottom mb-4">
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
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($orders as $order)
        <tr>
          <th>{{ $loop->iteration }}</th>
          <td>{{ $order->user->name }}</td>
          <td>{{ $order->id }}</td>
          <td>{{ $order->total_amount }}</td>
          <td>
            <a href="/dashboard/order/{{ $order->id }}" class="text-decoration-none">
              <span class="badge text-bg-info">Detail</span>
            </a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

@endsection