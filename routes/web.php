<?php

use App\Models\Post;
use App\Models\Tag;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('create-post',function(){
    // this will create a new post with a random title
    // this will pick a random user
    // TODO: must create 10 posts. Otherwise it will fail due to fake()->randomElement method
    Post::create([
        'title' => fake()->sentence(),
        'user_id' => fake()->randomElement([1,5,6,7])
    ]);
});

Route::get('create-tag',function(){
    // this will create a new tag with a random name
    // TODO: must create 10 tags. Otherwise it will fail due to fake()->randomElement method
    Tag::create([
        'name' => fake()->word()
    ]);
});

Route::get('create-post-tag',function(){
    // this will pick a random post
    // the random element is used to pick a random post
    $post = Post::findOrFail(fake()->randomElement([1,2,3,4]));
    // this will attach the tag to the post
    // the random element is used to pick a random tag
    $post->tags()->attach(fake()->randomElement([1,2,3,4,5,6,7,8,9,10]));
});

Route::get('delete-post-tag',function(){
    /**
     * Remember once you have detached a tag from a post it will be deleted.
     * So if you detach a tag then must change the post id to another post.
     * Otherwise you will get an error 402 due to findOrFail method
     */
    // find the post with id 1
    $post = Post::findOrFail(1);   
    // detach the tag from the post with id 1
    $post->tags()->detach(7); 
});

Route::get('update-post-tag',function(){
    /**
     * This method will sync or update post tags
     * The sync method is actually detaches all the tags from the post
     * and then attaches the new tags
     */
    // find the post with id 1
    $post = Post::findOrFail(1);   
    // update the tag from the post with id 1
    $post->tags()->sync([1,2,3,4,5,6,7,8,9,10]); 
});

Route::get('post-tag',function(){
    // this will pick all the posts with tags
   $post = Post::with(['user','tags'])->get();
   return response()->json($post); 
});

Route::get('tag-post',function(){
    // this will pick all the tags with posts
    /**
     * This is actually a fetches all the tags with posts
     * Here i combined the posts user relation with the tags
     */
    $tag = Tag::with(['posts','posts.user'])->get();
    return response()->json($tag);
});
