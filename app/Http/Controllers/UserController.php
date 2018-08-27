<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Transformers\UserTransformer;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'role:administrator']);
    }

    public function getUsers()
    {
        return fractal(User::all(), new UserTransformer())->respond();
    }
}
