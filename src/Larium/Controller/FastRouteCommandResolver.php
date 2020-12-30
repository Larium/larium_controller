<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

namespace Larium\Controller;

use FastRoute\Dispatcher;

class FastRouteCommandResolver extends CommandResolverInterface
{
    protected $dispatcher;

    protected $container;

    protected $args = array();

    public function __construct(Dispatcher $dispatcher, $container = null)
    {
        $this->dispatcher = $dispatcher;
        $this->container = $container;
    }

    public function getCommand(RequestInterface $request)
    {
        $uri = $request->getPath().((null !== $request->getQueryString()) ? '?'.$request->getQueryString() : null);
        $routeInfo = $this->dispatcher->dispatch($request->getMethod(), $uri);

        switch ($routeInfo[0]) {
            case Dispatcher::NOT_FOUND:
                // ... 404 Not Found
                return false;
                break;
            case Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $routeInfo[1];
                // ... 405 Method Not Allowed
                return false;
                break;
            case Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $args = $routeInfo[2];

                if (is_callable($handler)) {

                    $function = new \ReflectionFunction($command);

                    $this->args = $this->get_arguments(
                        $request,
                        $function->getParameters(),
                        $args
                    );

                    return $handler;
                }

                if (is_string($handler)) {
                    list($controller, $action) = explode(':', $handler);

                    $instance = new $controller($this->container);

                    try {
                        $command = new \ReflectionMethod($instance, $action());
                    } catch(\ReflectionException $e) {
                        throw new \OutOfRangeException($e->getMessage(), 404, $e);
                    }

                    $this->args = $this->get_arguments(
                        $request,
                        $command->getParameters(),
                        $args
                    );

                    return [$instance, $action];
                }

                break;
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
