<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Session;
use Throwable;
use Illuminate\Database\Eloquent\MassAssignmentException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Validation\ValidationException;
use Psy\Exception\ErrorException;
use Psy\Exception\FatalErrorException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Database\QueryException;
use Illuminate\Contracts\Container\BindingResolutionException;

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
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if(explode( '/',$request->getPathInfo())[1] == 'api') {
            //dd($exception);
            if ($exception instanceof ModelNotFoundException) {
                $model = strtolower(class_basename($exception->getModel()));
                return response()->json([
                    'message' => "Does not exits any instance of {$model} with the given"
                ], 404);
            }
            if ($exception instanceof BindingResolutionException) {
                return response()->json([
                    'message' => $exception->getMessage()
                ], 404);
            }
            if ($exception instanceof AuthorizationException) {
                return response()->json([
                    'message' => $exception->getMessages()
                ], 403);
            }
            if ($exception instanceof AuthenticationException) {
                return response()->json([
                    'message' => "Please login again"
                ], 401);
            }
            if ($exception instanceof ValidationException) {
                return response()->json([
                    'message' => $exception->validator->errors()->getMessages()
                ], 414);
            }
            if ($exception instanceof MethodNotAllowedHttpException) {
                return response()->json([
                    'message' => "Method not allowed"
                ], 405);
            }
            if ($exception instanceof QueryException) {
                return response()->json([
                    'message' => $exception->getMessages()
                ], 400);
            }
           /* if ($exception instanceof TokenInvalidException) {
                return response()->json([
                    'message' => $exception->getMessages()
                ], 463);
                return $this->errorResponse("Token valid", 463);
            }*/
           /* if ($exception instanceof TokenExpiredException) {
                return response()->json([
                    'message' => $exception->getMessages()
                ], 403);
                return $this->errorResponse("Token expired", 406);
            }*/
           /* if ($exception instanceof JWTException) {
                return response()->json([
                    'message' => $exception->getMessages()
                ], 403);
                return $this->errorResponse($exception->getMessage(), 410);
            }*/
            if ($exception instanceof UnauthorizedHttpException) {
                return response()->json([
                    'message' => $exception->getMessages()
                ], 406);
            }
            if ($exception instanceof FatalErrorException) {
                return response()->json([
                    'message' => $exception->getMessages()
                ], 407);
            }
            if ($exception instanceof MassAssignmentException) {
                return response()->json([
                    'message' => $exception->getMessages()
                ], 408);
            }
            if ($exception instanceof ErrorException) {
                return response()->json([
                    'message' => $exception->getMessages()
                ], 409);
            }
           /* if ($exception instanceof InvalidArgumentException) {
                return response()->json([
                    'message' => $exception->getMessages()
                ], 411);
            }*/
            if ($exception instanceof NotFoundHttpException) {
                return response()->json([
                    'message' => "The API {$request->path()} can not be found"
                ], 404);
            }
            if (env('APP_DEBUG') == false) {
                return parent::render($request, $exception);
            }
            return response()->json([
                'message' => 'Unexpected error. Try later'
            ], 500);
        }else {
            return parent::render($request, $exception);
        }

    }

    public function unauthenticated($request, AuthenticationException $exception)
    {
        if($request->expectsJson()){
            return response()->json(['error' => 'unauthenticated'], 401);
        }
        foreach ($exception->guards() as $key => $guard){
            if($key==0){
                break;
            }
        }

        //$guard = array_pop($exception->guards());
        switch ($guard){
            case 'admin':
                Session::remove('redirectAfterLoginAdmin');
                Session::push('redirectAfterLoginAdmin', $request->getUri());
                $login= ADMIN_LOGIN;
                break;
            default:
                $login= 'login';
                break;
        }

        return redirect()->guest(route($login));
    }
}
