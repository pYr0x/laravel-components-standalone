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

namespace twentytwo;

use Illuminate\Database\Capsule\Manager as Capsule;

class Database
{

    public function __construct($laravelDI) {
        $capsule = new Capsule($laravelDI);

        $capsule->addConnection([
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => 'triwala_tw_mdm',
            'username'  => 'root',
            'password'  => '',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ], "mdm");

        $capsule->addConnection([
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => 'triwala_tw_twu',
            'username'  => 'root',
            'password'  => '',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ], "twu");

        //$capsule->setAsGlobal();

        $capsule->bootEloquent();

        $db = $capsule->getDatabaseManager();

        //$foo = $db->connection('mdm')->table('wwanlage')->where('id', 0)->get();
        //$bar = $foo;
    }
}