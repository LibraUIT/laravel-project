                <!-- start hotel booking -->
                <div class="hotel_booking_area">
                    <div class="container">
                        <div class="hotel_booking">
                            <form id="form1" role="form" action="#" class="">
                                <div class="col-lg-2 col-md-2 col-sm-2">
                                    <div class="room_book border-right-dark-1">
                                        <h6>Book Your</h6>
                                        <p>Rooms</p>
                                    </div>
                                </div>
                                <div class="form-group col-lg-2 col-md-2 col-sm-2">
                                    <div class="input-group border-bottom-dark-2">
                                        <input class="date-picker" id="datepicker" placeholder="Arrival" type="text"/>
                                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                <div class="form-group col-lg-2 col-md-2 col-sm-2">
                                    <div class="input-group border-bottom-dark-2">
                                        <input class="date-picker" id="datepicker1" placeholder="Departure" type="text"/>
                                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="row">
                                        <div class="form-group col-lg-3 col-md-3 col-sm-3 icon_arrow">
                                            <div class="input-group border-bottom-dark-2">
                                                <select class="form-control" name="room" id="room">
                                                  <option selected="selected" disabled="disabled">1 Room</option>
                                                  <option value="Single">1 Room</option>
                                                  <option value="Double">2 Room</option>
                                                  <option value="Deluxe">3 Room</option>
                                                </select>               
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-3 col-md-3 col-sm-3 icon_arrow">
                                            <div class="input-group border-bottom-dark-2">
                                                <select class="form-control" name="room" id="adult">
                                                  <option selected="selected" disabled="disabled">1 Adult</option>
                                                  <option value="Single">1 Adult</option>
                                                  <option value="Double">2 Adult</option>
                                                  <option value="Deluxe">3 Adult</option>
                                                </select>               
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-3 col-md-3 col-sm-3 icon_arrow">
                                            <div class="input-group border-bottom-dark-2">
                                                <select class="form-control" name="room" id="child">
                                                  <option selected="selected" disabled="disabled">0 Child</option>
                                                  <option value="Single">0 Child</option>
                                                  <option value="Double">1 Child</option>
                                                  <option value="Deluxe">2 Child</option>
                                                </select>               
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                            <a class="btn btn-primary floatright">Book</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- special offer start -->
                            @if($bookingwithspecial == 1)
                            <div class="special_offer_main">
                                <img src="{{asset('public/images/special-offer-main.png')}}" alt="">
                            </div>
                            @endif
                            <!-- end offer start -->
                        </div>
                    </div>
                </div>
                <!-- end hotel booking -->