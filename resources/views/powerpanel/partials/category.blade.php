@if(isset($categories))
<style type="text/css">
	.select2-results__option[role=group] ul {
    padding: 0px 0 0px 20px !important;
    font-size: 13px !important;
	}
</style>
<div class="row">
	<div class="col-md-12">
		<div class="form-group @if($errors->first('category_id')) has-error @endif">
                    
			<label class="form_title" for="category_id">{{ trans('template.common.selectcategory') }} <span aria-required="true" class="required"> * </span></label>
			@if(\Request::segment(2)=='faq')
                        <select id="category_id" class="form-control" name="category_id"  onchange="prod_cat('faq')">				
			</select>
			@elseif(\Request::segment(2)=='deals')
                        <select id="category_id" class="form-control" name="category_id"  onchange="prod_cat('deals')">				
			</select>
                        @elseif(\Request::segment(2)=='testimonial')
                        <select id="category_id" class="form-control" name="category_id"  onchange="prod_cat('testimonial')">				
			</select>
						@elseif(\Request::segment(2)=='careers')
                        <select id="category_id" class="form-control" name="category_id"  onchange="prod_cat('careers')">				
			</select>
                        @elseif(\Request::segment(2)=='products-package')
                        <select id="category_id" class="form-control" name="category_id"  onchange="prod_cat('products-package')">				
			</select>
                          @elseif(\Request::segment(2)=='product-features')
                        <select id="category_id" class="form-control" name="category_id"  onchange="prod_cat('product-features')">				
			</select>
                             @elseif(\Request::segment(2)=='featured-products')
                        <select id="category_id" class="form-control" name="category_id"  onchange="prod_cat('featured-products')">				
			</select>
                        @else
                        <select id="category_id" class="form-control" name="category_id" onchange="prod_cat_alias('products')">				
			</select>
                        @endif
			<span class="help-block">
				{{ $errors->first('category_id') }}
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
		$selectedMenu1 = json_encode( isset($data) && $data->fkProductCategories!=null ? $data->fkProductCategories : old('category_id') );
	}
	//$selectedMenu = ($data->txtCategories == null)?[]:$unserialized;
	@endphp

var selectedMenu_1={!! $selectedMenu1 !!};
var cat = $.parseJSON('{!! $categories !!}'=='false'?'[{"id":"addCat","text":"Add Category"}]':'{!! $categories !!}');
$(document).ready(function() {
		initSelect2(cat, selectedMenu_1);		
});
function initSelect2(cat, selectedMenu){
	$.when(   	
   	$("#category_id").select2({				
				placeholder: "{{ trans('template.common.selectcategory') }}",
				dataAdapter: customAdapter,
				data: cat
		}).on("select2:opening select2:closing", function (e) { 
			//$('.select2-dropdown li[role=group] strong').hide();			
		}).on("change.select2", function(e){
			setSelectedOptions(cat);
		})
	).done(function(){
	  $("#category_id").select2('val', selectedMenu);
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

$('#category_id').change(function(){	
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
var selectedPro='';
	@php
	$selectedPro12='';
        
		$selectedPro12 = json_encode( isset($data) && $data->fkProduct!=null ? $data->fkProduct : old('product_id') );
                
	@endphp
var selectedPro={!! $selectedPro12 !!};
function prod_cat(link){
    
    jQuery.ajax({
                type: "POST",
                url: window.site_url+'/powerpanel/'+link+'/getProductAjax',
                data: {						                              
                                "prod_catval": $('#category_id').val(),                              
                },
                async: false,
                success: function(result) {    
                    if(link == 'deals' ){
                        $('#product_div').show();
                        $("#product_id").select2().empty();
                        $.when($("#product_id").select2({				
                                        placeholder: "{{ trans('template.common.selectproduct') }}",
                                        dataAdapter: customAdapter,
                                        data: result
                        }).on("select2:opening select2:closing", function (e) { 
                                //$('.select2-dropdown li[role=group] strong').hide();			
                        }).on("change.select2", function(e){setSelectedOptions(result);
                        })).done(function(){
                            if(selectedPro != null)
                            $("#product_id").select2('val', selectedPro.split(','));
                        });	
                    }else{
                        $('#product_div').show();
                        $("#product_id").select2().empty();
                        $.when($("#product_id").select2({				
                                        placeholder: "{{ trans('template.common.selectproduct') }}",
                                        dataAdapter: customAdapter,
                                        data: result
                        }).on("select2:opening select2:closing", function (e) { 
                                //$('.select2-dropdown li[role=group] strong').hide();			
                        }).on("change.select2", function(e){setSelectedOptions(result);
                        })).done(function(){
                            $("#product_id").select2('val', selectedPro);
                        });	
                    }
            }
    });
}
function prod_cat_alias(link){
    jQuery.ajax({
                type: "POST",
                url: window.site_url+'/powerpanel/'+link+'/getProductAliasAjax',
                data: {						                              
                                "prod_catval": $('#category_id').val(),                              
                },
                async: false,
                success: function(result) {    
                    if(result !='' && result !='false'){
                        moduleAlias = result;
                        var pro_url = $('.openLink').attr("href");
//                        alert(pro_url);
                        @php
                        $pre_url = url("/");
                        @endphp
                        var pro_url_rep = pro_url.replace("###", moduleAlias);
                        var last_url = "{!! $pre_url !!}/"+pro_url_rep;
//                        alert(last_url);
                        $('.openLink').attr("href",last_url);
                }
            }
    });
}
</script>

@endsection
@endif