@extends('layout.main')

@section('content')

<div class="m-5">
  <div class="border-bottom mb-4">
    <h2>Orders</h2>
  </div>
  
  <div class="mt-2 col-lg-10 mb-5">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Quantity</th>
            <th scope="col">Total</th>
          </tr>
        </thead>
        <tbody>
            <?php 
                $totalPrice = 0;
                $sumQuantity = 0;
            ?>
            @foreach($carts as $cart)
                <?php 
                    $total = 0; 
                    $total = $cart->price * $cart->quantity;
                    $price = $total / $cart->quantity;
                    $sumQuantity += $cart->quantity; 
                    $totalPrice += $total; 
                ?>
                <tr>
                    <th>{{ $loop->iteration }}</th>
                    <td class="text-center col-lg-4">
                        <div class="row d-flex justify-content-center">
                            <div class="col-lg-9">
                                <h4 class="nomargin">{{ $cart->name }}</h4>
                            </div>
                        </div>
                    </td>
                    <td class="text-center col-lg-2">${{ $price }}</td>
                    <td >
                        <input type="number" value="{{ $cart->quantity }}" class="form-control quantity" disabled/>
                    </td>
                    <td class="text-center col-lg-4">${{ $cart->price * $cart->quantity }}</td>
                </tr>
            @endforeach
        </tbody>
      </table>
  
      <div id="pricing">
        <p id="shipping">
          <strong>Shipping</strong>: <span id="sshipping"> $ {{ "50000" }}</span>
        </p>
        <p id="sub-total">
          <strong>Total</strong>: <span id="stotal">$ {{ $order->total_amount }}</span>
        </p>
      </div>
      <hr>
      <form class="col-8">
        @csrf
        <h2>Billing</h2>
        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="name" class="form-control" id="name" value="{{ $userDetail->name }}" disabled>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" value="{{ $userDetail->email }}" disabled>
        </div>
        <div class="mb-3">
          <label for="city" class="form-label">City</label>
          <input type="city" class="form-control" id="city" value="{{ $userDetail->city }}" disabled>
        </div>
        <div class="mb-3">
          <label for="address" class="form-label">Address</label>
          <input type="address" class="form-control" id="address" value="{{ $userDetail->address }}" disabled>
        </div>
        <div class="mb-3">
          <label for="zip_code" class="form-label">ZIP Code</label>
          <input type="zip_code" class="form-control" id="zip_code" value="{{ $userDetail->zip_code }}" disabled>
        </div>
        <div class="mb-3">
          <label for="location" class="form-label">Location</label>
          <select name="location" class="form-control" id="location" disabled>
            <option value="{{ $userDetail->location }}">{{ $userDetail->location }}</option>
          </select>
        </div>
  
        <hr>
        <h2>Shipping</h2>
        <div class="mb-3">
          <label for="sname" class="form-label">Name</label>
          <input type="sname" class="form-control" id="sname" value="{{ $userDetail->sname }}" disabled>
        </div>
        <div class="mb-3">
          <label for="semail" class="form-label">Email</label>
          <input type="semail" class="form-control" id="semail" value="{{ $userDetail->semail }}" disabled>
        </div>
        <div class="mb-3">
          <label for="scity" class="form-label">City</label>
          <input type="scity" class="form-control" id="scity" value="{{ $userDetail->scity }}" disabled>
        </div>
        <div class="mb-3">
          <label for="saddress" class="form-label">Address</label>
          <input type="saddress" class="form-control" id="saddress" value="{{ $userDetail->saddress }}" disabled>
        </div>
        <div class="mb-3">
          <label for="szip_code" class="form-label">ZIP Code</label>
          <input type="szip_code" class="form-control" id="szip_code" value="{{ $userDetail->szip_code }}" disabled>
        </div>
        <div class="mb-3">
          <label for="slocation" class="form-label">Location</label>
          <select name="slocation" class="form-control" id="slocation" disabled>
            <option value="{{ $userDetail->slocation }}">{{ $userDetail->slocation }}</option>
          </select>
        </div>
      </form>
  
      <hr>
      <h2>Status</h2>
      <form action="/dashboard/order/{{ $order->id }}" method="post" class="col-8">
        @csrf
        @method('put')
        <div class="mb-3">
          <label for="status" class="form-label">Status</label>
          <select name="status" class="form-control" id="status" disabled>
            <option value="{{ $order->status }}" selected>{{ $order->status }}</option>
          </select>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection