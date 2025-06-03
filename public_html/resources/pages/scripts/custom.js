var pageDelete='Caution! The selected records will be deleted. Press DELETE to confirm.';
var DELETE_ATLEAST_ONE= Lang.get('template.oneRecordDeleted');
var DELETE_CONFIRM_MESSAGE = (window.location.href.indexOf("page") > -1)? pageDelete :  Lang.get('template.selectedDeleted');
var alias = '';
$(document).ready(function() {

		$(document).on('click', '.delete', function(e) {    	
				e.preventDefault();
				var controller = $(this).data('controller');
				alias = $(this).data('alias');
				deleteItemModal();
				$('#confirm .delMsg').text(DELETE_CONFIRM_MESSAGE);
				$('#delete').show();
		});


		$(document).on('click', '#delete', function() {
				deleteItem(DELETE_URL, alias);
		});

		$(document).on('click', '#deleteAll', function() {
				Delete_Records();
		});

		$(document).on('click', '.deleteMass', function(e) {
				e.preventDefault();
				var CheckedLength = $("input[type='checkbox'][class='chkDelete']:checked").length;
				if (CheckedLength == 0) {
						$('#confirmForAll .delMsg').text(DELETE_ATLEAST_ONE);
						$('#deleteAll').hide();
				}
				if (CheckedLength > 0) {
						$('#confirmForAll .delMsg').text(DELETE_CONFIRM_MESSAGE);
						$('#deleteAll').show();
				}
				deleteMultiple();
		});	
});

$('.group-checkable').click(function() {
		if ($(this).parent().attr('class') != 'checked') {
				$('.chkDelete').each(function() {
						$(this).prop('checked', true);
						$(this).parent().addClass('checked');
				});
		} else {
				$('.chkDelete').each(function() {
						$(this).prop('checked', false);
						$(this).parent().removeClass('checked');
				});
		}
});

function deleteItem(ajaxUrl, slug) {

		$.ajax({
				url: ajaxUrl,
				data: {
						ids: [slug]
				},
				type: "POST",
				dataType: "HTML",
				success: function(data) {
						$('#confirm').modal('hide');
						var $lmTable = $(".dataTable").dataTable({
								bRetrieve: true
						});
						$lmTable.fnDraw(false);
				},
				error: function() {
						console.log('error!');
				},
				async: false
		});
}

function Delete_Records() {
		var matches = [];
		$(".chkDelete:checked").each(function() {
				matches.push(this.value);
		});
		jQuery.ajax({
				type: "POST",
				url: DELETE_URL,
				data: {
						"ids": matches
				},
				async: false,
				success: function(result) {
						$('#confirmForAll').modal('hide');
						var $lmTable = $(".dataTable").dataTable({
								bRetrieve: true
						});
						$lmTable.fnDraw(false);

				}
		});
}

function deleteMultiple() {
		$('#confirmForAll').modal({
				backdrop: 'static',
				keyboard: false
		});
}

function deleteItemModal() {
		$('#confirm').modal({
				backdrop: 'static',
				keyboard: false
		});
}

/*$(document).on("contextmenu", ".moveTo", function(event) {
	event.preventDefault();
	var curOrder = $(this).data('order');
	var module = $(this).data('module');
	$('#moveTo input[name=order]').val(curOrder);
	$('#moveTo input[name=exorder]').val(curOrder);
	$('#moveTo #go').data('module',module);
	moveToModal();
});*/

function moveToModal() {
		$('#moveTo').modal({
				backdrop: 'static',
				keyboard: false
		});
}

$('input[name="display_order"]').keypress(function (event) {
            return isNumber(event, this);
});

function isNumber(evt, element) {

    var charCode = (evt.which) ? evt.which : event.keyCode;
    if (
        (charCode < 48 || charCode > 57)) // allow only digit.
        return false;

    return true;
}

 $(document).on('click', '#go', function() {
		jQuery.ajax({
				type: "POST",
				url: $(this).data('module')+'/swaporder',
				data: {						
						"order": $('#moveTo input[name=order]').val(),
						"exOrder": $('#moveTo input[name=exorder]').val()
				},
				async: false,
				success: function(result) {
					$('#moveTo').modal('hide');
				},
				complete:function(){
					var $lmTable = $(".dataTable").dataTable({
							bRetrieve: true
					});
					$lmTable.fnDraw(false);
				}
		});
});
 $(document).on('click', '#refresh', function(e) {
  $("#statusfilter,#featuredfilter, #pageFilter, #bannerFilter, #bannerFilterType,#category_id,#searchfilter").val('').trigger('change');
  $('#searchfilter').keyup();

 });