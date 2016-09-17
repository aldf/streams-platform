<?php namespace Anomaly\Streams\Platform\Exception;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\Debug\ExceptionHandler as SymfonyDisplayer;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ExceptionHandler extends \Illuminate\Foundation\Exceptions\Handler
{

    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        HttpException::class,
    ];

    /**
     * Render an exception into an HTTP response.
     *
     * @param  Request   $request
     * @param  Exception $e
     * @return Response
     */
    public function render($request, Exception $e)
    {
        if ($e instanceof HttpException) {
            if (!$e->getStatusCode() == 404) {
                return $this->renderHttpException($e);
            }

            if (($redirect = config('streams::404.redirect')) && $request->path() !== $redirect) {
                return redirect($redirect, 301);
            }

            return $this->renderHttpException($e);
        } elseif (!config('app.debug')) {
            return response()->view("streams::errors.500", ['message' => $e->getMessage()], 500);
        } else {
            return parent::render($request, $e);
        }
    }

    /**
     * Render the given HttpException.
     *
     * @param  \Symfony\Component\HttpKernel\Exception\HttpException $e
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function renderHttpException(HttpException $e)
    {
        $status = $e->getStatusCode();

        if (!config('app.debug') && view()->exists("streams::errors.{$status}")) {
            return response()->view("streams::errors.{$status}", ['message' => $e->getMessage()], $status);
        } else {
            return (new SymfonyDisplayer(config('app.debug')))->handle($e);
        }
    }
}
