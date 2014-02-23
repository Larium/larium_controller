<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

//Dependecy
require_once 'larium_routing/autoload.php';
require_once 'larium_executor/autoload.php';

require_once 'ClassMap.php';

$classes = array(
    'Larium\\Controller\\Message\\Web' => 'Larium/Controller/Message/Web.php',
    'Larium\\Controller\\Message\\OnRequest' => 'Larium/Controller/Message/OnRequest.php',
    'Larium\\Controller\\Message\\BeforeCommand' => 'Larium/Controller/Message/BeforeCommand.php',
    'Larium\\Controller\\Message\\AfterCommand' => 'Larium/Controller/Message/AfterCommand.php',
    'Larium\\Controller\\Message\\ExceptionMessage' => 'Larium/Controller/Message/ExceptionMessage.php',
    'Larium\\Controller\\Message\\FinishResponseMessage' => 'Larium/Controller/Message/FinishResponseMessage.php',
    'Larium\\Controller\\WebHandler' => 'Larium/Controller/WebHandler.php',
    'Larium\\Controller\\ControllerInterface' => 'Larium/Controller/ControllerInterface.php',
    'Larium\\Controller\\DispatcherInterface' => 'Larium/Controller/DispatcherInterface.php',
    'Larium\\Controller\\CommandResolver' => 'Larium/Controller/CommandResolver.php',
    'Larium\\Controller\\error\\error.phtml' => 'Larium/Controller/error/error.phtml',
    'Larium\\Controller\\FrontController' => 'Larium/Controller/FrontController.php',
    'Larium\\Controller\\Dispatcher' => 'Larium/Controller/Dispatcher.php',
    'Larium\\Controller\\CommandResolverInterface' => 'Larium/Controller/CommandResolverInterface.php',
    'Larium\\Controller\\ActionController' => 'Larium/Controller/ActionController.php',
    'Larium\\Controller\\ErrorController' => 'Larium/Controller/ErrorController.php',
);

ClassMap::load(__DIR__ . "/src/", $classes)->register();
