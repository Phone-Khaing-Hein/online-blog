<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::search()->latest('id')->paginate(5);
        return view('post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $request->validate([
            'title'=>"required|unique:posts,title|min:3",
            'category'=>"required|integer|exists:categories,id",
            'description'=>"required|min:10",
            'photo'=>'nullable',
            'photo.*'=>'file|mimes:jpg,jpeg,png',
            'tags'=>"required",
            'tags.*'=>"integer|exists:tags,id"
        ]);
        DB::transaction(function() use ($request){



        $post = new Post();
        $post->title = $request->title;
        $post->slug = $request->title;
        $post->description = $request->description;
        $post->excerpt = Str::words($request->description,15,'...');
        $post->category_id = $request->category;
        $post->user_id = Auth::id();
        $post->is_publish = true;
        $post->save();

        //save tags to pivot table
        $post->tags()->attach($request->tags);

        if (!Storage::exists('public/thumbnail')){
            Storage::makeDirectory('public/thumbnail');
        }

        if ($request->hasFile('photo')){
            foreach ($request->file('photo') as $photo){
                //store photo
                $newName = uniqid()."_photo".$photo->extension();
                $photo->storeAs("public/photo",$newName);

                //making thumbnail
                $img = Image::make($photo);
                $img->fit(200,200);
                $img->save('storage/thumbnail/'.$newName);

                //save in db
                $photo = new Photo();
                $photo->name = $newName;
                $photo->post_id = $post->id;
                $photo->user_id = Auth::id();
                $photo->save();
            }
        }
        });

        return redirect()->route('post.index')->with('status',$request->title.' created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('post.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('post.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $request->validate([
            'title'=>"required|unique:posts,title,$post->id|min:3",
            'category'=>"required|integer|exists:categories,id",
            'description'=>"required|min:10",
        ]);

        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->description = $request->description;
        $post->excerpt = Str::words($request->description,15,'...');
        $post->category_id = $request->category;
        $post->update();

        //delete from pivot
        $post->tags()->detach();

        //save tags to pivot table
        $post->tags()->attach($request->tags);

        return redirect()->route('post.index')->with('status',$request->title.' updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        foreach ($post->photos as $photo){
            //delete photos from file
            Storage::delete('public/photo/'.$photo->name);
            Storage::delete('public/thumbnail/'.$photo->name);
        }
        //delete photos from db
        $post->photos()->delete();
        //delete from pivot
        $post->tags()->detach();

        $post->delete();
        return redirect()->route('post.index')->with('status','deleted successfully');
    }
}
