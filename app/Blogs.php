<?php
/**
 * The Blog class handels blog model queries
 * ORM implemetation.
 * @package   Netquick powerpanel
 * @license   http://www.opensource.org/licenses/BSD-3-Clause
 * @version   1.00
 * @since   	2016-07-14
 * @author    NetQuick
 */
namespace App;
use Illuminate\Database\Eloquent\Model;
use Cache;
use DB;
class Blogs extends Model {
		protected $table = 'blog';
		protected $fillable = [
			'id',
			'intAliasId',
			'varTitle',
			'varAuthor',
			'fkIntImgId',
			'fkIntVideoId',
			'dtStartDateTime',
			'dtEndDateTime',
			'varExternalLink',
			'txtShortDescription',
			'txtDescription',
			'txtCategories',
			'intDisplayOrder',
			'varFeaturedBlog',
			'varWelcomeSectionBlog',
			'varMetaTitle',
			'varMetaKeyword',
			'varMetaDescription',
			'chrPublish',
			'chrDelete',
			'created_at',
			'updated_at'
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
        $response = Cache::tags(['Blogs'])->get('getBlogRecordIdByAliasID_'.$aliasID);
        if(empty($response)){
					$response = Self::Select('id')->deleted()->publish()->checkAliasId($aliasID)->first();
					Cache::tags(['Blogs'])->forever('getBlogRecordIdByAliasID_'.$aliasID, $response);
				}
        return $response;
    }

		/**
		 * This method handels retrival of front service list
		 * @return  Object
		 * @since   2017-10-14
		 * @author  NetQuick
		 */
		public static function getFrontList($filterArr=false, $page=1){
			$response = false;
			
			$moduleFields=['varTitle', 'varAuthor', 'txtShortDescription','fkIntImgId', 'intAliasId', 'dtStartDateTime'];			
			$aliasFields=['id','varAlias'];

			$response = Cache::tags(['Blogs'])->get('getBlogFrontList_'.$page);			
			if(empty($response)){
				$response = Self::getFrontRecords($moduleFields, $aliasFields)
				->deleted()
				->publish()
				->filter($filterArr)
				->paginate(1);
				Cache::tags(['Blogs'])->forever('getBlogFrontList_'.$page, $response);
			}		
			
			return $response;
		}

		/**
		 * This method handels retrival of front latest blog list
		 * @return  Object
		 * @since   2017-10-13
		 * @author  NetQuick
		 */
		public static function getLatestList($id=false){
			$response = false;			
			$moduleFields=['varTitle', 'fkIntImgId', 'intAliasId', 'dtStartDateTime'];
			$aliasFields=['id','varAlias'];
			$response = Cache::tags(['Blogs'])->get('getBlogLatestList_'.$id);
			if(empty($response)){
				$response = Self::getFrontRecords($moduleFields, $aliasFields)
				->deleted()
				->publish()
				->take(5)
				->get();
				Cache::tags(['Blogs'])->forever('getBlogLatestList_'.$id, $response);
			}
			return $response;
		}

		/**
		 * This method handels retrival of front latest blog list
		 * @return  Object
		 * @since   2017-10-13
		 * @author  NetQuick
		 */
		public static function getFeaturedList($limit=10){
			$response = false;
			$moduleFields=['varTitle', 'varAuthor','fkIntImgId', 'intAliasId', 'dtStartDateTime','txtShortDescription'];			
			$aliasFields=['id','varAlias'];
			$response = Cache::tags(['Blogs'])->get('getBlogFeaturedList');
			if(empty($response)){
				$response = Self::getFrontRecords($moduleFields, $aliasFields)
				->deleted()
				->publish()
				->featured('Y')
				->displayOrderBy('DESC')
				->take($limit)
				->get();
				Cache::tags(['Blogs'])->forever('getBlogFeaturedList', $response);
			}
			return $response;
		}

		/**
		 * This method handels retrival of front blog detail
		 * @return  Object
		 * @since   2017-10-13
		 * @author  NetQuick
		 */
		public static function getFrontDetail($id){
			$response = false;			
			$moduleFields=['id','varTitle', 'txtDescription','fkIntImgId', 'intAliasId', 'dtStartDateTime'];
			$aliasFields=['id','varAlias'];
			$response = Cache::tags(['Blogs'])->get('getFrontBlogDetail_'.$id);
			if(empty($response)){
				$response = Self::getFrontRecords($moduleFields, $aliasFields)
				->deleted()
				->checkAliasId($id)
				->first();
				Cache::tags(['Blogs'])->forever('getFrontBlogDetail_'.$id, $response);	
			}
			return $response;
		}

