<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
      integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="{{ asset('Bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <title>PC Paradise - One-Stop Marketplace for PC Enthusiasts</title>
  </head>
  <body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top" >
      <div class="container" >
        <span class="navbar-brand" style="color: #23b5d3;">PC Paradise</span>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item me-2 ms-2">
              <a class="nav-link" aria-current="page" href="/">Home</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Products</a>
              <ul style="background-color: #6a5b6e;" class="dropdown-menu">
                @foreach (DB::table('categories')->get() as $category)
                  <li><a href="/Products?category={{ $category->name }}" style="color: beige;" class="dropdown-item">{{ $category->name }}</a></li>
                  
                @endforeach
                {{-- <li><a href="/Products?category=GPU" style="color: beige;" class="dropdown-item">Graphics Cards</a></li>
                <li><a href="/Products?category=CPU" style="color: beige;" class="dropdown-item">Processors</a></li>
                <li><a href="/Products?category=RAM" style="color: beige;" class="dropdown-item">Memory (RAM)</a></li>
                <li><a href="/Products?category=Motherboard" style="color: beige;" class="dropdown-item">Motherboards</a></li>
                <li><a href="/Products?category=Peripherals" style="color: beige;" class="dropdown-item">Peripherals</a></li> --}}
                <li><hr class="dropdown-divider"></li>
                <li><a href="/Products" style="color: beige;" class="dropdown-item">All Products</a></li>
              </ul>
            </li>
            <li class="nav-item ms-2">
              <a class="nav-link" href="/Sell">Sell your Product</a>
            </li>
          </ul>
          @auth
            <div class="d-flex nav-icons">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item mt-2">
                  <a href="{{ route('CartItem.index') }}"><i style="color: beige;" class="fas fa-shopping-cart"></i></a>
                </li>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i style="color: beige;" class="fas fa-user"> {{ Auth::user()->fname }}</i></a>
                <ul style="background-color: #6a5b6e;" class="dropdown-menu">
                  <li><a href="/user" style="color: beige;" class="dropdown-item">Profile</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li>
                    <form method="POST" action="{{ route('logout') }}">
                      @csrf
                      <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" style="color: red;" class="dropdown-item">Log Out</a>
                    </form>
                  </li>
                </ul>
                </li>
              </ul>




          </div>
          @endauth
          @guest
            <div class="d-flex nav-icons">
              <a class="nav-link" href="/SignIn">Sign in</a>
          </div>
          @endguest
          
        </div>
      </div>
    </nav>

    @yield('content')
    <!-- footer -->
    <footer class="footer-section ">
      <div class="footer-container">
        <div class="menu">
          <h2>PC Paradise</h2>
          <div class="menu-items">
            <i class="fab fa-facebook-square mb-3">  @PCP</i>
            <i class="fab fa-instagram-square mb-3">  @PCP</i>
            <i class="fab fa-twitter-square">  @PCP</i>
          </div>
        </div>
        <div class="menu">
          <h2>Products </h2>
          <div class="menu-items">
            <a href="https://tech-code24.net/">Men's Shoes</a>
            <a href="https://tech-code24.net/">Women's Shoes</a>
            <a href="https://tech-code24.net/">Popular Dress</a>
            <a href="https://tech-code24.net/">Sport Shoes</a>
          </div>
        </div>
        <div class="menu">
          <h2>Further Info</h2>
          <div class="menu-items">
            <a href="https://tech-code24.net/">Home</a>
            <a href="https://tech-code24.net/">About</a>
            <a href="https://tech-code24.net/">Contact</a>
            <a href="https://tech-code24.net/">FAQs</a>
          </div>
        </div>
      </div>
    </footer>
    @yield('script')
    <script
      src="{{ asset('Bootstrap/js/bootstrap.bundle.min.js') }}"
    ></script>
  </body>
</html>
