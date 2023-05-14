@extends('layout.main')

@section('content')

<section class="new-arrivals">
  <div id="site">
    <div class="container">
      <div class="title-box">
        <h2>Women's Clothes</h2>
      </div>
      <div class="row">	
        @foreach($womens as $women)
          <div class="col-md-3">
            <div class="product-top">
              <img src="{{ asset('storage/' . $women->image) }}">
            </div>
            <div class="product-bottom text-center">
              <h3>{{ $women->name }}</h3>
              <div class="product-description">
                <p class="product-price">{{ $women->price }}</p>
                <form class="add-to-cart" action="{{ route('cart.add', $women->id) }}" method="post">
                  @csrf
                  <div class="d-flex flex-row justify-content-center">
                    <input type="hidden" id="id" name="id" value="{{ $women->id }}" />
                    <label for="quantity">Quantity</label>
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
            <div class="product-bottom text-center">
              <h3>{{ $men->name }}</h3>
              <div class="product-description">
                <p class="product-price">{{ $men->price }}</p>
                <form class="add-to-cart" action="{{ route('cart.add', $men->id) }}" method="post">
                  @csrf
                  <div class="d-flex flex-row justify-content-center">
                    <input type="hidden" id="id" name="id" value="{{ $men->id }}" />
                    <label for="quantity">Quantity</label>
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