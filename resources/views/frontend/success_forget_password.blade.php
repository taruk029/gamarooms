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
                    <h1 class="theme-login-title">Cheers!</h1>
                  </div>
                  <div class="theme-login-box">
                    <div class="theme-login-box-inner">
                      <p class="theme-login-pwd-reset-text">You have successfully reset your password.</p>
                      <a class="btn btn-login" href="{{url('login')}}">Click Here to Login</a>
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