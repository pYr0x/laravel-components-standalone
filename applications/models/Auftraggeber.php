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

class Auftraggeber extends BaseModel
{
    protected $connection = "mdm";
    protected $table = 'auftraggeber';
    protected $primaryKey = "id";

    public $timestamps = false;

    protected $guarded = [];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'retrieved' => \app\listeners\AuftraggeberRetrieved::class,
    ];

    /**
     * leistungsempfaenger
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function leistungsempfaenger() {
        return $this->hasMany('app\models\Leistungsempfaenger', 'auftraggeber_id');
    }

    /**
     * warmwasseranlagen
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function warmwasseranlagen() {
        return $this->hasManyThrough(
            'app\models\Warmwasseranlage',
            'app\models\Leistungsempfaenger',
            'auftraggeber_id',
            'leistungsempfaenger_id',
            'id',
            'id'
        );
    }
}
