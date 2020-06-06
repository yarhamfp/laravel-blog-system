<?php

namespace App\Http\Controllers\Author;

use App\Category;
use App\Comment;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $posts = $user->posts;
        $popular_posts = $user->posts()
            ->withCount('comments')
            ->orderBy('view_count', 'desc')
            ->orderBy('comments_count')
            ->take(5)->get();
        $total_pending_posts = $posts->where('is_approved', false)->count();
        $all_views = $posts->sum('view_count');
        $category_count = Category::all()->count();
        return view('pages.author.dashboard', [
            'posts'  => $posts,
            'popular_posts'  => $popular_posts,
            'total_pending_posts'  => $total_pending_posts,
            'all_views'  => $all_views,
            'category'  => $category_count
        ]);
    }
}
