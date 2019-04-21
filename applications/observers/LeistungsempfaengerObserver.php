<?php
/**
 * creation date: 20.04.2019
 *
 * @author          Julian Kern
 * @copyright       Copyright (c) 2007-2019 Julian Kern, twentytwo Solutions (http://www.22-solutions.de)
 * All Rights Reserved
 *
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */


namespace app\observers;


use app\models\Leistungsempfaenger;

class LeistungsempfaengerObserver
{
    public function retrieved(Leistungsempfaenger $le) {
        print_r($le);
    }
}
