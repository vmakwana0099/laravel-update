<?php

namespace App\Http\Controllers;

use App\Casestudies;
use Illuminate\Http\Request;
use App\Helpers\MyLibrary;
use App\Helpers\resize_image;
use App\Http\Traits\slug;
use App\Http\Requests;
use App\CmsPage;
use App\Alias;

class CasestudiesController extends FrontController {

    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    public function index(Request $request) {

        $CasestudyData = [];

        $CasestudyData['CasestudyData'] = Casestudies::getFrontList();

        $pagename = $request->segment(1);
         
        $aliasId = slug::resolve_alias($pagename);
        $CasestudyData['CmsData'] = CmsPage::getPageContentByPageAlias($aliasId);
       
        return view('casestudy', $CasestudyData);
    }

    public function detail($alias) {


        $id = slug::resolve_alias($alias);
        
        $Casestudies = Casestudies::getFrontDetail($id);
        
        if (count($Casestudies) > 0) {
           
            $ProId = Casestudies::getCasestudyId($id);
            
            $MetaData = MyLibrary::getMetaDetails($ProId->id, 'casestudy');
             
            $Data['PageHits'] = Casestudies::PageHits($ProId->id);
            
            $breadcrumb = [];
            $breadcrumb['title'] = (!empty($Casestudies->varTitle)) ? ucwords($Casestudies->varTitle) : '';
            $breadcrumb['url'] = 'casestudies';
            $breadcrumb = $breadcrumb;
            $detailPageTitle = $breadcrumb['title'];
            $META_TITLE = $MetaData->varMetaTitle;
            $META_KEYWORD = $MetaData->varMetaKeyword;
            $META_DESCRIPTION = $MetaData->varMetaDescription;
            
            return view('casestudy-details', compact('detailPageTitle', 'Data', 'Casestudies', 'alias', 'breadcrumb', 'META_TITLE', 'META_DESCRIPTION', 'META_KEYWORD'));
        } else {
            abort(404);
        }
    }

}
