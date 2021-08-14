<?php

namespace App\Http\Controllers;

use App\Tag;    
use App\Post;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\Posts\CreatePostRequest;
use App\Http\Requests\Posts\UpdatePostsRequest;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('verifyCategoriesCount')->only(['create','store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index')->with('posts',Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('posts.create')->with('categories',Category::all())->with('tags',Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
       $image = $request->image->store('posts');

       $post = Post::create([
        'title'=>$request->title,
        'description'=>$request->description,
        "content"=>$request->content,
        'image'=>$image,
        'published_at'=>$request->published_at,
        'category_id'=>$request->category,
        'user_id'=> auth()->user()->id
       ]);
        
       if($request->tags)
       {
           $post->tags()->attach($request->tags);
       }
       session()->flash('success','Post Created Successfully');
        
       return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.create')
            ->with('post',$post)
            ->with('categories',Category::all())
            ->with('tags',Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostsRequest $request,Post $post)
    {
        $data = $request->only(['title','description','content','published_at']);
        //check for imgae
        if($request->hasFile('image')){

            $image = $request->image->store('posts');
            
            //delete old image
            $post->deleteImage();

            $data['image']=$image;

        }

        if($request->tags)
        {
            $post->tags()->sync($request->tags);
        }
        //update attributes
        $post->update($data);

        session()->flash('success','Post Updated Successfully');

        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Post::withTrashed()->where('id',$id)->firstorFail();

        if($post->trashed()){

            $post->deleteImage();

            $post->forceDelete();
        }
        else{
            $post->delete();
        }

        session()->flash('success','Post Deleted Successfully');

        return redirect(route('posts.index'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function trashed(Post $post){

       $trashed=Post::onlyTrashed()->get();

       return view('posts.index')->withPosts($trashed);

    }

    public function restore($id)
    {
        $post=Post::withTrashed()->where('id',$id)->firstorFail();

        $post->restore();

        session()->flash('success','Post Restored Successfully');

        return redirect(route('posts.index'));


    }
}
