var TableDatatablesAjax = function () {
	var initPickers = function () {
		//init date pickers
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
					{"data": 0, className: 'td_checker',"bSortable":false},
					{"data": 1, className: 'text-left',"name":'varName'},
					{"data": 2, className: 'text-left',"name":'varEmail'},
					{"data": 3, className: 'text-center',"bSortable":false},
					{"data": 4, className: 'text-center',"bSortable":false},
					{"data": 5, className: 'text-center',"bSortable":false},
					{"data": 6, className: 'text-center',"name":'appointmentDate'},
					{"data": 7, className: 'text-center',"name":'varIpAddress'},
					{"data": 8, className: 'text-center',"name":'created_at'},
				],
				"ajax": {
					"url": window.site_url+"/powerpanel/appointment-lead/get_list", // ajax source
				},
				"order": [
					[8, "desc"]
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

		$(document).on('click', '#appointmentDate', function(e) {
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

		$(document).on('click', '.commentAction', function(e) {
				e.preventDefault();
				$('#addCommentModal #commentErr').addClass('hide');
				var commentAction = $(this).data('action');
				var leadId = $(this).data('lid');
				
				$('#addCommentModal #selectedlead').val(leadId);
				$('#addCommentModal #CommentAction').val(commentAction);
				//$('#addCommentModal #modelComment').val('');
				if(commentAction == "edit"){
					var oldComment = $(this).data('oldcomment');
						$('#addCommentModal #modelComment').val(oldComment);
				}else{
					$('#addCommentModal #modelComment').val('');
				}
				showAddComment();
		});
		$(document).on('click', '#saveComment', function(e) {
			var comment = $.trim($('#addCommentModal #modelComment').val());
			var leadId = $("#addCommentModal #selectedlead").val();
			var commentAction = $("#addCommentModal #CommentAction").val();
				if(comment.length<1 || comment==''){
					$('#addCommentModal #commentErr').removeClass('hide');
				}else{
					$('#addCommentModal #commentErr').addClass('hide');
					jQuery.ajax({
							type: "POST",
							url: window.site_url+'/powerpanel/appointment-lead/saveComment',
							data: {						
									"varComment": $('#addCommentModal #modelComment').val(),
									"commentAction": commentAction,
									"leadId":leadId
							},
							dataType:'json',
							async: false,
							success: function(result) {
								$('#addCommentModal #modelComment').val('');
								$("#addCommentModal #selectedlead").val('');
								$('#addCommentModal').modal('hide');
							}
					});
					grid.getDataTable().ajax.reload();
				}
		});
		$(document).on('click', '#refresh', function(e) {
				$('#start_date').val('');
				$('#end_date').val('');
				grid.setAjaxParam("rangeFilter", '');
				grid.getDataTable().ajax.reload();
		});

		$ ('#ExportRecord').on('click',function(e) {
			e.preventDefault();
			if (totalRec < 1) {
				$('#noRecords').modal('show');
			} else {
				$('#noRecords').modal('hide');
				var exportRadioVal = $("input[name='export_type']:checked").val();
				if (exportRadioVal != '') {
					if (exportRadioVal == 'selected_records') {
						if ($('#ExportRecord').click) {
							if ($('input[name="delete[]"]:checked').val()) {
								ip = '?'+$('input[name="delete[]"]:checked').serialize()+'&'+'export_type'+'='+exportRadioVal;
								var ajaxurl = window.site_url+"/powerpanel/appointment-lead/ExportRecord"+ip;
								window.location = ajaxurl;
								grid.getDataTable().ajax.reload();
							} else {
								$('#noSelectedRecords').modal('show');
							}
						}
					} else {
						$('#selected_records').modal('hide');
						var ajaxurl = window.site_url+"/powerpanel/appointment-lead/ExportRecord";
						window.location = ajaxurl;
					}
				}
			}
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

function showAddComment(){
	$('#addCommentModal').modal({
			backdrop: 'static',
			keyboard: false
	});	
}