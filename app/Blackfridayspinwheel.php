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
use App\Helpers\MyLibrary;
use DB;

class Blackfridayspinwheel extends Model {

	protected $table = 'spinwheel_blackfriday';
	protected $fillable = [
		'id',
		'varname',
		'varemail',
		'varphone',
		'promocode',
		'created_at',
	];

}
