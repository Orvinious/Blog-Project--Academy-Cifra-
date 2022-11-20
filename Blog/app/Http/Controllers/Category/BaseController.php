<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function main(){

        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }
}
