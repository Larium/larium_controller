<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

namespace Larium\Controller;

interface ControllerInterface
{
    const CONTROLLER_SUFFIX = 'Controller';
    const ACTION_SUFFIX     = 'Action';

    /**
     * @return Larium\View\ViewInterface
     */
    public function getView();

    /**
     * @return Larium\Http\RequestInterface
     */
    public function getRequest();

    /**
     * @return Larium\Http\ResponseInterface
     */
    public function getResponse();

    public function redirect($location);

    public function forward($controller, $action = null);
}

