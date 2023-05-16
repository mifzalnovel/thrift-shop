@extends('layout.main')

@section('content')

<section class="new-arrivals">
      
  <div id="site">
    <div class="container">
      @if(session('success'))
        <div class="alert alert-success text-center" role="alert">
          {{session('success')}}
        </div>
      @elseif (session('error'))
      <div class="alert alert-danger text-center" role="alert">
        {{session('error')}}
      </div>
      @endif
      <div class="title-box">
        <h2>Women's Clothes</h2>
      </div>
      <div class="row">	
        @foreach($womens as $women)
          <div class="col-md-3">
            <div class="product-top">
              <img src="{{ asset('storage/' . $women->image) }}">
            </div>
            <div class="product-bottom text-center d-flex align-items-stretch flex-column">
              <div style="height: 13vh;">
                <h3 class="h-100 d-inline-block">{{ $women->name }}</h3>
              </div>
              <div class="product-description">
                <p class="product-price col align-self-center">{{ $women->price }}</p>
                <form class="add-to-cart" action="{{ route('cart.add', $women->id) }}" method="post">
                  @csrf
                  <div class="d-flex flex-row justify-content-center">
                    @if($order)
                      <input type="hidden" name="order_id" id="order_id" for="order_id" value="{{ $order->id }}">
                    @endif
                    <input type="hidden" id="id" name="id" value="{{ $women->id }}" />
                    <label for="quantity" class="col align-self-center">Quantity</label>
                    <input name="quantity" id="quantity" type="number" class="col-4 mx-2 my-2 form-control quantity"/>
                  </div>
                  <p><input type="submit" value="Add to cart" class="btn" /></p>
                </form>
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
        @foreach($mens as $men)
          <div class="col-md-3">
            <div class="product-top">
              <img src="{{ asset('storage/' . $men->image) }}">
            </div>
            <div class="product-bottom text-center d-flex align-items-stretch flex-column">
              <div style="height: 13vh;">
                <h3 class="h-100 d-inline-block">{{ $men->name }}</h3>
              </div>
              <div class="product-description">
                <p class="product-price col align-self-center">{{ $men->price }}</p>
                <form class="add-to-cart" action="{{ route('cart.add', $men->id) }}" method="post">
                  @csrf
                  <div class="d-flex flex-row justify-content-center">
                    @if($order)
                      <input type="hidden" name="order_id" id="order_id" for="order_id" value="{{ $order->id }}">
                    @endif
                    <input type="hidden" id="id" name="id" value="{{ $men->id }}" />
                    <label for="quantity" class="col align-self-center">Quantity</label>
                    <input name="quantity" id="quantity" type="number" class="col-4 mx-2 my-2 form-control quantity"/>
                  </div>
                  <p><input type="submit" value="Add to cart" class="btn" /></p>
                </form>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</section>

@endsection