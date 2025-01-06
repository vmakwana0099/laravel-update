<div class="dropdown-menu">
    <div class="container">
        <div class="menu_01">
            <h3 class="title hidden-lg-down">Hosting</h3>
            <ul>

                <?php $pos = 1; ?>
                
<!--                @if(Config::get('Constant.Currency') == 'INR')
                $Currency = '&#8377;';
                @else
                $Currency = '&#x24;';
                @endif-->
                
               
                @foreach($data as $value)
                <?php
                if ($pos == 1) {
                    $Class = "active";
                } else {
                    $Class = "";
                }
                if ($value->id == 22) {
                    $content = "The Reliability of Hosting Delivered at Blazing Fast Speed With Host IT Smart.";
                } else if ($value->id == 23) {
                    $content = "The Reliability of Wordpress Delivered at Blazing Fast Speed With Host IT Smart.";
                } else if ($value->id == 24) {
                    $content = "The Reliability of Cloud Delivered at Blazing Fast Speed With Host IT Smart.";
                } else if ($value->id == 25) {
                    $content = "The Reliability of eCommerce Delivered at Blazing Fast Speed With Host IT Smart.";
                } else if ($value->id == 26) {
                    $content = "The Reliability of VPS Delivered at Blazing Fast Speed With Host IT Smart.";
                } else if ($value->id == 27) {
                    $content = "The Reliability of Dedicated Delivered at Blazing Fast Speed With Host IT Smart.";
                } else if ($value->id == 29) {
                    $content = "The Reliability of Reseller Delivered at Blazing Fast Speed With Host IT Smart.";
                } else {
                    $content = "The Reliability of Wordpress Delivered at Blazing Fast Speed With Host IT Smart.";
                }
                ?>
                <li class="dropdown {{$Class}}">
                    <a href="{{ url('hosting/'.$value->txtPageUrl)}}" title="{{$value->varTitle}}" class="dropdown-toggle" data-toggle="dropdown">{{$value->varTitle}}</a>


                    <div class="dropdown-menu">
                        <div class="d-flex">
                            <div class="menu_02">
                                <div class="optimized_hosting">
                                    <h3>{{$value->varTitle}}</h3>
                                    <div class="content">
                                        {{$content}}
                                    </div>
                                    <div class="price_div">
                                        <span class="startat">Starts at</span>
                                        <div class="pricepermonth"><span class="rupees_sign"> &#8377;</span>{{$value->price}}<span class="month">/month*</span></div>
                                    </div>
                                    <a href="{{ url('hosting/'.$value->txtPageUrl)}}" class="btn" title="Get Started">Get Started</a>
                                </div>
                            </div>
                            <div class="menu_03">
                                <div class="buy_div">
                                    <div class="buybox text-center">
                                        <span class="hotofr-icon"></span>
                                        <h4><a href="#" title="Buy WordPress Hosting & Get Domain for Free">Buy {{$value->varTitle}} & Get Domain for Free</a></h4>
                                        <a href="#" class="btn" title="Shop Now">Shop Now</a>
                                    </div>
                                    <div class="buybox text-center">
                                        <span class="hotofr-icon"></span>
                                        <h4><a href="#" title="Wordpress Setup for a Discount Price">{{$value->varTitle}} Setup for a Discount Price</a></h4>
                                        <div class="offer-price"><span>Only</span><i>&#8377; 99</i></div>
                                        <a href="#" class="btn" title="Shop Now">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </li>
                <?php $pos++; ?>
                @endforeach
            </ul>
            <div class="rating_div row">
                <span class="rating_title">Check out our customer Reviews</span>
                <img src="assets/images/rating.png" alt="Rating">
            </div>
        </div>
        <div class="menu_04">
            <div class="month-offer text-center">
                <span class="offer-icon"></span>
                <h4>Offer of the Month</h4>
                <span class="tagline">The best Web Hosting</span>
                <div class="price_text">
                    Start at <span class="rs-ico">&#8377;</span><span class="rupees">99</span><span class="permonth">/mo*</span>
                </div>
                <ul class="offer_list">
                    <li>Unlimited Domains</li>
                    <li>Unmetered bandwidth</li>
                    <li>Unmetered hosting space</li>
                    <li>Unlimited email accounts</li>
                </ul>
                <a href="{{ url('hosting/'.$value->txtPageUrl)}}" class="btn" title="Get Start Now">Get Start Now</a>
            </div>
        </div>
    </div>
</div>