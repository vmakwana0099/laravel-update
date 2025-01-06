<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Cache;

class VideoGallery extends Model
{

    protected $table    = 'video_gallery';
    protected $fillable = [
        'id',
        'fkIntAlbumId',
        'fkIntVideoId',
        'varTitle',
        'intDisplayOrder',
        'chrDisplay',
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
    public static function getRecordIdByAliasID($aliasID)
    {
        $response = false;
        $response = Cache::tags(['VideoGallery'])->get('getVideoGalleryRecordByAliasID_'.$aliasID);
        if(empty($response)){
            $response = Self::Select('id')->deleted()->publish()->checkAliasId($aliasID)->first();
            Cache::tags(['VideoGallery'])->forever('getVideoGalleryRecordByAliasID_'.$aliasID, $response);
        }
        return $response;
    }
    /**
     * This method handels retrival of front videoGallery list
     * @return  Object
     * @since   2017-10-13
     * @author  NetQuick
     */
    public static function getFrontList($range = null, $albumId = null,$page=1)
    {
        $videoGalleryFields = ['varTitle', 'fkIntVideoId', 'fkIntAlbumId'];
        $videoFields = ['id','varVideoName','txtVideoOriginalName','varVideoExtension','youtubeId','chrPublish'];
        $response = Cache::tags(['VideoGallery'])->get('getVideogalleryFrontList_'.$albumId.'_'.$page);
        if(empty($response)){
            $gallery            = Self::getFrontRecords($videoGalleryFields,false,false,$videoFields)
                ->with(['videoAlbum' => function ($query) {
                    $query->select('id', 'txtDescription');
                }])
                ->publish()
                ->deleted()
                ->displayOrderBy('ASC');

            if ($albumId != null) {
                $gallery = $gallery->checkByAlbumId($albumId);
            }

            if ($range != null) {
                $gallery = $gallery->paginate($range);
            } else {
                $gallery = $gallery->get();
            }
            $response = $gallery;
            Cache::tags(['VideoGallery'])->forever('getVideogalleryFrontList_'.$albumId.'_'.$page, $response);
        }
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
    public static function getRecordByOrder($order = false)
    {
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
     * This method handels retrival of record count
     * @return  Object
     * @since   2017-10-16
     * @author  NetQuick
     */
    public static function getRecordByAlbumID($albumID)
    {
        $response           = false;
        $videoGalleryFields = ['id', 'fkIntAlbumId', 'fkIntVideoId', 'varTitle', 'intDisplayOrder', 'chrPublish'];
        $response           = Self::getPowerPanelRecords($videoGalleryFields)
            ->checkByAlbumId($albumID)
            ->deleted()
            ->displayOrderBy('ASC')
            ->paginate(9);
        return $response;
    }

    /**
     * This method handels retrival of record count
     * @return  Object
     * @since   2017-10-16
     * @author  NetQuick
     */
    public static function getRecordList()
    {
        $response           = false;
        $videoGalleryFields = ['id', 'fkIntAlbumId', 'fkIntVideoId', 'varTitle', 'intDisplayOrder', 'chrPublish'];
        $videoFields = ['id','varVideoName','txtVideoOriginalName','varVideoExtension','youtubeId','chrPublish'];
        $response           = Self::getPowerPanelRecords($videoGalleryFields,false,false,$videoFields)
            ->deleted()
            ->displayOrderBy('ASC')
            ->paginate(9);
        return $response;
    }

    /**
     * This method handels retrival of record count
     * @return  Object
     * @since   2017-10-16
     * @author  NetQuick
     */
    public static function getRecordById($id)
    {
        $response         = false;
        $videoAlbumFields = ['id', 'fkIntAlbumId', 'fkIntVideoId', 'varTitle', 'intDisplayOrder', 'chrPublish'];
        $response         = Self::getPowerPanelRecords($videoAlbumFields)->deleted()->checkRecordId($id)->first();
        return $response;
    }

    /**
     * This method handels retrival of blog records
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public static function getPowerPanelRecords($moduleFields = false, $aliasFields = false, $videoAlbumFields = false,$videoFields=false)
    {
        $response = false;
        $response = self::select($moduleFields);
        $data = [];
        if ($videoAlbumFields != false) {
            $data['videoAlbum'] = function ($query) use ($videoAlbumFields) {
                $query->select($videoAlbumFields);
            };
        }

        if ($videoFields != false) {
            $data['video'] = function ($query) use ($videoFields) {
                $query->select($videoFields)->publish();
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
    public static function getRecordForLogById($id)
    {
        $response     = false;
        $moduleFields = ['id', 'fkIntAlbumId', 'fkIntVideoId', 'varTitle', 'intDisplayOrder', 'chrPublish'];
        $response     = Self::getPowerPanelRecords($moduleFields)->deleted()->checkRecordId($id)->first();
        return $response;
    }

    /**
     * This method handels alias relation
     * @return  Object
     * @since   2017-08-22
     * @author  NetQuick
     */
    public function alias()
    {
        return $this->belongsTo('App\Alias', 'intAliasId', 'id');
    }

    /**
     * This method handels image relation
     * @return  Object
     * @since   2017-08-22
     * @author  NetQuick
     */
    public function video()
    {
        return $this->belongsTo('App\Video', 'fkIntVideoId', 'id');
    }

    /**
     * This method handels image relation
     * @return  Object
     * @since   2017-08-22
     * @author  NetQuick
     */
    public function videoAlbum()
    {
        return $this->belongsTo('App\VideoAlbum', 'fkIntAlbumId', 'id');
    }

    /**
     * This method handels retrival of show records
     * @return  Object
     * @since   2017-08-22
     * @author  NetQuick
     */
    public static function getRecords()
    {
        return self::with(['alias' => function ($query) {
            $query->checkModuleCode();
        }, 'video', 'videoAlbum']);
    }

    /**
     * This method handels retrival of videoGallery records
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public static function getFrontRecords($moduleFields = false, $aliasFields = false, $imageFields = false,$videoFields=false)
    {
        $response = false;
        $response = self::select($moduleFields);
        $data = [];
        if ($videoFields != false) {
            $data['video'] = function ($query) use ($videoFields) {
                $query->select($videoFields)->publish();
            };
        }
        if (count($data) > 0) {
                $response = $response->with($data);
        }
        return $response;
        
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
     * This method handels order scope
     * @return  Object
     * @since   2017-08-22
     * @author  NetQuick
     */
    public function scopeOrderCheck($query, $order)
    {
        return $query->where('intDisplayOrder', $order);
    }
    /**
     * This method handels publish scope
     * @return  Object
     * @since   2017-08-22
     * @author  NetQuick
     */
    public function scopePublish($query)
    {
        return $query->where(['chrPublish' => 'Y']);
    }

    /**
     * This method handels delete scope
     * @return  Object
     * @since   2017-08-22
     * @author  NetQuick
     */
    public function scopeDeleted($query)
    {
        return $query->where(['chrDelete' => 'N']);
    }

    /**
     * This method handels order by display order
     * @return  Object
     * @since   2017-08-22
     * @author  NetQuick
     */
    public function scopeDisplayOrderBy($query, $orderBy)
    {
        return $query->orderBy('intDisplayOrder', $orderBy);
    }

    /**
     * This method handels order by display order
     * @return  Object
     * @since   2017-08-22
     * @author  NetQuick
     */
    public function scopeCheckByAlbumId($query, $albumId)
    {
        return $query->where('fkIntAlbumId', $albumId);
    }

    /**
     * This method handels filter scope
     * @return  Object
     * @since   2017-08-22
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
            $data = $query->where('chrPublish', $filterArr['statusFilter']);
        }
        if (!empty($filterArr['searchFilter']) && $filterArr['searchFilter'] != ' ') {
            $data = $query->where('varTitle', 'like', "%" . $filterArr['searchFilter'] . "%");
        }
        if (!empty($query)) {
            $response = $query;
        }
        return $response;
    }

    /**
     * This method handels retrival of record count based on album
     * @return  Object
     * @since   2017-10-16
     * @author  NetQuick
     */
    public static function getCountById($albumId = null)
    {
        $response     = false;
        $moduleFields = ['id'];
        $response     = Self::getPowerPanelRecords($moduleFields)
            ->checkByAlbumId($albumId)
            ->deleted()
            ->count();
        return $response;
    }

}
