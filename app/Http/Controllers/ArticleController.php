<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Transformers\ArticleTransformer;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'role:administrator|moderator']);
    }

    public function getArticles()
    {
        return fractal(Article::all(), new ArticleTransformer())->respond();
    }
}
