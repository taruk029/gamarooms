@extends('frontend.layout.app')
@section('title', 'Payment Details')
@push('styles')
<link href="{{ asset('public/assets/css/bootstrap-select.min.css') }}" rel="stylesheet">
<style type="text/css">
.sal{
    line-height: 50px;
}
.info_booking{
    font-size:12px;
}
</style>
@endpush
@section('content')
<?php $criteria = Session::get('criteria'); ?>
    <div class="theme-hero-area">
      <div class="theme-hero-area-bg-wrap">
        <div class="theme-hero-area-bg-pattern theme-hero-area-bg-pattern-ultra-light" style="background-image:url({{ asset('public/frontend/img/patterns/travel/4.png') }} ) ;"></div>
        <div class="theme-hero-area-grad-mask"></div>
      </div>
      <div class="theme-hero-area-body">
        <div class="container">
          <div class="row _pv-60">
          </div>
        </div>
      </div>
    </div>
     <div class="theme-page-section theme-page-section-lg">
      <div class="container">
        <div class="row row-col-static row-col-mob-gap" id="sticky-parent" data-gutter="60">
          <div class="col-md-12 ">
            <h2>Cancellation Details</h2>
                <div class="theme-payment-page-sections">
                  <div class="theme-payment-page-sections-item">
                    <h3 class="theme-payment-page-sections-item-title"></h3>
                    <div class="theme-payment-page-form">
                      <div class="row row-col-gap" data-gutter="20">
                        <div class="col-md-8">
                          <table>
                              <?php $i =1; ?>
                                @if($data)
                                    @if($data->IsCancellable==1)
                                        <tr>
                                          <td>- Booking Reference  - <strong>{{$booking['reference_id']}}</strong></td>
                                        </tr>
                                        <tr>
                                          <td>- Booking Amount  - <strong>{{$booking['currency']}} {{$booking['booking_amount']+$booking['commission']}}</strong></td>
                                        </tr>
                                        <tr>
                                          <td><hr></td>
                                        </tr>
                                        @if(isset($data->CancellationPolicyStatic[0]->CancellationCharges))
                                        <?php $is_true = 0;
                                            $amount = 0;
                                            $currency = "";?>
                                        @foreach($data->CancellationPolicyStatic[0]->CancellationCharges as $rows)
                                            <tr><td><br></td></tr>
                                            <tr>
                                              <td>- Expiry Date - <strong><?php $exd = date_create($rows->ExpiryDate); echo date_format($exd,'M d, Y'); ?></strong></td>
                                            </tr>
                                            <tr><td><br></td></tr>
                                            <tr>
                                              <td>- Cancellation Charge - <strong>{{$rows->Charge->Currency}} {{$rows->Charge->Amount}}</strong></td>
                                            </tr>
                                            <tr>
                                              <td><h5>You will be charged {{$rows->Charge->Currency}} {{$rows->Charge->Amount}} for cancelling this booking till <?php $exd = date_create($rows->ExpiryDate); echo date_format($exd,'M d, Y'); ?>.</h5></td>
                                            </tr>
                                            <?php
                                            $cur_date =  date("Y-m-d H:i:s");
                                            $exd = date_create($rows->ExpiryDate); $check_date = date_format($exd,'Y-m-d H:i:s');
                                            if($cur_date<=$check_date)
                                            {
                                                if($is_true==0)
                                                {
                                                    $amount = $rows->Charge->Amount;
                                                    $currency = $rows->Charge->Currency;
                                                }
                                                $is_true=1;
                                            } 
                                            ?>
                                        @endforeach
                                        @endif
                                    @else
                                    <tr>
                                      <td><h3>Sorry, you can not cancel this booking.</h3></td>
                                    </tr>
                                    @endif
                                @endif
                          </table><br>
                        </div>
                        <div class="col-md-4">
                            <img src="{{ asset('public/img/cancel.png')}}" class="img-rounded pull-right" style="height:110px;">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <hr>
                <div class="col-md-offset-4 col-md-4">
                    <a href="{{url('confirm_cancel/'.$booking_id."/".base64_encode($amount)."/".base64_encode($currency))}}" class="btn btn-lg _tt-uc btn-primary-inverse btn-block" onclick="return confirm('Are you sure to cancel this booking?');">Confirm to Cancel !</a>
                </div>
                <br>
                <br>
                <br>
                <br>
                <br>
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
<script type="text/javascript">
   /* window.onbeforeunload = function() {
        return "Dude, are you sure you want to leave? Think of the kittens!";
    }*/
</script>
@endpush