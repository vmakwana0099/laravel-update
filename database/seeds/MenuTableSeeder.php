<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Helpers\MyLibrary;
use App\Http\Traits\slug;

class MenuTableSeeder extends Seeder
{
		public function run()
		{
			$moduleCode = DB::table('module')->select('id')->where('varModuleName','menu')->first();	
									

					DB::table('menu')->insert([
						'intParentMenuId' => 0,
						'intItemOrder' => 1,
						'intParentItemOrder' => 1,
						'intPosition' => 1,
						'intAliasId' => MyLibrary::insertAlias(slug::create_slug('Home')[0],$moduleCode->id),
						'intPageId' => null,
						'varTitle' => 'Home',
						'txtPageUrl' => '/', 
						'chrActive' => 'Y',
						'chrMegaMenu' => 'N',
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);
					
						

					DB::table('menu')->insert([
						'intParentMenuId' => 0,
						'intItemOrder' => 2,
						'intParentItemOrder' => 1,
						'intPosition' => 1,
						'intAliasId' => MyLibrary::insertAlias(slug::create_slug('Services')[0],$moduleCode->id),
						'intPageId' => null,
						'varTitle' => 'Services',
						'txtPageUrl' => 'services', 
						'chrActive' => 'Y',
						'chrMegaMenu' => 'N',
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);
					
						

					DB::table('menu')->insert([
						'intParentMenuId' => 0,
						'intItemOrder' => 3,
						'intParentItemOrder' => 1,
						'intPosition' => 1,
						'intAliasId' => MyLibrary::insertAlias(slug::create_slug('Team')[0],$moduleCode->id),
						'intPageId' => null,
						'varTitle' => 'Team',
						'txtPageUrl' => 'team', 
						'chrActive' => 'Y',
						'chrMegaMenu' => 'N',
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);
					
						

					DB::table('menu')->insert([
						'intParentMenuId' => 0,
						'intItemOrder' => 4,
						'intParentItemOrder' => 1,
						'intPosition' => 1,
						'intAliasId' => MyLibrary::insertAlias(slug::create_slug('Testimonials')[0],$moduleCode->id),
						'intPageId' => null,
						'varTitle' => 'Testimonials',
						'txtPageUrl' => 'testimonial', 
						'chrActive' => 'Y',
						'chrMegaMenu' => 'N',
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);
					
						

					DB::table('menu')->insert([
						'intParentMenuId' => 0,
						'intItemOrder' => 5,
						'intParentItemOrder' => 1,
						'intPosition' => 1,
						'intAliasId' => MyLibrary::insertAlias(slug::create_slug('Blog')[0],$moduleCode->id),
						'intPageId' => null,
						'varTitle' => 'Blog',
						'txtPageUrl' => 'blog', 
						'chrActive' => 'Y',
						'chrMegaMenu' => 'N',
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);
					
						

					DB::table('menu')->insert([
						'intParentMenuId' => 0,
						'intItemOrder' => 6,
						'intParentItemOrder' => 1,
						'intPosition' => 1,
						'intAliasId' => MyLibrary::insertAlias(slug::create_slug('News')[0],$moduleCode->id),
						'intPageId' => null,
						'varTitle' => 'News',
						'txtPageUrl' => 'news', 
						'chrActive' => 'Y',
						'chrMegaMenu' => 'N',
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);
					
						

					DB::table('menu')->insert([
						'intParentMenuId' => 0,
						'intItemOrder' => 7,
						'intParentItemOrder' => 1,
						'intPosition' => 1,
						'intAliasId' => MyLibrary::insertAlias(slug::create_slug('Photo Album')[0],$moduleCode->id),
						'intPageId' => null,
						'varTitle' => 'Photo Album',
						'txtPageUrl' => 'photo-album', 
						'chrActive' => 'Y',
						'chrMegaMenu' => 'N',
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);
					
						

					DB::table('menu')->insert([
						'intParentMenuId' => 0,
						'intItemOrder' => 8,
						'intParentItemOrder' => 1,
						'intPosition' => 1,
						'intAliasId' => MyLibrary::insertAlias(slug::create_slug('Video Album')[0],$moduleCode->id),
						'intPageId' => null,
						'varTitle' => 'Video Album',
						'txtPageUrl' => 'video-album', 
						'chrActive' => 'Y',
						'chrMegaMenu' => 'N',
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);
					
						

					DB::table('menu')->insert([
						'intParentMenuId' => 0,
						'intItemOrder' => 9,
						'intParentItemOrder' => 1,
						'intPosition' => 1,
						'intAliasId' => MyLibrary::insertAlias(slug::create_slug('FAQ')[0],$moduleCode->id),
						'intPageId' => null,
						'varTitle' => 'FAQ',
						'txtPageUrl' => 'faq', 
						'chrActive' => 'Y',
						'chrMegaMenu' => 'N',
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);
					
						

					DB::table('menu')->insert([
						'intParentMenuId' => 0,
						'intItemOrder' => 10,
						'intParentItemOrder' => 1,
						'intPosition' => 1,
						'intAliasId' => MyLibrary::insertAlias(slug::create_slug('About us')[0],$moduleCode->id),
						'intPageId' => null,
						'varTitle' => 'About us',
						'txtPageUrl' => 'about-us', 
						'chrActive' => 'Y',
						'chrMegaMenu' => 'N',
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);
					
						

					DB::table('menu')->insert([
						'intParentMenuId' => 0,
						'intItemOrder' => 11,
						'intParentItemOrder' => 1,
						'intPosition' => 1,
						'intAliasId' => MyLibrary::insertAlias(slug::create_slug('Contact us')[0],$moduleCode->id),
						'intPageId' => null,
						'varTitle' => 'Contact us',
						'txtPageUrl' => 'contact-us', 
						'chrActive' => 'Y',
						'chrMegaMenu' => 'N',
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);

					DB::table('menu')->insert([
						'intParentMenuId' => 0,
						'intItemOrder' => 11,
						'intParentItemOrder' => 1,
						'intPosition' => 2,
						'intAliasId' => MyLibrary::insertAlias(slug::create_slug('Privacy Policy')[0],$moduleCode->id),
						'intPageId' => null,
						'varTitle' => 'Contact us',
						'txtPageUrl' => 'contact-us', 
						'chrActive' => 'Y',
						'chrMegaMenu' => 'N',
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);

					DB::table('menu')->insert([
						'intParentMenuId' => 0,
						'intItemOrder' => 11,
						'intParentItemOrder' => 2,
						'intPosition' => 2,
						'intAliasId' => MyLibrary::insertAlias(slug::create_slug('Terms & Conditions')[0],$moduleCode->id),
						'intPageId' => null,
						'varTitle' => 'Contact us',
						'txtPageUrl' => 'contact-us', 
						'chrActive' => 'Y',
						'chrMegaMenu' => 'N',
						'chrPublish' => 'Y',
						'chrDelete' => 'N',
						'created_at'=> Carbon::now(),
						'updated_at'=> Carbon::now()
					]);
					
								
		}
}
