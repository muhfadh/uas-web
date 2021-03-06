<?php

namespace App\Http\Controllers\Author;

use App\Category;
use App\Post;
use App\Tag;
use App\Http\Controllers\Controller;
use App\Notifications\NewAuthorPost;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Notifications\Notifiable;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Auth::user()->posts()->latest()->get();
        return view('author.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('author.post.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customMessages = [
            'required' => 'Post :attribute tidak boleh kosong!'
        ];
        $this->validate($request,[
            'title' => 'required',
            'image' => 'required',
            'categories' => 'required',
            'tags' => 'required',
            'body' => 'required'
        ], $customMessages);

        $image = $request->file('image');
        $slug = Str::slug($request->title);
        if(isset($image)){
            //buat nama unik image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('post')){
                Storage::disk('public')->makeDirectory('post');
            }

            $postImage = Image::make($image)->resize(1600,1066)->stream();
            Storage::disk('public')->put('post/'.$imageName, $postImage);
        }
        else{
            $imageName = "default.png";
        }


        $post = new Post();
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug = $slug;
        $post->image = $imageName;
        $post->body = $request->body;
        if(isset($request->status)){
            $post->status = true;
        }
        else{
            $post->status = false;
        }

        $post->is_approved = false;
        $post->save();
        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);

        $users = User::where('role_id', '1')->get();
        // $users->each->notify(new NewAuthorPost($post));
        Notification::send($users, new NewAuthorPost($post));
        Toastr::info('Post Berhasil Disimpan :)' ,'Sukses');

        return redirect()->route('author.post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        if($post->user_id != Auth::id()){
            Toastr::error('Kamu tidak berhak mengakses postingan ini!' ,'Error');
            return redirect()->back();
        }
        return view('author.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if($post->user_id != Auth::id()){
            Toastr::error('Kamu tidak berhak mengakses postingan ini!' ,'Error');
            return redirect()->back();
        }
        $categories = Category::all();
        $tags = Tag::all();
        return view('author.post.edit', compact('post','categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $customMessages = [
            'required' => 'Post :attribute tidak boleh kosong!'
        ];
        $this->validate($request,[
            'title' => 'required',
            'image' => 'image',
            'categories' => 'required',
            'tags' => 'required',
            'body' => 'required'
        ], $customMessages);

        $image = $request->file('image');
        $slug = Str::slug($request->title);
        if(isset($image)){
            //buat nama unik image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('post')){
                Storage::disk('public')->makeDirectory('post');
            }

            //hapus image post lama
            if(Storage::disk('public')->exists('post/'.$post->image)){
                Storage::disk('public')->delete('post/'.$post->image);
            }

            $postImage = Image::make($image)->resize(1600,1066)->stream();
            Storage::disk('public')->put('post/'.$imageName, $postImage);
        }
        else{
            $imageName = $post->image;
        }

        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug = $slug;
        $post->image = $imageName;
        $post->body = $request->body;
        if(isset($request->status)){
            $post->status = true;
        }
        else{
            $post->status = false;
        }

        $post->is_approved = false;
        $post->save();
        $post->categories()->sync($request->categories);
        $post->tags()->sync($request->tags);
        Toastr::info('Post Berhasil Diperbarui :)' ,'Sukses');
        return redirect()->route('author.post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if(Storage::disk('public')->exists('post/'.$post->image)){
            Storage::disk('public')->delete('post/'.$post->image);
        }

        $post->categories()->detach();
        $post->tags()->detach();
        $post->delete();
        Toastr::info('Post Berhasil Dihapus :)' ,'Sukses');
        return redirect()->back();
    }
}
