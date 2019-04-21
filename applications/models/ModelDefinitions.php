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

use app\models\Entnahmestelle;
use app\models\Warmwasseranlage;

return [
    Warmwasseranlage::class => Warmwasseranlage::getDefinition(),
    Entnahmestelle::class => Entnahmestelle::getDefinition(),
];