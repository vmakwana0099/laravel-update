<?php
namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
use Cache;

class VideoAlbum extends Model
{

    protected $table    = 'video_album';
    protected $fillable =
        [
        'id',
        'varTitle',
        'intAliasId',
        'fkIntVideoId',
        'intDisplayOrder',
        'txtDescription',
        'chrDisplay',
        'chrPublish',
        'chrDelete',
        'varMetaTitle',
        'varMetaKeyword',
        'varMetaDescription',
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
        $response = Cache::tags(['VideoAlbums'])->get('getVideoAlbumsRecordIdByAliasID_'.$aliasID);
        if(empty($response)){
            $response = Self::Select('id')->deleted()->publish()->checkAliasId($aliasID)->first();
            Cache::tags(['VideoAlbums'])->forever('getVideoAlbumsRecordIdByAliasID_'.$aliasID, $response);
        }
        return $response;
    }
    /**
     * This method handels retrival of front videoAlbum list
     * @return  Object
     * @since   2017-10-13
     * @author  NetQuick
     */
    public static function getFrontList($range = false, $filterArr = false,$page=1)
    {
        $videoAlbumFields  = ['id', 'varTitle', 'fkIntVideoId', 'intAliasId', 'txtDescription', 'varMetaTitle', 'varMetaKeyword', 'varMetaDescription'];
        $aliasFields       = ['id', 'varAlias'];
        $videoFields       = ['id'];
        $videoGalaryFields = ['fkIntAlbumId'];
        $response = Cache::tags(['VideoAlbums'])->get('getVideoAlbumFrontList_'.$page);              
        if(empty($response)){
            $response = Self::getFrontRecords($videoAlbumFields, $aliasFields, $videoFields, $videoGalaryFields)
            ->orderBy('created_at', 'desc')
            ->deleted()
            ->publish()
            ->filter($filterArr)
            ->displayOrderBy('ASC')
            ->paginate($range);
            Cache::tags(['VideoAlbums'])->forever('getVideoAlbumFrontList_'.$page, $response);
        }
        return $response;
    }

    /**
     * This method handels retrival of front videoAlbum list
     * @return  Object
     * @since   2017-10-13
     * @author  NetQuick
     */
    public static function getFrontDropDownList($range = false, $filterArr = false)
    {
        $videoAlbumFields = ['id', 'varTitle'];
        $response = Cache::tags(['VideoAlbums'])->get('getVideoAlbumgetFrontDropDownList');              
        if(empty($response)){
            $response = Self::getFrontRecords($videoAlbumFields)
                ->orderBy('created_at', 'desc')
                ->deleted()
                ->publish()
                ->get()
                ->pluck('varTitle', 'id')
                ->toArray();
            Cache::tags(['VideoAlbums'])->forever('getVideoAlbumgetFrontDropDownList', $response);    
        }
        return $response;
    }

    /**
     * This method handels retrival of front videoAlbum list
     * @return  Object
     * @since   2017-10-13
     * @author  NetQuick
     */
    public static function getAlbumForGalaryList($id = null)
    {
        $videoAlbumFields = [
            'id',
            'varMetaTitle',
            'varMetaKeyword',
            'varMetaDescription',
        ];
        $response = Cache::tags(['VideoAlbums'])->get('getVideoAlbumForGalaryList_'.$id);                    
        if(empty($response)){   
            $response = Self::select($videoAlbumFields)
                ->checkAliasId($id)
                ->publish()
                ->deleted()
                ->get();
            Cache::tags(['VideoAlbums'])->forever('getVideoAlbumForGalaryList_'.$id, $response);
        }
        return $response;
    }

    /**
     * This method handels retrival of record count
     * @return  Object
     * @since   2017-10-16
     * @author  NetQuick
     */
    public static function getRecordList($filterArr = false)
    {
        $response         = false;
        $videoAlbumFields = ['id', 'varTitle', 'intAliasId', 'fkIntVideoId', 'intDisplayOrder', 'txtDescription', 'chrPublish'];
        $response         = Self::getPowerPanelRecords($videoAlbumFields)->deleted()->filter($filterArr)->get();
        return $response;
    }

