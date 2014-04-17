<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

namespace Larium\Controller;

interface ContainerAwareInterface
{
    /**
     * Sets the container instance.
     *
     * @param mixed $container
     * @access public
     * @return void
     */
    public function setContainer($container);

    /**
     * Gets the container instance.
     *
     * @access public
     * @return mixed
     */
    public function getContainer();

}
