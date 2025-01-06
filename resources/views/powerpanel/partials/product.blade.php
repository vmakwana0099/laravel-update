@if(isset($ProductCombo))

<style type="text/css">
	.select2-results__option[role=group] ul {
    padding: 0px 0 0px 20px !important;
    font-size: 13px !important;
	}
</style>
<div class="row">
	<div class="col-md-12">
		<div class="form-group @if($errors->first('product_id')) has-error @endif">
			<label class="form_title" for="product_id">{{ trans('template.common.selectproduct') }} <span aria-required="true" class="required"> * </span></label>
			<select id="product_id" class="form-control" name="product_id">				
			</select>
			<span class="help-block">
				{{ $errors->first('product_id') }}
			</span>
		</div>
	</div>
</div>
@section('cat_select3_config')
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

var selectedMenu3='';
	@php
	$selectedMenu2='';
	if(null !== app('request')->input('category')){
	  $selectedMenu2=app('request')->input('category');
	}else
	{
		$selectedMenu2 = json_encode( isset($data) && $data->fkProduct!=null ? $data->fkProduct : old('product_id') );
	}
	//$selectedMenu = ($data->txtCategories == null)?[]:$unserialized;
	@endphp

var selectedMenu3={!! $selectedMenu2 !!};
var cat2 = $.parseJSON('{!! $ProductCombo !!}'=='false'?'[{"id":"addCat","text":"Add Category"}]':'{!! $ProductCombo !!}');

$(document).ready(function() {
		initSelect3(cat2, selectedMenu3);		
});
function initSelect3(cat2, selectedMenu3){
	$.when(   	
   	$("#product_id").select2({				
				placeholder: "{{ trans('template.common.selectproduct') }}",
				dataAdapter: customAdapter,
				data: cat2
		}).on("select2:opening select2:closing", function (e) { 
			//$('.select2-dropdown li[role=group] strong').hide();			
		}).on("change.select2", function(e){
			setSelectedOptions(cat2);
		})
	).done(function(){
	  $("#product_id").select2('val', selectedMenu3);
	});	
}



function setSelectedOptions(cat2){
	var rootKey;
		var childParentArr=[];
		for(var prop in cat2) {		 
		 rootKey = prop;
		 for( var key in cat2[rootKey] ) {
			 if(key=='children'){
			 	var obj = cat2[rootKey][key];
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

$('#product_id').change(function(){	
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
		var parentCategory = $('#parent_category_id').val();
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
							"selectedCat[]": $('#category_id').val(),
							"parent_category_id":parentCategory,
					},
					dataType:'json',
					async: false,
					success: function(result) {
						$('#addCatModal').modal('hide');						
						$('#category_id').data('select2').dataAdapter.updateOptions([null]);
						$('#category_id').data('select2').dataAdapter.updateOptions($.parseJSON(result.cat));						
						$("#category_id").select2('val', result.selected);
						$( "#parent_category_id" ).replaceWith( result.categoriesHtml );
					}
			});
		}
});
</script>

@endsection
@endif