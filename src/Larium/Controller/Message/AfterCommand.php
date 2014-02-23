<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

namespace Larium\Controller\Message;

use Larium\Http\RequestInterface;
use Larium\Controller\WebHandler;

class AfterCommand extends Web
{
    protected $response;

    protected $command;

    public function __construct(WebHandler $handler, RequestInterface $request, $response, $command)
    {
        $this->response = $response;

        $this->command = $command;

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
     * Gets response.
     *
     * @access public
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Sets response.
     *
     * @param mixed $response the value to set.
     * @access public
     * @return void
     */
    public function setResponse($response)
    {
        $this->response = $response;
    }
}
