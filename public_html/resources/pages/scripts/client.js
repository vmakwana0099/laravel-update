$(document).on('keyup', '#searchFilter', function() {
	var searchVal = $('#searchFilter').val();
	var length = $("#searchFilter").val().length;	
	if (length>=3) {
		$.ajax({
			url: site_url+'/client',
			data: { searchVal:searchVal },
			type: "POST",         
			dataType: "json",
			success: function(data) {
				var html = '';
				if(data != null && data !='') {
					$.each (data, function(key, value) {	
						html += '<div class="item col-md-3 col-xs-6 col-xs-small grid animate fadeInUp">';
						html += '<div class="client_box box_border nopadding">';
						html += '<div class="client_image">';
						html += '<div class="nqimg_effects thumbnail_container">';
						html += '<div class="thumbnail img">';
						if(value.txt_image_url != null && value.txt_image_url !='') {
							html += '<img alt="No Image" src="'+value.txt_image_url+'/'+value.txt_image_alt_tag+'.'+value.var_image_extension+'">';
						} else {
							html += '<img alt="No Image" src="'+site_url+''+'/resources/images/user_male4.png"/>';
						}
						html += '</div>';
						html += '<div class="nqimg_mask">';
						html += '<div class="nqimg_inner">';
						html += '<a href="'+site_url+'/client/'+value.alias+'/details" class="btn btn_size btn_radius btn_bg_none btn_txt_change btn_bg_change" title="'+value.name+'"><i class="fa fa-link"></i></a>';	
						html += '</div>';
						html += '</div>';        		
						html += '</div>';
						html += '</div>';
						html += '</div>';    		
						html +=	'<div class="client_desc">';
						html += '<h3><a href="'+site_url+'/client/'+value.alias+'/details" title="'+value.name+'" class="link">'+value.name+'</a></h3>';
						html += '<span>'+value.tag_line+'</span>';
						html += '<ul class="nqsocia">';
						html += '<li><a href="'+value.facebook+'" title="Facebook" class="sn sn_size sn_radius sn_bg_none sn_txt_change sn_bg_change"><i class="fa fa-facebook"></i></a></li>';
						html += '<li><a href="'+value.twitter+'" title="Twitter" class="sn sn_size sn_radius sn_bg_none sn_txt_change sn_bg_change"><i class="fa fa-twitter"></i></a></li>';
						html += '<li><a href="'+value.linkedin+'" title="Linkedin" class="sn sn_size sn_radius sn_bg_none sn_txt_change sn_bg_change"><i class="fa fa-linkedin"></i></a></li>';
						html += '<li><a href="'+value.google_plus+'" title="Google+" class="sn sn_size sn_radius sn_bg_none sn_txt_change sn_bg_change"><i class="fa fa-google-plus"></i></a></li>';
						html += '</ul>';
						html += '</div>';
						html += '</div>';
					});
				} else {
					html +=	'<div class="client_desc">';
					html += '<span>No records found.</span>';
					html += '</div>';
				}
				$('.clientList').html(html);        		
			},
			error: function() {
				console.log('error!');
			}                                 
		});
	} else if (length < 1) {
		$.ajax({
			url: site_url+'/client',
			data: { searchVal:searchVal },
			type: "POST",         
			dataType: "json",
			success: function(data) {
				var html = '';
				if(data != null && data !='') {
					$.each (data, function(key, value) {	
						html += '<div class="item col-md-3 col-xs-6 col-xs-small grid animate fadeInUp">';
						html += '<div class="client_box box_border nopadding">';
						html += '<div class="client_image">';
						html += '<div class="nqimg_effects thumbnail_container">';
						html += '<div class="thumbnail img">';
						if(value.txt_image_url != null && value.txt_image_url !='') {
							html += '<img alt="No Image" src="'+value.txt_image_url+'/'+value.txt_image_alt_tag+'.'+value.var_image_extension+'">';
						} else {
							html += '<img alt="No Image" src="'+site_url+''+'/resources/images/user_male4.png"/>';
						}
						html += '</div>';
						html += '<div class="nqimg_mask">';
						html += '<div class="nqimg_inner">';
						html += '<a href="'+site_url+'/client/'+value.alias+'/details" class="btn btn_size btn_radius btn_bg_none btn_txt_change btn_bg_change" title="'+value.name+'"><i class="fa fa-link"></i></a>';	
						html += '</div>';
						html += '</div>';        		
						html += '</div>';
						html += '</div>';
						html += '</div>';    		
						html +=	'<div class="client_desc">';
						html += '<h3><a href="'+site_url+'/client/'+value.alias+'/details" title="'+value.name+'" class="link">'+value.name+'</a></h3>';
						html += '<span>'+value.tag_line+'</span>';
						html += '<ul class="nqsocia">';
						html += '<li><a href="'+value.facebook+'" title="Facebook" class="sn sn_size sn_radius sn_bg_none sn_txt_change sn_bg_change"><i class="fa fa-facebook"></i></a></li>';
						html += '<li><a href="'+value.twitter+'" title="Twitter" class="sn sn_size sn_radius sn_bg_none sn_txt_change sn_bg_change"><i class="fa fa-twitter"></i></a></li>';
						html += '<li><a href="'+value.linkedin+'" title="Linkedin" class="sn sn_size sn_radius sn_bg_none sn_txt_change sn_bg_change"><i class="fa fa-linkedin"></i></a></li>';
						html += '<li><a href="'+value.google_plus+'" title="Google+" class="sn sn_size sn_radius sn_bg_none sn_txt_change sn_bg_change"><i class="fa fa-google-plus"></i></a></li>';
						html += '</ul>';
						html += '</div>';
						html += '</div>';
					});
				} else {
					html +=	'<div class="client_desc">';
					html += '<span>No records found.</span>';
					html += '</div>';
				}
				$('.clientList').html(html);        		
			},
			error: function() {
				console.log('error!');
			}                                 
		});
	}
});
$(document).on('click', '.pagination a', function (e) {
	e.preventDefault();
	var page = $(this).attr('href').split('page=')[1];
	getPosts(page);
});
function getPosts(page) {
	$.ajax({
		url : site_url+'/pagination/client?page='+page,
	}).done(function (data) {
		$('.page').html(data);
		location.hash = '/page_'+page;
	}).fail(function () {
		alert('Something went to wrong.');
	});
}