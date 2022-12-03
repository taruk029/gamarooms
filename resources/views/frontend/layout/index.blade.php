@extends('frontend.layout.app')
@section('title', 'Home')
@section('content')
<div class="theme-hero-area _h-desk-100vh">
        <div class="theme-hero-area-bg-wrap">
          <div class="theme-hero-area-bg-video theme-hero-area-bg-video-blur" id="youtube-video" data-video-id="umVm3QXFE18"></div>
          <div class="theme-hero-area-bg" style="background-image:url(img/jocbjnw5_rc_1500x800.jpg);"></div>
          <div class="theme-hero-area-bg-pattern theme-hero-area-bg-pattern-strong" style="background-image:url( {{ asset('public/img/patterns/ep_naturalblack.png') }} );"></div>
          <div class="theme-hero-area-mask"></div>
          <div class="theme-hero-area-inner-shadow"></div>
        </div>
        <div class="theme-hero-area-body _pos-desk-v-c _w-f _pv-mob-50">
          <div class="container"> 
            <div class="theme-search-area-tabs _pb-100">
              <div class="theme-search-area-tabs-header _c-w _mb-50">
                <h1 class="theme-search-area-tabs-title theme-search-area-tabs-title-lg">Explore with Gama Rooms</h1>
              </div>
              <div class="tabbable">
                <ul class="nav _fw-b _mb-5 nav-tabs nav-white nav-blank nav-xl nav-active-primary nav-mob-inline" role="tablist">
                  <li class="active" role="presentation">
                    <a aria-controls="SearchAreaTabs-1" role="tab" data-toggle="tab" href="#SearchAreaTabs-1">Hotels</a>
                  </li>
                </ul>
                <div class="tab-content _pt-15">
                  <div class="tab-pane active" id="SearchAreaTabs-1" role="tab-panel">
                    <div class="theme-search-area theme-search-area-white">
                      <div class="theme-search-area-form">
                        <div class="row" data-gutter="30">
                          <div class="col-md-3 ">
                            <div class="theme-search-area-section first theme-search-area-section-line">
                              <div class="theme-search-area-section-inner">
                                <i class="theme-search-area-section-icon lin lin-location-pin"></i>
                                <select class="theme-search-area-section-input typeahead selectpicker form-control bg-white" data-live-search="true" name="search_by_name" id="search_by_name">
                                  <option value="">Search Location</option>
                                    <?php
                                    if($data)
                                    {
                                      foreach ($data as $row) 
                                      { ?>
                                          <option value="{{$row->CCODE_ECI}}">{{$row->FullName}} <label class="address">({{$row->address}})</label> </option>
                                      <?php }
                                    }
                                     ?>
                                  </select>
                                <!-- <input class="theme-search-area-section-input typeahead" type="text" placeholder="Hotel Location" data-provide="typeahead"/> -->
                              </div>
                            </div>
                          </div>
                          <div class="col-md-4 ">
                            <div class="row" data-gutter="30">
                              <div class="col-md-6 ">
                                <div class="theme-search-area-section theme-search-area-section-line">
                                  <div class="theme-search-area-section-inner">
                                    <i class="theme-search-area-section-icon lin lin-calendar"></i>
                                    <input class="theme-search-area-section-input datePickerStart _mob-h" value="Wed 06/27" type="text" placeholder="Check-in"/>
                                    <input class="theme-search-area-section-input _desk-h mobile-picker" value="2018-06-27" type="date"/>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6 ">
                                <div class="theme-search-area-section theme-search-area-section-line">
                                  <div class="theme-search-area-section-inner">
                                    <i class="theme-search-area-section-icon lin lin-calendar"></i>
                                    <input class="theme-search-area-section-input datePickerEnd _mob-h" value="Mon 07/02" type="text" placeholder="Check-out"/>
                                    <input class="theme-search-area-section-input _desk-h mobile-picker" value="2018-07-02" type="date"/>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-4 ">
                            <div class="row" data-gutter="30">
                              <div class="col-md-6 ">
                                <div class="theme-search-area-section theme-search-area-section-line quantity-selector" data-increment="Rooms">
                                  <div class="theme-search-area-section-inner">
                                    <i class="theme-search-area-section-icon lin lin-tag"></i>
                                    <input class="theme-search-area-section-input" value="1 Room" type="text"/>
                                    <div class="quantity-selector-box" id="HotelSearchRooms">
                                      <div class="quantity-selector-inner">
                                        <p class="quantity-selector-title">Rooms</p>
                                        <ul class="quantity-selector-controls">
                                          <li class="quantity-selector-decrement">
                                            <a href="#">&#45;</a>
                                          </li>
                                          <li class="quantity-selector-current">1</li>
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
                                <div class="theme-search-area-section theme-search-area-section-line quantity-selector" data-increment="Guests">
                                  <div class="theme-search-area-section-inner">
                                    <i class="theme-search-area-section-icon lin lin-people"></i>
                                    <input class="theme-search-area-section-input" value="2 Guests" type="text"/>
                                    <div class="quantity-selector-box" id="HotelSearchGuests">
                                      <div class="quantity-selector-inner">
                                        <p class="quantity-selector-title">Guests</p>
                                        <ul class="quantity-selector-controls">
                                          <li class="quantity-selector-decrement">
                                            <a href="#">&#45;</a>
                                          </li>
                                          <li class="quantity-selector-current">1</li>
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
                          </div>
                          <div class="col-md-1 ">
                            <button class="theme-search-area-submit _mt-0 _fs-xl theme-search-area-submit-curved theme-search-area-submit-primary theme-search-area-submit-glow">&rarr;</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane" id="SearchAreaTabs-2" role="tab-panel">
                    <div class="theme-search-area theme-search-area-white">
                      <div class="theme-search-area-form">
                        <div class="row" data-gutter="30">
                          <div class="col-md-4 ">
                            <div class="theme-search-area-section first theme-search-area-section-line">
                              <div class="theme-search-area-section-inner">
                                <i class="theme-search-area-section-icon lin lin-location-pin"></i>
                                <input class="theme-search-area-section-input typeahead" type="text" placeholder="Apartment Location" data-provide="typeahead"/>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-7 ">
                            <div class="row" data-gutter="30">
                              <div class="col-md-4 ">
                                <div class="theme-search-area-section theme-search-area-section-line">
                                  <div class="theme-search-area-section-inner">
                                    <i class="theme-search-area-section-icon lin lin-calendar"></i>
                                    <input class="theme-search-area-section-input datePickerStart _mob-h" value="Wed 06/27" type="text" placeholder="Check-in"/>
                                    <input class="theme-search-area-section-input _desk-h mobile-picker" value="2018-06-27" type="date"/>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-4 ">
                                <div class="theme-search-area-section theme-search-area-section-line">
                                  <div class="theme-search-area-section-inner">
                                    <i class="theme-search-area-section-icon lin lin-calendar"></i>
                                    <input class="theme-search-area-section-input datePickerEnd _mob-h" value="Mon 07/02" type="text" placeholder="Check-out"/>
                                    <input class="theme-search-area-section-input _desk-h mobile-picker" value="2018-07-02" type="date"/>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-4 ">
                                <div class="theme-search-area-section theme-search-area-section-line quantity-selector" data-increment="Guests">
                                  <div class="theme-search-area-section-inner">
                                    <i class="theme-search-area-section-icon lin lin-people"></i>
                                    <input class="theme-search-area-section-input" value="2 Guests" type="text"/>
                                    <div class="quantity-selector-box" id="RoomSearchGuests">
                                      <div class="quantity-selector-inner">
                                        <p class="quantity-selector-title">Guests</p>
                                        <ul class="quantity-selector-controls">
                                          <li class="quantity-selector-decrement">
                                            <a href="#">&#45;</a>
                                          </li>
                                          <li class="quantity-selector-current">1</li>
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
                          </div>
                          <div class="col-md-1 ">
                            <button class="theme-search-area-submit _mt-0 _fs-xl theme-search-area-submit-curved theme-search-area-submit-primary theme-search-area-submit-glow">&rarr;</button>
                          </div>
                        </div>
                      </div>
                      <div class="theme-search-area-options _mob-h clearfix">
                        <h5 class="theme-search-area-options-title">Apartment type</h5>
                        <div class="btn-group theme-search-area-options-list" data-toggle="buttons">
                          <label class="btn btn-primary active">
                            <input type="radio" name="room-options" id="room-option-1" checked/>Any
                          </label>
                          <label class="btn btn-primary">
                            <input type="radio" name="room-options" id="room-option-2"/>Entire Home
                          </label>
                          <label class="btn btn-primary">
                            <input type="radio" name="room-options" id="room-option-3"/>Private Room
                          </label>
                          <label class="btn btn-primary">
                            <input type="radio" name="room-options" id="room-option-4"/>Shared Space
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane" id="SearchAreaTabs-3" role="tab-panel">
                    <div class="theme-search-area theme-search-area-white">
                      <div class="theme-search-area-form">
                        <div class="row" data-gutter="30">
                          <div class="col-md-5 ">
                            <div class="row" data-gutter="30">
                              <div class="col-md-6 ">
                                <div class="theme-search-area-section first theme-search-area-section-line">
                                  <div class="theme-search-area-section-inner">
                                    <i class="theme-search-area-section-icon lin lin-location-pin"></i>
                                    <input class="theme-search-area-section-input typeahead" type="text" placeholder="Departure" data-provide="typeahead"/>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6 ">
                                <div class="theme-search-area-section theme-search-area-section-line">
                                  <div class="theme-search-area-section-inner">
                                    <i class="theme-search-area-section-icon lin lin-location-pin"></i>
                                    <input class="theme-search-area-section-input typeahead" type="text" placeholder="Arrival" data-provide="typeahead"/>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6 ">
                            <div class="row" data-gutter="30">
                              <div class="col-md-4 ">
                                <div class="theme-search-area-section theme-search-area-section-line">
                                  <div class="theme-search-area-section-inner">
                                    <i class="theme-search-area-section-icon lin lin-calendar"></i>
                                    <input class="theme-search-area-section-input datePickerStart _mob-h" value="Wed 06/27" type="text" placeholder="Check-in"/>
                                    <input class="theme-search-area-section-input _desk-h mobile-picker" value="2018-06-27" type="date"/>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-4 ">
                                <div class="theme-search-area-section theme-search-area-section-line">
                                  <div class="theme-search-area-section-inner">
                                    <i class="theme-search-area-section-icon lin lin-calendar"></i>
                                    <input class="theme-search-area-section-input datePickerEnd _mob-h" value="Mon 07/02" type="text" placeholder="Check-out"/>
                                    <input class="theme-search-area-section-input _desk-h mobile-picker" value="2018-07-02" type="date"/>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-4 ">
                                <div class="theme-search-area-section theme-search-area-section-line quantity-selector" data-increment="Passengers">
                                  <div class="theme-search-area-section-inner">
                                    <i class="theme-search-area-section-icon lin lin-people"></i>
                                    <input class="theme-search-area-section-input" value="1 Passenger" type="text"/>
                                    <div class="quantity-selector-box" id="FlySearchPassengers">
                                      <div class="quantity-selector-inner">
                                        <p class="quantity-selector-title">Passengers</p>
                                        <ul class="quantity-selector-controls">
                                          <li class="quantity-selector-decrement">
                                            <a href="#">&#45;</a>
                                          </li>
                                          <li class="quantity-selector-current">1</li>
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
                          </div>
                          <div class="col-md-1 ">
                            <button class="theme-search-area-submit _mt-0 _fs-xl theme-search-area-submit-curved theme-search-area-submit-primary theme-search-area-submit-glow">&rarr;</button>
                          </div>
                        </div>
                      </div>
                      <div class="theme-search-area-options clearfix">
                        <div class="btn-group theme-search-area-options-list" data-toggle="buttons">
                          <label class="btn btn-primary active">
                            <input type="radio" name="flight-options" id="flight-option-1" checked/>Round Trip
                          </label>
                          <label class="btn btn-primary">
                            <input type="radio" name="flight-options" id="flight-option-2"/>One Way
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane" id="SearchAreaTabs-4" role="tab-panel">
                    <div class="theme-search-area theme-search-area-white">
                      <div class="theme-search-area-form">
                        <div class="row" data-gutter="30">
                          <div class="col-md-7 ">
                            <div class="row" data-gutter="30">
                              <div class="col-md-6 ">
                                <div class="theme-search-area-section first theme-search-area-section-line">
                                  <div class="theme-search-area-section-inner">
                                    <i class="theme-search-area-section-icon lin lin-location-pin"></i>
                                    <input class="theme-search-area-section-input typeahead" type="text" placeholder="Pick up location" data-provide="typeahead"/>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6 ">
                                <div class="theme-search-area-section theme-search-area-section-line">
                                  <div class="theme-search-area-section-inner">
                                    <i class="theme-search-area-section-icon lin lin-location-pin"></i>
                                    <input class="theme-search-area-section-input typeahead" type="text" placeholder="Drop off location" data-provide="typeahead"/>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-2 ">
                            <div class="theme-search-area-section theme-search-area-section-line">
                              <div class="theme-search-area-section-inner">
                                <i class="theme-search-area-section-icon lin lin-calendar"></i>
                                <input class="theme-search-area-section-input datePickerStart _mob-h" value="Wed 06/27" type="text" placeholder="Check-in"/>
                                <input class="theme-search-area-section-input _desk-h mobile-picker" value="2018-06-27" type="date"/>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-2 ">
                            <div class="theme-search-area-section theme-search-area-section-line">
                              <div class="theme-search-area-section-inner">
                                <i class="theme-search-area-section-icon lin lin-calendar"></i>
                                <input class="theme-search-area-section-input datePickerEnd _mob-h" value="Mon 07/02" type="text" placeholder="Check-out"/>
                                <input class="theme-search-area-section-input _desk-h mobile-picker" value="2018-07-02" type="date"/>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-1 ">
                            <button class="theme-search-area-submit _mt-0 _fs-xl theme-search-area-submit-curved theme-search-area-submit-primary theme-search-area-submit-glow">&rarr;</button>
                          </div>
                        </div>
                      </div>
                      <div class="theme-search-area-options _mob-h clearfix">
                        <h5 class="theme-search-area-options-title">Car type</h5>
                        <div class="btn-group theme-search-area-options-list" data-toggle="buttons">
                          <label class="btn btn-primary active">
                            <input type="radio" name="car-options" id="car-option-1" checked/>Any
                          </label>
                          <label class="btn btn-primary">
                            <input type="radio" name="car-options" id="car-option-2"/>Sedan
                          </label>
                          <label class="btn btn-primary">
                            <input type="radio" name="car-options" id="car-option-3"/>Hatchback
                          </label>
                          <label class="btn btn-primary">
                            <input type="radio" name="car-options" id="car-option-4"/>SUV
                          </label>
                          <label class="btn btn-primary">
                            <input type="radio" name="car-options" id="car-option-5"/>Crossover
                          </label>
                          <label class="btn btn-primary">
                            <input type="radio" name="car-options" id="car-option-6"/>Coupe
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane" id="SearchAreaTabs-5" role="tab-panel">
                    <div class="theme-search-area theme-search-area-white">
                      <div class="theme-search-area-form">
                        <div class="row" data-gutter="30">
                          <div class="col-md-4 ">
                            <div class="theme-search-area-section first theme-search-area-section-line">
                              <div class="theme-search-area-section-inner">
                                <i class="theme-search-area-section-icon lin lin-location-pin"></i>
                                <input class="theme-search-area-section-input typeahead" type="text" placeholder="Destination" data-provide="typeahead"/>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-7 ">
                            <div class="row" data-gutter="30">
                              <div class="col-md-4 ">
                                <div class="theme-search-area-section theme-search-area-section-line">
                                  <div class="theme-search-area-section-inner">
                                    <i class="theme-search-area-section-icon lin lin-calendar"></i>
                                    <input class="theme-search-area-section-input datePickerStart _mob-h" value="Wed 06/27" type="text" placeholder="Check-in"/>
                                    <input class="theme-search-area-section-input _desk-h mobile-picker" value="2018-06-27" type="date"/>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-4 ">
                                <div class="theme-search-area-section theme-search-area-section-line">
                                  <div class="theme-search-area-section-inner">
                                    <i class="theme-search-area-section-icon lin lin-calendar"></i>
                                    <input class="theme-search-area-section-input datePickerEnd _mob-h" value="Mon 07/02" type="text" placeholder="Check-out"/>
                                    <input class="theme-search-area-section-input _desk-h mobile-picker" value="2018-07-02" type="date"/>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-4 ">
                                <div class="theme-search-area-section theme-search-area-section-line quantity-selector" data-increment="Guests">
                                  <div class="theme-search-area-section-inner">
                                    <i class="theme-search-area-section-icon lin lin-people"></i>
                                    <input class="theme-search-area-section-input" value="2 Guests" type="text"/>
                                    <div class="quantity-selector-box" id="ExpSearchGuests">
                                      <div class="quantity-selector-inner">
                                        <p class="quantity-selector-title">Guests</p>
                                        <ul class="quantity-selector-controls">
                                          <li class="quantity-selector-decrement">
                                            <a href="#">&#45;</a>
                                          </li>
                                          <li class="quantity-selector-current">1</li>
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
                          </div>
                          <div class="col-md-1 ">
                            <button class="theme-search-area-submit _mt-0 _fs-xl theme-search-area-submit-curved theme-search-area-submit-primary theme-search-area-submit-glow">&rarr;</button>
                          </div>
                        </div>
                      </div>
                      <div class="theme-search-area-options _mob-h clearfix">
                        <h5 class="theme-search-area-options-title">Type</h5>
                        <div class="btn-group theme-search-area-options-list" data-toggle="buttons">
                          <label class="btn btn-primary active">
                            <input type="radio" name="exp-options" id="exp-option-1" checked/>Any
                          </label>
                          <label class="btn btn-primary">
                            <input type="radio" name="exp-options" id="exp-option-2"/>Experiences
                          </label>
                          <label class="btn btn-primary">
                            <input type="radio" name="exp-options" id="exp-option-3"/>Immersions
                          </label>
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