<?php

namespace App\Http\Controllers\v1\Auth;

use App\Http\Controllers\Controller;
use App\Services\User\UserService;
use App\Http\Requests\ResetPasswordRequest;
use App\Responser\JsonResponser;
use Exception;

class ResetPasswordController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function reset(ResetPasswordRequest $request)
    {
        try {
            $response = $this->userService->resetPassword($request->validated());

            return JsonResponser::send(
                $response['error'] ?? false,
                $response['message'] ?? 'Password has been reset successfully.',
                $response['data'] ?? null,
                $response['status'] ?? 200
            );
        } catch (Exception $e) {
            return JsonResponser::send(
                true,
                'An unexpected error occurred while resetting your password.',
                null,
                500
            );
        }
    }
}
