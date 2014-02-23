<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

namespace Larium\Controller;

use Larium\Http\RequestInterface;
use Larium\Http\ResponseInterface;
use Larium\Route\RouterInterface;

class FrontController
{
    /**
     * The Router instance to handle Routes.
     *
     * @var    Larium\Route\RouterInterface
     * @access protected
     */
    protected $router;

    protected $dispatcher;

    public function __construct(
        DispatcherInterface $dispatcher,
        RouterInterface $router
    ) {
        $this->dispatcher = $dispatcher;
        $this->router = $router;
    }

    public function process(
        RequestInterface $request,
        ResponseInterface $response
    ) {
        $route = $this->router->route($request, $response);

        $this->dispatcher->dispatch($route, $request, $response);

    }
}
