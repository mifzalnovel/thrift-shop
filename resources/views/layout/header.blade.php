<section id="nav-bar">
  <nav class="navbar navbar-expand-lg navbar-light" style="background-color: rgb(5, 5, 5);">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" style="color:white;">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="pull-right" >
      <a style="color:white; font-size: 30px;" href="index.html">Thrift Shop</a>
    </div> 
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a style="color:white;" class="nav-link" href="{{ route('home') }}">Home</a>
        </li>
        <li class="nav-item">
          <a style="color:white;" class="nav-link" href="{{ route('product') }}">Products</a>
        </li>
        <li class="nav-item">
          <a style="color:white;" class="nav-link" href="{{ route('cart') }}">Cart</a>
        </li>
        <li class="nav-item">
          <a style="color:white;" class="nav-link" href="{{ route('aboutUs') }}">About Us</a>
        </li>
        <li class="nav-item">
          <a style="color:white;" class="nav-link" href="{{ route('ourTeam') }}" tabindex="-1" aria-disabled="true">Our Team</a>
        </li>
        <li class="nav-item">
          <a style="color:white;" class="nav-link" href="{{ route('contact') }}">Contact</a>
        </li>
        <li class="nav-item">
          <a style="color:white;" class="nav-link" href="{{ route('login') }}">Login</a>
        </li>
      </ul>
    </div>
  </nav>
</section>


<div>
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
      <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
        <span class="fs-4">Simple header</span>
      </a>

    <ul class="nav nav-pills">
      <li class="nav-item"><a href="{{ route('home') }}" class="nav-link active" aria-current="page">Home</a></li>

      <li class="nav-item"><a href="{{ route('product') }}">Products</a></li>

      <li class="nav-item"><a href="{{ route('cart') }}">Cart</a></li>
      
      <li class="nav-item"><a href="{{ route('aboutUs') }}">About Us</a></li>

      <li class="nav-item"><a href="{{ route('ourTeam') }}" tabindex="-1" aria-disabled="true">Our Team</a></li>

      <li class="nav-item"><a href="{{ route('contact') }}">Contact</a></li>

      <li class="nav-item"><a href="{{ route('actionlogout') }}" class="nav-link active" aria-current="page">Logout</a></li>
      
    </ul>
  </header>
</div>