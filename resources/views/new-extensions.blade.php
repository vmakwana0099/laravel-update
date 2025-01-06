@extends('layouts.app')
@section('content')
@include('layouts.inner_banner')
<div class="domain_offer_section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="cms">
                <h2 class="text-center">Domain Offers</h2>
                <p class="text-center short_content">Enter any domain you'd like to transfer from any register.</p>
            </div>
            </div>
            @foreach($TLDFeatured as $i => $Featured)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="tld_box d-flex justify-content-center align-items-center">
                    <div class="left_part">
                        <span class="upto">UP TO</span>{{$TldOfferFeatured[$i]}}<i class="percent">%</i>
                    </div>
                    <div class="right_part">
                        @php if(Config::get('Constant.sys_currency') == 'INR'){  @endphp 
                            <div class="price">
                                 <i class="rp-icon">&#8377;</i>{{str_replace('.00','',$Featured['INR']['domainregister'])}}<span>Only</span>
                            </div>
                        @php } else { @endphp 
                            <div class="price">
                                <i class="rp-icon">&#36;</i>{{str_replace('.00','',$Featured['USD']['domainregister'])}}<span>Only</span>
                            </div>
                        @php } @endphp 
                        <div class="doman_name">
                            <a href="{{url('/domain')}}/{{$TldAliasFeatured[$i]}}" title=".{{$TLDNameFeatured[$i]}}">.{{$TLDNameFeatured[$i]}}</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<div class="pricing_table_section cms">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center">DOMAIN <span>PRICES</span></h2>
                <span class="short-txt text-center">All Price Per Year</span>
            </div>
            <div class="col-md-12">
                <table class="table-hover">     
                    <tr>
                        <th>EXTENSION</th>
                        <th class="mobile_hide text-center">CATEGORY</th>
                        <th class="text-center">PRICE</th>
                        <th class="mobile_hide text-center">RENEWAL</th>
                        <th class="mobile_hide text-right">TRANSFER</th>
                    </tr>
                    @foreach($ProductData as $k => $Tld)
                    <tr>
                        <td><a href="{{url('/domain')}}/{{$TldAliasName[$k]}}" title=".{{$TldName[$k]}}" class="domain_name"><span>.{{$TldName[$k]}} <i class="la la-long-arrow-right"></i></span></a></td>
                        <td class="mobile_hide text-center">@if(!empty($TldCategory[$k]))
                            @php $i = 1; @endphp
                            @foreach($TldCategory[$k] as $CatName){{$CatName->varTitle}}{{ count($TldCategory[$k]) > $i ? ' |' : ''}} 
                            @php $i++; @endphp
                            @endforeach
                            @endif
                        </td>
                        @php if(Config::get('Constant.sys_currency') == 'INR') {  @endphp 
                            <td class="text-center">
                                @if($Tld['INR']['domainregister'] == 0.00)
                                    {{'N/A'}}
                                @else
                                    <i class="rupees">{!! Config::get('Constant.sys_currency_symbol') !!}</i>{{str_replace('.00','',$Tld['INR']['domainregister'])}}
                                @endif
                            </td>
                            <td class="mobile_hide text-center">
                                @if($Tld['INR']['domainrenew'] == 0.00)
                                    {{'N/A'}}
                                @else
                                <i class="rupees">{!! Config::get('Constant.sys_currency_symbol') !!}</i>{{str_replace('.00','',$Tld['INR']['domainrenew'])}}
                                @endif
                            </td>
                            <td class="mobile_hide text-right">
                                @if($Tld['INR']['domaintransfer'] == 0.00)
                                    {{'N/A'}}
                                @else
                                <i class="rupees">{!! Config::get('Constant.sys_currency_symbol') !!}</i>{{str_replace('.00','',$Tld['INR']['domaintransfer'])}}
                                @endif
                            </td>
                        @php } else { @endphp 
                            <td class="text-center">
                                 @if($Tld['USD']['domainregister'] == 0.00)
                                    {{'N/A'}}
                                @else
                                <i class="rupees">{!! Config::get('Constant.sys_currency_symbol') !!}</i>{{str_replace('.00','',$Tld['USD']['domainregister'])}}
                                @endif
                            </td>
                            
                            <td class="mobile_hide text-center">
                                @if($Tld['USD']['domainrenew'] == 0.00)
                                    {{'N/A'}}
                                @else
                                <i class="rupees">{!! Config::get('Constant.sys_currency_symbol') !!}</i>{{str_replace('.00','',$Tld['USD']['domainrenew'])}}
                                @endif
                            </td>
                            
                            <td class="mobile_hide text-right">
                                  @if($Tld['USD']['domaintransfer'] == 0.00)
                                    {{'N/A'}}
                                @else
                                <i class="rupees">{!! Config::get('Constant.sys_currency_symbol') !!}</i>{{str_replace('.00','',$Tld['USD']['domaintransfer'])}}
                                @endif 
                            </td>
                        @php } @endphp 
                    </tr>
                    @endforeach
                </table>
            </div>
            <div class="col-sm-12">
                <div class="text-center">
                    <ul class="ac-pagination">
                        {{$TLDData->links()}}
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection