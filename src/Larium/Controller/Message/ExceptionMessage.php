<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

namespace Larium\Controller\Message;

class ExceptionMessage extends Web
{
    protected $exception;

    protected $response;

    public function __construct($handler, $request, $exception)
    {
        $this->setException($exception);

        parent::__construct($handler, $request);
    }

    /**
     * Gets exception.
     *
     * @access public
     * @return mixed
     */
    public function getException()
    {
        return $this->exception;
    }

    /**
     * Sets exception.
     *
     * @param mixed $exception the value to set.
     * @access public
     * @return void
     */
    public function setException($exception)
    {
        $this->exception = $exception;
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

    public function hasResponse()
    {
        return null !== $this->response;
    }
}
