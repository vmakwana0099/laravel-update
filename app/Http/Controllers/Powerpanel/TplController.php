<?php 
namespace App\Http\Controllers\Powerpanel;

use App\Http\Controllers\PowerpanelController;
use Request;

class TplController extends PowerpanelController {
	

	public function __construct()
  {
      parent::__construct();
     if(isset($_COOKIE['locale'])){
			app()->setLocale($_COOKIE['locale']);
		}
  }
  
	public function index($view)
	{
		$response = false;

		switch ($view) {

			case 'quicksidebar':
				return view('powerpanel.partials.quicksidebar');
			break;

			case 'dashboard':
				return view('powerpanel.pages.dashboard');
			break;

			case 'sidebar':
				return view('powerpanel.partials.sidebar');
			break;

			case 'header':
				return view('powerpanel.partials.header');
			break;			
			
			case 'pagehead':
				return view('powerpanel.partials.pagehead');
			break;						


			default:
				# code...
			break;
		}

		
	}
	
}