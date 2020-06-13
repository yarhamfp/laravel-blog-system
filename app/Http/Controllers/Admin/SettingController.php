<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class SettingController extends Controller
{
    public function index($slug)
    {
        $setting = Setting::where('slug', $slug)->firstOrFail();
        return view('pages.admin.setting', [
            'setting'   => $setting
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'  => 'required',
            'subname'   => 'required',
        ]);
        $slug = $request->slug;
        $icon = $request->file('icon');
        $slug = Str::slug($request->name);
        $setting = Setting::findOrFail($id);
        if (isset($icon)) {
            $currentDate = Carbon::now()->toDateString();
            $iconName = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $icon->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('settings')) {
                Storage::disk('public')->makeDirectory('settings');
            }
            //            Delete old icon form settings folder
            if (Storage::disk('public')->exists('settings/' . $setting->icon)) {
                Storage::disk('public')->delete('settings/' . $setting->icon);
            }
            $settings = Image::make($icon)->resize(500, 500)->save(90);
            Storage::disk('public')->put('settings/' . $iconName, $settings);
        } else {
            $iconName = $setting->icon;
        }
        $setting->name = $request->name;
        $setting->subname = $request->subname;
        $setting->slug = $slug;
        $setting->icon = $iconName;
        $setting->save();
        return redirect()->route('admin.dashboard')->with('sukses', 'Settings berhasil diUpdate');
    }
}
