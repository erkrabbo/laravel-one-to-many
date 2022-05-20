<?php

namespace App\Http\Controllers\Admin;
use App\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(20);
        return view('home', compact('posts'));
    }
}
