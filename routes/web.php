<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\BookmarkController;

use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\CategoriesPost;

Auth::routes();

Route::get('/email',function(){
    return view('users/emails/welcome');
});

Route::group(['middleware'=>'auth'],function(){

    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/search',[HomeController::class,'search'])->name('search');
    Route::get('/suggestedusers', [HomeController::class, 'showAllSuggestedUsers'])->name('suggested.users');


    #POST
    Route::get('/post/create',[PostController::class,'create'])->name('post.create');
    Route::post('/post/store',[PostController::class,'store'])->name('post.store');
    Route::get('/post/{id}/show',[PostController::class,'show'])->name('post.show');
    Route::get('/post/{id}/edit',[PostController::class,'edit'])->name('post.edit');
    Route::patch('/post/{id}/update',[PostController::class,'update'])->name('post.update');
    Route::delete('/post/{id}/destroy',[PostController::class,'destroy'])->name('post.destroy');
    // Route::get('/post/like',[PostController::class,'index'])->name('like.index');

    #COMMENT
    Route::post('/comment/{post_id}/store',[CommentController::class,'store'])->name('comment.store');
    Route::delete('/{id}/destroy',[CommentController::class,'destroy'])->name('comment.destroy');

    #PROFILE
    Route::get('/profile/{id}/show',[ProfileController::class,'show'])->name('profile.show');
    Route::get('/profile/edit',[ProfileController::class,'edit'])->name('profile.edit');
    Route::patch('/profile/{id}/update',[ProfileController::class,'update'])->name('profile.update');
    Route::patch('/profile/{id}/passwordupdate',[ProfileController::class,'passwordUpdate'])->name('password.update');
    Route::get('/profile/{id}/followers',[ProfileController::class,'followers'])->name('profile.followers');
    Route::get('/profile/{id}/following',[ProfileController::class,'following'])->name('profile.following');


    #LIKE
    Route::post('/like/{post_id}/store',[LikeController::class,'store'])->name('like.store');
    Route::delete('/like/{post_id}/destroy',[LikeController::class,'destroy'])->name('like.destroy');

    #Bookmark
    Route::post('/bookmark/{post_id}/store',[BookmarkController::class,'store'])->name('bookmark.store');
    Route::delete('/bookmark/{post_id}/destroy',[BookmarkController::class,'destroy'])->name('bookmark.destroy');

    #FOLLOW
    Route::post('/follow/{user_id}/store',[FollowController::class,'store'])->name('follow.store');
    Route::delete('/follow/{user_id}/destroy',[FollowController::class,'destroy'])->name('follow.destroy');

    #ADMIN
    Route::group(['prefix'=>'admin','as'=>'admin.','middleware'=>'admin'], function(){

        Route::get('/users',[UsersController::class,'index'])->name('users');
        Route::delete('/users/{id}/deactivate',[UsersController::class,'deactivate'])->name('users.deactivate');
        Route::patch('/users/{id}/activate',[UsersController::class,'activate'])->name('users.activate');

        Route::get('/posts',[PostsController::class,'index'])->name('posts');
        Route::delete('/posts/{id}/unvisible',[PostsController::class,'unvisible'])->name('posts.unvisible');
        Route::patch('/posts/{id}/visible',[PostsController::class,'visible'])->name('posts.visible');

        Route::get('/categories',[CategoriesPost::class,'index'])->name('categories');
        Route::post('/categories/store',[CategoriesPost::class,'store'])->name('categories.store');
        Route::delete('/categories/{id}/destroy',[CategoriesPost::class,'destroy'])->name('categories.destroy');
        Route::patch('/categories/{id}/update',[CategoriesPost::class,'update'])->name('categories.update');

    });

});


