@extends('dashboard.layout.dmain')

@section('dcontent')

<div id="site">
	<div id="content">
		<h1>Checkout</h1>
		<table id="checkout-cart" class="shopping-cart">
			<thead>
				<tr>
					<th scope="col">Item</th>
					<th scope="col">Price</th>
					<th scope="col">Qty</th>
					<th scope="col">total</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$total = 0; 
					$sumQuantity = 0;
				?>
				@foreach($carts as $cart)
					<?php 
						$total += $cart->price * $cart->quantity;
						$sumQuantity += $cart->quantity; 
					?>
					<tr>
						<td data-th="Product">
							<div class="row">
								<div class="col-sm-9">
									<h4 class="nomargin">{{ $cart->name }}</h4>
								</div>
							</div>
						</td>
						<td data-th="Price">${{ $cart->price }}</td>
						<td data-th="Quantity">
								<input type="number" value="{{ $cart->quantity }}" class="form-control quantity" readonly/>
						</td>
						<td data-th="Subtotal" class="text-center">${{ $cart->price * $cart->quantity }}</td>
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
			@method('put')
			<div class="mb-3">
				<label for="status" class="form-label">Status</label>
				<select name="status" class="form-control" id="status">
					<option value="{{ $order->status }}">{{ $order->status }}</option>
					<option value="Pending">Pending</option>
					<option value="Processing">Processing</option>
					<option value="Shipped">Shipped</option>
					<option value="Delivered">Delivered</option>
				</select>
				<button type="submit" class="btn btn-primary">Update Status</button>
		</form>
	</div>
</div>

@endsection