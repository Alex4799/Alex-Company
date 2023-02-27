@extends('admin.layout.index')
@section('title')
    Change Password
@endsection

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="col-lg-6 offset-lg-3">
                <div class="card bg-secondary">
                    <div class="card-body">
                        <div class="card-title">
                            <h1 class="text-center title-2">Change Password</h1>
                        </div>
                        <hr>
                        @if (session('failPass'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-triangle-exclamation"></i>{{session('failPass')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <form action="{{route('profile#changePassword')}}" method="post" novalidate="novalidate">
                            @csrf
                            <div>
                                <div class="form-group">
                                <label class="control-label mb-1">Old Password</label>
                                <input id="cc-pament1" name="oldPassword" type="password" class="passwordInput form-control @error('oldPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Old password...">
                                @error('oldPassword')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="control-label mb-1">New Password</label>
                                <input id="cc-pamen2t" name="newPassword" type="password" class="passwordInput form-control @error('oldPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter New password...">
                                @error('newPassword')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="control-label mb-1">Comfirm Password</label>
                                <input id="cc-pament3" name="comfirmPassword" type="password" class="passwordInput form-control @error('oldPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Confirm password...">
                                @error('comfirmPassword')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div>
                                <input type="checkbox" onclick="changeInputType()" class="m-2 show_password_status">Show Password
                            </div>

                            <div class="my-3 offset-8">
                                <button id="payment-button" type="submit" class="btn btn-lg btn-dark btn-block">
                                    <span id="payment-button-amount">Change</span>
                                    <span id="payment-button-sending" style="display:none;">Sending…</span>
                                    <i class="fa-solid fa-key"></i>
                                </button>
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
  let input = document.getElementsByClassName('passwordInput');
    for (let i = 0; i < input.length; i++) {
        if (input[i].type === "password") {
            input[i].type = "text";
        } else {
            input[i].type = "password";
        }

    }
}

</script>
@endsection
