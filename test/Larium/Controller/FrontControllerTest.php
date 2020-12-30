<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

namespace Larium\Controller;

use Larium\Http\Request;
use Larium\Http\Response;
use Larium\Route\Router;
use Larium\Executor\Executor;

class FrontControllerTest extends \PHPUnit_Framework_TestCase
{

    public function testWebHandler()
    {
        $executor = new Executor();
        $web = new WebHandler($executor);

        $router = new Router();
        $resolver = new CommandResolver($router);

        $response = $web->handle($this->getRequest(), $resolver)->send();

        $this->assertEquals(2, $response);
    }

    public function testFastRouteCommandResolver()
    {
        $dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
            $r->addRoute('GET', '/artist/show/{id:[0-9]+}', 'ArtistController:show');
        });
    }

    private function getRequest()
    {
        $server = array(
            'HTTP_HOST' => 'demo.local',
            'SERVER_ADDR' => '127.0.0.1',
            'SERVER_PORT' => 80,
            'REMOTE_ADDR' => '127.0.0.1',
            'DOCUMENT_ROOT' => '/srv/http/test',
            'SCRIPT_FILENAME' => '/srv/http/test/index.php',
            'REDIRECT_QUERY_STRING' => 'page=1&test=2',
            'GATEWAY_INTERFACE' => 'CGI/1.1',
            'SERVER_PROTOCOL' => 'HTTP/1.1',
            'REQUEST_METHOD' => 'GET',
            'QUERY_STRING' => 'page=1&test=2',
            'REQUEST_URI' => '/artist/show/id/1?page=1&test=2',
            'SCRIPT_NAME' => '/index.php',
            'PHP_SELF' => '/index.php'
        );

        return new Request(null, array(), array(), array(), array(), $server);
    }
}