		/**
		 * This method handels retrival of front blog detail
		 * @return  Object
		 * @since   2017-10-13
		 * @author  NetQuick
		 */
		public static function getFeaturedBlogs($limit=10){
			$response = false;			
			$moduleFields=['id','varTitle', 'txtDescription','fkIntImgId', 'intAliasId', 'dtStartDateTime'];
			$aliasFields=['id','varAlias'];
			$response = Cache::tags(['Blogs'])->get('getFeaturedBlogs');
			if(empty($response)){
				$response = Self::getFrontRecords($moduleFields, $aliasFields)
				->featured('Y')
				->deleted()
				->publish()
				->take($limit)
				->get();
				Cache::tags(['Blogs'])->forever('getFeaturedBlogs', $response);	
			}

			return $response;
		}	
		
		/**
		 * This method handels retrival of front blog detail
		 * @return  Object
		 * @since   2017-10-13
		 * @author  NetQuick
		 */
		public static function getWelcomeBlog(){
			$response = false;			
			$moduleFields=['id','varTitle', 'txtDescription','fkIntImgId', 'intAliasId', 'dtStartDateTime'];
			$aliasFields=['id','varAlias'];
			$response = Cache::tags(['Blogs'])->get('getWelcomeBlog');
			if(empty($response)){
				$response = Self::getFrontRecords($moduleFields, $aliasFields)
				->deleted()
				->publish()
				->welcomeSection()
				->first();
				Cache::tags(['Blogs'])->forever('getWelcomeBlog', $response);	
			}
			return $response;
		}	

