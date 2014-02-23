<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

namespace Larium\Controller\Message;

use Larium\Executor\Message;
use Larium\Http\RequestInterface;
use Larium\Controller\WebHandler;

class Web extends Message
{
    protected $request;

    protected $web_handler;

    /**
     * __construct
     *
     * @param WebHandler $handler
     * @param RequestInterface $request
     * @access public
     * @return Message
     */
    public function __construct(WebHandler $handler, RequestInterface $request)
    {
        $this->setWebHandler($handler);
        $this->setRequest($request);
    }

    /**
     * Gets request.
     *
     * @access public
     * @return mixed
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Sets request.
     *
     * @param mixed $request the value to set.
     * @access public
     * @return void
     */
    public function setRequest(RequestInterface $request)
    {
        $this->request = $request;
    }

    /**
     * Gets web_handler.
     *
     * @access public
     * @return WebHandler
     */
    public function getWebHandler()
    {
        return $this->web_handler;
    }

    /**
     * Sets web_handler.
     *
     * @param mixed $web_handler the value to set.
     * @access public
     * @return void
     */
    public function setWebHandler(WebHandler $web_handler)
    {
        $this->web_handler = $web_handler;
    }
}
