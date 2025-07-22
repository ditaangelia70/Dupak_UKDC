<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Cookie as SymfonyCookie;

use Tymon\JWTAuth\Facades\JWTAuth;

use Symfony\Component\HttpFoundation\RedirectResponse;

use App\Models\Settings;

class AuthController extends Controller
{
    public function get_user(Request $request){
        try {
            $token = $request->cookie('token');

            if (!$token) {
                return response()->json(['message' => 'Token not found'], 400);
            }

            $user = JWTAuth::setToken($token)->authenticate();

            if (!$user) {
                return null;
            }
        } catch (\Exception $e) {
            return null;
        }

        return $user;
    }

    public function show_login(Request $request){
        $user = $this->get_user($request);
        if($user && isset($user->role)){
            $role =  $user->role;
            if($role === 'admin'){
                return redirect('/admin');
            }else if($role === 'staf'){
                return redirect('/staf');
            }
            return redirect('/dosen');
        }
        $settings =  Settings::find(1);
    	return view('auth.login', ['settings'=>$settings]);
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only(['username', 'password']);

        if (!$token = JWTAuth::attempt($credentials)){
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function me()
    {
        return response()->json(Auth::user());
    }

    public function logout()
    {
    		$cookie = new SymfonyCookie('token', '', time() - 3600, '/', null, true, true, false, 'Lax');
        return redirect('/')->withCookie($cookie);
    }

    protected function respondWithToken($token)
    {
		$cookie = new SymfonyCookie(
	        'token',      // Nama cookie
	        $token,       // Nilai token
	        Carbon::now()->addMinutes(60), // Expired time (1 jam)
	        '/',          // Path
	        null,         // Domain
	        true,         // Secure (harus HTTPS)
	        true,         // HttpOnly (tidak bisa diakses oleh JavaScript)
	        false,        // Raw
	        'Lax'      // SameSite policy
	    );

        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60,
            'user' => Auth::user()
        ])->withCookie($cookie);
    }
}