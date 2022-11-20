<?php

namespace App\Http\Controllers\Personal\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\Personal\Comment\UpdateRequest;
use App\Models\Comment;
use App\Models\Post;

class PersonalController extends Controller
{
    public function index(){

        return view('personal.main.index');
    }
    public function liked(){
        $posts = auth()->user()->likedPosts;
        return view('personal.liked.liked', compact('posts'));
    }
    public function likedelete(Post $post){
        auth()->user()->likedPosts()->detach($post->id);

        return redirect()->route('personal.liked');
    }
    public  function comments(){
        $comments = auth()->user()->comments;

        return view('personal.comments.comments', compact('comments'));
    }
    public  function commedit(Comment $comment){
        return view('personal.comments.edit', compact('comment'));
    }
    public  function commupdate(UpdateRequest $request, Comment $comment){
        $data = $request->validated();
        $comment->update($data);
        return redirect()->route('personal.comments', compact('comment'));
    }
    public  function commdestroy(Comment $comment){
        $comment->delete();
        return redirect()->route('personal.comments', compact('comment'));
    }
}
