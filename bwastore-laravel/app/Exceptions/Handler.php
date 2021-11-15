<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    public function report(Throwable $exception)
    {
        if (app()->bound("sentry") && $this->shouldReport($exception)) {
            app("sentry")->captureException($exception);
        }

        parent::report($exception);
    }
    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        "current_password",
        "password",
        "password_confirmation",
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}