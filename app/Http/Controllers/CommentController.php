<?php

namespace App\Http\Controllers;

use App\Comment;
use App\CommentReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $id)
    {
        $this->validate($request, [
            'name'  => 'required',
            'email' => 'required',
            'comment' => 'required'
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'comment.required' => 'Comment tidak boleh kosong',
        ]);
        $data = $request->all();
        $data['post_id'] = $id;
        Comment::create($data);
        return redirect()->back()->with('sukses', 'Comment berhasil dikirim');
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
}
