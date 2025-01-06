@php

	$options = explode(",",$field['fieldoptions']);

@endphp

 @if($field['id']=='359' || $field['id']=='353' || $field['id']=='358' || $field['id']=='356' || $field['id']=='357' || $field['id']=='372')

<div class="c_c_select-plan c_c_vps_plans">
			<input type="hidden" id="fieldName" value="{{$field['name']}}">
			<div class="c_c_plan-options vps-plan-options">
	@foreach($options as $option)


			<div class="box_radio_label">
				<input type="radio" name="customfield_{{$field['id']}}" value="{{$option}}" id="{{$option}}" onclick="setCustomFieldValue('{{$_REQUEST['id']}}','{{$field['id']}}',this.value);" @if(Session::has('config_loc') && Session::get('config_loc') == $option)
		checked 
		@elseif(isset($field['selectedOption']) && $field['selectedOption'] == $option) 
		checked 
		@endif>
				<label for="{{$option}}" class="radio_options" title="{{$option}}">
				@if($option=="India")
				<img src="{{Config::get('Constant.CDNURL')}}/assets/images/icon_india.png" alt="{{$option}}"/>
				@elseif($option=="USA" || $option=="USA - (Kansas City)" || $option=="USA - (Nevada)")
				<img src="{{Config::get('Constant.CDNURL')}}/assets/images/icon_usa.png" alt="{{$option}}"/>
				@endif
				<span class="desc">{{$option}}</span>

				<span class="extra-text"></span>

				</label>
				</div>

				@endforeach

	</div>
		</div>


 @else

 		<div class="select_box">

<select class="selectpicker customele" id="customfield_{{$field['id']}}" name="customfield_{{$field['id']}}" onchange="setCustomFieldValue('{{$_REQUEST['id']}}','{{$field['id']}}',this.value);">

		@foreach($options as $option)

			<option value="{{$option}}" 
		@if(Session::has('config_loc') && Session::get('config_loc') == $option)
		selected
		@elseif(isset($field['selectedOption']) && $field['selectedOption'] == $option) 
		selected 
		@endif >{{$option}}</option>

		@endforeach
</select>	
</div>
 @endif