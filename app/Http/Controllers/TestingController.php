<?php

namespace App\Http\Controllers;
use App\Models\Testing;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
class TestingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * Apply the middleware `auth:user_model` to every route in this controller.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:user_model');
    }

    public function getData()
    {
    /**
     * Get all data from Testing table
     *
     * @return \Illuminate\Http\JsonResponse
     */
        try {
            $data = Testing::get();
            return response()->json($data);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Could not get data'], 500);
        }
    }

    //Fungsi untuk mengambil data berdasarkan ID
    public function getDataId($id)
    {
        $data = Testing::where('id', $id)->first();
        return response()->json($data);
    }
}
