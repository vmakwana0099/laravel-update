<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    protected $fillable = [
        'id', 'name', 'display_name', 'description', 'created_at', 'updated_at', 'chr_delete', 'chr_publish'
    ];

    // ===================== Static Custom Methods =====================

    public static function getRecordList($filterArr = false)
    {
        $fields = ['id', 'name', 'display_name', 'description'];
        return self::getPowerPanelRecords($fields)
            ->deleted()
            ->filter($filterArr)
            ->get();
    }

    public static function getRecordListing($filterArr = false)
    {
        $fields = ['id', 'display_name'];
        return self::getPowerPanelRecords($fields)
            ->deleted()
            ->pluck('display_name', 'id');
    }

    public static function getRecordById($id = false)
    {
        $fields = ['id', 'name', 'display_name', 'description'];
        return self::getPowerPanelRecords($fields)
            ->deleted()
            ->checkRecordId($id)
            ->first();
    }

    public static function updateRecord($id = false, $data = false)
    {
        return self::where('id', $id)->update($data);
    }

    public static function getRecordForLogById($id)
    {
        $fields = ['id', 'name', 'display_name', 'description'];
        return self::getPowerPanelRecords($fields)
            ->deleted()
            ->checkRecordId($id)
            ->first();
    }

    public static function getFrontRecords($fields = false)
    {
        return self::select($fields);
    }

    public static function getPowerPanelRecords($fields = false)
    {
        return self::select($fields);
    }

    public static function getRecords($searchVal = '')
    {
        return self::with([]);
    }

    // ===================== Scopes =====================

    public function scopeCheckRecordId($query, $id)
    {
        return $query->where('id', $id);
    }

    public function scopeDeleted($query)
    {
        return $query->where(['chr_delete' => 'N']);
    }

    public function scopeFilter($query, $filterArr = false, $returnTotalRecords = false)
    {
        if (!empty($filterArr['orderByFieldName']) && !empty($filterArr['orderTypeAscOrDesc'])) {
            $query->orderBy($filterArr['orderByFieldName'], $filterArr['orderTypeAscOrDesc']);
        } else {
            $query->orderBy('name', 'DESC');
        }

        if (!$returnTotalRecords && !empty($filterArr['iDisplayLength']) && $filterArr['iDisplayLength'] > 0) {
            $query->skip($filterArr['iDisplayStart'])->take($filterArr['iDisplayLength']);
        }

        if (!empty($filterArr['searchFilter']) && trim($filterArr['searchFilter']) !== '') {
            $query->where(function ($q) use ($filterArr) {
                $q->where('name', 'like', '%' . $filterArr['searchFilter'] . '%')
                  ->orWhere('display_name', 'like', '%' . $filterArr['searchFilter'] . '%');
            });
        }

        return $query;
    }
}
