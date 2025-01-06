@extends('layouts.app')
@section('content')
<div class="thankyou-found rtng_thankyou" style="display:flex; justify-content: center; align-items: center;">
    <div class="container">
        <div class="row">
            <form id="rating-form" action="{{ url('/') }}">
                <input type="hidden" name="oder_id" value="{{$headers['o_id']}}">
                <input type="hidden" name="id" value="{{$headers['id']}}">               
                <div class="cstmr_rtng_main">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-12 col-lg-8 col-sm-12">
                                <div class="cstmr_rtng_cnt_box">                                   
                                    <h2>Dear, {{$details['firstname']}}</h2>
                                    <div class="cstmr_cnt">
                                        <p>We would like to express our sincerest gratitude for
                                            choosing our services and becoming our valued client.
                                        </p>
                                        <p>We would greatly appreciate it if you could spare a few moments to provide valuable feedback regarding your recent experience with Host IT Smart’s services. Your feedback is crucial in helping us improve and deliver the highest level of customer satisfaction.
                                        </p>
                                        <p>Please Take a Moment to Answer the Following Questions:</p>
                                    </div>
                                    <div class="exp_our_servc rtng-fnt-head">
                                        <h6>1. How would you rate your overall experience with our service?</h6>
                                        <div class="cstmr_rtng_star">
                                            <a id="1" href="javascript:void(0)" class="cstmr_rtng_box @if($headers['s'] == 1)<?php echo "active"; ?>@endif">
                                                <img src="/assets/images/feedback_rating/001star.svg" alt="Poor">
                                                <p>Poor</p>
                                           </a>
                                            <a id="2" href="javascript:void(0)" class="cstmr_rtng_box @if($headers['s'] == 2)<?php echo "active"; ?>@endif">
                                                <img src="/assets/images/feedback_rating/002star.svg" alt="Bad">
                                                <p>Bad</p>
                                           </a>
                                            <a id="3" href="javascript:void(0)" class="cstmr_rtng_box @if($headers['s'] == 3)<?php echo "active"; ?>@endif">
                                                <img src="/assets/images/feedback_rating/003star.svg" alt="Fair">
                                                <p>Fair</p>
                                           </a>
                                            <a id="4" href="javascript:void(0)" class="cstmr_rtng_box @if($headers['s'] == 4)<?php echo "active"; ?>@endif">
                                                <img src="/assets/images/feedback_rating/004star.svg" alt="Good">
                                                <p>Good</p>
                                           </a>
                                            <a id="5" href="javascript:void(0)" class="cstmr_rtng_box @if($headers['s'] == 5)<?php echo "active"; ?>@endif">
                                                <img src="/assets/images/feedback_rating/005star.svg" alt="Excellent">
                                                <p>Excellent</p>
                                           </a>
                                        </div>
                                    </div>                                   
                                    <div class="exp_our_servc rtng-fnt-head">
                                        <h6>2. Were our staff members friendly, professional, and attentive to your needs?</h6>                                 
                                        <ul>
                                            <li>
                                                <input type="checkbox" id="yes" name="attentive" value="Yes">
                                                <label for="vehicle1"> Yes</label><br>
                                            </li>
                                            <li>
                                                <input type="checkbox" id="no" name="attentive" value="No">
                                                <label for="vehicle2">No</label><br>
                                            </li>
                                        </ul>
                                    </div>                                    
                                    <div class="rtng_sugg rtng-fnt-head">
                                        <h6>3. Do you have any suggestions or recommendations for improvements?</h6>                                        
                                        <textarea id="suggestions" name="suggestions" rows="4"></textarea>                                        
                                    </div>                                    
                                    <div class="rtng_rch_out">
                                        <p>Thank you in advance for your valuable time & input. We look forward to hearing from you soon. If you have any further questions or require assistance, please feel free to reach out to us via</p>
                                        <div class="rtng_support">
                                            <div class="rtng_support_box">
                                                <a href="https://tawk.to/chat/62b3fcc37b967b1179961023/1g67h6nc3" id="liveChatButton" title="">
                                                    <i class="fa-solid fa-comments"></i>
                                                    <p>Live Chat</p>
                                                </a>
                                            </div>
                                            <div class="rtng_support_box">
                                                <a href="tel:079-3507-9700" title="">
                                                    <i class="fa-solid fa-phone-volume"></i>
                                                    <p>Phone Support</p>
                                                </a>
                                            </div>
                                            <div class="rtng_support_box">
                                                @php
                                                $manageurl = config('app.api_url');
                                                @endphp
                                                <a href="<?php echo $manageurl; ?>/submitticket.php" target="_blank">
                                                    <i class="fa-solid fa-ticket"></i>
                                                    <p>Ticket Support</p>
                                                </a>
                                            </div>
                                            <div class="rtng_support_box">
                                                @if(null!==(Config::get('Constant.SOCIAL_WHATSAPP_LINK')) && strlen(Config::get('Constant.SOCIAL_WHATSAPP_LINK')) > 0)
                                                <a href="{{Config::get('Constant.SOCIAL_WHATSAPP_LINK')}}" target="_blank">
                                                    @endif
                                                    <i class="fa-brands fa-square-whatsapp"></i>
                                                    <p>Whatsapp Supports</p>
                                                </a>
                                            </div>
                                        </div>
                                    </div>                                    
                                    <div class="rtng_submit">
                                        <button type="submit" id="submitBtn" data-toggle="modal" data-target="#staticBackdrop_thanks">SUBMIT</button>
                                    </div>   
                                    <!-- Button trigger modal -->                                      
                                        
                                        <!-- Modal -->
                                        <div class="modal_thanks_main" id="thankyoupopup">
                                        <div class="modal modal_thanks fade modal-center" id="staticBackdrop_thanks" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                               
                                                <div class="modal-body text-center">
                                                    <img src="assets/images/new_img/8878.gif" alt="success">
                                                    <h2 class="modal-title" id="staticBackdropLabel">Thank You For Your Feedback!</h2>
                                                    <h3>We sincerely appreciate your feedback and the time you took to share your thoughts.</h3>
                                                    <br>
                                                   <a href="{{ url('/') }}" class="button back_to_site">Back to site</a>

                                                    {{-- <button class="button back_to_site">Back to site</button> --}}
                                                </div>
                                            </div>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
$('.cstmr_rtng_box').on('click', function() {
$('.cstmr_rtng_box').removeClass('active');
$(this).addClass('active');
});
});
$(document).ready(function() {
$('#yes').on('click', function() {
document.getElementById("no").checked = false;
});
$('#no').on('click', function() {
document.getElementById("yes").checked = false;
});
});
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
    const ratingButtons = document.querySelectorAll(".cstmr_rtng_box");
    let star = "{{ $headers['s'] }}";

    ratingButtons.forEach((button) => {
        button.addEventListener("click", function () {            
            ratingButtons.forEach((btn) => {
                btn.classList.remove("active");
            });           
            button.classList.add("active");
            star = button.id; 
        });
    });
    document.getElementById("rating-form").addEventListener("submit", function (event) {
        event.preventDefault();        
        var formData = $("#rating-form").serialize();
        formData += "&star=" + star;
        $.ajax({
            url: "{{ url('/orderratingUpdate') }}",
            data: formData,
            type: "post",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {                
                $('#staticBackdrop_thanks').modal('show');
                             
            }
        });
    });
});
</script>
@endsection