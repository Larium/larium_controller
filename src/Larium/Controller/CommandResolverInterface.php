<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

namespace Larium\Controller;

use Larium\Http\RequestInterface;

interface CommandResolverInterface
{
    /**
     * Gets a callable to execute
     *
     * @param RequestInterace $request
     * @access public
     * @return A PHP callable. [Closure or array(class, method)]
     */
    public function getCommand(RequestInterface $request);

    /**
     * Gets arguments to use for executing the getCommand callable
     *
     * @access public
     * @return array
     */
    public function getArgs();
}
