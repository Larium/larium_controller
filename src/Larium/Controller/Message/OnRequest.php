<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

namespace Larium\Controller\Message;

use Larium\Http\ResponseInterface;

class OnRequest extends Web
{

    protected $response;

    /**
     * Gets response.
     *
     * @access public
     * @return ResponseInterface
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Sets response.
     *
     * @param ResponseInterface $response the value to set.
     * @access public
     * @return void
     */
    public function setResponse(ResponseInterface $response)
    {
        $this->response = $response;
    }

    /**
     * Checks if a Response objects exists in this Message
     *
     * @access public
     * @return boolean
     */
    public function hasResponse()
    {
        return null !== $this->response;
    }
}
