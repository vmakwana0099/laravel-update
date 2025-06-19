<?php

/**
 * The Product class handels product model queries
 * ORM implemetation.
 * @package   Netquick powerpanel
 * @license   http://www.opensource.org/licenses/BSD-3-Clause
 * @version   1.00
 * @since        2016-07-14
 * @author    NetQuick
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cache;
use DB;
use App\Pagehit;
use Illuminate\Support\Facades\Request;
use Jenssegers\Agent\Agent;
use Carbon\Carbon;

class Products extends Model {

    protected $table = 'products';
    protected $fillable = [
        'id',
        'intAliasId',
        'varTitle',
        'fkIntImgId',
        'varTagLine',
        'fkProductCategories',
        'varListingIconClass',
        'varBannerIconClass',
        'varSaveTextMonth',
        'varSaveTextYear',
        'VarBannerName1',
        'VarBannerLink1',
        'VarBannerName2',
        'VarBannerLink2',
        'varOfferTextOneMonth',
        'varOfferTextThreeMonth',
        'varOfferTextSixMonth',
        'varOfferTextOneYear',
        'varOfferTextTwoYear',
        'varOfferTextThreeYear',
        'txtShortDescription',
        'txtDescription',
        'txtHomePageDesc',
        'txtHostingMainPageDesc',
        'chrDisplayonhomepage',
        'chrDisplayonmenu',
        'intDisplayOrder',
        'varMetaTitle',
        'varMetaKeyword',
        'varMetaDescription',
        'chrPublish',
        'chrDelete',
        'created_at',
        'updated_at',

    ];

    /**
     * This method handels retrival of front blog detail
     * @return  Object
     * @since   2017-10-13
     * @author  NetQuick
     */
    public static function getRecordIdByAliasID($aliasID) {
        $response = false;
        $response = Self::Select('id')->deleted()->publish()->checkAliasId($aliasID)->first();
        return $response;
    }

    /**
     * This method handels retrival of record count based on category
     * @return  Object
     * @since   2017-10-16
     * @author  NetQuick
     */
    public static function getCountById($categoryId = null) {
        $response = false;
        $moduleFields = ['id'];
        $response = Self::getPowerPanelRecords($moduleFields)
                ->checkCategoryId($categoryId)
                ->deleted()
                ->count();
        return $response;
    }

    /**
     * This method handels retrival of record count
     * @return  Object
     * @since   2017-10-16
     * @author  NetQuick
     */
    public static function getRecordList($filterArr = false) {
        $response = false;
        $moduleFields = [
            'id',
            'chrPublish',
            'fkIntImgId',
            'varTitle',
            'fkProductCategories',
            'varTagLine',
            'varListingIconClass',
            'varBannerIconClass',
            'varSaveTextMonth',
            'varSaveTextYear',
            'VarBannerName1',
            'VarBannerLink1',
            'VarBannerName2',
            'VarBannerLink2',
            'varOfferTextOneMonth',
            'varOfferTextThreeMonth',
            'varOfferTextSixMonth',
            'varOfferTextOneYear',
            'varOfferTextTwoYear',
            'varOfferTextThreeYear',
            'txtShortDescription',
            'txtHomePageDesc',
            'txtHostingMainPageDesc',
            'chrDisplayonhomepage',
            'chrDisplayonmenu',
            'intDisplayOrder',
        ];
        $aliasFields = ['id', 'varAlias'];
        $response = Self::getPowerPanelRecords($moduleFields, $aliasFields)
                ->deleted()
                ->filter($filterArr)
                ->get();
        return $response;
    }

    /**
     * This method handels retrival of record count
     * @return  Object
     * @since   2017-10-16
     * @author  NetQuick
     */
    public static function getRecordById($id = false) {
        $response = false;
        $moduleFields = [
            'id',
            'intAliasId',
            'varTitle',
            'fkIntImgId',
            'varTagLine',
            'varListingIconClass',
            'varBannerIconClass',
            'varSaveTextMonth',
            'varSaveTextYear',
            'VarBannerName1',
            'VarBannerLink1',
            'VarBannerName2',
            'VarBannerLink2',
            'varOfferTextOneMonth',
            'varOfferTextThreeMonth',
            'varOfferTextSixMonth',
            'varOfferTextOneYear',
            'varOfferTextTwoYear',
            'varOfferTextThreeYear',
            'fkProductCategories',
            'txtShortDescription',
            'txtDescription',
            'txtHomePageDesc',
            'txtHostingMainPageDesc',
            'chrDisplayonhomepage',
            'chrDisplayonmenu',
            'intDisplayOrder',
            'varMetaTitle',
            'varMetaKeyword',
            'varMetaDescription',

            'chrPublish'];
        $aliasFields = ['id', 'varAlias'];
        $videoFields = ['id', 'varVideoName', 'varVideoExtension', 'youtubeId'];
        $response = Self::getPowerPanelRecords($moduleFields, $aliasFields, $videoFields)
                ->deleted()
                ->checkRecordId($id)
                ->first();
        return $response;
    }

    /**
     * This method handels retrival of front Sponsor list
     * @return  Object
     * @since   2017-10-13
     * @author  NetQuick
     */
    public static function getFrontList($limit = 10) {
        $response = false;
        $response = Cache::tags(['Products'])->get('getFrontList');
        if (empty($response)) {
            $moduleFields = [
                'id',
                'intAliasId',
                'varTitle',
                'fkIntImgId',
                'varTagLine',
                'varListingIconClass',
                'varBannerIconClass',
                'varSaveTextMonth',
                'varSaveTextYear',
                'VarBannerName1',
                'VarBannerLink1',
                'VarBannerName2',
                'VarBannerLink2',
                'varOfferTextOneMonth',
                'varOfferTextThreeMonth',
                'varOfferTextSixMonth',
                'varOfferTextOneYear',
                'varOfferTextTwoYear',
                'varOfferTextThreeYear',
                'fkProductCategories',
                'txtShortDescription',
                'txtHomePageDesc',
                'txtHostingMainPageDesc',
                'chrDisplayonhomepage',
                'chrDisplayonmenu',
                'txtDescription',
                'intDisplayOrder'
            ];
            $aliasFields = ['id', 'varAlias'];
            $response = Self::getFrontRecords($moduleFields, $aliasFields)
                    ->deleted()
                    ->publish()
                    ->featured('Y')
                    ->displayOrderBy('DESC')
                    ->take($limit)
                    ->get();
            Cache::tags(['Products'])->forever('getFrontList', $response);
        }
        return $response;
    }

    /**
     * This method handels retrival of record count
     * @return  Object
     * @since   2017-10-16
     * @author  NetQuick
     */
    protected static $fetchedOrder = [];
    protected static $fetchedOrderObj = null;

    public static function getRecordByOrder($order = false) {
        $response = false;
        $moduleFields = [
            'id',
            'intDisplayOrder',
        ];
        if (!in_array($order, Self::$fetchedOrder)) {
            array_push(Self::$fetchedOrder, $order);
            Self::$fetchedOrderObj = Self::getPowerPanelRecords($moduleFields)
                    ->deleted()
                    ->orderCheck($order)
                    ->first();
        }
        $response = Self::$fetchedOrderObj;
        return $response;
    }

    #Database Configurations========================================
    /**
     * This method handels retrival of product records
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */

    public static function getFrontRecords($moduleFields = false, $aliasFields = false, $imageFields = false) {
        $response = false;
        $data = [
            'alias' => function ($query) use ($aliasFields) {
        $query->select($aliasFields);
    },
            'image' => function ($query) use ($imageFields) {
        $query->select($imageFields);
    },
        ];
        $response = self::select($moduleFields)->with($data);
        return $response;
    }

    /**
     * This method handels retrival of product records
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public static function getPowerPanelRecords($moduleFields = false, $aliasFields = false, $videoFields = false, $imageFields = false, $categoryFields = false) {
        $data = [];
        $response = false;
        $response = self::select($moduleFields);
        if ($imageFields != false) {
            $data['image'] = function ($query) use ($imageFields) {
                $query->select($imageFields);
            };
        }
        if ($aliasFields != false) {
            $data['alias'] = function ($query) use ($aliasFields) {
                $query->select($aliasFields)->checkModuleCode();
            };
        }
        if ($videoFields != false) {
            $data['video'] = function ($query) use ($videoFields) {
                $query->select($videoFields)->publish();
            };
        }
        if ($categoryFields != false) {
            $data['productCategory'] = function ($query) use ($categoryFields) {
                $query->select($categoryFields);
            };
        }
        if (count($data) > 0) {
            $response = $response->with($data);
        }
        return $response;
    }

    /**
     * This method handels retrival of record by id for Log Manage
     * @return  Object
     * @since   2017-10-16
     * @author  NetQuick
     */
    public static function getRecordForLogById($id) {
        $response = false;
        $moduleFields = ['id', 'varTitle', 'fkIntImgId', 'fkProductCategories', 'txtShortDescription', 'txtDescription', 'intDisplayOrder', 'chrDisplayonhomepage', 'chrDisplayonmenu', 'varMetaTitle', 'varMetaKeyword', 'varMetaDescription', 'chrPublish'];
        $response = Self::getPowerPanelRecords($moduleFields)->deleted()->checkRecordId($id)->first();
        return $response;
    }

    public static function getProductData($id) {
        $response = false;
        $moduleFields = ['varTitle'];
        $response = Self::select($moduleFields)
                ->deleted()
                ->publish()
                ->where('id', $id)
                ->first();
        return $response;
    }

    public static function getProductId($id, $catId) {
        $response = false;
        $moduleFields = ['id'];
        $response = Self::select($moduleFields)
                ->deleted()
                ->publish()
                ->where('intAliasId', $id)
                ->where('fkProductCategories', $catId)
                ->first();
        return $response;
    }

    public static function getProductCatId($id) {
        $response = false;
        $moduleFields = ['id'];
        $response = DB::table('product_category')
                ->select($moduleFields)
                ->where('chrDelete', 'N')
                ->where('chrPublish', 'Y')
                ->where('intAliasId', $id)
                ->first();
        return $response;
    }

    public static function getTLDId($id) {
        $response = false;
        $moduleFields = ['id'];
        $response = DB::table('tld')
                ->select($moduleFields)
                ->where('chrDelete', 'N')
                ->where('chrPublish', 'Y')
                ->where('intAliasId', $id)
                ->first();
//        dd($response);
        return $response;
    }

    public static function getProductBanner($id) {
        $response = false;
        $response = DB::table('products')
                ->select('id', 'varTitle', 'fkIntImgId', 'varTagLine', 'txtShortDescription','txtDescription', 'varListingIconClass', 'varBannerIconClass','varSaveTextMonth','varSaveTextYear', 'VarBannerName1', 'VarBannerLink1', 'VarBannerName2', 'VarBannerLink2', 'varOfferTextOneMonth', 'varOfferTextThreeMonth', 'varOfferTextSixMonth', 'varOfferTextOneYear', 'varOfferTextTwoYear', 'varOfferTextThreeYear', 'varWHMCSPackageFieldName')
                ->where('chrDelete', 'N')
                ->where('chrPublish', 'Y')
                ->where('id', $id)
                ->first();
        return $response;
    }

    public static function getFeaturesRecords($id) {
        $response = DB::table('product_features')
                ->join('product_category', 'product_category.id', '=', 'product_features.fkProductCategories')
                ->select('product_features.varTitle', 'product_features.chrLandingPage', 'product_features.varShortDescription', 'product_features.varIconClass')
                ->where(['product_features.fkProduct' => $id])
                ->where(['product_features.chrDelete' => 'N'])
                ->where(['product_features.chrLandingPage' => 'N'])
                ->where(['product_features.chrPublish' => 'Y'])
                ->orderBy('product_features.intDisplayOrder')
                ->limit(20)
                ->get();
        return $response;
    }

    public static function getFaqRecords($id) {
        $response = DB::table('faq')
                ->select(['varTitle', 'txtDescription'])
                ->where(['fkProduct' => $id])
                ->where(['chrDelete' => 'N'])
                ->where(['chrLandingPage' => 'N'])
                ->where(['chrPublish' => 'Y'])
                ->orderBy('intDisplayOrder')
                ->get();
        return $response;
    }

    public static function getFeaturedProductsRecords($id) {
        $response = DB::table('featured_products')
                ->select(['varTitle', 'varShortDescription', 'varIconClass', 'varFeature', 'varButtonName', 'varButtonLink', 'varWHMCSFieldName'])
                ->where(['fkProduct' => $id])
                ->where(['chrDelete' => 'N'])
                ->where(['chrLandingPage' => 'N'])
                ->where(['chrPublish' => 'Y'])
                ->orderBy('intDisplayOrder')
                ->limit(2)
                ->get();
        return $response;
    }

    public static function getProductsPackageRecords($id) {
        $response = DB::table('products_package')
                ->select(['varTitle',
                    DB::raw('replace(intOldPriceOneMonthINR, ".00", "") as intOldPriceOneMonthINR'),
                    DB::raw('replace(intOldPriceThreeMonthINR, ".00", "") as intOldPriceThreeMonthINR'),
                    DB::raw('replace(intOldPriceSixMonthINR, ".00", "") as intOldPriceSixMonthINR'),
                    DB::raw('replace(intOldPriceOneYearINR, ".00", "") as intOldPriceOneYearINR'),
                    DB::raw('replace(intOldPriceOneYearINR, ".00", "") as intOldPriceOneYearINR'),
                    DB::raw('replace(intOldPriceTwoYearINR, ".00", "") as intOldPriceTwoYearINR'),
                    DB::raw('replace(intOldPriceThreeYearINR, ".00", "") as intOldPriceThreeYearINR'),
                    DB::raw('replace(intOldPriceOneMonthUSD, ".00", "") as intOldPriceOneMonthUSD'),
                    DB::raw('replace(intOldPriceThreeMonthUSD, ".00", "") as intOldPriceThreeMonthUSD'),
                    DB::raw('replace(intOldPriceSixMonthUSD, ".00", "") as intOldPriceSixMonthUSD'),
                    DB::raw('replace(intOldPriceOneYearUSD, ".00", "") as intOldPriceOneYearUSD'),
                    DB::raw('replace(intOldPriceTwoYearUSD, ".00", "") as intOldPriceTwoYearUSD'),
                    DB::raw('replace(intOldPriceTwoYearUSD, ".00", "") as intOldPriceTwoYearUSD'),
                    DB::raw('replace(intOldPriceThreeYearUSD, ".00", "") as intOldPriceThreeYearUSD'),
                    'varAdditionalOffer',
                    'txtSpecification',
                    'txtShortDescription',
                    'fkWhmcsProduct',
                    'chrDisplayontop'])
                ->where(['fkProduct' => $id])
                ->where(['chrDelete' => 'N'])
                ->where(['chrPublish' => 'Y'])
                ->orderBy('intDisplayOrder')
                //->limit(3)
                ->get();
        return $response;
    }

    public static function productFormDisplay($whmcsproid, $category, $pakagetime, $cartURL, $method, $count,$aliasId = NULL,$proname = null,$pro_id = NULL) {
        $returnHtml = '';
        $returnHtml .= '<form action="' . $cartURL . '" id="form_' . $category . '_' . $whmcsproid . '_' . $count . '" class="planform" name="form_' . $category . '_' . $whmcsproid . '" method="' . $method . '" onsubmit="return addToCartEvent(this);" >';
        $csrftoken = csrf_token();
        // $returnHtml .= '<input type="hidden" id="vpsform' . $count . '" name="vpsform' . $count . '" value="' . $count . '"/>';
        if(isset($aliasId) && $aliasId == 483){ 
            // $returnHtml .= '<input type="hidden" id="skipconfig' . $count . '" name="skipconfig[]" value="1"/>';
        }
        // if(isset($whmcsproid) && $whmcsproid == 416){ 
        //     $returnHtml .= '<input type="hidden" id="skipconfig' . $count . '" name="skipconfig[]" value="1"/>';
        // }
        $returnHtml .= '<input type="hidden" id="_token' . $count . '" name="_token" value="' . $csrftoken . '"/>';
        $returnHtml .= '<input type="hidden" id="producttype' . $count . '" name="producttype[]" value="' . $category . '"/>';
        $returnHtml .= '<input type="hidden" id="pid' . $count . '" name="pid[]" value="' . $whmcsproid . '"/>';
        // if (isset($pro_id) && !empty($pro_id)) {
        // $returnHtml .= '<input type="hidden" id="pro_id' . $count . '" name="pro_id[]" value="' . $pro_id . '"/>';
        // }
         if (isset($pro_id) && !empty($pro_id)) {
            $returnHtml .= '<input type="hidden" id="pro_id' . $count . '" name="pro_id[]" value="' . $pro_id . '"/>';    
        }
        else{
            $returnHtml .= '<input type="hidden" id="pro_id' . $count . '" name="pro_id[]" value="1"/>';    

        }
        $returnHtml .= '<input type="hidden" id="billingcycle' . $count . '" name="billingcycle[]" value="' . $pakagetime . '"/>';
        if(!empty($category) && ($category == 'dedicatedserver' || $category == 'hosting')){
            $returnHtml .= '<input type="hidden" id="location' . $count . '" name="location[]" value="India"/>';
        }
        if(!empty($category) && $category == 'vps'){

            
        
            if(!empty($aliasId) && $aliasId == 484)
            { 
                // This is for quick Order
                if( $whmcsproid == '236' || $whmcsproid == '238' )
                { 
                    if( $count == '10' || $count == '4' || $count == '7' ){
                        // for starter
                        $returnHtml .= '<input type="hidden" name="vps_ram[]" id="vps_ram' . $count . '" value="587">';
                        $returnHtml .= '<input type="hidden" name="vps_cpu[]" id="vps_cpu' . $count . '" value="585">';
                        $returnHtml .= '<input type="hidden" name="vps_hdd[]" id="vps_hdd' . $count . '" value="590">';
                        $returnHtml .= '<input type="hidden" name="selectedPak[]" id="selectedPak_' . $count . '" value="Starter">';
                        // $returnHtml .= '<input type="hidden" name="location[]" id="location' . $count . '" value="USA">';
                    }else if( $count == '11' || $count == '5' || $count == '8' ){
                        // for performance
                        $returnHtml .= '<input type="hidden" name="vps_ram[]" id="vps_ram' . $count . '" value="588">';
                        $returnHtml .= '<input type="hidden" name="vps_cpu[]" id="vps_cpu' . $count . '" value="598">';
                        $returnHtml .= '<input type="hidden" name="vps_hdd[]" id="vps_hdd' . $count . '" value="591">';
                        $returnHtml .= '<input type="hidden" name="selectedPak[]" id="selectedPak_' . $count . '" value="Performance">';
                        //$returnHtml .= '<input type="hidden" name="location[]" id="location' . $count . '" value="USA">';
                    }else if( $count == '12' || $count == '6' || $count == '9' ){
                        // for business
                        $returnHtml .= '<input type="hidden" name="vps_ram[]" id="vps_ram' . $count . '" value="746">';
                        $returnHtml .= '<input type="hidden" name="vps_cpu[]" id="vps_cpu' . $count . '" value="598">';
                        $returnHtml .= '<input type="hidden" name="vps_hdd[]" id="vps_hdd' . $count . '" value="747">';
                        $returnHtml .= '<input type="hidden" name="selectedPak[]" id="selectedPak_' . $count . '" value="Business">';
                        //$returnHtml .= '<input type="hidden" name="location[]" id="location' . $count . '" value="USA">';
                    }  
                }
                // End 
            } else {
                // This is for customize plane
            if ( $count == '10' || $count == '4' || $count == '7' || $count == '13' || $count == '16' || $count == '1') {
                //$returnHtml .= '<input type="hidden" name="selectedPak[]" id="selectedPak_' . $count . '" value="Starter">';
                $returnHtml .= '<input type="hidden" name="vps_ram[]" id="vps_ram' . $count . '" value="2">';
            $returnHtml .= '<input type="hidden" name="vps_cpu[]" id="vps_cpu' . $count . '" value="2">';
            $returnHtml .= '<input type="hidden" name="vps_hdd[]" id="vps_hdd' . $count . '" value="15">';
            $returnHtml .= '<input type="hidden" name="location[]" id="location' . $count . '" value="India">';
            }elseif ( $count == '11'|| $count == '5' || $count == '8' ) {
                $returnHtml .= '<input type="hidden" name="selectedPak[]" id="selectedPak_' . $count . '" value="Performance">';
            }
            // End
            }
        }
        
        $buttonText = "Choose Plan";
        // $buttonText = "Buy Now";
        $vpsclass = '';
        if(!empty($category) && ($category == 'vps' || $category == 'dedicatedserver')){ $buttonText = "Configure"; }
        
        if($whmcsproid == 220 || $whmcsproid == 221 || $whmcsproid == 227 || $whmcsproid == 222 || $whmcsproid == 224 || $whmcsproid == 225 || $whmcsproid == 236){
            $buttonText = "Buy Now";
        }
         if (Request::segment(2) == 'windows-vps-hosting' || Request::segment(2) == 'forex-vps-hosting') {
                $vpsclass = "windows-vps-managed-btn";
                $buttonText = "Add to Cart";
                // echo'<pre>123: ';print_r($vpsclass);exit;
                }

        if($aliasId != 484 && $whmcsproid == 236){ $buttonText = "Configure"; }
        if(!empty($category) && ($category == 'vps')){ 
            // $returnHtml .= "<button onclick='return calltoVPSConfiguration(this);' class='btn-primary' title='Buy Now'>".$buttonText."</button>";
            if (Request::segment(2) == 'linux-vps-hosting') {
                 $proname .= "_linux";    
                }
            
                $button_id = str_replace(" ","_",$proname);
            if ($whmcsproid == 416) {
                // $returnHtml .= "<button class='free-button' id ='".$button_id."' title='Buy Now'>Get 7 Days free</button>";
                $returnHtml .= "<button class='free-button' id ='".$button_id."' title='".$buttonText."'>Configure</button>";
            }elseif(in_array($whmcsproid, [465, 466, 463, 464, 467, 468, 469, 470, 471, 472, 473, 474, 475, 476, 477, 478,509,510,511,508,516,518,519,520])){
                $newVPSClass = 'primary-btn-sq-bdr';
                if($whmcsproid == 509 || $whmcsproid == 518){
                    $newVPSClass = 'primary-btn-sq';
                }
                // $returnHtml .= "<button class='vps_managed_btn' id ='".$button_id."' title='Add to Cart'>Add to Cart</button>";
                $returnHtml .= "<button class='".$newVPSClass."' id ='".$button_id."' title='Add to Cart'>Choose Plan</button>";
            }

            else{
                
                $returnHtml .= "<button class='btn-primary " . $vpsclass . "' id ='".$button_id."' title='".$buttonText."'>".$buttonText."</button>";
            }
        }
        elseif(!empty($category) && ($category == 'hosting') ){
          $hostingClass = 'primary-btn-sq-bdr';
          if($whmcsproid == 535 || $whmcsproid == 523 || $whmcsproid == 527 || $whmcsproid == 531){
            $hostingClass = 'primary-btn-sq';
          }
          $returnHtml .= "<button class=' ". $hostingClass ." " . $vpsclass . "' title='".$buttonText."'>".$buttonText."</button>"; 
          // <button class='shared-hstg-plan-btn " . $vpsclass . "' title='".$buttonText."'>".$buttonText."</button>
        }
        elseif(Request::segment(2) == 'dedicated-servers'){
                $returnHtml .= "<button class='vps_managed_btn'  title='".$buttonText."'>".$buttonText."</button>";

        }
        else{ 
            $returnHtml .= "<button class='btn-primary vps_managed_btn' title='".$buttonText."'>".$buttonText."</button>"; 
        }
        $returnHtml .= '</form>';
        $ButtonName = 'form_' . $category . '_' . $whmcsproid;
        // echo '<pre>123:'; print_r($returnHtml); exit;
        
        return $returnHtml;
    }

    /**
     * This method handels retrival of product records
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public static function getRecords() {
        return self::with(['alias' => function ($query) {
                $query->checkModuleCode();
            }, 'image']);
    }

    /**
     * This method handels alias relation
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public function alias() {
        return $this->belongsTo('App\Alias', 'intAliasId', 'id');
    }

    /**
     * This method handels image relation
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public function image() {
        return $this->belongsTo('App\Image', 'fkIntImgId', 'id');
    }

    /**
     * This method handels video relation
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public function video() {
        return $this->belongsTo('App\Video', 'fkIntVideoId', 'id');
    }

    /**
     * This method handels alias id scope
     * @return  Object
     * @since   2016-07-24
     * @author  NetQuick
     */
    public function scopeCheckAliasId($query, $id) {
        return $query->where('intAliasId', $id);
    }

    /**
     * This method handels record id scope
     * @return  Object
     * @since   2016-07-24
     * @author  NetQuick
     */
    public function scopeCheckRecordId($query, $id) {
        return $query->where('id', $id);
    }

    /**
     * This method handels category id scope
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public function scopeCheckCategoryId($query, $id) {
        return $query->where('fkProductCategories', $id);
    }

    /**
     * This method handels order scope
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public function scopeOrderCheck($query, $order) {
        return $query->where('intDisplayOrder', $order);
    }

    public static function getProductNameDeals($id) {
        $response = false;
        $response = DB::table('products_package as PP')
                ->select(DB::raw('CONCAT(nq_PP.varTitle, " - ", nq_P.varTitle) AS text'), 'PP.id')
                ->join('products as P', 'PP.fkProduct', '=', 'P.id')
                ->where('PP.chrDelete', 'N')
                ->where('PP.chrPublish', 'Y')
                ->where('PP.fkProductCategories', $id)
                ->get();
        return $response;
    }
    public static function getProductName($id) {
        $response = false;
        $parentCategoryFields = ['id', 'varTitle as text'];
        $response = Self::getPowerPanelRecords($parentCategoryFields)
                ->deleted()
                ->publish()
                ->CheckCategoryId($id)
                ->get();
        return $response;
    }

    public static function getProductAlias($id) {
        $response = false;
        $response = DB::table('product_category')
                ->select('alias.varAlias')
                ->join('alias', 'product_category.intAliasId', '=', 'alias.id')
                ->where('product_category.chrDelete', 'N')
                ->where('product_category.chrPublish', 'Y')
                ->where('product_category.id', $id)
                ->first();
        return $response;
    }

    /**
     * This method handels publish scope
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public function scopePublish($query) {
        return $query->where(['chrPublish' => 'Y']);
    }

    /**
     * This method handels delete scope
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public function scopeDeleted($query) {
        return $query->where(['chrDelete' => 'N']);
    }

    /**
     * This method handels Popular Service scope
     * @return  Object
     * @since   2016-08-30
     * @author  NetQuick
     */
    public function scopeLatest($query, $id = false) {
        return $query
                        //->whereRaw('created_at > DATE_SUB(NOW(), INTERVAL 7 DAY)')
                        //->whereRaw('created_at <= NOW()')
                        ->groupBy('id')
                        ->orderBy('created_at', 'desc');
    }

    /**
     * This method handels featured scope
     * @return  Object
     * @since   2016-08-08
     * @author  NetQuick
     */
    function scopeFeatured($query, $flag = null) {
        $response = false;
        $response = $query->where(['varFeaturedProduct' => $flag]);
        return $response;
    }

    /**
     * This method handels orderBy scope
     * @return  Object
     * @since   2016-08-08
     * @author  NetQuick
     */
    public function scopeDisplayOrderBy($query, $orderBy) {
        $response = false;
        $response = $query->orderBy('intDisplayOrder', $orderBy);
        return $response;
    }

    /**
     * This method handels filter scope
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public function scopeFilter($query, $filterArr = false, $retunTotalRecords = false) {
        $response = null;

        if ($filterArr['orderByFieldName'] != null && $filterArr['orderTypeAscOrDesc'] != null) {
            $query = $query->orderBy($filterArr['orderByFieldName'], $filterArr['orderTypeAscOrDesc']);
        } else {
            $query = $query->orderBy('varTitle', 'ASC');
        }

        if (!$retunTotalRecords) {
            if (!empty($filterArr['iDisplayLength']) && $filterArr['iDisplayLength'] > 0) {
                $data = $query->skip($filterArr['iDisplayStart'])->take($filterArr['iDisplayLength']);
            }
        }
        if (!empty($filterArr['statusFilter']) && $filterArr['statusFilter'] != ' ') {
            $data = $query->where('chrPublish', $filterArr['statusFilter']);
        }
        if (!empty($filterArr['catFilter']) && $filterArr['catFilter'] != ' ') {
            $data = $query->where('fkProductCategories', $filterArr['catFilter']);
        }
        if (!empty($filterArr['categoryfilter']) && $filterArr['categoryfilter'] != ' ') {
            $data = $query->where('fkProductCategories', $filterArr['categoryfilter']);
        }
        if (!empty($filterArr['searchFilter']) && $filterArr['searchFilter'] != ' ') {
            $data = $query->where('varTitle', 'like', "%" . $filterArr['searchFilter'] . "%");
        }

        if (!empty($query)) {
            $response = $query;
        }
        return $response;
    }

    public static function getfkProductCountById($categoryId = null, $table_name) {
        $response = false;
        $moduleFields = ['id'];
        $response = DB::table($table_name)
                ->select($moduleFields)
                ->where(['fkProduct' => $categoryId])
                ->where(['chrDelete' => 'N'])
                ->count();
        return $response;
    }

    public static function PageHits($id) {
        $aliasID = null;
        $sever_info = Request::server('HTTP_USER_AGENT');
        $ip_address = Request::ip();
        $agent = new Agent;
        $device = '';
        if ($agent->is('iPad')) {
            $device = 'Y';
        } elseif ($agent->isMobile()) {
            $device = 'N';
        } else {
            $device = 'Y';
        }
        if (isset($id)) {
            $aliasID = $id;
        }
        if (!empty($sever_info) && !empty($device) && !empty($ip_address)) {
//            $isExist = Pagehit::select('id')->where(['fkIntAliasId' => $aliasID, 'intFKModuleCode' => '38', 'varIpAddress' => $ip_address, 'isWeb' => $device])->first();
//
//            if (!isset($isExist->id)) {
                Pagehit::insert([
                    'fkIntAliasId' => $aliasID,
                    'intFKModuleCode' => "38",
                    'varBrowserInfo' => $sever_info,
                    'isWeb' => $device,
                    'varIpAddress' => $ip_address,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
//            }
        }
    }

}
