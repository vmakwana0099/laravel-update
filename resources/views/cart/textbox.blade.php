<div class="form-group">
	@if($field['id'] == 'hostname')
	<input class="form-control customele" type="text" id="customfield_{{$field['id']}}" name="customfield_{{$field['id']}}" @if(isset($field['selectedOption'])) value="{{$productData['producttype']}}.{{date("YmdHis")}}.hostitsmart.com" @endif/>
	@else
	<input class="form-control customele" type="text" id="customfield_{{$field['id']}}" name="customfield_{{$field['id']}}" onblur="setCustomFieldValue('{{$key}}','{{$field['id']}}',this.value);" @if(isset($field['selectedOption'])) value="{{$field['selectedOption']}}" @endif/>
	@endif

</div>
 
