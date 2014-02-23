<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

namespace Larium\Controller;

use Larium\Route\RouteInterface;
use Larium\Http\RequestInterface;
use Larium\Http\ResponseInterface;

interface DispatcherInterface
{
    /**
     * 
     * @param  false|RouteInterface $route 
     * @param  RequestInterface $request 
     * @param  ResponseInterface $response 
     * @access public
     * @return void
     */
    public function dispatch(
        $route, 
        RequestInterface $request, 
        ResponseInterface $response
    );
        
}
