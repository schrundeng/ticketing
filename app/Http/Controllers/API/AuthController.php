<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\UserModel;
use App\Models\pengelolaModel;
// use App\Http\Controllers\absenModel;
use App\Http\Controllers\Controller;
use App\Models\absenModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    //Login Function
    public function loginUser(Request $request)
    {
        // Get the name and password from the request
        $credentials = $request->only('id_user', 'password');

        try {
            // Attempt to authenticate the user using the default guard
            if (!$token = Auth::guard('user_model')->attempt($credentials)) {
                // If the authentication is not successful, return a 401 response
                // with an error message
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        } catch (JWTException $e) {
            // If there is an error when creating the token, return a 500 response
            // with an error message
            return response()->json(['error' => 'Could not create token'], 500);
        } 

        // If the authentication is successful, return a response with the token
        return response()->json(compact('token'));
    }

    public function loginPengelola(Request $request)
    {
        // Get the name and password from the request
        $credentials = $request->only('id_pengelola', 'password');

        // Delete any previous login records based on id_pengelola
        $absenDelete = absenModel::where('id_pengelola', $credentials['id_pengelola'])->delete();

        // Make a new login record consisted of id_pengelola, login_date, and status. Status 1 means logged in.
        $absenCreate = absenModel::create([
            'id_pengelola' => $credentials['id_pengelola'],
            'login_date' => now(),
            'status' => 1,
        ]);

        try {
            // Attempt to authenticate the user using the default guard
            if (!$token = Auth::guard('pengelola_model')->attempt($credentials)) {
                // If the authentication is not successful, return a 401 response
                // with an error message
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        } catch (JWTException $e) {
            // If there is an error when creating the token, return a 500 response
            // with an error message
            return response()->json(['error' => 'Could not create token'], 500);
            

        }

        // If the authentication is successful, return a response with the token
        return response()->json(compact('token'));
    }

    /**
     * To return user data
     */
    public function me()
    {
        return response()->json(Auth::user());
    }

    /**
     * To logout user
     */
    public function logoutUser()
    {
        try {
            // Get the current authenticated user token to invalidate to prevent further uses after logout.
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json([
                'message' => 'Successfully logged out',
            ]);
        } catch (JWTException $e) {
            // Catch any errors during token invalidation process
            return response()->json(['error' => 'Failed to logout, please try again'], 500);
        }

    }

    public function logoutPengelola()
    {
        try {
            // Get the authenticated user
            $user = Auth::guard('pengelola_model')->user();

            if (!$user) {
                return response()->json(['error' => 'User not authenticated'], 401);
            }

            // Update the logout date for the current user's record in the absenModel
            $absenUpdate = absenModel::where('id_pengelola', $user->username);

            if ($absenUpdate) {
                $absenUpdate->update([
                    'logout_date' => now(),
                    'status' => 0,
                ]);
            } else {
                return response()->json(['error' => 'No login record found'], 404);
            }

            // Invalidate the token to log the user out
            JWTAuth::invalidate(JWTAuth::getToken());

            return response()->json([
                'message' => 'Successfully logged out',
            ]);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Failed to logout, please try again'], 500);
        }
    }

    /**
     * To refresh token
     */
    public function refreshUser()
    {
        try {
            //Gets current authenticated token to use to regenerate a new token for user_model to use
            $newToken = JWTAuth::refresh(JWTAuth::getToken(), config('jwt.provider.user_model'));
            return response()->json(['token' => $newToken]);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Failed to refresh token, please try again'], 500);
        }
    }

    public function refreshPengelola()
    {
        try {
            //Gets current authenticated token to use to regenerate a new token for user_model to use
            $newToken = JWTAuth::refresh(JWTAuth::getToken(), config('jwt.provider.user_model'));
            return response()->json(['token' => $newToken]);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Failed to refresh token, please try again'], 500);
        }
    }

    /**
     * To register a user
     */

    public function registerUser(Request $request)
    {
        // Validate data to make sure it's correctly inputted
        $request->validate([
            'id_user' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6',
        ]);

        // Create a new user in the database
        $user = UserModel::create([
            'id_user' => $request->id_user,
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->id_user,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => 'User created successfully',
            'user' => $user
        ]);
    }

    public function registerPengelola(Request $request)
    {
        // Validate data to make sure it's correctly inputted
        $request->validate([
            'id_pengelola' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6',
        ]);

        // Create a new operator in the database
        $user = pengelolaModel::create([
            'id_pengelola' => $request->id_pengelola,
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->id_pengelola,
            'password' => Hash::make($request->password),
            'role' => 'operator',
        ]);

        return response()->json([
            'message' => 'User created successfully',
            'user' => $user
        ]);
    }

    public function registerPemimpin(Request $request)
    {
        // Validate data to make sure it's correctly inputted
        $request->validate([
            'id_pengelola' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6',
        ]);

        // Create a new manager in the database
        $user = pengelolaModel::create([
            'id_pengelola' => $request->id_pengelola,
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->id_pengelola,
            'password' => Hash::make($request->password),
            'role' => 'pemimpin',
        ]);

        return response()->json([
            'message' => 'User created successfully',
            'user' => $user
        ]);
    }

    public function registerAdmin(Request $request)
    {
        // Validate data to make sure it's correctly inputted
        $request->validate([
            'id_pengelola' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6',
        ]);

        // Create a new admin in the database
        $user = pengelolaModel::create([
            'id_pengelola' => $request->id_pengelola,
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->id_pengelola,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ]);

        return response()->json([
            'message' => 'User created succesfully',
            'user' => $user
        ]);
    }


}

