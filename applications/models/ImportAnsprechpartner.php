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

class ImportAnsprechpartner extends BaseModel
{
    protected $connection = "mdm";
    protected $table = "import_ansprechpartner";

    protected $primaryKey = "import_ansprechpartner_id";

    public $timestamps = false;

    protected $guarded = [];

    public function warmwasseranlage() {
        return $this->belongsTo('app\model\ImportWarmwasseranlage', 'import_wwanlage_id');
    }
}