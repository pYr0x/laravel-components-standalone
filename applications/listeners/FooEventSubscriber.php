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

class FooEventSubscriber
{

    public function handle($event) {
        // default callable
    }


    /**
     * Handle user login events.
     */
    public function handleUserLogin($event) {
        echo "here!";
    }

    /**
     * Handle user logout events.
     */
    public function handleUserLogout($event) {}

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            FooEvent::class,
            //'BarEventSubscriber@handleUserLogin'//'app\listeners\BarEventSubscriber@handleUserLogin'
            //[BarEventSubscriber::class, 'handleUserLogin']//'app\listeners\BarEventSubscriber@handleUserLogin'
            'app\listeners\FooEventSubscriber@handleUserLogin'
        );

        //$events->listen(
        //    'Illuminate\Auth\Events\Logout',
        //    'App\Listeners\UserEventSubscriber@handleUserLogout'
        //);
    }
}
