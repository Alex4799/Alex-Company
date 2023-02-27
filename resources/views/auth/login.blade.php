<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Alex Lucifer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

</head>
<body class="bg-secondary">

    <div class="container d-flex flex-column justify-content-center align-items-center p-5" style="height: 100vh">
        <div class="shadow p-5">
            <div class="w-50">
                <img src="{{asset('layout/images/icon/final_logo.png')}}" class="">
            </div>
            <div class="parents w-100">
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" placeholder="Enter your email ...." class="form-control" type="email" name="email" :value="old('email')" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input id="password passwordInput" placeholder="Enter your password ...." class="form-control passwordInput" type="password" name="password" required autocomplete="current-password">
                    </div>
                    <div>
                        <input type="checkbox" onclick="changeInputType()" class="m-2 show_password_status">Show Password
                    </div>
                    <div class="row m-1">
                        <a class="text-dark col" href="{{ route('auth#registerPage') }}">Register</a>
                        <input type="submit" class="btn btn-info col-3 offset-5" value="Login">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>

    function changeInputType() {
    let input = document.getElementsByClassName('passwordInput')[0];
    if (input.type === "password") {
      input.type = "text";
    } else {
      input.type = "password";
    }
  }

  </script>
</html>
