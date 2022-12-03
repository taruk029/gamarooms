
    <nav class="navbar navbar-default navbar-inverse navbar-theme navbar-theme-abs navbar-theme-transparent navbar-theme-border" id="main-nav">
      <div class="container">
        <div class="navbar-inner nav">
          <div class="navbar-header">
            <button class="navbar-toggle collapsed" data-target="#navbar-main" data-toggle="collapse" type="button" area-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}">
              <img src="{{ asset('frontend/img/logo.png') }}" alt="Image Alternative text" title="Gama Rooms"/> 
            </a>
          </div>
          <div class="collapse navbar-collapse" id="navbar-main">
            <ul class="nav navbar-nav">
              <li>
                <a class="" href="{{ url('/') }}" title="Home" >Home</a>
              </li>
              <li>
                <a class="" href="{{ url('aboutus') }}" title="About Us" >About Us</a>
              </li>
              
              <li>
                <a class="" href="{{ url('terms_conditions') }}" title="Terms & Conditions" >Terms & Conditions</a>
              </li><!-- <li>
                <a class="dropdown-toggle" href="index-2.html" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">About</a>
              </li> -->
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a class="" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                  <span class="_desk-h">Currency</span>
                  <b>@if(Session::has('currency')) {{Session::get('currency')}} @else {{'AED'}}  @endif</b>
                </a>
                <div class="dropdown-menu dropdown-menu-xxl" style="width: 200px;">
                  <h5 class="dropdown-meganav-select-list-title">Select Currency</h5>
                  
                      <ul class="dropdown-meganav-select-list-currency">
                         <li @if(Session::has('currency')) @if(Session::get('currency')=="AED") {{'class=active'}} @endif @else {{'class=active'}}  @endif >
                          <a href="{{ url('change_currency/1')}}">
                            <span>AED</span>U.A.E. dirham
                          </a>
                        </li>
                        <li @if(Session::has('currency')) @if(Session::get('currency')=="USD") {{'class=active'}} @endif @endif >
                          <a href="{{ url('change_currency/2')}}">
                            <span>US$</span>U.S. dollar
                          </a>
                        </li>
                      </ul>
                </div>
              </li>
              <?php if(Auth::user()) { ?>
              <li>
                    <a href="javascript:void(0)" role="button">
                  <span class="_desk-h">Wallet</span>
                    <b>Wallet: {{App\Helpers\Helper::get_wallet_amount(Auth::user()['id'])?App\Helpers\Helper::get_wallet_amount(Auth::user()['id']):"0.00"}}</b>
                </a>
                </li>
              <li class="navbar-nav-item-user dropdown">
                <a class="" href="javascript:void(0)" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-user-circle-o navbar-nav-item-user-icon"></i>My Account
                </a>
                <ul class="dropdown-menu">
                    <li>
                    <a href="{{ url('booking_history') }}">Booking History</a>
                    </li>
                    <li>
                    <a href="{{ url('my_profile') }}">Profile</a>
                    </li>
                  <!--<li>
                    <a href="account.html">Preferences</a>
                  </li>
                  <li>
                    <a href="account-notifications.html">Notifications</a>
                  </li>
                  <li>
                    <a href="account-cards.html">Payment Methods</a>
                  </li>
                  <li>
                    <a href="account-travelers.html">Travelers</a>
                  </li>
                  <li>
                    <a href="account-history.html">History</a>
                  </li>
                  <li>
                    <a href="account-bookmarks.html">Bookmarks</a>
                  </li>-->
                  <li>
                    <a href="{{ url('logout') }}">Logout</a>
                  </li>
                </ul>
              </li>
            <?php } 
            else
              { ?>
                <li class="navbar-nav-item-user dropdown">
                <a class="dropdown-toggle" href="account.html" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-user-circle-o navbar-nav-item-user-icon"></i>Account
                </a>
                <ul class="dropdown-menu">
                  <li>
                    <a href="{{ url('login')}}"><i class="fa fa-sign-in"></i> Login</a>
                  </li>
                  <li>
                    <a href="{{ url('signup')}}"><i class="fa fa-user-plus"></i> Register</a>
                  </li>
                </ul>
              </li>
            <?php } ?>
            </ul>
          </div>
        </div>
      </div>
    </nav>