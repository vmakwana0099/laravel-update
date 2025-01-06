@if(isset($faqCategory))

<style type="text/css">
    
	.select2-results__option[role=group] ul {
    padding: 0px 0 0px 20px !important;
    font-size: 13px !important;
	}
</style>

<div class="row">
	<div class="col-md-12">
		<div class="form-group @if($errors->first('faqcategory_id')) has-error @endif">
			<label class="form_title" for="faqcategory_id">{{ trans('template.common.selectfaqcategory') }} <span aria-required="true" class="required"> * </span></label>
                        <select id="faqcategory_id" class="form-control" name="faqcategory_id">				
			</select>
			<span class="help-block">
				{{ $errors->first('faqcategory_id') }}
			</span>
		</div>
	</div>
</div>

@section('cat_select2_config')
<script type="text/javascript">
    
$.fn.select2.amd.define('select2/data/customAdapter', ['select2/data/array', 'select2/utils'],
    function (ArrayAdapter, Utils) {
        function CustomDataAdapter ($element, options) {
 	        CustomDataAdapter.__super__.constructor.call(this, $element, options);
        }
        Utils.Extend(CustomDataAdapter, ArrayAdapter);
				CustomDataAdapter.prototype.updateOptions = function (data) {
						this.$element.html('');            
            this.addOptions(this.convertToOptions(data));
        }        
        return CustomDataAdapter;
    }
);
var customAdapter = $.fn.select2.amd.require('select2/data/customAdapter');

var selectedMenu='';
	@php
	$selectedMenu1='';
	if(null !== app('request')->input('category')){
	  $selectedMenu1=app('request')->input('category');
	}else
	{
		$selectedMenu1 = json_encode( isset($data) && $data->fkCategory!=null ? $data->fkCategory : old('faqcategory_id') );
	}
	//$selectedMenu = ($data->txtCategories == null)?[]:$unserialized;
	@endphp

var selectedMenu={!! $selectedMenu1 !!};
var deltypemenu='';
var cat = $.parseJSON('{!! $faqCategory !!}'=='false'?'[{"id":"addCat","text":"Add Category"}]':'{!! $faqCategory !!}');
$(document).ready(function() {
		initSelect2_deal(cat, selectedMenu);		
});
function initSelect2_deal(cat, selectedMenu){
	$.when(   	
   	$("#faqcategory_id").select2({				
				placeholder: "{{ trans('template.common.selectfaqcategory') }}",
				dataAdapter: customAdapter,
				data: cat
		}).on("select2:opening select2:closing", function (e) { 
			//$('.select2-dropdown li[role=group] strong').hide();			
		}).on("change.select2", function(e){
			setSelectedOptions(cat);
		})
	).done(function(){
	  $("#faqcategory_id").select2('val', selectedMenu);
	});	
}


function setSelectedOptions(cat){
	var rootKey;
		var childParentArr=[];
		for(var prop in cat) {		 
		 rootKey = prop;
		 for( var key in cat[rootKey] ) {
			 if(key=='children'){
			 	var obj = cat[rootKey][key];
			 	 $.each(obj, function (i, item) {			 	 	
			 	 	childParentArr[item.text] = item.parentTitle;
			 	 });
			 }
			}
		}

		$('.select2-selection__choice').each(function(){
			var title = $(this).attr('title');			
			if(childParentArr[title]!==undefined){
				var a=$(this).first().contents().filter(function() {
    			return this.nodeType == 3;
				}).replaceWith(childParentArr[title]+'<i class="fa fa-angle-double-right" aria-hidden="true"></i>'+title);				
			}
		});		
}
//Add category dynamically======================================

$('#faqcategory_id').change(function(){	
	$($(this).children('option:checked')).each(function(){			
			if($(this).val()=='addCat'){
				$(this).removeAttr('selected');				
				showAddCat();				
			}
		});
	$('#addCatModal input').val(null);	
});

function showAddCat(){
	$('#addCatModal').modal({
			backdrop: 'static',
			keyboard: false
	});	
}

$('#addCat').click( function() {
		var title = $.trim($('#addCatModal input[name=title]').val());
		var parentCategory = $('#parent_faqcategory_id').val();
		if(parentCategory==""){
				parentCategory = 0;
		}
		if(title.length<1 || title==''){
			$('#addCatModal #catErr').removeClass('hide');
		}else{
			$('#addCatModal #catErr').addClass('hide');
			jQuery.ajax({
					type: "POST",
					url: window.site_url+'/powerpanel/'+$(this).data('module')+'/ajaxCatAdd',
					data: {						
							"varTitle": $('#addCatModal input[name=title]').val(),
							"selectedCat[]": $('#faqcategory_id').val(),
							"parent_faqcategory_id":parentCategory,
					},
					dataType:'json',
					async: false,
					success: function(result) {
						$('#addCatModal').modal('hide');						
						$('#faqcategory_id').data('select2').dataAdapter.updateOptions([null]);
						$('#faqcategory_id').data('select2').dataAdapter.updateOptions($.parseJSON(result.cat));						
						$("#faqcategory_id").select2('val', result.selected);
						$( "#parent_faqcategory_id" ).replaceWith( result.categoriesHtml );
					}
			});
		}
});
$(document).ready(function() {
    	var radioValue = $("input[name='discountType']:checked").val();			
    			if(radioValue == 'Percentage'){
                            $('#Percentage_discount_div').show();
                            $('#Fixed_discount_div').hide();
                        }else{
                                 $('#Percentage_discount_div').hide();
                            $('#Fixed_discount_div').show();
                            
                        }
});
$("input[name='discountType']").click( function(){
  var radioValue = $("input[name='discountType']:checked").val();
     
			if(radioValue == 'Percentage'){
                            $('#Percentage_discount_div').show();
                            $('#Fixed_discount_div').hide();
                        }else{
                            $('#Percentage_discount_div').hide();
                            $('#Fixed_discount_div').show();
                            
                        }
    });

</script>

@endsection
@endif