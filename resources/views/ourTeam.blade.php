@extends('layout.main')

@section('content')

<div class="container mt-5 mb-5">
  <div class="border-bottom mb-3">
    <h2>Our Team</h2>
  </div>
  <div class="row">
    <div class="col">
      <div class="card" style="width: 23rem;">
        <img src="images/foto1.jpeg" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Mifzal Novel</h5>
          <p class="card-text">082111633082</p>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card" style="width: 23rem;">
        <img src="images/foto2.jpeg" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Ach Sahal Septiananda</h5>
          <p class="card-text">082111633099</p>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection