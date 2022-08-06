<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param \Exception $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {

        if ($this->isHttpException($exception)) {

            if ($exception instanceof HttpException && $exception->getStatusCode() == 403) {
                return new JsonResponse($exception->getMessage(), 403);
            }
            if ($exception->getStatusCode() == '404') {
                return \Response::view('website.page-404', array(), 404);
            }
        }
        if ($exception->getMessage()=="Trying to get property 'headers' of non-object" && $exception->getCode()==0 ) {
            return redirect()->back();
        }
        else {

            return parent::render($request, $exception);
        }
    }
}
