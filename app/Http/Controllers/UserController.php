<?php

namespace App\Http\Controllers;
use App\Models\Testing;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
    public function getTicket()
    {
        $user = UserModel::get();
        $response = [
            'status' => true,
            'data' => $user,
            'message' => 'Success'
        ];

        return Response::json($response);
    }
}
