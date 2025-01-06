@if(isset($dealcategories))
<style type="text/css">
	.select2-results__option[role=group] ul {
    padding: 0px 0 0px 20px !important;
    font-size: 13px !important;
	}
</style>
<div class="row">
	<div class="col-md-12">
		<div class="form-group @if($errors->first('dealscategory_id')) has-error @endif">
			<label class="form_title" for="dealscategory_id">{{ trans('template.common.selectdealcategory') }} <span aria-required="true" class="required"> * </span></label>
                        <select id="dealscategory_id" class="form-control" name="dealscategory_id">				
			</select>
			<span class="help-block">
				{{ $errors->first('dealscategory_id') }}
			</span>
		</div>
	</div>
</div>
@section('cat_select2_deal')
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
        $selectedMenu_deal='';
	if(null !== app('request')->input('category')){
	  $selectedMenu1=app('request')->input('category');
	}else
	{
		$selectedMenu1 = json_encode( isset($data) && $data->fkdealscategory_id!=null ? $data->fkdealscategory_id : old('dealscategory_id') );
	}
	//$selectedMenu = ($data->txtCategories == null)?[]:$unserialized;
		$selectedMenu_deal = json_encode( isset($data) && $data->fkdealtype_id!=null ? $data->fkdealtype_id : old('dealscategory_id') );
	@endphp

var selectedMenu={!! $selectedMenu1 !!};
var deltypemenu={!! $selectedMenu_deal !!};
var cat_deal = $.parseJSON('{!! $dealcategories !!}'=='false'?'[{"id":"addCat","text":"Add Category"}]':'{!! $dealcategories !!}');
var DealsType = $.parseJSON('{!! $DealsType !!}'=='false'?'[]':'{!! $DealsType !!}');
$(document).ready(function() {
		initSelect2_deal(cat_deal, selectedMenu);		
                initselect2_dealtype(DealsType,deltypemenu);
});
function initSelect2_deal(cat_deal, selectedMenu){
	$.when(   	
   	$("#dealscategory_id").select2({				
				placeholder: "{{ trans('template.common.selectdealcategory') }}",
				dataAdapter: customAdapter,
				data: cat_deal
		}).on("select2:opening select2:closing", function (e) { 
			//$('.select2-dropdown li[role=group] strong').hide();			
		}).on("change.select2", function(e){
			setSelectedOptions(cat_deal);
		})
	).done(function(){
	  $("#dealscategory_id").select2('val', selectedMenu);
	});	
}
function initselect2_dealtype(cat_deal, selectedMenu){
	$.when(   	
   	$("#dealtype_id").select2({				
				placeholder: "{{ trans('template.dealsModule.selectdealtype') }}",
				dataAdapter: customAdapter,
				data: cat_deal
		}).on("select2:opening select2:closing", function (e) { 
			//$('.select2-dropdown li[role=group] strong').hide();			
		}).on("change.select2", function(e){
			setSelectedOptions(cat_deal);
		})
	).done(function(){
	  $("#dealtype_id").select2('val', selectedMenu);
	});	
}



function setSelectedOptions(cat_deal){
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

$('#dealscategory_id').change(function(){	
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
		var parentCategory = $('#parent_dealscategory_id').val();
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
							"selectedCat[]": $('#dealscategory_id').val(),
							"parent_dealscategory_id":parentCategory,
					},
					dataType:'json',
					async: false,
					success: function(result) {
						$('#addCatModal').modal('hide');						
						$('#dealscategory_id').data('select2').dataAdapter.updateOptions([null]);
						$('#dealscategory_id').data('select2').dataAdapter.updateOptions($.parseJSON(result.cat));						
						$("#dealscategory_id").select2('val', result.selected);
						$( "#parent_dealscategory_id" ).replaceWith( result.categoriesHtml );
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