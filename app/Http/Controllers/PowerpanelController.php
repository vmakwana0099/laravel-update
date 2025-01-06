<?php
namespace App\Http\Controllers;

use App\Helpers\MyLibrary;
use App\Helpers\resize_image;
use App\Helpers\time_zone;
use App\Http\Controllers\Controller;
use App\Http\Traits\slug;
use App\User;
use Auth;
use Config;
use File;
use Zip;
use Artisan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class PowerpanelController extends Controller
{
		use slug;
		protected $breadcrumb        = [];
		protected $commonVariableArr = [];
		protected $module_code;
		public function __construct()
		{

				time_zone::time_zone();
				$this->commonVariableArr['userId']    = Auth::id();
				$this->commonVariableArr['ipAddress'] = MyLibrary::get_client_ip();
				$this->logo();
				view()->share('allLocale', $this->getLang());
		}


		public function logo()
		{
				$user_data      = Auth::user();
				
				$sessionEmailID = '';
				if (!empty($user_data->email)) {
						$sessionEmailID = $user_data->email;
				}
				if (!empty($sessionEmailID)) {
						if (!empty($user_data->fkIntImgId)) {
								$logo_url = resize_image::resize($user_data->fkIntImgId);
								view()->share('User_logo_url', $logo_url);
						} 
						else {
								$logo_url = '';
								view()->share('User_logo_url', $logo_url);
						}
				}
		}

		public function getLang()
		{
				$langArray = array();
				$directory = base_path('resources/lang');
				$dir       = File::directories($directory);
				foreach ($dir as $directory) {
						array_push($langArray, str_replace('//', '', explode('/lang', $directory)[1]));
				}
				return $langArray;
		}

		/**
		 * This method generates alias
		 * @return  JSON formata data of alias
		 * @since   2017-10-30
		 * @author  NetQuick
		 */
		public function aliasGenerate()
		{
				$alias    = Input::get('alias');
				$slug     = slug::create_slug($alias);
				$response = array('alias' => $slug);
				echo json_encode($response);
		}

		/**
		 * This method generates seo content
		 * @return  Meta values
		 * @since   2017-10-30
		 * @author  NetQuick
		 */
		public function generateSeoContent()
		{
				$fromajax    = true;
				$title       = Input::get('title');
				$title       = ($title == "") ? Input::get('name') : $title;
				$description = Input::get('description');
				$seoData     = MyLibrary::generateSeocontent($title, $description, $fromajax);
				return $seoData;
		}

		public function install($file){
			$zip = Zip::open(base_path('storage/'.$file.'.zip'));
			$zip->extract(base_path('storage/'.$file.'/'));
			
			File::copyDirectory(base_path('storage/'.$file.'/app'), base_path('app/'));
			File::copyDirectory(base_path('storage/'.$file.'/database'), base_path('database/'));
			File::copyDirectory(base_path('storage/'.$file.'/public_html'), base_path('public_html/'));
			File::copyDirectory(base_path('storage/'.$file.'/resources'), base_path('resources/'));
			File::deleteDirectory(base_path('storage/'.$file));
				
			ob_clean();
			ob_end_flush();
			ini_set("output_buffering", "0");
			ob_implicit_flush(true);
			header('Content-Type: text/event-stream');
			header('Cache-Control: no-cache');

			$command = "D: && cd " . base_path('/') . " && composer dump-autoload";
			$proc    = popen($command, 'r');
        while (!feof($proc)) {
            $this->echoEvent(fread($proc, 4096));
        }
      $this->echoEvent("finish");
			
			Artisan::call('cache:clear');
			Artisan::call('migrate');
			Artisan::call('db:seed',['--class' => 'ModuleEntryTableSeeder']);
			Artisan::call('db:seed',['--class' => 'PermissionTableSeeder']);			
		}

		public function echoEvent($datatext)
    {
        echo "data: " . implode("\ndata: ", explode("\n", $datatext)) . "\n\n";
    }

}
