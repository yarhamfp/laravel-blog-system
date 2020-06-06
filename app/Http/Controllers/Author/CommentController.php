<?php

namespace App\Http\Controllers\Author;

use App\Comment;
use App\CommentReply;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index()
    {
        $post = Auth::user()->posts;
        // return $comment = Comment::where('post_id', $post);
        // dd($post);
        return view('pages.author.comment.index', [
            'posts' => $post
        ]);
    }

    public function show($id)
    {
        $comment = Comment::findOrFail($id);
        if ($comment->posts->users->id != Auth::id()) {
            return redirect()->back()->with('error', 'Anda tidak berhak melihat ini');
        } else {
            return view('pages.author.comment.reply', [
                'comment'   => $comment
            ]);
        };
    }

    public function reply(Request $request, $id)
    {
        $this->validate($request, [
            'reply' => 'required'
        ]);
        $data = $request->all();
        $data['comment_id'] = $id;
        $data['user_id']    = Auth::id();

        CommentReply::create($data);
        return redirect()->back()->with('sukses', 'Comment berhasil dibalas');
    }

    public function destroy($id)
    {
        $data = Comment::findOrFail($id);
        if ($data->posts->users->id != Auth::id()) {
            return redirect()->back()->with('error', 'Anda tidak berhak menghapus ini');
        } else {
            $data->delete();
            return redirect()->back()->with('sukses', 'Komentar berhasil dihapus!');
        };
    }

    public function replyDestroy($id)
    {
        $reply = CommentReply::findOrFail($id);
        if ($reply->comments->posts->users->id != Auth::id()) {
            return redirect()->back()->with('error', 'Anda tidak berhak menghapus ini');
        } else {
            $reply->delete();
            return redirect()->back()->with('sukses', 'Reply terlah terhapus');
        }
    }
}
