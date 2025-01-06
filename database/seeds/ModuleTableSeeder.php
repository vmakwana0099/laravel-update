<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ModuleTableSeeder extends Seeder
{
		public function run()
		{
									
					DB::table('module')->insert([
						'varTitle' => 'Front Home',
						'varModuleName' =>  'home',
						'varTableName' => '',
						'varModelName' => '',
						'varModuleClass' => 'HomeController',
						'intDisplayOrder' => 1,
						'chrIsFront' => 'N',
						'chrIsPowerpanel' => 'N',
						'decVersion' => 1.0,
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'varPermissions'=>'',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);

					DB::table('module')->insert([
						'varTitle' => 'Banners',
						'varModuleName' =>  'banners',
						'varTableName' => 'banner',
						'varModelName' => 'Banner',
						'varModuleClass' => 'BannerController',
						'intDisplayOrder' => 2,
						'chrIsFront' => 'N',
						'chrIsPowerpanel' => 'Y',
						'decVersion' => 1.0,
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'varPermissions'=>'list, create, edit, delete, publish',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);
					
						
					
					DB::table('module')->insert([
						'varTitle' => 'Blogs',
						'varModuleName' =>  'blogs',
						'varTableName' => 'blog',
						'varModelName' => 'Blogs',
						'varModuleClass' => 'BlogsController',
						'intDisplayOrder' => 3,
						'chrIsFront' => 'Y',
						'chrIsPowerpanel' => 'Y',
						'decVersion' => 1.0,
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'varPermissions'=>'list, create, edit, delete, publish',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);
					
						
					
					DB::table('module')->insert([
						'varTitle' => 'Contact Us',
						'varModuleName' =>  'contact-us',
						'varTableName' => 'contact_lead',
						'varModelName' => 'ContactLead',
						'varModuleClass' => 'ContactleadController',
						'intDisplayOrder' => 4,
						'chrIsFront' => 'Y',
						'chrIsPowerpanel' => 'Y',
						'decVersion' => 2.0,
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'varPermissions'=>'list, delete',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);

					
					DB::table('module')->insert([
						'varTitle' => 'FAQ',
						'varModuleName' =>  'faq',
						'varTableName' => 'faq',
						'varModelName' => 'Faq',
						'varModuleClass' => 'FaqController',
						'intDisplayOrder' => 5,
						'chrIsFront' => 'Y',
						'chrIsPowerpanel' => 'Y',
						'decVersion' => 2.0,
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'varPermissions'=>'list, create, edit, delete, publish',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);
						
					DB::table('module')->insert([
						'varTitle' => 'Appointment Lead',
						'varModuleName' =>  'appointment-lead',
						'varTableName' => 'appointment_lead',
						'varModelName' => 'AppointmentLead',
						'varModuleClass' => 'AppointmentLeadController',
						'intDisplayOrder' => 6,
						'chrIsFront' => 'Y',
						'chrIsPowerpanel' => 'Y',
						'decVersion' => 2.0,
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'varPermissions'=>'list, delete',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);		

					DB::table('module')->insert([
						'varTitle' => 'Services',
						'varModuleName' =>  'services',
						'varTableName' => 'services',
						'varModelName' => 'Services',
						'varModuleClass' => 'ServicesController',
						'intDisplayOrder' => 7,
						'chrIsFront' => 'Y',
						'chrIsPowerpanel' => 'Y',
						'decVersion' => 1.0,
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'varPermissions'=>'list, create, edit, delete, publish',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);

					DB::table('module')->insert([
						'varTitle' => 'Restaurant Menu',
						'varModuleName' =>  'restaurant-menu',
						'varTableName' => 'restaurant_menu_items',
						'varModelName' => 'RestaurantMenu',
						'varModuleClass' => 'RestaurantMenuController',
						'intDisplayOrder' => 8,
						'chrIsFront' => 'Y',
						'chrIsPowerpanel' => 'Y',
						'decVersion' => 1.0,
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'varPermissions'=>'list, create, edit, delete, publish',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);	

					DB::table('module')->insert([
						'varTitle' => 'Restaurant Reservations',
						'varModuleName' =>  'restaurant-reservations',
						'varTableName' => 'restaurant_reservations_lead',
						'varModelName' => 'RestaurantReservations',
						'varModuleClass' => 'RestaurantReservationsController',
						'intDisplayOrder' => 9,
						'chrIsFront' => 'Y',
						'chrIsPowerpanel' => 'Y',
						'decVersion' => 2.0,
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'varPermissions'=>'list, delete',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);				
						
					
					DB::table('module')->insert([
						'varTitle' => 'Testimonial',
						'varModuleName' =>  'testimonial',
						'varTableName' => 'testimonials',
						'varModelName' => 'Testimonial',
						'varModuleClass' => 'TestimonialController',
						'intDisplayOrder' => 10,
						'chrIsFront' => 'Y',
						'chrIsPowerpanel' => 'Y',
						'decVersion' => 1.0,
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'varPermissions'=>'list, create, edit, delete, publish',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);
					
						
					
					DB::table('module')->insert([
						'varTitle' => 'Menu',
						'varModuleName' =>  'menu',
						'varTableName' => 'menu',
						'varModelName' => 'Menu',
						'varModuleClass' => 'MenuController',
						'intDisplayOrder' => 11,
						'chrIsFront' => 'N',
						'chrIsPowerpanel' => 'Y',
						'decVersion' => 3.0,
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'varPermissions'=>'list, create, edit, delete',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);
					
						
					
					DB::table('module')->insert([
						'varTitle' => 'Team',
						'varModuleName' =>  'team',
						'varTableName' => 'team',
						'varModelName' => 'Team',
						'varModuleClass' => 'TeamController',
						'intDisplayOrder' => 12,
						'chrIsFront' => 'Y',
						'chrIsPowerpanel' => 'Y',
						'decVersion' => 2.0,
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'varPermissions'=>'list, create, edit, delete, publish',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);
					
						
					
					DB::table('module')->insert([
						'varTitle' => 'Pages',
						'varModuleName' =>  'pages',
						'varTableName' => 'pages',
						'varModelName' => 'CmsPage',
						'varModuleClass' => 'CmsPagesController',
						'intDisplayOrder' => 13,
						'chrIsFront' => 'Y',
						'chrIsPowerpanel' => 'Y',
						'decVersion' => 1.0,
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'varPermissions'=>'list, create, edit, delete, publish',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);
					
						
					
					DB::table('module')->insert([
						'varTitle' => 'News Letter',
						'varModuleName' =>  'newsletter-lead',
						'varTableName' => 'newsletter_lead',
						'varModelName' => 'NewsletterLead',
						'varModuleClass' => 'NewsletterController',
						'intDisplayOrder' => 14,
						'chrIsFront' => 'N',
						'chrIsPowerpanel' => 'Y',
						'decVersion' => 1.0,
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'varPermissions'=>'list, delete',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);
					
						
					
					DB::table('module')->insert([
						'varTitle' => 'Recent Updates',
						'varModuleName' =>  'recent-updates',
						'varTableName' => 'notifications',
						'varModelName' => 'RecentUpdates',
						'varModuleClass' => 'RecentUpdateController',
						'intDisplayOrder' => 15,
						'chrIsFront' => 'N',
						'chrIsPowerpanel' => 'Y',
						'decVersion' => 1.0,
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'varPermissions'=>'list',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);
					
						
					
					DB::table('module')->insert([
						'varTitle' => 'Static Blocks',
						'varModuleName' =>  'static-block',
						'varTableName' => 'static_block',
						'varModelName' => 'StaticBlocks',
						'varModuleClass' => 'StaticBlocksController',
						'intDisplayOrder' => 16,
						'chrIsFront' => 'N',
						'chrIsPowerpanel' => 'Y',
						'decVersion' => 1.0,
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'varPermissions'=>'list, create, edit, delete, publish',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);
					
						
					
					DB::table('module')->insert([
						'varTitle' => 'Contact Info',
						'varModuleName' =>  'contact-info',
						'varTableName' => 'contact_info',
						'varModelName' => 'ContactInfo',
						'varModuleClass' => 'ContactInfoController',
						'intDisplayOrder' => 17,
						'chrIsFront' => 'N',
						'chrIsPowerpanel' => 'Y',
						'decVersion' => 1.0,
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'varPermissions'=>'list, create, edit, delete, publish',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);
					
						
					
					DB::table('module')->insert([
						'varTitle' => 'PopUp',
						'varModuleName' =>  'popup',
						'varTableName' => 'pop_up_content',
						'varModelName' => 'PopUpContent',
						'varModuleClass' => 'PopUpController',
						'intDisplayOrder' => 18,
						'chrIsFront' => 'N',
						'chrIsPowerpanel' => 'Y',
						'decVersion' => 1.0,
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'varPermissions'=>'list, create, edit, delete, publish',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);
					
						
					
					DB::table('module')->insert([
						'varTitle' => 'News',
						'varModuleName' =>  'news',
						'varTableName' => 'news',
						'varModelName' => 'News',
						'varModuleClass' => 'NewsController',
						'intDisplayOrder' => 35,
						'chrIsFront' => 'Y',
						'chrIsPowerpanel' => 'Y',
						'decVersion' => 1.0,
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'varPermissions'=>'list, create, edit, delete, publish',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);
					
						
					
					DB::table('module')->insert([
						'varTitle' => 'Photo Album',
						'varModuleName' =>  'photo-album',
						'varTableName' => 'photo_album',
						'varModelName' => 'PhotoAlbum',
						'varModuleClass' => 'PhotoAlbumController',
						'intDisplayOrder' => 36,
						'chrIsFront' => 'Y',
						'chrIsPowerpanel' => 'Y',
						'decVersion' => 1.0,
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'varPermissions'=>'list, create, edit, delete, publish',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);
					
						
					
					DB::table('module')->insert([
						'varTitle' => 'Photo Gallery',
						'varModuleName' =>  'photo-gallery',
						'varTableName' => 'photo_gallery',
						'varModelName' => 'PhotoGallery',
						'varModuleClass' => 'PhotoGalleryController',
						'intDisplayOrder' => 37,
						'chrIsFront' => 'N',
						'chrIsPowerpanel' => 'Y',
						'decVersion' => 1.0,
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'varPermissions'=>'list, create, edit, delete, publish',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);
					
						
					
					DB::table('module')->insert([
						'varTitle' => 'News Category',
						'varModuleName' =>  'news-category',
						'varTableName' => 'news_category',
						'varModelName' => 'NewsCategory',
						'varModuleClass' => 'NewsCategoryController',
						'intDisplayOrder' => 38,
						'chrIsFront' => 'N',
						'chrIsPowerpanel' => 'Y',
						'decVersion' => 1.0,
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'varPermissions'=>'list, create, edit, delete, publish',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);

					DB::table('module')->insert([
						'varTitle' => 'Event Category',
						'varModuleName' =>  'event-category',
						'varTableName' => 'event_category',
						'varModelName' => 'EventCategory',
						'varModuleClass' => 'EventCategoryController',
						'intDisplayOrder' => 38,
						'chrIsFront' => 'N',
						'chrIsPowerpanel' => 'Y',
						'decVersion' => 1.0,
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'varPermissions'=>'list, create, edit, delete, publish',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);
					
						
					
					DB::table('module')->insert([
						'varTitle' => 'Plugins',
						'varModuleName' =>  'plugins',
						'varTableName' => '',
						'varModelName' => '',
						'varModuleClass' => '',
						'intDisplayOrder' => 39,
						'chrIsFront' => 'N',
						'chrIsPowerpanel' => 'Y',
						'decVersion' => 1.0,
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'varPermissions'=>'list, create, edit, delete, publish',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);
					
						
					
					DB::table('module')->insert([
						'varTitle' => 'Video Album',
						'varModuleName' =>  'video-album',
						'varTableName' => 'video_album',
						'varModelName' => 'VideoAlbum',
						'varModuleClass' => 'VideoAlbumController',
						'intDisplayOrder' => 40,
						'chrIsFront' => 'Y',
						'chrIsPowerpanel' => 'Y',
						'decVersion' => 1.0,
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'varPermissions'=>'list, create, edit, delete, publish',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);
					
						
					
					DB::table('module')->insert([
						'varTitle' => 'Video Gallery',
						'varModuleName' =>  'video-gallery',
						'varTableName' => 'video_gallery',
						'varModelName' => 'VideoGallery',
						'varModuleClass' => 'VideoGalleryController',
						'intDisplayOrder' => 41,
						'chrIsFront' => 'Y',
						'chrIsPowerpanel' => 'Y',
						'decVersion' => 1.0,
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'varPermissions'=>'list, create, edit, delete, publish',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);
					
						
					
					DB::table('module')->insert([
						'varTitle' => 'Sitemap',
						'varModuleName' =>  'sitemap',
						'varTableName' => '',
						'varModelName' => '',
						'varModuleClass' => '',
						'intDisplayOrder' => 42,
						'chrIsFront' => 'N',
						'chrIsPowerpanel' => 'Y',
						'decVersion' => 1.0,
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'varPermissions'=>'list, create, edit, delete, publish',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);
					
						
					
					DB::table('module')->insert([
						'varTitle' => 'Services Category',
						'varModuleName' =>  'service-category',
						'varTableName' => 'service_category',
						'varModelName' => 'ServiceCategory',
						'varModuleClass' => 'ServiceCategoryController',
						'intDisplayOrder' => 43,
						'chrIsFront' => 'N',
						'chrIsPowerpanel' => 'Y',
						'decVersion' => 1.0,
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'varPermissions'=>'list, create, edit, delete, publish',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);

					DB::table('module')->insert([
						'varTitle' => 'Restaurant Menu Category',
						'varModuleName' =>  'restaurant-menu-category',
						'varTableName' => 'restaurant_menu_category',
						'varModelName' => 'RestaurantMenuCategory',
						'varModuleClass' => 'RestaurantMenuCategoryController',
						'intDisplayOrder' => 43,
						'chrIsFront' => 'N',
						'chrIsPowerpanel' => 'Y',
						'decVersion' => 1.0,
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'varPermissions'=>'list, create, edit, delete, publish',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);
					
						
					
					DB::table('module')->insert([
						'varTitle' => 'Sponsors',
						'varModuleName' =>  'sponsor',
						'varTableName' => 'sponsor',
						'varModelName' => 'Sponsor',
						'varModuleClass' => 'SponsorController',
						'intDisplayOrder' => 44,
						'chrIsFront' => 'Y',
						'chrIsPowerpanel' => 'Y',
						'decVersion' => 1.0,
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'varPermissions'=>'list, create, edit, delete, publish',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);


					DB::table('module')->insert([
						'varTitle' => 'Client',
						'varModuleName' =>  'client',
						'varTableName' => 'client',
						'varModelName' => 'Client',
						'varModuleClass' => 'ClientController',
						'intDisplayOrder' => 44,
						'chrIsFront' => 'Y',
						'chrIsPowerpanel' => 'Y',
						'decVersion' => 1.0,
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'varPermissions'=>'list, create, edit, delete, publish',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);
					
						
					
					DB::table('module')->insert([
						'varTitle' => 'Sponsor Category',
						'varModuleName' =>  'sponsor-category',
						'varTableName' => 'sponsor_category',
						'varModelName' => 'SponsorCategory',
						'varModuleClass' => 'SponsorCategoryController',
						'intDisplayOrder' => 45,
						'chrIsFront' => 'N',
						'chrIsPowerpanel' => 'Y',
						'decVersion' => 1.0,
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'varPermissions'=>'list, create, edit, delete, publish',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);
					
						
					
					DB::table('module')->insert([
						'varTitle' => 'Blog Category',
						'varModuleName' =>  'blog-category',
						'varTableName' => 'blog_category',
						'varModelName' => 'BlogCategory',
						'varModuleClass' => 'BlogCategoryController',
						'intDisplayOrder' => 46,
						'chrIsFront' => 'N',
						'chrIsPowerpanel' => 'Y',
						'decVersion' => 1.0,
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'varPermissions'=>'list, create, edit, delete, publish',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);
					
						
					
					DB::table('module')->insert([
						'varTitle' => 'Menu Type',
						'varModuleName' =>  'menu-type',
						'varTableName' => 'menu_type',
						'varModelName' => 'MenuType',
						'varModuleClass' => '',
						'intDisplayOrder' => 48,
						'chrIsFront' => 'N',
						'chrIsPowerpanel' => 'Y',
						'decVersion' => 1.0,
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'varPermissions'=>'list, create, edit, delete',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);
					
						
					
					DB::table('module')->insert([
						'varTitle' => 'Events',
						'varModuleName' =>  'events',
						'varTableName' => 'event',
						'varModelName' => 'Events',
						'varModuleClass' => 'EventsController',
						'intDisplayOrder' => 49,
						'chrIsFront' => 'Y',
						'chrIsPowerpanel' => 'Y',
						'decVersion' => 1.0,
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'varPermissions'=>'list, create, edit, delete, publish',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);
					
						
					
					DB::table('module')->insert([
						'varTitle' => 'Shows Category',
						'varModuleName' =>  'show-category',
						'varTableName' => 'show_category',
						'varModelName' => 'ShowCategory',
						'varModuleClass' => 'ShowCategoryController',
						'intDisplayOrder' => 57,
						'chrIsFront' => 'N',
						'chrIsPowerpanel' => 'N',
						'decVersion' => 1.0,
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'varPermissions'=>'list, create, edit, delete, publish',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);
					
						
					
					DB::table('module')->insert([
						'varTitle' => 'Product Category',
						'varModuleName' =>  'product-category',
						'varTableName' => 'product_category',
						'varModelName' => 'ProductCategory',
						'varModuleClass' => 'ProductCategoryController',
						'intDisplayOrder' => 51,
						'chrIsFront' => 'N',
						'chrIsPowerpanel' => 'Y',
						'decVersion' => 1.0,
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'varPermissions'=>'list, create, edit, delete, publish',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);
					
						
					
					DB::table('module')->insert([
						'varTitle' => 'Products',
						'varModuleName' =>  'products',
						'varTableName' => 'products',
						'varModelName' => 'Products',
						'varModuleClass' => 'ProductController',
						'intDisplayOrder' => 52,
						'chrIsFront' => 'N',
						'chrIsPowerpanel' => 'Y',
						'decVersion' => 1.0,
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'varPermissions'=>'list, create, edit, delete, publish',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);
					
						
					
					DB::table('module')->insert([
						'varTitle' => 'Shows',
						'varModuleName' =>  'shows',
						'varTableName' => 'show',
						'varModelName' => 'Show',
						'varModuleClass' => 'ShowController',
						'intDisplayOrder' => 54,
						'chrIsFront' => 'Y',
						'chrIsPowerpanel' => 'Y',
						'decVersion' => 1.0,
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'varPermissions'=>'list, create, edit, delete, publish',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);
					
					DB::table('module')->insert([
						'varTitle' => 'Advertise',
						'varModuleName' =>  'advertise',
						'varTableName' => 'advertises',
						'varModelName' => 'Advertise',
						'varModuleClass' => 'AdvertiseController',
						'intDisplayOrder' => 56,
						'chrIsFront' => 'N',
						'chrIsPowerpanel' => 'N',
						'decVersion' => 1.0,
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'varPermissions'=>'list, create, edit, delete, publish',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);
					
						
					
					DB::table('module')->insert([
						'varTitle' => 'Email Log',
						'varModuleName' =>  'email-log',
						'varTableName' => 'email_log',
						'varModelName' => 'EmailLog',
						'varModuleClass' => 'EmailLogController',
						'intDisplayOrder' => 59,
						'chrIsFront' => 'N',
						'chrIsPowerpanel' => 'Y',
						'decVersion' => 1.0,
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'varPermissions'=>'list,delete',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);
					
						
					
					DB::table('module')->insert([
						'varTitle' => 'log',
						'varModuleName' =>  'log',
						'varTableName' => 'log',
						'varModelName' => 'Log',
						'varModuleClass' => 'LogController',
						'intDisplayOrder' => 60,
						'chrIsFront' => 'N',
						'chrIsPowerpanel' => 'Y',
						'decVersion' => 1.0,
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'varPermissions'=>'list, delete, advanced',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);
					
								
					DB::table('module')->insert([
						'varTitle' => 'Users',
						'varModuleName' =>  'users',
						'varTableName' => 'users',
						'varModelName' => 'User',
						'varModuleClass' => 'UserController',
						'intDisplayOrder' => 0,
						'chrIsFront' => 'N',
						'chrIsPowerpanel' => 'Y',
						'decVersion' => 1.0,
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'varPermissions'=>'list, create, edit, delete, publish',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);

					DB::table('module')->insert([
						'varTitle' => 'Role',
						'varModuleName' =>  'roles',
						'varTableName' => 'roles',
						'varModelName' => 'Role',
						'varModuleClass' => 'RoleController',
						'intDisplayOrder' => 0,
						'chrIsFront' => 'N',
						'chrIsPowerpanel' => 'Y',
						'decVersion' => 1.0,
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'varPermissions'=>'list, create, edit, delete, publish',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);

					DB::table('module')->insert([
						'varTitle' => 'Profile',
						'varModuleName' =>  'changeprofile',
						'varTableName' => 'users',
						'varModelName' => 'User',
						'varModuleClass' => 'ProfileController',
						'intDisplayOrder' => 0,
						'chrIsFront' => 'N',
						'chrIsPowerpanel' => 'Y',
						'decVersion' => 1.0,
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'varPermissions'=>'edit, change-password',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);

					DB::table('module')->insert([
						'varTitle' => 'General Setting',
						'varModuleName' =>  'settings',
						'varTableName' => 'general_setting',
						'varModelName' => 'GeneralSettings',
						'varModuleClass' => 'SettingsController',
						'intDisplayOrder' => 0,
						'chrIsFront' => 'N',
						'chrIsPowerpanel' => 'Y',
						'decVersion' => 1.0,
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'varPermissions'=>'general-setting-management, smtp-mail-setting, seo-setting, social-setting, social-media-share-setting, other-setting, maintenance-setting, module-setting,recent-activities',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);

					DB::table('module')->insert([
						'varTitle' => 'Login history',
						'varModuleName' =>  'login-history',
						'varTableName' => 'login_history',
						'varModelName' => 'Login History',
						'varModuleClass' => 'LoginHistoryController',
						'intDisplayOrder' => 61,
						'chrIsFront' => 'N',
						'chrIsPowerpanel' => 'Y',
						'decVersion' => 1.0,
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'varPermissions'=>'list, delete',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);

					DB::table('module')->insert([
						'varTitle' => 'Careers Category',
						'varModuleName' =>  'careers-category',
						'varTableName' => 'careers_category',
						'varModelName' => 'CareersCategory',
						'varModuleClass' => 'CareersCategoryController',
						'intDisplayOrder' => 62,
						'chrIsFront' => 'N',
						'chrIsPowerpanel' => 'Y',
						'decVersion' => 1.0,
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'varPermissions'=>'list, create, edit, delete, publish',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);

					DB::table('module')->insert([
						'varTitle' => 'Careers',
						'varModuleName' =>  'careers',
						'varTableName' => 'careers',
						'varModelName' => 'Careers',
						'varModuleClass' => 'CareersController',
						'intDisplayOrder' => 63,
						'chrIsFront' => 'Y',
						'chrIsPowerpanel' => 'Y',
						'decVersion' => 1.0,
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'varPermissions'=>'list, create, edit, delete, publish',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);

					DB::table('module')->insert([
						'varTitle' => 'Events Leads',
						'varModuleName' =>  'event-leads',
						'varTableName' => 'event_lead',
						'varModelName' => 'EventLead',
						'varModuleClass' => 'EventleadController',
						'intDisplayOrder' => 64,
						'chrIsFront' => 'N',
						'chrIsPowerpanel' => 'Y',
						'decVersion' => 1.0,
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'varPermissions'=>'list, delete',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);

					DB::table('module')->insert([
						'varTitle' => 'Project Category',
						'varModuleName' =>  'project-category',
						'varTableName' => 'project_category',
						'varModelName' => 'ProjectCategory',
						'varModuleClass' => 'ProjectCategoryController',
						'intDisplayOrder' => 65,
						'chrIsFront' => 'N',
						'chrIsPowerpanel' => 'Y',
						'decVersion' => 1.0,
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'varPermissions'=>'list, create, edit, delete, publish',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);

					DB::table('module')->insert([
						'varTitle' => 'Projects',
						'varModuleName' =>  'projects',
						'varTableName' => 'projects',
						'varModelName' => 'Projects',
						'varModuleClass' => 'ProjectController',
						'intDisplayOrder' => 66,
						'chrIsFront' => 'Y',
						'chrIsPowerpanel' => 'Y',
						'decVersion' => 1.0,
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'varPermissions'=>'list, create, edit, delete, publish',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);
		}
}
