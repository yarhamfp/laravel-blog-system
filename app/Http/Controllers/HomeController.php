<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\ViewPage;
use Conner\Tagging\Model\Tag;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categori1 = Category::first();
        $slug = $categori1->slug;
        $categories = Category::where('slug', '!=', $slug)->inRandomOrder()->get();
        $slider_indikator = Category::all();
        $terbaru = Post::latest()->approved()->published()->paginate(6);
        $popularPost = Post::where('view_count', '>', '10')->published()->approved()->orderBy('view_count', 'DESC')->limit(6)->get();
        // dd($slug);
        return view('pages.home', [
            'categori1' => $categori1,
            'categories' => $categories,
            'terbaru'   => $terbaru,
            'slider'    => $slider_indikator,
            'popularPost'   => $popularPost
        ]);
    }
    public function blogpost($slug)
    {
        $categories = Category::all();
        $post = Post::where('slug', $slug)->firstOrFail();
        $postKey = 'blog_' . $post->id;
        if (!Session::has($postKey)) {
            $post->increment('view_count');
            Session::put($postKey, 1);
        }
        return view('pages.blogpost', [
            'post'  => $post,
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function category()
    {
        $categories = Category::paginate(6);
        return view('pages.category', [
            'categories' => $categories
        ]);
    }

    public function tagview($slug)
    {
        $tag = Tag::where('slug', $slug)->first();
        $postByTag = Post::withAnyTag($slug, 'slug')->paginate(6);
        return view('pages.tagsview', [
            'postByTag' => $postByTag,
            'tag' => $tag
        ]);
    }

    public function categoryview($slug)
    {
        $categories = Category::where('slug', $slug)->first();
        $posts = $categories->posts()->approved()->published()->paginate(6);
        return view('pages.category-view', [
            'posts' => $posts,
            'categories' => $categories
        ]);
    }
}
