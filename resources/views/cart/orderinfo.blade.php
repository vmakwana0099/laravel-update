@extends('layouts.app')
@section('content')
@include('layouts.inner_banner')

<script type="text/javascript">
	function loadCartSummary(){
        $.ajax({
            async:true,
            url:"{{url('cart/getordersummary')}}",
            data:{},
            type:"get",
            success:function(response){
                $("#cart_right_panel").html(response); 
            }
        });
    }
    loadCartSummary();
    function emptycart(){ 
        if(confirm('Are you sure, you want to empty the cart?'))
        { window.location.href="{{url('cart/empty')}}"; }
    }
    $(function(){
        $("#checkoutbtn").click(function(){
            
        });
    });
</script>
@endsection