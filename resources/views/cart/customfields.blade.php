<div class="step_box addtitional_service">
  <form id="customfields_{{$key}}" action="#" method="post">
      <input type="hidden" id="ele_key" name="ele_key" value="{{$key}}">
      <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
      @if(!empty($productData['customfields']))
      <table> 
             @foreach($productData['customfields'] as $field) 
              @if($field['fieldtype'] == 'text') 
              <div class="select_plan d-flex align-items-center flex-wrap">
              <label class="name">{{$field['name']}}</label>
                  @include('cart.textbox',['field' => $field]) 
                  @php
                if(!empty($field['required'])){
                  $validationStr[] = " customfield_".$field['id'].": { required: true }";
                  $validationMsgStr[] = " customfield_".$field['id'].": { required: '".$field['description']."' }";
                }
              @endphp
              </div>    
              @endif

              @if($field['fieldtype'] == 'link') 
             <div class="select_plan d-flex align-items-center flex-wrap">
              <label class="name">{{$field['name']}}</label>
                     @include('cart.link',['field' => $field]) 
              </div>       
             @endif

             @if($field['fieldtype'] == 'password') 
             <div class="select_plan d-flex align-items-center flex-wrap">
              <label class="name">{{$field['name']}}</label>
                     @include('cart.password',['field' => $field]) 
                     @php
                if(!empty($field['required'])){
                  $validationStr[] = " customfield_".$field['id'].": { required: true }";
                  $validationMsgStr[] = " customfield_".$field['id'].": { required: '".$field['description']."' }";
                }
              @endphp
              </div>       
             @endif

              @if($field['fieldtype'] == 'dropdown') 
              
              @if($field['id']=='359' || $field['id']=='353' || $field['id']=='358' || $field['id']=='356' || $field['id']=='357' || $field['id']=='372')
                @if ($field['name'] == "Location")
                  <h4 class="c_c_title c_c_blue-title">Server {{$field['name']}}</h4>
                @else
                  <h4 class="c_c_title c_c_blue-title">{{$field['name']}}</h4>
                @endif
                {{-- <div class="c_c_title-desc">Select Your {{$field['name']}}</div> --}}
                 @include('cart.dropdown',['field' => $field]) 
              @else
                <div class="select_plan d-flex align-items-center flex-wrap">
                  @if ($field['name'] == "Location")
                    <label class="name">Server {{$field['name']}}</label>  
                  @else
                    <label class="name">{{$field['name']}}</label>  
                  @endif
                   @include('cart.dropdown',['field' => $field])
                </div> 
              @endif
             @endif

             @if($field['fieldtype'] == 'tickbox') 
             <div class="select_plan d-flex align-items-center flex-wrap">
              <label class="name no-refund">{{$field['name']}}</label>
                     @include('cart.tickbox',['field' => $field]) 
             </div>        
             @endif

             @if($field['fieldtype'] == 'textarea') 
             <div class="select_plan d-flex align-items-center flex-wrap">
              <label class="name">{{$field['name']}}</label>
                     @include('cart.textarea',['field' => $field]) 
             </div>        
             @endif
            @endforeach 
      </table>
      @endif
      </form>
</div>
 <div class="btn_div text-right">
  <a href="javascript:void(0);" id="next_btn_3" class="btn next_btn" title="Save & Confirm" style="display:none;">Save & Confirm</a>
</div>
@php if(isset($validationStr) && !empty($validationStr)){ @endphp
<script type="text/javascript">
  $(function(){
    $("#customfields_{{$key}}").validate({
        errorElement: 'span', //default input error message container
        errorClass: 'error', // default input error message class
        ignore: [],
        rules: { @php echo implode(",",$validationStr); @endphp },
        messages: { @php echo implode(",",$validationMsgStr); @endphp }
      });
  });
</script>
@php } @endphp