    /**
     * This method handels retrival of record count
     * @return  Object
     * @since   2017-10-16
     * @author  NetQuick
     */
    public static function getRecordsWithAlias()
    {
        $response         = false;
        $videoAlbumFields = ['id', 'varTitle', 'intAliasId', 'fkIntVideoId', 'intDisplayOrder', 'txtDescription', 'chrPublish'];
        $aliasFields      = ['id', 'varAlias'];
        $response         = Self::getPowerPanelRecords($videoAlbumFields, $aliasFields)
            ->deleted()
            ->get();
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
        $videoAlbumFields = ['id', 'varTitle', 'intAliasId', 'fkIntVideoId', 'intDisplayOrder', 'txtDescription', 'chrPublish', 'varMetaTitle', 'varMetaKeyword', 'varMetaDescription'];
        $aliasFields      = ['id', 'varAlias'];
        $response         = Self::getPowerPanelRecords($videoAlbumFields, $aliasFields)->deleted()->checkRecordId($id)->first();
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
        $moduleFields = ['id', 'varTitle', 'fkIntVideoId', 'intDisplayOrder', 'txtDescription', 'chrPublish', 'varMetaTitle', 'varMetaKeyword', 'varMetaDescription'];
        $response     = Self::getPowerPanelRecords($moduleFields)->deleted()->checkRecordId($id)->first();
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
     * This method handels retrival of videoAlbum records
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public static function getFrontRecords($videoAlbumFields = false, $aliasFields = false, $videoFields = false, $videoGalleryFields = false)
    {
        $data     = [];
        $response = false;
        $response = self::select($videoAlbumFields);
        if ($videoFields != false) {
            $data['video'] = function ($query) use ($videoFields) {$query->select($videoFields)->publish();};
        }
        if ($aliasFields != false) {
            $data['alias'] = function ($query) use ($aliasFields) {$query->select($aliasFields)->checkModuleCode();};
        }
        if ($videoGalleryFields != false) {
            $data['videoGallery'] = function ($query) use ($videoGalleryFields) {$query->select($videoGalleryFields);};
        }

        if (count($data) > 0) {
            $response = $response->with($data);
        }
        return $response;
    }

    /**
     * This method handels retrival of blog records
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public static function getPowerPanelRecords($videoAlbumFields = false, $aliasFields = false, $videoGalleryFields = false)
    {
        $data = [];
        if ($aliasFields != false) {
            $data['alias'] = function ($query) use ($aliasFields) {
                $query->select($aliasFields);
            };
        }
        if ($videoGalleryFields != false) {
            $data['videoGallery'] = function ($query) use ($videoGalleryFields) {
                $query->select($videoGalleryFields);
            };
        }
        return self::select($videoAlbumFields)->with($data);
    }

    /**
     * This method handels alias relation
     * @return  Object
     * @since   2016-08-21
     * @author  NetQuick
     */
    public function alias()
    {
        return $this->belongsTo('App\Alias', 'intAliasId', 'id');
    }

    public function videoGallery()
    {
        return $this->hasMany('App\VideoGallery', 'fkIntAlbumId', 'id');
    }

    /**
     * This method handels video relation
     * @return  Object
     * @since   2016-08-21
     * @author  NetQuick
     */
    public function video()
    {
        return $this->belongsTo('App\Video', 'fkIntVideoId', 'id');
    }

    /**
     * This method handels retrival of show records
     * @return  Object
     * @since   2016-08-21
     * @author  NetQuick
     */
    public static function getRecords()
    {
        return self::with([
            'alias',
            'video',
        ]);
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
     * @since   2016-08-21
     * @author  NetQuick
     */
    public function scopeOrderCheck($query, $order)
    {
        return $query->where('intDisplayOrder', $order);
    }
    /**
     * This method handels publish scope
     * @return  Object
     * @since   2016-08-21
     * @author  NetQuick
     */
    public function scopePublish($query)
    {
        return $query->where(['chrPublish' => 'Y']);
    }

    /**
     * This method handels delete scope
     * @return  Object
     * @since   2016-08-21
     * @author  NetQuick
     */
    public function scopeDeleted($query)
    {
        return $query->where(['chrDelete' => 'N']);
    }

    /**
     * This method handels delete scope
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public function scopeDisplayOrderBy($query, $orderBy)
    {
        return $query->orderBy('intDisplayOrder', $orderBy);
    }

    /**
     * This method handels filter scope
     * @return  Object
     * @since   2016-08-21
     * @author  NetQuick
     */
    public function scopeFilter($query, $filterArr = false, $retunTotalRecords = false)
    {
        $response = null;
        if (!empty($filterArr['orderByFieldName']) && !empty($filterArr['orderTypeAscOrDesc'])) {
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

    public static function list_video_albums($start = false, $limit = false, $orderByFieldName = false, $orderTypeAscOrDesc = false, $searchFilter = false, $statusFilter = false, $retunTotalRecords = false)
    {
        $module   = DB::table('modules')->where('var_module_name', '=', 'video-album')->first();
        $response = false;
        $data     = '';
        $query    = '';
        $query    = DB::table('video_album')
            ->select(
                'video_album.id',
                'video_album.title',
                'video_album.video_id',
                'video_album.display_order',
                'video_album.display',
                'video_album.chr_publish',
                'video_album.chr_delete',
                'video_album.varMetaTitle',
                'video_album.varMetaKeyword',
                'video_album.varMetaDescription',
                'video_album.created_at',
                'video_album.updated_at',
                'alias.alias',
                'videos.id as v_id',
                'videos.fk_user_id',
                'videos.youtube_id',
                'videos.txt_video_url',
                'videos.txt_video_path',
                'videos.var_video_slug',
                'videos.var_video_name',
                'videos.var_video_extension',
                'videos.chr_is_user_uploaded',
                DB::raw("COUNT(video_gallery.fk_album_id) as video_count")
            )

            ->leftJoin('videos', 'videos.id', '=', 'video_album.video_id')
            ->leftJoin('alias', 'video_album.id', '=', 'alias.fk_record_code')
            ->leftJoin('video_gallery', 'video_gallery.fk_album_id', '=', 'video_album.id')
            ->where('video_album.chr_delete', 'N')
            ->where('alias.fk_module_code', $module->int_code)
            ->groupBy('video_album.id');

        if (!empty($orderByFieldName) && !empty($orderTypeAscOrDesc)) {
            $data = $query->orderBy($orderByFieldName, $orderTypeAscOrDesc);
        } else {
            $data = $query->orderBy('video_album.display_order', 'ASC');
        }
        if (!$retunTotalRecords) {
            if (!empty($limit) && $limit > 0) {
                $data = $query->skip($start)->take($limit);
            }
        }

        if (!empty($searchFilter)) {
            $data = $query->whereRaw("(video_album.title LIKE '%$searchFilter%' or video_album.description LIKE '%$searchFilter%')");
        }

        if (!empty($statusFilter) && $statusFilter != ' ') {
            $data = $query->where('video_album.chr_publish', '=', $statusFilter);
        }

        if (!empty($data)) {
            //DB::enableQueryLog();
            $response = $data->get();
            //dd(DB::getQueryLog());

        }
        return $response;
    }

    public static function get_video_album($id = false)
    {

        $response = false;
        $data     = DB::table('video_album')
            ->select(
                'video_album.id',
                'video_album.title',
                'video_album.video_id',
                'video_album.description',
                'video_album.display_order',
                'video_album.display',
                'video_album.chr_publish',
                'video_album.chr_delete',
                'video_album.varMetaTitle',
                'video_album.varMetaKeyword',
                'video_album.varMetaDescription',
                'video_album.created_at',
                'video_album.updated_at',
                'videos.id as v_id',
                'videos.fk_user_id',
                'videos.txt_video_url',
                'videos.txt_video_path',
                'videos.var_video_slug',
                'videos.var_video_name',
                'videos.var_video_extension',
                'videos.chr_is_user_uploaded'
            )
            ->leftJoin('videos', 'videos.id', '=', 'video_album.video_id')
            ->where('video_album.id', '=', $id);
        if (!empty($data)) {
            $response = $data->first();
        }

        return $response;
    }

    /**
     * This method handels retrival of album title by album id
     * @return  Object
     * @since   2017-10-16
     * @author  NetQuick
     */
    public static function getAlbumTitleById($albumId = false)
    {
        $response     = false;
        $moduleFields = ['varTitle'];
        $response     = Self::getPowerPanelRecords($moduleFields)
            ->deleted()
            ->checkRecordId($albumId)
            ->first();
        return $response;
    }

}
