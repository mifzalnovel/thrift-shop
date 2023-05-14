@extends('layout.main')

@section('content')

<div class="d-flex justify-content-center">
    <div class="mt-2 col-lg-10 mb-5">
        <div class="border-bottom mb-4">
            <h2>Cart</h2>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col" class="d-flex justify-content-center">Total</th>
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
                        <th>{{ $loop->iteration }}</th>
                        <td data-th="Product">
                            <div class="row">
                                <div class="col-sm-9">
                                    <h4 class="nomargin">{{ $cart->name }}</h4>
                                </div>
                            </div>
                        </td>
                        <td data-th="Price">${{ $cart->price }}</td>
                        <td data-th="Quantity">
                            <input type="number" value="{{ $cart->quantity }}" class="form-control quantity" disabled/>
                        </td>
                        <td data-th="Subtotal" class="text-center col-lg-4">${{ $cart->price * $cart->quantity }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div id="pricing">
            <p id="shipping">
                <strong>Shipping</strong>: <span id="sshipping"> $ {{ "50000" }}</span>
            </p>
            <p id="sub-total">
                <strong>Total</strong>: <span id="stotal">$ {{ $total }}</span>
            </p>
        </div>

				<div>
					<p>
						Silahkan lakukan pembayaran ke <strong>Bank ABC</strong><br>
						<strong>No Rekening 1234567890 (A/N Admin)</strong><br>
						<strong>Total Pembayaran</strong>: <span id="stotal"><strong> $ {{ $total + 50000 }}</strong></span>
						Setelah melakukan pembayaran Silahkan lakukan konfirmasi pembayaran ke no WA <strong>081234567890</strong>

					</p>
				</div>
        <hr>
        <form action="{{ route('update.detail.checkout', $userDetail->id) }}" method="post" id="checkout-order-form" style="background-color: skyblue">
            @method('patch')
            @csrf
		 	<h2>Your Details</h2>
		 	<fieldset id="fieldset-billing">
		 		<legend>Billing</legend>
		 		<div>
		 			<label for="name">Name</label>
		 			<input type="text" name="name" id="name" data-type="string" data-message="This field cannot be empty"  value="{{ $userDetail->name }}" required/>
		 		</div>
		 		<div>
		 			<label for="email">Email</label>
		 			<input type="text" name="email" id="email" data-type="expression" data-message="Not a valid email address" value="{{ $userDetail->email }}" required/>
		 		</div>
		 		<div>
		 			<label for="city">City</label>
		 			<input type="text" name="city" id="city" data-type="string" data-message="This field cannot be empty" value="{{ $userDetail->city }}" required/>
		 		</div>
		 		<div>
		 			<label for="address">Address</label>
		 			<input type="text" name="address" id="address" data-type="string" data-message="This field cannot be empty" value="{{ $userDetail->name }}" required/>
				</div>
				<div>
		 			<label for="zip_code">ZIP Code</label>
		 			<input type="text" name="zip_code" id="zip_code" data-type="string" data-message="This field cannot be empty" value="{{ $userDetail->zip_code }}" required/>
				</div>
		 		<div>
		 			<label for="location">Location</label>
		 			<select name="location" id="location" data-type="string" data-message="This field cannot be empty" required>
						 <option value="{{ $userDetail->location }}">{{ $userDetail->location }}</option>
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
		 			<input type="text" name="sname" id="sname" data-type="string" data-message="This field cannot be empty" value="{{ $userDetail->sname }}" required/>
				</div>
				<div>
					<label for="semail">Email</label>
		 			<input type="text" name="semail" id="semail" data-type="expression" data-message="Not a valid email address" value="{{ $userDetail->semail }}" required/>
		 		</div>
		 		<div>
					 <label for="scity">City</label>
		 			<input type="text" name="scity" id="scity" data-type="string" data-message="This field cannot be empty" value="{{ $userDetail->scity }}" required/>
		 		</div>
		 		<div>
		 			<label for="saddress">Address</label>
		 			<input type="text" name="saddress" id="saddress" data-type="string" data-message="This field cannot be empty" value="{{ $userDetail->saddress }}" required/>
				</div>
		 		<div>
		 			<label for="szip_code">ZIP Code</label>
		 			<input type="text" name="szip_code" id="szip_code" data-type="string" data-message="This field cannot be empty" value="{{ $userDetail->szip_code }}" required/>
				</div>
				<div>
		 			<label for="slocation">Location</label>
		 			<select name="slocation" id="slocation" data-type="string" data-message="This field cannot be empty" required>
						 <option value="{{ $userDetail->slocation }}">{{ $userDetail->slocation }}</option>
		 				@foreach($locations as $location)
                            <option value="{{ $location->name }}">{{ $location->name }}</option>
                        @endforeach
		 			</select>
		 		</div>
			</fieldset>
		 	<center><p><input type="submit" value="Submit" class="btn btn-success mb-3" /></p></center>
		</form>
    </div>
</div>

@endsection