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

class ImportEntnahmestelle extends BaseModel
{
    protected $connection = "mdm";
    protected $table = "import_wwentnahmestellen";

    protected $primaryKey = "import_wwentnahmestelle_id";

    public $timestamps = false;

    protected $guarded = [];


    public function warmwasseranlage() {
        return $this->belongsTo('app\models\ImportWarmwasseranlage', 'import_wwanlage_id');
    }

    public function mieter() {
        return $this->belongsTo('app\models\ImportMieter', 'import_wwentnahmestelle_id', 'import_entnahmestelle_id');
    }
}