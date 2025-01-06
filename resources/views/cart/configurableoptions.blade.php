
  <form id="configfields_{{$key}}" name="configfields_{{$key}}" action="#" method="post">
    <div class="step_box">
       <div class="btn_div text-right">
        All Price (<span class="rupee">{!! Config::get('Constant.sys_currency_symbol') !!} </span>)
    </div>
      @if(!empty($productData['configfields']))
               @foreach($productData['configfields'] as $field)
               <div class="select_plan d-flex align-items-center flex-wrap">
                <label class="name">{{$field['name']}}</label>
                   <div class="select_box">
                      @php
                        $options = $field['options'];
                        $validationStr[] = " configfield_".$field['id'].": { required: true }";
                        $validationMsgStr[] = " configfield_".$field['id'].": { required: 'Please select configuration option.' }";
                      @endphp
                      <select  class="selectpicker configele" id="configfield_{{$field['id']}}" name="configfield_{{$field['id']}}" onchange="setConfigurationFieldValue('{{$key}}','{{$field['id']}}',this.value);">
                        {{--<option value="">--- Select Option ---</option>--}}
                        @foreach($options as $option)
                          <option value="{{$option['id']}}" @if(isset($field['selectedOption']) && $field['selectedOption'] == $option['id']) selected @endif 
                                  @if(Session::get('vps_cpu_select') == $option['id']) selected @endif 
                                  @if(Session::get('vps_ram_select') == $option['id']) selected @endif 
                                  @if(Session::get('vps_hdd_select') == $option['id']) selected @endif 
                                  
                                  >{{$option['name']}} 
                            {{--@if($option['pricing']['setup'][$productData['regperiod']] > 0))
                              Setup Fees: {{$option['pricing']['setup'][$productData['regperiod']]}}    
                            @else   
                              Setup Fees: FREE
                            @endif--}}
                            @if($option['pricing']['price'][$productData['regperiod']] > 0)
                             at {{$option['pricing']['price'][$productData['regperiod']]}}
                            @elseif($option['name'] != "None")   
                              FREE
                            @endif
                        </option>
                        @endforeach
                      </select> 
                    </div>
                  </div>
               @endforeach 
        @endif
    </div>
    <div class="btn_div text-right">
        <a href="javascript:void(0);" id="next_btn_2" class="btn next_btn" title="Next">Next</a>
    </div>
  </form>
<script type="text/javascript">
  $(function(){
    $("#configfields_{{$key}}").validate({
        errorElement: 'span', //default input error message container
        errorClass: 'error', // default input error message class
        ignore: [],
        rules: { @php echo implode(",",$validationStr); @endphp },
        messages: { @php echo implode(",",$validationMsgStr); @endphp }
      });
      //getconfigfinalprice({{$key}});
      //$("#configfield_189").change();

      //Need to add configu option id wise here for realtime calculation
      if($("#configfield_185"))
      { setTimeout(function(){ $("#configfield_185").change();},1000); }
      
      if($("#configfield_186"))
      { setTimeout(function(){ $("#configfield_186").change();},2000); }
      
      if($("#configfield_187"))
      { setTimeout(function(){ $("#configfield_187").change();},3000); }
      
      if($("#configfield_189"))
      { setTimeout(function(){ $("#configfield_189").change();},1000); }
      
      if($("#configfield_190"))
      { setTimeout(function(){ $("#configfield_190").change();},2000); }
      
      if($("#configfield_191"))
      { setTimeout(function(){ $("#configfield_191").change();},3000); }

      if($("#configfield_229"))
      { setTimeout(function(){ $("#configfield_229").change();},1000); }

      if($("#configfield_230"))
      { setTimeout(function(){ $("#configfield_230").change();},2000); }

      if($("#configfield_231"))
      { setTimeout(function(){ $("#configfield_231").change();},2000); }

    
       if($("#configfield_238")){ setTimeout(function(){ $("#configfield_238").parent().parent().parent().find(".name,.select_box").hide(); },3000);  }
      
      
      
      //$("#configfield_191").change();
  });
  
</script>