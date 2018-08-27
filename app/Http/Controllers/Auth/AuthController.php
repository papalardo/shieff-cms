<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Transformers\UserTransformer;
use App\Models\User;

class AuthController extends Controller
{
    /**
     *  Instance of model 
     */
    protected $model;

    /**
     * Login user after login
     * 
     * @var boolean
     */
    protected $loginAfterLogin = false;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->model = new User;
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Invalid email or password'], 401);
        }

        return response([
            'status' => 'success'
        ])
        ->header('Authorization', $token);
    }

    /**
     *  Register a user
     */
    public function register(Request $request)
    {
        $payLoad = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ];

        $user = $this->model->create($payLoad);
        $user->assignRole('user');

        if($this->loginAfterLogin) return $this->login($request);
        return fractal($user, new UserTransformer())->respond();
    }


    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function user()
    {
        return fractal(auth()->user(), new UserTransformer())->respond();
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return response([
            'status' => 'success'
        ])->header('Authorization', auth()->refresh());
    }
}
