<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use App\Http\Requests\StorePost;
use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show', 'all', 'archive']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     
        return view(
            'posts.index', 
            [
                'posts' => Post::postWithUserCommentsTags()->get(), 
            ]
        );
    }



    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $postShow = Cache::remember("post-show-{$id}", 60, function() use($id) {
            return Post::with(['comments', 'tags', 'comments.user'])->findOrFail($id);  
        });

        return view('posts.show', [
            'post' => $postShow
        ]);
    }

    public function create()
    {
        //$this->authorize('create');
        return view('posts.create');
    }

    

    public function store(StorePost $request)
    {

        $validatedData = $request->validated();

        $validatedData['user_id'] = $request->user()->id;
        
        $post = Post::create($validatedData);

        // Upload Picture for current Post
        if($request->hasFile('picture')) {
           
            $path = $request->file('picture')->store('posts');
            
            //$image = new Image(['path' =>  $path]);

            $post->image()->save(Image::make(['path' => $path]));
        }

        $request->session()->flash('status', 'Blog post was created!');

        return redirect()->route('posts.show', ['post' => $post->id]);
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);

        // if(Gate::denies('post.update', $post)) {
        //     abort(403, "You can't edit this post !");
        // }

        $this->authorize("update", $post);


        return view('posts.edit', ['post' => $post]);
    }

    public function update(StorePost $request, $id)
    {
        $post = Post::findOrFail($id);

        // if(Gate::denies('post.update', $post)) {
        //     abort(403, "You can't edit this post !");
        // }

        $this->authorize("update", $post);

          // Upload Picture for current Post
          if($request->hasFile('picture')) {

              $path = $request->file('picture')->store('posts');

                  if($post->image) {
                    Storage::delete($post->image->path);
                    $post->image->path = $path;
                    $post->image->save();
                  }
                  else {
                      $post->image()->save(Image::make(['path' => $path]));
                  }
        }

        $validatedData = $request->validated();

        $post->fill($validatedData);
        $post->save();

        $request->session()->flash('status', 'Blog post was updated!');

        return redirect()->route('posts.show', ['post' => $post->id]);
    }

    public function destroy(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $this->authorize("delete", $post);
        $post->delete();

        // Post::destroy($id);

        $request->session()->flash('status', 'Blog post was deleted!');

        return redirect()->route('posts.index');
    }


    public function restore($id) {
        $post = Post::onlyTrashed()->where('id', $id)->first();
        
        $this->authorize('restore', $post);
        $post->restore();
        return redirect()->back();
    }

    public function forcedelete($id) {
        $post = Post::onlyTrashed()->where('id', $id)->first();

        $this->authorize('forceDelete', $post);

        $post->forceDelete();
        return redirect()->back();
    }
}
