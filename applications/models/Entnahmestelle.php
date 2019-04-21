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

/**
 * Class Entnahmestelle
 * @package app\models
 */
class Entnahmestelle extends BaseModel
{
    protected $connection = "twu";
    protected $table = "wwentnahmestellen";

    protected $primaryKey = "id";

    public $timestamps = false;

    protected $guarded = [];


    public function warmwasseranlage() {
        return $this->belongsTo('app\models\Warmwasseranlage', 'wwanlage_id');
    }

    public function mieter() {
        return $this->belongsTo('app\models\Mieter', 'mieter_id');
    }
}