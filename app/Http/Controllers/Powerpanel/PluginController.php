<?php

/**
 * The MenuController class handels dynamic menu configuration
 * configuration  process.
 * @package   Netquick powerpanel
 * @license   http://www.opensource.org/licenses/BSD-3-Clause
 * @version   1.00
 * @since     2016-10-01
 * @author    NetQuick
 */

namespace App\Http\Controllers\Powerpanel;

use Request;
use App\Http\Controllers\PowerpanelController;

use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Contracts\Auth\Guard;
use App\Alias;
use App\Modules;
use App\Role;
use App\Log;
use App\Permission;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Route;
use DB;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;

class PluginController extends PowerpanelController
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index(){


		  try {

      	$client = new GuzzleHttpClient();

		 		$apiRequest = $client->request('GET', 'http://netquick.netcluesdemo.com/api/public/api/get_modules');

		 		$sqlModules = Modules::where(['chr_delete' => "N", 'chr_publish' => 'Y' ])->get();

		 		$installedModules = array();
		 		if(!empty($sqlModules)){
			 		foreach ($sqlModules as $module) {
			 			$installedModules[$module['var_module_name']] = $module;
			 		}
		 		}

        $arrModules = json_decode($apiRequest->getBody()->getContents());
				return view('powerpanel.plugins.list', ['arrModules' => $arrModules->data, 'installedModules' => $installedModules]);

      } catch (RequestException $re) {
          //For handling exception
          return "Please try again later. We couldn't retrive the list of module from netquick server.";
      }
	}


	public function get_module($module){

			try {

      	$client = new GuzzleHttpClient();

		 		$apiRequest = $client->request('get', 'http://netquick.netcluesdemo.com/api/public/api/get_module/'.$module);

        $arrData = json_decode($apiRequest->getBody()->getContents());


        return $arrData->data;

      } catch (RequestException $re) {
          //For handling exception
          return "Please try again later. We couldn't retrive the list of module from netquick server.";
      }
	}

	public function update_module($module){

			try {

      	$client = new GuzzleHttpClient();

		 		$apiRequest = $client->request('get', 'http://netquick.netcluesdemo.com/api/public/api/update_module/'.$module);

        $arrData = json_decode($apiRequest->getBody()->getContents());

        if($arrData->data->module_slug === $module){

        	$filename = $arrData->data->module_slug.".zip";
					$tempImage = tempnam(storage_path('modules'), $filename);
					copy($arrData->data->module_zip_url, $tempImage);

					$zipper = new \Chumper\Zipper\Zipper;

					// $logfiles = $zipper->make($tempImage)->listFiles();

					// if(!empty($logfiles)){
					// 	foreach ($logfiles as $key => $filepath) {
					// 		echo $filepath."\n";
					// 	}
					// }

					$zipper->make($tempImage)->extractTo('./../');
					@unlink($tempImage);

					Modules::where('var_module_name', $arrData->data->module_slug)
          ->update(['chr_version' => $arrData->data->chr_version]);

		      $migrate = \Artisan::call('migrate', [
		        "-n" => true
		       ]);

					$sqlModules = Modules::where(['chr_delete' => "N", 'chr_publish' => 'Y' ])->get();

					return response()->json([
						'status' => 'ok',
						'msg'=> $arrData->data->module_name." module has been successfully updated!",
					], 200);

        }

      } catch (RequestException $re) {
          //For handling exception
          return "Please try again later. We couldn't retrive the list of module from netquick server.";
      }

	}

}
