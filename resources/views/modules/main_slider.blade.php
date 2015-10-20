        <!-- start main slider -->
        <div class="main_slider_area">
            <div class="main_slider" id="slider_rev">
                {!! $module_hotel_booking_area !!}
                <div class="fullwidthbanner-container" >
                    <div class="fullwidth_home_banner">
                        <ul>
                            @if(count($config) > 0)
                            @foreach($config as $v)
                            <li data-transition="random" data-slotamount="7" data-masterspeed="1000">
                                <img src="{{URL::to('/')}}{{ str_replace('..', '',$v['image'])}}" alt="slide" >
                                <?php $text = explode(';', $v['text']) ; ?>
                                @if(count($text) > 0)
                                <div class="tp-caption large_black sfr" data-x="105" data-y="197" data-speed="1200" data-start="1100" data-easing="easeInOutBack"
                                    style="font-family: 'Playfair Display', serif; font-size: 48px;color: #131e2a; margin-bottom: 23px; text-transform: uppercase; line-height: 40px;">
                                    {{$text[0]}}
                                </div>
                                @if(count($text) > 1)
                                <div class="tp-caption large_black sfr" data-x="105" data-y="255" data-speed="1500" data-start="1400" data-easing="easeInOutBack"
                                    style="font-family: 'Playfair Display', serif; font-size: 48px;color: #131e2a; margin-bottom: 23px; text-transform: uppercase; line-height: 40px;">
                                    {{$text[1]}}
                                </div>-->
                                @endif
                                @endif

                                <div class="tp-caption lfb carousel-caption-inner" data-x="105" data-y="313" data-speed="1300" data-start="1700" data-easing="easeInOutBack" 
                                    style="background: #f7c411; padding: 10px; cursor: pointer;">
                                    @if($v['link'] == '')
                                    <a href="#" class="" style="background: #f7c411; border-radius: 0; color: #313a45; display: inline-block;  font-size: 18px; padding: 8px 34px; text-transform: uppercase; border: 1px solid #9e811a;">Explore IT</a>
                                    @else
                                    <a href="{{$v['link']}}" class="" style="background: #f7c411; border-radius: 0; color: #313a45; display: inline-block;  font-size: 18px; padding: 8px 34px; text-transform: uppercase; border: 1px solid #9e811a;">Explore IT</a>
                                    @endif
                                </div>
                            </li>
                            @endforeach
                            @endif
                            <!--<li data-transition="random" data-slotamount="7" data-masterspeed="1000">
                                <img src="{{asset('public/images/slider-one.jpg')}}" alt="slide" >
                                <div class="tp-caption large_black sfr" data-x="105" data-y="197" data-speed="1200" data-start="1100" data-easing="easeInOutBack"
                                    style="font-family: 'Playfair Display', serif; font-size: 48px;color: #131e2a; margin-bottom: 23px; text-transform: uppercase; line-height: 40px;">
                                    A brand New Hotel
                                </div>
                                <div class="tp-caption large_black sfr" data-x="105" data-y="255" data-speed="1500" data-start="1400" data-easing="easeInOutBack"
                                    style="font-family: 'Playfair Display', serif; font-size: 48px;color: #131e2a; margin-bottom: 23px; text-transform: uppercase; line-height: 40px;">
                                    Beyond Ordinary
                                </div>
                                <div class="tp-caption lfb carousel-caption-inner" data-x="105" data-y="313" data-speed="1300" data-start="1700" data-easing="easeInOutBack" 
                                    style="background: #f7c411; padding: 10px; cursor: pointer;">
                                    <a href="#" class="" style="background: #f7c411; border-radius: 0; color: #313a45; display: inline-block;  font-size: 18px; padding: 8px 34px; text-transform: uppercase; border: 1px solid #9e811a;">Explore IT</a>
                                </div>
                            </li>

                            <li data-transition="random" data-slotamount="7" data-masterspeed="1000">
                                <img src="{{asset('public/images/slider-one.jpg')}}" alt="slide" >
                                <div class="tp-caption large_black sfr" data-x="105" data-y="197" data-speed="1200" data-start="1100" data-easing="easeInOutBack"
                                    style="font-family: 'Playfair Display', serif; font-size: 48px;color: #131e2a; margin-bottom: 23px; text-transform: uppercase; line-height: 40px;">
                                    Book Your Summer Holidays
                                </div>
                                <div class="tp-caption large_black sfr" data-x="105" data-y="255" data-speed="1500" data-start="1400" data-easing="easeInOutBack"
                                    style="font-family: 'Playfair Display', serif; font-size: 48px;color: #131e2a; margin-bottom: 23px; text-transform: uppercase; line-height: 40px;">
                                    With HOTEL BOOKING Template
                                </div>
                                <div class="tp-caption lfb carousel-caption-inner" data-x="105" data-y="313" data-speed="1300" data-start="1700" data-easing="easeInOutBack" 
                                    style="background: #f7c411; padding: 10px; cursor: pointer;">
                                    <a href="#" class="" style="background: #f7c411; border-radius: 0; color: #313a45; display: inline-block;  font-size: 18px; padding: 8px 34px; text-transform: uppercase; border: 1px solid #9e811a;">Explore IT</a>
                                </div>
                            </li>-->    						                           
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- end main slider -->