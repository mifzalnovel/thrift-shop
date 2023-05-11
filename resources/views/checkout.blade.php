@extends('layout.main')

@section('content')

<div id="site">
	
	<div id="content">
		<h1>Checkout</h1>
		@if(session('cart'))
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
					@foreach(session('cart') as $id => $details)
						<?php 
							$total += $details['price'] * $details['quantity'];
							$sumQuantity += $details['quantity']; 
						?>
						<tr>
							<td data-th="Product">
								<div class="row">
									<div class="col-sm-9">
										<h4 class="nomargin">{{ $details['name'] }}</h4>
									</div>
								</div>
							</td>
							<td data-th="Price">${{ $details['price'] }}</td>
							<td data-th="Quantity">
									<input type="number" value="{{ $details['quantity'] }}" class="form-control quantity" readonly/>
							</td>
							<td data-th="Subtotal" class="text-center">${{ $details['price'] * $details['quantity'] }}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			<div id="pricing">
				<p id="shipping">
					<strong>Shipping</strong>: <span id="sshipping"> $ {{ "50000" }}</span>
				</p>
				<p id="sub-total">
					<strong>Total</strong>: <span id="stotal">$ {{ $total += 50000 }}</span>
				</p>
			</div>
		{{-- <form action="{{ route('checkout.post') }}" method="post" id="checkout-order-form" style="background-color: skyblue"> --}}
		<div id="checkout-order-form" style="background-color: skyblue">
		 	<h2>Your Details</h2>
		 	<fieldset id="fieldset-billing">
		 		<legend>Billing</legend>
		 		<div>
		 			<label for="name">Name</label>
		 			<input type="text" name="name" id="name" data-type="string" data-message="This field cannot be empty" />
		 		</div>
		 		<div>
		 			<label for="email">Email</label>
		 			<input type="text" name="email" id="email" data-type="expression" data-message="Not a valid email address" />
		 		</div>
		 		<div>
		 			<label for="city">City</label>
		 			<input type="text" name="city" id="city" data-type="string" data-message="This field cannot be empty" />
		 		</div>
		 		<div>
		 			<label for="address">Address</label>
		 			<input type="text" name="address" id="address" data-type="string" data-message="This field cannot be empty" />
				</div>
				<div>
		 			<label for="zip">ZIP Code</label>
		 			<input type="text" name="zip" id="zip" data-type="string" data-message="This field cannot be empty" />
				</div>
		 		<div>
		 			<label for="location">Location</label>
		 			<select name="location" id="location" data-type="string" data-message="This field cannot be empty">
						 <option value="">Select</option>
		 				@foreach($locations as $location)
              <option value="{{ $location->id }}">{{ $location->name }}</option>
							@endforeach
						</select>
					</div>
				</fieldset>
		 	<fieldset id="fieldset-shipping">
				 <legend>Shipping</legend>
		 		<div>
					 <label for="sname">Name</label>
		 			<input type="text" name="sname" id="sname" data-type="string" data-message="This field cannot be empty" />
				</div>
				<div>
					<label for="semail">Email</label>
		 			<input type="text" name="semail" id="semail" data-type="expression" data-message="Not a valid email address" />
		 		</div>
		 		<div>
					 <label for="scity">City</label>
		 			<input type="text" name="scity" id="scity" data-type="string" data-message="This field cannot be empty" />
		 		</div>
		 		<div>
		 			<label for="saddress">Address</label>
		 			<input type="text" name="saddress" id="saddress" data-type="string" data-message="This field cannot be empty" />
				</div>
		 		<div>
		 			<label for="szip">ZIP Code</label>
		 			<input type="text" name="szip" id="szip" data-type="string" data-message="This field cannot be empty" />
				</div>
				<div>
		 			<label for="slocation">Location</label>
		 			<select name="slocation" id="slocation" data-type="string" data-message="This field cannot be empty">
						 <option value="">Select</option>
		 				@foreach($locations as $location)
              <option value="{{ $location->id }}">{{ $location->name }}</option>
            @endforeach
		 			</select>
		 		</div>
			</fieldset>
		 	{{-- <center><p><input type="submit" id="submit-order" value="Submit" class="btn btn-success" /></p></center> --}}
		 	{{-- <center><p><input type="submit" id="submit-order" value="Submit" class="btn btn-success" /></p></center> --}}
			<p class="btn"><a href="{{ url('checkout/add') }}" class="btn border-0 btn-success text-center" role="button">Submit</a> </p>
		</div>
		@endif
	</div>
</div>

@endsection