<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Throwable;

class Handler extends ExceptionHandler
{

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
        });

        $this->renderable(function (AuthenticationException $e, $request) {
            return response()->json(['message' => 'Not autenticated!.', 'error' => $e->getMessage()]);
        });

        $this->renderable(function (RouteNotFoundException $e) {
            return response()->json(['message' => 'Error!.', 'error' => $e->getMessage()]);
        });

        $this->renderable(function (NotFoundHttpException $e, $request) {
            return response()->json(['message' => 'Not found!.', 'error' => $e->getMessage()]);
        });

        $this->renderable(function (ValidationException $e, $request) {
            return new JsonResponse($e->errors(), 422);
        });

        $this->renderable(function (Exception $e, $request) {

            if (request()->wantsJson() || request()->isJson()) {

                $response = ['errors' => 'Sorry, something went wrong.'];

                if (config('app.debug')) {
                    $response['exception'] = get_class($e);
                    $response['message'] = $e->getMessage();
                    $response['trace'] = $e->getTrace();
                }

                $status = 500;
                return response()->json($response, $status);
            }
        });
    }
}
