@extends('frontend.layout.app')
@section('title', 'Search Hotels')
@push('styles')
<link href="{{ asset('assets/css/bootstrap-select.min.css') }}" rel="stylesheet">
<style type="text/css">
.sal{
    line-height: 50px;
}
.icheck_box
{
    position: absolute;
    top: 0%;
    left: 0%;
    display: block;
    width: 100%;
    height: 100%;
    margin: 0px;
    padding: 0px;
    background: rgb(255, 255, 255);
    margin-left:-70px !important;
}
.clear{
 clear:both;
 margin-top: 20px;
}

#searchResult{
list-style: none;
padding: 0px;
width: 250px;
position: absolute;
margin: 0;
z-index: 1;
overflow-y: scroll !important;
}

#searchResult li{
background: white;
color:black;
padding: 4px;
}

#searchResult li:hover{
background: white;
color:black;
padding: 4px;
font-size:16px;
}

/*#search_by_name li:nth-child(even){
 background: cadetblue;
 color: white;
}*/

#searchResult li:hover{
 cursor: pointer;
 background: #eeeeee;
}

/*input[type=text]{
 padding: 5px;
 width: 250px;
 letter-spacing: 1px;
}*/
/*.bgimg{
    background-image: url("public/assets/img/rxgcjsathdq_1500x800.png");
    background-repeat: no-repeat;
    background-attachment: fixed;
    -o-background-size: cover;
    -moz-background-size: cover;
    -webkit-background-size: cover;
    
transform: translate3d(0px, -156px, 0px);
height: 939px;
}*/
/* width */
::-webkit-scrollbar {
  width: 10px;
}

/* Track */
::-webkit-scrollbar-track {
  background: #f1f1f1; 
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: #888; 
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #555; 
}
/*input[type=text]{
 padding: 5px;
 width: 250px;
 letter-spacing: 1px;
}*/
</style>
@endpush
@section('content')

