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
                        <p>Your email address has been verified successfully.</p>
                        <a class="btn" href="{{url('/')}}" title="Back to home">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection