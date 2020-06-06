<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function profile($username)
    {

        $user = User::where('username', $username)->firstOrFail();
        if ($user->id != Auth::id()) {
            return redirect()->back()->with('error', 'Kamu tidak mempunyai hak untuk melihat akses milik orang lain!');
        }
        return view('pages.author.user.profile', [
            'user' => $user
        ]);
    }

    public function update(Request $request, $id)
    {
        $role = User::findOrFail($id);
        if ($role->id != Auth::id()) {
            return redirect()->back()->with('error', 'Kamu dilarang mengedit data pribadi milik orang lain!');
        } else {
            $this->validate($request, [
                'username' => "unique:users,username,$id",
                'email' => "email|unique:users,email,$id",
                'image' => 'mimes:jpeg,png,jpg',
            ]);
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
            $user->role_id = 2;
            $user->image = $imageName;
            $user->about = $request->about;
            $user->save();
            return redirect()->route('author.dashboard')->with('sukses', 'Data User berhasil diUpdate');
        }
    }

    public function password(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ], [
            'confirmed' => 'Konfirmasi password anda salah'
        ]);

        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->old_password, $hashedPassword)) {
            if (!Hash::check($request->password, $hashedPassword)) {
                $user = User::findOrFail(Auth::id());
                $user->password = Hash::make($request->password);
                $user->save();
                Auth::logout();
                return redirect('/login')->with('sukses', 'Password telah berhasil dirubah! Silahkan login kembali dengan password baru anda');
            } else {
                return redirect()->back()->with('error', 'Password baru tidak boleh sama dengan password lama');
            }
        } else {
            return redirect()->back()->with('warning', 'Password lama anda tidak terdaftar / salah!');
        }
    }
}
