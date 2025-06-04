<?php
/*
 This helper generates breadcrumb
  
 */
namespace App\Helpers;

use App\Alias;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use App\CmsPage;


class breadcrumb extends Controller
{
    public static function getbreadcrumb($alias){
       
      echo  CmsPage::getCmspageID($alias);exit;
    }
}
