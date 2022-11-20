<?php

namespace App\Http\Controllers\Post\Like;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\Comment\StoreRequest;
use App\Models\Comment;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Post $post){
        auth()->user()->likedPosts()->toggle($post->id);

        return redirect()->back();
    }
}
