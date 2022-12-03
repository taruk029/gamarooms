
<?php $__env->startSection('title', 'Home'); ?>
<?php $__env->startPush('styles'); ?>
<link href="<?php echo e(asset('assets/css/bootstrap-select.min.css')); ?>" rel="stylesheet">
<style type="text/css">
.sal{
    line-height: 50px;
}
.dropdown-toggle
{
    background: transparent;
    color: white;
    border: 0px !important;
    margin-top: 4px !important;
}
.filter-option-inner-inner
{
    font-size: 16px !important;    
    font-weight: 100;
    line-height: 38px !important;
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

input[type=text]{
 padding: 5px;
 width: 250px;
 letter-spacing: 1px;
}
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
</style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="theme-hero-area theme-hero-area-primary">
        <div class="theme-hero-area-bg-wrap">
        <div class="theme-hero-area-bg"style="background-image:url(assets/img/rxgcjsathdq_1500x800.jpg);"></div>
        <div class="theme-hero-area-mask theme-hero-area-mask-half"></div>
        <div class="theme-hero-area-inner-shadow theme-hero-area-inner-shadow-light"></div>
      </div>
        <div class="theme-hero-area-body">
          <div class="container">
            <div class="theme-search-area _pv-100 _pv-mob-60 theme-search-area-stacked theme-search-area-white">
                
              <div class="theme-search-area-header">
                <h1 class="theme-search-area-title theme-search-area-title-lg">
                <center><img src="<?php echo e(asset('img/glogo.png')); ?>" class="img-thumb"></h1></center>
              </div>
              <div class="tabbable">
                <ul class="nav _fw-b _mb-5 nav-tabs nav-white nav-blank nav-xl nav-active-primary nav-mob-inline" role="tablist">
                  <li class="active" role="presentation">
                    <a aria-controls="SearchAreaTabs-1" role="tab" data-toggle="tab" href="#SearchAreaTabs-1"></a>
                  </li>
                </ul>
                <form method="get" action="<?php echo e(url('search_hotel')); ?>" id="gama_form" autocomplete="off" >
                <div class="tab-content _pt-15">
                  <div class="tab-pane active" id="SearchAreaTabs-1" role="tab-panel">
                    <div class="theme-search-area theme-search-area-white">
                      <div class="theme-search-area-form">
                        <div class="row" data-gutter="30">
                          <div class="col-md-2">
                            <div class="theme-search-area-section first theme-search-area-section-line">
                              <div class="theme-search-area-section-inner" id="wrap-text">
                                 <input class="theme-search-area-section-input" type="text" placeholder="Hotel Location" id="txt_search" name="txt_search" onkeyup="javascript:search_location()" autosearch="off"/> 
                                 <ul id="searchResult"></ul>
                                    <input type="hidden" name="search_by_name" id="search_by_name" value="">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="row" data-gutter="30">
                              <div class="col-md-6 ">
                                <div class="theme-search-area-section theme-search-area-section-line">
                                  <div class="theme-search-area-section-inner">
                                    <i class="theme-search-area-section-icon lin lin-calendar"></i>
                                    <input class="theme-search-area-section-input datePickerStart" value="<?php echo e(date('Y-m-d')); ?>"  autocomplete="off"  type="text" required placeholder="Check-in" name="start_date" />
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6 ">
                                <div class="theme-search-area-section theme-search-area-section-line">
                                  <div class="theme-search-area-section-inner">
                                    <i class="theme-search-area-section-icon lin lin-calendar"></i>
                                    <input class="theme-search-area-section-input datePickerEnd _mob-h" value="<?php echo e(date('Y-m-d')); ?>"  autocomplete="off"  type="text" required placeholder="Check-out"  name="end_date" />
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="row" data-gutter="30">
                                <div class="col-md-3 ">
                                <div class="theme-search-area-section theme-search-area-section-line quantity-selector"  data-increment="Rooms">
                                  <div class="theme-search-area-section-inner">
                                    <i class="theme-search-area-section-icon lin lin-tag"></i>
                                    <input class="theme-search-area-section-input" value="1 Room" type="text"  autocomplete="off"  required name="rooms"/>
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
                              <div class="col-md-3">
                                <div class="theme-search-area-section theme-search-area-section-line quantity-selector" data-increment="Guests">
                                  <div class="theme-search-area-section-inner">
                                    <i class="theme-search-area-section-icon lin lin-people"></i>
                                    <input class="theme-search-area-section-input" placeholder="Guests" type="text"  autocomplete="off"  required name="guest"/>
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
                                <div class="col-md-2">
                                <div class="theme-search-area-section theme-search-area-section-line quantity-selector" data-increment="Kids">
                                  <div class="theme-search-area-section-inner">
                                    <i class="theme-search-area-section-icon lin lin-people"></i>
                                    <input class="theme-search-area-section-input" placeholder="Kids" type="text" name="kids"  autocomplete="off"  id="kids"/>
                                    <div class="quantity-selector-box" id="HotelSearchGuests">
                                      <div class="quantity-selector-inner">
                                        <p class="quantity-selector-title">Kids</p>
                                        <ul class="quantity-selector-controls">
                                          <li class="quantity-selector-decrement" onclick="javascript:kidsAge();">
                                            <a href="#">&#45;</a>
                                          </li>
                                          <li class="quantity-selector-current">1</li>
                                          <li class="quantity-selector-increment"  onclick="javascript:kidsAge();">
                                            <a href="#">&#43;</a>
                                          </li>
                                        </ul>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="theme-search-area-section first theme-search-area-section-line">
                                  <div class="theme-search-area-section-inner">
                                    <!-- <input class="theme-search-area-section-input typeahead" type="text" placeholder="Hotel Location" data-provide="typeahead"/> -->
                                    <select class="theme-search-area-section-input typeahead selectpicker form-control bg-white"  autocomplete="off"  data-dropup-auto="false" data-live-search="true" name="source_market" id="source_market" required>
                                          <option value=""> Guest  Nationality</option>
                                        <?php
                                        if($country)
                                        {
                                          foreach ($country as $val) 
                                          { ?>
                                              <option value="<?php echo e($val->countrycode); ?>"><?php echo e($val->name); ?></option>
                                          <?php }
                                        }
                                         ?>
                                      </select>
                                  </div>
                            </div>
                          </div>
                            </div>
                          </div><!--
                          <div class="col-md-1 ">
                            <button class="theme-search-area-submit _mt-0 _fs-xl theme-search-area-submit-curved theme-search-area-submit-primary theme-search-area-submit-glow">&rarr;</button>
                          </div>-->
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-content _pt-15">
                  <div class="tab-pane active" id="SearchAreaTabs-1" role="tab-panel">
                    <div class="theme-search-area theme-search-area-white">
                      <div class="theme-search-area-form">
                        <div class="row" data-gutter="30">
                          
                          <div id="kids_age_div" style="display:none;"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div><br><br>
                <center>
                    <button class="theme-search-area-submit _mt-0 _fs-xl theme-search-area-submit-curved theme-search-area-submit-primary theme-search-area-submit-glow">Search Hotels &rarr;</button>
                </center>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script type="text/javascript" src="<?php echo e(asset('assets/js/bootstrap-select.min.js')); ?>"></script>
<script>
    $("#kids").click(function() 
    {
       kidsAge();
});
  function kidsAge()
  {
      var kids =  parseInt($("#kids").val());
       var age_list = [];
       for(var i=1; i<=kids; i++)
       {
           age_list.push('<div class="col-md-2"><div class="theme-search-area-section theme-search-area-section-line"><div class="theme-search-area-section-inner"><input class="theme-search-area-section-input" placeholder="Kid Age '+i+'" type="text" name="kids_age[]" /></div></div></div>');
       }
       $("#kids_age_div").html(age_list);
  }

 /* $(document).ready(function()
  {*/
    function search_location(){
        $("#searchResult").css('height', '0px');
        var search = $("#txt_search").val();

        if(search != "" && search.length >= 3)
        {
            
            $("#wrap-text").css("overflow-x", "initial");
            /*$.blockUI({ message: "<i class='fa fa-2x fa-spinner fa-spin' aria-hidden='true' ></i> &nbsp; <h6>Loading... a moment please.</h6>" });*/
            $.ajax({
                type:'GET',
                url:'<?php echo e(url('get_location')); ?>',
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
    $("#wrap-text").css("overflow-x", "hidden");
    $("#txt_search").val(value);
    $("#search_by_name").val(locid);
    $("#searchResult").empty();
    $("#searchResult").css('height', '0px');
}
    
    // Request User Details
/*    $.ajax({
        url: 'getSearch.php',
        type: 'post',
        data: {userid:userid, type:2},
        dataType: 'json',
        success: function(response){

            var len = response.length;
            $("#userDetail").empty();
            if(len > 0){
                var username = response[0]['username'];
                var email = response[0]['email'];
                $("#userDetail").append("Username : " + username + "<br/>");
                $("#userDetail").append("Email : " + email);
            }
        }

    });*/
/*
});*/
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\gamarooms\resources\views/frontend/index.blade.php ENDPATH**/ ?>