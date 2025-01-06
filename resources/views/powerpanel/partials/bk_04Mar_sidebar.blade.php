@php $menuArr = App\Helpers\PowerPanelSidebarConfig::getConfig(); @endphp
<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <div class="scroller" style="max-height:calc(100vh - 100px);" data-rail-visible="1" data-rail-color="#fff" data-handle-color="#ccc">
            <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                <li class="nav-item start {{ $menuArr['dashboard_active'] }} {{ $menuArr['dashboard_open'] }}">
                    <a href="{{ url('powerpanel') }}" title="{{ trans('template.sidebar.dashboard') }}" class="nav-link nav-toggle">
                        <i class="icon-home"></i>
                        <span class="title">{{ trans('template.sidebar.dashboard') }}</span>
                        <span class="{{ $menuArr['dashboard_selected'] }}"></span>
                    </a>
                </li>

                @if((isset($menuArr['can-menu-list']) && $menuArr['can-menu-list']) ||
                (isset($menuArr['can-pages-list']) && $menuArr['can-pages-list']) ||
                (isset($menuArr['can-banner-list']) && $menuArr['can-banner-list']) ||
                (isset($menuArr['can-static-block']) && $menuArr['can-static-block']) ||
                (isset($menuArr['can-popup-list']) && $menuArr['can-popup-list']) ||
                (isset($menuArr['can-contact-list']) && $menuArr['can-contact-list']))
                <li class="nav-item {{ (isset($menuArr['sitemg']) && $menuArr['sitemg']=='active')? 'open active' : '' }}">
                    <a title="{{ trans('template.sidebar.sitemanagement') }}" href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-sitemap"></i>
                        <span class="title">{{ trans('template.sidebar.sitemanagement') }}</span>
                        <span class="arrow {{ (isset($menuArr['sitemg']) && $menuArr['sitemg']=='active')? 'open' : '' }}"></span>
                        <span class=""></span>
                        <span class=""></span>
                    </a>
                    <ul class="sub-menu">
                        @if(isset($menuArr['can-menu-list']) && $menuArr['can-menu-list'])
                        <li class="nav-item {{ $menuArr['menu_active'] }} {{ $menuArr['menu_open'] }}">
                            <a title="{{ trans('template.sidebar.menu') }}" href="{{ url('powerpanel/menu') }}" class="nav-link nav-toggle">
                                <i class="icon-list"></i>
                                <span class="title">{{ trans('template.sidebar.menu') }}</span>
                                <span class="{{ $menuArr['menu_selected'] }}"></span>
                            </a>
                        </li>
                        @endif
                        @if(isset($menuArr['can-pages-list']) && $menuArr['can-pages-list'])
                        <li class="nav-item {{ $menuArr['page_active'] }} {{ $menuArr['page_open'] }}">
                            <a title="{{ trans('template.sidebar.pages') }}" href="{{ url('powerpanel/pages') }}" class="nav-link nav-toggle">
                                <i class="icon-layers"></i>
                                <span class="title">{{ trans('template.sidebar.pages') }}</span>
                                <span class="{{ $menuArr['page_selected'] }}"></span>
                            </a>
                        </li>
                        @endif
                        @if(isset($menuArr['can-banner-list']) && $menuArr['can-banner-list'])
                        <li class="nav-item {{ $menuArr['banner_active'] }} {{ $menuArr['banner_open'] }}">
                            <a title="{{ trans('template.sidebar.banner') }}" href="{{ url('powerpanel/banners') }}" class="nav-link nav-toggle">
                                <i class="icon-picture"></i>
                                <span class="title">{{ trans('template.sidebar.banner') }}</span>
                                <span class="{{ $menuArr['banner_selected'] }}"></span>
                            </a>
                        </li>
                        @endif
                        @if(isset($menuArr['can-static-block']) && $menuArr['can-static-block'])
                        <li class="nav-item {{ $menuArr['staticblocks_active'] }} {{ $menuArr['staticblocks_open'] }}">
                            <a title="{{ trans('template.sidebar.staticblock') }}" href="{{ url('powerpanel/static-block') }}" class="nav-link nav-toggle">
                                <i class="fa fa-commenting-o"></i>
                                <span class="title">{{ trans('template.sidebar.staticblock') }}</span>
                                <span class="{{ $menuArr['staticblocks_selected'] }}"></span>
                            </a>
                        </li>
                        @endif
                        @if(isset($menuArr['can-popup-list']) && $menuArr['can-popup-list'])
                        <li class="nav-item {{ $menuArr['managepopup_active'] }} {{ $menuArr['managepopup_open'] }}">
                            <a title="{{ trans('template.sidebar.popupcontent') }}" href="{{ url('powerpanel/popup') }}" class="nav-link nav-toggle">
                                <i class="icon-credit-card"></i>
                                <span class="title">{{ trans('template.sidebar.popupcontent') }}</span>
                                <span class="{{ $menuArr['managepopup_selected'] }}"></span>
                            </a>
                        </li>
                        @endif
                        @if(isset($menuArr['can-contact-list']) && $menuArr['can-contact-list'])
                        <li class="nav-item start {{ $menuArr['contact_info_active'] }} {{ $menuArr['contact_info_open'] }}">
                            <a title="{{ trans('template.sidebar.contactinfo') }}" href="{{ url('/powerpanel/contact-info') }}" class="nav-link nav-toggle">
                                <i class="icon-call-end"></i>
                                <span class="title">{{ trans('template.sidebar.contactinfo') }}</span>
                                <span class="{{ $menuArr['contact_info_selected'] }}"></span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif
                @if((isset($menuArr['can-contact-us-list']) && $menuArr['can-contact-us-list']) ||
                (isset($menuArr['can-newsletter-lead-list']) && $menuArr['can-newsletter-lead-list']) || 
                (isset($menuArr['can-event-leads-list']) && $menuArr['can-event-leads-list']) || 
                (isset($menuArr['can-aws-support-leads-list']) && $menuArr['can-aws-support-leads-list']) || 
                (isset($menuArr['can-inquiry-leads-list']) && $menuArr['can-inquiry-leads-list']) || 
                (isset($menuArr['can-appointment-lead-list']) && $menuArr['can-appointment-lead-list'])
                )
                <li class="nav-item {{ (isset($menuArr['leadmg']) && $menuArr['leadmg']=='active')? 'open active' : '' }}">
                    <a title="{{ trans('template.sidebar.leads') }}" href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-basket"></i>
                        <span class="title">{{ trans('template.sidebar.leads') }}</span>
                        <span class="arrow {{ (isset($menuArr['leadmg']) && $menuArr['leadmg']=='active')? 'open' : '' }}"></span>
                        <span class=""></span>
                        <span class=""></span>
                    </a>
                    <ul class="sub-menu">
                        @if(isset($menuArr['can-contact-us-list']) && $menuArr['can-contact-us-list'])
                        <li class="nav-item {{ $menuArr['contact_active'] }}">
                            <a title="{{ trans('template.sidebar.contactuslead') }}" href="{{ url('powerpanel/contact-us') }}" class="nav-link ">
                                <i class="fa fa-phone"></i>
                                <span class="title">{{ trans('template.sidebar.contactuslead') }}</span>
                                <span class="{{ $menuArr['contact_selected'] }}"></span>
                            </a>
                        </li>
                        @endif
						
						 @if(isset($menuArr['can-reseller-center-list']) && $menuArr['can-reseller-center-list'])
						<li class="nav-item {{ $menuArr['resellercenter_active'] }}">
							<a title="{{ trans('template.sidebar.resellercenterlead') }}" href="{{ url('powerpanel/reseller-center') }}" class="nav-link ">
								<i class="fa fa-phone"></i>
								<span class="title">{{ trans('template.sidebar.resellercenterlead') }}</span>
								<span class="{{ $menuArr['resellercenter_selected'] }}"></span>
							</a>
						</li>
						@endif

                        @if(isset($menuArr['can-appointment-lead-list']) && $menuArr['can-appointment-lead-list'])
                        <li class="nav-item {{ $menuArr['appointment_active'] }}">
                            <a title="{{ trans('template.appointmentleadModule.bookanappointment') }}" href="{{ url('powerpanel/appointment-lead') }}" class="nav-link ">
                                <i class="fa fa-phone"></i>
                                <span class="title">{{ trans('template.appointmentleadModule.bookanappointment') }}</span>
                                <span class="{{ $menuArr['appointment_selected'] }}"></span>
                            </a>
                        </li>
                        @endif

                        @if(isset($menuArr['can-newsletter-lead-list']) && $menuArr['can-newsletter-lead-list'])
                        <li class="nav-item {{ $menuArr['news_letter_active'] }}">
                            <a title="{{ trans('template.sidebar.newsletterleads') }}" href="{{ url('powerpanel/newsletter-lead') }}" class="nav-link ">
                                <i class="fa fa-newspaper-o"></i>
                                <span class="title">{{ trans('template.sidebar.newsletterleads') }}</span>
                                <span class="{{ $menuArr['news_letter_selected'] }}"></span>
                            </a>
                        </li>
                        @endif
                        @if(isset($menuArr['can-event-leads-list']) && $menuArr['can-event-leads-list'])
                        <li class="nav-item {{ $menuArr['event_lead_active'] }}">
                            <a title="{{ trans('template.sidebar.eventLeads') }}" href="{{ url('powerpanel/event-leads') }}" class="nav-link ">
                                <i class="fa fa-podcast"></i>
                                <span class="title">{{ trans('template.sidebar.eventLeads') }}</span>
                                <span class="{{ $menuArr['event_lead_selected'] }}"></span>
                            </a>
                        </li>
                        @endif
                         @if(isset($menuArr['can-aws-support-leads-list']) && $menuArr['can-aws-support-leads-list'])
                        <li class="nav-item {{ $menuArr['aws_support_lead_active'] }}">
                            <a title="{{ trans('template.sidebar.awssupportLead') }}" href="{{ url('powerpanel/aws-support-leads') }}" class="nav-link ">
                                <i class="fa fa-newspaper-o"></i>
                                <span class="title">{{ trans('template.sidebar.awssupportLead') }}</span>
                                <span class="{{ $menuArr['aws_support_lead_selected'] }}"></span>
                            </a>
                        </li>
                        @endif
                        @if(isset($menuArr['can-inquiry-leads-list']) && $menuArr['can-inquiry-leads-list'])
                        
                        <li class="nav-item {{ $menuArr['inquiry_leads_active'] }}">
                            <a title="{{ trans('template.sidebar.inquiryLead') }}" href="{{ url('powerpanel/inquiry-leads') }}" class="nav-link ">
                                <i class="fa fa-newspaper-o"></i>
                                <span class="title">{{ trans('template.sidebar.inquiryLead') }}</span>
                                <span class="{{ $menuArr['inquiry_leads_selected'] }}"></span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif
                @if((isset($menuArr['can-services-category-list']) && $menuArr['can-services-category-list']) ||
                (isset($menuArr['can-products-category-list']) && $menuArr['can-products-category-list']) ||
                (isset($menuArr['can-blogs-category-list']) && $menuArr['can-blogs-category-list']) ||
                (isset($menuArr['can-news-category-list']) && $menuArr['can-news-category-list']) ||
                (isset($menuArr['can-show-category-list']) && $menuArr['can-show-category-list']) ||
                (isset($menuArr['can-sponsor-category-list']) && $menuArr['can-sponsor-category-list']) ||
                (isset($menuArr['can-event-category-list']) && $menuArr['can-event-category-list'])||
                (isset($menuArr['can-careers-category-list']) && $menuArr['can-careers-category-list'])
                )
                <li class="nav-item {{ (isset($menuArr['catmg']) && $menuArr['catmg']=='active')? 'open active' : '' }}">
                    <a title="{{ trans('template.sidebar.categories') }}" href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-clone"></i>
                        <span class="title">{{ trans('template.sidebar.categories') }}</span>
                        <span class="arrow {{ (isset($menuArr['catmg']) && $menuArr['catmg']=='active')? 'open' : '' }}"></span>
                        <span class=""></span>
                        <span class=""></span>
                    </a>
                    <ul class="sub-menu">
                        @if(isset($menuArr['can-services-category-list']) && $menuArr['can-services-category-list'])
                        <li class="nav-item {{ $menuArr['service_category_active'] }} {{ $menuArr['service_category_open'] }}">
                            <a title="{{ trans('template.sidebar.service-category') }}" href="{{ url('powerpanel/service-category') }}" class="nav-link nav-toggle">
                                <i class="fa fa-cogs"></i>
                                <span class="title">{{ trans('template.sidebar.servicescategory') }}</span>
                                <span class="{{ $menuArr['service_category_selected'] }}"></span>
                            </a>
                        </li>
                        @endif
                        @if(isset($menuArr['can-products-category-list']) && $menuArr['can-products-category-list'])
                        <li class="nav-item {{ $menuArr['products_category_active'] }} {{ $menuArr['products_category_open'] }}">
                            <a title="Products Category" href="{{ url('powerpanel/product-category') }}" class="nav-link nav-toggle">
                                <i class="icon-graph"></i>
                                <span class="title">{{ trans('template.sidebar.productscategory') }}</span>
                                <span class="{{ $menuArr['products_category_selected'] }}"></span>
                            </a>
                        </li>
                        @endif
                        @if(isset($menuArr['can-blogs-category-list']) && $menuArr['can-blogs-category-list'])
                        <li class="nav-item {{ $menuArr['blog_category_active'] }} {{ $menuArr['blog_category_open'] }}">
                            <a title="{{ trans('template.sidebar.blog-category') }}" href="{{ url('powerpanel/blog-category') }}" class="nav-link nav-toggle">
                                <i class="icon-pencil"></i>
                                <span class="title">{{ trans('template.sidebar.blogcategory') }}</span>
                                <span class="{{ $menuArr['blog_category_selected'] }}"></span>
                            </a>
                        </li>
                        @endif
                        @if(isset($menuArr['can-news-category-list']) && $menuArr['can-news-category-list'])
                        <li class="nav-item {{ $menuArr['news_category_active'] }} {{ $menuArr['news_category_open'] }}">
                            <a title="{{ trans('template.sidebar.news-category') }}" href="{{ url('powerpanel/news-category') }}" class="nav-link nav-toggle">
                                <i class="fa fa-newspaper-o"></i>
                                <span class="title">{{ trans('template.sidebar.newscategory') }}</span>
                                <span class="{{ $menuArr['news_category_selected'] }}"></span>
                            </a>
                        </li>
                        @endif

                        @if(isset($menuArr['can-event-category-list']) && $menuArr['can-event-category-list'])
                        <li class="nav-item {{ $menuArr['event_category_active'] }} {{ $menuArr['event_category_open'] }}">
                            <a title="{{ trans('template.sidebar.event-category') }}" href="{{ url('powerpanel/event-category') }}" class="nav-link nav-toggle">
                                <i class="fa fa-podcast"></i>
                                <span class="title">{{ trans('template.sidebar.eventcategory') }}</span>
                                <span class="{{ $menuArr['event_category_selected'] }}"></span>
                            </a>
                        </li>
                        @endif

                        @if(isset($menuArr['can-sponsor-category-list']) && $menuArr['can-sponsor-category-list'])
                        <li class="nav-item {{ $menuArr['sponsor_category_active'] }} {{ $menuArr['sponsor_category_open'] }}">
                            <a title="{{ trans('template.sidebar.sponsor-category') }}" href="{{ url('powerpanel/sponsor-category') }}" class="nav-link nav-toggle">
                                <i class="fa fa-handshake-o"></i>
                                <span class="title">{{ trans('template.sidebar.sponsorcategory') }}</span>
                                <span class="{{ $menuArr['sponsor_category_selected'] }}"></span>
                            </a>
                        </li>
                        @endif

                        @if(isset($menuArr['can-show-category-list']) && $menuArr['can-show-category-list'])
                        <li class="nav-item {{ $menuArr['show_category_active'] }} {{ $menuArr['show_category_open'] }}">
                            <a title="{{ trans('template.sidebar.showcategory') }}" href="{{ url('powerpanel/show-category') }}" class="nav-link nav-toggle">
                                <i class="icon-film"></i>
                                <span class="title">{{ trans('template.sidebar.showcategory') }}</span>
                                <span class="{{ $menuArr['show_category_selected'] }}"></span>
                            </a>
                        </li>
                        @endif
                        @if(isset($menuArr['can-careers-category-list']) && $menuArr['can-careers-category-list'])
                        <li class="nav-item {{ $menuArr['careers_category_active'] }} {{ $menuArr['careers_category_open'] }}">
                            <a title="{{ trans('template.sidebar.careercategory') }}" href="{{ url('powerpanel/careers-category') }}" class="nav-link nav-toggle">
                                <i class="fa fa-suitcase"></i>
                                <span class="title">{{ trans('template.sidebar.careercategory') }}</span>
                                <span class="{{ $menuArr['careers_category_selected'] }}"></span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif

                @if(
                (isset($menuArr['can-services-list']) && $menuArr['can-services-list']) ||
                (isset($menuArr['can-products-list']) && $menuArr['can-products-list']) ||
                (isset($menuArr['can-products-package-list']) && $menuArr['can-products-package-list']) ||
                (isset($menuArr['can-blogs-list']) && $menuArr['can-blogs-list']) ||
                (isset($menuArr['can-events-list']) && $menuArr['can-events-list']) ||
                (isset($menuArr['can-careers-list']) && $menuArr['can-careers-list']) ||
                (isset($menuArr['can-news-list']) && $menuArr['can-news-list']) ||
                (isset($menuArr['can-testimonial-list']) && $menuArr['can-testimonial-list']) ||
                (isset($menuArr['can-casestudy-list']) && $menuArr['can-casestudy-list']) ||
                (isset($menuArr['can-deals-list']) && $menuArr['can-deals-list']) ||
                (isset($menuArr['can-team-list']) && $menuArr['can-team-list']) ||
                (isset($menuArr['can-tld-list']) && $menuArr['can-tld-list']) ||
                (isset($menuArr['can-shows-list']) && $menuArr['can-shows-list']) ||
                (isset($menuArr['can-sponsor-list']) && $menuArr['can-sponsor-list']) ||
                (isset($menuArr['can-faq-list']) && $menuArr['can-faq-list'])
                (isset($menuArr['can-general-faq-list']) && $menuArr['can-general-faq-list'])
                (isset($menuArr['can-product-features-list']) && $menuArr['can-product-features-list'])
                (isset($menuArr['can-featured-products-list']) && $menuArr['can-featured-products-list'])
                )
                <li class="nav-item {{ (isset($menuArr['contmg']) && $menuArr['contmg']=='active')? 'open active' : '' }}">
                    <a title="{{ trans('template.sidebar.contents') }}" href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-puzzle"></i>
                        <span class="title">{{ trans('template.sidebar.contents') }}</span>
                        <span class="arrow {{ (isset($menuArr['contmg']) && $menuArr['contmg']=='active')? 'open' : '' }}"></span>
                        <span class=""></span>
                        <span class=""></span>
                    </a>
                    <ul class="sub-menu">
                        @if(isset($menuArr['can-services-list']) && $menuArr['can-services-list'])
                        <li class="nav-item {{ $menuArr['services_active'] }} {{ $menuArr['services_open'] }}">
                            <a title="{{ trans('template.sidebar.services') }}" href="{{ url('powerpanel/services') }}" class="nav-link nav-toggle">
                                <i class="fa fa-cogs"></i>
                                <span class="title">{{ trans('template.sidebar.services') }}</span>
                                <span class="{{ $menuArr['services_selected'] }}"></span>
                            </a>
                        </li>
                        @endif
                        @if(isset($menuArr['can-products-list']) && $menuArr['can-products-list'])
                        <li class="nav-item {{ $menuArr['products_active'] }} {{ $menuArr['products_open'] }}">
                            <a title="Products" href="{{ url('powerpanel/products') }}" class="nav-link nav-toggle">
                                <i class="fa fa-twitch"></i>
                                <span class="title">Products</span>
                                <span class="{{ $menuArr['products_selected'] }}"></span>
                            </a>
                        </li>
                        @endif
                        @if(isset($menuArr['can-products-package-list']) && $menuArr['can-products-package-list'])
                        <li class="nav-item {{ $menuArr['products_package_active'] }} {{ $menuArr['products_package_open'] }}">
                            <a title="Products Package" href="{{ url('powerpanel/products-package') }}" class="nav-link nav-toggle">
                                <i class="icon-graph"></i>
                                <span class="title">Products Package</span>
                                <span class="{{ $menuArr['products_package_selected'] }}"></span>
                            </a>
                        </li>
                        @endif
                        @if(isset($menuArr['can-product-features-list']) && $menuArr['can-product-features-list'])
                        <li class="nav-item {{ $menuArr['product_features_active'] }} {{ $menuArr['product_features_open'] }}">
                            <a title="{{ trans('template.sidebar.productfeatures') }}" href="{{ url('powerpanel/product-features') }}" class="nav-link nav-toggle">
                                <i class="icon-film"></i>
                                <span class="title">{{ trans('template.sidebar.productfeatures') }}</span>
                                <span class="{{ $menuArr['product_features_selected'] }}"></span>
                            </a>
                        </li>
                        @endif
                        @if(isset($menuArr['can-featured-products-list']) && $menuArr['can-featured-products-list'])
                        <li class="nav-item {{ $menuArr['featured_products_active'] }} {{ $menuArr['featured_products_open'] }}">
                            <a title="{{ trans('template.sidebar.featuredproducts') }}" href="{{ url('powerpanel/featured-products') }}" class="nav-link nav-toggle">
                                 <i class="fa fa-handshake-o"></i>
                                <span class="title">{{ trans('template.sidebar.featuredproducts') }}</span>
                                <span class="{{ $menuArr['featured_products_selected'] }}"></span>
                            </a>
                        </li>
                        @endif
                        @if(isset($menuArr['can-blogs-list']) && $menuArr['can-blogs-list'])
                        <li class="nav-item {{ $menuArr['blogs_active'] }} {{ $menuArr['blogs_open'] }}">
                            <a title="{{ trans('template.sidebar.blog') }}" href="{{ url('powerpanel/blogs') }}" class="nav-link nav-toggle">
                                <i class="icon-pencil"></i>
                                <span class="title">{{ trans('template.sidebar.blog') }}</span>
                                <span class="{{ $menuArr['blogs_selected'] }}"></span>
                            </a>
                        </li>
                        @endif
                        @if(isset($menuArr['can-events-list']) && $menuArr['can-events-list'])
                        <li class="nav-item {{ $menuArr['events_active'] }} {{ $menuArr['events_open'] }}">
                            <a title="{{ trans('template.sidebar.events') }}" href="{{ url('powerpanel/events') }}" class="nav-link nav-toggle">
                                <i class="fa fa-podcast"></i>
                                <span class="title">{{ trans('template.sidebar.events') }}</span>
                                <span class="{{ $menuArr['events_selected'] }}"></span>
                            </a>
                        </li>
                        @endif
                        @if(isset($menuArr['can-careers-list']) && $menuArr['can-careers-list'])
                        <li class="nav-item {{ $menuArr['careers_active'] }} {{ $menuArr['careers_open'] }}">
                            <a title="{{ trans('template.sidebar.careers') }}" href="{{ url('powerpanel/careers') }}" class="nav-link nav-toggle">
                                <i class="fa fa-suitcase"></i>
                                <span class="title">{{ trans('template.sidebar.careers') }}</span>
                                <span class="{{ $menuArr['careers_selected'] }}"></span>
                            </a>
                        </li>
                        @endif
                        @if(isset($menuArr['can-news-list']) && $menuArr['can-news-list'])
                        <li class="nav-item {{ $menuArr['news_active'] }} {{ $menuArr['news_open'] }}">
                            <a title="{{ trans('template.sidebar.news') }}" href="{{ url('powerpanel/news') }}" class="nav-link nav-toggle">
                                <i class="icon-note"></i>
                                <span class="title">{{ trans('template.sidebar.news') }}</span>
                                <span class="{{ $menuArr['news_selected'] }}"></span>
                            </a>
                        </li>
                        @endif
                        @if(isset($menuArr['can-testimonial-list']) && $menuArr['can-testimonial-list'])
                        <li class="nav-item {{ $menuArr['testimonial_active'] }} {{ $menuArr['testimonial_open'] }}">
                            <a title="{{ trans('template.sidebar.testimonials') }}" href="{{ url('powerpanel/testimonial') }}" class="nav-link nav-toggle">
                                <i class="icon-bubbles"></i>
                                <span class="title">{{ trans('template.sidebar.testimonials') }}</span>
                                <span class="{{ $menuArr['testimonial_selected'] }}"></span>
                            </a>
                        </li>
                        @endif
                        @if(isset($menuArr['can-casestudy-list']) && $menuArr['can-casestudy-list'])
                        <li class="nav-item {{ $menuArr['casestudy_active'] }} {{ $menuArr['casestudy_open'] }}">
                            <a title="{{ trans('template.sidebar.casestudy') }}" href="{{ url('powerpanel/casestudy') }}" class="nav-link nav-toggle">
                                <i class="icon-bubbles"></i>
                                <span class="title">{{ trans('template.sidebar.casestudy') }}</span>
                                <span class="{{ $menuArr['casestudy_selected'] }}"></span>
                            </a>
                        </li>
                        @endif
                           @if(isset($menuArr['can-deals-list']) && $menuArr['can-deals-list'])
                        <li class="nav-item {{ $menuArr['deals_active'] }} {{ $menuArr['deals_open'] }}">
                            <a title="{{ trans('template.sidebar.deals') }}" href="{{ url('powerpanel/deals') }}" class="nav-link nav-toggle">
                                <i class="fa fa-yelp"></i>
                                <span class="title">{{ trans('template.sidebar.deals') }}</span>
                                <span class="{{ $menuArr['deals_selected'] }}"></span>
                            </a>
                        </li>
                        @endif
                        @if(isset($menuArr['can-team-list']) && $menuArr['can-team-list'])
                        <li class="nav-item {{ $menuArr['team_active'] }} {{ $menuArr['team_open'] }}">
                            <a title="{{ trans('template.sidebar.team') }}" href="{{ url('powerpanel/team') }}" class="nav-link nav-toggle">
                                <i class="fa fa-user-o"></i>
                                <span class="title">{{ trans('template.sidebar.team') }}</span>
                                <span class="{{ $menuArr['team_selected'] }}"></span>
                            </a>
                        </li>
                        @endif
                         @if(isset($menuArr['can-tld-list']) && $menuArr['can-tld-list'])
                        <li class="nav-item {{ $menuArr['tld_active'] }} {{ $menuArr['tld_open'] }}">
                            <a title="{{ trans('template.sidebar.tld') }}" href="{{ url('powerpanel/tld') }}" class="nav-link nav-toggle">
                                <i class="fa fa-user-o"></i>
                                <span class="title">{{ trans('template.sidebar.tld') }}</span>
                                <span class="{{ $menuArr['tld_selected'] }}"></span>
                            </a>
                        </li>
                        @endif
                        @if(isset($menuArr['can-shows-list']) && $menuArr['can-shows-list'])
                        <li class="nav-item {{ $menuArr['shows_active'] }} {{ $menuArr['shows_open'] }}">
                            <a title="{{ trans('template.sidebar.shows') }}" href="{{ url('powerpanel/shows') }}" class="nav-link nav-toggle">
                                <i class="icon-film"></i>
                                <span class="title">{{ trans('template.sidebar.shows') }}</span>
                                <span class="{{ $menuArr['shows_selected'] }}"></span>
                            </a>
                        </li>
                        @endif
                        @if(isset($menuArr['can-sponsor-list']) && $menuArr['can-sponsor-list'])
                        <li class="nav-item {{ $menuArr['sponsor_active'] }} {{ $menuArr['sponsor_open'] }}">
                            <a title="{{ trans('template.sidebar.sponser') }}" href="{{ url('powerpanel/sponsor') }}" class="nav-link nav-toggle">
                                <i class="fa fa-handshake-o" style="font-size:15px"></i>
                                <span class="title">{{ trans('template.sidebar.sponser') }}</span>
                                <span class="{{ $menuArr['sponsor_selected'] }}"></span>
                            </a>
                        </li>
                        @endif
                        @if(isset($menuArr['can-client-list']) && $menuArr['can-client-list'])
                        <li class="nav-item {{ $menuArr['client_active'] }} {{ $menuArr['client_open'] }}">
                            <a title="{{ trans('template.sidebar.client') }}" href="{{ url('powerpanel/client') }}" class="nav-link nav-toggle">
                                <i class="fa fa-group" style="font-size:15px"></i>
                                <span class="title">{{ trans('template.sidebar.client') }}</span>
                                <span class="{{ $menuArr['client_selected'] }}"></span>
                            </a>
                        </li>
                        @endif
                        @if(isset($menuArr['can-faq-list']) && $menuArr['can-faq-list'])
                        <li class="nav-item {{ $menuArr['faq_active'] }} {{ $menuArr['faq_open'] }}">
                            <a title="{{ trans('template.sidebar.faq') }}" href="{{ url('powerpanel/faq') }}" class="nav-link nav-toggle">
                                <i class="icon-question"></i>
                                <span class="title">{{ trans('template.sidebar.faq') }}</span>
                                <span class="{{ $menuArr['faq_selected'] }}"></span>
                            </a>
                        </li>
                        @endif
                        @if(isset($menuArr['can-general-faq-list']) && $menuArr['can-general-faq-list'])
                        <li class="nav-item {{ $menuArr['general_faq_active'] }} {{ $menuArr['general_faq_open'] }}">
                            <a title="{{ trans('template.sidebar.generalfaq') }}" href="{{ url('powerpanel/general-faq') }}" class="nav-link nav-toggle">
                                <i class="fa fa-wechat"></i>
                                <span class="title">{{ trans('template.sidebar.generalfaq') }}</span>
                                <span class="{{ $menuArr['general_faq_selected'] }}"></span>
                            </a>
                        </li>
                        @endif

                    </ul>
                </li>
                @endif

                @if(
                (isset($menuArr['can-restaurant-menu-list']) && $menuArr['can-restaurant-menu-list']) ||
                (isset($menuArr['can-restaurant-menu-category-list']) && $menuArr['can-restaurant-menu-category-list'])||
                (isset($menuArr['can-restaurant-reservations-list']) && $menuArr['can-restaurant-reservations-list']) 
                )

                <li class="nav-item {{ (isset($menuArr['restmg']) && $menuArr['restmg']=='active')? 'open active' : '' }}">
                    <a title="{{ trans('template.sidebar.restaurant') }}" href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-cutlery"></i>
                        <span class="{{ trans('template.sidebar.restaurant') }}"> {{ trans('template.sidebar.restaurant') }}</span>
                        <span class="arrow {{ (isset($menuArr['restmg']) && $menuArr['restmg']=='active')? 'open' : '' }}"></span>
                        <span class=""></span>
                        <span class=""></span>
                    </a>
                    <ul class="sub-menu">
                        @if(isset($menuArr['can-restaurant-menu-category-list']) && $menuArr['can-restaurant-menu-category-list'])
                        <li class="nav-item {{ $menuArr['restaurant_menu_category_active'] }} {{ $menuArr['restaurant_menu_category_open'] }}">
                            <a title="{{ trans('template.sidebar.restaurant_menu_category') }}" href="{{ url('powerpanel/restaurant-menu-category') }}" class="nav-link nav-toggle">
                                <i class="fa fa-book"></i>
                                <span class="title">{{ trans('template.sidebar.restaurant_menu_category') }}</span>
                                <span class="{{ $menuArr['restaurant_menu_category_selected'] }}"></span>
                            </a>
                        </li>
                        @endif
                        @if(isset($menuArr['can-restaurant-menu-list']) && $menuArr['can-restaurant-menu-list'])
                        <li class="nav-item {{ $menuArr['restaurant_menu_active'] }} {{ $menuArr['restaurant_menu_open'] }}">
                            <a title="{{ trans('template.sidebar.restaurant_menu') }}" href="{{ url('powerpanel/restaurant-menu') }}" class="nav-link nav-toggle">
                                <i class="fa fa-map-o"></i>
                                <span class="title">{{ trans('template.sidebar.restaurant_menu') }}</span>
                                <span class="{{ $menuArr['restaurant_menu_selected'] }}"></span>
                            </a>
                        </li>
                        @endif

                        @if(isset($menuArr['can-restaurant-reservations-list']) && $menuArr['can-restaurant-reservations-list'])
                        <li class="nav-item {{ $menuArr['restaurant_reservations_active'] }}">
                            <a title="{{ trans('template.sidebar.restaurant_reservations') }}" href="{{ url('powerpanel/restaurant-reservations') }}" class="nav-link ">
                                <i class="fa fa-gavel"></i>
                                <span class="title">{{ trans('template.sidebar.restaurant_reservations') }}</span>
                                <span class="{{ $menuArr['restaurant_reservations_selected'] }}"></span>
                            </a>
                        </li>
                        @endif


                    </ul>
                </li>
                @endif

                @if((isset($menuArr['can-projects-category-list']) && $menuArr['can-projects-category-list']) || (isset($menuArr['can-projects-list']) && $menuArr['can-projects-list']))
                <li class="nav-item {{ (isset($menuArr['realmg']) && $menuArr['realmg']=='active')? 'open active' : '' }}">
                    <a title="Manage Projects" href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-puzzle"></i>
                        <span class="title">Projects</span>
                        <span class="arrow {{ (isset($menuArr['realmg']) && $menuArr['realmg']=='active')? 'open active' : '' }}"></span>
                        <span class=""></span>
                        <span class=""></span>
                    </a>
                    <ul class="sub-menu">
                        @if(isset($menuArr['can-projects-category-list']) && $menuArr['can-projects-category-list'])
                        <li class="nav-item {{ $menuArr['projects_category_active'] }} {{ $menuArr['projects_category_open'] }}">
                            <a title="{{ trans('template.sidebar.projectscategory') }}" href="{{ url('powerpanel/project-category') }}" class="nav-link nav-toggle">
                                <i class="icon-graph"></i>
                                <span class="title">{{ trans('template.sidebar.projectscategory') }}</span>
                                <span class="{{ $menuArr['projects_category_selected'] }}"></span>
                            </a>
                        </li>
                        @endif
                        @if(isset($menuArr['can-projects-list']) && $menuArr['can-projects-list'])
                        <li class="nav-item {{ $menuArr['projects_active'] }} {{ $menuArr['projects_open'] }}">
                            <a title="Projects" href="{{ url('powerpanel/projects') }}" class="nav-link nav-toggle">
                                <i class="icon-graph"></i>
                                <span class="title">Projects</span>
                                <span class="{{ $menuArr['projects_selected'] }}"></span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif



                @if(
                (isset($menuArr['can-photo-album-list']) && $menuArr['can-photo-album-list']) ||
                (isset($menuArr['can-video-album-list']) && $menuArr['can-video-album-list'])
                )
                <li class="nav-item {{ (isset($menuArr['albummg']) && $menuArr['albummg']=='active')? 'open active' : '' }}">
                    <a title="Album" href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-picture"></i>
                        <span class="title">Album</span>
                        <span class="arrow {{ (isset($menuArr['albummg']) && $menuArr['albummg']=='active')? 'open' : '' }}"></span>
                        <span class=""></span>
                        <span class=""></span>
                    </a>
                    <ul class="sub-menu">
                        @if(isset($menuArr['can-photo-album-list']) && $menuArr['can-photo-album-list'])
                        <li class="nav-item {{ $menuArr['photo_album_active'] }} {{ $menuArr['photo_album_open'] }}">
                            <a title="{{ trans('template.sidebar.photoalbum') }}" href="{{ url('powerpanel/photo-album') }}" class="nav-link nav-toggle">
                                <i class="fa fa-file-image-o"></i>
                                <span class="title">{{ trans('template.sidebar.photoalbum') }}</span>
                                <span class="{{ $menuArr['photo_album_selected'] }}"></span>
                            </a>
                        </li>
                        @endif
                        @if(isset($menuArr['can-video-album-list']) && $menuArr['can-video-album-list'])
                        <li class="nav-item {{ $menuArr['video_album_active'] }} {{ $menuArr['video_album_open'] }}">
                            <a title="{{ trans('template.sidebar.videoalbum') }}" href="{{ url('powerpanel/video-album') }}" class="nav-link nav-toggle">
                                <i class="fa fa-file-video-o"></i>
                                <span class="title">{{ trans('template.sidebar.videoalbum') }}</span>
                                <span class="{{ $menuArr['video_album_selected'] }}"></span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif
                @if(
                (isset($menuArr['can-photo-gallery-list']) && $menuArr['can-photo-gallery-list']) ||
                (isset($menuArr['can-video-gallery-list']) && $menuArr['can-video-gallery-list'])
                )
                <li class="nav-item {{ (isset($menuArr['gallarymg']) && $menuArr['gallarymg']=='active')? 'open active' : '' }}">
                    <a title="{{ trans('template.sidebar.gallery') }}" href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-picture"></i>
                        <span class="title">{{ trans('template.sidebar.gallery') }}</span>
                        <span class="arrow {{ (isset($menuArr['gallarymg']) && $menuArr['gallarymg']=='active')? 'open' : '' }}"></span>
                        <span class=""></span>
                        <span class=""></span>
                    </a>
                    <ul class="sub-menu">
                        @if(isset($menuArr['can-photo-gallery-list']) && $menuArr['can-photo-gallery-list'])
                        <li class="nav-item {{ $menuArr['photo_gallery_active'] }} {{ $menuArr['photo_gallery_open'] }}">
                            <a title="Photo Gallery" href="{{ url('powerpanel/photo-gallery') }}" class="nav-link nav-toggle">
                                <i class="fa fa-file-image-o"></i>
                                <span class="title">Photo Gallery</span>
                                <span class="{{ $menuArr['photo_gallery_selected'] }}"></span>
                            </a>
                        </li>
                        @endif
                        @if(isset($menuArr['can-video-gallery-list']) && $menuArr['can-video-gallery-list'])
                        <li class="nav-item {{ $menuArr['video_galary_active'] }} {{ $menuArr['video_galary_open'] }}">
                            <a title="Video Gallery" href="{{ url('powerpanel/video-gallery') }}" class="nav-link nav-toggle">
                                <i class="fa fa-file-video-o"></i>
                                <span class="title">Video Gallery</span>
                                <span class="{{ $menuArr['video_galary_selected'] }}"></span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif


                @if(isset($menuArr['can-advertise-list']) && $menuArr['can-advertise-list'])
                <li class="nav-item {{$menuArr['ads_active']}}">
                    <a title="{{ trans('template.sidebar.advertisements') }}" href="{{ url('powerpanel/advertise') }}" class="nav-link ">
                        <i class="fa fa-assistive-listening-systems"></i>
                        <span class="title">{{ trans('template.sidebar.advertisements') }}</span>
                        <span class=" {{$menuArr['ads_selected']}}"></span>
                    </a>
                </li>
                @endif


                @if(
                (isset($menuArr['can-roles-list']) && $menuArr['can-roles-list']) ||
                (isset($menuArr['can-users-list']) && $menuArr['can-users-list'])
                )
                <li class="nav-item {{ (isset($menuArr['usermg']) && $menuArr['usermg']=='active')? 'open active' : '' }}">
                    <a title="{{ trans('template.sidebar.users') }}" href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-user"></i>
                        <span class="title">{{ trans('template.sidebar.users') }}</span>
                        <span class="arrow {{ (isset($menuArr['usermg']) && $menuArr['usermg']=='active')? 'open' : '' }}"></span>
                        <span class=""></span>
                        <span class=""></span>
                    </a>
                    <ul class="sub-menu">
                        @if(isset($menuArr['can-roles-list']) && $menuArr['can-roles-list'])
                        <li class="nav-item {{ $menuArr['roles_active'] }} {{ $menuArr['roles_open'] }}">
                            <a title="{{ trans('template.sidebar.rolemanager') }}" href="{{ url('/powerpanel/roles') }}" class="nav-link ">
                                <i class="icon-docs"></i>
                                <span class="title">{{ trans('template.sidebar.rolemanager') }}</span>
                                <span class="{{ $menuArr['roles_selected'] }}"></span>
                            </a>
                        </li>
                        @endif
                        @if(isset($menuArr['can-users-list']) && $menuArr['can-users-list'])
                        <li class="nav-item {{ $menuArr['users_active'] }} {{ $menuArr['users_open'] }}">
                            <a title="{{ trans('template.sidebar.usermanagement') }}" href="{{ url('/powerpanel/users') }}" class="nav-link ">
                                <i class="icon-users"></i>
                                <span class="title">{{ trans('template.sidebar.usermanagement') }}</span>
                                <span class="{{ $menuArr['users_selected'] }}"></span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif

                @if(
                (isset($menuArr['can-email-log-list']) && $menuArr['can-email-log-list']) ||
                (isset($menuArr['can-log-list']) && $menuArr['can-log-list'])
                )
                <li class="nav-item {{ (isset($menuArr['logmg']) && $menuArr['logmg']=='active')? 'open active' : '' }}">
                    <a title="{{ trans('template.sidebar.logs') }}" href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-envelope-open-o"></i>
                        <span class="title">{{ trans('template.sidebar.logs') }}</span>
                        <span class="arrow {{ (isset($menuArr['logmg']) && $menuArr['logmg']=='active')? 'open' : '' }}"></span>
                        <span class=""></span>
                        <span class=""></span>
                    </a>
                    <ul class="sub-menu">
                        @if(isset($menuArr['can-email-log-list']) && $menuArr['can-email-log-list'])
                        <li class="nav-item {{ $menuArr['email_active'] }} {{ $menuArr['email_open'] }}">
                            <a title="{{ trans('template.sidebar.emaillog') }}" href="{{ url('powerpanel/email-log') }}" class="nav-link nav-toggle">
                                <i class="icon-envelope-letter"></i>
                                <span class="title">{{ trans('template.sidebar.emaillogs') }}</span>
                                <span class="{{ $menuArr['email_selected'] }}"></span>
                            </a>
                        </li>
                        @endif
                        @if(isset($menuArr['can-log-list']) && $menuArr['can-log-list'])
                        <li class="nav-item {{ $menuArr['log_active'] }} {{ $menuArr['log_open'] }}">
                            <a title="{{ trans('template.sidebar.logmanager') }}" href="{{ url('powerpanel/log') }}" class="nav-link nav-toggle">
                                <i class="fa fa-key"></i>
                                <span class="title">{{ trans('template.sidebar.logmanager') }}</span>
                                <span class="{{ $menuArr['log_selected'] }}"></span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif
                @if(isset($menuArr['can-login-history']) && $menuArr['can-login-history'])
                <li class="nav-item {{ $menuArr['login_history_active'] }} {{ $menuArr['login_history_open'] }}">
                    <a href="{{ url('powerpanel/login-history') }}" title="{{ trans('Login History') }}" class="nav-link nav-toggle">
                        <i class="fa fa-key"></i>
                        <span class="title">{{ trans('Login History') }}</span>
                        <span class="{{ $menuArr['login_history_selected'] }}"></span>
                    </a>
                </li>
                @endif
                @if(isset($menuArr['can-recent-updates-list']) && $menuArr['can-recent-updates-list'])
                <li class="nav-item {{ (isset($menuArr['recmg']) && $menuArr['recmg']=='active')? 'open active' : '' }}">
                    <a title="{{ trans('template.sidebar.recentupdates') }}" href="{{ url('powerpanel/recent-updates') }}" class="nav-link nav-toggle">
                        <i class="icon-bell"></i>
                        <span class="title">{{ trans('template.sidebar.recentupdates') }}</span>
                        <span class="{{ $menuArr['recent_selected'] }}"></span>
                    </a>
                </li>
                @endif

            </ul>
        </div>
    </div>
</div>