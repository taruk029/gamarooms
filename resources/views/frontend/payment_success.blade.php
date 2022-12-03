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
                <h1 class="theme-payment-success-title">Payment Successful</h1>
               <!-- <p class="theme-payment-success-subtitle">We have emailed you the receipt.</p>-->
              </div>
              <div class="theme-payment-success-box">
                <ul class="theme-payment-success-summary">
                <?php 
                $order_id = "";
                for($i = 0; $i < $dataSize; $i++) 
    	        { 
    	            $information=explode('=',$decryptValues[$i]);
    	        ?>
    	        @if($i==3)
        	        <li>Status
                        <span>{{$information[1]}}</span>
                    </li>
                @elseif($i==0)
                <?php $order_id = $information[1];?>
                    <li>Order Id
                        <span>{{$information[1]}}</span>
                    </li>
                @elseif($i==1)
                    <li>Tracking Id
                        <span>{{$information[1]}}</span>
                    </li>
                @elseif($i==9)
                    <li>Currency
                        <span>{{$information[1]}}</span>
                    </li>
                @elseif($i==10)
                    <li>Amount
                        <span>{{$information[1]}}</span>
                    </li>
                @endif
    		    <?php } ?>
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
                <li>
                  <a target="_blank" href="{{ url('voucher/'.base64_encode($order_id))}}">
                    <i class="fa fa-print"></i>
                    <p>View
                      <br>receipt
                    </p>
                  </a>
                </li>
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