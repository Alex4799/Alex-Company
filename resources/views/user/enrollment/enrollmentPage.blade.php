@extends('user.layout.index')
@section('title')
    Enrollment
@endsection

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="col-lg-6 offset-lg-3">
                <div class="card bg-secondary">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Enrollment</h3>
                        </div>
                        <hr>
                        @if (session('failPass'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-triangle-exclamation"></i>{{session('failPass')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <form action="{{route('user#Enrollment')}}" method="post" novalidate="novalidate">
                            @csrf
                            <div>
                                <div class="form-group">
                                <label class="control-label mb-1">Enter Password</label>
                                <input id="cc-pament passwordInput" name="password" type="password" class="passwordInput form-control @error('password') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter password...">
                                @error('password')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>

                            <div>
                                <input type="checkbox" onclick="changeInputType()" class="m-2 show_password_status">Show Password
                            </div>

                            <div class="my-3 offset-9">
                                <input type="submit" class="btn btn-dark" value="Send">
                            </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
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
@endsection
