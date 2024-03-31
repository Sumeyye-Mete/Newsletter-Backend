<?php

use App\Http\Controllers\Api\V1\ArticleController;
use App\Http\Controllers\Api\V1\AuthorController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\SubscribeController;
use App\Mail\DailyEmail;
use App\Models\Article;
use App\Models\Subscribes;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::bind('article', function ($value) {
    return Article::where('id', $value)->orWhere('slug', $value)->firstOrFail();
});
Route::group(['prefix' => 'v1', 'middleware' => 'auth:sanctum'], function () {
    Route::post('articles', [ArticleController::class, "store"]);
    Route::post('articles/{article}', [ArticleController::class, "update"]);
    Route::delete('articles/{article}', [ArticleController::class, "destroy"]);

    Route::get('/authors/{user}', [AuthorController::class, 'show'])->name('authors');
    Route::get('/user', UserController::class);
});
Route::group(['prefix' => 'v1'], function () {
    Route::get('articles', [ArticleController::class, "index"]);
    Route::get('articles/{article}', [ArticleController::class, "show"])->name("articles.show");
    Route::post('subscribe', [SubscribeController::class, "store"]);
});


