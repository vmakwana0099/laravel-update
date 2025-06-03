<div class="content_body_bg">
   
    <?php $themeversion = !isset($_SESSION['themepreview']) ? Config::get('Constant.DEFAULT_THEME') : $_SESSION['themepreview']; ?> 
    @include('template.'.$themeversion.'.service_section_home')
    @include('template.'.$themeversion.'.features_section_home')
    @include('template.'.$themeversion.'.testimonial_section_home')
    @include('template.'.$themeversion.'.support_section_home')
    @include('template.'.$themeversion.'.why_choose_hostitsmart')
    @include('template.'.$themeversion.'.associated_with_section_home')
    {{-- @include('template.'.$themeversion.'.customer_rating_section') --}}
    
 <script>

    $('.cust-revw-carousel').owlCarousel({

        loop: true,

        margin: 10,

        nav: true,

        responsive: {

            0: {

                items: 1

            },

            600: {

                items: 1

            },

            1000: {

                items: 1

            }

        }

    })

</script>






<script>

    const swiper = new Swiper(".swiper", {

        // Optional parameters

        slidesPerView: 3,

        spaceBetween: 30,

        loop: false,

        // Navigation arrows

        navigation: {

            nextEl: ".swiper-button-next",

            prevEl: ".swiper-button-prev"

        },

        mousewheel: {

            releaseOnEdges: true,

            eventsTarget: "container",

        }

    });

</script>



