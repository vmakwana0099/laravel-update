var TableDatatablesAjax = function () {
	var initPickers = function () {
		//init date pickers
		$('.date-picker').datepicker({
			rtl: App.isRTL(),
			autoclose: true
		});
	}
	var handleRecords = function () {
		var grid = new Datatable();
		var ip='';
		var totalRec;
		grid.init({
			src: $("#datatable_ajax"),
			onSuccess: function (grid, response) {
				if(response.recordsTotal<1){$('.deleteMass').hide();}else{$('.deleteMass').show();}
				if(response.recordsTotal<1){$('.ExportRecord').hide();}else{$('.ExportRecord').show();}
				
				// grid:        grid object
				// response:    json object of server side ajax response
				// execute some code after table records loaded		
				// get all typeable inputs		
				totalRec = response.recordsTotal;
			},
			onError: function (grid) {
				// execute some code on network or other general error
			},
			onDataLoad: function(grid) {
				// execute some code on ajax data load
			},
			loadingMessage: 'Loading...',
			dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options
				// Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
				// setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js).
				// So when dropdowns used the scrollable div should be removed.
				//"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
				"bStateSave": false, // save datatable state(pagination, sort, etc) in cookie.
				"lengthMenu": [
					[10, 20, 50, 100],
					[10, 20, 50, 100] // change per page values here
				],
				"pageLength": 10, // default record count per page
				//Code for sorting
				"serverSide": true,
				"columns": [
					{"data": 0, className: 'td_checker',"bSortable":false},
					{"data": 1, className: 'text-left',"name":'name',"bSortable":false},
					{"data": 2, className: 'text-left',"name":'email',"bSortable":false},
					{"data": 3, className: 'text-center',"name":'varIpAddress'},
					{"data": 4, className: 'text-center',"name":'created_at'},
					{"data": 5, className: 'text-center',"name":'updated_at'},
				],
				"ajax": {
					"url": window.site_url+"/powerpanel/login-history/get_list", // ajax source
				},
				"order": [
					[4, "desc"]
				]// set first column as a default sort by asc
			}
		});
		$(document).on('keyup', '#searchfilter', function (e) {
			e.preventDefault();
			var action = $('#searchfilter').val();
			if (action.length>=2) {				
				//$.cookie('ContactLeadsearch',action);				
				grid.setAjaxParam("customActionType", "group_action");
				grid.setAjaxParam("searchValue", action);
				grid.setAjaxParam("id", grid.getSelectedRows());
				grid.getDataTable().ajax.reload();
			} else if(action.length<1) {
				//$.removeCookie('ContactLeadsearch');
				grid.setAjaxParam("customActionType", "group_action");
				grid.setAjaxParam("searchValue", action);
				grid.setAjaxParam("id", grid.getSelectedRows());
				grid.getDataTable().ajax.reload();
			}
		});
		grid.setAjaxParam("customActionType", "group_action");
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