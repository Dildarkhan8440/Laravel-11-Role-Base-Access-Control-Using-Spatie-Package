<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\Post;
use Illuminate\Routing\Controllers\HasMiddleware;

class PostController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            // examples with aliases, pipe-separated names, guards, etc:
            'role_or_permission:view post|create post|delete post|update post|publish post|unpublish post',
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::get();
        return view('role-permission.post.index', ['posts' => $posts]);    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    
        return view('role-permission.post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|max:255',
        ]);

        $user = Post::create([
                        'title' => $request->title,
                        'description' => $request->description,
                        'user_id' => auth()->user()->id,
                    ]);

        return redirect('/posts')->with('status','Post created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $posts= Post::find($id);
        return view('role-permission.post.edit', ['posts' => $posts]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
        ];

        Post::where('id',$id)->update($data);

        return redirect('/posts')->with('status','Post Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect('/posts')->with('status','Post Delete Successfully');
    }
    public function publish(string $id){
        Post::where('id',$id)->update(['status'=>'active']);
        return redirect('/posts')->with('status','Post Published Successfully');
    }
    public function unpublish(string $id){
        Post::where('id',$id)->update(['status'=>'inactive']);
        return redirect('/posts')->with('status','Post Un-Published Successfully');
    }
}
