<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function login_post(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            notify()->success('Tekrardan Hosgeldiniz ' . Auth::user()->name);
            return redirect()->route('tasks');
        } else {
            return redirect()->route('login')->withErrors('E-Posta veya sifre hatalidir');
        }
    }

    public function register()
    {
        return view('register');
    }

    public function register_post(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|unique:admins|email',
            'password' => 'required|min:6',
        ]);

        $admin = new Admin;
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = bcrypt($request->password);

        $admin->save();
        notify()->success('Basarili', 'Kullanıcı basariyla olusturuldu.');
        return redirect()->route('tasks');
    }

    public function update(Request $request, $id)
    {
        $isNick = Admin::where(['nick_name' => $request->nick_name])->whereNotIn('id', [$id])->first();
        $isMail = Admin::where(['email' => str_slug($request->email)])->whereNotIn('id', [$id])->first();
        if ($isNick) {
            notify()->error($request->nick_name . ' Nick Adı mevcuttur.');
            return redirect()->back();
        }
        if ($isMail) {
            notify()->error($request->email . ' Email adresi mevcuttur.');
            return redirect()->back();
        }

        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $admin = Admin::findOrFail($id);
        $admin->name = $request->name;
        $admin->nick_name = $request->nick_name;
        $admin->email = $request->email;
        $admin->description = $request->description;
        $admin->facebook = $request->facebook;
        $admin->twitter = $request->twitter;
        $admin->instagram = $request->instagram;

        if ($request->hasFile('image')) {
            $imageName = str_slug($request->nick_name) . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads/yonetici/'), $imageName);
            $admin->image = $imageName;
        }


        $admin->save();
        notify()->success('Yönetici basariyla guncellendi.');
        return redirect()->route('admin.yonetici.index');
    }

    public function update_password(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|confirmed|max:50',
            'password_confirmation' => 'required_with:password|same:password'
        ]);

        $admin = Admin::findOrFail($id);
        $admin->password = bcrypt($request->password);
        $admin->save();
        notify()->success($admin->nick_name . ' kullanıcının şifresi değiştirildi.');
        return redirect()->route('admin.yonetici.index');
    }

    public function switch(Request $request)
    {
        $admin = Admin::findOrFail($request->id);
        if ($admin->id != 1) {
            $admin->status = $request->statu == 'true' ? 1 : 0;
            $admin->save();
        }

    }

    public function delete($id)
    {
        $admin = Admin::find($id);;
        if ($admin->id != 1) {
            $admin->delete();
            notify()->success($admin->nick_name . ' Kayit Silinenlere basariyla tasindi.');
            return redirect()->route('admin.yonetici.index');
        } else {
            notify()->error($admin->nick_name . ' Bu kullanıcı silinemez.');
            return redirect()->route('admin.yonetici.index');
        }
    }

    public function trashed()
    {
        $admins = Admin::onlyTrashed()->orderBy('deleted_at', 'desc')->get();
        return view('back.auth.trashed', compact('admins'));
    }

    public function recycle($id)
    {
        $admin = Admin::onlyTrashed()->find($id);
        $admin->restore();
        notify()->success($admin->nick_name . ' kullanıcısı basariyla kurtarildi.');
        return redirect()->back();
    }

    public function hardDelete($id)
    {
        if ($id != 1) {
            $admin = Admin::onlyTrashed()->find($id);

            if (File::exists('uploads/yonetici/' . $admin->image)) {
                File::delete(public_path('uploads/yonetici/' . $admin->image));
            }
            notify()->success($admin->nick_name . ' kullanıcısı basariyla silindi.');
            $admin->forceDelete();
            return redirect()->back();
        }
    }


    public function logout()
    {
        Auth::logout();
        notify()->success('Cikis Basarili.');
        return redirect()->route('home');
    }


}
