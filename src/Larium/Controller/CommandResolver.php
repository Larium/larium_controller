<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

namespace Larium\Controller;

use Larium\Route\Router;
use Larium\Route\RouteInterface;
use Larium\Http\RequestInterface;

class CommandResolver implements CommandResolverInterface
{

    protected $router;

    protected $args = array();

    public function __construct(Router $router)
    {
        $this->setRouter($router);
    }

    public function setRouter(Router $router)
    {
        $this->router = $router;
    }

    public function getRouter()
    {
        return $this->router;
    }

    /**
     * Gets the contoller and command action to execute.
     *
     * @param RequestInterface $request
     * @access public
     * @return array A callbale array with controller instance and command action.
     */
    public function getCommand(RequestInterface $request)
    {
        $route = $this->router->route($request);

        if ($route instanceOf RouteInterface) {

            $params = $route->getParams();

            if ($command = $route->getCallableFunction()) {

                $function = new \ReflectionFunction($command);

                $this->args = $this->get_arguments(
                    $request,
                    $function->getParameters(),
                    $params
                );

                return $function;
            } else {

                $controller_class = $route->getController().'Controller';

                if (!class_exists($controller_class)) {
                    throw new \RuntimeException(sprintf('Class \'%s\' not found', $controller_class), 404);
                }

                $controller = new $controller_class();

                try {
                    $command = new \ReflectionMethod($controller, $route->getAction());
                } catch(\ReflectionException $e) {
                    throw new \OutOfRangeException($e->getMessage(), 404, $e);
                }

                $this->args = $this->get_arguments(
                    $request,
                    $command->getParameters(),
                    $params
                );

                return array($controller, $command->getName());
            }
        } else {

            if (false === $route) {

                return false;
            } else {

            }
        }
    }

    public function getArgs()
    {
        return $this->args;
    }

    private function get_arguments(RequestInterface $request, array $attrs_want, array $params)
    {
        $args = array();
        foreach($attrs_want as $attr) {
            if (array_key_exists($attr->name, $params)) {
                $args[] = $params[$attr->name];
            } elseif ($attr->getClass()
                && $attr->getClass()->isInstance($request)
            ) {
                $args[] = $request;
            }
        }

        return $args;
    }
}
