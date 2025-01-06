@php $metaInfoRequired = true; @endphp
@if(isset($metaRequired) && $metaRequired==true )
@php $metaInfoRequired = true; @endphp
@elseif(isset($metaRequired) && $metaRequired==false)
@php $metaInfoRequired = false; @endphp
@endif

<h3 class="form-section">{{ trans('template.common.seoinformation') }}</h3>														
<div class="row">
    <div class="col-md-6">	 
        <div class="form-group"> 
            <button type="button" id='auto-generate' class="btn dark btn-outline" onclick="generate_seocontent('@if(!empty($form)){{ $form }}@endif');">{{ trans('template.common.autogenerate') }}</button>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group @if($errors->first('varMetaTitle')) has-error @endif">
            <label class="control-label form_title">{{ trans('template.common.metatitle') }} 
                @if($metaInfoRequired)
                <span aria-required="true" class="required"> * </span>
                @endif
            </label>      

            @if(isset($inf) && isset($inf['varMetaTitle']))
            @php  $metaTitle = $inf['varMetaTitle']  @endphp
            @else
            @php  $metaTitle = null  @endphp
            @endif

            {!! Form::text('varMetaTitle', $metaTitle , array('maxlength'=>'160','class' => 'form-control maxlength-handler','id'=>'varMetaTitle','autocomplete'=>'off','placeholder' => trans('template.common.metatitle'))) !!}
            <!-- <span>Maximum 500 Characters </span> -->
            <span class="help-block">{{ $errors->first('varMetaTitle') }}</span>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group @if($errors->first('varMetaKeyword')) has-error @endif">
            <label class="control-label form_title">{{ trans('template.common.metakeyword') }} 
                @if($metaInfoRequired)
                <span aria-required="true" class="required"> * </span>
                @endif
            </label>
            @if(isset($inf) && isset($inf['varMetaKeyword']))
            @php  $metaKeyword = $inf['varMetaKeyword']  @endphp
            @else
            @php  $metaKeyword = null  @endphp
            @endif

            {!! Form::textarea('varMetaKeyword', $metaKeyword, 
            array(
            'maxlength'=>'500',
            'class' => 'form-control maxlength-handler',      		
            'cols' => '40', 
            'rows' => '3',
            'id' => 'varMetaKeyword','placeholder' => trans('template.common.metakeyword')
            )) 
            !!}
            <!-- <span>Maximum 500 Characters </span> -->
            <span class="help-block">{{ $errors->first('varMetaKeyword') }}</span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group @if($errors->first('varMetaDescription')) has-error @endif">
            <label class="control-label form_title">{{ trans('template.common.metadescription') }} 
                @if($metaInfoRequired)
                <span aria-required="true" class="required"> * </span>
                @endif
            </label>

            @if(isset($inf) && isset($inf['varMetaDescription']))
            @php  $metaDescription = $inf['varMetaDescription']  @endphp
            @else
            @php  $metaDescription = null  @endphp
            @endif

            {!! Form::textarea('varMetaDescription', $metaDescription, 
            array(
            'maxlength'=>'500',
            'class' => 'form-control maxlength-handler',      		
            'cols' => '40', 
            'rows' => '3',
            'id' => 'varMetaDescription',
            'spellcheck' => 'true','placeholder' => trans('template.common.metadescription')
            )) 
            !!}
             <!-- <span>Maximum 500 Characters </span> -->
            <span class="help-block">{{ $errors->first('varMetaDescription') }}</span>
        </div>
    </div>
</div>