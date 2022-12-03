@extends('frontend.layout.app')
@section('title', 'Payment Details')
@push('styles')
@section('content')
<div class="theme-page-section theme-page-section-gray theme-page-section-xl">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
            <div class="theme-payment-success">
              <div class="theme-payment-success-header">
                <i class="fa fa-check-circle theme-payment-success-header-icon"></i>
                <h1 class="theme-payment-success-title">Cancellation Details</h1>
                <p class="theme-payment-success-subtitle">The booking has been cancelled successfully.</p>
              </div>
              <div class="theme-payment-success-box">
                <ul class="theme-payment-success-summary">
        	        <li>Status
                        <span>Cancelled</span>
                    </li>
                    <li>Order Id
                        <span>{{$booking['reference_id']}}</span>
                    </li>
                    <li>Booking Amount 
                        <span>{{$booking['currency']}}  {{$booking['booking_amount']+$booking['commission']}}</span>
                    </li>
                    <li>Cancellation Charge
                        <span>{{$booking['currency']}} {{$booking['cancellation_charge']}}</span>
                    </li>
                </ul>
                <p class="theme-payment-success-check-order"><a href="{{ url('/')}}">Go to Homepage</a>.
                </p>
              </div>
              <ul class="theme-payment-success-actions">
                <!--<li>
                  <a href="#">
                    <i class="fa fa-file-pdf-o"></i>
                    <p>PDF
                      <br>receipt
                    </p>
                  </a>
                </li>-->
                <!--<li>
                  <a href="#">
                    <i class="fa fa-envelope-o"></i>
                    <p>SMS
                      <br>receipt
                    </p>
                  </a>
                </li>-->
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection