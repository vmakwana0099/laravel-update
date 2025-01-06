<?php
namespace App\Http\Controllers\Powerpanel;
use App\GeneralSettings;
use App\CommonModel;
use App\ModuleSettings;
use Auth;
use App\Http\Requests;
use Request;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\PowerpanelController;
use App\Helpers\Email_sender;
use App\Pagehit;
use App\ContactLead;
use App\EmailLog;
use App\Modules;
use Session;
use App\Image;
use App\Timezone;
use App\NewsletterLead;
use App\Helpers\resize_image;
use Config;
use File;
use Cache;
use Artisan;
use DB;

class SettingsController extends PowerpanelController {
	public function __construct() {
		parent::__construct();
		if(isset($_COOKIE['locale'])){
			app()->setLocale($_COOKIE['locale']);
		}
	}
	public function index() 
	{
		/********* PHP INI FILE CONTENT **********/
		$phpIniPath = public_path().'/.user.ini';
		$phpIniFileExist = $this->filePathExist($phpIniPath);
		if(!$phpIniFileExist){
				$phpIniContent = '';
			  File::put($phpIniPath, $phpIniContent);			
		}
		$phpIniContent = File::get($phpIniPath);
		/********* End of PHP INI FILE CONTENT **********/
		/********* Robot FILE CONTENT **********/
		$robotFilepath = public_path().'/robots.txt';
		$robotFileExist = $this->filePathExist($robotFilepath);
		if(!$robotFileExist){
				$robotFileContent = '';
				File::put($robotFilepath, $robotFileContent);		
		}
		$robotFileContent = File::get($robotFilepath);
		/*********End of Robot FILE CONTENT **********/
		$BingSiteAuthFilePath = public_path().'/BingSiteAuth.xml';
		$bingFileName = 'BingSiteAuth.xml';
		$bingFileExist = $this->filePathExist($BingSiteAuthFilePath);
		if(!$bingFileExist){
				GeneralSettings::checkByFieldName('BING_FILE_PATH')->update(['fieldValue' => null]);
				Config::set('Constant.BING_FILE_PATH',null);	
		}

		if(!empty(Session::get('tab'))) {
			$tabSessionValue = Session::get('tab');
		}else{
			$tabSessionValue = '';
		}

		$timezone = Timezone::get();
		$this->breadcrumb['title']=trans('template.header.settings');
		
		return view('powerpanel.general_setting.settings',[
			'tab_value' => $tabSessionValue,
			'timezone'=>$timezone,
			'breadcrumb'=>$this->breadcrumb,
			'phpIniContent'=>$phpIniContent,
			'imageManager'=> true,
			'robotFileContent'=>$robotFileContent
		]);
	}
	static function testMail() 
	{		
		Email_sender::testMail();
		echo '<div class="alert alert-info">Test email has been sent in your login email</div>';
	}
	static function update_settings()
	{		
		$data = Input::get();
		$BingSiteAuthFilePath = public_path().'/BingSiteAuth.xml';
		$bingFileName = 'BingSiteAuth.xml';
		$BingfileError = false;
		if (Input::file('xml_file')) 
    {
    		$file = Input::file('xml_file');
        $pathinfo  = pathinfo($file->getClientOriginalName());
        $uploadedFileExtention = $pathinfo['extension'];
        
        if($uploadedFileExtention !='xml'){
						$BingfileError = true;
        }
        if($BingfileError == false){
		    		if(self::filePathExist($BingSiteAuthFilePath)){
		    				unlink($BingSiteAuthFilePath);
		    		}
		        $file->move(public_path(), $bingFileName);
        }
    }

		$phpIniPath = public_path().'/.user.ini';
		$robotFilepath = public_path().'/robots.txt';
		Session::forget('tab');
		Session::put('tab',Input::get('tab'));
		$tab_val = Input::get('tab');
		switch ($tab_val) {
			case 'general_settings':
				$message = array(
					'front_logo_id.required' => 'The front logo field is required.',
					'maintenance_text.required' => 'The maintenance text field is required.'
				);
				$rules = array(
					'site_name' => 'required|max:160',
					'front_logo_id' => 'required',
					'maintenance_text' => 'required'
				);
			break;
			case 'smtp_settings':
				$rules = array(
					'mailer' => 'required',
					'smtp_server' => 'required',
					'smtp_username' => 'required',
					'smtp_password' => 'required',
					'smtp_port' => 'required',
					'smtp_sender_name' => 'required',
					'smtp_sender_id' => 'required|email',
					'mail_content' => 'required'
				);
			break;
			case 'seo_settings':
				$rules = array(
					'meta_title' => 'required',
					'meta_keyword' => 'required',
					'meta_description' => 'required',
				);
				$message = array();
				if($BingfileError){
						$rules['xml_file'] = 'required';
						$message = array(
							'xml_file.required' => 'Please upload only xml file',
						);
				}
			break;
			case 'social_settings':
				$rules = array(
					// 'fb_link' => 'url',
					// 'twitter_link' => 'url',
					// 'youtube_link' => 'url',
					// 'google_link' => 'url',
					// 'linkedin_link' => 'url',
					// 'instagram_link' => 'url',
					// 'tumblr_link' => 'url',
					// 'pinterest_link' => 'url',
					// 'flickr_link' => 'url',
					// 'dribbble_link' => 'url',
					// 'rss_feed_link' => 'url'
				);
				$message = array(
					// 'fb_link.url' => 'Enter valid Url',
					// 'twitter_link.url' => 'Enter valid Url',
					// 'youtube_link.url' => 'Enter valid Url',
					// 'google_link.url' => 'Enter valid Url',
					// 'linkedin_link.url' => 'Enter valid Url',
					// 'instagram_link.url' => 'Enter valid Url',
					// 'tumblr_link.url' => 'Enter valid Url',
					// 'pinterest_link.url' => 'Enter valid Url',
					// 'flickr_link.url' => 'Enter valid Url',
					// 'dribbble_link.url' => 'Enter valid Url',
					// 'rss_feed_link.url' => 'Enter valid Url'
				);
			break;
			case 'social_share_settings':
				$rules = array(
					'fb_id' => 'required',
					'fb_api' => 'required',
					'fb_secret_key' => 'required',
					'fb_access_token' => 'required',
					'twitter_api' => 'required',
					'twitter_secret_key' => 'required',
					'twitter_access_token' => 'required',
					'twitter_access_token_key'=>'required',
					'linkedin_api' => 'required',
					'linkedin_secret_key' => 'required',
					'linkedin_access_token' => 'required',
					'linkedin_access_token_key' => 'required'
				);
			break;
			case 'other_settings':
				$rules = array(
					'google_capcha_key' => 'required',
					'google_map_key' => 'required',
					'php_ini_content' => 'handle_xss',
				);
				$message = array(
					'php_ini_content.handle_xss' => 'Enter valid input.'
				);
			break;
			case 'maintenance':
				$message = array(
					'reset.required' => 'Please select an option to reset.'
				);
				$rules = array(
					'reset' => 'required'
				);
			break;
		}
		
		if(($tab_val=='other_settings')||($tab_val=='general_settings')||($tab_val=='maintenance')||($tab_val=='social_settings') ||($tab_val=='seo_settings')){
			$validator = Validator::make($data, $rules, $message);
		}else{
			$validator = Validator::make($data, $rules);
		}
		if($validator->passes()){
			switch ($tab_val) {
				case 'general_settings':
					$arrGeneralSettings = array(
						'DEFAULT_THEME' => Input::get('theme'),  /* Vk 4/12/2019 Start */
						'DISPLAY_MAINTENANCE' => Input::get('display_maintenance'),  /* Vk 10/9/2020 Start */
						'DISPLAY_MAINTENANCE_LINK' => Input::get('maintenance_text_link'),  /* Vk 10/9/2020 Start */
						'MAINTENANCE_TEXT' => Input::get('maintenance_text'),  /* Vk 10/9/2020 Start */
						'SITE_NAME' => trim(Input::get('site_name')),
						'FRONT_LOGO_ID' => Input::get('front_logo_id'),
						'DEFAULT_TIME_ZONE' => Input::get('timezone'),
						'DEFAULT_NEWSLETTER_EMAIL' => Input::get('default_newsletter_email'),
						'DEFAULT_REPLYTO_EMAIL' => trim(Input::get('default_replyto_email')),
						'DEFAULT_CONTACTUS_EMAIL' => trim(Input::get('default_contactus_email')),
						'EMERGENCY_CONTENT_DESCRIPTION' => Input::get('emrdescription'),
						'DISPLAY_EMERGENCY_CONTENT' => Input::get('displayonhome')
					);
				break;
				case 'smtp_settings':					
					$arrGeneralSettings = array(
						'MAILER' => Input::get('mailer'),
						'SMTP_SERVER' => trim(Input::get('smtp_server')),
						'SMTP_USERNAME' => trim(Input::get('smtp_username')),
						'SMTP_PASSWORD' => Input::get('smtp_password'),
						'SMTP_ENCRYPTION' => Input::get('smtp_encryption'),
						'SMTP_AUTHENTICATION' => Input::get('smtp_authenticattion'),
						'SMTP_PORT' => trim(Input::get('smtp_port')),
						'SMTP_SENDER_NAME' => trim(Input::get('smtp_sender_name')),
						'DEFAULT_EMAIL' => trim(Input::get('smtp_sender_id')),
						'DEFAULT_SIGNATURE_CONTENT' => Input::get('mail_content')
					);					
				break;
				case 'seo_settings':
					$arrGeneralSettings = array(
						'GOOGLE_ANALYTIC_CODE' => Input::get('google_analytic_code'),
						'GOOGLE_TAG_MANAGER_FOR_BODY' => Input::get('google_tag_manager_for_body'),
						'DEFAULT_META_TITLE' => trim(Input::get('meta_title')),
						'DEFAULT_META_KEYWORD' => trim(Input::get('meta_keyword')),
						'DEFAULT_META_DESCRIPTION' => Input::get('meta_description'),
						'META_TAG' => trim(Input::get('meta_tag')),
						'ROBOT_TXT_CONTENT' => Input::get('robotfile_content'),
						'BING_FILE_PATH' => $bingFileName,
					);
				break;
				case 'social_settings':
					$arrGeneralSettings = array(
						'SOCIAL_FB_LINK' => trim(Input::get('fb_link')),
						'SOCIAL_TWITTER_LINK' => trim(Input::get('twitter_link')),
						'SOCIAL_YOUTUBE_LINK' => trim(Input::get('youtube_link')),
						'Google_Plus_Link' => trim(Input::get('google_link')),
						'SOCIAL_LINKEDIN_LINK' => trim(Input::get('linkedin_link')),
						'SOCIAL_INSTAGRAM_LINK' => trim(Input::get('instagram_link')),
						'SOCIAL_TUMBLR_LINK' => trim(Input::get('tumblr_link')),
						'SOCIAL_PINTEREST_LINK' => trim(Input::get('pinterest_link')),
						'SOCIAL_FLICKR_LINK' => trim(Input::get('flickr_link')),
						'SOCIAL_DRIBBBLE_LINK' => trim(Input::get('dribbble_link')),
						'SOCIAL_RSS_FEED_LINK' => trim(Input::get('rss_feed_link')),
						'SOCIAL_WHATSAPP_LINK' => trim(Input::get('whatsapp_link')),
					);
				break;
				case 'social_share_settings':
					$arrGeneralSettings = array(
						'SOCIAL_SHARE_FB_ID' => Input::get('fb_id'),
						'SOCIAL_SHARE_FB_API_KEY' => trim(Input::get('fb_api')),
						'SOCIAL_SHARE_FB_SECRET_KEY' => trim(Input::get('fb_secret_key')),
						'SOCIAL_SHARE_FB_ACCESS_TOKEN' => trim(Input::get('fb_access_token')),
						'SOCIAL_SHARE_TWITTER_API_KEY' => trim(Input::get('twitter_api')),
						'SOCIAL_SHARE_TWITTER_SECRET_KEY' => trim(Input::get('twitter_secret_key')),
						'SOCIAL_SHARE_TWITTER_ACCESS_TOKEN' => trim(Input::get('twitter_access_token')),
						'SOCIAL_SHARE_TWITTER_ACCESS_SECRET_KEY' => trim(Input::get('twitter_access_token_key')),
						'SOCIAL_SHARE_LINKEDIN_API_KEY' => trim(Input::get('linkedin_api')),
						'SOCIAL_SHARE_LINKEDIN_SECRET_KEY' => trim(Input::get('linkedin_secret_key')),
						'SOCIAL_SHARE_LINKEDIN_ACCESS_TOKEN' => trim(Input::get('linkedin_access_token')),
						'SOCIAL_SHARE_LINKEDIN_ACCESS_SECRET_KEY' => trim(Input::get('linkedin_access_token_key'))
					);
				break;
				case 'other_settings':
					$available_social_links_for_team = array();
					$available_social_links_for_team_data = Input::get('available_social_links_for_team');
					$i=0;
					if(is_array($available_social_links_for_team_data)){
						foreach($available_social_links_for_team_data as $key => $value){
							if($value['title']!=""){
								$value['key'] = 'social_link_'.$i;
								$available_social_links_for_team[$i] = $value;
								$i++;
							}
						}		
					}
					
					$available_social_links_for_team = serialize($available_social_links_for_team);
					$arrGeneralSettings = array(
						'DEFAULT_PAGE_SIZE' => 9,
						'DEFAULT_DATE_FORMAT' => Input::get('default_date_format'),
						'DEFAULT_TIME_FORMAT' => Input::get('time_format'),
						'GOOGLE_MAP_KEY' => trim(Input::get('google_map_key')),
						'GOOGLE_CAPCHA_KEY' => trim(Input::get('google_capcha_key')),
						'BAD_WORDS' => Input::get('bad_words'),
						'PHP_INI_CONTENT' => Input::get('php_ini_content'),
						'AVAILABLE_SOCIAL_LINKS_FOR_TEAM_MEMBER' => $available_social_links_for_team,
					);
			  break;
			  case 'maintenance':
			  	foreach (Input::get('reset') as $key => $value){
						switch($value) {
							case "moblihits":
								Pagehit::where('isWeb','=','N')->delete();
							break;
							case "webhits":
								Pagehit::where('isWeb','=','Y')->delete();
								Cache::forget('checkPageHits');
								Cache::forget('checkInnerPageHits');
							break;
							case "contactleads":
								ContactLead::truncate();
							break;
							case "newsletterleads":
								NewsletterLead::truncate();
							break;
							case "emaillog":
								EmailLog::truncate();
							break;
							case "flushAllCache":
								Cache::flush();
							break;
						}
					}
			  break;
			}
			if($tab_val!='maintenance'){
				foreach ($arrGeneralSettings as $key => $value){	
					if($key != 'PHP_INI_CONTENT' || $key != 'ROBOT_TXT_CONTENT'){			
						GeneralSettings::checkByFieldName($key)->update(['fieldValue' => $value]);
					}
					if($key == 'PHP_INI_CONTENT'){
						$fileexist = self::filePathExist($phpIniPath);
						if($fileexist){
								$phpIniContent = $value; 
								File::put($phpIniPath, $phpIniContent);
						}
					}
					if($key == 'ROBOT_TXT_CONTENT'){
						$fileexist = self::filePathExist($robotFilepath);
						if($fileexist){
								$robotFileContent = $value; 
								File::put($robotFilepath, $robotFileContent);
						}
					}
				}
			}
			self::flushCache();
		}else{
			return Redirect::route('powerpanel/settings')->withErrors($validator)->withInput();
		}
		if($tab_val=='maintenance'){
			return Redirect::route('powerpanel/settings')->with('message','The data has been successfully reset.');
		}else{
			return Redirect::route('powerpanel/settings')->with('message','The record has been successfully edited and saved.	');	
		}
	}
	public static function flushCache(){
			Cache::tags('genralSettings')->flush();
	}

