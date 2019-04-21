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

use Acclimate\Container\CompositeContainer;
use Acclimate\Container\ContainerAcclimator;
use app\events\FooEvent;
use app\facades\AliasLoader;
use app\facades\SomeServiceFacade;
use app\listeners\FooEventSubscriber;
use app\listeners\BarListener;
use app\models\Auftraggeber;
use app\models\Entnahmestelle;
use app\models\ImportEntnahmestelle;
use app\models\ImportWarmwasseranlage;
use app\models\Leistungsempfaenger;
use app\models\Warmwasseranlage;
use app\observers\LeistungsempfaengerObserver;
use DI\ContainerBuilder;
use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Facade;
use Psr\Container\ContainerInterface;
use twentytwo\BaseModel;
use twentytwo\Database;

require "vendor/autoload.php";

$laravelDI = new Container();
$dispatcher = new Dispatcher($laravelDI);
$capsule = new Capsule($laravelDI);
$capsule->setEventDispatcher($dispatcher);


$phpDI = new DI\Container();


$acclimator = new ContainerAcclimator;
$laravelDIContainer = $acclimator->acclimate($laravelDI);

$container = new CompositeContainer();


// Configure PHP-DI container
$builder = new ContainerBuilder();
$builder->wrapContainer($container);
$builder->useAnnotations(true);
$builder->useAutowiring(true);


$builder->addDefinitions([
    'Database' => function(ContainerInterface $c) use ($capsule) {
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

        $db->connection('mdm')->enableQueryLog();
        $db->connection('twu')->enableQueryLog();

        return $db;
    },
    //Model::class => DI\autowire()->property('resolver', DI\get('Database')),

        //function(ContainerInterface $c) use ($laravelDI) {
        //$foo = "bar";
    //}

]);

$builder->addDefinitions(__DIR__.DIRECTORY_SEPARATOR.'applications'.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR.'ModelDefinitions.php');

// Add PHP-DI container
$phpDIContainer = $builder->build();



$container->addContainer($laravelDIContainer);
$container->addContainer($phpDIContainer);



$db = $phpDIContainer->make("Database");





/** FACADES */
//https://www.sitepoint.com/how-laravel-facades-work-and-how-to-use-them-elsewhere/
$aliases = [
    'FancyName' => SomeServiceFacade::class,
];
Facade::setFacadeApplication($container);
AliasLoader::getInstance($aliases)->register();




/** CUSTOM EVENTS */
$events = [
    FooEvent::class => [
        BarListener::class
    ]
];

$subscribe = [
    FooEventSubscriber::class,
];

foreach ($events as $event => $listeners) {
    foreach (array_unique($listeners) as $listener) {
        $dispatcher->listen($event, $listener);
    }
}
foreach ($subscribe as $subscriber) {
    $dispatcher->subscribe($subscriber);
}

/** MODEL EVENTS */
Leistungsempfaenger::observe(LeistungsempfaengerObserver::class);



/** @var DatabaseManager $db */
//$l = $container->get(Warmwasseranlage::class);
//
//if($l){
//    echo $l->id;
//}

//$b = $l->load('entnahmestellen:id');

//$c = $b;





//$wwa = $db->connection('mdm')->select("select * from wwanlage where id = ?", [0]);
//$wwa = $db->connection('mdm')->table('wwanlage')->find(0);

//$container->set('foo', "bar");

//
//
//$config = $container->get('config');

//$wwas = Warmwasseranlage::findOrFail(23523);





//$wwa = new Warmwasseranlage (['ref_id' => 1]);
//$wwa->save();





//$wwa = Warmwasseranlage::find('17378');
//
//foreach ($wwa->entnahmestellen()->get() as $entnahmestelle) {
//    $foo = $entnahmestelle;
//}


//$wwa = Warmwasseranlage::with('entnahmestellen:id')->find(17378);
//$foo = $wwa->entnahmestellen;
//$bar = $foo[0];
//
//echo $bar;



//$wwe = Entnahmestelle::find(108591);
//
//$foo = $wwe->warmwasseranlage->id;
//$bar = $foo->id;



//$wwe = Entnahmestelle::with('warmwasseranlage:id')->find(108591);


//$wwe = Entnahmestelle::find(108591);
//$wwe->load('warmwasseranlage:id');
//
//$foo = $wwe->warmwasseranlage->id;
//echo $foo;


//$ag = Auftraggeber::with('leistungsempfaenger:id,auftraggeber_id')->find(18);
//$ag = Entnahmestelle::with('mieter')->find(500242);

//$ag = Auftraggeber::find(18);
//print_r($ag);



$le = Leistungsempfaenger::find(2);


//$queries = $db->connection('mdm')->getQueryLog();
// ein nutzer kann mehere entnahmestellen haben
// eine entnahmestelle kann ein nutzer haben.



//$dispatcher->listen([FooEvent::class], BarListener::class);
//$dispatcher->subscribe(FooEventSubscriber::class);
// Firing the event
$dispatcher->fire(new FooEvent("foo"));






$foo = "bar";


