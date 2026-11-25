<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use App\Http\Requests\Admin\NotificationRequest;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\DataTables;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_notifications')->only(['index']);
        $this->middleware('permission:create_notifications')->only(['create', 'store']);
        $this->middleware('permission:update_notifications')->only(['edit', 'update']);
        $this->middleware('permission:delete_notifications')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index()
    {
        return view('admin.notifications.index');

    }// end of index

    public function data()
    {
        $notifications = Notification::get();
        return DataTables::of($notifications)
            ->addColumn('record_select', 'admin.notifications.data_table.record_select')
            ->addColumn('actions', 'admin.notifications.data_table.actions')
            ->rawColumns(['record_select', 'actions'])
            ->toJson();

    }// end of data

    public function create()
    {

        return view('admin.notifications.create');

    }// end of create

    public function store(NotificationRequest $request)
    {

        $request->validated();


        \Illuminate\Support\Facades\Mail::to('asddsa@gmail.com')->send(new \App\Mail\WelcomeMail($request->input()));

        //dd('done');

        Notification::create($request->all());

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.notifications.index');

    }// end of store

    public function edit(Notification $notification)
    {
        return view('admin.notifications.edit', compact('notification'));

    }// end of edit

    public function destroy(Notification $notification)
    {
        $this->delete($notification);
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $notification = Notification::FindOrFail($recordId);

            $this->delete($notification);

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of bulkDelete

    private function delete(Notification $notification)
    {
        $notification->delete();

    }// end of delete
}
