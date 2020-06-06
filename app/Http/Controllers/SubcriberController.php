<?php

namespace App\Http\Controllers;

use App\Subscriber;
use Illuminate\Http\Request;

class SubcriberController extends Controller
{
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'email' => "required|email|unique:subscribers"
            ],
            [
                'email.unique' => "email ini sudah terdaftar"
            ]
        );
        $data = $request->all();
        Subscriber::create($data);
        return redirect()->route('home')->with('sukses', 'Anda telah terdaftar sebagai subcriber kami :)');
    }
}
