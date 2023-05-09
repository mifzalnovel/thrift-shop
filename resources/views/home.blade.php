@extends('layout.main')

@section('content')

<div class="slider">
	<div id="carouselExampleInterval" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active" data-interval="10000">
        <img src="images/cover3.webp" class="d-block w-100" alt="..." style="width:auto;height:800px;">
      </div>
      <div class="carousel-item" data-interval="2000">
        <img src="images/cover2.webp" class="d-block w-100" alt="..." style="width:auto;height:800px;">
      </div>
      <div class="carousel-item">
        <img src="images/suits.webp" class="d-block w-100" alt="..." style="width:auto;height:800px;">
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleInterval" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleInterval" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>

@endsection