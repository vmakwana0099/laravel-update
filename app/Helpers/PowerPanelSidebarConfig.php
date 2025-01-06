<?php

namespace App\Helpers;

use Auth;
use Illuminate\Support\Facades\Request;

class PowerPanelSidebarConfig {

    public static function getConfig() {
        $menuArr = [];
        if (empty(Request::segment(2)) || Request::segment(2) == 'dashboard') {
            $menuArr['dashboard_active'] = 'active';
            $menuArr['dashboard_open'] = 'open';
            $menuArr['dashboard_selected'] = 'selected';
        } else {
            $menuArr['dashboard_active'] = '';
            $menuArr['dashboard_open'] = '';
            $menuArr['dashboard_selected'] = '';
        }

        if (Auth::user()->can('menu-list')) {
            $menuArr['can-menu-list'] = true;
            if (Request::segment(2) == 'menu') {
                $menuArr['menu_active'] = 'active';
                $menuArr['menu_open'] = 'open';
                $menuArr['menu_selected'] = 'selected';
                $menuArr['sitemg'] = 'active';
            } else {
                $menuArr['menu_active'] = '';
                $menuArr['menu_open'] = '';
                $menuArr['menu_selected'] = '';
            }
        }

        if (Auth::user()->can('banners-list')) {
            $menuArr['can-banner-list'] = true;
            if (Request::segment(2) == 'banners') {
                $menuArr['banner_active'] = 'active';
                $menuArr['banner_open'] = 'open';
                $menuArr['banner_selected'] = 'selected';
                $menuArr['sitemg'] = 'active';
            } else {
                $menuArr['banner_active'] = '';
                $menuArr['banner_open'] = '';
                $menuArr['banner_selected'] = '';
                $menuArr['banner_active'] = '';
            }
        }

        if (Auth::user()->can('pages-list')) {
            $menuArr['can-pages-list'] = true;
            if (Request::segment(2) == 'pages') {
                $menuArr['page_active'] = 'active';
                $menuArr['page_open'] = 'open';
                $menuArr['page_selected'] = 'selected';
                $menuArr['sitemg'] = 'active';
            } else {
                $menuArr['page_active'] = '';
                $menuArr['page_open'] = '';
                $menuArr['page_selected'] = '';
                $menuArr['page_active'] = '';
            }
        }

        if (Auth::user()->can('static-block-list')) {
            $menuArr['can-static-block'] = true;
            if (Request::segment(2) == 'static-block') {
                $menuArr['staticblocks_active'] = 'active';
                $menuArr['staticblocks_open'] = 'open';
                $menuArr['staticblocks_selected'] = 'selected';
                $menuArr['sitemg'] = 'active';
            } else {
                $menuArr['staticblocks_active'] = '';
                $menuArr['staticblocks_open'] = '';
                $menuArr['staticblocks_selected'] = '';
                $menuArr['staticblocks_active'] = '';
            }
        }

        if (Auth::user()->can('popup-list')) {
            $menuArr['can-popup-list'] = true;
            if (Request::segment(2) == 'popup') {
                $menuArr['managepopup_active'] = 'active';
                $menuArr['managepopup_open'] = 'open';
                $menuArr['managepopup_selected'] = 'selected';
                $menuArr['sitemg'] = 'active';
            } else {
                $menuArr['managepopup_active'] = '';
                $menuArr['managepopup_open'] = '';
                $menuArr['managepopup_selected'] = '';
                $menuArr['managepopup_active'] = '';
            }
        }

        if (Auth::user()->can('contact-info-list')) {
            $menuArr['can-contact-list'] = true;
            if (Request::segment(2) == 'contact-info') {
                $menuArr['contact_info_active'] = 'active';
                $menuArr['contact_info_open'] = 'open';
                $menuArr['contact_info_selected'] = 'selected';
                $menuArr['sitemg'] = 'active';
            } else {
                $menuArr['contact_info_active'] = '';
                $menuArr['contact_info_open'] = '';
                $menuArr['contact_info_selected'] = '';
            }
        }

        if (Auth::user()->can('contact-us-list')) {
            $menuArr['can-contact-us-list'] = true;
            if (Request::segment(2) == 'contact-us') {
                $menuArr['contact_active'] = 'active';
                $menuArr['contact_open'] = 'open';
                $menuArr['contact_selected'] = 'selected';
                $menuArr['leadmg'] = 'active';
            } else {
                $menuArr['contact_active'] = '';
                $menuArr['contact_open'] = '';
                $menuArr['contact_selected'] = '';
            }
        }
        if (Auth::user()->can('google-contact-us-list')) {
            // echo '123:'; exit;
            $menuArr['can-google-contact-us-list'] = true;
            if (Request::segment(2) == 'google-contact-us') {
                $menuArr['google-contact_active'] = 'active';
                $menuArr['google-contact_open'] = 'open';
                $menuArr['google-contact_selected'] = 'selected';
                $menuArr['leadmg'] = 'active';
            } else {
                $menuArr['google-contact_active'] = '';
                $menuArr['google-contact_open'] = '';
                $menuArr['google-contact_selected'] = '';
            }
        }
		//For ResellerCenterLeads ----------------------------
		if (Auth::user()->can('reseller-center-list')) {
            $menuArr['can-reseller-center-list'] = true;
            if (Request::segment(2) == 'reseller-center') {
                $menuArr['resellercenter_active'] = 'active';
                $menuArr['resellercenter_open'] = 'open';
                $menuArr['resellercenter_selected'] = 'selected';
                $menuArr['leadmg'] = 'active';
            } else {
                $menuArr['resellercenter_active'] = '';
                $menuArr['resellercenter_open'] = '';
                $menuArr['resellercenter_selected'] = '';
            }
        }
		//For ResellerCenterLeads ----------------------------

        if (Auth::user()->can('appointment-lead-list')) {
            $menuArr['can-appointment-lead-list'] = true;
            if (Request::segment(2) == 'appointment-lead') {
                $menuArr['appointment_active'] = 'active';
                $menuArr['appointment_open'] = 'open';
                $menuArr['appointment_selected'] = 'selected';
                $menuArr['leadmg'] = 'active';
            } else {
                $menuArr['appointment_active'] = '';
                $menuArr['appointment_open'] = '';
                $menuArr['appointment_selected'] = '';
            }
        }

        if (Auth::user()->can('newsletter-lead-list')) {
            $menuArr['can-newsletter-lead-list'] = true;
            if (Request::segment(2) == 'newsletter-lead') {
                $menuArr['news_letter_active'] = 'active';
                $menuArr['news_letter_open'] = 'open';
                $menuArr['news_letter_selected'] = 'selected';
                $menuArr['leadmg'] = 'active';
            } else {
                $menuArr['news_letter_active'] = '';
                $menuArr['news_letter_open'] = '';
                $menuArr['news_letter_selected'] = '';
            }
        }

        if (Auth::user()->can('event-leads-list')) {
            $menuArr['can-event-leads-list'] = true;
            if (Request::segment(2) == 'event-leads') {
                $menuArr['event_lead_active'] = 'active';
                $menuArr['event_lead_open'] = 'open';
                $menuArr['event_lead_selected'] = 'selected';
                $menuArr['leadmg'] = 'active';
            } else {
                $menuArr['event_lead_active'] = '';
                $menuArr['event_lead_open'] = '';
                $menuArr['event_lead_selected'] = '';
            }
        }
        if (Auth::user()->can('aws-support-leads-list')) {
            $menuArr['can-aws-support-leads-list'] = true;
            if (Request::segment(2) == 'event-leads') {
                $menuArr['aws_support_lead_active'] = 'active';
                $menuArr['aws_supportlead_open'] = 'open';
                $menuArr['aws_support_lead_selected'] = 'selected';
                $menuArr['leadmg'] = 'active';
            } else {
                $menuArr['aws_support_lead_active'] = '';
                $menuArr['aws_support_lead_open'] = '';
                $menuArr['aws_support_lead_selected'] = '';
            }
        }
        
        if (Auth::user()->can('inquiry-leads-list')) {
            
            $menuArr['can-inquiry-leads-list'] = true;
            if (Request::segment(2) == 'inquiry-leads') {
                $menuArr['inquiry_leads_active'] = 'active';
                $menuArr['inquiry_leads_open'] = 'open';
                $menuArr['inquiry_leads_selected'] = 'selected';
                $menuArr['leadmg'] = 'active';
            } else {
                $menuArr['inquiry_leads_active'] = '';
                $menuArr['inquiry_leads_open'] = '';
                $menuArr['inquiry_leads_selected'] = '';
            }
        }

        if (Auth::user()->can('service-category-list')) {
            $menuArr['can-services-category-list'] = true;
            if (Request::segment(2) == 'service-category') {
                $menuArr['service_category_active'] = 'active';
                $menuArr['service_category_open'] = 'open';
                $menuArr['service_category_selected'] = 'selected';
                $menuArr['catmg'] = 'active';
            } else {
                $menuArr['service_category_active'] = '';
                $menuArr['service_category_open'] = '';
                $menuArr['service_category_selected'] = '';
            }
        }

        if (Auth::user()->can('restaurant-menu-list')) {
            $menuArr['can-restaurant-menu-list'] = true;
            if (Request::segment(2) == 'restaurant-menu') {
                $menuArr['restaurant_menu_active'] = 'active';
                $menuArr['restaurant_menu_open'] = 'open';
                $menuArr['restaurant_menu_selected'] = 'selected';
                $menuArr['restmg'] = 'active';
            } else {
                $menuArr['restaurant_menu_active'] = '';
                $menuArr['restaurant_menu_open'] = '';
                $menuArr['restaurant_menu_selected'] = '';
            }
        }


        if (Auth::user()->can('restaurant-menu-category-list')) {
            $menuArr['can-restaurant-menu-category-list'] = true;
            if (Request::segment(2) == 'restaurant-menu-category') {
                $menuArr['restaurant_menu_category_active'] = 'active';
                $menuArr['restaurant_menu_category_open'] = 'open';
                $menuArr['restaurant_menu_category_selected'] = 'selected';
                $menuArr['restmg'] = 'active';
            } else {
                $menuArr['restaurant_menu_category_active'] = '';
                $menuArr['restaurant_menu_category_open'] = '';
                $menuArr['restaurant_menu_category_selected'] = '';
            }
        }

        if (Auth::user()->can('restaurant-reservations-list')) {
            $menuArr['can-restaurant-reservations-list'] = true;
            if (Request::segment(2) == 'restaurant-reservations') {
                $menuArr['restaurant_reservations_active'] = 'active';
                $menuArr['restaurant_reservations_open'] = 'open';
                $menuArr['restaurant_reservations_selected'] = 'selected';
                $menuArr['restmg'] = 'active';
            } else {
                $menuArr['restaurant_reservations_active'] = '';
                $menuArr['restaurant_reservations_open'] = '';
                $menuArr['restaurant_reservations_selected'] = '';
            }
        }

        if (Auth::user()->can('project-category-list')) {
            $menuArr['can-projects-category-list'] = true;
            if (Request::segment(2) == 'project-category') {
                $menuArr['projects_category_active'] = 'active';
                $menuArr['projects_category_open'] = 'open';
                $menuArr['projects_category_selected'] = 'selected';
                $menuArr['realmg'] = 'active';
            } else {
                $menuArr['projects_category_active'] = '';
                $menuArr['projects_category_open'] = '';
                $menuArr['projects_category_selected'] = '';
            }
        }

        if (Auth::user()->can('product-category-list')) {
            $menuArr['can-products-category-list'] = true;
            if (Request::segment(2) == 'product-category') {
                $menuArr['products_category_active'] = 'active';
                $menuArr['products_category_open'] = 'open';
                $menuArr['products_category_selected'] = 'selected';
                $menuArr['catmg'] = 'active';
            } else {
                $menuArr['products_category_active'] = '';
                $menuArr['products_category_open'] = '';
                $menuArr['products_category_selected'] = '';
            }
        }

        if (Auth::user()->can('blog-category-list')) {
            $menuArr['can-blogs-category-list'] = true;
            if (Request::segment(2) == 'blog-category') {
                $menuArr['blog_category_active'] = 'active';
                $menuArr['blog_category_open'] = 'open';
                $menuArr['blog_category_selected'] = 'selected';
                $menuArr['catmg'] = 'active';
            } else {
                $menuArr['blog_category_active'] = '';
                $menuArr['blog_category_open'] = '';
                $menuArr['blog_category_selected'] = '';
            }
        }

        if (Auth::user()->can('news-category-list')) {
            $menuArr['can-news-category-list'] = true;
            if (Request::segment(2) == 'news-category') {
                $menuArr['news_category_active'] = 'active';
                $menuArr['news_category_open'] = 'open';
                $menuArr['news_category_selected'] = 'selected';
                $menuArr['catmg'] = 'active';
            } else {
                $menuArr['news_category_active'] = '';
                $menuArr['news_category_open'] = '';
                $menuArr['news_category_selected'] = '';
            }
        }

        if (Auth::user()->can('event-category-list')) {
            $menuArr['can-event-category-list'] = true;
            if (Request::segment(2) == 'event-category') {
                $menuArr['event_category_active'] = 'active';
                $menuArr['event_category_open'] = 'open';
                $menuArr['event_category_selected'] = 'selected';
                $menuArr['catmg'] = 'active';
            } else {
                $menuArr['event_category_active'] = '';
                $menuArr['event_category_open'] = '';
                $menuArr['event_category_selected'] = '';
            }
        }

        if (Auth::user()->can('sponsor-category-list')) {
            $menuArr['can-sponsor-category-list'] = true;
            if (Request::segment(2) == 'sponsor-category') {
                $menuArr['sponsor_category_active'] = 'active';
                $menuArr['sponsor_category_open'] = 'open';
                $menuArr['sponsor_category_selected'] = 'selected';
                $menuArr['catmg'] = 'active';
            } else {
                $menuArr['sponsor_category_active'] = '';
                $menuArr['sponsor_category_open'] = '';
                $menuArr['sponsor_category_selected'] = '';
            }
        }

        if (Auth::user()->can('show-category-list')) {
            $menuArr['can-show-category-list'] = true;
            if (Request::segment(2) == 'show-category') {
                $menuArr['show_category_active'] = 'active';
                $menuArr['show_category_open'] = 'open';
                $menuArr['show_category_selected'] = 'selected';
                $menuArr['catmg'] = 'active';
            } else {
                $menuArr['show_category_active'] = '';
                $menuArr['show_category_open'] = '';
                $menuArr['show_category_selected'] = '';
            }
        }

        if (Auth::user()->can('careers-category-list')) {
            $menuArr['can-careers-category-list'] = true;
            if (Request::segment(2) == 'careers-category') {
                $menuArr['careers_category_active'] = 'active';
                $menuArr['careers_category_open'] = 'open';
                $menuArr['careers_category_selected'] = 'selected';
                $menuArr['catmg'] = 'active';
            } else {
                $menuArr['careers_category_active'] = '';
                $menuArr['careers_category_open'] = '';
                $menuArr['careers_category_selected'] = '';
            }
        }

        if (Auth::user()->can('projects-list')) {
            $menuArr['can-projects-list'] = true;
            if (Request::segment(2) == 'projects') {
                $menuArr['projects_active'] = 'active';
                $menuArr['projects_open'] = 'open';
                $menuArr['projects_selected'] = 'selected';
                $menuArr['realmg'] = 'active';
            } else {
                $menuArr['projects_active'] = '';
                $menuArr['projects_open'] = '';
                $menuArr['projects_selected'] = '';
            }
        }

        if (Auth::user()->can('services-list')) {
            $menuArr['can-services-list'] = true;
            if (Request::segment(2) == 'services') {
                $menuArr['services_active'] = 'active';
                $menuArr['services_open'] = 'open';
                $menuArr['services_selected'] = 'selected';
                $menuArr['contmg'] = 'active';
            } else {
                $menuArr['services_active'] = '';
                $menuArr['services_open'] = '';
                $menuArr['services_selected'] = '';
            }
        }

        if (Auth::user()->can('products-list')) {
            $menuArr['can-products-list'] = true;
            if (Request::segment(2) == 'products') {
                $menuArr['products_active'] = 'active';
                $menuArr['products_open'] = 'open';
                $menuArr['products_selected'] = 'selected';
                $menuArr['contmg'] = 'active';
            } else {
                $menuArr['products_active'] = '';
                $menuArr['products_open'] = '';
                $menuArr['products_selected'] = '';
            }
        }
        
        if (Auth::user()->can('products-package-list')) {
            $menuArr['can-products-package-list'] = true;
            if (Request::segment(2) == 'products-package') {
                $menuArr['products_package_active'] = 'active';
                $menuArr['products_package_open'] = 'open';
                $menuArr['products_package_selected'] = 'selected';
                $menuArr['contmg'] = 'active';
            } else {
                $menuArr['products_package_active'] = '';
                $menuArr['products_package_open'] = '';
                $menuArr['products_package_selected'] = '';
            }
        }

        if (Auth::user()->can('blogs-list')) {
            $menuArr['can-blogs-list'] = true;
            if (Request::segment(2) == 'blogs') {
                $menuArr['blogs_active'] = 'active';
                $menuArr['blogs_open'] = 'open';
                $menuArr['blogs_selected'] = 'selected';
                $menuArr['contmg'] = 'active';
            } else {
                $menuArr['blogs_active'] = '';
                $menuArr['blogs_open'] = '';
                $menuArr['blogs_selected'] = '';
            }
        }

        if (Auth::user()->can('news-list')) {
            $menuArr['can-news-list'] = true;
            if (Request::segment(2) == 'news') {
                $menuArr['news_active'] = 'active';
                $menuArr['news_open'] = 'open';
                $menuArr['news_selected'] = 'selected';
                $menuArr['contmg'] = 'active';
            } else {
                $menuArr['news_active'] = '';
                $menuArr['news_open'] = '';
                $menuArr['news_selected'] = '';
            }
        }

        if (Auth::user()->can('careers-list')) {
            $menuArr['can-careers-list'] = true;
            if (Request::segment(2) == 'careers') {
                $menuArr['careers_active'] = 'active';
                $menuArr['careers_open'] = 'open';
                $menuArr['careers_selected'] = 'selected';
                $menuArr['contmg'] = 'active';
            } else {
                $menuArr['careers_active'] = '';
                $menuArr['careers_open'] = '';
                $menuArr['careers_selected'] = '';
            }
        }

        if (Auth::user()->can('testimonial-list')) {
            $menuArr['can-testimonial-list'] = true;
            if (Request::segment(2) == 'testimonial') {
                $menuArr['testimonial_active'] = 'active';
                $menuArr['testimonial_open'] = 'open';
                $menuArr['testimonial_selected'] = 'selected';
                $menuArr['contmg'] = 'active';
            } else {
                $menuArr['testimonial_active'] = '';
                $menuArr['testimonial_open'] = '';
                $menuArr['testimonial_selected'] = '';
            }
        }

        if (Auth::user()->can('testimonials-list')) {
            $menuArr['can-testimonials-list'] = true;
            if (Request::segment(2) == 'testimonials') {
                $menuArr['testimonials_active'] = 'active';
                $menuArr['testimonials_open'] = 'open';
                $menuArr['testimonials_selected'] = 'selected';
                $menuArr['contmg'] = 'active';
            } else {
                $menuArr['testimonials_active'] = '';
                $menuArr['testimonials_open'] = '';
                $menuArr['testimonials_selected'] = '';
            }
        }
        
        if (Auth::user()->can('casestudy-list')) {
            $menuArr['can-casestudy-list'] = true;
            if (Request::segment(2) == 'casestudy') {
                $menuArr['casestudy_active'] = 'active';
                $menuArr['casestudy_open'] = 'open';
                $menuArr['casestudy_selected'] = 'selected';
                $menuArr['contmg'] = 'active';
            } else {
                $menuArr['casestudy_active'] = '';
                $menuArr['casestudy_open'] = '';
                $menuArr['casestudy_selected'] = '';
            }
        }
        if (Auth::user()->can('deals-list')) {
            $menuArr['can-deals-list'] = true;
            if (Request::segment(2) == 'deals') {
                $menuArr['deals_active'] = 'active';
                $menuArr['deals_open'] = 'open';
                $menuArr['deals_selected'] = 'selected';
                $menuArr['contmg'] = 'active';
            } else {
                $menuArr['deals_active'] = '';
                $menuArr['deals_open'] = '';
                $menuArr['deals_selected'] = '';
            }
        }

        if (Auth::user()->can('team-list')) {
            $menuArr['can-team-list'] = true;
            if (Request::segment(2) == 'team') {
                $menuArr['team_active'] = 'active';
                $menuArr['team_open'] = 'open';
                $menuArr['team_selected'] = 'selected';
                $menuArr['contmg'] = 'active';
            } else {
                $menuArr['team_active'] = '';
                $menuArr['team_open'] = '';
                $menuArr['team_selected'] = '';
            }
        }
        if (Auth::user()->can('tld-list')) {
            $menuArr['can-tld-list'] = true;
            if (Request::segment(2) == 'tld') {
                $menuArr['tld_active'] = 'active';
                $menuArr['tld_open'] = 'open';
                $menuArr['tld_selected'] = 'selected';
                $menuArr['contmg'] = 'active';
            } else {
                $menuArr['tld_active'] = '';
                $menuArr['tld_open'] = '';
                $menuArr['tld_selected'] = '';
            }
        }

        if (Auth::user()->can('events-list')) {
            $menuArr['can-events-list'] = true;
            if (Request::segment(2) == 'events') {
                $menuArr['events_active'] = 'active';
                $menuArr['events_open'] = 'open';
                $menuArr['events_selected'] = 'selected';
                $menuArr['contmg'] = 'active';
            } else {
                $menuArr['events_active'] = '';
                $menuArr['events_open'] = '';
                $menuArr['events_selected'] = '';
            }
        }

        if (Auth::user()->can('shows-list')) {
            $menuArr['can-shows-list'] = true;
            if (Request::segment(2) == 'shows') {
                $menuArr['shows_active'] = 'active';
                $menuArr['shows_open'] = 'open';
                $menuArr['shows_selected'] = 'selected';
                $menuArr['contmg'] = 'active';
            } else {
                $menuArr['shows_active'] = '';
                $menuArr['shows_open'] = '';
                $menuArr['shows_selected'] = '';
            }
        }

        if (Auth::user()->can('sponsor-list')) {
            $menuArr['can-sponsor-list'] = true;
            if (Request::segment(2) == 'sponsor') {
                $menuArr['sponsor_active'] = 'active';
                $menuArr['sponsor_open'] = 'open';
                $menuArr['sponsor_selected'] = 'selected';
                $menuArr['contmg'] = 'active';
            } else {
                $menuArr['sponsor_active'] = '';
                $menuArr['sponsor_open'] = '';
                $menuArr['sponsor_selected'] = '';
            }
        }

        if (Auth::user()->can('client-list')) {
            $menuArr['can-client-list'] = true;
            if (Request::segment(2) == 'client') {
                $menuArr['client_active'] = 'active';
                $menuArr['client_open'] = 'open';
                $menuArr['client_selected'] = 'selected';
                $menuArr['contmg'] = 'active';
            } else {
                $menuArr['client_active'] = '';
                $menuArr['client_open'] = '';
                $menuArr['client_selected'] = '';
            }
        }

        if (Auth::user()->can('faq-list')) {
            $menuArr['can-faq-list'] = true;
            if (Request::segment(2) == 'faq') {
                $menuArr['faq_active'] = 'active';
                $menuArr['faq_open'] = 'open';
                $menuArr['faq_selected'] = 'selected';
                $menuArr['contmg'] = 'active';
            } else {
                $menuArr['faq_active'] = '';
                $menuArr['faq_open'] = '';
                $menuArr['faq_selected'] = '';
            }
        }
        if (Auth::user()->can('general-faq-list')) {
            $menuArr['can-general-faq-list'] = true;
            if (Request::segment(2) == 'general-faq') {
                $menuArr['general_faq_active'] = 'active';
                $menuArr['general_faq_open'] = 'open';
                $menuArr['general_faq_selected'] = 'selected';
                $menuArr['contmg'] = 'active';
            } else {
                $menuArr['general_faq_active'] = '';
                $menuArr['general_faq_open'] = '';
                $menuArr['general_faq_selected'] = '';
            }
        }
        if (Auth::user()->can('product-features-list')) {
            $menuArr['can-product-features-list'] = true;
            if (Request::segment(2) == 'product-features') {
                $menuArr['product_features_active'] = 'active';
                $menuArr['product_features_open'] = 'open';
                $menuArr['product_features_selected'] = 'selected';
                $menuArr['contmg'] = 'active';
            } else {
                $menuArr['product_features_active'] = '';
                $menuArr['product_features_open'] = '';
                $menuArr['product_features_selected'] = '';
            }
        }
        if (Auth::user()->can('featured-products-list')) {
            $menuArr['can-featured-products-list'] = true;
            if (Request::segment(2) == 'featured-products') {
                $menuArr['featured_products_active'] = 'active';
                $menuArr['featured_products_open'] = 'open';
                $menuArr['featured_products_selected'] = 'selected';
                $menuArr['contmg'] = 'active';
            } else {
                $menuArr['featured_products_active'] = '';
                $menuArr['featured_products_open'] = '';
                $menuArr['featured_products_selected'] = '';
            }
        }

        if (Auth::user()->can('photo-album-list')) {
            $menuArr['can-photo-album-list'] = true;
            if (Request::segment(2) == 'photo-album') {
                $menuArr['photo_album_active'] = 'active';
                $menuArr['photo_album_open'] = 'open';
                $menuArr['photo_album_selected'] = 'selected';
                $menuArr['albummg'] = 'active';
            } else {
                $menuArr['photo_album_active'] = '';
                $menuArr['photo_album_open'] = '';
                $menuArr['photo_album_selected'] = '';
            }
        }

        if (Auth::user()->can('video-album-list')) {
            $menuArr['can-video-album-list'] = true;
            if (Request::segment(2) == 'video-album') {
                $menuArr['video_album_active'] = 'active';
                $menuArr['video_album_open'] = 'open';
                $menuArr['video_album_selected'] = 'selected';
                $menuArr['albummg'] = 'active';
            } else {
                $menuArr['video_album_active'] = '';
                $menuArr['video_album_open'] = '';
                $menuArr['video_album_selected'] = '';
            }
        }

        if (Auth::user()->can('photo-gallery-list')) {
            $menuArr['can-photo-gallery-list'] = true;
            if (Request::segment(2) == 'photo-gallery') {
                $menuArr['photo_gallery_active'] = 'active';
                $menuArr['photo_gallery_open'] = 'open';
                $menuArr['photo_gallery_selected'] = 'selected';
                $menuArr['gallarymg'] = 'active';
            } else {
                $menuArr['photo_gallery_active'] = '';
                $menuArr['photo_gallery_open'] = '';
                $menuArr['photo_gallery_selected'] = '';
            }
        }

        if (Auth::user()->can('video-gallery-list')) {
            $menuArr['can-video-gallery-list'] = true;
            if (Request::segment(2) == 'video-gallery') {
                $menuArr['video_galary_active'] = 'active';
                $menuArr['video_galary_open'] = 'open';
                $menuArr['video_galary_selected'] = 'selected';
                $menuArr['gallarymg'] = 'active';
            } else {
                $menuArr['video_galary_active'] = '';
                $menuArr['video_galary_open'] = '';
                $menuArr['video_galary_selected'] = '';
            }
        }

        if (Auth::user()->can('advertise-list')) {
            $menuArr['can-advertise-list'] = true;
            if (Request::segment(2) == 'advertise') {
                $menuArr['ads_active'] = 'active';
                $menuArr['ads_selected'] = 'open';
                $menuArr['ad_selected'] = 'selected';
                $menuArr['admanager'] = 'active';
            } else {
                $menuArr['ads_active'] = '';
                $menuArr['ads_selected'] = '';
                $menuArr['ad_selected'] = '';
            }
        }

        if (Auth::user()->can('roles-list')) {
            $menuArr['can-roles-list'] = true;
            if (Request::segment(2) == 'roles') {
                $menuArr['roles_active'] = 'active';
                $menuArr['roles_open'] = 'open';
                $menuArr['roles_selected'] = 'selected';
                $menuArr['usermg'] = 'active';
            } else {
                $menuArr['roles_active'] = '';
                $menuArr['roles_open'] = '';
                $menuArr['roles_selected'] = '';
            }
        }

        if (Auth::user()->can('users-list')) {
            $menuArr['can-users-list'] = true;
            if (Request::segment(2) == 'users') {
                $menuArr['users_active'] = 'active';
                $menuArr['users_open'] = 'open';
                $menuArr['users_selected'] = 'selected';
                $menuArr['usermg'] = 'active';
            } else {
                $menuArr['users_active'] = '';
                $menuArr['users_open'] = '';
                $menuArr['users_selected'] = '';
            }
        }

        if (Auth::user()->can('email-log-list')) {
            $menuArr['can-email-log-list'] = true;
            if (Request::segment(2) == 'email-log') {
                $menuArr['email_active'] = 'active';
                $menuArr['email_open'] = 'open';
                $menuArr['email_selected'] = 'selected';
                $menuArr['logmg'] = 'active';
            } else {
                $menuArr['email_active'] = '';
                $menuArr['email_open'] = '';
                $menuArr['email_selected'] = '';
            }
        }

        if (Auth::user()->can('log-list')) {
            $menuArr['can-log-list'] = true;
            if (Request::segment(2) == 'log') {
                $menuArr['log_active'] = 'active';
                $menuArr['log_open'] = 'open';
                $menuArr['log_selected'] = 'selected';
                $menuArr['logmg'] = 'active';
            } else {
                $menuArr['log_active'] = '';
                $menuArr['log_open'] = '';
                $menuArr['log_selected'] = '';
            }
        }

        if (Auth::user()->can('login-history-list')) {
            $menuArr['can-login-history'] = true;
            if (Request::segment(2) == 'login-history') {
                $menuArr['login_history_active'] = 'active';
                $menuArr['login_history_open'] = 'open';
                $menuArr['login_history_selected'] = 'selected';
                $menuArr['login_historymg'] = 'active';
            } else {
                $menuArr['login_history_active'] = '';
                $menuArr['login_history_open'] = '';
                $menuArr['login_history_selected'] = '';
            }
        }

        if (Auth::user()->can('recent-updates-list')) {
            $menuArr['can-recent-updates-list'] = true;
            if (Request::segment(2) == 'recent-updates') {
                $menuArr['recent_active'] = 'active';
                $menuArr['recent_open'] = 'open';
                $menuArr['recent_selected'] = 'selected';
                $menuArr['recmg'] = 'active';
            } else {
                $menuArr['recent_active'] = '';
                $menuArr['recent_open'] = '';
                $menuArr['recent_selected'] = '';
            }
        }

        return $menuArr;
    }

}
