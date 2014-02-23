<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

namespace Larium\Controller\Message;

class FinishResponseMessage extends Web
{
    protected $response;

    public function __construct($handler, $request, $response)
    {
        $this->setResponse($response);

        parent::__construct($handler, $request);
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
