<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

namespace Larium\Controller;

use Larium\Route\RouteInterface;
use Larium\Http\RequestInterface;
use Larium\Http\ResponseInterface;

class Dispatcher implements DispatcherInterface
{
    /**
     * Dispatches a request instance.
     *
     * @param mixed             $route
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @access public
     * @return string
     */
    public function dispatch(
        $route,
        RequestInterface $request,
        ResponseInterface $response
    ) {

        if ($route instanceof RouteInterface) {

            $params = $route->getParams();

            if ($command = $route->getCallableFunction()) {

                $function = new \ReflectionFunction($command);

                $args = $this->get_arguments(
                    $request,
                    $function->getParameters(),
                    $params
                );

                $invoke = $function->invokeArgs($args);

            } else {

                list($controller, $command) = $this->getCommand($route, $request, $response);

                $args = $this->get_arguments(
                    $request,
                    $command->getParameters(),
                    $params
                );

                $invoke = $command->invokeArgs($controller, $args);
            }

            if (null === $invoke) {
                //throw excpetion
            } elseif ( $invoke instanceof ResponseInterface) {

                echo $invoke->send();

            } elseif (is_string($invoke)) {

                echo $response->setBody($invoke)->send();

            } else {

                echo $resonse()->send();
            }
        } else {

            if (false === $route) {

            } else {

            }
        }
    }

    /**
     * Gets the contoller and command action to execute.
     *
     * @param RouteInterface $route
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @access public
     * @return array An array with controller instance and command action.
     */
    public function getCommand(
        RouteInterface $route,
        RequestInterface $request,
        ResponseInterface $response
    ) {
        $controller_class = $route->getController().'Controller';

        $controller = new $controller_class($request, $response);

        try {

            $command = new \ReflectionMethod($controller, $route->getAction());

        } catch(\ReflectionException $e) {

            throw new \OutOfRangeException($e->getMessage(), 404, $e);
        }

        return array($controller, $command);
    }

    private function get_arguments(RequestInterface $request, array $attrs_want, array $params)
    {
        $args = array();
        foreach($attrs_want as $attr) {
            if (array_key_exists($attr->name, $params)) {
                $args[] = $params[$attr->name];
            } elseif ($attr->getClass() && $attr->getClass()->getName() == get_class($request)) {
                $args[] = $request;
            }
        }

        return $args;
    }
}
