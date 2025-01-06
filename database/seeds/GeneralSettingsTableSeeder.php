<?php
use Illuminate\Database\Seeder;
use Carbon\Carbon;
class GeneralSettingsTableSeeder extends Seeder {
	/**
	* Run the database seeds.
	*
	* @return void
	*/
	public function run() 
	{

		$logo = DB::table('image')->select('id','txtImageName')->where('txtImageName','=','logo')->first();
		DB::table('general_setting')->insert([
			'fieldName'  => 'BAD_WORDS',
			'fieldValue' => 'Y',
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);
		DB::table('general_setting')->insert([
			'fieldName'  => 'SITE_NAME',
			'fieldValue' => 'NetQuick',
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);
		DB::table('general_setting')->insert([
			'fieldName'  => 'DEFAULT_TIME_FORMAT',
			'fieldValue' => 'g:i A',
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);
		DB::table('general_setting')->insert([
			'fieldName'  => 'FRONT_LOGO_ID',
			'fieldValue' => (isset($logo->id)?$logo->id:null),
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);	
		DB::table('general_setting')->insert([
			'fieldName'  => 'DEFAULT_PAGE_SIZE',
			'fieldValue' => '20',
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);	
		DB::table('general_setting')->insert([
			'fieldName'  => 'DEFAULT_DATE_FORMAT',
			'fieldValue' => 'M/d/Y',
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);
		DB::table('general_setting')->insert([
			'fieldName'  => 'DEFAULT_TIME_ZONE',
			'fieldValue' => 'America/Cayman',
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);
		DB::table('general_setting')->insert([
			'fieldName'  => 'DEFAULT_EMAIL',
			'fieldValue' => 'testbynetclues@gmail.com',
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);			
		DB::table('general_setting')->insert([
			'fieldName'  => 'DEFAULT_PHONENO',
			'fieldValue' => '1231234560',
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);
		DB::table('general_setting')->insert([
			'fieldName'  => 'DEFAULT_ADDRESS',
			'fieldValue' => '501, Mauryansh Elanza, 5th Floor, Nr Parekh Hospital, Nr Shyamal Cross Road, Satellite, Ahmedabad, Gujarat 380015',
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);	
		DB::table('general_setting')->insert([
			'fieldName'  => 'DEFAULT_NEWSLETTER_EMAIL',
			'fieldValue' => 'testbynetclues@gmail.com',
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);	
		DB::table('general_setting')->insert([
			'fieldName'  => 'DEFAULT_REPLYTO_EMAIL',
			'fieldValue' => 'testbynetclues@gmail.com',
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);		
		DB::table('general_setting')->insert([
			'fieldName'  => 'DEFAULT_CONTACTUS_EMAIL',
			'fieldValue' => 'testbynetclues@gmail.com',
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);		
		DB::table('general_setting')->insert([
			'fieldName'  => 'DEFAULT_CURRENCY_SYMBOL',
			'fieldValue' => '$',
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);	
		DB::table('general_setting')->insert([
			'fieldName'  => 'MAILER',
			'fieldValue' => 'smtp',
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);		
		DB::table('general_setting')->insert([
			'fieldName'  => 'SMTP_SERVER',
			'fieldValue' => 'mailtrap.io',
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);		
		DB::table('general_setting')->insert([
			'fieldName'  => 'SMTP_USERNAME',
			'fieldValue' => '9d6ead95bee473',
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);	
		DB::table('general_setting')->insert([
			'fieldName'  => 'SMTP_PASSWORD',
			'fieldValue' => '60598066b3a39a',
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);	
		DB::table('general_setting')->insert([
			'fieldName'  => 'SMTP_ENCRYPTION',
			'fieldValue' => 'null',
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);
		DB::table('general_setting')->insert([
			'fieldName'  => 'SMTP_PORT',
			'fieldValue' => '2525',
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);
		DB::table('general_setting')->insert([
				'fieldName'  => 'SMTP_AUTHENTICATION',
				'fieldValue' => 'Y',
				'created_at'=> Carbon::now(),
				'updated_at'=> Carbon::now()
		]);	
		DB::table('general_setting')->insert([
			'fieldName'  => 'SMTP_SENDER_NAME',
			'fieldValue' => 'Admin',
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);
		DB::table('general_setting')->insert([
			'fieldName'  => 'DEFAULT_SIGNATURE_CONTENT',
			'fieldValue' => "<p><span style=\"color:#2574db; font-size:18px;display:block; margin-bottom:5px;font-family:'Segoe UI','Segoe WP','Segoe UI Regular','Helvetica Neue',Helvetica,Tahoma,'Arial Unicode MS',Sans-serif;\">Best Regards,</span></p>
<p style=\"font-family:'Segoe UI','Segoe WP','Segoe UI Regular','Helvetica Neue',Helvetica,Tahoma,'Arial Unicode MS',Sans-serif;padding:0;margin:0\">NetQuick</p>",
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);		
		DB::table('general_setting')->insert([
			'fieldName'  => 'GOOGLE_ANALYTIC_CODE',
			'fieldValue' => null,
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);
		DB::table('general_setting')->insert([
			'fieldName'  => 'GOOGLE_TAG_MANAGER_FOR_BODY',
			'fieldValue' => null,
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);
		DB::table('general_setting')->insert([
			'fieldName'  => 'DEFAULT_META_TITLE',
			'fieldValue' => "Sample meta title",
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);	
		DB::table('general_setting')->insert([
			'fieldName'  => 'DEFAULT_META_KEYWORD',
			'fieldValue' => "Sample meta keyword",
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);	
		DB::table('general_setting')->insert([
			'fieldName'  => 'DEFAULT_META_DESCRIPTION',
			'fieldValue' => "Sample meta description",
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);	
		DB::table('general_setting')->insert([
			'fieldName'  => 'META_TAG',
			'fieldValue' => "Sample meta tag",
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);
		DB::table('general_setting')->insert([
			'fieldName'  => 'SOCIAL_FB_LINK',
			'fieldValue' => 'http://www.fb.com',
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);
		DB::table('general_setting')->insert([
			'fieldName'  => 'Google_Plus_Link',
			'fieldValue' => 'https://www.google.com',
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);

		DB::table('general_setting')->insert([
			'fieldName'  => 'SOCIAL_SHARE_GOOGLE_PLUS_GETCODE',
			'fieldValue' => '',
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);

		DB::table('general_setting')->insert([
			'fieldName'  => 'SOCIAL_SHARE_GOOGLE_PLUS_ACCESS_TOKEN',
			'fieldValue' => '',
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);

		DB::table('general_setting')->insert([
			'fieldName'  => 'SOCIAL_TWITTER_LINK',
			'fieldValue' => 'http://www.twitter.com',
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);	
		DB::table('general_setting')->insert([
			'fieldName'  => 'SOCIAL_YOUTUBE_LINK',
			'fieldValue' => 'https://www.youtube.com',
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);
		DB::table('general_setting')->insert([
			'fieldName'  => 'SOCIAL_TRIPADVISOR_LINK',
			'fieldValue' => 'http://www.tripadvisor.com',
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);
		DB::table('general_setting')->insert([
			'fieldName'  => 'SOCIAL_LINKEDIN_LINK',
			'fieldValue' => 'https://www.linkedin.com/',
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);
		DB::table('general_setting')->insert([
			'fieldName'  => 'SOCIAL_SHARE_FB_ID',
			'fieldValue' => 1234567890,
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);
		DB::table('general_setting')->insert([
			'fieldName'  => 'SOCIAL_SHARE_FB_API_KEY',
			'fieldValue' => '12sd3456ds7890ds',
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);
		DB::table('general_setting')->insert([
			'fieldName'  => 'SOCIAL_SHARE_FB_SECRET_KEY',
			'fieldValue' => '12f3s45t67y890oo',
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);
		DB::table('general_setting')->insert([
			'fieldName'  => 'SOCIAL_SHARE_FB_ACCESS_TOKEN',
			'fieldValue' => '12f3s45t67y890oo',
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);
		DB::table('general_setting')->insert([
			'fieldName'  => 'SOCIAL_SHARE_TWITTER_API_KEY',
			'fieldValue' => '12f3s45t67y890sds',
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);
		DB::table('general_setting')->insert([
			'fieldName'  => 'SOCIAL_SHARE_TWITTER_SECRET_KEY',
			'fieldValue' => '12f3s45t67y890rer',
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);
		DB::table('general_setting')->insert([
			'fieldName'  => 'SOCIAL_SHARE_TWITTER_ACCESS_TOKEN',
			'fieldValue' => '12f3s45t67y890eruhsd',
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);
		DB::table('general_setting')->insert([
			'fieldName'  => 'SOCIAL_SHARE_TWITTER_ACCESS_SECRET_KEY',
			'fieldValue' => 'rer12f3s45t67y890eruhsd',
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);
		DB::table('general_setting')->insert([
			'fieldName'  => 'SOCIAL_SHARE_LINKEDIN_API_KEY',
			'fieldValue' => '12f3s45t67y890dssds',
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);
		DB::table('general_setting')->insert([
			'fieldName'  => 'SOCIAL_SHARE_LINKEDIN_SECRET_KEY',
			'fieldValue' => 'dffdf474ynjnj',
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);
		DB::table('general_setting')->insert([
			'fieldName'  => 'SOCIAL_SHARE_LINKEDIN_ACCESS_TOKEN',
			'fieldValue' => '12f3s45t67y8hsd',
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);
		DB::table('general_setting')->insert([
			'fieldName'  => 'SOCIAL_SHARE_LINKEDIN_ACCESS_SECRET_KEY',
			'fieldValue' => '2f3s45t67y890eru',
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);
		DB::table('general_setting')->insert([
			'fieldName'  => 'SOCIAL_SHARE_LINKEDIN_GETCODE',
			'fieldValue' => '',
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);
		DB::table('general_setting')->insert([
			'fieldName'  => 'GOOGLE_CAPCHA_KEY',
			'fieldValue' => '6LcMaBcUAAAAANP0isVwiI4kIULFS5XN8j5zPdYG',
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);
		DB::table('general_setting')->insert([
			'fieldName'  => 'GOOGLE_MAP_KEY',
			'fieldValue' => '6LeRHRYTAAAAACb3IQx41VH7OqwRKYcQo13tMI2t',
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);		
		DB::table('general_setting')->insert([
			'fieldName'  => 'FOOTER_COPYRIGHTS',
			'fieldValue' => 'Copyright &copy;',
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);		
		DB::table('general_setting')->insert([
			'fieldName'  => 'FOOTER_YEAR',
			'fieldValue' => '2017',
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);
		DB::table('general_setting')->insert([
			'fieldName'  => 'FOOTER_DEVELOPED_BY',
			'fieldValue' => 'Website Designed &amp; Developed By: <a href="http://www.netclues.com" target="_blank" rel="nofollow" title="Netclues"><span class="netclues_logo"></span></a>',
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);
		DB::table('general_setting')->insert([
			'fieldName'  => 'AVAILABLE_SOCIAL_LINKS_FOR_TEAM_MEMBER',
			'fieldValue' => serialize(["0"=>["title"=>"Facebook","placeholder"=>"http://www.facebook.com","class"=>"fa fa-facebook","key"=>"social_0"]]),
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);

		DB::table('general_setting')->insert([
			'fieldName'  => 'BING_FILE_PATH',
			'fieldValue' => null,
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);

		DB::table('general_setting')->insert([
			'fieldName'  => 'SOCIAL_INSTAGRAM_LINK',
			'fieldValue' => 'http://www.instagram.com',
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);
		DB::table('general_setting')->insert([
			'fieldName'  => 'SOCIAL_TUMBLR_LINK',
			'fieldValue' => 'http://www.tumblr.com',
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);
		DB::table('general_setting')->insert([
			'fieldName'  => 'SOCIAL_PINTEREST_LINK',
			'fieldValue' => 'http://www.pinterest.com',
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);
		DB::table('general_setting')->insert([
			'fieldName'  => 'SOCIAL_FLICKR_LINK',
			'fieldValue' => 'http://www.flickr.com',
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);
		DB::table('general_setting')->insert([
			'fieldName'  => 'SOCIAL_DRIBBBLE_LINK',
			'fieldValue' => 'http://www.dribbble.com',
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);
		DB::table('general_setting')->insert([
			'fieldName'  => 'SOCIAL_RSS_FEED_LINK',
			'fieldValue' => '',
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);
		
	}
}