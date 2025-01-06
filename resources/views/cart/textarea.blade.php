<div class="form-group">
<textarea class="form-control customele" id="customfield_{{$field['id']}}" name="customfield_{{$field['id']}}" onblur="setCustomFieldValue('{{$key}}','{{$field['id']}}',this.value);">@if(isset($field['selectedOption'])) {{$field['selectedOption']}} @endif</textarea>
</div>