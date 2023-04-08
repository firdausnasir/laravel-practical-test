<?php

namespace App\Exceptions;

use App\Helpers\ApiResponseHelper;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(function (Throwable $e, Request $request) {
            if ($request->wantsJson()) {
                if ($e instanceof NotFoundHttpException) {
                    return ApiResponseHelper::common(sprintf('%s not found', $this->prettyModelNotFound($e)), $e, 404);
                }

                return ApiResponseHelper::common('Something went wrong', $e);
            }
        });
    }

    private function prettyModelNotFound(NotFoundHttpException $exception): string
    {
        if ($exception->getPrevious() instanceof ModelNotFoundException && !is_null($exception->getPrevious()->getModel())) {
            $model = preg_replace('/[A-Z]/', ' $0', class_basename($exception->getPrevious()->getModel()));

            return Str::of($model)->ltrim()->ucfirst()->toString();
        }

        return 'resource';
    }
}
