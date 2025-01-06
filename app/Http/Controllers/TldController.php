<?php

namespace App\Http\Controllers;

use App\Tld;
use Illuminate\Http\Request;
use App\Helpers\MyLibrary;
use App\Helpers\resize_image;
use App\Http\Traits\slug;
use Config;

class TldController extends FrontController {

    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $Data = [];
        $Data['TLDData'] = Tld::getTLD();
        $Data['TLDFeatured'] = Tld::getTLDOffer();
        $FinalTld = array();
        $TldName = array();
        foreach ($Data['TLDData'] as $Tld) {
            $FinalTld[$Tld->id][$Tld->currency][$Tld->type] = $Tld->Price1;
            $TldName[$Tld->id] = $Tld->varTitle;
            $TldAliasName[$Tld->id] = $Tld->varAlias;
            $CatName = '';
            if ($Tld->varCategory != '') {
                $CatName = Tld::getTLDCatName($Tld->varCategory);
            }
            $TldCategory[$Tld->id] = $CatName;
        }
        $Data['ProductData'] = $FinalTld;
        $TLDFeatured = array();
        foreach ($Data['TLDFeatured'] as $TldFeatured) {
            //echo '<pre>';print_r($TldFeatured);
            $TLDFeatured[$TldFeatured->id][$TldFeatured->currency][$TldFeatured->type] = $TldFeatured->Price1;
            $TldNameFeatured[$TldFeatured->id] = $TldFeatured->varTitle;
            $TldAliasFeatured[$TldFeatured->id] = $TldFeatured->varAlias;
            $TldOfferFeatured[$TldFeatured->id] = $TldFeatured->varOffer;
            if($TldFeatured->type == 'domainregister' && Config::get('Constant.sys_currency') == $TldFeatured->currency)
            { $TldOfferPriceFeatured[$TldFeatured->id] = $TldFeatured->offerPrice; }
        }
        
        $Data['ProductData'] = $FinalTld;
        $Data['TldName'] = $TldName;
        $Data['TldAliasName'] = $TldAliasName;
        $Data['TldCategory'] = $TldCategory;
        $Data['TLDFeatured'] = $TLDFeatured;
        $Data['TLDNameFeatured'] = $TldNameFeatured;
        $Data['TldAliasFeatured'] = $TldAliasFeatured;
        $Data['TldOfferFeatured'] = $TldOfferFeatured;
        $Data['TldOfferPriceFeatured'] = $TldOfferPriceFeatured;
        return view('tld', $Data);
    }

}
