<?php

/**
 * The Banner class handels bannner queries
 * ORM implemetation.
 * @package   Netquick powerpanel
 * @license   http://www.opensource.org/licenses/BSD-3-Clause
 * @version   1.1
 * @since   	2017-07-20
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class CareersDetails extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'careers_details';
    protected $fillable = [
        'varfirstname',
        'varlastname',
        'varemail',
        'txtfile',
        'intphonenumber',
        'intcareercat',
        'intexperience',
        'txtmessage',
    ];

    public function careerscategory(){
        $response = false;
        $response = $this->belongsTo('App\CareersCategory', 'intcareercat', 'id');
        return $response;
    }

}
