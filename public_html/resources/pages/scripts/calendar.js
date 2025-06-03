var AppCalendar = function() {
	return {
		//main function to initiate the module
		init: function() {
			this.initCalendar();
		},
		initCalendar: function() {
			if (!jQuery().fullCalendar) {
				return;
			}
			var date = new Date();
			var d = date.getDate();
			var m = date.getMonth();
			var y = date.getFullYear();
			var h = {};
			App.blockUI({
				target: '#calendar',
				animate: true,
				overlayColor: 'none'
			});
			if (App.isRTL()) {
				if ($('#calendar').parents(".portlet").width() <= 720) {
					$('#calendar').addClass("mobile");
					h = {
						right: 'title, prev, next',
						center: '',
						left: 'agendaDay, agendaWeek, month, today'
					};
				} else {
					$('#calendar').removeClass("mobile");
					h = {
						right: 'title',
						center: '',
						left: 'agendaDay, agendaWeek, month, today, prev,next'
					};
				}
			} else {
				if ($('#calendar').parents(".portlet").width() <= 720) {
					$('#calendar').addClass("mobile");
					h = {
						left: 'title, prev, next',
						center: '',
						right: 'today,month,agendaWeek,agendaDay'
					};
				} else {
					$('#calendar').removeClass("mobile");
					h = {
						left: 'title',
						center: '',
						right: 'prev,next,today,month,agendaWeek,agendaDay'
					};
				}
				App.unblockUI('#calendar');
			}
			function searchFilterAjax (val){
				var arrData = [];
				if(val != ''){
					arrData['searchVal']=val;
				}else{
					arrData['searchVal']='';
				}

				var viewName =	$('#calendar').fullCalendar('getView').name;
				if(viewName === undefined)
				{
					viewName='month';
				}
				//$("#calendar").fullCalendar( 'changeView', viewName );
				$.ajax({
					type: "GET",
					cache: false,
					async: true,
					url: site_url+'/powerpanel/calender/get_activity',
					data: ({searchValue:arrData['searchVal']}),
					dataType: "json",
					beforeSend: function(){
						$('.loader').show();
					},
					complete: function(){
						$('.loader').hide();
					},
					success: function(res) {
						App.unblockUI('#calendar');
						App.initAjax(); // reinitialize elements & plugins for newly loaded content
						arrData = res;
						$('#calendar').fullCalendar('destroy'); // destroy the calendar
						$('#calendar').fullCalendar({
							header: h,
							defaultView: viewName, // change default view with available options from http://arshaw.com/fullcalendar/docs/views/Available_Views/
							slotMinutes: 15,
							editable: true,
							droppable: true, // this allows things to be dropped onto the calendar !!!
							eventRender: function (event, element) {
								element.on('click', function (e) {
									$('.fc-day-grid-event').each(function () {
										$('.popover').popover('hide');
									});
								});

								element.popover({
									title: event.title,
									placement: '',
									html:true,
									content: event.msg
								});

								$('body').on('click', function (e) {
										$('.fc-day-grid-event').each(function () {
												//the 'is' for buttons that trigger popups
												//the 'has' for icons within a button that triggers a popup
											 if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
														(($(this).popover('hide').data('bs.popover')||{}).inState||{}).click = false  // fix for BS 3.3.6
												}
										});
								});

							},
							events: arrData
						});
					},
					error: function(xhr, ajaxOptions, thrownError) {
						App.unblockUI('#calendar');
						var msg = 'Error on reloading the content. Please check your connection and try again.';
						if (error == "toastr" && toastr) {
							toastr.error(msg);
						} else if (error == "notific8" && $.notific8) {
							$.notific8('zindex', 11500);
							$.notific8(msg, {
								theme: 'ruby',
								life: 3000
							});
						} else {
							alert(msg);
						}
					}
				});
			}
			/*Default on page load ajax call start*/
			searchFilterAjax();
			/*Default on page load ajax call end*/
			/*Start filter for status*/
			$('#searchdata').keyup(function(){
				var val = $('#searchdata').val();
				if (val != ''){
					searchFilterAjax(val);
				}else{
					searchFilterAjax('');
				}
			});
			/*End filter for status*/

		}
	};
}();
jQuery(document).ready(function() {
	AppCalendar.init();
	// $('body').on('click', function (e) {
	// 	$('.fc-day-grid-event').each(function () {
	// 		if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.fc-day-grid-event').has(e.target).length === 0) {
	// 	  	$('.popover').popover('hide');
	// 		}
	// 	});
	// });
	// $('.fc-day-grid-event').click(function (e) {
	// 	e.stopPropagation();
	// });

});

// var defaultView='basicWeek';
// var viewName=document.cookie.split(';')[0].split('=')[1];
// //or basicWeek, basicDay, agendaWeek, agendaDay
// $("#calendar").fullCalendar( 'changeView', viewName );