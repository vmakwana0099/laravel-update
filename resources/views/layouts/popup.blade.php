
<div id="nqpopup" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">			
			<div class="modal-body">				
				<H2>Note:</H2>
				<h4>{!!$popupcontent->txtDescription!!}</h4>				
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$(window).on('load',function(){
	$('#nqpopup').modal('show');
});
</script>