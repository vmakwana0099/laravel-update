<div class="check_box">
          <label class="custom-radio">
             <input type="checkbox" class="customele" id="customfield_{{$field['id']}}" name="customfield_{{$field['id']}}" value="{{$field['id']}}" 
@if(isset($field['selectedOption']) &&  $field['selectedOption'] == 'true') checked @endif
onclick="setCustomFieldValue('{{$key}}','{{$field['id']}}',($(this).is(':checked')?true:false));"/>
              <span class="checkmark"></span> I will manage my own server </label>
</div>
