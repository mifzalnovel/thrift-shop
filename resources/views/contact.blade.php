@extends('layout.main')

@section('content')

<section id="contact">  
  <div class="container mt-5">
    <h1>Contact</h1>
    <div class="row">
      <div class="col-md-6">
        <form class="contact-form">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Your Name..">
          </div>
          <div class="form-group">
            <input type="number" class="form-control" placeholder="Phone no.">
          </div>
          <div class="form-group">
            <input type="email" class="form-control" placeholder="Email..">
          </div>
          <div class="form-group">
            <textarea class="form-control" rows="4" placeholder="Message.."></textarea>
          </div>
        
          <button type="submit" class="btn btn-success pull-right">Submit</button>
        </form>
      </div>
      <div class="col-md-6 contact-info">
        <div class="follow"><b><i class="fa fa-map-marker"></i>  </b>UNAIR</div>
        <div class="follow"><b><i class="fa fa-mobile"></i>  </b>08123456789</div>
        <div class="follow"><b><i class="fa fa-envelope"></i>  </b>thriftshop@gmail.com</div>
        <div class="follow"><label><b>Social Media </b></label>
        <a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a>
        <a href="https://www.youtube.com/"><i class="fa fa-youtube-play"></i></a>
        <a href="https://twitter.com/login"><i class="fa fa-twitter"></i></a>
        <a href="https://myaccount.google.com/"><i class="fa fa-google-plus"></i></a>
        </div>
      </div> 
    </div>
  </div>
</section>

@endsection