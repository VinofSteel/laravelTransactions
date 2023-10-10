<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler {
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
    public function register(): void {
        $this->reportable(function (Throwable $error) {
            //
        });
    }

    public function render($request, Throwable $error) {
        $statusCodeToReturnForAppError = $error->getCode() ? $error->getCode() : 500;

        if ($error instanceof ValidationException) {
            return response()->json([
                'errors' => $error->validator->errors()
            ], 422);
        }

        if ($error instanceof AppError) {
            return response()->json([
                'errors' => $error->getMessage()
            ], $statusCodeToReturnForAppError);
        }

        return response()->json([
            'message' => 'Erro interno do servidor'
        ], 500);
    }
}
