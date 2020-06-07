<?php

namespace App\Http\Controllers\Author;

use App\Category;
use App\Http\Controllers\Controller;
use App\Notifications\NewAuthorPost;
use App\Post;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
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
        $user_id = Auth::id();
        $item = Post::where('user_id', $user_id)->latest()->get();
        return view('pages.author.post.index', [
            'item' => $item
        ]);
    }

    public function pending()
    {
        $post = Auth::user()->posts()->where('is_approved', false)->get();
        return view('pages.author.post.pending', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('pages.author.post.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:posts',
            'categories' => 'required',
            'tags' => 'required',
            'body' => 'required',
        ], [
            'title.unique' => 'Title ini sudah dipakai'
        ]);
        $image = $request->file('image');
        $slug = Str::slug($request->title);

        if (isset($image)) {
            // membuat nama unik image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('post')) {
                Storage::disk('public')->makeDirectory('post');
            }

            // image resize
            $postImage = Image::make($image)->resize(1600, 1066)->save(90);
            Storage::disk('public')->put('post/' . $imageName, $postImage);
        } else {
            $imageName = "default.jpg";
        }
        $post = new Post();
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug = $slug;
        $post->image = $imageName;
        $post->body = $request->body;
        if (isset($request->status)) {
            $post->status = true;
        } else {
            $post->status = false;
        }
        $post->is_approved = false;
        $tags = $request->tags;

        $post->save();
        $post->tag($tags);
        $post->categories()->attach($request->categories);
        // $post->tags()->attach($request->tags);
        $users = User::where('role_id', '1')->get();
        Notification::send($users, new NewAuthorPost($post));

        return redirect()->route('author.post.index')->with('sukses', 'Data post berhasil ditambahkan. Silahkan menunggu admin untuk mengapprove post anda');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        if ($post->user_id != Auth::id()) {
            return redirect()->back()->with('warning', 'Kamu tidak mempunyai hak untuk melihat akses milik orang lain!');
        }
        return view('pages.author.post.show', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if ($post->user_id != Auth::id()) {
            return redirect()->back()->with('error', 'Kamu tidak mempunyai hak untuk mengedit akses milik orang lain!');
        }
        $categories = Category::all();
        return view('pages.author.post.edit', [
            'post' => $post,
            'categories' => $categories
        ]);
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
        if ($post->user_id != Auth::id()) {
            return redirect()->back()->with('error', 'Kamu tidak mempunyai hak untuk mengedit akses milik orang lain!');
        }
        $this->validate($request, [
            'title' => 'required',
            'image' => 'image',
            'categories' => 'required',
            'tags' => 'required',
            'body' => 'required',
        ]);
        $image = $request->file('image');
        $slug = Str::slug($request->title);
        if (isset($image)) {
            //            make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('post')) {
                Storage::disk('public')->makeDirectory('post');
            }
            //            delete old post image
            if (Storage::disk('public')->exists('post/' . $post->image)) {
                Storage::disk('public')->delete('post/' . $post->image);
            }
            $postImage = Image::make($image)->resize(1600, 1066)->save(90);
            Storage::disk('public')->put('post/' . $imageName, $postImage);
        } else {
            $imageName = $post->image;
        }

        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug = $slug;
        $post->image = $imageName;
        $post->body = $request->body;
        if (isset($request->status)) {
            $post->status = true;
        } else {
            $post->status = false;
        }
        $post->is_approved = false;
        $tags = $request->tags;
        $post->save();
        $post->retag($tags);

        $post->categories()->sync($request->categories);
        // $post->tags()->sync($request->tags);

        return redirect()->back()->with('sukses', 'Data post berhasil Diedit.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if ($post->user_id != Auth::id()) {
            return redirect()->back()->with('error', 'Kamu tidak mempunyai hak untuk menghapus akses milik orang lain!');
        }
        if (Storage::disk('public')->exists('post/' . $post->image)) {
            Storage::disk('public')->delete('post/' . $post->image);
        }
        $post->categories()->detach();
        // $post->tags()->detach();
        $post->delete();
        $post->untag();
        return redirect()->back()->with('sukses', 'Data post berhasil dihapus.');
    }
}
