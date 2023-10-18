<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Video;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/create-user', function () {
    for($i = 0; $i < 10; $i++) {
        User::factory()->create();
    }
});

Route::get('/create-post', function () {
    for($i = 0; $i < 10; $i++) {
        $post = Post::create([
                'title' => 'Post ' . $i,
                'user_id' => fake()->numberBetween(1, 10),
                ]);
        $post->comments()->create([
            'body' => 'Comment for post ' . $i,
            'user_id' => fake()->numberBetween(1, 10),
        ]);
    }
});

Route::get('create-video', function () {
    for($i = 0; $i < 10; $i++) {
        $video = Video::create([
                    'title' => 'Video ' . $i,
                    'user_id' => fake()->numberBetween(1, 10),
                ]);

        $video->comments()->create([
            'body' => 'Comment for video ' . $i,
            'user_id' => fake()->numberBetween(1, 10),
        ]);
    }
});

Route::get('create-comment-post', function () {
    $post = Post::with('comments')
            ->findOrFail(fake()
            ->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]));
    $post->comments()->create([
        'body' => 'Comment for post ' . $post->id,
        'user_id' => fake()->numberBetween(1, 10),
    ]);
    return response()->json($post);
});

Route::get('create-comment-video', function () {
    $video = Video::with('comments')
            ->findOrFail(fake()
            ->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]));
    $video->comments()->create([
        'body' => 'Comment for video ' . $video->id,
        'user_id' => fake()->numberBetween(1, 10),
    ]);
    return response()->json($video);
});

Route::get('comment-post', function () {
    $posts = Post::with('comments')->get();
    return response()->json($posts);
});

Route::get('comment-video', function () {
    $video = Video::with('comments')->get();
    return response()->json($video);
});
