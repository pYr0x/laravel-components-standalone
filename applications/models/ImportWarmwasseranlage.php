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

class ImportWarmwasseranlage extends BaseModel
{
    protected $connection = "mdm";
    protected $table = 'import_wwanlagen';

    protected $primaryKey = "import_wwanlage_id";

    public $timestamps = false;

    protected $guarded = ['created'];

    public function warmwasseranlage() {
        return $this->hasOne('app\model\Warmwasseranlage', 'wwanlage_id');
    }

    public function leistungsempfaenger() {
        return $this->belongsTo('app\models\Leistungsempfaenger', 'leistungsempfaenger_id');
    }

    public function entnahmestellen() {
        return $this->hasMany('app\models\ImportEntnahmestelle', 'import_wwanlage_id');
    }

    //public function mieter() {
    //    //return $this->hasManyThrough('')
    //        return $this->hasManyThrough(
    //            'app\models\ImportMieter',
    //            'app\models\ImportEntnahmestelle',
    //            'import_wwentnahmestelle_id',
    //            'import_entnahmestelle_id',
    //            'import_mieter_id',
    //            'import_wwentnahmestelle_id'
    //        );
    //}
}