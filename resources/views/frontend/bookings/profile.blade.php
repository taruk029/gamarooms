@extends('frontend.layout.app')
@section('title', 'Home')
@push('styles')
<link href="{{ asset('public/backend/datatables/assets/vendors/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endpush
@section('content')
<div class="theme-hero-area theme-hero-area-half">
      <div class="theme-hero-area-bg-wrap">
        <div class="theme-hero-area-bg" style="background-image:url({{ asset('public/img/activity-adult-beach-beautiful-378152_1500x800.jpg') }});"></div>
        <div class="theme-hero-area-mask theme-hero-area-mask-half"></div>
        <div class="theme-hero-area-inner-shadow"></div>
      </div>
      <div class="theme-hero-area-body">
        <div class="container">
          <div class="row">
            <div class="col-md-8 col-md-offset-2 theme-page-header-abs">
              <div class="theme-page-header theme-page-header-lg">
                <h1 class="theme-page-header-title">My Profile</h1>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@include('flash::message')
<div class="theme-page-section theme-page-section-gray theme-page-section-lg">
      <div class="container">
        <div class="row">
          <div class="col-md-12 ">
            <div class="row">
              <div class="col-md-12 ">
                  <form action="{{ url('update_profile')}}" method="post" >
                      @csrf
                <div class="theme-account-preferences">
                  <div class="theme-account-preferences-item">
                    <div class="row">
                      <div class="col-md-3 ">
                        <h5 class="theme-account-preferences-item-title">Email Address</h5>
                      </div>
                      <div class="col-md-7 ">
                        <p class="theme-account-preferences-item-value">{{$agent['email']}}</p>
                      </div>
                    </div>
                  </div>
                  <div class="theme-account-preferences-item">
                    <div class="row">
                      <div class="col-md-3 ">
                        <h5 class="theme-account-preferences-item-title">First Name</h5>
                      </div>
                      <div class="col-md-7 ">
                        <input class="form-control" type="text" name="first_name"  value="{{$agent['first_name']}}" required />
                      </div>
                    </div>
                  </div>
                  <div class="theme-account-preferences-item">
                    <div class="row">
                      <div class="col-md-3 ">
                        <h5 class="theme-account-preferences-item-title">Last Name</h5>
                      </div>
                      <div class="col-md-7 ">
                        <input class="form-control" type="text" name="last_name" value="{{$agent['last_name']}}" required />
                      </div>
                    </div>
                  </div>
                  <div class="theme-account-preferences-item">
                    <div class="row">
                      <div class="col-md-3 ">
                        <h5 class="theme-account-preferences-item-title">Agency Name</h5>
                      </div>
                      <div class="col-md-7 ">
                        <input class="form-control" type="text" name="agency_name" value="{{$agent['agency_name']}}" required />
                      </div>
                    </div>
                  </div>
                  <div class="theme-account-preferences-item">
                    <div class="row">
                      <div class="col-md-3 ">
                        <h5 class="theme-account-preferences-item-title">Agency Email</h5>
                      </div>
                      <div class="col-md-7 ">
                        <input class="form-control" type="text" name="agency_email" value="{{$agent['agency_email']}}" required />
                      </div>
                    </div>
                  </div>
                  <div class="theme-account-preferences-item">
                    <div class="row">
                      <div class="col-md-3 ">
                        <h5 class="theme-account-preferences-item-title">City</h5>
                      </div>
                      <div class="col-md-7 ">
                        <input class="form-control" type="text" name="city" value="{{$agent['city']}}" required />
                      </div>
                    </div>
                  </div>
                  <div class="theme-account-preferences-item">
                    <div class="row">
                      <div class="col-md-3 ">
                        <h5 class="theme-account-preferences-item-title">IATA status</h5>
                      </div>
                      <div class="col-md-7 ">
                        <div class="form-group">
                            <div class="radio-wrapper">
                              <label class="radio-inline">
                                <input type="radio" name="iata_status" value="1" <?php if($agent['iata_status']==1) echo "checked"; ?> onclick="open_iata_no(1)" tabindex="9">Approved
                              </label>
                              <label class="radio-inline">
                                <input type="radio" name="iata_status" value="0" <?php if($agent['iata_status']==0) echo "checked"; ?> onclick="open_iata_no(0)" tabindex="10" >Not Approved
                              </label>
                            </div>
                            <br>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="theme-account-preferences-item" <?php if($agent['iata_status']==0) echo "style='display:none;'"; else echo "style='display:block;'"; ?> id="iata_no_div">
                    <div class="row">
                      <div class="col-md-3 ">
                        <h5 class="theme-account-preferences-item-title">IATA Number</h5>
                      </div>
                      <div class="col-md-7 ">
                        <input class="form-control" type="text" name="iata_no" id="iata_no" value="{{$agent['iata_no']}}"/>
                      </div>
                    </div>
                  </div>
                  <div class="theme-account-preferences-item">
                    <div class="row">
                      <div class="col-md-3 ">
                        <h5 class="theme-account-preferences-item-title">Country</h5>
                      </div>
                      <div class="col-md-7 ">
                            <select name="country" id="country" class="form-control" tabindex="8" required >
                            <option value="">Select Country</option>
                            @if($countries)
                              @foreach($countries as $rows)
                                <option <?php if($agent['country']==$rows->id) echo "selected"; ?> value="{{ $rows->id }}">{{ $rows->name }}</option>
                              @endforeach
                            @endif
                          </select>
                      </div>
                    </div>
                  </div>
                  
                <div class="theme-account-preferences-item-change-actions">
                 <center> <input type="submit" class="btn btn-md btn-primary" value="Submit Changes"></center>
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
<script src="{{ asset('public/backend/datatables/assets/vendors/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/backend/datatables/assets/js/demo8/pages/crud/datatables/basic/paginations.js') }}" type="text/javascript"></script>
@endpush
<script type="text/javascript">
  function open_iata_no(id)
  {
    if(id==1)
    {
      $("#iata_no_div").css('display', 'block');
      $("#iata_no").attr('required', 'required');
    }
    else
    {
      $("#iata_no_div").css('display', 'none');
      $("#iata_no").removeAttr('required');

    }
  }
</script>