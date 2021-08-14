<?php

namespace App\Http\Controllers\blog;

use App\Tag;
use App\Post;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostsController extends Controller
{
    public function show(Post $post)
    {
        return view('blog.show')->with('post',$post);
    }

    public function category(Category $category)
    {
        return view('blog.category')->with('category',$category)
        ->with('posts',$category->posts()->simplePaginate(2))
        ->with('categories',Category::all())
        ->with('tags',Tag::all());
    }

    public function tag(Tag $tag)
    {
        return view('blog.tag')->with('tag',$tag)
        ->with('posts',$tag->posts()->simplePaginate(2))
        ->with('tags',Tag::all())
        ->with('categories',Category::all());
    }
}
