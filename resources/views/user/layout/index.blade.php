<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>@yield('title')</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('layout/assets/vendor/aos/aos.css')}}" rel="stylesheet">
  <link href="{{asset('layout/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('layout/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('layout/assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('layout/assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{asset('layout/assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{asset('layout/assets/css/style.css')}}" rel="stylesheet">

  <link rel="shortcut icon" href="{{asset('image/lucifer.jpg')}}" type="image/x-icon">

  <script src="https://kit.fontawesome.com/10de2103ef.js" crossorigin="anonymous"></script>

</head>

<body class="bg-secondary">

  <!-- ======= Mobile nav toggle button ======= -->
  <i class="bi bi-list mobile-nav-toggle d-xl-none me-2"></i>

  <!-- ======= Header ======= -->
  <header id="header">
    <div class="d-flex flex-column">

      <div class="profile">
        @if (Auth::user()->image==null)
        @if (Auth::user()->gender=='male')
            <img src="{{asset('image/default-male-image.png')}}" class="img-fluid rounded-circle">
        @else
            <img src="{{asset('image/default-female-image.webp')}}" class="img-fluid rounded-circle">
        @endif
        @else
            <img src="{{asset('storage/'.Auth::user()->image)}}" class="img-fluid rounded-circle">
        @endif
        <h1 class="text-light"><a href="index.html">{{Auth::user()->name}}</a></h1>
        <div class="social-links mt-3 text-center">

          @if (request('unread_message_count')!=0)
            <a href="{{route('user#messageList')}}" title="Message" type="button" class="btn btn-info position-relative">
                <i class="fa-solid fa-envelope"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                {{request('unread_message_count')}}
                <span class="visually-hidden">unread message</span>
                </span>
            </a>
          @endif

          @if (request('notDoneWorks_count')!=0)
              <a href="{{route('user#workList')}}" title="Work" type="button" class="my-2 btn btn-outline-success position-relative">
                  <i class="fa-solid fa-hammer"></i>
                  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{request('notDoneWorks_count')}}
                    <span class="visually-hidden">undone work</span>
                  </span>
                </a>
          @endif

          @if (request('admin_enrollment_status')==1 && request('user_enrollment_status')==0)
          <a href="{{route('user#EnrollmentPage')}}" title="Enrollment" type="button" class="my-2 btn btn-outline-light position-relative">
            <i class="fa-solid fa-bell"></i>
              <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                <span class="visually-hidden">Enrollment</span>
              </span>
            </a>
          @endif



      @if (request('undoneOrderCount')!=0)
          <a href="{{route('user#orderHistory')}}" title="Order" type="button" class="my-2 btn btn-outline-info position-relative">
            <i class="fa-solid fa-list"></i>
              <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                {{request('undoneOrderCount')}}
                <span class="visually-hidden">undone order</span>
              </span>
            </a>
      @endif

        </div>
      </div>

      <div>

      </div>

      <nav id="navbar" class="nav-menu navbar">
        <ul class="list-unstyled navbar__list">
            <li class="@if (url()->current()==route('user#profile')) active @endif">
                <a class="js-arrow" href="{{route('user#profile')}}">
                    <i class="fa-solid fa-user"></i>Profile
                </a>
            </li>
            <li class="@if (url()->current()==route('user#adminList')) active @endif">
                <a href="{{route('user#adminList')}}">
                    <i class="fa-solid fa-users"></i>Admin</a>
            </li>
            <li class="@if (url()->current()==route('user#workList')) active @endif">
                <a href="{{route('user#workList')}}">
                    <i class="fa-solid fa-square-check"></i>Work</a>
            </li>
            <li class="@if (url()->current()==route('user#categoryList')) active @endif">
                <a href="{{route('user#categoryList')}}">
                    <i class="fas fa-chart-bar"></i>Category</a>
            </li>
            <li class="@if (url()->current()==route('user#productList')) active @endif">
                <a href="{{route('user#productList')}}">
                    <i class="fas fa-chart-bar"></i>Product</a>
            </li>
            <li class="@if (url()->current()==route('user#customerList')) active @endif">
                <a href="{{route('user#customerList')}}">
                    <i class="fa-solid fa-users"></i>Customers</a>
            </li>
            <li class="@if (url()->current()==route('user#orderHistory')) active @endif">
                <a href="{{route('user#orderHistory')}}">
                    <i class="fa-solid fa-cart-shopping"></i>Order</a>
            </li>
            <li class="@if (url()->current()==route('user#messageList')) active @endif">
                <a href="{{route('user#messageList')}}">
                    <i class="fa-solid fa-message"></i>Message</a>
            </li>
            <li class="@if (url()->current()==route('user#saleDashboard')) active @endif">
                <a href="{{route('user#saleDashboard')}}">
                    <i class="fa-solid fa-chart-line"></i>Product Dashboard</a>
            </li>
            <li class="@if (url()->current()==route('user#changePasswordPage')) active @endif">
                <a href="{{route('user#changePasswordPage')}}">
                    <i class="fa-solid fa-key"></i>Change Password</a>
            </li>
            <li class=" me-2">
                <form action="{{route('logout')}}" method="post">
                    @csrf
                    <button class="btn btn-danger py-2 w-100" type="submit"><i class="fa-solid fa-arrow-right-from-bracket"></i>Logout</button>
                </form>
            </li>
        </ul>
      </nav><!-- .nav-menu -->
    </div>
  </header><!-- End Header -->

  <main id="main">
    <section class="breadcrumbs title bg-secondary">
        <div class="col-5">
            <img src="{{asset('layout/images/icon/final_logo.png')}}" class="w-100">
        </div>
    </section>

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs bg-secondary">
      <div class="container bg-secondary">
        @yield('content')
      </div>
    </section><!-- End Breadcrumbs -->

    <section class=" bg-secondary">
        <div class="text-center">
            <div class="copyright">
              &copy; Copyright <strong><span>iPortfolio</span></strong>
            </div>
              Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
          </div>
        </section>

  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{asset('layout/assets/vendor/purecounter/purecounter_vanilla.js')}}"></script>
  <script src="{{asset('layout/assets/vendor/aos/aos.js')}}"></script>
  <script src="{{asset('layout/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('layout/assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{asset('layout/assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
  <script src="{{asset('layout/assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
  <script src="{{asset('layout/assets/vendor/typed.js/typed.min.js')}}"></script>
  <script src="{{asset('layout/assets/vendor/waypoints/noframework.waypoints.js')}}"></script>
  <script src="{{asset('layout/assets/vendor/php-email-form/validate.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{asset('layout/assets/js/main.js')}}"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  @yield('script')
</body>

</html>
