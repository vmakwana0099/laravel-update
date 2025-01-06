@extends('layouts.app')
@section('content')
<div class="thankyou-found">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="text-center thankyou-main">
                    <div class="image-thankyou aos-init" data-aos="flip-left" data-aos-easing="ease-out-back" data-aos-delay="300">
                        <img src="{{url('/')}}/assets/images/thank-you.png" alt="Thank You" />
                    </div>
                    <div class="thankyou-content aos-init" data-aos="fade-up" data-aos-delay="500">
                        <p>{{ $message }}</p>

<?php
    $lowercaseMessage = strtolower($message);

    if ($lowercaseMessage == 'congratulations! your password has been successfully updated. please login with new password in future.') { 
    // echo '<pre>123'; print_r($lowercaseMessage); exit; // For debugging purposes

        ?>
        <a class="btn" href="{{ url('/login') }}" title="Back to home">Back to login</a>
    <?php } else { ?>
        <!-- Display something else or just the same button -->
        <a class="btn" href="{{ url('/') }}" title="Back to home">Back to Home</a>
    <?php }
?>



                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
// exit;
?>
@endsection 