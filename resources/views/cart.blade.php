@extends('layout.main')

@section('content')

<div class="d-flex justify-content-center">
    <div class="mt-2 col-lg-10 mb-5">
        @if(session('success'))
        <div class="alert alert-success text-center" role="alert">
          {{session('success')}}
        </div>
      @endif
        <div class="border-bottom mb-4">
            <h2>Cart</h2>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" class="text-center">#</th>
                    <th scope="col" class="text-center">Name</th>
                    <th scope="col" class="text-center">Price</th>
                    <th scope="col" class="text-center">Quantity</th>
                    <th scope="col" class="text-center">Total</th>
                    <th scope="col" class="text-center">Action</th>
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
                            <input type="number" name="quantity" id="quantity" for="quantity" value="{{ $cart->quantity }}" class="form-control quantity"/>
                        </td>
                        <td class="text-center col-lg-4">${{ $cart->price * $cart->quantity }}</td>
                        <td class="text-center col-lg-4">
                            <form action="{{ route('cart.edit', $cart) }}" method="post" class="d-inline">
                                {{-- @method('patch') --}}
                                @csrf
                                <button type="submit" class="badge btn-warning border-0">
                                    <span>Update</span>
                                </button>
                            </form>
                            {{-- <a href="{{ route('cart.edit', $cart->id) }}">
                                <span>Update</span>
                            </a> --}}
                            <form action="{{ route('cart.destroy', $cart->id) }}" method="post"  class="d-inline" data-token="{{csrf_token()}}">
                                @method('delete')
                                @csrf
                                <button type="submit" class="badge btn-danger border-0">
                                    <span>Hapus</span>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div id="pricing">
            <p id="shipping">
                <strong>Shipping</strong>: <span id="sshipping"> $ {{ "50000" }}</span>
            </p>
            <p id="sub-total">
                <strong>Total</strong>: <span id="stotal">$ {{ $totalPrice += 50000 }}</span>
            </p>
        </div>
        <hr>
        <div class="d-flex justify-content-end">
            <a href="{{ route('checkout') }}" class="btn btn-primary border-0">Checkout</a>
        </div>
    </div>
</div>

@endsection