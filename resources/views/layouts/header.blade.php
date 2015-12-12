        <!-- start header -->
        <header class="header_area">

            <!-- start main header -->
            <div class="main_header_area">
                <div class="container">
                    <!-- start mainmenu & logo -->
                    <div class="mainmenu">
                        <div id="nav">
                            <nav class="navbar navbar-default">
                                <!-- Brand and toggle get grouped for better mobile display -->
                                <div class="navbar-header">
                                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                  </button>
                                  <div class="site_logo fix">
                                      <a id="brand" class="clearfix navbar-brand border-right-whitesmoke" href="{{$home_url}}"><img src="{{asset($site_logo)}}" title="{{$site_title}}" alt="{{$site_title}}"></a>
                                      <div class="header_login floatleft">
                                          <ul>
                                              @if(Auth::check())
                                              <li><a href="{{$login_url}}">Profile</a></li>
                                              <li><a href="{{$logout_url}}">Logout</a></li>
                                              @else
                                              <li><a href="{{$login_url}}">Login</a></li>
                                              <li><a href="{{$register_url}}">Register</a></li>
                                              @endif
                                          </ul>
                                      </div>
                                  </div>
                                </div>

                                <!-- Collect the nav links, forms, and other content for toggling -->
                                <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
                                  <ul class="nav navbar-nav">
                                    <!--<li role="presentation" class="dropdown">
                                        <a id="drop-one" href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">
                                          Home
                                        </a>
                                        <ul id="menu1" class="dropdown-menu" role="menu">
                                          <li role="presentation"><a role="menuitem" tabindex="-1" href="index-two.html">Home Page two</a></li>
                                        </ul>
                                    </li>-->
                                    <li @if(session('active_menu') == 'home') class="active_menu" @endif ><a href="{{$home_url}}">Home</a></li>        
                                    <li @if(session('active_menu') == 'catalog') class="active_menu" @endif ><a href="{{$catalog_url}}">Catalog</a></li>
                                    <li @if(session('active_menu') == 'gallery') class="active_menu" @endif><a href="{{$gallery_url}}">Gallery</a></li>
                                    <li role="presentation" class="dropdown">
                                        <a id="drop2" href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">
                                          Features
                                        </a>
                                        <ul id="menu2" class="dropdown-menu" role="menu">
                                          <li role="presentation"><a role="menuitem" tabindex="-1" href="{{$about_url}}">About US</a></li>
                                          <li role="presentation"><a role="menuitem" tabindex="-1" href="booking.html">Booking</a></li>
                                          <li role="presentation"><a role="menuitem" tabindex="-1" href="room-details.html">Room Details</a></li>
                                          <li role="presentation"><a role="menuitem" tabindex="-1" href="staff.html">Our Staff</a></li>
                                          <li role="presentation"><a role="menuitem" tabindex="-1" href="{{$page_404_url}}">404 Page</a></li>
                                        </ul>
                                    </li>
                                    <li @if(session('active_menu') == 'news') class="active_menu" @endif ><a href="{{$news_url}}">News</a></li>
                                    <li @if(session('active_menu') == 'contact') class="active_menu" @endif ><a href="{{$contact_url}}">Contacts</a></li>
                                  </ul>
                                  <div class="emergency_number">
                                      <a href="tel:1234567890"><img src="{{asset('public/images/call-icon.png')}}" alt="">123 456 7890</a>
                                  </div>
                                </div><!-- /.navbar-collapse -->
                            </nav>
                        </div>
                    </div>
                    <!-- end mainmenu and logo -->
                </div>
            </div>
            <!-- end main header -->

        </header>
        <!-- end header -->