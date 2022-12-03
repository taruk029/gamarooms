
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
            <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
              <img src="<?php echo e(asset('frontend/img/logo.png')); ?>" alt="Image Alternative text" title="Gama Rooms"/> 
            </a>
          </div>
          <div class="collapse navbar-collapse" id="navbar-main">
            <ul class="nav navbar-nav">
              <li>
                <a class="" href="<?php echo e(url('/')); ?>" title="Home" >Home</a>
              </li>
              <li>
                <a class="" href="<?php echo e(url('aboutus')); ?>" title="About Us" >About Us</a>
              </li>
              
              <li>
                <a class="" href="<?php echo e(url('terms_conditions')); ?>" title="Terms & Conditions" >Terms & Conditions</a>
              </li><!-- <li>
                <a class="dropdown-toggle" href="index-2.html" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">About</a>
              </li> -->
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a class="" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                  <span class="_desk-h">Currency</span>
                  <b><?php if(Session::has('currency')): ?> <?php echo e(Session::get('currency')); ?> <?php else: ?> <?php echo e('AED'); ?>  <?php endif; ?></b>
                </a>
                <div class="dropdown-menu dropdown-menu-xxl" style="width: 200px;">
                  <h5 class="dropdown-meganav-select-list-title">Select Currency</h5>
                  
                      <ul class="dropdown-meganav-select-list-currency">
                         <li <?php if(Session::has('currency')): ?> <?php if(Session::get('currency')=="AED"): ?> <?php echo e('class=active'); ?> <?php endif; ?> <?php else: ?> <?php echo e('class=active'); ?>  <?php endif; ?> >
                          <a href="<?php echo e(url('change_currency/1')); ?>">
                            <span>AED</span>U.A.E. dirham
                          </a>
                        </li>
                        <li <?php if(Session::has('currency')): ?> <?php if(Session::get('currency')=="USD"): ?> <?php echo e('class=active'); ?> <?php endif; ?> <?php endif; ?> >
                          <a href="<?php echo e(url('change_currency/2')); ?>">
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
                    <b>Wallet: <?php echo e(App\Helpers\Helper::get_wallet_amount(Auth::user()['id'])?App\Helpers\Helper::get_wallet_amount(Auth::user()['id']):"0.00"); ?></b>
                </a>
                </li>
              <li class="navbar-nav-item-user dropdown">
                <a class="" href="javascript:void(0)" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-user-circle-o navbar-nav-item-user-icon"></i>My Account
                </a>
                <ul class="dropdown-menu">
                    <li>
                    <a href="<?php echo e(url('booking_history')); ?>">Booking History</a>
                    </li>
                    <li>
                    <a href="<?php echo e(url('my_profile')); ?>">Profile</a>
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
                    <a href="<?php echo e(url('logout')); ?>">Logout</a>
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
                    <a href="<?php echo e(url('login')); ?>"><i class="fa fa-sign-in"></i> Login</a>
                  </li>
                  <li>
                    <a href="<?php echo e(url('signup')); ?>"><i class="fa fa-user-plus"></i> Register</a>
                  </li>
                </ul>
              </li>
            <?php } ?>
            </ul>
          </div>
        </div>
      </div>
    </nav><?php /**PATH E:\xampp\htdocs\gamarooms\resources\views/frontend/layout/header.blade.php ENDPATH**/ ?>