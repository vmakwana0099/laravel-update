@extends('layouts.app')
@section('content')

@if (isset($bannerData) && !empty($bannerData) && count($bannerData) > 0)
    <?php $themeversion = !isset($_SESSION['themepreview']) ? Config::get('Constant.DEFAULT_THEME') : $_SESSION['themepreview']; ?> 
    @include('template.'.$themeversion.'.banner')
@else
    @include('layouts.inner_banner')
@endif

<div class="deals-main head-tb-p-40" id="deals-main">    
    <div class="container">
        <div class="deals-tabbing">

            <!-- Vk 6_10_2020 Start -->
            <div class="section-heading">
              <h2 class="text-center text_head">
                Explore Our Smart Deals
              </h2>
            </div>
            <!-- Vk 6_10_2020 End -->





            <ul class="nav nav-pills nav-deals d-md-flex d-none" data-aos="fade-up">      
                <li class="col text-center nav-item">
                    <a data-toggle="pill" href="#all-deals" title="All Offers" class="nav-link active" id="alloffer1">All Offers</a></li>
                @foreach($DealsCat as $Cat)
                <?php
                // echo '<pre>'; print_r($Cat);
                ?>
                <li class="col text-center nav-item" id="{{str_replace(' ', '-', $Cat->varTitle)}}" >
                    <a class="nav-link" data-toggle="pill" href="#{{$Cat->id}}" title="{{$Cat->varTitle}}" id="{{str_replace(' ', '-', $Cat->varTitle)}}1">{{$Cat->varTitle}}</a></li>
                @endforeach
                
            </ul>
            <div class="dropdown d-md-none d-block">
                <select class="form-control selectpicker" id='ProductTitle'>
                    <option class="deals-tab-responsive">All Offers</option>
                    @foreach($DealsCat as $Cat)
                    <option class="deals-tab-responsive"  value="{{$Cat->id}}">{{$Cat->varTitle}}</option>
                    @endforeach
                </select>
            </div>
           {{--  <script>
                $('#ProductTitle').on('change', function() {
                    if(this.value == "1") {
                      $('#1').addClass('in active');
                      $('#2').removeClass('in active');
                      $('#3').removeClass('in active');
                      $('#4').removeClass('in active');
                      $('#all-deals').removeClass('in active');
                    } else if(this.value == "2") { 
                      $('#1').removeClass('in active');
                      $('#2').addClass('in active');
                      $('#3').removeClass('in active');
                      $('#4').removeClass('in active');
                      $('#all-deals').removeClass('in active');
                    } else if(this.value == "3") { 
                      $('#1').removeClass('in active');
                      $('#2').removeClass('in active');
                      $('#3').addClass('in active');
                      $('#4').removeClass('in active');
                      $('#all-deals').removeClass('in active');
                    } else if(this.value == "4") { 
                      $('#1').removeClass('in active');
                      $('#2').removeClass('in active');
                      $('#3').removeClass('in active');
                      $('#4').addClass('in active');
                      $('#all-deals').removeClass('in active');
                    } else {
                      $('#1').removeClass('in active');
                      $('#2').removeClass('in active');
                      $('#3').removeClass('in active');
                      $('#4').removeClass('in active');
                      $('#all-deals').addClass('in active');
                    }
                  });
                </script> --}}
  

            <div class="tab-content">
                <div id="all-deals" class="tab-pane in active all-deals">
                    <div class="deal-boxes">
                        <div class="row">
                            @php $ao = 0; @endphp <?php /* vk 20/1/2020 */ ?>
                            @foreach($DealsData as $Deals)
                            @php $date1 = \Carbon\Carbon::parse($Deals->dtend_date)->format('Y-m-d H:i:s'); 
                            $now =  \Carbon\Carbon::now();
                            $datetime1 = new DateTime($date1);
                            $datetime2 = new DateTime($now);
                            $interval = $datetime1->diff($datetime2);
                            $days = $interval->format('%a');
                            $cur_url = Request::fullUrl();
                            $title = $Deals->varTitle;
                            $fb = "https://www.facebook.com/sharer/sharer.php?u=$cur_url&t=$title";
                            $tw = "https://twitter.com/home?status=$title%20$cur_url";
                            $gp = "https://plus.google.com/share?url=$cur_url";
                            $pn = "https://www.pinterest.com/pin/create/button/?url=$cur_url&description=$title";
                            $ln = "http://www.linkedin.com/shareArticle?mini=true&amp;url=$cur_url";
                            @endphp
                            <div class="col-lg-4 col-sm-6 col-12 d-flex justify-content-center" data-aos='zoom-in' >
                                <div class="deal-box flex-wrap s0" data-aos="zoom-inn" data-aos-delay="100" id="s0">
                                    <div class="deal-head d-flex">
                                            <div class="hot-deals promocode">
                                                {{$Deals->varTagLine}}
                                            </div>
                                            @if($days <= '4')
                                            <div class="ending-soon-div">Ending Soon!</div>
                                            @endif
                                            {{-- <div class="ml-auto deals-share-position">
                                                <a href="javascript:void(0)" class="deals-share" title="Share"><i class="icon-share sprite-deals"></i></a>
                                                <ul class="banner-social">
                                                    <li><a href="{{$fb}}" class="share-social facebook" target="_blank" title="facebook"><i class="fa fa-facebook"></i></a></li>
                                                    
                                                    <li><a href="{{$tw}}" class="share-social twitter" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                                                    <li><a href="{{$pn}}" class="share-social pinterest" target="_blank" title="Pinterest"><i class="fa fa-pinterest-p"></i></a></li>
                                                    <li><a href="{{$ln}}" class="share-social linkedin" target="_blank" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
                                                </ul>
                                            </div> --}}
                                        </div>
                                    <div class="align-self-center">
                                        <i class="{{$Deals->varListingIcon}}"></i>
                                        
                                        <h3 class="deal-title" title="{{$Deals->varTitle}}">{{$Deals->varTitle}}</h3>
                                        <div class="deal-off">
                                            @if(!empty($Deals->discount_percentage))
                                            <span class="off-big">{{$Deals->discount_percentage}}<span class="light-font">%</span></span>off
                                            @else
                                            <span class="off-big">{{$Deals->discount_fixed}}</span>off
                                            @endif
                                        </div>
                                        <span class="deals-text">
                                            @if(strlen($Deals->varShortDescription) > 115) 
                                            {!!substr(nl2br($Deals->varShortDescription),0, 115).'...'!!}
                                            @else
                                            {!!nl2br($Deals->varShortDescription)!!}
                                            @endif
                                        </span> 
                                    </div>

                                    @if(!empty($Deals->varDealsINRPrice) && !empty($Deals->varDealsUSDPrice))
                                            <div class="deal-price d-flex ">
                                                <span class="rupees">{!! Config::get('Constant.sys_currency_symbol') !!}</span>
                                                @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                                <span class="deal-p">{{$Deals->varDealsINRPrice}}</span>
                                                @php } else { @endphp 
                                                <span class="deal-p">{{$Deals->varDealsUSDPrice}}</span>
                                                @php } @endphp 
                                                @php if(isset($Deals->DealsCat) && $Deals->DealsCat=="Domains")
                                                { @endphp
                                                <span class="deal-month align-items-end d-flex">Per Year</span>
                                             @php } else { @endphp-
                                                <span class="deal-month align-items-end d-flex">Per Month</span>
                                             @php } @endphp
                                            </div>

                                            @elseif(!empty($Deals->varDealsINRPrice))
                                            <div class="deal-price d-flex align-items-end deal-price-hosting">
                                            <span>&nbsp;Starts @</span>

                                                <span class="rupees">{!! Config::get('Constant.sys_currency_symbol') !!}</span>
                                                <span class="deal-p "> {{$Deals->varDealsINRPrice}}</span>
                                                @if(strtolower($Deals->varTitle) == strtolower(".COM Domain"))
                                                <span class="deal-month align-items-end d-flex" >/Yr </span>
                                                @else
                                                <span class="deal-month align-items-end d-flex" >/mo </span>
                                                @endif
                                            </div>

                                             @endif
                                             @if($Deals->discount_percentage > 0)
                                            <div class="deal-price d-flex align-items-end deal-price-hosting" style="margin-left:1px; ">
                                                <span>&nbsp;Grab Extra</span>
                                                <span class="deal-p "> {{$Deals->discount_percentage}}%&nbsp;OFF</span>
                                                <span class="deal-month align-items-end d-flex deal-price"> With</span>
                                            </div>
                                             <span class="deal-p-extra-days">15&nbsp;</span>
                                                <span class="deal-extra-days">Days Extra</span>
                                             @endif
                                    <div class="deal-code d-flex">
                                         @if(isset($Deals->varbutton_link) && !empty($Deals->varbutton_link))
                                         <a href="{{ $Deals->varbutton_link }}" class="btn" title="GET THIS DEAL">GET THIS DEAL</a>
                                         @endif
                                            @php if(isset($Deals->DealsCat) && $Deals->DealsCat=="Domains")
                                                { @endphp
                                                {{-- <a href="javascript:void(0)" class="btn" title="GET THIS DEAL" data-toggle="modal" data-target="#all-offer_{{$Deals->id}}">GET THIS DEAL</a> --}}
                                             @php } else { @endphp
                                                {{-- <a href="javascript:void(0)" class="btn" title="Get This Deal" data-toggle="modal" data-target="#all-offer_{{$Deals->id}}">GET THIS DEAL</a> --}}
                                             @php } @endphp
                                             
                                            
                                           

                                    </div>
                                </div>
                            </div>
                            <div class="modal fade deal-popup" id="all-offer_{{$Deals->id}}" role="dialog">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            <h2 class="modal-title">Sale Activated!</h2>
                                        </div>
                                        <div class="modal-body">
                                            <div class="deal-body">
                                              <!--   <div class="deal-promo">Copy and paste this code at Checkout.</div> -->
                                                <div class="promo">
                                                    <form action="{{$cur_url}}" class="custom-input form-group">
                                                        @if(isset($Deals->varbutton_link))
                                                            @if(!empty($Deals->varpromo_code))
                                                            <div class="input-group" id="all_copy_{{$Deals->id}}">
                                                                <input autocomplete="off" readonly="" type="text" value="{{$Deals->varpromo_code}}" id="all_offer_{{$Deals->id}}" class="form-control">
                                                                <p class="link-copy btn all_offer_{{$Deals->id}}" title="Copy" onclick="myFunction('all_offer_{{$Deals->id}}')">Copy</p>
                                                            </div>
                                                            @endif
                                                        {{-- <button onclick="window.location = '{{$Deals->varbutton_link}}';" type="button" title="Grab This Deals Now!" target="_blank" class="btn">Grab This Deals Now!</button> --}}
                                                        <a href="{{ $Deals->varbutton_link }}" title="Grab This Deals Now!" target="_blank" class="btn">Grab This Deals Now!</a>


                                                        @else
                                                        <div class="input-group" id="all_copy_{{$Deals->id}}">
                                                            <input autocomplete="off" readonly="" type="text" value="{{$Deals->varpromo_code}}" id="all_offer_{{$Deals->id}}" class="form-control">
                                                            <p class="link-copy btn all_offer_{{$Deals->id}}" title="Copy" onclick="myFunction('all_offer_{{$Deals->id}}')">Copy</p>
                                                        </div>
                                                        <button onclick="applyPromocode($('#all_offer_{{$Deals->id}}').val(), 'all_offer_{{$Deals->id}}');" type="button" title="Grab This Deals Now!" target="_blank" class="btn">Grab This Deals Now!</button>
                                                        @endif
                                                    </form>
                                                </div>
                                                <div class="deal-discount">
                                                   <b> {{$Deals->varpopup_title}}</b>
                                                </div>
                                              <!--   <div class="deal-text">
                                                    @if(strlen($Deals->varShortDescription) > 230) 
                                                    {!!substr(nl2br($Deals->varShortDescription),0, 230)!!}
                                                    @else
                                                    {!!nl2br($Deals->varShortDescription)!!}
                                                    @endif
                                                </div> -->
                                                @if(!empty($Deals->varProductFeatures))
                                                <?php /*<div class="deal-discount">
                                                    Product Features
                                                </div>*/ ?>
                                                <div class="deal-text">
                                                    {!!nl2br($Deals->varProductFeatures)!!}
                                                </div>
                                                @endif
                                                <div class="offer-end float-center">
                                                    Offer Ends {{date('d-m-Y', strtotime($Deals->dtend_date))}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer flex-column">
                                            <div class="deal-signmail text-center">
                                                <div class="signup-mail-text">Sign up for emails and be the first to know</div>
                                                <div class="mail-textbox">
                                                    <form action="https://hostitsmart.us19.list-manage.com/subscribe/post?u=f6d3566771049dcebe2b276d7&id=0e3eda5761" class="form-group custom-input">
                                                        <div class="input-group">
                                                            <span class="email-sign"></span>
                                                            <input type="text" id="emailinput_{{$Deals->id}}" placeholder="Email Address" name="EMAIL" class="form-control">
                                                            <button id="checkemail_{{$Deals->id}}" onclick="return validation({{$Deals->id}})" title="Sign Up" class="btn">Sign Up</button>
                                                            <?php
                                                            /*<input type="text" placeholder="Email Address" name="Email Address" class="form-control">
                                                            <button type="submit" title="Sign Up" class="btn">Sign Up</button>*/
                                                            ?>
                                                        </div>
                                                            <span id="emailvalidationtext_{{$Deals->id}}" class="red"></span>
                                                    </form>
                                                </div>
                                                <div class="deal-terms">
                                                    I agree to the <a href="{{url('/terms')}}" title="Terms of Use">Terms of Use</a> and <a href="{{url('/privacy-policy')}}" title="Privacy Policy">Privacy Policy</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php /* Start vk 20/1/2020 */ ?>
                            @php $ao++; @endphp
                            @endforeach
                            @if($ao == 0)
                            <div class="col-12"><div class="no-record"> <i class="no-record-icon"></i><span>No Deals
                            </span></div></div>
                            @endif
                            <?php /* End vk 20/1/2020 */ ?>
                        </div>
                    </div>
                </div>
                <div id="1" class="tab-pane">
                    <div class="deal-boxes">
                        <div class="row">
                            @php $w = 0; @endphp
                            @foreach($DealsData as $Deals)
                            @if($Deals->fkdealscategory_id == 1)
                            @php $date1 = \Carbon\Carbon::parse($Deals->dtend_date)->format('Y-m-d H:i:s'); 
                            $now =  \Carbon\Carbon::now();
                            $datetime1 = new DateTime($date1);
                            $datetime2 = new DateTime($now);
                            $interval = $datetime1->diff($datetime2);
                            $days = $interval->format('%a');
                            $cur_url = Request::fullUrl();
                            $title = $Deals->varTitle;
                            $fb = "https://www.facebook.com/sharer/sharer.php?u=$cur_url&t=$title";
                            $tw = "https://twitter.com/home?status=$title%20$cur_url";
                            $gp = "https://plus.google.com/share?url=$cur_url";
                            $pn = "https://www.pinterest.com/pin/create/button/?url=$cur_url&description=$title";
                            $ln = "http://www.linkedin.com/shareArticle?mini=true&amp;url=$cur_url";
                            @endphp 
                            <div class="col-lg-4 col-sm-6 col-12 d-flex justify-content-center" >
                                <div class="deal-box  flex-wrap" data-aos="zoom-inn" data-aos-delay="100" id="s1">
                                    <div class="deal-head d-flex">
                                        <div class="hot-deals promocode">
                                            {{$Deals->varTagLine}}
                                        </div>
                                        @if($days <= '4')
                                        <div class="ending-soon-div">Ending Soon!</div>
                                        @endif
                                        {{-- <div class="ml-auto deals-share-position">
                                            <a href="javascript:void(0)" class="deals-share" title="Share"><i class="icon-share sprite-deals"></i></a>
                                            <ul class="banner-social">
                                                <li><a href="{{$fb}}" class="share-social facebook" target="_blank" title="facebook"><i class="fa fa-facebook"></i></a></li>
                                                
                                                <li><a href="{{$tw}}" class="share-social twitter" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                                                <li><a href="{{$pn}}" class="share-social pinterest" target="_blank" title="Pinterest"><i class="fa fa-pinterest-p"></i></a></li>
                                                <li><a href="{{$ln}}" class="share-social linkedin" target="_blank" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
                                            </ul>
                                        </div> --}}
                                    </div>
                                    <div class="align-self-center">
                                        <i class="{{$Deals->varListingIcon}}"></i>
                                        <h3 class="deal-title" title="{{$Deals->varTitle}}">{{$Deals->varTitle}}</h3>
                                        <div class="deal-off">
                                            @if(!empty($Deals->discount_percentage))
                                            <span class="off-big">{{$Deals->discount_percentage}}<span class="light-font">%</span></span>off
                                            @else
                                            <span class="off-big">{{$Deals->discount_fixed}}</span>off
                                            @endif
                                        </div>
                                        <span class="deals-text">
                                            @if(strlen($Deals->varShortDescription) > 115) 
                                            {!!substr(nl2br($Deals->varShortDescription),0, 115).'...'!!}
                                            @else
                                            {!!nl2br($Deals->varShortDescription)!!}
                                            @endif
                                        </span>
                                    </div>
                                    @if(!empty($Deals->varDealsINRPrice) && !empty($Deals->varDealsUSDPrice))
                                            <div class="deal-price d-flex ">
                                                <span class="rupees">{!! Config::get('Constant.sys_currency_symbol') !!}</span>
                                                @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                                <span class="deal-p">{{$Deals->varDealsINRPrice}}</span>
                                                @php } else { @endphp 
                                                <span class="deal-p">{{$Deals->varDealsUSDPrice}}</span>
                                                @php } @endphp 
                                                @php if(isset($Deals->DealsCat) && $Deals->DealsCat=="Domains")
                                                { @endphp
                                                <span class="deal-month align-items-end d-flex">Per Year</span>
                                             @php } else { @endphp-
                                                <span class="deal-month align-items-end d-flex">Per Month</span>
                                             @php } @endphp
                                            </div>

                                            @elseif(!empty($Deals->varDealsINRPrice))
                                            <div class="deal-price d-flex align-items-end deal-price-hosting">
                                            <span>&nbsp;Starts @</span>

                                                <span class="rupees">{!! Config::get('Constant.sys_currency_symbol') !!}</span>
                                                <span class="deal-p "> {{$Deals->varDealsINRPrice}}</span>
                                                @if(strtolower($Deals->varTitle) == strtolower(".COM Domain"))
                                                <span class="deal-month align-items-end d-flex" >/Yr </span>
                                                @else
                                                <span class="deal-month align-items-end d-flex" >/mo </span>
                                                @endif
                                            </div>
                                             @endif
                                             @if($Deals->discount_percentage > 0)
                                            <div class="deal-price d-flex align-items-end deal-price-hosting" style="margin-left:1px; ">
                                                <span>&nbsp;Grab Extra</span>
                                                <span class="deal-p "> {{$Deals->discount_percentage}}%&nbsp;OFF</span>
                                                <span class="deal-month align-items-end d-flex deal-price"> With</span>
                                            </div>
                                             <span class="deal-p-extra-days">15&nbsp;</span>
                                                <span class="deal-extra-days">Days Extra</span>
                                             @endif


                                    <div class="deal-code d-flex">
                                        @if(isset($Deals->varbutton_link) && !empty($Deals->varbutton_link))
                                         <a href="{{ $Deals->varbutton_link }}" class="btn" title="GET THIS DEAL">GET THIS DEAL</a>
                                         @endif
                                        {{-- <a href="javascript:void(0)" class="btn" title="GET THIS DEAL" data-toggle="modal" data-target="#web-host_{{$Deals->id}}">GET THIS DEAL</a> --}}

                                        {{-- @if(!empty($Deals->varDealsINRPrice) && !empty($Deals->varDealsUSDPrice))
                                        <div class="deal-price d-flex">
                                            <span class="rupees">{!! Config::get('Constant.sys_currency_symbol') !!}</span>
                                            @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                            <span class="deal-p">{{$Deals->varDealsINRPrice}}</span>
                                            @php } else { @endphp 
                                            <span class="deal-p">{{$Deals->varDealsUSDPrice}}</span>
                                            @php } @endphp 
                                            <span class="deal-month align-items-end d-flex">Per Month</span>
                                        </div>
                                        @endif --}}
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade deal-popup" id="web-host_{{$Deals->id}}" role="dialog">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            <h2 class="modal-title">Sale Activated!</h2>
                                        </div>
                                        <div class="modal-body">
                                            <div class="deal-body">
                                                {{-- <div class="deal-promo">Copy and paste this code at Checkout.</div> --}}
                                                <div class="promo">
                                                    <form action="{{$cur_url}}" class="custom-input form-group">
                                                        @if(isset($Deals->varbutton_link))
                                                            @if(!empty($Deals->varpromo_code))
                                                            <div class="input-group" id="all_copy_{{$Deals->id}}">
                                                                <input autocomplete="off" readonly="" type="text" value="{{$Deals->varpromo_code}}" id="all_offer_{{$Deals->id}}" class="form-control">
                                                                <p class="link-copy btn all_offer_{{$Deals->id}}" title="Copy" onclick="myFunction('all_offer_{{$Deals->id}}')">Copy</p>
                                                            </div>
                                                            @endif
                                                        {{-- <button onclick="window.location = '{{$Deals->varbutton_link}}';" type="button" title="Grab This Deals Now!" target="_blank" class="btn">Grab This Deals Now!</button> --}}

                                                         <a href="{{ $Deals->varbutton_link }}" title="Grab This Deals Now!" target="_blank" class="btn">Grab This Deals Now!</a>

                                                        @else
                                                        <div class="input-group" id="all_copy_{{$Deals->id}}">
                                                            <input autocomplete="off" readonly="" type="text" value="{{$Deals->varpromo_code}}" id="all_offer_{{$Deals->id}}" class="form-control">
                                                            <p class="link-copy btn all_offer_{{$Deals->id}}" title="Copy" onclick="myFunction('all_offer_{{$Deals->id}}')">Copy</p>
                                                        </div>
                                                        <button onclick="applyPromocode($('#all_offer_{{$Deals->id}}').val(), 'all_offer_{{$Deals->id}}');" type="button" title="Grab This Deals Now!" target="_blank" class="btn">Grab This Deals Now!</button>
                                                        @endif
                                                    </form>
                                                </div>
                                                <div class="deal-discount">
                                                    {{$Deals->varpopup_title}}
                                                </div>
                                                <div class="deal-text">
                                                    @if(strlen($Deals->varShortDescription) > 230) 
                                                    {!!substr(nl2br($Deals->varShortDescription),0, 230)!!}
                                                    @else
                                                    {!!nl2br($Deals->varShortDescription)!!}
                                                    @endif
                                                </div>
                                                @if(!empty($Deals->varProductFeatures))
                                                <?php /*<div class="deal-discount">
                                                    Product Features
                                                </div>*/ ?>
                                                <div class="deal-text">
                                                    {!!nl2br($Deals->varProductFeatures)!!}
                                                </div>
                                                @endif
                                                <div class="offer-end float-center">
                                                    Offer Ends {{date('d-m-Y', strtotime($Deals->dtend_date))}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer flex-column">
                                            <div class="deal-signmail text-center">
                                                <div class="signup-mail-text">Sign up for emails and be the first to know</div>
                                                <div class="mail-textbox">
                                                    <form action="https://hostitsmart.us19.list-manage.com/subscribe/post?u=f6d3566771049dcebe2b276d7&id=0e3eda5761" class="form-group custom-input">
                                                        <div class="input-group">
                                                            <span class="email-sign"></span>
                                                            <input type="text" id="webemailinput_{{$Deals->id}}" placeholder="Email Address" name="EMAIL" class="form-control">
                                                            <button type="submit" onclick="return webvalidation({{$Deals->id}})" id="webcheckemail_{{$Deals->id}}" title="Sign Up" class="btn">Sign Up</button>
                                                            <?php
                                                            /*<input type="text" placeholder="Email Address" name="Email Address" class="form-control">
                                                            <button type="submit" title="Sign Up" class="btn">Sign Up</button>*/
                                                            ?>
                                                        </div>
                                                            <span id="webemailvalidationtext_{{$Deals->id}}" class="red"></span>
                                                    </form>
                                                </div>
                                               <div class="deal-terms">
                                                    I agree to the <a href="{{url('/terms')}}" title="Terms of Use">Terms of Use</a> and <a href="{{url('/privacy-policy')}}" title="Privacy Policy">Privacy Policy</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @php $w++; @endphp
                            @endif
                            @endforeach
                            @if($w == 0)
                            <div class="col-12"><div class="no-record"> <i class="no-record-icon"></i><span>No Deals
                            </span></div></div>
                            @endif
                        </div>
                    </div>
                </div>
                <div id="2" class="tab-pane">
                    <div class="deal-boxes">
                        <div class="row">
                            @php $c = 0; @endphp
                            @foreach($DealsData as $Deals)
                            @if($Deals->fkdealscategory_id == 2)
                            @php $date1 = \Carbon\Carbon::parse($Deals->dtend_date)->format('Y-m-d H:i:s'); 
                            $now =  \Carbon\Carbon::now();
                            $datetime1 = new DateTime($date1);
                            $datetime2 = new DateTime($now);
                            $interval = $datetime1->diff($datetime2);
                            $days = $interval->format('%a');
                            $cur_url = Request::fullUrl();
                            $title = $Deals->varTitle;
                            $fb = "https://www.facebook.com/sharer/sharer.php?u=$cur_url&t=$title";
                            $tw = "https://twitter.com/home?status=$title%20$cur_url";
                            $gp = "https://plus.google.com/share?url=$cur_url";
                            $pn = "https://www.pinterest.com/pin/create/button/?url=$cur_url&description=$title";
                            $ln = "http://www.linkedin.com/shareArticle?mini=true&amp;url=$cur_url";
                            @endphp 
                            <div class="col-lg-4 col-sm-6 col-12 d-flex justify-content-center" >
                                <div class="deal-box flex-wrap s2" data-aos="zoom-inn" data-aos-delay="100" id="s2">
                                    <div class="deal-head d-flex">
                                        <div class="hot-deals promocode">
                                            {{$Deals->varTagLine}}
                                        </div>
                                        @if($days <= '4')
                                        <div class="ending-soon-div">Ending Soon!</div>
                                        @endif
                                        {{-- <div class="ml-auto deals-share-position">
                                            <a href="javascript:void(0)" class="deals-share" title="Share"><i class="icon-share sprite-deals"></i></a>
                                            <ul class="banner-social">
                                                <li><a href="{{$fb}}" class="share-social facebook" target="_blank" title="facebook"><i class="fa fa-facebook"></i></a></li>
                                                
                                                <li><a href="{{$tw}}" class="share-social twitter" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                                                <li><a href="{{$pn}}" class="share-social pinterest" target="_blank" title="Pinterest"><i class="fa fa-pinterest-p"></i></a></li>
                                                <li><a href="{{$ln}}" class="share-social linkedin" target="_blank" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
                                            </ul>
                                        </div> --}}
                                    </div>
                                    <div class="align-self-center">
                                        <i class="{{$Deals->varListingIcon}}"></i>
                                        <h3 class="deal-title" title="{{$Deals->varTitle}}">{{$Deals->varTitle}}</h3>
                                        <div class="deal-off">
                                            @if(!empty($Deals->discount_percentage))
                                            <span class="off-big">{{$Deals->discount_percentage}}<span class="light-font">%</span></span>off
                                            @else
                                            <span class="off-big">{{$Deals->discount_fixed}}</span>off
                                            @endif
                                        </div>
                                       <span class="deals-text">
                                            @if(strlen($Deals->varShortDescription) > 115) 
                                            {!!substr(nl2br($Deals->varShortDescription),0, 115).'...'!!}
                                            @else
                                            {!!nl2br($Deals->varShortDescription)!!}
                                            @endif
                                        </span>
                                    </div>
                                    @if(!empty($Deals->varDealsINRPrice) && !empty($Deals->varDealsUSDPrice))
                                            <div class="deal-price d-flex ">
                                                <span class="rupees">{!! Config::get('Constant.sys_currency_symbol') !!}</span>
                                                @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                                <span class="deal-p">{{$Deals->varDealsINRPrice}}</span>
                                                @php } else { @endphp 
                                                <span class="deal-p">{{$Deals->varDealsUSDPrice}}</span>
                                                @php } @endphp 
                                                @php if(isset($Deals->DealsCat) && $Deals->DealsCat=="Domains")
                                                { @endphp
                                                <span class="deal-month align-items-end d-flex">Per Year</span>
                                             @php } else { @endphp-
                                                <span class="deal-month align-items-end d-flex">Per Month</span>
                                             @php } @endphp
                                            </div>

                                            @elseif(!empty($Deals->varDealsINRPrice))
                                            <div class="deal-price d-flex align-items-end deal-price-hosting">
                                            <span>&nbsp;Starts @</span>

                                                <span class="rupees">{!! Config::get('Constant.sys_currency_symbol') !!}</span>
                                                <span class="deal-p "> {{$Deals->varDealsINRPrice}}</span>
                                                @if(strtolower($Deals->varTitle) == strtolower(".COM Domain"))
                                                <span class="deal-month align-items-end d-flex" >/Yr </span>
                                                @else
                                                <span class="deal-month align-items-end d-flex" >/mo </span>
                                                @endif
                                            </div>
                                             @endif
                                             @if($Deals->discount_percentage > 0)
                                            <div class="deal-price d-flex align-items-end deal-price-hosting" style="margin-left:1px; ">
                                                <span>&nbsp;Grab Extra</span>
                                                <span class="deal-p "> {{$Deals->discount_percentage}}%&nbsp;OFF</span>
                                                <span class="deal-month align-items-end d-flex deal-price"> With</span>
                                            </div>
                                             <span class="deal-p-extra-days">15&nbsp;</span>
                                                <span class="deal-extra-days">Days Extra</span>
                                             @endif
                                    <div class="deal-code d-flex">
                                        @if(isset($Deals->varbutton_link) && !empty($Deals->varbutton_link))
                                         <a href="{{ $Deals->varbutton_link }}" class="btn" title="GET THIS DEAL">GET THIS DEAL</a>
                                         @endif
                                        {{-- <a href="javascript:void(0)" class="btn" title="GET THIS DEAL" data-toggle="modal" data-target="#combo_{{$Deals->id}}">GET THIS DEAL</a> --}}
                                         @if(!empty($Deals->varDealsINRPrice) && !empty($Deals->varDealsUSDPrice))
                                        <div class="deal-price d-flex">
                                            <span class="rupees">{!! Config::get('Constant.sys_currency_symbol') !!}</span>
                                            @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                            <span class="deal-p">{{$Deals->varDealsINRPrice}}</span>
                                            @php } else { @endphp 
                                            <span class="deal-p">{{$Deals->varDealsUSDPrice}}</span>
                                            @php } @endphp 
                                            <span class="deal-month align-items-end d-flex">Per Month</span>
                                        </div>
                                         @endif
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade deal-popup" id="combo_{{$Deals->id}}" role="dialog">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            <h2 class="modal-title">Sale Activated!</h2>
                                        </div>
                                        <div class="modal-body">
                                            <div class="deal-body">
                                                {{-- <div class="deal-promo">Copy and paste this code at Checkout.</div> --}}
                                                <div class="promo">
                                                    <form action="{{$cur_url}}" class="custom-input form-group">
                                                        @if(isset($Deals->varbutton_link))
                                                            @if(!empty($Deals->varpromo_code))
                                                            <div class="input-group" id="all_copy_{{$Deals->id}}">
                                                                <input autocomplete="off" readonly="" type="text" value="{{$Deals->varpromo_code}}" id="all_offer_{{$Deals->id}}" class="form-control">
                                                                <p class="link-copy btn all_offer_{{$Deals->id}}" title="Copy" onclick="myFunction('all_offer_{{$Deals->id}}')">Copy</p>
                                                            </div>
                                                            @endif
                                                        {{-- <button onclick="window.location = '{{$Deals->varbutton_link}}';" type="button" title="Grab This Deals Now!" target="_blank" class="btn">Grab This Deals Now!</button> --}}
                                                         <a href="{{ $Deals->varbutton_link }}" title="Grab This Deals Now!" target="_blank" class="btn">Grab This Deals Now!</a>
                                                        @else
                                                        <div class="input-group" id="all_copy_{{$Deals->id}}">
                                                            <input autocomplete="off" readonly="" type="text" value="{{$Deals->varpromo_code}}" id="all_offer_{{$Deals->id}}" class="form-control">
                                                            <p class="link-copy btn all_offer_{{$Deals->id}}" title="Copy" onclick="myFunction('all_offer_{{$Deals->id}}')">Copy</p>
                                                        </div>
                                                        <button onclick="applyPromocode($('#all_offer_{{$Deals->id}}').val(), 'all_offer_{{$Deals->id}}');" type="button" title="Grab This Deals Now!" target="_blank" class="btn">Grab This Deals Now!</button>
                                                        @endif
                                                    </form>
                                                </div>
                                                <div class="deal-discount">
                                                    {{$Deals->varpopup_title}}
                                                </div>
                                                <div class="deal-text">
                                                    @if(strlen($Deals->varShortDescription) > 230) 
                                                    {!!substr(nl2br($Deals->varShortDescription),0, 230)!!}
                                                    @else
                                                    {!!nl2br($Deals->varShortDescription)!!}
                                                    @endif
                                                </div>
                                                @if(!empty($Deals->varProductFeatures))
                                                <?php /*<div class="deal-discount">
                                                    Product Features
                                                </div>*/ ?>
                                                <div class="deal-text">
                                                    {!!nl2br($Deals->varProductFeatures)!!}
                                                </div>
                                                @endif
                                                <div class="offer-end float-center">
                                                    Offer Ends {{date('d-m-Y', strtotime($Deals->dtend_date))}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer flex-column">
                                            <div class="deal-signmail text-center">
                                                <div class="signup-mail-text">Sign up for emails and be the first to know</div>
                                                <div class="mail-textbox">
                                                    <form action="https://hostitsmart.us19.list-manage.com/subscribe/post?u=f6d3566771049dcebe2b276d7&id=0e3eda5761" class="form-group custom-input">
                                                        <div class="input-group">
                                                            <span class="email-sign"></span>
                                                            <input type="text" id="cmbemailinput_{{$Deals->id}}" placeholder="Email Address" name="EMAIL" class="form-control">
                                                            <button type="submit" onclick="return cmbvalidation({{$Deals->id}})" id="cmbcheckemail_{{$Deals->id}}" title="Sign Up" class="btn">Sign Up</button>
                                                            <?php
                                                            /*<input type="text" placeholder="Email Address" name="Email Address" class="form-control">
                                                            <button type="submit" title="Sign Up" class="btn">Sign Up</button>*/
                                                            ?>
                                                        </div>
                                                        <span id="cmbemailvalidationtext_{{$Deals->id}}" class="red"></span>
                                                    </form>
                                                </div>
                                                <div class="deal-terms">
                                                    I agree to the <a href="{{url('/terms')}}" title="Terms of Use">Terms of Use</a> and <a href="{{url('/privacy-policy')}}" title="Privacy Policy">Privacy Policy</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @php $c++; @endphp
                            @endif
                            @endforeach
                            @if($c == 0)
                            <div class="col-12"><div class="no-record"> <i class="no-record-icon"></i><span>No Deals
                            </span></div></div>
                            @endif
                        </div>
                    </div>
                </div>
                <div id="3" class="tab-pane">
                    <div class="deal-boxes">
                        <div class="row">
                            @php $d = 0; @endphp
                            @foreach($DealsData as $Deals)
                            @if($Deals->fkdealscategory_id == 3)
                            @php $date1 = \Carbon\Carbon::parse($Deals->dtend_date)->format('Y-m-d H:i:s'); 
                            $now =  \Carbon\Carbon::now();
                            $datetime1 = new DateTime($date1);
                            $datetime2 = new DateTime($now);
                            $interval = $datetime1->diff($datetime2);
                            $days = $interval->format('%a');
                            $cur_url = Request::fullUrl();
                            $title = $Deals->varTitle;
                            $fb = "https://www.facebook.com/sharer/sharer.php?u=$cur_url&t=$title";
                            $tw = "https://twitter.com/home?status=$title%20$cur_url";
                            $gp = "https://plus.google.com/share?url=$cur_url";
                            $pn = "https://www.pinterest.com/pin/create/button/?url=$cur_url&description=$title";
                            $ln = "http://www.linkedin.com/shareArticle?mini=true&amp;url=$cur_url";
                            @endphp 
                            <div class="col-lg-4 col-sm-6 col-12 d-flex justify-content-center" >
                                <div class="deal-box  flex-wrap s3" data-aos="zoom-inn" data-aos-delay="100" id="s3">
                                    <div class="deal-head d-flex">
                                        <div class="hot-deals promocode">
                                            {{$Deals->varTagLine}}
                                        </div>
                                        @if($days <= '4')
                                        <div class="ending-soon-div">Ending Soon!</div>
                                        @endif
                                        {{-- <div class="ml-auto deals-share-position">
                                            <a href="javascript:void(0)" class="deals-share" title="Share"><i class="icon-share sprite-deals"></i></a>
                                            <ul class="banner-social">
                                                <li><a href="{{$fb}}" class="share-social facebook" target="_blank" title="facebook"><i class="fa fa-facebook"></i></a></li>
                                                
                                                <li><a href="{{$tw}}" class="share-social twitter" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                                                <li><a href="{{$pn}}" class="share-social pinterest" target="_blank" title="Pinterest"><i class="fa fa-pinterest-p"></i></a></li>
                                                <li><a href="{{$ln}}" class="share-social linkedin" target="_blank" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
                                            </ul>
                                        </div> --}}
                                    </div>
                                    <div class="align-self-center">
                                        <i class="{{$Deals->varListingIcon}}"></i>
                                        <h3 class="deal-title" title="{{$Deals->varTitle}}">{{$Deals->varTitle}}</h3>
                                        <div class="deal-off">
                                            @if(!empty($Deals->discount_percentage))
                                            <span class="off-big">{{$Deals->discount_percentage}}<span class="light-font">%</span></span>off
                                            @else
                                            <span class="off-big">{{$Deals->discount_fixed}}</span>off
                                            @endif
                                        </div>
                                       <span class="deals-text">
                                            @if(strlen($Deals->varShortDescription) > 115) 
                                            {!!substr(nl2br($Deals->varShortDescription),0, 115).'...'!!}
                                            @else
                                            {!!nl2br($Deals->varShortDescription)!!}
                                            @endif
                                        </span>
                                    </div>
                                    @if(!empty($Deals->varDealsINRPrice) && !empty($Deals->varDealsUSDPrice))
                                            <div class="deal-price d-flex ">
                                                <span class="rupees">{!! Config::get('Constant.sys_currency_symbol') !!}</span>
                                                @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                                <span class="deal-p">{{$Deals->varDealsINRPrice}}</span>
                                                @php } else { @endphp 
                                                <span class="deal-p">{{$Deals->varDealsUSDPrice}}</span>
                                                @php } @endphp 
                                                @php if(isset($Deals->DealsCat) && $Deals->DealsCat=="Domains")
                                                { @endphp
                                                <span class="deal-month align-items-end d-flex">Per Year</span>
                                             @php } else { @endphp-
                                                <span class="deal-month align-items-end d-flex">Per Month</span>
                                             @php } @endphp
                                            </div>

                                            @elseif(!empty($Deals->varDealsINRPrice))
                                            <div class="deal-price d-flex align-items-end deal-price-hosting">
                                            <span>&nbsp;Starts @</span>

                                                <span class="rupees">{!! Config::get('Constant.sys_currency_symbol') !!}</span>
                                                <span class="deal-p "> {{$Deals->varDealsINRPrice}}</span>
                                                @if(strtolower($Deals->varTitle) == strtolower(".COM Domain"))
                                                <span class="deal-month align-items-end d-flex" >/Yr </span>
                                                @else
                                                <span class="deal-month align-items-end d-flex" >/mo </span>
                                                @endif
                                            </div>
                                             @endif
                                             @if($Deals->discount_percentage > 0)
                                            <div class="deal-price d-flex align-items-end deal-price-hosting" style="margin-left:1px; ">
                                                <span>&nbsp;Grab Extra</span>
                                                <span class="deal-p "> {{$Deals->discount_percentage}}%&nbsp;OFF</span>
                                                <span class="deal-month align-items-end d-flex deal-price"> With</span>
                                            </div>
                                             <span class="deal-p-extra-days">15&nbsp;</span>
                                                <span class="deal-extra-days">Days Extra</span>
                                             @endif
                                    <div class="deal-code d-flex">
                                        @if(isset($Deals->varbutton_link) && !empty($Deals->varbutton_link))
                                         <a href="{{ $Deals->varbutton_link }}" class="btn" title="GET THIS DEAL">GET THIS DEAL</a>
                                         @endif
                                        {{-- <a href="javascript:void(0)" class="btn" title="GET THIS DEAL" data-toggle="modal" data-target="#domain_{{$Deals->id}}">GET THIS DEAL</a> --}}
                                         @if(!empty($Deals->varDealsINRPrice) && !empty($Deals->varDealsUSDPrice))
                                        <div class="deal-price d-flex">
                                            <span class="rupees">{!! Config::get('Constant.sys_currency_symbol') !!}</span>
                                            @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                            <span class="deal-p">{{$Deals->varDealsINRPrice}}</span>
                                            @php } else { @endphp 
                                            <span class="deal-p">{{$Deals->varDealsUSDPrice}}</span>
                                            @php } @endphp 
                                            <span class="deal-month align-items-end d-flex">Per Year</span>
                                        </div>
                                         @endif
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade deal-popup" id="domain_{{$Deals->id}}" role="dialog">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            <h2 class="modal-title">Sale Activated!</h2>
                                        </div>
                                        <div class="modal-body">
                                            <div class="deal-body">
                                                {{-- <div class="deal-promo">Copy and paste this code at Checkout.</div> --}}
                                                <div class="promo">
                                                    <form action="{{$cur_url}}" class="custom-input form-group">
                                                        @if(isset($Deals->varbutton_link))
                                                            @if(!empty($Deals->varpromo_code))
                                                            <div class="input-group" id="all_copy_{{$Deals->id}}">
                                                                <input autocomplete="off" readonly="" type="text" value="{{$Deals->varpromo_code}}" id="all_offer_{{$Deals->id}}" class="form-control">
                                                                <p class="link-copy btn all_offer_{{$Deals->id}}" title="Copy" onclick="myFunction('all_offer_{{$Deals->id}}')">Copy</p>
                                                            </div>
                                                            @endif
                                                        {{-- <button onclick="window.location = '{{$Deals->varbutton_link}}';" type="button" title="Grab This Deals Now!" target="_blank" class="btn">Grab This Deals Now!</button> --}}
                                                         <a href="{{ $Deals->varbutton_link }}" title="Grab This Deals Now!" target="_blank" class="btn">Grab This Deals Now!</a>
                                                        @else
                                                        <div class="input-group" id="all_copy_{{$Deals->id}}">
                                                            <input autocomplete="off" readonly="" type="text" value="{{$Deals->varpromo_code}}" id="all_offer_{{$Deals->id}}" class="form-control">
                                                            <p class="link-copy btn all_offer_{{$Deals->id}}" title="Copy" onclick="myFunction('all_offer_{{$Deals->id}}')">Copy</p>
                                                        </div>
                                                        <button onclick="applyPromocode($('#all_offer_{{$Deals->id}}').val(), 'all_offer_{{$Deals->id}}');" type="button" title="Grab This Deals Now!" target="_blank" class="btn">Grab This Deals Now!</button>
                                                        @endif
                                                    </form>
                                                </div>
                                                <div class="deal-discount">
                                                    {{$Deals->varpopup_title}}
                                                </div>
                                                <div class="deal-text">
                                                    @if(strlen($Deals->varShortDescription) > 230) 
                                                    {!!substr(nl2br($Deals->varShortDescription),0, 230)!!}
                                                    @else
                                                    {!!nl2br($Deals->varShortDescription)!!}
                                                    @endif
                                                </div>
                                                @if(!empty($Deals->varProductFeatures))
                                                <?php /*<div class="deal-discount">
                                                    Product Features
                                                </div>*/ ?>
                                                <div class="deal-text">
                                                    {!!nl2br($Deals->varProductFeatures)!!}
                                                </div>
                                                @endif
                                                <div class="offer-end float-center">
                                                    Offer Ends {{date('d-m-Y', strtotime($Deals->dtend_date))}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer flex-column">
                                            <div class="deal-signmail text-center">
                                                <div class="signup-mail-text">Sign up for emails and be the first to know</div>
                                                <div class="mail-textbox">
                                                    <form action="https://hostitsmart.us19.list-manage.com/subscribe/post?u=f6d3566771049dcebe2b276d7&id=0e3eda5761" class="form-group custom-input">
                                                        <div class="input-group">
                                                            <span class="email-sign"></span>
                                                            <input type="text" id="doemailinput_{{$Deals->id}}" placeholder="Email Address" name="EMAIL" class="form-control">
                                                            <button type="submit" onclick="return dovalidation({{$Deals->id}})" id="docheckemail_{{$Deals->id}}" title="Sign Up" class="btn">Sign Up</button>
                                                            <?php
                                                            /*<input type="text" placeholder="Email Address" name="Email Address" class="form-control">
                                                            <button type="submit" title="Sign Up" class="btn">Sign Up</button>*/
                                                            ?>
                                                        </div>
                                                            <span id="doemailvalidationtext_{{$Deals->id}}" class="red"></span>
                                                    </form>
                                                </div>
                                                <div class="deal-terms">
                                                    I agree to the <a href="{{url('/terms')}}" title="Terms of Use">Terms of Use</a> and <a href="{{url('/privacy-policy')}}" title="Privacy Policy">Privacy Policy</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @php $d++; @endphp
                            @endif
                            @endforeach
                            @if($d == 0)
                            <div class="col-12"><div class="no-record"> <i class="no-record-icon"></i><span>No Deals
                            </span></div></div>
                            @endif
                        </div>
                    </div>
                </div>
                <div id="4" class="tab-pane">
                    <div class="deal-boxes">
                        <div class="row">
                            @php $s = 0; @endphp
                            @foreach($DealsData as $Deals)
                            @if($Deals->fkdealscategory_id == 4)
                            @php $date1 = \Carbon\Carbon::parse($Deals->dtend_date)->format('Y-m-d H:i:s'); 
                            $now =  \Carbon\Carbon::now();
                            $datetime1 = new DateTime($date1);
                            $datetime2 = new DateTime($now);
                            $interval = $datetime1->diff($datetime2);
                            $days = $interval->format('%a');
                            $cur_url = Request::fullUrl();
                            $title = $Deals->varTitle;
                            $fb = "https://www.facebook.com/sharer/sharer.php?u=$cur_url&t=$title";
                            $tw = "https://twitter.com/home?status=$title%20$cur_url";
                            $gp = "https://plus.google.com/share?url=$cur_url";
                            $pn = "https://www.pinterest.com/pin/create/button/?url=$cur_url&description=$title";
                            $ln = "http://www.linkedin.com/shareArticle?mini=true&amp;url=$cur_url";
                            @endphp 
                            <div class="col-lg-4 col-sm-6 col-12 d-flex justify-content-center">
                                <div class="deal-box d-flex flex-wrap" data-aos="zoom-inn" data-aos-delay="100">
                                    <div class="deal-head d-flex">
                                        <div class="hot-deals promocode">
                                            {{$Deals->varTagLine}}
                                        </div>
                                        @if($days <= '4')
                                        <div class="ending-soon-div">Ending Soon!</div>
                                        @endif
                                        {{-- <div class="ml-auto deals-share-position">
                                            <a href="javascript:void(0)" class="deals-share" title="Share"><i class="icon-share sprite-deals"></i></a>
                                            <ul class="banner-social">
                                                <li><a href="{{$fb}}" class="share-social facebook" target="_blank" title="facebook"><i class="fa fa-facebook"></i></a></li>
                                                
                                                <li><a href="{{$tw}}" class="share-social twitter" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                                                <li><a href="{{$pn}}" class="share-social pinterest" target="_blank" title="Pinterest"><i class="fa fa-pinterest-p"></i></a></li>
                                                <li><a href="{{$ln}}" class="share-social linkedin" target="_blank" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
                                            </ul>
                                        </div> --}}
                                    </div>
                                    <div class="align-self-center">
                                        <i class="{{$Deals->varListingIcon}}"></i>
                                        <h3 class="deal-title" title="Reseller Hosting">Reseller Hosting</h3>
                                        <div class="deal-off">
                                            @if(!empty($Deals->discount_percentage))
                                            <span class="off-big">{{$Deals->discount_percentage}}<span class="light-font">%</span></span>off
                                            @else
                                            <span class="off-big">{{$Deals->discount_fixed}}</span>off
                                            @endif
                                        </div>
                                       <span class="deals-text">
                                            @if(strlen($Deals->varShortDescription) > 115) 
                                            {!!substr(nl2br($Deals->varShortDescription),0, 115).'...'!!}
                                            @else
                                            {!!nl2br($Deals->varShortDescription)!!}
                                            @endif
                                        </span>
                                    </div>
                                    <div class="deal-code d-flex">
                                        @if(isset($Deals->varbutton_link) && !empty($Deals->varbutton_link))
                                         <a href="{{ $Deals->varbutton_link }}" class="btn" title="GET THIS DEAL">GET THIS DEAL</a>
                                         @endif
                                        {{-- <a href="javascript:void(0)" class="btn" title="GET THIS DEAL" data-toggle="modal" data-target="#website_{{$Deals->id}}">GET THIS DEAL</a> --}}
                                         @if(!empty($Deals->varDealsINRPrice) && !empty($Deals->varDealsUSDPrice))
                                        <div class="deal-price d-flex">
                                            <span class="rupees">{!! Config::get('Constant.sys_currency_symbol') !!}</span>
                                            @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                                            <span class="deal-p">{{$Deals->varDealsINRPrice}}</span>
                                            @php } else { @endphp 
                                            <span class="deal-p">{{$Deals->varDealsUSDPrice}}</span>
                                            @php } @endphp 
                                            <span class="deal-month align-items-end d-flex">Per Month</span>
                                        </div>
                                         @endif
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade deal-popup" id="website_{{$Deals->id}}" role="dialog">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            <h2 class="modal-title">Sale Activated!</h2>
                                        </div>
                                        <div class="modal-body">
                                            <div class="deal-body">
                                                {{-- <div class="deal-promo">Copy and paste this code at Checkout.</div> --}}
                                                <div class="promo">
                                                    <form action="{{$cur_url}}" class="custom-input form-group">
                                                        @if(isset($Deals->varbutton_link))
                                                            @if(!empty($Deals->varpromo_code))
                                                            <div class="input-group" id="all_copy_{{$Deals->id}}">
                                                                <input autocomplete="off" readonly="" type="text" value="{{$Deals->varpromo_code}}" id="all_offer_{{$Deals->id}}" class="form-control">
                                                                <p class="link-copy btn all_offer_{{$Deals->id}}" title="Copy" onclick="myFunction('all_offer_{{$Deals->id}}')">Copy</p>
                                                            </div>
                                                            @endif
                                                        {{-- <button onclick="window.location = '{{$Deals->varbutton_link}}';" type="button" title="Grab This Deals Now!" target="_blank" class="btn">Grab This Deals Now!</button> --}}
                                                         <a href="{{ $Deals->varbutton_link }}" title="Grab This Deals Now!" target="_blank" class="btn">Grab This Deals Now!</a>
                                                        @else
                                                        <div class="input-group" id="all_copy_{{$Deals->id}}">
                                                            <input autocomplete="off" readonly="" type="text" value="{{$Deals->varpromo_code}}" id="all_offer_{{$Deals->id}}" class="form-control">
                                                            <p class="link-copy btn all_offer_{{$Deals->id}}" title="Copy" onclick="myFunction('all_offer_{{$Deals->id}}')">Copy</p>
                                                        </div>
                                                        <button onclick="applyPromocode($('#all_offer_{{$Deals->id}}').val(), 'all_offer_{{$Deals->id}}');" type="button" title="Grab This Deals Now!" target="_blank" class="btn">Grab This Deals Now!</button>
                                                        @endif
                                                    </form>
                                                </div>
                                                <div class="deal-discount">
                                                    {{$Deals->varpopup_title}}
                                                </div>
                                                <div class="deal-text">
                                                    @if(strlen($Deals->varShortDescription) > 230) 
                                                    {!!substr(nl2br($Deals->varShortDescription),0, 230)!!}
                                                    @else
                                                    {!!nl2br($Deals->varShortDescription)!!}
                                                    @endif
                                                </div>
                                                @if(!empty($Deals->varProductFeatures))
                                                <?php /*<div class="deal-discount">
                                                    Product Features
                                                </div>*/ ?>
                                                <div class="deal-text">
                                                    {!!nl2br($Deals->varProductFeatures)!!}
                                                </div>
                                                @endif
                                                <div class="offer-end float-center">
                                                    Offer Ends {{date('d-m-Y', strtotime($Deals->dtend_date))}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer flex-column">
                                            <div class="deal-signmail text-center">
                                                <div class="signup-mail-text">Sign up for emails and be the first to know</div>
                                                <div class="mail-textbox">
                                                    <form action="https://hostitsmart.us19.list-manage.com/subscribe/post?u=f6d3566771049dcebe2b276d7&id=0e3eda5761" class="form-group custom-input">
                                                        <div class="input-group">
                                                            <span class="email-sign"></span>
                                                            <input type="text" id="wsemailinput_{{$Deals->id}}" placeholder="Email Address" name="EMAIL" class="form-control">
                                                            <button type="submit" onclick="return wsvalidation({{$Deals->id}})" id="wscheckemail_{{$Deals->id}}" title="Sign Up" class="btn">Sign Up</button>
                                                            <?php
                                                            /*<input type="text" placeholder="Email Address" name="Email Address" class="form-control">
                                                            <button type="submit" title="Sign Up" class="btn">Sign Up</button>*/
                                                            ?>
                                                        </div>
                                                            <span id="wsemailvalidationtext_{{$Deals->id}}" class="red"></span>
                                                    </form>
                                                </div>
                                                <div class="deal-terms">
                                                    I agree to the <a href="{{url('/terms')}}" title="Terms of Use">Terms of Use</a> and <a href="{{url('/privacy-policy')}}" title="Privacy Policy">Privacy Policy</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @php $s++; @endphp
                            @endif
                            @endforeach
                            @if($s == 0)
                            <div class="col-12"><div class="no-record"> <i class="no-record-icon"></i><span>No Deals
                            </span></div></div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
/*@if(!empty($FaqData) && count($FaqData) >0)
<div class="getquestion-div">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 data-aos="fade-up">Got a Question? We've the Answer!</h3>
            </div>
            <div class="col-12">
                <div id="accordion">
                    @php $i = 0; $class = ''; $class1 = ''; $class2 = ''; $class3 = '';  $class4 = ''; @endphp
                    @foreach($FaqData as $Faq)
                    @php if ($i == '0'){
                    $class = 'true';
                    $class1 = '';
                    $class2 = 'display:block';
                    } else {
                    $class = 'false'; 
                    $class1 = 'collapsed'; 
                    $class2 = 'display:none';
                    } if ($i > '4'){
                    $class3 = 'display:none';
                    $class4 = 'display:block';
                    } else {
                    $class3 = '';
                    $class4 = 'display:none';
                    } @endphp
                    <div class="card" data-aos="fade-up" style="{{$class3}}">
                        <h4 class="mb-0">
                            <button class="btn btn-link {{$class1}}" data-toggle="collapse" data-target="#collapse{{$i}}" aria-expanded="true" aria-controls="collapse{{$i}}">
                                {{$Faq->varTitle}} 
                            </button>
                        </h4>
                        <div id="collapse{{$i}}" class="collapse" data-parent="#accordion" style="{{$class2}}">
                            <div class="card-body">
                                {!! $Faq->txtDescription !!}
                            </div>
                        </div>
                    </div>
                    @php $i++;@endphp
                    @endforeach
                </div>
            </div>
            <div class="col-12 aos-init" data-aos="fade-up" style="{{$class4}}">
                <a href="javascript:;" id="show" title="More" class="more_link">More</a>
            </div>
            <script>
            $("#show").click(function() {
                $(".card").show();
                $("#show").hide();
            });</script>
        </div>
    </div>
</div>
@endif*/
?>
<div class="modal fade deal-popup successmsg" id="SuccessMsg" role="dialog">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <div class="deal-body">
                <div class="deal-promo" id='alertmsg'></div>
                <div class="promo">
                    <a href="{{url('/')}}" class="btn">Buy now</a>
               </div>
            </div>
        </div>
         
    </div>
</div>
</div>

<script>
function validation(id){   
        if($("#emailinput_"+id).val()==""){
            $("#emailvalidationtext_"+id).text("Please enter email address");
            return false;}   
        else{       
             if(/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i.test($("#emailinput_"+id).val())){   
                $("#emailvalidationtext_"+id).text("");
                return true;}
            else{     
                $("#emailvalidationtext_"+id).text("Please enter valid email address");
                return false;}}}

    function webvalidation(id){   
        if($("#webemailinput_"+id).val()==""){
            $("#webemailvalidationtext_"+id).text("Please enter email address");
            return false;}   
        else{       
             if(/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i.test($("#webemailinput_"+id).val())){   
                $("#webemailvalidationtext_"+id).text("");
                return true;}
            else{     
                $("#webemailvalidationtext_"+id).text("Please enter valid email address");
                return false;}}}

     function cmbvalidation(id){   
        if($("#cmbemailinput_"+id).val()==""){
            $("#cmbemailvalidationtext_"+id).text("Please enter email address");
            return false;}   
        else{       
             if(/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i.test($("#cmbemailinput_"+id).val())){   
                $("#cmbemailvalidationtext_"+id).text("");
                return true;}
            else{     
                $("#cmbemailvalidationtext_"+id).text("Please enter valid email address");
                return false;}}}

    function dovalidation(id){   
        if($("#doemailinput_"+id).val()==""){
            $("#doemailvalidationtext_"+id).text("Please enter email address");
            return false;}   
        else{       
             if(/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i.test($("#doemailinput_"+id).val())){
                $("#doemailvalidationtext_"+id).text("");
                return true;}
            else{     
                $("#doemailvalidationtext_"+id).text("Please enter valid email address");
                return false;}}}

    function wsvalidation(id){   
        if($("#wsemailinput_"+id).val()==""){
            $("#wsemailvalidationtext_"+id).text("Please enter email address");
            return false;}   
        else{       
             if(/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i.test($("#wsemailinput_"+id).val())){ 
             $("#wsemailvalidationtext_"+id).text("");  
                return true;}
            else{     
                $("#wsemailvalidationtext_"+id).text("Please enter valid email address");
                return false;}}}
                
function myFunction(val) {
var copyText = document.getElementById(val);
        copyText.select();
        document.execCommand("copy");
        $("." + val).html("Copied");
}
</script>
@php $values = Request::get('id'); @endphp 
@if (!empty($values))
    <script type="text/javascript">
        $(document).ready(function() {
            var values = {{$values}}
            $('#all-offer_'+ values ).modal('show');
        });
       
    </script>

@endif
<script type="text/javascript">
    function applyPromocode(promocode , popupname){
        var promo = promocode;
        if(promo == ''){ alert("Please enter promocode.");return false; }
        var message = "";
        var response1 = null;
        var response2 = null;
        var response3 = null;
        $.ajax({
            async:false,
            url:"{{url('cart/converttowhmcs')}}",
            data:{"_token":"{{ csrf_token() }}"},
            type:"post",
            success:function(res1){
                response1 = res1;
                $.ajax({
                async:false,
                url:"{{Config::get('hitsupdatecart')}}"+"/updatecart.php",
                data:{"poststr":response1},
                type:"post",
                success:function(res2){
                        response2 = res2;
                        $.ajax({
                        async:false,                            
                        url:"{{Config::get('hitsupdatecart')}}"+"/cart.php?a=view",
                        data:{"token":"19a7b0aa888e02da3fcebd2ca4a5b822cdb6fc3e","promocode":promo},
                        type:"post",
                        success:function(res3){
                            var div = $('<div>').attr({"id":"divPromocodeHtml"}).html(res3);
                            message = $(div).find("#scrollingPanelContainer").prev().find('.alert').text();
                            discount = $(div).find("span#discount").text().replace("INR","").replace("USD","").replace("$","").replace(".00","");
                            message = $.trim(message);
                            if(message == 'Promotion Code Accepted! Your order total has been updated.'){
                                message = 'Promocode applied';
                            }
                            if(message == 'The promotion code you entered has been applied to your cart but no items qualify for the discount yet - please check the promotion terms'){
                                message = 'Promocode has been applied but there is no product found in cart. Please click below link to add product.';
                            }
                           updatePromoCode('add',promo,discount,message);  

                           $(".deal-popup").modal("hide");
                           $('#alertmsg').html(message);
                           $('#SuccessMsg').modal('show');
                        }
                        });
                    }
                });
            }
        });
        htmlStr = '<a class="delete-icon" title="remove"><i class="remove-icon"></i></a><span class="promocode">' + promo + '</span><span class="promo-text">'+message+'</span>';
        $(".after-promocode").removeClass('d-done');
        $(".before-apply-promocode").addClass('d-done');
       //$(htmlStr).insertAfter("#txtpromo");
       return message;
    }
      function updatePromoCode(action,promo='',amount='',prmomessage=''){
        var formData = {"_token":"{{ csrf_token() }}","action":action,"promo":promo,"discount":amount,"prmomessage":prmomessage};
        $.ajax({
            async:false,
            beforeSend: function () { showLoader(); },
            url:"{{url('cart/updatepromo')}}",
            data:formData,
            type:"post",
            success:function(response){ hideLoader(); }
        });
    }
</script>
 <script>
     $('html, body').animate({
        scrollTop: $('#deals-main').offset().top
    }, 800);
      
       $(document).ready(function() {
    // Get the current URL
    var currentUrl = window.location.href;

    // Check if the URL includes '#SERVER'
    if (currentUrl.includes('#SERVER')) {
        // Show parent elements with class "deal-box" that have a child with class "s3"
        $('.deal-box:has(.s3)').show();
         $('#alloffer1,#all-deals, #Web-Hosting1, #Combo-Plans1').removeClass('active');
                $('#SERVERS1').addClass('active');
                $('#3').addClass('active');
    }
    else if (currentUrl.includes('#Web-Hosting')) {
        // Show parent elements with class "deal-box" that have a child with class "s3"
        $('.deal-box:has(.s1)').show();
         $('#alloffer1,#all-deals, #Combo-Plans1,#SERVERS1').removeClass('active');
                $('#Web-Hosting1').addClass('active');
                $('#1').addClass('active');
    } else {
        // If the URL does not include '#SERVER', hide all elements with class "deal-box"
        
        $('#alloffer1').addClass('active');
        $('#all-deals').addClass('active');
         $('.deal-box:has(.all-deals)').show();

        // You may add additional logic here if needed
    }

    // Additional logic to handle navigation clicks
    $('.nav-deals a').on('click', function() {
        var dealType = $(this).attr('href');
        $(dealType).addClass('in active').siblings().removeClass('in active');
    });
});


    </script>
@endsection