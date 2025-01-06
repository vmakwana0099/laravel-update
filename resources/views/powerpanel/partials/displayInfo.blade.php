<div class="form-group">
       <!--  <label class="control-label form_title">{{ trans('template.display') }} <span aria-required="true" class="required"> * </span> </label> -->
    <label class="form_title" for="site_name">Publish/ Unpublish <span aria-required="true" class="required"> * </span></label>
    <div class="md-radio-inline">
        <div class="md-radio">
            @if ((isset($display) && $display == 'Y') || (null == Input::old('chrMenuDisplay') || Input::old('chrMenuDisplay') == 'Y'))
            @php  $checked_yes = 'checked'  @endphp
            @else
            @php  $checked_yes = ''  @endphp
            @endif     
            <input class="md-radiobtn" type="radio" value="Y" name="chrMenuDisplay" id="chrMenuDisplay0" {{ $checked_yes }}> 

            @if (Request::segment(2)=='users') 
            <label for="chrMenuDisplay0"> <span></span> <span class="check"></span> <span class="box"></span> {{ trans('template.common.activate') }}  </label>
            @else
            <label for="chrMenuDisplay0"> <span></span> <span class="check"></span> <span class="box"></span> {{ trans('template.common.publish') }} </label>
            @endif
        </div>
         @if (Request::segment(2)!='contact-info') 
        <div class="md-radio">               
            @if ((isset($display) && $display == 'N') || Input::old('chrMenuDisplay') == 'N')
            @php  $checked_no = 'checked'  @endphp
            @else 
            @php  $checked_no = ''  @endphp
            @endif     
            <input class="md-radiobtn" type="radio" value="N" name="chrMenuDisplay" id="chrMenuDisplay1" {{  $checked_no }}>

            @if (Request::segment(2)=='users') 
            <label for="chrMenuDisplay1"> <span></span> <span class="check"></span> <span class="box"></span>  {{ trans('template.common.deactivate') }} </label>
            @else
            <label for="chrMenuDisplay1"> <span></span> <span class="check"></span> <span class="box"></span> {{ trans('template.common.unpublish') }} </label>
            @endif

        </div>
          @endif
        <span class="help-block">
            <strong>{{ $errors->first('chrMenuDisplay') }}</strong>
        </span>
        <div id="frmmail_membership_error">
        </div>
    </div>
</div>   