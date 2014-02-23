<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

namespace Larium\Controller;

abstract class ActionController
{

    final public function __construct()
    {
        $this->init();
    }

    public function init()
    {

    }
}
