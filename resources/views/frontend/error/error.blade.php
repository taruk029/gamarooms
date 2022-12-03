@extends('frontend.layout.app')
@section('title', 'Home')
@push('styles')
<link href="{{ asset('assets/css/bootstrap-select.min.css') }}" rel="stylesheet">
<style type="text/css">
.sal{
    line-height: 50px;
}
</style>
@endpush
@section('content')
    <div class="theme-hero-area theme-hero-area-full">
      <div class="theme-hero-area-bg-wrap">
        <div class="theme-hero-area-bg" style="background-image:url({{ asset('public/frontend/img/buoy-dawn-daylight-forest-442555_1500x800.jpg') }} );"></div>
        <div class="theme-hero-area-mask theme-hero-area-mask-dark"></div>
        <div class="theme-hero-area-inner-shadow"></div>
      </div>
      <div class="theme-hero-area-body theme-hero-area-body-vert-center">
        <div class="container">
          <div class="theme-page-404 _ta-c">
                @if(isset($response))
                <h1 class="theme-page-404-title"><?php echo $response->getStatusCode() ?></h1>
                <p class="theme-page-404-subtitle"><?php echo $response->getReasonPhrase() ?></p>
                <p class="theme-page-404-subtitle"><?php echo $response->getBody() ?></p>
                @else
                <h2 class="theme-page-404-title">Sorry</h2>
                <p class="theme-page-404-subtitle"><?php echo $message ?></p>
                @endif
            <a class="btn btn-ghost btn-xxl btn-white btn-uc" href="<?php if(isset($_SERVER['HTTP_REFERER'])) echo $_SERVER['HTTP_REFERER']; ?>">Go Back</a>
          </div>
        </div>
      </div>
    </div>
@endsection
@push('scripts')
<script type="text/javascript" src="{{ asset('assets/js/bootstrap-select.min.js') }}"></script>
@endpush