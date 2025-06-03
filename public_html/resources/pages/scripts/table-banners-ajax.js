var gridRows=0;
var grid;
var TableDatatablesAjax = function () {
	var handleRecords = function () {
			grid = new Datatable();
			grid.init({
				src: $("#banners_datatable_ajax"),
				onSuccess: function (grid, response) {
					gridRows=response.recordsTotal;
					if(response.recordsTotal<1){$('.deleteMass').hide();}else{$('.deleteMass').show();}
					
				},
				onError: function (grid) {
					// execute some code on network or other general error  
				},
				onDataLoad: function(grid) {
					if($('.pagination-panel .prev').hasClass('disabled')){									
							$("#banners_datatable_ajax tbody tr:first").find('.moveUp').hide();
					}
					if($('.pagination-panel .next').hasClass('disabled')){
							$("#banners_datatable_ajax tbody tr:last").find('.moveDwn').hide();
					}

					$('.make-switch').bootstrapSwitch();
				},
				loadingMessage: 'Loading...',
				dataTable: { 
					"deferRender": true,
					"stateSave": true, // save datatable state(pagination, sort, etc) in cookie.
					"lengthMenu": [
						[10, 20, 50, 100],
						[10, 20, 50, 100] // change per page values here
					],
					"pageLength": 10, // default record count per page
					//Code for sorting 
					"serverSide": true,
					"columns": [
						{"data": 0, className: 'td_checker', 'bSortable': false},
						{"data": 1, 'name': 'varTitle',className: 'text-left'},
						{"data": 2, 'bSortable': false,className: 'text-center'},						
						{"data": 3, 'bSortable': false,className: 'text-center'},
						{"data": 4, 'name' : 'varBannerType',className: 'text-center'},
						{"data": 5, className: 'text-center','name': 'intDisplayOrder'},
						{"data": 6, 'bSortable' : false,className: 'text-center publish_switch'},
						{"data": 7, 'bSortable' : false,className: 'text-right'},
						{"data": 8, 'bSortable' : false}
					],
					"columnDefs": [{
						"targets": [ 8 ],
						"visible": false,
						"searchable": false
					}],
					"ajax": {
						"url": window.site_url+"/powerpanel/banners/get_list", // ajax source
					},                
					'fnCreatedRow': function (nRow, aData, iDataIndex) {						
						$(nRow).attr('data-order', aData[8]);
					},
					"order": [
						[5, "desc"]
					]
				}
			});


			$('#banners_datatable_ajax tbody').on( 'click', '.moveDwn', function () {
						var order = $(this).data('order');
						var exOrder = $('#banners_datatable_ajax tbody').find('tr[data-order='+order+']').next().data('order');
						exOrder = (exOrder==undefined)?order+1:exOrder;
						reorder(order, exOrder);
					} );

				$('#banners_datatable_ajax tbody').on( 'click', '.moveUp', function () {
						var order = $(this).data('order');
						var exOrder = $('#banners_datatable_ajax tbody').find('tr[data-order='+order+']').prev().data('order');
						exOrder = (exOrder==undefined)?order-1:exOrder;
						reorder(order, exOrder);
				});


			/*********/
			$(document).on('change','#bannerFilter',function (e) {
				e.preventDefault();
				var action = $(this).val();
				
				if (action != "") {
					grid.setAjaxParam("customActionType", "group_action");
					grid.setAjaxParam("bannerFilter", action);
					grid.setAjaxParam("id", grid.getSelectedRows());
					grid.getDataTable().ajax.reload();
				} else {
					grid.setAjaxParam("customActionType", "group_action");
					grid.setAjaxParam("bannerFilter", action);
					grid.setAjaxParam("id", grid.getSelectedRows());
				}
			});
			/*********/

		//This code for search filter
		$(document).on('keyup', '#searchfilter', function (e) {
			e.preventDefault();
			var action = $('#searchfilter').val();
			if (action.length>=2) {
				
				grid.setAjaxParam("customActionType", "group_action");
				grid.setAjaxParam("searchValue", action);
				grid.setAjaxParam("id", grid.getSelectedRows());
				grid.getDataTable().ajax.reload();
			} else if(action.length<1) {
				
				grid.setAjaxParam("customActionType", "group_action");
				grid.setAjaxParam("searchValue", action);
				grid.setAjaxParam("id", grid.getSelectedRows());
				grid.getDataTable().ajax.reload();
			}
		});
		$(document).on('change', '#statusfilter', function (e) {
			e.preventDefault();
			var action = $('#statusfilter').val();
		if (action != "") {
			grid.setAjaxParam("customActionType", "group_action");
			grid.setAjaxParam("customActionName", action);
			grid.setAjaxParam("id", grid.getSelectedRows());
			grid.getDataTable().ajax.reload();
		} else {
			grid.setAjaxParam("customActionType", "group_action");
			grid.setAjaxParam("customActionName", action);
			grid.setAjaxParam("id", grid.getSelectedRows());
		}
	});

		$(document).on('change', '#bannerFilterType', function (e) {
				e.preventDefault();
				var action = $('#bannerFilterType').val();
			if (action != "") {
				grid.setAjaxParam("customActionType", "group_action");
				grid.setAjaxParam("bannerFilterType", action);
				grid.setAjaxParam("id", grid.getSelectedRows());
				grid.getDataTable().ajax.reload();
			} else {
				grid.setAjaxParam("customActionType", "group_action");
				grid.setAjaxParam("customActionName", action);
				grid.setAjaxParam("id", grid.getSelectedRows());
			}
		});
	$(document).on('change','#pageFilter',function (e) {
		e.preventDefault();
		var action = $(this).val();
		
		if (action != "") {
			grid.setAjaxParam("customActionType", "group_action");
			grid.setAjaxParam("pageFilter", action);
			grid.setAjaxParam("id", grid.getSelectedRows());
			grid.getDataTable().ajax.reload();
		} else {
			grid.setAjaxParam("customActionType", "group_action");
			grid.setAjaxParam("pageFilter", action);
			grid.setAjaxParam("id", grid.getSelectedRows());
		}
	});
		$(document).on("switchChange.bootstrapSwitch",".publish",function(event, state){
			//e.preventDefault();
			var controller = $(this).data('controller');
			var alias = $(this).data('alias');
			var val = $(this).data('value');
			var url = site_url+'/'+controller+'/publish';
			$.ajax({
				url: url,
				data: { alias:alias, val:val},
				type: "POST",         
				dataType: "HTML",        
				success: function(data) {
					grid.getDataTable().ajax.reload(null,false);
				},
				error: function() {
					console.log('error!');
				}                                 
			});      
		});
		$(document).on('click','.defaultBanner', function(e){
			e.preventDefault();
			var controller = $(this).data('controller');
			var alias = $(this).data('alias');
			var val = $(this).data('value');
			var url = site_url+'/'+controller+'/makeDefault';
			$.ajax({
				url: url,
				data: { alias:alias, val:val},
				type: "POST",         
				dataType: "HTML",        
				success: function(data) {
					grid.getDataTable().ajax.reload();
				},
				error: function() {
					console.log('error!');
				}                                 
			});      
		});
		grid.setAjaxParam("customActionType", "group_action");
		grid.clearAjaxParams();
		grid.getDataTable().columns().iterator('column', function(ctx, idx) {
			$(grid.getDataTable().column(idx).header()).append('<span class="sort-icon"/>');
		});
	}
	return {
		//main function to initiate the module
		init: function () {
			handleRecords();
		}
	};
}();
jQuery(document).ready(function() {
	
	$.ajaxSetup({
		headers:{
			'X-CSRF-Token': $('input[name="_token"]').val()
		}
	});
	TableDatatablesAjax.init();
}); 


function reorder(curOrder, excOrder)
{	
	var ajaxurl =site_url+'/powerpanel/banners/reorder';
	$.ajax({
			url: ajaxurl,
			data: { order:curOrder , exOrder:excOrder },
			type: "POST",
			dataType: "HTML",
			success: function(data) {
			},
			complete:function() {				
				grid.getDataTable().ajax.reload( null, false );
			},
			error: function() {
					console.log('error!');
			}
	});
}