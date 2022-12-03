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
                      <p class="theme-login-pwd-reset-text">Enter the email associated with your account in the field below and we'll email you a link to reset your password.</p>
                      <div class="form-group theme-login-form-group">
                        <form action="{{url('forget_password')}}" method="post">
                            @csrf
                            <input class="form-control" type="email" name="email" id="email" placeholder="Email Adress" required="required" maxlength="191"/>
                      </div>
                      <button class="btn btn-uc btn-dark btn-block btn-lg" type="submit">Submit</button>
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
@endpush