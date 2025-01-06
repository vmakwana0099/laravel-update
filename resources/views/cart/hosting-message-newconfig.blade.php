@php $youCanSavePrice=($data['maxselectedsave']-$data['saveamount']); @endphp

@if (isset($data['selectedMax']) && $data['selectedMax']=="true")
<div class="alert-success savings bc-alertmess">
    <i class="fa-regular fa-thumbs-up text-success" aria-hidden="true"></i>
    <strong>Nice!</strong> You have
    {{-- <span><span id="produdct_billing_period">{{ $data['maxDuration']??"" }}</span> months</span> --}}
    @if (!empty($youCanSavePrice) && $youCanSavePrice>0)     
        {{-- <strong>You have saved {!! Config::get('Constant.sys_currency_symbol') !!}<span id="save_amount">{{ $youCanSavePrice }}</span></strong>. --}}
        <strong> saved <span id="save_amount">Max</strong> by choosing</span>
    @else
        <strong> saved <span id="save_amount">{!! Config::get('Constant.sys_currency_symbol') !!}{{ $data['maxselectedsave'] }}</strong> by choosing</span>
    @endif
    <span id="produdct_billing_period">{{ $data['maxDuration']??"" }}</span> Months plan.
</div>
@else
<div class="alert-info savings bc-alertmess">
    <i class="fa fa-info-circle text-info" aria-hidden="true"></i>
    <strong>Want to save more? Get a {!! Config::get('Constant.sys_currency_symbol') !!}<span id="want_to_save_amount">{{ $youCanSavePrice }}</span>
    </strong>
    discount by choosing the <span><span id="want_to_save_billing_cycle_period">{{ $data['maxDuration']??"" }}</span> months Plan</span>!
    {{-- want to save more? get C$48 discount by chooseing 6 months Plan --}}
</div>
@endif