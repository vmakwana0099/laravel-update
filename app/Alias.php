<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use DB;
use Cache;
use Config;

class Alias extends Model {

    use Sluggable;

    protected $table = 'alias';
    protected $fillable = ['varAlias', 'intFkModuleCode'];
    protected static $fetchedID = [];
    protected static $fetchedAlias = null;

    public function sluggable(): array {
        return [
            'varAlias' => [
                'source' => 'alias'
            ]
        ];
    }




    static function getAlias($slug = false) {
        $response = false;
        if (!empty($slug)) {
            $response = Cache::rememberForever($slug, function() use ($slug) {
                        return Self::select(['id', 'intFkModuleCode', 'varAlias'])
                                        ->where('varAlias', $slug)
                                        ->get()
                                        ->first();
                    });
        }
        return $response;
    }

    static function get_module_by_alias($slug = false) {
        $response = false;
        $response = DB::table('alias')
                ->where('varAlias', '=', $slug)
                ->leftJoin('cms_pages', 'cms_pages.module_code', '=', 'alias.intFkModuleCode')
                ->first();
        return $response;
    }

    public static function addAlias($alias = false, $moduleCode = false) {
        $response = false;
        $exists = Self::getAlias($alias);
        if ($exists == false) {
            $data = [
                'varAlias' => $alias,
                'intFkModuleCode' => $moduleCode];
            $response = Self::insertGetId($data);
        } else {
            $response = $exists->id;
        }
        return $response;
    }

    public function module() {
        return $this->belongsTo('App\Modules', 'intFkModuleCode', 'id');
    }

    /**
     * This method handels retrival of records
     * @return  Object
     * @since   04-08-2017
     * @author  NetQuick
     */
    static function getRecords() {
        return self::with(['cmsPage', 'module']);
    }

    /**
     * This method handels pagehits relation
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    public function pagehits() {
        $response = false;
        $response = $this->hasMany('App\Pagehit', 'fkIntAliasId', 'id');
        return $response;
    }

    /**
     * This method handels record id scope
     * @return  Object
     * @since   04-08-2017
     * @author  NetQuick
     */
    function scopeCheckRecordId($query, $id) {
        return $query->where('id', $id);
    }

    function scopeCheckByAlias($query, $alias) {
        return $query->where('varAlias', $alias);
    }

    public function events() {
        return $this->hasOne('App\Blogs', 'id', 'intAliasId');
    }

    public function blogs() {
        return $this->hasOne('App\Blogs', 'id', 'intAliasId');
    }

    public function team() {
        return $this->hasOne('App\team', 'id', 'intAliasId');
    }

    public function client() {
        return $this->hasOne('App\Client', 'id', 'intAliasId');
    }

    public function blogCategory() {
        return $this->hasOne('App\BlogCategory', 'id', 'intAliasId');
    }

    public function servieCategory() {
        return $this->hasOne('App\ServiceCategory', 'id', 'intAliasId');
    }

    public function newsCategory() {
        return $this->hasOne('App\NewsCategory', 'id', 'intAliasId');
    }

    public function eventCategory() {
        return $this->hasOne('App\EventCategory', 'id', 'intAliasId');
    }

    public function sponsorCategory() {
        return $this->hasOne('App\SponsorCategory', 'id', 'intAliasId');
    }

    public function productCategory() {
        return $this->hasOne('App\ProductCategory', 'id', 'intAliasId');
    }

    public function advertiseSlots() {
        return $this->hasOne('App\AdvertiseSlots', 'id', 'intAliasId');
    }

    public function cmspage() {
        return $this->hasOne('App\CmsPage', 'id', 'intAliasId');
    }

    public function staticBlock() {
        return $this->hasOne('App\StaticBlocks', 'id', 'intAliasId');
    }

    public function menu() {
        return $this->hasOne('App\Menu', 'id', 'intAliasId');
    }

    public function menuType() {
        return $this->hasOne('App\MenuType', 'id', 'intAliasId');
    }

    /**
     * This method handels module code check for alias
     * @return  Object
     * @since   2016-07-14
     * @author  NetQuick
     */
    function scopeCheckModuleCode($query, $moduleId = false) {
        if ($moduleId == false) {
            $moduleId = Config::get('Constant.MODULE.ID');
        }
        return $query->where('alias.intFkModuleCode', $moduleId);
    }

    static function updateAlias($oldAlias, $newAlias) {
        Alias::where('varAlias', $oldAlias)->update(['varAlias' => $newAlias]);
    }

}
