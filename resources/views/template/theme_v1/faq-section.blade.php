@if(!empty($FaqData) && count($FaqData) > 0)
<?php
// echo '<pre>'; print_r(Request::segment(1));exit;
?>
<section class="win-vps-faq">
    <section id="faq" class="head-tb-p-40">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="section-heading text-center">
                       @if(Request::segment(1) =='contact')
                        <h2 class="text_head">Got a Question? We've the Answer!</h2>
                        @elseif((Request::segment(1) == 'domain-registration'))
                        <h2 class="text_head">Domain Registration: Frequently Asked Questions</h2>
                        @elseif((Request::segment(2) == 'bulk-domain-search'))
                        <h2 class="text_head">Still have questions?<br> See if our answer database solves your query already</h2>
                        @elseif((Request::segment(2) == 'domain-transfer'))
                        <h2 class="text_head">Domain Transfer : Frequently Asked Questions</h2>
                        @elseif((Request::segment(1) == 'whois'))
                        <h2 class="text_head">Still have questions?<br> See if our answer database solves your query already</h2>
                        @elseif((Request::segment(2) == 'linux-hosting'))
                        <h2 class="text_head">Still Have Questions?<br> Linux Hosting : Frequently Asked Questions</h2>
                        @elseif((Request::segment(2) == 'wordpress-hosting'))
                        <h2 class="text_head">Frequently Asked Questions About WordPress Hosting</h2>
                        @elseif((Request::segment(2) == 'linux-reseller-hosting'))
                        <h2 class="text_head">Linux Reseller Hosting: Frequently Asked Questions</h2>
                        @elseif((Request::segment(2) == 'windows-hosting'))
                        <h2 class="text_head">Still Have Questions?<br> Windows Web Hosting: Frequently Asked Questions</h2>
                        @elseif((Request::segment(2) == 'ecommerce-hosting'))
                        <h2 class="text_head">eCommerce Hosting:<br> Frequently Asked Questions</h2>
                        @elseif((Request::segment(2) == 'vps-hosting'))
                        <h2 class="text_head">Frequently Asked Questions About VPS Hosting</h2>
                        @elseif((Request::segment(2) == 'windows-vps-hosting'))
                        <h2 class="text_head">Frequently Asked Questions About Windows VPS Hosting</h2>
                        @elseif((Request::segment(2) == 'dedicated-servers'))
                        <h2 class="text_head">Still Have Questions?<br> Dedicated Servers: Frequently Asked Questions</h2>
                        @elseif((Request::segment(2) == 'managed-vps-hosting'))
                        <h2 class="text_head">Frequently Asked Questions About Managed VPS</h2>
                         @elseif((Request::segment(2) == 'forex-vps-hosting'))
                        <h2 class="text_head">Frequently Asked Questions For Forex VPS Hosting</h2>
                         @elseif((Request::segment(2) == 'website-builder'))
                        <h2 class="text_head">Website Builder : Frequently Asked Questions!</h2>
                         @elseif((Request::segment(2) == 'google-workspace-india'))
                        <h2 class="text_head">Frequently Asked Questions For Google Workspace</h2>
                         @elseif((Request::segment(2) == 'microsoft-office-365-suite'))
                        <h2 class="text_head">Got a Question? We've the Answer!</h2>
                         @elseif((Request::segment(1) == 'ssl-certificates'))
                        <h2 class="text_head">SSL Certificate: Frequently Asked Questions</h2>
                         @elseif((Request::segment(1) == 'web-hosting'))
                        <h2 class="text_head">Frequently Asked Questions About Web Hosting</h2>
                         @elseif((Request::segment(2) == 'linux-vps-hosting'))
                        <h2 class="text_head">Frequently Asked Questions About Linux VPS Hosting</h2>
                         @elseif((Request::segment(1) == 'web-hosting-affiliates'))
                        <h2 class="text_head">Affiliate Program: Frequently Asked Questions</h2>
                        @else
                             <h2 class="text_head">Frequently Asked Questions</h2>

                       @endif
                        {{-- <h2 class="text_head">Frequently Asked Questions About Windows VPS Hosting</h2> --}}
                    </div>
                </div>
            </div>

            <div id="accordion" class="accordion faq-wrap">
                <div class="row">
                    <div class="col-md-6">
                        @php
                        $halfFaqs = ceil(count($FaqData) / 2); // Calculate half the number of FAQs (rounded up)
                        $i = 0;
                        @endphp

                        @foreach($FaqData as $Faq)
                        @php
                        $class = ''; // Only first FAQ is active on page load
                        $openClass = '';
                        $half_count = ceil(count($FaqData) / 2); // Calculate half of the total FAQs
                        @endphp

                        <div class="accordion-item mb-3 faqs-card">
                            <button class="accordion-header collapsed" data-bs-toggle="collapse" data-bs-target="#collapse{{ $i }}" aria-expanded="false">
                                <div class="mb-0 d-inline-block faqs-span">
                                    {!! isset($Faq->varTitle) && !empty($Faq->varTitle) ? str_replace("@sitename", Config::get('Constant.SITE_NAME'), $Faq->varTitle) : "" !!}
                                </div>
                            </button>
                            <div id="collapse{{ $i }}" class="collapse {{ $class }}" data-bs-parent="#accordion">
                                <div class="card-body white-bg">
                                    {!! isset($Faq->txtDescription) && !empty($Faq->txtDescription) ? str_replace('@sitename', Config::get('Constant.SITE_NAME'), str_replace('@siteurl', url('/'), str_replace('@sys_currency_symbol', Config::get('Constant.sys_currency_symbol'), $Faq->txtDescription))) : "" !!}
                                </div>
                            </div>
                        </div>

                        @php
                        $i++;
                        if ($i == $half_count) {
                            echo '</div><div class="col-md-6 col-lg-6">';
                        }
                        @endphp
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>

@endif