		/**
		 * This method handels retrival of record count based on category
		 * @return  Object
		 * @since   2017-10-16
		 * @author  NetQuick
		 */
		public static function getCountById($categoryId=null){
			$response=false;
			$moduleFields=['id'];						
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
		public static function getRecordList($filterArr=false){
			$response=false;
			$moduleFields=[ 'id', 'intAliasId', 'varFeaturedBlog', 'varTitle', 'fkIntImgId', 'txtCategories', 'varAuthor', 'intDisplayOrder', 'txtShortDescription', 'txtDescription','dtStartDateTime', 'chrPublish'];
			$aliasFields=['id','varAlias'];
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
		public static function getRecordById($id=false){
			$response=false;
			$moduleFields=[ 
			'id',
			'intAliasId',
			'varTitle',
			'fkIntImgId',
			'fkIntVideoId',
			'txtCategories',
			'varAuthor',
			'varExternalLink',
			'varFeaturedBlog',
			'intDisplayOrder', 			
			'txtShortDescription', 
			'txtDescription', 
			'dtStartDateTime', 
			'varMetaTitle',
			'varMetaKeyword',
			'varMetaDescription',
			'chrPublish'];
			$aliasFields=['id','varAlias'];
		  $videoFields = ['id', 'varVideoName', 'varVideoExtension', 'youtubeId'];
      $response    = Self::getPowerPanelRecords($moduleFields, $aliasFields , $videoFields)
			->deleted()
			->checkRecordId($id)
			->first();
			return $response;
		}

		/**
		 * This method handels retrival of front service list
		 * @return  Object
		 * @since   2017-10-14
		 * @author  NetQuick
		 */
		public static function getFrontPopularList($limit=5){
			$response = false;
			
			$fieldsArr['moduleFields'] = [
				'blog.id',
				'blog.varTitle', 
				'blog.varAuthor', 
				'blog.txtShortDescription',
				'blog.fkIntImgId', 
				'blog.intAliasId', 
				'blog.dtStartDateTime',
				DB::raw("COUNT(fkIntAliasId) as maxhit")
			];			
			$fieldsArr['aliasFields'] = ['id','varAlias'];
			$fieldsArr['pageHitsFields'] = ['id','fkIntAliasId'];
			
			$response = Self::getRecordsForFront($fieldsArr)
				->deleted()
				->publish()
				->groupBy('blog.intAliasId')
				->groupBy('blog.id')
				->orderBy('maxhit','DESC')
				->popularBlogsFilter()
				->take($limit)
				->get();		
			
			return $response;
		}

		/**
		 * This method handels retrival of front lists
		 * @return  Object
		 * @since   2017-10-14
		 * @author  NetQuick
		 */

		static function getRecordsForFront($fieldsArr){
				$data     = [];
				$response = false;
				$response     = Self::select($fieldsArr['moduleFields']);

				if (count($data) > 0) {
						$response = $response->with($data);
				}
				return $response;
		}

		/**
		 * This method handels retrival of record count
		 * @return  Object
		 * @since   2017-10-16
		 * @author  NetQuick
		 */
		protected static $fetchedOrder=[];
		protected static $fetchedOrderObj=null;
		public static function getRecordByOrder($order=false){
			$response = false;
			$moduleFields=[ 
			'id',
			'intDisplayOrder'
			];			
			if(!in_array($order, Self::$fetchedOrder)){
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
		 * This method handels retrival of blog records old version *=Delete it afterwards=*
		 * @return  Object
		 * @since   2016-07-14
		 * @author  NetQuick
		 */
		static function getRecords() {
			$response = false;
			$data=['image','alias','blogCategory'];
			if(count($data)>0){
				$response = Self::with($data);
			}			
			return $response;
		}

		/**
		 * This method handels retrival of blog records
		 * @return  Object
		 * @since   2016-07-14
		 * @author  NetQuick
		 */
		static function getFrontRecords($moduleFields=false, $aliasFields=false, $imageFields=false) {
			$response = false;
			$data=[
				'alias' => function ($query) use ($aliasFields) { $query->select($aliasFields); }				
			];
			$response = self::select($moduleFields)->with($data);
			return $response;
		}

		/**
		 * This method handels retrival of blog records
		 * @return  Object
		 * @since   2016-07-14
		 * @author  NetQuick
		 */
		static function getPowerPanelRecords($moduleFields=false, $aliasFields=false, $videoFields = false, $imageFields=false, $categoryFields=false) 
		{			
			$data=[];
			$response=false;
			$response=self::select($moduleFields);
			if($imageFields!=false){
				$data['image']= function ($query) use ($imageFields) { $query->select($imageFields);  };
			}			
			if($aliasFields!=false){
				$data['alias'] = function ($query) use ($aliasFields) { $query->select($aliasFields)->checkModuleCode(); };
			}

			 if ($videoFields != false) {
          $data['video'] = function ($query) use ($videoFields) {$query->select($videoFields)->publish();};
        }

			if($categoryFields!=false){
				$data['blogCategory']=function ($query) use ($categoryFields) { $query->select($categoryFields);  };
			}
			if(count($data)>0){
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
			$response = false;
			$moduleFields=['id', 'intAliasId','varTitle','fkIntImgId','txtCategories','fkIntVideoId', 'varAuthor','varExternalLink','varFeaturedBlog','intDisplayOrder', 'txtShortDescription', 'txtDescription', 'dtStartDateTime', 'varMetaTitle','varMetaKeyword','varMetaDescription','chrPublish'];
			$response =  Self::getPowerPanelRecords($moduleFields)->deleted()->checkRecordId($id)->first();
			return $response;
		}

		/**
		 * This method handels alias relation
		 * @return  Object
		 * @since   2016-07-14
		 * @author  NetQuick
		 */
		public function alias() {
			$response = false;
			$response = $this->belongsTo('App\Alias', 'intAliasId', 'id');
			return $response;
		}
		/**
		 * This method handels image relation
		 * @return  Object
		 * @since   2016-07-14
		 * @author  NetQuick
		 */
		public function image() {
			$response = false;
			$response = $this->belongsTo('App\Image', 'fkIntImgId', 'id');
			return $response;
		}
		 /**
     * This method handels video relation
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public function video()
    {
            return $this->belongsTo('App\Video', 'fkIntVideoId', 'id');
    }
		/**
		 * This method handels news category relation
		 * @return  Object
		 * @since   2016-07-14
		 * @author  NetQuick
		 */
		public function blogCategory() {
			$response = false;
			$response = $this->belongsTo('App\BlogCategory', 'intCategoryId', 'id');
			return $response;
		}	
		/**
		 * This method handels alias id scope
		 * @return  Object
		 * @since   2016-07-24
		 * @author  NetQuick
		 */
		function scopeCheckAliasId($query, $id) {
			$response = false;
			$response = $query->where('intAliasId', $id);
			return $response;
		}
		/**
		 * This method handels record id scope
		 * @return  Object
		 * @since   2016-07-24
		 * @author  NetQuick
		 */
		function scopeCheckRecordId($query, $id) {
			$response =false;
			$response = $query->where('id', $id);
			return $response;
		}
		/**
		 * This method handels category id scope
		 * @return  Object
		 * @since   2016-07-14
		 * @author  NetQuick
		 */
		function scopeCheckCategoryId($query, $id) {
			$response = false;
			$response = $query->where('txtCategories','like', '%'.'"'.$id.'"'.'%');
			return $response;
		}
		/**
		 * This method handels order scope
		 * @return  Object
		 * @since   2016-07-14
		 * @author  NetQuick
		 */
		function scopeOrderCheck($query, $order) {
			$response = false;
			$response = $query->where('intDisplayOrder', $order);
			return $response;
		}
		/**
		 * This method handels publish scope
		 * @return  Object
		 * @since   2016-07-14
		 * @author  NetQuick
		 */
		function scopePublish($query) {
			$response = false;
			$response = $query->where(['chrPublish' => 'Y']);
			return $response;
		}
		/**
		 * This method handels delete scope
		 * @return  Object
		 * @since   2016-07-14
		 * @author  NetQuick
		 */
		function scopeDeleted($query) {
			$response = false;
			$response = $query->where(['chrDelete' => 'N']);
			return $response;
		}
		/**
		 * This method handels welcome section scope
		 * @return  Object
		 * @since   2016-08-08
		 * @author  NetQuick
		 */
		function scopeWelcomeSection($query) {
			$response = false;
			$response = $query->where(['varWelcomeSectionBlog' => 'Y']);
			return $response;
		}
		/**
		 * This method handels featured scope
		 * @return  Object
		 * @since   2016-08-08
		 * @author  NetQuick
		 */
		function scopeFeatured($query,$flag=null) {
			$response = false;
			$response = $query->where(['varFeaturedBlog' => $flag]);
			return $response;
		}

		/**
		 * This method handels Popular Blogs scope
		 * @return  Object
		 * @since   2016-08-30
		 * @author  NetQuick
		 */
		function scopeLatest($query,$id=false) {
			$response = false;			
			$response = $query->groupBy('id')->orderBy('created_at','desc');
			if($id>0){
				$response = $response->where('id','!=',$id);
			}
			//->whereRaw('created_at > DATE_SUB(NOW(), INTERVAL 7 DAY)')			
			//->whereRaw('created_at <= NOW()')			
			return $response;
		}

		/**
		 * This method handels filter scope
		 * @return  Object
		 * @since   2016-07-14
		 * @author  NetQuick
		 */
		function scopeFilter($query, $filterArr = false ,$retunTotalRecords = false) {
				$response = false;
				if ((!empty($filterArr['orderByFieldName'])) && (!empty($filterArr['orderTypeAscOrDesc']))) {
						$query = $query->orderBy($filterArr['orderByFieldName'], $filterArr['orderTypeAscOrDesc']);
				} else {
						$query = $query->orderBy('varTitle', 'ASC');
				}

				if ($retunTotalRecords) {
						if (!empty($filterArr['iDisplayLength']) && $filterArr['iDisplayLength'] > 0) {
								$data = $query->skip($filterArr['iDisplayStart'])->take($filterArr['iDisplayLength']);
						}
				}
				if (!empty($filterArr['statusFilter']) && $filterArr['statusFilter'] != ' ') {
						$data = $query->where('chrPublish' ,$filterArr['statusFilter']);
				}
				if (!empty($filterArr['catFilter']) && $filterArr['catFilter'] != ' ') {
						$data = $query->where('txtCategories' ,'like','%'.'"'.$filterArr['catFilter'].'"'.'%');
				}
				
				if (!empty($filterArr['searchFilter']) && $filterArr['searchFilter'] != ' ') {
						$data = $query->where('varTitle','like', "%".$filterArr['searchFilter'] . "%");
				}
				
				if (!empty($filterArr['start'])) {
						$data = $query->whereRaw('DATE(dtStartDateTime) >= DATE("' . date('Y-m-d', strtotime(str_replace('/','-',$filterArr['start']))) . '")');
				}

				if (!empty($filterArr['end'])) {
						$data = $query->whereRaw('DATE(dtStartDateTime) <= DATE("' . date('Y-m-d', strtotime(str_replace('/','-',$filterArr['end']))) . '") AND dtStartDateTime IS NOT null');
				}
				
				if (!empty($query)) {
						$response = $query;
				}
				return $response;
		}
		/**
		 * This method handels front search scope
		 * @return  Object
		 * @since   2016-08-09
		 * @author  NetQuick
		 */
		function scopeFrontSearch($query, $term='') {
			$response = false;
			$response = $query->where(['varTitle', 'like', '%'.$term.'%']);
			return $response;
		}

		/**
		* This method handels orderBy scope
		* @return  Object
		* @since   2016-08-08
		* @author  NetQuick
		*/
		public function scopeDisplayOrderBy($query, $orderBy)
		{
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
    public function scopePopularBlogsFilter($query, $filterArr = false, $retunTotalRecords = false)
    {
        $response = null;
        $query = $query->leftJoin('alias', 'alias.id', '=', 'blog.intAliasId');
        $query = $query->leftJoin('page_hits','page_hits.fkIntAliasId','=','alias.id');

        if (!empty($query)) {
            $response = $query;
        }

        return $response;
    }
}
