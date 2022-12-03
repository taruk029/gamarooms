@extends('frontend.layout.app')
@section('title', 'Payment Details')
@push('styles')
<link href="{{ asset('public/assets/css/bootstrap-select.min.css') }}" rel="stylesheet">
<style type="text/css">
.sal{
    line-height: 50px;
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
          <div class="col-md-8 ">
            <div class="theme-payment-page-sections">
              <div class="theme-payment-page-sections-item">
                <h3 class="theme-payment-page-sections-item-title">Guest Details</h3>
                <div class="theme-payment-page-form">
                  <div class="row row-col-gap" data-gutter="20">
                    <div class="col-md-6 ">
                      <table>
                          <?php $i =1; ?>
                            @if($guests)
                                @foreach($guests as $row)
                                    <tr>
                                      <td>{{$i}} - {{$row}}</td>
                                    </tr>
                                <?php $i++; ?>   
                                @endforeach
                            @endif
                            @if($kids_count)
                                <tr>
                                    <td>+ {{$kids_count}} Child(ren)</td>
                                </tr>
                            @endif
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="theme-payment-page-sections-item">
                <h3 class="theme-payment-page-sections-item-title">Enter Cutomer Information</h3>
                <div class="theme-payment-page-form">
                    <div class="theme-payment-page-form _mb-20">
                  <!--<h3 class="theme-payment-page-form-title">Cutomer's Details</h3>-->
                  <form action="{{ url('pay_details')}}" method="post">
                      @csrf
                  <div class="row row-col-gap" data-gutter="20">
                    <div class="col-md-6 ">
                      <div class="theme-payment-page-form-item form-group">
                        <input class="form-control" type="text" placeholder="Name" name="name" maxlength="50" required value="{{Auth::user()['name']}}">
                      </div>
                    </div>
                    <div class="col-md-6 ">
                      <div class="theme-payment-page-form-item form-group">
                        <input class="form-control" type="email" placeholder="Email" name="email" maxlength="50" required value="{{Auth::user()['email']}}">
                      </div>
                    </div>
                    <div class="col-md-6 ">
                      <div class="theme-payment-page-form-item form-group">
                        <input class="form-control" type="text" placeholder="Phone" name="phone" maxlength="10" required >
                      </div>
                    </div>
                    <div class="col-md-6 ">
                      <div class="theme-payment-page-form-item form-group">
                        <input class="form-control" type="text" placeholder="Billing Address" name="address" maxlength="100" required value="">
                      </div>
                    </div>
                    <div class="col-md-6 ">
                      <div class="theme-payment-page-form-item form-group">
                        <input class="form-control" type="text" placeholder="City" name="city"   maxlength="50" required value="{{$agent_details['city']}}">
                      </div>
                    </div>
                    
                    <div class="col-md-6 ">
                      <div class="theme-payment-page-form-item form-group">
                        <input class="form-control" type="text" placeholder="Country" name="country" maxlength="50" required value="{{$agent_details['name']}}">
                      </div>
                    </div>
                    <div class="col-md-6 ">
                        <h3 class="theme-payment-page-sections-item-title">Payment</h3>
                      <div class="theme-payment-page-form-item form-group">
                            <label class="radio-inline">
                              <input type="radio" name="payment_mode" checked value="1">Credit/Debit Card
                            </label>
                            <label class="radio-inline">
                                <?php $wallet_amount = App\Helpers\Helper::get_wallet_amount(Auth::user()['id']); ?>
                              <input type="radio" name="payment_mode" value="2" <?php if($wallet_amount < $total_amount) echo "disabled";echo " title='Your wallet has insufficient balance to make this booking';" ?> >Wallet
                            </label>
                      </div>
                    </div>
                    <input type=hidden name="merchant_id" value="{{$merchant_id}}">
                    <input type="hidden" name="redirect_url" value="{{url('ccavResponseHandler')}}"/><br>
                    <input type="hidden" name="cancel_url" value="{{url('ccavResponseHandler')}}"/><br>
                    <input type=hidden name="amount" value="{{$total_amount}}"><br>
                    <input type="hidden" name="order_id" value="{{$product_id}}"/><br>
                    <input type="hidden" name="booking_id" value="{{$booking_id}}"/><br>
                    <input type="hidden"  name="currency" value="<?php if(Session::has('currency')) { if(Session::get('currency')=="AED") echo "AED"; else echo '$';} else echo "AED"; ?>"/><br>
                  </div>
                </div>
                  <div class="row row-col-gap" data-gutter="20">
                    
                    <div class="col-md-6 ">
                   
                    </div>
                  </div>
                </div>
              </div>
              <div class="theme-payment-page-sections-item">
                <div class="theme-payment-page-booking">
                  
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 ">
            <div class="sticky-col">
              <div class="theme-sidebar-section _mb-10">
                <h5 class="theme-sidebar-section-title">Booking Summary</h5>
                <ul class="theme-sidebar-section-summary-list">
                  <li><strong>Booking Reference - {{$reference_id}}</strong></li>
                  <li>{{$count_rooms}} room, {{count($guests)}} adults</li>
                  <li>Check-in: <?php $start_booking = date_create($start_booking_date); echo date_format($start_booking,'d-m-Y');?></li>
                  <li>Check-out: <?php $end_booking = date_create($end_booking_date); echo date_format($end_booking,'d-m-Y');?></li>
                </ul>
              </div>
              <div class="theme-sidebar-section _mb-10">
                <h5 class="theme-sidebar-section-title">Charges</h5>
                <div class="theme-sidebar-section-charges">
                  <ul class="theme-sidebar-section-charges-list">
                    <li class="theme-sidebar-section-charges-item">
                      <h5 class="theme-sidebar-section-charges-item-title"><?php $diff=date_diff($end_booking,$start_booking); echo $diff->format("%a") ?> nights</h5>
                      <p class="theme-sidebar-section-charges-item-subtitle">2 Guests</p>
                      <p class="theme-sidebar-section-charges-item-price"><?php if(Session::has('currency')) { if(Session::get('currency')=="AED") echo "AED"; else echo '$';} else echo "AED"; ?> {{$total_amount}}</p>
                    </li>
                  </ul>
                  <p class="theme-sidebar-section-charges-total">Total
                    <span><?php if(Session::has('currency')) { if(Session::get('currency')=="AED") echo "AED"; else echo '$';} else echo "AED"; ?> {{$total_amount}}</span>
                  </p>
                </div>
              </div>
              <div class="theme-payment-page-sections-item">
                <div class="theme-payment-page-booking">
                <div class="theme-payment-page-booking-header">
                    <p class="">By clicking book now button you agree with terms and conditionals. Thank you for trusting our service.</p>
                </div>
                <button type="submit" class="btn _tt-uc btn-primary-inverse btn-lg btn-block">Pay Now</a>
                </div>
                </form>
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