<div class="form-group">
<input class="form-control customele" type="text" id="customfield_{{$field['id']}}" name="customfield_{{$field['id']}}" onblur="setCustomFieldValue('{{$key}}','{{$field['id']}}',this.value);" @if(isset($field['selectedOption'])) value="{{$field['selectedOption']}}" @endif/>
</div>