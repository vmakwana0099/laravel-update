<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permissions'; // If not using Laravel default table naming
    public $timestamps = true; // Adjust based on your table structure

    protected $fillable = [
        'name', 'display_name', 'description', 'intFKModuleCode'
    ];

    /**
     * Get all permissions with optional related module data.
     */
    public static function getPermissions()
    {
        $permissionFields = ['id', 'name', 'display_name', 'description', 'intFKModuleCode'];
        $moduleFields = ['id', 'varTitle'];

        return self::getPowerPanelRecords($permissionFields, $moduleFields)
            ->get()
            ->toArray();
    }

    /**
     * Query builder with optional module relation eager loading.
     */
    public static function getPowerPanelRecords($permissionFields = [], $moduleFields = [])
    {
        $query = self::select($permissionFields);

        if (!empty($moduleFields)) {
            $query->with(['modules' => function ($q) use ($moduleFields) {
                $q->select($moduleFields);
            }]);
        }

        return $query;
    }

    /**
     * Relationship with modules table.
     */
    public function modules()
    {
        return $this->belongsTo(Modules::class, 'intFKModuleCode', 'id');
    }

    /**
     * Relationship with permission_role table.
     * Adjust this model name and relation if you're changing your ACL system.
     */
    public function permissionRole()
    {
        return $this->hasOne(PermissionRole::class, 'permission_id', 'id');
    }
}
