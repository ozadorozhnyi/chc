<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Response;
use Throwable;

class Handler extends ExceptionHandler
{
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
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(function (LanguageNotSupportedException $e, $request) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error' => [
                        'title' => __('api.language_not_supported_exception.title'),
                        'message' => __('api.language_not_supported_exception.message', [
                            'language' => $e->getMessage()
                        ]),
                        'resource' => $request->path(),
                    ],
                ], Response::HTTP_FORBIDDEN);
            }
        });

        $this->renderable(function (ValidationException $e, $request) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error' => [
                        'code' => Response::HTTP_UNPROCESSABLE_ENTITY,
                        'title' => __('api.validation_exception_title'),
                        'message' => $e->getMessage(),
                        'errors' => $e->errors(),
                    ],
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            }
        });

        $this->renderable(function (ResourceCreationFailedException $e, $request) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error' => [
                        'title' => __('api.resource_creation_failed.title'),
                        'message' => __('api.resource_creation_failed.message'),
                        'resource' => $request->path(),
                    ],
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        });

        $this->renderable(function (NotFoundHttpException $e, $request) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error' => [
                        'title' => __('api.not_found_http_exception.title'),
                        'message' => __('api.not_found_http_exception.message'),
                        'resource' => $request->path(),
                    ],
                ], Response::HTTP_NOT_FOUND);
            }
        });
    }
}
