<?php
/**
* This helper give description for static block section by alias.
* @package   Netquick
* @version   1.00
* @since     2016-12-07
* @author    Vishal Agrawal
*/
namespace App\Helpers;
use App\StaticBlocks;
use App\Http\Traits\slug;

class static_block {
	use slug;

  static function static_block($alias) {
		if (!empty($alias)) 
		{
			$alisasID = slug::resolve_alias_for_routes($alias);
			$data = StaticBlocks::get_description_by_alias($alisasID);
			if (!empty($data)) 
			{
				return $data->txtDescription;
			}
		}
	}
}