$(document).ready(function(){
	$(".cmsPages").click(function(){
		var cmspage_id = this.id;
		$.ajax({
			url: site_url+'/powerpanel/dashboard/ajax',
			data: { type:'cms', id:cmspage_id },
			type: "POST",         
			dataType: "json",
			success: function(data) {
				var html = '';
				if(data != null && data !='') {
					html +=	'<div class="modal-dialog">';
					html +=	'<div class="modal-vertical">';
					html += '<div class="modal-content">';
					html +=	'<div class="modal-header">';
					html += '<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>';
					html += '<h3 class="modal-title">'+data.varTitle+'</h3>';
					html += '</div>';
					html += '<div class="modal-body">';
					html +=	'<p>'+data.varTitle+'</p>';
					html +=	'<p>'+data.txtDescription+'</p>';
					html +=	'</div>';
					html +=	'</div>';
					html +=	'</div>';
					html +=	'</div>';
					$('.detailsCmsPage').html(html);
					$('.detailsCmsPage').modal('show');
				}
			},
			error: function() {
				console.log('error!');
			}                                 
		});
	});
	$(".contactUsLead").click(function()
	{
		var contactuslead_id = this.id;
		$.ajax({
			url: site_url+'/powerpanel/dashboard/ajax',
			data: { type:'contactuslead', id:contactuslead_id },
			type: "POST",         
			dataType: "json",
			success: function(data) {
				var html = '';
				if(data != null && data !='') {
					html +=	'<div class="modal-dialog">';
					html +=	'<div class="modal-vertical">';
					html += '<div class="modal-content">';
					html +=	'<div class="modal-header">';
					html += '<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>';
					html += '<h3 class="modal-title">'+data.varName+'</h3>';
					html += '</div>';
					html += '<div class="modal-body">';
					html +=	'<p>Email: '+data.varEmail+'</p>';
					if(data.varPhoneNo==null || data.varPhoneNo==''){
						html +=	'<p>Phone #: '+'-'+'</p>';
					}else{
						html +=	'<p>Phone #: '+data.varPhoneNo+'</p>';	
					}
					if(data.txtUserMessage==null || data.txtUserMessage==''){
						html +=	'<p>Message: '+'-'+'</p>';
					}else{
						html +=	'<p>Message: '+data.txtUserMessage+'</p>';	
					}
					
					html +=	'</div>';
					html +=	'</div>';
					html +=	'</div>';
					html +=	'</div>';
					$('.detailsContactUsLead').html(html);
					$('.detailsContactUsLead').modal('show');
				}
			},
			error: function() {
				console.log('error!');
			}                                 
		});
	});
	$(".FaqRecord").click(function(){
		var faq_id = this.id;
		$.ajax({
			url: site_url+'/powerpanel/dashboard/ajax',
			data: { type:'faq', id:faq_id },
			type: "POST",         
			dataType: "json",
			success: function(data) {
				var html = '';
				if(data != null && data !='') {
					html +=	'<div class="modal-dialog">';
					html +=	'<div class="modal-vertical">';
					html += '<div class="modal-content">';
					html +=	'<div class="modal-header">';
					html += '<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>';
					html += '<h3 class="modal-title">FAQ</h3>';
					html += '</div>';
					html += '<div class="modal-body">';
					html +=	'<p>'+data.question+'</p>';
					html +=	'<p>'+data.answer+'</p>';
					html +=	'</div>';
					html +=	'</div>';
					html +=	'</div>';
					html +=	'</div>';
					$('.FAQDetails').html(html);
					$('.FAQDetails').modal('show');
				}
			},
			error: function() {
				console.log('error!');
			}                                 
		});
	});
	$(".BlogRecord").click(function(){
		var blog_id = this.id;
		$.ajax({
			url: site_url+'/powerpanel/dashboard/ajax',
			data: { type:'blog', blog_alias:blog_id },
			type: "POST",         
			dataType: "json",
			success: function(data) {
				var html = '';
				if(data != null && data !='') {
					html +=	'<div class="modal-dialog">';
					html +=	'<div class="modal-vertical">';
					html += '<div class="modal-content">';
					html +=	'<div class="modal-header">';
					html += '<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>';
					html += '<h3 class="modal-title">Blog</h3>';
					html += '</div>';
					html += '<div class="modal-body">';
					html +=	'<p>'+data.title+'</p>';
					html +=	'<p>'+data.description+'</p>';
					html +=	'</div>';
					html +=	'</div>';
					html +=	'</div>';
					html +=	'</div>';
					$('.BlogDetails').html(html);
					$('.BlogDetails').modal('show');
				}
			},
			error: function() {
				console.log('error!');
			}
		});
	});
});
