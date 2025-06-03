 $('.fancybox-buttons').fancybox({
   autoWidth: true,
   autoHeight: true,
   autoResize: true,
   autoCenter: true,
   closeBtn: true,
   openEffect: 'elastic',
   closeEffect: 'elastic',
   helpers: {
     title: {
       type: 'inside',
       position: 'top'
     }
   },
   beforeShow: function() {
     this.title = $(this.element).data("title");
   }
 });

 $(window).on('hashchange', function() {
   if (window.location.hash) {
     var page = window.location.hash.replace('#', '');
     if (page == Number.NaN || page <= 0) {
       return false;
     } else {
       getPosts(page);
     }
   }
 });

 $(document).ready(function() {
   if (window.location.hash) {
     var page = window.location.hash.replace('#', '');
     if (page == Number.NaN || page <= 0) {
       return false;
     } else {
       getPosts(page);
     }
   }
   $(document).on('click', '.pagination a', function(e) {
     var page = $(this).attr('href').split('page=')[1];
     window.location.hash = page;
     e.preventDefault();
   });
 });

 function getPosts(page) {
   $.ajax({
     url: '?page=' + page,
     dataType: 'json',
   }).done(function(data) {
     $('.posts').html(data);
     location.hash = page;
   }).fail(function() {
     alert('Posts could not be loaded.');
   });
 }

 function update_data(id) 
 {

   var title = $('#title_' + id).val();
   var order = $('#display_order_' + id).val();
   var imgId = $('.image_' + id).val();

   $.ajax({
     type: "POST",
     cache: true,
     url: window.site_url+'/powerpanel/photo-gallery/update',
     data: {
       'title': title,
       'id': id,
       'order': order,
       'imgId': imgId
     },
     success: function(data) 
     {
       if (window.location.hash) {
         var page = window.location.hash.replace('#', '');
         if (page == Number.NaN || page <= 0) {
           return false;
         } else {
           getPosts(page);
         }
       }
       if (data) {
         toastr.options = {
           "closeButton": true,
           "debug": false,
           "positionClass": "toast-top-right",
           "onclick": null,
           "showDuration": "1000",
           "hideDuration": "1000",
           "timeOut": "5000",
           "extendedTimeOut": "1000",
           "showEasing": "swing",
           "hideEasing": "linear",
           "showMethod": "fadeIn",
           "hideMethod": "fadeOut"
         }
         toastr.success('Details are updated successfully.');
         $('.posts').html(data);


       } else {

         toastr.options = {
           "closeButton": true,
           "debug": false,
           "positionClass": "toast-top-right",
           "onclick": null,
           "showDuration": "1000",
           "hideDuration": "1000",
           "timeOut": "5000",
           "extendedTimeOut": "1000",
           "showEasing": "swing",
           "hideEasing": "linear",
           "showMethod": "fadeIn",
           "hideMethod": "fadeOut"
         }
         toastr.error('Details are not updated.');
         $('.posts').html(data);

       }
     },
     error: function(xhr, ajaxOptions, thrownError) {

     },
     async: true
   });

 }

 function update_status(id) {

   var status = $('.status_' + id).attr('data-status');

   $.ajax({
     type: "POST",
     cache: true,
     url: window.site_url + '/powerpanel/photo-gallery/update_status',
     data: {
       'id': id,
       'status': status
     },
     success: function(data) 
     {

       var response = $.parseJSON(data);
      

       if (response.publish) 
       {
         $('.status_' + id).attr('data-status', 'Y');
         $('.status_' + id + ' i').attr('class', 'fa fa-eye');

         toastr.options = {
           "closeButton": true,
           "debug": false,
           "positionClass": "toast-top-right",
           "onclick": null,
           "showDuration": "1000",
           "hideDuration": "1000",
           "timeOut": "3000",
           "extendedTimeOut": "1000",
           "showEasing": "swing",
           "hideEasing": "linear",
           "showMethod": "fadeIn",
           "hideMethod": "fadeOut"
         }
         toastr.success(response.publish);

       } else {

         $('.status_' + id).attr('data-status', 'N');
         $('.status_' + id + ' i').attr('class', 'fa fa-eye-slash');

         toastr.options = {
           "closeButton": true,
           "debug": false,
           "positionClass": "toast-top-right",
           "onclick": null,
           "showDuration": "1000",
           "hideDuration": "1000",
           "timeOut": "3000",
           "extendedTimeOut": "1000",
           "showEasing": "swing",
           "hideEasing": "linear",
           "showMethod": "fadeIn",
           "hideMethod": "fadeOut"
         }
         toastr.success(response.unpublish);

       }

     },
     error: function(xhr, ajaxOptions, thrownError) {

     },
     async: true
   });

 }

 function remove(id) {

   var response = confirm("Are you sure you want to delete this image?");
   if (response) 
   {
     $.ajax({
       type: "POST",
       cache: true,
       url: window.site_url + '/powerpanel/photo-gallery/destroy',
       data: {
         'id': id
       },
       success: function(data) {
         $('.posts').html(data);

         if (window.location.hash) {
           var page = window.location.hash.replace('#', '');
           if (page == Number.NaN || page <= 0) {
             return false;
           } else {
             getPosts(page);
           }
         }

       },
       error: function(xhr, ajaxOptions, thrownError) {

       },
       async: true
     });
   } else {
     return false;
   }


 }