<?php
/**
 * The Project class handels project model queries
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
use Config;

class Projects extends Model
{
    protected $table    = 'projects';
    protected $fillable = [
        'id',
        'intAliasId',
        'varTitle',
        'fkIntImgId',
        'fkIntVideoId',
        'txtShortDescription',
        'txtDescription',
        'fkProductCategories',
        'fkIntDocId',
        'intDisplayOrder',
        'varFeaturedProject',
        'varCurrency',
        'fltSalePrice',
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
        $response     = false;
        $moduleFields = ['id'];
        $response     = Self::getPowerPanelRecords($moduleFields)
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
        $response     = false;
        $moduleFields = [
            'id',
            'chrPublish',
            'fkIntImgId',
            'varTitle',
            'fkIntImgId',
            'intCategory',
            'intStatus',
            'varTitle',
            'txtShortDescription',
            'intDisplayOrder',
        ];
        $aliasFields = ['id', 'varAlias'];
        $response    = Self::getPowerPanelRecords($moduleFields, $aliasFields)
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
        $response     = false;
        $moduleFields = [
            'id',
            'intAliasId',
            'varTitle',
            'fkIntImgId',
            'fkIntDocId',
            'fkIntVideoId',
            'fkIntTeam',
            'intCategory',
            'intStatus',
            'txtShortDescription',
            'txtDescription',
            'intDisplayOrder',
            'varFeaturedProject',
            'varCurrency',
            'fltSalePrice',
            'intBeds',
            'fltBaths',
            'fltWidth',
            'fltDepth',
            'fltLandSize',
            'txtAddress',
            'varLatitude',
            'varLongitude',
            'varMetaTitle',
            'varMetaKeyword',
            'varMetaDescription',
            'chrPublish'];
        $aliasFields = ['id', 'varAlias'];
        $videoFields = ['id', 'varVideoName', 'varVideoExtension', 'youtubeId'];
        $response    = Self::getPowerPanelRecords($moduleFields, $aliasFields , $videoFields)
            ->deleted()
            ->checkRecordId($id)
            ->first();
        return $response;
    }

    /**
     * This method handels retrival of record count
     * @return  Object
     * @since   2017-10-16
     * @author  NetQuick
     */
    protected static $fetchedOrder    = [];
    protected static $fetchedOrderObj = null;
    public static function getRecordByOrder($order = false) {
        $response     = false;
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

    /**
    * This method handels retrival of projects to be displayed on homepage
    * @return  Object
    * @since   2017-10-13
    * @author  NetQuick
    */
    public static function getHomeFeaturedProjects() {
        $response = false;
        $moduleFields = ['varTitle','intAliasId','fkIntImgId','intCategory','intStatus','intDisplayOrder','created_at'];
        $aliasFields  = ['id','varAlias'];
        $imageFields = ['id','txtImageName','txtImgOriginalName','varImageExtension'];
        $statusFields  = ['id','varTitle'];
        $categoryFields  = ['id','varTitle'];
        $response = Self::getFrontRecords($moduleFields, $aliasFields, $imageFields, $statusFields, $categoryFields)
            //->whereRaw('((intStatus = 1 AND id = (SELECT MAX(id) from ch_projects where intStatus = 1 AND chrPublish = "Y" AND chrDelete = "N")) OR (intStatus = 2 AND id = (SELECT MAX(id) from ch_projects where intStatus = 2 AND chrPublish = "Y" AND chrDelete = "N")) OR (intStatus = 3 AND id = (SELECT MAX(id) from ch_projects where intStatus = 3 AND chrPublish = "Y" AND chrDelete = "N")))')
            ->whereRaw('chrPublish = "Y" AND chrDelete = "N" AND ((intStatus = 1 AND varFeaturedProject = "Y") OR (intStatus = 2 AND varFeaturedProject = "Y") OR (intStatus = 3 AND varFeaturedProject = "Y"))')
            ->orderBy('intStatus', 'asc')
            ->get();
        return $response;
    }
    #Database Configurations========================================
    /**
     * This method handels retrival of project records
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public static function getFrontRecords($moduleFields = false, $aliasFields = false, $imageFields = false, $statusFields = false, $categoryFields = false) {
        $response = false;
        $data     = [
            'alias' => function ($query) use ($aliasFields) {$query->select($aliasFields);},
            'image' => function ($query) use ($imageFields) {$query->select($imageFields);},
            'status' => function ($query) use ($statusFields) {$query->select($statusFields);},
            'category' => function ($query) use ($categoryFields) {$query->select($categoryFields);},
        ];
        $response = self::select($moduleFields)->with($data);
        return $response;
    }
    /**
     * This method handels retrival of project records
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public static function getPowerPanelRecords($moduleFields = false, $aliasFields = false, $videoFields = false, $imageFields = false, $categoryFields = false)
    {
        $data     = [];
        $response = false;
        $response = self::select($moduleFields);
        if ($imageFields != false) {
            $data['image'] = function ($query) use ($imageFields) {$query->select($imageFields);};
        }
        if ($aliasFields != false) {
            $data['alias'] = function ($query) use ($aliasFields) {$query->select($aliasFields)->checkModuleCode();};
        }
        if ($videoFields != false) {
                $data['video'] = function ($query) use ($videoFields) {$query->select($videoFields)->publish();};
        }
        if ($categoryFields != false) {
            $data['projectCategory'] = function ($query) use ($categoryFields) {$query->select($categoryFields);};
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
    public static function getRecordForLogById($id)
    {
        $response     = false;
        //$moduleFields = ['id', 'varTitle', 'fkIntImgId', 'intCategory', 'fkIntVideoId', 'txtShortDescription', 'txtDescription', 'intDisplayOrder', 'varFeaturedProject', 'varMetaTitle', 'varMetaKeyword', 'varMetaDescription', 'chrPublish'];
        $moduleFields = ['id', 'varTitle', 'fkIntImgId', 'intCategory', 'fkIntVideoId', 'txtShortDescription', 'txtDescription', 'intDisplayOrder', 'varMetaTitle', 'varMetaKeyword', 'varMetaDescription', 'chrPublish'];
        $response     = Self::getPowerPanelRecords($moduleFields)->deleted()->checkRecordId($id)->first();
        return $response;
    }
    /**
     * This method handels retrival of project records
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public static function getRecords() {
        return self::with(['alias' => function ($query) {
            $query->checkModuleCode();
        }, 'image', 'status', 'category', 'team', 'video', 'document']);
    }
    public static function getRecordsSitemap() {
        return self::with(['alias', 'image', 'status', 'category', 'team', 'video', 'document']);
    }
    /**
     * This method handels alias relation
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public function alias()
    {
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
     * This method handels document relation
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public function document() {
            return $this->belongsTo('App\Document', 'fkIntDocId', 'id');
    }
    /**
     * This method handels status relation
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public function status() {
        return $this->belongsTo('App\ProjectStatus', 'intStatus', 'id');
    }
    /**
     * This method handels status relation
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public function category() {
        return $this->belongsTo('App\ProjectCategory', 'intCategory', 'id');
    }
    /**
     * This method handels status relation
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public function team() {
        return $this->belongsTo('App\Team', 'fkIntTeam', 'id');
    }
    /**
     * This method handels alias id scope
     * @return  Object
     * @since   2016-07-24
     * @author  NetQuick
     */
    public function scopeCheckAliasId($query, $id)
    {
        return $query->where('intAliasId', $id);
    }
    /**
     * This method handels record id scope
     * @return  Object
     * @since   2016-07-24
     * @author  NetQuick
     */
    public function scopeCheckRecordId($query, $id)
    {
        return $query->where('id', $id);
    }
    /**
     * This method handels category id scope
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public function scopeCheckCategoryId($query, $id)
    {
        return $query->where('intCategory', $id);
    }
    /**
     * This method handels order scope
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public function scopeOrderCheck($query, $order)
    {
        return $query->where('intDisplayOrder', $order);
    }
    /**
     * This method handels publish scope
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public function scopePublish($query)
    {
        return $query->where(['chrPublish' => 'Y']);
    }
    /**
     * This method handels delete scope
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public function scopeDeleted($query)
    {
        return $query->where(['chrDelete' => 'N']);
    }

    /**
     * This method handels Popular Service scope
     * @return  Object
     * @since   2016-08-30
     * @author  NetQuick
     */
    public function scopeLatest($query, $id = false)
    {
        return $query
        //->whereRaw('created_at > DATE_SUB(NOW(), INTERVAL 7 DAY)')
        //->whereRaw('created_at <= NOW()')
        ->groupBy('id')
            ->orderBy('created_at', 'desc');
    }

    /**
     * This method handels filter scope
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public function scopeFilter($query, $filterArr = false, $retunTotalRecords = false)
    {
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
            //$data = $query->where('chrPublish', $filterArr['statusFilter']);
            $data = $query->where('intStatus', $filterArr['statusFilter']);
        }
        if (!empty($filterArr['catFilter']) && $filterArr['catFilter'] != ' ') {
            $data = $query->where('intCategory', $filterArr['catFilter']);
        }
        if (!empty($filterArr['searchFilter']) && $filterArr['searchFilter'] != ' ') {
            $data = $query->where('varTitle', 'like', "%" . $filterArr['searchFilter'] . "%");
        }

        if (!empty($query)) {
            $response = $query;
        }
        return $response;
    }
    
    /*PDF Header*/
    public static function getpdfheader($objContactInfo = array()) {
        $header = '<div style="page-break-inside:avoid;">
                    <table cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td align="left" width="60%" valign="middle" style="padding-bottom:5pt;padding-top:22pt;padding-left:6pt">
                                <img src="'.url('assets/front/images/logo1.png').'" border="0" alt="'.Config::get('Constant.SITE_NAME').'" />
                            </td>';
                            $header .= '<td align="right" width="25%" valign="top" style="padding-bottom:5pt; padding-left:10pt;padding-top:35pt">
                                <table width="100%" cellpadding="0" cellspacing="0">';
                                    $header .= '<tr>
                                        <td align="left" width="14%" valign="top" style="font-size:9pt;line-height:12pt;letter-spacing:0.5px;color:#252525;padding-bottom:5pt">
                                        <img src="assets/images/phone-icon.png" alt="Email" width="16"/>
                                        </td>';
                                    $primaryPhoneArr = unserialize($objContactInfo['varPhoneNo']);
                                    $phoneString = implode('<br />', $primaryPhoneArr);
                                        $header .= '<td  align="left" width="86%" valign="top"  style="border-collapse:collapse;font-size:10pt;letter-spacing:0.7px;line-height:15pt;color:#252525;padding-bottom:4pt" valign="top">'.$phoneString.'</td>
                                    </tr>';
                                    $header .= '<tr>
                                        <td  align="left" width="14%" valign="top"  style="font-size:10pt;line-height:12pt;letter-spacing:0.5px;color:#252525;">
                                        <img src="assets/images/mail-icon.png" alt="Email" width="16"/></td>';
                                        $primaryEmailArr = unserialize($objContactInfo['varEmail']);
                                        if(count($primaryEmailArr)) {
                                            foreach($primaryEmailArr as $email) {
                                        $header .= '<td  align="left" width="86%" valign="top" style="border-collapse:collapse;font-size:10pt;letter-spacing:0.7px;line-height:13pt;color:#252525">'.$email.'</td>';
                                            }
                                        }
                                    $header .= '</tr>';
                                $header .= '</table>
                            </td>';
                        $header .= '</tr>
                    </table>
                </div>';
        return $header;
    }
    
    public static function getpdffooter() {
        //$footer = '</table>';
        //return $footer;
    }
    
    /**
    * This method handels retrival of projects to be edited when a project of same status is marked as featured
    * @return  Object
    * @since   2017-10-13
    * @author  NetQuick
    */
    public static function getStatusFeaturedProjects($status = 0) {
        $response = false;
        if($status != 0) {
            $moduleFields = ['id'];
            $aliasFields  = ['id','varAlias'];
            $imageFields = ['id','txtImageName','txtImgOriginalName','varImageExtension'];
            $statusFields  = ['id','varTitle'];
            $categoryFields  = ['id','varTitle'];
            $response = Self::getFrontRecords($moduleFields, $aliasFields, $imageFields, $statusFields, $categoryFields)
                ->where([
                    ['intStatus', '=', $status],
                    ['varFeaturedProject', '=', 'Y']
                ])
                ->orderBy('intStatus', 'asc')
                ->get();
        }
        return $response;
    }
}