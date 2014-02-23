<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

namespace Larium\Controller\Message;

use Larium\Http\RequestInterface;
use Larium\Controller\WebHandler;

class BeforeCommand extends Web
{
    protected $command;

    /**
     * __construct
     *
     * @param WebHandler $handler
     * @param RequestInterface $request
     * @param mixed $command
     * @access public
     * @return void
     */
    public function __construct(WebHandler $handler, RequestInterface $request, $command)
    {
        $this->setCommand($command);
        parent::__construct($handler, $request);
    }

    /**
     * Gets command.
     *
     * @access public
     * @return mixed
     */
    public function getCommand()
    {
        return $this->command;
    }

    /**
     * Sets command.
     *
     * @param mixed $command the value to set.
     * @access public
     * @return void
     */
    public function setCommand($command)
    {
        $this->command = $command;
    }
}
