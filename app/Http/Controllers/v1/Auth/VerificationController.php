<?php

namespace App\Http\Controllers\v1\Auth;

use App\Http\Controllers\Controller;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function verify(Request $request, $id, $hash)
    {
        $response = $this->userService->verifyEmail($id, $hash);
        return view('verify-email', [
            'status' => $response['error'] ? 'error' : 'success',
            'message' => $response['error'] ?? $response['message'],
        ]);
    }
}
