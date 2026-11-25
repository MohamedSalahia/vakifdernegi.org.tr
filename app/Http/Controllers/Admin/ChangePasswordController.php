<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;

class ChangePasswordController extends Controller
{
    public function index($id)
    {
        //dd($id);
        $user = User::find($id);
        return view('admin.users.changePassword', compact('user'));
    }

    public function store(Request $request,$id)
    {

        $request->validate([
            'new_password' => ['required'],
            'confirm_new_password' => ['same:new_password'],
        ]);

        User::find($id)->update(['password'=> Hash::make($request->new_password)]);

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('admin.users.index');
    }
}
