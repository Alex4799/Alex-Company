<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>@yield('title')</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Cardo:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('customer/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('customer/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('customer/assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">
  <link href="{{asset('customer/assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{asset('customer/assets/vendor/aos/aos.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{asset('customer/assets/css/main.css')}}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: PhotoFolio - v1.2.0
  * Template URL: https://bootstrapmade.com/photofolio-bootstrap-photography-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
    <link rel="shortcut icon" href="{{asset('image/lucifer.jpg')}}" type="image/x-icon">

  {{-- fontawesome  --}}
  <script src="https://kit.fontawesome.com/10de2103ef.js" crossorigin="anonymous"></script>

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid d-flex align-items-center justify-content-between">

      <a href="#" class="logo d-flex align-items-center  me-auto me-lg-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <div><img src="{{asset('image/lucifer.jpg')}}" class="w-100" alt=""></div>
        <h1>Alex Lucifer</h1>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto @if (url()->current()==route('customer#home')) active @endif" href="{{route('customer#home')}}">Home</a></li>
          <li><a class="nav-link scrollto @if (url()->current()==route('customer#cartList')) active @endif" href="{{route('customer#cartList')}}">Cart</a></li>
          <li><a class="nav-link scrollto @if (url()->current()==route('customer#orderHistory')) active @endif" href="{{route('customer#orderHistory')}}">Order History</a></li>
          <li><a class="nav-link scrollto @if (url()->current()==route('customer#messageSendPage')) active @endif" href="{{route('customer#messageSendPage')}}">Contact Us</a></li>
          <li>
            @if (request('unread_message_count')!=0)
            <div>
                <a href="{{route('customer#messageList')}}" type="button" class="btn position-relative">
                    <i class=" fa-solid fa-message fs-4"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{request('unread_message_count')}}
                    <span class="visually-hidden">uread message</span>
                    </span>
                </a>
            </div>
            @endif
        </li>
        <li>
            @if (request('cart_count')!=0)
            <div>
                <a href="{{route('customer#cartList')}}" type="button" class="btn position-relative">
                    <i class="fa-solid fa-cart-shopping fs-4"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{request('cart_count')}}
                    <span class="visually-hidden">cart</span>
                    </span>
                </a>
            </div>
            @endif

          </li>
          <li class="ms-3 nav-link" >
            <div class="">
                <div class="">
                <div class="dropdown">
                    <button class="btn btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{Auth::user()->name}}
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{route('customer#profile')}}">Profile</a></li>
                        <li><a class="dropdown-item" href="{{route('customer#changePasswordPage')}}">Change Password</a></li>
                        <li>
                            <form action="{{route('logout')}}" method="post" class="">
                                @csrf
                                <button class="w-100 btn btn-danger" type="submit"><i class="fa-solid fa-arrow-right-from-bracket"></i>Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
                </div>
            </div>
          </li>


        </ul>
      </nav><!-- .navbar -->

      <div class="header-social-links">
        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
      </div>
      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    </div>
  </header><!-- End Header -->

  <main id="main" data-aos="fade" data-aos-delay="1500">

    <!-- ======= Gallery Section ======= -->
    <section id="gallery" class="page-header">
        @yield('content')
    </section><!-- End Gallery Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>PhotoFolio</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/photofolio-bootstrap-photography-website-template/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader">
    <div class="line"></div>
  </div>

  <!-- Vendor JS Files -->
  <script src="{{asset('customer/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('customer/assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
  <script src="{{asset('customer/assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{asset('customer/assets/vendor/aos/aos.js')}}"></script>
  <script src="{{asset('customer/assets/vendor/php-email-form/validate.js')}}"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <!-- Template Main JS File -->
  <script src="{{asset('customer/assets/js/main.js')}}"></script>

  @yield('script')
</body>

</html>
