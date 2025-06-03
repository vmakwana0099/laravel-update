var gridRows=0;
var grid;
var TableDatatablesAjax = function () {
	var initPickers = function () {				
	}
	var handleRecords = function () {			
			var action = $('#category_id').val();
			grid = new Datatable();		
			grid.setAjaxParam("catValue", action);
			grid.init({
			src: $("#datatable_ajax"),
			onSuccess: function (grid, response) {
				gridRows=response.recordsTotal;
				if(response.recordsTotal<1){$('.deleteMass').hide();}else{$('.deleteMass').show();}
				// grid:        grid object
				// response:    json object of server side ajax response
				// execute some code after table records loaded
			},
			onError: function (grid) {
				// execute some code on network or other general error  
			},
			onDataLoad: function(grid) {
				// execute some code on ajax data load
				// var sortCol=grid.getDataTable().order()[0][0];
				// var sort=grid.getDataTable().order()[0][1];
				// if(sort=='asc' && sortCol == 6){								
				// 	grid.getDataTable().column(0).visible( true );
				// }else{								
				// 	grid.getDataTable().column(0).visible( false );
				// 	grid.getDataTable().rows().remove();
				// }
			},
			loadingMessage: 'Loading...',
			dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options 
				// Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
				// setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
				// So when dropdowns used the scrollable div should be removed. 
				//"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
				"bStateSave": false, // save datatable state(pagination, sort, etc) in cookie.
				"lengthMenu": [
					[10, 20, 50, 100, 150, -1],
					[10, 20, 50, 100, 150, "All"] // change per page values here
				],
				"pageLength": 10, // default record count per page
				//Code for sorting
				"serverSide": true,
				"columns": [
					{"data": 0, className: 'reorder text-center', "bSortable":false},
					{"data": 1, "bSortable":false, className: 'text-center'},
					{"data": 2, "bSortable":false, className: 'text-center'},
					{"data": 3, "bSortable":false, className: 'text-center'},
					{"data": 4, "name":'varTitle', className: 'text-left'},
					{"data": 5, "name":'intParentCategoryId', className: 'text-left'},
					{"data": 6, "name":'intDisplayOrder', className: 'text-center'},
					{"data": 7, className: 'text-center'},
					{"data": 8, "bSortable":false, className: 'text-right'}
				],

				"sDom": "Ttfrip",
				"oTreeTable": {
					"fnPreInit": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
					// This function will be registerd as "aoRowCallback" of jquery.dataTables,
					//  thus it has the same signature as "fnRowCallback".
					// Specify "id" & "class" attributes for each row (TR) required by jquery.treeTable:
					//   for parent rows, add class 'parent';
					//   for children rows, add a class with name of prefix - 'child-of-' and parent id

					},
					"showExpander": true,
				// The other settings to override the default options of jquery.treeTable, e.g. chil
				},

				"columnDefs": [{
					"targets": [ 2,3 ],
					"visible": false,
					"searchable": false
				}],
				"ajax": {
					"url": window.site_url+"/powerpanel/service-category/get_list", // ajax source
				},                
				'fnCreatedRow': function (nRow, aData, iDataIndex) {					
					$(nRow).attr('id', aData[2]);
					$(nRow).addClass('parent');
					if(aData[3]>0){						
						$(nRow).addClass('child-of-'+aData[3]);
					}				
				},          
				"order": [
					[6, "desc"]
				]
			}
		});
		$(document).on('change', '#statusfilter', function (e) {
			e.preventDefault();
			var action = $('#statusfilter').val();
			if (action != " ") {
				//$.cookie('ServiceCategoryStatus',action);
			} else {
				//$.removeCookie('ServiceCategoryStatus');
			}	
			if (action != "") {
				grid.setAjaxParam("customActionType", "group_action");
				grid.setAjaxParam("statusValue", action);
				grid.setAjaxParam("id", grid.getSelectedRows());
				grid.getDataTable().ajax.reload();
			} else {
				grid.setAjaxParam("customActionType", "group_action");
				grid.setAjaxParam("statusValue", action);
				grid.setAjaxParam("id", grid.getSelectedRows());
			}
		});
		$(document).on('click','.publish', function(e){
			e.preventDefault();
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
					grid.getDataTable().ajax.reload();
				},
				error: function() {
					console.log('error!');
				}                                 
			});		   
		});
		$(document).on('keyup', '#searchfilter', function (e) {
			e.preventDefault();
			var action = $('#searchfilter').val();
			if (action.length>=2) {				
				//$.cookie('ServiceCategorySearch',action);				
				grid.setAjaxParam("customActionType", "group_action");
				grid.setAjaxParam("searchValue", action);
				grid.setAjaxParam("id", grid.getSelectedRows());
				grid.getDataTable().ajax.reload();
			} else if(action.length<1) {
				//$.removeCookie('ServiceCategorySearch');
				grid.setAjaxParam("customActionType", "group_action");
				grid.setAjaxParam("searchValue", action);
				grid.setAjaxParam("id", grid.getSelectedRows());
				grid.getDataTable().ajax.reload();
			}
		});
		
		grid.setAjaxParam("customActionType", "group_action");
		// grid.getDataTable().ajax.reload();
		grid.clearAjaxParams();
	}
	return {
		//main function to initiate the module
		init: function () {
			initPickers();
			handleRecords();
		}
	};
}();

jQuery(document).ready(function() {
	
	$.ajaxSetup({
		headers: {
			'X-CSRF-Token': $('input[name="_token"]').val()
		}
	});
	TableDatatablesAjax.init(); 
	
});

$('#datatable_ajax').on('row-reorder.dt', function ( e, diff, edit ) {
	 setTimeout(function() {			
			var currentPg = $('.pagination-panel-input').val();
			var range = $( "select[name=datatable_ajax_length]" ).val();
			var offset; 
			var swapArr={};

			$('#datatable_ajax').find('tbody').find('tr').each(function(i,r){            
						var id=$(r)[0]['id'];
						offset = ((currentPg*range)+i)-range;
						swapArr[id] = offset;
				});
			reorder(swapArr);
		 }, 1000);
		
	});

function reorder(swapArr)
{
	var ajaxurl =site_url+'/powerpanel/service-category/reorder';
	$.ajax({
			url: ajaxurl,
			data: { order:swapArr },
			type: "POST",
			dataType: "HTML",
			success: function(data) {
				grid.getDataTable().ajax.reload( null, false );
			},
			error: function() {
					console.log('error!');
			}
	});
}