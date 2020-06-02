<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Symfony\Component\VarDumper\Cloner\Data;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('pages.admin.user.index', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->route('admin.user.index')->with('warning', 'Demi alasan keamanan, Create user hanya bisa dilakukan dihalaman register.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'name' => 'required|unique:users',
        //     'email' => 'required|email|unique:users',
        //     'username' => 'required|unique:users',
        //     'role_id' => 'required',
        //     'image' => 'mimes:jpeg,png,jpg'
        // ]);
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
    public function edit($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        return view('pages.admin.user.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function role(Request $request, $id)
    {
        $data = $request->all();
        $user = User::findOrFail($id);
        // return $data;
        $user->update($data);
        return redirect()->back()->with('sukses', 'Data berhasil diedit');
    }


    public function update(Request $request, $id)
    {
        $role = User::find($id);
        if ($role->id != Auth::id()) {
            return redirect()->back()->with('warning', 'Kamu tidak mempunyai hak untuk melihat akses milik orang lain!');
        } else {
            $this->validate($request, [
                'username' => "unique:users,username,$id",
                'email' => "email|unique:users,email,$id",
                'image' => 'mimes:jpeg,png,jpg',
            ]);
            // $data = $request->all();
            // return $data;
            $image = $request->file('image');
            $slug = Str::slug($request->name);
            $user = User::findOrFail($id);
            if (isset($image)) {
                $currentDate = Carbon::now()->toDateString();
                $imageName = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                if (!Storage::disk('public')->exists('profile')) {
                    Storage::disk('public')->makeDirectory('profile');
                }
                //            Delete old image form profile folder
                if (Storage::disk('public')->exists('profile/' . $user->image)) {
                    Storage::disk('public')->delete('profile/' . $user->image);
                }
                $profile = Image::make($image)->resize(500, 500)->save(90);
                Storage::disk('public')->put('profile/' . $imageName, $profile);
            } else {
                $imageName = $user->image;
            }
            $user->name = $request->name;
            $user->email = $request->email;
            $user->username = $request->username;
            $user->role_id = $request->role_id;
            $user->image = $imageName;
            $user->about = $request->about;
            $user->save();
            return redirect()->route('admin.user.index')->with('sukses', 'Data User berhasil diUpdate');
        }
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
