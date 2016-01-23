        <!-- start Hotel Facilities section -->
        <section class="hotel_facilities_area margin-top-115 margin-bottom-100">
            <div class="container">
                <div class="hotel_facilities">
                    <div class="section_title nice_title content-center">
                        <h3>Hotel facilties</h3>
                    </div>
                    <div class="hotel_facilities_content">
                        <div role="tabpanel">

                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                            <?php 
                                $i = 1; $j = 1; $itemwidth = 12;
                            ?>
                            @foreach($hotel_facilities as $k => $hotel_facilitie)
                            @if($hotel_facilitie->status == 1)
                                <li role="presentation" @if($i == 1) class="active" @endif >
                                    <a href="#{{strtolower($hotel_facilitie->name)}}" aria-controls="sports-club" role="tab" data-toggle="tab"><img src="{{asset(URL::to('/').str_replace('..', '',$hotel_facilitie->icon))}}" alt="{{$hotel_facilitie->name}}"><span>{{$hotel_facilitie->name}}</span></a>
                                </li>
                                <?php $i++; ?>
                            @endif    
                            @endforeach
                            <?php 
                            $totalwidth = ($i - 1 ) * $itemwidth;
                            ?>
                                <!--<li role="presentation" class="active">
                                    <a href="#restaurant" aria-controls="restaurant" role="tab" data-toggle="tab"><img src="{{asset('public/images/home-facilities-icon-eleven.png')}}" alt="restaurant"><span>restaurant</span></a>
                                </li>
                                <li role="presentation">
                                    <a href="#sports-club" aria-controls="sports-club" role="tab" data-toggle="tab"><img src="{{asset('public/images/home-facilities-icon-seven.png')}}" alt="sports-club"><span>sports-club</span></a>
                                </li>
                                <li role="presentation">
                                    <a href="#pick-up" aria-controls="pick-up" role="tab" data-toggle="tab"><img src="{{asset('public/images/home-facilities-icon-eight.png')}}" alt="pick-up"><span>pick-up</span></a>
                                </li>
                                <li role="presentation">
                                    <a href="#bar" aria-controls="bar" role="tab" data-toggle="tab"><img src="{{asset('public/images/home-facilities-icon-nine.png')}}" alt="bar"><span>bar</span></a>
                                </li>
                                <li role="presentation">
                                    <a href="#gym" aria-controls="gym" role="tab" data-toggle="tab"><img src="{{asset('public/images/home-facilities-icon-ten.png')}}" alt="gym"><span>gym</span></a>
                                </li>-->
                            </ul>                           

                          
                            <!-- Tab panes -->
                            <div class="tab-content">
                            @foreach($hotel_facilities as $k => $hotel_facilitie)
                            @if($hotel_facilitie->status == 1)
                                @if($j == 1)
                                <div role="tabpanel" class="tab-pane active" id="{{strtolower($hotel_facilitie->name)}}">
                                @else
                                <div role="tabpanel" class="tab-pane" id="{{strtolower($hotel_facilitie->name)}}">
                                @endif
                                
                                    <div class="single-tab-content">
                                        <div class="row">
                                            <div class="co-lg-5 col-md-5 col-sm-6">
                                                <div class="single-tab-image">
                                                    <a href="#"><img src="{{asset(URL::to('/').str_replace('..', '',$hotel_facilitie->image))}}" alt="{{$hotel_facilitie->name}}"></a>
                                                </div>
                                            </div>
                                            <div class="co-lg-7 col-md-7 col-sm-6">
                                                <div class="single-tab-details">
                                                    <h6>{{$hotel_facilitie->small_heading}}</h6>
                                                    <h3>{{$hotel_facilitie->big_heading}}</h3>
                                                    <p>
                                                    <?php
                                                    $text = nl2br($hotel_facilitie->description);
                                                    print_r($text);
                                                    ?>
                                                    </p>                                                    
                                                    <div class="our_services">
                                                        <a href="#" class="margin-right-33">Service Hours: {{$hotel_facilitie->start}} - {{$hotel_facilitie->end}} </a>
                                                        <a href="#">service charge : ${{$hotel_facilitie->charge}}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php $j++; ?>
                            @endif  
                            @endforeach    
                                <!--<div role="tabpanel" class="tab-pane active" id="restaurant">
                                    <div class="single-tab-content">
                                        <div class="row">
                                            <div class="co-lg-5 col-md-5 col-sm-6">
                                                <div class="single-tab-image">
                                                    <a href="#"><img src="{{asset('public/images/hotel-facility-one.jpg')}}" alt=""></a>
                                                </div>
                                            </div>
                                            <div class="co-lg-7 col-md-7 col-sm-6">
                                                <div class="single-tab-details">
                                                    <h6>The world class</h6>
                                                    <h3>Restaurant & Banquets</h3>
                                                    <p>
                                                        Semper ac dolor vitae accumsan. Cras interdum hendrerit lacinia. Phasellus accumsan urna vitae molestie interdum. Nam sed placerat libero, non eleifend dolor.
                                                    </p>
                                                    <p>
                                                        Cras ac justo et augue suscipit euismod vel eget lectus. Proin vehicula nunc arcu, pulvinar accumsan nulla porta vel. Vivamus malesuada vitae sem ac pellentesque.
                                                    </p>
                                                    <div class="our_services">
                                                        <a href="#" class="margin-right-33">Service Hours; 19.00-22:00 </a>
                                                        <a href="#">service charge : $15</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="sports-club">
                                    <div class="single-tab-content">
                                        <div class="row">
                                            <div class="co-lg-5 col-md-5">
                                                <div class="single-tab-image">
                                                    <a href="#"><img src="{{asset('public/images/hotel-facility-three.jpg')}}" alt=""></a>
                                                </div>
                                            </div>
                                            <div class="co-lg-7 col-md-7">
                                                <div class="single-tab-details">
                                                    <h6>The world class</h6>
                                                    <h3>Sports Club</h3>
                                                    <p>
                                                        Semper ac dolor vitae accumsan. Cras interdum hendrerit lacinia. Phasellus accumsan urna vitae molestie interdum. Nam sed placerat libero, non eleifend dolor.
                                                    </p>
                                                    <p>
                                                        Cras ac justo et augue suscipit euismod vel eget lectus. Proin vehicula nunc arcu, pulvinar accumsan nulla porta vel. Vivamus malesuada vitae sem ac pellentesque.
                                                    </p>
                                                    <div class="our_services">
                                                        <a href="#" class="margin-right-33">Service Hours; 19.00-22:00 </a>
                                                        <a href="#">service charge : $15</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="pick-up">
                                    <div class="single-tab-content">
                                        <div class="row">
                                            <div class="co-lg-5 col-md-5">
                                                <div class="single-tab-image">
                                                    <a href="#"><img src="{{asset('public/images/hotel-facility-one.jpg')}}" alt=""></a>
                                                </div>
                                            </div>
                                            <div class="co-lg-7 col-md-7">
                                                <div class="single-tab-details">
                                                    <h6>The world class</h6>
                                                    <h3>Pick Up</h3>
                                                    <p>
                                                        Semper ac dolor vitae accumsan. Cras interdum hendrerit lacinia. Phasellus accumsan urna vitae molestie interdum. Nam sed placerat libero, non eleifend dolor.
                                                    </p>
                                                    <p>
                                                        Cras ac justo et augue suscipit euismod vel eget lectus. Proin vehicula nunc arcu, pulvinar accumsan nulla porta vel. Vivamus malesuada vitae sem ac pellentesque.
                                                    </p>
                                                    <div class="our_services">
                                                        <a href="#" class="margin-right-33">Service Hours; 19.00-22:00 </a>
                                                        <a href="#">service charge : $15</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="bar">
                                    <div class="single-tab-content">
                                        <div class="row">
                                            <div class="co-lg-5 col-md-5">
                                                <div class="single-tab-image">
                                                    <a href="#"><img src="{{asset('public/images/hotel-facility-three.jpg')}}" alt=""></a>
                                                </div>
                                            </div>
                                            <div class="co-lg-7 col-md-7">
                                                <div class="single-tab-details">
                                                    <h6>The world class</h6>
                                                    <h3>Bar</h3>
                                                    <p>
                                                        Semper ac dolor vitae accumsan. Cras interdum hendrerit lacinia. Phasellus accumsan urna vitae molestie interdum. Nam sed placerat libero, non eleifend dolor.
                                                    </p>
                                                    <p>
                                                        Cras ac justo et augue suscipit euismod vel eget lectus. Proin vehicula nunc arcu, pulvinar accumsan nulla porta vel. Vivamus malesuada vitae sem ac pellentesque.
                                                    </p>
                                                    <div class="our_services">
                                                        <a href="#" class="margin-right-33">Service Hours; 19.00-22:00 </a>
                                                        <a href="#">service charge : $15</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="gym">
                                    <div class="single-tab-content">
                                        <div class="row">
                                            <div class="co-lg-5 col-md-5">
                                                <div class="single-tab-image">
                                                    <a href="#"><img src="{{asset('public/images/hotel-facility-one.jpg')}}" alt=""></a>
                                                </div>
                                            </div>
                                            <div class="co-lg-7 col-md-7">
                                                <div class="single-tab-details">
                                                    <h6>The world class</h6>
                                                    <h3>Gym</h3>
                                                    <p>
                                                        Semper ac dolor vitae accumsan. Cras interdum hendrerit lacinia. Phasellus accumsan urna vitae molestie interdum. Nam sed placerat libero, non eleifend dolor.
                                                    </p>
                                                    <p>
                                                        Cras ac justo et augue suscipit euismod vel eget lectus. Proin vehicula nunc arcu, pulvinar accumsan nulla porta vel. Vivamus malesuada vitae sem ac pellentesque.
                                                    </p>
                                                    <div class="our_services">
                                                        <a href="#" class="margin-right-33">Service Hours; 19.00-22:00 </a>
                                                        <a href="#">service charge : $15</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>-->
                                                           
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <style type="text/css">
            .hotel_facilities .nav.nav-tabs {
                border: medium none;
                margin: 0 auto;
                text-align: center;
                width: <?php echo $totalwidth; ?>%;
            }
            @if($background != FALSE)
            .hotel_facilities_area {
                background: url({{URL::to('/').str_replace('..', '',$background)}}) no-repeat fixed 0 0;
                background-size: cover;
                background-position: fixed;
            }
            @else
            .hotel_facilities_area {
                background: none;
                background-size: cover;
                background-position: fixed;
            }
            @endif
        </style>
        <!-- end Hotel Facilities section -->
        