<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

namespace Larium\Controller;

use Larium\Http\RequestInterface;

abstract class ActionController implements ContainerAwareInterface
{
    protected $container;

    final public function __construct()
    {
    }

    public function init(RequestInterface $request)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * {@inheritdoc}
     */
    public function setContainer($container)
    {
        $this->container = $container;
    }
}
