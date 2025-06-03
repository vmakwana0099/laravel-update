$(document).ready(function(){
	grab();
	$('.search').on('click',function(){
		grab();
	});
});

function grab(){
	var fromDate = $('#from').val();
		var toDate = $("#to").val();
		var value = $("#selectfilter").val();
		var searchValue = $('#searchfilter').val();
		//var regExp = /(\d{1,2})\/(\d{1,2})\/(\d{2,4})/;
		//if(parseInt(toDate.replace(regExp,"$3$2$1"))>=parseInt(fromDate.replace(regExp,"$3$2$1")) || value != ' '){
		if(Date.parse(toDate)>=Date.parse(fromDate)) {
			$.ajax({
				type: "POST",
				url: site_url+'/powerpanel/recent-updates/get_list',
				data:{
					'fromDate':fromDate,
					'toDate':toDate,
					'val':value,
					'searchVal':searchValue
				},
				dataType:'HTML',
				beforeSend: function(){
					$('.loader').show()
				},
				complete: function(){
					$('.loader').hide();
				},
				success: function(data) {
					$('#recentList').html(data);
				},
				error: function(xhr, ajaxOptions, thrownError){
					alert(thrownError);
				}
			});
		}else{
			$('#modal').modal();
		}
}