<?php $criteria = Session::get('criteria'); ?>
    <div class="theme-hero-area">
      <div class="theme-hero-area-bg-wrap">
        <div class="theme-hero-area-bg-pattern theme-hero-area-bg-pattern-ultra-light" style="background-image:url({{ asset('frontend/img/patterns/travel/4.png') }} ) ;"></div>
        <div class="theme-hero-area-grad-mask"></div>
      </div>
      <div class="theme-hero-area-body">
        <div class="container">
          <div class="row _pv-60">
            <div class="col-md-9 ">
              <div class="">
                <div class="theme-hero-text theme-hero-text-white">
                  <div class="theme-hero-text-header">
                    <h2 class="theme-hero-text-title _mb-20 theme-hero-text-title-sm">{{$count_hotels}} Hotels in {{$province['name']}}</h2>
                  </div>
                </div>
                
                <ul class="theme-breadcrumbs _mt-20">
                  <li>
                    <p class="theme-breadcrumbs-item-title">
                      <a href="{{ url('/') }}">Home</a>
                    </p>
                  </li>
                  <li>
                    <p class="theme-breadcrumbs-item-title">
                      <a href="#">{{ $country['name'] }}</a>
                    </p>
                  </li>
                  <li>
                    <p class="theme-breadcrumbs-item-title active">{{$province['name']}} Hotels</p>
                  </li>
                </ul>
              </div>
              <div class="theme-search-area-inline _desk-h theme-search-area-inline-white">
                <h4 class="theme-search-area-inline-title">{{$count_hotels}} Hotels in {{$province['name']}}</h4>
                <p class="theme-search-area-inline-details">{{$start_date}} &rarr; {{$end_date}}, 1 Room</p>
                <a class="theme-search-area-inline-link magnific-inline" href="#searchEditModal">
                  <i class="fa fa-pencil"></i>Edit
                </a>
                <div class="magnific-popup magnific-popup-sm mfp-hide" id="searchEditModal">
                  <div class="theme-search-area theme-search-area-vert">
                    <div class="theme-search-area-header">
                      <h1 class="theme-search-area-title theme-search-area-title-sm">Edit your Search</h1>
                      <p class="theme-search-area-subtitle">Prices might be different from current results</p>
                    </div>
                    <div class="theme-search-area-form">
                        <form method="get" action="{{ url('search_hotel')}}" id="gama_form"  autocomplete="off" >
                      <div class="theme-search-area-section first theme-search-area-section-curved">
                        <label class="theme-search-area-section-label">Where</label>
                        <div class="theme-search-area-section-inner" id="wrap-text" <?php if(!empty($txt_search)) echo "style='overflow-x:hidden'"; ?>>
                          <i class="theme-search-area-section-icon lin lin-location-pin"></i>
                          <input class="theme-search-area-section-input" value="{{$txt_search}}" id="txt_search_mobile"  name="txt_search_mobile" type="text" placeholder="Hotel Location">
                        </div>
                      </div>
                      <div class="row" data-gutter="10">
                        <div class="col-md-6 ">
                          <div class="theme-search-area-section theme-search-area-section-curved">
                            <label class="theme-search-area-section-label">Check In</label>
                            <div class="theme-search-area-section-inner">
                              <i class="theme-search-area-section-icon lin lin-calendar"></i>
                              <input class="theme-search-area-section-input datePickerStart _mob-h" value="{{$start_date}}" type="text" placeholder="Check-in"/>
                              <!--<input class="theme-search-area-section-input _desk-h mobile-picker" value="2018-06-27" type="date"/>-->
                              <input class="theme-search-area-section-input _desk-h mobile-picker" name="start_date" value="<?php $exd = date_create($start_date); echo date_format($exd,'Y-m-d');?>" type="date" required placeholder="Check-in"/>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6 ">
                          <div class="theme-search-area-section theme-search-area-section-curved">
                            <label class="theme-search-area-section-label">Check Out</label>
                            <div class="theme-search-area-section-inner">
                              <i class="theme-search-area-section-icon lin lin-calendar"></i>
                              <input class="theme-search-area-section-input datePickerEnd _mob-h" value="{{$end_date}}" type="text" placeholder="Check-out"/>
                              <!--<input class="theme-search-area-section-input _desk-h mobile-picker" value="2018-07-02" type="date"/>-->
                              <input class="theme-search-area-section-input _desk-h mobile-picker" value="<?php $exd = date_create($end_date); echo date_format($exd,'Y-m-d');?>" type="date"  name="end_date" required placeholder="Check-out"/>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row" data-gutter="10">
                        <div class="col-md-6 ">
                          <div class="theme-search-area-section theme-search-area-section-curved quantity-selector" data-increment="Rooms">
                            <label class="theme-search-area-section-label">Rooms</label>
                            <div class="theme-search-area-section-inner">
                              <i class="theme-search-area-section-icon lin lin-tag"></i>
                              <input class="theme-search-area-section-input" value="{{$room}} Room" type="text" name="rooms"/>
                              <div class="quantity-selector-box" id="mobile-HotelSearchRooms">
                                <div class="quantity-selector-inner">
                                  <p class="quantity-selector-title">Rooms</p>
                                  <ul class="quantity-selector-controls">
                                    <li class="quantity-selector-decrement">
                                      <a href="#">&#45;</a>
                                    </li>
                                    <li class="quantity-selector-current">{{$room}}</li>
                                    <li class="quantity-selector-increment">
                                      <a href="#">&#43;</a>
                                    </li>
                                  </ul>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6 ">
                          <div class="theme-search-area-section theme-search-area-section-curved quantity-selector" data-increment="Guests">
                            <label class="theme-search-area-section-label">Guests</label>
                            <div class="theme-search-area-section-inner">
                              <i class="theme-search-area-section-icon lin lin-people"></i>
                              <input class="theme-search-area-section-input" value="{{$guest}} Guests" type="text" name="guest"/>
                              <div class="quantity-selector-box" id="mobile-HotelSearchGuests">
                                <div class="quantity-selector-inner">
                                  <p class="quantity-selector-title">Guests</p>
                                  <ul class="quantity-selector-controls">
                                    <li class="quantity-selector-decrement">
                                      <a href="#">&#45;</a>
                                    </li>
                                    <li class="quantity-selector-current">{{$guest}}</li>
                                    <li class="quantity-selector-increment">
                                      <a href="#">&#43;</a>
                                    </li>
                                  </ul>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6 ">
                          <div class="theme-search-area-section theme-search-area-section-curved quantity-selector" data-increment="Kids">
                            <label class="theme-search-area-section-label">Kids</label>
                            <div class="theme-search-area-section-inner">
                              <i class="theme-search-area-section-icon lin lin-people"></i>
                              <input class="theme-search-area-section-input" value="{{$kids?$kids:0}} Kids" type="text" name="kids"/>
                              <div class="quantity-selector-box" id="mobile-HotelSearchGuests">
                                <div class="quantity-selector-inner">
                                  <p class="quantity-selector-title">Kids</p>
                                  <ul class="quantity-selector-controls">
                                    <li class="quantity-selector-decrement">
                                      <a href="#">&#45;</a>
                                    </li>
                                    <li class="quantity-selector-current">{{$kids?$kids:0}}</li>
                                    <li class="quantity-selector-increment">
                                      <a href="#">&#43;</a>
                                    </li>
                                  </ul>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="theme-search-area-section first theme-search-area-section-curved">
                        <label class="theme-search-area-section-label">Guest Location</label>
                        <div class="theme-search-area-section-inner">
                          <i class="theme-search-area-section-icon lin lin-location-pin"></i>
                          <select class="theme-search-area-section-input typeahead selectpicker form-control bg-white" data-dropup-auto="false" data-live-search="true" name="source_market" id="source_market" required>
                         <option value=""> Search Location</option>
                        <?php
                        if($country_all)
                        {
                          foreach ($country_all as $row) 
                          {  
                             if($row->countrycode==$source_market)
                          { ?>
                              <option value="{{$row->countrycode}}" selected="selected">{{$row->name}}</option>
                          <?php }
                          else
                          { ?>
                          <option value="{{$row->countrycode}}">{{$row->name}}</option>
                          <?php }
                        }
                        }
                         ?>
                    </select>
                        </div>
                      </div>
                      <button type="submit" class="theme-search-area-submit _mt-0 _tt-uc theme-search-area-submit-curved">Change</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="theme-page-section theme-page-section-gray">
      <div class="container">
        <div class="row row-col-static" id="sticky-parent" data-gutter="20">
          <div class="col-md-3 ">
            <div class="sticky-col _mob-h">
              <!--<div class="theme-search-results-sidebar-map-view _mb-10">
                <a class="theme-search-results-sidebar-map-view-link" href="#"></a>
                <div class="theme-search-results-sidebar-map-view-body">
                  <i class="fa fa-map-marker theme-search-results-sidebar-map-view-icon"></i>
                  <p class="theme-search-results-sidebar-map-view-sign">Map View</p>
                </div>
                <div class="theme-search-results-sidebar-map-view-mask"></div>
              </div>-->
              <form method="get" action="{{ url('search_hotel')}}" id="gama_form"  autocomplete="off" >
              <div class="theme-search-area _p-20 _bg-p _br-4 _mb-20 _bsh theme-search-area-vert theme-search-area-white">
                <div class="theme-search-area-form" id="hero-search-form">
                  <div class="theme-search-area-section first theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">
                    <label class="theme-search-area-section-label">Where</label>
                    <div class="theme-search-area-section-inner" id="wrap-text1" <?php if(!empty($txt_search)) echo "style='overflow-x:hidden'"; ?>>
                      <i class="theme-search-area-section-icon lin lin-location-pin"></i>
                      <input class="theme-search-area-section-input" value="{{$txt_search}}" type="text" id="txt_search1" name="txt_search" placeholder="Hotel Location" onkeyup="javascript:search_location()" autosearch="off"/>
                      
                      <ul id="searchResult"></ul>
                      <input type="hidden" name="search_by_name" id="search_by_name" value="{{$search_by_name}}">
                    </div>
                  </div>
                  <div class="row" data-gutter="10">
                    <div class="col-md-6 ">
                      <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">
                        <label class="theme-search-area-section-label">Check In</label>
                        <div class="theme-search-area-section-inner">
                          <i class="theme-search-area-section-icon lin lin-calendar"></i>
                          <input class="theme-search-area-section-input datePickerStart _mob-h" name="start_date" value="{{$start_date}}" type="text" required placeholder="Check-in"/>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 ">
                      <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">
                        <label class="theme-search-area-section-label">Check Out</label>
                        <div class="theme-search-area-section-inner">
                          <i class="theme-search-area-section-icon lin lin-calendar"></i>
                          <input class="theme-search-area-section-input datePickerEnd _mob-h" value="{{$end_date}}" type="text"  name="end_date" required placeholder="Check-out"/>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row" data-gutter="10">
                    <div class="col-md-6 ">
                      <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border quantity-selector" data-increment="Guests">
                        <label class="theme-search-area-section-label">Guests</label>
                        <div class="theme-search-area-section-inner">
                          <i class="theme-search-area-section-icon lin lin-people"></i>
                          <input class="theme-search-area-section-input" value="{{$guest}} Guests" type="text" name="guest" required/>
                          <div class="quantity-selector-box" id="HotelSearchGuests">
                            <div class="quantity-selector-inner">
                              <p class="quantity-selector-title">Guests</p>
                              <ul class="quantity-selector-controls">
                                <li class="quantity-selector-decrement">
                                  <a href="#">&#45;</a>
                                </li>
                                <li class="quantity-selector-current">{{$guest}}</li>
                                <li class="quantity-selector-increment">
                                  <a href="#">&#43;</a>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 ">
                      <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border quantity-selector" data-increment="Guests">
                        <label class="theme-search-area-section-label">Kids</label>
                        <div class="theme-search-area-section-inner">
                          <i class="theme-search-area-section-icon lin lin-people"></i>
                          <input class="theme-search-area-section-input" value="{{$kids?$kids:0}} Kids" type="text" name="kids" required/>
                          <div class="quantity-selector-box" id="HotelSearchGuests">
                            <div class="quantity-selector-inner">
                              <p class="quantity-selector-title">Kids</p>
                              <ul class="quantity-selector-controls">
                                <li class="quantity-selector-decrement">
                                  <a href="#">&#45;</a>
                                </li>
                                <li class="quantity-selector-current">{{$kids?$kids:0}}</li>
                                <li class="quantity-selector-increment">
                                  <a href="#">&#43;</a>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row" data-gutter="10">
                      <div class="col-md-6 ">
                      <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border quantity-selector" data-increment="Rooms">
                        <label class="theme-search-area-section-label">Rooms</label>
                        <div class="theme-search-area-section-inner">
                          <i class="theme-search-area-section-icon lin lin-tag"></i>
                          <input class="theme-search-area-section-input" value="{{$room}} Room" type="text" name="rooms" required>
                          <div class="quantity-selector-box" id="HotelSearchRooms">
                            <div class="quantity-selector-inner">
                              <p class="quantity-selector-title">Rooms</p>
                              <ul class="quantity-selector-controls">
                                <li class="quantity-selector-decrement">
                                  <a href="#">-</a>
                                </li>
                                <li class="quantity-selector-current">{{$room}}</li>
                                <li class="quantity-selector-increment">
                                  <a href="#">+</a>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="theme-search-area-section first theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">
                    <label class="theme-search-area-section-label">Guest Location</label>
                    <div class="theme-search-area-section-inner">
                      <i class="theme-search-area-section-icon lin lin-location-pin"></i>
                      <select class="theme-search-area-section-input typeahead selectpicker form-control bg-white" data-dropup-auto="false" data-live-search="true" name="source_market" id="source_market" required>
                         <option value=""> Search Location</option>
                        <?php
                        if($country_all)
                        {
                          foreach ($country_all as $row) 
                          {  
                             if($row->countrycode==$source_market)
                          { ?>
                              <option value="{{$row->countrycode}}" selected="selected">{{$row->name}}</option>
                          <?php }
                          else
                          { ?>
                          <option value="{{$row->countrycode}}">{{$row->name}}</option>
                          <?php }
                        }
                        }
                         ?>
                    </select>
                    <!--  <input class="" value="New York" type="text" placeholder="Hotel Location" data-provide="typeahead"/>-->
                    </div>
                  </div>
                  <button class="theme-search-area-submit _mt-0 _tt-uc theme-search-area-submit-curved theme-search-area-submit-sm theme-search-area-submit-white theme-search-area-submit-primary">Change</button>
                </div>
              </div>
              </form>
                 <?php
                        
                        $fare = array();
                        $hotel_name = array();
                        $i = 0;
                        foreach($data as $row)
                        {
                            array_push($hotel_name, $row->EstablishmentInfo->EstablishmentName);
                            if($row->Rooms)
                            {
                                foreach($row->Rooms as $rows)
                                {
                                  $commission_amnt = ($rows->Boards[0]->NetCost->Amount*$commission['commission'])/100;
                                  $amount = round($rows->Boards[0]->NetCost->Amount+$commission_amnt,2);
                                  array_push($fare, $amount);
                                  
                                  if(isset($_GET['pricefrom']) && isset($_GET['priceto']))
                                    { 
                                        if($rows->Boards[0]->NetCost->Amount>=$_GET['pricefrom'] && $rows->Boards[0]->NetCost->Amount<=$_GET['priceto'])
                                        {
                                            continue;
                                        }
                                        else
                                        {
                                            unset($data[$i]);
                                        }
                                    }
                                }
                            }
                            $i++;
                        } 
                        if(isset($_GET['hotel_name']))
                        { 
                            /*echo $_GET['hotel_name'];die;*/
                            if(!empty($_GET['hotel_name']))
                            {
                                $j = 0;
                                foreach($data as $row)
                                {
                                    if($row->EstablishmentInfo->EstablishmentName != $_GET['hotel_name'])
                                    {
                                        unset($data[$j]);
                                    }
                                    $j++;
                                }
                            }
                        }
                       ?>
                       <?php
                       if(isset($_GET['hotel_class']))
                       {
                            if(!empty($_GET['hotel_class']))
                            {
                                $class_arr = explode(",", $_GET['hotel_class']);
                                $j = 0;
                                foreach($data as $row)
                                {
                                    if(!in_array($row->EstablishmentInfo->Rating, $class_arr))
                                    {
                                        unset($data[$j]);
                                    }
                                    $j++;
                                }
                            }
                       }
                       ?>
              <div class="theme-search-results-sidebar">
                <div class="theme-search-results-sidebar-sections _mb-20 _br-2 theme-search-results-sidebar-sections-white-wrap">
                  <div class="theme-search-results-sidebar-section">
                    <h5 class="theme-search-results-sidebar-section-title">Search Hotels</h5>
                    <div class="theme-search-results-sidebar-section-search">
                        <select class="theme-search-results-sidebar-section-search-input" id="hotel_name">
                            <option value="">Search By Hotel</option>
                            <?php if($hotel_name) 
                            {
                                foreach($hotel_name as $hot_row)
                                { 
                                    if(isset($_GET['hotel_name']))
                                    {
                                ?>
                                    <option @if($_GET['hotel_name']==$hot_row) {{"selected"}} @endif value="{{$hot_row}}">{{$hot_row}}</option>
                            <?php
                                    }
                                    else
                                    { ?>
                                    <option value="{{$hot_row}}">{{$hot_row}}</option>
                                <?php }
                                }
                            } ?>
                        </select>
                      <!--<input  type="text" placeholder="Hotel name, address"/>-->
                      <a class="fa fa-search theme-search-results-sidebar-section-search-btn" href="javascript:void(0)" onclick="javascript:search_hotel_name()"></a>
                    </div>
                  </div>
                  <div class="theme-search-results-sidebar-section">
                    <h5 class="theme-search-results-sidebar-section-title">Hotel Class</h5>
                    <div class="theme-search-results-sidebar-section-checkbox-list">
                      <div class="theme-search-results-sidebar-section-checkbox-list-items">
                        <div class="checkbox">
                          <label class="icheck-label">
                              
                            <input class="icheck_box" type="checkbox" <?php if(isset($_GET['hotel_class'])) { if(strpos($_GET['hotel_class'], '5') !== false) echo "checked"; } ?> name="hot_class[]" id="class5" onclick="javascript:hotel_class(5)"/> 
                            <span class="icheck-title"></span>
                          </label>
                          <span class="theme-search-results-sidebar-section-checkbox-list-amount">5 Stars</span>
                        </div>
                        <div class="checkbox">
                          <label class="icheck-label">
                            <input class="icheck_box" type="checkbox" <?php if(isset($_GET['hotel_class'])) { if(strpos($_GET['hotel_class'], '4') !== false) echo "checked"; } ?> name="hot_class[]" id="class4" onclick="javascript:hotel_class(4)"/>
                            <span class="icheck-title"></span>
                          </label>
                          <span class="theme-search-results-sidebar-section-checkbox-list-amount">4 Stars</span>
                        </div>
                        <div class="checkbox">
                          <label class="icheck-label">
                            <input class="icheck_box" type="checkbox" <?php if(isset($_GET['hotel_class'])) { if(strpos($_GET['hotel_class'], '3') !== false) echo "checked"; } ?> name="hot_class[]" id="class3" onclick="javascript:hotel_class(3)"/>
                            <span class="icheck-title"></span>
                          </label>
                          <span class="theme-search-results-sidebar-section-checkbox-list-amount">3 Stars</span>
                        </div>
                        <div class="checkbox">
                          <label class="icheck-label">
                            <input class="icheck_box" type="checkbox" <?php if(isset($_GET['hotel_class'])) { if(strpos($_GET['hotel_class'], '2') !== false) echo "checked"; } ?> name="hot_class[]" id="class2" onclick="javascript:hotel_class(2)"/>
                            <span class="icheck-title"></span>
                          </label>
                          <span class="theme-search-results-sidebar-section-checkbox-list-amount">2 Stars</span>
                        </div>
                        <div class="checkbox">
                          <label class="icheck-label">
                            <input class="icheck_box" type="checkbox" <?php if(isset($_GET['hotel_class'])) { if(strpos($_GET['hotel_class'], '1') !== false) echo "checked"; } ?> name="hot_class[]" id="class1" onclick="javascript:hotel_class(1)"/>
                            <span class="icheck-title"></span>
                          </label>
                          <span class="theme-search-results-sidebar-section-checkbox-list-amount">1 Star</span>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="theme-search-results-sidebar-section">
                    <h5 class="theme-search-results-sidebar-section-title">Price</h5>
                    <div class="theme-search-results-sidebar-section-price">
                    
                      <input id="price-slider" name="price-slider" data-min="{{$fare?min($fare):0}}" data-max="{{$fare?max($fare):500}}"/>
                    </div>
                  </div>

                </div>
              </div>
              <div class="theme-ad">
                <a class="theme-ad-link" href="#"></a>
                <p class="theme-ad-sign">Advertisement</p>
                @foreach($medias as $row)
                  @if($row->id==1)
                    @if(!empty($row->image_name))
                        @if(file_exists(base_path().'/img/side_bannners/'.$row->image_name))   
                            <img src="{{$row->image_url}}" class="img-thumb img" alt="Image Alternative text" title="Image Title" > 
                        @else
                             <img src="{{$row->image_url}}" class="theme-ad-img" alt="Image Alternative text" title="Image Title" > 
                        @endif
                    @endif
                  @endif
                @endforeach
              </div>
            </div>
          </div>
          <div class="col-md-6-5 ">
            <div class="theme-search-results">
              <div class="">
                  <?php 
                  if($data)
                  {
                      $num =1;
                      foreach($data as $row)
                      {
                  ?>
                <div class="theme-search-results-item theme-search-results-item-"  id="hotel_{{$num}}">
                  <div class="theme-search-results-item-preview">
                    <a class="theme-search-results-item-mask-link" data-id="{{$num}}" data-establishmentid="{{$row->EstablishmentId}}" href="#searchResultsItem-{{$num}}" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="searchResultsItem-"></a>
                    <a class="theme-search-results-item-bookmark theme-search-results-item-bookmark-top" href="#">
                      <i class="fa fa-bookmark"></i>
                      <span>Watch</span>
                    </a>
                    <div class="row" data-gutter="20">
                      <!--<div class="col-md-5 ">
                        <div class="theme-search-results-item-img-wrap">
                          <img class="theme-search-results-item-img" src="img/hotel-results/1.jpg" alt="Image Alternative text" title="Image Title"/>
                        </div>
                      </div>-->
                      <div class="col-md-9 ">
                        <ul class="theme-search-results-item-hotel-stars">
                            <?php if(isset($row->EstablishmentInfo->RatingTypeId) && $row->EstablishmentInfo->RatingTypeId==1 && isset($row->EstablishmentInfo->Rating))
                            {
                                for($i=1; $i<=$row->EstablishmentInfo->Rating; $i++)
                                { ?>
                                 <li>
                                    <i class="fa fa-star"></i>
                                  </li> 
                                <?php }
                            }?>
                          
                        </ul>
                        <h5 class="theme-search-results-item-title theme-search-results-item-title-lg">{{ $row->EstablishmentInfo->EstablishmentName}}</h5>
                        <div class="theme-search-results-item-hotel-rating">
                          <p class="theme-search-results-item-hotel-rating-title">
                            <b>Accomodation Type:</b>&nbsp;{{ $row->EstablishmentInfo->AccomodationType}}
                          </p>
                        </div>
                        <p class="theme-search-results-item-location">
                          <i class="fa fa-map-marker"></i> {{ $row->EstablishmentInfo->LocationName}}
                        </p>
                      </div>
                      <div class="col-md-3 ">
                        <div class="theme-search-results-item-book">
                          <div class="theme-search-results-item-price">
                              <?php if($row->Rooms)
                              {
                                  $fare = array();
                                  $room_number = 1;
                                  foreach($row->Rooms as $rows)
                                  {
                                      $commission_amnt = ($rows->Boards[0]->NetCost->Amount*$commission['commission'])/100;
                                      /*echo $rows->Boards[0]->NetCost->Amount."<br>";
                                      echo $commission['commission'];*/
                                      $amount = round($rows->Boards[0]->NetCost->Amount+$commission_amnt,2);
                                      array_push($fare, $amount);
                                  }
                              }?>
                            <p class="theme-search-results-item-price-tag">@if(Session::has('currency')) @if(Session::get('currency')=="AED") {{'AED'}} @else {{'$'}}  @endif @else {{'AED'}}  @endif {{ min($fare) }} </p>
                            <!--<p class="theme-search-results-item-price-sign">avg/night</p>-->
                            
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="collapse theme-search-results-item-collapse" id="searchResultsItem-{{$num}}">
                    <div class="theme-search-results-item-extend">
                      <a class="theme-search-results-item-extend-close" href="#searchResultsItem-{{$num}}" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="searchResultsItem-">&#10005;</a>
                      <div class="tabbable theme-search-results-item-tabs">
                        <ul class="nav nav-tabs" role="tablist">
                          <li  class="active"  role="presentation">
                            <a role="tab" data-toggle="tab" href="#tab-item-{{$num}}-3" aria-controls="tab-item-{{$num}}-3">Rooms</a>
                          </li>
                          <li   role="presentation" >
                            <a role="tab" data-toggle="tab" href="#tab-item-{{$num}}-1" aria-controls="tab-item-{{$num}}-1">Details</a>
                          </li>
                          <li role="presentation">
                            <a role="tab" data-toggle="tab" href="#tab-item-{{$num}}-2" aria-controls="tab-item-{{$num}}-2">Map</a>
                          </li>
                        </ul>
                        <div class="tab-content ">
                          <div class="tab-pane " role="tabpanel" id="tab-item-{{$num}}-1">
                            <div class="row" data-gutter="20">
                              <div class="col-md-6 ">
                                <ul class="magnific-gallery theme-search-results-item-tabs-gallery" id="hotel_img_{{$num}}">
                                  
                                </ul>
                              </div>
                              <div class="col-md-6 ">
                                <p class="theme-search-results-item-tabs-details-desc" id="hotel_desc_{{$num}}">
                                   </p>
                                
                              </div>
                            </div>
                          </div>
                          <div class="tab-pane " role="tabpanel" id="tab-item-{{$num}}-2">
                            <div class="row" data-gutter="20">
                              <div class="col-md-7 ">
                                <div class="google-map theme-search-results-item-tabs-map" data-lat="40.7483624" data-lng="-73.9900896" id="hotel_map_{{$num}}"></div>
                              </div>
                              <div class="col-md-5 ">
                                <h3 class="theme-search-results-item-tabs-map-title" id="hotel_address_{{$num}}"></h3>
                                <ul class="theme-search-results-item-tabs-map-rates">
                                  <li>
                                    <i class="fa fa-phone theme-search-results-item-tabs-map-rates-icon"></i>
                                    <h5 class="theme-search-results-item-tabs-map-rates-title"  id="hotel_phone_{{$num}}"> 
                                      
                                    </h5>
                                    <p class="theme-search-results-item-tabs-map-rates-sign"></p>
                                  </li>
                                  <li>
                                    <i class="fa fa-fax theme-search-results-item-tabs-map-rates-icon"></i>
                                    <h5 class="theme-search-results-item-tabs-map-rates-title" id="hotel_fax_{{$num}}">
                                     
                                    </h5>
                                    <p class="theme-search-results-item-tabs-map-rates-sign"></p>
                                  </li>
                                  <li>
                                    <i class="fa fa-envelope-square theme-search-results-item-tabs-map-rates-icon"></i>
                                    <h5 class="theme-search-results-item-tabs-map-rates-title" id="hotel_email_{{$num}}">
                                      
                                    </h5>
                                    <p class="theme-search-results-item-tabs-map-rates-sign"></p>
                                  </li>
                                </ul>
                              </div>
                            </div>
                          </div>
                           <div class="tab-pane active" role="tabpanel" id="tab-item-{{$num}}-3">
                               <?php if($row->Rooms)
                                {
                                  $fare = array();
                                  foreach($row->Rooms as $rows)
                                  {
                                      $commission_amnt = ($rows->Boards[0]->NetCost->Amount*$commission['commission'])/100;
                                      $amount = round($rows->Boards[0]->NetCost->Amount+$commission_amnt,2);
                                      if(isset($_GET['pricefrom']) && isset($_GET['priceto']))
                                      {
                                        if($rows->Boards[0]->NetCost->Amount>=$_GET['pricefrom'] && $rows->Boards[0]->NetCost->Amount<=$_GET['priceto'])
                                        {
                                ?>
                                    <div class="row" data-gutter="20" style="border-bottom:1px #eee solid;">
                                        <div class="col-md-1">
                                            <input type="checkbox" class="form-control room_id" name="selected_rooms_{{$row->EstablishmentId}}[]" data-room_name="{{ $rows->Description }}" onclick="javascript:get_room_booking('{{$row->EstablishmentId}}','{{ $row->EstablishmentInfo->EstablishmentName}}', {{ $rows->Boards[0]->Code }}', '{{$rows->Code}}', '{{ base64_encode($rows->Boards[0]->NetCost->Amount) }}', '{{ base64_encode($amount) }}', {{$room_number}})" id="{{$row->EstablishmentId}}_{{$room_number}}"  value="{{ $rows->Boards[0]->Code }}" style="margin-top:63%;"> 
                                        </div>
                                      <div class="col-md-8">
                                        <h3>{{ $rows->Description }}</h3>
                                        <p>{{ $rows->Boards[0]->Description }}</p>
                                        <ul class="theme-search-results-item-hotel-features">
                                          <li>
                                            <span>!</span>
                                            <b>Cancellation Policy</b>  
                                          </li>
                                        </ul>
                                        <ul class="theme-search-results-item-hotel-features">
                                            <li><br>Cancellation Charge -</b> @if(Session::has('currency')) @if(Session::get('currency')=="AED") {{'AED'}} @else {{'$'}}  @endif @else {{'AED'}}  @endif{{$rows->Boards[0]->CancellationPolicy->CancellationCharges[0]->Charge->Amount}}</li>
                                            <?php if(isset($rows->Boards[0]->CancellationPolicy)) { ?>
                                                <li><br>Expiry Date -</b> <?php $exd = date_create($rows->Boards[0]->CancellationPolicy->CancellationCharges[0]->ExpiryDate); echo date_format($exd,'d-m-Y');?></li>
                                            <?php } ?>
                                        </ul>
                                      </div>
                                      <div class="col-md-3 ">
                                       <div class="theme-search-results-item-book">
                                          <div class="theme-search-results-item-price">
                                            <p class="theme-search-results-item-price-tag">@if(Session::has('currency')) @if(Session::get('currency')=="AED") {{'AED'}} @else {{'$'}}  @endif @else {{'AED'}}  @endif {{ $amount }} </p>
                                            <button type="button" class="btn btn-primary-inverse btn-block theme-search-results-item-price-btn" onclick="javascript:check_hotel_room()">Book Now</button>
                                          </div>
                                        
                                        </div>
                                      </div>
                                    </div>
                            <?php  } } else { ?>
                            <div class="row" data-gutter="20" style="border-bottom:1px #eee solid;">
                                        <div class="col-md-1">
                                            <input type="checkbox" class="form-control room_id" name="selected_rooms_{{$row->EstablishmentId}}[]" data-room_name="{{ $rows->Description }}"  onclick="javascript:get_room_booking('{{$row->EstablishmentId}}', '{{ $row->EstablishmentInfo->EstablishmentName}}', '{{ $rows->Boards[0]->Code }}', '{{$rows->Code}}', '{{ base64_encode($rows->Boards[0]->NetCost->Amount) }}', '{{ base64_encode($amount) }}', {{$room_number}})" id="{{$row->EstablishmentId}}_{{$room_number}}" value="{{ $rows->Boards[0]->Code }}" style="margin-top:63%;"> 
                                        </div>
                                      <div class="col-md-8">
                                        <h3>{{ $rows->Description }}</h3>
                                        <p>{{ $rows->Boards[0]->Description }}</p>
                                        <?php if(isset($rows->Boards[0]->CancellationPolicy)) { ?>
                                        <ul class="theme-search-results-item-hotel-features">
                                          <li>
                                            <span>!</span>
                                            <b>Cancellation Policy</b>  
                                          </li>
                                        </ul>
                                        <ul class="theme-search-results-item-hotel-features">
                                            <li><br>Cancellation Charge -</b>@if(Session::has('currency')) @if(Session::get('currency')=="AED") {{'AED'}} @else {{'$'}}  @endif @else {{'AED'}}  @endif {{$rows->Boards[0]->CancellationPolicy->CancellationCharges[0]->Charge->Amount}}</li>
                                            <li><br>Expiry Date -</b> <?php $exd = date_create($rows->Boards[0]->CancellationPolicy->CancellationCharges[0]->ExpiryDate); echo date_format($exd,'d-m-Y');?></li>
                                        </ul>
                                        <?php } ?>
                                      </div>
                                      <div class="col-md-3 ">
                                       <div class="theme-search-results-item-book">
                                          <div class="theme-search-results-item-price">
                                            <p class="theme-search-results-item-price-tag">@if(Session::has('currency')) @if(Session::get('currency')=="AED") {{'AED'}} @else {{'$'}}  @endif @else {{'AED'}}  @endif {{ $amount }} </p>
                                            <button type="button" class="btn btn-primary-inverse btn-block theme-search-results-item-price-btn" onclick="javascript:check_hotel_room()">Book Now</button>
                                            <!--<p class="theme-search-results-item-price-sign">avg/night</p>-->
                                          </div>
                                        
                                        </div>
                                      </div>
                                    </div>
                            <?php } 
                            $room_number++;
                            } } ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <?php $num++; } /* endforeach */
                }   /* endif */?>
              </div>
            </div>
            <!--<a class="btn _tt-uc _fs-sm _mt-10 btn-white btn-block btn-lg" href="#">Load More Results</a>-->
          </div>
          <div class="col-md-2-5 ">
            <div class="sticky-col _mob-h">
              <div class="theme-ad _mb-20">
                <a class="theme-ad-link" href="#"></a>
                <p class="theme-ad-sign">Advertisement</p>
                @foreach($medias as $row)
                  @if($row->id==2)
                    @if(!empty($row->image_name))
                        @if(file_exists(base_path().'/img/side_bannners/'.$row->image_name))   
                            <img src="{{$row->image_url}}" class="img-thumb img" alt="Image Alternative text" title="Image Title" > 
                        @else
                             <img src="{{$row->image_url}}" class="theme-ad-img" alt="Image Alternative text" title="Image Title" > 
                        @endif
                    @endif
                  @endif
                @endforeach
              </div>
              <div class="theme-ad">
                <a class="theme-ad-link" href="#"></a>
                <p class="theme-ad-sign">Advertisement</p>
                @foreach($medias as $row)
                  @if($row->id==3)
                    @if(!empty($row->image_name))
                        @if(file_exists(base_path().'/img/side_bannners/'.$row->image_name))   
                            <img src="{{$row->image_url}}" class="img-thumb img" alt="Image Alternative text" title="Image Title" > 
                        @else
                             <img src="{{$row->image_url}}" class="theme-ad-img" alt="Image Alternative text" title="Image Title" > 
                        @endif
                    @endif
                  @endif
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Guests Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ url('make_booking') }}" method="post" id="gama_booking_form"  autocomplete="off" >
            @csrf
            <div class="row">
                <div class="col-md-12">
                <div id="room_names">
                </div>
                </div>
            </div>
            <div class="row">
            <div class="col-md-12">
                <h6>Age less than 12 would be considered as child.</h6>
            </div>
            </div>
            @if($room)
                <?php
                for($i=1; $i<=$room; $i++)
                { ?>
                    
            <div class="row">
                <div class="col-md-4">
                    <h3>Room {{$i}}</h3>
                </div>
                <div class="col-md-3">
                    <button type="button" class="btn btn-success btn-xs" onclick="javascript:add_new_link({{$i}})" style="margin-top: 18%;"><i class="fa fa-plus"></i> Add Room {{$i}} Guests</button>
                </div>
                <div class="col-md-3">
                    <div id="remove_link_button{{$i}}" style="display: none">
                        <a href="javascript:void(0)" class="btn btn-danger btn-xs" onclick="javascript:remove_link({{$i}})" style="margin-top: 18%;"><i class="fa fa-minus"></i> Remove Room {{$i}} Guests</a>
                    </div>
                </div>
            </div>
            <hr>   
            <?php $rand_id = rand(10,100)?>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Salutation:</label>
                        <select class="form-control" name="guests_salutation{{$i}}[]" id="guests_salutation{{$rand_id}}" required onchange="javascript:show_age({{$rand_id}})">
                            <option value="">Select</option>
                            <option value="Mr">Mr.</option>
                            <option value="Ms">Ms.</option>
                            <option value="Mrs">Mrs.</option>
                            <option value="Child">Child</option>
                        </select>
                        </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">First Name:</label>
                                <input type="text" class="form-control" name="guests_first_name{{$i}}[]" maxlength="90" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Last Name:</label>
                                <input type="text" class="form-control" name="guests_last_name{{$i}}[]" maxlength="90" required>
                            </div>
                        </div>
                        <div class="col-md-3" id="guests_age_div{{$rand_id}}" style="display:none">
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Age:</label>
                                <input type="number" class="form-control" name="guests_age{{$i}}[]" value="30" id="guests_age{{$rand_id}}"  maxlength="50">
                            </div>
                        </div>
                </div>
                <div id="new_link_div{{$i}}">       
                </div>
                <?php  } ?>
            @endif
            <div id="boarding_details">
            </div>
            <input type="hidden" value="" id="isbooked" name="isbooked" required>
            <input type="hidden" value="{{$province['provinceid']}}" id="province_id" name="province_id" required>
            <input type="hidden" value="" id="establishment_id" name="establishment_id" required>
            <input type="hidden" value="" id="establishment_name" name="establishment_name" required>
            <input type="hidden" value="{{$room}}" id="num_rooms" name="num_rooms" required>
            <input type="hidden" value="{{$start_date}}T00:00:00Z" id="start_booking_date" name="start_booking_date" required>
            <input type="hidden" value="{{$end_date}}T00:00:00Z" id="end_booking_date" name="end_booking_date" required>
            <input type="hidden" value="{{$source_market}}" id="source_market_book" name="source_market_book" required>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Confirm & Book</button>
      </div>
    </div>
    </form>
  </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript" src="{{ asset('assets/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('/frontend/js/jquery.validate.js') }}"></script>
<script src="{{ asset('/frontend/js/additional-methods.js') }}"></script>
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD8aRohIKL9qqZegnjStqlOjaXiwtdnafg&sensor=false"></script>
<script type="text/javascript">
    function add_new_link(id)
    {
        $("#remove_link_button"+id).css("display","block");
        var rand_id = Math.floor(Math.floor(Math.random() * 6) + 1);
        $("#new_link_div"+id).append( '<div class="row"><div class="col-md-3"><div class="form-group"><label for="recipient-name" class="col-form-label">Salutation:</label><select class="form-control" name="guests_salutation'+id+'[]" required onchange="javascript:show_age('+rand_id+')" id="guests_salutation'+rand_id+'"><option value="">Select</option><option value="Mr">Mr.</option><option value="Ms">Ms.</option><option value="Mrs">Mrs.</option><option value="Child">Child</option></select></div></div><div class="col-md-3"><div class="form-group"><label for="message-text" class="col-form-label">First Name:</label><input type="text" class="form-control" name="guests_first_name'+id+'[]" maxlength="90" required ></div></div><div class="col-md-3"><div class="form-group"><label for="message-text" class="col-form-label">Last Name:</label><input type="text" class="form-control" name="guests_last_name'+id+'[]" maxlength="90" required></div></div><div class="col-md-3" id="guests_age_div'+rand_id+'" style="display:none"><div class="form-group"><label for="message-text" class="col-form-label">Age:</label><input type="number" class="form-control" name="guests_age'+id+'[]" maxlength="50" value="30" id="guests_age'+rand_id+'"  required></div></div></div>');
    }
    function remove_link(id)
    {         
        $("#new_link_div"+id).children().last().remove();  
        if($("#new_link_div"+id).children().length ==0)
        {
            $("#remove_link_button"+id).css("display","none"); 
        }
    }
</script>
<script>
    var room_name = new Array;
    $('.theme-search-results-item-mask-link').click(function(){

    room_name =[];
    var id = $(this).data('id');
    $('#room_names').html('');
    $('#boarding_details').html('');
    $("#isbooked").val('');
    $('.room_id').prop('checked', false);
    var establishmentid = $(this).data('establishmentid');
    var dataString = {'establishmentid':establishmentid};
    $.blockUI({ message: "<i class='fa fa-2x fa-spinner fa-spin' aria-hidden='true' ></i> &nbsp; <h6>Loading... a moment please.</h6>" });
    window.i =1;
        $.ajax({
           type:'get',
           url:'{{ url('get_establishment') }}',
           data: dataString,
           headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
           success:function(response){
                if(response.error==false)
                {
                    data = response.Images;
                    var count = Object.keys(data).length;
                    var all = '';
                    for (var i = 0; i < count; i++) 
                    { 
                        $.ajax({url:data[i].Url,type:'HEAD',success:
                            all += '<li><a href="'+data[i].Url+'"><img src="'+data[i].Url+'" alt="Image Alternative text" title="Image Title"/></a></li>'
                        });
                    }
                    $("#hotel_img_"+id).html(all);
                    $("#hotel_address_"+id).html(response.Address);
                    $("#hotel_phone_"+id).html(response.PhoneNumber);
                    $("#hotel_fax_"+id).html(response.FaxNumber);
                    $("#hotel_email_"+id).html(response.Email);
                    $("#hotel_address_"+id).html(response.Address);
                    $("#hotel_desc_"+id).html(response.Summary);
                    $("#hotel_map_"+id).attr('data-lat',response.Latitude);
                    $("#hotel_map_"+id).attr('data-lng',response.Longitude);
                    var map;
                    var marker;
                    var geocoder = new google.maps.Geocoder();
                    var infowindow = new google.maps.InfoWindow();
                    var myLatlng = new google.maps.LatLng(response.Latitude,response.Longitude);
                    var mapOptions = {zoom: 18,center: myLatlng,mapTypeId: google.maps.MapTypeId.ROADMAP};
                    map = new google.maps.Map(document.getElementById("hotel_map_"+id), mapOptions);
                    marker = new google.maps.Marker({ map: map, position: myLatlng, draggable: true}); 
                    $.unblockUI();
                }
                else
                {
                    alert("error");
                }
           },
        error: function (request, error) {
          $.blockUI({ message: "<i class='fa fa-2x fa-spinner fa-spin' aria-hidden='true' ></i> &nbsp; <h6>Something went wrong, please try again.</h6>" });
          setTimeout(function(){  $.unblockUI(); }, 3000);
        }
        });
});
    
</script>
<?php if(Session::has('currency')) { if(Session::get('currency')=="AED") $cur = "AED"; else $cur = '$';} else $cur = "AED"; ?>
<?php if(isset($_GET['pricefrom']) && isset($_GET['priceto']))
{
?>
<script>
function priceSlider() {
    $("#price-slider").ionRangeSlider({
        type: "double",
        from: "{{$_GET['pricefrom']}}",
        to: "{{$_GET['priceto']}}",
        prefix: "{{$cur}}"
    });

    $("#price-slider-mob").ionRangeSlider({
        type: "double",
        from: "{{$_GET['pricefrom']}}",
        to: "{{$_GET['priceto']}}",
        prefix: "{{$cur}}"
    });
}
</script>
<?php }
else
{?>

<script>
    function priceSlider() {
    $("#price-slider").ionRangeSlider({
        type: "double",
        prefix: "{{$cur}}"
    });

    $("#price-slider-mob").ionRangeSlider({
        type: "double",
        prefix: "{{$cur}}"
    });
}
</script>
<?php } ?>
<script type="text/javascript">
$(document).ready(function() { 
priceSlider();
var slider = $("#price-slider").data("ionRangeSlider");
});
// Get values
$( "#price-slider").change(function() 
{
    var slider = $("#price-slider").data("ionRangeSlider");
    var from = slider.result.from;
    var to = slider.result.to;
    var url  = window.location.href; 
    
    var new_url = updateQueryStringParameter(url, 'pricefrom', from);
    var latest_url = updateQueryStringParameter(new_url, 'priceto', to);
    window.location.href = latest_url;
    
});
</script>
<script>
function search_hotel_name()
{
    var hotel = $('#hotel_name').val();
    var url  = window.location.href;
    var new_url = updateQueryStringParameter(url, 'hotel_name', hotel);
    window.location.href = new_url;
}
</script>
<script>
var check_val = [];
function hotel_class(id)
{
    var chk = $("#class"+id).prop('checked');
    if(chk)
    {
        check_val.push(id);
        var url  = window.location.href;
        var new_url = updateQueryStringParameter(url, 'hotel_class', check_val);
        window.location.href = new_url;
    }
    else
    {
        var url  = window.location.href;
        var new_url = updateQueryStringParameter(url, 'hotel_class', '');
        window.location.href = new_url;
    }
}
</script>
<script>
function updateQueryStringParameter(uri, key, value) {
      var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
      var separator = uri.indexOf('?') !== -1 ? "&" : "?";
      if (uri.match(re)) {
        return uri.replace(re, '$1' + key + "=" + value + '$2');
      }
      else {
        return uri + separator + key + "=" + value;
      }
    }
</script>
<script>
var i = 1;
var total_rooms = "{{$room}}";
function get_room_booking (establishmet_id, establishmet_name, board_code, room_code, amount, commission_amount, room_num)
{
    if(establishmet_id!="" &&  board_code!="" &&  room_code!="" &&  amount!="" )
    {
        if($("#"+establishmet_id+"_"+room_num).is(':checked'))
        {
            var num_rooms = $("#num_rooms").val();
            room_name.push($("#"+establishmet_id+"_"+room_num).data('room_name'));
            
            if(this.i <= total_rooms)
            {
                $("#establishment_id").val(establishmet_id);
                $("#establishment_name").val(establishmet_name);
                $("#isbooked").val(1);
                $("#boarding_details").append('<input type="hidden" name="board_code[]" value="'+board_code+'" id="board_code_'+establishmet_id+'_'+room_num+'"><input type="hidden" name="room_code[]" value="'+room_code+'" id="room_code_'+establishmet_id+'_'+room_num+'"><input type="hidden" name="amount[]" value="'+amount+'" id="amount_'+establishmet_id+'_'+room_num+'"><input type="hidden" name="commission_amount[]" value="'+commission_amount+'" id="commission_amount_'+establishmet_id+'_'+room_num+'">');
                ///data = JSON.parse(room_name);
                var count = Object.keys(room_name).length;
                var all = '';
                for (var i = 0; i < count; i++) 
                { 
                    /*all += room_name[i]+' x '+parseInt(num_rooms)/count+"<br>"; */
                    all += room_name[i]; 
                    all += "<br>"; 
                }
                $("#room_names").html(all);
                window.i++;
            }
            else
            {
                $("#"+establishmet_id+"_"+room_num).prop('checked', false);
                alert("You have searched for "+num_rooms+" room(s). To book more rooms increase the number in search field. ");
            }
        }
        else
        {
            room_name.splice(room_name.indexOf($("#"+establishmet_id+"_"+room_num).data("room_name")),1);
            $("#isbooked").val('');
            $("#board_code_"+establishmet_id+"_"+room_num).remove();
            $("#room_code_"+establishmet_id+"_"+room_num).remove();
            $("#amount_"+establishmet_id+"_"+room_num).remove();
            $("#commission_amount_"+establishmet_id+"_"+room_num).remove();
        }
    }
}
</script>
<script>
function check_hotel_room()
{
    var isbooked = $("#isbooked").val();
    if(isbooked=="")
    {
        alert("Please select at least one room before booking.");
        $("#exampleModal").modal('hide'); 
    }
    else
    {
        $("#exampleModal").modal('show'); 
    }
}
</script>
<script>
function show_age(id)
{
    var g_id = $('#guests_salutation'+id).val();
    if(g_id!="Child")
    {
        $("#guests_age_div"+id).css("display", "none");
        $("#guests_age"+id).removeAttr("required");
        $("#guests_age"+id).val("30"); 
    }
    else
    {
        $("#guests_age_div"+id).css("display", "block");
        $("#guests_age"+id).attr("required","required"); 
        $("#guests_age"+id).val(''); 
    }
}
</script>
<script> 
function search_location(){
    var search = $("#txt_search1").val();
    
    if(search != "" && search.length >= 3)
    {
        $("#wrap-text1").css("overflow-x", "initial");
        $.ajax({
            type:'GET',
            url:'{{ url('get_location') }}',
            data: {search:search},
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(data){  
                var count = data.length;
                $("#searchResult").empty();
                var all = '';
                for (var i = 0; i < count; i++) { 
                    var location_id = data[i].location_id;
                    var province_id = data[i].province_id;
                    var name = data[i].name;
                    var province = data[i].province;
                    var country = data[i].country;  
                    all += '<li data-value="'+location_id+','+province_id+'">'+name+','+province+','+country+'</li>';
                }
                $("#searchResult").append(all);
                $("#searchResult li").bind("click",function()
                {
                    setText(this);
                });
                if(count>0)
                {
                    $("#searchResult").css('height', '150px');
                }
            }
        });
    }
}
// Set Text to search box and get details
function setText(element){

    var value = $(element).text();
    var locid = $(element).data('value');
    $("#wrap-text1").css("overflow-x", "hidden");

    $("#txt_search1").val(value);
    $("#search_by_name").val(locid);
    $("#searchResult").empty();
    $("#searchResult").css('height', '0px');
}
</script>
@endpush