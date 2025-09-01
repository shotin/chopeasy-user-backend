<?php

namespace App\Responser;

use App\Models\ErrorLog;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class JsonResponser
{
    /**
     * Return a new JSON response with paginated data
     *
     * @param int $status
     * @param StaffStrength\ApiMgt\Http\Collections\ApiPaginatedCollection $data
     * @param string|null $message
     * @return Illuminate\Http\JsonResponse
     */
    public static function sendPaginated(
        int $status,
        $data = [],
        string $message = ""
    ): JsonResponse {
        $data = $data->toArray();
        $response = [
            'status' => $status,
            'data' => $data['data'],
            'meta' => $data['meta'],
            "message" => ucwords($message),
        ];
        return response()->json($response, $status);
    }

    /**
     * Return a new JSON response
     *
     * @param bool $error
     * @param string $message
     * @param mixed $data
     * @param int $statusCode
     * @param \Throwable|null $th
     * @return Illuminate\Http\JsonResponse
     */
    public static function send(
        bool $error = true,
        string $message = "",
        $data = [],
        int $statusCode = 200,
        ?\Throwable $th = null
    ): JsonResponse {
        if ($th && $statusCode === 500) {
            ErrorLog::create([
                'causer' => optional(auth()->user())->id ?? 'Guest',
                'model' => get_class($th),
                'error_message' => $th->getMessage(),
                'error_line' => is_numeric($th->getLine()) ? $th->getLine() : null,
                'error_trace' => $th->getTraceAsString(),
                'request_url' => request()->fullUrl() ?? 'N/A',
                'request_method' => request()->method() ?? 'N/A',
                'request_data' => !empty(request()->except(['password', 'password_confirmation', 'new_password']))
                    ? json_encode(request()->except(['password', 'password_confirmation', 'new_password']))
                    : null,
                'request_ip' => request()->ip() ?? 'N/A',
                'user_agent' => request()->header('User-Agent') ?? 'N/A',
            ]);
        }

        $response = [
            "error" => $error,
            "message" => $error ? $message : ucwords($message),
            "data" => $data,
        ];

        // Include exception details if available
        if ($th) {
            $response['exception'] = [
                'message' => $th->getMessage(),
                'line' => $th->getLine(),
                // 'trace' => $th->getTrace(),
            ];
        }

        return response()->json($response, $statusCode);
    }


    /**
     * Log an error with extra context and return a formatted JSON response.
     *
     * @param string $message The error message to display to the user.
     * @param int $statusCode HTTP status code for the response.
     * @param string $logLevel The log level (e.g., 'error', 'warning', 'info').
     * @param array $context Additional context to log (not included in the user response).
     * @return \Illuminate\Http\JsonResponse
     */
    public static function errorWithLog($message, $statusCode = 400, $logLevel = 'error', $exception = null, array $context = [])
    {
        //Laravel log levels
        //Log::emergency('Database connection failed. Application is down!'); //Database server is down., The application cannot load critical configuration files.
        //Log::alert('Payment gateway API credentials are missing!'); //Payment gateway credentials have been invalidated., An external service (like an API) is unavailable.
        //Log::critical('Queue worker process failed to start!'); //Application services (e.g., queue workers) fail unexpectedly., Disk space is about to run out.
        //Log::error('User registration failed due to missing required fields.'); //A specific user request fails (e.g., a missing resource)., Validation errors during a critical operation.
        //Log::warning('The application is using a deprecated API endpoint.'); A configuration is missing but has a fallback., Deprecated APIs being used.
        //Log::notice('User logged in with a new device.'); A user successfully logged in after a password reset., System resources are nearing a threshold.
        //Log::info('Weekly backup completed successfully.'); Record when an automated process starts and ends., Details about routine tasks like file uploads.
        //Log::debug('Query executed: SELECT * FROM users WHERE id = 1'); //Query logs or detailed information during testing., Verbose output about application states.


        // Log error with specified log level
        Log::$logLevel($message, [
            'status_code' => $statusCode,
            'exception' => $exception ? [
                'message' => $exception->getMessage(),
                'line' => $exception->getLine(),
                'trace' => $exception->getTraceAsString(),
            ] : null,
            'context' => $context ?? []
        ]);

        // Log details to the database (always, regardless of exception presence)
        ErrorLog::create([
            'causer' => optional(auth()->user())->id ?? 'Guest',
            'model' => $exception ? get_class($exception) : 'N/A',
            'error_message' => $exception ? $exception->getMessage() : $message,
            'error_line' => $exception ? $exception->getLine() : 'N/A',
            'error_trace' => $exception ? $exception->getTraceAsString() : 'N/A',
            'request_url' => request()->fullUrl() ?? 'N/A',
            'request_method' => request()->method() ?? 'N/A',
            'request_data' => !empty(request()->all()) ? json_encode(request()->all()) : null,
            'request_ip' => request()->ip() ?? 'N/A',
            'user_agent' => request()->header('User-Agent') ?? 'N/A',
            'context' => json_encode($context ?? [])
        ]);

        // If the status code is 500, log the details to the database
        // if ($exception && $statusCode === 500) {
        //     ErrorLog::create([
        //         'causer' => optional(auth()->user())->id ?? 'Guest',
        //         'model' => $exception ? get_class($exception) : null,
        //         'error_message' => $exception->getMessage(),
        //         'error_line' => $exception->getLine(),
        //         'error_trace' => $exception->getTraceAsString(),
        //         'request_url' => request()->fullUrl() ?? 'N/A',
        //         'request_method' => request()->method() ?? 'N/A',
        //         'request_data' => !empty(request()->all()) ? json_encode(request()->all()) : null,
        //         'request_ip' => request()->ip() ?? 'N/A',
        //         'user_agent' => request()->header('User-Agent') ?? 'N/A',
        //         'context' => $context ?? []
        //     ]);
        // }

        return self::error($message, $statusCode);
    }

    /**
     * Handle error without logging.
     *
     * @param string $message
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    public static function error($message, $statusCode = 400)
    {
        return response()->json([
            'error' => true,
            'message' => $message,
            'data' => null,
        ], $statusCode);
    }
}
