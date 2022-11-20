<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function main(){
        return redirect()->route('post.index');
    }
}
