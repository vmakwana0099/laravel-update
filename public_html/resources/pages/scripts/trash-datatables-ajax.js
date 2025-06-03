var lmTable;
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

				grid.init({
						src: $("#datatable_ajax"),
						onSuccess: function (grid, response) {
if(response.recordsTotal<1){$('.deleteMass').hide();}else{$('.deleteMass').show();}
							if(response.recordsTotal<1){
								$('.deleteMass').hide();
								$('.restoreMass').hide();
							}else{
								$('.deleteMass').show();
								$('.restoreMass').show();
							}
						},
						onError: function (grid) {
						},
						onDataLoad: function(grid) {
						},
						loadingMessage: 'Loading...',
						dataTable: {
								"bStateSave": false, // save datatable state(pagination, sort, etc) in cookie.
								"lengthMenu": [
										[10, 20, 50, 100, 150, -1],
										[10, 20, 50, 100, 150, "All"] // change per page values here
								],
								"pageLength": 10, // default record count per page
								//Code for sorting
								"serverSide": true,
								"columns": [
									{"data": 0, className:'text-center',"bSortable":false},
									{"data": 1, className:'text-left',"bSortable":false},
									{"data": 2, className:'text-center',"bSortable":false}
								],
								"ajax": {
										"url": window.site_url+"/powerpanel/trash/init", // ajax source
								},
								'fnCreatedRow': function (nRow, aData, iDataIndex) {
									//console.log(aData);
									$(nRow).attr('id', aData[2]);
								},
								"order": [
									[1, "desc"]
								]// set first column as a default sort by asc
								

						}
				});

				// handle group actionsubmit button click
				grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
						e.preventDefault();
						var action = $(".table-group-action-input", grid.getTableWrapper());
						if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
								grid.setAjaxParam("customActionType", "group_action");
								grid.setAjaxParam("customActionName", action.val());
								grid.setAjaxParam("id", grid.getSelectedRows());
								grid.getDataTable().ajax.reload();
								grid.clearAjaxParams();
						} else if (action.val() == "") {
								App.alert({
										type: 'danger',
										icon: 'warning',
										message: 'Please select an action',
										container: grid.getTableWrapper(),
										place: 'prepend'
								});
						} else if (grid.getSelectedRowsCount() === 0) {
								App.alert({
										type: 'danger',
										icon: 'warning',
										message: 'No record selected',
										container: grid.getTableWrapper(),
										place: 'prepend'
								});
						}
				});

				grid.setAjaxParam("customActionType", "group_action");
				// grid.getDataTable().ajax.reload();					
				grid.clearAjaxParams();				

				lmTable = grid;
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

	$('#moduleFilter').change(function(){			
		if( $(this).val().length > 1 )
		{
			var url = window.site_url+$(this).val();
			lmTable.getDataTable().ajax.url(url);			
			lmTable.getDataTable().ajax.reload();				
		}
	});
});