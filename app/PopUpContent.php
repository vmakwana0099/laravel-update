<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;
class PopUpContent extends Model {
	/**
	* The attributes that are mass assignable.
	*
	* @var array
	*/
	protected $table = 'pop_up_content';
	protected $fillable = [
	'id',
	'varTitle',
	'txtDescription',
	'dtStartDateTime',
	'dtEndDateTime',
	'chrPublish',
	'chrDelete'
	];

	/**
	 * This method handels retrival of faqs records
	 * @return  Object
	 * @since   2016-07-20
	 * @author  NetQuick
	 */
	static function getRecords() {
			return self::with([]);
	}

	/**
	 * This method handels record id scope
	 * @return  Object
	 * @since   2016-07-24
	 * @author  NetQuick
	 */
	function scopeCheckRecordId($query, $id) {
			return $query->where('id', $id);
	}

	/**
	 * This method handels publish scope
	 * @return  Object
	 * @since   2016-07-20
	 * @author  NetQuick
	 */
	function scopePublish($query) {
			return $query->where(['chrPublish' => 'Y']);
	}

	/**
	 * This method handels delete scope
	 * @return  Object
	 * @since   2016-07-20
	 * @author  NetQuick
	 */
	function scopeDeleted($query) {
			return $query->where(['chrDelete' => 'N']);
	}
	/**
	 * This method handels filter scope
	 * @return  Object
	 * @since   2016-08-08
	 * @author  NetQuick
	 */
	function scopeFilter($query) {
		return $query->whereRaw('NOW() BETWEEN dtStartDateTime AND dtEndDateTime');
	}

	/**
	 * This method handels retrival of record by id
	 * @return  Object
	 * @since   2017-10-16
	 * @author  NetQuick
	 */
	public static function getPopupContent()
	{
		$response = false;
		$moduleFields=['id', 'varTitle' , 'txtDescription', 'dtStartDateTime','dtEndDateTime','chrPublish'];
		$response =  Self::select($moduleFields)->deleted()->first();
		return $response;
	}
	/**
	 * This method handels retrival of record by id
	 * @return  Object
	 * @since   2017-10-16
	 * @author  NetQuick
	 */
	public static function getRecordById($id)
	{
		$response = false;
		$moduleFields=['id', 'varTitle' , 'txtDescription', 'dtStartDateTime','dtEndDateTime','chrPublish'];
		$response =  Self::select($moduleFields)->deleted()->checkRecordId($id)->first();
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
		$moduleFields=['id', 'varTitle' , 'txtDescription', 'dtStartDateTime','dtEndDateTime','chrPublish'];
		$response =  Self::select($moduleFields)->deleted()->checkRecordId($id)->first();
		return $response;
	}

}
