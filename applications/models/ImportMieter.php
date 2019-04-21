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

class ImportMieter extends BaseModel
{
    protected $connection = "mdm";
    protected $table = "import_mieter";

    protected $primaryKey = "import_mieter_id";

    public $timestamps = false;

    protected $guarded = [];

    public function entnahmestelle() {
        return $this->hasMany('app\model\ImportEntnahmestelle', 'import_mieter_id');
    }

}