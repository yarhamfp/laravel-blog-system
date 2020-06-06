<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use App\CommentReply;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index()
    {
        $comment = Comment::latest()->get();
        return view('pages.admin.comment.index', [
            'comment'   => $comment
        ]);
    }

    public function show($id)
    {
        $comment = Comment::findOrFail($id);
        return view('pages.admin.comment.reply', [
            'comment'   => $comment
        ]);
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
        $data->delete();
        return redirect()->back()->with('sukses', 'Komentar berhasil dihapus!');
    }

    public function replyDestroy($id)
    {
        $reply = CommentReply::findOrFail($id);
        $reply->delete();
        return redirect()->back()->with('sukses', 'Reply terlah terhapus');
    }
}
