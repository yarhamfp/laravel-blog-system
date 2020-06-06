<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Comment;
use App\Http\Controllers\Controller;
use App\Post;
use App\User;
use Carbon\Carbon;
use Conner\Tagging\Model\Tag;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all()->count();
        $popularPost = Post::where('view_count', '>', '10')->orderBy('view_count', 'DESC')->limit(6)->get();
        $all_comments = Comment::all()->count();
        $pending_posts = Post::where('is_approved', false)->count();
        $all_views = Post::sum('view_count');
        $author_count = User::where('role_id', 2)->count();
        $new_posts_today = Post::whereDate('created_at', Carbon::today())->count();
        $category_count = Category::all()->count();
        $tag_count = Tag::all()->count();
        $active_author = User::where('role_id', 2)
            ->withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->take(10)->get();
        return view('pages.admin.dashboard', [
            'posts'  => $posts,
            'popularPost'  => $popularPost,
            'all_comments'  => $all_comments,
            'pending_posts'  => $pending_posts,
            'all_views'  => $all_views,
            'author_count'  => $author_count,
            'new_posts_today'  => $new_posts_today,
            'category_count'  => $category_count,
            'tag_count' => $tag_count,
            'active_author' => $active_author
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
}
