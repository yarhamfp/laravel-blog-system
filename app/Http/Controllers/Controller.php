<?php

namespace App\Http\Controllers;

use App\CommentReply;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

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
