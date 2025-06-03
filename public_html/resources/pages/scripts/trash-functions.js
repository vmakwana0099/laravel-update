/**
Custom module for you to write your own javascript functions
**/
// DELETE MESSAGE
var DELETE_ATLEAST_ONE = 'Please select atleast one record to be delete.';
var DELETE_CONFIRM_MESSAGE = '<div class="form-body"><div class="form-group"><label for="site_name">Type DELETE to confirm</label><br/><input type="text" name="confirm" id="ipConfirm"/><span class="help-block" style="color:red"></span></div></div>';
var Custom = function () {
		// private functions & variables
		var myFunc = function(text) {
			alert(text);
		} 
		// public functions
		return {
				//main function
				init: function () {
						//initialize here something.            
				},        
				recycleItem : function(ajaxUrl,slug,tableRef,modalId)
				{   
					$.ajax({
							url: ajaxUrl,
							data: { alias:slug, module:tableRef },
							type: "POST",
							dataType: "HTML",        
							success: function(data) {
								$('#confirm').modal('hide');        
								$('#restore-item').modal('hide');
								var $lmTable = $(".dataTable").dataTable( { bRetrieve : true } );
								$lmTable.fnDraw();
							},
							error: function() {
									console.log('error!');
							}
					});
				},
				recycleRecords : function(ajaxUrl,tableRef,modalId){
					var matches = [];
					$(".chkDelete:checked").each(function() {
							matches.push(this.value);
					}); 

					jQuery.ajax({
							type: "POST",
							url: ajaxUrl,
							data: {
									"ids": matches,
									"module" : tableRef
							},
							async: false,        
							success: function(result)
							{
								$('#confirm').modal('hide');
								$('#restore-item').modal('hide');               
								var $lmTable = $(".dataTable").dataTable( { bRetrieve : true } );
								$lmTable.fnDraw();
								return false;
							}
					});
			}
		};
}();

jQuery(document).ready(function() {    
	 Custom.init();     
	 $('#moduleFilter').trigger('change');
	 $(document).on('click','.delete', function(e){       
				e.preventDefault(); 
				var tableRef = $('#moduleFilter option:selected').data('module');
				$('#confirm .delMsg').html(DELETE_CONFIRM_MESSAGE);         
				var alias=$(this).data('alias');
				var url=site_url+'/powerpanel/trash/destroy';

				$('#confirm').modal({ backdrop: 'static', keyboard: false });
				$(document).on('click', '#delete', function() {           
							if($('#ipConfirm').val().length < 1)
							{
								$('#confirm .help-block').text('Please enter DELETE to confirm');
							}
							else if($('#ipConfirm').val() == 'DELETE')
							{
								Custom.recycleItem(url,alias,tableRef,'#confirm');
							}
							else{
								$('#confirm .help-block').text('Sorry, please enter exctly DELETE to confirm');
							}
					});

		});

	 $(document).on('click','.restore', function(e){        
				e.preventDefault(); 
				var tableRef = $('#moduleFilter option:selected').data('module');
				$('#restore-item .resMsg').text('Are you sure you wnat to restore?');         
				var alias=$(this).data('alias');
				var url=site_url+'/powerpanel/trash/restore';

				$('#restore-item').modal({ backdrop: 'static', keyboard: false })
					.one('click', '#restore-it', function() {        
							Custom.recycleItem(url,alias,tableRef,'#restore-item');
					});      
		});

		$(document).on('click','.deleteMass', function(e){
				e.preventDefault();
				var tableRef = $('#moduleFilter option:selected').data('module');
				var CheckedLength = $("input[type='checkbox'][name='delete']:checked").length;
				if (CheckedLength == 0) {        
						$('#confirm .delMsg').html(DELETE_ATLEAST_ONE);
						$('#delete').hide();
				}
				if (CheckedLength > 0)
				{      
					$('#confirm .delMsg').html(DELETE_CONFIRM_MESSAGE); 
					$('#delete').show();
				}
				$('#confirm').modal({ backdrop: 'static', keyboard: false });
				$(document).on('click', '#delete', function() {           
							if($('#ipConfirm').val().length < 1)
							{
								$('#confirm .help-block').text('Please enter DELETE to confirm');
							}
							else if($('#ipConfirm').val() == 'DELETE')
							{
								Custom.recycleRecords(site_url+'/powerpanel/trash/destroyAll',tableRef,'#confirm');
							}
							else{
								$('#confirm .help-block').text('Sorry, please enter exctly DELETE to confirm');
							}
					});

		});

		$(document).on('click','.restoreMass', function(e){
				e.preventDefault();
				var tableRef = $('#moduleFilter option:selected').data('module');
				var CheckedLength = $("input[type='checkbox'][name='delete']:checked").length;
				if (CheckedLength == 0) {        
						$('#restore-item .resMsg').text('Please select atleast one record to be restored.');
						$('#restore-it').hide();
				}
				if (CheckedLength > 0)
				{      
					$('#restore-item .resMsg').text('Are you sure you wnat to restore?'); 
					$('#restore-it').show();
				}
				$('#restore-item').modal({ backdrop: 'static', keyboard: false })
					.one('click', '#restore-it', function() {
							Custom.recycleRecords(site_url+'/powerpanel/trash/restoreAll',tableRef,'#restore-item');
				});      
		});
		

});
/***
Usage
***/
//Custom.doSomeStuff();