<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Notifications\AuthorPostApproved;
use App\Notifications\NewAuthorPost;
use App\Notifications\NewPostNotify;
use App\Post;
use App\Subscriber;
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
        $item = Post::latest()->get();
        return view('pages.admin.post.index', [
            'item' => $item
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
        return view('pages.admin.post.create', [
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

            // img thumb create
            if (!Storage::disk('public')->exists('post/thumb')) {
                Storage::disk('public')->makeDirectory('post/thumb');
            }
            //            resize image for category slider and upload
            $thumb = Image::make($image)->resize(500, 300)->save(90);
            Storage::disk('public')->put('post/thumb/' . $imageName, $thumb);
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
        if (isset($request->is_approved)) {
            $post->is_approved = true;
        } else {
            $post->is_approved = false;
        }
        $tags = $request->tags;
        // $tags = explode(",", $request->tags);

        $post->save();
        $post->tag($tags);
        $post->categories()->attach($request->categories);
        // $post->tags()->attach($request->tags);

        return redirect()->route('admin.post.index')->with('sukses', 'Data post berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('pages.admin.post.show', [
            'post' => $post
        ]);
    }

    public function pending()
    {
        $post = Post::where('is_approved', false)->get();
        return view('pages.admin.post.pending', [
            'post' => $post
        ]);
    }

    public function approval($id)
    {
        $post = Post::find($id);
        if ($post->is_approved == false) {
            $post->is_approved = true;
            $post->save();
            $post->users->notify(new AuthorPostApproved($post));

            $subscribers = Subscriber::all();
            foreach ($subscribers as $subscriber) {
                Notification::route('mail', $subscriber->email)
                    ->notify(new NewPostNotify($post));
            }
        }
        return redirect()->back()->with('sukses', 'Data post berhasil diapprove.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('pages.admin.post.edit', [
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
            // img thumb update
            if (!Storage::disk('public')->exists('post/thumb')) {
                Storage::disk('public')->makeDirectory('post/thumb');
            }
            //            delete old post image
            if (Storage::disk('public')->exists('post/thumb/' . $post->image)) {
                Storage::disk('public')->delete('post/thumb/' . $post->image);
            }
            $thumb = Image::make($image)->resize(500, 300)->save(90);
            Storage::disk('public')->put('post/thumb/' . $imageName, $thumb);
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
        $post->is_approved = $post->is_approved;
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
