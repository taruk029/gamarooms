@extends('frontend.layout.app')
@section('title', 'Home')
@push('styles')
@endpush
@section('content')
<div class="theme-hero-area">
      <div class="theme-hero-area-bg-wrap">
        <div class="theme-hero-area-bg" style="background-image:url( {{ asset('public/img/adult-book-business-cactus-297755_1500x800.jpg') }} );"></div>
        <div class="theme-hero-area-mask theme-hero-area-mask-strong"></div>
      </div>
      <div class="theme-hero-area-body">
        <div class="theme-page-section _pt-100 theme-page-section-xl">
          <div class="container">
            <div class="row">
              <div class="col-md-4 col-md-offset-4">
                <div class="theme-login theme-login-white">
                  <div class="theme-login-header">
                    <h1 class="theme-login-title">Password Reset</h1>
                    <p class="theme-login-subtitle">Restore your forgotten password</p>
                  </div>
                  <div class="theme-login-box">
                    <div class="theme-login-box-inner">
                      <p class="theme-login-pwd-reset-text">Reset Your Password</p>
                      <div class="form-group theme-login-form-group">
                        <form action="{{url('reset_password')}}" method="post" id="reset">
                            @csrf
                            <input type="password" name="password" id="password" class="form-control" placeholder="Enter New Password" required="required" maxlength="191">
                            <br>
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password" required="required" maxlength="191">
                            <input type="hidden" name="id" value="{{$id}}">
                            <input type="hidden" name="token" value="{{$token}}">
                            
                      </div>
                      <button class="btn btn-uc btn-dark btn-block btn-lg" type="submit">Reset Password</button>
                        </form>
                      <a class="theme-login-pwd-reset-back" href="{{ url('/')}}">Remember the password?</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
@endsection
@push('scripts')

<script src="{{ asset('public/frontend/js/jquery.validate.js') }}"></script>
<script src="{{ asset('public/frontend/js/additional-methods.js') }}"></script>
<script type="text/javascript">           
$("#reset").validate({
    rules: {
        password: {
            required: true,
            minlength: 5
        },
        confirm_password: {
            required: true,
            minlength: 5,
            equalTo: "#password"
        },
    messages: {            
        password: {
            required: "Please provide a password",
            minlength: "Your password must be at least 5 characters long"
        },
        confirm_password: {
            required: "Please provide a password",
            minlength: "Your password must be at least 5 characters long",
            equalTo: "Please enter the same password as above"
        }
    }
    }
});
</script>
@endpush