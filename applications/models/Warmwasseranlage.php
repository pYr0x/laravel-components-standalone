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
 * Class Warmwasseranlage
 * @package app\models
 */
class Warmwasseranlage extends BaseModel
{
    protected $connection = "mdm";
    protected $table = 'wwanlage';
    protected $primaryKey = "id";

    public $timestamps = false;

    protected $guarded = [];

    protected $routerKeyName = "wwa-id";


    public function entnahmestellen() {
        return $this->hasMany('app\models\Entnahmestelle', 'wwanlage_id');
    }

    public function leistungsempfaenger() {
        return $this->belongsTo('app\models\Leistungsempfaenger', 'leistungsempfaenger_id');
    }


    /**
     * foo
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNotDeleted($query) {
        return $query->where('deleted', 0);
    }

    /**
     * scopeNotDisabled
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNotDisabled($query) {
        return $query->where('disabled', 0);
    }

    /**
     * scopeActive
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query) {
        return $query->notDeleted()->notDisabled();
    }
}