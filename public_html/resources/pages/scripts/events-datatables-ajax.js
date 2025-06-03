var gridRows = 0;
var grid;
var TableDatatablesAjax = function() {
		var initPickers = function() {
				// $('.date-picker').datepicker({
				// 		rtl: App.isRTL(),
				// 		autoclose: true
				// });
		}
		var handleRecords = function() {

				var cols = [{
										"data": 0,
										"bSortable": false
								}, {
										"data": 1,
										className: 'text-left',
										"name": 'varTitle'
								}, {
										"data": 2,
										className: 'text-center',
										"bSortable": false
								}, {
										"data": 3,
										className: 'text-center',
										"name": 'dtStartDateTime'
								}, {
										"data": 4,
										className: 'text-center',
										"name": 'dtEndDateTime'
								}, {
										"data": 5,
										className: 'text-center',
										"name": 'intDisplayOrder'
								}, {
										"data": 6,
										className: 'text-center',
										"bSortable": false
								}, {
										"data": 7,
										className: 'text-center publish_switch',
										"bSortable": false
								}, {
										"data": 8,
										className: 'text-center',
										"bSortable": false
								},{
										"data": 9,
										className: 'text-center',
										"bSortable": false
								}];

				var action = $('#category_id').val();
				grid = new Datatable();
				grid.setAjaxParam("catValue", action);
				grid.init({
						src: $("#datatable_ajax"),
						onSuccess: function(grid, response) {
								gridRows = response.recordsTotal;
								if (response.recordsTotal < 1) {
										$('.deleteMass').hide();
								} else {
										$('.deleteMass').show();
								}
						},
						onError: function(grid) {},
						onDataLoad: function(grid) {
								if ($('.pagination-panel .prev').hasClass('disabled')) {
										$("#datatable_ajax tbody tr:first").find('.moveUp').hide();
								}
								if ($('.pagination-panel .next').hasClass('disabled')) {
										$("#datatable_ajax tbody tr:last").find('.moveDwn').hide();
								}
								$('.make-switch').bootstrapSwitch();
						},
						loadingMessage: 'Loading...',
						dataTable: {
								"deferRender": true,
								"stateSave": true, // save datatable state(pagination, sort, etc) in cookie.
								"lengthMenu": [
										[10, 20, 50, 100],
										[10, 20, 50, 100]
								],
								"pageLength": 10,
								"serverSide": true,
								"columns": cols,
								"ajax": {
										"url": window.site_url + "/powerpanel/events/get_list",
								},
								'fnCreatedRow': function(nRow, aData, iDataIndex) {
										$(nRow).attr('data-order', aData[9]);
								},
								"columnDefs": [{
										"targets": [9],
										"visible": false,
										"searchable": false
								}],
								"order": [
										[6, "desc"]
								]
						}
				});
				$('#datatable_ajax tbody').on('click', '.moveDwn', function() {
						var order = $(this).data('order');
						var exOrder = $('#datatable_ajax tbody').find('tr[data-order=' + order + ']').next().data('order');
						exOrder = (exOrder == undefined) ? order + 1 : exOrder;
						reorder(order, exOrder);
				});
				$('#datatable_ajax tbody').on('click', '.moveUp', function() {
						var order = $(this).data('order');
						var exOrder = $('#datatable_ajax tbody').find('tr[data-order=' + order + ']').prev().data('order');
						exOrder = (exOrder == undefined) ? order - 1 : exOrder;
						reorder(order, exOrder);
				});
				grid.getTableWrapper().on('click', '.table-group-action-submit', function(e) {
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
				$(document).on('change', '#statusfilter', function(e) {
						e.preventDefault();
						var action = $('#statusfilter').val();
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
				$(document).on('keyup', '#searchfilter', function(e) {
						e.preventDefault();
						var action = $('#searchfilter').val();
						if (action.length >= 2) {
								grid.setAjaxParam("customActionType", "group_action");
								grid.setAjaxParam("searchValue", action);
								grid.setAjaxParam("id", grid.getSelectedRows());
								grid.getDataTable().ajax.reload();
						} else if (action.length < 1) {
								grid.setAjaxParam("customActionType", "group_action");
								grid.setAjaxParam("searchValue", action);
								grid.setAjaxParam("id", grid.getSelectedRows());
								grid.getDataTable().ajax.reload();
						}
				});

				$(document).on('change', '#personalityFilter', function(e) {
						e.preventDefault();
						var action = $('#personalityFilter').val();
						if (action != "") {
								grid.setAjaxParam("customActionType", "group_action");
								grid.setAjaxParam("personalityFilter", action);
								grid.setAjaxParam("id", grid.getSelectedRows());
								grid.getDataTable().ajax.reload();
						} else {
								grid.setAjaxParam("customActionType", "group_action");
								grid.setAjaxParam("personalityFilter", action);
								grid.setAjaxParam("id", grid.getSelectedRows());
						}
				});
				$(document).on('click', '#refresh', function(e) {
						$('#start_date').val('');
						$('#end_date').val('');
						grid.setAjaxParam("rangeFilter", '');
						grid.getDataTable().ajax.reload();
				});

				$(document).on('change', '#category_id', function(e) {
						e.preventDefault();
						var action = $('#category_id').val();
						
						if (action != "") {
								grid.setAjaxParam("customActionType", "group_action");
								grid.setAjaxParam("catValue", action);
								grid.setAjaxParam("id", grid.getSelectedRows());
								grid.getDataTable().ajax.reload();
						} else {
								grid.setAjaxParam("customActionType", "group_action");
								grid.setAjaxParam("catValue", action);
								grid.setAjaxParam("id", grid.getSelectedRows());
						}
				});
				
				$(document).on("switchChange.bootstrapSwitch", ".publish", function(event, state) {
						//e.preventDefault();
						var controller = $(this).data('controller');
						var alias = $(this).data('alias');
						var val = $(this).data('value');
						var url = site_url + '/' + controller + '/publish';
						$.ajax({
								url: url,
								data: {
										alias: alias,
										val: val
								},
								type: "POST",
								dataType: "HTML",
								success: function(data) {
										grid.getDataTable().ajax.reload(null, false);
								},
								error: function() {
										console.log('error!');
								}
						});
				});
				$('#confirm').on('hidden.bs.modal', function() {
						grid.getDataTable().ajax.reload();
				});
				$(document).on('change', '#paymentFilter', function(e) {
						e.preventDefault();
						var action = $('#paymentFilter').val();
						if (action != "") {
								grid.setAjaxParam("customActionType", "group_action");
								grid.setAjaxParam("paymentFilter", action);
								grid.setAjaxParam("id", grid.getSelectedRows());
								grid.getDataTable().ajax.reload();
						} else {
								grid.setAjaxParam("customActionType", "group_action");
								grid.setAjaxParam("paymentFilter", action);
								grid.setAjaxParam("id", grid.getSelectedRows());
						}
				});
				$(document).on('click', '#eventRange', function(e) {
						e.preventDefault();
						var action = {};
						action['from'] = $('#start_date').val();
						action['to'] = $('#end_date').val();
						if (action['from'] != '' || action['to'] != '') {
								grid.setAjaxParam("customActionType", "group_action");
								grid.setAjaxParam("rangeFilter", action);
								grid.setAjaxParam("id", grid.getSelectedRows());
								grid.getDataTable().ajax.reload();
						} else {
								grid.setAjaxParam("customActionType", "group_action");
								grid.setAjaxParam("rangeFilter", action);
								grid.setAjaxParam("id", grid.getSelectedRows());
						}
				});
				grid.setAjaxParam("customActionType", "group_action");
				grid.clearAjaxParams();
				grid.getDataTable().columns().iterator('column', function(ctx, idx) {
						$(grid.getDataTable().column(idx).header()).append('<span class="sort-icon"/>');
				});
		}
		return {
				init: function() {
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

function reorder(curOrder, excOrder) {
		var ajaxurl = site_url + '/powerpanel/events/reorder';
		$.ajax({
				url: ajaxurl,
				data: {
						order: curOrder,
						exOrder: excOrder
				},
				type: "POST",
				dataType: "HTML",
				success: function(data) {},
				complete: function() {
						grid.getDataTable().ajax.reload(null, false);
				},
				error: function() {
						console.log('error!');
				}
		});
}