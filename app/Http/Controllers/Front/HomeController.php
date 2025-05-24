<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data['blogs'] = Blog::query()->latest()->take(3)->get();

        return view('front.index', $data);
    }
}
