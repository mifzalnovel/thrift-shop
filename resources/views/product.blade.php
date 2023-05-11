@extends('layout.main')

@section('content')

<section class="new-arrivals">
  <div id="site">
    <div class="container">
      <div class="title-box">
        <h2>Women's Clothes</h2>
      </div>
      <div class="row">	
        @foreach($products as $product)	
          <div class="col-md-3">
            <div class="product-top">
              <img src="{{ asset('storage/' . $product->image) }}">
            </div>
            <div class="product-bottom text-center">
              <h3>{{ $product->name }}</h3>
              <div class="product-description" data-name="Check Coat" data-price="50000">
                <p class="product-price">{{ $product->price }}</p>
                {{-- <form class="add-to-cart" action="cart.html" method="post">
                  <div>
                    <label for="quantity">Quantity</label>
                    <input type="text" name="quantity" id="quantity" class="qty"/>
                  </div>
                </form> --}}
                <p class="btn"><a href="{{ url('cart/add/'.$product->id) }}" class="btn border-0 bg-dark text-center" role="button">Add to cart</a> </p>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</section>

<section class="on-sale">
  <div id="site">
    <div class="container">
      <div class="title-box">
        <h2>Men's Clothes</h2>
      </div>
      <div class="row">			
        <div class="col-md-3">
        <div class="product-top">
          <img src="images/ladies/2054548-04-2.jpg">
        </div>
        
        
        <div class="product-bottom text-center">
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          <i class="fa fa-star-half-o"></i>
          <h3>Check Coat</h3>
          <div class="product-description" data-name="Check Coat" data-price="50000">
            <p class="product-price">300,000</p>
            <form class="add-to-cart" action="cart.html" method="post">
              <div>
                <label for="qty-2">Quantity</label>
                <input type="text" name="qty-2" id="qty-2" class="qty" value="1" />
              </div>
              <p><input type="submit" value="Add to cart" class="btn" /></p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection