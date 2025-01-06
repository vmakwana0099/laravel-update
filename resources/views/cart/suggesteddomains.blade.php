<h3 class="eligible-text">Matching Domains Available</h3>
<ul class="domain-detail">
    @foreach($domains as $key => $domain)
                @php
                    $t = str_replace(".","-",$key);
                @endphp
                @if($domain['status'] == 'available') 
    <li class="d-flex">
        <span class="domain-name">{{$key}}</span>
        <form id="suggestedDomainFrm_{{$t}}" name="suggestedDomainFrm_{{$t}}" action="javascript:void(0);">
                    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}"/>
                    <input type="hidden" id="producttype" name="producttype[]" value="domain"/>
                    <input type="hidden" id="domain" name="domain[]" value="{{$key}}"/>
                    <input type="hidden" id="tld" name="tld[]" value=".{{$domain['tld']}}"/>
                    <input type="hidden" id="domaintype" name="domaintype[]" value="register"/>
                    <input type="hidden" id="regperiod" name="regperiod[]" value="1"/>
                </form>
        <span class="domain-right">
            <span class="price-overline d-none d-md-inline-block">
                <span class="rupees">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline">{{$domain['pricing']->wrongprice}}/mo</span>
            </span>
            <span class="original-price">
                <span class="rupees">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{$domain['pricing']->register}}
                <span class="light">/mo</span>
            </span>
            <button class="btn" title="Add" onclick="addMatchingDomain('{{$t}}',this);">Add</button>

        </span>
    </li>
    @endif
@endforeach
</ul>
