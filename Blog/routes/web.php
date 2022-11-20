<?php

use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\Main\AdminController;
use App\Http\Controllers\Admin\Post\PostController;
use App\Http\Controllers\Admin\Tag\TagController;
use App\Http\Controllers\Admin\User\UserController as UserControllerAlias;
use App\Http\Controllers\Main\BaseController;
use App\Http\Controllers\Personal\Main\PersonalController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [BaseController::class, 'main'])->name('main.index');
// --------- Посты ------
Route::controller(\App\Http\Controllers\Post\BaseController::class)->group(function () {
    $urlPrefix = "/post";
    $prefix = "post";
    Route::get("$urlPrefix", "index")->name("$prefix.index");
    Route::get("$urlPrefix/{post}", "show")->name("$prefix.show");

    Route::controller(\App\Http\Controllers\Post\Comment\StoreController::class)->group(function (){
    $prefix = "/{post}";
        Route::post("post/$prefix", "store")->name("post.comment.store");
    });

});
// --------- Посты ------

// --------- КатегорииСписок ------
Route::get('/categories', [\App\Http\Controllers\Category\BaseController::class, 'main'])->name('category.index');
Route::get('{category}/posts', [\App\Http\Controllers\Category\Post\IndexController::class, 'index'])->name('category.post.index');
// --------- КатегорииСписок ------

// --------- Лайк ------
Route::controller(\App\Http\Controllers\Post\Like\LikeController::class)->group(function () {
    Route::post("post/{post}/like", "store")->name("post.like.store");
});
// --------- Лайк ------

Route::group(['middleware' => ['auth','admin', 'verified']], function() {
    Route::controller(PersonalController::class)->group(function () {
        $urlPrefix = "/personal";
        $prefix = "personal";
        Route::get("$urlPrefix", "index")->name("$prefix.index");

        Route::get("$urlPrefix/liked", "liked")->name("$prefix.liked");
        Route::delete("$urlPrefix/liked/{post}", "likedelete")->name("$prefix.liked.delete");

        Route::get("$urlPrefix/comments", "comments")->name("$prefix.comments");
        Route::get("$urlPrefix/comments/edit", "commedit")->name("$prefix.comments.edit");
        Route::patch("$urlPrefix/comments/{comment}", "commupdate")->name("$prefix.comments.update");
        Route::delete("$urlPrefix/comments/{comment}", "commdestroy")->name("$prefix.comments.destroy");

    });
});

Route::group(['middleware' => ['auth','admin', 'verified']], function() {

    // --------- Админка ------
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    // ---------Категории
    Route::controller(CategoryController::class)->group(function () {
        $urlPrefix = "/admin/categories";
        $prefix = "admin.category";

        Route::get("$urlPrefix", "index")->name("$prefix.index");
        Route::get("$urlPrefix/create", "create")->name("$prefix.create");
        Route::post("$urlPrefix/create/new", "store")->name("$prefix.store");
        Route::get("$urlPrefix/{category}", "show")->name("$prefix.show");
        Route::get("$urlPrefix/{category}/edit", "edit")->name("$prefix.edit");
        Route::patch("$urlPrefix/{category}", "update")->name("$prefix.update");
        Route::delete("$urlPrefix/{category}", "destroy")->name("$prefix.destroy");

    });

    // ---------Категории

    // ---------Тэги


    Route::controller(TagController::class)->group(function () {
        $urlPrefix = "/admin/tags";
        $prefix = "admin.tag";

        Route::get("$urlPrefix", "index")->name("$prefix.index");
        Route::get("$urlPrefix/create", "create")->name("$prefix.create");
        Route::post("$urlPrefix/create/new", "store")->name("$prefix.store");
        Route::get("$urlPrefix/{tag}", "show")->name("$prefix.show");
        Route::get("$urlPrefix/{tag}/edit", "edit")->name("$prefix.edit");
        Route::patch("$urlPrefix/{tag}", "update")->name("$prefix.update");
        Route::delete("$urlPrefix/{tag}", "destroy")->name("$prefix.destroy");
    });


    // ---------Тэги

    // ---------Посты


    Route::controller(PostController::class)->group(function () {
        $urlPrefix = "/admin/post";
        $prefix = "admin.post";

        Route::get("$urlPrefix", "index")->name("$prefix.index");
        Route::get("$urlPrefix/create", "create")->name("$prefix.create");
        Route::post("$urlPrefix/create/new", "store")->name("$prefix.store");
        Route::get("$urlPrefix/{post}", "show")->name("$prefix.show");
        Route::get("$urlPrefix/{post}/edit", "edit")->name("$prefix.edit");
        Route::patch("$urlPrefix/{post}", "update")->name("$prefix.update");
        Route::delete("$urlPrefix/{post}", "destroy")->name("$prefix.destroy");
    });


    // ---------Посты

    // ---------Пользователи
    Route::controller(UserControllerAlias::class)->group(function () {
        $urlPrefix = "/admin/user";
        $prefix = "admin.user";

        Route::get("$urlPrefix", "index")->name("$prefix.index");
        Route::get("$urlPrefix/create", "create")->name("$prefix.create");
        Route::post("$urlPrefix/create/new", "store")->name("$prefix.store");
        Route::get("$urlPrefix/{user}", "show")->name("$prefix.show");
        Route::get("$urlPrefix/{user}/edit", "edit")->name("$prefix.edit");
        Route::patch("$urlPrefix/{user}", "update")->name("$prefix.update");
        Route::delete("$urlPrefix/{user}", "destroy")->name("$prefix.destroy");
    });

    // ---------Пользователи


    // --------- Админка ------
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
