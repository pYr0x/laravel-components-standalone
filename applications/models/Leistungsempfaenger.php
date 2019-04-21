<?php
/**
 * creation date: 31.03.2019
 *
 * @author          Julian Kern
 * @copyright       Copyright (c) 2007-2019 Julian Kern, twentytwo Solutions (http://www.22-solutions.de)
 * All Rights Reserved
 *
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */


namespace app\models;


use twentytwo\BaseModel;

class Leistungsempfaenger extends BaseModel
{
    protected $connection = "mdm";
    protected $table = 'leistungsempfaenger';
    protected $primaryKey = "id";

    public $timestamps = false;

    protected $guarded = [];

    public function auftraggeber() {
        return $this->belongsTo('app\models\Auftraggeber', 'auftraggeber_id');
    }

    public function warmwasseranlagen() {
        return $this->hasMany('app\models\Warmwasseranlage', 'leistungsempfaenger_id');
    }
}