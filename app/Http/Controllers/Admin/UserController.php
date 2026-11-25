<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\User;
use Yajra\DataTables\DataTables;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_users')->only(['index']);
        $this->middleware('permission:create_users')->only(['create', 'store']);
        $this->middleware('permission:update_users')->only(['edit', 'update']);
        $this->middleware('permission:delete_users')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index()
    {
        return view('admin.users.index');

    }// end of index

    public function data()
    {
        $users = User::whereRoleIs('admin')->orWhereRoleIs('user')->select('id','name','email', 'image', 'created_at', 'updated_at')->orderBy('id', 'desc')->get();
        //dd($users);

        return DataTables::of($users)
            ->addColumn('record_select', 'admin.users.data_table.record_select')
            ->addColumn('actions', 'admin.users.data_table.actions')
            ->addColumn('images', 'admin.users.data_table.images')
            ->rawColumns(['record_select', 'actions', 'images'])
            ->toJson();

    }// end of data

    public function create()
    {

        return view('admin.users.create');

    }// end of create

    public function store(UserRequest $request)
    {

        $request->validated();
        /*$requestData['password'] = bcrypt($request->password);*/

        $request_data = $request->except(['password', 'password_confirmation', 'permissions', 'image']);
        $request_data['password'] = bcrypt($request->password);

        if ($request->image) {

            $file = $request->file('image');

            $path = $file->hashName('public/user_images');

            $image = Image::make($file);

            /*$image->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            });*/

            Storage::put($path, (string) $image->encode());

            $request_data['image'] = $request->image->hashName();

        }//end of if

        //dd($request_data);

        $user = User::create($request_data);
        $user->attachRole('admin');
        if ($request->permissions){
            $user->syncPermissions($request->permissions);
        }
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.users.index');

    }// end of store

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));

    }// end of edit

    public function update(UserRequest $request, User $user)
    {
        //$request_data = $request->validated();
        $request_data = $request->except(['permissions', 'image']);
        if ($request->image) {

            if ($user->image != null) {

                Storage::delete('public/user_images/' . $user->image);

            }//end of if

            $file = $request->file('image');

            $path = $file->hashName('public/user_images');

            $image = Image::make($file);

            Storage::put($path, (string) $image->encode());

            $request_data['image'] = $request->image->hashName();

        }//end of if

        //auth()->user()->update($request_data);


        //dd($request);
        $user->update($request_data);
        if ($request->permissions){
            $user->syncPermissions($request->permissions);
        }
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('admin.users.index');

    }// end of update

    public function destroy(User $user)
    {
        if ($user->image != null) {

            Storage::delete('public/user_images/' . $user->image);

        }//end of if
        $this->delete($user);
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $user = User::FindOrFail($recordId);

            //dd($user->image);

            if ($user->image != null) {

                Storage::delete('public/user_images/' . $user->image);

            }//end of if

            $this->delete($user);

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of bulkDelete

    private function delete(User $user)
    {
        $user->delete();

    }// end of delete

}//end of controller
