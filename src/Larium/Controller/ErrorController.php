<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

namespace Larium\Controller;

use Larium\Http\RequestInterface;
use Larium\Http\Response;
use Larium\Support\Logger;
use Larium\Exceptions\ErrorException;

class ErrorController extends ActionController
{
    public function errorAction(
        \Exception $exception,
        RequestInterface $request
    ) {
        /*
        $this->getView()
            ->assign('e', $exception)
            ->assign(
                'params', array_merge(
                    array(),
                    $request->getParams(),
                    $request->getPost(),
                    $request->getQuery()
                )
            ); 
         */
        Logger::getLogger()->log($exception->__toString());
        $r = new Response(ErrorException::stackTrace($exception));
        $r->sendError();
        return $r;
    } 
}
