<h3 class="eligible-text">Recommended for you</h3>
<div class="recommanded-div">
    <div class="row">
        <div class="recomand-left">
            <div class="recomand-icon">
            </div>
            <div class="recomand-details">
                <h3 class="recomend-title">{{$product['groupname']}} {{"-".$product['productname']}}</h3>
                <ul>
                    @if(!empty($product['features']))
                    @foreach($product['features'] as $feature)
                        <li>{{$feature}}</li>
                    @endforeach
                @endif
                </ul>
            </div>
        </div>
         @php
                $protype = '';
                $recomArr = unserialize(Config::get('producttypesArr'));
                if(isset($recomArr[$product['pid']])){ $protype = $recomArr[$product['pid']];  }
            @endphp
        <div class="recomand-domain-price ml-auto">
            <span class="domain-right">
                <span class="original-price">
                    <span class="rupees">{!! Config::get('Constant.sys_currency_symbol') !!}</span>{{$product['pricing']->price}}
                    <span class="light">/mo</span>
                </span>
                <span class="price-overline">
                    <span class="rupees">{!! Config::get('Constant.sys_currency_symbol') !!}</span><span class="overline">{{$product['pricing']->wrongprice}}/mo</span> 
                </span>
                <button class="btn" title="Add" onclick="addRecommandedProducts('{{$protype}}','{{$product['pid']}}','{{$product['pricing']->durationame}}');">Add</button>
            </span>
        </div>
    </div>
</div>