	public function getDBbackUp(){		
		$message=trans('template.common.oppsSomethingWrong');
		Artisan::call('backup:run');		
		Session::put('tab','maintenance');
		$filename=base_path('storage/laravel-backups/temp/'.env('DB_DATABASE').'.sql');
		$bytes = File::size($filename);
		if($bytes>0 && self::filePathExist($filename)){
			$message='Database has been backed up!';
			GeneralSettings::deleteLogs();
		}		
		return Redirect::route('powerpanel/settings')->with('message',$message);	
	}

	public static function filePathExist($filepath=false){
			$response = false;
			if(file_exists($filepath)){
				$response = true;		
			}
			return $response; 
	}

	static function saveModuleSettings() {		
		$data = Input::get();
		$id = $data['moduleId'];
		unset($data['_token']);
		$settings = json_encode($data);
		$exists = ModuleSettings::getSettings($id);
		$settings =['intModuleId'=>$id, 'txtSettings'=>$settings, 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=>date('Y-m-d H:i:s') ];
		if(empty($exists)){			
			CommonModel::addRecord($settings, '\\App\\ModuleSettings');
		}else{
			$whereCondArr = ['intModuleId'=>$id];			
			CommonModel::updateRecords($whereCondArr , $settings, false,'\\App\\ModuleSettings');
		}
		echo '<div class="alert alert-success">'.ucwords($data['moduleName']).' Settings saved successfully</div>';
	}

	public function getModuleSettings(){
		$response = false;
		$data = Input::get();
		$id = $data['moduleId'];
		Session::put('moduleSettting',$id);
		$response = ModuleSettings::getSettings($id);
		$response = isset($response->txtSettings)?$response->txtSettings:null;
		if(!empty($response)){
			$response = $response;
		}
		return $response;
	}

	public function getModulesAjax(){
		$term = Input::get('term');		
		Session::put('tab','module');
		$modules = Modules::getModuleListForSettings($term);		
		if(null == Session::get('moduleSettting')){
			Session::put('moduleSettting',$modules[0]->id);
		}
		return view('powerpanel.partials.modulesettingtabs',['modules'=>$modules])->render();
	}
}