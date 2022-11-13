<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Traits\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

    use Response;
    /**
     * Login usuario y retornar el token
     * @return token
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);

        // Config::set('jwt.user', User::class);
        // Config::set('auth.providers', ['users' => [
        //     'driver' => 'eloquent',
        //     'model' => User::class,
        // ]]);
    }

    public function login(Request $request)
    {
        try {
            $credentials = $request->only('user', 'password');
            $data['usuario'] = $credentials['user'];
            $data['password'] = $credentials['password'];

            if (!$token = JWTAuth::attempt([
                'email' => $data['usuario'],
                'password' => $data['password']
            ])) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            $user = DB::table('users')->select('email', 'name')->where('email', $data['usuario'])->first();

            return response()->json(['token' => $token, 'user' => $user])
                ->header('Authorization', $token)
                ->withCookie(
                    'token',
                    $token,
                    config('jwt.ttl'),
                    '/'
                );
        } catch (\Throwable $th) {
            return  $this->errorResponse([$th->getMessage(), $th->getFile(), $th->getLine()]);
        }
    }

    /**
     * Logout usuario
     *
     * @return void
     */

    public function logout()
    {
        auth()->logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Logged out Successfully.'
        ], 200);
    }

    /**
     * Obtener el usuario autenticado
     *
     * @return Usuario
     */


    /**
     * Refrescar el token por uno nuevo
     *
     * @return token
     */

    public function me()
    {
        return response()->json(auth()->user());
    }

    public function refresh()
    {
        if ($token = $this->guard()->refresh()) {
            return response()->json()
                ->json(['status' => 'successs'], 200)
                ->header('Authorization', $token);
        }
        return response()->json(['error' => 'refresh_token_error'], 401);
    }

    public function renew()
    {
        try {
            if (!$token = $this->guard()->refresh()) {
                return response()->json(['error' => 'refresh_token_error'], 401);
            }
            $user = auth()->user();
            $user = User::find($user->id);
            return response()
                ->json(['status' => 'successs', 'token' => $token, 'user' => $user], 200)
                ->header('Authorization', $token);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'refresh_token_error' . $th->getMessage()], 401);
        }
    }

    /**
     * Retornar el guard
     *
     * @return Guard
     */
    private function guard()
    {
        return Auth::guard();
    }


    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 24,
            // 'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

    public function changePassword()
    {
        if (!auth()->user()) {
            return response()->json(['error' => 'refresh_token_error'], 401);
        }

        $user = User::find(auth()->user()->id);
        $user->password = Hash::make(Request()->get('newPassword'));
        $user->change_password = 0;
        $user->save();
        return Response()->json(['status' => 'successs', 200]);
    }
}
