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


namespace app\listeners;


use app\events\FooEvent;

class BarListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param FooEvent $event
     *
     * @return void
     */
    public function handle(FooEvent $event)
    {
        echo $event->someMethod();
        // Access the order using $event->order...
    }

}
