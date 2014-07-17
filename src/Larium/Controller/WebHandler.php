<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

namespace Larium\Controller;

use Larium\Http\RequestInterface;
use Larium\Http\ResponseInterface;
use Larium\Http\Response;
use Larium\Executor\Executor;

class WebHandler
{
    protected $executor;

    const ON_REQUEST      = 'web.request';

    const BEFORE_COMMAND  = 'web.before_controller';

    const AFTER_COMMAND   = 'web.after_controller';

    const ON_EXCEPTION    = 'web.exception';

    const FINISH_RESPONSE = 'web.finish_response';

    public function __construct(Executor $executor)
    {
        $this->executor = $executor;
    }

    /**
     * Handles given request and returns as Response object.
     *
     * @param RequestInterface $request
     * @param Router $router
     * @access public
     * @return ResponseInterface
     */
    public function handle(RequestInterface $request, CommandResolverInterface $resolver)
    {

        try {
            $message = new Message\OnRequest($this, $request);
            $this->executor->execute(static::ON_REQUEST, $message);

            // We have an early response.
            if ($message->hasResponse()) {
                return $message->getResponse();
            }

            // Can we resolve a command to execute for the given Request?
            //$resolver = new CommandResolver($router);
            if (false === ($command = $resolver->getCommand($request))) {
                throw new \OutOfRangeException(sprintf('Unable to resolve path %s for execution', $request->getPath()), 404);
            }

            //
            $message = new Message\BeforeCommand($this, $request, $command);
            $this->executor->execute(static::BEFORE_COMMAND, $message);

            if (is_array($command) && $command[0] instanceof ActionController) {
                // Initialize command
                $response = $command[0]->init($request);

                if ($response instanceof ResponseInterface) {
                    return $response;
                }
            }

            // Execute Command
            $response = call_user_func_array($command, $resolver->getArgs());

            if (!$response instanceOf ResponseInterface) {
                // Look up for Response in AFTER_COMMAND events.
                $message = new Message\AfterCommand($this, $request, $response, $command);
                $this->executor->execute(static::AFTER_COMMAND, $message);

                $response = $message->getResponse();

                if (!$response instanceof ResponseInterface) {
                    throw new \LogicException('You must return a ResponseInterface!');
                }
            }

            return $this->finish_response($response, $request);

        } catch (\Exception $e) {

            return $this->handle_exception($e, $request);
        }
    }

    private function finish_response(ResponseInterface $response, RequestInterface $request)
    {
        $message = new Message\FinishResponseMessage($this, $request, $response);
        $this->executor->execute(static::FINISH_RESPONSE, $message);

        return $message->getResponse();
    }

    private function handle_exception(\Exception $e, $request)
    {
        $message = new Message\ExceptionMessage($this, $request, $e);
        $this->executor->execute(static::ON_EXCEPTION, $message);

        $e = $message->getException();

        if (!$message->hasResponse()) {

            throw $e;
        }

        $response = $message->getResponse();

        $response->setStatus($e->getCode() == 404 ? 404 : 500);

        return $this->finish_response($response, $request);

    }
}
