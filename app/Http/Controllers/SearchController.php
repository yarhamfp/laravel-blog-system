<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request['query'];
        $posts = Post::where('title', 'LIKE', "%$query%")->approved()->published()->paginate(6);
        return view('pages.search', [
            'posts'     => $posts,
            'search'    => $query
        ]);
    }
}
