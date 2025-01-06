
<!-- for ckeditor and file upload  code start -->
<script src="{{ url('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
<script src="{{ url('vendor/unisharp/laravel-ckeditor/adapters/jquery.js') }}"></script>

{{-- <script src="{{ url('vendor/unisharp/laravel-ckeditor/config.js') }}"></script> --}}
<script>
   var route_prefix = "{{ url( empty(config('lfm.url_prefix'))?:'/'  ) }}";
</script>
<script type="text/javascript">

 $('#txtHtmlBanner').ckeditor(
  {
  	 	filebrowserImageBrowseUrl: route_prefix + '/?type=Images',
			filebrowserImageUploadUrl: route_prefix + '/upload?type=Images&_token={{csrf_token()}}',
			filebrowserBrowseUrl: route_prefix+'?type=Files',
		 	filebrowserUploadUrl: route_prefix+'/upload?type=Files&_token={{csrf_token()}}'
 });
 $('#txtDescription').ckeditor(
  {
  	 	filebrowserImageBrowseUrl: route_prefix + '/?type=Images',
			filebrowserImageUploadUrl: route_prefix + '/upload?type=Images&_token={{csrf_token()}}',
			filebrowserBrowseUrl: route_prefix+'?type=Files',
		 	filebrowserUploadUrl: route_prefix+'/upload?type=Files&_token={{csrf_token()}}'
 });
 $('#txtFeaturedDescription').ckeditor(
  {
  	 	filebrowserImageBrowseUrl: route_prefix + '/?type=Images',
			filebrowserImageUploadUrl: route_prefix + '/upload?type=Images&_token={{csrf_token()}}',
			filebrowserBrowseUrl: route_prefix+'?type=Files',
		 	filebrowserUploadUrl: route_prefix+'/upload?type=Files&_token={{csrf_token()}}'
 });

 $('form').on('submit', function()
 {
  for ( instance in CKEDITOR.instances ) 
  {
    CKEDITOR.instances[instance].updateElement();
  }
 }); 

//this works when content changes
// CKEDITOR.instances['txtDescription'].on('change', function() { 
//   alert(1);
// });
 </script>
<!-- for ckeditor and file upload  code end -->
